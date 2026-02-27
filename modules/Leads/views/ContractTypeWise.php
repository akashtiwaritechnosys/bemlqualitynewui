<?php

class Leads_ContractTypeWise_View extends Vtiger_Index_View {

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

	function preProcess(Vtiger_Request $request, $display = true) {
		//Vtiger7 - TO show custom view name in Module Header
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$viewer->assign('CUSTOM_VIEWS', CustomView_Record_Model::getAllByGroup($moduleName));
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$record = $request->get('record');
		if (!empty($record) && $moduleModel->isEntityModule()) {
			$recordModel = $this->record ? $this->record : Vtiger_Record_Model::getInstanceById($record, $moduleName);
			$viewer->assign('RECORD', $recordModel);
		}

		$duplicateRecordsList = array();
		$duplicateRecords = $request->get('duplicateRecords');

		if (is_array($duplicateRecords)) {
			$duplicateRecordsList = $duplicateRecords;
		}

		$viewer = $this->getViewer($request);
		$viewer->assign('SPECIAL_ERROR', $request->get('specialError'));
		$viewer->assign('DUPLICATE_RECORDS', $duplicateRecordsList);
		parent::preProcess($request, $display);
	}

	function process(Vtiger_Request $request) {
		echo $this->showModuleDetailView($request);
	}

	private $pickListValues;

	function showModuleDetailView(Vtiger_Request $request) {
		$this->pickListValues = getAllPickListValues('eq_type_of_conrt');
		$this->pickListValues[''] = '';
		$a = $this->getLastlevelStatusCountArray('BD355', 'NCL');
		$moduleName = $request->getModule();

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'Contract Type Wise');
		global $adb;
		$sql = "SELECT equip_model,org_code
		FROM `vtiger_equipment`
		INNER JOIN vtiger_account ON vtiger_account.accountid = vtiger_equipment.account_id
		where eq_run_war_st = 'Contract' and equip_category= 'S'
		group by equip_model,org_code;";

		$result = $adb->pquery($sql, array());
		$records = [];
		while ($row = $adb->fetch_array($result)) {
			$arrayKey = $row['equip_model'];

			if (array_key_exists($arrayKey, $records)) {
				$lastConuts = $this->getLastlevelStatusCountArray($arrayKey, $row['org_code']);
				$pushArray = $records[$arrayKey];
				array_push($pushArray, array($row['org_code'] => $lastConuts));
				$records[$arrayKey] = $pushArray;
			} else {
				$lastConuts = $this->getLastlevelStatusCountArray($arrayKey, $row['org_code']);
				$pushArray = [];
				array_push($pushArray, array($row['org_code'] => $lastConuts));
				$records[$arrayKey] = $pushArray;
			}
		}

		$alteredRecords = [];
		foreach ($records as $masterKey => $record) {
			$countmaintainArray = [];
			foreach ($record as $key => $recordItems) {
				foreach ($recordItems as $key1 => $value) {
					foreach ($value as $key2 => $value2) {
						$countmaintainArray[$key2] = (int) $countmaintainArray[$key2] + $value2['Count'];
					}
				}
			}
			if (count($record) > 1) {
				array_push($record, array('Sub Total' => $countmaintainArray));
			}
			$alteredRecords[$masterKey] = $record;
		}
		$records = $alteredRecords;

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
		foreach ($this->pickListValues as $pickkey => $pickValue) {
			$valCount = $this->getTotalLastCountsBasedOnStatusFooter($pickkey);
			$totalAllGrand = $totalAllGrand + (int) $valCount;
			array_push($pushArray, $valCount);
		}
		array_push($pushArray, $totalAllGrand);

		$AnoPushArray = [];
		array_push($AnoPushArray, array('Grand Total' => $pushArray));
		$records['.'] = $AnoPushArray;

		$viewer->assign('ResultArray', $records);
		$viewer->assign('PickListValues', $this->pickListValues);
		return $viewer->view('ContractTypeWise.tpl', $moduleName, true);
	}

	private $recordsTemp;
	private $recordsTempTotalHolder;

	function getTotalLastCountsBasedOnStatusFooter($pickkey) {
		foreach ($this->recordsTempTotalHolder as $row) {
			if ($row['eq_type_of_conrt'] == $pickkey) {
				return $row['count'];
			}
		}
	}

	function getLastlevelStatusCountArray($model, $orgCode) {
		global $adb;

		$sql = "SELECT eq_type_of_conrt,count(eq_type_of_conrt) as 'count'
		FROM `vtiger_equipment`
		INNER JOIN vtiger_account ON vtiger_account.accountid = vtiger_equipment.account_id
		where eq_run_war_st = 'Contract' and equip_category= 'S' 
		and equip_model = ? and org_code = ?
		group by eq_type_of_conrt";

		if (empty($orgCode)) {
			$orgCode = '';
			$sql = "SELECT eq_type_of_conrt,count(eq_type_of_conrt) as 'count'
			FROM `vtiger_equipment`
			INNER JOIN vtiger_account ON vtiger_account.accountid = vtiger_equipment.account_id
			where eq_run_war_st = 'Contract' and equip_category= 'S' 
			and equip_model = ? and (org_code IS NULL or org_code = ?) 
			group by eq_type_of_conrt";
		}

		$result = $adb->pquery($sql, array($model, $orgCode));
		$this->recordsTemp = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($this->recordsTemp, $row);
		}
		$pushArray = [];
		$totalCount = 0;
		foreach ($this->pickListValues as $pickkey => $pickValue) {
			$valCount = $this->getTotalLastCountsBasedOnStatus($pickkey);
			$totalCount = $totalCount + (int) $valCount;
			array_push($pushArray, array(
				'Colkey' => $pickkey,
				'Count' => $valCount
			));
		}
		array_push($pushArray, array(
			'Colkey' => 'Total',
			'Count' => $totalCount
		));
		return $pushArray;
	}

	function getTotalLastCountsBasedOnStatus($pickkey) {
		foreach ($this->recordsTemp as $row) {
			if ($row['eq_type_of_conrt'] == $pickkey) {
				return $row['count'];
			}
		}
	}
}
