<!-- cart -->
<div class="row d-flex py-5" style="justify-content: center;">

    <div class="col-lg-6 col-md-10 col-sm-12 card border shadow-0 mb-3">
        <div class="m-4">
            <h4 class="card-title mb-4">Keranjang</h4>
            <?php foreach ($cart as $key) { ?>
                <?php
                // Add these lines inside your foreach loop
                $isStockEmpty = $key['stok_produk'] == 0;
                $disableCheckbox = $isStockEmpty ? 'disabled' : '';
                $disableQuantityButtons = $isStockEmpty ? 'disabled' : '';

                if ($isStockEmpty || $key['qty_produk'] > $key['stok_produk']) {
                    $this->M_cart->updateIsCheck($key['id_cart'], 0);
                }
                ?>

                <div class="row gy-3 mb-4 pt-3">
                    <div class="col-lg-5">
                        <div class="me-lg-5">
                            <div class="d-flex">
                            <div class="d-flex align-items-center">
                                <input class="me-3 checkbox-produt" type="checkbox" data-id="<?php echo $key['id_cart']; ?>" data-initial-stock="<?php echo $key['stok_produk']; ?>" <?php echo ($key['is_check'] == 1 && $key['stok_produk'] > 0) ? 'checked' : ''; ?> onchange="updateIsCheck(this)" <?php echo ($key['stok_produk'] == 0 || $key['qty_produk'] > $key['stok_produk']) ? 'disabled' : ''; ?>>
                            </div>

                                <a href="<?php echo base_url('produk/') . $key['slug'] ?>" class="nav-link">
                                    <img src="<?php echo base_url($key['url_foto']) ?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                                    <div class="">
                                        <?php echo $key['nama_produk'] ?>
                                </a>
                                <!-- <p class="text-muted"><?php echo $key['nama_category'] ?></p> -->


                                <?php if ($key['qty_produk'] > $key['stok_produk'] && !$isStockEmpty) : ?>
                                    <p class="stock-warning">Jumlah melebihi stok! Tidak bisa dicheckout. (stok <?php echo $key['stok_produk'] ?>)</p>
                                <?php endif; ?>

                                <?php if ($isStockEmpty) : ?>
                                    <p class="stock-warning">Maaf stok barang habis</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                    <div class="input-group input-group-sm d-flex me-5 col-lg-8 col-sm-3 col-md-5 w-75 pt-3" style="justify-content: center;align-items: ;">

                        <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart'] ?>" data-stock="<?php echo $key['stok_produk'] ?>" onclick="validateAndSetQuantity(this, 'decrease', event)" <?php echo ($key['qty_produk'] <= 1) ? 'disabled' : ''; ?> style="height: 30px; width: 33%;" data-action='decrease'>
                            <i class="fa-solid fa-minus"></i>
                        </button>

                        <input type="text" id="qty_<?php echo $key['id_cart']; ?>" class="form-control text-center border border-secondary" name="qty_produk" value="<?php echo $key['qty_produk']; ?>" aria-label="Example text with button addon" aria-describedby="button-addon1" style="height: 30px; width: 33%; text-align: center;" oninput="validateAndSetQuantity(this, 'input', event)" maxlength="3" data-id="<?php echo $key['id_cart']; ?>" data-stock="<?php echo $key['stok_produk']; ?>" />

                        <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart']; ?>" data-stock="<?php echo $key['stok_produk']; ?>" onclick="validateAndSetQuantity(this, 'increase', event)" <?php echo ($key['qty_produk'] >= $key['stok_produk']) ? 'disabled' : ''; ?> style="height: 30px; width: 33%; text-align: center;" data-action='increase'>
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <small id="quantityMessage_<?php echo $key['id_cart']; ?>" class="text-danger"></small>

                    </div>

                    <div class="d-flex flex-column pt-3" style="justify-content: ;">
                        <h6><span id="subtotal_<?php echo $key['id_cart']; ?>" class="format"><?php $key['harga_produk'] * $key['qty_produk']; ?></span></h6>
                        <small class="text-muted text-nowrap"><span class="format"><?php echo $key['harga_produk'] ?></span>/per item</small>
                    </div>
                </div>

                <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2 pt-3" style="align-items: ;">
                    <div class="float-md-end">
                        <!--                   <a href="#!" class="btn btn-light border px-2 icon-hover-primary"><i class="fas fa-heart fa-lg px-1 text-secondary"></i></a> -->
                        <a href="<?php echo base_url('user/deleteCart/') . $key['id_cart'] ?>" class="btn btn-light border text-danger icon-hover-danger delete-cart-item"> Hapus</a>
                    </div>
                </div>
        </div>


    <?php } ?>
    <div class="border-top pt-4 mx-4 mb-4">
        <p><i class="fas fa-truck text-muted fa-lg"></i> Pengiriman Akan Dilakukan 1-2 Hari Setelah Pembayaran</p>
        <p class="text-muted">
            Proses pengiriman akan dilakukan setelah pihak pembeli melakukan pembayaran dan mengonfirmasi pembayaran kepada penjual yang dilakukan melalui whatsapp.
        </p>
    </div>
    </div>
</div>

<div class="col-lg-3 col-md-10 col-sm-12 ">
    <div class="card shadow-0 border">
        <h4 class="p-3">Ringkasan Belanja</h4>

        <div class="d-flex pt- px-4" style="justify-content: sp;">
            <h6 class="pe-3">Total Harga</h6>
            <p class="mb-2 fw-bold" id="total_checked_price"></p>
        </div>

        <div class="row my-3 d-flex flex-column" style="align-items: center;">
            <div class="col-11" style="">
                <a href="#" class="btn w-100 shadow-0 mb-2" onclick="return validateCheckout()" style="background: #D21312;color:white;"> Lanjutkan Transaksi </a>
            </div>
            <div class="col-11">
                <a href="<?php echo base_url('shop') ?>" class="btn btn-light w-100 border mt-2"> Kembali Berbelanja </a>
            </div>
        </div>
    </div>
</div>

</div>
<!-- end cart -->
<script>
    $(document).ready(function() {

        $.each(<?php echo json_encode($cart); ?>, function(index, cartItem) {
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
            url: '<?php echo base_url('user/updateQuantity/'); ?>' + id_cart,
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

        $.ajax({
            url: '<?php echo base_url('user/updateIsCheck/'); ?>' + id_cart,
            type: 'POST',
            data: {
                is_check: is_check
            },
            success: function(response) {
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
            url: '<?php echo base_url('user/updateTotalCheckedPrice'); ?>',
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
            window.location.href = '<?php echo base_url('checkout') ?>';
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
            url: '<?php echo base_url('LandingPage/getCartAndOrderCount'); ?>', // Ganti dengan URL yang sesuai
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
</script>