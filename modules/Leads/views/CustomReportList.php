<?php

class Leads_CustomReportList_View extends Vtiger_Index_View {

	function __construct() {
		parent::__construct();
	}

	public function requiresPermission(Vtiger_Request $request) {
		return true;
	}
	public function getOverlayHeaderScripts(Vtiger_Request $request) {
		$moduleName = $request->getModule();
		$jsFileNames = array(
			"modules.$moduleName.resources.Edit",
		);
		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		return $jsScriptInstances;
	}

	function preProcess(Vtiger_Request $request, $display = true) {
		//Vtiger7 - TO show custom view name in Module Header
		$viewer = $this->getViewer($request);
		$moduleName = $request->getModule();
		$viewer->assign('CUSTOM_VIEWS', CustomView_Record_Model::getAllByGroup($moduleName));
		$moduleModel = Vtiger_Module_Model::getInstance($moduleName);
		$record = $request->get('record');
		if (!empty($record) && $moduleModel->isEntityModule()) {
			$recordModel = $this->record ? $this->record : Vtiger_Record_Model::getInstanceById($record, $moduleName);
			$viewer->assign('RECORD', $recordModel);
		}

		$duplicateRecordsList = array();
		$duplicateRecords = $request->get('duplicateRecords');

		if (is_array($duplicateRecords)) {
			$duplicateRecordsList = $duplicateRecords;
		}

		$viewer = $this->getViewer($request);
		$viewer->assign('SPECIAL_ERROR', $request->get('specialError'));
		$viewer->assign('DUPLICATE_RECORDS', $duplicateRecordsList);
		parent::preProcess($request, $display);
	}

	function process(Vtiger_Request $request) {
		echo $this->showModuleDetailView($request);
	}

	function showModuleDetailView(Vtiger_Request $request) {
		$moduleName = $request->getModule();

		$viewer = $this->getViewer($request);
		$viewer->assign('MODULE', $moduleName);
		
		$records = [
			[
				'label' => 'Model Wise Contract',
				'url' => 'index.php?module=Leads&view=ModelWiseContract'
			],
			[
				'label' => 'STATUS OF CONTRACT EQUIPMENT',
				'url' => 'index.php?module=Leads&view=CustomReportsStatusOfContractEquipment'
			],
			[
				'label' => 'DETAILS OF OFF ROAD UNDER CONTRACT EQUIPMENTS',
				'url' => 'index.php?module=Leads&view=StatusUnderContractEquipmentDetailed'
			],
			[
				'label' => 'STATUS OF UNDER WARRANTY EQUIPMENT',
				'url' => 'index.php?module=Leads&view=StatusUnderWarrantyEquipment'
			],
			[
				'label' => 'DETAILS OF OFF ROAD UNDER WARRANTY EQUIPMENTS',
				'url' => 'index.php?module=Leads&view=StatusUnderWarrantyEquipmentDetailed'
			],
			[
				'label' => 'Contract Type Wise',
				'url' => 'index.php?module=Leads&view=ContractTypeWise'
			],
			[
				'label' => 'Warranty And Contract',
				'url' => 'index.php?module=Leads&view=WarrantyAndContract'
			],
			[
				'label' => 'Major Corporate Customer',
				'url' => 'index.php?module=Leads&view=MajorCorporateCustomer'
			],
			[
				'label' => 'CIL subsidiary wise',
				'url' => 'index.php?module=Leads&view=CILsubsidiarywise'
			],
			[
				'label' => 'Region wise',
				'url' => 'index.php?module=Leads&view=RegionWise'
			],
			[
				'label' => 'Contract',
				'url' => 'index.php?module=Leads&view=Contract'
			],
			[
				'label' => 'Warranty',
				'url' => 'index.php?module=Leads&view=Warranty'
			],
			[
				'label' => 'NON-COAL POPULATION',
				'url' => 'index.php?module=Leads&view=NonCoalPopulation'
			],
			[
				'label' => 'COAL CUSTOMER',
				'url' => 'index.php?module=Leads&view=CoalCustomer'
			],
			[
				'label' => 'Life Cycle',
				'url' => 'index.php?module=Leads&view=LifeCycle'
			]
		];

		$viewer->assign('ResultArray', $records);
		return $viewer->view('CustomReportList.tpl', $moduleName, true);
	}

	function showDashBoardAddTabForm($request) {
		$moduleName = $request->getModule();

		$viewer = $this->getViewer($request);
		$viewer->assign("MODULE", $moduleName);
		echo $viewer->view('AddDashBoardTabForm.tpl', $moduleName, true);
	}

}
