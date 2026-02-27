<?php /* Smarty version Smarty-3.1.7, created on 2022-05-17 14:48:55
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\Invoice\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19305640336283b5d757e888-12892004%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '193b365c514c1bb8b252043ff36600ed4c0bfead' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\Invoice\\DetailViewSummaryContents.tpl',
      1 => 1651513333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19305640336283b5d757e888-12892004',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6283b5d75a267',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6283b5d75a267')) {function content_6283b5d75a267($_smarty_tpl) {?>
<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>