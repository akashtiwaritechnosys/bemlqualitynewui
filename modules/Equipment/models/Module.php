<?php

class Equipment_Module_Model extends Vtiger_Module_Model {
    public function getModuleBasicLinks() {
        $basicLinks = array();
        $importPermission = Users_Privileges_Model::isPermitted($this->getName(), 'Import');
			if($importPermission) {
				$basicLinks[] = array(
					'linktype' => 'BASIC',
					'linklabel' => 'LBL_IMPORT',
					'linkurl' => $this->getImportUrl(),
					'linkicon' => 'fa-download'
				);
			}
        return $basicLinks;
    }
	public function getEquipmentByStatusPercentage($owner, $dateFilter) {
		$db = PearDatabase::getInstance();
		$ownerSql = ''; //$this->getOwnerWhereConditionForDashBoards($owner);
		if (!empty($ownerSql)) {
			$ownerSql = ' AND ' . $ownerSql;
		}
		$params = array();
		if (!empty($dateFilter)) {
			$dateFilterSql = ' AND createdtime BETWEEN ? AND ? ';
			$params[] = $dateFilter['start'];
			$params[] = $dateFilter['end'];
		}
		$picklistvaluesmap = getAllPickListValues("eq_run_war_st");
		$anothrParams = $params;
		foreach ($picklistvaluesmap as $picklistValue) {
			$anothrParams[] = $picklistValue;
		}
		global $current_user;
		$nonAdminQueryPecent = Users_Privileges_Model::getNonAdminAccessControlQuery($this->getName(), $current_user, '');
		// $nonAdminQueryPecent = strstr($nonAdminQueryPecent," ");

		$sql = 'SELECT COUNT(*) as count
		FROM vtiger_equipment 
		INNER JOIN vtiger_crmentity 
		ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid and vtiger_crmentity.deleted=0 
		' .  $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
		' where  vtiger_equipment.eq_run_war_st in 
		(' . generateQuestionMarks($picklistvaluesmap) . ')';

		$result = $db->pquery($sql, $anothrParams);
		$dataRow = $db->fetchByAssoc($result, 0);
		$totalCount = 10;
		if (!empty($dataRow)) {
			$totalCount = $dataRow['count'];
		}

		$sql = 'SELECT COUNT(*) as count, CASE WHEN vtiger_equipment.eq_run_war_st IS NULL OR vtiger_equipment.eq_run_war_st = "" THEN "" ELSE vtiger_equipment.eq_run_war_st END AS statusvalue 
		FROM vtiger_equipment INNER JOIN vtiger_crmentity ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid AND vtiger_crmentity.deleted=0
		' . $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
		' INNER JOIN vtiger_eq_run_war_st ON vtiger_equipment.eq_run_war_st = vtiger_eq_run_war_st.eq_run_war_st 
		WHERE vtiger_equipment.eq_run_war_st IN (' . generateQuestionMarks($picklistvaluesmap) . ')
		GROUP BY statusvalue ORDER BY vtiger_eq_run_war_st.sortorderid';

		$result = $db->pquery($sql, $anothrParams);
		$availablePicklist = array();
		$statusObject = [];
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$statusObjectVal = [];
			$row = $db->query_result_rowdata($result, $i);
			$ticketStatusVal = $row['statusvalue'];
			if ($ticketStatusVal == '') {
				$ticketStatusVal = 'LBL_BLANK';
			}
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			$statusObjectVal['count'] = $row['count'];
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = ($row['count'] / $totalCount) * 100;
			}

