<?php
require_once('modules/ServiceEngineer/ServiceEngineer.php');
class Mobile_WS_UserSignUp extends Mobile_WS_Controller {

    function requireLogin() {
        return false;
    }

    function process(Mobile_API_Request $request) {
        $response = new Mobile_API_Response();
        $responseObject = [];
        $id = $request->get('uid');
        $otp = $request->get('otp');
        $status = Vtiger_ShortURL_Helper::handleForgotPasswordMobile(vtlib_purify($id));
        if ($status == true) {
            $shortURLModel = Vtiger_ShortURL_Helper::getInstance($id);
            $otpFromDataBase = $shortURLModel->handler_data['otp'];
            if ($otp == $otpFromDataBase) {
                global $current_user;
                $current_user = Users::getActiveAdminUser();
                $sentTime = $shortURLModel->handler_data['time'];
                $now = strtotime("Now");
                if ($now >  $sentTime) {
                    $response->setError(100, "OTP is Expired");
                    return $response;
                } else {
                    $activeFields = $this->getActiveFields('ServiceEngineer', true);
                    $focus = CRMEntity::getInstance('ServiceEngineer');
                    $activeFieldKeys = array_keys($activeFields);
                    foreach ($activeFieldKeys as $activeFieldKey) {
                        if ($activeFieldKey == 'assigned_user_id') {
                            $focus->column_fields['assigned_user_id'] = $this->getAssignedPerson($shortURLModel->handler_data['nearest_office']);
                        } else {
                            $focus->column_fields[$activeFieldKey] = $shortURLModel->handler_data[$activeFieldKey];
                        }
                    }
                    $focus->column_fields['assigned_user_id']  = 1;
                    $focus->save("ServiceEngineer");
                    $responseObject['phone'] = $focus->column_fields['phone'];
                    $responseObject['usercreatedid'] =  $focus->id;
                    $responseObject['useruniqeid'] =  'Unique Id // To do';
                    $date = new DateTime();
                    $responseObject['timestamp'] = $date->getTimestamp();
                    $responseObject['message'] = "Thank you for your valuable registration. " .
                        "Verification pending from BEML. " .
                        "After succesful verification, you will be communicated through SMS/Email.";
                    $response->setApiSucessMessage("Successfully User Is Created");
                    $response->setResult($responseObject);
                    $shortURLModel->delete();
                    return $response;
                }
            } else {
                $response->setError(100, "OTP Is Invalid");
                return $response;
            }
        } else {
            $response->setError(100, "UID Is Invalid");
            return $response;
        }
    }

    function getAssignedPerson() {
        return 1;
    }

    function getActiveFields($module, $withPermissions = false) {
        $activeFields = Vtiger_Cache::get('CustomerPortal', 'activeFields'); // need to flush cache when fields updated at CRM settings

        if (empty($activeFields)) {
            global $adb;
            $sql = "SELECT name, fieldinfo FROM vtiger_customerportal_fields INNER JOIN vtiger_tab ON vtiger_customerportal_fields.tabid=vtiger_tab.tabid";
            $sqlResult = $adb->pquery($sql, array());
            $num_rows = $adb->num_rows($sqlResult);

            for ($i = 0; $i < $num_rows; $i++) {
                $retrievedModule = $adb->query_result($sqlResult, $i, 'name');
                $fieldInfo = $adb->query_result($sqlResult, $i, 'fieldinfo');
                $activeFields[$retrievedModule] = $fieldInfo;
            }
            Vtiger_Cache::set('CustomerPortal', 'activeFields', $activeFields);
        }

        $fieldsJSON = $activeFields[$module];
        $data = Zend_Json::decode(decode_html($fieldsJSON));
        $fields = array();

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (self::isViewable($key, $module)) {
                    if ($withPermissions) {
                        $fields[$key] = $value;
                    } else {
                        $fields[] = $key;
                    }
                }
            }
        }
        return $fields;
    }

    function isViewable($fieldName, $module) {
        global $db;
        $db = PearDatabase::getInstance();
        $tabidSql = "SELECT tabid from vtiger_tab WHERE name = ?";
        $tabidResult = $db->pquery($tabidSql, array($module));
        if ($db->num_rows($tabidResult)) {
            $tabId = $db->query_result($tabidResult, 0, 'tabid');
        }
        $presenceSql = "SELECT presence,displaytype FROM vtiger_field WHERE fieldname=? AND tabid = ?";
        $presenceResult = $db->pquery($presenceSql, array($fieldName, $tabId));
        $num_rows = $db->num_rows($presenceResult);
        if ($num_rows) {
            $fieldPresence = $db->query_result($presenceResult, 0, 'presence');
            $displayType = $db->query_result($presenceResult, 0, 'displaytype');
            if ($fieldPresence == 0 || $fieldPresence == 2 && $displayType !== 4) {
                return true;
            } else {
                return false;
            }
        }
    }

    function fixUIType($module, $fieldname, $uitype) {
        if ($module == 'Contacts' || $module == 'Leads') {
            if ($fieldname == 'salutationtype') {
                return 16;
            }
        } else if ($module == 'Calendar' || $module == 'Events') {
            if ($fieldname == 'time_start' || $fieldname == 'time_end') {
                // Special type for mandatory time type (not defined in product)
                return 252;
            }
        }
        return $uitype;
    }
}
