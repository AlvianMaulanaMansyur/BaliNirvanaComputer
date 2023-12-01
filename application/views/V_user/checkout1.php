<form action="<?php echo base_url('user/transaksi') ?>" method="post" enctype="multipart/form-data">

    <div class="p-5 row d-flex">

        <!-- Input Personal Info -->
        <div class="col">
            <h1>Checkout</h1>
            <fieldset disabled>
                <div class="mb-4">
                    <label for="alamat" class="form-label">Nama</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $cart[0]['nama_customer'] ?>">
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label">No. Telp</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $cart[0]['telepon'] ?>">
                </div>

                <div class="mb-4">
                    <label for="alamat" class="form-label">Email</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $cart[0]['email'] ?>">
                </div>
            </fieldset>

            <div class="mb-4">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" id="alamat" value="<?php echo $cart[0]['alamat'] ?>">
            </div>

            <div class="mb-4">
                <label for="alamat" class="form-label">Detail Alamat</label>
                <input type="text" name="detail_alamat" class="form-control" id="alamat" value="">
            </div>

            <div class="row mb-4">
                <div class="d-flex">
                    <div class="mb-3 me-4 col-4">
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
                    
                    <div class="mb-3 me-4 col-4">
                    <label for="Category" class="form-label">Kecamatan</label>
                    <select name="id_kecamatan" class="form-select" id="kecamatan">
                            <?php foreach ($kecamatanOptions as $id => $kecamatanOption) { ?>
                                <option value="<?php echo $id; ?>" <?php echo ($id == $selectedKecamatan) ? 'selected' : ''; ?>>
                                    <?php echo $kecamatanOption; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="alamat" class="form-label">Kodepos</label>
                        <input type="number" name="kodepos" pattern="[0-9]{5}" class="form-control" value="<?php echo $cart[0]['kodepos'] ?>" required>
                    </div>

                </div>
            </div>

        </div>
        <!-- Akhir Input Personal Info -->

        <!-- Start Product Info -->
        <div class="col-lg-7 col-sm-12">
            <h1>Product Info</h1>
            <?php $total = 0; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    <?php foreach ($cart as $key) { ?>

                        <tr>
                            <td><?php echo $key['nama_produk'] ?></th>
                            <td><?php echo $key['harga_produk'] ?></td>
                            <td><?php echo $key['qty_produk'] ?></td>
                            <td><?php echo $key['harga_produk'] * $key['qty_produk'] ?></td>
                        </tr>

                        <?php $total += $key['harga_produk'] * $key['qty_produk'] ?>
                    <?php } ?>
                </tbody>
            </table>

            <h1>Total : <?php echo $total ?></h1>
            <button type="submit" class="btn btn-success col-2">Order</button>
        </div>
        <!-- End Product Info -->

    </div>

</form>


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