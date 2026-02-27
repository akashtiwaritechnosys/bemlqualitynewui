{strip}
    <div class="row">
        <div class="col-lg-1">
            <button type="button" class="btn btn-primary">
                <a href="index.php?module=Leads&view=CustomReportList">Back</a></button>
        </div>
        <div align="center" class="col-lg-9">
            <h3>{$REPORT_LABEL}</h3>
        </div>
        <div class="col-lg-1">
            <button onclick="ExportToExcel('xlsx')" type="button" class="btn btn-primary" id="">
                Export as XLSX
            </button>
        </div>
        <div class="col-lg-1">
            <button type="button" class="btn btn-primary pdfgen" id="">
                Export as PDF
            </button>
        </div>
{/strip}