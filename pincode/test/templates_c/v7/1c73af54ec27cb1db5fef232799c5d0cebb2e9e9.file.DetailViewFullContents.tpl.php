<?php /* Smarty version Smarty-3.1.7, created on 2022-07-29 08:34:20
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\ServiceOrders\DetailViewFullContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:158513274062dd828fdda441-84303768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c73af54ec27cb1db5fef232799c5d0cebb2e9e9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\ServiceOrders\\DetailViewFullContents.tpl',
      1 => 1659082558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '158513274062dd828fdda441-84303768',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62dd828fe52c9',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'RECORD_STRUCTURE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62dd828fe52c9')) {function content_62dd828fe52c9($_smarty_tpl) {?><form id="detailView" method="POST">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('LineItemsDetail.tpl','ServiceOrders'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</form>
<?php }} ?>