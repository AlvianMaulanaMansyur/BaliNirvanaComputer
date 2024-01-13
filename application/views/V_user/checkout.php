<!-- checkout -->

<section class="bg-light py-4">
    <div class="d-flex row" style="justify-content: center;">
        <h1 class="col-10 pt-">Checkout</h1>
        <div class="pt-3 pb-2 px-3 col-lg-4 col-sm-10">

            <div class="card">
                <div class="card-header">
                    <h3>Personal Info</h3>
                </div>

                <form action="<?php echo base_url('buatpesanan') ?>" method="post" enctype="multipart/form-data">

                    <div class="row d-flex px-3 pt-2">

                        <!-- Input Personal Info -->
                        <div class="">
                            <h5 class="card-title pt-2">INFORMASI PERSONAL</h5>

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
                                <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat Pengiriman" required>
                                <input type="text" name="detail_alamat" class="form-control" id="" placeholder="Detail Alamat, contoh: Di dekat pura">
                            </div>


                            <div class="row mb-4">
                                <div class="mb-3 me-4 col-5">
                                    <label for="Category" class="form-label">Kabupaten</label>
                                    <select name="kota" id="Kota" class="form-select">
                                        <!-- <option selected value="">Pilih Kabupaten</option> -->
                                        <option selected value="">Pilih Kabupaten</option>

                                        <?php
                                        $uniqueCities = array();
                                        foreach ($kota as $city) {
                                            if (!in_array($city['kota'], $uniqueCities)) {
                                                $uniqueCities[] = $city['kota'];
                                        ?>
                                                <option value="<?php echo $city['id_kota_kab'] ?>"><?php echo $city['kota'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>

                                <div class="mb-3 col-5">
                                    <label for="Category" class="form-label">Kecamatan</label>
                                    <select name="id_kecamatan" class="form-select" id="kecamatan">
                                        <option selected value="">Pilih Kecamatan</option>
                                        <?php foreach ($kota as $item) { ?>
                                            <option value="<?php echo $item['id_kecamatan'] ?>" data-kota-id="<?php echo $item['id_kota_kab'] ?>"><?php echo $item['kecamatan'] ?></option>
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

<script>
    // var kjkjj = hai;
    $(document).ready(function() {
        // Disable Kecamatan dropdown initially

        $('#kecamatan').prop('disabled', true);

        // Save original Kecamatan options for later use
        var originalKecamatanOptions = $('#kecamatan option');

        $('#kecamatan').empty();
        $('#kecamatan').append('<option value="" selected>Pilih Kecamatan</option>');

        // Listen for changes in Kabupaten dropdown
        $('#Kota').change(function() {
            var selectedKotaId = $(this).val();

            // If Kabupaten is selected, enable Kecamatan dropdown
            if (selectedKotaId !== '') {
                $('#kecamatan').prop('disabled', false);

                // Clear existing options from Kecamatan dropdown
                $('#kecamatan').empty();
                $('#kecamatan').append('<option value="" selected>Pilih Kecamatan</option>');

                // Filter and add Kecamatan options based on selected Kabupaten ID
                originalKecamatanOptions.each(function() {
                    var optionKotaId = $(this).data('kota-id');
                    if (optionKotaId == selectedKotaId) {
                        $('#kecamatan').append($(this));
                    }
                });

                // Select the first option by default
                $('#kecamatan').prop('selectedIndex', 0);
            } else {
                // If no Kabupaten is selected, disable and reset Kecamatan dropdown
                $('#kecamatan').prop('disabled', true).val('');
            }
        });
    });
</script>