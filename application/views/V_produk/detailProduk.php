<!-- detail barang -->
<section class="py-5">
    <div class="container">
        <div class="row gx-5">
            <aside class="col-lg-6">
                <div id="mainPhoto" class="border rounded-4 mb-3 d-flex justify-content-center">
                    <img src="<?php echo base_url($produk['url_foto']); ?>" alt="Foto Produk" style="width: 500px;height: auto;">
                </div>
                <div class="row">
                    <!-- Tampilkan semua foto dalam bentuk card -->
                    <?php foreach ($produk['fotos'] as $foto) : ?>
                        <div class="card mb-3 foto-card d-flex col-3 me-3 " style="align-items: center;" data-src="<?php echo base_url($foto['url_foto']); ?>">
                            <img src="<?php echo base_url($foto['url_foto']); ?>" class="card-img-top" alt="Foto Produk" style="width: auto;height: 140px;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </aside>
            <main class="col-lg-6">

                <form action="<?php echo base_url('user/insertcart/') . $produk['slug'] ?>" method="post" onsubmit="return validateAndSubmit()">
                    <div class="ps-lg-3">
                        <h2 class="title text-dark">
                            <?php echo $produk['nama_produk'] ?>
                        </h2>
                        <!-- Di dalam halaman PHP -->
                        <div id="produkSlug" data-slug="<?php echo $produk['slug']; ?>"></div>


                        <div class="mb-3">
                            <h5><span class="format"><?php echo $produk['harga_produk'] ?></span>
                                <span class="text-muted">/item</span>
                            </h5>
                        </div>

                        <div class="mb-3">
                            <h6 class=""><?php echo $produk['nama_category'] ?></h6>
                        </div>

                        <div class="mb-3">
                            Stok: <?php echo $produk['stok_produk'] ?>
                        </div>
                        <!-- Di dalam halaman PHP -->
                        <div id="stokProduk" data-stok="<?php echo $produk['stok_produk']; ?>"></div>


                        <div class="col-md-4 col-6 mb-3">
                            <div class="input-group mb-3" style="width: 170px;">
                                <button class="btn btn-white border border-secondary px-3" type="button" id="decrementButton" data-mdb-ripple-color="dark" onclick="decrementQty()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" id="Qty_produk" class="form-control text-center border border-secondary" name="qty_produk" value="1" aria-label="Example text with button addon" aria-describedby="button-addon1" maxlength="3" />
                                <button class="btn btn-white border border-secondary px-3" type="button" id="incrementButton" data-mdb-ripple-color="dark" onclick="incrementQty()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <div id="alertContainer" style="width: 310px;"></div>
                        </div>
                        <div>
                            <?php if ($produk['stok_produk'] <= 0) : ?>
                                <button type="button" class="btn btn-danger shadow-0" onclick="validateAndSubmit()" style="background-color: #D21312;" disabled>Tambahkan ke <i class="me-1 fa-solid fa-cart-shopping"></i></button>
                            <?php else : ?>
                                <button type="button" class="btn btn-danger shadow-0" onclick="validateAndSubmit()" style="background-color: #D21312;">Tambahkan ke <i class="me-1 fa-solid fa-cart-shopping"></i></button>
                            <?php endif ?>
                            <!-- <button type="submit" class="btn btn-danger shadow-0"><i class="me-1 fa-solid fa-cart-shopping"></i>Keranjang</button> -->
                        </div>

                        <h3 class="pt-3">Deskripsi</h3>
                        <p>
                        <pre>
<?php echo $produk['deskripsi_produk'] ?>
</pre>
                        </p>

                    </div>

                </form>
            </main>

        </div>

    </div>
    </div>
</section>
<!-- end detail 