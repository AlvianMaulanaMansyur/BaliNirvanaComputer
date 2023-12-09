<!-- monthly_report.php -->

<form method="post" action="<?php base_url('dashboard/monthlyreport') ?>" id="monthlyReportForm">
    <label for="month"></label>
    <input type="month" name="month" id="month" value="<?php echo $selected_month ?>" required>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<h2>Monthly Report <?php echo $selected_month ?></h2>


<table class="table table-secondary">
    <thead>
        <tr>
            <th>Customer Name</th>
            <th>No Pesanan</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Date</th>

        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($monthly_orders as $order) : ?>
            <tr>
                <?php
                // Mengambil tanggal dari database atau sumber lain
                $datetimeFromDatabase = $order['create_time'];

                $dateWithoutTime = date('Y-m-d', strtotime($datetimeFromDatabase));
                ?>
                <td><?php echo $order['nama_customer']; ?></td>
                <td><?php echo $order['id_pesanan']; ?></td>
                <td><?php echo $order['nama_produk']; ?></td>
                <td><?php echo $order['qty_produk']; ?></td>
                <?php $sub = $order['harga_produk'] * $order['qty_produk']; ?>
                <td class="format"><?php echo $sub ?></td>
                <td><?php echo $dateWithoutTime; ?></td>
            </tr>
            <?php $total += $sub; ?>
        <?php endforeach; ?>
    </tbody>
</table>
<h5>Total Penjualan : <span class="format"><?php echo $total ?></span></h5>

