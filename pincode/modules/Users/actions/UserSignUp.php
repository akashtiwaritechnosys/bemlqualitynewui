<?php
require_once('modules/ServiceEngineer/ServiceEngineer.php');
class Users_UserSignUp_Action extends Vtiger_Action_Controller {

    function loginRequired() {
        return false;
    }

    function checkPermission(Vtiger_Request $request) {
        return true;
    }

    function process(Vtiger_Request $request) {
        $response = new Vtiger_Response();
        $responseObject = [];
        $id = $request->get('uid');
        $otp = $request->get('otp');
        $status = Vtiger_ShortURL_Helper::handleForgotPasswordMobile(vtlib_purify($id));
        if ($status == true) {
            global $current_user;
            $current_user = Users::getActiveAdminUser();
            $shortURLModel = Vtiger_ShortURL_Helper::getInstance($id);
            $handlerData = $shortURLModel->handler_data;
            $otpFromDataBase = $shortURLModel->handler_data['otp'];
            if ($otp == $otpFromDataBase) {
                $sentTime = $shortURLModel->handler_data['time'];
                $now = strtotime("Now");
                if ($now >  $sentTime) {
                    $response->setError(100, "OTP is Expired");
                    return $response;
                } else {
                    $activeFields = $this->getActiveFields('ServiceEngineer', true);
                    $focus = CRMEntity::getInstance('ServiceEngineer');
                    $activeFieldKeys = array_keys($activeFields);

                    $hasSubRoleArr = array('Regional Office', 'Service Centre', 'Activity Centre', 'District Office');
                    if (in_array($handlerData['office'], $hasSubRoleArr)) {
                        $releventRole = '';
                        if ($handlerData['office'] == 'District Office') {
                            $releventRole =  $handlerData['district_office'];
                        } else if ($handlerData['office'] == 'Regional Office') {
                            $releventRole =  $handlerData['regional_office'];
                        }
                        if ($handlerData['cust_role'] == 'Service Manager') {
                            if($handlerData['sub_service_manager_role'] == 'Service Manager Support'){
                                $focus->column_fields['sys_detect_role'] = $releventRole . ' - Service Manager';
                            } else {
                                $focus->column_fields['sys_detect_role'] = $releventRole . ' - ' . $handlerData['sub_service_manager_role'];
                            }
                        } else {
                            $focus->column_fields['sys_detect_role'] = $releventRole . ' - ' . $handlerData['cust_role'];
                        }
                    } else {
                        $focus->column_fields['sys_detect_role'] = $handlerData['office'] . ' - ' . $handlerData['cust_role'];
                    }

                    foreach ($activeFieldKeys as $activeFieldKey) {
                        if ($activeFieldKey == 'date_of_birth' || $activeFieldKey == 'date_of_joining') {
                            $dateValue = $shortURLModel->handler_data[$activeFieldKey];
                            $date = new DateTimeField($dateValue);
                            $convertedDate = $date::__convertToDBFormat($dateValue, 'dd/mm/yyyy');
                            $shortURLModel->handler_data[$activeFieldKey] = $convertedDate;
                        }
                        // if ($activeFieldKey == 'assigned_user_id') {
                        //     $a = $this->getParentRoleUserId($focus->column_fields['sys_detect_role']);
                        //     var_dump($a);
                        //     die();
                        //     $focus->column_fields['assigned_user_id'] = $this->getParentRoleUserId($focus->column_fields['sys_detect_role']);
                        // } else {
                        $focus->column_fields[$activeFieldKey] = $shortURLModel->handler_data[$activeFieldKey];
                        // }
                    }

                    // $focus->column_fields['assigned_user_id'] = $this->getParentRoleUserId($focus->column_fields['sys_detect_role']);
                    $focus->column_fields['assigned_user_id'] = $this->getParentRoleUserId($handlerData['regional_office'], $handlerData);
                    $focus->save("ServiceEngineer");

                    $responseObject['message'] = 'Record is Created ';
                    $response->setResult($responseObject);
                    return $response;
                }
            } else {
                $response->setError(100, "OTP is Invalid");
                return $response;
            }
        } else {
            $response->setError(100, "UID is Invalid");
            return $response;
        }
    }

    function getParentRole($roleName) {
        global $adb;
        $sql = "SELECT * FROM `vtiger_role` where rolename = ?";
        $result = $adb->pquery($sql, array($roleName));
        $dataRow = $adb->fetchByAssoc($result, 0);
        $pR = '';
        if (empty($dataRow['parentrole'])) {
            $pR = '';
        } else {
            $pR = $dataRow['parentrole'];
        }
        $arrayOfRoles = explode('::', $pR);
        array_pop($arrayOfRoles);
        $actualParentRole = implode("::", $arrayOfRoles);
        $pRsql = "SELECT * FROM `vtiger_role` where parentrole = ?";
        $pRresult = $adb->pquery($pRsql, array($actualParentRole));
        $pRdataRow = $adb->fetchByAssoc($pRresult, 0);
        if (empty($pRdataRow['rolename'])) {
            return '';
        } else {
            return  $pRdataRow['rolename'];
        }
    }

    function getParentRoleUserId($roleName, $data) {
        // $parentRole = $this->getParentRole($roleName);
        if ($data['office'] == 'District Office') {
            $parentRole =  $data['district_office'] . ' - DISTRICT MANAGER';
        } else if ($data['office'] == 'Regional Office') {
            $parentRole =  $data['regional_office'] . ' - REGIONAL MANAGER';
        }

        $userId = $this->getUserIdOfRole($parentRole);
        if (empty($userId)) {
            return 1;
            // $this->getParentRoleUserId($parentRole);
        } else {
            return $userId;
        }
    }

    function getUserIdOfRole($roleName) {
        global $adb;
        $sql = "SELECT * FROM `vtiger_role` 
		INNER JOIN `vtiger_user2role` ON `vtiger_user2role`.`roleid` = `vtiger_role`.`roleid` 
		where rolename = ?";
        $result = $adb->pquery($sql, array($roleName));
        $dataRow = $adb->fetchByAssoc($result, 0);
        if (empty($dataRow['userid'])) {
            return 1;
        } else {
            return $dataRow['userid'];
        }
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
}
