<div class="container">
    <h1>Insert Barang</h1>
    <form action="<?php echo base_url('admin/editProduk') ?>" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="Id_produk" class="form-label">ID Produk</label>
            <input readonly type="text" name="id_produk" class="form-control" id="Id_produk" value="<?php echo $produk['id_produk'] ?>">
        </div>

        <input hidden type="text" name="id_admin" class="form-control" id="Id_admin" value="<?php echo $produk['id_admin'] ?>">

        <div class="mb-3">
            <label for="" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" id="namaBarang" value="<?php echo $produk['nama_produk'] ?>">
        </div>

        <div class="mb-3">
            <label for="Category" class="form-label">Category</label>
            <select name="id_category" id="Category" class="form-select">
                <?php foreach ($category as $category) { ?>
                    <?php $selected = ($produk['id_category'] == $category['id_category']) ? "selected" : ""; ?>
                    <option value="<?php echo $category['id_category'] ?>" <?php echo $selected ?>><?php echo $category['nama_category'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="Stok_produk" class="form-label">Stok Produk</label>
            <input type="number" name="stok_produk" class="form-control" id="Stok_produk" value="<?php echo $produk['stok_produk'] ?>">
        </div>

        <div class="mb-3">
            <label for="Harga" class="form-label">Harga Produk</label>
            <input type="number" name="harga_produk" class="form-control" id="Harga" value="<?php echo $produk['harga_produk'] ?>">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi_produk"><?php echo $produk['deskripsi_produk'] ?></textarea>
        </div>

        <!-- Tambahkan input tersembunyi untuk menyimpan nama file gambar lama -->
        <input type="hidden" name="gambar_lama" value="<?php echo $produk['foto_produk']; ?>">

        <!-- Tampilkan gambar lama -->
        <img src="<?php echo base_url($produk['foto_produk']); ?>" alt="Gambar Produk" style="width: 200px;">

        <!-- Input untuk memilih gambar baru -->
        <div class="mb-3">
            <label for="Foto_produk" class="form-label">Foto Produk</label>
            <input type="file" name="foto_produk" class="form-control" id="Foto_produk">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>