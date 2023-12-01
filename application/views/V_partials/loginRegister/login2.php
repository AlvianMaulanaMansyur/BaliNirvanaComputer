<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Bali</b>Nirvana</p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Masuk Terlebih Dahulu</p>
                <?php
                if ($this->session->flashdata('error_message')) {
                    echo '<p style="color:red;">' . $this->session->flashdata('error_message') . '</p>';
                }
                ?>

                <?php echo form_open('AuthCustomer/process_login'); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password_customer">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php echo form_close(); ?>

                <p class="mb-1">
                    <a href="lupa_sandi.php">Lupa Sandi?</a>
                </p>
                <p class="mb-0">
                    <a href="<?= base_url('customer/register'); ?>" class="text-center">Belum Punya Akun? DAFTAR</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>