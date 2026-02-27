<?php

/***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class Equipment extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_equipment';
	var $table_index = 'equipmentid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = array('vtiger_equipmentcf', 'equipmentid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = array(
		'vtiger_crmentity', 'vtiger_equipment', 'vtiger_equipmentcf',
		'vtiger_inventoryproductrel_equipment'
	);

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_equipment' => 'equipmentid',
		'vtiger_equipmentcf' => 'equipmentid',
		'vtiger_inventoryproductrel_equipment' => 'id'
	);

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = array();
	var $list_fields_name = array();

	// Make the field link to detail view
	var $list_link_field = 'equipment_sl_no';

	// For Popup listview and UI type support
	var $search_fields = array();
	var $search_fields_name = array();

	// For Popup window record selection
	var $popup_fields = array('equipment_sl_no');

	// For Alphabetical search
	var $def_basicsearch_col = 'equipment_sl_no';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'equipment_sl_no';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = array('equipment_sl_no', 'assigned_user_id');

	var $default_order_by = 'equipment_sl_no';
	var $default_sort_order = 'ASC';

	function Equipment() {
		$this->log = LoggerManager::getLogger('Equipment');
		$this->db = PearDatabase::getInstance();
		$this->column_fields = getColumnFields('Equipment');
	}

	/**
	 * Invoked when special actions are performed on the module.
	 * @param String Module name
	 * @param String Event Type
	 */
	function vtlib_handler($moduleName, $eventType) {
		if ($eventType == 'module.postinstall') {
			//Enable ModTracker for the module
			static::enableModTracker($moduleName);
			//Create Related Lists
			static::createRelatedLists();
		} else if ($eventType == 'module.disabled') {
			// Handle actions before this module is being uninstalled.
		} else if ($eventType == 'module.preuninstall') {
			// Handle actions when this module is about to be deleted.
		} else if ($eventType == 'module.preupdate') {
			// Handle actions before this module is updated.
		} else if ($eventType == 'module.postupdate') {
			//Create Related Lists
			static::createRelatedLists();
		}
	}

	/**
	 * Enable ModTracker for the module
	 */
	public static function enableModTracker($moduleName) {
		include_once 'vtlib/Vtiger/Module.php';
		include_once 'modules/ModTracker/ModTracker.php';

		//Enable ModTracker for the module
		$moduleInstance = Vtiger_Module::getInstance($moduleName);
		ModTracker::enableTrackingForModule($moduleInstance->getId());
	}

	protected static function createRelatedLists() {
		include_once('vtlib/Vtiger/Module.php');
	}

	function save_module($module) {
		// saveLineDetailsEquipment($this, $module);
		global $onlyFromWeb;
		$onlyFromWeb = true;
	}

	function getNonAdminAccessControlQuery1($module, $user, $scope = '') {
		require('user_privileges/user_privileges_' . $user->id . '.php');
		require('user_privileges/sharing_privileges_' . $user->id . '.php');
		$query = ' ';
		$tabId = getTabid($module);
		if ($is_admin == false && $profileGlobalPermission[1] == 1 && $profileGlobalPermission[2]
				== 1 && $defaultOrgSharingPermission[$tabId] == 3) {
			$tableName = 'vt_tmp_u' . $user->id;
			$sharingRuleInfoVariable = $module . '_share_read_permission';
			$sharingRuleInfo = $$sharingRuleInfoVariable;
			$sharedTabId = null;
			if (!empty($sharingRuleInfo) && (count($sharingRuleInfo['ROLE']) > 0 ||
					count($sharingRuleInfo['GROUP']) > 0)) {
				$tableName = $tableName . '_t' . $tabId;
				$sharedTabId = $tabId;
			} elseif ($module == 'Calendar' || !empty($scope)) {
				$tableName .= '_t' . $tabId;
			}
			$this->setupTemporaryTable($tableName, $sharedTabId, $user, $current_user_parent_role_seq, $current_user_groups);
			// for secondary module we should join the records even if record is not there(primary module without related record)
				if($scope == ''){
					$query = " INNER JOIN $tableName ON $tableName$scope.id = " .
							"vtiger_crmentity$scope.smownerid ";
				}else{
					$query = " INNER JOIN $tableName ON $tableName$scope.id = " .
							"vtiger_crmentity$scope.smownerid OR vtiger_crmentity$scope.smownerid IS NULL";
				}
			}
		return $query;
	}

	public function getNonAdminAccessControlQuery($module, $user, $scope = '') {
		global $current_user;
		require_once('include/utils/GeneralUtils.php');
		$data = getUserDetailsBasedOnEmployeeModuleG($current_user->user_name);
		if (empty($data)) {
			return $this->getNonAdminAccessControlQuery1($module, $user, $scope = '');
		}
		if (($data['cust_role'] == 'Service Manager' &&
			($data['sub_service_manager_role'] == 'Regional Manager'
				|| $data['sub_service_manager_role'] == 'Regional Service Manager'))) {
			return $this->getNonAdminAccessControlQuery1($module, $user, $scope = '');
		} else if (($data['cust_role'] == 'BEML Management'
			|| $data['cust_role'] == 'BEML Marketing HQ'
			|| $data['cust_role'] == 'Divisonal Service Support')) {
			return '';
		} else {
			return '';
		}
	}
}
