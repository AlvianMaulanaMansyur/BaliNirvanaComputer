document.addEventListener("DOMContentLoaded", function () {
	// Get all elements with the class 'format'
	const priceElements = document.querySelectorAll(".format .price");
	priceElements.forEach(function (element) {
		const amount = parseFloat(
			element.textContent.replace("Rp. ", "").replace(",", "")
		);
		element.textContent = "Rp. " + formatCurrency(amount);
	});
});
