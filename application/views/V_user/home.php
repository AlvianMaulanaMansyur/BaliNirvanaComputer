<div class="col-12 h-50 mb-5 animate__animated animate__fadeInUp" style="border: rounded; margin-top: 
20px;">
  <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="<?php echo base_url('assets/foto/PROMO THIS MONTH.png') ?>" class="d-block w-100 rounded" alt="...">
      </div>
      <div class="carousel-item ">
        <img src="<?php echo base_url('assets/foto/bali.png') ?>" class="d-block w-100 rounded" alt="..." style="height: auto;">
      </div>
      <div class="carousel-item ">
        <img src="<?php echo base_url('assets/foto/bali (1).png') ?>" class="d-block w-100 rounded" alt="..." style="height: auto;">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>


<div class="box2 animate__animated animate__fadeInDown">
  <p class="bnc animate__animated animate__fadeInUp">Bali Nirvana <span>Computer</span></p>
  <p class="pelanggan animate_animated animate_fadeInRight">
    Bali Nirvana Computer telah dibuka sejak tahun 2014,<br>
    merupakan salah satu toko aksesoris elektronik dan serta menjual laptop, pc. <br>
    Selalu memberikan kualitas di setiap barang yang kami suguhkan. <br>
    Sangat bersaing karena Bali Nirvana Computer memiliki pelanggan setia yang selalu dipuaskan oleh <br>
    produk yang berkualitas. <br>
  </p>
  <br>
</div>


<div class="container py-4 animate__animated animate__fadeInUp">
  <div class="box1">
    <h1 class="rekomendasi text-center">Kategori Produk</h1>
  </div>
</div>
<div data-aos="fade-up">
  <div class="container">
    <div class="row row-cols-1 row-cols-md-5 g-2 py-5 ">

      <?php foreach ($category as $key) : ?>
        <div class="col_kategori">
          <a href="<?php echo base_url('category/') . strtolower($key['nama_category']) ?>">
            <div class="card d-flex justify-content-center align-items-center pt-4">
              <img src="<?php echo base_url($key['foto_category']); ?>" class="card-img-top " alt="" style="width:100px; height:100px; text-align:center;">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <h5 class="card-title text-center"><a href="<?php echo base_url('category/') . strtolower($key['nama_category']) ?>"><?php echo $key['nama_category'] ?></a></h5>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</div>

<div data-aos="fade-up">
  <div class="box2 mt-5">
    <p class="bnc ">Bali Nirvana <span>Computer</span></p>
    <p class="pelanggan  animate_animated animate_fadeInRight">Untuk pelanggan setia Bali Nirvana Computer <br>
      dapat menghubungi kami melalui media sosial kami atau contact person yang tertera pada informasi kami. <br>
      kami terus mengupayakan kepuasan pelanggan dalam berbelanja di Bali Nirvana Computer dengan mengutamakan <br>
      kualitas barang dan kenyamanan pelanggan. </p>
    <br>
  </div>
</div>

<div class="container py-5">
  <div data-aos="fade-up">
    <div class="box1">
      <h1 class="rekomendasi text-center">Produk Teratas kami</h1>
    </div>
  </div>

  <div id="produk" class="row row-cols-xs-2 row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 pb-5 mt-2 ">

    <?php
    $limit = 8; // Tentukan jumlah maksimal card yang ingin ditampilkan
    $ProdukLimited = array_slice($produk, 0, $limit);

    foreach ($ProdukLimited as $product) :
    ?>
      <div data-aos="fade-up">
        <div class="card" style="width: auto; height: auto; overflow: hidden; border: 1px solid #ccc; border-radius:10px;">
          <a href="<?php echo base_url('produk/') . $product['slug'] ?>">
            <?php if ($product['stok_produk'] <= 0) : ?>
              <img src="<?php echo base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar" style="opacity: 0.3; width: 100%;height: 100%;  object-fit: cover;">
            <?php else : ?>
              <img src="<?php echo base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar" style="width: 100%;height: 100%;  object-fit: cover;">
            <?php endif ?>

            <div class="rkp_body card-body">
          </a>
          <div class="d-flex">
            <h5 class="card-title me-2"><?php echo $product['nama_produk'] ?></h5>
            <?php if ($product['stok_produk'] <= 0) : ?>
              <small class="text-muted">Stok Habis</small>
            <?php endif ?>
          </div>
        </div>
        <div class="rkp_ket  mb-3">
          <h5 class="format" style="margin-left: 15px;"><?php echo '<span id="price_' . $product['id_produk'] . '" class="price">' . ($product['harga_produk']) . '</span>'; ?></h5>

          <div class="d-flex justify-content-end pe-1">
            <a href="<?php echo base_url('produk/') . $product['slug'] ?>" class="btn btn-primary" style="background: #d21312 ; border:none;"><i class="fa-solid fa-cart-shopping"></i></a>
          </div>
        </div>
      </div>
  </div>
<?php endforeach ?>
</div>

<div class="tombol">

  <button class="learn-more">
    <a class="<?php echo ($this->uri->segment(1) == 'shop') ? 'active' : ''; ?>" href="<?php echo site_url('shop'); ?>">
    <span class="circle" aria-hidden="true">
      <span class="icon arrow"></span>
    </span>
    <span class="button-text">Produk Lainnya</span>
    </a>
  </button>
</div>