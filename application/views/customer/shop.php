<?php
$results = isset($results) ? $results : null;
?>

<!-- Bagian Kategori -->
<div class="container py-4 animate__animated animate__fadeInUp">
    <div class="box_shop">
        <h3 class="kategori_shop text-center">Kategori Produk</h3>
    </div>

    <div data-aos="fade-up">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-5 g-2 py-5 ">
                <?php foreach ($category as $key) : ?>
                    <div class="col_kategori">
                        <a href="<?php echo base_url('category/') . $key['id_category'] ?>">
                            <div class="card">
                                <img src="<?php echo base_url($key['foto_category']); ?>" class="card-img-top" alt="">
                                <div class="card-body">
                                    <h5 class="card-title text-center"><a href="<?php echo base_url('category/') . $key['id_category'] ?>"><?php echo $key['nama_category'] ?></a></h5>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>

<?php if (empty($results) && is_iterable($results)) : ?>
    <?php $kosong = true; ?>
    <?php $produk = '' ?>
<?php endif ?>

<!-- Tampilan Hasil Pencarian atau Produk - Produk -->
<div class="container py-4 animate__animated animate__fadeInUp" id='menu'>
    <div class="box_shop">
        <h3 class="kategori_shop text-center">
            <?php if ($kosong) : ?>
                Tidak Ada Hasil Pencarian
            <?php elseif ($results) : ?>
                Hasil Pencarian
            <?php else : ?>
                Produk - Produk
            <?php endif; ?>
        </h3>
    </div>
</div>

<div class="container">
    <?php if (!empty($results) && is_iterable($results)) : ?>
        <!-- Tampilkan hasil pencarian jika ditemukan -->
        <div class="row row-cols-2 row-cols-md-3 g-3 py-3">
            <?php foreach ($results as $product) : ?>
                <div data-aos="fade-up">
                    <div class="rkp card">
                        <a href="<?php echo base_url('produk/') . $product['id_produk'] ?>">
                            <img src=" <?php echo base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar">
                            <div class="rkp_body card-body">
                        </a>
                        <h5 class="card-title"><?php echo $product['nama_produk'] ?></h5>
                    </div>
                    <div class="rkp_ket  mb-3">
                        <h5 class="format" style="margin-left: 15px;"><?php echo '<span id="price_' . $product['id_produk'] . '" class="price">' . ($product['harga_produk']) . '</span>'; ?></h5>

                        <div class="d-flex justify-content-end pe-1">
                            <a href="<?php echo base_url('produk/') . $product['id_produk'] ?>" class="btn btn-primary"> Check</a>
                        </div>
                    </div>
                </div>
        </div>
    <?php endforeach ?>
</div>

<?php elseif (!empty($produk) && is_iterable($produk)) : ?>
    <!-- Tampilkan produk jika hasil pencarian tidak ditemukan -->
    <div class="row row-cols-2 row-cols-md-3 g-3 py-3">
        <?php foreach ($produk as $product) : ?>
            <div data-aos="fade-up">
                <div class="rkp card">
                    <a href="<?php echo base_url('produk/') . $product['id_produk'] ?>">
                        <img src=" <?php echo base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar">
                        <div class="rkp_body card-body">
                    </a>
                    <h5 class="card-title"><?php echo $product['nama_produk'] ?></h5>
                </div>
                <div class="rkp_ket  mb-3">
                    <h5 class="format" style="margin-left: 15px;"><?php echo '<span id="price_' . $product['id_produk'] . '" class="price">' . ($product['harga_produk']) . '</span>'; ?></h5>

                    <div class="d-flex justify-content-end pe-1">
                        <a href="<?php echo base_url('produk/') . $product['id_produk'] ?>" class="btn btn-primary"> Check</a>
                    </div>
                </div>
            </div>
    </div>
<?php endforeach ?>
</div>
<?php else : ?>
    <!-- Konten Khusus jika produk kosong (misalnya, setelah pemfilteran kategori) -->
    <div class="container d-flex pb-4" style="justify-content: center;">
        <h1>Produk Kosong</h1>
    </div>
<?php endif; ?>
</div>