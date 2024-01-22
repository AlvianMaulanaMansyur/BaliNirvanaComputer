<!-- checkout1 -->

<!-- <section class="bg-light py-4"> -->
<div class="d-flex row" style="justify-content: center;">
    <h1 class="col-10 pt-2" style="margin-left: 30px;">Checkout</h1>
    <div class="pt-3 pb-2 px-3 col-lg-5 col-sm-10">

        <div class="card">

            <form id="checkout-form" action="<?php echo base_url('checkout') ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">

                <div class="d-flex px-3 pt-2">

                    <div class="">
                        <h5 class="card-title pt-2">INFORMASI PERSONAL</h5>

                        <fieldset disabled>
                            <div class="mb-4">
                                <label for="nama_customer" class="form-label">Nama</label>
                                <input type="text" name="nama_customer" class="form-control" id="nama_customer" value="<?php echo $cart[0]['nama_customer'] ?>">
                            </div>

                            <div class="mb-4">
                                <label for="telepon" class="form-label">No. Telepon</label>
                                <input type="text" name="telepon" class="form-control" id="telepon" value="<?php echo $cart[0]['telepon'] ?>">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email" value="<?php echo $cart[0]['email'] ?>">
                            </div>
                        </fieldset>

                        <div class="mb-4">
                            <label for="alamat" class="form-label required-field">Alamat</label>
                            <div id="error-alamat"></div>
                            <?php echo form_error('alamat', '<div class="text-danger">', '</div>'); ?>
                            <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Pengiriman" value="<?php echo $cart[0]['alamat'] ?>">
                            <input type="text" name="detail_alamat" class="form-control" id="detail_alamat" placeholder="Detail Alamat, contoh: Di dekat pura" value="<?php echo $cart[0]['detail_alamat'] ?>">
                        </div>

                        <div class="row mb-4">
                            <div class="mb-3 me-4 col-5">
                                <label for="Category" class="form-label required-field">Kabupaten</label>
                                <div id="error-Kota"></div>
                                <?php echo form_error('kota', '<div class="text-danger">', '</div>'); ?>

                                <?php
                                $selectedKotaKab = (!empty($cart)) ? $cart[0]['id_kota_kab'] : '';
                                $selectedKecamatan = (!empty($cart)) ? $cart[0]['id_kecamatan'] : '';

                                $kotaOptions = array(); // Array asosiatif untuk menyimpan kabupaten unik
                                $kecamatanOptions = array(); // Array asosiatif untuk menyimpan kecamatan unik berdasarkan kabupaten yang dipilih

                                foreach ($kota as $city) {
                                    $kotaOptions[$city['id_kota_kab']] = $city['kota'];

                                    if ($city['id_kota_kab'] == $selectedKotaKab) {
                                        $kecamatanOptions[$city['id_kecamatan']] = array(
                                            'id_kota_kab' => $city['id_kota_kab'],
                                            'nama_kecamatan' => $city['kecamatan']
                                        );
                                    }
                                }
                                ?>

                                <select name="kota" id="Kota" class="form-select">
                                    <?php if (empty($selectedKotaKab)) : ?>
                                        <option value="" selected>Pilih Kabupaten</option>
                                    <?php endif ?>
                                    <?php foreach ($kotaOptions as $id => $kotaOption) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ($id == $selectedKotaKab) ? 'selected' : ''; ?> data-kota-id="<?php echo $id ?>">
                                            <?php echo $kotaOption; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-3 col-5">

                                <label for="Category" class="form-label required-field">Kecamatan</label>
                                <div id="error-kecamatan"></div>
                                <?php echo form_error('kecamatan', '<div class="text-danger">', '</div>'); ?>

                                <select name="kecamatan" class="form-select" id="kecamatan">
                                    <?php foreach ($kecamatanOptions as $id => $kecamatanOption) { ?>
                                        <option value="<?php echo $id; ?>" <?php echo ($id == $selectedKecamatan) ? 'selected' : ''; ?>>
                                            <?php echo $kecamatanOption['nama_kecamatan']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="mb-4 col-5">
                                <?php echo form_error('kodepos', '<div class="text-danger">', '</div>'); ?>

                                <label for="alamat" class="form-label required-field">Kodepos</label>
                                <div id="error-kodepos"></div>
                                <input type="number" name="kodepos" id="kodepos" pattern="[0-9]{5}" class="form-control" value="<?php echo $cart[0]['kodepos'] ?>">
                                <div id="kodepos"></div>
                            </div>



                        </div>

                    </div>
                </div>
        </div>
    </div>

    <div class="py-3 px-3 col-lg-5 col-sm-10">
        <div class="card">

            <div class="card-body">
                <h5 class="card-title">RINGKASAN</h5>

                <div class="">
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $key) { ?>

                        <div class="row d-flex pt-3">
                            <div class="d-flex col-lg-7 col-md-9 col-sm-12">
                                <div>
                                    <img src="<?php echo base_url($key['url_foto']) ?>" class="border rounded me-3" style="width: 100px; height: 100px;" />
                                </div>

                                <div>
                                    <p class="mb-0"><?php echo $key['nama_produk'] ?></p>
                                    <small class="mb-0 text-muted text-nowrap">Jumlah: <?php echo $key['qty_produk'] ?></small>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-3 col-sm-12 pt-lg-0 pt-sm-3 ps-sm-3 ps-lg-0">
                                <h6 class="mb-0"><span class="format"><?php echo $key['harga_produk'] ?></span></h6>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="border mt-3"></div>

                    <div class="d-flex flex-column pt-4 pb-3 me-lg-5 me-sm-0" style="align-items: end;">
                        <div class="d-flex m-0">
                            <h6 style="font-weight: 500;" class="me-2">Total Harga: </h6>
                            <span class="format fw-2"><?php echo $total_harga ?></span>
                        </div>
                            <small class="text-danger" style="font-size: 70%;">*harga sudah termasuk PPN 11%</small>
                    </div>
                    <div class="d-flex me-lg-5 me-sm-0" style="justify-content: end;">
                        <button type="button" id="submitBtn" class="btn col-lg-4 col-sm-4" style="background: #D21312;color:white;">Buat Pesanan</button>


                    </div>
                    <div class="border-top mt-3 pt-4 mx-4 mb-4">
                        <p><i class="fas fa-truck text-muted fa-lg"></i> Pengiriman Akan Dilakukan 1-2 Hari Setelah Pembayaran</p>
                        <p class="text-muted">
                            Proses pengiriman akan dilakukan setelah pihak pembeli melakukan pembayaran dan mengonfirmasi pembayaran kepada penjual yang dilakukan melalui whatsapp.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </form>
</div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // document.getElementById('checkout-form').addEventListener('submit', function (event) {
        document.getElementById('submitBtn').addEventListener('click', function() {
            console.log('halo');
            if (!validateForm()) {

            } else {
                submitFormViaAjax();
            }
        });

        function validateForm() {
            var alamat = document.getElementById('alamat');
            var kota = document.getElementById('Kota');
            var kecamatan = document.getElementById('kecamatan');
            var kodepos = document.getElementById('kodepos');

            // Check if the elements exist before trying to access their properties
            if (!alamat || !kota || !kecamatan || !kodepos) {
                console.error('One or more form elements not found.');
                return false;
            }

            // Reset all error messages
            resetErrorMessages([alamat, Kota, kecamatan, kodepos]);

            var isValid = true;

            // Validasi setiap input
            if (!alamat.value || alamat.value.trim() === '' || alamat.value === null) {
                console.log('Alamat is empty. Showing error message.');
                displayErrorMessage('error-alamat', 'Alamat harus diisi.');
                isValid = false;
            }

            if (!kota.value || kota.value.trim() === '') {
                console.log('Kota is empty. Showing error message.');
                displayErrorMessage('error-Kota', 'Kabupaten harus dipilih.');
                isValid = false;
            }

            if (!kecamatan.value || kecamatan.value.trim() === '') {
                console.log('Kecamatan is empty. Showing error message.');
                displayErrorMessage('error-kecamatan', 'Kecamatan harus dipilih.');
                isValid = false;
            }

            var kodeposValue = kodepos.value.trim();
            if (kodeposValue === '') {
                displayErrorMessage('error-kodepos', 'Kodepos harus diisi.');
                isValid = false;
            } else if (kodeposValue.length !== 5) {
                displayErrorMessage('error-kodepos', 'Kodepos harus berupa angka 5 digit.');
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

        function submitFormViaAjax() {
            // Ambil data formulir
            var formData = new FormData(document.getElementById('checkout-form'));

            // Kirim data formulir ke endpoint di server menggunakan AJAX
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('checkout') ?>',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'JSON',
                success: function(response) {
                    console.log('Formulir berhasil dikirim!', response);
                    var id_pesanan = response.id_pesanan;

                    var redirectURL = base_url + 'prosespesanan/' + id_pesanan;
                    window.location.href = redirectURL;
                },
                error: function(error) {
                    console.error('Terjadi kesalahan saat mengirim formulir', error);
                }
            });
        }
    });

    $(document).ready(function() {
        function updateKecamatanOptions(selectedKotaId) {
            var selectedKecamatanId = $('#kecamatan').val();

            $('#kecamatan').prop('disabled', !selectedKotaId);

            // Hapus opsi-opsi kecamatan yang ada
            $('#kecamatan option:not(:first-child)').remove();

            var defaultOption = '<option value="" selected>Pilih Kecamatan</option>';
            $('#kecamatan').append(defaultOption);

            <?php foreach ($kota as $key) { ?>
                if ('<?php echo $key['id_kota_kab'] ?>' === selectedKotaId) {
                    if ('<?php echo $key['id_kecamatan'] ?>' !== selectedKecamatanId) {
                        var option = '<option value="<?php echo $key['id_kecamatan'] ?>" data-kota="<?php echo $key['kota'] ?>"><?php echo $key['kecamatan'] ?></option>';
                        $('#kecamatan').append(option);
                    }
                }
            <?php } ?>
            $('#kecamatan').val(selectedKecamatanId);

        }

        var selectedKotaId = '<?php echo !empty($cart) ? $cart[0]['id_kota_kab'] : ''; ?>';
        var selectedKecamatanId = '<?php echo !empty($cart) ? $cart[0]['id_kecamatan'] : ''; ?>';

        updateKecamatanOptions(selectedKotaId);

        $('#Kota').change(function() {
            $('#kecamatan').empty();
            updateKecamatanOptions($(this).val());
        });
    });
</script>