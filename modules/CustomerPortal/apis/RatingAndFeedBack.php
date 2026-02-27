<?php

class CustomerPortal_RatingAndFeedBack extends CustomerPortal_API_Abstract {
    function process(CustomerPortal_API_Request $request) {
        $response = new CustomerPortal_API_Response();
        $module = $request->get('module');
        if (empty($module)) {
            $response->setError(100, "Module Is Missing");
            return $response;
        }
        $recordId = $request->get('record');
        if (empty($recordId)) {
            $response->setError(100, "recordId Is Missing");
            return $response;
        }
        if (strpos($recordId, 'x') == false) {
            $response->setError(100, 'RecordId Is Not Webservice Format');
            return $response;
        }
        $recordId = explode('x', $recordId);
        $recordId = $recordId[1];

        $fieldName = 'rating';
        if (empty($fieldName)) {
            $response->setError(100, "FieldName Is Missing");
            return $response;
        }
        $fieldValue = $request->get('rating');
        if (empty($fieldValue)) {
            $response->setError(100, "fieldValue Is Missing");
            return $response;
        }
        if (!isRecordExists($recordId)) {
            $response->setError(100, "Record You Are Trying To Update Is Does Not Exits");
            return $response;
        }
        global $current_user;
        $current_user = Users::getActiveAdminUser();
        $_SESSION["authenticated_user_id"] = $current_user->id;
        $recordModel = Vtiger_Record_Model::getInstanceById($recordId, $module);
        if (!empty($recordModel)) {
            $recordModel->set('mode', 'edit');
            $recordModel->set($fieldName, $fieldValue);
            $recordModel->save();
            $responseObject = [];
            $responseObject['message'] = 'Updated Successfully';
            $response->setResult($responseObject);
            return $response;
        } else {
            $response->setError(100, 'Not Able To Update');
            return $response;
        }
    }
}
