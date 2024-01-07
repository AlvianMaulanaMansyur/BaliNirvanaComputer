<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Kota & Kecamatan</h1>
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

                                <!-- Display alert before deleting -->
                                <button class="btn btn-danger delete-kota" data-id="<?php echo $kotas['id_kota_kab']; ?>" data-name="<?php echo $kotas['kota']; ?>"><i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <button type="button" class="btn mt-5" style="margin-bottom:30px;background: black;color: white;" data-bs-toggle="modal" data-bs-target="#tambahKecamatanModal">
                <i class="fa-solid fa-plus"></i><span>Tambah Kecamatan</span>
            </button>

            <?php $no = 1 ?>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Nama Kecamatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kotaKec as $kotaKeca) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $kotaKeca['kota'] ?></td>
                            <td><?php echo $kotaKeca['kecamatan'] ?></td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKecamatanModal<?php echo $kotaKeca['id_kecamatan'] ?>"><i class="fa-regular fa-pen-to-square"></i></button>

                                <!-- Display alert before deleting -->
                                <button class="btn btn-danger delete-kecamatan" data-id="<?php echo $kotaKeca['id_kecamatan']; ?>" data-name="<?php echo $kotaKeca['kecamatan']; ?>"><i class="fa-solid fa-trash"></i>
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
                            <form action="<?php echo base_url('dashboard/addkota') ?>" method="post">

                                <div class="mb-3">
                                    <label for="kota" class="form-label">Nama Kota</label>
                                    <input type="text" name="kota" class="form-control" id="kota" required>
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
                                <h1 class="modal-title fs-5" id="editKotaModalLabel">Tambah Kota</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('dashboard/editkota') ?>" method="post">

                                    <div class="mb-3">
                                        <input type="text" name="id_kota_kab" class="form-control" id="id_kota_kab" value="<?php echo $kotas['id_kota_kab'] ?>" hidden>
                                    </div>

                                    <div class="mb-3">
                                        <label for="kota" class="form-label">Nama Kota</label>
                                        <input type="text" name="kota" class="form-control" id="kota" value="<?php echo $kotas['kota'] ?>" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Modal tambah kecamatan -->
            <div class="modal fade" id="tambahKecamatanModal" tabindex="-1" aria-labelledby="tambahKecamatanModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tambahKecamatanModalLabel">Tambah Kecamatan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('dashboard/addkecamatan') ?>" method="post">
                                <div class="mb-3">
                                    <select name="id_kota_kab" id="" class="form-control">
                                        <option value="" selected>Pilih Kota</option>
                                        <?php foreach ($kota as $kotas) : ?>
                                            <option value="<?php echo $kotas['id_kota_kab'] ?>"><?php echo $kotas['kota'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Nama Kecamatan</label>
                                    <input type="text" name="kecamatan" class="form-control" id="kecamatan" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal edit kecamatan -->
            <?php foreach ($kotaKec as $kotaKeca) : ?>
                <div class="modal fade" id="editKecamatanModal<?php echo $kotaKeca['id_kecamatan'] ?>" tabindex="-1" aria-labelledby="editKecamatanModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editKecamatanModalLabel">Tambah Kecamatan</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('dashboard/editkecamatan') ?>" method="post">
                                <label for="kota" class="form-label">Nama Kota</label>
                                    <div class="mb-3">
                                        <select name="id_kota_kab" id="kota" class="form-control">
                                            <?php foreach ($kota as $kotas) : ?>
                                                <?php $selected = ($kotas['id_kota_kab'] == $kotaKeca['id_kota_kab']) ? "selected" : ""; ?>
                                                <option value="<?php echo $kotas['id_kota_kab'] ?>" <?php echo $selected ?>><?php echo $kotas['kota'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>

                                <input type="text" name="id_kecamatan" value="<?php echo $kotaKeca['id_kecamatan'] ?>" hidden>
                                    
                                    <div class="mb-3">
                                        <label for="kecamatan" class="form-label">Nama Kecamatan</label>
                                        <input type="text" name="kecamatan" class="form-control" id="kecamatan" value="<?php echo $kotaKeca['kecamatan'] ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Handle click on delete button
        $('.delete-kota').on('click', function(e) {
            e.preventDefault();

            var kotaId = $(this).data('id');
            var kotaName = $(this).data('name');

            Swal.fire({
                title: "Hapus Kota?",
                text: "Anda yakin ingin menghapus kota '" + kotaName + "'?, maka akan menghapus semua kecamatan yang berkaitan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete endpoint
                    window.location.href = "<?php echo base_url('dashboard/deletekota/') ?>" + kotaId;
                }
            });
        });

        $('.delete-kecamatan').on('click', function(e) {
            e.preventDefault();

            var kecamatanId = $(this).data('id');
            var kecamatanName = $(this).data('name');

            Swal.fire({
                title: "Hapus Kecamatan?",
                text: "Anda yakin ingin menghapus kecamatan '" + kecamatanName + "'?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete endpoint
                    window.location.href = "<?php echo base_url('dashboard/deletekecamatan/') ?>" + kecamatanId;
                }
            });
        });
    });
</script>