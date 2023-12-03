<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="asset/index2.html"><b>Bali</b>Nirvana</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new account!</p>

                <?php echo form_open('Customer/register'); ?>
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="username " name="username" id="username" value="<?= set_value('username'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('username'); ?></small>

                <div class="input-group mb-1 mt-3 mt-3">
                    <input type="password" class="form-control" placeholder="Password" name="password_customer" id="password_customer" value="<?= set_value('password_customer'); ?>">
                    <div class="input-group-append password-toggle">
                        <div class="input-group-text">
                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('password_customer'); ?></small>

                <div class="input-group mb-1 mt-3">
                    <input type="text" class="form-control" placeholder="Your Name" name="nama_customer" id="nama_customer" value="<?= set_value('nama_customer'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('nama_customer'); ?></small>

                <!-- <div class="input-group mb-1 mt-3">
                    <input type="password" class="form-control" placeholder="Retype password" name="password2">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div> -->

                <div class="input-group mb-1 mt-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" value="<?= set_value('email'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('email'); ?></small>

                <div class="input-group mb-1 mt-3">
                    <input type="number" class="form-control" placeholder="Phone Number" name="telepon" id="telepon" value="<?= set_value('telepon'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                </div>
                <small class="text-danger"><?= form_error('telepon'); ?></small>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-12 mb-3 mt-2 ">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?php echo form_close(); ?>

                <center><a href="<?= base_url('authCustomer/login') ?>" class="text-center">I already have an account!</a></center>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->