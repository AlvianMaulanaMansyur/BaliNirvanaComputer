
<script src="<?= base_url('assets/js/index.js') ?>"></script>
<script src="<?= base_url('assets/js/navbar.js') ?>"></script>
<script src="<?php echo base_url('assets/js/formatRp.js')?>"></script>
<script src="<?php echo base_url('assets/js/daftar_pesanan.js')?>"></script>
<script src="<?php echo base_url('assets/js/detailProduk.js')?>"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
<script src="<?php echo base_url('assets/js/about.js')?>"></script>

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
 




