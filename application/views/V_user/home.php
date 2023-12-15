<!-- <div class="container">
    <h1 class="">halo?</h1>
</div> -->
<div class="col-12 h-50 mb-5 animate__animated animate__fadeInUp" style="border: rounded; margin-top: 
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
        <a href="<?php echo base_url('category/') . $key['id_category'] ?>">
          <div class="card">
            <img src="<?php echo base_url($key['foto_category']); ?>" class="card-img-top" alt="">
            <div class="card-body">
              <h5 class="card-title"></h5>
              <h5 class="card-title text-center"><a href="<?php echo base_url('category/') . $key['id_category'] ?>"><?php echo $key['nama_category'] ?></a></h5>
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
      <h1 class="rekomendasi text-center">Rekomendasi Produk</h1>
    </div>
  </div>

  <div class=" row row-cols-2 row-cols-md-3 g-3 py-3">
    <?php $i = 1;
    $cards_per_page = 9;  ?>
    <?php foreach ($produk as $product) : ?>
      <?php $i++ ?>
      <?php if ($i < $cards_per_page) { ?>
        <div data-aos="fade-up">
          <div class="rkp card">
            <img src="<?php echo base_url($product['url_foto']); ?>" class="card-img-top" alt="Gambar">
            <div class="rkp_body card-body">

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
      <?php } else {
        if ($i % $cards_per_page === 0) {
          echo '</div>'; // Menutup div row-cols-2 row-cols-md-3 g-3 py-3
          echo '<div class="d-flex justify-content-between mt-3">';
          if ($i > $cards_per_page) {
            echo '<a href="?page=' . ($i / $cards_per_page) . '" class="btn btn-primary mx-1">&lt; Back</a>';
          }
          if ($i < $jumlah_card - $cards_per_page) {
            echo '<a href="?page=' . ($i / $cards_per_page + 2) . '" class="btn btn-primary ml-auto mx-1">Next &gt;</a>';
          }
          echo '</div>';
          echo '<div class="row row-cols-2 row-cols-md-3 g-3 py-3">';
        }
      }
      ?>
    <?php endforeach ?>

  </div>
</div>