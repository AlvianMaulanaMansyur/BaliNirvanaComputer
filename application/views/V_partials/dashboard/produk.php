<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Customer</h1>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah Produk
            </button>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Produk</th>
                        <th>Category</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi Produk</th>
                        <th>Foto Produk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php $no = 1 ?>
                    <?php foreach ($produk as $key) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td scope="row"> <?php echo $key['id_produk'] ?></td>
                            <td> <?php echo $key['nama_category'] ?></td>
                            <td><?php echo $key['nama_produk'] ?></td>
                            <td><?php echo $key['stok_produk'] ?></td>
                            <td> <?php echo $key['harga_produk'] ?></td>
                            <td> <?php echo $key['deskripsi_produk'] ?></td>
                            <td> <img src="<?php echo base_url($key['foto_produk']); ?>" alt="Gambar" style="width: 200px;height: auto;"></td>
                            <td>
                                <!-- <a href="<?php echo base_url('admin/hlmEdit/' . $key['id_produk']) ?>" class="btn btn-warning">Edit</a> -->
                                <!-- Tombol Edit Produk -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $key['id_produk']; ?>">Edit</button>

                                <a href="<?php echo base_url('dashboard/delete/' . $key['id_produk']) ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Modal Insert-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('dashboard/insertProduk') ?>" method="post" enctype="multipart/form-data" class="">
                    <div>
                        <input hidden readonly type="text" name="id_admin" class="form-control" id="Id_admin" value="1">
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" id="namaBarang">
                    </div>

                    <div class="mb-3">
                        <label for="Category" class="form-label">Category</label>
                        <select name="id_category" id="Category" class="form-select" required>
                            <option selected value="">Pilih Category Produk</option>
                            <?php foreach ($category as $key) { ?>
                                <option value="<?php echo $key['id_category'] ?>"><?php echo $key['nama_category'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="Stok_produk" class="form-label">Stok Produk</label>
                        <input type="number" name="stok_produk" class="form-control" id="Stok_produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="Harga" class="form-label">Harga Produk</label>
                        <input type="number" name="harga_produk" class="form-control" id="Harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi_produk" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="Foto_produk" class="form-label">Foto Produk</label>
                        <input type="file" name="foto_produk" class="form-control" id="Foto_produk" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($produk as $key) : ?>
    <!-- Modal untuk Edit -->
    <div class="modal fade" id="editModal<?php echo $key['id_produk']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk Edit -->
                    <form action="<?php echo base_url('dashboard/editProduk'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_produk" value="<?php echo $key['id_produk']; ?>">
                        <div class="mb-3">
                            <label for="Id_produk" class="form-label">ID Produk</label>
                            <input readonly type="text" name="id_produk" class="form-control" id="Id_produk" value="<?php echo $key['id_produk'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $key['nama_produk']; ?>" required>
                        </div>

                        <input hidden type="text" name="id_admin" class="form-control" id="Id_admin" value="<?php echo $key['id_admin'] ?>">

                        <div class="mb-3">
                            <label for="Category" class="form-label">Category</label>
                            <select name="id_category" id="Category" class="form-select">
                                <?php foreach ($category as $cat) { ?>
                                    <?php $selected = ($key['id_category'] == $cat['id_category']) ? "selected" : ""; ?>
                                    <option value="<?php echo $cat['id_category'] ?>" <?php echo $selected ?>><?php echo $cat['nama_category'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="Stok_produk" class="form-label">Stok Produk</label>
                            <input type="number" name="stok_produk" class="form-control" id="Stok_produk" value="<?php echo $key['stok_produk'] ?>">
                        </div>

                        <div class="mb-3">
                            <label for="Harga" class="form-label">Harga Produk</label>
                            <input type="number" name="harga_produk" class="form-control" id="Harga" value="<?php echo $key['harga_produk'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi_produk"><?php echo $key['deskripsi_produk'] ?></textarea>
                        </div>

                        <input type="hidden" name="gambar_lama" value="<?php echo $key['foto_produk']; ?>">

                        <img src="<?php echo base_url($key['foto_produk']); ?>" alt="Gambar Produk" style="width: 200px;">

                        <div class="mb-3">
                            <label for="Foto_produk" class="form-label">Foto Produk</label>
                            <input type="file" name="foto_produk" class="form-control" id="Foto_produk">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>