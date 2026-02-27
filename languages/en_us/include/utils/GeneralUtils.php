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
	$belowRoleContactIds = getAllBelowRoleContacts($accountId, $roles);
	array_push($belowRoleContactIds, $recordId);
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
	return array($roles, $accountId);
}
function getImageDetailsInUtils($recordId) {
	global $site_URL;
	$db = PearDatabase::getInstance();
	$imageDetails = array();
	if ($recordId) {
		$sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype FROM vtiger_attachments
			INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
			INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
			WHERE vtiger_crmentity.setype In ('HelpDesk Attachment' , 'HelpDesk Image')  AND vtiger_seattachmentsrel.crmid = ?";
		$result = $db->pquery($sql, array($recordId));
		$count = $db->num_rows($result);
		for ($i = 0; $i < $count; $i++) {
			$imageId = $db->query_result($result, $i, 'attachmentsid');
			$imageIdsList[] = $db->query_result($result, $i, 'attachmentsid');
			$imagePathList[] = $db->query_result($result, $i, 'path');
			$storedname[] = $db->query_result($result, $i, 'storedname');
			$imageName = $db->query_result($result, $i, 'name');
			$fieldName[] = $db->query_result($result, $i, 'subject');
			$url = \Vtiger_Functions::getFilePublicURL($imageId, $imageName);
			$imageOriginalNamesList[] = urlencode(decode_html($imageName));
			$imageNamesList[] = $imageName;
			$imageUrlsList[] = $url;
			$descriptionOffield[] = $db->query_result($result, $i, 'description');
		}
		if (is_array($imageOriginalNamesList)) {
			$countOfImages = count($imageOriginalNamesList);
			for ($j = 0; $j < $countOfImages; $j++) {
				$imageDetails[] = array(
					'id' => $imageIdsList[$j],
					'orgname' => $imageOriginalNamesList[$j],
					'path' => $imagePathList[$j] . $imageIdsList[$j],
					'location' => $imagePathList[$j] . $imageIdsList[$j] . '_' . $storedname[$j],
					'name' => $imageNamesList[$j],
					'url' => $imageUrlsList[$j],
					'field' => $imageUrlsList[$j],
					'fieldNameFromDB' => $fieldName[$j],
					'descriptionOffield' => $descriptionOffield[$j]
				);
			}
		}
	}
	return $imageDetails;
}

function getFieldsOfCategoryGeneralised($type, $purposeValue) {
	if ($type == 'GENERAL INSPECTION' || $type == 'SERVICE FOR SPARES PURCHASED') {
		$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('HelpDesk', 'purpose', 'ticketstatus');
		$type = $purposeValue;
	} else {
		$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('HelpDesk', 'ticket_type', 'ticketpriorities');
	}
	foreach ($fieldDependeny['valuemapping'] as $valueMapping) {
		if ($valueMapping['sourcevalue'] == $type) {
			return $valueMapping['targetvalues'];
		}
	}
}

function getImageDetailsInUtilsServiceReports($recordId) {
	global $site_URL;
	$db = PearDatabase::getInstance();
	$imageDetails = array();
	if ($recordId) {
		$sql = "SELECT vtiger_attachments.*, vtiger_crmentity.setype FROM vtiger_attachments
			INNER JOIN vtiger_seattachmentsrel ON vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid
			INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_attachments.attachmentsid
			WHERE vtiger_crmentity.setype In ('ServiceReports Attachment' , 'ServiceReports Image')  AND vtiger_seattachmentsrel.crmid = ?";
		$result = $db->pquery($sql, array($recordId));
		$count = $db->num_rows($result);
		for ($i = 0; $i < $count; $i++) {
			$imageId = $db->query_result($result, $i, 'attachmentsid');
			$imageIdsList[] = $db->query_result($result, $i, 'attachmentsid');
			$imagePathList[] = $db->query_result($result, $i, 'path');
			$storedname[] = $db->query_result($result, $i, 'storedname');
			$imageName = $db->query_result($result, $i, 'name');
			$fieldName[] = $db->query_result($result, $i, 'subject');
			$url = \Vtiger_Functions::getFilePublicURL($imageId, $imageName);
			$imageOriginalNamesList[] = urlencode(decode_html($imageName));
			$imageNamesList[] = $imageName;
			$imageUrlsList[] = $url;
			$descriptionOffield[] = $db->query_result($result, $i, 'description');
		}
		if (is_array($imageOriginalNamesList)) {
			$countOfImages = count($imageOriginalNamesList);
			for ($j = 0; $j < $countOfImages; $j++) {
				$imageDetails[] = array(
					'id' => $imageIdsList[$j],
					'orgname' => $imageOriginalNamesList[$j],
					'path' => $imagePathList[$j] . $imageIdsList[$j],
					'location' => $imagePathList[$j] . $imageIdsList[$j] . '_' . $storedname[$j],
					'name' => $imageNamesList[$j],
					'url' => $imageUrlsList[$j],
					'field' => $imageUrlsList[$j],
					'fieldNameFromDB' => $fieldName[$j],
					'descriptionOffield' => $descriptionOffield[$j]
				);
			}
		}
	}
	return $imageDetails;
}

