<?php
require_once('include/utils/GeneralUtils.php');
class ServiceEngineer_ReCalculateEngineerAssignement_Action extends Vtiger_IndexAjax_View {

	public function requiresPermission(\Vtiger_Request $request) {
		$permissions = parent::requiresPermission($request);
		$permissions[] = array(
			'module_parameter' => 'source_module',
			'action' => 'DetailView',
			'record_parameter' => 'record'
		);
		return $permissions;
	}

	public function process(Vtiger_Request $request) {
		global $adb;
		$response = new Vtiger_Response();
		$employeeList = $this->getAllApprovedEngineersList();
		foreach ($employeeList as $empKey => $empVal) {
			$relatedRecordIdList = $this->getAllRelatedList($empVal);
			foreach ($relatedRecordIdList as $relatedRecordId) {
				$anotherRelations = getAllAssociatedEquipmentsBasedSELInkedInEmployeeFunc($relatedRecordId);
				foreach ($anotherRelations as $anotherRelation) {
					$checkpresence = $adb->pquery("SELECT crmid FROM vtiger_crmentityrel WHERE
					crmid = ? AND module = ? AND relcrmid = ? AND relmodule = ?", array($empVal, 'ServiceEngineer', $anotherRelation, 'Equipment'));
					if ($checkpresence && $adb->num_rows($checkpresence))
						continue;
					$adb->pquery("INSERT INTO vtiger_crmentityrel(crmid, module, relcrmid, relmodule) VALUES(?,?,?,?)", array($empVal, 'ServiceEngineer', $anotherRelation, 'Equipment'));
				}
			}
		}

		$response->setResult(array('success' => true, 'message' => 'Successfuly Approved'));
		$response->emit();
	}

	function getAllRelatedList($empId) {
		global $adb;
		$sql = "SELECT crmid,relcrmid FROM vtiger_crmentityrel WHERE
				crmid = ? AND module = 'ServiceEngineer'  
				AND relmodule = 'FunctionalLocations'";
		$result = $adb->pquery($sql, array($empId));
		$recordIds = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($recordIds, $row['relcrmid']);
		}
		return $recordIds;
	}

	function getAllApprovedEngineersList() {
		global $adb;
		$sql = "SELECT serviceengineerid FROM `vtiger_serviceengineer`
		INNER JOIN vtiger_crmentity 
		on vtiger_crmentity.crmid = vtiger_serviceengineer.serviceengineerid
		WHERE vtiger_serviceengineer.approval_status = 'Accepted' 
		and vtiger_crmentity.deleted = 0";
		$result = $adb->pquery($sql, array());
		$recordIds = [];
		while ($row = $adb->fetch_array($result)) {
			array_push($recordIds, $row['serviceengineerid']);
		}
		return $recordIds;
	}
}
