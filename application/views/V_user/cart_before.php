<?php foreach ($cart as $key) { ?>
    <?php
    // Add these lines inside your foreach loop
    $isStockEmpty = $key['stok_produk'] == 0;
    $disableCheckbox = $isStockEmpty ? 'disabled' : '';
    $disableQuantityButtons = $isStockEmpty ? 'disabled' : '';
    ?>

    <div class="container d-flex <?php echo $isStockEmpty ? 'blur-effect' : ''; ?>" style="justify-content: space-between;">

        <div>
            <?php
            // Update is_check to 0 if the stock is 0
            if ($key['stok_produk'] == 0) {
                $this->M_cart->updateIsCheck($key['id_cart'], 0);
            }
            ?>
            <?php if ($key['qty_produk'] > $key['stok_produk']) : ?>
                <?php $this->M_cart->updateIsCheck($key['id_cart'], 0); ?>
            <?php endif; ?>

            <input type="checkbox" data-id="<?php echo $key['id_cart']; ?>" <?php echo ($key['is_check'] == 1 && $key['stok_produk'] > 0) ? 'checked' : ''; ?> onchange="updateIsCheck(this)" <?php echo ($key['stok_produk'] == 0 || $key['qty_produk'] > $key['stok_produk']) ? 'disabled' : ''; ?>>

            <img src="<?php echo base_url($key['foto_produk']); ?>" alt="Foto Produk" style="width: 300px;height: auto;">
            <?php echo $key['nama_produk'] ?>

            <?php if ($key['qty_produk'] > $key['stok_produk']) : ?>
                <p class="stock-warning">Jumlah melebihi stok! Tidak bisa dicheckout.</p>
            <?php endif; ?>


        </div>

        <div class="d-flex" style="align-items:center ;">

            <div class="me-5 d-flex position-relative">
                <!-- Tombol Minus -->
                <button class="quantity-control button-qty" data-id="<?php echo $key['id_cart']; ?>" data-action="decrease" <?php echo ($key['qty_produk'] == 1 || $key['stok_produk'] == 0) ? 'disabled' : ''; ?>>
                    <i class="fas fa-minus"></i>
                </button>

                <h4 id="qty_<?php echo $key['id_cart']; ?>" class="mx-2"><?php echo $key['qty_produk']; ?></h4>

                <button class="quantity-control button-qty" data-id="<?php echo $key['id_cart']; ?>" data-action="increase" <?php echo ($key['qty_produk'] == $key['stok_produk'] || $key['stok_produk'] == 0) ? 'disabled' : ''; ?>>
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>
            <div class="me-5">
                <div class="me-5">
                    Subtotal: <span class="format" id="subtotal_<?php echo $key['id_cart']; ?>"><?php echo $key['harga_produk'] * $key['qty_produk']; ?></span>
                </div>

            </div>
            <div>
                <a href="<?php echo base_url('user/deleteCart/') . $key['id_cart'] ?>" class="btn btn-danger delete-cart-item"><i class="fa-solid fa-trash"></i></a>
            </div>

        </div>
    </div>

<?php } ?>

<div class="container d-flex flex-column pt-5">

    <div>
        <h3 id="total_checked_price" class="format"></h3>
    </div>
    <a href="<?php echo base_url('checkout') ?>" class="btn btn-danger col-2">Checkout</a>
</div>



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
                    $('#subtotal_' + id_cart).text(formatCurrency(newSubtotal));

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
        $('#subtotal_' + cartItem.id_cart).text(formatCurrency(newSubtotal));
    }
</script>