<?php /* Smarty version Smarty-3.1.7, created on 2022-06-28 08:26:44
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\ServiceReports\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135327094962bab328cae383-73179386%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '033279eb07b4587858e5f75470f5a3e70775f83e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\ServiceReports\\DetailViewSummaryContents.tpl',
      1 => 1656404179,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '135327094962bab328cae383-73179386',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62bab328cb3f7',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62bab328cb3f7')) {function content_62bab328cb3f7($_smarty_tpl) {?><form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>