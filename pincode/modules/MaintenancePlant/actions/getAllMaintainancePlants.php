<?php
class MaintenancePlant_getAllMaintainancePlants_Action extends Vtiger_IndexAjax_View {
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		global $adb;
		$response = new Vtiger_Response();
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		if ($currentUserModel->isAdminUser()) {
			$xml = file_get_contents("http://10.80.2.84/phprfcbeml/sapclasses/examples/getAllPlants.php");
			$xml = json_decode($xml);
			foreach ($xml as $key => $value) {
				$sapRefNum = trim($value->{'WERKS'});
				$sql = 'select maintenanceplantid from vtiger_maintenanceplant where plant_code = ?';
				$sqlResult = $adb->pquery($sql, array($sapRefNum));
				$num_rows = $adb->num_rows($sqlResult);
				if ($num_rows > 0) {
					$dataRow = $adb->fetchByAssoc($sqlResult, 0);
					$recordModel = Vtiger_Record_Model::getInstanceById($dataRow['maintenanceplantid'], 'MaintenancePlant');
					$recordModel->set('mode', 'edit');
					$plantName = trim($value->{'NAME1'});
					$recordModel->set('plant_name', $plantName);

					// implement plant group sharing
					if (!empty($plantName)) {
						$sql = "select groupid from vtiger_groups where groupname = ? ";
						$result = $adb->pquery($sql, array($plantName));
						$dataRow = $adb->fetchByAssoc($result, 0);
						if (empty($dataRow['groupid'])) {
						} else {
							$recordModel->set('assigned_user_id', $dataRow['groupid']);
						}
					}
					$recordModel->save();
				} else {
					$focus = CRMEntity::getInstance('MaintenancePlant');
					$plantName = trim($value->{'NAME1'});
					$focus->column_fields['plant_name'] = $plantName;
					$focus->column_fields['plant_code'] = $value->{'WERKS'};
					// implement plant group sharing
					if (!empty($plantName)) {
						$sql = "select groupid from vtiger_groups where groupname = ? ";
						$result = $adb->pquery($sql, array($plantName));
						$dataRow = $adb->fetchByAssoc($result, 0);
						if (empty($dataRow['groupid'])) {
						} else {
							$focus->column_fields['assigned_user_id'] = $dataRow['groupid'];
						}
					}
					$focus->save("MaintenancePlant");
				}
			}
		} else {
			$response->setError("External App Sync Not Allowed");
			$response->emit();
		}
	}
}
