<!-- cart -->
<div class="row d-flex py-5" style="justify-content: center;">

    <div class="col-lg-8 col-md-10 col-sm-12 card border shadow-0">
        <div class="m-4">
            <h4 class="card-title mb-4">Keranjang Anda</h4>
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

                <div class="row gy-3 mb-4">
                    <div class="col-lg-5">
                        <div class="me-lg-5">
                            <div class="d-flex" style="align-items: center;">
                                <input class="me-3 checkbox-product" type="checkbox" data-id="<?php echo $key['id_cart']; ?>" data-initial-stock="<?php echo $key['stok_produk']; ?>" <?php echo ($key['is_check'] == 1 && $key['stok_produk'] > 0) ? 'checked' : ''; ?> onchange="updateIsCheck(this)" <?php echo ($key['stok_produk'] == 0 || $key['qty_produk'] > $key['stok_produk']) ? 'disabled' : ''; ?>>

                                <a href="<?php echo base_url('produk/') . $key['id_produk'] ?>" class="nav-link">
                                    <img src="<?php echo base_url($key['url_foto']) ?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                                    <div class="">
                                        <?php echo $key['nama_produk'] ?>
                                </a>
                                <p class="text-muted"><?php echo $key['nama_category'] ?></p>


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

                <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                    <div class="d-flex me-5" style="justify-content: center;text-align: center;">
                        <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart']; ?>" data-action="decrease" <?php echo ($key['qty_produk'] == 1 || $key['stok_produk'] == 0) ? 'disabled' : ''; ?> style="height: 40px;width: 50px;text-align: center;">
                            <i class="fas fa-minus"></i>
                        </button>

                        <h4 id="qty_<?php echo $key['id_cart']; ?>" class="mx-2"><?php echo $key['qty_produk']; ?></h4>

                        <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart']; ?>" data-action="increase" <?php echo ($key['qty_produk'] == $key['stok_produk'] || $key['stok_produk'] == 0) ? 'disabled' : ''; ?> style="height: 40px;width: 50px;text-align: center;">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    <div class="">
                        <h6><span id="subtotal_<?php echo $key['id_cart']; ?>" class="format"><?php $key['harga_produk'] * $key['qty_produk']; ?></span></h6>
                        <small class="text-muted text-nowrap"><span class="format"><?php echo $key['harga_produk'] ?></span>/per item</small>
                    </div>
                </div>
                <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
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

<div class="col-lg-3 col-md-10 col-sm-12 pt-2">

    <div class="card shadow-0 border">
        <div class="d-flex justify-content-between pt-3 px-2">
            <p class="mb-2 fw-bold" id="total_checked_price"></p>

        </div>

        <div class="row my-3 d-flex flex-column" style="align-items: center;">
            <div class="col-11">
                <a href="#" class="btn btn-success w-100 shadow-0 mb-2" onclick="return validateCheckout()"> Lanjutkan Transaksi </a>
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

        $('.quantity-control').on('click', function(e) {
            e.preventDefault();

            // Ambil data-id dan data-action dari elemen yang diklik
            var id_cart = $(this).data('id');
            var action = $(this).data('action');

            // Panggil fungsi untuk mengupdate jumlah produk
            updateQuantity(id_cart, action);
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

    function updateQuantity(id_cart, action) {
        $.ajax({
            url: '<?php echo base_url('user/updateQuantity/'); ?>' + id_cart,
            type: 'POST',
            data: {
                action: action
            },
            dataType: 'JSON',
            success: function(response) {
                if ('error' in response) {
                    // Handle error (jika diperlukan)
                } else {

                    var qty_produk = parseInt(response.qty_produk);
                    var stok_produk = parseInt(response.stok_produk);
                    var harga_produk = parseInt(response.harga_produk);

                    $('#qty_' + id_cart).text(qty_produk);

                    var newSubtotal = harga_produk * qty_produk;
                    $('#subtotal_' + id_cart).text(formatCurrency(newSubtotal));

                    updateButtonStates(id_cart, qty_produk, stok_produk, function() {
                        updateTotalCheckedPrice();
                    });

                    var stockWarning = $('#qty_' + id_cart).closest('.row').find('.stock-warning');
                    var checkbox = $('.checkbox-product[data-id="' + id_cart + '"]');

                    if (qty_produk > stok_produk) {
                        
                        stockWarning.show();
                        checkbox.prop('checked', false);
                        checkbox.prop('disabled', true);
                    } else {
                        stockWarning.hide();
                        checkbox.prop('disabled', false);
                    }

                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function updateButtonStates(id_cart, qty_produk, stok_produk, callback) {
        var decreaseButton = $('.quantity-control[data-id="' + id_cart + '"][data-action="decrease"]');
        var increaseButton = $('.quantity-control[data-id="' + id_cart + '"][data-action="increase"]');

        // Enable or disable the buttons based on the quantity and stock
        
        if (qty_produk <= 1) {
            decreaseButton.attr('disabled', 'disabled');
        } else {
            decreaseButton.removeAttr('disabled');
        }

        if (qty_produk >= stok_produk) {
            increaseButton.attr('disabled', 'disabled');
        } else {
            increaseButton.removeAttr('disabled');
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
                $('#total_checked_price').text('Total: ' + formatCurrency(response.total_checked_price));
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
</script>