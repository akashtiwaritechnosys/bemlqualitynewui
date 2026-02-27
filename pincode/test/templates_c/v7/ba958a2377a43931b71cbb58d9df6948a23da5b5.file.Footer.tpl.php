<?php /* Smarty version Smarty-3.1.7, created on 2022-06-10 14:02:58
         compiled from "C:\xampp\htdocs\bemlanother\includes\runtime/../../layouts/v7\modules\Vtiger\Footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:207680994362a34f125e83a9-76842317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba958a2377a43931b71cbb58d9df6948a23da5b5' => 
    array (
      0 => 'C:\\xampp\\htdocs\\bemlanother\\includes\\runtime/../../layouts/v7\\modules\\Vtiger\\Footer.tpl',
      1 => 1651513295,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '207680994362a34f125e83a9-76842317',
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
  'unifunc' => 'content_62a34f1263636',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62a34f1263636')) {function content_62a34f1263636($_smarty_tpl) {?>

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
	<!-- arrow is added to point arrow to the clicked element (Ex:- TaskManagement), 
	any one can use this by adding "show" class to it -->
	<div class='arrow'></div>
	<div class='data'>
	</div>
</div>
<div id='helpPageOverlay'></div>
<div id="js_strings" class="hide noprint"><?php echo Zend_Json::encode($_smarty_tpl->tpl_vars['LANGUAGE_STRINGS']->value);?>
</div>
<div class="modal myModal fade"></div>
<?php echo $_smarty_tpl->getSubTemplate (vtemplate_path('JSResources.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js" integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g==" crossorigin="anonymous"></script>
    <script>
        feather.replace()
    </script>

</body>

</html><?php }} ?>