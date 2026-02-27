<?php
include_once('include/utils/GeneralConfigUtils.php');
function EquipmentAvailabilityCalculateOnEdit($entityData) {
	$recordInfo = $entityData->{'data'};
	$id = $recordInfo['id'];
	$id = explode('x', $id);
	$id = $id[1];
	$db = PearDatabase::getInstance();

	$commitedAvailability = $recordInfo['eq_commited_avl'];
	if ($recordInfo['eq_available'] == 'Applicable') {
		if ($commitedAvailability == 'Different availability applicable during contract period') {
			$runningYearOfContract = $recordInfo['run_year_cont'];
			$query = "SELECT equipmentid,eq_run_war_st,shift_hours,run_year_cont,daadcp_avail_mon_percent,
					shift_hours,maint_h_app_for_ac, eq_mon_available
				FROM vtiger_equipment 
				INNER JOIN vtiger_crmentity 
				on vtiger_crmentity.crmid = vtiger_equipment.equipmentid 
				INNER JOIN vtiger_inventoryproductrel_equipment 
				on vtiger_inventoryproductrel_equipment.id = vtiger_equipment.equipmentid  
				where equipmentid = ? and daadcp_avail_sl_no = ? and eq_run_war_st IN('Contract', 'Under Warranty') 
				and eq_available = 'Applicable' and vtiger_crmentity.deleted = 0";
			$result = $db->pquery($query, array($id, $runningYearOfContract));
			while ($row = $db->fetchByAssoc($result)) {
				CheckAndCreateAvailability($row["equipmentid"],  $row);
			}
		} else if ($commitedAvailability == 'Availability For Warranty Period') {
			$query = "SELECT vtiger_equipment.equipmentid,eq_run_war_st,awp_commited_avl_y,
					awp_commited_avl_m,
					shift_hours,run_year_cont,daadcp_avail_mon_percent,
					shift_hours,maint_h_app_for_ac, eq_mon_available,
					cust_begin_guar,start_day_of_avail_calc,cust_war_end
					FROM vtiger_equipment 
					INNER JOIN vtiger_crmentity 
					on vtiger_crmentity.crmid = vtiger_equipment.equipmentid 
					INNER JOIN vtiger_equipmentcf 
					on vtiger_equipmentcf.equipmentid = vtiger_equipment.equipmentid
					INNER JOIN vtiger_inventoryproductrel_equipment 
					on vtiger_inventoryproductrel_equipment.id = vtiger_equipment.equipmentid  
					where vtiger_equipment.equipmentid = ? and eq_run_war_st IN('Contract', 'Under Warranty','Outside Warranty') 
					and eq_available = 'Applicable' and vtiger_crmentity.deleted = 0";
			$result = $db->pquery($query, array($id));
			while ($row = $db->fetchByAssoc($result)) {
				$start_date = date_create($row['cust_begin_guar']);
				$end_date = date_create($row['cust_war_end']);
				$interval = new DateInterval('P1D');
				$date_range = new DatePeriod($start_date, $interval, $end_date);
				foreach ($date_range as $currentDateSpecial) {
					$row['commited_avl_y'] = $row['awp_commited_avl_y'];
					$row['commited_avl_m_w'] = $row['awp_commited_avl_m'];
					CheckAndCreateAvailability1($row["equipmentid"],  $row, $currentDateSpecial);
				}
			}
		} else if ($commitedAvailability == 'Availability for both Warranty & Contract Period are Same') {
			$query = "SELECT equipmentid,eq_run_war_st,afbwcpas_commited_avl_y,
					afbwcpas_commited_avl_m,
					shift_hours,run_year_cont,daadcp_avail_mon_percent,
					shift_hours,maint_h_app_for_ac, eq_mon_available,cont_start_date,cont_end_date
					FROM vtiger_equipment 
					INNER JOIN vtiger_crmentity 
					on vtiger_crmentity.crmid = vtiger_equipment.equipmentid 
					INNER JOIN vtiger_inventoryproductrel_equipment 
					on vtiger_inventoryproductrel_equipment.id = vtiger_equipment.equipmentid  
					where equipmentid = ? and eq_run_war_st IN('Contract', 'Under Warranty') 
					and eq_available = 'Applicable' and vtiger_crmentity.deleted = 0";
			$result = $db->pquery($query, array($id));
			while ($row = $db->fetchByAssoc($result)) {
				$start_date = date_create($row['cont_start_date']);
				$end_date = date_create($row['cont_end_date']);
				$interval = new DateInterval('P1D');
				$date_range = new DatePeriod($start_date, $interval, $end_date);
				foreach ($date_range as $currentDateSpecial) {
					$row['commited_avl_y'] = $row['afbwcpas_commited_avl_y'];
					$row['commited_avl_m_w'] = $row['afbwcpas_commited_avl_m'];
					CheckAndCreateAvailability1($row["equipmentid"],  $row, $currentDateSpecial);
				}
			}
		} else if ($commitedAvailability == 'Same availability applicable through out contract period') {
			$query = "SELECT equipmentid,eq_run_war_st,saatocp_commited_avl_y_w,
					saatocp_commited_avl_m_w,saatocp_commited_avl_y_c,saatocp_commited_avl_m_c,
					shift_hours,run_year_cont,daadcp_avail_mon_percent,
					shift_hours,maint_h_app_for_ac, eq_mon_available
					FROM vtiger_equipment 
					INNER JOIN vtiger_crmentity 
					on vtiger_crmentity.crmid = vtiger_equipment.equipmentid 
					INNER JOIN vtiger_inventoryproductrel_equipment 
					on vtiger_inventoryproductrel_equipment.id = vtiger_equipment.equipmentid  
					where equipmentid = ? and eq_run_war_st IN('Contract', 'Under Warranty') 
					and eq_available = 'Applicable' and vtiger_crmentity.deleted = 0";
			$result = $db->pquery($query, array($id));
			while ($row = $db->fetchByAssoc($result)) {
				$warrantyStatus = $row['eq_run_war_st'];
				if ($warrantyStatus == 'Under Warranty') {
					$row['commited_avl_y'] = $row['saatocp_commited_avl_y_w'];
					$row['commited_avl_m_w'] = $row['saatocp_commited_avl_m_w'];
				} else if ($warrantyStatus == 'Contract') {
					$row['commited_avl_y'] = $row['saatocp_commited_avl_y_c'];
					$row['commited_avl_m_w'] = $row['saatocp_commited_avl_m_c'];
				}
				CheckAndCreateAvailability($row["equipmentid"],  $row);
			}
		}
	}
}
function CheckAndCreateAvailability($id, $row) {
	$row['type_of_eq_availability'] = 'Year';
	calculateEquipmentAvailabilty($id, date("Y"), date("Y-m-d"), $row);
	if ($row['eq_mon_available'] == 'Applicable') {
		$row['type_of_eq_availability'] = 'Month';
		calculateEquipmentAvailabilty($id, date("Y-m"), date("Y-m-d"), $row);
	}
}

function CheckAndCreateAvailability1($id, $row, $crrentDate) {
	// $row['type_of_eq_availability'] = 'Year';
	// calculateEquipmentAvailabiltyNew($id, $crrentDate->format('Y'), $crrentDate->format('Y-m-d'), $row, $crrentDate);
	if ($row['eq_mon_available'] == 'Applicable') {
		$row['type_of_eq_availability'] = 'Month';
		calculateEquipmentAvailabiltyNew($id, $crrentDate->format('Y-m'), $crrentDate->format('Y-m-d'), $row, $crrentDate);
	}
}
