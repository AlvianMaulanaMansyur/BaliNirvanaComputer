document.addEventListener("DOMContentLoaded", function () {
    // Get all elements with the class 'format'
    const priceElements = document.querySelectorAll('.format .price');

    // Loop through each element and format the currency
    priceElements.forEach(function (element) {
        const amount = parseFloat(element.textContent.replace('Rp. ', '').replace(',', ''));
        element.textContent = 'Rp. ' + formatCurrency(amount);
    });
});