			array_push($statusObject, $statusObjectVal);
			array_push($availablePicklist, $statusObjectVal['label']);
		}
		$notAvailable = array_diff($picklistvaluesmap, $availablePicklist);
		foreach ($notAvailable as $picklist) {
			$statusObjectVal = [];
			$ticketStatusVal = vtranslate($picklist, 'Equipment');
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = (0 / $totalCount) * 100;
			}
			$statusObjectVal['count'] = '0';
			array_push($statusObject, $statusObjectVal);
		}
		return $statusObject;
	}
	public function getEquipmentByStatusPercentageCustomer($owner, $dateFilter) {
		$db = PearDatabase::getInstance();
		$ownerSql = ''; //$this->getOwnerWhereConditionForDashBoards($owner);
		if (!empty($ownerSql)) {
			$ownerSql = ' AND ' . $ownerSql;
		}
		$params = array();
		if (!empty($dateFilter)) {
			$dateFilterSql = ' AND createdtime BETWEEN ? AND ? ';
			$params[] = $dateFilter['start'];
			$params[] = $dateFilter['end'];
		}
		$picklistvaluesmap = getAllPickListValues("eq_run_war_st");
		$anothrParams = $params;
		foreach ($picklistvaluesmap as $picklistValue) {
			$anothrParams[] = $picklistValue;
		}
		global $current_user;
		$nonAdminQueryPecent = Users_Privileges_Model::getNonAdminAccessControlQuery($this->getName(), $current_user, '');
		// $nonAdminQueryPecent = strstr($nonAdminQueryPecent," ");

		$sql = 'SELECT COUNT(*) as count
		FROM vtiger_equipment INNER JOIN vtiger_crmentity ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid where vtiger_crmentity.deleted=0 and vtiger_equipment.eq_run_war_st in (' . generateQuestionMarks($picklistvaluesmap) . ')
		' .  $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
		' ';

		$result = $db->pquery($sql, $anothrParams);
		$dataRow = $db->fetchByAssoc($result, 0);
		$totalCount = 0;
		if (!empty($dataRow)) {
			$totalCount = $dataRow['count'];
		}

		$sql = 'SELECT COUNT(*) as count, CASE WHEN vtiger_equipment.eq_run_war_st IS NULL OR vtiger_equipment.eq_run_war_st = "" THEN "" ELSE vtiger_equipment.eq_run_war_st END AS statusvalue 
		FROM vtiger_equipment INNER JOIN vtiger_crmentity ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid AND vtiger_crmentity.deleted=0
		' . $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
		' INNER JOIN vtiger_eq_run_war_st ON vtiger_equipment.eq_run_war_st = vtiger_eq_run_war_st.eq_run_war_st 
		WHERE vtiger_equipment.eq_run_war_st IN (' . generateQuestionMarks($picklistvaluesmap) . ')
		GROUP BY statusvalue ORDER BY vtiger_eq_run_war_st.sortorderid';

		$result = $db->pquery($sql, $anothrParams);
		$availablePicklist = array();
		$statusObject = [];
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$statusObjectVal = [];
			$row = $db->query_result_rowdata($result, $i);
			$ticketStatusVal = $row['statusvalue'];
			if ($ticketStatusVal == '') {
				$ticketStatusVal = 'LBL_BLANK';
			}
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			$statusObjectVal['count'] = $row['count'];
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = ($row['count'] / $totalCount) * 100;
			}

			array_push($statusObject, $statusObjectVal);
			array_push($availablePicklist, $statusObjectVal['label']);
		}
		$notAvailable = array_diff($picklistvaluesmap, $availablePicklist);
		foreach ($notAvailable as $picklist) {
			$statusObjectVal = [];
			$ticketStatusVal = vtranslate($picklist, 'Equipment');
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = (0 / $totalCount) * 100;
			}
			$statusObjectVal['count'] = '0';
			array_push($statusObject, $statusObjectVal);
		}
		return $statusObject;
	}

	public function getEquipmentByStatus($owner, $dateFilter) {
		$db = PearDatabase::getInstance();
		$ownerSql = ''; //$this->getOwnerWhereConditionForDashBoards($owner);
		if (!empty($ownerSql)) {
			$ownerSql = ' AND ' . $ownerSql;
		}
		$params = array();
		if (!empty($dateFilter)) {
			$dateFilterSql = ' AND createdtime BETWEEN ? AND ? ';
			$params[] = $dateFilter['start'];
			$params[] = $dateFilter['end'];
		}
		$picklistvaluesmap = getAllPickListValues("last_sr_status");
		$anothrParams = $params;
		foreach ($picklistvaluesmap as $picklistValue) {
			$anothrParams[] = $picklistValue;
		}
		global $current_user;
		$nonAdminQueryPecent = Users_Privileges_Model::getNonAdminAccessControlQuery($this->getName(), $current_user, '');
		// $nonAdminQueryPecent = strstr($nonAdminQueryPecent," ");

		$result = $db->pquery('SELECT COUNT(*) as count
			FROM vtiger_equipment 
			INNER JOIN vtiger_crmentity 
			ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid
			' .  $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
			' where vtiger_crmentity.deleted=0 
			and vtiger_equipment.last_sr_status in (' . generateQuestionMarks($picklistvaluesmap) . ') ', $anothrParams);
		$dataRow = $db->fetchByAssoc($result, 0);
		$totalCount = 0;
		if (!empty($dataRow)) {
			$totalCount = $dataRow['count'];
		}

		$result = $db->pquery('SELECT COUNT(*) as count, CASE WHEN vtiger_equipment.last_sr_status IS NULL OR vtiger_equipment.last_sr_status = "" THEN "" ELSE vtiger_equipment.last_sr_status END AS statusvalue 
			FROM vtiger_equipment INNER JOIN vtiger_crmentity ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid AND vtiger_crmentity.deleted=0
			' . $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
			' INNER JOIN vtiger_last_sr_status ON vtiger_equipment.last_sr_status = vtiger_last_sr_status.last_sr_status 
			WHERE vtiger_equipment.last_sr_status IN (' . generateQuestionMarks($picklistvaluesmap) . ')
			GROUP BY statusvalue ORDER BY vtiger_last_sr_status.sortorderid', $anothrParams);
		$availablePicklist = array();
		$statusObject = [];
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$statusObjectVal = [];
			$row = $db->query_result_rowdata($result, $i);
			$ticketStatusVal = $row['statusvalue'];
			if ($ticketStatusVal == '') {
				$ticketStatusVal = 'LBL_BLANK';
			}
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			$statusObjectVal['count'] = $row['count'];
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = ($row['count'] / $totalCount) * 100;
			}

			array_push($statusObject, $statusObjectVal);
			array_push($availablePicklist, $statusObjectVal['label']);
		}
		$notAvailable = array_diff($picklistvaluesmap, $availablePicklist);
		foreach ($notAvailable as $picklist) {
			$statusObjectVal = [];
			$ticketStatusVal = vtranslate($picklist, 'Equipment');
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = (0 / $totalCount) * 100;
			}
			$statusObjectVal['count'] = '0';
			array_push($statusObject, $statusObjectVal);
		}
		return $statusObject;
	}

	public function getEquipmentByStatusCustomers($owner, $dateFilter) {
		$db = PearDatabase::getInstance();
		$ownerSql = ''; //$this->getOwnerWhereConditionForDashBoards($owner);
		if (!empty($ownerSql)) {
			$ownerSql = ' AND ' . $ownerSql;
		}
		$params = array();
		if (!empty($dateFilter)) {
			$dateFilterSql = ' AND createdtime BETWEEN ? AND ? ';
			$params[] = $dateFilter['start'];
			$params[] = $dateFilter['end'];
		}
		$picklistvaluesmap = getAllPickListValues("last_sr_status");
		$anothrParams = $params;
		foreach ($picklistvaluesmap as $picklistValue) {
			$anothrParams[] = $picklistValue;
		}
		global $current_user;
		$nonAdminQueryPecent = Users_Privileges_Model::getNonAdminAccessControlQuery($this->getName(), $current_user, '');
		// $nonAdminQueryPecent = strstr($nonAdminQueryPecent," ");
		$result = $db->pquery('SELECT COUNT(*) as count
			FROM vtiger_equipment INNER JOIN vtiger_crmentity ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid where vtiger_crmentity.deleted=0 and vtiger_equipment.last_sr_status in (' . generateQuestionMarks($picklistvaluesmap) . ')
			' .  $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
			' ', $anothrParams);
		$dataRow = $db->fetchByAssoc($result, 0);
		$totalCount = 0;
		if (!empty($dataRow)) {
			$totalCount = $dataRow['count'];
		}

		$result = $db->pquery('SELECT COUNT(*) as count, CASE WHEN vtiger_equipment.last_sr_status IS NULL OR vtiger_equipment.last_sr_status = "" THEN "" ELSE vtiger_equipment.last_sr_status END AS statusvalue 
			FROM vtiger_equipment INNER JOIN vtiger_crmentity ON vtiger_equipment.equipmentid = vtiger_crmentity.crmid AND vtiger_crmentity.deleted=0
			' . $nonAdminQueryPecent . $ownerSql . ' ' . $dateFilterSql .
			' INNER JOIN vtiger_last_sr_status ON vtiger_equipment.last_sr_status = vtiger_last_sr_status.last_sr_status 
			WHERE vtiger_equipment.last_sr_status IN (' . generateQuestionMarks($picklistvaluesmap) . ')
			GROUP BY statusvalue ORDER BY vtiger_last_sr_status.sortorderid', $anothrParams);
		$availablePicklist = array();
		$statusObject = [];
		for ($i = 0; $i < $db->num_rows($result); $i++) {
			$statusObjectVal = [];
			$row = $db->query_result_rowdata($result, $i);
			$ticketStatusVal = $row['statusvalue'];
			if ($ticketStatusVal == '') {
				$ticketStatusVal = 'LBL_BLANK';
			}
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			$statusObjectVal['count'] = $row['count'];
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = ($row['count'] / $totalCount) * 100;
			}

			array_push($statusObject, $statusObjectVal);
			array_push($availablePicklist, $statusObjectVal['label']);
		}
		$notAvailable = array_diff($picklistvaluesmap, $availablePicklist);
		foreach ($notAvailable as $picklist) {
			$statusObjectVal = [];
			$ticketStatusVal = vtranslate($picklist, 'Equipment');
			$statusObjectVal['label'] = $ticketStatusVal;
			$ticketStatusVal = str_replace(' ', '_', $ticketStatusVal);
			$statusObjectVal['key'] = $ticketStatusVal;
			if ($totalCount == 0) {
				$statusObjectVal['percent'] = 0;
			} else {
				$statusObjectVal['percent'] = (0 / $totalCount) * 100;
			}
			$statusObjectVal['count'] = '0';
			array_push($statusObject, $statusObjectVal);
		}
		return $statusObject;
	}
}
