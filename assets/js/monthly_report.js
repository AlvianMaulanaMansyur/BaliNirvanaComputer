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

// $(document).ready(function() {
//     // Menangani perubahan pada elemen select bulan dan tahun
//     $('#month').on('change', function() {
//         // Memeriksa apakah kedua pilihan sudah dipilih
//         var isMonthSelected = $('#month').val() == '';

//         // Mengaktifkan atau menonaktifkan tombol submit berdasarkan hasil pemeriksaan
//         $('#submitButton').prop('disabled', (isMonthSelected));
//     });

//     $('#year').on('change', function() {
//         // Memeriksa apakah kedua pilihan sudah dipilih
//         var isYearSelected = $('#year').val() == '';

//         // Mengaktifkan atau menonaktifkan tombol submit berdasarkan hasil pemeriksaan
//         $('#submitButton').prop('disabled', (isYearSelected));
//     });
// });