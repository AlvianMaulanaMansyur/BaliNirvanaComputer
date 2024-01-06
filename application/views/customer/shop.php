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
            <div class="row row-cols-1 row-cols-md-5 g-2 py-5">
                <?php foreach ($category as $key) : ?>
                    <div class="col_kategori">
                        <a href="<?= base_url('category/') . strtolower($key['nama_category']) ?>">
                            <div class="card d-flex justify-content-center align-items-center pt-4">
                                <img src="<?= base_url($key['foto_category']); ?>" class="card-img-top" alt="" style="width: 100px; height: 100px; aspect-ratio: 1 / 1; ">
                                <div class="card-body">
                                    <h5 class="card-title text-center">
                                        <a href="<?= base_url('category/') . strtolower($key['nama_category']) ?>">
                                            <?= $key['nama_category'] ?>
                                        </a>
                                    </h5>
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
    <?php $produk = ''; ?>
<?php endif ?>

<!-- Tampilan Hasil Pencarian atau Produk - Produk -->
<div class="container pb-4 animate__animated animate__fadeInUp" id='menu'>
    <div class="box_shop">
        <h3 class="kategori_shop text-center">
            <?php if ($kosong) : ?>
                Tidak Ada Hasil Pencarian
            <?php elseif ($results) : ?>
                Hasil Pencarian
            <?php else : ?>
                Katalog Produk
            <?php endif; ?>
        </h3>
    </div>
</div>

<div class="container">
    <?php if (!empty($results) && is_iterable($results)) : ?>
        <!-- Tampilkan hasil pencarian jika ditemukan -->
        <div class="row row-cols-xs-2 row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 pb-5">
            <?php foreach ($results as $product) : ?>
                <div data-aos="fade-up">
                    <div class="card" style="width: auto; height: auto; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                        <a href="<?= base_url('produk/') . $product['slug'] ?>">
                            <img src="<?= base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1 / 1; ; opacity: <?= ($product['stok_produk'] <= 0) ? '0.3' : '1' ?>;">
                        </a>
                        <div class="rkp_body card-body">
                            <h5 class="card-title me-2"><?= $product['nama_produk'] ?></h5>
                            <?php if ($product['stok_produk'] <= 0) : ?>
                                <small class="text-muted">Stok Habis</small>
                            <?php endif ?>
                        </div>
                        <div class="rkp_ket mb-3">
                            <h5 class="format" style="margin-left: 15px;"><span id="price_<?= $product['id_produk'] ?>" class="price"><?= $product['harga_produk'] ?></span></h5>
                            <div class="d-flex justify-content-end pe-3">
                                <a href="<?= base_url('produk/') . $product['slug'] ?>" class="btn btn-primary" style="background: #d21312; border: none;"><i class="fa-solid fa-cart-shopping"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php elseif (!empty($produk) && is_iterable($produk)) : ?>
        <!-- Tampilkan produk jika hasil pencarian tidak ditemukan -->
        <div class="row row-cols-xs-2 row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 pb-5">
            <?php foreach ($produk as $product) : ?>
                <div data-aos="fade-up">
                    <div class="card" style="width: auto; height: auto; overflow: hidden; border: 1px solid #ccc; border-radius: 10px;">
                        <a href="<?= base_url('produk/') . $product['slug'] ?>">
                            <img src="<?= base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar" style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 1 / 1; ;opacity: <?= ($product['stok_produk'] <= 0) ? '0.3' : '1' ?>;">
                        </a>
                        <div class="rkp_body card-body">
                            <h5 class="card-title me-2"><?= $product['nama_produk'] ?></h5>
                            <?php if ($product['stok_produk'] <= 0) : ?>
                                <small class="text-muted">Stok Habis</small>
                            <?php endif ?>
                        </div>
                        <div class="rkp_ket mb-3">
                            <h5 class="format" style="margin-left: 15px;"><span id="price_<?= $product['id_produk'] ?>" class="price"><?= $product['harga_produk'] ?></span></h5>
                            <div class="d-flex justify-content-end pe-3">
                                <a href="<?= base_url('produk/') . $product['slug'] ?>" class="btn btn-primary" style="background: #d21312; border: none;"><i class="fa-solid fa-cart-shopping"></i></a>
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
