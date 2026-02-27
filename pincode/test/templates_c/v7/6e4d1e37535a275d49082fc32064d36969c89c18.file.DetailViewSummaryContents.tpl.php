<?php /* Smarty version Smarty-3.1.7, created on 2022-07-01 11:11:19
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\StockTransferOrders\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:41770526662bed6578b5209-87972581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e4d1e37535a275d49082fc32064d36969c89c18' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\StockTransferOrders\\DetailViewSummaryContents.tpl',
      1 => 1651513275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41770526662bed6578b5209-87972581',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62bed6578ce71',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62bed6578ce71')) {function content_62bed6578ce71($_smarty_tpl) {?>
<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>