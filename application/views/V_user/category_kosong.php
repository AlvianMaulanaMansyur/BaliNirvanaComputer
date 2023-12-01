<h1>Kategori Produk</h1>
<div class="row mb-5 pt-5">
    <?php foreach ($category as $key) : ?>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url($key['foto_category']); ?>" alt="Gambar" loading="lazy" style="width: 200px;height: auto;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $key['nama_category'] ?></h5>
                    <a href="<?php echo base_url('user/detailCategory/'.$key['id_category']) ?>" class="btn btn-warning">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<h3>Belum Ada Produk</h3>
