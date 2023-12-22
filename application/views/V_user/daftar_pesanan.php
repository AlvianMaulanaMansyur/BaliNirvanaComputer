<div class="container">
    <?php $no = 1; ?>
    <?php foreach ($orders as $id => $order) { ?>
        <div class="row d-flex">
            <div class="col">
                <h1>Pesanan <?php echo $id; ?></h1>
                <table class="table table-secondary">
                    <thead>
                        <tr>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($order['details'] as $detail) { ?>
                            <tr>
                                <td><?php echo $detail['nama_produk'] ?></td>
                                <td class="format"><?php echo $detail['harga_produk'] ?></td>
                                <td><?php echo $detail['qty_produk'] ?></td>
                                <td class="format"><?php echo $detail['subtotal'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="d-flex flex-column" style="justify-content: center;align-items: end;">
                    <h4>Status : <?php
                                    if ($order['status_pesanan'] == 1) {
                                        echo 'Berhasil';
                                    ?>
                        <?php } else {
                                        echo 'Belum Berhasil';
                        ?>
                            <!-- <a href="<?php echo base_url('orderid/') . $id ?>" class="btn btn-success">Lanjutkan Transaksi</a> -->
                            <button class="btn btn-success" onclick="redirectToOrder(<?php echo $id ?>)">Lanjutkan Transaksi</button>

                        <?php } ?>
                    </h4>
                    <h4>Total : <span class="format"><?php echo $order['total'] ?></span></h4>
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