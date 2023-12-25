<div class="container">
    <div>
        <h2 class="pt-5">Daftar Pesanan</h2>
    </div>
    <?php $no = 1; ?>
    <div class="pt-5 pb-2">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th class="col-4">Nama produk</th>
                    <th class="col-4">Harga</th>
                    <th class="col-2">Qty</th>
                    <th class="col-4">Subtotal</th>
                </tr>
            </thead>
        </table>
    </div>
    <?php foreach ($orders as $id => $order) { ?>
        <div class="card mb-3">
            <div class="row d-flex px-3 pt-2">
                <div class="col">

                    <h5>Pesanan <?php echo $id; ?></h5>
                    <table class="table">

                        <tbody class="">
                            <?php foreach ($order['details'] as $detail) { ?>
                                <tr>

                                    <td class="col-4"><?php echo $detail['nama_produk'] ?></td>
                                    <td class="col-4 format"><?php echo $detail['harga_produk'] ?></td>
                                    <td class="col-2"><?php echo $detail['qty_produk'] ?></td>
                                    <td class="col-4 format"><?php echo $detail['subtotal'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="d-flex flex-column mb-4" style="justify-content: center;align-items: end;">
                        <h5 class="pe-">Total : <span class="format"><?php echo $order['total'] ?></span></h5>

                        <h6>Status : <?php
                                        if ($order['status_pesanan'] == 1) {
                                            echo 'Selesai';
                                        ?>
                            <?php } else {
                                            echo 'Belum Selesai';
                            ?>
                                <button class="btn" onclick="redirectToOrder(<?php echo $id ?>)" style="background: #D21312;color:white;--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;" style="">Lanjutkan Transaksi</button>

                            <?php } ?>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    function redirectToOrder(orderId) {
        var baseUrl = '<?php echo base_url('orderid/'); ?>';
        var url = baseUrl + orderId;
        window.location.href = url;
    }
</script>