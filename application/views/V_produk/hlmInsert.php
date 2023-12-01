<div class="container">
<h1>Insert Barang</h1>
<form action="<?php echo base_url('admin/insertProduk') ?>" method="post" enctype="multipart/form-data" class="col-6">
    <div>
        <input hidden readonly type="text" name="id_admin" class="form-control" id="Id_admin" value="1">
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Nama Produk</label>
        <input type="text" name="nama_produk" class="form-control" id="namaBarang">
    </div>

    <div class="mb-3">
    <label for="Category" class="form-label">Category</label>
       <select name="id_category" id="Category" class="form-select" required>
        <option selected value="">Pilih Category Produk</option>
        <?php foreach ($category as $key) { ?>
        <option value="<?php echo $key['id_category'] ?>"><?php echo $key['nama_category'] ?></option>
       <?php } ?>
       </select>
    </div>

    <div class="mb-3">
        <label for="Stok_produk" class="form-label">Stok Produk</label>
        <input type="number" name="stok_produk" class="form-control" id="Stok_produk" required>
    </div>
   
    <div class="mb-3">
        <label for="Harga" class="form-label">Harga Produk</label>
        <input type="number" name="harga_produk" class="form-control" id="Harga" required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi Produk</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="deskripsi_produk" required></textarea>
    </div>
    <div class="mb-3">
        <label for="Foto_produk" class="form-label" >Foto Produk</label>
        <input type="file" name="foto_produk" class="form-control" id="Foto_produk" required>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
</div>