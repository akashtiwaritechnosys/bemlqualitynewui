<?php
function copyAllLineItemAfterCreation($entityData) {
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $ticketId = $recordInfo['ticket_id'];
    $ticketId = explode('x', $ticketId);
    $ticketId = $ticketId[1];

    $resultObject = alreadyReportGeneratedW($ticketId);
    $repId = $resultObject['generatedSRData']['servicereportsid'];
    secondlineCopingFromServiceReportsW($repId, $id);
    thirdlineCopingFromServiceReportsW($repId, $id);
}

function alreadyReportGeneratedW($id) {
    global $adb;
    $sql = 'select servicereportsid,is_recommisionreport,is_submitted from vtiger_servicereports'
        . ' INNER JOIN vtiger_crmentity '
        . ' ON vtiger_crmentity.crmid = vtiger_servicereports.servicereportsid '
        . ' where vtiger_servicereports.ticket_id = ? and vtiger_crmentity.deleted = 0';
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

function secondlineCopingFromServiceReportsW($servicereportid, $recommisionId) {
    global $adb;
    $salesorder_id = $servicereportid;
    $query1 = "SELECT * FROM vtiger_inventoryproductrel_other WHERE id=?";
    $res = $adb->pquery($query1, array($salesorder_id));
    $no_of_products = $adb->num_rows($res);
    $fieldsList = $adb->getFieldsArray($res);
    for ($j = 0; $j < $no_of_products; $j++) {
        $row = $adb->query_result_rowdata($res, $j);
        $col_value = array();
        for ($k = 0; $k < count($fieldsList); $k++) {
            if ($fieldsList[$k] != 'lineitem_id') {
                $col_value[$fieldsList[$k]] = $row[$fieldsList[$k]];
            }
        }
        if (count($col_value) > 0) {
            $col_value['id'] = $recommisionId;
            $columns = array_keys($col_value);
            $values = array_values($col_value);
            $query2 = "INSERT INTO vtiger_inventoryproductrel_other(" . implode(",", $columns) . ") VALUES (" . generateQuestionMarks($values) . ")";
            $adb->pquery($query2, array($values));
        }
    }
}

function thirdlineCopingFromServiceReportsW($servicereportid, $recommisionId) {
    global $adb;
    $salesorder_id = $servicereportid;
    $query1 = "SELECT * FROM vtiger_inventoryproductrel_other_masn WHERE id=?";
    $res = $adb->pquery($query1, array($salesorder_id));
    $no_of_products = $adb->num_rows($res);
    $fieldsList = $adb->getFieldsArray($res);
    for ($j = 0; $j < $no_of_products; $j++) {
        $row = $adb->query_result_rowdata($res, $j);
        $col_value = array();
        for ($k = 0; $k < count($fieldsList); $k++) {
            if ($fieldsList[$k] != 'lineitem_id') {
                $col_value[$fieldsList[$k]] = $row[$fieldsList[$k]];
            }
        }
        if (count($col_value) > 0) {
            $col_value['id'] = $recommisionId;
            $columns = array_keys($col_value);
            $values = array_values($col_value);
            $query2 = "INSERT INTO vtiger_inventoryproductrel_other_masn(" . implode(",", $columns) . ") VALUES (" . generateQuestionMarks($values) . ")";
            $adb->pquery($query2, array($values));
        }
    }
}
