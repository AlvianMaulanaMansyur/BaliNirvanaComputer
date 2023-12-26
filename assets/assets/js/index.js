document.getElementById('downloadAsImage').addEventListener('click', function() {
    html2canvas(document.getElementById('invoice')).then(function(canvas) {
        // Convert the canvas to a data URL in JPEG format with specified quality
        var imgData = canvas.toDataURL('image/jpeg', 0.9);

        // Create a link element to trigger the download
        var link = document.createElement('a');
        link.href = imgData;
        link.download = 'invoice.jpg';
        link.click();
    });
});
