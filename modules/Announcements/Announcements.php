<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

include_once 'modules/Vtiger/CRMEntity.php';

class Announcements extends Vtiger_CRMEntity {
	var $table_name = 'vtiger_announcements';
	var $table_index= 'announcementsid';

	/**
	 * Mandatory table for supporting custom fields.
	 */
	var $customFieldTable = Array('vtiger_announcementscf', 'announcementsid');

	/**
	 * Mandatory for Saving, Include tables related to this module.
	 */
	var $tab_name = Array('vtiger_crmentity', 'vtiger_announcements', 'vtiger_announcementscf');

	/**
	 * Mandatory for Saving, Include tablename and tablekey columnname here.
	 */
	var $tab_name_index = Array(
		'vtiger_crmentity' => 'crmid',
		'vtiger_announcements' => 'announcementsid',
		'vtiger_announcementscf'=>'announcementsid');

	/**
	 * Mandatory for Listing (Related listview)
	 */
	var $list_fields = Array (
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'Announcements No' => Array('announcements', 'announcements_no'),
		'Assigned To' => Array('crmentity','smownerid')
	);
	var $list_fields_name = Array (
		/* Format: Field Label => fieldname */
		'Announcements No' => 'announcements_no',
		'Assigned To' => 'assigned_user_id',
	);

	// Make the field link to detail view
	var $list_link_field = 'announcements_no';

	// For Popup listview and UI type support
	var $search_fields = Array(
		/* Format: Field Label => Array(tablename, columnname) */
		// tablename should not have prefix 'vtiger_'
		'Announcements No' => Array('announcements', 'announcements_no'),
		'Assigned To' => Array('vtiger_crmentity','assigned_user_id'),
	);
	var $search_fields_name = Array (
		/* Format: Field Label => fieldname */
		'Announcements No' => 'announcements_no',
		'Assigned To' => 'assigned_user_id',
	);

	// For Popup window record selection
	var $popup_fields = Array ('announcements_no');

	// For Alphabetical search
	var $def_basicsearch_col = 'announcements_no';

	// Column value to use on detail view record text display
	var $def_detailview_recname = 'announcements_no';

	// Used when enabling/disabling the mandatory fields for the module.
	// Refers to vtiger_field.fieldname values.
	var $mandatory_fields = Array('announcements_no','assigned_user_id');

	var $default_order_by = 'announcements_no';
	var $default_sort_order='ASC';

	/**
	* Invoked when special actions are performed on the module.
	* @param String Module name
	* @param String Event Type
	*/
	function vtlib_handler($moduleName, $eventType) {
		global $adb;
 		if($eventType == 'module.postinstall') {
			// TODO Handle actions after this module is installed.
		} else if($eventType == 'module.disabled') {
			// TODO Handle actions before this module is being uninstalled.
		} else if($eventType == 'module.preuninstall') {
			// TODO Handle actions when this module is about to be deleted.
		} else if($eventType == 'module.preupdate') {
			$query = $adb->pquery("DROP TABLE vtiger_announcements", array());
			// TODO Handle actions before this module is updated.
		} else if($eventType == 'module.postupdate') {
			$query = $adb->pquery("DROP TABLE vtiger_announcements", array());
			// TODO Handle actions after this module is updated.
		}
 	}

 	function save_module($module){
		// now handling in the crmentity for uitype 69
		$this->insertIntoAttachment($this->id,$module);
	}

	function insertIntoAttachment($id,$module)
	{
		global $log, $adb,$upload_badext;
		$log->debug("Entering into insertIntoAttachment($id,$module) method.");

		$file_saved = false;
		//This is to added to store the existing attachment id of the contact where we should delete this when we give new image
		
		$old_attachmentid = $adb->query_result($adb->pquery("select vtiger_crmentity.crmid from vtiger_seattachmentsrel inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_seattachmentsrel.attachmentsid where  vtiger_seattachmentsrel.crmid=?", array($id)),0,'crmid');
	
		if($_FILES['annos_file']['name'] != '' && $_FILES['annos_file']['size'] > 0){
			$_FILES['annos_file']['original_name'] = vtlib_purify($_REQUEST[$fileindex.'_hidden']);
			$file_saved = $this->uploadAndSaveFile($id,$module,$_FILES['annos_file']);
		}
	

		$imageNameSql = 'SELECT name FROM vtiger_seattachmentsrel INNER JOIN vtiger_attachments ON
								vtiger_seattachmentsrel.attachmentsid = vtiger_attachments.attachmentsid LEFT JOIN vtiger_announcements ON
								vtiger_announcements.announcementsid = vtiger_seattachmentsrel.crmid WHERE vtiger_seattachmentsrel.crmid = ?';
		$imageNameResult = $adb->pquery($imageNameSql,array($id));
		$imageName = decode_html($adb->query_result($imageNameResult, 0, "name"));

		//Inserting image information of record into base table
		$adb->pquery('UPDATE vtiger_announcements SET annos_file = ? WHERE announcementsid = ?',array($_FILES['annos_file']['name'],$id));

		//This is to handle the delete image for contacts
		if($module == 'Announcements' && $file_saved)
		{
			if($old_attachmentid != '')
			{
				$del_res1 = $adb->pquery("delete from vtiger_attachments where attachmentsid=?", array($old_attachmentid));
				$del_res2 = $adb->pquery("delete from vtiger_seattachmentsrel where attachmentsid=?", array($old_attachmentid));
			}
		}

		$log->debug("Exiting from insertIntoAttachment($id,$module) method.");
		
	}
}