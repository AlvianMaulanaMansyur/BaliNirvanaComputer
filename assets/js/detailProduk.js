    // Fungsi untuk mengganti gambar di detail produk
    document.querySelectorAll('.foto-card').forEach(function(fotoCard) {
        fotoCard.addEventListener('click', function() {
            var newSrc = this.getAttribute('data-src');
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
        var stokProduk = document.getElementById('stokProduk').getAttribute('data-stok');


        if (isNaN(currentQty) || currentQty >= stokProduk) {
            qtyInput.value = currentQty;
        } else {
            qtyInput.value = currentQty + 1;
        }

        updateButtonState();
    }

    function decrementQty() {
        var currentQty = parseInt(qtyInput.value);

        if (isNaN(currentQty) || currentQty <= 1) {
            qtyInput.value = 1;
        } else {
            qtyInput.value = currentQty - 1;
        }

        updateButtonState();
    }

    function updateButtonState() {
        var currentQty = parseInt(qtyInput.value);
        var stokProduk = document.getElementById('stokProduk').getAttribute('data-stok');


        // Disable incrementButton if the quantity reaches the stock limit
        if (currentQty > stokProduk) {
            incrementButton.disabled = true;
        } else if (currentQty == stokProduk) {
            document.getElementById('alertContainer').innerHTML = '';
            incrementButton.disabled = true;
        } else if (currentQty < stokProduk) {
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

        var qtyProduk = document.getElementById('Qty_produk').value;
        var stokProduk = document.getElementById('stokProduk').getAttribute('data-stok');


        if (parseInt(qtyProduk) > stokProduk) {
            // Tampilkan alert warning menggunakan Bootstrap
            document.getElementById('alertContainer').innerHTML = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Jumlah melebihi stok yang tersedia.
        </div>
        `;
            incrementButton.disabled = true;
            decrementButton.disabled = false;

        } else if (qtyProduk.trim() == '' || !/^[1-9]\d*$/.test(qtyProduk)) {
            // Tampilkan alert warning menggunakan Bootstrap
            document.getElementById('alertContainer').innerHTML = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Jumlah pembelian minimal 1 
        </div>
        `;
            incrementButton.disabled = false;
            decrementButton.disabled = true;
        } else {
            document.getElementById('alertContainer').innerHTML = '';
            incrementButton.disabled = false;
        }

    };

    document.getElementById('Qty_produk').addEventListener('keydown', function(event) {
        if (event.keyCode === 13) {
            event.preventDefault(); // Prevent default form submission
            validateAndSubmit(); // Call the validation and submission function
        }
    });

    function validateAndSubmit() {
        var qtyProduk = document.getElementById('Qty_produk').value;
        var stokProduk = document.getElementById('stokProduk').getAttribute('data-stok');
        var produkSlug = document.getElementById('produkSlug').getAttribute('data-slug');

        if (parseInt(qtyProduk) > parseInt(stokProduk)) {
            document.getElementById('alertContainer').innerHTML = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Jumlah melebihi stok yang tersedia.
        </div>
        `;
        } else if (qtyProduk.trim() == '' || !/^[1-9]\d*$/.test(qtyProduk)) {
            document.getElementById('alertContainer').innerHTML = `
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Jumlah pembelian minimal 1 
        </div>
        `;
        } else {
            document.getElementById('alertContainer').innerHTML = '';

            $.ajax({
                type: 'POST',
                url: base_url + 'user/insertcart/' + produkSlug,
                data: $('form').serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log('respon:',response)
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else if (response.success) {
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
                                window.location.href = base_url+'cart';
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