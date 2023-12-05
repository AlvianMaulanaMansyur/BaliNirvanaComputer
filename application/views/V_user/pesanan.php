<div class="container">
    <?php $no = 1; ?>
    <?php foreach ($orders as $invoice_number => $order) { ?>
        <div class="row d-flex">
            <div class="col">
                <h1>Pesanan <?php echo $invoice_number; ?></h1>
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
                                <td><?php echo $detail['harga_produk'] ?></td>
                                <td><?php echo $detail['qty_produk'] ?></td>
                                <td><?php echo $detail['subtotal'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="d-flex flex-column" style="justify-content: center;align-items: end;">
                    <h4>Status : <?php 
                    if($order['status_pesanan'] == 1) {
                        echo 'Berhasil';
                        ?>
                    <?php }else { 
                        echo 'Belum Berhasil';
                        ?>
                        <a href="<?php echo base_url('transaksi/').$invoice_number ?>" class="btn btn-success">Lanjutkan Transaksi</a>
                    <?php } ?>
                     </h4>
                    <h4>Total : <?php echo $order['total'] ?></h4>
                </div>
            </div>
        </div>
    <?php } ?>
</div>