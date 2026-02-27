<?php
function SyncToExternalOnAccept($entityData) {
    global $adb;
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $equipId = $recordInfo['equipment_id'];
    $equipId = explode('x', $equipId);
    $equipId = $equipId[1];

    $recordInstance = Vtiger_Record_Model::getInstanceById($equipId);
    $saprefNo = $recordInstance->get('equipment_sl_no');

    $url = "http://10.80.2.84/phprfcbeml/sapclasses/examples/CreateSR.php";
    $header = array('Content-Type:multipart/form-data');
    $data = array(
        'IM_TYPE' => 'ZY',
        'IM_TEXT' => 'Problem Desc',
        'IM_EQUNR' => $saprefNo,
        'IM_MSAUS' => 'X',
        'IM_EAUSZT' => '12.00',
        'IM_MAUEH' => 'H',
        'IM_TEXT1' => $recordInfo['description'],
        'IM_TEXT2' =>  $recordInfo['description'],
        'IM_TEXT3' =>  $recordInfo['description'],
        'IM_REPORTEDBY' => 'BUZTECHNOSYS'
    );
    $resource = curl_init();
    curl_setopt($resource, CURLOPT_URL, $url);
    curl_setopt($resource, CURLOPT_HTTPHEADER, $header);
    curl_setopt($resource, CURLOPT_POST, 1);
    curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($resource, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($resource);
    $response = json_decode($response,true);
    curl_close($resource);
    $query = "UPDATE vtiger_troubletickets SET external_app_num=? WHERE ticketid=?";
    $adb->pquery($query, array($response['EX_QMNUM'], $id));
}
