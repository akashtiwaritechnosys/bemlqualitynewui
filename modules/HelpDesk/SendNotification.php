<?php

use phpFCMv1\Client;
use phpFCMv1\Notification;
use phpFCMv1\Recipient;

function SendNotification($entityData) {
    global $adb;
    $recordInfo = $entityData->{'data'};
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $assigned_user_id = $recordInfo['assigned_user_id'];
    $assigned_user_id = explode('x', $assigned_user_id);
    $assigned_user_id = $assigned_user_id[1];

    $deviceId = getUserDeviceIdONAssignment($assigned_user_id);
    if (empty($deviceId)) {
        return;
    }

    try {
        $recordModel = Vtiger_Record_Model::getInstanceById($assigned_user_id, 'Users');
        $userLabel = $recordModel->get('last_name');
        $userMobileNo = $recordModel->get('phone_mobile');
        require_once __DIR__ . '/vendor/autoload.php';
        $client = new Client('vendor/dkjkjdkjdkjdkjkdjkdjdkkdjkdjncbnxvbr63536sshg/bemlchsfinals-firebase-adminsdk-8w0nz-6f63b7f709.json');
        $recipient = new Recipient();
        $notification = new Notification();

        $recipient->setSingleRecipient($deviceId);
        $notification->setNotification("New Service Request Is Assigned", 'TEST');
        $client->build($recipient, $notification);
        $result = $client->fire();
    } catch (Exception $e) {
    }
}

function getUserDeviceIdONAssignment($userId) {
    global $adb;
    $sql = 'SELECT deviceid FROM vtiger_mobilenotifiaction WHERE userid=?';
    $result = $adb->pquery($sql, array($userId));
    $purchaseOrderStatus = $adb->query_result($result, 0, "deviceid");
    return $purchaseOrderStatus;
}
