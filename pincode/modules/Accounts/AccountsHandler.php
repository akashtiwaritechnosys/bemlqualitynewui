<?php
require_once 'include/events/VTEventHandler.inc';
class AccountsHandler extends VTEventHandler {
	function handleEvent($eventName, $entityData) {
		global $adb;
		$modeid = $entityData->get('id');
		if ($eventName == 'vtiger.entity.beforesave') {
			$moduleName = $entityData->getModuleName();
			if ($moduleName == 'Contacts') {
				if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'con_approval_status' || isset($_REQUEST['con_approval_status'])) && $entityData->get('con_approval_status') == 'Rejected') {
					$modeid = $entityData->get('id');
					$result = $adb->pquery('SELECT rejection_reason FROM `vtiger_contactdetails` where contactid = ?', array($modeid));
					$rowData = $adb->fetchByAssoc($result, 0);
					if ($rowData) {
						$gstno = $rowData['rejection_reason'];
						if (empty($gstno)) {
							$response = new Vtiger_Response();
							$response->setEmitType(Vtiger_Response::$EMIT_JSON);
							$response->setError('Please Update the Rejection Reason');
							$response->emit();
							die();
						}
					}
				} else if ($entityData->get('con_approval_status') == 'Rejected' && $_REQUEST['action'] == 'Save' && empty($entityData->get('rejection_reason'))) {
					$exception = new DuplicateException(vtranslate('LBL_DUPLICATES_DETECTED'));
					$exception->setSpecialError('Please Update the Rejection Reason');
					throw $exception;
				} else if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'rejection_reason' || isset($_REQUEST['rejection_reason'])) && empty($entityData->get('rejection_reason'))) {
					$modeid = $entityData->get('id');
					$result = $adb->pquery('SELECT con_approval_status FROM `vtiger_contactdetails` where contactid = ?', array($modeid));
					$rowData = $adb->fetchByAssoc($result, 0);
					if ($rowData) {
						$gstno = $rowData['con_approval_status'];
						if ($gstno == 'Rejected') {
							$response = new Vtiger_Response();
							$response->setEmitType(Vtiger_Response::$EMIT_JSON);
							$response->setError('Please Change the Approval Status Befoe Making Rejection Reason Empty');
							$response->emit();
							die();
						}
					}
				}
			} else if ($moduleName == 'ServiceEngineer') {
				if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'approval_status' || isset($_REQUEST['approval_status'])) && $entityData->get('approval_status') == 'Rejected') {
					$modeid = $entityData->get('id');
					$result = $adb->pquery('SELECT rejection_reason FROM `vtiger_serviceengineer` where serviceengineerid = ?', array($modeid));
					$rowData = $adb->fetchByAssoc($result, 0);
					if ($rowData) {
						$gstno = $rowData['rejection_reason'];
						if (empty($gstno)) {
							$response = new Vtiger_Response();
							$response->setEmitType(Vtiger_Response::$EMIT_JSON);
							$response->setError('Please Update the Rejection Reason');
							$response->emit();
							die();
						}
					}
				} else if ($entityData->get('approval_status') == 'Rejected' && $_REQUEST['action'] == 'Save' && empty($entityData->get('rejection_reason'))) {
					$exception = new DuplicateException(vtranslate('LBL_DUPLICATES_DETECTED'));
					$exception->setSpecialError('Please Update the Rejection Reason');
					throw $exception;
				} else if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'rejection_reason' || isset($_REQUEST['rejection_reason'])) && empty($entityData->get('rejection_reason'))) {
					$modeid = $entityData->get('id');
					$result = $adb->pquery('SELECT approval_status FROM `vtiger_serviceengineer` where serviceengineerid = ?', array($modeid));
					$rowData = $adb->fetchByAssoc($result, 0);
					if ($rowData) {
						$gstno = $rowData['approval_status'];
						if ($gstno == 'Rejected') {
							$response = new Vtiger_Response();
							$response->setEmitType(Vtiger_Response::$EMIT_JSON);
							$response->setError('Please Change the Approval Status Befoe Making Rejection Reason Empty');
							$response->emit();
							die();
						}
					}
				}

				// After All The Role Confirmation This Will be Enabled
				// if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'approval_status' || isset($_REQUEST['approval_status'])) && $entityData->get('approval_status') == 'Accepted') {
				// 	$modeid = $entityData->get('id');
				// 	$result = $adb->pquery('SELECT sys_detect_role FROM `vtiger_serviceengineer` where serviceengineerid = ?', array($modeid));
				// 	$rowData = $adb->fetchByAssoc($result, 0);
				// 	if ($rowData) {
				// 		$systemDetectedRole = $rowData['sys_detect_role'];
				// 		if (empty($systemDetectedRole)) {
				// 			$response = new Vtiger_Response();
				// 			$response->setEmitType(Vtiger_Response::$EMIT_JSON);
				// 			$response->setError('Unable To Find Role Of This Employee');
				// 			$response->emit();
				// 			die();
				// 		}
				// 		$sql = "SELECT * FROM `vtiger_role` where rolename = ?";
				// 		$result = $adb->pquery($sql, array($systemDetectedRole));
				// 		$dataRow = $adb->fetchByAssoc($result, 0);
				// 		if (empty($dataRow['roleid'])) {
				// 			$response = new Vtiger_Response();
				// 			$response->setEmitType(Vtiger_Response::$EMIT_JSON);
				// 			$response->setError('Unable To Find Role Of This Employee');
				// 			$response->emit();
				// 			die();
				// 		}
				// 	}
				// } else if ($entityData->get('approval_status') == 'Accepted' && $_REQUEST['action'] == 'Save' && empty($entityData->get('sys_detect_role'))) {
				// 	$exception = new DuplicateException(vtranslate('LBL_DUPLICATES_DETECTED'));
				// 	$exception->setSpecialError('Unable To Find Role Of This Employee');
				// 	throw $exception;
				// }
			}  else if ($moduleName == 'HelpDesk') {
				$recordId = $entityData->get('equipment_id');
				$tiketType = $entityData->get('ticket_type');
				$fields = $this->getFieldsOfCategory($tiketType, $entityData->get('purpose'));
				if(in_array('hmr', $fields)){
					if (!empty($recordId)) {
						// handle HMR Funtionality
						$hmr = $entityData->get('hmr');
						if (empty($hmr)) {
							$hmr = 0;
						}
						$lastHMR = $this->getLastHMR($recordId);
						if(empty($modeid)){
							if ($lastHMR  > $hmr) {
								$exception = new DuplicateException('Current HMR Value Is Less Than Last HMR Value, Current HMR Value Is '.$lastHMR, 200);
								$exception->setModule($moduleName);
								$exception->setSpecialError('Current HMR Value Is Less Than Last HMR Value, Current HMR Value Is '.$lastHMR);
								throw $exception;
							}
						} else {
							if ($lastHMR  > $hmr) {
								$exception = new DuplicateException('Current HMR Value Is Less Than Last HMR Value, Current HMR Value Is '.$lastHMR, 200);
								$exception->setModule($moduleName);
								$exception->setSpecialError('Current HMR Value Is Less Than Last HMR Value, Current HMR Value Is '.$lastHMR);
								throw $exception;
							}
						}
					}
				}
				if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'tket_acc_status' || isset($_REQUEST['tket_acc_status'])) && $entityData->get('tket_acc_status') == 'Rejected') {
					$result = $adb->pquery('SELECT rejection_reason FROM `vtiger_serviceengineer` where serviceengineerid = ?', array($modeid));
					$rowData = $adb->fetchByAssoc($result, 0);
					if ($rowData) {
						$gstno = $rowData['rejection_reason'];
						if (empty($gstno)) {
							$response = new Vtiger_Response();
							$response->setEmitType(Vtiger_Response::$EMIT_JSON);
							$response->setError('Please Update the Rejection Reason');
							$response->emit();
							die();
						}
					}
				} else if ($entityData->get('tket_acc_status') == 'Rejected' && $_REQUEST['action'] == 'Save' && empty($entityData->get('rejection_reason'))) {
					$exception = new DuplicateException(vtranslate('LBL_DUPLICATES_DETECTED'));
					$exception->setSpecialError('Please Update the Rejection Reason');
					throw $exception;
				} else if ($_REQUEST['action'] == 'SaveAjax' && ($_REQUEST['field'] == 'rejection_reason' || isset($_REQUEST['rejection_reason'])) && empty($entityData->get('rejection_reason'))) {
					$modeid = $entityData->get('id');
					$result = $adb->pquery('SELECT tket_acc_status FROM `vtiger_troubletickets` where ticketid = ?', array($modeid));
					$rowData = $adb->fetchByAssoc($result, 0);
					if ($rowData) {
						$gstno = $rowData['tket_acc_status'];
						if ($gstno == 'Rejected') {
							$response = new Vtiger_Response();
							$response->setEmitType(Vtiger_Response::$EMIT_JSON);
							$response->setError('Please Change the Acceptence Status Befoe Making Rejection Reason Empty');
							$response->emit();
							die();
						}
					}
				}
			}
		}
	}
	function getLastHMR($recordId) {
        global $adb;
        $sql = 'select eq_last_hmr from vtiger_equipment where equipmentid = ?';
        $sqlResult = $adb->pquery($sql, array(trim($recordId)));
        $num_rows = $adb->num_rows($sqlResult);
        if($num_rows > 0){
			$dataRow = $adb->fetchByAssoc($sqlResult, 0);
			return (float)$dataRow['eq_last_hmr'];
        } else {
            return 0;
        }
    }

	function getFieldsOfCategory($type,$purposeValue){
		if($type == 'GENERAL INSPECTION'){
			$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('HelpDesk', 'purpose', 'ticketstatus');
			$type = $purposeValue;
		} else {
			$fieldDependeny = Vtiger_DependencyPicklist::getFieldsFitDependency('HelpDesk', 'ticket_type', 'ticketpriorities');
		}
		foreach($fieldDependeny['valuemapping'] as $valueMapping){
			if($valueMapping['sourcevalue'] == $type){
				return $valueMapping['targetvalues'];
			}
		}
	}
}
