<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('V_partials/header');?>

<body>

    <div class="container-fluid d-flex flex-column">
        <nav class="navbar top-0">
            <?php $this->load->view('V_partials/navbar'); ?>
        </nav>

        <div class="">
            <?php $this->load->view($content); ?>
        </div>

        <a hreaf="https://wa.me/6285858401102?text= Hai" class="position-fixed" style="right:0;bottom: 0;z-index: 1;margin:20px;"><i class="fa-brands fa-square-whatsapp " style="color: #17c200;font-size: 100px;"></i></a>

        <!-- <div id="invoice">
            ajdfadf
        </div>
        <button id="downloadAsImage" class="col-2">Download sebagai Gambar</button> -->

        <div class="footer">
            <?php $this->load->view('V_partials/footer'); ?>
        </div>
    </div>

</body>
<?php $this->load->view('V_partials/script');
 ?>

</html>