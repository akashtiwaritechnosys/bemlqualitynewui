<?php /* Smarty version Smarty-3.1.7, created on 2022-06-17 08:31:38
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\PDFMaker\Uninstall.tpl" */ ?>
<?php /*%%SmartyHeaderCode:48160491862ac3a4193de58-16965302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bb29a6525d2d283297514f314d184a8d444dbe1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\PDFMaker\\Uninstall.tpl',
      1 => 1655454622,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '48160491862ac3a4193de58-16965302',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62ac3a41c0661',
  'variables' => 
  array (
    'MODE' => 0,
    'MODULE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62ac3a41c0661')) {function content_62ac3a41c0661($_smarty_tpl) {?>
<div class="container-fluid" id="UninstallPDFMakerContainer"><form name="profiles_privilegies" action="index.php" method="post" class="form-horizontal"><br><label class="pull-left themeTextColor font-x-x-large"><?php echo vtranslate('LBL_UNINSTALL','PDFMaker');?>
</label><br clear="all"><hr><input type="hidden" name="module" value="PDFMaker" /><input type="hidden" name="view" value="" /><br /><div class="row-fluid"><label class="fieldLabel"><strong><?php echo vtranslate('LBL_UNINSTALL_DESC','PDFMaker');?>
:</strong></label><br><table class="table table-bordered table-condensed themeTableColor"><thead><tr class="blockHeader"><th class="mediumWidthType"><span class="alignMiddle"><?php echo vtranslate('LBL_UNINSTALL','PDFMaker');?>
</span></th></tr></thead><tbody><tr><td class="textAlignCenter"><button id="uninstall_pdfmaker_btn" type="button" class="btn btn-danger marginLeftZero"><?php echo vtranslate('LBL_UNINSTALL','PDFMaker');?>
</button></td></tr></tbody></table></div><?php if ($_smarty_tpl->tpl_vars['MODE']->value=="edit"){?><div class="pull-right"><button class="btn btn-success" type="submit"><?php echo vtranslate('LBL_SAVE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</button><a class="cancelLink" onclick="javascript:window.history.back();" type="reset"><?php echo vtranslate('LBL_CANCEL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</a></div><?php }?></form></div><?php }} ?>