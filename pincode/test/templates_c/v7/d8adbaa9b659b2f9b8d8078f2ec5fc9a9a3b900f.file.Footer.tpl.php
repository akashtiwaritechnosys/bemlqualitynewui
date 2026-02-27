<?php /* Smarty version Smarty-3.1.7, created on 2022-07-23 05:44:05
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\Vtiger\Footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1339441381627e56e1ba25b5-11106325%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd8adbaa9b659b2f9b8d8078f2ec5fc9a9a3b900f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\Vtiger\\Footer.tpl',
      1 => 1658555040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1339441381627e56e1ba25b5-11106325',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_627e56e1cce9e',
  'variables' => 
  array (
    'MODULE' => 0,
    'LANGUAGE_STRINGS' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_627e56e1cce9e')) {function content_627e56e1cce9e($_smarty_tpl) {?>

<footer class="app-footer">
    <div style="display: flex; height: 25px">
		<?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='Home'){?>
			<div style="width: 42px;background-color:#2C3B49"></div>
		<?php }else{ ?>
			<div></div>
		<?php }?>
	</div>
</footer>
</div>
<div id='overlayPage'>
	<div class='arrow'></div>
	<div class='data'>
	</div>
</div>
<div id='helpPageOverlay'></div>
<div id="js_strings" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['LANGUAGE_STRINGS']->value);?>
</div>
<div class="modal myModal fade"></div>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('JSResources.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <script src="<?php echo vresource_url('layouts/v7/feather.min.js');?>
"></script>
	<script>
        feather.replace()
    </script>
</body>

</html><?php }} ?>