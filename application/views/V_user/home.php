<div class="col-12 h-50 mb-5" style="border: rounded; margin-top: 
20px;">
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?php echo base_url('assets/foto/gambarCarosel.jpeg') ?>" class="d-block w-100 rounded" alt="..." style="height: auto;">
    </div>
    <div class="carousel-item">
      <img src="<?php echo base_url('assets/foto/huawei1.jpg') ?>" class="d-block w-100 rounded" alt="...">
    </div>
  </div>

</div>
</div>
<h1>Kategori Produk</h1>
<div class="row">
    <?php foreach ($category as $key) : ?>
        <div class="col-lg-3 col-md-6 col-sm-6 mt-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url($key['foto_category']); ?>" alt="Gambar" loading="lazy" style="width: 200px;height: auto;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $key['nama_category'] ?></h5>
                    <a href="<?php echo base_url('category/').$key['id_category'] ?>" class="btn btn-warning">Detail</a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<h1>Produk Kami</h1>
<div class="row">
    <?php foreach ($produk as $key) : ?>
        <div class="col-lg-4 col-md-6 col-sm-6 mt-3">
            <div class="card" style="width: 18rem;">
                <img src="<?php echo base_url($key['foto_produk']); ?>" alt="Gambar" style="width: 200px;height: auto;">
                <div class="card-body">
                  <form action="">
                    <h5 class="card-title"><?php echo $key['nama_produk'] ?></h5>
                    <p class="card-text"><?php echo $key['harga_produk'] ?></p>
                    <input type="hidden" value="<?php echo $key['id_produk']?>">
                    <a href="<?php echo base_url('produk/').$key['id_produk'] ?>" class="btn btn-warning">Detail</a>
                  </form>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>