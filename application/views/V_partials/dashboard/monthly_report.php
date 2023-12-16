<!-- monthly_report.php -->
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
                            <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Menangani perubahan pada elemen select bulan dan tahun
        var isMonthSelected = $('#month').val() == '';
        var isYearSelected = $('#month').val() == '';
        if (isMonthSelected && isYearSelected) {
            $('#submitButton').prop('disabled', (isMonthSelected && isYearSelected));
        }

        $('#month, #year').on('change', function() {
            // Memeriksa apakah kedua pilihan sudah dipilih
            var isMonthSelected = $('#month').val() !== '';
            var isYearSelected = $('#year').val() !== '';

            // Mengaktifkan atau menonaktifkan tombol submit berdasarkan hasil pemeriksaan
            $('#submitButton').prop('disabled', !(isMonthSelected && isYearSelected));
        });
    });
</script>