function getFieldsOfCategoryGeneralisedServiceReport($type,$purposeValue) {
	if ($type == 'SERVICE FOR SPARES PURCHASED' ) {
		$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('ServiceReports', 'tck_det_purpose', 'type_of_conrt');
		$type = $purposeValue;
	} else {
		$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('ServiceReports', 'sr_ticket_type', 'sr_war_status');
	}
	foreach ($fieldDependeny['valuemapping'] as $valueMapping) {
		if ($valueMapping['sourcevalue'] == $type) {
			return $valueMapping['targetvalues'];
		}
	}
}

function getFieldsOfCategoryServiceReport($type, $purposeValue) {
	if ($type == 'SERVICE FOR SPARES PURCHASED') {
		$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('ServiceReports', 'tck_det_purpose', 'type_of_conrt');
		$type = $purposeValue;
	} else {
		$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('ServiceReports', 'sr_ticket_type', 'sr_war_status');
	}
	foreach ($fieldDependeny['valuemapping'] as $valueMapping) {
		if ($valueMapping['sourcevalue'] == $type) {
			return $valueMapping['targetvalues'];
		}
	}
}

function getBlockLableBasedOnType($type, $purposeValue) {
	$blockLabel = '';
	switch ($type) {
		case 'BREAKDOWN':
			$blockLabel = 'LBL_ITEM_DETAILS';
			break;
		case 'GENERAL INSPECTION':
			$blockLabel = 'Parts Recommendation';
			break;
		case 'PRE-DELIVERY':
			$blockLabel = 'PARTS REQUIREMENT';
			break;
		case 'ERECTION AND COMMISSIONING':
			$blockLabel = 'PARTS REQUIREMENT';
			break;
		case 'INSTALLATION OF  SUB ASSEMBLY FITMENT':
			$blockLabel = 'Shortages/Damages if any';
			break;
		case 'SERVICE FOR SPARES PURCHASED':
			$blockLabel = 'Parts Details';
			break;
		default:
			$blockLabel = 'Parts Recommendation';
			break;
	}
	return $blockLabel;
}
function getSAPBasedOnType($type, $purposeValue) {
	$SAPDefalutValue = '';
	switch ($type) {
		case 'GENERAL INSPECTION':
			$SAPDefalutValue = 'Z3';
			break;
		case 'PRE-DELIVERY':
			$SAPDefalutValue = 'ZB';
			break;
		case 'ERECTION AND COMMISSIONING':
			$SAPDefalutValue = 'ZE';
			break;
		case 'DESIGN MODIFICATION':
			$SAPDefalutValue = 'Z2';
			break;
		case 'PERIODICAL MAINTENANCE':
			$SAPDefalutValue = 'Z4';
			break;
		default:
			$SAPDefalutValue ='';
			break;
	}
	return $SAPDefalutValue;
}

function configuredLineItemFieldsWithOutDepend($moduleName) {
	global $adb;
	$tabId = getTabId($moduleName);
	$sql = "SELECT * FROM `vtiger_field` LEFT JOIN vtiger_blocks
         on vtiger_blocks.blockid = vtiger_field.block where vtiger_field.tabid = ? 
         and helpinfo = 'li_lg' and blocklabel = ? ORDER BY `vtiger_field`.`sequence` ASC;";
	$result = $adb->pquery($sql, array($tabId, 'LBL_ITEM_DETAILS'));
	$fields = [];
	$fieldNames = [];

	while ($row = $adb->fetch_array($result)) {
		if ($row['uitype'] == '16') {
			$row['picklistValues'] = getAllPickListValues($row['fieldname']);
		}
		array_push($fieldNames, $row['fieldname']);
		array_push($fields, $row);
	}
	return array('fieldNames' => $fieldNames, 'fields' => $fields);
}

function configuredLineItemFieldsWithOutDependBLock($moduleName,$blockName) {
	global $adb;
	$tabId = getTabId($moduleName);
	$sql = "SELECT * FROM `vtiger_field` LEFT JOIN vtiger_blocks
         on vtiger_blocks.blockid = vtiger_field.block where vtiger_field.tabid = ? 
         and helpinfo = 'li_lg' and blocklabel = ? ORDER BY `vtiger_field`.`sequence` ASC;";
	$result = $adb->pquery($sql, array($tabId, $blockName));
	$fields = [];
	$fieldNames = [];

	while ($row = $adb->fetch_array($result)) {
		if ($row['uitype'] == '16') {
			$row['picklistValues'] = getAllPickListValues($row['fieldname']);
		}
		array_push($fieldNames, $row['fieldname']);
		array_push($fields, $row);
	}
	return array('fieldNames' => $fieldNames, 'fields' => $fields);
}

