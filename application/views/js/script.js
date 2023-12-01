document.getElementById('downloadAsImage').addEventListener('click', function() {
    html2canvas(document.getElementById('invoice')).then(function(canvas) {
        var link = document.createElement('a');
        link.href = canvas.toDataURL('image/png');
        link.download = 'invoice.png';
        link.click();
    });
});

document.getElementById('downloadAsPDF').addEventListener('click', function() {
    var pdf = new jsPDF();
    pdf.addHTML(document.getElementById('invoice'), function() {
        pdf.save('invoice.pdf');
    });
});
