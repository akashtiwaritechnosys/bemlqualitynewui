<?php

class Portal_SRStatusPercent_API extends Portal_Default_API {
	public function process(Portal_Request $request) {
		$_REQUEST['_operation'] = 'SRStatusPercent';
		$wholeRequest = array_merge($request->getAll(),$_REQUEST);
		$data = Vtiger_Connector::getInstance()->fireRequest($wholeRequest);
		$response = new Portal_Response();
		$response->setResult($data);
		$response->setApiSucessMessage('Successfully Fetched Data');
		return $response;
	}
}
