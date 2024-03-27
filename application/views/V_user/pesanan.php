<section class="">
    <div class="py-3 container ps-lg-5 ps-sm-0 halaman_transaksi">
        <h2 class=""> Pesanan</h2>
    </div>
    <div class="container col-sm-12 col-md-7 col-lg-5 p border border-1 border-dark p-4 mb-2" style="border-radius: 15px;">
        <div id="invoice" style="background-color: white;padding: 10px;">

            <div class="d-flex mb-2" style="justify-content: space-between; border-radius: 10px;">
                <h2 style="font-family: 'Poppins', sans-serif; font-weight: 400;">INVOICE</h2>
                <h2 class="brand" style="font-family: 'Poppins', sans-serif; font-weight: 500;">Bali Nirvana <span style="font-weight: 500;"> Computer</span></h2>
            </div>

            <div class="d-flex pt-3" style="justify-content: space-between;">
                <div>
                    <div>
                        <h6><?php echo $order[0]['nama_customer'] ?></h6>
                    </div>
                    <div class="pe-5">
                        <?php echo $order[0]['alamat_pengiriman'] ?>
                    </div>
                    <div class="pe-5">
                        <?php echo $order[0]['detail_alamat_pengiriman'] ?>
                    </div>
                </div>
                <div class="" style="text-align: end;">
                    <?php
                    $formattedMonthYear = date("l, d M Y", strtotime($order[0]['create_time']));
                    ?>
                    <h6>Tanggal:</h6>
                    <p>
                        <?php
                        echo $formattedMonthYear
                        ?>
                    </p>

                    <div>
                        <h6>No.Pesanan:</h6>
                        <?php echo $order[0]['id_pesanan'] ?>
                    </div>
                </div>


            </div>

            <div class="row d-flex">

                <!-- Start Product Info -->
                <div class="col">
                    <h5 style="margin-bottom: 1.2rem; margin-top: 1rem; font-family: 'Poppins', sans-serif;">Detail</h5>
                    <?php $total = 0; ?>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th class="w-50">Nama Produk</th>
                                <th class="w-25">Qty</th>
                                <th class="w-25">Harga</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php foreach ($order as $key) { ?>
                                <tr>
                                    <td><?php echo $key['nama_produk'] ?></td>
                                    <td><?php echo $key['qty_produk'] ?></td>
                                    <td>
                                        <div class="format"><?php echo $key['harga_produk'] * $key['qty_produk'] ?></div>
                                    </td>
                                </tr>
                                <?php $total += $key['harga_produk'] * $key['qty_produk'] ?>
                            <?php } ?>
                        </tbody>
                    </table>

                    <div class="pt-3" style="text-align: end;">
                        <h5 class="m-0">Total harga: <span class="format"><?php echo $total_harga ?></span></h5>
                        <small class="text-danger" style="font-size: 70%;">*harga sudah termasuk PPN 11%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container col-sm-12 col-md-7 col-lg-5 border border-1 border-dark p-4" style="border-radius: 15px;">

        <h4 class="pb-1" style="font-family: 'Poppins', sans-serif; font-weight: 600;">Cara Membayar.</h4>

        <div>
            <p style="margin:0;"> 1. Download Invoice melalui button dibawah.</p>
            <p style="margin:0;"> 2. Klik "bayar sekarang".</p>
            <p style="margin:0;"> 3. Tunjukan invoice pada admin. </p>
            <p style="margin:0;"> 4. Lakukan pembayaran via Whatsapp. </p>
            <p style="margin:0;"> 4. Tunggu Konfirmasi dari admin.</p>
            <p style="margin:0;"> 5. Setelah mendapat konfirmasi maka proses pembayaran selesai.</p>
        </div>
    </div>
    <div class=" container mt-4 col-sm-12 col-md-7 col-lg-5 ">

        <button id="downloadAsImage" class="btn btn-danger p-3 ">
            <i class="fa-solid fa-download me-2 "></i>Download Invoice
        </button>

        <button class="btn btn-success  me-2 p-3">
            <i class="fa-solid fa-comments-dollar"></i>
            <a href="https://wa.me/6287762722287?text= Hai, Saya ingin melakukan checkout pada barang ini!" class="text-white" target="_blank">BAYAR SEKARANG!</a>
        </button>
    </div>
</section>