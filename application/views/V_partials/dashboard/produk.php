<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Produk</h1>
            </div>

            <button type="button" class="btn btn-primary " style="margin-bottom:30px ;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                <i class="fa-solid fa-plus"></i> Tambah Produk
            </button>

            <?php echo form_open('Dashboard/search_produk', 'class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3  my-2 my-md-0 "'); ?>
            <div class="input-group d-flex" style="float:right">
                <?php echo form_input('keyword', '', 'class="form-control" placeholder="Search for..." aria-label="Search for..."'); ?>
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </div>
            <?php echo form_close(); ?>

            <table class="table table-striped">
                <thead>
                    <?php if (isset($produk) && !empty($produk)) : ?>
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
                    <?php if (isset($produk) && !empty($produk)) ?>
                    <?php $no = 1 ?>
                    <?php foreach ($produk as $product) : ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td scope="row"> <?php echo $product['id_produk'] ?></td>
                            <td> <?php echo $product['nama_category'] ?></td>
                            <td><?php echo $product['nama_produk'] ?></td>
                            <td><?php echo $product['stok_produk'] ?></td>
                            <td class="format"> <?php echo $product['harga_produk'] ?></td>
                            <td> <?php echo $product['deskripsi_produk'] ?></td>
                            <!-- <td> <img src="<?php echo base_url($product['foto_produk']); ?>" alt="Gambar" style="width: 200px;height: auto;"></td> -->
                            <td>
                                <?php
                                // Fetch and display photos for the current product
                                $product_photos = $this->M_produk->getProductPhotos($product['id_produk']);
                                foreach ($product_photos as $photo) {
                                    echo '<img src="' . base_url($photo['url_foto']) . '" alt="Gambar" style="width: 100px;height: auto;">';
                                }
                                ?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $product['id_produk']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>

                                <!-- Display alert before deleting -->
                                <button class="btn btn-danger delete-product-item" data-id="<?php echo $product['id_produk']; ?>" data-name="<?php echo $product['nama_produk']; ?>"><i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="10">
                            <?php if (isset($results) && !empty($results)) : ?>
                                <table class="table table-striped">
                                    <thead>
                                        <th>No</th>
                                        <th>ID Produk</th>
                                        <th>Category</th>
                                        <th>Nama Produk</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Deskripsi Produk</th>
                                        <th>Foto Produk</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1 ?>
                                        <?php foreach ($results as $result) : ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $result->id_produk ?></td>
                                                <td><?php echo $result->nama_category ?></td>
                                                <td><?php echo $result->nama_produk ?></td>
                                                <td><?php echo $result->stok_produk ?></td>
                                                <td><?php echo $result->harga_produk ?></td>
                                                <td><?php echo $result->deskripsi_produk ?></td>
                                                <td>
                                                    <?php
                                                    // Fetch and display photos for the current product
                                                    $product_photos = $this->M_produk->getProductPhotos($result->id_produk);
                                                    foreach ($product_photos as $photo) {
                                                        echo '<img src="' . base_url($photo['url_foto']) . '" alt="Gambar" style="width: 100px;height: auto;">';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $result->id_produk; ?>">Edit</button>

                                                    <!-- Display alert before deleting -->
                                                    <button class="btn btn-danger delete-product-item" data-id="<?php echo $result->id_produk; ?>" data-name="<?php echo $result->nama_produk; ?>">
                                                        Delete
                                                    </button>
                                                </td>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Tidak Ada data Barang yang tersedia</p>
        <?php endif; ?>
        </td>
        </tr>
    <?php endif; ?>
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('dashboard/insertProduk') ?>" method="post" enctype="multipart/form-data">
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

                    <div class=" mb-3">
                        <label for="Stok_produk" class="form-label">Stok Produk</label>
                        <input type="number" name="stok_produk" class="form-control" id="Stok_produk" required>
                    </div>


                    <label for="Harga" class="form-label">Harga Produk</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga_produk" class="form-control" id="Harga" required>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi_produk" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Foto_produk1" class="form-label">Foto Produk 1</label>
                        <input type="file" name="foto_produk1" class="form-control" id="Foto_produk1">
                    </div>

                    <div class="mb-3">
                        <label for="Foto_produk2" class="form-label">Foto Produk 2</label>
                        <input type="file" name="foto_produk2" class="form-control" id="Foto_produk2">
                    </div>

                    <div class="mb-3">
                        <label for="Foto_produk3" class="form-label">Foto Produk 3</label>
                        <input type="file" name="foto_produk3" class="form-control" id="Foto_produk3">
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

<?php if (isset($produk) && !empty($produk)) : ?>
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

                            <label for="Harga" class="form-label">Harga Produk</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga_produk" class="form-control" id="Harga" value="<?php echo $key['harga_produk'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi_produk"><?php echo $key['deskripsi_produk'] ?></textarea>
                            </div>

                            <!-- Edit form in your view -->
                            <?php $existing_photos = $this->M_produk->getProductPhotos($key['id_produk']);
                            foreach ($existing_photos as $photo) {
                                echo '<img src="' . base_url($photo['url_foto']) . '" alt="Gambar" style="width: 100px;height: auto;">';
                                // Add a hidden input for each existing photo URL
                                echo '<input type="hidden" name="gambar_lama[]" value="' . $photo['url_foto'] . '">';
                            } ?>


                            <div class="mb-3">
                                <label for="Foto_produk1" class="form-label">Foto Produk 1</label>
                                <input type="file" name="foto_produk1" class="form-control" id="Foto_produk1">
                            </div>

                            <div class="mb-3">
                                <label for="Foto_produk2" class="form-label">Foto Produk 2</label>
                                <input type="file" name="foto_produk2" class="form-control" id="Foto_produk2">
                            </div>

                            <div class="mb-3">
                                <label for="Foto_produk3" class="form-label">Foto Produk 3</label>
                                <input type="file" name="foto_produk3" class="form-control" id="Foto_produk3">
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
<?php endif; ?>

<script>
    $(document).ready(function() {

        // Handle click on delete button
        $('.delete-product-item').on('click', function(e) {
            e.preventDefault();

            var productId = $(this).data('id');
            var productName = $(this).data('name');

            Swal.fire({
                title: "Hapus Produk?",
                text: "Anda yakin ingin menghapus produk '" + productName + "'?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete endpoint
                    window.location.href = "<?php echo base_url('dashboard/delete/') ?>" + productId;
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        <?php if ($this->session->flashdata('success_add')) : ?>
            Swal.fire({
                title: 'Sukses!',
                text: '<?php echo $this->session->flashdata('success_add'); ?>',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        <?php endif; ?>
    });
</script>

<script>
    <?php if ($this->session->flashdata('success_edit') && $this->session->flashdata('edited_product_id')) : ?>
        Swal.fire({
            title: 'Sukses!',
            text: '<?php echo $this->session->flashdata('success_edit'); ?>',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    <?php endif; ?>
</script>