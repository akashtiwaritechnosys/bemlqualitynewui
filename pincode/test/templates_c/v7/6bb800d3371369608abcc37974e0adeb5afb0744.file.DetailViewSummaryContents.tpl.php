<?php /* Smarty version Smarty-3.1.7, created on 2022-07-24 17:34:01
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\ServiceOrders\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159705844162dd8289cd6036-91655872%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6bb800d3371369608abcc37974e0adeb5afb0744' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\ServiceOrders\\DetailViewSummaryContents.tpl',
      1 => 1651513275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159705844162dd8289cd6036-91655872',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62dd8289cdc61',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62dd8289cdc61')) {function content_62dd8289cdc61($_smarty_tpl) {?>
<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>