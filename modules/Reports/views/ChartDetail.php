<?php
/*************************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is: vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Reports_ChartDetail_View extends Vtiger_Index_View {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'DetailView', 'record_parameter' => 'record');
		return $permissions;
	}
	
	public function checkPermission(Vtiger_Request $request) {
		parent::checkPermission($request);
		$record = $request->get('record');
		$reportModel = Reports_Record_Model::getCleanInstance($record);
		$currentUserPriviligesModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();

		$owner = $reportModel->get('owner');
		$sharingType = $reportModel->get('sharingtype');

		$isRecordShared = true;
		if(($currentUserPriviligesModel->id != $owner) && $sharingType == "Private"){
			$isRecordShared = $reportModel->isRecordHasViewAccess($sharingType);
		}
		if(!$isRecordShared) {
			throw new AppException(vtranslate('LBL_PERMISSION_DENIED'));
		}
		return true;
	}

	function preProcess(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$recordId = $request->get('record');

		$this->record = $detailViewModel = Reports_DetailView_Model::getInstance($moduleName, $recordId);
		$reportModel = $detailViewModel->getRecord();
		$viewer->assign('REPORT_NAME', $reportModel->getName());

		parent::preProcess($request);

		$reportModel->setModule('Reports');

		$primaryModule = $reportModel->getPrimaryModule();
		$secondaryModules = $reportModel->getSecondaryModules();
		$primaryModuleModel = Vtiger_Module_Model::getInstance($primaryModule);

		$currentUser = Users_Record_Model::getCurrentUserModel();
		$userPrivilegesModel = Users_Privileges_Model::getInstanceById($currentUser->getId());
		$permission = $userPrivilegesModel->hasModulePermission($primaryModuleModel->getId());

		if(!$permission) {
			$viewer->assign('MODULE', $primaryModule);
			$viewer->assign('MESSAGE', vtranslate('LBL_PERMISSION_DENIED'));
			$viewer->view('OperationNotPermitted.tpl', $primaryModule);
			exit;
		}

		// Advanced filter conditions
		$viewer->assign('SELECTED_ADVANCED_FILTER_FIELDS', $reportModel->transformToNewAdvancedFilter());
		$viewer->assign('PRIMARY_MODULE', $primaryModule);
		$viewer->assign('SECONDARY_MODULES', $reportModel->getSecondaryModules());

		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($reportModel);
		$primaryModuleRecordStructure = $recordStructureInstance->getPrimaryModuleRecordStructure();
		$secondaryModuleRecordStructures = $recordStructureInstance->getSecondaryModuleRecordStructure();

		$viewer->assign('PRIMARY_MODULE_RECORD_STRUCTURE', $primaryModuleRecordStructure);
		$viewer->assign('SECONDARY_MODULE_RECORD_STRUCTURES', $secondaryModuleRecordStructures);

		$secondaryModuleIsCalendar = strpos($secondaryModules, 'Calendar');
		if(($primaryModule == 'Calendar') || ($secondaryModuleIsCalendar !== FALSE)){
			$advanceFilterOpsByFieldType = Calendar_Field_Model::getAdvancedFilterOpsByFieldType();
		} else{
			$advanceFilterOpsByFieldType = Vtiger_Field_Model::getAdvancedFilterOpsByFieldType();
		}
		$viewer->assign('ADVANCED_FILTER_OPTIONS', Vtiger_Field_Model::getAdvancedFilterOptions());
		$viewer->assign('ADVANCED_FILTER_OPTIONS_BY_TYPE', $advanceFilterOpsByFieldType);
		$dateFilters = Vtiger_Field_Model::getDateFilterTypes();
		foreach($dateFilters as $comparatorKey => $comparatorInfo) {
			$comparatorInfo['startdate'] = DateTimeField::convertToUserFormat($comparatorInfo['startdate']);
			$comparatorInfo['enddate'] = DateTimeField::convertToUserFormat($comparatorInfo['enddate']);
			$comparatorInfo['label'] = vtranslate($comparatorInfo['label'],$moduleName);
			$dateFilters[$comparatorKey] = $comparatorInfo;
		}

		$reportChartModel = Reports_Chart_Model::getInstanceById($reportModel);

		$viewer->assign('PRIMARY_MODULE_FIELDS', $reportModel->getPrimaryModuleFieldsForAdvancedReporting());
		$viewer->assign('SECONDARY_MODULE_FIELDS', $reportModel->getSecondaryModuleFieldsForAdvancedReporting());
		$viewer->assign('CALCULATION_FIELDS', $reportModel->getModuleCalculationFieldsForReport());

		$viewer->assign('DATE_FILTERS', $dateFilters);
		$viewer->assign('DETAILVIEW_ACTIONS', $detailViewModel->getDetailViewActions());
		$viewer->assign('REPORT_MODEL', $reportModel);
		$viewer->assign('RECORD', $recordId);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('CHART_MODEL', $reportChartModel);

		$dashBoardModel = new Vtiger_DashBoard_Model();
		$activeTabs = $dashBoardModel->getActiveTabs();
		foreach($activeTabs as $index => $tabInfo) {
			if(!empty($tabInfo['appname'])) {
				unset($activeTabs[$index]);
			}
		}
		$viewer->assign('DASHBOARD_TABS', $activeTabs);

		//Pivot Report
		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_report WHERE reportid = ?", array($recordId));
		$report_type = $adb->query_result($query, 0, 'report_type');
		$viewer->assign('report_type', $report_type);
		//Pivot Report

		$viewer->view('ChartReportHeader.tpl', $moduleName);
	}

	function process(Vtiger_Request $request) {
		$mode = $request->getMode();
		if(!empty($mode)) {
			$this->invokeExposedMethod($mode, $request);
			return;
		}
		echo $this->getReport($request);
	}

	function getReport(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$record = $request->get('record');

		$reportModel = Reports_Record_Model::getInstanceById($record);
		$reportChartModel = Reports_Chart_Model::getInstanceById($reportModel);
		$secondaryModules = $reportModel->getSecondaryModules();
		if(empty($secondaryModules)) {
			$viewer->assign('CLICK_THROUGH', true);
		}

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

		$viewer->assign('ADVANCED_FILTERS', $request->get('advanced_filter'));
		$viewer->assign('PRIMARY_MODULE_FIELDS', $reportModel->getPrimaryModuleFields());
		$viewer->assign('SECONDARY_MODULE_FIELDS', $reportModel->getSecondaryModuleFields());
		$viewer->assign('CALCULATION_FIELDS', $reportModel->getModuleCalculationFieldsForReport());

		$data = $reportChartModel->getData();
		$viewer->assign('CHART_TYPE', $reportChartModel->getChartType());
		$viewer->assign('DATA', $data);
		$viewer->assign('REPORT_MODEL', $reportModel);

		$viewer->assign('RECORD_ID', $record);
		$viewer->assign('REPORT_MODEL', $reportModel);
		$viewer->assign('SECONDARY_MODULES',$secondaryModules);
		$viewer->assign('MODULE', $moduleName);

		//Pivot Report
		global $adb;
		$query = $adb->pquery("SELECT * FROM vtiger_report WHERE reportid = ?", array($record));
		$report_type = $adb->query_result($query, 0, 'report_type');
		$viewer->assign('report_type', $report_type);

		$fieldlabel = explode(':', $reportChartModel->get('groupbyfield'));
		$labelQuery = $adb->pquery("SELECT * FROM vtiger_field WHERE fieldname = ?", array($fieldlabel[1]));
		$moduleifeldLabel = $adb->query_result($labelQuery, 0, 'fieldlabel');
		$primaryModule = $reportModel->getPrimaryModule();
		$viewer->assign('fieldlabel', vtranslate($moduleifeldLabel, $primaryModule));
		
		if($report_type == 'Pivot'){
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
				$hraderColumn = $adb->query_result($result, $i, '2');
				$rowsCounts = $adb->query_result($result, $i, '0');
				$rowsColumn = $adb->query_result($result, $i, '1');

				$columnCountValue = array();
				foreach ($herderValues as $key => $value) {
					if($value == $hraderColumn){
						$columnCountValue[$hraderColumn] = $rowsCounts;
					}
				}

				$pivotReportArray[$rowsColumn][] = array('rowsColumn' => $rowsColumn, 'rowsCounts' => $rowsCounts, 'hraderColumn' => $columnCountValue);

			}
			
			$newArray = array();
			$headerValuesArray = array();
			foreach ($pivotReportArray as $key => $value) {	
			$diffArray = array();
				foreach ($value as $key1 => $value1) {	
					foreach ($herderValues as $key11 => $value11) {
						foreach ($value1['hraderColumn'] as $key12 => $value12) {
							if($value11 == $key12){
								$diffArray[$value11] = $value12;
							}
							$headerValuesArray[$value11] = $value11;
							$newArray[$key] = array('rowsColumn' => $value1['rowsColumn'], 'hraderColumn' => $diffArray, 'headerValuesArray' => $headerValuesArray);
						}
					}
				}
			}
			$viewer->assign('herderValues', $headerValuesArray);
			$viewer->assign('pivotReportArray', $newArray);
		}

		//Pivot Report

		$viewer->view('ChartReportContents.tpl', $moduleName);
	}

	/**
	 * Function to get the list of Script models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_JsScript_Model instances
	 */
	function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			'modules.Vtiger.resources.Detail',
			"modules.Vtiger.resources.dashboards.Widget",
			"modules.$moduleName.resources.Detail",
			"modules.$moduleName.resources.Edit",
			"modules.$moduleName.resources.Edit3",
			"modules.$moduleName.resources.ChartEdit",
			"modules.$moduleName.resources.ChartEdit2",
			"modules.$moduleName.resources.ChartEdit3",
			"modules.$moduleName.resources.ChartDetail",
			'~/libraries/jquery/gridster/jquery.gridster.min.js',
			'~/libraries/jquery/jqplot/jquery.jqplot.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.canvasTextRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.canvasAxisTickRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.pieRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.barRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.categoryAxisRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.pointLabels.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.canvasAxisLabelRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.funnelRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.barRenderer.min.js',
			'~/libraries/jquery/jqplot/plugins/jqplot.logAxisRenderer.min.js',
			'~/libraries/jquery/VtJqplotInterface.js',
			'~/libraries/jquery/vtchart.js',
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	/**
	 * Function to get the list of Css models to be included
	 * @param Vtiger_Request $request
	 * @return <Array> - List of Vtiger_CssScript_Model instances
	 */
	public function getHeaderCss(Vtiger_Request $request) {
		$parentHeaderCssScriptInstances = parent::getHeaderCss($request);

		$headerCss = array(
			'~libraries/jquery/jqplot/jquery.jqplot.min.css'
		);
		$cssScripts = $this->checkAndConvertCssStyles($headerCss);
		$headerCssScriptInstances = array_merge($parentHeaderCssScriptInstances , $cssScripts);
		return $headerCssScriptInstances;
	}

}
