<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <link href="<?php echo base_url('assets/foto/balinirvanalogo.png') ?>" rel="icon">

   
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/backend/') ?>css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Tambahkan stylesheet SweetAlert -->

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Tambahkan script SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pre.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/input.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/checkout.css') ?>">
    
    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>

    <?php const PPN = 0.11; ?>

    <style>
        .disabled-link {
            pointer-events: none;
            /* Menonaktifkan interaksi mouse */
            opacity: 0.5;
            /* Menjadikan link menjadi semi-transparan */
        }
    </style>

</head>

<body class="sb-nav-fixed">