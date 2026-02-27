<?php
function SyncToExternalOnSERCreate($entityData) {
    global $adb;
    global $log;
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $ticketId = $recordInfo['ticket_id'];
    $ticketId = explode('x', $ticketId);
    $ticketId = $ticketId[1];
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
        return;
    }
    $notiType = $recordInfo['fail_de_sap_noti_type'];
    $reportedById = $recordInfo['reported_by'];
    $reportedById = explode('x', $reportedById);
    $reportedById = $reportedById[1];
    $reportedBy = Vtiger_Functions::getCRMRecordLabel($reportedById);
    $symptoms = $recordInfo['symptoms'];

    $Observation = $recordInfo['fd_obvservation'];
    $actionTaken = $recordInfo['action_taken_block'];
    // Implement fail_de_system_affected
    $systemAffected = $recordInfo['fail_de_system_affected'];
    $sql = 'select code , code_group from vtiger_fail_de_system_affected '
        . ' where fail_de_system_affected = ?';
    $sqlResult = $adb->pquery($sql, array($systemAffected));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $systemAffetedCode = '';
    $systemAffetedCodeGroup = '';
    if (empty($dataRow)) {
        $systemAffetedCode = '';
        $systemAffetedCodeGroup = '';
    } else {
        $systemAffetedCode = $dataRow['code'];
        $systemAffetedCodeGroup = $dataRow['code_group'];
    }

    // Implement fail_de_type_of_damage
    $typeOfDamage = $recordInfo['fail_de_type_of_damage'];
    $sql = 'select code , code_group from vtiger_fail_de_type_of_damage '
        . ' where fail_de_type_of_damage = ?';
    $sqlResult = $adb->pquery($sql, array($typeOfDamage));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $typeOfDamageCode = '';
    $typeOfDamageGroupCode = '';
    if (empty($dataRow)) {
        $typeOfDamageCode = '';
        $typeOfDamageGroupCode = '';
    } else {
        $typeOfDamageCode = $dataRow['code'];
        $typeOfDamageGroupCode = $dataRow['code_group'];
    }

    // Implement fail_de_part_pertains_to
    $partPertainsTo = $recordInfo['fail_de_part_pertains_to'];
    $sql = 'select code , code_group from vtiger_fail_de_part_pertains_to '
        . ' where fail_de_part_pertains_to = ?';
    $sqlResult = $adb->pquery($sql, array($partPertainsTo));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $partPertainsToCode = '';
    $partPertainsToCodeGroup = '';
    if (empty($dataRow)) {
        $partPertainsToCode = '';
        $partPertainsToCodeGroup = '';
    } else {
        $partPertainsToCode = $dataRow['code'];
        $partPertainsToCodeGroup = $dataRow['code_group'];
    }

    // Implement fail_de_parts_affected
    $partEffected = $recordInfo['fail_de_parts_affected'];
    $sql = 'select code , code_group from vtiger_fail_de_parts_affected'
        . ' where fail_de_parts_affected = ?';
    $sqlResult = $adb->pquery($sql, array($partEffected));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $partEffectedCode = '';
    $partEffectedCodeGroup = '';
    if (empty($dataRow)) {
        $partEffectedCode = '';
        $partEffectedCodeGroup = '';
    } else {
        $partEffectedCode = $dataRow['code'];
        $partEffectedCodeGroup = $dataRow['code_group'];
    }

    $equipId = $recordInfo['equipment_id'];
    $equipId = explode('x', $equipId);
    $equipId = $equipId[1];

    $SAPrefEquip = '';
    if (!empty($equipId)) {
        $recordInstance = Vtiger_Record_Model::getInstanceById($equipId);
        $SAPrefEquip = $recordInstance->get('equipment_sl_no');
    }

    $conditionAfterAction = $recordInfo['eq_sta_aft_act_taken'];
    $conditionAfterActionCode = getCodeOFValue('eq_sta_aft_act_taken', $conditionAfterAction);

    $conditionBeforeSRGen = $recordInfo['fd_eq_sta_bsr'];
    $conditionBeforeSRGenCode = getCodeOFValue('fd_eq_sta_bsr', $conditionBeforeSRGen);

    $conditionAfterMalfunction = $recordInfo['sr_equip_status'];
    $conditionAfterMalfunctionCode = getCodeOFValue('sr_equip_status', $conditionAfterMalfunction);

    // malfunction Implementation
    $ticketCreatedDateTimeArr = explode(' ', $ticketCreatedDateTime);
    $ticketCreatedDate = $ticketCreatedDateTimeArr[0];
    $ticketDateSAPFormat = str_replace('-', '', $ticketCreatedDate);
    $ticketCreatedTime = $ticketCreatedDateTimeArr[1];
    $ticketTimeSAPFormat = str_replace(':', '', $ticketCreatedTime);

    $malfunctionEndDate = $recordInfo['restoration_date'];
    $malfunctionEndDateSAPFormat = str_replace('-', '', $malfunctionEndDate);
    $malfunctionEndTime = $recordInfo['restoration_time'];
    $malfunctionEndTimeSAPFormat = str_replace(':', '', $malfunctionEndTime);

    $products = getProductsOfServiceReport($id);
    $hmr = $recordInfo['hmr'];
    $url = "http://10.80.2.84/phprfcbeml/sapclasses/examples/CreateSR.php";
    $header = array('Content-Type:multipart/form-data');
    $data = array(
        'IM_TYPE'  => $notiType,
        'IM_TEXT' => $symptoms,
        'IM_EQUNR'  => $SAPrefEquip,
        'IM_MSAUS' => 'X',
        'IM_EAUSZT' =>  '0.00',
        // 'IM_MAUEH'  => '',
        'IM_TEXT1' => $Observation,
        'IM_TEXT2' => $actionTaken,
        'IM_TEXT3' => $Observation .'\n'. $actionTaken,
        'IM_REPORTEDBY' => $reportedBy,
        'IM_RESPOSIBLE' => $partPertainsToCodeGroup . ',' . $partPertainsToCode,
        'IM_OBJECTPART' => $systemAffetedCodeGroup . ',' . $systemAffetedCode,
        'IM_DAMAGE' => $partEffectedCodeGroup . ',' . $partEffectedCode,
        'IM_CAUSE' => $typeOfDamageGroupCode . ',' . $typeOfDamageCode,
        'IM_EFFECT' =>  $conditionAfterActionCode,
        'IM_BEFORE_MALFUNC' => $conditionBeforeSRGenCode,
        'IM_AFTER_MALFUNC' =>  $conditionAfterMalfunctionCode,
        'IM_COND_AFTERTASK' =>  $conditionAfterActionCode,
        'IM_MALFUNC_STARTDATE' => $ticketDateSAPFormat,
        'IM_MALFUNC_STARTTIME' =>  $ticketTimeSAPFormat,
        'IM_MALFUNC_ENDDATE' => $malfunctionEndDateSAPFormat,
        'IM_MALFUNC_ENDTIME' => $malfunctionEndTimeSAPFormat,
        // 'IM_MEASURE_POINT'                '891'
        'IM_HMR_READING' => $hmr,
        'IM_PART' => $products['partNumber'],
        'IM_REQ_QTY' => $products['quantity'],
        'IM_ITEM_CATOG' => 'L'
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
    // var_dump($response);
    // die();
    $log->debug("*****Response Recived From SAP***********$response********");
    $response = json_decode($response, true);
    curl_close($resource);

    $ticketId = $recordInfo['ticket_id'];
    $ticketId = explode('x', $ticketId);
    $ticketId = $ticketId[1];
    if (empty(trim($response['EX_QMNUM']))) {
        print_r("<h3> Creating NotificationIn SAP Is Failed Because Of Following Error,Please Fix The Problems</h3></br>");
        print_r(json_encode($response));
        print_r("<br><h3><a href='index.php?module=ServiceReports&view=Edit&record=$id&app=MARKETING'> Click Here </a></h3>");
        die();
    }

    createServiceOrder($id, $ticketId, $response['EX_AUFNR']);
    $query = "UPDATE vtiger_troubletickets SET external_app_num=? WHERE ticketid=?";
    $adb->pquery($query, array($response['EX_QMNUM'], $ticketId));
}

