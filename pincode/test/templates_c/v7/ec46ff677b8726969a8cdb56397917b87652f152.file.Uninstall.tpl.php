<?php /* Smarty version Smarty-3.1.7, created on 2022-06-17 08:27:40
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\Settings\ITS4YouInstaller\Uninstall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46319671762ac3afc6dbdd0-55965228%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ec46ff677b8726969a8cdb56397917b87652f152' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\Settings\\ITS4YouInstaller\\Uninstall.tpl',
      1 => 1655454451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46319671762ac3afc6dbdd0-55965228',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'LICENSE' => 0,
    'QUALIFIED_MODULE' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62ac3afc6e7bd',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62ac3afc6e7bd')) {function content_62ac3afc6e7bd($_smarty_tpl) {?>
<div class="uninstallContainer" id="Uninstall_<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
_Container" style="padding: 15px; background: #fff;"><form name="profiles_privilegies" action="index.php" method="post" class="form-horizontal"><input type="hidden" name="module" value="<?php echo $_smarty_tpl->tpl_vars['MODULE']->value;?>
" /><input type="hidden" name="view" value="" /><input type="hidden" name="license_key_val" id="license_key_val" value="<?php echo $_smarty_tpl->tpl_vars['LICENSE']->value;?>
" /><div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><h3><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</h3><hr></div></div><br><div class="row"><div class="col-sm-12 col-md-12 col-lg-12"><table class="table table-bordered table-condensed themeTableColor"><thead><tr class="blockHeader"><th class="mediumWidthType" colspan="2"><span class="alignMiddle"><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</span></th></tr></thead><tbody><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo vtranslate($_smarty_tpl->tpl_vars['MODULE']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</td></tr><?php if (class_exists('ITS4YouInstaller_Version_Helper')){?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_MODULE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_VERSION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo ITS4YouInstaller_Version_Helper::getVersion();?>
</td></tr><?php }?><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('Vtiger',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo vtranslate('LBL_VERSION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><?php echo Vtiger_Version::current();?>
</td></tr><tr><td style="width: 25%"><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_URL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</label></td><td style="border-left: none;"><div class="pull-left" id="vatid_label"><?php echo vglobal('site_URL');?>
</div></td></tr><tr><td><label class="muted pull-right marginRight10px"><?php echo vtranslate('LBL_DESCRIPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label></td><td><div class="clearfix"><div class="alert alert-danger displayInlineBlock"><?php echo vtranslate('LBL_UNINSTALL_DESC',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</div></div></td></tr></tbody></table><div class="textAlignCenter"><button id="ITS4YouUninstall_btn" type="button" class="btn btn-danger marginLeftZero"><?php echo vtranslate('LBL_UNINSTALL',$_smarty_tpl->tpl_vars['QUALIFIED_MODULE']->value);?>
</button></div></div></div></form></div><?php }} ?>