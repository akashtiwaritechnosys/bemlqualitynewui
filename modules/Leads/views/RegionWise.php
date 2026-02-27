<?php

class Leads_RegionWise_View extends Vtiger_Index_View {

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
			if ($row['region_code'] == $arrayKey && $row['eq_run_war_st'] == $pickkey) {
				return $row['eq_run_war_st_count'];
			}
		}
	}

	private $recordsTemp;
	private $recordsTempTotalHolder;

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$pickListValues = getAllPickListValues('eq_run_war_st');
		unset($pickListValues['Aggregate Warranty']);
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'Region wise');
		global $adb;

		// $nonCoalCustomers = array("BCCL", 'CCL', 'ECL', 'MCL', 'NCL', 'SECL', 'WCL');
		// $nonCoalCustomers = ["NLC"];
		$sql = "SELECT region_code,eq_run_war_st,count(region_code) as 'eq_run_war_st_count' " .
			" FROM `vtiger_equipment` " .
			" INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name " .
			" where  equip_category = 'S' " .
			" GROUP By region_code,eq_run_war_st";

		// array_push($nonCoalCustomers, 'S');
		$result = $adb->pquery($sql, array());
		$this->recordsTemp = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($this->recordsTemp, $row);
		}

		$result = $adb->pquery($sql, array());
		$records = [];
		while ($row = $adb->fetch_array($result)) {
			$arrayKey = $row['region_code'];
			if (array_key_exists($arrayKey, $records)) {
				$pushArray = $records[$arrayKey];
				if (count($pushArray) == (count($pickListValues) + 1)) {
					continue;
				}
				$totalCount = 0;
				foreach ($pickListValues as $pickkey => $pickValue) {
					$valCount = $this->getCountsBasedOnStatus($arrayKey, $pickkey);
					$totalCount = $totalCount + (int) $valCount;
					array_push($pushArray, $valCount);
				}
				array_push($pushArray, $totalCount);
				$records[$arrayKey] = $pushArray;
			} else {
				$pushArray = [];
				$totalCount = 0;
				foreach ($pickListValues as $pickkey => $pickValue) {
					$valCount = $this->getCountsBasedOnStatus($arrayKey, $pickkey);
					$totalCount = $totalCount + (int) $valCount;
					array_push($pushArray, $valCount);
				}
				array_push($pushArray, $totalCount);
				$records[$arrayKey] = $pushArray;
			}
		}
		$sql = "SELECT eq_run_war_st,count(eq_run_war_st) as 'count' ".
				"FROM `vtiger_equipment` ".
				" INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name ".
				" where  equip_category = 'S' " .
				" GROUP By eq_run_war_st";

		$result = $adb->pquery($sql, array());
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
			array_push($pushArray, $valCount);
		}
		array_push($pushArray, $totalAllGrand);
		$records['Grand Total'] = $pushArray;

		$viewer->assign('ResultArray', $records);
		$viewer->assign('PickListValues', $pickListValues);
		return $viewer->view('RegionWise.tpl', $moduleName, true);
	}

	function getTotalLastCountsBasedOnStatus($pickkey) {
		foreach ($this->recordsTempTotalHolder as $row) {
			if ($row['eq_run_war_st'] == $pickkey) {
				return $row['count'];
			}
		}
	}
}
