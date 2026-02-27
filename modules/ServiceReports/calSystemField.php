<?php
include_once('include/utils/GeneralUtils.php');
include_once('include/utils/IgClassUtils.php');
function calSystemField($entityData) {
    global $adb;
    global $log;
    $recordInfo = $entityData->{'data'};

    $notiType = $recordInfo['fail_de_sap_noti_type'];
    $id = $recordInfo['id'];
    $id = explode('x', $id);
    $id = $id[1];

    $off_on_account_of_sys = '';
    $off_on_account_of = $recordInfo['off_on_account_of'];
    if ($off_on_account_of == 'CUSTOMER') {
        $off_on_account_of_sys = 'CUSTOMER';
    } else if ($off_on_account_of == 'BEML') {
        $partPartains = $recordInfo['fail_de_part_pertains_to'];
        if ($partPartains == 'BEML') {
            $off_on_account_of_sys = $recordInfo['fd_sub_div'];
        } else if ($partPartains == 'Vendor') {
            $off_on_account_of_sys = 'VENDOR';
        }
    }
    $query = "UPDATE vtiger_servicereportscf SET off_on_account_of_sys = ? WHERE servicereportsid=?";
    $adb->pquery($query, array($off_on_account_of_sys, $id));
}
