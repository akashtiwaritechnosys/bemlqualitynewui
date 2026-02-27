<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/

class ITS4YouReports_GenerateObjUtils_Helper extends ITS4YouReports_HighChartUtils_Helper
{

    public static $temp_files_path = 'test/ITS4YouReports/';
    public $report_obj = null;
    public $currentLanguage = null;
    public $currentModule = null;
    protected static $currencyUiTypes = [71, 72, 712];
    protected static $currencyArray = [];
    protected $reports4you_type = '';

    public $totalCountQualification = 0;
    public $limitValue = 0;
    protected $pagination = array();
    protected $prevPageExists = false;
    protected $nextPageExists = false;

    protected static function db()
    {
        return PearDatabase::getInstance();
    }

    protected function setNoOfRows($noofrows=0){
        echo "<script type='text/javascript' id='__reportrun_directoutput_recordcount_script'>
                jQuery(document).ready(function(){
                    if(document.getElementById('countValue')) document.getElementById('countValue').innerHTML=$noofrows;
                    if(document.getElementById('_reportrun_total')) document.getElementById('_reportrun_total').innerHTML=$noofrows;
                });</script>";

        return true;
    }

    protected function setNoOfTotalRows($noofrows=0){
        $this->setNoOfRows($noofrows);

        echo "<script type='text/javascript' id='__reportrun_directoutput_recordcount_script'>
                jQuery(document).ready(function(){
                    if(document.getElementById('ofValues')) document.getElementById('ofValues').innerHTML=$noofrows;});</script>";

        if ('tabular' === $this->reports4you_type) {
            if ((int) $noofrows < (int) $this->report_obj->reportinformations["columns_limit"]) {
                echo "<script type='text/javascript' id='__reportrun_directoutput_recordcounthide_script'>
	                jQuery(document).ready(function(){
	                    jQuery('#limitOfRecords').hide();
					});</script>";
            } else {
                echo "<script type='text/javascript' id='__reportrun_directoutput_recordcounthide_script'>
	                jQuery(document).ready(function(){
	                    jQuery('#limitOfRecords').show();
					});</script>";
            }
        } else {
            if ((int) $noofrows < (int) $this->report_obj->reportinformations["summaries_limit"]) {
                echo "<script type='text/javascript' id='__reportrun_directoutput_recordcounthide_script'>
	                jQuery(document).ready(function(){
	                    jQuery('#limitOfRecords').hide();
					});</script>";
            } else {
                echo "<script type='text/javascript' id='__reportrun_directoutput_recordcounthide_script'>
	                jQuery(document).ready(function(){
	                    jQuery('#limitOfRecords').show();
					});</script>";
            }
        }

        return true;
    }

    public static function createTempFolderIfNotExists()
    {
        $testReports4You = vglobal('root_directory') . self::$temp_files_path;

        if (!file_exists($testReports4You)) {
            mkdir($testReports4You, 0777, true);
        }

        if (!file_exists('modules/ITS4YouReports/highcharts/')) {
            mkdir('modules/ITS4YouReports/highcharts/', 0777, true);
        }
    }

    protected function getQFArray()
    {
        $qf_array = [];
        $qf_temp = $this->report_obj->getSelectedQFColumnsArray($this->report_obj->record);
        if (!empty($qf_temp)) {
            foreach ($qf_temp as $qf_temp_arr) {
                $qf_array[] = $qf_temp_arr['fieldcolname'];
            }
        }
        $this->qf_array = $qf_array;

        return true;
    }

    protected static function getModuleNameFromColumnStr($columnStr = '')
    {
        $columnModule = '';

        if (!empty($columnStr)) {
            $tmpSplit  = explode(':', $columnStr);
            $moduleField = $tmpSplit[2];
            $moduleFieldArr = explode('_', $moduleField);
            $columnModule = $moduleFieldArr[0];
        }

        return $columnModule;
    }

    public static function getDataTypeFromColumnStr($columnStr = '')
    {
        $columnModule = '';

        if (!empty($columnStr)) {
            $columnModule = explode(':', $columnStr)[4];
        }

        return $columnModule;
    }

