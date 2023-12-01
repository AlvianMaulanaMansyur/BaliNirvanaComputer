
<h1>Kategori Produk</h1>
<div class="row mb-5 pt-5">
    <?php foreach ($category as $key) : ?>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url($key['foto_category']); ?>" alt="Gambar" loading="lazy" style="width: 200px;height: auto;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $key['nama_category'] ?></h5>
                    <a href="<?php echo base_url('category/'.$key['id_category']) ?>" class="btn btn-warning">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<h1>Kategori Produk : <?php echo $produk[0]['nama_category'];?></h1>
<div class="row">
    <?php foreach ($produk as $key) : ?>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url($key['foto_produk']); ?>" alt="Gambar" loading="lazy" style="width: 200px;height: auto;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $key['nama_produk'] ?></h5>
                    <p class="card-text"><?php echo $key['harga_produk'] ?></p>
                    <a href="<?php echo base_url('produk/'.$key['id_produk']) ?>" class="btn btn-warning">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>