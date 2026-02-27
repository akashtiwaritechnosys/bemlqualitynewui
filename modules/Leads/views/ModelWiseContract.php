<?php

class Leads_ModelWiseContract_View extends Vtiger_Index_View {

	function __construct() {
		parent::__construct();
	}

	public function requiresPermission(Vtiger_Request $request) {
		return true;
	}

	function process(Vtiger_Request $request) {
		echo $this->showModuleDetailView($request);
	}

	function getCountsBasedOnStatus($arrayKey, $pickkey) {
		foreach ($this->recordsTemp as $row) {
			if ($row['equip_model'] == $arrayKey && $row['eq_type_of_conrt'] == $pickkey) {
				return $row['eq_run_war_st_count'];
			}
		}
	}

	private $recordsTemp;
	private $recordsTempTotalHolder;

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$pickListValues = getAllPickListValues('eq_type_of_conrt');

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'Model Wise Contract');
		global $adb;

		$sql = "SELECT equip_model,eq_type_of_conrt,count(equip_model) as 'eq_run_war_st_count'
				FROM `vtiger_equipment`
				where eq_run_war_st = 'Contract' and equip_category= 'S' 
				group by equip_model,eq_type_of_conrt";
		$result = $adb->pquery($sql, array());
		$this->recordsTemp = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($this->recordsTemp, $row);
		}

		$result = $adb->pquery($sql, array());
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
				array_push($pushArray, array('Grand Total' => $totalCount));
				$records[$arrayKey] = $pushArray;
			} else {
				$pushArray = [];
				$totalCount = 0;
				foreach ($pickListValues as $pickkey => $pickValue) {
					$valCount = $this->getCountsBasedOnStatus($arrayKey, $pickkey);
					$totalCount = $totalCount + (int) $valCount;
					array_push($pushArray, array($pickkey => $valCount));
				}
				array_push($pushArray, array('Grand Total' => $totalCount));
				$records[$arrayKey] = $pushArray;
			}
		}

		$sql = "SELECT eq_type_of_conrt,count(eq_type_of_conrt) as 'count'
				FROM `vtiger_equipment`
				where eq_run_war_st = 'Contract' and equip_category= 'S' 
				group by eq_type_of_conrt;";

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
			array_push($pushArray, array($pickkey => $valCount));
		}
		array_push($pushArray, array('Grand Total' => $totalAllGrand));
		$records['Grand Total'] = $pushArray;

		// print_r($records);
		// die();
		$viewer->assign('ResultArray', $records);
		$viewer->assign('PickListValues', $pickListValues);
		return $viewer->view('ModelWiseContract.tpl', $moduleName, true);
	}

	function getTotalLastCountsBasedOnStatus($pickkey) {
		foreach ($this->recordsTempTotalHolder as $row) {
			if ($row['eq_type_of_conrt'] == $pickkey) {
				return $row['count'];
			}
		}
	}
}
