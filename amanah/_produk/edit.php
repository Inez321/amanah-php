<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$kode_produk = $_GET['kode_produk'];
$query = mysqli_query($connection, "SELECT * FROM produk WHERE kode_produk='$kode_produk'");
$data = mysqli_fetch_array($query);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Edit Produk</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>
      <a href="../_produk/index.php">/ Daftar Produk </a>/ Edit Produk
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <form action="update.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="kode_produk" value="<?= $data['kode_produk'] ?>">
            
            <div class="form-group">
              <label for="kode_produk">Kode Produk</label>
              <input type="text" class="form-control" id="kode_produk" value="<?= $data['kode_produk'] ?>" disabled>
              <small class="text-muted">Kode produk tidak dapat diubah</small>
            </div>

            <div class="form-group">
              <label for="nama_produk">Nama Produk</label>
              <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= $data['nama_produk'] ?>" disabled>
              <small class="text-muted">Nama produk tidak dapat diubah</small>
            </div>

            <div class="form-group">
              <label for="deskripsi">Deskripsi/Isi Produk</label>
              <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?= $data['deskripsi'] ?>" required>
            </div>

            <div class="form-group">
              <label for="harga_produk">Harga Produk</label>
              <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="<?= $data['harga_produk'] ?>" required>
            </div>

            <div class="form-group">
              <label for="gambar_produk">Gambar Produk</label>
              <input type="file" class="form-control-file" id="gambar_produk" name="gambar_produk">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
              <?php if($data['gambar_produk']): ?>
                <div class="mt-2">
                  <img src="<?= $data['gambar_produk'] ?>" alt="Gambar Produk" style="max-width: 200px;">
                </div>
              <?php endif; ?>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>