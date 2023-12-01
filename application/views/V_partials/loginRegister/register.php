<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="asset/index2.html"><b>Bali</b>Nirvana</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new account!</p>

                <?php echo form_open('Customer/register'); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="username " name="username" id="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('username'); ?>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password_customer" id="password_customer">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password_customer'); ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Your Name" name="nama_customer" id="nama_customer">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nama_customer'); ?>
                <!-- <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Retype password" name="password2">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div> -->
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('email'); ?>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Phone Number" name="telepon" id="telepon">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('telepon'); ?>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php echo form_close(); ?>

                <a href="<?= base_url('Customer/login') ?>" class="text-center">I already have an account!</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->