<?php

class Portal_RatingAndFeedBack_API extends Portal_Default_API {
	public function preProcess(Portal_Request $request) {
	}

	public function postProcess(Portal_Request $request) {
	}

    function process(Portal_Request $request) {
        global $adb;
		$_REQUEST['_operation'] = 'RatingAndFeedBack';
		$wholeRequest = array_merge($request->getAll(),$_REQUEST);
		$responseObject = Vtiger_Connector::getInstance()->fireRequest($wholeRequest);
		$response = new Portal_Response();
		if(isset($responseObject['code'])){
			$response->setError($responseObject['code'] , $responseObject['message']);
		} else {
			$response->setApiSucessMessage("Your Rating Is Updated Successfully");
			$response->setResult($responseObject);
		}
		return $response;
    }
}
