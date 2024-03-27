<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $selected_month ?></title>
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

    .date {
        width: 90px;
    }

    .bali-nirvana {
        color: #D21312;
        font-weight: 500;
    }

    .computer {
        color: black;
        font-weight: 500;
    }

    .header-container {
        margin-bottom: 0px;
    }

    .brand {
        display: inline-block;
    }

    .bulan-laporan-bulanan {
        display: inline-block;
        margin-right: 220px;
        padding-left: 20px;
    }
</style>

<body>
    <div class="header-container" style="border-bottom: 1px;">
        <h2 class="bulan-laporan-bulanan">Laporan Bulanan</h2>
        <h2 class="brand"><span class="bali-nirvana">Bali Nirvana</span> <span class="computer">Computer</span></h2>
        <h3>
            <?php echo $selected_month ?>
        </h3>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama Customer</th>
                <th>No Pesanan</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th class="date">Tanggal</th>
                <th>Subtotal</th>
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
                    <td class="date"><?php echo $dateWithoutTime; ?></td>
                    <td class="format"><?php echo $this->pdf->formatCurrency($sub) ?></td>
                </tr>
                <?php $total += $sub; ?>


            <?php endforeach; ?>
            <tr>
                <td colspan="5" align="right"><strong class="h6">Total Penjualan:</strong></td>
                <td class="format"><strong><?php echo $this->pdf->formatCurrency($total); ?></strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>