<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Bali</b>Nirvana</p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body ">
                <p class="login-box-msg">Silahkan Masukan Email Anda!</p>
                <?php
                if ($this->session->flashdata('error_message')) {
                    echo '<p style="color:red;">' . $this->session->flashdata('error_message') . '</p>';
                }
                ?>

                <?php echo form_open('AuthCustomer/forgotPassword');  ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukan Email anda" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                </div>
                <!-- /.col -->
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>