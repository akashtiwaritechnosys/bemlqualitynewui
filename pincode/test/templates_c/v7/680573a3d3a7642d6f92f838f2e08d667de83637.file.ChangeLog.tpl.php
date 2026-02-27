<?php /* Smarty version Smarty-3.1.7, created on 2022-06-17 08:28:44
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\Settings\ITS4YouInstaller\ChangeLog.tpl" */ ?>
<?php /*%%SmartyHeaderCode:45353610062ac3b3c915af0-44395460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '680573a3d3a7642d6f92f838f2e08d667de83637' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\Settings\\ITS4YouInstaller\\ChangeLog.tpl',
      1 => 1655454498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '45353610062ac3b3c915af0-44395460',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'QUALIFIED_MODULE' => 0,
    'EXTENSION' => 0,
    'MODULE_ACTION' => 0,
    'MODULE_CHANGES' => 0,
    'MODULE_CHANGE' => 0,
    'EXTENSION_TYPE' => 0,
    'IS_AUTH' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62ac3b3c98412',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62ac3b3c98412')) {function content_62ac3b3c98412($_smarty_tpl) {?>
<div class="modal-dialog modal-lg changeLog"><div class='modal-content'><div class="modal-header"><div class="clearfix"><div class="pull-right " ><button type="button" class="close" aria-label="Close" data-dismiss="modal"><span aria-hidden="true" class='fa fa-close'></span></button></div><h4 class="pull-left"><?php echo vtranslate('LBL_CHANGELOG_INFORMATION',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h4></div></div><div class="modal-body" id="changeLog"><h4><b><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getExtensionLabel();?>
&nbsp;<?php if ('Upgrade'==$_smarty_tpl->tpl_vars['MODULE_ACTION']->value){?><?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getVersion();?>
&nbsp;<?php echo vtranslate('LBL_UPDATE_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getPackageVersion();?>
<?php }else{ ?><?php echo vtranslate('LBL_INSTALL_TO',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
&nbsp;<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->getPackageVersion();?>
<?php }?></b></h4><br><?php if (empty($_smarty_tpl->tpl_vars['MODULE_CHANGES']->value)){?><div class="alert alert-warning"><?php echo vtranslate('LBL_MISSING_CHANGELOG',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div><?php }else{ ?><?php  $_smarty_tpl->tpl_vars['MODULE_CHANGE'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['MODULE_CHANGE']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['MODULE_CHANGES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['MODULE_CHANGE']->key => $_smarty_tpl->tpl_vars['MODULE_CHANGE']->value){
$_smarty_tpl->tpl_vars['MODULE_CHANGE']->_loop = true;
?><div><h4><?php echo $_smarty_tpl->tpl_vars['MODULE_CHANGE']->value['version'];?>
</h4><hr><div style="white-space: pre-line;"><?php echo decode_html($_smarty_tpl->tpl_vars['MODULE_CHANGE']->value['description']);?>
</div><br></div><?php } ?><?php }?></div><div class="modal-footer"><span class="extension_container"><?php if ($_smarty_tpl->tpl_vars['EXTENSION']->value->isVtigerCompatible()){?><input type="hidden" name="extensionName" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('name');?>
"/><input type="hidden" name="extensionUrl" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('downloadURL');?>
"/><input type="hidden" name="extensionId" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION']->value->get('id');?>
"/><input type="hidden" name="extensionType" value="<?php echo $_smarty_tpl->tpl_vars['EXTENSION_TYPE']->value;?>
"/><input type="hidden" name="moduleMode" value="oneClickInstall"/><?php if (!$_smarty_tpl->tpl_vars['EXTENSION']->value->isAlreadyExists()){?><input type="hidden" name="moduleAction" value="Install"/><button class="oneClickInstall btn btn-primary <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value){?>authenticated <?php }else{ ?> loginRequired<?php }?>"><?php echo vtranslate('LBL_INSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }elseif($_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradable()||$_smarty_tpl->tpl_vars['EXTENSION']->value->isUpgradableMulti()){?><input type="hidden" name="moduleAction" value="Upgrade"/><button class="oneClickInstall isUpdateBtn btn btn-success margin0px <?php if ($_smarty_tpl->tpl_vars['IS_AUTH']->value){?>authenticated <?php }else{ ?> loginRequired<?php }?>"><?php echo vtranslate('LBL_UPDATE',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button><?php }?><?php }?></span></div></div></div><?php }} ?>