    public static function isDTType($columnStr)
    {
        return 'DT' === self::getDataTypeFromColumnStr($columnStr);
    }

    protected static function isAddCurrencyField($reportObj, $fldName, $columnsArray)
    {
        $isAddCurrencyField = false;

        if (((in_array($columnsArray['uitype_' . $fldName], self::$currencyUiTypes) && !in_array($fldName, ['quantity']))
                || (in_array($columnsArray['uitype_' . $reportObj->getClearFldName($fldName)], self::$currencyUiTypes) && !in_array($reportObj->getClearFldName($fldName), ['quantity']))
                || (in_array($fldName, ITS4YouReports::$intentory_fields)
                    && !in_array($fldName, ITS4YouReports::$intentory_skip_formating))
                || (in_array(self::getStaticClearFldName($fldName), ITS4YouReports::$intentory_fields)
                    && !in_array(self::getStaticClearFldName($fldName), ITS4YouReports::$intentory_skip_formating)))
            && !in_array($fldName, ['quantity'])) {
            $isAddCurrencyField = true;
        }

        return $isAddCurrencyField;
    }

    protected function getClearFldName($fldName)
    {
        $fldNameArr = explode('_', $fldName);
        $lastKey = (count($fldNameArr) - 1);
        $lastVal = $fldNameArr[$lastKey];

        $preLastKey = (count($fldNameArr) - 2);
        $preLastVal = $fldNameArr[$preLastKey];

        if (in_array(strtolower($lastVal), $this->calculation_type_array)) {
            unset($fldNameArr[(count($fldNameArr) - 1)]);
        } elseif (is_numeric($lastVal) || 'mif' === $lastVal || 'mif' === $preLastVal) {

            foreach ($fldNameArr as $key => $value) {
                if (is_numeric($value) || 'mif' === $lastVal) {
                    unset($fldNameArr[$key]);
                }
                if ('mif' === $preLastVal) {
                    unset($fldNameArr[$preLastKey]);
                }
            }
        }

        return implode('_', $fldNameArr);
    }

    protected static function getStaticClearFldName($fldName)
    {
        $fldNameArr = explode('_', $fldName);
        $lastKey = (ITS4YouReports_Functions_Helper::count($fldNameArr) - 1);
        $lastVal = $fldNameArr[$lastKey];

        if (is_numeric($lastVal)) {
            foreach ($fldNameArr as $key => $value) {
                if (is_numeric($value)) {
                    unset($fldNameArr[$key]);
                }
            }
        }

        return implode('_', $fldNameArr);
    }

    public static function placeReportNameToPDF($reportName)
    {
        $name = "<table class='rpt4youTableText' width='100%'>";
        $name .= "<tr>";
        $name .= "<td colspan='1' class='rpt4youGrpHeadInfoText' width='100%' style='border:0px;'>";
        $name .= $reportName;
        $name .= "</td>";
        $name .= "</tr>";
        $name .= "</table>";

        return $name;
    }

    public static function isGetReportsHtml()
    {
        $request = new Vtiger_Request($_REQUEST, $_REQUEST);

        return ('GetReportsHtml' === $request->get('name'));
    }

    protected static function isDateColumn($columnStr = '')
    {
        return strpos($columnStr, ':D');
    }

    protected static function isDateTimeColumn($columnStr = '')
    {
        return strpos($columnStr, ':DT');
    }

    protected static function isDate($columnStr = '')
    {
        if (false !== self::isDateTimeColumn($columnStr)) {
            return true;
        }
        if (false !== self::isDateColumn($columnStr)) {
            return true;
        }

        return false;
    }

    protected static function isMoreStrictMysql()
    {
        global $site_URL;

        return strpos($site_URL, 'fortemix');
    }

    protected static function getFirstValue($formatted)
    {
        if (is_array($formatted)) {
            return (isset($formatted[0]) ? $formatted[0] : 0);
        } else {
            return (isset($formatted) ? $formatted : 0);
        }
    }

