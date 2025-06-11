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
        // Update status galon dari 'Kosong' (di pelanggan) ke 'Ada isi' (di gudang)
        $query = "UPDATE inventori 
                  SET status_produk = 'Ada isi', tgl_keluar = NULL 
                  WHERE kode_item = '$kode_item' AND status_produk = 'Kosong'";
        
        if (mysqli_query($connection, $query)) {
            $_SESSION['info'] = [
                'status' => 'success',
                'message' => 'Galon berhasil dikembalikan ke gudang.'
            ];
            
            header('Location: index.php');
            exit();
        } else {
            $error = "Gagal mengembalikan galon: " . mysqli_error($connection);
        }
    }
}

// Get empty galons at customer (status = 'Kosong')
$empty_galons = mysqli_query($connection, 
    "SELECT i.*, p.nama_produk 
     FROM inventori i
     JOIN produk p ON i.kode_produk = p.kode_produk
     WHERE i.kode_produk = 'PRD-001' AND i.status_produk = 'Kosong'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Galon Kembali</h1>
    <div class="section-header-breadcrumb">
      <p>
        <a href="../_layout/index.php">Home</a> / 
        <a href="index.php">Status Galon</a> / 
        Galon Kembali
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
              <label for="kode_item">Pilih Galon dari Pelanggan</label>
              <select class="form-control" name="kode_item" id="kode_item" required>
                <option value="">-- Pilih Galon Kosong --</option>
                <?php while ($galon = mysqli_fetch_assoc($empty_galons)): ?>
                  <option value="<?= $galon['kode_item'] ?>">
                    <?= $galon['kode_item'] ?> - <?= $galon['nama_produk'] ?> 
                    (Masuk: <?= date('d-m-Y', strtotime($galon['tgl_masuk'])) ?>)
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="tgl_kembali">Tanggal Kembali ke Gudang</label>
              <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required 
                     value="<?= date('Y-m-d') ?>">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-arrow-circle-left"></i> Kembalikan ke Gudang
              </button>
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