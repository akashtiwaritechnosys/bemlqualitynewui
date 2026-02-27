<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('include/utils/GeneralUtils.php');
include_once('include/utils/IgClassUtils.php');

function UpdateResponseTime($entityData) {
    global $adb;
    global $log;
    $recordInfo = $entityData->{'data'};

    $ticketId = $recordInfo['ticket_id'];
    $ticketId = explode('x', $ticketId);
    $ticketId = $ticketId[1];

    // no need to sync to sap of undefined notification types
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $sql = 'select external_app_num,createdtime from vtiger_troubletickets ' .
        ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_troubletickets.ticketid ' .
        ' where ticketid = ?';
    $sqlResult = $adb->pquery($sql, array($ticketId));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);

    // add a logic to calculate first response time.
    $timeinMinuts = getTimeDifferenceInMinutes($dataRow['createdtime'], date("Y-m-d H:i:s"));
    global $adb;
    $adb->pquery('UPDATE vtiger_troubletickets SET time_insec_to_resp = ? 
    WHERE ticketid=?', array(intval($timeinMinuts), $ticketId));
}
