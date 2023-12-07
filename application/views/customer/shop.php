<div class="container">
    <div class="container py-4 animate_animated animate_fadeInUp">
        <div class="box_shop">
            <h3 class="kategori_shop text-center">Kategori Produk</h3>
        </div>
    </div>

    <div data-aos="fade-up">
        <div class="container">
            <div class="row row-cols-1 row-cols-md-5 g-2 py-5 ">

                <?php foreach ($category as $key) : ?>
                    <div class="col_kategori">

                        <div class="card">
                            <img src="<?php echo base_url($key['foto_category']); ?>" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title"></h5>
                                <h5 class="card-title text-center"><a href="<?php echo base_url('category/') . $key['id_category'] ?>"><?php echo $key['nama_category'] ?></a></h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>
        </div>
    </div>
</div>

<div class="container py-4 animate_animated animate_fadeInUp">
    <div class="box_shop">
        <h3 class="kategori_shop text-center">Produk - Produk</h3>
    </div>
</div>

<div class="container">
    <?php if ($kosong == false) : ?>
        <div class="row row-cols-2 row-cols-md-3 g-3 py-3">
            <?php $i = 1;
            $cards_per_page = 9;  ?>
            <?php foreach ($produk as $product) : ?>
                <?php $i++ ?>
                <?php if ($i < $cards_per_page) { ?>
                    <div data-aos="fade-up">
                        <div class="rkp card">
                            <img src="<?php echo base_url($product['foto_produk']); ?>" class="card-img-top" alt="Gambar">
                            <div class="rkp_body card-body">

                                <h5 class="card-title"><?php echo $product['nama_produk'] ?></h5>
                            </div>
                            <div class="rkp_ket  mb-3">
                                <h5 class="" style="margin-left: 15px;">Rp. <?php echo $product['harga_produk'] ?></h5>
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
    <?php else : ?>
        <div class="container d-flex" style="justify-content: center;">
            <h1>Produk Kosong</h1>
        </div>
    <?php endif ?>
</div>