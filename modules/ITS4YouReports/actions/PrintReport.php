<?php

/*+********************************************************************************
 * The content of this file is subject to the Reports 4 You license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/
require_once('modules/ITS4YouReports/GenerateObj.php');

class ITS4YouReports_PrintReport_Action extends Vtiger_Action_Controller
{
    public function checkPermission(Vtiger_Request $request)
    {
    }

    function preProcess(Vtiger_Request $request)
    {
        return true;
    }

    function postProcess(Vtiger_Request $request)
    {
        return true;
    }

    public function process(Vtiger_Request $request)
    {
        $report_chartpdf = '';
        @ob_clean();

        if (true === vtlib_isModuleActive('PDFMaker') && file_exists('modules/PDFMaker/resources/mpdf/mpdf.php')) {
            $report_html = $request->get('form_report_html');

            $report_head = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN'>
                        <html>
                          <head>
                          </head>
                          <body>";

            if ($request->has('form_chart_canvas') && '' !== $request->get('form_chart_canvas')) {
                $chart_image = 'data:image/png;base64,' . $request->get('form_chart_canvas');

                $report_chartpdf = "
                <div style='height:21cm;text-align:center;'><img src='" . $chart_image . "'></div>";
            }
            $report_foot = '</body>
                        </html>';

            if ($request->has('type') && in_array($request->get('type'), ['all', 'base'])) {
                $record = $request->get('record');

                // set reload to generate query by defined Filter criteria
                $_REQUEST['reload'] = 1;

                $ITS4YouReports = new ITS4YouReports(true, $record);
                $generate = new GenerateObj($ITS4YouReports,"",false,true);
                $reportData = $generate->generateReport($record);
                $report_html = $reportData[0];
            }

            //--start report
            echo $report_head;

            if ($request->has('form_report_name') && !empty($request->get('form_report_name'))) {
                $form_report_name = $request->get('form_report_name');
                echo GenerateObj::placeReportNameToPDF($form_report_name);
            }

            echo $report_html;
            //--end

            $report_totals = '<br />' . $request->get('form_report_totals');
            $report_totals_arr = explode('<!--LIMIT_INF-->', $report_totals);
            if (ITS4YouReports_Functions_Helper::count($report_totals_arr) > 1) {
                $report_totals = $report_totals_arr[0] . $report_totals_arr[2];
            }
            echo $report_totals;

            if (!empty($report_chartpdf)) {
                echo $report_chartpdf;
            }

            echo $report_foot;
?>
<script type="text/javascript">
    window.print();
    setTimeout(function(){
        window.close();
    }, 1000);
</script>
<?php
            exit;
        }
    }
}
