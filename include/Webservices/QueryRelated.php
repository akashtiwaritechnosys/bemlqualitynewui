<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

include_once 'include/Webservices/Query.php';
include_once 'include/Webservices/RelatedTypes.php';

function vtws_query_related($query, $id, $relatedLabel, $user, $filterClause = null) {
    global $log, $adb;

    $webserviceObject = VtigerWebserviceObject::fromId($adb, $id);
    $handlerPath  = $webserviceObject->getHandlerPath();
    $handlerClass = $webserviceObject->getHandlerClass();
    require_once $handlerPath;
    $handler = new $handlerClass($webserviceObject, $user, $adb, $log);
    $meta = $handler->getMeta();
    $entityName = $meta->getObjectEntityName($id);

    // Extract related module name from query.
    $relatedType = null;
    if (preg_match("/FROM\s+([^\s]+)/i", $query, $m)) {
        $relatedType = trim($m[1]);
    }

    // Check for presence of expected relation.
    $found = false;
    $relatedTypes = vtws_relatedtypes($entityName, $user);
    foreach ($relatedTypes['information'] as $label => $information) {
        if ($label == $relatedLabel && $information['name'] == $relatedType) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        throw new WebServiceException(WebServiceErrorCode::$UNKOWNENTITY, "Relation specified is incorrect");
    }

    vtws_preserveGlobal('currentModule', $entityName);

    // Fetch related record IDs - so we can further retrieve complete information using vtws_query 
    $relatedWebserviceObject = VtigerWebserviceObject::fromName($adb, $relatedType);
    $relatedHandlerPath  = $relatedWebserviceObject->getHandlerPath();
    $relatedHandlerClass = $relatedWebserviceObject->getHandlerClass();
    require_once $relatedHandlerPath;
    $relatedHandler = new $relatedHandlerClass($relatedWebserviceObject, $user, $adb, $log);
    $relatedIds = $handler->relatedIds($id, $relatedType, $relatedLabel, $relatedHandler);

    // Initialize return value
    $relatedRecords = array();

    // Rewrite query and extract related records if there at least one.

    if ($relatedLabel == 'Documents') {
        $relatedIds = array_merge($relatedIds, getTheCustomerviewableDocumentsAswell());
    }
    if (!empty($relatedIds)) {
        $relatedIdClause = "id IN ('" . implode("','", $relatedIds) . "')";
        if (stripos($query, 'WHERE') == false) {
            $query .= " WHERE " . $relatedIdClause;
        } else {
            $queryParts = explode('WHERE', $query);
            $query = $queryParts[0] . " WHERE " . $relatedIdClause;
            $query .= " AND " . $queryParts[1];
        }
        if (!empty($filterClause)) {
            $query .= " " . $filterClause;
        }
        $query .= ";";
        $relatedRecords = vtws_query($query, $user);
    }

    VTWS_PreserveGlobal::flush();
    return $relatedRecords;
}

function getTheCustomerviewableDocumentsAswell() {
    $sql = "select CONCAT('15x',notesid) as notesid from vtiger_notes
        inner join vtiger_crmentity on vtiger_crmentity.crmid = vtiger_notes.notesid
        where (show_to_customer_new = 'Both' || show_to_customer_new = 'Customer') and vtiger_crmentity.deleted= 0";
    global $adb;

    $result = $adb->pquery($sql, array());
    $recordIds = [];
    while ($row = $adb->fetch_array($result)) {
        array_push($recordIds, $row['notesid']);
    }
    return $recordIds;
}
