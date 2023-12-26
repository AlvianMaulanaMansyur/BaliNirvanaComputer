<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!--  -->



    <link rel="stylesheet" href="<?php echo base_url('assets/css/navbar.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/footer.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/contact.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/about.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/home.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/shop.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/transaksi.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pre.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/info.css') ?>">


    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins';
        }

        .container-fluid {
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        /* Style untuk checkbox */
        input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            border: 2px solid #555;
            border-radius: 4px;
            outline: none;
            cursor: pointer;
            position: relative;

        }

        /* Style untuk tanda centang pada checkbox yang tercentang */
        input[type="checkbox"]:checked {
            background-color: #2196F3;
            /* Warna latar belakang saat tercentang */
            border-color: #2196F3;
            /* Warna border saat tercentang */
        }

        /* Style untuk tanda centang pada checkbox */
        input[type="checkbox"]:checked:after {
            content: '\2714';
            /* Unicode untuk tanda centang */
            font-size: 14px;
            color: white;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>