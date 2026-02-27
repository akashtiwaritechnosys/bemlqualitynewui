<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/

class Accounts_ListView_Model extends Vtiger_ListView_Model {

	/**
	 * Function to get the list of Mass actions for the module
	 * @param <Array> $linkParams
	 * @return <Array> - Associative array of Link type to List of  Vtiger_Link_Model instances for Mass Actions
	 */
	public function getListViewMassActions($linkParams) {
		$massActionLinks = parent::getListViewMassActions($linkParams);

		$currentUserModel = Users_Privileges_Model::getCurrentUserPrivilegesModel();
		$emailModuleModel = Vtiger_Module_Model::getInstance('Emails');

		if ($currentUserModel->hasModulePermission($emailModuleModel->getId())) {
			$massActionLink = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_SEND_EMAIL',
				'linkurl' => 'javascript:Vtiger_List_Js.triggerSendEmail("index.php?module=' . $this->getModule()->getName() . '&view=MassActionAjax&mode=showComposeEmailForm&step=step1","Emails");',
				'linkicon' => ''
			);
			$massActionLinks['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}

		$SMSNotifierModuleModel = Vtiger_Module_Model::getInstance('SMSNotifier');
		if (!empty($SMSNotifierModuleModel) && $currentUserModel->hasModulePermission($SMSNotifierModuleModel->getId())) {
			$massActionLink = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_SEND_SMS',
				'linkurl' => 'javascript:Vtiger_List_Js.triggerSendSms("index.php?module=' . $this->getModule()->getName() . '&view=MassActionAjax&mode=showSendSMSForm","SMSNotifier");',
				'linkicon' => ''
			);
			$massActionLinks['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}

		$moduleModel = $this->getModule();
		if ($currentUserModel->hasModuleActionPermission($moduleModel->getId(), 'EditView')) {
			$massActionLink = array(
				'linktype' => 'LISTVIEWMASSACTION',
				'linklabel' => 'LBL_TRANSFER_OWNERSHIP',
				'linkurl' => 'javascript:Vtiger_List_Js.triggerTransferOwnership("index.php?module=' . $moduleModel->getName() . '&view=MassActionAjax&mode=transferOwnership")',
				'linkicon' => ''
			);
			$massActionLinks['LISTVIEWMASSACTION'][] = Vtiger_Link_Model::getInstanceFromValues($massActionLink);
		}

		return $massActionLinks;
	}

	/**
	 * Function to get the list of listview links for the module
	 * @param <Array> $linkParams
	 * @return <Array> - Associate array of Link Type to List of Vtiger_Link_Model instances
	 */
	function getListViewLinks($linkParams) {
		$links = parent::getListViewLinks($linkParams);

		$index = 0;
		foreach ($links['LISTVIEWBASIC'] as $link) {
			if ($link->linklabel == 'Send SMS') {
				unset($links['LISTVIEWBASIC'][$index]);
			}
			$index++;
		}
		return $links;
	}

	public function getListViewEntries($pagingModel) {
		$db = PearDatabase::getInstance();

		$moduleName = $this->getModule()->get('name');
		$moduleFocus = CRMEntity::getInstance($moduleName);
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$queryGenerator = $this->get('query_generator');
		$listViewContoller = $this->get('listview_controller');

		$searchParams = $this->get('search_params');
		if (empty($searchParams)) {
			$searchParams = array();
		}
		$glue = "";
		if (count($queryGenerator->getWhereFields()) > 0 && (count($searchParams)) > 0) {
			$glue = QueryGenerator::$AND;
		}
		$queryGenerator->parseAdvFilterList($searchParams, $glue);

		$searchKey = $this->get('search_key');
		$searchValue = $this->get('search_value');
		$operator = $this->get('operator');
		if (!empty($searchKey)) {
			$queryGenerator->addUserSearchConditions(array('search_field' => $searchKey, 'search_text' => $searchValue, 'operator' => $operator));
		}

		$orderBy = $this->getForSql('orderby');
		$sortOrder = $this->getForSql('sortorder');

		if (!empty($orderBy)) {
			$queryGenerator = $this->get('query_generator');
			$fieldModels = $queryGenerator->getModuleFields();
			$orderByFieldModel = $fieldModels[$orderBy];
			if ($orderByFieldModel && ($orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::REFERENCE_TYPE ||
				$orderByFieldModel->getFieldDataType() == Vtiger_Field_Model::OWNER_TYPE)) {
				$queryGenerator->addWhereField($orderBy);
			}
		}
		$listQuery = $this->getQuery();

		$sourceModule = $this->get('src_module');
		if (!empty($sourceModule)) {
			if (method_exists($moduleModel, 'getQueryByModuleField')) {
				$overrideQuery = $moduleModel->getQueryByModuleField($sourceModule, $this->get('src_field'), $this->get('src_record'), $listQuery, $this->get('relationId'));
				if (!empty($overrideQuery)) {
					$listQuery = $overrideQuery;
				}
			}
		}

		$startIndex = $pagingModel->getStartIndex();
		$pageLimit = $pagingModel->getPageLimit();
		$paramArray = array();

		if (!empty($orderBy) && $orderByFieldModel) {
			if ($orderBy == 'roleid' && $moduleName == 'Users') {
				$listQuery .= ' ORDER BY vtiger_role.rolename ' . ' ' . $sortOrder;
			} else {
				$listQuery .= ' ORDER BY ' . $queryGenerator->getOrderByColumn($orderBy) . ' ' . $sortOrder;
			}

			if ($orderBy == 'first_name' && $moduleName == 'Users') {
				$listQuery .= ' , last_name ' . ' ' . $sortOrder . ' ,  email1 ' . ' ' . $sortOrder;
			}
		} else if (empty($orderBy) && empty($sortOrder) && $moduleName != "Users") {
			// List view will be displayed on recently created/modified records
			require_once('include/utils/GeneralUtils.php');
			global $popupEntryFromSEMOdal, $popupEntryFromSEMOdalsourceRecord;
			if ($popupEntryFromSEMOdal == true) {
				global $current_user;
				$data = getUserDetailsBasedOnEmployeeModuleG($current_user->user_name);
				$functionalLocations = array(678308); //getAllAssociatedFunctionalLocationsSE('36x' . $popupEntryFromSEMOdalsourceRecord);
				if (empty($functionalLocations)) {
					$listQuery = $listQuery . ' and 1 = 2 ';
				} else {
					$listQuery = $listQuery . ' AND vtiger_account.accountid IN ("' . implode('","', $functionalLocations) . '")';
				}
			} else {
				global $current_user;
				$data = getUserDetailsBasedOnEmployeeModuleG($current_user->user_name);
				if (empty($data) || $current_user->user_name == 'masteradmin') {
				} else {
					if (($data['cust_role'] == 'Service Manager' &&
						($data['sub_service_manager_role'] == 'Regional Manager'
							|| $data['sub_service_manager_role'] == 'Regional Service Manager'))) {
						$functionalLocations = array_unique(getAllLinkedCustomersServiceManager('36x' . $data['serviceengineerid']));
						if (empty($functionalLocations)) {
							$listQuery = $listQuery . ' and 1 = 2 ';
						} else {
							$listQuery = $listQuery . ' AND vtiger_account.accountid IN ("' . implode('","', $functionalLocations) . '")';
						}
					} else if (($data['cust_role'] == 'BEML Management'
						|| $data['cust_role'] == 'BEML Marketing HQ'
						|| $data['cust_role'] == 'Divisonal Service Support')) {
					} else {
						$functionalLocations =array_unique(getAllLinkedCustomers('36x' . $data['serviceengineerid']));
						if (empty($functionalLocations)) {
							$listQuery = $listQuery . ' and 1 = 2 ';
						} else {
							$listQuery = $listQuery . ' AND vtiger_account.accountid IN ("' . implode('","', $functionalLocations) . '")';
						}
					}
				}
			}
			$listQuery .= ' ORDER BY vtiger_crmentity.modifiedtime DESC';
		}

		$viewid = ListViewSession::getCurrentView($moduleName);
		if (empty($viewid)) {
			$viewid = $pagingModel->get('viewid');
		}
		$_SESSION['lvs'][$moduleName][$viewid]['start'] = $pagingModel->get('page');

		ListViewSession::setSessionQuery($moduleName, $listQuery, $viewid);

		$listQuery .= " LIMIT ?, ?";
		array_push($paramArray, $startIndex);
		array_push($paramArray, ($pageLimit + 1));

		$listResult = $db->pquery($listQuery, $paramArray);

		$listViewRecordModels = array();
		$listViewEntries =  $listViewContoller->getListViewRecords($moduleFocus, $moduleName, $listResult);

		$pagingModel->calculatePageRange($listViewEntries);

		if ($db->num_rows($listResult) > $pageLimit) {
			array_pop($listViewEntries);
			$pagingModel->set('nextPageExists', true);
		} else {
			$pagingModel->set('nextPageExists', false);
		}

		$index = 0;
		foreach ($listViewEntries as $recordId => $record) {
			$rawData = $db->query_result_rowdata($listResult, $index++);
			$record['id'] = $recordId;
			$listViewRecordModels[$recordId] = $moduleModel->getRecordFromArray($record, $rawData);
		}
		return $listViewRecordModels;
	}

	public function getListViewCount() {
		$db = PearDatabase::getInstance();

		$queryGenerator = $this->get('query_generator');


		$searchParams = $this->get('search_params');
		if (empty($searchParams)) {
			$searchParams = array();
		}

		// for Documents folders we should filter with folder id as well
		$folderKey = $this->get('folder_id');
		$folderValue = $this->get('folder_value');
		if (!empty($folderValue)) {
			$queryGenerator->addCondition($folderKey, $folderValue, 'e');
		}

		$glue = "";
		if (count($queryGenerator->getWhereFields()) > 0 && (count($searchParams)) > 0) {
			$glue = QueryGenerator::$AND;
		}
		$queryGenerator->parseAdvFilterList($searchParams, $glue);

		$searchKey = $this->get('search_key');
		$searchValue = $this->get('search_value');
		$operator = $this->get('operator');
		if (!empty($searchKey)) {
			$queryGenerator->addUserSearchConditions(array('search_field' => $searchKey, 'search_text' => $searchValue, 'operator' => $operator));
		}
		$moduleName = $this->getModule()->get('name');
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);

		$listQuery = $this->getQuery();
		$sourceModule = $this->get('src_module');
		if (!empty($sourceModule)) {
			$moduleModel = $this->getModule();
			if (method_exists($moduleModel, 'getQueryByModuleField')) {
				$overrideQuery = $moduleModel->getQueryByModuleField($sourceModule, $this->get('src_field'), $this->get('src_record'), $listQuery);
				if (!empty($overrideQuery)) {
					$listQuery = $overrideQuery;
				}
			}
		}
		$position = stripos($listQuery, ' from ');
		if ($position) {
			$split = preg_split('/ from /i', $listQuery);
			$splitCount = count($split);
			// If records is related to two records then we'll get duplicates. Then count will be wrong
			$meta = $queryGenerator->getMeta($this->getModule()->getName());
			$columnIndex = $meta->getObectIndexColumn();
			$baseTable = $meta->getEntityBaseTable();
			$listQuery = "SELECT count(distinct($baseTable.$columnIndex)) AS count ";
			for ($i = 1; $i < $splitCount; $i++) {
				$listQuery = $listQuery . ' FROM ' . $split[$i];
			}
		}

		if ($this->getModule()->get('name') == 'Calendar') {
			$listQuery .= ' AND activitytype <> "Emails"';
		}

		global $current_user;
		require_once('include/utils/GeneralUtils.php');
		$data = getUserDetailsBasedOnEmployeeModuleG($current_user->user_name);
		if (empty($data) || $current_user->user_name == 'masteradmin') {
		} else {
			if (($data['cust_role'] == 'Service Manager' &&
				($data['sub_service_manager_role'] == 'Regional Manager'
					|| $data['sub_service_manager_role'] == 'Regional Service Manager'))) {
				$functionalLocations = getAllLinkedCustomersServiceManager('36x' . $data['serviceengineerid']);
				if (empty($functionalLocations)) {
					$listQuery = $listQuery . ' and 1 = 2 ';
				} else {
					$listQuery = $listQuery . ' AND vtiger_account.accountid IN ("' . implode('","', $functionalLocations) . '")';
				}
			} else if (($data['cust_role'] == 'BEML Management'
				|| $data['cust_role'] == 'BEML Marketing HQ'
				|| $data['cust_role'] == 'Divisonal Service Support')) {
			} else {
				$functionalLocations = getAllLinkedCustomers('36x' . $data['serviceengineerid']);
				if (empty($functionalLocations)) {
					$listQuery = $listQuery . ' and 1 = 2 ';
				} else {
					$listQuery = $listQuery . ' AND vtiger_account.accountid IN ("' . implode('","', $functionalLocations) . '")';
				}
			}
		}
		$listResult = $db->pquery($listQuery, array());
		return $db->query_result($listResult, 0, 'count');
	}
}
