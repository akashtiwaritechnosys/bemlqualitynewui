<?php
class Accounts_AccountsExternalAppSync_Action extends Vtiger_IndexAjax_View {
	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array('module_parameter' => 'module', 'action' => 'Export');
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		$response = new Vtiger_Response();
		$currentUser = Users_Record_Model::getCurrentUserModel();
		if ($currentUser->isAdminUser()) {
			global $adb;
			$xml = file_get_contents("http://10.80.2.84/phprfcbeml/sapclasses/examples/getAllCustomers.php");
			$xml = json_decode($xml);
			foreach ($xml as $key => $value) {
				$sapRefNum = trim($value->{'KUNNR'});
				$sql = 'select accountid from vtiger_account where external_app_num = ?';
				$sqlResult = $adb->pquery($sql, array($sapRefNum));
				$num_rows = $adb->num_rows($sqlResult);
				if ($num_rows > 0) {
					$dataRow = $adb->fetchByAssoc($sqlResult, 0);
					$recordModel = Vtiger_Record_Model::getInstanceById($dataRow['accountid'], 'Accounts');
					$recordModel->set('mode', 'edit');
					$recordModel->set('accountname', $value->{'NAME1'});
					$recordModel->set('bill_city', $value->{'ORT01'});
					$recordModel->set('email1', $value->{'SMTP_ADDR'});
					$recordModel->set('phone', $value->{'TELF1'});
					$recordModel->save();
				} else {
					$focus = CRMEntity::getInstance('Accounts');
					$focus->column_fields['accountname'] = $value->{'NAME1'};
					$focus->column_fields['bill_city'] = $value->{'ORT01'};
					$focus->column_fields['external_app_num'] = $sapRefNum;
					$focus->column_fields['email1'] = $value->{'SMTP_ADDR'};
					$focus->column_fields['phone'] = $value->{'TELF1'};
					$focus->save("Accounts");
				}
			}
		} else {
			$response->setError("External App Sync Not Allowed");
			$response->emit();
		}
	}
}
