<!-- cart -->

<?php foreach ($cart as $key) { ?>
    <?php
    // Add these lines inside your foreach loop
    $isStockEmpty = $key['stok_produk'] == 0;
    $disableCheckbox = $isStockEmpty ? 'disabled' : '';
    $disableQuantityButtons = $isStockEmpty ? 'disabled' : '';
    ?>

    <?php
    // Update is_check to 0 if the stock is 0
    if ($key['stok_produk'] == 0) {
        $this->M_cart->updateIsCheck($key['id_cart'], 0);
    }
    ?>
    <?php if ($key['qty_produk'] > $key['stok_produk']) : ?>
        <?php $this->M_cart->updateIsCheck($key['id_cart'], 0); ?>
    <?php endif; ?>

    <div class="row d-flex pt-5" style="justify-content: center;align-items: center;">

        <div class="col-lg-8 col-md-10 col-sm-12 card border shadow-0">
            <div class="m-4">
                <h4 class="card-title mb-4">Keranjang Anda</h4>
                <div class="row gy-3 mb-4">
                    <div class="col-lg-5">
                        <div class="me-lg-5">
                            <div class="d-flex">
                                <input type="checkbox" data-id="<?php echo $key['id_cart']; ?>" <?php echo ($key['is_check'] == 1 && $key['stok_produk'] > 0) ? 'checked' : ''; ?> onchange="updateIsCheck(this)" <?php echo ($key['stok_produk'] == 0 || $key['qty_produk'] > $key['stok_produk']) ? 'disabled' : ''; ?>>
                                <img src="<?php echo base_url($key['foto_produk']) ?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                                <div class="">
                                    <a href="#" class="nav-link"><?php echo $key['nama_produk'] ?></a>
                                    <p class="text-muted"><?php echo $key['nama_category'] ?></p>
                                    <?php if ($key['qty_produk'] > $key['stok_produk']) : ?>
                                        <p class="stock-warning">Jumlah melebihi stok! Tidak bisa dicheckout.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                        <div class="d-flex" style="justify-content: center;text-align: center;">
                            <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart']; ?>" data-action="decrease" <?php echo ($key['qty_produk'] == 1 || $key['stok_produk'] == 0) ? 'disabled' : ''; ?> style="height: 40px;width: 50px;text-align: center;">
                                <i class="fas fa-minus"></i>
                            </button>

                            <h4 id="qty_<?php echo $key['id_cart']; ?>" class="mx-2"><?php echo $key['qty_produk']; ?></h4>

                            <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart']; ?>" data-action="increase" <?php echo ($key['qty_produk'] == $key['stok_produk'] || $key['stok_produk'] == 0) ? 'disabled' : ''; ?> style="height: 40px;width: 50px;text-align: center;">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <div class="">
                            <text class="h6"><span class="format"><?php echo $key['harga_produk'] ?></span></text> <br />
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

                <span id="subtotal_<?php echo $key['id_cart']; ?>"><?php $key['harga_produk'] * $key['qty_produk']; ?></span>

                <?php } ?>

                

            <div class="border-top pt-4 mx-4 mb-4">
                <p><i class="fas fa-truck text-muted fa-lg"></i> Pengiriman Akan Dilakukan 1-2 Hari Setelah Pembayaran</p>
                <p class="text-muted">
                    Proses pengiriman akan dilakukan setelah pihak pembeli melakukan pembayaran dan mengonfirmasi pembayaran kepada penjual yang dilakukan melalui whatsapp.
                </p>
            </div>
        </div>
    </div>
  
    <div class="col-3">
        
        <div class="card shadow-0 border">
            <div class="d-flex justify-content-between pt-3 px-2">
                <p class="mb-2 fw-bold format" id="total_checked_price"></p>
               
            </div>

            <div class="mt-3">
                <a href="<?php echo base_url('checkout') ?>" class="btn btn-success w-100 shadow-0 mb-2"> Lanjutkan Transaksi </a>
                <a href="<?php echo base_url('shop') ?>" class="btn btn-light w-100 border mt-2"> Kembali Berbelanja </a>
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

            Swal.fire({
                title: "Hapus Cart?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = deleteUrl;
                }
            });
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
            dataType: 'json',
            success: function(response) {
                if ('error' in response) {
                    // Handle error (jika diperlukan)
                } else {
                    $('#qty_' + id_cart).text(response.qty_produk);

                    var newSubtotal = response.harga_produk * response.qty_produk;
                    // $('#subtotal_' + id_cart).text(formatCurrency(newSubtotal));

                    // Update the button states with a callback for updateTotalCheckedPrice
                    updateButtonStates(id_cart, response.qty_produk, response.stok_produk, function() {
                        updateTotalCheckedPrice();
                    });

                    // Periksa dan atur kembali status checkbox
                    var checkbox = $('.container[data-id="' + id_cart + '"] input[type="checkbox"]');
                    var stockWarning = $('.container[data-id="' + id_cart + '"] .stock-warning');

                    console.log(response.qty_produk);
                    console.log(response.stok_produk);
                    if (response.qty_produk > response.stok_produk) {
                        checkbox.prop('checked', false);
                        checkbox.prop('disabled', true);
                        stockWarning.show();
                    } else {
                        checkbox.prop('disabled', false);
                        stockWarning.hide();
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

        // // Execute the callback if provided
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

    function updateCurrencyFormat(cartItem) {
        var newSubtotal = cartItem.harga_produk * cartItem.qty_produk;
        // $('#subtotal_' + cartItem.id_cart).text(formatCurrency(newSubtotal));
    }
</script>