<?php
class BankGuarantee_SyncAllBankGuarantee_Action extends Vtiger_IndexAjax_View {
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$currentUserModel = Users_Record_Model::getCurrentUserModel();
		if ($currentUserModel->isAdminUser()) {
			global $adb;
			$xml = file_get_contents("http://10.80.2.84/phprfcbeml/sapclasses/examples/getAllBankGuarantees.php");
			$xml = json_decode($xml);
			foreach ($xml as $key => $value) {
				$sapRefNum = trim($value->{'ZBG_NO'});
				$sql = 'select bankguaranteeid from vtiger_bankguarantee where zbg_no = ?';
				$sqlResult = $adb->pquery($sql, array($sapRefNum));
				$num_rows = $adb->num_rows($sqlResult);
				if ($num_rows > 0) {
					$dataRow = $adb->fetchByAssoc($sqlResult, 0);
					$recordModel = Vtiger_Record_Model::getInstanceById($dataRow['bankguaranteeid'], 'BankGuarantee');
					$focus = CRMEntity::getInstance('BankGuarantee');
					$recordModel->set('mode', 'edit');
					$recordModel->set('equipment_model', trim($value->{'ZBG_EQPTMODEL'}));
					$recordModel->set('zbg_no', $sapRefNum);
					$recordModel->set('bg_val', $value->{'ZBG_VALUE'});
					$recordModel->set('zbg_region', trim($value->{'ZBG_REGION'}));

					$validfrom = $value->{'ZBG_VALDTFROM'};
					$y = substr($validfrom, 0, 4);
					$m = substr($validfrom, 4, 2);
					$d = substr($validfrom, 6, 2);
					$recordModel->set('bg_valid_from', $y . '-' . $m . '-' . $d);

					$validTo = $value->{'ZBG_VALDTTO'};
					$y = substr($validTo, 0, 4);
					$m = substr($validTo, 4, 2);
					$d = substr($validTo, 6, 2);
					$recordModel->set('bg_valid_to', $y . '-' . $m . '-' . $d);

					$sql = "select equipmentid from vtiger_equipment where equipment_sl_no = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'ZBG_EQPTSLNO'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['equipmentid'])) {
						$recordModel->set('equipment_id', '');
					} else {
						$recordModel->set('equipment_id', $dataRow['equipmentid']);
					}

					$sql = "select accountid from vtiger_account where external_app_num = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'ZBG_CUSTCODE'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['accountid'])) {
						$recordModel->set('account_id', '');
					} else {
						$recordModel->set('account_id', $dataRow['accountid']);
					}

					$sql = "select maintenanceplantid,plant_name from vtiger_maintenanceplant where plant_code = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'ZBG_PLANTNO'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['maintenanceplantid'])) {
						$recordModel->set('plant_name', '');
					} else {
						$recordModel->set('plant_name', $dataRow['maintenanceplantid']);
						$plantName = $dataRow['plant_name'];
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
					$focus = CRMEntity::getInstance('BankGuarantee');
					$focus->column_fields['equipment_model'] = $value->{'ZBG_EQPTMODEL'};
					$sql = "select equipmentid from vtiger_equipment where equipment_sl_no = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'ZBG_EQPTSLNO'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['equipmentid'])) {
						$focus->column_fields['equipment_id'] = '';
					} else {
						$focus->column_fields['equipment_id'] =  $dataRow['equipmentid'];
					}
					$focus->column_fields['zbg_no'] = $sapRefNum;
					$focus->column_fields['bg_val'] = $value->{'ZBG_VALUE'};
					$focus->column_fields['zbg_region'] = $value->{'ZBG_REGION'};

					$validfrom = $value->{'ZBG_VALDTFROM'};
					$y = substr($validfrom, 0, 4);
					$m = substr($validfrom, 4, 2);
					$d = substr($validfrom, 6, 2);
					$focus->column_fields['bg_valid_from'] = $y . '-' . $m . '-' . $d;

					$validTo = $value->{'ZBG_VALDTTO'};
					$y = substr($validTo, 0, 4);
					$m = substr($validTo, 4, 2);
					$d = substr($validTo, 6, 2);
					$focus->column_fields['bg_valid_to'] = $y . '-' . $m . '-' . $d;

					$sql = "select accountid from vtiger_account where external_app_num = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'ZBG_CUSTCODE'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['accountid'])) {
						$focus->column_fields['account_id'] = '';
					} else {
						$focus->column_fields['account_id'] = $dataRow['accountid'];
					}

					$sql = "select maintenanceplantid,plant_name from vtiger_maintenanceplant where plant_code = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'ZBG_PLANTNO'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['maintenanceplantid'])) {
						$focus->column_fields['plant_name'] = '';
					} else {
						$focus->column_fields['plant_name'] = $dataRow['maintenanceplantid'];
						$plantName = $dataRow['plant_name'];
						$sql = "select groupid from vtiger_groups where groupname = ? ";
						$result = $adb->pquery($sql, array($plantName));
						$dataRow = $adb->fetchByAssoc($result, 0);
						if (empty($dataRow['groupid'])) {
						} else {
							$focus->column_fields['assigned_user_id'] = $dataRow['groupid'];
						}
					}
					$focus->save("BankGuarantee");
				}
			}
		} else {
			$response->setError("External App Sync Not Allowed");
			$response->emit();
		}
	}
}
