<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

<h2>Edit Customer</h2>

<?php echo form_open('admin/update_customer'); ?>

<input type="hidden" name="customer_id" value="<?php echo $customer->id_customer; ?>">

<label for="username">Username:</label>
<input type="text" name="username" value="<?php echo $customer->username; ?>" required>
<br>

<label for="nama_customer">Nama Customer:</label>
<input type="text" name="nama_customer" value="<?php echo $customer->nama_customer; ?>" required>
<br>

<label for="email">Email:</label>
<input type="email" name="email" value="<?php echo $customer->email; ?>" required>
<br>

<label for="telepon">Telepon:</label>
<input type="text" name="telepon" value="<?php echo $customer->telepon; ?>" required>
<br>

<input type="submit" value="Simpan">

<?php echo form_close(); ?>

</body>
</html>
