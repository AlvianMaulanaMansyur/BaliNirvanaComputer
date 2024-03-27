<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Kota</h1>
            </div>

            <button type="button" class="btn" style="margin-bottom:30px;background: #D21312;color: white;" data-bs-toggle="modal" data-bs-target="#tambahKotaModal">
                <i class="fa-solid fa-plus"></i> <span>Tambah Kota</span>
            </button>

            <?php $no = 1 ?>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kota as $kotas) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $kotas['kota'] ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKotaModal<?php echo $kotas['id_kota_kab'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>

                                <button class="btn btn-danger delete-kota" data-id="<?php echo $kotas['id_kota_kab']; ?>" data-name="<?php echo $kotas['kota']; ?>"><i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <!-- Modal tambah kota -->
            <div class="modal fade" id="tambahKotaModal" tabindex="-1" aria-labelledby="tambahKotaModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tambahKotaModalLabel">Tambah Kota</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-tambah-kota" class="needs-validation" novalidate action="<?php echo base_url('dashboard/addkota') ?>" method="post">

                                <div class="mb-3">
                                    <label for="kota" class="form-label">Nama Kota</label>
                                    <input type="text" name="kota" class="form-control" id="kota" required>
                                    <div class="invalid-feedback">
                                        Isi nama kota.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal edit kota -->
            <?php foreach ($kota as $kotas) : ?>
                <div class="modal fade" id="editKotaModal<?php echo $kotas['id_kota_kab'] ?>" tabindex="-1" aria-labelledby="editKotaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editKotaModalLabel">Edit Kota</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="form-edit-kota-<?php echo $kotas['id_kota_kab'] ?>" class="needs-validation" novalidate action="<?php echo base_url('dashboard/editkota') ?>" method="post">

                                    <input type="text" name="id_kota_kab" class="form-control" id="id_kota_kab" value="<?php echo $kotas['id_kota_kab'] ?>" hidden>

                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Nama Kota</label>
                                        <input type="text" name="kota" class="form-control" id="kota" value="<?php echo $kotas['kota'] ?>" required>
                                        <div class="invalid-feedback">
                                            Isi nama kota.
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>