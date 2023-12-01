<div class="container pt-5">
    <h1>Informasi</h1>
    <form action="<?php echo base_url('user/uploadPersonalInfo') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" id="alamat" value="">
        </div>

        <div class="row">
            <div class="d-flex">
                <div class="mb-3 me-4 col-2">
                    <label for="Category" class="form-label">Kabupaten</label>
                    <select name="kota" id="Kota" class="form-select">
                        <option selected value="">Pilih Kabupaten</option>
                        <?php
                        $uniqueKotas = array_unique(array_column($personal, 'kota'));
                        foreach ($uniqueKotas as $kota) {
                        ?>
                            <option value="<?php echo $kota ?>"><?php echo $kota ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3 me-4 col-2">
                    <label for="Category" class="form-label">Kodepos</label>
                    <select name="kodepos" class="form-select" id="kodepos">
                        <option selected value="">Pilih Kodepos</option>
                        <?php foreach ($personal as $key) { ?>
                            <option value="<?php echo $key['kodepos'] ?>" data-kota="<?php echo $key['kota'] ?>"><?php echo $key['kodepos'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>

    <script>
        document.getElementById('Kota').addEventListener('change', function() {
            var selectedKota = this.value;
            var kodeposSelect = document.getElementById('kodepos');

            kodeposSelect.innerHTML = '<option selected>Pilih Kodepos</option>';

            // Tambahkan opsi Kodepos yang sesuai dengan Kabupaten yang dipilih
            <?php foreach ($personal as $key) { ?>
                if ('<?php echo $key['kota'] ?>' === selectedKota) {
                    var option = document.createElement('option');
                    option.value = '<?php echo $key['kodepos'] ?>';
                    option.textContent = '<?php echo $key['kodepos'] ?>';
                    kodeposSelect.appendChild(option);
                }
            <?php } ?>
        });
    </script>
</div>