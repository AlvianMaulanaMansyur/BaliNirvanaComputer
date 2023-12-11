<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
</body>
</html>
