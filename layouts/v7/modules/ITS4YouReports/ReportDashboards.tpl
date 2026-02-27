{*/*<!--
/*********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/
-->*/*}

{strip}
    <div style="border:1px solid #ccc;padding:4%;">
        <div class="form-group">
            <label class="control-label textAlignLeft col-lg-2 {if 'tabular' === $REPORT_TYPE}hide{/if}"">
                {vtranslate('PrimarySearchBy',$MODULE)}
            </label>
            <div class="col-lg-4 {if 'tabular' === $REPORT_TYPE}hide{/if}">
                <select id="primary_search" name="primary_search" class="select2 inputElement" style="margin:auto;">
                    <option value="none">{'LBL_NONE'|@getTranslatedString:'ITS4YouReports'}</option>
                    {foreach key=primary_search_key item=primary_search_arr from=$primary_search_options}
                        <option value="{$primary_search_arr.value}" {if $primary_search_arr.value==$primary_search}selected='selected'{/if}>{$primary_search_arr.text}</option>
                    {/foreach}
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label textAlignLeft col-lg-2">
                {vtranslate('AllowInModules',$MODULE)}
            </label>
            <div class="col-lg-4">
                <input type="hidden" name="allow_in_modules_hidden" id="allow_in_modules_hidden" value="">
                <select id="allow_in_modules" multiple name="allow_in_modules" class="select2 inputElement" style="margin:auto;">
                    {foreach key=moduleName item=moduleLabel from=$allmodules}
                        <option value="{$moduleName}"
                            {if is_array($allowedmodules) && in_array($moduleName, $allowedmodules)}
                                selected
                            {/if}
                        >
                            {$moduleLabel}
                        </option>
                    {/foreach}
                </select>
            </div>
            <div class="control-label textAlignLeft">
                <label class="checkbox {if 'tabular' === $REPORT_TYPE}hide{/if}" style="margin-left: 30px;display: inline;">
                    <input name="dashboard_chart"
                      id="dashboard_chart" {if $REPORT_DASHBOARD_CHART eq 'true' && 'tabular' !== $REPORT_TYPE} checked {/if}
                      type="checkbox"/>&nbsp;{vtranslate('REPORT_DASHBOARD_CHART', $MODULE)}</label>
                <label class="checkbox" style="margin-left: 30px;display: inline;">
                    <input name="dashboard_table"
                      id="dashboard_table" {if $REPORT_DASHBOARD_TABLE eq 'true'} checked {/if}
                      type="checkbox"/>&nbsp;{vtranslate($REPORT_TYPE, $MODULE)}</label>
            </div>
        </div>
    </div>
{/strip}