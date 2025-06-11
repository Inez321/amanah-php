<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

// Initialize variables
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_item = $_POST['kode_item'] ?? '';
    $tgl_kembali = $_POST['tgl_kembali'] ?? '';
    
    if (!$kode_item) {
        $error = "Item harus dipilih.";
    } elseif (!$tgl_kembali) {
        $error = "Tanggal kembali harus diisi.";
    } else {
        $query = "UPDATE inventori 
                  SET status_produk = 'Ada isi', tgl_keluar = NULL 
                  WHERE kode_item = '$kode_item'";
        
        if (mysqli_query($connection, $query)) {
            $_SESSION['info'] = [
                'status' => 'success',
                'message' => 'Galon berhasil dikembalikan ke gudang.'
            ];
            
            // Check if headers already sent
            if (!headers_sent()) {
                header('Location: index.php');
                exit();
            } else {
                echo '<script>window.location.href="index.php";</script>';
                exit();
            }
        } else {
            $error = "Gagal mengembalikan galon: " . mysqli_error($connection);
        }
    }
}

// Get empty galons (status = 'Kosong')
$empty_galons = mysqli_query($connection, 
    "SELECT i.*, p.nama_produk 
     FROM inventori i
     JOIN produk p ON i.kode_produk = p.kode_produk
     WHERE i.kode_produk = 'PRD-001' AND i.status_produk = 'Kosong'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Data Return Galon</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>
      <a href="index.php">/ Data Gudang </a>/ Return Galon
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php if ($error): ?>
            <div class="alert alert-danger">
              <?= $error ?>
            </div>
          <?php endif; ?>
          
          <form action="" method="post">
            <div class="form-group">
              <label for="kode_item">Pilih Galon Kosong</label>
              <select class="form-control" name="kode_item" id="kode_item" required>
                <option value="">-- Pilih Galon Kosong --</option>
                <?php while ($galon = mysqli_fetch_assoc($empty_galons)): ?>
                  <option value="<?= $galon['kode_item'] ?>">
                    <?= $galon['kode_item'] ?> - <?= $galon['nama_produk'] ?> (Masuk: <?= date('d-m-Y', strtotime($galon['tgl_masuk'])) ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="tgl_kembali">Tanggal Kembali</label>
              <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required 
                     value="<?= date('Y-m-d') ?>">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan Return</button>
              <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
          </form>

          <hr>
          
          <h5>Daftar Galon Kosong</h5>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kode Item</th>
                  <th>Produk</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                mysqli_data_seek($empty_galons, 0); // Reset pointer
                while ($galon = mysqli_fetch_assoc($empty_galons)): ?>
                  <tr>
                    <td><?= $galon['kode_item'] ?></td>
                    <td><?= $galon['nama_produk'] ?></td>
                    <td><?= date('d-m-Y', strtotime($galon['tgl_masuk'])) ?></td>
                    <td><?= $galon['tgl_keluar'] ? date('d-m-Y', strtotime($galon['tgl_keluar'])) : '-' ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>