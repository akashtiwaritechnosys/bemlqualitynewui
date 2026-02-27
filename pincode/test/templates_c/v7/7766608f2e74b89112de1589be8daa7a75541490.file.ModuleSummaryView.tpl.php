<?php /* Smarty version Smarty-3.1.7, created on 2022-07-01 11:11:19
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\StockTransferOrders\ModuleSummaryView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60613891262bed657768a82-00052871%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7766608f2e74b89112de1589be8daa7a75541490' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\StockTransferOrders\\ModuleSummaryView.tpl',
      1 => 1651513275,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60613891262bed657768a82-00052871',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62bed6577f84d',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62bed6577f84d')) {function content_62bed6577f84d($_smarty_tpl) {?>
<div class="recordDetails"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>