<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="pt-3 container d-flex flex-column">
            <h1 class="h3 mb-0 text-gray-800 ">Data Pesanan</h1>
            <?php echo form_open('Dashboard/search_pesanan', 'class=""'); ?>
            <div class="input-group" style="width: 230px;">
                <?php echo form_input('keyword', '', 'class="form-control" placeholder="Search for..." aria-label="Search for..."'); ?>
                <!-- <button class="btn btn-danger"  type="submit"><i class="fas fa-search"></i></button> -->
                <button class="btn" type="submit" style="background: white;color: #D21312;border-color:#D21312"><i class="fas fa-search"></i></button>

            </div>
            <?php echo form_close(); ?>
        </div>
        <div class="card-body container d-flex flex-column align-items-center ">
            <?php if (empty($orders)) : ?>
                <p class="pt-3">
                    pesanan tidak ditemukan!
                </p>
            <?php else : ?>
                <?php $no = 1; ?>
                <?php foreach ($orders as $id => $order) { ?>
                    <div class="card mb-5 col-lg-10 col-md-11 col-sm-12">
                        <div class="row d-flex px-3 pt-2">
                            <div class="col">

                                <div class="ps-4 pt-2 d-flex flex-sm-row flex-column align-items-start">
                                    <?php
                                    $formattedMonthYear = date("d F Y", strtotime($order['create_time']));
                                    ?>
                                    <h5 class="me-2"><?php echo $formattedMonthYear ?></h5>
                                    <div class="" style="align-items: end;justify-content: end;">
                                        <div>
                                            <h6 class="text-muted">No. Pesanan <?php echo $id; ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <h6>Nama : <?php echo $order['details'][0]['nama_customer']; ?>,
                                    <span>Telepon : <?php echo $order['details'][0]['telepon']; ?></span>

                                </h6>
                                <span>Alamat : <?php echo $order['details'][0]['alamat_pengiriman']; ?></span> <br>
                                <span>Detail Alamat : <?php echo $order['details'][0]['detail_alamat_pengiriman']; ?></span>
                                <div class="mt-2 border border-1"></div>


                                <?php foreach ($order['details'] as $detail) { ?>


                                    <div class="row d-flex pt-3">
                                        <div class="ps-lg-5 ps-sm-0 d-flex col-lg-7 col-md-9 col-sm-12">
                                            <div>
                                                <img src="<?php echo base_url($detail['url_foto']) ?>" class="border rounded me-3" style="width: 100px; height: 100px;" />
                                            </div>

                                            <div>
                                                <h6 class="mb-0"><?php echo $detail['nama_produk'] ?></h6>
                                                <span class="mb-0 text-muted text-nowrap">Jumlah: <?php echo $detail['qty_produk'] ?></span>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 col-md-3 col-sm-12 pt-lg-0 pt-sm-3 ps-sm-3 ps-lg-0">
                                            <h6 class="mb-0"><span class="format"><?php echo $detail['harga_produk'] ?></span></h6>
                                        </div>
                                        <div class="mt-2 border border-1"></div>
                                    </div>

                                <?php } ?>

                                <div class="d-flex flex-column me-3 mb-2" style="align-items: end;">
                                    <h5 class="pt-3">Total harga: <span class="format"><?php echo $order['total'] ?></span></h5>
                                    <div class="d-flex">
                                        <?php if ($order['status'] == 0) : ?>
                                            <a href="javascript:void(0);" class="btn btn-danger btn-sm me-2" onclick="confirmCancelOrder(<?php echo $order['id_pesanan']; ?>)">
                                                <h6>Batalkan Pesanan</h6>
                                            </a>
                                        <?php else : ?>
                                        <?php endif ?>
                                        <a href="javascript:void(0);" class="btn btn-sm <?php
                                                                                        if ($order['status'] == 0) {
                                                                                            echo 'btn-warning';
                                                                                        } elseif ($order['status'] == 1) {
                                                                                            echo 'btn-success disabled-link';
                                                                                        } elseif ($order['status'] == 2) {
                                                                                            echo 'btn-danger disabled-link';
                                                                                        }
                                                                                        ?>" style="display: flex; justify-content: center; align-items: center;" onclick="confirmUpdateOrder(<?php echo $order['id_pesanan']; ?>, <?php echo $order['status']; ?>)">
                                            <h6>
                                                <?php
                                                $status = $order['status'];
                                                if ($status == 0) {
                                                    echo 'Belum Lunas';
                                                } elseif ($status == 1) {
                                                    echo 'Sudah Lunas';
                                                } elseif ($status == 2) {
                                                    echo 'Pesanan Dibatalkan';
                                                } else {
                                                    // Jika ada nilai status lain yang belum ditangani
                                                }
                                                ?>
                                            </h6>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            <?php endif ?>
        </div>
    </div>
</div>

<script>
    function confirmCancelOrder(idPesanan) {
        if (confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')) {
            // Lakukan permintaan AJAX untuk memperbarui status pesanan
            $.ajax({
                url: '<?php echo base_url('Dashboard/cancelOrder'); ?>',
                type: 'POST',
                data: {
                    idPesanan: idPesanan
                },
                dataType: 'JSON',
                success: function(response) {
                    if (response.sukses) {
                        // Opsional, perbarui antarmuka pengguna untuk menunjukkan pembatalan pesanan
                        alert('Pesanan berhasil dibatalkan.');
                        // Muat ulang atau perbarui daftar pesanan
                        location.reload();
                    } else {
                        alert('Gagal membatalkan pesanan. Silakan coba lagi.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi nanti.');
                }
            });
        }
    }
</script>