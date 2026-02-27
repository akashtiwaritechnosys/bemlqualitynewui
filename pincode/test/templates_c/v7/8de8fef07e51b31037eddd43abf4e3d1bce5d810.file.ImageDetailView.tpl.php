<?php /* Smarty version Smarty-3.1.7, created on 2022-06-11 13:33:47
         compiled from "C:\xampp\htdocs\bemlanother\includes\runtime/../../layouts/v7\modules\Vtiger\uitypes\ImageDetailView.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103876478762a499bb3a9c03-60109890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8de8fef07e51b31037eddd43abf4e3d1bce5d810' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bemlanother\\includes\\runtime/../../layouts/v7\\modules\\Vtiger\\uitypes\\ImageDetailView.tpl',
      1 => 1651513307,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103876478762a499bb3a9c03-60109890',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'RECORD' => 0,
    'IMAGE_INFO' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62a499bb3b2d4',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62a499bb3b2d4')) {function content_62a499bb3b2d4($_smarty_tpl) {?>
<?php  $_smarty_tpl->tpl_vars['IMAGE_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['ITER'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RECORD']->value->getImageDetails(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['IMAGE_INFO']->key => $_smarty_tpl->tpl_vars['IMAGE_INFO']->value){
$_smarty_tpl->tpl_vars['IMAGE_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['ITER']->value = $_smarty_tpl->tpl_vars['IMAGE_INFO']->key;
?>
	<?php if (!empty($_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'])){?>
		<img src="<?php echo $_smarty_tpl->tpl_vars['IMAGE_INFO']->value['url'];?>
" width="150" height="80">
	<?php }?>
<?php } ?><?php }} ?>