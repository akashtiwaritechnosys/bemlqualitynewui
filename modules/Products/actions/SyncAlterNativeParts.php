<?php
class Products_SyncAlterNativeParts_Action extends Vtiger_IndexAjax_View {
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		ini_set('max_execution_time', 0);
		ini_set('default_socket_timeout', 9000);
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		if ($currentUserModel->isAdminUser()) {
			global $adb;
			include_once('include/utils/GeneralUtils.php');
			$url = getExternalAppURL('getAllMaterialAltMaster');
			
			$itiration = $request->get('indexForLink');

			$fireRequest = true;
			$requestUrl = $url . '&INDEX=' . $itiration;
			
			$xml = file_get_contents($requestUrl);
			$xml = json_decode($xml);
			if (empty($xml)) {
				$fireRequest = false;
			}
			foreach ($xml as $key => $value) {
				$insertSql = "INSERT INTO `vtiger_alternaiveparts` (`productname`, `alt_productname`)
				VALUES (?, ?)";
				$adb->pquery($insertSql, array(trim($value->{'MATWA'}), trim($value->{'SMATN'})));
			}
			$response = new Vtiger_Response();
			$response->setResult(array('success' => true, 'hasNext' => $fireRequest));
			$response->emit();
		} else {
			$response->setError("External App Sync Not Allowed");
			$response->emit();
		}
	}
}
