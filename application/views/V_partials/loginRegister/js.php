<!-- jQuery -->
<script src="<?= base_url('assets/loginRegister/') ?>asset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/loginRegister/') ?>asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/loginRegister/') ?>asset/dist/js/adminlte.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#togglePassword').click(function () {
            var passwordField = $('#password_customer');
            var passwordFieldType = passwordField.attr('type');
            
            if (passwordFieldType === 'password') {
                passwordField.attr('type', 'text');
                $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordField.attr('type', 'password');
                $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
</body>

</html>