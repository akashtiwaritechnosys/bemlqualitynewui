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

class ITS4YouReports_GetReportsHtml_Dashboard extends Vtiger_IndexAjax_View {

    function getSearchParams($value,$assignedto,$dates) {
        $listSearchParams = array();
        $conditions = array(array('leadstatus','e',$value));
        if($assignedto != '') array_push($conditions,array('assigned_user_id','e',getUserFullName($assignedto)));
        if(!empty($dates)){
            array_push($conditions,array('createdtime','bw',$dates['start'].' 00:00:00,'.$dates['end'].' 23:59:59'));
        }
        $listSearchParams[] = $conditions;
        return '&search_params='. json_encode($listSearchParams);
    }

    public function process(Vtiger_Request $request) {
//        self::processV7($request);
        $layout = Vtiger_Viewer::getDefaultLayoutName();

        if($layout == "v7"){
            self::processV7($request);
        } else {
            self::processV6($request);
        }
    }

    public function processV6(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $viewer = $this->getViewer($request);
        $layout = Vtiger_Viewer::getDefaultLayoutName();

        $moduleName = $request->get('module');

        $recordId = $request->get("record");
        $viewer->assign('recordid', $recordId);

        $linkId = $request->get('linkid');
        $data = $request->get('data');

        $createdTime = $request->get('createdtime');

        //Date conversion from user to database format
        if(!empty($createdTime)) {
            $dates['start'] = Vtiger_Date_UIType::getDBInsertedValue($createdTime['start']);
            $dates['end'] = Vtiger_Date_UIType::getDBInsertedValue($createdTime['end']);
        }

        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

        $recordModel = ITS4YouReports_Record_Model::getInstanceById($recordId);

        $data = $moduleModel->getReports4You($recordId,$request->get('smownerid'),$dates);

        $detailViewUrl = 'index.php?module=ITS4YouReports&view=Detail&record='.$recordId;
        $viewer->assign('detailViewUrl', $detailViewUrl);

        $widget = Vtiger_Widget_Model::getInstance($linkId, $currentUser->getId());
        $widget->set('title', $recordModel->getName());

        if($request->has('mode') && $request->get('mode')=='widget'){
            echo $data;
            die();
        }

        //Include special script and css needed for this widget
        $viewer->assign('WIDGET', $widget);
        $viewer->assign('MODULE_NAME', $moduleName);
        @ob_clean();
        if ('v7' === $layout) {
            if(is_array($data)){
                $data = "<script>
    jQuery( document ).ready(function() {
      jQuery('#reports4you_widget_$recordId').html('".vtranslate("LBL_NO_DATA_TO_DISPLAY", $moduleName)."');
    });
                </script>";
            }
        }

        // ITS4YOU-CR SlOl 9. 3. 2016 15:57:34
        $Rmodule = '';
        if ('v7' === $layout) {
            $widgetSearchBy = ITS4YouReports::getWidgetSearchArray($recordId);
            if(!empty($widgetSearchBy)){
                if(isset($recordModel->report->primarymodule)){
                    $Rmodule = $recordModel->report->primarymodule;
                }
                if(isset($widgetSearchBy["primary_search"]) && $widgetSearchBy["primary_search"]!=""){
                    $primary_search = $widgetSearchBy["primary_search"];
                    $viewer->assign('primary_search', $primary_search);
                    $primary_search_array = $widgetSearchBy["primary_search_values"];
                    $viewer->assign('primary_values', $primary_search_array["picklistValues"]);
                    $viewer->assign('primary_selected', $primary_search_array["valueArr"]);
                    $primary_label = ITS4YouReports::getColumnStr_Label($primary_search);
                    $viewer->assign('primary_label', $primary_label);
                }
            }
        }
        $viewer->assign('LModule', $Rmodule);
        // ITS4YOU-END

        if ('v7' !== $layout) {
            $viewer->assign('DATA', $data[0]);
        } else {
            $viewer->assign('DATA', $data);
        }

        $viewer->assign('CURRENTUSER', $currentUser);

        $accessibleUsers = $currentUser->getAccessibleUsersForModule('Leads');
        $viewer->assign('ACCESSIBLE_USERS', $accessibleUsers);

        $viewer->assign('SETTING_EXIST', false);

        $content = $request->get('content');
        if(!empty($content)) {
            $display_widget_header = false;
        }else{
            $display_widget_header = true;
        }
        $viewer->assign('display_widget_header', $display_widget_header);

        $viewer->view('dashboards/DashBoardWidgetContents.tpl', $moduleName);
    }

    public function processV7(Vtiger_Request $request) {
        $currentUser = Users_Record_Model::getCurrentUserModel();
        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();
        $layout = Vtiger_Viewer::getDefaultLayoutName();

        $recordId = $request->get("record");
        $viewer->assign('recordid', $recordId);

        $linkId = $request->get('linkid');
        $dates = [];
//        $data = $request->get('data');

        if ($request->has('tab')) {
            $tabId = $request->get('tab');
        }

//        $createdTime = $request->get('createdtime');

        //Date conversion from user to database format
//        if(!empty($createdTime)) {
//            $dates['start'] = Vtiger_Date_UIType::getDBInsertedValue($createdTime['start']);
//            $dates['end'] = Vtiger_Date_UIType::getDBInsertedValue($createdTime['end']);
//        }

//        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);

        $recordModel = ITS4YouReports_Record_Model::getInstanceById($recordId);
        $ITS4YouReports = new ITS4YouReports(true, $recordId);
        $generate = new GenerateObj($ITS4YouReports,"",false,true);
        $r_permitted = $generate->report_obj->CheckReportPermissions($generate->report_obj->primarymodule, $generate->report_obj->record, $die_due);

        if ($r_permitted) {
//            $generate->create_pdf_schedule = true;
            $reportHtmlData = $generate->generateReport($this->id, "HTML", false);
            $data = $reportHtmlData[0];
        }

//        $data = $moduleModel->getReports4You($recordId, $request->get('smownerid'), $dates);

        $detailViewUrl = 'index.php?module=ITS4YouReports&view=Detail&record='.$recordId;
        $viewer->assign('detailViewUrl', $detailViewUrl);

        $widget = Vtiger_Widget_Model::getInstance($linkId, $currentUser->getId());
        $widget->set('title', $recordModel->getName());
        $widget->set('tabid', $tabId);

        //Include special script and css needed for this widget
        $viewer->assign('WIDGET', $widget);
        $viewer->assign('MODULE_NAME', $moduleName);
        $viewer->assign('REPORT_MODEL', $recordModel);

        $viewer->assign('DATA', $data);
        $viewer->assign('CURRENTUSER', $currentUser);

        $accessibleUsers = $currentUser->getAccessibleUsersForModule('Leads');
        $viewer->assign('ACCESSIBLE_USERS', $accessibleUsers);

        $viewer->assign('SETTING_EXIST', false);

        $content = $request->get('content');
        if(!empty($content)) {
            $display_widget_header = false;
        }else{
            $display_widget_header = true;
        }
        $viewer->assign('display_widget_header', $display_widget_header);

        $viewer->view('dashboards/DashBoardWidgetHtml.tpl', $moduleName);

    }

}
