<script type="text/javascript" src="libraries/assets/xlsx.full.min.js"></script>
<script src="libraries/assets/jquery.min.js"></script>
<script src="libraries/assets/jspdf.min.js"></script>
<script src="libraries/assets/jspdf.plugin.autotable.min.js"></script>

<script>
  function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('data_table');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
      XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
      XLSX.writeFile(wb, fn || ('{$REPORT_LABEL}.' + (type || 'xlsx')));
  }
  $('.pdfgen').click(function() {
    var pdf = new jsPDF('p', 'pt', 'a4');
    var table = document.getElementById('data_table');
    pdf.autoTable({
      html: table,
      startY: 20,
      styles: { fillColor: false },
      theme: 'grid',
      didDrawCell: function(data) {
        var cellStyles = data.cell.styles;
        pdf.setDrawColor(0);
        pdf.setLineWidth(0.5);
        pdf.rect(data.cell.x, data.cell.y, data.cell.width, data.cell.height);
      },
    });
    pdf.save('{$REPORT_LABEL}.pdf');
  });

  $('#loadresults').click(function() {
    let allSelectedModel = $('#equipmentModel').val();
    let length = 0;
    if(allSelectedModel && allSelectedModel.length) {
      length = allSelectedModel.length;
    }
    let concatenatedstring = "";
    for(i = 0; i < length; i++) {
      if(i == 0){
        concatenatedstring = allSelectedModel[i];
      } else {
        concatenatedstring = concatenatedstring + "#" + allSelectedModel[i];
      }
    }
    let ticketType = $('#ticketType').val();
    let warrantyStatus = $('#warrantyStatus').val();
    window.location.replace("index.php?module=Leads&view=LifeCycle&equipmentModel="+encodeURIComponent(concatenatedstring)+
    "&ticketType="+ticketType +"&warrantyStatus="+warrantyStatus);
  });
</script>