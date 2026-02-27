<?php /* Smarty version Smarty-3.1.7, created on 2022-07-29 06:32:46
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\StockTransferOrders\partials\LineItemsEdit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13594619162e038254317c1-37113260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11182772ca21298ff27965b965224912cee21952' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\StockTransferOrders\\partials\\LineItemsEdit.tpl',
      1 => 1659076362,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13594619162e038254317c1-37113260',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62e038254a06e',
  'variables' => 
  array (
    'RECORD_STRUCTURE' => 0,
    'LINEITEM_FIELDS' => 0,
    'IMAGE_EDITABLE' => 0,
    'COL_SPAN1' => 0,
    'PRODUCT_EDITABLE' => 0,
    'QUANTITY_EDITABLE' => 0,
    'PURCHASE_COST_EDITABLE' => 0,
    'COL_SPAN2' => 0,
    'LIST_PRICE_EDITABLE' => 0,
    'MARGIN_EDITABLE' => 0,
    'COL_SPAN3' => 0,
    'RELATED_PRODUCTS' => 0,
    'TAX_TYPE' => 0,
    'USER_MODEL' => 0,
    'row_no' => 0,
    'LINE_ITEM_BLOCK_LABEL' => 0,
    'BLOCK_FIELDS' => 0,
    'BLOCK_LABEL' => 0,
    'MODULE' => 0,
    'DEFAULT_TAX_REGION_INFO' => 0,
    'TAX_REGIONS' => 0,
    'TAX_REGION_ID' => 0,
    'TAX_REGION_INFO' => 0,
    'RECORD' => 0,
    'CURRENCINFO' => 0,
    'SELECTED_CURRENCY' => 0,
    'CURRENCIES' => 0,
    'currency_details' => 0,
    'USER_CURRENCY_ID' => 0,
    'RECORD_STRUCTURE_MODEL' => 0,
    'RECORD_CURRENCY_RATE' => 0,
    'IS_INDIVIDUAL_TAX_TYPE' => 0,
    'IS_GROUP_TAX_TYPE' => 0,
    'data' => 0,
    'PRODUCT_ACTIVE' => 0,
    'SERVICE_ACTIVE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62e038254a06e')) {function content_62e038254a06e($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['LINEITEM_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value['LBL_ITEM_DETAILS'], null, 0);?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']){?><?php $_smarty_tpl->tpl_vars['IMAGE_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']){?><?php $_smarty_tpl->tpl_vars['PRODUCT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']){?><?php $_smarty_tpl->tpl_vars['QUANTITY_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['QUANTITY_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']){?><?php $_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']){?><?php $_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']){?><?php $_smarty_tpl->tpl_vars['MARGIN_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->isEditable(), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN3']->value)+1, null, 0);?><?php }?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']){?><?php $_smarty_tpl->tpl_vars['COMMENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']){?><?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']){?><?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']){?><?php $_smarty_tpl->tpl_vars['SH_PERCENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']){?><?php $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']->isEditable(), null, 0);?><?php }?><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']){?><?php $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_EDITABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']->isEditable(), null, 0);?><?php }?><?php $_smarty_tpl->tpl_vars["FINAL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'], null, 0);?><?php $_smarty_tpl->tpl_vars["IS_INDIVIDUAL_TAX_TYPE"] = new Smarty_variable(true, null, 0);?><?php $_smarty_tpl->tpl_vars["IS_GROUP_TAX_TYPE"] = new Smarty_variable(false, null, 0);?><?php if ($_smarty_tpl->tpl_vars['TAX_TYPE']->value=='individual'){?><?php $_smarty_tpl->tpl_vars["IS_GROUP_TAX_TYPE"] = new Smarty_variable(false, null, 0);?><?php $_smarty_tpl->tpl_vars["IS_INDIVIDUAL_TAX_TYPE"] = new Smarty_variable(true, null, 0);?><?php }?><input type="hidden" class="numberOfCurrencyDecimal" value="<?php echo $_smarty_tpl->tpl_vars['USER_MODEL']->value->get('no_of_currency_decimals');?>
" /><input type="hidden" name="totalProductCount" id="totalProductCount" value="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" /><input type="hidden" name="subtotal" id="subtotal" value="" /><input type="hidden" name="total" id="total" value="" /><div name='editContent'><?php $_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL'] = new Smarty_variable("LBL_ITEM_DETAILS", null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE']->value[$_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL']->value], null, 0);?><?php $_smarty_tpl->tpl_vars['BLOCK_LABEL'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINE_ITEM_BLOCK_LABEL']->value, null, 0);?><?php if (count($_smarty_tpl->tpl_vars['BLOCK_FIELDS']->value)>0){?><div class='fieldBlockContainer'><div class="row"><div class="col-sm-3"><h4 class='fieldBlockHeader' style="margin-top:5px;"><?php echo vtranslate($_smarty_tpl->tpl_vars['BLOCK_LABEL']->value,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</h4></div><div style="display:none" class="col-sm-9 well"><div class="row"><div class="col-sm-4"><?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']&&$_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->isEditable()){?><span class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->get('label'),$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<select class="select2" id="region_id" name="region_id" style="width: 164px;"><option value="0" data-info="<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['DEFAULT_TAX_REGION_INFO']->value));?>
"><?php echo vtranslate('LBL_SELECT_OPTION',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><?php  $_smarty_tpl->tpl_vars['TAX_REGION_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['TAX_REGION_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['TAX_REGIONS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->key => $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value){
$_smarty_tpl->tpl_vars['TAX_REGION_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value = $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['TAX_REGION_ID']->value;?>
" data-info='<?php echo Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value));?>
' <?php if ($_smarty_tpl->tpl_vars['TAX_REGION_ID']->value==$_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')){?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['TAX_REGION_INFO']->value['name'];?>
</option><?php } ?></select><input type="hidden" id="prevRegionId" value="<?php echo $_smarty_tpl->tpl_vars['RECORD']->value->get('region_id');?>
" /><a class="fa fa-wrench hidden-xs" href="index.php?module=Vtiger&parent=Settings&view=TaxIndex" target="_blank" style="vertical-align:middle;"></a></span><?php }?></div><div class="col-sm-4"><div class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate('LBL_CURRENCY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<?php $_smarty_tpl->tpl_vars['SELECTED_CURRENCY'] = new Smarty_variable($_smarty_tpl->tpl_vars['CURRENCINFO']->value, null, 0);?><?php if ($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value==''){?><?php $_smarty_tpl->tpl_vars['USER_CURRENCY_ID'] = new Smarty_variable($_smarty_tpl->tpl_vars['USER_MODEL']->value->get('currency_id'), null, 0);?><?php  $_smarty_tpl->tpl_vars['currency_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency_details']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->key => $_smarty_tpl->tpl_vars['currency_details']->value){
$_smarty_tpl->tpl_vars['currency_details']->_loop = true;
?><?php if ($_smarty_tpl->tpl_vars['currency_details']->value['curid']==$_smarty_tpl->tpl_vars['USER_CURRENCY_ID']->value){?><?php $_smarty_tpl->tpl_vars['SELECTED_CURRENCY'] = new Smarty_variable($_smarty_tpl->tpl_vars['currency_details']->value, null, 0);?><?php }?><?php } ?><?php }?><select class="select2" id="currency_id" name="currency_id" style="width: 150px;"><?php  $_smarty_tpl->tpl_vars['currency_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency_details']->_loop = false;
 $_smarty_tpl->tpl_vars['count'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->key => $_smarty_tpl->tpl_vars['currency_details']->value){
$_smarty_tpl->tpl_vars['currency_details']->_loop = true;
 $_smarty_tpl->tpl_vars['count']->value = $_smarty_tpl->tpl_vars['currency_details']->key;
?><option value="<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['curid'];?>
" class="textShadowNone" data-conversion-rate="<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['conversionrate'];?>
" <?php if ($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id']==$_smarty_tpl->tpl_vars['currency_details']->value['curid']){?> selected <?php }?>><?php echo getTranslatedCurrencyString($_smarty_tpl->tpl_vars['currency_details']->value['currencylabel']);?>
 (<?php echo $_smarty_tpl->tpl_vars['currency_details']->value['currencysymbol'];?>
)</option><?php } ?></select><?php $_smarty_tpl->tpl_vars["RECORD_CURRENCY_RATE"] = new Smarty_variable($_smarty_tpl->tpl_vars['RECORD_STRUCTURE_MODEL']->value->getRecord()->get('conversion_rate'), null, 0);?><?php if ($_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value==''){?><?php $_smarty_tpl->tpl_vars["RECORD_CURRENCY_RATE"] = new Smarty_variable($_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['conversionrate'], null, 0);?><?php }?><input type="hidden" name="conversion_rate" id="conversion_rate" value="<?php echo $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value;?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'];?>
" id="prev_selected_currency_id" /><!-- TODO : To get default currency in even better way than depending on first element --><input type="hidden" id="default_currency_id" value="<?php echo $_smarty_tpl->tpl_vars['CURRENCIES']->value[0]['curid'];?>
" /><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['SELECTED_CURRENCY']->value['currency_id'];?>
" id="selectedCurrencyId" /></div></div><div class="col-sm-4"><div class="pull-right"><i class="fa fa-info-circle"></i>&nbsp;<label><?php echo vtranslate('LBL_TAX_MODE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</label>&nbsp;<select class="select2 lineItemTax" id="taxtype" name="taxtype" style="width: 150px;"><option value="individual" <?php if ($_smarty_tpl->tpl_vars['IS_INDIVIDUAL_TAX_TYPE']->value){?>selected<?php }?>><?php echo vtranslate('LBL_INDIVIDUAL',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option><option value="group" <?php if ($_smarty_tpl->tpl_vars['IS_GROUP_TAX_TYPE']->value){?>selected<?php }?>><?php echo vtranslate('LBL_GROUP',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</option></select></div></div></div></div></div><div class="lineitemTableContainer"><table class="table table-bordered" id="lineItemTab"><tr><td><strong><?php echo vtranslate('LBL_TOOLS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value){?><td><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->get('label');?>
<?php $_tmp1=ob_get_clean();?><?php echo vtranslate($_tmp1,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><?php if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value){?><td><span class="redColor">*</span><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->get('label');?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp2,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td><?php }?><td><strong><?php echo vtranslate('LBL_QTY',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong></td></tr><tr id="row0" class="hide lineItemCloneCopy" data-row-num="0"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/LineItemsContent.tpl",'StockTransferOrders'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('row_no'=>0,'data'=>array(),'IGNORE_UI_REGISTRATION'=>true), 0);?>
</tr><?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['data']->_loop = false;
 $_smarty_tpl->tpl_vars['row_no'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
$_smarty_tpl->tpl_vars['data']->_loop = true;
 $_smarty_tpl->tpl_vars['row_no']->value = $_smarty_tpl->tpl_vars['data']->key;
?><tr id="row<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" data-row-num="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" class="lineItemRow" <?php if ($_smarty_tpl->tpl_vars['data']->value["entityType".($_smarty_tpl->tpl_vars['row_no']->value)]=='Products'){?>data-quantity-in-stock=<?php echo $_smarty_tpl->tpl_vars['data']->value["qtyInStock".($_smarty_tpl->tpl_vars['row_no']->value)];?>
<?php }?>><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/LineItemsContent.tpl",'StockTransferOrders'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('row_no'=>$_smarty_tpl->tpl_vars['row_no']->value,'data'=>$_smarty_tpl->tpl_vars['data']->value), 0);?>
</tr><?php } ?><?php if (count($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value)==0&&($_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value=='true'||$_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value=='true')){?><tr id="row1" class="lineItemRow" data-row-num="1"><?php echo $_smarty_tpl->getSubTemplate (vtemplate_path("partials/LineItemsContent.tpl",'StockTransferOrders'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('row_no'=>1,'data'=>array(),'IGNORE_UI_REGISTRATION'=>false), 0);?>
</tr><?php }?></table></div></div><?php }?></div><?php }} ?>