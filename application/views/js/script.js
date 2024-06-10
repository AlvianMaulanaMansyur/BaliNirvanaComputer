    document.getElementById('downloadAsImage').addEventListener('click', function() {
    // Tentukan dimensi canvas
    var canvasWidth = 800; // Ganti sesuai kebutuhan Anda
    var canvasHeight = 600; // Ganti sesuai kebutuhan Anda

    // Buat elemen canvas dengan dimensi yang ditentukan
    var staticCanvas = document.createElement('canvas');
    staticCanvas.width = canvasWidth;
    staticCanvas.height = canvasHeight;

    // Ambil konteks 2D dari elemen canvas
    var staticContext = staticCanvas.getContext('2d');

    // Tangkap elemen dengan id 'invoice' ke dalam canvas statis
    html2canvas(document.getElementById('invoice'), { canvas: staticCanvas }).then(function(canvas) {
        // Salin isi canvas dinamis ke canvas statis
        staticContext.drawImage(canvas, 0, 0, canvasWidth, canvasHeight);

        // Buat elemen <a> untuk mengunduh
        var link = document.createElement('a');
        link.href = staticCanvas.toDataURL('image/png');
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
