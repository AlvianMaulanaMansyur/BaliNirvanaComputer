<section class="">
    <div class="halaman_transaksi">
        <h2 class="hlmn">Halaman Pesanan</h2>
    </div>
        <div class="container col-sm-12 col-md-7 col-lg-5 border border-1 border-dark p-4" style="border-radius: 15px;">
    <div id="invoice" style="background-color: white;">

            <div class="d-flex border-bottom mb-2" style="justify-content: space-between; border-radius: 10px;">
                <h2 style="font-family: 'Poppins', sans-serif; font-weight: 400;">INVOICE</h2>
                <h2 class="brand" style="font-family: 'Poppins', sans-serif; font-weight: 500;">Bali Nirvana <span style="font-weight: 500;"> Computer</span></h2>
            </div>

            <div class="d-flex" style="justify-content: space-between;">
                <div>
                    <div>
                        <?php echo $order[0]['nama_customer'] ?>
                    </div>
                    <div class="pe-5">
                        <?php echo $order[0]['alamat_pengiriman'] ?>
                    </div>
                    <div class="pe-5">
                        <?php echo $order[0]['detail_alamat_pengiriman'] ?>
                    </div>
                </div>
                <div class="">
                    <?php
                    echo 'Tanggal <br>';
                    echo $order[0]['create_time']
                    ?></div>
            </div>

            <div class="row d-flex">

                <!-- Start Product Info -->
                <div class="col">
                    <h5 style="margin-bottom: 1.2rem; margin-top: 1rem; font-family: 'Poppins', sans-serif;">Detail</h5>
                    <?php $total = 0; ?>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col-6">Nama Produk</th>
                                <th scope="col-2">Qty</th>
                                <th scope="col-4">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                            <?php foreach ($order as $key) { ?>

                                <tr>
                                    <td class="col-5"><?php echo $key['nama_produk'] ?></td>
                                    <td><?php echo $key['qty_produk'] ?></td>
                                    <td>
                                        <div class="format"><?php echo $key['harga_produk'] * $key['qty_produk'] ?></div>
                                        <!-- <small class="text-muted text-nowrap"><span class="format"><?php echo $key['harga_produk'] ?></span>/item</small> -->
                                    </td>
                                </tr>

                                <?php $total += $key['harga_produk'] * $key['qty_produk'] ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="d-flex" style="justify-content: right;">
                        <h5>Total : <span class="format"><?php echo $total ?></span></h1>
                    </div>
                </div>
            </div>

        </div>

    </div>
    
    <div class="d-flex container mt-4 col-sm-12 col-md-7 col-lg-5" style="justify-content: right;">
        <button id="downloadAsImage" class="col-4 btn btn-primary">Download Invoice</button>
    </div>

    <div class="deskripsi_pembayaran" style="margin-top: 5px;">
        silahkan download invoice untuk melakukan pembayaran!
        <span></span>
        <h5 class="wa_pembayaran">Hubungi Wa Berikut Untuk Melakukan Pembayaran</h5>
        <a hreaf="https://wa.me/628?text= Hai" class="" style="right:0;bottom: 0;z-index: 1;margin:20px;"><i class="fa-brands fa-square-whatsapp " style="color: #17c200;font-size: 100px;"></i></a>
    </div>
</section>