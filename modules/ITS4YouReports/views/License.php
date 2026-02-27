<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_License_View extends Vtiger_Index_View {

    function checkPermission(Vtiger_Request $request) {
            $currentUserModel = Users_Record_Model::getCurrentUserModel();
            if(!$currentUserModel->isAdminUser()) {
                    throw new AppException(vtranslate('LBL_PERMISSION_DENIED', 'Vtiger'));
            }
            
    }
    
    public function preProcess(Vtiger_Request $request, $display = true) {
        //$ITS4YouReports = new ITS4YouReports_ITS4YouReports_Model();

        $viewer = $this->getViewer($request);
        $moduleName = $request->getModule();
        
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        
        $viewer->assign('QUALIFIED_MODULE', $moduleName);
        Vtiger_Basic_View::preProcess($request, false);
        $viewer = $this->getViewer($request);

        $moduleName = $request->getModule();
        
        $linkParams = array('MODULE' => $moduleName, 'ACTION' => $request->get('view'));
        $linkModels = $moduleModel->getSideBarLinks($linkParams);
        $viewer->assign('QUICK_LINKS', $linkModels);
        
        $viewer->assign('CURRENT_USER_MODEL', Users_Record_Model::getCurrentUserModel());
        $viewer->assign('CURRENT_VIEW', $request->get('view'));
        
        if ($display) {
            $this->preProcessDisplay($request);
        } 
    }
    
    public function process(Vtiger_Request $request) {
        /*
        $adb = PearDatabase::getInstance();        
        $ITS4YouReports = new ITS4YouReports_ITS4YouReports_Model();
        $viewer = $this->getViewer($request);
        $mode = $request->get('mode');
        
        $viewer->assign("MODE", $mode);
        $viewer->assign("LICENSE", $ITS4YouReports->GetLicenseKey());
        $viewer->assign("VERSION_TYPE", $ITS4YouReports->GetVersionType()); 
        
        $viewer->view('License.tpl', 'ITS4YouReports');        
        */
        $s = "site_URL";

        $license = new ITS4YouReports_License_Action();
        $lic_res = $license->checkLicense();

        $company_details = Vtiger_CompanyDetails_Model::getInstanceById();

        $ITS4YouReports = new ITS4YouReports_ITS4YouReports_Model();

        $viewer = $this->getViewer($request);

        $mode = $request->get('mode');

        $viewer->assign("MODE", $mode);             

        $viewer->assign("ORGANIZATION", $company_details);
        
        $viewer->assign("URL", vglobal($s));

        $show_activate_license = 1;

        if ( substr($lic_res,2,1) < 2 && substr($lic_res,-4,4) == "prof" ) {
          $viewer->assign("LICENSE", $ITS4YouReports->GetLicenseKey());
          $show_activate_license = 0;
          $type = "reactivate";
        }elseif ( substr($lic_res,2,1) == 2 && substr($lic_res,-4,4) == "prof" ) {
          $type = "reinstall";
        }
        
        $viewer->assign("TYPE", $type);
        $viewer->assign("SHOW_ACTIVATE_LICENSE", $show_activate_license);
        $viewer->assign("VERSION_TYPE", $ITS4YouReports->GetVersionType());            

        $viewer->view('License.tpl', 'ITS4YouReports');  
    }
    
    /**
     * Function to get the list of Script models to be included
     * @param Vtiger_Request $request
     * @return <Array> - List of Vtiger_JsScript_Model instances
     */
    function getHeaderScripts(Vtiger_Request $request) {
            $headerScriptInstances = parent::getHeaderScripts($request);
            $moduleName = $request->getModule();

            $jsFileNames = array(
                    'modules.Vtiger.resources.List',
                    "modules.$moduleName.resources.List",
                    "modules.$moduleName.resources.License",
            );

            $jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
            $headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
            return $headerScriptInstances;
    }

}     