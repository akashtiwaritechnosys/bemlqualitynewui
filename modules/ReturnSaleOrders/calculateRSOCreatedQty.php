<?php
function calculateRSOCreatedQty($entityData) {
    global $adb;
    $data = $entityData->{'data'};

    $parentLineItemId = $data['parent_line_itemid'];
    include_once('include/utils/GeneralConfigUtils.php');
    $recordIds = getAllRSOWithParentId($parentLineItemId);

    $sql = "SELECT sum(sto_qty) as totalqty FROM `vtiger_inventoryproductrel` where id in (" .
        generateQuestionMarks($recordIds) .
        ")";

    $result = $adb->pquery($sql, $recordIds);
    $qty = 0;
    while ($row = $adb->fetch_array($result)) {
        $qty = $row['totalqty'];
    }

    if (!empty($qty)) {
        $query = "UPDATE vtiger_inventoryproductrel SET rso_created_qty=? WHERE lineitem_id=?";
        $adb->pquery($query, array($qty, $parentLineItemId));
    }

    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $saleOrderId = $recordInfo['sale_order_id'];
    $saleOrderId = explode('x', $saleOrderId);
    $saleOrderId = $saleOrderId[1];

    if (!empty($saleOrderId)) {
        $recordInstance = Vtiger_Record_Model::getInstanceById($saleOrderId);
        $equipment_id = $recordInstance->get('equipment_id');
        $project_name = $recordInstance->get('project_name');
        $salesOrderNo = $recordInstance->get('external_app_num');
        $ticketId = $recordInstance->get('ticket_id');
        $noti = $recordInstance->get('po_no');

        $query = "UPDATE vtiger_returnsaleorders SET equipment_id=? ,
            project_name=? , ext_app_num_noti= ?, ticket_id = ?, ext_app_num_rso = ?
            WHERE returnsaleordersid = ?";
        $adb->pquery($query, array($equipment_id, $project_name, $noti, $ticketId, $salesOrderNo, $id));
    }
}
