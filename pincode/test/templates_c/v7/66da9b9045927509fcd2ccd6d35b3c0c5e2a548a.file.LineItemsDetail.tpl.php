<?php /* Smarty version Smarty-3.1.7, created on 2022-06-28 13:38:23
         compiled from "C:\xampp\htdocs\beml\includes\runtime/../../layouts/v7\modules\ServiceReports\LineItemsDetail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79539439962baba4ac91336-53336805%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '66da9b9045927509fcd2ccd6d35b3c0c5e2a548a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\beml\\includes\\runtime/../../layouts/v7\\modules\\ServiceReports\\LineItemsDetail.tpl',
      1 => 1656423499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '79539439962baba4ac91336-53336805',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.7',
  'unifunc' => 'content_62baba4ad971b',
  'variables' => 
  array (
    'BLOCK_LIST' => 0,
    'ITEM_DETAILS_BLOCK' => 0,
    'LINEITEM_FIELDS' => 0,
    'IMAGE_VIEWABLE' => 0,
    'COL_SPAN1' => 0,
    'PRODUCT_VIEWABLE' => 0,
    'QUANTITY_VIEWABLE' => 0,
    'PURCHASE_COST_VIEWABLE' => 0,
    'COL_SPAN2' => 0,
    'LIST_PRICE_VIEWABLE' => 0,
    'MARGIN_VIEWABLE' => 0,
    'COL_SPAN3' => 0,
    'RELATED_PRODUCTS' => 0,
    'MODULE_NAME' => 0,
    'RECORD' => 0,
    'TAX_REGION_MODEL' => 0,
    'REGION_LABEL' => 0,
    'MODULE' => 0,
    'LINE_ITEM_DETAIL' => 0,
    'COMMENT_VIEWABLE' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_62baba4ad971b')) {function content_62baba4ad971b($_smarty_tpl) {?><?php $_smarty_tpl->tpl_vars['ITEM_DETAILS_BLOCK'] = new Smarty_variable($_smarty_tpl->tpl_vars['BLOCK_LIST']->value['LBL_ITEM_DETAILS'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['LINEITEM_FIELDS'] = new Smarty_variable($_smarty_tpl->tpl_vars['ITEM_DETAILS_BLOCK']->value->getFields(), null, 0);?>
<?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(0, null, 0);?>
<?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(0, null, 0);?>
<?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(2, null, 0);?>
<?php $_smarty_tpl->tpl_vars['IMAGE_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['MARGIN_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['COMMENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['SH_PERCENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>
<?php $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable(false, null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']){?>
    <?php $_smarty_tpl->tpl_vars['IMAGE_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['IMAGE_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']){?>
    <?php $_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']){?>
    <?php $_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN1'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN1']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']){?>
    <?php $_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['purchase_cost']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['PURCHASE_COST_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']){?>
    <?php $_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['listprice']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['LIST_PRICE_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN2'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN2']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']){?>
    <?php $_smarty_tpl->tpl_vars['MARGIN_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['margin']->isViewable(), null, 0);?>
<?php if ($_smarty_tpl->tpl_vars['MARGIN_VIEWABLE']->value){?><?php $_smarty_tpl->tpl_vars['COL_SPAN3'] = new Smarty_variable(($_smarty_tpl->tpl_vars['COL_SPAN3']->value)+1, null, 0);?><?php }?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']){?>
    <?php $_smarty_tpl->tpl_vars['COMMENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['comment']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']){?>
    <?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_amount']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']){?>
    <?php $_smarty_tpl->tpl_vars['ITEM_DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['discount_percent']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']){?>
    <?php $_smarty_tpl->tpl_vars['SH_PERCENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnS_H_Percent']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']){?>
    <?php $_smarty_tpl->tpl_vars['DISCOUNT_AMOUNT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountAmount']->isViewable(), null, 0);?>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']){?>
    <?php $_smarty_tpl->tpl_vars['DISCOUNT_PERCENT_VIEWABLE'] = new Smarty_variable($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['hdnDiscountPercent']->isViewable(), null, 0);?>
<?php }?>

<input type="hidden" class="isCustomFieldExists" value="false">

<?php $_smarty_tpl->tpl_vars['FINAL_DETAILS'] = new Smarty_variable($_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value[1]['final_details'], null, 0);?>
<div class="details block">
    <div class="lineItemTableDiv">
        <table class="table table-bordered lineItemsTable" style = "margin-top:15px">
            <thead>
            <th colspan="<?php echo $_smarty_tpl->tpl_vars['COL_SPAN1']->value;?>
" class="lineItemBlockHeader">
                <?php $_smarty_tpl->tpl_vars['REGION_LABEL'] = new Smarty_variable(vtranslate('LBL_ITEM_DETAILS',$_smarty_tpl->tpl_vars['MODULE_NAME']->value), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')&&$_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']&&$_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->isViewable()){?>
                    <?php $_smarty_tpl->tpl_vars['TAX_REGION_MODEL'] = new Smarty_variable(Inventory_TaxRegion_Model::getRegionModel($_smarty_tpl->tpl_vars['RECORD']->value->get('region_id')), null, 0);?>
                    <?php if ($_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value){?>
                        <?php ob_start();?><?php echo vtranslate($_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['region_id']->get('label'),$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars['REGION_LABEL'] = new Smarty_variable($_tmp1." : ".($_smarty_tpl->tpl_vars['TAX_REGION_MODEL']->value->getName()), null, 0);?>
                    <?php }?>
                <?php }?>
                <?php echo $_smarty_tpl->tpl_vars['REGION_LABEL']->value;?>

            </th>
            </thead>
            <tbody>
                <tr>
                    <?php if ($_smarty_tpl->tpl_vars['IMAGE_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['image']->get('label');?>
<?php $_tmp2=ob_get_clean();?><?php echo vtranslate($_tmp2,$_smarty_tpl->tpl_vars['MODULE']->value);?>
</strong>
                        </td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <span class="redColor">*</span><strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['productid']->get('label');?>
<?php $_tmp3=ob_get_clean();?><?php echo vtranslate($_tmp3,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>

                    <?php if ($_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE']->value){?>
                        <td class="lineItemFieldName">
                            <strong><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['LINEITEM_FIELDS']->value['quantity']->get('label');?>
<?php $_tmp4=ob_get_clean();?><?php echo vtranslate($_tmp4,$_smarty_tpl->tpl_vars['MODULE_NAME']->value);?>
</strong>
                        </td>
                    <?php }?>
                    
                    <td class="lineItemFieldName">
                        <strong>Action 1</strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong>Action 2</strong>
                    </td>
                    <td class="lineItemFieldName">
                        <strong>Replacement Action</strong>
                    </td>
                </tr>
                <?php  $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->_loop = false;
 $_smarty_tpl->tpl_vars['INDEX'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['RELATED_PRODUCTS']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->key => $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value){
$_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->_loop = true;
 $_smarty_tpl->tpl_vars['INDEX']->value = $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->key;
?>
                    <tr>
                        <?php if ($_smarty_tpl->tpl_vars['IMAGE_VIEWABLE']->value){?>
                            <td style="text-align:center;">
                                <img src='<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productImage".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
' height="42" width="42">
                            </td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['PRODUCT_VIEWABLE']->value){?>
                            <td>
                                <div>
                                    <?php if ($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productDeleted".($_smarty_tpl->tpl_vars['INDEX']->value)]){?>
                                        <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                                    <?php }else{ ?>
                                        <h5><a class="fieldValue" href="index.php?module=<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["entityType".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
&view=Detail&record=<?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["hdnProductId".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
</a></h5>
                                        <?php }?>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productDeleted".($_smarty_tpl->tpl_vars['INDEX']->value)]){?>
                                    <div class="redColor deletedItem">
                                        <?php if (empty($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)])){?>
                                            <?php echo vtranslate('LBL_THIS_LINE_ITEM_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_THIS_LINE_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        <?php }else{ ?>
                                            <?php echo vtranslate('LBL_THIS',$_smarty_tpl->tpl_vars['MODULE']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["entityType".($_smarty_tpl->tpl_vars['INDEX']->value)];?>
 <?php echo vtranslate('LBL_IS_DELETED_FROM_THE_SYSTEM_PLEASE_REMOVE_OR_REPLACE_THIS_ITEM',$_smarty_tpl->tpl_vars['MODULE']->value);?>

                                        <?php }?>
                                    </div>
                                <?php }?>
                                <div>
                                    <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["subprod_names".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['COMMENT_VIEWABLE']->value&&!empty($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["productName".($_smarty_tpl->tpl_vars['INDEX']->value)])){?>
                                    <div>
                                        <?php echo nl2br(decode_html($_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["comment".($_smarty_tpl->tpl_vars['INDEX']->value)]));?>

                                    </div>
                                <?php }?>
                            </td>
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['QUANTITY_VIEWABLE']->value){?>
                            <td>
                                <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["qty".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                            </td>
                        <?php }?>
                        
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["sr_action_one".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["sr_action_two".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                        </td>
                        <td>
                            <?php echo $_smarty_tpl->tpl_vars['LINE_ITEM_DETAIL']->value["sr_replace_action".($_smarty_tpl->tpl_vars['INDEX']->value)];?>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div><?php }} ?>