<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/backend/') ?>css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Tambahkan stylesheet SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">

    <!-- Tambahkan script SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <style>
    .disabled-link {
        pointer-events: none; /* Menonaktifkan interaksi mouse */
        opacity: 0.5; /* Menjadikan link menjadi semi-transparan */
    }
</style>

</head>

<body class="sb-nav-fixed">