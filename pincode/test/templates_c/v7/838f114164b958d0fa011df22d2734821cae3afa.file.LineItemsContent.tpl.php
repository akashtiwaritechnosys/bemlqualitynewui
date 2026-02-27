<?php /* Smarty version Smarty-3.1.7, created on 2022-07-20 10:11:03
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\ServiceReports\partials\LineItemsContent.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94585026862bab2b0f0bc43-99587833%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '838f114164b958d0fa011df22d2734821cae3afa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\ServiceReports\\partials\\LineItemsContent.tpl',
      1 => 1658311854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94585026862bab2b0f0bc43-99587833',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62bab2b120e0f',
  'variables' => 
  array (
    'row_no' => 0,
    'entityIdentifier' => 0,
    'data' => 0,
    'RELATED_PRODUCTS' => 0,
    'hdnProductId' => 0,
    'productId' => 0,
    'MODULE' => 0,
    'purchaseCost' => 0,
    'qty' => 0,
    'RECORD_CURRENCY_RATE' => 0,
    'CURRENCIES' => 0,
    'currency_details' => 0,
    'IMAGE_EDITABLE' => 0,
    'image' => 0,
    'PRODUCT_EDITABLE' => 0,
    'tax_row_no' => 0,
    'productName' => 0,
    'productDeleted' => 0,
    'entityType' => 0,
    'PRODUCT_ACTIVE' => 0,
    'SERVICE_ACTIVE' => 0,
    'subproduct_ids' => 0,
    'subprod_names' => 0,
    'subprod_qty_list' => 0,
    'SUB_PRODUCT_INFO' => 0,
    'SUB_PRODUCT_ID' => 0,
    'COMMENT_EDITABLE' => 0,
    'comment' => 0,
    'QUANTITY_EDITABLE' => 0,
    'PURCHASE_COST_EDITABLE' => 0,
    'MARGIN_EDITABLE' => 0,
    'margin' => 0,
    'qtyInStock' => 0,
    'sr_action_one' => 0,
    'sr_action_two' => 0,
    'sr_replace_action' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62bab2b120e0f')) {function content_62bab2b120e0f($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars["deleted"] = new Smarty_variable(("deleted").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["image"] = new Smarty_variable(("productImage").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["purchaseCost"] = new Smarty_variable(("purchaseCost").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["margin"] = new Smarty_variable(("margin").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["hdnProductId"] = new Smarty_variable(("hdnProductId").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productName"] = new Smarty_variable(("productName").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["comment"] = new Smarty_variable(("comment").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productDescription"] = new Smarty_variable(("productDescription").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["qtyInStock"] = new Smarty_variable(("qtyInStock").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["qty"] = new Smarty_variable(("qty").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["sr_action_one"] = new Smarty_variable(("sr_action_one").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["sr_action_two"] = new Smarty_variable(("sr_action_two").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["sr_replace_action"] = new Smarty_variable(("sr_replace_action").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["listPrice"] = new Smarty_variable(("listPrice").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productTotal"] = new Smarty_variable(("productTotal").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["subproduct_ids"] = new Smarty_variable(("subproduct_ids").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["subprod_names"] = new Smarty_variable(("subprod_names").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["subprod_qty_list"] = new Smarty_variable(("subprod_qty_list").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["entityIdentifier"] = new Smarty_variable(("entityType").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["entityType"] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['entityIdentifier']->value], null, 0);?><?php $_smarty_tpl->tpl_vars["discount_type"] = new Smarty_variable(("discount_type").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["discount_percent"] = new Smarty_variable(("discount_percent").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["checked_discount_percent"] = new Smarty_variable(("checked_discount_percent").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["style_discount_percent"] = new Smarty_variable(("style_discount_percent").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["discount_amount"] = new Smarty_variable(("discount_amount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["checked_discount_amount"] = new Smarty_variable(("checked_discount_amount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["style_discount_amount"] = new Smarty_variable(("style_discount_amount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["checked_discount_zero"] = new Smarty_variable(("checked_discount_zero").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["discountTotal"] = new Smarty_variable(("discountTotal").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["totalAfterDiscount"] = new Smarty_variable(("totalAfterDiscount").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["taxTotal"] = new Smarty_variable(("taxTotal").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["netPrice"] = new Smarty_variable(("netPrice").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["FINAL"] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'], null, 0);?><?php $_smarty_tpl->tpl_vars["productDeleted"] = new Smarty_variable(("productDeleted").($_smarty_tpl->tpl_vars['row_no']->value), null, 0);?><?php $_smarty_tpl->tpl_vars["productId"] = new Smarty_variable($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value], null, 0);?><?php $_smarty_tpl->tpl_vars["listPriceValues"] = new Smarty_variable(Products_Record_Model::getListPriceValues($_smarty_tpl->tpl_vars['productId']->value), null, 0);?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value=='PurchaseOrder'){?><?php $_smarty_tpl->tpl_vars["listPriceValues"] = new Smarty_variable(array(), null, 0);?><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['RECORD_CURRENCY_RATE']->value;?>
<?php $_tmp1=ob_get_clean();?><?php ob_start();?><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo (((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]*$_tmp1));?><?php }else{ ?><?php echo "0";?><?php }?><?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["purchaseCost"] = new Smarty_variable($_tmp2, null, 0);?><?php  $_smarty_tpl->tpl_vars['currency_details'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['currency_details']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['CURRENCIES']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['currency_details']->key => $_smarty_tpl->tpl_vars['currency_details']->value){
$_smarty_tpl->tpl_vars['currency_details']->_loop = true;
?><?php $_smarty_tpl->createLocalArrayVariable('listPriceValues', null, 0);
$_smarty_tpl->tpl_vars['listPriceValues']->value[$_smarty_tpl->tpl_vars['currency_details']->value['currency_id']] = $_smarty_tpl->tpl_vars['currency_details']->value['conversionrate']*$_smarty_tpl->tpl_vars['purchaseCost']->value;?><?php } ?><?php }?><td style="text-align:center;"><i class="fa fa-trash deleteRow cursorPointer" title="<?php echo vtranslate('LBL_DELETE',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"></i>&nbsp;<a><img src="<?php echo vimage_path('drag.png');?>
" border="0" title="<?php echo vtranslate('LBL_DRAG',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"/></a><input type="hidden" class="rowNumber" value="<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" /></td><?php if ($_smarty_tpl->tpl_vars['IMAGE_EDITABLE']->value){?><td class='lineItemImage' style="text-align:center;"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['image']->value]){?>	<img src='<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['image']->value];?>
' height="42" width="42"> <?php }?></td><?php }?><?php if ($_smarty_tpl->tpl_vars['PRODUCT_EDITABLE']->value){?><td><!-- Product Re-Ordering Feature Code Addition Starts --><input type="hidden" name="hidtax_row_no<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" id="hidtax_row_no<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['tax_row_no']->value;?>
"/><!-- Product Re-Ordering Feature Code Addition ends --><div class="itemNameDiv form-inline"><div class="row"><div class="col-lg-10"><div class="input-group" style="width:100%"><input type="text" id="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['productName']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value];?>
" class="productName form-control <?php if ($_smarty_tpl->tpl_vars['row_no']->value!=0){?> autoComplete <?php }?> " placeholder="<?php echo vtranslate('LBL_TYPE_SEARCH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"data-rule-required=true <?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])){?> disabled="disabled" <?php }?>><?php if (!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value]){?><span class="input-group-addon cursorPointer clearLineItem" title="<?php echo vtranslate('LBL_CLEAR',$_smarty_tpl->tpl_vars['MODULE']->value);?>
"><i class="fa fa-times-circle"></i></span><?php }?><input type="hidden" id="<?php echo $_smarty_tpl->tpl_vars['hdnProductId']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['hdnProductId']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['hdnProductId']->value];?>
" class="selectedModuleId"/><input type="hidden" id="lineItemType<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" name="lineItemType<?php echo $_smarty_tpl->tpl_vars['row_no']->value;?>
" value="<?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
" class="lineItemType"/><div class="col-lg-2"><?php if ($_smarty_tpl->tpl_vars['row_no']->value==0){?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }elseif($_smarty_tpl->tpl_vars['entityType']->value==''&&$_smarty_tpl->tpl_vars['PRODUCT_ACTIVE']->value=='true'){?><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }elseif($_smarty_tpl->tpl_vars['entityType']->value==''&&$_smarty_tpl->tpl_vars['SERVICE_ACTIVE']->value=='true'){?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><?php }else{ ?><?php if (($_smarty_tpl->tpl_vars['entityType']->value=='Services')&&(!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])){?><span class="lineItemPopup cursorPointer" data-popup="ServicesPopup" title="<?php echo vtranslate('Services',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Services" data-field-name="serviceid"><?php echo Vtiger_Module_Model::getModuleIconPath('Services');?>
</span><?php }elseif((!$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value])){?><span class="lineItemPopup cursorPointer" data-popup="ProductsPopup" title="<?php echo vtranslate('Products',$_smarty_tpl->tpl_vars['MODULE']->value);?>
" data-module-name="Products" data-field-name="productid"><?php echo Vtiger_Module_Model::getModuleIconPath('Products');?>
</span><?php }?><?php }?></div></div></div></div></div><input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subproduct_ids']->value];?>
" id="<?php echo $_smarty_tpl->tpl_vars['subproduct_ids']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subproduct_ids']->value;?>
" class="subProductIds" /><div id="<?php echo $_smarty_tpl->tpl_vars['subprod_names']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['subprod_names']->value;?>
" class="subInformation"><span class="subProductsContainer"><?php  $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->_loop = false;
 $_smarty_tpl->tpl_vars['SUB_PRODUCT_ID'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['subprod_qty_list']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->key => $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value){
$_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->_loop = true;
 $_smarty_tpl->tpl_vars['SUB_PRODUCT_ID']->value = $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->key;
?><em> - <?php echo $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['name'];?>
 (<?php echo $_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['qty'];?>
)<?php if ($_smarty_tpl->tpl_vars['SUB_PRODUCT_INFO']->value['qty']>getProductQtyInStock($_smarty_tpl->tpl_vars['SUB_PRODUCT_ID']->value)){?>&nbsp;-&nbsp;<span class="redColor"><?php echo vtranslate('LBL_STOCK_NOT_ENOUGH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
</span><?php }?></em><br><?php } ?></span></div><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productDeleted']->value]){?><div class="row-fluid deletedItem redColor"><?php if (empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['productName']->value])){?><?php echo vtranslate('LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }else{ ?><?php echo vtranslate('LBL_THIS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['entityType']->value;?>
 <?php echo vtranslate('LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<?php }?></div><?php }else{ ?><?php if ($_smarty_tpl->tpl_vars['COMMENT_EDITABLE']->value){?><div><br><textarea id="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['comment']->value;?>
" class="lineItemCommentBox"><?php echo decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['comment']->value]);?>
</textarea></div><?php }?><?php }?></td><?php }?><td><input id="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" name="<?php echo $_smarty_tpl->tpl_vars['qty']->value;?>
" type="text" class="qty smallInputBox inputElement"data-rule-required=true data-rule-positive=true data-rule-greater_than_zero=true value="<?php if (!empty($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value])){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value];?>
<?php }else{ ?>1<?php }?>"<?php if ($_smarty_tpl->tpl_vars['QUANTITY_EDITABLE']->value==false){?> disabled=disabled <?php }?> /><?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_EDITABLE']->value==false&&$_smarty_tpl->tpl_vars['MODULE']->value!='PurchaseOrder'){?><input id="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if (((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])){?><?php echo ((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value])/((float)$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]);?>
<?php }else{ ?>0<?php }?>" /><span style="display:none" class="purchaseCost">0</span><input name="<?php echo $_smarty_tpl->tpl_vars['purchaseCost']->value;?>
" type="hidden" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['purchaseCost']->value];?>
<?php }else{ ?>0<?php }?>" /><?php }?><?php if ($_smarty_tpl->tpl_vars['MARGIN_EDITABLE']->value==false){?><input type="hidden" name="<?php echo $_smarty_tpl->tpl_vars['margin']->value;?>
" value="<?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];?>
<?php }else{ ?>0<?php }?>"></span><span class="margin pull-right" style="display:none"><?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value]){?><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['margin']->value];?>
<?php }else{ ?>0<?php }?></span><?php }?><?php if ($_smarty_tpl->tpl_vars['MODULE']->value!='PurchaseOrder'){?><br><span class="stockAlert redColor <?php if ($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qty']->value]<=$_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value]){?>hide<?php }?>" ><?php echo vtranslate('LBL_STOCK_NOT_ENOUGH',$_smarty_tpl->tpl_vars['MODULE']->value);?>
<br><?php echo vtranslate('LBL_MAX_QTY_SELECT',$_smarty_tpl->tpl_vars['MODULE']->value);?>
&nbsp;<span class="maxQuantity"><?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['qtyInStock']->value];?>
</span></span><?php }?></td><td><select id="<?php echo $_smarty_tpl->tpl_vars['sr_action_one']->value;?>
" class="inputElement picklistfield" data-fieldtype="picklist" name="<?php echo $_smarty_tpl->tpl_vars['sr_action_one']->value;?>
" data-selected-value='<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_one']->value];?>
'><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_one']->value]))=='To be replaced'){?> selected <?php }?> value="To be replaced"> To be replaced </option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_one']->value]))=='Can be used'){?> selected <?php }?> value="Can be used"> Can be used </option></select></td><td><select id="<?php echo $_smarty_tpl->tpl_vars['sr_action_two']->value;?>
" class="inputElement picklistfield" data-fieldtype="picklist" name="<?php echo $_smarty_tpl->tpl_vars['sr_action_two']->value;?>
" data-selected-value='<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_two']->value];?>
'><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_two']->value]))=='Required'){?> selected <?php }?> value="Required">Required</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_two']->value]))=='Repaired'){?> selected <?php }?> value="Replaced">Repaired</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_action_two']->value]))=='Replaced'){?> selected <?php }?> value="Replaced">Replaced</option></select></td><td><select id="<?php echo $_smarty_tpl->tpl_vars['sr_replace_action']->value;?>
" class="inputElement picklistfield" data-fieldtype="picklist" name="<?php echo $_smarty_tpl->tpl_vars['sr_replace_action']->value;?>
" data-selected-value='<?php echo $_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_replace_action']->value];?>
'><option value=""><?php echo vtranslate('LBL_SELECT_OPTION','Vtiger');?>
</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_replace_action']->value]))=='From BEML'){?> selected <?php }?> value="From BEML">From BEML</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_replace_action']->value]))=='From Vendor'){?> selected <?php }?> value="From Vendor">From Vendor</option><option <?php if (trim(decode_html($_smarty_tpl->tpl_vars['data']->value[$_smarty_tpl->tpl_vars['sr_replace_action']->value]))=='From Customer'){?> selected <?php }?> value="From Customer">From Customer</option></select></td><?php }} ?>