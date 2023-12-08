document.addEventListener("DOMContentLoaded", function () {
    // Get all elements with the class 'format'
    const priceElements = document.querySelectorAll('.format');

    // Loop through each element and format the currency
    priceElements.forEach(function (element) {
        const amount = parseFloat(element.textContent.replace('Rp. ', '').replace(',', ''));
        element.textContent = formatCurrency(amount);
    });
});

function formatCurrency(amount) {
    // Format number as currency
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, 
        maximumFractionDigits: 0, 
    });
    return formatter.format(amount);
}