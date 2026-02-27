<?php

include_once 'config.php';
include_once 'include/Webservices/Relation.php';

include_once 'vtlib/Vtiger/Module.php';
include_once 'includes/main/WebUI.php';

global $current_user, $adb;
$current_user = Users::getActiveAdminUser();
require_once('modules/HelpDesk/HelpDesk.php');

global $noCreationOfInventorItems;
$noCreationOfInventorItems = true;

$sql = "SELECT 1 FROM `vtiger_troubletickets` 
INNER JOIN vtiger_crmentity 
ON vtiger_crmentity.crmid = vtiger_troubletickets.ticketid 
where title = ? and vtiger_crmentity.deleted = 0";
$result = $adb->pquery($sql, array(trim($_REQUEST['message'])));
$num_rows = $adb->num_rows($result);
if ($num_rows == 0) {
	$focus = new HelpDesk();
	$focus->id = '';
	$focus->mode = '';

	$consql = "SELECT contactid FROM `vtiger_contactdetails` 
	INNER JOIN vtiger_crmentity 
	ON vtiger_crmentity.crmid = vtiger_contactdetails.contactid 
	where email = ? and vtiger_crmentity.deleted = 0";
	
	$Conresult = $adb->pquery($consql, array($_REQUEST['email']));
	$connum_rows = $adb->num_rows($Conresult);
	$dataRow = $adb->fetchByAssoc($Conresult, 0);
	$contactId = '';
	if($connum_rows > 0){
		$contactId = $dataRow['contactid'];
	}
	$focus->column_fields['description'] = $_REQUEST['message'];
	$focus->column_fields['contact_id'] = $contactId;
	$focus->column_fields['ticketstatus'] = 'Open';
	$focus->column_fields['ticket_type'] = 'BREAKDOWN';
	$focus->save("HelpDesk");
	echo 'success';
}
