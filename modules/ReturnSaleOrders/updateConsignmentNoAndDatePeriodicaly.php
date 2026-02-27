<?php
function updateConsignmentNoAndDatePeriodicaly($entityData) {
    global $adb;
    
    include_once('include/utils/IgClassUtils.php');
    $query = 'SELECT sto_no,productname,lineitem_id FROM `vtiger_inventoryproductrel` 
    where (sto_no is not NULL or sto_no != "") 
    and (goods_consignment_no is null or goods_consignment_no = "")';
    $result = $adb->pquery($query, array());
    while ($row = $adb->fetch_array($result)) {
        if (empty($row['sto_no'])) {
            continue;
        }
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
