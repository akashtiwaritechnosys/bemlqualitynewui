<?php
include_once dirname(__FILE__) . '/models/Alert.php';
include_once dirname(__FILE__) . '/models/SearchFilter.php';
include_once dirname(__FILE__) . '/models/Paging.php';

class Mobile_WS_GetSRList extends Mobile_WS_Controller {

	function isCalendarModule($module) {
		return ($module == 'Events' || $module == 'Calendar');
	}

	function getSearchFilterModel($module, $search) {
		return Mobile_WS_SearchFilterModel::modelWithCriterias($module, Zend_JSON::decode($search));
	}

	function getPagingModel(Mobile_API_Request $request) {
		$page = $request->get('page', 0);
		return Mobile_WS_PagingModel::modelWithPageStart($page);
	}

	function process(Mobile_API_Request $request) {
		$current_user = $this->getActiveUser();

		$module = 'HelpDesk';
		$filterId = $request->get('filterid');
		$page = $request->get('page', '1');
		$orderBy = $request->getForSql('orderBy');
		$sortOrder = $request->getForSql('sortOrder');

		$moduleModel = Vtiger_Module_Model::getInstance($module);
		$headerFieldModels = $moduleModel->getHeaderViewFieldsList();

		$headerFields = array();
		$fields = array();
		$headerFieldColsMap = array();
		$headerFieldStatusValue = $request->get('headerFieldStatusValue');
		$additinalConditions = [];
		if (!empty($headerFieldStatusValue)) {
			$additinalCondition = array('ticket_type','e', $headerFieldStatusValue);
			array_push($additinalConditions, $additinalCondition);
			$nameFields = $this->getConfiguredStatusFields($headerFieldStatusValue);
		} else {
			$nameFields =  $moduleModel->getNameFields();
		}

		if (is_string($nameFields)) {
			$nameFieldModel = $moduleModel->getField($nameFields);
			$headerFields[] = $nameFields;
			$fields = array('name' => $nameFieldModel->get('name'), 'label' => vtranslate($nameFieldModel->get('label'), $module), 'fieldType' => $nameFieldModel->getFieldDataType());
		} else if (is_array($nameFields)) {
			foreach ($nameFields as $nameField) {
				$nameFieldModel = $moduleModel->getField($nameField);
				$headerFields[] = $nameField;
				$fields[] = array('name' => $nameFieldModel->get('name'), 'label' => vtranslate($nameFieldModel->get('label'), $module), 'fieldType' => $nameFieldModel->getFieldDataType());
			}
		}

		foreach ($headerFieldModels as $fieldName => $fieldModel) {
			$headerFields[] = $fieldName;
			// $fields[] = array('name' => $fieldName, 'label' => vtranslate($fieldModel->get('label'), $module), 'fieldType' => $fieldModel->getFieldDataType());
			$headerFieldColsMap[$fieldModel->get('column')] = $fieldName;
		}

		if ($module == 'HelpDesk') $headerFieldColsMap['title'] = 'ticket_title';
		if ($module == 'Documents') $headerFieldColsMap['title'] = 'notes_title';
		global $fetchinFormMobile;
		$fetchinFormMobile = true;

		$listViewModel = Vtiger_ListView_Model::getInstance($module, $filterId, $headerFields);

		if (!empty($sortOrder)) {
			$listViewModel->set('orderby', $orderBy);
			$listViewModel->set('sortorder', $sortOrder);
		}
		if (!empty($request->get('search_key'))) {
			$listViewModel->set('search_key', $request->get('search_key'));
			$listViewModel->set('search_value', $request->get('search_value'));
			$listViewModel->set('operator', $request->get('operator'));
		}

		if (!empty($request->get('search_params')) || !empty($request->get('headerFieldStatusValue'))) {
			$searchParams = json_decode($request->get('search_params'));
			if(empty($searchParams)){
				$searchParams = [];
			}
			$searchParams = array(array_merge($searchParams,$additinalConditions));
			$transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $listViewModel->getModule());
			$listViewModel->set('search_params', $transformedSearchParams);
		}

		$listViewModel->set('searchAllFieldsValue', $request->get('searchAllFieldsValue'));

		$pagingModel = new Vtiger_Paging_Model();
		$pageLimit = $pagingModel->getPageLimit();
		$pagingModel->set('page', $page);
		$pagingModel->set('limit', $pageLimit);
		$listViewEntries = $listViewModel->getListViewEntries($pagingModel);

		if (empty($filterId)) {
			$customView = new CustomView($module);
			$filterId = $customView->getViewId($module);
		}

		if ($listViewEntries) {
			$referenceFields = array('equipment_id','func_loc_id');
			foreach ($listViewEntries as $index => $listViewEntryModel) {
				$data = $listViewEntryModel->getRawData();
				// $record = array('id' => $listViewEntryModel->getId());
				$modelNumber = $data['sr_equip_model'];
				foreach ($data as $i => $value) {
					if (is_string($i)) {
						if($i == 'sr_equip_model'){
							continue;
						}
						if (isset($headerFieldColsMap[$i])) {
							$i = $headerFieldColsMap[$i];
						}
						$record[$i] = decode_html($value);
						if(in_array($i,$referenceFields)){
							$record[$i] = Vtiger_Functions::getCRMRecordLabel($value);
						}
						if($i == 'equipment_id'){
							$record[$i] = $modelNumber .'-'.$record[$i];
						} else if($i == 'hmr'){
							$record[$i] = $record[$i] .' Hrs';
						} else if($i == 'ticketid'){
							$record[$i] = '17x'.$record[$i];
						}
					}
				}
				unset($record['starred']);
				$records[] = $record;
			}
		}

