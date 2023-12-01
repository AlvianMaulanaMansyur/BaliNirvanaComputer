<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title><?php echo $data['title'] ?></title>

    <style>
        .container {
            height: 100vh;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f8f8;
            padding: 10px;
        }
    </style>
</head>   

<body>

    <div class="container-fluid d-flex flex-column">
        <nav class="navbar top-0">
            <?php $this->load->view('V_partials/header'); ?>
        </nav>

        <div class="container">
            <?php $this->load->view($data['content']); ?>
        </div>

        <a hreaf="https://wa.me/?text= Hai" class="position-fixed" style="right:0;bottom: 0;z-index: 1;margin:20px;"><i class="fa-brands fa-square-whatsapp " style="color: #17c200;font-size: 100px;"></i></a>

        <div id="invoice">
            <!-- Informasi invoice di sini -->
            ajdfadf
        </div>
        <button id="downloadAsImage" class="col-2">Download sebagai Gambar</button>
        <div class="footer">
            <?php $this->load->view('V_partials/footer'); ?>
        </div>
    </div>

</body>

</html>