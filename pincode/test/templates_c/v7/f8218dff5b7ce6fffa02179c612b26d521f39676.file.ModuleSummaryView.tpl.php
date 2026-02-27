<?php /* Smarty version Smarty-3.1.7, created on 2022-05-17 13:00:22
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\HelpDesk\ModuleSummaryView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:99241110362839c66dd0c65-55056195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8218dff5b7ce6fffa02179c612b26d521f39676' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\HelpDesk\\ModuleSummaryView.tpl',
      1 => 1651513330,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99241110362839c66dd0c65-55056195',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62839c66dfbb3',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62839c66dfbb3')) {function content_62839c66dfbb3($_smarty_tpl) {?>
<div class="recordDetails"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('SummaryViewContents.tpl',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
</div><?php }} ?>