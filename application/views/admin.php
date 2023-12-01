<div class="container">
    <h1>LIST BARANG</h1>
    <a href="<?php echo base_url('admin/hlmInsert') ?>">Tambah Barang</a>
    <a href="<?php echo base_url('admin/monthlyReport') ?>">Monthly Report</a>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th>No</th>
      <th>ID PRODUK</th>
      <th>ID CATEGORY</th>
      <th>ID ADMIN</th>
      <th>NAMA PRODUK</th>
      <th>STOK</th>
      <th>HARGA</th>
      <th>DESKRIPSI PRODUK</th>
      <th>FOTO PRODUK</th>
      <th>act</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <?php $no = 1 ?>
  <?php foreach ($produk as $key) : ?>
    <tr>
      <td><?php echo $no++ ?></td>
      <td scope="row"> <?php echo $key['id_produk'] ?></td>
      <td> <?php echo $key['nama_category'] ?></td>
      <td><?php echo $key['nama_produk'] ?></td>
      <td><?php echo $key['stok_produk'] ?></td>
      <td> <?php echo $key['harga_produk'] ?></td>
      <td> <?php echo $key['deskripsi_produk'] ?></td>
      <td> <img src="<?php echo base_url($key['foto_produk']) ; ?>" alt="Gambar" style="width: 200px;height: auto;"></td>
      <td>
        <a href="<?php echo base_url('admin/hlmEdit/'.$key['id_produk']) ?>" class="btn btn-warning">Edit</a>
        <a href="<?php echo base_url('admin/delete/'.$key['id_produk']) ?>"class="btn btn-danger">Delete</a>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
  </div>
</div>

