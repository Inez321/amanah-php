<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

// Generate product code
$query = mysqli_query($connection, "SELECT kode_produk FROM produk ORDER BY kode_produk DESC LIMIT 1");
$last_code = mysqli_fetch_assoc($query);
if ($last_code) {
    $last_num = (int) substr($last_code['kode_produk'], 4);
    $new_num = $last_num + 1;
    $kode_produk = 'PRD-' . str_pad($new_num, 3, '0', STR_PAD_LEFT);
} else {
    $kode_produk = 'PRD-001';
}
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Produk</h1>
    <div class="section-header-breadcrumb">
      <p>
        <a href="../_layout/index.php">Home </a>
        <a href="index.php">/ Daftar Produk </a>/ Tambah Produk
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?= $_SESSION['error'] ?>
              <?php unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>
          
          <form action="store.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="kode_produk">Kode Produk</label>
              <input type="text" class="form-control" id="kode_produk" name="kode_produk" 
                     value="<?= $kode_produk ?>" readonly required>
            </div>

            <div class="form-group">
              <label for="nama_produk">Nama Produk</label>
              <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
            </div>

            <div class="form-group">
              <label for="deskripsi">Deskripsi/Isi Produk</label>
              <input type="text" class="form-control" id="deskripsi" name="deskripsi" required>
              <small class="form-text text-muted">Contoh: "19 Liter" untuk galon, "12 Botol" untuk produk botol</small>
            </div>

            <div class="form-group">
              <label for="harga_produk">Harga</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp</span>
                </div>
                <input type="number" class="form-control" id="harga_produk" name="harga_produk" min="0" required>
              </div>
            </div>

            <div class="form-group">
              <label for="gambar_produk">Gambar Produk</label>
              <input type="file" class="form-control-file" id="gambar_produk" name="gambar_produk" accept="image/*" required>
              <small class="form-text text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB.</small>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
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