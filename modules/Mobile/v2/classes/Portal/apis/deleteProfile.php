<?php

class Portal_deleteProfile_API extends Portal_Default_API {

	public function process(Portal_Request $request) {
		global $adb;
		$response = new Portal_Response();
		$contactId = Portal_Session::get('contact_id');

		$sql = 'select req_for_del from vtiger_contactdetails where contactid=?';
		$sqlResult = $adb->pquery($sql, array($contactId));
		$delRequest = $adb->query_result($sqlResult, 0, 'req_for_del');
		if ($delRequest == '1') {
			$response->setError(1501, 'Already Profile Delete Is requested');
			return $response;
		} else {
			$sql = 'update vtiger_contactdetails set req_for_del = 1 where contactid=?';
			$sqlResult = $adb->pquery($sql, array($contactId));
			$response->setApiSucessMessage('User Profile Is Marked For Delete Successfully');
			$response->setResult([]);
			return $response;
		}
	}
}
