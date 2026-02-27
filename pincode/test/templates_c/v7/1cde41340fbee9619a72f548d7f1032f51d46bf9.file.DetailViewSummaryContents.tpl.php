<?php /* Smarty version Smarty-3.1.7, created on 2022-05-17 13:00:23
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\HelpDesk\DetailViewSummaryContents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:77408028662839c670ae029-52100623%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cde41340fbee9619a72f548d7f1032f51d46bf9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\HelpDesk\\DetailViewSummaryContents.tpl',
      1 => 1651513331,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '77408028662839c670ae029-52100623',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62839c670c1e3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62839c670c1e3')) {function content_62839c670c1e3($_smarty_tpl) {?>
<form id="detailView" method="POST"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewWidgets.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</form><?php }} ?>