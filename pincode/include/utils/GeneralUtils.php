<?php

function getAllEquipmentsAssociatedWithContact($recordId, $searchKey) {
	global $adb;
	$functionalLocations = getAllAssociatedFunctionalLocations($recordId);
	if (empty($functionalLocations)) {
		return [];
	}
	$sql = 'select equipmentid,equipment_sl_no  from vtiger_equipment'
		. ' INNER JOIN vtiger_crmentity '
		. ' ON vtiger_crmentity.crmid = vtiger_equipment.equipmentid '
		. ' where vtiger_equipment.functional_loc IN ("' . implode('","', $functionalLocations) . '")'
		. ' AND equipment_sl_no  LIKE ? AND vtiger_crmentity.deleted = 0';
	$result = $adb->pquery($sql, array("%$searchKey%"));
	$recordIds = [];
	while ($row = $adb->fetch_array($result)) {
		array_push($recordIds, array('label' => $row['equipment_sl_no'], 'id' => '38x' . $row['equipmentid']));
	}
	return $recordIds;
}


function getAllAssociatedFunctionalLocations($recordId) {
	$recordId = explode('x', $recordId);
	$recordId = $recordId[1];
	$data = getRoleIdOfcustomer($recordId);
	$roles = $data[0];
	$accountId = $data[1];
	$belowRoleContactIds = getAllBelowRoleContacts($accountId,$roles);
	array_push($belowRoleContactIds,$recordId);
	global $adb;
	$sql = "SELECT `vtiger_crmentityrel`.relcrmid FROM `vtiger_crmentityrel` " .
		" inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_crmentityrel.relcrmid " .
		" where `vtiger_crmentityrel`.crmid  in (" . generateQuestionMarks($belowRoleContactIds) . ") and relmodule =  'FunctionalLocations'  and vtiger_crmentity.deleted = 0";
	$result = $adb->pquery($sql, $belowRoleContactIds);
	$recordIds = [];
	while ($row = $adb->fetch_array($result)) {
		array_push($recordIds, $row['relcrmid']);
	}
	return $recordIds;
}

function getAllBelowRoleContacts($recordId, $roles) {
	if (empty($roles)) {
		return [];
	}
	global $adb;
	$sql = "SELECT `vtiger_contactdetails`.contactid FROM `vtiger_contactdetails` " .
		" inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_contactdetails.contactid " .
		" where con_role in (" . generateQuestionMarks($roles) . ") and accountid =  ?  and vtiger_crmentity.deleted = 0";
	$params = $roles;
	$params[] = $recordId;
	$result = $adb->pquery($sql, $params);
	$recordIds = [];
	while ($row = $adb->fetch_array($result)) {
		array_push($recordIds, $row['contactid']);
	}
	return $recordIds;
}

function getRoleIdOfcustomer($recordId) {
	// Todo On Confirmation
	global $adb;
	$sql = "select con_role,accountid from vtiger_contactdetails where contactid = ?";
	$result = $adb->pquery($sql, array($recordId));
	$roleName = '';
	$accountId = '';
	while ($row = $adb->fetch_array($result)) {
		$roleName =  $row['con_role'];
		$accountId =  $row['accountid'];
	}
	$sql = "SELECT parentrole FROM `vtiger_role` where rolename = ?";
	$result = $adb->pquery($sql, array($roleName));
	$parentRoleString = '';
	while ($row = $adb->fetch_array($result)) {
		$parentRoleString =  $row['parentrole'];
	}

	$sql = "SELECT rolename FROM `vtiger_role` where parentrole like ?";
	$result = $adb->pquery($sql, array("$parentRoleString::%"));
	$roles = [];
	while ($row = $adb->fetch_array($result)) {
		array_push($roles, $row['rolename']);
	}
	return array($roles,$accountId);
}
