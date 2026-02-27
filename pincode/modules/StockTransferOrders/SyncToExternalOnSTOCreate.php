<?php
function SyncToExternalOnSTOCreate($entityData) {
    global $adb;
    global $log;
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $plant = $recordInfo['plant_name'];
    $plant = explode('x', $plant);
    $plant = $plant[1];

    $sql = "select plant_code from vtiger_maintenanceplant where maintenanceplantid = ? ";
    $result = $adb->pquery($sql, array($plant));
    $plantcode = '';
    $dataRow = $adb->fetchByAssoc($result, 0);
    if (empty($dataRow['plant_code'])) {
        $plantcode = '';
    } else {
        $plantcode = $dataRow['plant_code'];
    }

    //Reciving Plant Implementation
    $recplant = $recordInfo['rec_plant_name'];
    $recplant = explode('x', $recplant);
    $recplant = $recplant[1];

    $sql = "select plant_code from vtiger_maintenanceplant where maintenanceplantid = ? ";
    $result = $adb->pquery($sql, array($recplant));
    $recplantcode = '';
    $dataRow = $adb->fetchByAssoc($result, 0);
    if (empty($dataRow['plant_code'])) {
        $recplantcode = '';
    } else {
        $recplantcode = $dataRow['plant_code'];
    }

    $items = getProductsOfSTO($id,$recplantcode);
   
    $url = "http://10.80.2.84/phprfcbeml/sapclasses/examples/CreateSTO.php";
    $header = array('Content-Type:multipart/form-data');
    $data = array(
        'DOC_TYPE'  => 'ZWUB',
        'PURCH_ORG' => 'SP01',
        'PUR_GROUP'  => 'EME',
        'SUPPLY_PLANT' => $plantcode,
        'COLLECTIVE_NO' => $recordInfo['collective_no'],
        'YOUR_REF' => $recordInfo['your_ref'],
        'OUR_REF' => $recordInfo['our_ref'],
        'IT_ITEMS' => json_encode($items)
    );

    // print_r($data);
    // die();

    $log->debug("*****Data Sendig To SAP***********" . json_encode($data) . "********");
    $resource = curl_init();
    curl_setopt($resource, CURLOPT_URL, $url);
    curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
    curl_setopt($resource, CURLOPT_POST, 1);
    curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($resource, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($resource);
    $responseUnencode = $response;
    $log->debug("*****Response Recived From SAP***********$response********");
    $response = json_decode($response, true);
    curl_close($resource);

    $ticketId = $recordInfo['ticket_id'];
    $ticketId = explode('x', $ticketId);
    $ticketId = $ticketId[1];
    if (empty(trim($response['STO_NUMBER']))) {
        print_r("<h3> Creating STO In SAP Is Failed Because Of Following Error,Please Fix The Problems</h3></br>");
        print_r($responseUnencode);
        print_r("<br><h3><a href='index.php?module=StockTransferOrders&view=Edit&record=$id&app=INVENTORY'> Click Here </a></h3>");
        die();
    }

    $query = "UPDATE vtiger_stocktransferorders SET external_app_num=? WHERE stocktransferorderid=?";
    $adb->pquery($query, array($response['STO_NUMBER'], $id));
}

function getProductsOfSTO($recordId,$recplantcode) {
    global $adb;
    $query = "SELECT
        case when vtiger_products.productid != '' then vtiger_products.productname else vtiger_service.servicename end as productname,
        case when vtiger_products.productid != '' then vtiger_products.product_no else vtiger_service.service_no end as productcode,
        case when vtiger_products.productid != '' then vtiger_products.unit_price else vtiger_service.unit_price end as unit_price,
        case when vtiger_products.productid != '' then vtiger_products.qtyinstock else 'NA' end as qtyinstock,
        case when vtiger_products.productid != '' then 'Products' else 'Services' end as entitytype,
        vtiger_inventoryproductrel.listprice, vtiger_products.is_subproducts_viewable, vtiger_products.plant_name,
        vtiger_inventoryproductrel.description AS product_description, vtiger_inventoryproductrel.*,
        vtiger_crmentity.deleted FROM vtiger_inventoryproductrel
        LEFT JOIN vtiger_crmentity ON vtiger_crmentity.crmid=vtiger_inventoryproductrel.productid
        LEFT JOIN vtiger_products ON vtiger_products.productid=vtiger_inventoryproductrel.productid
        LEFT JOIN vtiger_service ON vtiger_service.serviceid=vtiger_inventoryproductrel.productid
        WHERE id=? ORDER BY sequence_no";
    
    $params = array($recordId);
    $result = $adb->pquery($query, $params);
    $num_rows = $adb->num_rows($result);
    $products = [];
    for ($i = 0; $i < $num_rows; $i++) {
        $product = array();
        $product['MATNR'] = $adb->query_result($result, $i, 'productname');
        $product['MENGE'] = $adb->query_result($result, $i, 'quantity');
        $product['PLANT'] = $recplantcode;
        // $plantCodeId = $adb->query_result($result, $i, 'plant_name');

        // $sql = "select plant_code from vtiger_maintenanceplant where maintenanceplantid = ? ";
        // $insideResult = $adb->pquery($sql, array($plantCodeId));
        // $dataRow = $adb->fetchByAssoc($insideResult, 0);
        // if (empty($dataRow['plant_code'])) {
        //     $product['PLANT'] = '';
        // } else {
        //     $product['PLANT'] = $dataRow['plant_code'];
        // }
        array_push($products, $product);
    }
    return $products;
}