		$moreRecords = false;
		if (count($listViewEntries) > $pageLimit) {
			$moreRecords = true;
			array_pop($records);
		}

		$response = new Mobile_API_Response();
		if (empty($records)) {
			$records = array();
		}
		$newHeaders = [];
		foreach ($fields as $field) {
			if ($field['name'] != 'sr_equip_model') {
				array_push($newHeaders, $field);
			}
		}
		$moduleModel = Vtiger_Module_Model::getInstance('HelpDesk');
		$counts = $moduleModel->getTicketsByStatusCountsForUser('' , '', $headerFieldStatusValue);
		$response->setResult(array(
			'ticketStatusCounts' => $counts,
			'records' => $records,
			'headers' => $newHeaders,
			'selectedFilter' => $filterId,
			'nameFields' => $nameFields,
			'moreRecords' => $moreRecords,
			'orderBy' => $orderBy,
			'sortOrder' => $sortOrder,
			'page' => $page
		));
		$response->setApiSucessMessage('Successfully Fetched Data');
		return $response;
	}
	public function transferListSearchParamsToFilterCondition($listSearchParams, $moduleModel) {
		return Vtiger_Util_Helper::transferListSearchParamsToFilterCondition($listSearchParams, $moduleModel);
	}

	function processSearchRecordLabelForCalendar(Mobile_API_Request $request, $pagingModel = false) {
		$current_user = $this->getActiveUser();

		// Fetch both Calendar (Todo) and Event information
		$moreMetaFields = array('date_start', 'time_start', 'activitytype', 'location');
		$eventsRecords = $this->fetchRecordLabelsForModule('Events', $current_user, $moreMetaFields, false, $pagingModel);
		$calendarRecords = $this->fetchRecordLabelsForModule('Calendar', $current_user, $moreMetaFields, false, $pagingModel);

		// Merge the Calendar & Events information
		$records = array_merge($eventsRecords, $calendarRecords);

		$modifiedRecords = array();
		foreach ($records as $record) {
			$modifiedRecord = array();
			$modifiedRecord['id'] = $record['id'];
			unset($record['id']);
			$modifiedRecord['eventstartdate'] = $record['date_start'];
			unset($record['date_start']);
			$modifiedRecord['eventstarttime'] = $record['time_start'];
			unset($record['time_start']);
			$modifiedRecord['eventtype'] = $record['activitytype'];
			unset($record['activitytype']);
			$modifiedRecord['eventlocation'] = $record['location'];
			unset($record['location']);

			$modifiedRecord['label'] = implode(' ', array_values($record));

			$modifiedRecords[] = $modifiedRecord;
		}

		$response = new Mobile_API_Response();
		$response->setResult(array('records' => $modifiedRecords, 'module' => 'Calendar'));

		return $response;
	}

	function fetchRecordLabelsForModule($module, $user, $morefields = array(), $filterOrAlertInstance = false, $pagingModel = false) {
		if ($this->isCalendarModule($module)) {
			$fieldnames = Mobile_WS_Utils::getEntityFieldnames('Calendar');
		} else {
			$fieldnames = Mobile_WS_Utils::getEntityFieldnames($module);
		}

		if (!empty($morefields)) {
			foreach ($morefields as $fieldname) $fieldnames[] = $fieldname;
		}

		if ($filterOrAlertInstance === false) {
			$filterOrAlertInstance = Mobile_WS_SearchFilterModel::modelWithCriterias($module);
			$filterOrAlertInstance->setUser($user);
		}

		return $this->queryToSelectFilteredRecords($module, $fieldnames, $filterOrAlertInstance, $pagingModel);
	}

	function getConfiguredStatusFields($statusFilterName) {
		global $adb;
		$sql = "SELECT columnname FROM `vtiger_customview` inner join vtiger_cvcolumnlist " .
			"on vtiger_cvcolumnlist.cvid = vtiger_customview.cvid " .
			"where vtiger_customview.viewname = ? ORDER BY `vtiger_cvcolumnlist`.`columnindex` ASC";
		$result = $adb->pquery($sql, array($statusFilterName));
		$columns = [];
		while ($row = $adb->fetch_array($result)) {
			$columnname = $row['columnname'];
			$columnname = explode(':', $columnname);
			array_push($columns, $columnname[2]);
		}
		return $columns;
	}

	function queryToSelectFilteredRecords($module, $fieldnames, $filterOrAlertInstance, $pagingModel) {

		if ($filterOrAlertInstance instanceof Mobile_WS_SearchFilterModel) {
			return $filterOrAlertInstance->execute($fieldnames, $pagingModel);
		}

		global $adb;

		$moduleWSId = Mobile_WS_Utils::getEntityModuleWSId($module);
		$columnByFieldNames = Mobile_WS_Utils::getModuleColumnTableByFieldNames($module, $fieldnames);

		// Build select clause similar to Webservice query
		$selectColumnClause = "CONCAT('{$moduleWSId}','x',vtiger_crmentity.crmid) as id,";
		foreach ($columnByFieldNames as $fieldname => $fieldinfo) {
			$selectColumnClause .= sprintf("%s.%s as %s,", $fieldinfo['table'], $fieldinfo['column'], $fieldname);
		}
		$selectColumnClause = rtrim($selectColumnClause, ',');

		$query = $filterOrAlertInstance->query();
		$query = preg_replace("/SELECT.*FROM(.*)/i", "SELECT $selectColumnClause FROM $1", $query);

		if ($pagingModel !== false) {
			$query .= sprintf(" LIMIT %s, %s", $pagingModel->currentCount(), $pagingModel->limit());
		}

		$prequeryResult = $adb->pquery($query, $filterOrAlertInstance->queryParameters());
		return new SqlResultIterator($adb, $prequeryResult);
	}
}
