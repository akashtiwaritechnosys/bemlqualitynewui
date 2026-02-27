<?php
class HelpDesk_DuplicateCheckForEquipment_Action extends Vtiger_IndexAjax_View {

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$equipmentId = $request->get('equipment_id');
		$ticketType = $request->get('ticket_type');
		global $adb;
		if ($ticketType == 'BREAKDOWN') {
			if (empty($equipmentId)) {
				$response->setResult(true);
			} else {
				$sql = 'SELECT equip_status FROM `vtiger_troubletickets`
				inner join vtiger_crmentity 
				on vtiger_crmentity.crmid = vtiger_troubletickets.ticketid
				where equipment_id = ? 
				and ticket_type = ? and vtiger_troubletickets.status != "Closed"
				and vtiger_troubletickets.status != "Closed : Recommissioning Is Pending"
				and vtiger_crmentity.deleted = 0';
				$sqlResult = $adb->pquery($sql, array($equipmentId, $ticketType));
				$num_rows = $adb->num_rows($sqlResult);
				$foundduplicate = false;
				while ($row = $adb->fetch_array($sqlResult)) {
					if ($row['equip_status'] == 'Off Road') {
						$foundduplicate = true;
					}
				}
				if ($foundduplicate == true) {
					$response->setError('Already Off Road Service Request Pending you cannot create another Request');
				} else {
					$response->setResult(true);
				}
			}
		} else if ($ticketType == 'PRE-DELIVERY' || $ticketType == 'ERECTION AND COMMISSIONING') {
			$equipmentId = $request->get('equip_id_da');
			if (empty($equipmentId)) {
				$response->setResult(true);
			} else {
				$sql = 'SELECT equip_status FROM `vtiger_troubletickets`
					inner join vtiger_crmentity 
					on vtiger_crmentity.crmid = vtiger_troubletickets.ticketid
					where equip_id_da = ? 
					and ticket_type = ? and vtiger_troubletickets.status != "Closed"
					and vtiger_troubletickets.status != "Closed : Recommissioning Is Pending"
					and vtiger_crmentity.deleted = 0';
				$sqlResult = $adb->pquery($sql, array($equipmentId, $ticketType));
				$num_rows = $adb->num_rows($sqlResult);
				if ($num_rows > 0) {
					$response->setError('Already service request pending for same equipment');
				} else {
					$response->setResult(true);
				}
			}
		} else {
			if (empty($equipmentId)) {
				$response->setResult(true);
			} else {
				$sql = 'SELECT 1 FROM `vtiger_troubletickets`
					inner join vtiger_crmentity 
					on vtiger_crmentity.crmid = vtiger_troubletickets.ticketid
					where equipment_id = ? 
					and ticket_type = ? and vtiger_troubletickets.status != "Closed"
					and vtiger_troubletickets.status != "Closed : Recommissioning Is Pending"
					and vtiger_crmentity.deleted = 0';
				$sqlResult = $adb->pquery($sql, array($equipmentId, $ticketType));
				$num_rows = $adb->num_rows($sqlResult);
				if ($num_rows > 0) {
					$response->setError('Already service request pending for same equipment');
				} else {
					$response->setResult(true);
				}
			}
		}
		$response->emit();
	}
}
