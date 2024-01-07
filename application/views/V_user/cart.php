<!-- cart -->
<div class="row d-flex py-5" style="justify-content: center;">

    <div class="col-lg-6 col-md-10 col-sm-12 card border shadow-0 mb-3">
        <div class="m-4">
            <h4 class="card-title mb-4">Keranjang</h4>
            <?php foreach ($cart as $key) { ?>
                <?php
                // Add these lines inside your foreach loop
                $isStockEmpty = $key['stok_produk'] == 0;
                $isProductDeleted = $key['deleted'] == 1;
                $disableCheckbox = $isStockEmpty ? 'disabled' : '';
                $disableQuantityButtons = $isStockEmpty ? 'disabled' : '';

                if ($isStockEmpty || $key['qty_produk'] > $key['stok_produk']) {
                    $this->M_cart->updateIsCheck($key['id_cart'], 0);
                }
                ?>

                <div class="row gy-3 mb-4 pt-3">
                    <div class="col-lg-5">
                        <div class="me-lg-5">
                            <div class="d-flex">
                                <!-- <?php echo $key['deleted'] ?> -->
                                <div class="d-flex align-items-center">
                                    <input class="me-3 checkbox-produt" type="checkbox" data-id="<?php echo $key['id_cart']; ?>" data-initial-stock="<?php echo $key['stok_produk']; ?>" <?php echo ($key['is_check'] == 1 && $key['stok_produk'] > 0 && $key['deleted']==0) ? 'checked' : ''; ?> onchange="updateIsCheck(this)" <?php echo ($key['stok_produk'] == 0 || $key['qty_produk'] > $key['stok_produk'] || $key['deleted']==1) ? 'disabled' : ''; ?>>
                                </div>

                                <a href="<?php echo base_url('produk/') . $key['slug'] ?>" class="nav-link">
                                    <img src="<?php echo base_url($key['url_foto']) ?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                                    <div class="">
                                        <?php echo $key['nama_produk'] ?>
                                </a>

                                <?php if ($key['qty_produk'] > $key['stok_produk'] && !$isStockEmpty) : ?>
                                    <p class="stock-warning">Jumlah melebihi stok! Tidak bisa dicheckout. (stok <?php echo $key['stok_produk'] ?>)</p>
                                <?php endif; ?>

                                <?php if ($isStockEmpty) : ?>
                                    <p class="stock-warning">Maaf stok barang habis</p>
                                <?php endif; ?>

                                <?php if ($isProductDeleted) : ?>
                                    <p class="stock-warning" style="color: red;">Maaf produk telah dihapus!</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                    <div class="input-group input-group-sm d-flex me-5 col-lg-8 col-sm-3 col-md-5 w-75 pt-3" style="justify-content: center;">

                        <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart'] ?>" data-stock="<?php echo $key['stok_produk'] ?>" data-delete="<?php echo $key['deleted'] ?>" onclick="validateAndSetQuantity(this, 'decrease', event)" <?php echo ($key['qty_produk'] <= 1 || $key['deleted']==1) ? 'disabled' : ''; ?> style="height: 30px; width: 33%;" data-action='decrease'>
                            <i class="fa-solid fa-minus"></i>
                        </button>

                        <input type="text" id="qty_<?php echo $key['id_cart']; ?>" class="form-control text-center border border-secondary" name="qty_produk" value="<?php echo $key['qty_produk']; ?>" data-delete="<?php echo $key['deleted'] ?>" aria-label="Example text with button addon" aria-describedby="button-addon1" style="height: 30px; width: 33%; text-align: center;" oninput="validateAndSetQuantity(this, 'input', event)" maxlength="3" data-id="<?php echo $key['id_cart']; ?>" data-stock="<?php echo $key['stok_produk']; ?>" <?php echo ($key['deleted']==1) ? 'disabled' : ''; ?> />

                        <button class="quantity-control btn btn-white border border-secondary px-3" data-id="<?php echo $key['id_cart']; ?>" data-stock="<?php echo $key['stok_produk']; ?>" data-delete="<?php echo $key['deleted'] ?>" onclick="validateAndSetQuantity(this, 'increase', event)" <?php echo ($key['qty_produk'] >= $key['stok_produk'] || $key['deleted']==1) ? 'disabled' : ''; ?> style="height: 30px; width: 33%; text-align: center;" data-action='increase'>
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <small id="quantityMessage_<?php echo $key['id_cart']; ?>" class="text-danger"></small>
                    </div>

                    <div class="d-flex flex-column pt-3">
                        <h6><span id="subtotal_<?php echo $key['id_cart']; ?>" class="format"><?php $key['harga_produk'] * $key['qty_produk']; ?></span></h6>
                        <small class="text-muted text-nowrap"><span class="format"><?php echo $key['harga_produk'] ?></span>/per item</small>
                    </div>
                </div>

                <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2 pt-3">
                    <div class="float-md-end">
    
                        <a href="<?php echo base_url('user/deleteCart/') . $key['id_cart'] ?>" class="btn btn-light border text-danger icon-hover-danger delete-cart-item"> Hapus</a>
                    </div>
                </div>
        </div>


    <?php } ?>
    <div class="border-top pt-4 mx-4 mb-4">
        <p><i class="fas fa-truck text-muted fa-lg"></i> Pengiriman Akan Dilakukan 1-2 Hari Setelah Pembayaran</p>
        <p class="text-muted">
            Proses pengiriman akan dilakukan setelah pihak pembeli melakukan pembayaran dan mengonfirmasi pembayaran kepada penjual yang dilakukan melalui whatsapp.
        </p>
    </div>
    </div>
</div>

<div class="col-lg-3 col-md-10 col-sm-12 ">
    <div class="card shadow-0 border">
        <h4 class="p-3">Ringkasan Belanja</h4>

        <div class="d-flex pt- px-4" style="justify-content: sp;">
            <h6 class="pe-3">Total Harga</h6>
            <p class="mb-2 fw-bold" id="total_checked_price"></p>
        </div>

        <div class="row my-3 d-flex flex-column" style="align-items: center;">
            <div class="col-11">
                <a href="#" class="btn w-100 shadow-0 mb-2" onclick="return validateCheckout()" style="background: #D21312;color:white;"> Lanjutkan Transaksi </a>
            </div>
            <div class="col-11">
                <a href="<?php echo base_url('shop') ?>" class="btn btn-light w-100 border mt-2"> Kembali Berbelanja </a>
            </div>
        </div>
    </div>
</div>

</div>
<div id="cart-data" data-cart="<?php echo htmlspecialchars(json_encode($cart)); ?>"></div>

