<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

require_once 'modules/ITS4YouReports/ITS4YouReports.php';
require_once 'modules/ITS4YouReports/GenerateObj.php';
require_once 'include/Zend/Json.php';

require_once('modules/ITS4YouReports/helpers/ITS4YouErrorLog.php');

class ITS4YouScheduledReport extends ITS4YouReports {
// class ITS4YouScheduledReport {

    var $db;
    var $user;

    var $isScheduled = false;
    var $scheduledInterval = null;
    var $scheduledFormat = null;
    var $scheduledRecipients = null;
    var $csvPath = null;
    var $csvName = null;
    var $csvSeparator = null;
    var $schedule_all_records = null;
    var $schedule_skip_empty = null;
    var $onRequest = null;

    public $getnerateForUser = false;

    static $SCHEDULED_HOURLY = 1;
    static $SCHEDULED_DAILY = 2;
    static $SCHEDULED_WEEKLY = 3;
    static $SCHEDULED_BIWEEKLY = 4;
    static $SCHEDULED_MONTHLY = 5;
    static $SCHEDULED_ANNUALLY = 6;

    var $ITS4YouReports;

    public function __construct($adb, $record = '')
    {
        $this->db = $adb;
        if ($record) {
            $this->id = $record;
        }
    }

    public function setGenerateForUser($userId){
        $user = new Users();
        $user->retrieveCurrentUserInfoFromFile($userId);
        global $current_user;
        $current_user = $user;
        return $user;
    }

