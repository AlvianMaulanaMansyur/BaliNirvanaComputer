
<script src="<?= base_url('assets/js/index.js') ?>"></script>
<script src="<?= base_url('assets/js/navbar.js') ?>"></script>
<script src="<?php echo base_url('assets/js/formatRp.js')?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var searchForm = document.getElementById('search-form');

        if (searchForm) {
            searchForm.addEventListener('submit', function (event) {
                // Menghentikan aksi formulir default (misalnya, pengiriman formulir)
                event.preventDefault();

                // Menentukan elemen target yang akan digulir
                var targetElement = document.getElementById('menu'); // Ganti dengan ID elemen target Anda

                // Melakukan scroll ke elemen target
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth', // Untuk animasi scroll
                        block: 'start'      // Digulirkan ke bagian atas elemen target
                    });
                }
            });
        }
    });
</script>
 




