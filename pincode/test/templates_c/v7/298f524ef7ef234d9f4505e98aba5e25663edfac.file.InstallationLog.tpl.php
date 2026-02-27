<?php /* Smarty version Smarty-3.1.7, created on 2022-06-17 08:30:22
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\Settings\ITS4YouInstaller\InstallationLog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46638766462ac3b9e73ebd0-04778185%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '298f524ef7ef234d9f4505e98aba5e25663edfac' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\Settings\\ITS4YouInstaller\\InstallationLog.tpl',
      1 => 1655454498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46638766462ac3b9e73ebd0-04778185',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'ERROR' => 0,
    'MODULE_ACTION' => 0,
    'QUALIFIED_MODULE' => 0,
    'ERRORS' => 0,
    'EXTENSIONS' => 0,
    'EXTENSION' => 0,
    'TARGET_MODULE_INSTANCE' => 0,
    'MODULE_FILE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62ac3b9e780bc',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62ac3b9e780bc')) {function content_62ac3b9e780bc($_smarty_tpl) {?>
<div class="modal-dialog modal-lg installationLog"><div class='modal-content'><div class="modal-header" style="background: #596875;color:white;"><div class="pull-right " ><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div><div class="row"><div class="col-lg-11 col-md-11"><?php if ($_smarty_tpl->tpl_vars['ERROR']->value){?><input type="hidden" name="installationStatus" value="error" /><h3 class="modal-title" style="color: red"><?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value=="Upgrade"){?><?php echo vtranslate('LBL_UPGRADE_FAILED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_INSTALLATION_FAILED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></h3><?php }else{ ?><input type="hidden" name="installationStatus" value="success" /><h3 class="modal-title"><?php if ('Upgrade'==$_smarty_tpl->tpl_vars['MODULE_ACTION']->value){?><?php echo vtranslate('LBL_UPGRADE_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_INSTALL_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></h3><?php }?></div></div></div><div class="modal-body" id="installationLog"><h3><?php if ($_smarty_tpl->tpl_vars['MODULE_ACTION']->value=="Upgrade"){?><?php echo vtranslate('LBL_UPGRADE_LOG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_INSTALLATION_LOG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }?></h3><div id="extensionInstallationInfo" class="backgroundImageNone" style="background-color: white;"><?php  $_smarty_tpl->tpl_vars['ERROR'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['ERROR']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ERRORS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['ERROR']->key => $_smarty_tpl->tpl_vars['ERROR']->value){
$_smarty_tpl->tpl_vars['ERROR']->_loop = true;
?><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR']->value['EXTENSION'],$_smarty_tpl->tpl_vars['ERROR']->value['EXTENSION']);?>
</h4><p style="color:red;"><?php echo vtranslate($_smarty_tpl->tpl_vars['ERROR']->value['message'],$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</p><?php } ?><?php  $_smarty_tpl->tpl_vars['EXTENSION'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['EXTENSION']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['EXTENSIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['EXTENSION']->key => $_smarty_tpl->tpl_vars['EXTENSION']->value){
$_smarty_tpl->tpl_vars['EXTENSION']->_loop = true;
?><h4><?php echo vtranslate($_smarty_tpl->tpl_vars['EXTENSION']->value->getName(),$_smarty_tpl->tpl_vars['EXTENSION']->value->getName());?>
</h4><?php $_smarty_tpl->tpl_vars['MODULE_FILE_NAME'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSION']->value->getModuleFile(), null, 0);?><?php $_smarty_tpl->tpl_vars['TARGET_MODULE_INSTANCE'] = new Smarty_variable($_smarty_tpl->tpl_vars['EXTENSION']->value->getModule(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()&&$_smarty_tpl->tpl_vars['MODULE_ACTION']->value=='Upgrade'){?><?php if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable()){?><?php echo vtranslate('LBL_ALREADY_UPGRADED',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->update($_smarty_tpl->tpl_vars['TARGET_MODULE_INSTANCE']->value,$_smarty_tpl->tpl_vars['MODULE_FILE_NAME']->value);?>
<?php }?><?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->import($_smarty_tpl->tpl_vars['MODULE_FILE_NAME']->value,false);?>
<?php }?><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->saveVersion();?>
<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->deleteModuleFile();?>
<?php } ?></div></div><div class="modal-footer"><span class="pull-right"><button class="btn btn-success" id="importCompleted" onclick="location.reload()"><?php echo vtranslate('LBL_OK',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></span></div></div></div><?php }} ?>