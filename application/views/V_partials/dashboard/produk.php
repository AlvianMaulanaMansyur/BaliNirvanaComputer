<div class="container-fluid px-2 mt-2 ">
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800 ">Data Produk</h1>
            </div>

            <!-- <button type="button" class="btn" style="margin-bottom:30px;background: #D21312;color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fa-solid fa-plus"></i> <span>Tambah Produk</span>
                </button> -->
            <a href="<?php echo base_url('tambahproduk') ?>" type="button" class="btn" style="margin-bottom:30px;background: #D21312;color: white;"><i class="fa-solid fa-plus"></i> <span>Tambah Produk</span></a>

            <?php echo form_open('Dashboard/search_produk', 'class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3  my-2 my-md-0 "'); ?>
            <div class="input-group d-flex" style="float:right">
                <?php echo form_input('keyword', '', 'class="form-control" placeholder="Search for..." aria-label="Search for..."'); ?>
                <button class="btn" type="submit" style="background: white;color: #D21312;border-color:#D21312"><i class="fas fa-search"></i></button>
            </div>
            <?php echo form_close(); ?>

            <?php if (isset($produk) && !empty($produk)) : ?>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>ID Produk</th>
                                <th>Category</th>
                                <th class="col-2">Nama Produk</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th class="d-none d-md-table-cell d-lg-table-cell">Deskripsi Produk</th>
                                <th>Foto Produk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1 ?>
                            <?php foreach ($produk as $product) : ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $product['id_produk'] ?></td>
                                    <td><?php echo $product['nama_category'] ?></td>
                                    <td class="col-2"><?php echo $product['nama_produk'] ?></td>
                                    <td><?php echo $product['stok_produk'] ?></td>
                                    <td class="format"><?php echo $product['harga_produk'] ?></td>
                                    <td class="col-3 d-none d-md-table-cell">
                                        <div>
                                            <pre><?php
                                                    $desc = $product['deskripsi_produk'];
                                                    $trimmed_desc = substr($desc, 0, 100);
                                                    echo '<p>' . $trimmed_desc . '</p>';
                                                    ?></pre>
                                            <h6><a href="#deskripsiModal<?php echo $product['id_produk']; ?>" data-bs-toggle="modal" style="font-size: 13px; color:#D21312">
                                                    Lihat Selengkapnya
                                                </a></h6>
                                        </div>
                                        <div class="d-flex" style="justify-content: end;">
                                        </div>
                                    </td>

                                    <!-- Modal untuk menampilkan semua deskripsi -->
                                    <div class="modal fade" id="deskripsiModal<?php echo $product['id_produk']; ?>" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deskripsiModalLabel">Deskripsi Produk</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <pre>
                                            <p><?php echo $product['deskripsi_produk']; ?></p>
                                        </pre>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                        <a href="<?php echo base_url('editproduk/') . $product['id_produk'] ?>" type="button" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>

                                        <button class="btn btn-danger delete-product-item" data-id="<?php echo $product['id_produk']; ?>" data-name="<?php echo $product['nama_produk']; ?>"><i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else : ?>

                <?php if (isset($results) && !empty($results)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>ID Produk</th>
                                    <th>Category</th>
                                    <th class="col-2">Nama Produk</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th class="d-none d-md-table-cell d-lg-table-cell">Deskripsi Produk</th>
                                    <th>Foto Produk</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($results as $result) : ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $result->id_produk ?></td>
                                        <td><?php echo $result->nama_category ?></td>
                                        <td class="col-2"><?php echo $result->nama_produk ?></td>
                                        <td><?php echo $result->stok_produk ?></td>
                                        <td class="format"><?php echo $result->harga_produk ?></td>
                                        <td class="col-3 d-none d-md-table-cell">
                                            <div>
                                                <pre><?php
                                                        $desc = $result->deskripsi_produk;
                                                        $trimmed_desc = substr($desc, 0, 100);
                                                        echo '<p>' . $trimmed_desc . '</p>';
                                                        ?></pre>
                                                <h6><a href="#deskripsiModal<?php echo $result->id_produk; ?>" data-bs-toggle="modal" style="font-size: 13px; color:#D21312">
                                                        Lihat Selengkapnya
                                                    </a></h6>
                                            </div>
                                            <div class="d-flex" style="justify-content: end;">
                                            </div>
                                        </td>

                                        <!-- Modal untuk menampilkan semua deskripsi -->
                                        <div class="modal fade" id="deskripsiModal<?php echo $result->id_produk ?>" tabindex="-1" aria-labelledby="deskripsiModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deskripsiModalLabel">Deskripsi Produk</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <pre>
                                            <p><?php echo $result->deskripsi_produk; ?></p>
                                        </pre>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
                                            <a href="<?php echo base_url('editproduk/') . $result->id_produk ?>" type="button" class="btn btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>

                                            <!-- Display alert before deleting -->
                                            <button class="btn btn-danger delete-product-item" data-id="<?php echo $result->id_produk ?>" data-name="<?php echo $result->nama_produk; ?>"><i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <p>Tidak Ada data Barang yang tersedia</p>
                <?php endif ?>

            <?php endif; ?>

        </div>
    </div>
</div>

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
        <?php if ($this->session->flashdata('error')) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?php echo $this->session->flashdata('error'); ?>'
            });
        <?php } elseif ($this->session->flashdata('success')) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '<?php echo $this->session->flashdata('success'); ?>'
            });
        <?php } ?>
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