<div class="container d-flex">
    <img src="<?php echo base_url($produk['foto_produk']); ?>" alt="Foto Produk" style="width: 500px;height: auto;">

    <div class="">
        <form action="<?php echo base_url('user/insertcart/') . $produk['id_produk'] ?>" method="post" onsubmit="return validateAndSubmit()">
            <div class="mb-3">
                <?php echo $produk['nama_produk'] ?>
            </div>

            <div class="mb-3">
                Category : <?php echo $produk['nama_category'] ?>
            </div>

            <div class="mb-3">
                Stok : <?php echo $produk['stok_produk'] ?>
            </div>

            <div class="mb-3">
                Harga : <?php echo $produk['harga_produk'] ?>
            </div>

            <div class="mb-3">
                Qty : <input type="number" class="form-input" name="qty_produk" id="Qty_produk" onkeypress="handleKeyPress(event)" value="1">
            </div>

            <div id="alertContainer"></div>

            <div class="mb-3">
                Deskripsi : <?php echo $produk['deskripsi_produk'] ?>
            </div>

            <button type="button" class="btn btn-success" onclick="validateAndSubmit()">Tambah Keranjang</button>

            <!-- Alert div -->
        </form>
    </div>
</div>

<script>
    document.getElementById('Qty_produk').oninput = function() {
        var value = this.value;

        // Remove any non-numeric characters, including '-'
        var sanitizedValue = value.replace(/[^0-9]/g, '');

        // Update the input value with the sanitized value
        this.value = sanitizedValue;

        // Clear the alert container
        document.getElementById('alertContainer').innerHTML = '';
    };

    function handleKeyPress(event) {
        if (event.keyCode === 13) {
            // Jika tombol yang ditekan adalah "Enter"
            event.preventDefault(); // Mencegah aksi default (pengiriman formulir)
            validateAndSubmit(); // Panggil fungsi validasi dan pengiriman AJAX
        }
    }

    function validateAndSubmit() {
        var qtyProduk = document.getElementById('Qty_produk').value;
        var stokProduk = <?php echo $produk['stok_produk']; ?>;

        if (parseInt(qtyProduk) > stokProduk) {
            // Tampilkan alert warning menggunakan Bootstrap
            document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Jumlah melebihi stok yang tersedia.
            </div>
            `;
        } else if (!/^[1-9]\d*$/.test(qtyProduk)) {
            // Tampilkan alert warning menggunakan Bootstrap
            document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Jumlah pembelian minimal 1 
            </div>
            `;
        } else {
            document.getElementById('alertContainer').innerHTML = '';

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url("user/insertcart/") . $produk["id_produk"]; ?>',
                data: $('form').serialize(),
                dataType: 'json',
                success: function(response) {

                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else if (response.success) {
                        // Tampilkan alert success menggunakan Bootstrap
                        Swal.fire({
                            title: "Success!",
                            text: "Produk berhasil ditambahkan ke keranjang.",
                            icon: "success",
                            showCancelButton: false, // Tidak menampilkan tombol "Cancel"
                            showConfirmButton: true, // Menampilkan tombol "OK"
                            confirmButtonText: "OK", // Label pada tombol "OK"
                            confirmButtonColor: "#3085d6", // Warna tombol "OK"

                        }).then((result) => {
                            // Aksi yang diambil setelah tombol "OK" diklik
                            if (result.isConfirmed) {
                                // Redirect ke landing page atau controller user
                                window.location.href = '<?php echo base_url("home"); ?>';
                            }
                        });

                    } else {
                        if (response.error_message) {
                            // Tampilkan alert danger menggunakan Bootstrap
                            document.getElementById('alertContainer').innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ${response.error_message}
                               
                            </div>
                            `;
                        } else {
                            // Tampilkan alert danger menggunakan Bootstrap
                            document.getElementById('alertContainer').innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Gagal menambahkan produk ke keranjang.
                                
                            </div>
                            `;
                        }
                    }
                },
                error: function() {
                    // Handle errors if any
                }
            });
        }
    }
</script>