    protected function getCsvPath()
    {
        $adb = PearDatabase::getInstance();
        $csvPath = '';

        if (!empty($this->id)) {
            $result = $adb->pquery(
                'SELECT csv_path FROM  its4you_reports4you_scheduled_reports
                        LEFT JOIN its4you_reports4you ON its4you_reports4you.reports4youid = its4you_reports4you_scheduled_reports.reportid 
                         WHERE reportid=? AND deleted=0',
                [$this->id]
            );

            if ($adb->num_rows($result) > 0) {
                try {
                    $reportScheduleInfo = $adb->raw_query_result_rowdata($result, 0);
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                $csvPath = $reportScheduleInfo['csv_path'];
            }
        }

        return $csvPath;
    }

    protected function getCsvName()
    {
        $adb = PearDatabase::getInstance();
        $csvPath = '';

        if (!empty($this->id)) {
            $result = $adb->pquery(
                'SELECT csv_name FROM  its4you_reports4you_scheduled_reports
                        LEFT JOIN its4you_reports4you ON its4you_reports4you.reports4youid = its4you_reports4you_scheduled_reports.reportid 
                         WHERE reportid=? AND deleted=0',
                [$this->id]
            );

            if ($adb->num_rows($result) > 0) {
                try {
                    $reportScheduleInfo = $adb->raw_query_result_rowdata($result, 0);
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                $csvPath = $reportScheduleInfo['csv_name'];
            }
        }

        return $csvPath;
    }

    protected function getCsvSeparator()
    {
        $adb = PearDatabase::getInstance();
        $csvSeparator = ',';

        if (!empty($this->id)) {
            $result = $adb->pquery(
                'SELECT csv_separator FROM  its4you_reports4you_scheduled_reports
                        LEFT JOIN its4you_reports4you ON its4you_reports4you.reports4youid = its4you_reports4you_scheduled_reports.reportid 
                         WHERE reportid=? AND deleted=0',
                [$this->id]
            );

            if ($adb->num_rows($result) > 0) {
                try {
                    $reportScheduleInfo = $adb->raw_query_result_rowdata($result, 0);
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                if (!empty($reportScheduleInfo['csv_separator'])) {
                    $csvSeparator = $reportScheduleInfo['csv_separator'];
                }
            }
        }

        return $csvSeparator;
    }

    protected function getSkipEmpty()
    {
        $adb = PearDatabase::getInstance();
        $skipEmpty = '';

        if (!empty($this->id)) {
            $result = $adb->pquery(
                'SELECT schedule_skip_empty FROM  its4you_reports4you_scheduled_reports
                        LEFT JOIN its4you_reports4you ON its4you_reports4you.reports4youid = its4you_reports4you_scheduled_reports.reportid 
                         WHERE reportid=? AND deleted=0',
                [$this->id]
            );

            if ($adb->num_rows($result) > 0) {
                try {
                    $reportScheduleInfo = $adb->raw_query_result_rowdata($result, 0);
                } catch (Exception $e) {
                    die($e->getMessage());
                }
                if (!empty($reportScheduleInfo['schedule_skip_empty'])) {
                    $skipEmpty = $reportScheduleInfo['schedule_skip_empty'];
                }
            }
        }

        return $skipEmpty;
    }

    public function getReportScheduleInfo() {
        $adb = PearDatabase::getInstance();
        if(!empty($this->id)) {
            $cachedInfo = VTCacheUtils::lookupReport_ScheduledInfo($this->user->id, $this->id);

            if($cachedInfo == false) {
                $result = $adb->pquery('SELECT * FROM  its4you_reports4you_scheduled_reports
                                        LEFT JOIN its4you_reports4you ON its4you_reports4you.reports4youid = its4you_reports4you_scheduled_reports.reportid 
                                         WHERE reportid=? AND deleted=0', array($this->id));

                if($adb->num_rows($result) > 0) {
                    $reportScheduleInfo = $adb->raw_query_result_rowdata($result, 0);

                    $scheduledInterval = (!empty($reportScheduleInfo['schedule']))?Zend_Json::decode($reportScheduleInfo['schedule']):array();
                    $scheduledRecipients = (!empty($reportScheduleInfo['recipients']))?Zend_Json::decode($reportScheduleInfo['recipients']):array();

                    $isScheduled = $reportScheduleInfo['is_active'];

                    VTCacheUtils::updateReport_ScheduledInfo($this->user->id, $this->id, $isScheduled, $reportScheduleInfo['format'],
                                                             $scheduledInterval, $scheduledRecipients, $reportScheduleInfo['next_trigger_time']);

                    $cachedInfo = VTCacheUtils::lookupReport_ScheduledInfo($this->user->id, $this->id);
                }
            }
            if($cachedInfo) {
                $this->isScheduled = $cachedInfo['isScheduled'];
                $this->scheduledFormat = $cachedInfo['scheduledFormat'];
                $this->scheduledInterval = $cachedInfo['scheduledInterval'];
                $this->scheduledRecipients = $cachedInfo['scheduledRecipients'];
                $this->scheduledTime = $cachedInfo['scheduledTime'];
                $this->csvPath = $this->getCsvPath();
                $this->csvName = $this->getCsvName();
                $this->csvSeparator = $this->getCsvSeparator();
                $this->schedule_skip_empty = $this->getSkipEmpty();
                return true;
            }
        }
        // ITS4YOU-CR SlOl 2. 5. 2013 12:30:11
        else{
            $this->isScheduled = (isset($_REQUEST['isReportScheduled']) && $_REQUEST['isReportScheduled']!='')?$_REQUEST['isReportScheduled']:'';
            $this->scheduledFormat = (isset($_REQUEST['scheduledReportFormat']) && $_REQUEST['scheduledReportFormat']!='')?$_REQUEST['scheduledReportFormat']:'';
            $this->scheduledInterval = (isset($_REQUEST['scheduledTypeSelectedStr']) && $_REQUEST['scheduledTypeSelectedStr']!='')?Zend_Json::decode($_REQUEST['scheduledIntervalJson']):array();
            $this->scheduledRecipients = (isset($_REQUEST['selectedRecipientsStr']) && $_REQUEST['selectedRecipientsStr']!='')?Zend_Json::decode($_REQUEST['selectedRecipientsStr']):array();
            $this->csvPath = (isset($_REQUEST['csv_path'])) ? $_REQUEST['csv_path'] : '';
            $this->csvName = (isset($_REQUEST['csv_name'])) ? $_REQUEST['csv_name'] : '';
            $this->csvSeparator = (isset($_REQUEST['csv_separator'])) ? $_REQUEST['csv_separator'] : '';
            $this->schedule_skip_empty = (isset($_REQUEST['schedule_skip_empty'])) ? $_REQUEST['schedule_skip_empty'] : '';
            return true;
        }
        // ITS4YOU-END
        return false;
    }

    public function getRecipientEmails() {
        $recipientsInfo = $this->scheduledRecipients;

        $recipientsList = array();
        if(!empty($recipientsInfo)) {
            if(!empty($recipientsInfo['users'])) {
                $recipientsList = array_merge($recipientsList, $recipientsInfo['users']);
            }

            if(!empty($recipientsInfo['roles'])) {
                foreach($recipientsInfo['roles'] as $roleId) {
                    $roleUsers = getRoleUsers($roleId);
                    foreach($roleUsers as $userId => $userName) {
                        array_push($recipientsList, $userId);
                    }
                }
            }

            if(!empty($recipientsInfo['rs'])) {
                foreach($recipientsInfo['rs'] as $roleId) {
                    $users = getRoleAndSubordinateUsers($roleId);
                    foreach($users as $userId => $userName) {
                        array_push($recipientsList, $userId);
                    }
                }
            }


            if(!empty($recipientsInfo['groups'])) {
                require_once 'include/utils/GetGroupUsers.php';
                foreach($recipientsInfo['groups'] as $groupId) {
                    $userGroups = new GetGroupUsers();
                    $userGroups->getAllUsersInGroup($groupId);
                    $recipientsList = array_merge($recipientsList, $userGroups->group_users);
                }
            }
        }
        $recipientsEmails = array();
        if(!empty($recipientsList) && ITS4YouReports_Functions_Helper::count($recipientsList) > 0) {
            foreach($recipientsList as $userId) {
                $userName = getUserFullName($userId);
                $userEmail = getUserEmail($userId);
                if(!in_array($userEmail, $recipientsEmails)) {
                    $recipientsEmails[$userName] = $userEmail;
                }
            }
        }

        if(isset($this->generate_other) && $this->generate_other!=''){
            $generate_other_array = explode(';',$this->generate_other);
            foreach($generate_other_array as $otherEmail){
                $otherEmailArr = explode('@', $otherEmail);
                $otherName = $otherEmailArr[0];
                $recipientsEmails[$otherName] = $otherEmail;
            }
        }
        return $recipientsEmails;
    }

    public function sendEmail($ownerUser='') {
        require_once 'vtlib/Vtiger/Mailer.php';
        $adb = PearDatabase::getInstance();
        global $current_user, $currentModule;
        $vtigerMailer = new Vtiger_Mailer();
        $csvUnlink = true;

        $currentModule = 'ITS4YouReports';
        $reportObj = new ITS4YouReports(true,$this->id);
        if ($reportObj->CheckReportPermissions($currentModule, $this->id, false) !== false) {

            if ($this->getnerateForUser != true) {
                $recipientEmails = $this->getRecipientEmails();
            } else {
                $recipientEmails[getUserFullName($ownerUser->id)] = getUserEmail($ownerUser->id);
            }

            $layout = Vtiger_Viewer::getDefaultLayoutName();
            if ('v7' === $layout) {
                $userModel = Users_Record_Model::getInstanceFromPreferenceFile($ownerUser->id);
                $emailRecordModel = Emails_Record_Model::getCleanInstance('Emails');
                $fromEmail = $emailRecordModel->getFromEmailAddress();
                $replyTo = $emailRecordModel->getReplyToEmail();
                $userName = $userModel->getName();
                $vtigerMailer->ConfigSenderInfo($fromEmail, $userName, $replyTo);
            }

            /** SENDER INFO CONFIG START
             * uncomment line bellow to set up Report owner as a sender
             * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
            //$vtigerMailer->ConfigSenderInfo($ownerUser->column_fields['email1'], getUserFullName($ownerUser->id));
            /** SENDER INFO CONFIG END */

            $ITS4YouReports = new ITS4YouReports(true, $this->id);

            $default_charset = vglobal('default_charset');
            if (!isset($default_charset)) {
                $default_charset = 'UTF-8';
            }
            $ITS4YouReports_reportname = $this->generate_cool_url($ITS4YouReports->reportname);
            $ITS4YouReports_reportdesc = $this->generate_cool_url($ITS4YouReports->reportdesc);

            $currentTime = date('Y-m-d H:i:s');

            $user_id = $ownerUser->id;

            $report_filename = 'Reports4You_' . $user_id . '_' . $this->id;

            if (!empty($this->generate_subject)) {
                $subject = $this->generate_subject;
            } else {
                $subject = $ITS4YouReports_reportname . ' - ' . $currentTime . ' (' . DateTimeField::getDBTimeZone() . ')';
            }

            ITS4YouReports_ITS4YouError_Log::createLog('Generate start {'.$this->id.'}');
            $generate = new GenerateObj($ITS4YouReports,'',false,true);
            $die_due = true;
            if (!isset($_REQUEST['module'])) {
                $die_due = false;
            }
            $r_permitted = $generate->report_obj->CheckReportPermissions($generate->report_obj->primarymodule, $generate->report_obj->record, $die_due);

            if ($r_permitted !== false) {
                $generate->schedule_all_records = $this->schedule_all_records;
                $generate->schedule_skip_empty = $this->schedule_skip_empty;

                $currentModule = 'ITS4YouReports';
                $generate->setCurrentModule4You($currentModule);
                $current_language = $ownerUser->language;
                $generate->setCurrentLanguage4You($current_language);
                $reportFormat = $this->scheduledFormat;
                //$reportFormat = 'pdf;xls';
                $reportFormat = explode(';', $reportFormat);
                $tmpDir = 'test/ITS4YouReports/';

                $attachments = array();
                if (in_array('pdf', $reportFormat)) {
                    ITS4YouReports_ITS4YouError_Log::createLog('Generate PDF start {'.$this->id.'}');
                    $generate->create_pdf_schedule = true;
                    $report_html = $generate->generateReport($this->id, 'HTML', false);

                    if (empty($generate->schedule_skipped)) {
                        if (!empty($generate->report_filename) && file_exists($generate->report_filename)) {
                            $attachments[$generate->pdf_filename] = $generate->report_filename;
                        }
                    }

                    ITS4YouReports_ITS4YouError_Log::createLog('Generate PDF end {'.$this->id.'}');
                }

                if (in_array('xls', $reportFormat)) {
                    ITS4YouReports_ITS4YouError_Log::createLog('Generate XLS start {'.$this->id.'}');
                    $report_data = $generate->generateReport($this->id, 'XLS', false);

                    if (empty($generate->schedule_skipped)) {
                        $ITS4YouReports_xls = $generate->filename . '.xls';
                        $fileName_arr = explode('.', $ITS4YouReports_xls);
                        $fileName = implode('.', $fileName_arr);

                        $fileName_path = $tmpDir . $ITS4YouReports_xls;

                        $generate->writeReportToExcelFile($fileName_path, $report_data);
                        $attachments[$fileName] = $fileName_path;
                    }

                    ITS4YouReports_ITS4YouError_Log::createLog('Generate XLS end {'.$this->id.'}');

                }

                if (in_array('csv', $reportFormat)) {
                    ITS4YouReports_ITS4YouError_Log::createLog('Generate CSV start {' . $this->id . '}');

                    if (!empty($this->csvPath) && !empty($this->csvName)) {
                        $csvPath = self::prepareCsvPath($this->csvPath) . '/' . $this->csvName;
                        $csvUnlink = false;
                    } else {
                        $csvPath = $tmpDir . $generate->filename . '.csv';
                    }

                    if (!empty($csvPath)) {
                        $report_data = $generate->generateReport($this->id, 'XLS', false);

                        if (empty($generate->schedule_skipped)) {
                            $ITS4YouReports_csv = $csvPath;
                            $fileName = (!empty($this->csvName) ? $this->csvName : $subject . '.csv');

                            $fileName_path = $ITS4YouReports_csv;
                            $generate->writeReportToCSVFile($fileName_path, $report_data, $this->csvSeparator);
                            $attachments[$fileName] = $fileName_path;
                        }
                    } else {
                        ITS4YouReports_ITS4YouError_Log::createLog('Empty CSV Path !!! {' . $this->id . '}');
                    }
                    ITS4YouReports_ITS4YouError_Log::createLog('Generate CSV end {' . $this->id . '}');
                }

//$recipientEmails = array("olear@its4you.sk");
                if (!empty($recipientEmails)) {
                    if (empty($generate->schedule_skipped)) {
                        foreach ($recipientEmails as $name => $email) {
                            $vtigerMailer->AddAddress($email, $name);
                        }

                        if (!empty($this->generate_text)) {
                            $contents = nl2br($this->generate_text);
                        } else {
                            $contents = getTranslatedString('LBL_AUTO_GENERATED_REPORT_EMAIL', $currentModule) . '<br/><br/>';

                            if ($this->onRequest || empty($generate->report_html_headerInfo)) {
                                $contents .= '<b>' . getTranslatedString('LBL_REPORT_NAME', $currentModule) . ' :</b> ' . $ITS4YouReports_reportname . '<br/>';
                                $contents .= '<b>' . getTranslatedString('LBL_DESCRIPTION', $currentModule) . ' :</b><br/>' . $ITS4YouReports_reportdesc . '<br/><br/>';
                            } else {
                                $contents .= $generate->report_html_headerInfo;
                            }
                        }

                        global $site_URL;
                        $detail_url = $site_URL . '/index.php?module=' . $currentModule . '&view=Detail&record=' . $this->id;
                        $contents .= "<br/><br/><a href='$detail_url' target='_blank'>" . getTranslatedString('LBL_FOR_DETAILS_CLICK', $currentModule) . '</a><br/><br/>';

                        //$vtigerMailer->Subject = "=?ISO-8859-15?Q?".imap_8bit($subject)."?=";
                        $vtigerMailer->Subject = html_entity_decode($subject, ENT_QUOTES, 'UTF-8');
                        $vtigerMailer->Body = $contents;
                        $vtigerMailer->ContentType = 'text/html';

                        // ITS4YOU-UP SlOl 10. 2. 2016 7:18:44
                        foreach ($attachments as $attachmentName => $path) {
                            //$vtigerMailer->AddAttachment($path, "=?ISO-8859-15?Q?".imap_8bit(html_entity_decode($attachmentName,ENT_QUOTES, "UTF-8"))."?=");
                            $vtigerMailer->AddAttachment($path, (html_entity_decode($attachmentName, ENT_QUOTES, 'UTF-8')));
                        }

                        $send_result = $vtigerMailer->Send(true);
                        echo 'SEND RESULT -> ' . $send_result . '<br />';
                        foreach ($attachments as $attachmentName => $path) {
                            if (strpos($path, '.csv') && !$csvUnlink) {
                                continue;
                            }
                            unlink($path);
                        }
                    } else {
                        echo 'SKIP RESULT -> 1<br />';
                    }
                }

                ITS4YouReports_ITS4YouError_Log::createLog('Generate end {'.$this->id.'}');
                ITS4YouReports::cleanITS4YouReportsCacheFiles();
            }
            //echo "<pre>EXIST ? = ";print_r(method_exists(ITS4YouReports, "cleanITS4YouReportsCacheFiles"));echo "</pre>";
        } else {
            ITS4YouReports_ITS4YouError_Log::createLog('Generate {'.$this->id.'} not permitted for user {'.$current_user->id.'}');
        }
        return true;
    }

    public function checkUserActivity($userId){
        $adb = PearDatabase::getInstance();
        $query = 'SELECT 1 from vtiger_users where id=? AND status = ?';
        $result = $adb->requirePsSingleResult($query, array($userId, 'Active'), false);
        if (empty($result)) {
            return false;
        }else{
            return true;
        }
    }

    public function sendGenerateForEmail(){
        $ITS4YouReports = new ITS4YouReports(true,$this->id);
        $generate_for = true;
        $generate = new GenerateObj($ITS4YouReports,'',$generate_for);

        $generateFor = ITS4YouReports::getSchedulerGenerateFor($this->id);
        if(!empty($generateFor)){
            $generateForUsers = $generate->getGenerateForUsers($generateFor);
            if(!empty($generateForUsers)){
                foreach($generateForUsers as $userId){
                    ITS4YouReports_ITS4YouError_Log::createLog('sendGenerateForEmail {'.$this->id.'} start user {'.$userId.'}');
                    if($this->checkUserActivity($userId)){
//if($userId=="17"){
                        global $current_user;
                        $this->setGenerateForUser($userId);
                        $this->getnerateForUser = true;
                        $this->sendEmail($current_user);
                        $current_user = null;
                        ITS4YouReports_ITS4YouError_Log::createLog('sendGenerateForEmail {'.$this->id.'} end user {'.$userId.'}');
//}
                    }
                }
            }
        }
        return true;
    }

    public function getNextTriggerTime() {
        $scheduleInfo = $this->scheduledInterval;

        $scheduleType		= $scheduleInfo['scheduletype'];
        $scheduledMonth		= $scheduleInfo['month'];
        $scheduledDayOfMonth= $scheduleInfo['date'];
        $scheduledDayOfWeek = $scheduleInfo['day'];
        $scheduledTime		= $scheduleInfo['time'];
        if(empty($scheduledTime)) {
            $scheduledTime = '10:00';
        } elseif(stripos(':', $scheduledTime) === false) {
            $scheduledTime = $scheduledTime .':00';
        }

        if($scheduleType == ITS4YouScheduledReport::$SCHEDULED_HOURLY) {
            $date = date_create(date('Y-m-d'));
            $time_arr = explode(':',$this->scheduledInterval['time']);
            $date->setTime(date('H'), $time_arr[1], 00);
            date_modify($date, '+1 hour');
            return date_format($date, 'Y-m-d H:i:s');
        }
        if($scheduleType == ITS4YouScheduledReport::$SCHEDULED_DAILY) {
            $strToTime = strtotime($scheduledTime);
            $nowDateArray = DateTimeField::convertToUserTimeZone(date('Y-m-d H:i:s'));
            if (strtotime($nowDateArray->format('H:i')) >= $strToTime) {
                $timeToSchedule = strtotime('+ 1 day ' . $scheduledTime);
            } else {
                $timeToSchedule = $strToTime;
            }
            return date('Y-m-d H:i:s', $timeToSchedule);
        }
        if($scheduleType == ITS4YouScheduledReport::$SCHEDULED_WEEKLY) {
            $weekDays = array('0'=>'Sunday','1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday');

            if(date('w',time()) == $scheduledDayOfWeek) {
                return date('Y-m-d H:i:s',strtotime('+1 week '.$scheduledTime));
            } else {
                return date('Y-m-d H:i:s',strtotime($weekDays[$scheduledDayOfWeek].' '.$scheduledTime));
            }
        }
        if($scheduleType == ITS4YouScheduledReport::$SCHEDULED_BIWEEKLY) {
            $weekDays = array('0'=>'Sunday','1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday');
            if(date('w',time()) == $scheduledDayOfWeek) {
                return date('Y-m-d H:i:s',strtotime('+2 weeks '.$scheduledTime));
            } else {
                return date('Y-m-d H:i:s',strtotime($weekDays[$scheduledDayOfWeek].' '.$scheduledTime));
            }
        }
        if($scheduleType == ITS4YouScheduledReport::$SCHEDULED_MONTHLY) {
            $currentTime = time();
            $currentDayOfMonth = date('j',$currentTime);

            if($scheduledDayOfMonth == $currentDayOfMonth) {
                return date('Y-m-d H:i:s',strtotime('+1 month '.$scheduledTime));
            } else {
                $monthInFullText = date('F',$currentTime);
                $yearFullNumeric = date('Y',$currentTime);
                if($scheduledDayOfMonth < $currentDayOfMonth) {
                    $nextMonth = date('Y-m-d H:i:s',strtotime('next month'));
                    $monthInFullText = date('F',strtotime($nextMonth));
                    $yearFullNumeric = date('Y',strtotime($nextMonth));
                }
                return date('Y-m-d H:i:s',strtotime($scheduledDayOfMonth.' '.$monthInFullText.' '.$yearFullNumeric.' '.$scheduledTime));
            }
        }
        if($scheduleType == ITS4YouScheduledReport::$SCHEDULED_ANNUALLY) {
            $months = array(0=>'January',1=>'February',2=>'March',3=>'April',4=>'May',5=>'June',6=>'July',
                            7=>'August',8=>'September',9=>'October',10=>'November',11=>'December');
            $currentTime = time();
            $currentMonth = date('n',$currentTime);
            if(($scheduledMonth+1) == $currentMonth) {
                return date('Y-m-d H:i:s',strtotime('+1 year '.$scheduledTime));
            } else {
                $monthInFullText = $months[$scheduledMonth];
                $yearFullNumeric = date('Y',$currentTime);
                if(($scheduledMonth+1) < $currentMonth) {
                    $nextMonth = date('Y-m-d H:i:s',strtotime('next year'));
                    $yearFullNumeric = date('Y',strtotime($nextMonth));
                }
                return date('Y-m-d H:i:s',strtotime($scheduledDayOfMonth.' '.$monthInFullText.' '.$yearFullNumeric.' '.$scheduledTime));
            }
        }
    }

    public function updateNextTriggerTime() {
        $adb = $this->db;

        $currentTime = date('Y-m-d H:i:s');
        $scheduledInterval = $this->scheduledInterval;
        $nextTriggerTime = $this->getNextTriggerTime(); // Compute based on the frequency set

        ITS4YouReports_ITS4YouError_Log::createLog('Update nextTriggerTime {'.$this->id.'} to '.$nextTriggerTime);

        $adb->pquery('UPDATE  its4you_reports4you_scheduled_reports SET next_trigger_time=? WHERE reportid=?', array($nextTriggerTime, $this->id));
    }

    public static function generateRecipientOption($type, $value, $name='') {
        switch($type) {
            case 'users'	:	if(empty($name)) $name = getUserFullName($value);
                $optionName = 'User::'.addslashes(decode_html($name));
                $optionValue = 'users::'.$value;
                break;
            case 'groups'	:	if(empty($name)) {
                $groupInfo = getGroupName($value);
                $name = $groupInfo[0];
            }
                $optionName = 'Group::'.addslashes(decode_html($name));
                $optionValue = 'groups::'.$value;
                break;
            case 'roles'	:	if(empty($name)) $name = getRoleName ($value);
                $optionName = 'Roles::'.addslashes(decode_html($name));
                $optionValue = 'roles::'.$value;
                break;
            case 'rs'		:	if(empty($name)) $name = getRoleName ($value);
                $optionName = 'RoleAndSubordinates::'.addslashes(decode_html($name));
                $optionValue = 'rs::'.$value;
                break;
        }
        return '<option value="'.$optionValue.'">'.$optionName.'</option>';
    }

    public function getSelectedRecipientsHTML() {
        $selectedRecipientsHTML = '';
        if(!empty($this->scheduledRecipients)) {
            foreach($this->scheduledRecipients as $recipientType => $recipients) {
                foreach($recipients as $recipientId) {
                    $selectedRecipientsHTML .= ITS4YouScheduledReport::generateRecipientOption($recipientType, $recipientId);
                }
            }
        }
        return $selectedRecipientsHTML;
    }

    public static function getAvailableUsersHTML() {
        $userDetails = getAllUserName();
        $usersHTML = '<select id="availableRecipients" name="availableRecipients" multiple size="6" class="crmFormList" style="width:100%;">';
        foreach($userDetails as $userId=>$userName) {
            $usersHTML .= ITS4YouScheduledReport::generateRecipientOption('users', $userId, $userName);
        }
        $usersHTML .= '</select>';
        return $usersHTML;
    }

    public static function getAvailableGroupsHTML() {
        $grpDetails = getAllGroupName();
        $groupsHTML = '<select id="availableRecipients" name="availableRecipients" multiple size="6" class="crmFormList" style="width:100%;">';
        foreach($grpDetails as $groupId=>$groupName) {
            $groupsHTML .= ITS4YouScheduledReport::generateRecipientOption('groups', $groupId, $groupName);
        }
        $groupsHTML .= '</select>';
        return $groupsHTML;
    }

    public static function getAvailableRolesHTML() {
        $roleDetails = getAllRoleDetails();
        $rolesHTML = '<select id="availableRecipients" name="availableRecipients" multiple size="6" class="crmFormList" style="width:100%;">';
        foreach($roleDetails as $roleId=>$roleInfo) {
            $rolesHTML .= ITS4YouScheduledReport::generateRecipientOption('roles', $roleId, $roleInfo[0]);
        }
        $rolesHTML .= '</select>';
        return $rolesHTML;
    }

    public static function getAvailableRolesAndSubordinatesHTML() {
        $roleDetails = getAllRoleDetails();
        $rolesAndSubHTML = '<select id="availableRecipients" name="availableRecipients" multiple size="6" class="crmFormList" style="width:100%;">';
        foreach($roleDetails as $roleId=>$roleInfo) {
            $rolesAndSubHTML .= ITS4YouScheduledReport::generateRecipientOption('rs', $roleId, $roleInfo[0]);
        }
        $rolesAndSubHTML .= '</select>';
        return $rolesAndSubHTML;
    }

    public static function getScheduledReports($user) {

        $adb = PearDatabase::getInstance();

        $default_timezone = vglobal('default_timezone');

        $adminTimeZone = $user->time_zone;
        @date_default_timezone_set($adminTimeZone);
        $currentTime = date('Y-m-d H:i:s');
        @date_default_timezone_set($default_timezone);

//$adb->setDebug(true);
        /** PRODUCTIVE SCHEDULING CODE PART !!!
         **/
        $result = $adb->pquery('SELECT * FROM  its4you_reports4you_scheduled_reports
                                        INNER JOIN its4you_reports4you ON its4you_reports4you.reports4youid=its4you_reports4you_scheduled_reports.reportid AND deleted=0 AND is_active=1 
                                        INNER JOIN its4you_reports4you_settings ON its4you_reports4you_settings.reportid = its4you_reports4you.reports4youid
                                        WHERE next_trigger_time IS NULL || next_trigger_time <= ?', array($currentTime));

        /** DEV SCHEDULING CODE PART !!! * /
        $customQry = ' AND its4you_reports4you.reports4youid=9144';
        $result = $adb->pquery("SELECT * FROM  its4you_reports4you_scheduled_reports
        INNER JOIN its4you_reports4you ON its4you_reports4you.reports4youid=its4you_reports4you_scheduled_reports.reportid AND deleted=0 AND is_active=1
        INNER JOIN its4you_reports4you_settings ON its4you_reports4you_settings.reportid = its4you_reports4you.reports4youid
        WHERE 1 $customQry", array());
        // */
//$adb->setDebug(false);
        $scheduledReports = array();
        $noOfScheduledReports = $adb->num_rows($result);
        for($i=0; $i<$noOfScheduledReports; ++$i) {
            $reportScheduleInfo = $adb->raw_query_result_rowdata($result, $i);

            $scheduledInterval = (!empty($reportScheduleInfo['schedule']))?Zend_Json::decode($reportScheduleInfo['schedule']):array();
            $scheduledRecipients = (!empty($reportScheduleInfo['recipients']))?Zend_Json::decode($reportScheduleInfo['recipients']):array();

            $ITS4YouScheduledReport = new ITS4YouScheduledReport($adb);
            $ITS4YouScheduledReport->id = $reportScheduleInfo['reportid'];
            $ITS4YouScheduledReport->isScheduled = true;
            $ITS4YouScheduledReport->scheduledFormat = $reportScheduleInfo['format'];
            $ITS4YouScheduledReport->scheduledInterval = $scheduledInterval;
            $ITS4YouScheduledReport->scheduledRecipients = $scheduledRecipients;
            $ITS4YouScheduledReport->scheduledTime = $reportScheduleInfo['next_trigger_time'];
            $ITS4YouScheduledReport->owner = $reportScheduleInfo['owner'];

            $ITS4YouScheduledReport->generate_other = $reportScheduleInfo['generate_other'];
            $ITS4YouScheduledReport->generate_subject = $reportScheduleInfo['generate_subject'];
            $ITS4YouScheduledReport->generate_text = $reportScheduleInfo['generate_text'];
            $ITS4YouScheduledReport->schedule_all_records = $reportScheduleInfo['schedule_all_records'];
            $ITS4YouScheduledReport->schedule_skip_empty = $reportScheduleInfo['schedule_skip_empty'];
            $ITS4YouScheduledReport->csvPath = $ITS4YouScheduledReport->getCsvPath();
            $ITS4YouScheduledReport->csvName = $ITS4YouScheduledReport->getCsvName();
            $ITS4YouScheduledReport->csvSeparator = $ITS4YouScheduledReport->getCsvSeparator();

            $scheduledReports[] = $ITS4YouScheduledReport;
        }

        return $scheduledReports;
    }

    public function getScheduledReportsOnRequest()
    {
        return ITS4YouReports_CronExport_Model::getAll();
    }

    public static function sendScheduledReportsOnRequest()
    {
        $adb = PearDatabase::getInstance();
        $scheduledReport = new self($adb);
        $scheduledReportsOnRequest = $scheduledReport->getScheduledReportsOnRequest();

        foreach ($scheduledReportsOnRequest as $userId => $rows) {
            foreach ($rows as $reportId => $formats) {
                if (empty($formats)) {
                    continue;
                }

                array_walk($formats, 'lower_array');

                $requestScheduledReport = new self($adb, $reportId);
                $requestScheduledReport->onRequest = TRUE;
                $requestScheduledReport->schedule_all_records = TRUE;
                $requestScheduledReport->id = $reportId;
                $requestScheduledReport->scheduledFormat = implode(';', $formats);

                if($requestScheduledReport->checkUserActivity($userId)){
                    global $current_user;
                    $requestScheduledReport->setGenerateForUser($userId);
                    $requestScheduledReport->getnerateForUser = TRUE;

                    $requestScheduledReport->sendEmail($current_user);
                    ITS4YouReports_CronExport_Model::updateStatusDone($reportId, $userId);
                    $current_user = null;
                }
            }
        }
    }

    protected static function isActiveUser($userId)
    {
        $adb = PearDatabase::getInstance();

        $activeUser = $adb->run_query_record(
            sprintf(
                '
            SELECT id
            FROM vtiger_users 
            WHERE status = "Active" AND id=%s
        '
                ,
                intval($userId)
            )
        );

        return !empty($activeUser);
    }

    public static function removeInActiveUsersFromScheduling()
    {
        $adb = PearDatabase::getInstance();

        $all = $adb->run_query_allrecords('
            SELECT reportid, recipients
            FROM its4you_reports4you_scheduled_reports
        ');

        foreach ($all as $item) {
            $update = false;
            $newRecipientUsers = [];
            $id = $item['reportid'];
            $recipients = json_decode($item['recipients'], true);

            if (!empty($recipients) && !empty($recipients['users'])) {
                foreach ($recipients['users'] as $userId) {
                    if (self::isActiveUser($userId)) {
                        $newRecipientUsers[] = $userId;
                    }
                }

                if ($recipients['users'] !== $newRecipientUsers) {
                    $recipients['users'] = $newRecipientUsers;
                    $update = true;
                }
            }

            if ($update) {
                $adb->pquery('UPDATE its4you_reports4you_scheduled_reports 
                                SET recipients=? 
                                WHERE reportid=?', [
                    json_encode($recipients),
                    $id
                ]);
            }
        }
    }

    public static function sendScheduledReports()
    {
        require_once 'modules/com_vtiger_workflow/VTWorkflowUtils.php';
        global $default_timezone, $current_user;
        $util = new VTWorkflowUtils();
        $adminUser = $util->adminUser();
        $current_user = $adminUser;
        self::removeInActiveUsersFromScheduling();

        $scheduledReports = self::getScheduledReports($adminUser);
        $util->revertUser();

        if(!empty($scheduledReports)){
            foreach($scheduledReports as $scheduledReport) {
                $reportId = $scheduledReport->id;
                ITS4YouReports_ITS4YouError_Log::createLog('Start {'.$reportId.'}');
                $ReportOwnerUser = ITS4YouReports::getReports4YouOwnerUser($scheduledReport->owner);
                $adminTimeZone = $adminUser->time_zone;
                @date_default_timezone_set($adminTimeZone);
                $scheduledReport->updateNextTriggerTime();
                @date_default_timezone_set($default_timezone);
                // generate for scheduler users based on owner user
                ITS4YouReports_ITS4YouError_Log::createLog('sendEmail start {'.$reportId.'}');
                $scheduledReport->sendEmail($ReportOwnerUser);
                ITS4YouReports_ITS4YouError_Log::createLog('sendEmail end {'.$reportId.'}');
                // generate for users based on generate for users
                $scheduledReport->sendGenerateForEmail();
                ITS4YouReports_ITS4YouError_Log::createLog('End {'.$reportId.'}');
                $ReportOwnerUser = ITS4YouReports::revertSchedulerUser();
            }
        }
    }

    public static function runScheduledReports($adb) {
        self::sendScheduledReports();
        self::sendScheduledReportsOnRequest();
    }

    function generate_cool_url($nazov){
        //$nazov=trim(strtolower(stripslashes($nazov)));
        //$Search = array(" - ","/"," ",",","Äľ","Ĺˇ","ÄŤ","ĹĄ","Ĺľ","Ă˝","Ăˇ","Ă­","Ă©","Ăł","Ă¶","Ăş","ĂĽ","Ă¤","Ĺ","ÄŹ","Ă´","Ĺ•","Ä˝","Ĺ ","ÄŚ","Ĺ¤","Ĺ˝","Ăť","Ă","ĂŤ","Ă‰","Ă“","Ăš","ÄŽ","\"","Â°");
        $nazov=trim(stripslashes($nazov));
        $Search = array(" - ","/",",","Äľ","Ĺˇ","ÄŤ","ĹĄ","Ĺľ","Ă˝","Ăˇ","Ă­","Ă©","Ăł","Ă¶","Ăş","ĂĽ","Ă¤","Ĺ","ÄŹ","Ă´","Ĺ•","Ä˝","Ĺ ","ÄŚ","Ĺ¤","Ĺ˝","Ăť","Ă","ĂŤ","Ă‰","Ă“","Ăš","ÄŽ","\"","Â°");
        $Replace = array("-","-","-","l","s","c","t","z","y","a","i","e","o","o","u","u","a","n","d","o","r","l","s","c","t","z","y","a","i","e","o","u","d","","");
        $return=str_replace($Search, $Replace, $nazov);
        // echo $return;
        return $return;
    }

    /**
     * @param $csvPath
     *
     * @return string
     */
    public static function prepareCsvPath($csvPath)
    {
        $csvPath = trim(strip_tags(html_entity_decode($csvPath)), '/');

        if (!is_dir($csvPath)) {
            mkdir($csvPath, 0755, true);
        }

        return $csvPath;
    }

}

?>