function getExternalAppURL($endPointName) {
	global $adb;
	$sql = 'select * from vtiger_external_application_info where id = 1 ';
	$sqlResultSet = $adb->pquery($sql, array());
	$dataRow = $adb->fetchByAssoc($sqlResultSet, 0);
	$u = $dataRow['uname'];
	$p = $dataRow['pass'];
	$url = $dataRow['url'];
	$url = $url . $endPointName .'.php' . "?uta=" . $u . '&pws=' . $p;
	return $url;
}

function getAllEquipmentsAssociatedWithSE($recordId, $searchKey) {
	global $adb;
	$functionalLocations = getAllAssociatedFunctionalLocationsSE($recordId);
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

function getAllAssociatedFunctionalLocationsSE($recordId) {
	$recordId = explode('x', $recordId);
	$recordId = $recordId[1];
	$belowRoleContactIds = [];
	array_push($belowRoleContactIds, $recordId);
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

function getUserDetailsBasedOnEmployeeModuleG($badgeNo) {
	global $adb;
	$sql = 'select serviceengineerid,phone,cust_role from vtiger_serviceengineer '
		. ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_serviceengineer.serviceengineerid '
		. ' where vtiger_serviceengineer.badge_no = ? and vtiger_crmentity.deleted = 0';
	$sqlResult = $adb->pquery($sql, array($badgeNo));
	$num_rows = $adb->num_rows($sqlResult);
	if ($num_rows == 1) {
		$dataRow = $adb->fetchByAssoc($sqlResult, 0);
		return $dataRow;
	} else {
		return false;
	}
}

function getAggregateDetailsBasedOnCode($aggregateTypeCode, $equipmentSerialNum, $parentEquipmentId) {
	global $adb;
	$sql = "SELECT equipment_sl_no,equip_war_terms  FROM `vtiger_equipment` 
	INNER JOIN vtiger_equipmentcf on vtiger_equipmentcf.equipmentid = vtiger_equipment.equipmentid
	where  equipment_sl_no = ?";
	$sqlResult = $adb->pquery($sql, array($equipmentSerialNum.'-'.$aggregateTypeCode));
	$num_rows = $adb->num_rows($sqlResult);
	$dataRow = [];
	if ($num_rows > 0) {
		$dataRow = $adb->fetchByAssoc($sqlResult, 0);
	}
	return $dataRow;
}

function getAggregateDetails($aggregateType,$equipmentSerialNum, $parentEquipment) {
	global $adb;
	$sql = "SELECT equip_ag_serial_no FROM `vtiger_equipment` 
	INNER JOIN vtiger_equipmentcf on vtiger_equipmentcf.equipmentid = vtiger_equipment.equipmentid
	where equipment_sl_no = ? and agg_equipment_id = ?";
	$sqlResult = $adb->pquery($sql, array($equipmentSerialNum.'-'.$aggregateType, $parentEquipment));
	$num_rows = $adb->num_rows($sqlResult);
	$dataRow = [];
	if ($num_rows > 0) {
		$dataRow = $adb->fetchByAssoc($sqlResult, 0);
	}
	return $dataRow;
}

function IGisBadgeExits($badgeNo, $phone) {
	global $adb;
	$sql = 'select badge_no,phone from vtiger_serviceengineer 
	inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_serviceengineer.serviceengineerid
	where badge_no = ? or phone = ? and vtiger_crmentity.deleted = 0';
	$sqlResult = $adb->pquery($sql, array(trim($badgeNo), trim($phone)));
	$num_rows = $adb->num_rows($sqlResult);
	if ($num_rows > 0) {
		return $adb->fetchByAssoc($sqlResult, 0);
	} else {
		return '';
	}
}

function isInAllowedFunctionalLocation($recordId) {
	global $current_user;
	$data = getUserDetailsBasedOnEmployeeModuleG($current_user->user_name);
	$functionalLocations = getAllAssociatedFunctionalLocationsSE('36x' . $data['serviceengineerid']);
	if (empty($functionalLocations)) {
		return false;
	}
	global $adb;
	$sql = 'select equipmentid from vtiger_equipment'
		. ' INNER JOIN vtiger_crmentity '
		. ' ON vtiger_crmentity.crmid = vtiger_equipment.equipmentid '
		. ' where vtiger_equipment.functional_loc IN ("' . implode('","', $functionalLocations) . '")'
		. ' AND vtiger_equipment.equipmentid = ? and vtiger_crmentity.deleted = 0';
	$sqlResult = $adb->pquery($sql, array($recordId));
	$num_rows = $adb->num_rows($sqlResult);
	if ($num_rows > 0) {
		return true;
	} else {
		return false;
	}
}