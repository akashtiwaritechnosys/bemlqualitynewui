<?php
chdir(dirname(_FILE_) . '/../');
include_once 'config.php';
include_once 'include/Webservices/Relation.php';
include_once 'vtlib/Vtiger/Module.php';
include_once 'includes/main/WebUI.php';
global $current_user;
$current_user = Users::getActiveAdminUser();
$webUI = new Vtiger_WebUI();
global $adb;
$msql = "SELECT * FROM vtiger_crmentity where setype ='HelpDesk' and deleted = 0";
$res = $adb->pquery($msql, array());
$_REQUEST['action'] = 'SaveAjax';
global $doingMig;
$doingMig = true;
while ($row = $adb->fetchByAssoc($res)) {
        $recordModel = Vtiger_Record_Model::getInstanceById($row['crmid']);
        $val = isRecommisionExits($row['crmid']);
        if ($val == true && $recordModel->get('ticketstatus') == 'Closed') {
                $recordModel->set('mode', 'edit');
                $recordModel->set('ticketstatus', 'Closed after Re-commissioning');
                $recordModel->save();
        }
}

function isRecommisionExits($id) {
        global $adb;
        $sql = 'select recommissioningreportsid,is_submitted  from vtiger_recommissioningreports'
                . ' INNER JOIN vtiger_crmentity '
                . ' ON vtiger_crmentity.crmid = vtiger_recommissioningreports.recommissioningreportsid '
                . ' where vtiger_recommissioningreports.ticket_id = ? and vtiger_crmentity.deleted = 0';
        $sqlResult = $adb->pquery($sql, array($id));
        $num_rows = $adb->num_rows($sqlResult);
        if ($num_rows > 0) {
                $resultObject = true;
        } else {
                $resultObject = false;
        }
        return $resultObject;
}
