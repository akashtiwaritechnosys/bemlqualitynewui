<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Reports_ChartSaveAjax_View extends Vtiger_IndexAjax_View {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$record = $request->get('record');
		$reportModel = Reports_Record_Model::getInstanceById($record);
		$reportModel->setModule('Reports');
		$reportModel->set('advancedFilter', $request->get('advanced_filter'));


		$secondaryModules = $reportModel->getSecondaryModules();
		if(empty($secondaryModules)) {
			$viewer->assign('CLICK_THROUGH', true);
		}

		$dataFields = $request->get('datafields', 'count(*)');
		if(is_string($dataFields)) $dataFields = array($dataFields);

		$reportModel->set('reporttypedata', Zend_Json::encode(array(
																'type'=>$request->get('charttype', 'pieChart'),
																'groupbyfield'=>$request->get('groupbyfield'),'groupbyfield1'=>$request->get('groupbyfield1'),
																'datafields'=>$dataFields)
															));
		$reportModel->set('reporttype', 'chart');
		$reportModel->save();

		$reportChartModel = Reports_Chart_Model::getInstanceById($reportModel);
        
        $data = $reportChartModel->getData();
		$viewer->assign('CHART_TYPE', $reportChartModel->getChartType());
		$viewer->assign('DATA', $data);
		$viewer->assign('MODULE', $moduleName);
        $viewer->assign('REPORT_MODEL', $reportModel);

		$isPercentExist = false;
		$selectedDataFields = $reportChartModel->get('datafields');
		foreach ($selectedDataFields as $dataField) {
			list($tableName, $columnName, $moduleField, $fieldName, $single) = split(':', $dataField);
			list($relModuleName, $fieldLabel) = split('_', $moduleField);
			$relModuleModel = Vtiger_Module_Model::getInstance($relModuleName);
			$fieldModel = Vtiger_Field_Model::getInstance($fieldName, $relModuleModel);
			if ($fieldModel && $fieldModel->getFieldDataType() != 'currency') {
				$isPercentExist = true;
				break;
			} else if (!$fieldModel) {
				$isPercentExist = true;
			}
		}

		$yAxisFieldDataType = (!$isPercentExist) ? 'currency' : '';
		$viewer->assign('YAXIS_FIELD_TYPE', $yAxisFieldDataType);

		//Pivot Report
		global $adb;
		$type = $request->get('type');
		$viewer->assign('report_type', $type); 
		$fieldlabel = explode(':', $reportChartModel->get('groupbyfield'));
		$labelQuery = $adb->pquery("SELECT * FROM vtiger_field WHERE fieldname = ?", array($fieldlabel[1]));
		$moduleifeldLabel = $adb->query_result($labelQuery, 0, 'fieldlabel');
		$primaryModule = $reportModel->getPrimaryModule();
		$viewer->assign('fieldlabel', vtranslate($moduleifeldLabel, $primaryModule));
		
		if($type == 'Pivot'){
			$getHeaderFieldQuery = $adb->pquery("SELECT * FROM vtiger_reporttype WHERE reportid = ?", array($record));
			$headerFieldData = Zend_Json::decode(decode_html($adb->query_result($getHeaderFieldQuery, 0, 'data')));
			$groupbyfield1 = explode(':', $headerFieldData['groupbyfield1']);
			$viewer->assign('groupbyfield1', $groupbyfield1);
			$getHeaderValueQuery = $adb->pquery("SELECT * FROM vtiger_".$groupbyfield1[1]."", array());
			$getHeaderValueRows = $adb->num_rows($getHeaderValueQuery);
			$herderValues = array();
			for ($i=0; $i < $getHeaderValueRows; $i++) { 
				$header = $adb->query_result($getHeaderValueQuery, $i, $groupbyfield1[1]);
				$herderValues[] = $header;
			}
		
			$viewer->assign('herderValues', $herderValues);
		
			$query = $data['chartSQL'];
			$result = $adb->pquery($query, array());
			$resultRows = $adb->num_rows($result);
			
			$pivotReportArray = array();
			for ($i=0; $i < $resultRows; $i++) { 
				$columnCountValue = array();
				$hraderColumn = $adb->query_result($result, $i, '2');
				$rowsCounts = $adb->query_result($result, $i, '0');
				$rowsColumn = $adb->query_result($result, $i, '1');

				foreach ($herderValues as $key => $value) {
					if($value == $hraderColumn){
						$columnCountValue[$hraderColumn] = $rowsCounts;
					}else{
						$columnCountValue[$value] = 0;
					}
				}

				$pivotReportArray[$hraderColumn] = array('rowsColumn' => $rowsColumn, 'rowsCounts' => $rowsCounts, 'hraderColumn' => $columnCountValue);
			}
			$viewer->assign('pivotReportArray', $pivotReportArray);
		}
		//Pivot Report
		$viewer->view('ChartReportContents.tpl', $moduleName);
	}
}