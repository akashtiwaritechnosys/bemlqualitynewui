<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_ProgressLine_Helper
{
    private static $reportObj = null;

    protected static function getDataFromStr($data_str)
    {
        return explode(',', $data_str);
    }

    protected static function isProgressEnabled($type)
    {
        $return = false;

        switch ($type) {
            case 'min':
            case 'max':
            case 'avg':
                if (isset(self::$reportObj)
                    && in_array(strtoupper($type), explode(',', self::$reportObj->reportinformations['charts'][1]['progress_line']))) {
                    $return = true;
                }
                break;
        }

        return $return;
    }

    public static function getMinProgressLine($data_str)
    {
        if (!self::isProgressEnabled('min')) {
            return '';
        }

        $minProgressData = [];
        $data = self::getDataFromStr($data_str);

        $minData = [];

        foreach ($data as $float) {
            $minData[] = $float;
            $minProgressData[] = min($minData);
        }

        return implode(',', $minProgressData);
    }

    public static function getAverageProgressLine($data_str)
    {
        if (!self::isProgressEnabled('avg')) {
            return '';
        }

        $avgProgressData = [];
        $data = self::getDataFromStr($data_str);

        $n = 1;
        $sum = 0;

        foreach ($data as $float) {
            $sum += floatval($float);
            $avgProgressData[] = ($sum / $n);
            $n++;
        }

        return implode(',', $avgProgressData);
    }

    public static function getMaxProgressLine($data_str)
    {
        if (!self::isProgressEnabled('max')) {
            return '';
        }

        $maxProgressData = [];
        $data = self::getDataFromStr($data_str);

        $maxData = [];

        foreach ($data as $float) {
            $maxData[] = $float;
            $maxProgressData[] = max($maxData);
        }

        return implode(',', $maxProgressData);
    }

    public static function getProgressLines($data_str, $reportObj)
    {
        $return = [];
        $returnStr = '';
        self::$reportObj = $reportObj;

        if (self::isProgressEnabled('min')) {
            $return[] = sprintf(
                "{
                name: '%s',
                data: [%s],
                type: 'line',
                yAxis: 0
                }",
                vtranslate('MIN', 'ITS4YouReports'),
                self::getMinProgressLine($data_str)
            );
        }

        if (self::isProgressEnabled('avg')) {
            $return[] = sprintf(
                "{
                name: '%s',
                data: [%s],
                type: 'line',
                yAxis: 0
                }",
                vtranslate('AVG', 'ITS4YouReports'),
                self::getAverageProgressLine($data_str)
            );
        }

        if (self::isProgressEnabled('max')) {
            $return[] = sprintf(
                "{
                name: '%s',
                data: [%s],
                type: 'line',
                yAxis: 0
                }",
                vtranslate('MAX', 'ITS4YouReports'),
                self::getMaxProgressLine($data_str)
            );
        }

        if (!empty($return)) {
            $returnStr = implode(',', $return) . ',';
        }

        return $returnStr;
    }
}
