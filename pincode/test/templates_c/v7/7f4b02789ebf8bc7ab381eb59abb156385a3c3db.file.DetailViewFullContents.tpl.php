<?php /* Smarty version Smarty-3.1.7, created on 2022-07-26 18:59:38
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\StockTransferOrders\DetailViewFullContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:150859025962bed6503c3265-48745420%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f4b02789ebf8bc7ab381eb59abb156385a3c3db' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\StockTransferOrders\\DetailViewFullContents.tpl',
      1 => 1658861975,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '150859025962bed6503c3265-48745420',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62bed6503dc92',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'RECORD_STRUCTURE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62bed6503dc92')) {function content_62bed6503dc92($_smarty_tpl) {?><form id="detailView" method="POST">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('LineItemsDetail.tpl','StockTransferOrders'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</form>
<?php }} ?>