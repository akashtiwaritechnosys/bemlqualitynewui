<?php

class Leads_CustomReportsStatusOfContractEquipment_View extends Vtiger_Index_View {

	function __construct() {
		parent::__construct();
	}

	public function requiresPermission(Vtiger_Request $request) {
		return true;
	}

	function process(Vtiger_Request $request) {
		echo $this->showModuleDetailView($request);
	}

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('REPORT_LABEL', 'STATUS OF CONTRACT EQUIPMENT');
		global $adb;
		$sql = "SELECT equip_model,org_code,count(equip_model) as 'eq_run_war_st_count'
				FROM `vtiger_equipment`
				INNER JOIN vtiger_account ON vtiger_account.accountid = vtiger_equipment.account_id
				where eq_run_war_st = 'Contract' and equip_category= 'S' group by equip_model,org_code";

		$result = $adb->pquery($sql, array());
		$records = [];
		$totalCommisioned = 0;
		$totalOnRoadFinal = 0;
		$totalOffRoadFinal = 0;
		$truckFinal = 0;
		$hpFinal = 0;
		$vendorsFinal = 0;
		$emFinal = 0;
		$custFinal = 0;
		$engineFinal =0;
		while ($row = $adb->fetch_array($result)) {
			$arrayKey = $row['equip_model'];
			$totalOffRoad = $this->getTotalOffroadEquipments($arrayKey, $row['org_code']);
			$totalOnRoad = (int) $row['eq_run_war_st_count'] - (int) $totalOffRoad[0];
			$totalCommisioned = $totalCommisioned + (int) $row['eq_run_war_st_count'];
			$totalOnRoadFinal = $totalOnRoadFinal + $totalOnRoad;
			$totalOffRoadFinal = $totalOffRoadFinal + (int) $totalOffRoad[0];

			$engineFinal = $engineFinal +  $totalOffRoad[1];
			$truckFinal = $truckFinal +  $totalOffRoad[2];
			$hpFinal = $hpFinal +  $totalOffRoad[3];
			$emFinal = $emFinal +  $totalOffRoad[4];
			$vendorsFinal = $vendorsFinal +  $totalOffRoad[5];
			$custFinal = $custFinal +  $totalOffRoad[6];
			if (array_key_exists($arrayKey, $records)) {
				$pushArray = $records[$arrayKey];
				array_push($pushArray, array($row['org_code'], $row['eq_run_war_st_count'], $totalOnRoad, $totalOffRoad[0], $totalOffRoad[1], $totalOffRoad[2], $totalOffRoad[3], $totalOffRoad[4], $totalOffRoad[5],$totalOffRoad[6]));
				$records[$arrayKey] = $pushArray;
			} else {
				$records[$arrayKey] = array(array($row['org_code'], $row['eq_run_war_st_count'], $totalOnRoad, $totalOffRoad[0], $totalOffRoad[1], $totalOffRoad[2], $totalOffRoad[3], $totalOffRoad[4], $totalOffRoad[5],$totalOffRoad[6]));
			}
		}
		$records['Total'] = array(array(
			'', $totalCommisioned, $totalOnRoadFinal, $totalOffRoadFinal,$engineFinal,
			$truckFinal, $hpFinal, $emFinal, $vendorsFinal, $custFinal
		));
		$viewer->assign('ResultArray', $records);
		return $viewer->view('Itech.tpl', $moduleName, true);
	}

	function getTotalOffroadEquipments($model, $orgCode) {
		global $adb;
		$sql = "SELECT count(vtiger_servicereportscf.off_on_account_of_sys) as 'count' , vtiger_servicereportscf.off_on_account_of_sys,vtiger_servicereports.servicereportsid 
				FROM vtiger_servicereports  
				INNER JOIN vtiger_crmentity 
				ON vtiger_servicereports.servicereportsid = vtiger_crmentity.crmid 
				INNER JOIN vtiger_servicereportscf 
				ON vtiger_servicereportscf.servicereportsid = vtiger_servicereports.servicereportsid 
				INNER JOIN vtiger_equipment
				ON vtiger_equipment.equipmentid = vtiger_servicereports.equipment_id
				INNER JOIN vtiger_recommissioningreportscf
				ON vtiger_recommissioningreportscf.servicereportsid = vtiger_servicereports.servicereportsid 
				LEFT JOIN vtiger_account AS vtiger_accountaccount_id  
				ON vtiger_accountaccount_id.accountid = vtiger_servicereports.account_id 
				WHERE vtiger_crmentity.deleted=0 AND   
				(( vtiger_servicereports.sr_ticket_type = 'BREAKDOWN')  
				and ( vtiger_servicereports.eq_sr_equip_model = ?)  
				and ( vtiger_servicereportscf.eq_sta_aft_act_taken = 'Off Road')  
				and ( vtiger_accountaccount_id.org_code = ?)
				and vtiger_equipment.eq_run_war_st = ?
				and vtiger_recommissioningreportscf.eq_sta_aft_act_taken = 'Off Road')
				AND vtiger_servicereports.servicereportsid > 0
				GROUP by vtiger_servicereportscf.off_on_account_of_sys";

		$sqlResult = $adb->pquery($sql, array($model, $orgCode, 'Contract'));
		$num_rows = $adb->num_rows($sqlResult);
		if ($num_rows > 0) {
			$totalFailed = 0;
			$customerFailed = 0;
			$vendorFailed = 0;
			$emCount = 0;
			$truckCount = 0;
			$engineCount = 0;
			$hpCount = 0;
			while ($row = $adb->fetch_array($sqlResult)) {
				$totalFailed = $totalFailed + (int)$row['count'];
				if ($row['off_on_account_of_sys'] == 'CUSTOMER') {
					$customerFailed = (int)$row['count'];
				} else if ($row['off_on_account_of_sys'] == 'VENDOR') {
					$vendorFailed = (int)$row['count'];
				} else if ($row['off_on_account_of_sys'] == 'EM') {
					$emCount = (int)$row['count'];
				} else if (decode_html($row['off_on_account_of_sys']) == 'H&P') {
					$hpCount = (int)$row['count'];
				} else if ($row['off_on_account_of_sys'] == 'Truck') {
					$truckCount = (int)$row['count'];
				} else if ($row['off_on_account_of_sys'] == 'Engine') {
					$engineCount = (int)$row['count'];
				}
			}
			return array((int) $totalFailed,$engineCount, $truckCount, $hpCount, $emCount, $vendorFailed, $customerFailed);
		} else {
			return array(0,0, 0, 0, 0, 0, 0);
		}
	}
}
