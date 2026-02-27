<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_HighChartUtils_Helper
{

    public static function isStacked($type)
    {
        return (false !== strpos($type, 'stacked'));
    }

    public function getQuickFiltersFromRequest(Vtiger_Request $request)
    {
        global $default_charset;
        $qfRequest = [];
        $requestAll = $request->getAll();
        if ($requestAll['quick_filter_criteria']) {
            $decodedQFCriteria = html_entity_decode($requestAll['quick_filter_criteria'], ENT_QUOTES, $default_charset);
            $quickFilterCriteria = Zend_Json::decode($decodedQFCriteria);
            // transformation
            foreach ($quickFilterCriteria as $qfArray) {
                $qfRequest[$qfArray['columnname']]['value'] = $qfArray['value'];
                $qfRequest[$qfArray['columnname']]['radio'] = $qfArray['radio_value'];
            }
        }

        return $qfRequest;
    }

    public static function getHighChartDataLabelFormatByType($type, $pointDecimals)
    {
        switch ($type) {
            case 'piepercentage':
                $format = '<b>{point.name}</b> {point.percentage:.1f} %';
                break;
            default:
                $format = "<b>{point.name}</b> ({point.y:,.$pointDecimals})";
                break;
        }

        return $format;
    }

    public static function getHighChartTooltipByType($type)
    {
        $tooltip = "formatter: function () {
                                        return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + this.y ";

        if (self::isStacked($type)) {
            $tooltip .= "+ '<br/>' + '" . vtranslate("LBL_TOTAL", "ITS4YouReports") .
                vtranslate("LBL_DOUBLEDOT", "ITS4YouReports") . " ' + this.point.stackTotal";
        }

        $tooltip .= ';
                            }';

        return $tooltip;
    }

    public static function getHighChartSeriesTooltipByType($type)
    {
        switch ($type) {
            case 'pie':
            case 'piepercentage':
                $tooltip = "valueSuffix: '',
                        pointFormat: '{series.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'";
                break;
            default:
                $tooltip = "valueSuffix: ''";
                break;
        }

        return $tooltip;
    }
}
