<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Bali</b>Nirvana</p>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body ">
                <p class="login-box-msg">Masukan Password Terbaru Anda!</p>
                <?php
                if ($this->session->flashdata('error_message')) {
                    echo '<p style="color:red;">' . $this->session->flashdata('error_message') . '</p>';
                }
                ?>

                <?php echo form_open('AuthCustomer/Change_Password');  ?>

                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="New Password" name="password_customer" id="password_customer">
                    <div class="input-group-append password-toggle">
                        <div class="input-group-text">
                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                    </div>
                </div>
                <?php echo form_error('password_customer', '<small class="text-danger p-3" >', '</small>'); ?>

               
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Repeat Password" name="password1" id="password_customer">
                    <div class="input-group-append password-toggle">
                        <div class="input-group-text">
                            <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>
                    </div>                  
                </div>
                <?php echo form_error('password1', '<small class="text-danger p-3" >', '</small>'); ?>

                <div class="row">

                </div>
                <!-- /.col -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                </div>
                <!-- /.col -->
            </div>
            <?php echo form_close(); ?>
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>