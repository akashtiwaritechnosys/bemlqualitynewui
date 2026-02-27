{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
************************************************************************************}

<input type='hidden' name='charttype' value="{$CHART_TYPE}" />
<input type='hidden' name='data' value='{Vtiger_Functions::jsonEncode($DATA)}' />
<input type='hidden' name='clickthrough' value="{$CLICK_THROUGH}" />

<br>
<div class="dashboardWidgetContent">
    {if $report_type eq 'Pivot'}
        <table border="1" style="width: auto;table-layout: fixed;margin-left: 35px;" class="table">
            <tr>
                <td></td>
                {foreach key=herderValues_key item=herderValues_value from=$herderValues}
                    <td><b>{$herderValues_value}</b></td>
                {/foreach}
            </tr>
            {foreach key=pivotReport_key item=pivotReport_value from=$pivotReportArray}
                <tr>
                    <td><b>{$pivotReport_value['rowsColumn']}</b></td>
                    {foreach key=hraderColumn_key item=hraderColumn_value from=$pivotReport_value['headerValuesArray']}
                        {if array_key_exists($hraderColumn_key,$pivotReport_value['hraderColumn'])}
                            <td>{$pivotReport_value['hraderColumn'][$hraderColumn_key]}</td>
                        {else}
                            <td>0</td>
                        {/if}
                    {/foreach}
                <tr>
            {/foreach}
        </table>
    {else}
        <input type="hidden" class="yAxisFieldType" value="{$YAXIS_FIELD_TYPE}" />
        <div class='border1px filterConditionContainer' style="padding:30px;">
            <div id='chartcontent' name='chartcontent' style="min-height:400px;" data-mode='Reports'></div>
            <br>
            {if $CLICK_THROUGH neq 'true'}
                <div class='row-fluid alert-info'>
                    <span class='col-lg-4 offset4'> &nbsp;</span>
                    <span class='span alert-info'>
                        <i class="icon-info-sign"></i>
                        {vtranslate('LBL_CLICK_THROUGH_NOT_AVAILABLE', $MODULE)}
                    </span>
                </div>
                <br>
            {/if}
            {if $REPORT_MODEL->isInventoryModuleSelected()}
                <div class="alert alert-info">
                    {assign var=BASE_CURRENCY_INFO value=Vtiger_Util_Helper::getUserCurrencyInfo()}
                    <i class="icon-info-sign" style="margin-top: 1px;"></i>&nbsp;&nbsp;
                    {vtranslate('LBL_CALCULATION_CONVERSION_MESSAGE', $MODULE)} - {$BASE_CURRENCY_INFO['currency_name']} ({$BASE_CURRENCY_INFO['currency_code']})
                </div>
            {/if}
        </div>
    {/if}
</div>
<br>

