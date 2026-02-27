<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/
require_once('modules/ITS4YouReports/GenerateObj.php');

class ITS4YouReports_CronExport_Action extends Vtiger_Action_Controller
{
    public function checkPermission(Vtiger_Request $request)
    {
    }

    function preProcess(Vtiger_Request $request)
    {
        return true;
    }

    function postProcess(Vtiger_Request $request)
    {
        return true;
    }

    public function process(Vtiger_Request $request)
    {
        global $current_user;

        $ITS4YouReports = new ITS4YouReports();

        $permitted = $ITS4YouReports->CheckReportPermissions('', $request->get('record'));

        if ($permitted) {
            $userId = $current_user->id;
            $reportId = $request->get('record');
            $type = '';

            switch ($request->get('mode')) {
                case 'ExportPDF':
                case 'GetPrintReport':
                    $type = 'PDF';
                    break;
                case 'GetXLS':
                    $type = 'XLS';
                    break;
            }

            ITS4YouReports_CronExport_Model::saveRequest($reportId, $userId, $type);

            $result = ['success' => true];
        } else {
            $result = [
                'success' => false,
                'message' => vtranslate('LBL_PERMISSION_DENIED', $request->getModule())
            ];
        }

        $response = new Vtiger_Response();
        try {
            $response->setResult($result);
        } catch (Exception $e) {
            $response->setError($e->getCode(), $e->getMessage());
        }
        $response->emit();
    }

}
