<?php
class ServiceReports_Edit_View extends Inventory_Edit_View {

	public function process(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$record = $request->get('record');
		$sourceRecord = $request->get('sourceRecord');
		$sourceModule = $request->get('sourceModule');
		if (empty($sourceRecord) && empty($sourceModule)) {
			$sourceRecord = $request->get('returnrecord');
			$sourceModule = $request->get('returnmodule');
		}

		$viewer->assign('MODE', '');
		$viewer->assign('IS_DUPLICATE', false);
		if ($request->has('totalProductCount')) {
			if ($record) {
				$recordModel = Vtiger_Record_Model::getInstanceById($record);
			} else {
				$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			}
			$relatedProducts = $recordModel->convertRequestToProducts($request);
			$taxes = $relatedProducts[1]['final_details']['taxes'];
		} else if (!empty($record)  && $request->get('isDuplicate') == true) {
			$recordModel = Inventory_Record_Model::getInstanceById($record, $moduleName);
			$currencyInfo = $recordModel->getCurrencyInfo();
			$taxes = $recordModel->getProductTaxes();
			$relatedProducts = $recordModel->getProducts();

			$mandatoryFieldModels = $recordModel->getModule()->getMandatoryFieldModels();
			foreach ($mandatoryFieldModels as $fieldModel) {
				if ($fieldModel->isReferenceField()) {
					$fieldName = $fieldModel->get('name');
					if (Vtiger_Util_Helper::checkRecordExistance($recordModel->get($fieldName))) {
						$recordModel->set($fieldName, '');
					}
				}
			}
			$viewer->assign('IS_DUPLICATE', true);
		} elseif (!empty($record)) {
			$recordModel = Inventory_Record_Model::getInstanceById($record, $moduleName);
			$currencyInfo = $recordModel->getCurrencyInfo();
			$taxes = $recordModel->getProductTaxes();
			$relatedProducts = $recordModel->getProducts();
			$viewer->assign('RECORD_ID', $record);
			$viewer->assign('MODE', 'edit');
		} elseif (($request->get('salesorder_id') || $request->get('quote_id') || $request->get('invoice_id')) && ($moduleName == 'PurchaseOrder')) {
			if ($request->get('salesorder_id')) {
				$referenceId = $request->get('salesorder_id');
			} elseif ($request->get('invoice_id')) {
				$referenceId = $request->get('invoice_id');
			} else {
				$referenceId = $request->get('quote_id');
			}

			$parentRecordModel = Inventory_Record_Model::getInstanceById($referenceId);
			$currencyInfo = $parentRecordModel->getCurrencyInfo();

			$relatedProducts = $parentRecordModel->getProductsForPurchaseOrder();
			$taxes = $parentRecordModel->getProductTaxes();

			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$recordModel->setRecordFieldValues($parentRecordModel);
		} elseif ($request->get('salesorder_id') || $request->get('quote_id')) {
			if ($request->get('salesorder_id')) {
				$referenceId = $request->get('salesorder_id');
			} else {
				$referenceId = $request->get('quote_id');
			}

			$parentRecordModel = Inventory_Record_Model::getInstanceById($referenceId);
			$currencyInfo = $parentRecordModel->getCurrencyInfo();
			$taxes = $parentRecordModel->getProductTaxes();
			$relatedProducts = $parentRecordModel->getProducts();
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);
			$recordModel->setRecordFieldValues($parentRecordModel);
		} else {
			$taxes = Inventory_Module_Model::getAllProductTaxes();
			$recordModel = Vtiger_Record_Model::getCleanInstance($moduleName);

			//The creation of Inventory record from action and Related list of product/service detailview the product/service details will calculated by following code
			if ($request->get('product_id') || $sourceModule === 'Products' || $request->get('productid')) {
				if ($sourceRecord) {
					$productRecordModel = Products_Record_Model::getInstanceById($sourceRecord);
				} else if ($request->get('product_id')) {
					$productRecordModel = Products_Record_Model::getInstanceById($request->get('product_id'));
				} else if ($request->get('productid')) {
					$productRecordModel = Products_Record_Model::getInstanceById($request->get('productid'));
				}
				$relatedProducts = $productRecordModel->getDetailsForInventoryModule($recordModel);
			} elseif ($request->get('service_id') || $sourceModule === 'Services') {
				if ($sourceRecord) {
					$serviceRecordModel = Services_Record_Model::getInstanceById($sourceRecord);
				} else {
					$serviceRecordModel = Services_Record_Model::getInstanceById($request->get('service_id'));
				}
				$relatedProducts = $serviceRecordModel->getDetailsForInventoryModule($recordModel);
			} elseif ($sourceRecord && in_array($sourceModule, array('Accounts', 'Contacts', 'Potentials', 'Vendors', 'PurchaseOrder'))) {
				$parentRecordModel = Vtiger_Record_Model::getInstanceById($sourceRecord, $sourceModule);
				$recordModel->setParentRecordData($parentRecordModel);
				if ($sourceModule !== 'PurchaseOrder') {
					$relatedProducts = $recordModel->getParentRecordRelatedLineItems($parentRecordModel);
				}
			} elseif ($sourceRecord && in_array($sourceModule, array('HelpDesk', 'Leads'))) {
				$parentRecordModel = Vtiger_Record_Model::getInstanceById($sourceRecord, $sourceModule);
				$relatedProducts = $recordModel->getParentRecordRelatedLineItems($parentRecordModel);
			}
		}

