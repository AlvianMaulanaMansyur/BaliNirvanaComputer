<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Kategori</h1>
            </div>
            <button type="button" class="btn" style="margin-bottom:30px;background: #D21312;color: white;" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                <i class="fa-solid fa-plus"></i> <span>Tambah Kategori</span>
            </button>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Id Kategori</th>
                            <th>Foto Kategori</th>
                            <th>Nama Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($category as $categories) : ?>
                            <tr>
                                <td><?php echo $categories['id_category'] ?></td>
                                <td>
                                    <img src="<?php echo base_url($categories['foto_category']) ?>" alt="" style="width: 100px;height: auto;">
                                </td>
                                <td><?php echo $categories['nama_category'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editKategoriModal<?php echo $categories['id_category']; ?>"><i class="fa-regular fa-pen-to-square"></i></button>

                                    <button class="btn btn-danger delete-category" data-id="<?php echo $categories['id_category']; ?>" data-name="<?php echo $categories['nama_category']; ?>"><i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Modal untuk Tambah Category -->
            <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="tambahKategoriModalLabel">Tambah Kategori</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo base_url('dashboard/addcategory') ?>" method="post" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <label for="nama_category" class="form-label">Nama Kategori</label>
                                    <input type="text" name="nama_category" class="form-control" id="nama_category" required>
                                </div>
                                <div class="mb-3">
                                    <label for="foto_category" class="form-label">Foto Kategori</label>
                                    <input type="file" name="foto_category" class="form-control" id="foto_category">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <?php foreach ($category as $categories) : ?>
                <!-- Modal untuk Tambah Category -->
                <div class="modal fade" id="editKategoriModal<?php echo $categories['id_category'] ?>" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="editKategoriModalLabel">Kategori</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo base_url('dashboard/editcategory') ?>" method="post" enctype="multipart/form-data">

                                    <div class="mb-3">
                                        <label for="nama_category" class="form-label">Nama Kategori</label>
                                        <input type="text" name="nama_category" class="form-control" id="nama_category" value="<?php echo $categories['nama_category'] ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <img src="<?php echo base_url($categories['foto_category']) ?>" alt="" style="width: 100px;height: auto;display: block;">
                                        <label for="foto_category" class="form-label">Foto Kategori</label>
                                        <input type="text" name="id_category" class="form-control" value="<?php echo $categories['id_category'] ?>" hidden>
                                        <input type="file" name="foto_category" class="form-control" id="foto_category">
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

<script>
    $(document).ready(function() {

        // Handle click on delete button
        $('.delete-category').on('click', function(e) {
            e.preventDefault();

            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');

            Swal.fire({
                title: "Hapus Produk?",
                text: "Anda yakin ingin menghapus kategori '" + categoryName + "'?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to delete endpoint
                    window.location.href = "<?php echo base_url('dashboard/deletecategory/') ?>" + categoryId;
                }
            });
        });
    });
</script>