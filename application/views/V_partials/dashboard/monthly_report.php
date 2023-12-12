<!-- monthly_report.php -->

<div>
    <form method="get" action="<?php echo base_url('dashboard/MonthlyReport'); ?>">
        <label for="month">Bulan:</label>
        <select name="month" id="month" required>
            <?php
            for ($i = 1; $i <= 12; $i++) {
                $monthValue = sprintf("%02d", $i);
                $monthLabel = date("F", strtotime("2023-$monthValue-01"));
                $selected = ($monthValue == $this->input->get('month')) ? 'selected' : '';
                echo "<option value='$monthValue' $selected>$monthLabel</option>";
            }
            ?>
        </select>

        <label for="year">Tahun:</label>
        <select name="year" id="year" required>
            <?php
            $currentYear = date("Y");
            for ($i = $currentYear; $i >= ($currentYear - 5); $i--) {
                $selected = ($i == $this->input->get('year')) ? 'selected' : '';
                echo "<option value='$i' $selected>$i</option>";
            }
            ?>
        </select>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<div id="monthlyReportContent">
    <h2>Monthly Report <?php echo $selected_month ?></h2>
    <table class="table table-secondary">
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
                    <td class="format"><?php echo $sub ?></td>
                    <td><?php echo $dateWithoutTime; ?></td>
                </tr>
                <?php $total += $sub; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h5>Total Penjualan : <span class="format"><?php echo $total ?></span></h5>

</div>
<div>
    <a href="<?php echo base_url('dashboard/saveaspdf'); ?>" class="btn btn-primary">Save as PDF</a>
</div>