    protected function getHidUrlFromId($fldHid)
    {
        global $site_URL, $current_user;
        $adb = PearDatabase::getInstance();
        $hidUrl = null;

        if (isset($fldHid) && $fldHid != "") {
            $entitytype = getSalesEntityType($fldHid);
            if ($entitytype != "") {
                global $site_URL;
                switch ($entitytype) {
                    case "Calendar":
                        $hidUrl = $site_URL . '/index.php?module=Calendar&view=Detail&record=' . $fldHid . '&return_module=ITS4YouReports&return_action=resultGenerate&return_id=' . vtlib_purify(
                                $_REQUEST["record"]
                            ) . '&activity_mode=Task';
                        break;
                    case "Events":
                        $hidUrl = $site_URL . '/index.php?module=Calendar&view=Detail&record=' . $fldHid . '&return_module=ITS4YouReports&return_action=resultGenerate&return_id=' . vtlib_purify(
                                $_REQUEST["record"]
                            ) . '&activity_mode=Events';
                        break;
                    default:
                        $hidUrl = $site_URL . '/index.php?module=' . $entitytype . '&view=Detail&record=' . $fldHid . '&return_module=ITS4YouReports&return_action=resultGenerate&return_id=' . vtlib_purify(
                                $_REQUEST["record"]
                            );
                        break;
                }
            } else {
                $user = 'no';
                $u_result = $adb->pquery("SELECT count(*) as count from vtiger_users where id = ?", [$fldHid]);
                if ($adb->query_result($u_result, 0, 'count') > 0) {
                    $user = 'yes';
                }
                if (is_admin($current_user)) {
                    if ($user == 'no') {
                        $hidUrl = $site_URL . '/index.php?module=Settings&action=GroupDetailView&groupId=' . $fldHid;
                    } else {
                        $hidUrl = $site_URL . '/index.php?module=Users&action=DetailView&record=' . $fldHid;
                    }
                }
            }
        }

        return $hidUrl;
    }

    protected function getHidUrlFromResult($result, $fld, $f_i, $i)
    {
        $adb = PearDatabase::getInstance();

        $fldHid = $adb->query_result($result, $f_i, $fld->name . "_hid");

        if (array_key_exists($fld->name, $this->ui10_fields) && !empty($custom_field_values[$i])) {
            $fldHid = $custom_field_values[$i];
        }

        return $this->getHidUrlFromId($fldHid);
    }

