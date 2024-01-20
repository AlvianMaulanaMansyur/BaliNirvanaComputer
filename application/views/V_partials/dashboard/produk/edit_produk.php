<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Tambah Produk</h1>
            </div>

            <form id="edit-produk-form" action="<?php echo base_url('dashboard/insertProduk') ?>" method="post" enctype="multipart/form-data" onsubmit="return validateFormEditProduk()">

                <div>
                    <input hidden readonly type="text" name="id_admin" class="form-control" id="id_admin" value="<?php echo $id_admin ?>">
                </div>

                <div hidden id="id_produk" data-id-produk="<?php echo $produk['id_produk'] ?>"></div>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label required-field">Nama Produk</label>
                    <span id="error-nama_produk"></span>
                    <input type="text" name="nama_produk" class="form-control" id="nama_produk" value="<?php echo $produk['nama_produk'] ?>" >
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label required-field">Kategori</label>
                    <span id="error-category"></span>

                    <select name="category" id="category" class="form-select ">
                    <?php foreach ($category as $categories) { ?>
                                        <?php $selected = ($key['id_category'] == $categories['id_category']) ? "selected" : ""; ?>
                                        <option value="<?php echo $categories['id_category'] ?>" <?php echo $selected ?>><?php echo $categories['nama_category'] ?></option>
                                    <?php } ?>
                    </select>
                </div>

                <div class=" mb-3">
                    <label for="stok_produk" class="form-label required-field">Stok Produk</label>
                    <span id="error-stok_produk"></span>

                    <input type="number" name="stok_produk" class="form-control" id="stok_produk" value="<?php echo $produk['stok_produk'] ?>">
                </div>

                <label for="harga_produk" class="form-label required-field">Harga Produk</label>
                <span id="error-harga_produk"></span>

                <div class="input-group mb-3">
                    <span class="input-group-text">Rp</span>
                    <input type="number" name="harga_produk" class="form-control" id="harga_produk"value="<?php echo $produk['harga_produk'] ?>">
                </div>

                <div class="mb-3">
                    <label for="deskripsi_produk" class="form-label required-field">Deskripsi Produk</label>
                    <span id="error-deskripsi_produk"></span>

                    <textarea class="form-control" id="deskripsi_produk" rows="5" name="deskripsi_produk" value="<?php echo $produk['deskripsi_produk'] ?>"><?php echo $produk['deskripsi_produk'] ?></textarea>
                </div>

                <?php
                            $existing_photos = $this->M_produk->getProductPhotos($produk['id_produk']);
                            $count_existing_photos = count($existing_photos);
                            $photo_urls = [];
                            for ($i = 0; $i < 3; $i++) : ?>

                                <?php
                                if ($i < $count_existing_photos) {
                                    $photo = $existing_photos[$i];
                                    $photo_urls[$photo['urutan_foto']] = $photo['url_foto'];
                                }
                                ?>

                                <?php if ($i == 0) : ?>
                                    <img src="<?php echo base_url($photo_urls[$i + 1]) ?>" alt="Gambar" style="width: 100px; height: auto;">
                                    <div class="mb-3">
                                        <label for="foto_produk<?php echo $i + 1; ?>" class="form-label required-field">
                                            Foto Produk <?php echo $i + 1; ?> (Wajib)
                                        </label>
                                        <input type="file" name="foto_produk<?php echo $i + 1; ?>" class="form-control" id="foto_produk<?php echo $i + 1; ?>">
                                    </div>
                                <?php elseif ($i == 1) : ?>
                                    <?php if (empty($photo_urls[$i + 1])) : ?>
                                    <?php else : ?>
                                        <img src="<?php echo base_url($photo_urls[$i + 1]) ?>" style="width: 100px; height: auto;">
                                        <input type="checkbox" name="delete_foto<?php echo $i + 1 ?>" value="<?php echo $i + 1 ?>"> Hapus Foto
                                    <?php endif ?>

                                    <div class="mb-3">

                                        <label for="foto_produk<?php echo $i + 1; ?>" class="form-label required-field">
                                            Foto Produk <?php echo $i + 1; ?> (Opsional)
                                        </label>

                                        <input type="file" name="foto_produk<?php echo $i + 1; ?>" class="form-control" id="foto_produk<?php echo $i + 1; ?>">
                                    </div>

                                <?php elseif ($i == 2) : ?>
                                    <?php if (empty($photo_urls[$i + 1]) || $photo_urls[$i + 1] == null) : ?>
                                    <?php else : ?>
                                        <img src="<?php echo base_url($photo_urls[$i + 1]) ?>" style="width: 100px; height: auto;">
                                        <input type="checkbox" name="delete_foto<?php echo $i + 1 ?>" value="<?php echo $i + 1 ?>"> Hapus Foto
                                    <?php endif ?>

                                    <div class="mb-3">

                                        <label for="foto_produk<?php echo $i + 1; ?>" class="form-label required-field">
                                            Foto Produk <?php echo $i + 1; ?> (Opsional)
                                        </label>

                                        <input type="file" name="foto_produk<?php echo $i + 1; ?>" class="form-control" id="foto_produk<?php echo $i + 1; ?>">
                                    </div>
                                <?php endif ?>
                            <?php endfor ?>

        </div>
        <button type="button" class="btn btn-primary" id="submitBtn">Submit</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // document.getElementById('checkout-form').addEventListener('submit', function (event) {
        document.getElementById('submitBtn').addEventListener('click', function() {
            if (!validateFormEditProduk()) {

            } else {
                submitEdit();
            }
        });

        function validateFormEditProduk() {
            var nama_produk = document.getElementById('nama_produk');
            var category = document.getElementById('category');
            var stok_produk = document.getElementById('stok_produk');
            var harga_produk = document.getElementById('harga_produk');
            var deskripsi_produk = document.getElementById('deskripsi_produk');
            var foto_produk1 = document.getElementById('foto_produk1');

            if (!nama_produk || !category || !stok_produk || !harga_produk || !foto_produk1 || !deskripsi_produk) {
                console.error('One or more form elements not found.');
                return false;
            }

            // Reset all error messages
            resetErrorMessages([nama_produk, category, stok_produk, harga_produk, foto_produk1, deskripsi_produk]);

            var isValid = true;

            // Validasi setiap input
            if (!nama_produk.value || nama_produk.value.trim() === '' || nama_produk.value === null) {
                console.log('Alamat is empty. Showing error message.');
                displayErrorMessage('error-nama_produk', 'Nama produk harus diisi.');
                isValid = false;
            }

            if (!category.value || category.value.trim() === '') {
                console.log('Kota is empty. Showing error message.');
                displayErrorMessage('error-category', 'Kategori harus dipilih.');
                isValid = false;
            }

            if (!stok_produk.value || stok_produk.value.trim() === '') {
                console.log('Kecamatan is empty. Showing error message.');
                displayErrorMessage('error-stok_produk', 'Stok produk harus diisi.');
                isValid = false;
            }

            if (!harga_produk.value || harga_produk.value.trim() === '') {
                console.log('Kecamatan is empty. Showing error message.');
                displayErrorMessage('error-harga_produk', 'Harga produk harus diisi.');
                isValid = false;
            }

            if (!deskripsi_produk.value || deskripsi_produk.value.trim() === '') {
                console.log('Kecamatan is empty. Showing error message.');
                displayErrorMessage('error-deskripsi_produk', 'Deskripsi produk harus diisi.');
                isValid = false;
            }

            if (!isValid) {
                console.log('One or more fields are not valid.');
            } else {
                console.log('All fields are valid.');
            }

            return isValid;
        }

        function displayErrorMessage(elementId, message) {
            var errorElement = document.getElementById(elementId);
            if (errorElement) {
                errorElement.innerText = message;
                errorElement.classList.add('text-danger');
                errorElement.style.display = 'block'; // Tampilkan pesan kesalahan
            }
        }

        function resetErrorMessages(elements) {
            elements.forEach(function(element) {
                var errorElement = document.getElementById('error-' + element.id);
                if (errorElement) {
                    errorElement.innerText = '';
                    errorElement.style.display = 'none'; // Sembunyikan pesan kesalahan
                }
            });
        }

        function submitEdit() {
            // Ambil data formulir
            var formData = new FormData($('#edit-produk-form')[0]);
            var idProduk = document.getElementById('id_produk').getAttribute('data-id-produk');
            // Kirim data formulir ke endpoint di server menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: base_url + 'editproduk/' + idProduk,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'JSON',
                success: function(response) {
                    console.log('Formulir berhasil dikirim!', response);
                    if (response.hasOwnProperty('data')) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.data,
                        }).then((result) => {
                            // Redirect ke halaman produk setelah menutup SweetAlert
                            if (result.isConfirmed || result.isDismissed) {
                                var redirectURL = base_url + 'dashboard/produk';
                                window.location.href = redirectURL;
                            }
                        });
                    } else {
                        console.error('Respons tidak memiliki properti "data".');
                    }
                },
                error: function(error) {
                    console.error('Terjadi kesalahan saat mengirim formulir', error);

                    // Log or alert the error response
                    console.log(error.responseText);
                }
            });
        }
    });
</script>