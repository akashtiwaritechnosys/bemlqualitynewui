<?php

class Leads_CoalCustomer_View extends Vtiger_Index_View {

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

	function getCountsBasedOnStatusSTA($equipModel, $regionCode, $warstatus) {
		foreach ($this->recordsTempSTA as $row) {
			if ($row['equip_model'] == $equipModel && $row['org_code'] == $regionCode && $row['eq_run_war_st'] == $warstatus) {
				return $row['eq_run_war_st_count'];
			}
		}
	}

	function getCountsBasedOnStatusCountSTA($regionCode, $warstatus) {
		foreach ($this->recordsTempSTA as $row) {
			if ($row['org_code'] == $regionCode && $row['eq_run_war_st'] == $warstatus) {
				return $row['eq_run_war_st_count'];
			}
		}
	}
	private $recordsTempSTA;

	function getRegionWiseStatusdata() {
		$pickListValues = getAllPickListValues('eq_run_war_st');
		unset($pickListValues['Aggregate Warranty']);
		$regionCodes = array(
			"BCCL" => "BCCL", 'CCL' => 'CCL',
			'ECL' => 'ECL', 'MCL' => 'MCL', 'NCL' => 'NCL', 'SECL' => 'SECL', 'WCL' => 'WCL'
		);
		global $adb;
		$pickListValuesRowColSub = getAllPickListValues('eq_division');
		$mainResultArray =  [];
		foreach ($pickListValuesRowColSub as $RowKey => $rowValue) {
			$sql = "SELECT equip_model,org_code,eq_run_war_st,count(org_code) as 'eq_run_war_st_count' " .
				" FROM `vtiger_equipment` " .
				" INNER JOIN vtiger_account " .
				" ON vtiger_account.accountid = vtiger_equipment.account_id " .
				" where  equip_category = 'S' and eq_division = ? " .
				" GROUP By equip_model,org_code,eq_run_war_st";
			$result = $adb->pquery($sql, array($RowKey));
			$this->recordsTempSTA = [];
			while ($row = $adb->fetch_array($result)) {
				array_push($this->recordsTempSTA, $row);
			}

			$result = $adb->pquery($sql, array($RowKey));
			$records = [];
			while ($row = $adb->fetch_array($result)) {
				$arrayKey = $row['equip_model'];
				if (array_key_exists($arrayKey, $records)) {
				} else {
					$pushArray = [];
					$totalCount = 0;
					foreach ($regionCodes as $regionCodekey => $regionCodeValue) {
						$InnerObject = [];
						foreach ($pickListValues as $pickkey => $pickValue) {
							$valCount = $this->getCountsBasedOnStatusSTA($arrayKey, $regionCodekey, $pickkey);
							$totalCount = $totalCount + (int) $valCount;
							array_push($InnerObject, array($pickkey => $valCount));
						}
						array_push($pushArray, array($regionCodekey => $InnerObject));
					}
					array_push($pushArray, $totalCount);
					$records[$arrayKey] = $pushArray;
				}
			}
			$sql = "SELECT org_code,eq_run_war_st,count(org_code) as 'eq_run_war_st_count' " .
				" FROM `vtiger_equipment` " .
				" INNER JOIN vtiger_account " .
				" ON vtiger_account.accountid = vtiger_equipment.account_id " .
				" where  equip_category = 'S' and eq_division = ? " .
				" GROUP By org_code,eq_run_war_st";
			$result = $adb->pquery($sql, array($RowKey));
			$this->recordsTempSTA = [];
			while ($row = $adb->fetch_array($result)) {
				array_push($this->recordsTempSTA, $row);
			}
			$pushArray = [];
			$totalCount = 0;
			foreach ($regionCodes as $regionCodekey => $regionCodeValue) {
				$InnerObject = [];
				foreach ($pickListValues as $pickkey => $pickValue) {
					$valCount = $this->getCountsBasedOnStatusCountSTA($regionCodekey, $pickkey);
					$totalCount = $totalCount + (int) $valCount;
					array_push($InnerObject,  array($pickkey => $valCount));
				}
				array_push($pushArray, array($regionCodekey => $InnerObject));
			}
			array_push($pushArray, $totalCount);
			$records['Sub Total'] = $pushArray;
			$mainResultArray[$RowKey] =  $records;
		}
		$sql = "SELECT org_code,eq_run_war_st,count(org_code) as 'eq_run_war_st_count' " .
			" FROM `vtiger_equipment` " .
			" INNER JOIN vtiger_account " .
			" ON vtiger_account.accountid = vtiger_equipment.account_id " .
			" where  equip_category = 'S' and eq_division in (" . generateQuestionMarks(array_keys($pickListValuesRowColSub)) . ")  " .
			" GROUP By org_code,eq_run_war_st";
		$result = $adb->pquery($sql, array_keys($pickListValuesRowColSub));
		$this->recordsTempSTA = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($this->recordsTempSTA, $row);
		}
		$pushArray = [];
		$totalCount = 0;
		foreach ($regionCodes as $regionCodekey => $regionCodeValue) {
			$InnerObject = [];
			foreach ($pickListValues as $pickkey => $pickValue) {
				$valCount = $this->getCountsBasedOnStatusCountSTA($regionCodekey, $pickkey);
				$totalCount = $totalCount + (int) $valCount;
				array_push($InnerObject,  array($pickkey => $valCount));
			}
			array_push($pushArray, array($regionCodekey => $InnerObject));
		}
		array_push($pushArray, $totalCount);
		$records = [];
		$records['Total'] = $pushArray;
		$mainResultArray['Total'] =  $records;
		return $mainResultArray;
	}

	private $recordsTemp;
	private $recordsTempTotalHolder;

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$pickListValues = array(
			"BCCL" => "BCCL", 'CCL' => 'CCL',
			'ECL' => 'ECL', 'MCL' => 'MCL', 'NCL' => 'NCL', 'SECL' => 'SECL', 'WCL' => 'WCL'
		);
		$anotherColumnGroup = getAllPickListValues('eq_run_war_st');
		unset($anotherColumnGroup['Aggregate Warranty']);
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'COAL CUSTOMERS');
		global $adb;

		$staRecords = $this->getRegionWiseStatusdata();
		$viewer->assign('ResultArray', $staRecords);

		$RowColIgKey = 'equip_model';
		$ColColMainKey = "(account_id+;+(Accounts)+org_code)";
		$ColColSubKey = 'eq_run_war_st';

		$viewer->assign('RowColIgKey', $RowColIgKey);
		$viewer->assign('ColColMainKey', $ColColMainKey);
		$viewer->assign('ColColSubKey', $ColColSubKey);

		$viewer->assign('PickListValues', $pickListValues);
		$viewer->assign('anotherColumnGroup', $anotherColumnGroup);
		return $viewer->view('CoalCustomer.tpl', $moduleName, true);
	}
}
