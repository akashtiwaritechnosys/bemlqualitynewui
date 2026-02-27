<?php
function updateConsignmentNoAndDate($entityData) {
    global $adb;
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $salesOrderId = $recordInfo['sale_order_id'];
    $salesOrderId = explode('x', $salesOrderId);
    $salesOrderId = $salesOrderId[1];
    // 7000202380

    include_once('include/utils/IgClassUtils.php');
    $dataArr = IgClassUtils::getSingleColumnValue(array(
        'table' => 'vtiger_salesorder',
        'columnId' => 'salesorderid',
        'idValue' => $salesOrderId,
        'expectedColValue' => 'external_app_num'
    ));
    $salesOrderDocumentNumber = $dataArr[0]['external_app_num'];
    if (!empty($salesOrderDocumentNumber)) {
        $query = "UPDATE vtiger_returnsaleorders SET ext_app_num_rso = ? WHERE returnsaleordersid = ?";
        $adb->pquery($query, array($salesOrderDocumentNumber, $id));
    }

    $query = 'SELECT sto_no,productname,lineitem_id FROM `vtiger_inventoryproductrel` where id = ?';
    $result = $adb->pquery($query, array($id));
    while ($row = $adb->fetch_array($result)) {
        $responseObject = IgClassUtils::getConginmentNoAndDateRSO($row['sto_no']);
        foreach ($responseObject['data'] as $consignmentInformation) {
            if (trim($consignmentInformation['MATNR']) == $row['productname']) {
                $updateQuery = 'update vtiger_inventoryproductrel 
                set goods_consignment_no = ?, goods_rcived_dte = ? 
                where lineitem_id = ?';
                $sapFormat = $consignmentInformation['DATEN'];
                if ($sapFormat == '00000000') {
                    $consignmentDate = NULL;
                } else {
                    $y = substr($sapFormat, 0, 4);
                    $m = substr($sapFormat, 4, 2);
                    $d = substr($sapFormat, 6, 2);
                    $consignmentDate = $y . '-' . $m . '-' . $d;
                }
                $adb->pquery($updateQuery, array($consignmentInformation['EXTI1'], $consignmentDate, $row['lineitem_id']));
            }
        }
    }
}
