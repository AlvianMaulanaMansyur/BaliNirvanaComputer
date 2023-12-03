<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>
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
                Qty : <input type="number" class="form-input" name="qty_produk" id="Qty_produk" onkeypress="handleKeyPress(event)">
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
        } else if (parseInt(qtyProduk) < 1) {
            // Tampilkan alert warning menggunakan Bootstrap
            document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Jumlah pembelian minimal 1 
            </div>
            `;
        } else  {
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