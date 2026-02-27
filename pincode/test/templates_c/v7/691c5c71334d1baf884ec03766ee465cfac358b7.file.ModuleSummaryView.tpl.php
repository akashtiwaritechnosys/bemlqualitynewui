<?php /* Smarty version Smarty-3.1.7, created on 2022-05-17 14:48:55
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\Invoice\ModuleSummaryView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11550129346283b5d74dafd3-93037331%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '691c5c71334d1baf884ec03766ee465cfac358b7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\Invoice\\ModuleSummaryView.tpl',
      1 => 1651513332,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11550129346283b5d74dafd3-93037331',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_6283b5d74e92b',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_6283b5d74e92b')) {function content_6283b5d74e92b($_smarty_tpl) {?>
<div class="recordDetails"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>