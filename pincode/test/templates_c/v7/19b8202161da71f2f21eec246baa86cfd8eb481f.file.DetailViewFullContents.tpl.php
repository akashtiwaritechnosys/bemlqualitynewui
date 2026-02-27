<?php /* Smarty version Smarty-3.1.7, created on 2022-06-28 08:22:34
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\ServiceReports\DetailViewFullContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:87351064362bab3182854e6-85152226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19b8202161da71f2f21eec246baa86cfd8eb481f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\ServiceReports\\DetailViewFullContents.tpl',
      1 => 1656404506,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '87351064362bab3182854e6-85152226',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62bab31828ba5',
  'variables' => 
  array (
    'MODULE_NAME' => 0,
    'RECORD_STRUCTURE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62bab31828ba5')) {function content_62bab31828ba5($_smarty_tpl) {?><form id="detailView" method="POST">
    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('DetailViewBlockView.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('RECORD_STRUCTURE'=>$_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value,'MODULE_NAME'=>$_smarty_tpl->tpl_vars['MODULE_NAME']->value), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('LineItemsDetail.tpl','ServiceReports'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

</form>
<?php }} ?>