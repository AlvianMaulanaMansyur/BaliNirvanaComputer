<!-- monthly_report_table -->
<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Laporan Bulanan</h1>
            </div>
            <div>
                <form method="get" action="<?php echo base_url('dashboard/monthlyReport') ?>">
                    <div class="row">
                        <div class="col-4">
                            <select class="form-select" name="month" id="month" required>
                                <option value="" selected>Pilih Bulan</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                    $monthValue = sprintf("%02d", $i);
                                    $monthLabel = date("F", strtotime("2023-$monthValue-01"));
                                    $selected = ($monthValue == $this->input->get('month')) ? 'selected' : '';
                                    echo "<option value='$monthValue' $selected>$monthLabel</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-4">
                            <select class="form-control" name="year" id="year" required>
                                <option value="" selected>Pilih Tahun</option>
                                <?php
                                $currentYear = date("Y");
                                for ($i = $currentYear; $i >= ($currentYear - 5); $i--) {
                                    $selected = ($i == $this->input->get('year')) ? 'selected' : '';
                                    echo "<option value='$i' $selected>$i</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-4">
                            <button type="submit" id="submitButton" class="btn" style="background-color: #D21312;color:white">Submit</button>
                        </div>
                    </div>

                </form>
            </div>

            <div id="monthlyReportContainer" class="pt-4">

                <h2><?php echo $selected_month ?></h2>
                <div class="table-responsive">
                    <?php if (empty($monthly_orders)) : ?>
                        <p>Tidak ada pesanan yang selesai.</p>
                    <?php else : ?>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Nama Customer</th>
                                    <th>No Pesanan</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal</th>
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
                                        <?php $sub = ($order['harga_produk']*$order['qty_produk']) + ($order['harga_produk'] * $order['qty_produk'] * PPN); ?>
                                        <td><?php echo $dateWithoutTime; ?></td>
                                        <td class="format"><?php echo $sub ?></td>
                                    </tr>
                                    <?php $total += $sub; ?>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="5" align="right"><strong class="h6">Total Penjualan(termasuk PPN):</strong></td>
                                    <td class="format"><strong><?php echo $total; ?></strong></td>
                                </tr>
                            </tbody>

                        </table>

                    <?php endif; ?>
                </div>
            </div>

            <?php if (!empty($monthly_orders)) : ?>
                <div>
                    <a href="<?php echo base_url('dashboard/saveaspdf'); ?>" class="btn" style="background-color: white;color:#D21312;border-color:#D21312;">Save as PDF</a>
                </div>
            <?php else : ?>

            <?php endif; ?>
        </div>
    </div>
</div>