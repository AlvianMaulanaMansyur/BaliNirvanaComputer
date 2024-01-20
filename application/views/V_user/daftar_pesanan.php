<div class="container">
    <div>
        <h2 class="pt-5 mb-4 ps-lg-5 ps-sm-0">Daftar Pesanan</h2>
    </div>
</div>

<div class="container d-flex flex-column align-items-center">

    <?php $no = 1; ?>
    <?php foreach ($orders as $id => $order) { ?>
        <div class="card mb-3 col-lg-10 col-md-11 col-sm-12">

            <div class="row d-flex px-3 pt-2">
                <div class="col">
                    <div class="ps-4 pt-2 d-flex flex-sm-row flex-column align-items-start">
                        <?php
                        $formattedMonthYear = date("d F Y", strtotime($order['create_time']));
                        ?>
                        <h5 class="me-2"><?php echo $formattedMonthYear ?></h5>
                        <h6 class="text-muted">No. Pesanan <?php echo $id; ?></h6>
                    </div>


                    <?php foreach ($order['details'] as $detail) { ?>


                        <div class="row d-flex pt-3">
                            <div class="d-flex col-lg-7 col-md-6 col-sm-6 ps-5 mb-3">
                                <div>
                                    <img src="<?php echo base_url($detail['url_foto']) ?>" class="border rounded me-3" style="width: 100px; height: 100px;" />
                                </div>

                                <div>
                                    <p class="mb-0"><?php echo $detail['nama_produk'] ?></p>
                                    <small class="mb-0 text-muted text-nowrap">Jumlah: <?php echo $detail['qty_produk'] ?></small><br>

                                    <?php if ($detail['deleted'] == 1) : ?>
                                        <small class="mb-0 text-danger text-nowrap">Produk sudah dihapus!</small>
                                    <?php elseif ($detail['stok_produk'] <= 0) : ?>
                                        <small class="mb-0 text-danger text-nowrap">Stok habis!</small>
                                    <?php endif ?>
                                </div>

                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-6">
                                <h6 class=""><span class="format"><?php echo $detail['harga_produk'] ?></span></h6>
                            </div>


                            <div class="mt-2 border border-1"></div>
                        </div>


                    <?php } ?>


                    <div class="d-flex flex-column mb-4 pt-3" style="justify-content: center;align-items: end;">
                        <h5 class="">Total : <span class="format"><?php echo $order['total'] ?></span></h5>

                        <h6>Status : <?php
                                        if ($order['status_pesanan'] == 1) {
                                            echo 'Selesai';
                                        ?>
                            <?php } elseif ($order['status_pesanan'] == 0) {
                                            echo 'Belum Selesai';
                            ?>
                                <button class="btn" onclick="redirectToOrder(<?php echo $id ?>)" style="background: #D21312;color:white;--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" style="">Lanjutkan Transaksi</button>

                            <?php } elseif ($order['status_pesanan'] == 2) { ?>
                                <?php echo 'Dibatalkan'; ?>
                            <?php } ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

