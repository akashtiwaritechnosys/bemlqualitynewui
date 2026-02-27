<?php

class Leads_LifeCycle_View extends Vtiger_Index_View {

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
		global $adb;
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();

		$dateRange = $request->get('dateRange');

		$fromDate = $request->get('fromDate');
		$toDate = $request->get('toDate');

		$ticketType = $request->get('ticketType');
		$equipmentModel = $request->get('equipmentModel');
		$equipmentModel = explode("#",$equipmentModel);
		$warrantyStatus = $request->get('warrantyStatus');

		//WHERE ticket_date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)
		//WHERE ticket_date BETWEEN ? AND ?";
		// $result = $adb->pquery($sql, array($fromDate, $toDate));
		//ticket_date
		/*
		SELECT count(a.ticketid) as no_of_tickets,SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets, a.sr_equip_model from vtiger_troubletickets as a WHERE a.ticket_type='BREAKDOWN' GROUP BY a.sr_equip_model;
		*/
		/*
		SELECT count(a.ticketid) as no_of_tickets,SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets, b.sr_war_status from vtiger_troubletickets as a JOIN vtiger_servicereports as b ON a.ticketid=b.ticket_id WHERE a.ticket_type='BREAKDOWN' GROUP BY b.sr_war_status;

		*/

		$conditions = [];
		$params = [];
		$typeCategory = '';

		if (!empty($dateRange)) {
			foreach ($dateRange as $range) {
				$conditions[] = "a.ticket_date >= DATE_SUB(CURDATE(), INTERVAL $range)";
			}
		}

		if (!empty($fromDate) && !empty($toDate)) {
			$conditions[] = "a.ticket_date BETWEEN ? AND ?";
			$params[] = $fromDate;
			$params[] = $toDate;
		}

		if (!empty($ticketType)) {
			$sql = "SELECT 
				COUNT(a.ticketid) AS no_of_tickets,
				SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,
				SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets,
				a.sr_equip_model
				FROM vtiger_troubletickets AS a
				WHERE a.ticket_type = ?";

			$params[] = $ticketType;

			if (!empty($conditions)) {
				$sql .= " AND (" . implode(' AND ', $conditions) . ")";
			}

			if (!empty($equipmentModel)) {
				$sql .= " AND sr_equip_model in(" . generateQuestionMarks($equipmentModel) . ") GROUP BY a.sr_equip_model";
				foreach ($equipmentModel as $eqmodel) {
					array_push($params, $eqmodel);
				}
			}
			/*$sqlResult = $adb->pquery($sql, $params);
			$num_rows = $adb->num_rows($sqlResult);

			$resultData = [];
			if ($num_rows > 0) {
				for ($i = 0; $i < $num_rows; $i++) {
					$row = $adb->fetchByAssoc($sqlResult, $i);
					$resultData[] = $row;
				}
			}*/

			$typeCategory = "TicketType";
		} elseif (!empty($equipmentModel)) {
			$sql = "SELECT 
					count(a.ticketid) as no_of_tickets,
					SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,
					SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets,
					a.sr_equip_model
					FROM vtiger_troubletickets AS a
					WHERE a.sr_equip_model in(". generateQuestionMarks($equipmentModel) .")";

			foreach ($equipmentModel as $eqmodel) {
				array_push($params, $eqmodel);
			}
			// $params[] = $equipmentModel;

			if (!empty($conditions)) {
				$sql .= " AND (" . implode(' AND ', $conditions) . ")";
			}

			$sql .= " GROUP BY a.sr_equip_model";

			/*$sqlResult2 = $adb->pquery($sql, $params);
			$num_rows = $adb->num_rows($sqlResult2);

			$resultData = [];
			if ($num_rows > 0) {
				for ($i = 0; $i < $num_rows; $i++) {
					$row = $adb->fetchByAssoc($sqlResult2, $i);
					$resultData[] = $row;
				}
			}*/
			$typeCategory = "EquipmentModel";
		} elseif (!empty($warrantyStatus)) {

			$sql = "SELECT 
					count(a.ticketid) as no_of_tickets,
					SUM(CASE WHEN a.status = 'Open' THEN 1 ELSE 0 END) AS open_tickets,
					SUM(CASE WHEN a.status = 'Closed' THEN 1 ELSE 0 END) AS closed_tickets,
					b.sr_war_status
					FROM vtiger_troubletickets AS a 
					JOIN vtiger_servicereports as b ON a.ticketid=b.ticket_id
					WHERE b.sr_war_status = ?";

			$params[] = $warrantyStatus;

			if (!empty($conditions)) {
				$sql .= " AND (" . implode(' AND ', $conditions) . ")";
			}

			$sql .= " GROUP BY b.sr_war_status";

			$typeCategory = "WarrantyStatus";
		}


		$sqlResult2 = $adb->pquery($sql, $params);
		$num_rows = $adb->num_rows($sqlResult2);

		$resultData = [];
		if ($num_rows > 0) {
			for ($i = 0; $i < $num_rows; $i++) {
				$row = $adb->fetchByAssoc($sqlResult2, $i);
				$resultData[] = $row;
			}
		}
		$viewer->assign('typeCategory', $typeCategory);
		$viewer->assign('resultData', $resultData);
		$viewer->assign('equipmentModel', $equipmentModel);
		$viewer->assign('ticketType', $ticketType);
		$viewer->assign('warrantyStatus', $warrantyStatus);
		echo $this->showModuleDetailView($request);
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
		$viewer->assign('REPORT_LABEL', 'Life Cycle');
		$ColumnColIg = '(plant_name ; (MaintenancePlant) region_code)';
		$rowColIg = 'equip_model';
		global $adb;


		$sql = "SELECT sr_ticket_typeid,sr_ticket_type FROM `vtiger_sr_ticket_type`";
		$sqlResult = $adb->pquery($sql, array());
		$num_rows = $adb->num_rows($sqlResult);
		$ticketTypRow = [];

		if ($num_rows > 0) {
			for ($i = 0; $i < $num_rows; $i++) {
				$row = $adb->fetchByAssoc($sqlResult, $i);
				if (!empty($row['sr_ticket_type'])) {
					$ticketTypRow[] = $row;
				}
			}
		}


		$sqlEquip = "SELECT sr_equip_modelid,sr_equip_model FROM `vtiger_sr_equip_model`";
		$sqlResult2 = $adb->pquery($sqlEquip, array());
		$num_rows = $adb->num_rows($sqlResult2);
		$eqipDataRow = [];

		if ($num_rows > 0) {
			for ($i = 0; $i < $num_rows; $i++) {
				$row = $adb->fetchByAssoc($sqlResult2, $i);
				if (!empty($row['sr_equip_model']) && $row['sr_equip_model'] !== '----') {
					$eqipDataRow[] = $row;
				}
			}
		}


		$sqlWar = "SELECT sr_war_statusid,sr_war_status FROM `vtiger_sr_war_status`";
		$sqlResult3 = $adb->pquery($sqlWar, array());
		$num_rows = $adb->num_rows($sqlResult3);
		$warDataRow = [];

		if ($num_rows > 0) {
			for ($i = 0; $i < $num_rows; $i++) {
				$row = $adb->fetchByAssoc($sqlResult3, $i);
				if (!empty($row['sr_war_status'])) {
					$warDataRow[] = $row;
				}
			}
		}


		$viewer->assign('ticketTypRow', $ticketTypRow);
		$viewer->assign('eqipDataRow', $eqipDataRow);
		$viewer->assign('warDataRow', $warDataRow);

		return $viewer->view('LifeCycle.tpl', $moduleName, true);
	}
}
