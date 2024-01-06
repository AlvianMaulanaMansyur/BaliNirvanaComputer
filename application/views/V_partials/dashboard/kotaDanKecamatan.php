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
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kota as $kotas) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $kotas['kota'] ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>


            <button type="button" class="btn mt-5" style="margin-bottom:30px;background: #D21312;color: white;" data-bs-toggle="modal" data-bs-target="#tambahKecamatanModal">
                <i class="fa-solid fa-plus"></i> <span>Tambah Kecamatan</span>
            </button>
            <?php $no = 1 ?>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Kota</th>
                        <th>Nama Kecamatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($kotaKec as $kotaKeca) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $kotaKeca['kota'] ?></td>
                            <td><?php echo $kotaKeca['kecamatan'] ?></td>
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


        </div>
    </div>
</div>