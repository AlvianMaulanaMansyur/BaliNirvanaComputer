<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashobard</title>
</head>

<body>
    <h2>Data Pelanggan</h2>
    <?php if (isset($customer) && !empty($customer)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Username</th>
                    <th>Nama Customer</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customer as $customer) : ?>
                    <tr>
                        <td><?php echo $customer['id_customer']; ?></td>
                        <td><?php echo $customer['username']; ?></td>
                        <td><?php echo $customer['nama_customer']; ?></td>
                        <td><?php echo $customer['email']; ?></td>
                        <td><?php echo $customer['telepon']; ?></td>
                        <td><a href="<?php echo base_url('admin/edit/' . $customer['id_customer']); ?>">Edit</a>
                            <a href="<?php echo base_url('dashboard/delete_customer/' . $customer['id_customer']); ?>">Hapus</a>
                        </td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    <?php else : ?>
        <p>Tidak ada data pelanggan yang tersedia.</p>
    <?php endif; ?>

    <a href="<?php echo base_url('admin/logout'); ?>">Log Out</a>
</body>

</html>