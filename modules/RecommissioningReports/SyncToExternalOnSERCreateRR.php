<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include_once('include/utils/GeneralUtils.php');
include_once('include/utils/IgClassUtils.php');
function SyncToExternalOnSERCreateRR($entityData) {
    global $adb, $noTRiggerOFWorkFlowForRR;
    global $log;
    if ($noTRiggerOFWorkFlowForRR == true) {
        return;
    }
    $recordInfo = $entityData->{'data'};

    $vtquipment_id = $recordInfo['equipment_id'];
    $vtquipment_id = explode('x', $vtquipment_id);
    $vtquipment_id = $vtquipment_id[1];
    $eq_sta_aft_act_taken = $recordInfo['eq_sta_aft_act_taken'];
    $query = "UPDATE vtiger_equipment SET last_sr_status=? WHERE equipmentid=?";
    $adb->pquery($query, array($eq_sta_aft_act_taken, $vtquipment_id));

    $notiType = $recordInfo['fail_de_sap_noti_type'];
    $typeOFNoti = explode('--', $notiType);
    $notiType = $typeOFNoti[0];
    // no need to sync to sap of undefined notification types
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $ticketId = $recordInfo['ticket_id'];
    $ticketId = explode('x', $ticketId);
    $ticketId = $ticketId[1];

    if ($notiType == '--') {
        $isSubmitted = $recordInfo['is_submitted'];
        if ($isSubmitted == '1') {
            global $donotUpdateToInprogrss;
            $donotUpdateToInprogrss = true;
            $query = "UPDATE vtiger_troubletickets SET status = ?,ticket_close_date=? WHERE ticketid=?";
            $adb->pquery($query, array('Closed after Re-commissioning', date('Y-m-d'),$ticketId));
        }
        include_once('include/utils/IgClassUtils.php');
        $failedPartCanBeCreated = IgClassUtils::FailedPartCanBeCreated($id);
        if ($failedPartCanBeCreated == true) {
            $sql = 'select ticket_id from vtiger_failedparts ' .
                ' inner join vtiger_crmentity
                  on vtiger_crmentity.crmid = vtiger_failedparts.failedpartid ' .
                ' where ticket_id = ? and vtiger_crmentity.deleted = 0 ';
            $sqlResult = $adb->pquery($sql, array($ticketId));
            $num_rows = $adb->num_rows($sqlResult);
            if ($num_rows == 0) {
                IgClassUtils::createFailedPartsRecords($id, $ticketId, $exterAppNum);
            }
        }
        return;
    }

    $sql = 'select external_app_num,createdtime from vtiger_troubletickets ' .
        ' inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_troubletickets.ticketid ' .
        ' where ticketid = ?';
    $sqlResult = $adb->pquery($sql, array($ticketId));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $ticketCreatedDateTime = '';
    if (empty($dataRow)) {
    } else {
        $exterAppNum = $dataRow['external_app_num'];
        $ticketCreatedDateTime =  $dataRow['createdtime'];
    }
    if (!empty($exterAppNum)) {
        $isSubmitted = $recordInfo['is_submitted'];
        // IgClassUtils::handleUpdatedOfNotification(
        //     $recordInfo,
        //     $ticketCreatedDateTime,
        //     $notiType,
        //     $id,
        //     $exterAppNum,
        //     'RecommissioningReports'
        // );
        if ($isSubmitted == '1') {
            $responseObject = changeNotifiationStatusWithRR('Closed', $exterAppNum, $ticketId);
            if ($responseObject['success'] == true) {
                $query = "UPDATE vtiger_troubletickets SET status = ?,ticket_close_date=? WHERE ticketid=?";
                $adb->pquery($query, array('Closed after Re-commissioning', date('Y-m-d'),$ticketId));

                $query = "UPDATE vtiger_recommissioningreports SET report_status = ? WHERE recommissioningreportsid=?";
                $adb->pquery($query, array('Submitted', $id));

                $resultObject = RRIGalreadyReportGenerated($ticketId);
                $alreadyReportGenerated = $resultObject['alreadySRGenerated'];
                if ($alreadyReportGenerated == true) {
                    $repId = $resultObject['generatedSRData']['servicereportsid'];
                    $query = "UPDATE vtiger_servicereports SET is_recc_submitted = ? WHERE servicereportsid = ?";
                    $adb->pquery($query, array('1', $repId));
                }
            } else {
                $query = "UPDATE vtiger_recommissioningreports SET is_submitted = ? WHERE recommissioningreportsid=?";
                $adb->pquery($query, array('0', $id));
                global $actionFromMobileApis;
                if ($actionFromMobileApis) {
                    global $hasSAPErrors, $ErrorMessage, $SAPDetailError;
                    $hasSAPErrors = true;
                    $ErrorMessage = "Changing Notificatin Status Failed";
                    $SAPDetailError = $responseObject['message'];
                } else {
                    if (trim($responseObject['message']) == 'Notification already is in Completed status') {
                        $query = "UPDATE vtiger_troubletickets SET status = ?,ticket_close_date=? WHERE ticketid=?";
                        $adb->pquery($query, array('Closed after Re-commissioning',date('Y-m-d'), $ticketId));
                        $query = "UPDATE vtiger_recommissioningreports SET report_status = ? WHERE recommissioningreportsid=?";
                        $adb->pquery($query, array('Submitted', $id));
                        $resultObject = RRIGalreadyReportGenerated($ticketId);
                        $alreadyReportGenerated = $resultObject['alreadySRGenerated'];
                        if ($alreadyReportGenerated == true) {
                            $repId = $resultObject['generatedSRData']['servicereportsid'];
                            $query = "UPDATE vtiger_servicereports SET is_recc_submitted = ? WHERE servicereportsid = ?";
                            $adb->pquery($query, array('1', $repId));
                        }
                    } else {
                        $_SESSION["errorFromExternalApp"] = $responseObject['message'];
                        $_SESSION["lastSyncedExterAppRecord"] = $id;
                        header("Location: index.php?module=RecommissioningReports&view=Edit&record=$id&app=SUPPORT");
                        exit();
                    }
                }
            }
        } else {
            $_SESSION["errorFromExternalApp"] = NULL;
            $_SESSION["lastSyncedExterAppRecord"] = NULL;
        }

        if ($isSubmitted == '1') {
            include_once('include/utils/IgClassUtils.php');
            $failedPartCanBeCreated = IgClassUtils::FailedPartCanBeCreated($id);
            if ($failedPartCanBeCreated == true) {
                $sql = 'select ticket_id from vtiger_failedparts ' .
                    ' inner join vtiger_crmentity 
                  on vtiger_crmentity.crmid = vtiger_failedparts.failedpartid ' .
                    ' where ticket_id = ? and vtiger_crmentity.deleted = 0 ';
                $sqlResult = $adb->pquery($sql, array($ticketId));
                $num_rows = $adb->num_rows($sqlResult);
                if ($num_rows == 0) {
                    IgClassUtils::createFailedPartsRecords($id, $ticketId, $exterAppNum);
                }
            }
        }
        return;
    }
}
function RRIGalreadyReportGenerated($id) {
    global $adb;
    $sql = 'select servicereportsid,is_recommisionreport,is_submitted from vtiger_servicereports'
        . ' INNER JOIN vtiger_crmentity '
        . ' ON vtiger_crmentity.crmid = vtiger_servicereports.servicereportsid '
        . ' where vtiger_servicereports.ticket_id = ? and vtiger_crmentity.deleted = 0 limit 1';
    $sqlResult = $adb->pquery($sql, array($id));
    $num_rows = $adb->num_rows($sqlResult);
    $resultObject = [];
    if ($num_rows > 0) {
        $resultObject['alreadySRGenerated'] = true;
        $resultObject['generatedSRData'] = $adb->fetchByAssoc($sqlResult, 0);
    } else {
        $resultObject['alreadySRGenerated'] = false;
    }
    return $resultObject;
}
