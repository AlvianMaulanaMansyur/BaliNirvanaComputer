    $(document).ready(function() {

        var cartData = JSON.parse(document.getElementById('cart-data').getAttribute('data-cart'));

        $.each(cartData, function(index, cartItem) {
            updateCurrencyFormat(cartItem);
        });

        $('.checkbox-product').each(function() {
            var checkbox = $(this);
            var initialStock = parseInt(checkbox.data('initial-stock'));
            var isChecked = checkbox.prop('checked');
            var currentQty = parseInt($('#qty_' + checkbox.data('id')).text());

            if (currentQty > initialStock || initialStock == 0) {
                checkbox.prop('checked', false);
                checkbox.prop('disabled', true);
            }
        });

        // Menangani klik pada tautan hapus
        $('.delete-cart-item').on('click', function(e) {
            e.preventDefault();

            var deleteUrl = $(this).attr('href');
            var parentContainer = $(this).closest('.d-flex');
            window.location.href = deleteUrl;
        });
        updateTotalCheckedPrice();
    });

    // Fungsi untuk mengupdate kuantitas
    function updateQuantity(id_cart, newQuantity) {
        $.ajax({
            url: base_url + 'user/updateQuantity/' + id_cart,
            type: 'POST',
            data: {
                newQuantity: newQuantity
            },
            dataType: 'JSON',
            success: function(response) {
                if ('error' in response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.error,
                    });
                } else {
                    var stock_produk = parseInt(response.stok_produk); // Tambahkan deklarasi stock_produk di sini
                    var qty_produk = parseInt(response.qty_produk); // Tambahkan deklarasi stock_produk di sini
                    var harga_produk = parseInt(response.harga_produk);
                    $('#qty_' + id_cart).val(qty_produk);

                    var Subtotal = harga_produk * qty_produk;
                    $('#subtotal_' + id_cart).text(formatCurrency(Subtotal));

                    var stockWarning = $('#qty_' + id_cart).closest('.row').find('.stock-warning');
                    var checkbox = $('.checkbox-product[data-id="' + id_cart + '"]');

                    if (qty_produk > stock_produk) {
                        stockWarning.show();
                        checkbox.prop('checked', false);
                        checkbox.prop('disabled', true);
                    } else {
                        stockWarning.hide();
                        checkbox.prop('disabled', false);
                    }

                    $.when().then(function() {
                        updateButtonStates(id_cart, qty_produk, stock_produk, function() {
                            updateTotalCheckedPrice();
                        });
                    });

                    updateCartAndOrderCount();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function updateButtonStates(id_cart, qty_produk, stok_produk, callback) {
        var buttonIncrease = $('[data-id="' + id_cart + '"][data-action="increase"]');
        var buttonDecrease = $('[data-id="' + id_cart + '"][data-action="decrease"]');
        if (qty_produk >= stok_produk) {
            buttonIncrease.attr('disabled', 'disable');
        } else {
            buttonIncrease.removeAttr('disabled');
        }

        if (qty_produk <= 1) {
            buttonDecrease.attr('disabled', 'disabled');
        } else {
            buttonDecrease.removeAttr('disabled');
        }

        if (callback && typeof callback === 'function') {
            callback();
        }

    }
    
    function updateIsCheck(checkbox) {
        var id_cart = $(checkbox).data('id');
        var is_check = checkbox.checked ? 1 : 0;
        console.log('halo')
        $.ajax({
            url: base_url + 'user/updateIsCheck/' + id_cart,
            type: 'POST',
            data: {
                is_check: is_check
            },
            success: function(response) {
                console.log('hilo');
                updateTotalCheckedPrice();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function updateTotalCheckedPrice() {
        // Get all checked checkboxes

        // There are checked items, proceed with updating the total price
        $.ajax({
            url: base_url + 'user/updateTotalCheckedPrice',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update total harga yang dicentang pada elemen HTML yang sesuai
                $('#total_checked_price').text(formatCurrency(response.total_checked_price));
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function validateCheckout(event) {
        // Check if any items are selected
        var selectedItems = $('[type="checkbox"]:checked');

        if (selectedItems.length === 0) {
            // If no items are selected, show a SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pilih barang terlebih dahulu sebelum melanjutkan transaksi.',
            });
            event.preventDefault();
            return false; // Prevent the default behavior of the link
        } else {
            window.location.href = base_url+'checkout';
        }

        // If items are selected, proceed with the checkout process
        return true;
    }

    function updateCurrencyFormat(cartItem) {
        var newSubtotal = cartItem.harga_produk * cartItem.qty_produk;
        $('#subtotal_' + cartItem.id_cart).text(formatCurrency(newSubtotal));
    }

    function updateCartAndOrderCount() {
        // Lakukan AJAX request untuk mengambil jumlah produk dari server
        $.ajax({
            url: base_url + 'LandingPage/getCartAndOrderCount', // Ganti dengan URL yang sesuai
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update jumlah produk dalam keranjang
                $('.cart-count').text(response.cartCount);

                // Update jumlah produk dalam pesanan
                $('.order-count').text(response.orderCount);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function validateAndSetQuantity(inputOrButton, action, event) {
        var inputElement;

        if (event.target.tagName === 'BUTTON' || event.target.tagName === 'I') {
            // If the target is a button or an icon, find the associated input
            inputElement = inputOrButton.parentElement.querySelector('input');
        } else if (event.target.tagName === 'INPUT') {
            // If the target is an input field, use it directly
            inputElement = event.target;
        } else {
            // If the target is none of the above, return
            return;
        }

        var currentValue = parseInt(inputElement.value) || 0;
        var id_cart = inputElement.getAttribute('data-id');
        var stock = parseInt(inputElement.getAttribute('data-stock'));
        var quantityMessage = document.getElementById('quantityMessage_' + id_cart);

        if (action === 'increase') {
            currentValue += 1;
        } else if (action === 'decrease') {
            currentValue = Math.max(currentValue - 1, 1);
        } else {
            var sanitizedValue = inputElement.value.replace(/\D/g, '');
            var limitedValue = sanitizedValue.substring(0, 3);
            inputElement.value = limitedValue;
            currentValue = parseInt(limitedValue) || 0;
        }

        if (!isNaN(currentValue) && currentValue > 0 && currentValue <= stock) {

            updateQuantity(id_cart, currentValue);
            if (quantityMessage) {
                quantityMessage.textContent = '';
            }
        } else {
            if (quantityMessage) {
                if (currentValue === 0 || isNaN(currentValue) || currentValue === '') {

                    var buttonDecrease = $('[data-id="' + id_cart + '"][data-action="decrease"]');
                    buttonDecrease.attr('disabled', 'disable');

                    quantityMessage.textContent = 'Minimal jumlah 1';
                } else {

                    var buttonIncrease = $('[data-id="' + id_cart + '"][data-action="increase"]');
                    var buttonDecrease = $('[data-id="' + id_cart + '"][data-action="decrease"]');

                    buttonIncrease.attr('disabled', 'disable');
                    buttonDecrease.removeAttr('disabled');

                    quantityMessage.textContent = 'Jumlah melebihi stok';
                    if (action === 'decrease') {
                        // currentValue = Math.max(currentValue - 1, 1);
                        updateQuantity(id_cart, currentValue);
                        quantityMessage.textContent = '';
                    }
                }
            }
        }
    }