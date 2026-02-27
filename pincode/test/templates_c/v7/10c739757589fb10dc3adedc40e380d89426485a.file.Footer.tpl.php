<?php /* Smarty version Smarty-3.1.7, created on 2022-07-30 14:04:54
         compiled from "C:\xampp\htdocs\Pincode\includes\runtime/../../layouts/v7\modules\Vtiger\Footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:46175566262e53a860518c6-39761030%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10c739757589fb10dc3adedc40e380d89426485a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Pincode\\includes\\runtime/../../layouts/v7\\modules\\Vtiger\\Footer.tpl',
      1 => 1658555040,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '46175566262e53a860518c6-39761030',
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
  'unifunc' => 'content_62e53a861a61f',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62e53a861a61f')) {function content_62e53a861a61f($_smarty_tpl) {?>

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