		$deductTaxes = $relatedProducts[1]['final_details']['deductTaxes'];
		if (!$deductTaxes) {
			$deductTaxes = Inventory_TaxRecord_Model::getDeductTaxesList();
		}

		$taxType = $relatedProducts[1]['final_details']['taxtype'];
		$moduleModel = $recordModel->getModule();
		$fieldList = $moduleModel->getFields();
		$requestFieldList = array_intersect_key($request->getAllPurified(), $fieldList);

		$inventoryRecordModel = Inventory_Record_Model::getCleanInstance($moduleName);
		$termsAndConditions = $inventoryRecordModel->getInventoryTermsAndConditions();

		foreach ($requestFieldList as $fieldName => $fieldValue) {
			$fieldModel = $fieldList[$fieldName];
			if ($fieldModel->isEditable()) {
				$recordModel->set($fieldName, $fieldModel->getDBInsertValue($fieldValue));
			}
		}
		$sourceRecord = $request->get('sourceRecord');
		$sourceModule = $request->get('sourceModule');
		if (!empty($sourceRecord)) {
			$recordInstnce = Vtiger_Record_Model::getInstanceById($sourceRecord, $sourceModule);
			$fM = $this->getMapping();
			foreach ($fM as $key => $value) {
				$aKey = $value['HelpDesk']['igFieldName'];
				$bKey = $value['ServiceReports']['igFieldName'];
				$recordModel->set($bKey, $recordInstnce->get($aKey));
			}
			$recordModel->set('ticket_id', $sourceRecord);
			$viewer->assign('IMAGE_DETAILS', $recordInstnce->getImageDetails());

			$recId = $recordInstnce->get('smcreatorid');
			$db = PearDatabase::getInstance();
			$sql = 'select user_name from vtiger_users where id = ?';
			$sqlResult = $db->pquery($sql, array($recId));
			$dataRow = $db->fetchByAssoc($sqlResult, 0);

			$sql = 'select serviceengineerid from vtiger_serviceengineer where badge_no = ?';
			$sqlResult = $db->pquery($sql, array($dataRow['user_name']));
			$dataRow = $db->fetchByAssoc($sqlResult, 0);

			$recordModel->set('reported_by', $dataRow['serviceengineerid']);
			$recId = $recordInstnce->get('func_loc_id');
			if (!empty($recId)) {
				$recInstance = Vtiger_Record_Model::getInstanceById($recId, 'FunctionalLocations');
				$recordModel->set('area_name', $recInstance->get('func_area_name'));
				$recordModel->set('project_name', $recInstance->get('func_proj_name'));
			}
			$equipmentId = $recordInstnce->get('equipment_id');
			if (!empty($recId)) {
				$recInstance = Vtiger_Record_Model::getInstanceById($equipmentId, 'Equipment');
				$recordModel->set('dte_of_commissing', $recInstance->get('cust_begin_guar'));
				$recordModel->set('type_of_conrt', $recInstance->get('eq_type_of_conrt'));
				$recordModel->set('run_year_cont', $recInstance->get('run_year_cont'));
				$recordModel->set('cont_start_date', $recInstance->get('cont_start_date'));
				$recordModel->set('cont_end_date', $recInstance->get('cont_end_date'));
				$recordModel->set('sr_war_status', $recInstance->get('eq_run_war_st'));
			}
			$recId = $recordInstnce->get('assigned_user_id');
			$db = PearDatabase::getInstance();
			$sql = 'select user_name from vtiger_users where id = ?';
			$sqlResult = $db->pquery($sql, array($recId));
			$dataRow = $db->fetchByAssoc($sqlResult, 0);

			$sql = 'select serviceengineerid from vtiger_serviceengineer where badge_no = ?';
			$sqlResult = $db->pquery($sql, array($dataRow['user_name']));
			$dataRow = $db->fetchByAssoc($sqlResult, 0);

			if (!empty($dataRow)) {
				$recInstance = Vtiger_Record_Model::getInstanceById($dataRow['serviceengineerid'], 'ServiceEngineer');
				$recordModel->set('badge_no', $recInstance->get('badge_no'));
				$recordModel->set('ser_eng_name', $recInstance->get('service_engineer_name'));
				$recordModel->set('sr_designaion', $recInstance->get('designaion'));
				$recordModel->set('sr_regional_office', $recInstance->get('regional_office'));
				$recordModel->set('dist_off_or_act_cen', $recInstance->get('district_office'));
			}
		}


