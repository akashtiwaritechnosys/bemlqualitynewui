<?php

class Equipment_getAllEquipment_Action extends Vtiger_IndexAjax_View {
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
			ini_set('max_execution_time', 0);
			require_once('modules/Equipment/Equipment.php');
			$xml = file_get_contents("http://10.80.2.84/phprfcbeml/sapclasses/examples/getAllEquipments.php");
			$xml = json_decode($xml);
			foreach ($xml as $key => $value) {
				$sapRefNum = trim($value->{'EQUNR'});
				$sql = 'select equipmentid from vtiger_equipment where equipment_sl_no = ?';
				$sqlResult = $adb->pquery($sql, array($sapRefNum));
				$num_rows = $adb->num_rows($sqlResult);
				if ($num_rows > 0) {
					$dataRow = $adb->fetchByAssoc($sqlResult, 0);
					$recordModel = Vtiger_Record_Model::getInstanceById($dataRow['equipmentid'], 'Equipment');
					$recordModel->set('mode', 'edit');
					$recordModel->set('equi_desc', $value->{'SHTXT'});
					$recordModel->set('eq_equip_status', $value->{'STTXT'});
					$recordModel->set('maintain_plant', $value->{'SWERK'});
					$recordModel->set('equip_model', $value->{'TYPBZ'});
					$sql = "select accountid from vtiger_account where external_app_num = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'KUND1'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['accountid'])) {
						$recordModel->set('account_id', '');
					} else {
						$recordModel->set('account_id', $dataRow['accountid']);
					}

					$sql = "select functionallocationsid from vtiger_functionallocations where functionallocation_name = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'TPLNR'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['functionallocationsid'])) {
						$recordModel->set('functional_loc', '');
					} else {
						$recordModel->set('functional_loc', $dataRow['functionallocationsid']);
					}

					$validfrom = $value->{'DATAB'};
					$y = substr($validfrom, 0, 4);
					$m = substr($validfrom, 4, 2);
					$d = substr($validfrom, 6, 2);
					$recordModel->set('eq_valid_from', $y . '-' . $m . '-' . $d);
					$validTo = $value->{'DATBI'};
					$y = substr($validTo, 0, 4);
					$m = substr($validTo, 4, 2);
					$d = substr($validTo, 6, 2);
					$recordModel->set('eq_valid_to', $y . '-' . $m . '-' . $d);

					$validfrom = $value->{'GWLDT'};
					$y = substr($validfrom, 0, 4);
					$m = substr($validfrom, 4, 2);
					$d = substr($validfrom, 6, 2);
					$recordModel->set('cust_begin_guar', $y . '-' . $m . '-' . $d);
					$validTo = $value->{'GWLEN'};
					$y = substr($validTo, 0, 4);
					$m = substr($validTo, 4, 2);
					$d = substr($validTo, 6, 2);
					$recordModel->set('cust_war_end', $y . '-' . $m . '-' . $d);

					$idate = $value->{'IDATE'};
					$y = substr($idate, 0, 4);
					$m = substr($idate, 4, 2);
					$d = substr($idate, 6, 2);
					$recordModel->set('last_hmr_date', $y . '-' . $m . '-' . $d);
					$recordModel->set('eq_last_hmr',trim($value->{'RECDV'}));
					$idate = $value->{'ITIME'};
					$y = substr($idate, 0, 2);
					$m = substr($idate, 2, 2);
					$d = substr($idate, 4, 2);
					$recordModel->set('last_hmr_time', $y . ':' . $m . ':' . $d);

					// implement plant
					$sql = "select maintenanceplantid,plant_name from vtiger_maintenanceplant where plant_code = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'SWERK'})));
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
					$focus = CRMEntity::getInstance('Equipment');
					$focus->column_fields['equipment_sl_no'] = trim($value->{'EQUNR'});
					$focus->column_fields['equi_desc'] = trim($value->{'SHTXT'});
					$focus->column_fields['eq_equip_status'] = trim($value->{'STTXT'});
					$focus->column_fields['maintain_plant'] = trim($value->{'SWERK'});
					$focus->column_fields['equip_model'] = trim($value->{'TYPBZ'});
					$sql = "select accountid from vtiger_account where external_app_num = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'KUND1'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['accountid'])) {
						$focus->column_fields['account_id']  = '';
					} else {
						$focus->column_fields['account_id']  = $dataRow['accountid'];
					}

					$sql = "select functionallocationsid from vtiger_functionallocations where functionallocation_name = ? ";
					$result = $adb->pquery($sql, array(trim($value->{'TPLNR'})));
					$dataRow = $adb->fetchByAssoc($result, 0);
					if (empty($dataRow['functionallocationsid'])) {
						$focus->column_fields['functional_loc']  = '';
					} else {
						$focus->column_fields['functional_loc']  = $dataRow['functionallocationsid'];
					}

					$validfrom = $value->{'GWLDT'};
					$y = substr($validfrom, 0, 4);
					$m = substr($validfrom, 4, 2);
					$d = substr($validfrom, 6, 2);
					$focus->column_fields['cust_begin_guar'] = $y . '-' . $m . '-' . $d;
					$validTo = $value->{'GWLEN'};
					$y = substr($validTo, 0, 4);
					$m = substr($validTo, 4, 2);
					$d = substr($validTo, 6, 2);
					$focus->column_fields['cust_war_end'] = $y . '-' . $m . '-' . $d;

					$validfrom = $value->{'DATAB'};
					$y = substr($validfrom, 0, 4);
					$m = substr($validfrom, 4, 2);
					$d = substr($validfrom, 6, 2);
					$focus->column_fields['eq_valid_from'] = $y . '-' . $m . '-' . $d;

					$validTo = $value->{'DATBI'};
					$y = substr($validTo, 0, 4);
					$m = substr($validTo, 4, 2);
					$d = substr($validTo, 6, 2);
					$focus->column_fields['eq_valid_to'] = $y . '-' . $m . '-' . $d;

					$idate = $value->{'IDATE'};
					$y = substr($idate, 0, 4);
					$m = substr($idate, 4, 2);
					$d = substr($idate, 6, 2);
					$focus->column_fields['last_hmr_date'] = $y . '-' . $m . '-' . $d;
					$focus->column_fields['eq_last_hmr'] = trim($value->{'RECDV'});
					$idate = $value->{'ITIME'};
					$y = substr($idate, 0, 2);
					$m = substr($idate, 2, 2);
					$d = substr($idate, 4, 2);
					$focus->column_fields['last_hmr_time'] = $y . ':' . $m . ':' . $d;

					$focus->column_fields['assigned_user_id'] = 1;
					$focus->save("Equipment");
				}
			}
		} else {
			$response->setError("External App Sync Not Allowed");
			$response->emit();
		}
	}
}
