<!-- detail barang -->
<section class="py-5">
    <div class="container">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div id="mainPhoto" class="border rounded-4 mb-3 d-flex justify-content-center">
                    <img src="<?php echo base_url($produk['url_foto']); ?>" alt="Foto Produk" style="width: 500px;height: auto;">
                </div>
                <div class="row">
                    <!-- Tampilkan semua foto dalam bentuk card -->
                    <?php foreach ($produk['fotos'] as $foto) : ?>
                        <div class="card mb-3 foto-card d-flex col-3 me-3 " style="align-items: center;" data-src="<?php echo base_url($foto['url_foto']); ?>">
                            <img src="<?php echo base_url($foto['url_foto']); ?>" class="card-img-top" alt="Foto Produk" style="width: auto;height: 140px;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>
            <main class="col-lg-6">

                <form action="<?php echo base_url('user/insertcart/') . $produk['slug'] ?>" method="post" onsubmit="return validateAndSubmit()">
                    <div class="ps-lg-3">
                        <h3 class="title text-dark">
                            <?php echo $produk['nama_produk'] ?>
                        </h3>

                        <div class="mb-3">
                            <span class="format"><?php echo $produk['harga_produk'] ?></span>
                            <span class="text-muted">/per unit</span>
                        </div>

                        <div class="mb-3">
                            Category : <?php echo $produk['nama_category'] ?>
                        </div>

                        <div class="mb-3">
                            Stok : <?php echo $produk['stok_produk'] ?>
                        </div>

                        <div class="col-md-4 col-6 mb-3">
                            <label class="mb-2 d-block">Jumlah</label>
                            <div class="input-group mb-3" style="width: 170px;">
                                <button class="btn btn-white border border-secondary px-3" type="button" id="decrementButton" data-mdb-ripple-color="dark" onclick="decrementQty()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" id="Qty_produk" class="form-control text-center border border-secondary" name="qty_produk" value="1" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                                <button class="btn btn-white border border-secondary px-3" type="button" id="incrementButton" data-mdb-ripple-color="dark" onclick="incrementQty()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div id="alertContainer"></div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger shadow-0" onclick="validateAndSubmit()"><i class="me-1 fa-solid fa-cart-shopping"></i>Keranjang</button>
                            <!-- <button type="submit" class="btn btn-danger shadow-0"><i class="me-1 fa-solid fa-cart-shopping"></i>Keranjang</button> -->
                        </div>

                        <h3 class="pt-3">Deskripsi</h3>
                        <p>
<pre>
<?php echo $produk['deskripsi_produk'] ?>
</pre>
                        </p>
                        
                    </div>

                </form>
            </main>

        </div>

    </div>
    </div>
</section>
<!-- end detail barang -->

<script>
    document.querySelectorAll('.foto-card').forEach(function(fotoCard) {
        fotoCard.addEventListener('click', function() {
            // Dapatkan atribut 'data-src' dari elemen yang diklik
            var newSrc = this.getAttribute('data-src');

            // Ganti atribut 'src' dari elemen 'mainPhoto' dengan nilai baru
            document.getElementById('mainPhoto').getElementsByTagName('img')[0].src = newSrc;
        });
    });

    $(document).ready(function() {
        updateButtonState();
    });
    var qtyInput = document.getElementById('Qty_produk');
    var incrementButton = document.getElementById('incrementButton');
    var decrementButton = document.getElementById('decrementButton');

    function incrementQty() {
        var currentQty = parseInt(qtyInput.value);

        if (isNaN(currentQty)) {
            currentQty = 0;
        }

        qtyInput.value = currentQty + 1;
        updateButtonState();
        document.getElementById('alertContainer').innerHTML = '';
    }

    function decrementQty() {
        var currentQty = parseInt(qtyInput.value);

        if (isNaN(currentQty) || currentQty <= 1) {
            qtyInput.value = 0;
        } else {
            qtyInput.value = currentQty - 1;
        }

        updateButtonState();
        document.getElementById('alertContainer').innerHTML = '';
    }

    function updateButtonState() {
        var currentQty = parseInt(qtyInput.value);
        var stokProduk = <?php echo $produk['stok_produk']; ?>;

        // Disable incrementButton if the quantity reaches the stock limit
        if (currentQty >= stokProduk) {
            incrementButton.disabled = true;
        } else {
            incrementButton.disabled = false;
        }

        // Disable decrementButton if the quantity is 1
        if (currentQty <= 1) {
            decrementButton.disabled = true;
        } else {
            decrementButton.disabled = false;
        }
    }

    document.getElementById('Qty_produk').oninput = function() {

        var qtyInput = document.getElementById('Qty_produk');

        var value = this.value;

        // Remove any non-numeric characters, including '-'
        var sanitizedValue = value.replace(/[^0-9]/g, '');

        // Update the input value with the sanitized value
        this.value = sanitizedValue;

        // Clear the alert container
        document.getElementById('alertContainer').innerHTML = '';
    };

    document.getElementById('Qty_produk').addEventListener('keydown', function(event) {
        if (event.keyCode === 13) {
            event.preventDefault(); // Prevent default form submission
            validateAndSubmit(); // Call the validation and submission function
        }
    });

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
        } else if (qtyProduk.trim() == '' || !/^[1-9]\d*$/.test(qtyProduk)) {
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
                url: '<?php echo base_url("user/insertcart/") . $produk["slug"]; ?>',
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
                            showCancelButton: false,
                            showConfirmButton: true,
                            confirmButtonText: "OK",
                            confirmButtonColor: "#3085d6",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Redirect to the cart page
                                window.location.href = '<?php echo base_url("cart"); ?>';
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
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors if any
                    document.getElementById('alertContainer').innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat menambahkan produk ke keranjang.
                </div>
                `;
                }
            });
        }
    }

    // Update button click events to pass parameter for differentiation
    document.querySelector('.btn-warning').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        validateAndSubmit(true); // Pass true for checkout
    });

    document.querySelector('.btn-danger').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default form submission
        validateAndSubmit(false); // Pass false for cart
    });
</script>