		$recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceFromRecordModel($recordModel, Vtiger_RecordStructure_Model::RECORD_STRUCTURE_MODE_EDIT);

		$viewer->assign('VIEW_MODE', "fullForm");

		$isRelationOperation = $request->get('relationOperation');

		//if it is relation edit
		$viewer->assign('IS_RELATION_OPERATION', $isRelationOperation);
		if ($isRelationOperation) {
			$viewer->assign('SOURCE_MODULE', $sourceModule);
			$viewer->assign('SOURCE_RECORD', $sourceRecord);
		}
		if (!empty($record)  && $request->get('isDuplicate') == true) {
			$viewer->assign('IS_DUPLICATE', true);
		} else {
			$viewer->assign('IS_DUPLICATE', false);
		}
		$currencies = Inventory_Module_Model::getAllCurrencies();
		$picklistDependencyDatasource = Vtiger_DependencyPicklist::getPicklistDependencyDatasource($moduleName);

		$recordStructure = $recordStructureInstance->getStructure();

		$viewer->assign('PICKIST_DEPENDENCY_DATASOURCE', Vtiger_Functions::jsonEncode($picklistDependencyDatasource));
		$viewer->assign('RECORD', $recordModel);
		$viewer->assign('RECORD_STRUCTURE_MODEL', $recordStructureInstance);
		$viewer->assign('RECORD_STRUCTURE', $recordStructure);
		$viewer->assign('MODULE', $moduleName);
		$viewer->assign('CURRENTDATE', date('Y-n-j'));
		$viewer->assign('USER_MODEL', Users_Record_Model::getCurrentUserModel());

		$taxRegions = $recordModel->getRegionsList();
		$defaultRegionInfo = $taxRegions[0];
		unset($taxRegions[0]);

		$viewer->assign('TAX_REGIONS', $taxRegions);
		$viewer->assign('DEFAULT_TAX_REGION_INFO', $defaultRegionInfo);
		$viewer->assign('INVENTORY_CHARGES', Inventory_Charges_Model::getInventoryCharges());
		$viewer->assign('RELATED_PRODUCTS', $relatedProducts);
		$viewer->assign('DEDUCTED_TAXES', $deductTaxes);
		$viewer->assign('TAXES', $taxes);
		$viewer->assign('TAX_TYPE', $taxType);
		$viewer->assign('CURRENCINFO', $currencyInfo);
		$viewer->assign('CURRENCIES', $currencies);
		$viewer->assign('TERMSANDCONDITIONS', $termsAndConditions);

