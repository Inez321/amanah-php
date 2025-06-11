<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

// Generate new galon code
$query = mysqli_query($connection, "SELECT MAX(kode_item) as last_code FROM inventori");
$data = mysqli_fetch_assoc($query);
$last_num = $data['last_code'] ? (int)substr($data['last_code'], 4) : 0;
$new_code = 'ITM-' . str_pad($last_num + 1, 7, '0', STR_PAD_LEFT);
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Galon Baru</h1>
    <div class="section-header-breadcrumb">
      <p>
        <a href="../_layout/index.php">Home</a> / 
        <a href="index.php">Daftar Galon</a> / 
        Tambah Galon
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
              <?= $_SESSION['error'] ?>
              <?php unset($_SESSION['error']); ?>
            </div>
          <?php endif; ?>
          
          <form action="store.php" method="post">
            <input type="hidden" name="kode_produk" value="PRD-001"> <!-- Default to galon product code -->
            
            <div class="form-group">
              <label for="kode_item">Kode Galon</label>
              <input type="text" class="form-control" id="kode_item" name="kode_item" 
                     value="<?= $new_code ?>" readonly>
            </div>

            <div class="form-group">
              <label for="tgl_masuk">Tanggal Masuk</label>
              <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" 
                     value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="form-group">
              <label for="status_produk">Status Awal</label>
              <select class="form-control" id="status_produk" name="status_produk" required>
                <option value="Ada isi">Ada isi</option>
                <option value="Kosong">Kosong</option>
              </select>
              <small class="text-muted">Pilih status awal galon</small>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Simpan
              </button>
              <a href="index.php" class="btn btn-secondary">
                <i class="fas fa-times"></i> Batal
              </a>
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