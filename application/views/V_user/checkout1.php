<!-- checkout -->

<section class="bg-light py-4">
    <div class="d-flex row" style="justify-content: center;">
        <h1 class="col-10 pt-2" style="margin-left: 300px;">Checkout</h1>
        <div class="pt-3 pb-2 px-3 col-lg-4 col-sm-10">

            <div class="card">

                <form action="<?php echo base_url('buatpesanan') ?>" method="post" enctype="multipart/form-data" class="">

                    <div class="row d-flex px-3 pt-2">

                        <!-- Input Personal Info -->
                        <div class="">
                            <h5 class="card-title pt-2">PEMBAYARAN</h5>

                            <fieldset disabled>
                                <div class="mb-4">
                                    <label for="alamat" class="form-label">Nama</label>
                                    <input type="text" name="nama_customer" class="form-control" id="alamat" value="<?php echo $cart[0]['nama_customer'] ?>">
                                </div>

                                <div class="mb-4">
                                    <label for="alamat" class="form-label">No. Telepon</label>
                                    <input type="text" name="telepon" class="form-control" id="alamat" value="<?php echo $cart[0]['telepon'] ?>">
                                </div>

                                <div class="mb-4">
                                    <label for="alamat" class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" id="alamat" value="<?php echo $cart[0]['email'] ?>">
                                </div>
                            </fieldset>

                            <div class="mb-4">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat Pengiriman" value="<?php echo $cart[0]['alamat'] ?>" required>
                                <input type="text" name="detail_alamat" class="form-control" id="" placeholder="Detail Alamat, contoh: Di dekat pura" value="<?php echo $cart[0]['detail_alamat'] ?>">
                            </div>


                            <div class="row mb-4">
                                <div class="mb-3 me-4 col-5">
                                    <label for="Category" class="form-label">Kabupaten</label>
                                    <?php
                                    $selectedKotaKab = (!empty($cart)) ? $cart[0]['id_kota_kab'] : ''; // Variabel untuk menyimpan id_kota_kab yang ingin dipilih
                                    $selectedKecamatan = (!empty($cart)) ? $cart[0]['id_kecamatan'] : ''; // Variabel untuk menyimpan id_kecamatan yang ingin dipilih

                                    $kotaOptions = array(); // Array asosiatif untuk menyimpan kabupaten unik
                                    $kecamatanOptions = array(); // Array asosiatif untuk menyimpan kecamatan unik berdasarkan kabupaten yang dipilih

                                    foreach ($kota as $city) {
                                        $kotaOptions[$city['id_kota_kab']] = $city['kota'];

                                        if ($city['id_kota_kab'] == $selectedKotaKab) {
                                            $kecamatanOptions[$city['id_kecamatan']] = $city['kecamatan'];
                                        }
                                    }
                                    ?>

                                    <select name="kota" id="Kota" class="form-select">
                                        <?php foreach ($kotaOptions as $id => $kotaOption) { ?>
                                            <option value="<?php echo $id; ?>" <?php echo ($id == $selectedKotaKab) ? 'selected' : ''; ?>>
                                                <?php echo $kotaOption; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-3 col-5">
                                    <label for="Category" class="form-label">Kecamatan</label>
                                    <select name="id_kecamatan" class="form-select" id="kecamatan">
                                        <?php foreach ($kecamatanOptions as $id => $kecamatanOption) { ?>
                                            <option value="<?php echo $id; ?>" <?php echo ($id == $selectedKecamatan) ? 'selected' : ''; ?>>
                                                <?php echo $kecamatanOption; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="mb-4 col-5">
                                    <label for="alamat" class="form-label">Kodepos</label>
                                    <input type="number" name="kodepos" pattern="[0-9]{5}" class="form-control" value="<?php echo $cart[0]['kodepos'] ?>" required>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>
        </div>
        <!-- Akhir Input Personal Info -->

        <!-- Start Product Info -->
        <div class="py-3 px-3 col-lg-4 col-sm-10">
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

                            <?php $total += $key['harga_produk'] * $key['qty_produk'] ?>
                        <?php } ?>

                        <div class="d-flex pt-5 me-lg-5 me-sm-0" style="justify-content: end;">
                            <h5 style="font-weight: 500;">Total Harga:  <span class="format"><?php echo $total ?></span></h5>
                        </div>
                        <div class="d-flex me-lg-5 me-sm-0" style="justify-content: end;">
                            <button type="submit" class="btn col-lg-4 col-sm-4" style="background: #D21312;color:white;">Buat Pesanan</button>
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
        <!-- End Product Info -->
        </form>
    </div>
</section>

<!-- Script JavaScript -->
<script>
    $(document).ready(function() {
        // Fungsi untuk mengatur nilai default dan filter kecamatan
        function updateKecamatanOptions(selectedKotaId) {
            // Ambil nilai kecamatan yang sudah terpilih sebelumnya
            var selectedKecamatanId = $('#kecamatan').val();

            // Hapus opsi-opsi kecamatan yang ada
            $('#kecamatan option:not(:first-child)').remove();

            // Tambahkan opsi default
            var defaultOption = '<option selected value="">Pilih Kecamatan</option>';
            $('#kecamatan').append(defaultOption);

            // Filter dan update opsi kecamatan berdasarkan kabupaten yang dipilih
            <?php foreach ($kota as $key) { ?>
                if ('<?php echo $key['id_kota_kab'] ?>' === selectedKotaId) {
                    // Jika id_kecamatan sama dengan yang sudah terpilih, skip opsi tersebut
                    if ('<?php echo $key['id_kecamatan'] ?>' !== selectedKecamatanId) {
                        var option = '<option selected value="<?php echo $key['id_kecamatan'] ?>" data-kota="<?php echo $key['kota'] ?>"><?php echo $key['kecamatan'] ?></option>';
                        $('#kecamatan').append(option);
                    }
                }
            <?php } ?>

            // Pilih kembali kecamatan yang sudah terpilih sebelumnya
            $('#kecamatan').val(selectedKecamatanId);
        }

        // Ambil nilai awal dari data yang akan diedit
        var selectedKotaId = '<?php echo !empty($cart) ? $cart[0]['id_kota_kab'] : ''; ?>';
        var selectedKecamatanId = '<?php echo !empty($cart) ? $cart[0]['id_kecamatan'] : ''; ?>';

        // Panggil fungsi untuk mengatur nilai default dan filter
        updateKecamatanOptions(selectedKotaId);

        // Handler perubahan pada elemen <select> kabupaten
        $('#Kota').change(function() {
            // Hapus semua opsi kecamatan dan tambahkan opsi default
            $('#kecamatan').empty();
            updateKecamatanOptions($(this).val());
        });
    });
</script>