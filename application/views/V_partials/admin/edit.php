<?php if (isset($confirm_update) && $confirm_update) : ?>
    <script>
        // Tampilkan konfirmasi jika konfirm_update diset
        confirmUpdate();
    </script>
<?php endif; ?>

<div class="container-fluid px-2 mt-2">
    <div class="card mb-4">
        <div class="card-body">
            <form action="<?php echo base_url('dashboard/update_customer'); ?>" method="post" onsubmit="return confirmUpdate()">
                <input type="hidden" name="confirm_update" value="1">
                <input type="hidden" name="id_customer" value="<?php echo $customer->id_customer; ?>">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $customer->username; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" name="password_customer" value="<?php echo $customer->password_customer; ?>" required|trim>
                </div>
                <div class="mb-3">
                    <label for="nama_customer" class="form-label">Nama Customer</label>
                    <input type="text" class="form-control" name="nama_customer" value="<?php echo $customer->nama_customer; ?>" required|trim>
                </div>
                <div class="mb-3">
                    <label for="Email" class="form-label">Email</label>
                    <input type="Text" class="form-control" name="email" value="<?php echo $customer->email; ?>" required|trim>
                </div>
                <div class="mb-3">
                    <label for="Telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" name="telepon" value="<?php echo $customer->telepon; ?>" required|trim>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
<script>
    // Fungsi untuk menampilkan konfirmasi
    function confirmUpdate() {
        return confirm("Simpan Perubahan?");
    }
</script>