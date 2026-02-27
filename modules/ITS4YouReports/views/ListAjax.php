<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class ITS4YouReports_ListAjax_View extends Vtiger_List_View {

    function __construct() {
        parent::__construct();
        $this->exposeMethod('getListViewCount');
        $this->exposeMethod('getRecordsCount');
        $this->exposeMethod('getPageCount');
    }

    function preProcess(Vtiger_Request $request) {
        return true;
    }

    function postProcess(Vtiger_Request $request) {
        return true;
    }

    function process(Vtiger_Request $request) {
        $mode = $request->get('mode');
        if(!empty($mode)) {
            $this->invokeExposedMethod($mode, $request);
            return;
        }
    }

    /**
     * Function returns the number of records for the current filter
     * @param Vtiger_Request $request
     */
    function getRecordsCount(Vtiger_Request $request) {
        $moduleName = $request->getModule();
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $listViewModel = new ITS4YouReports_ListView_Model();
        $listViewModel->set('module', $moduleModel);
        $folderId = $request->get('viewname');
        if (empty($folderId) || $folderId == 'undefined') {
            $folderId = 'All';
        }
        $listViewModel->set('folderid', $folderId);

        $searchParams = $request->get('search_params');
        if (empty($searchParams)) {
            $searchParams = [];
        }
        $listViewModel->set("search_params", $searchParams);

        $pageNumber = $request->get('page');
        if (empty ($pageNumber)) {
            $pageNumber = '1';
        }
        $pagingModel = new Vtiger_Paging_Model();
        $pagingModel->set('page', $pageNumber);

        $listViewEntries = $listViewModel->getListViewEntries($pagingModel);
        $count = ITS4YouReports_Functions_Helper::count($listViewEntries);

        $result = array();
        $result['module'] = $moduleName;
        $result['viewname'] = 1;
        $result['count'] = $count;

        $response = new Vtiger_Response();
        $response->setEmitType(Vtiger_Response::$EMIT_JSON);
        $response->setResult($result);
        $response->emit();
    }

}
