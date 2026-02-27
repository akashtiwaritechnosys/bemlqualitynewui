<?php

require_once 'includes/main/WebUI.php';
require_once 'include/utils/utils.php';
require_once 'include/utils/VtlibUtils.php';
require_once 'modules/Vtiger/helpers/ShortURL.php';

class Mobile_WS_PreResetPassword extends Mobile_WS_Controller {

    function requireLogin() {
        return false;
    }

    function process(Mobile_API_Request $request) {
        $response = new Mobile_API_Response();
        $mobileNo = $request->get('mobileNo');
        global $adb;
        $IpAddress = $this->getClientIp() . date("YmdH");
        $sql = " select count(*) as 'count' from vtiger_shorturls "
            . " where ip_address = ?";
        $result = $adb->pquery($sql, array($IpAddress));
        $dataRow = $adb->fetchByAssoc($result, 0);
        $numberOfattempts = (int) $dataRow['count'];
        if ($numberOfattempts > 10) {
            $response->setError(100, 'Number of Password Reset Attempt is Exceeded');
            return $response;
        }
        if (!empty($mobileNo)) {
            $usercreatedid = '';
            $email = '';
            $useruniqeid = '';
            $id = '';
            $mobile = '';
            $mobileNo = vtlib_purify($mobileNo);
            $sql = 'select serviceengineerid,vtiger_serviceengineer.email,vtiger_users.id,vtiger_serviceengineer.phone,vtiger_users.accesskey from vtiger_serviceengineer ' .
                ' inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_serviceengineer.serviceengineerid ' .
                ' inner join vtiger_users on vtiger_users.user_name=vtiger_serviceengineer.badge_no ' .
                ' where vtiger_serviceengineer.phone = ? AND vtiger_crmentity.deleted = 0';
            $result = $adb->pquery($sql, array($mobileNo));
            if ($adb->num_rows($result) == 1 ) {
                $email = $adb->query_result($result, 0, 'email');
                $id = $adb->query_result($result, 0, 'id');
                $mobile = $adb->query_result($result, 0, 'phone');
                $useruniqeid =  $adb->query_result($result, 0, 'accesskey');
                $usercreatedid =  $adb->query_result($result, 0, 'serviceengineerid');
            } else {
                $response->setError(100, 'Unable To Find User');
                return $response;
            }
            if (!empty($email)) {
                $time = time();
                $otp = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                $options = array(
                    'handler_path' => 'modules/Users/handlers/ForgotPassword.php',
                    'handler_class' => 'Users_ForgotPassword_Handler',
                    'handler_function' => 'changePassword',
                    'onetime' => 0
                );
                $handler_data['time'] = strtotime("+1 Minute");
                $handler_data['hash'] = md5($mobileNo . $time);
                $handler_data['otp'] = $otp;
                $handler_data['mobileNo'] = $mobileNo;
                $handler_data['id'] = $id;
                $options['handler_data'] = $handler_data;
                $trackURL = Vtiger_ShortURL_Helper::generateURLMobile($options);
                $content = 'Dear Customer,<br><br> 
                You recently requested a password reset for your CRM Account.<br> 
                To create a new password, Here is your OTP ' . $otp . '
                <br><br> 
                This request was made on ' . date("Y-m-d H:i:s") . ' and will expire in next 1 Minutes.<br><br> 
                Regards,<br> 
                CRM Support Team.<br>';

                $subject = 'CRM: Password Reset';
                vimport('~~/modules/Emails/mail.php');
                global $HELPDESK_SUPPORT_EMAIL_ID, $HELPDESK_SUPPORT_NAME;
                $status = send_mail('Users', $email, $HELPDESK_SUPPORT_NAME, $HELPDESK_SUPPORT_EMAIL_ID, $subject, $content, '', '', '', '', '', true);
                if ($status === 1 || $status === true) {
                    $responseObject['uid'] = $trackURL;
                    $responseObject['usermobilenumber'] = $mobile;
                    $date = new DateTime();
                    $responseObject['usercreatedid'] = $usercreatedid;
                    $responseObject['useruniqeid'] = $useruniqeid;
                    $responseObject['timestamp'] = $date->getTimestamp();
                    $responseObject['usertype'] = 'BEMLUSER';
                    $responseObject['message'] = 'OTP Has Sent To Registered Email';
                    $response->setApiSucessMessage('OTP Has Sent To Registered Email');
                    $response->setResult($responseObject);
                    $result = $adb->pquery('update vtiger_shorturls set ip_address = ? where uid= ? ', array($IpAddress, $trackURL));
                    return $response;
                } else {
                    $response->setError(100, 'Not Able To Send Email');
                    return $response;
                }
            } else {
                $response->setError(100, 'Unable To Find Email Of The User');
                return $response;
            }
        } else {
            $products['result'] = false;
            $products['message'] = "Mobile Number Is Required To Send OTP";
            $response->setResult($products);
            return $response;
        }
    }
    function getClientIp() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if (getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if (getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if (getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if (getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if (getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}
