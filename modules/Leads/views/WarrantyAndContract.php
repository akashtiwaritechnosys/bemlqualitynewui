<?php

class Leads_WarrantyAndContract_View extends Vtiger_Index_View {

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
			if ($row['equip_model'] == $arrayKey && $row['eq_run_war_st'] == $pickkey) {
				return $row['eq_run_war_st_count'];
			}
		}
	}

	private $recordsTemp;
	private $recordsTempTotalHolder;

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$pickListValues = getAllPickListValues('eq_run_war_st');
		$pickListValuesRowColSub = getAllPickListValues('eq_division');
		unset($pickListValues['Aggregate Warranty']);
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'Warranty And Contract');
		global $adb;
		$mainResultArray = [];
		foreach ($pickListValuesRowColSub as $RowKey => $rowValue) {
			$sql = "SELECT equip_model,eq_run_war_st,count(equip_model) as 'eq_run_war_st_count'
				FROM `vtiger_equipment`
				where  equip_category= 'S' and eq_division = ?
				group by equip_model,eq_run_war_st";

			$ColumnColIg = 'eq_run_war_st';
			$rowColIg = 'equip_model';

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

			$sql = "SELECT eq_run_war_st,count(eq_run_war_st) as 'count'
				FROM `vtiger_equipment`
				where  equip_category= 'S' and eq_division = ?
				group by eq_run_war_st;";

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
			$records['Sub Total'] = $pushArray;
			$mainResultArray[$RowKey] =  $records;
		}

		$sql = "SELECT eq_run_war_st,count(eq_run_war_st) as 'count'
				FROM `vtiger_equipment`
				where  equip_category= 'S' and eq_division in (". generateQuestionMarks(array_keys($pickListValuesRowColSub)) .")
				group by eq_run_war_st;";

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

		$viewer->assign('ResultArray', $mainResultArray);
		$viewer->assign('PickListValues', $pickListValues);

		$viewer->assign('ColumnColIg', $ColumnColIg);
		$viewer->assign('rowColIg', $rowColIg);

		return $viewer->view('WarrantyAndContract.tpl', $moduleName, true);
	}

	function getTotalLastCountsBasedOnStatus($pickkey) {
		foreach ($this->recordsTempTotalHolder as $row) {
			if ($row['eq_run_war_st'] == $pickkey) {
				return $row['count'];
			}
		}
	}
}