function getProductsOfServiceReport($recordId) {
    global $adb;
    $query = "SELECT
        case when vtiger_products.productid != '' then vtiger_products.productname else vtiger_service.servicename end as productname,
        case when vtiger_products.productid != '' then vtiger_products.product_no else vtiger_service.service_no end as productcode,
        case when vtiger_products.productid != '' then vtiger_products.unit_price else vtiger_service.unit_price end as unit_price,
        case when vtiger_products.productid != '' then vtiger_products.qtyinstock else 'NA' end as qtyinstock,
        case when vtiger_products.productid != '' then 'Products' else 'Services' end as entitytype,
        vtiger_inventoryproductrel.listprice, vtiger_products.is_subproducts_viewable, 
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
    for ($i = 1; $i <= $num_rows; $i++) {
        $products['partNumber'] = $adb->query_result($result, $i - 1, 'productname');
        $products['quantity'] = $adb->query_result($result, $i - 1, 'quantity');
        return $products;
    }
}

function getCodeOFValue($keyTable, $value) {
    global $adb;
    $sql = 'select code from vtiger_' . $keyTable
        . ' where ' . $keyTable . ' = ?';
    $sqlResult = $adb->pquery($sql, array($value));
    $dataRow = $adb->fetchByAssoc($sqlResult, 0);
    $code = '';
    if (empty($dataRow)) {
        $code = '';
    } else {
        $code = $dataRow['code'];
    }
    return $code;
}

