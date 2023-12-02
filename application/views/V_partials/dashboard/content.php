<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Customer</h1>
            </div>
            <table class="table table-striped">

                <thead>
                    <?php if (isset($customer) && !empty($customer)) : ?>
                        <tr>
                            <th scope="col">No</th>

                            <th scope="col">ID Pelanggan</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Customer</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telepon</th>
                            <th scope="col">Action</th>

                        </tr>
                </thead>
                <tbody>
                    <?php if (isset($customer) && !empty($customer)) ?>
                    <?php $no = 1 ?>
                    <?php foreach ($customer as $key) : ?>

                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $key['id_customer']; ?></td>
                            <td><?php echo $key['username']; ?></td>
                            <td><?php echo $key['nama_customer']; ?></td>
                            <td><?php echo $key['email']; ?></td>
                            <td><?php echo $key['telepon']; ?></td>
                            <td>
                                <a href="<?php echo base_url('dashboard/edit/' . $key['id_customer']); ?>">
                                    <button type="button" class="btn btn-warning"><i class="fa-regular fa-pen-to-square" style="color: #000000;"></i></button></a>

                                <a href="<?php echo base_url('dashboard/delete_customer/' . $key['id_customer']); ?>">
                                    <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button></a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7">
                            <?php if (isset($results) && !empty($results)) : ?>
                                <table class="table table-striped">
                                    <thead>
                                        <!-- Kolom-kolom tabel hasil pencarian -->

                                        <th scope="col">ID Pelanggan</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Telepon</th>
                                        <th scope="col">Action</th>
                                        <!-- ... -->
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($results as $result) : ?>
                                            <tr>
                                                <!-- Data hasil pencarian -->
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $result->id_customer; ?></td>
                                                <td><?php echo $result->username; ?></td>
                                                <td><?php echo $result->nama_customer; ?></td>
                                                <td><?php echo $result->email; ?></td>
                                                <td><?php echo $result->telepon; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('dashboard/edit/' . $result->id_customer); ?>">
                                                        <button type="button" class="btn btn-warning"><i class="fa-regular fa-pen-to-square" style="color: #000000;"></i></button>
                                                    </a>
                                                    <a href="<?php echo base_url('dashboard/delete_customer/' . $result->id_customer); ?>">
                                                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                                                    </a>
                                                </td>
                                                <!-- ... -->
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <p>Tidak ada data pelanggan yang tersedia.</p>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>