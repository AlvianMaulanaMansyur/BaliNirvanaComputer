<h1>Hlm Pesanan</h1>

<div class="container">
    <?php $no = 1; ?>
    <?php foreach ($orders as $invoice_number => $order) { ?>
        <div class="row d-flex">
            <div class="col">
                <h1>Pesanan <?php echo $no++; ?></h1>
                <h5>Nama : <?php echo $order['details'][0]['nama_customer']; ?></h5>
                <h5>Alamat : <?php echo $order['details'][0]['alamat_pengiriman']; ?></h5>
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
                <div class="d-flex flex-column" style="align-items: end;">
                    <h4 class="">Total : <?php echo $order['total'] ?></h4>
                    <a href="<?php echo base_url('admin/updateOrder/') . $order['id_pesanan'] ?>" class="btn <?php echo ($order['status'] == 0) ? 'btn-warning' : 'btn-success'; ?> col-2" style="display: flex; justify-content: center; align-items: center;">
                        <h5>
                            <?php
                            $status = $order['status'];
                            if ($status == 0) {
                                echo 'Belum Selesai';
                            } else {
                                echo 'Sudah';
                            }
                            ?>
                        </h5>
                    </a>

                </div>
            </div>
        </div>
    <?php } ?>
</div>