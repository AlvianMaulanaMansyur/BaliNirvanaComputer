<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<body>
    <h2>Monthly Report <?php echo $selected_month ?></h2>
    <table class="table">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>No Pesanan</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Subtotal</th>
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
                    $dateWithoutTime = date('d-m-Y', strtotime($datetimeFromDatabase));
                    ?>
                    <td><?php echo $order['nama_customer']; ?></td>
                    <td><?php echo $order['id_pesanan']; ?></td>
                    <td><?php echo $order['nama_produk']; ?></td>
                    <td><?php echo $order['qty_produk']; ?></td>
                    <?php $sub = $order['harga_produk'] * $order['qty_produk']; ?>
                    <td class="format"><?php echo $this->pdf->formatCurrency($sub) ?></td>

                    <td><?php echo $dateWithoutTime; ?></td>
                </tr>
                <?php $total += $sub; ?>


            <?php endforeach; ?>
        </tbody>
    </table>
    <h5>Total Penjualan : <span class="format"><?php echo $this->pdf->formatCurrency($total) ?></span></h5>
</body>

</html>