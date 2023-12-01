<!-- Form Edit Customer -->
<form action="<?php echo base_url('admin/update_customer'); ?>" method="post">
    <input type="hidden" name="customer_id" value="<?php echo $customer->id_customer; ?>">

    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" name="username" value="<?php echo $customer->username; ?>" required>
    </div>

    <div class="form-group">
        <label for="nama_customer">Nama Customer:</label>
        <input type="text" class="form-control" name="nama_customer" value="<?php echo $customer->nama_customer; ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" value="<?php echo $customer->email; ?>" required>
    </div>

    <div class="form-group">
        <label for="telepon">Telepon:</label>
        <input type="text" class="form-control" name="telepon" value="<?php echo $customer->telepon; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
</form>
