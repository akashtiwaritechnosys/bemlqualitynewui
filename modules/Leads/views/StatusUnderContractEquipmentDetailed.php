<?php

class Leads_StatusUnderContractEquipmentDetailed_View extends Vtiger_Index_View {

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
		unset($pickListValues['Aggregate Warranty']);
		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'DETAILS OF OFF ROAD UNDER CONTRACT EQUIPMENTS');
		global $adb;
		$headers = [
			'vtiger_equipment.equipment_sl_no',
			'dte_of_commissing', 'date_of_failure',
			'vtiger_servicereports.hmr', 'no_of_days', 'region_code', 'org_code',
			'fd_obvservation', 'action_taken_block', 'resp', 'pdc_date'
		];
		$sql = "SELECT vtiger_equipment.equipment_sl_no,dte_of_commissing,date_of_failure,vtiger_servicereports.hmr,no_of_days,
				region_code,vtiger_account.org_code,fd_obvservation,action_taken_block,'',pdc_date
			FROM `vtiger_servicereports`
			INNER JOIN vtiger_servicereportscf ON vtiger_servicereportscf.servicereportsid = vtiger_servicereports.servicereportsid
			INNER JOIN vtiger_account ON vtiger_account.accountid = vtiger_servicereports.account_id
			INNER JOIN vtiger_equipment ON vtiger_equipment.equipmentid = vtiger_servicereports.equipment_id
			INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name
			INNER JOIN vtiger_troubletickets ON vtiger_troubletickets.ticketid = vtiger_servicereports.ticket_id
			where  vtiger_servicereports.sr_war_status = 'Contract' and vtiger_servicereports.is_recommisionreport = 0";
		
		$result = $adb->pquery($sql, array());
		$records = [];
		$dateFields = ['pdc_date', 'date_of_failure', 'dte_of_commissing'];
		while ($row = $adb->fetchByAssoc($result)) {
			foreach ($row as $rowKey => $rowVal) {
				if (in_array($rowKey, $dateFields)) {
					$row[$rowKey] = Vtiger_Date_UIType::getDisplayDateValue($rowVal);
				}
			}
			array_push($records, $row);
		}
		$viewer->assign('ResultArray', $records);
		$sql = "SELECT vtiger_equipment.equipment_sl_no,dte_of_commissing,date_of_failure,vtiger_servicereports.hmr,no_of_days,
				region_code,vtiger_account.org_code,vtiger_recommissioningreportscf.fd_obvservation,vtiger_recommissioningreportscf.action_taken_block,'',pdc_date
			FROM `vtiger_servicereports`
			INNER JOIN vtiger_servicereportscf ON vtiger_servicereportscf.servicereportsid = vtiger_servicereports.servicereportsid
			INNER JOIN vtiger_account ON vtiger_account.accountid = vtiger_servicereports.account_id
			INNER JOIN vtiger_equipment ON vtiger_equipment.equipmentid = vtiger_servicereports.equipment_id
			INNER JOIN vtiger_maintenanceplant ON vtiger_maintenanceplant.maintenanceplantid = vtiger_equipment.plant_name
			INNER JOIN vtiger_troubletickets ON vtiger_troubletickets.ticketid = vtiger_servicereports.ticket_id
			INNER JOIN vtiger_recommissioningreportscf
				ON vtiger_recommissioningreportscf.servicereportsid = vtiger_servicereports.servicereportsid 
			where  vtiger_servicereports.sr_war_status = 'Contract'";

		$result = $adb->pquery($sql, array());
		$records = [];
		$dateFields = ['pdc_date', 'date_of_failure', 'dte_of_commissing'];
		while ($row = $adb->fetchByAssoc($result)) {
			foreach ($row as $rowKey => $rowVal) {
				if (in_array($rowKey, $dateFields)) {
					$row[$rowKey] = Vtiger_Date_UIType::getDisplayDateValue($rowVal);
				}
			}
			array_push($records, $row);
		}
		$viewer->assign('ResultArrayRemm', $records);
		$viewer->assign('PickListValues', $pickListValues);
		$viewer->assign('headers', $headers);

		return $viewer->view('StatusUnderContractEquipmentDetailed.tpl', $moduleName, true);
	}

	function getTotalLastCountsBasedOnStatus($pickkey) {
		foreach ($this->recordsTempTotalHolder as $row) {
			if ($row['eq_run_war_st'] == $pickkey) {
				return $row['count'];
			}
		}
	}
}
