<?php /* Smarty version Smarty-3.1.7, created on 2022-06-10 14:03:00
         compiled from "C:\xampp\htdocs\bemlanother\includes\runtime/../../layouts/v7\modules\Settings\ITS4YouInstaller\Reminder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:143925307562a34f145f7fe5-58571661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '54774873c54c8b9cde894e2aaa9ab28fb81307f8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bemlanother\\includes\\runtime/../../layouts/v7\\modules\\Settings\\ITS4YouInstaller\\Reminder.tpl',
      1 => 1651513262,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '143925307562a34f145f7fe5-58571661',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'ALERTS' => 0,
    'ALERT' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62a34f1464671',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62a34f1464671')) {function content_62a34f1464671($_smarty_tpl) {?>
<li class="its4you_installer_menu"><div class="dropdown pull-left"><div class="dropdown-toggle displayInlineBlock" data-toggle="dropdown" aria-expanded="true"><a href="#" id="menubar_quickCreate" class="qc-button fa fa-bell" title="Quick Create" aria-hidden="true"></a></div><ul class="dropdown-menu its4you_installer_dropdown"><div id="its4you_installer_title"><div class="its4you_installer_text"  style="text-align:center;"> <?php echo vtranslate('REMINDERS',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b></div></div><hr><div style="padding:5px 15px"><div class="its4you_installer_alerts"><?php  $_smarty_tpl->tpl_vars['ALERT'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ALERT']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ALERTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ALERT']->key => $_smarty_tpl->tpl_vars['ALERT']->value){
$_smarty_tpl->tpl_vars['ALERT']->_loop = true;
?><div class="its4you_installer_alert clearfix <?php if ($_smarty_tpl->tpl_vars['ALERT']->value['status']!=1){?>installer_new_alert<?php }?>"><div class="pull-left installer_alert_icon"><i class="fa fa-<?php echo $_smarty_tpl->tpl_vars['ALERT']->value['icon'];?>
"></i></div><div class="pull-left" style="max-width: 300px;"><div><b><?php echo vtranslate($_smarty_tpl->tpl_vars['ALERT']->value['alert_type'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</b>&nbsp;<a style="padding: 0"><span>New Ticket is Opened </span></a></div><div style="color: #888"><?php if (!empty($_smarty_tpl->tpl_vars['ALERT']->value['createdtime'])){?><span><?php echo Vtiger_Util_Helper::formatDateIntoStrings($_smarty_tpl->tpl_vars['ALERT']->value['createdtime']);?>
</span>&nbsp;&nbsp;<?php }?></div></div></div><?php } ?></div><br><div style="text-align:center;"><a style="padding: 5px 12px;" href="index.php?module=ITS4YouQuickReminder&view=List&app=TOOLS" class="btn btn-primary">See All Reminders</a></div></div></ul></div><style>.<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_menu_icon {height: 37px;vertical-align: top;display: inline-block;line-height: 15px;}.installer_icon:after {content: ' ';display: inline-block;height: 15px;width: 15px;background: no-repeat url('layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon.png') center center / 15px 15px;}.its4you_installer_alerts {/*max-height: 500px;overflow: auto;*/width: 400px;}.its4you_installer_alert {padding: 0 0 10px 0;}#its4you_installer_title {display: block;position: relative;line-height: 50px;vertical-align: top;height: 50px;margin: 4px 10px;background: #EFEFEF;}.its4you_installer_text {line-height: 48px;display: inline-block;padding: 0 15px;font-size: 15px;margin: 0 0 0 50px;}.its4you_installer_icon {background: no-repeat url("layouts/v7/modules/Settings/ITS4YouInstaller/images/ITS4YouIcon50x50.png") center center / 50px 50px;color: #fff;text-align: center;vertical-align: middle;display: inline-block;line-height: 50px;width: 50px;height: 50px;position: absolute;}.installer_alert_icon .fa-warning{color: #ff0000;}.installer_alert_icon .fa-info-circle{color: #0088ff;}.installer_alert_icon .fa-refresh{color: #00aa00;}.installer_alert_icon .fa-question{color: #ffaa00;}.installer_alert_icon .fa-bell{color: #fd7e14;}.installer_alert_icon {width: 24px;height: 24px;margin: 12px 22px 12px 12px;}.installer_alert_icon .fa {font-size: 24px;}.its4you_installer_badge {position: absolute;right: 0;bottom: 0;border-radius: 10px;font: bold 10px Arial;padding: 3px 5px;background: #0088cc none repeat scroll 0 0;margin-bottom: 5px;}</style></li><?php }} ?>