		$productModuleModel = Vtiger_Module_Model::getInstance('Products');
		$viewer->assign('PRODUCT_ACTIVE', $productModuleModel->isActive());

		$serviceModuleModel = Vtiger_Module_Model::getInstance('Services');
		$viewer->assign('SERVICE_ACTIVE', $serviceModuleModel->isActive());

		// added to set the return values
		if ($request->get('returnview')) {
			$request->setViewerReturnValues($viewer);
		}

		if ($request->get('displayMode') == 'overlay') {
			$viewer->assign('SCRIPTS', $this->getOverlayHeaderScripts($request));
			echo $viewer->view('OverlayEditView.tpl', $moduleName);
		} else {
			$viewer->view('EditView.tpl', 'ServiceReports');
		}
	}

	public function getMapping($editable = false) {
		if (!$this->mapping) {
			$db = PearDatabase::getInstance();
			$query = 'SELECT * FROM vtiger_convertpotentialmapping';
			if ($editable) {
				$query .= ' WHERE editable = 1';
			}

			$result = $db->pquery($query, array());
			$numOfRows = $db->num_rows($result);
			$mapping = array();
			for ($i = 0; $i < $numOfRows; $i++) {
				$rowData = $db->query_result_rowdata($result, $i);
				$mapping[$rowData['cfmid']] = $rowData;
			}

			$finalMapping = $fieldIdsList = array();
			foreach ($mapping as $mappingDetails) {
				array_push($fieldIdsList, $mappingDetails['potentialfid'], $mappingDetails['projectfid']);
			}
			$fieldLabelsList = array();
			if (!empty($fieldIdsList)) {
				$fieldLabelsList = $this->getFieldsInfo(array_unique($fieldIdsList));
			}
			foreach ($mapping as $mappingId => $mappingDetails) {
				$finalMapping[$mappingId] = array(
					'editable'	=> $mappingDetails['editable'],
					'HelpDesk'		=> $fieldLabelsList[$mappingDetails['potentialfid']],
					'ServiceReports'	=> $fieldLabelsList[$mappingDetails['projectfid']]
				);
			}

			$this->mapping = $finalMapping;
		}

		return $this->mapping;
	}

	public function getFieldsInfo($fieldIdsList) {
		$leadModel = Vtiger_Module_Model::getInstance('HelpDesk');
		$leadId = $leadModel->getId();

		$db = PearDatabase::getInstance();
		$result = $db->pquery('SELECT fieldid, fieldlabel, uitype, typeofdata, fieldname, tablename, tabid FROM vtiger_field WHERE fieldid IN (' . generateQuestionMarks($fieldIdsList) . ')', $fieldIdsList);
		$numOfRows = $db->num_rows($result);

		$fieldLabelsList = array();
		for ($i = 0; $i < $numOfRows; $i++) {
			$rowData = $db->query_result_rowdata($result, $i);

			$fieldInfo = array('id' => $rowData['fieldid'], 'label' => $rowData['fieldlabel']);
			// if ($rowData['tabid'] !== $leadId) {
			$fieldModel = Settings_Leads_Field_Model::getCleanInstance();
			$fieldModel->set('uitype', $rowData['uitype']);
			$fieldModel->set('typeofdata', $rowData['typeofdata']);
			$fieldModel->set('name', $rowData['fieldname']);
			$fieldModel->set('table', $rowData['tablename']);
			$fieldInfo['igFieldName'] = $rowData['fieldname'];
			$fieldInfo['fieldDataType'] = $fieldModel->getFieldDataType();
			// }

			$fieldLabelsList[$rowData['fieldid']] = $fieldInfo;
		}
		return $fieldLabelsList;
	}
	public function getHeaderCss(Vtiger_Request $request) {
		$headerCssInstances = parent::getHeaderCss($request);

		$cssFileNames = array(
			"~layouts/" . Vtiger_Viewer::getDefaultLayoutName() . "/modules/Users/build/css/intlTelInput.css",
		);
		$cssInstances = $this->checkAndConvertCssStyles($cssFileNames);
		$headerCssInstances = array_merge($headerCssInstances, $cssInstances);

		return $headerCssInstances;
	}
}
