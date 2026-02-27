<?php
class Mobile_WS_getEquipmentSelectionMessage extends Mobile_WS_Controller {

    function process(Mobile_API_Request $request) {
        $response = new Mobile_API_Response();
        $record = $request->get('record');
        $record = explode('x', $record);
        $record = $record[1];
        if (!empty($record) && isRecordExists($record)) {
            $equimentRecordModel = Vtiger_Record_Model::getInstanceById($record);
            $runningStatus = $equimentRecordModel->get('eq_run_war_st');
            $orgId = $equimentRecordModel->get('account_id');

            if (!empty($orgId) && isRecordExists($orgId)) {
                $orgRecordModel = Vtiger_Record_Model::getInstanceById($orgId);
                $chargableOutSideWarrnty = $orgRecordModel->get('chargeable_outside_war');
            }

            if ($chargableOutSideWarrnty == '1') {
                $chargableOutSideWarrntyText = 'Chargable Outside Warranty';
            } else {
                $chargableOutSideWarrntyText = 'Not Chargable Outside Warranty';
            }
            if ($runningStatus == 'Outside Warranty') {
                $ResponseObject = [];
                $ResponseObject['message'] = 'Equipment is Outside Warranty, Customer is ' . $chargableOutSideWarrntyText;
                $response->setResult($ResponseObject);
                $response->setApiSucessMessage('Successfully Fetched Data');
                return $response;
            } else {
                $ResponseObject = [];
                $ResponseObject['message'] = '';
                $response->setResult($ResponseObject);
                $response->setApiSucessMessage('Successfully Fetched Data');
                return $response;
            }
        } else {
            $ResponseObject = [];
            $ResponseObject['message'] = 'Record Does Not Exits';
            $response->setResult($ResponseObject);
            $response->setApiSucessMessage('Successfully Fetched Data');
            return $response;
        }
    }
}
