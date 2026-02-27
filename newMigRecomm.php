<?php
require_once("modules/com_vtiger_workflow/include.inc");
require_once("modules/com_vtiger_workflow/tasks/VTEntityMethodTask.inc");
require_once("modules/com_vtiger_workflow/VTEntityMethodManager.inc");
require_once("include/database/PearDatabase.php");
$adb = PearDatabase::getInstance();
$emm = new VTEntityMethodManager($adb);
require_once 'vtlib/Vtiger/Module.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('RecommissioningReports');
$blockInstance = Vtiger_Block::getInstance('Equipment_Status_after_Action_taken', $moduleInstance);
if ($blockInstance) {
    echo " block does not exits --- Equipment_Status_after_Action_taken   -- <br>";
} else {
    $blockInstance = new Vtiger_Block();
    $blockInstance->label = 'Equipment_Status_after_Action_taken';
    $moduleInstance->addBlock($blockInstance);
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('RecommissioningReports');
$blockInstance = Vtiger_Block::getInstance('Restoration_Date', $moduleInstance);
if ($blockInstance) {
    echo " block does not exits --- Restoration_Date   -- <br>";
} else {
    $blockInstance = new Vtiger_Block();
    $blockInstance->label = 'Restoration_Date';
    $moduleInstance->addBlock($blockInstance);
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('RecommissioningReports');
$blockInstance = Vtiger_Block::getInstance('Service_Engineer_Observations', $moduleInstance);
if ($blockInstance) {
    echo " block does not exits --- Service_Engineer_Observations   -- <br>";
} else {
    $blockInstance = new Vtiger_Block();
    $blockInstance->label = 'Service_Engineer_Observations';
    $moduleInstance->addBlock($blockInstance);
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;

$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;
$moduleInstance = Vtiger_Module::getInstance('RecommissioningReports');
$blockInstance = Vtiger_Block::getInstance('Off_Road', $moduleInstance);
if ($blockInstance) {
    echo " block does exits --- Off_Road   -- <br>";
} else {
    $blockInstance = new Vtiger_Block();
    $blockInstance->label = 'Off_Road';
    $moduleInstance->addBlock($blockInstance);
}
$moduleInstance = null;
$blockInstance = null;
$fieldInstance = null;