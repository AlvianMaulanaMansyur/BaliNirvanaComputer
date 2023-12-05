<div class="d-flex row" style="justify-content: center;">
<h1 class="col-10 pt-4">Checkout</h1>
    <div class="pt-3 pb-2 px-3 col-lg-4 col-sm-10">
        
        <div class="card">
            <div class="card-header">
                <h3>Personal Info</h3>
            </div>

            <form action="<?php echo base_url('user/transaksi/') ?>" method="post" enctype="multipart/form-data" class="">

                <div class="row d-flex px-3 pt-2">

                    <!-- Input Personal Info -->
                    <div class="">

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
                            <input type="text" name="alamat" class="form-control" id="alamat" value="" placeholder="Alamat Pengiriman" required>
                            <input type="text" name="detail_alamat" class="form-control" id="" placeholder="Detail Alamat, contoh: Di dekat pura">
                        </div>


                        <div class="row mb-4">
                            <div class="mb-3 me-4 col-5">
                                <label for="Category" class="form-label">Kabupaten</label>
                                <select name="kota" id="Kota" class="form-select">
                                    <!-- <option selected value="">Pilih Kabupaten</option> -->
                                    <option selected value="">Pilih Kecamatan</option>

                                    <?php
                                    $uniqueCities = array();
                                    foreach ($kota as $city) {
                                        // Jika kota belum ditambahkan ke daftar unik, tambahkan
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
                                    <?php foreach ($kota as $item) { ?>
                                        <option value="<?php echo $item['id_kecamatan'] ?>" data-kota="<?php echo $item['kota'] ?>"><?php echo $item['kecamatan'] ?></option>
                                    <?php } ?>

                                </select>
                            </div>

                            <div class="mb-4 col-5">
                                <label for="alamat" class="form-label">Kodepos</label>
                                <input type="number" name="kodepos" pattern="[0-9]{5}" class="form-control" required>
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
            <div class="card-header">
                <h3>Product Info</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <?php $total = 0; ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col-4">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            <?php foreach ($cart as $key) { ?>

                                <tr>
                                    <td class="col-5"><?php echo $key['nama_produk'] ?></th>
                                    <td><?php echo $key['harga_produk'] ?></td>
                                    <td><?php echo $key['qty_produk'] ?></td>
                                    <td><?php echo $key['harga_produk'] * $key['qty_produk'] ?></td>
                                </tr>

                                <?php $total += $key['harga_produk'] * $key['qty_produk'] ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="d-flex" style="justify-content: end;">
                        <h4 style="font-weight: 800;">Total : <?php echo $total ?></h4>
                    </div>
                    <div class="d-flex" style="justify-content: end;">
                        <button type="submit" class="btn btn-warning col-lg-2 col-sm-4">Order</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- End Product Info -->
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- ... -->

<script>
    $(document).ready(function() {
        $('#kecamatan').append('<option selected value="">Pilih Kecamatan</option>');

        $('#Kota').change(function() {
            var selectedKotaId = $(this).val();
            // $('#kecamatan').append('<option selected value="">Pilih Kecamatan</option>');

            // Hapus semua opsi kecamatan yang ada
            $('#kecamatan').empty();

            // Tambahkan opsi default

            // Filter kecamatan berdasarkan kabupaten yang dipilih
            <?php foreach ($kota as $key) { ?>
                if ('<?php echo $key['id_kota_kab'] ?>' === selectedKotaId) {
                    var option = '<option value="<?php echo $key['id_kecamatan'] ?>" data-kota="<?php echo $key['kota'] ?>"><?php echo $key['kecamatan'] ?></option>';
                    $('#kecamatan').append(option);
                }
            <?php } ?>
        });
    });
</script>