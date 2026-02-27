<?php

class Leads_Warranty_View extends Vtiger_Index_View {

	function __construct() {
		parent::__construct();
	}

	public function requiresPermission(Vtiger_Request $request) {
		return true;
	}
	public function getOverlayHeaderScripts(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$jsFileNames = array(
			"modules.$moduleName.resources.Edit",
		);
		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		return $jsScriptInstances;
	}

	function process(Vtiger_Request $request) {
		echo $this->showModuleDetailView($request);
	}

	function getCountsBasedOnStatus($arrayKey, $pickkey) {
		foreach ($this->recordsTemp as $row) {
			if ($row['equip_model'] == $arrayKey && $row['region_code'] == $pickkey) {
				return $row['eq_run_war_st_count'];
			}
		}
	}

	private $recordsTemp;
	private $recordsTempTotalHolder;

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$pickListValues = getAllPickListValues('region_code');
		$pickListValuesRowColSub = getAllPickListValues('eq_division');
		unset($pickListValues['Aggregate Warranty']);
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'Under Warranty');
		$ColumnColIg = '(plant_name ; (MaintenancePlant) region_code)';
		$rowColIg = 'equip_model';
		global $adb;

		$mainResultArray = [];
		foreach ($pickListValuesRowColSub as $RowKey => $rowValue) {
			$sql = "SELECT equip_model,region_code,count(equip_model) as 'eq_run_war_st_count'
				FROM `vtiger_equipment`
				INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name
				where  equip_category= 'S' and eq_run_war_st = 'Under Warranty' and eq_division = ?
				group by equip_model,region_code";

			$result = $adb->pquery($sql, array($RowKey));
			$this->recordsTemp = [];
			while ($row = $adb->fetch_array($result)) {
				array_push($this->recordsTemp, $row);
			}

			$result = $adb->pquery($sql, array($RowKey));
			$records = [];
			while ($row = $adb->fetch_array($result)) {
				$arrayKey = $row['equip_model'];
				if (array_key_exists($arrayKey, $records)) {
					$pushArray = $records[$arrayKey];
					if (count($pushArray) == (count($pickListValues) + 1)) {
						continue;
					}
					$totalCount = 0;
					foreach ($pickListValues as $pickkey => $pickValue) {
						$valCount = $this->getCountsBasedOnStatus($arrayKey, $pickkey);
						$totalCount = $totalCount + (int) $valCount;
						array_push($pushArray, array($pickkey => $valCount));
					}
					array_push($pushArray, $totalCount);
					$records[$arrayKey] = $pushArray;
				} else {
					$pushArray = [];
					$totalCount = 0;
					foreach ($pickListValues as $pickkey => $pickValue) {
						$valCount = $this->getCountsBasedOnStatus($arrayKey, $pickkey);
						$totalCount = $totalCount + (int) $valCount;
						array_push($pushArray, array($pickkey => $valCount));
					}
					array_push($pushArray, $totalCount);
					$records[$arrayKey] = $pushArray;
				}
			}

			$sql = "SELECT region_code,count(region_code) as 'count'
				FROM `vtiger_equipment`
				INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name 
				where  equip_category= 'S' and eq_run_war_st = 'Under Warranty' and eq_division = ?
				group by region_code;";

			$result = $adb->pquery($sql, array($RowKey));
			$this->recordsTempTotalHolder = [];
			while ($row = $adb->fetch_array($result)) {
				array_push($this->recordsTempTotalHolder, $row);
			}

			$pushArray = [];
			$totalCount = 0;
			$totalAllGrand = 0;
			foreach ($pickListValues as $pickkey => $pickValue) {
				$valCount = $this->getTotalLastCountsBasedOnStatus($pickkey);
				$totalAllGrand = $totalAllGrand + (int) $valCount;
				array_push($pushArray, array($pickkey => $valCount));
			}

			array_push($pushArray, $totalAllGrand);
			$records['Grand Total'] = $pushArray;
			$mainResultArray[$RowKey] =  $records;
		}

		$sql = "SELECT region_code,count(region_code) as 'count'
				FROM `vtiger_equipment`
				INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name 
				where  equip_category= 'S' and eq_run_war_st = 'Under Warranty' 
				and eq_division in (". generateQuestionMarks(array_keys($pickListValuesRowColSub)) .")
				group by region_code;";

		$result = $adb->pquery($sql, array_keys($pickListValuesRowColSub));
		$this->recordsTempTotalHolder = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($this->recordsTempTotalHolder, $row);
		}

		$pushArray = [];
		$totalCount = 0;
		$totalAllGrand = 0;
		foreach ($pickListValues as $pickkey => $pickValue) {
			$valCount = $this->getTotalLastCountsBasedOnStatus($pickkey);
			$totalAllGrand = $totalAllGrand + (int) $valCount;
			array_push($pushArray, array($pickkey => $valCount));
		}

		array_push($pushArray, $totalAllGrand);
		$records = [];
		$records['Total'] = $pushArray;
		$mainResultArray['Total'] =  $records;

		$viewer->assign('ColumnColIg', $ColumnColIg);
		$viewer->assign('rowColIg', $rowColIg);
		$viewer->assign('ResultArray', $mainResultArray);
		$viewer->assign('PickListValues', $pickListValues);
		return $viewer->view('Warranty.tpl', $moduleName, true);
	}

	function getTotalLastCountsBasedOnStatus($pickkey) {
		foreach ($this->recordsTempTotalHolder as $row) {
			if ($row['region_code'] == $pickkey) {
				return $row['count'];
			}
		}
	}
}
