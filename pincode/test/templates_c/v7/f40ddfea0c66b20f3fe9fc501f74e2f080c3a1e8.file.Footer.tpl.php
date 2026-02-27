<?php /* Smarty version Smarty-3.1.7, created on 2022-08-18 10:42:10
         compiled from "/var/www/html/pincode/includes/runtime/../../layouts/v7/modules/Vtiger/Footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:59630838662fe178282a060-76819979%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f40ddfea0c66b20f3fe9fc501f74e2f080c3a1e8' => 
    array (
      0 => '/var/www/html/pincode/includes/runtime/../../layouts/v7/modules/Vtiger/Footer.tpl',
      1 => 1658555042,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '59630838662fe178282a060-76819979',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MODULE' => 0,
    'LANGUAGE_STRINGS' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62fe178282ef9',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62fe178282ef9')) {function content_62fe178282ef9($_smarty_tpl) {?>

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