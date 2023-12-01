<?php foreach ($cart as $key) { ?>

    <div class="container d-flex" style="justify-content: space-between;">
        <div>
            <input type="checkbox" data-id="<?php echo $key['id_cart']; ?>" <?php echo $key['is_check'] == 1 ? 'checked' : ''; ?> onchange="updateIsCheck(this)">

            <img src="<?php echo base_url($key['foto_produk']); ?>" alt="Foto Produk" style="width: 300px;height: auto;">
            <?php echo $key['nama_produk'] ?>
        </div>


        <div class="d-flex" style="align-items: center;">
        <div class="me-5 d-flex">
                <!-- Tombol Minus -->
                <a href="" class="quantity-control" data-id="<?php echo $key['id_cart']; ?>" data-action="decrease">
                    <i class="fa-solid fa-minus"></i>
                </a>
                <!-- Jumlah Produk -->
                <h4 id="qty_<?php echo $key['id_cart']; ?>" class="mx-2"><?php echo $key['qty_produk']; ?></h4>
                <!-- Tombol Plus -->
                <a href="" class="quantity-control" data-id="<?php echo $key['id_cart']; ?>" data-action="increase">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            <div class="me-5">
                <!-- Subtotal -->
                Subtotal : <span id="subtotal_<?php echo $key['id_cart']; ?>"><?php echo $key['harga_produk'] * $key['qty_produk']; ?></span>
            </div>
            <div>
                <a href="<?php echo base_url('user/deleteCart/') . $key['id_cart'] ?>" class="btn btn-danger delete-cart-item"><i class="fa-solid fa-trash"></i></a>
            </div>
        </div>
    </div>


<?php } ?>

<div class="container d-flex flex-column pt-5">
    <h3 id="total_checked_price"></h3>
    <a href="<?php echo base_url('user/checkout') ?>" class="btn btn-danger col-2">Checkout</a>
</div>

<script>
    $(document).ready(function() {

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
                    parentContainer.addClass('animate__animated animate__fadeOutUp faster');

                    parentContainer.on('animationend webkitAnimationEnd oAnimationEnd', function() {
                        window.location.href = deleteUrl;
                    });
                }
            });
        });
        updateTotalCheckedPrice();
    });

    function updateQuantity(id_cart, action) {
        $.ajax({
            url: '<?php echo base_url('user/updateQuantity/'); ?>' + id_cart,
            type: 'POST',
            data: { action: action },
            dataType: 'json',
            success: function(response) {
                // Update jumlah produk pada elemen HTML yang sesuai
                $('#qty_' + id_cart).text(response.qty_produk);

                // Update subtotal pada elemen HTML yang sesuai
                var newSubtotal = response.harga_produk * response.qty_produk;
                $('#subtotal_' + id_cart).text(newSubtotal);

                // Update total harga yang dicentang pada elemen HTML yang sesuai
                updateTotalCheckedPrice();
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function updateIsCheck(checkbox) {
        var id_cart = $(checkbox).data('id');
        var is_check = checkbox.checked ? 1 : 0;

        // Kirim permintaan AJAX untuk menyimpan perubahan
        $.ajax({
            url: '<?php echo base_url('user/updateIsCheck/'); ?>' + id_cart,
            type: 'POST',
            data: {
                is_check: is_check
            },
            success: function(response) {
                // Update total harga yang dicentang pada elemen HTML yang sesuai
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
                $('#total_checked_price').text('Total: ' + response.total_checked_price);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>