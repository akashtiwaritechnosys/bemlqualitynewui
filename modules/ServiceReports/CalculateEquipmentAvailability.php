<?php
function CalculateEquipmentAvailability($entityData) {
    global $adb;
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $equipId = $recordInfo['equipment_id'];
    $equipId = explode('x', $equipId);
    $equipId = $equipId[1];

    $createdDate = $recordInfo['createdtime'];
    $createdDate = substr($createdDate, 0, 7);
    include_once('include/utils/GeneralConfigUtils.php');
    // calculateEquipmentAvailabilty($equipId, $createdDate, $recordInfo['createdtime']);

    $ticket_id = $recordInfo['ticket_id'];
    $ticket_id = explode('x', $ticket_id);
    $ticket_id = $ticket_id[1];

    $reportedUserId = '';
    $sql = 'SELECT source,smcreatorid FROM `vtiger_crmentity` where crmid = ? and source = "CUSTOMER PORTAL"';
    $result = $adb->pquery($sql, array($ticket_id));
    $dataRow = $adb->fetchByAssoc($result, 0);
    $num_rows = $adb->num_rows($result);
    if ($num_rows > 0) {
        $reportedUserId = createdContactUserId($ticket_id);
    } else {
        $reportedUserId = getEngineerInfo($dataRow['smcreatorid']);
    }

    if (!empty($reportedUserId)) {
        $query = "UPDATE vtiger_servicereports SET reported_by = ? WHERE servicereportsid=?";
        $adb->pquery($query, array($reportedUserId, $id));
    }

    $sql = 'select external_app_num,createdtime from vtiger_troubletickets ' .
        ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_troubletickets.ticketid ' .
        ' where ticketid = ?';
    $sqlResult = $adb->pquery($sql, array($ticket_id));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $ticketCreatedDateTime = '';
    if (empty($dataRow)) {
    } else {
        $exterAppNum = $dataRow['external_app_num'];
        $ticketCreatedDateTime =  $dataRow['createdtime'];
    }
    $ticketCreatedDateTimeArr = explode(' ', $ticketCreatedDateTime);
    $ticketCreatedTime = $ticketCreatedDateTimeArr[1];
    $time = strtotime($ticketCreatedTime);
    $startTime = date("H:i:s", strtotime('+5 hours 30 minutes', $time));
    updateTotalBreakDownHors($id, $startTime);
}

function createdContactUserId($ticket_id) {
    global $adb;
    $query = "SELECT contact_id FROM `vtiger_troubletickets`"
        . " where ticketid = ?";
    $result = $adb->pquery($query, array($ticket_id));
    $num_rows = $adb->num_rows($result);
    $dataRow = $adb->fetchByAssoc($result, 0);
    if ($num_rows > 0) {
        return $dataRow['contact_id'];
    } else {
        return '';
    }
}

function updateTotalBreakDownHors($recordId, $startTime) {
    global $adb;
    $upSql =  'UPDATE `vtiger_servicereports` SET `failure_time` =  ? 
    WHERE `vtiger_servicereports`.`servicereportsid` = ?';
    $adb->pquery($upSql, array($startTime, $recordId));

    $sql = "SELECT  sum(TIMEDIFF(CONCAT(restoration_date,' ',restoration_time),
        CONCAT(date_of_failure,' ', failure_time))) as 'totalbreakdown' from `vtiger_servicereports`
        INNER JOIN vtiger_servicereportscf 
        on vtiger_servicereportscf.servicereportsid = vtiger_servicereports.servicereportsid
        WHERE vtiger_servicereports.servicereportsid = ?";
    $sqlResult = $adb->pquery($sql, array($recordId));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $totalbreakdown = '';
    if (!empty($dataRow)) {
    	$totalbreakdown = $dataRow['totalbreakdown'] / 10000;
    }
    $upSql =  'UPDATE `vtiger_servicereportscf` SET `total_breakdown_hours` =  ? 
    WHERE `vtiger_servicereportscf`.`servicereportsid` = ?';
    $adb->pquery($upSql, array($totalbreakdown, $recordId));
}

function getEngineerInfo($recId) {
    $db = PearDatabase::getInstance();
    $sql = 'select user_name from vtiger_users where id = ?';
    $sqlResult = $db->pquery($sql, array($recId));
    $dataRow = $db->fetchByAssoc($sqlResult, 0);

    $sql = 'select serviceengineerid from vtiger_serviceengineer' .
        ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_serviceengineer.serviceengineerid' .
        ' where badge_no = ? and vtiger_crmentity.deleted= 0 ORDER BY serviceengineerid DESC LIMIT 1';
    $sqlResult = $db->pquery($sql, array($dataRow['user_name']));
    $dataRowEng = $db->fetchByAssoc($sqlResult, 0);
    return $dataRowEng['serviceengineerid'];
}
