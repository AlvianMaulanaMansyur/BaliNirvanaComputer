<!-- monthly_report.php -->

    <form method="post" action="<?php echo base_url('dashboard/monthlyReport'); ?>">
        <label for="month">Month:</label>
        <select name="month" id="month">
            <!-- Options for months (1-12) -->
        </select>

        <label for="year">Year:</label>
        <input type="text" name="year" id="year" />

        <button type="submit">Submit</button>
    </form>


    <h2>Monthly Report</h2>


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
                    <?php $sub = $order['harga_produk']*$order['qty_produk']; ?>
                    <td class="format"><?php echo $sub ?></td>
                    <td><?php echo $dateWithoutTime; ?></td>
                </tr>
                <?php $total += $sub; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <h5>Total Penjualan : <span class="format"><?php echo $total ?></span></h5>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Populate month options
        for (let i = 1; i <= 12; i++) {
            $('#month').append('<option value="' + i + '">' + i + '</option>');
        }

        // Optional: Populate year options dynamically based on your requirements
    });

    function generatePDF() {
        var month = $('#month').val();
        var year = $('#year').val();

        // Use AJAX to send data to server
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('C_laporan/generatePDF'); ?>',
            data: {
                month: month,
                year: year
            },
            success: function(response) {
                // Handle the response if needed
            }
        });
    }
</script>