function createServiceOrder($id, $ticketId, $SapNumber) {
    $salesorder_id = $id;
    require_once('include/utils/utils.php');
    require_once('modules/ServiceReports/ServiceReports.php');
    require_once('modules/ServiceOrders/ServiceOrders.php');
    require_once('modules/Users/Users.php');

    global $current_user;
    if (!$current_user) {
        $current_user = Users::getActiveAdminUser();
    }
    $so_focus = new ServiceReports();
    $so_focus->id = $salesorder_id;
    $so_focus->retrieve_entity_info($salesorder_id, "ServiceReports");
    foreach ($so_focus->column_fields as $fieldname => $value) {
        $so_focus->column_fields[$fieldname] = decode_html($value);
    }

    $focus = new ServiceOrders();
    $focus = getConvertSrepToServiceOrder($focus, $so_focus, $salesorder_id);
    $focus->id = '';
    $focus->mode = '';
    // $focus->column_fields['salesorder_id'] = $salesorder_id;
    // $focus->column_fields['invoicestatus'] = 'Created';
    $invoice_so_fields = array(
        'txtAdjustment' => 'txtAdjustment',
        'hdnSubTotal' => 'hdnSubTotal',
        'hdnGrandTotal' => 'hdnGrandTotal',
        'hdnTaxType' => 'hdnTaxType',
        'hdnDiscountPercent' => 'hdnDiscountPercent',
        'hdnDiscountAmount' => 'hdnDiscountAmount',
        'hdnS_H_Amount' => 'hdnS_H_Amount',
        'assigned_user_id' => 'assigned_user_id',
        'currency_id' => 'currency_id',
        'conversion_rate' => 'conversion_rate',
    );
    foreach ($invoice_so_fields as $invoice_field => $so_field) {
        $focus->column_fields[$invoice_field] = $so_focus->column_fields[$so_field];
    }
    $focus->column_fields['ticket_id'] = $ticketId;
    $focus->column_fields['external_app_num'] = $SapNumber;
    $focus->_servicereportid = $salesorder_id;
    $focus->_recurring_mode = 'recurringinvoice_from_service_report';
    $focus->save("ServiceOrders");
    return $focus->id;
}
