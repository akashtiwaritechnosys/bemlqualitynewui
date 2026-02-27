<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

class Settings_LabelManager_LabelManager_View extends Settings_Vtiger_Index_View {
	public static $languageContainer;
	function __construct() {
		parent::__construct();
		$this->exposeMethod('languageSettings');
		$this->exposeMethod('languageManage');
		$this->exposeMethod('addNewLabelPopup');
	}

	public function process (Vtiger_Request $request) {
		$mode = $request->getMode();
		if($mode){
			echo $this->invokeExposedMethod($mode, $request);
			return;
		}
	}
	
	public function languageSettings(Vtiger_Request $request) {
		global $adb;
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
		
		$allModule = Settings_Workflows_Module_Model::getSupportedModules();
		$supportModules = array();
		foreach($allModule as $key => $value){
			$modulename = $value->name;
			$supportModules[$modulename] = $modulename;
		}

		//Added new feature
		$supportModules['Vtiger'] = 'Vtiger';
		$supportModules['Home'] = 'Home';
		//Added new feature

		$languagesList = Settings_LabelManager_LabelManager_View::getLanguagesList();
		
		$viewer->assign('LANGUAGES', $languagesList);
		$viewer->assign('supportModules',$supportModules);
		$viewer->view('SettingsView.tpl', $qualifiedModuleName);
	}

	public function getLanguagesList() {
		$adb = PearDatabase::getInstance();

		$language_query = 'SELECT prefix, label FROM vtiger_language';
		$result = $adb->pquery($language_query, array());
		$num_rows = $adb->num_rows($result);
		for($i = 0; $i<$num_rows; $i++) {
			$lang_prefix = decode_html($adb->query_result($result, $i, 'prefix'));
			$label = decode_html($adb->query_result($result, $i, 'label'));
			$languages_list[$lang_prefix] = $label;
		}
		asort($languages_list);
		return $languages_list;
	}
	
	public function languageManage(Vtiger_Request $request) {
		global $adb, $root_directory;
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
		$sourceModule = $request->get('sourceModule');
		$language = $request->get('language');
		
		$languageFilename = $root_directory.'/languages/'.$language.'/'.$sourceModule.'.php';
		
		$tabidQuery = $adb->pquery("SELECT * FROM vtiger_tab WHERE name = ?", array($sourceModule));
		$tabid = $adb->query_result($tabidQuery, 0, 'tabid');
		$query = $adb->pquery("SELECT * FROM vtiger_field WHERE tabid = ? AND fieldLabel NOT IN('starred','tags')", array($tabid));
		$rows = $adb->num_rows($query);
		
		$modulefields = array();
		for($i = 0;$i < $rows;$i++) {
			$fieldLabel = $adb->query_result($query,$i,'fieldlabel');
			$translateLabel = Vtiger_Language_Handler::getLanguageTranslatedString($language, $fieldLabel, $module = '');
			$modulefields[$adb->query_result($query,$i,'fieldlabel')] = $translateLabel;
		}
		
		if (file_exists($languageFilename)) {
            require $languageFilename;
            self::$languageContainer[$language][$sourceModule]['languageStrings'] = $languageStrings;
			self::$languageContainer[$language][$sourceModule]['jsLanguageStrings'] = $jsLanguageStrings;
        }

        $languageFileArray = isset(self::$languageContainer[$language][$sourceModule]) ? self::$languageContainer[$language][$sourceModule] : array();
	
		$viewer->assign('supportModules',$supportModules);
		$viewer->assign('languageStrings',$languageFileArray['languageStrings']);
		$viewer->assign('jsLanguageStrings',$languageFileArray['jsLanguageStrings']);
		$viewer->assign('sourceModule',$sourceModule);
		$viewer->assign('language',$language);
		$viewer->view('LanguageManage.tpl', $qualifiedModuleName);
	}

	public function getHeaderScripts(Vtiger_Request $request) {
		$headerScriptInstances = parent::getHeaderScripts($request);
		$moduleName = $request->getModule();

		$jsFileNames = array(
			'modules.Settings.LabelManager.resources.LabelManager',
		);

		$jsScriptInstances = $this->checkAndConvertJsScripts($jsFileNames);
		$headerScriptInstances = array_merge($headerScriptInstances, $jsScriptInstances);
		return $headerScriptInstances;
	}

	public function addNewLabelPopup(Vtiger_Request $request) {
		$viewer = $this->getViewer($request);
		$qualifiedModuleName = $request->getModule(false);
		$sourceModule = $request->get('sourceModule');
		$language = $request->get('language');

		$viewer->assign('sourceModule',$sourceModule);
		$viewer->assign('language',$language);
		$viewer->assign('QUALIFIED_MODULE',$qualifiedModuleName);
		echo $viewer->view('AddNewLabelPopup.tpl', $qualifiedModuleName, true);
	}
	
}