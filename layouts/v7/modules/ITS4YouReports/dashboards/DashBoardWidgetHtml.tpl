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
    {include file="dashboards/WidgetHtmlHeader.tpl"|@vtemplate_path:$MODULE_NAME}

    <div style="height:100%;width:100%;overflow: hidden;">
        <div style="height:80%;width:100%;overflow: auto;">
            <div style="height:5px;"></div>
            <input class="widgetData" type='hidden' value='{Vtiger_Util_Helper::toSafeHTML(ZEND_JSON::encode($DATA))}' />
            <input id="widgetReports4YouHtmlId" type='hidden' value='{$recordid}' />

            <!-- div id="reports4you_widget_html_{$smarty.request.tab}{$recordid}" style="height:85%;width:95%;margin:auto;" ></div-->
            <div class="dashboardWidgetContent">
                {$DATA}
            </div>
        </div>
    </div>

    <div class="widgeticons dashBoardWidgetFooter">
        <div class="footerIcons pull-right">
            {include file="dashboards/DashboardFooterIcons.tpl"|@vtemplate_path:$MODULE_NAME}
        </div>
    </div>
{/strip}