    protected static function decodeColumnsArray($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[decode_html($key)] = self::decodeColumnsArray($value);
            }
        } else {
            $data = decode_html($data);
        }

        return $data;
    }

    public static function getDBDateFormat($value, $db_time_zone = '', $time_zone = '')
    {
        if (empty($db_time_zone)) {
            global $current_user;
            $db_time_zone = $current_user->time_zone;
        }

        if (empty($time_zone)) {
            $time_zone = DateTimeField::getDBTimeZone();
        }

        $now_time_His = date('H:i:s');
        $date = DateTimeField::convertTimeZone($value . ' ' . $now_time_His, $db_time_zone, $time_zone);

        return $date->format('Y-m-d');
    }

    public function setCurrentLanguage4You($language = '')
    {
        if (!empty($language)) {
            $this->currentLanguage = $language;
        } else {
            global $current_language;
            $this->currentLanguage = $language;
        }
    }

    public function getCurrentLanguage4You()
    {
        if (!isset($this->currentLanguage) || $this->currentLanguage == "") {
            $this->setCurrentLanguage4You();
        }

        return $this->currentLanguage;
    }

    public function setCurrentModule4You()
    {
        $this->currentModule = 'ITS4YouReports';
    }

    public function getCurrentModule4You()
    {
        if (!isset($this->currentModule) || $this->currentModule == "") {
            $this->setCurrentModule4You();
        }

        return $this->currentModule;
    }

    public function writeReportToExcelFile($fileName, $reportData)
    {
        global $currentModule, $current_language;
        global $default_charset;
        $mod_strings = return_module_language($current_language, $this->getCurrentModule4You());

        require_once("libraries/PHPExcel/PHPExcel.php");

        $workbook = new PHPExcel();
        $worksheet = $workbook->setActiveSheetIndex(0);

        //$reportData = $this->GenerateReport("PDF",$filterlist);
        $headers_arr = $reportData['headers'];
        $arr_val = $reportData['data'];
//ITS4YouReports::sshow($reportData);

        //$totalxls = $this->GenerateReport("TOTALXLS",$filterlist);

        $header_styles = [
            'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'E1E0F7']],
            //'font' => array( 'bold' => true )
        ];

        $merge_count = "";
        $header_merge = [];
        $go_merge = false;
        if (isset($reportData["merge_count"]) && isset($reportData["header_merge"]) && !empty($reportData["header_merge"])) {
            $merge_count = $reportData["merge_count"];
            $header_merge = $reportData["header_merge"];
            $go_merge = true;
        }
        if (isset($arr_val)) {
            $rowcount = 1;
            $count = 0;
            $columnName = "A";
            $column_index = $target_index = "B";
            for ($tci = 1; $tci < $merge_count; $tci++) {
                ++$target_index . PHP_EOL;
            }
            //$target_index = $column_index+$merge_count;
            foreach ($headers_arr as $key => $value) {
                $value = trim($value);
                if ($value == "LBL_GROUPING_TOTALS") {
                    $value = vtranslate("LBL_GROUPING_TOTALS", $this->getCurrentModule4You());
                }
                $value = html_entity_decode($value, ENT_QUOTES, $default_charset);
                $worksheet->setCellValueExplicitByColumnAndRow($count, $rowcount, $value, true);
                $worksheet->getStyleByColumnAndRow($count, $rowcount)->applyFromArray($header_styles);
                if ($go_merge === true) {
                    if ($key == 0) {
                        $worksheet->mergeCells('A1:A2');
                        $count++;
                    } else {
                        $b1 = "$column_index$rowcount";
                        $b2 = "$target_index$rowcount";
                        $worksheet->mergeCells("$b1:$b2");
                        for ($tci = 0; $tci < $merge_count; $tci++) {
                            ++$column_index . PHP_EOL;
                            ++$target_index . PHP_EOL;
                            $count++;
                        }
                    }
                } else {
                    $count++;
                }
            }
            $rowcount++;

            if ($go_merge === true) {
                foreach ($header_merge as $count => $cols_header_val) {
                    $worksheet->setCellValueExplicitByColumnAndRow($count, $rowcount, $cols_header_val, true);
                    $worksheet->getStyleByColumnAndRow($count, $rowcount)->applyFromArray($header_styles);
                }
                $rowcount++;
            }
            foreach ($arr_val as $row_i => $col_arr) {
                $count = 0;
                foreach ($col_arr as $hdr => $value) {
                    $value = decode_html($value);
                    // TODO Determine data-type based on field-type.
                    // String type helps having numbers prefixed with 0 intact.
                    if (is_numeric($value) && !in_array($hdr, ['IMEI'])) {
                        $dataType = PHPExcel_Cell_DataType::TYPE_NUMERIC;
                    } else {
                        $dataType = PHPExcel_Cell_DataType::TYPE_STRING;
                    }
                    $worksheet->setCellValueExplicitByColumnAndRow($count, $rowcount, $value, $dataType);
                    $count = $count + 1;
                }
                $rowcount++;
            }
        }
        /**  DO NOT USE HTML BECAUSE EXCEL COULD NOT OPEN IT !!! - damaged file **/
        //$workbookWriter = PHPExcel_IOFactory::createWriter($workbook, 'HTML');
        $workbookWriter = PHPExcel_IOFactory::createWriter($workbook, 'Excel5');
        $workbookWriter->save($fileName);
    }

    /**
     * @param $fileName
     * @param $reportData
     */
    function writeReportToCSVFile($fileName, $reportData, $separator)
    {
        $headersArr = $reportData['headers'];
        $arrVal = $reportData['data'];

        try {
            $fp = fopen($fileName, 'w+');

            if (isset($arrVal)) {
                $csvValues = [];
                // Header
                $headersArr = array_map('trim', $headersArr);
                $csvValues = array_map('decode_html', $headersArr);
                fputcsv($fp, $csvValues, $separator);

                foreach ($arrVal as $key => $array_value) {
                    $csvValues = array_map('decode_html', array_values($array_value));
                    fputcsv($fp, $csvValues, $separator);
                }
            }
            fclose($fp);
        } catch (Exception $exception) {
            print_r($exception->getMessage());
        }
    }

    public static function getUserDateFormatFromDB($currentUser)
    {
        $db = PearDatabase::getInstance();

        if (!isset($_SESSION['r4u_date_format'])) {
            $result = $db->pquery('SELECT date_format FROM vtiger_users where id=?', [$currentUser->getId()]);
            $num_rows = $db->num_rows($result);
            if ($num_rows > 0) {
                $row = $db->fetch_array($result);
                $format = $row['date_format'];
            } else {
                $format = 'dd-mm-yyyy';
            }
            $_SESSION['r4u_date_format'] = $format;
        } else {
            $format = $_SESSION['r4u_date_format'];
        }

        return $format;
    }

    public static function displaySqlFormattedQuery($query)
    {
        if (!class_exists('SqlFormatter')) {
            include_once('modules/ITS4YouReports/lib/SqlFormatter.php');
        }

        if (class_exists('SqlFormatter')) {
            echo 'Formated:';
            print_r(SqlFormatter::format($query));
        } else {
            echo 'Query:';
            echo '<pre>';
            print_r($query);
            echo '</pre>';
        }

        return true;
    }

    public static function checkInstallationMemmoryLimit()
    {
        //  memory limit
        $memory_limit_min = 129;
        $memory_limit_recommended = 256;
        $memory_limit1 = ini_get('memory_limit');
        ini_set('memory_limit', '256M');
        $memory_limit2 = ini_get('memory_limit');
        // if original memory limit value is OK then set it to back
        if ((int)substr($memory_limit1, 0, -1) >= (int)substr($memory_limit2, 0, -1)) {
            ini_set('memory_limit', $memory_limit1);
            $memory_limit2 = '';
        }

        return true;
    }

    protected static function getCurrencyForFld($currencyId = '')
    {
        $current_user = Users_Record_Model::getCurrentUserModel();

        if ($current_user && !empty($current_user->get('currency_id'))) {
            $currencyId = $current_user->get('currency_id');
        }

        if (empty($currencyId)) {
            $currencyId = self::$currencyArray['id'];
        }

        return $currencyId;
    }

    /**
     * @return int
     */
    public function getTotalCountQualification() {
        return $this->totalCountQualification;
    }

    /**
     * function to return information if result is ajaxed
     *
     * @return bool
     */
    public function isResultFromAjax() {
        return ('ajax' === $_REQUEST['mode']);
    }

    /**
     * calculate and set report pagination numbers
     */
    public function calculateRange() {
        global $list_max_entries_per_page;

        $perPage = $list_max_entries_per_page;
        $page = (!empty($_REQUEST['page'])?$_REQUEST['page']:1);
        $start = (($page-1)*$perPage)+1;
        $end = ($page)*$perPage;
        if ($this->totalCountQualification < $end) {
            $end = $this->totalCountQualification;
        }

        $this->pagination = [
            'start' => $start,
            'end' => $end,
            'of' => $this->totalCountQualification,
            'page' => $page,
            'pages' => ceil($this->totalCountQualification/$perPage),
            'prevPageExists' => (int) (1 === $start),
            'nextPageExists' => (int) ($this->totalCountQualification > $end),
        ];
    }

    public function getRecordStartRange() {
        return $this->pagination['start'];
    }

    public function getRecordEndRange() {
        return $this->pagination['end'];
    }

    public function getRecordOfRange() {
        return $this->pagination['of'];
    }

    public function isPrevPageExists() {
        return $this->pagination['prevPageExists'];
    }

    public function isNextPageExists() {
        return $this->pagination['nextPageExists'];
    }

    public function getPages() {
        return $this->pagination['pages'];
    }

    public function getPageNumber() {
        return $this->pagination['page'];
    }

    /**
     * return Report pagination html block
     *
     * @return string
     */
    public function getResultPagination() {

        $pagination = '
                <input type="hidden" id="pageNumber" value="'.$this->getPageNumber().'">
                <div class="listViewActionsDiv row-fluid no-print" style="height:3em;width:100%;">
                    <div class="row-fluid textAlignRight">
                        <div class="row-fluid">
                            <div class="span12 pull-right">
                                <div class="popupPaging">
                                    <div class="row-fluid">
                                        <span class="span3" style="float:right !important;min-width:230px">
                                            <span class="pull-right">
                                                <span class="pageNumbers">
                                                    <span class="pageNumbersText">
                                                    ' . $this->getRecordStartRange() . ' 
                                                    ' . vtranslate('LBL_to') . ' 
                                                    ' . $this->getRecordEndRange() . ' 
                                                    ' . vtranslate('LBL_OF') . ' 
                                                    ' . $this->getRecordOfRange() . '
                                                    </span>
                                                </span>&nbsp;&nbsp;
                                                <span class="btn-group pull-right">
                                                    <button class="btn btn-default" id="listViewPreviousPageButton" 
                                                    ';
        $pagination .= ($this->isPrevPageExists() ? 'disabled' : '');
        $pagination .= '                            ><i class="fa fa-caret-left"></i>
                                                    </button>
                                                    <button class="btn dropdown-toggle btn-default" type="button" id="listViewPageJump" data-toggle="dropdown"';
        $pagination .= ($this->getPages() < 2 ? 'disabled' : '');
        $pagination .= '                                ><i class="fa fa-ellipsis-h icon" title="' . vtranslate('LBL_LISTVIEW_PAGE_JUMP') . '"></i>
                                                    </button>
                                                    <ul class="listViewBasicAction dropdown-menu" id="listViewPageJumpDropDown">
                                                        <li>
                                                            <div class="listview-pagenum">
                                                                <span class="span3 pushUpandDown2per"><span class="pull-left">
                                                                ' . vtranslate('LBL_PAGE') . '
                                                                </span></span>
                                                                <span class="span3 pushUpandDown2per" ><strong>' . $this->getPageNumber() . '</strong></span>
                                                                <span class="span2 textAlignCenter pushUpandDown2per">
                                                                    ' . vtranslate('LBL_OF') . '&nbsp;
                                                                </span>
                                                                <span class="span3 pushUpandDown2per totalPageCount" >' . $this->getPages() . '</span>
                                                            </div>
                                                            <div class="listview-pagejump">
                                                                <input type="text" id="pageToJumpReports" placeholder="' . vtranslate('LBL_LISTVIEW_PAGE_JUMP') . '" class="listViewPagingInput text-center">&nbsp;
                                                                <button type="button" id="pageToJumpSubmit" class="btn btn-success listViewPagingInputSubmit text-center">GO</button>
                                                            </div>    
                                                        </li>
                                                    </ul>
                                                    <button class="btn btn-default" id="listViewNextPageButton" 
                                                    ';
        $pagination .= ($this->isNextPageExists() ? '' : 'disabled');
        $pagination .= '                            ><i class="fa fa-caret-right"></i>
                                                    </button>
                                                </span>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>';

        return $pagination;
    }

    protected function isSupportedPagination() {
        return 'tabular' === $this->reports4you_type;
    }

    public static function isAjax() {
        return 'ajax' === $_REQUEST['mode'];
    }

    public static function isAllExport()
    {
        $request = new Vtiger_Request($_REQUEST, $_REQUEST);

        return 'all' === $request->get('type');
    }

    public static function showScripts(Vtiger_Request $request)
    {
        return 'ShowWidget' !== $request->get('view')
            && true === $request->has('module')
            && 'ITS4YouReports' === $request->get('module')
            && !in_array($request->get('mode'), ['widget', 'ExportPDF', 'GetPrintReport'])
            ;
    }

    public static function showScriptsDashBoard(Vtiger_Request $request)
    {
        return true === $request->has('module')
            && 'ITS4YouReports' === $request->get('module')
            && !in_array($request->get('mode'), ['widget', 'ExportPDF', 'GetPrintReport'])
            ;
    }

    protected static function getCountValue($totals_array, $count_key)
    {
        if (ITS4YouReports_TabularCalculations_Config::avgUseEmptyRowsCount()) {
            return $totals_array[$count_key];
        }

        return $totals_array['AVG_NOT_EMPTY_COUNT'];
    }

    protected static function getSiteUrl()
    {
        global $site_URL;

        return trim($site_URL, '/');
    }

    protected static function getColumnDateSql($columnSql, $comparator, $dataType='')
    {
        /*
        if ('DT' === $dataType
            && in_array(
                $comparator,
                [
                    'custom',
                ]
            )
        ) {
            $columnSql = ' DATE(' . trim($columnSql) . ') ';
        }
        */

        return $columnSql;
    }

    protected function useQueryCalculation()
    {
        return 'tabular' === $this->report_obj->reportinformations['reporttype'];
    }

    protected function getCalculationForTabular($calculationType, $column)
    {
        $return = 0;
        $columnString = $this->columns_array[$column];

        if (empty($columnString)) {
            return $return;
        }

        $fldCond = $this->columns_array[$columnString]['fld_cond'];

        if (empty($fldCond)) {
            return $return;
        }

        $sqlArrayLimit = explode('FROM ' . $this->parimary_table_name, $this->tf_sql);
        $sqlArray = explode(' LIMIT ', $sqlArrayLimit[1]);

        $query = sprintf('SELECT %s(%s) calculated_value FROM ' . $this->parimary_table_name . $sqlArray[0],
            $calculationType,
            $fldCond
        );

        if (!ITS4YouReports_TabularCalculations_Config::avgUseEmptyRowsCount()) {
            $query .= sprintf(
                '
            AND 
            (
                %s IS NOT NULL 
                AND %s != "" 
            )
            ',
                $fldCond
                ,
                $fldCond
            );
        }

        if (!empty($this->report_obj->reportinformations['columns_limit'])
            && 'all' !== $_REQUEST['type']
        ) {
            $query .= ' LIMIT ' . $this->report_obj->reportinformations['columns_limit'];
        }

        $result = self::db()->query($query);

        if ($result && self::db()->num_rows($result)) {
            $row = self::db()->fetchByAssoc($result, 0);
            $return = $row['calculated_value'];
        }

        return $return;
    }

    protected function getTotalCalculation($column, $calculationType, $currency_id = false)
    {
        $adb = PearDatabase::getInstance();
        $totalFinalSql = $this->tf_sql;
        $val = 0;

        $totalFinalArray = explode('LIMIT ', $totalFinalSql);
        $totalFinalSubArray = explode('FROM ', $totalFinalArray[0]);
        $sqlTorso = $totalFinalSubArray[1];

        if (!empty($currency_id)) {
            if (false === strpos($sqlTorso, 'WHERE ')) {
                $jCond = ' WHERE ';
            } else {
                $jCond = ' AND ';
            }

            $sqlTorso .= sprintf(' %s %s = %s',
                $jCond,
                ltrim($this->group_by_currency_sql, ','),
                $currency_id
            );
        }

        $columnSql = $this->columns_array[$this->columns_array[$column]]['fld_cond'];

        if (false === strpos($sqlTorso, 'WHERE ')) {
            $jCond = ' WHERE ';
        } else {
            $jCond = ' AND ';
        }

        if (!ITS4YouReports_TabularCalculations_Config::avgUseEmptyRowsCount()) {
            $sqlTorso .= sprintf(' %s (%s IS NOT NULL AND %s != "")',
                $jCond,
                $columnSql,
                $columnSql
            );
        }

        $result = $adb->query(sprintf('SELECT %s(%s) %s 
                            FROM %s',
                $calculationType,
                $columnSql,
                $column,
                $sqlTorso)
        );

        if ($result) {
            $numRows = $adb->num_rows($result);

            if ($numRows > 0) {
                $row = $adb->fetchByAssoc($result);
                $val = $row[$column];
            }
        }

        return $val;
    }

    protected static function isSingleCellField($fieldName): bool
    {
        return (preg_match("/^quantity/", $fieldName))
            || (preg_match("/^ps_productvatsum/", $fieldName));
    }
}
