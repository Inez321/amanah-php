<?php
require_once '../layout/top.php';
require_once '../helper/connection.php';

// Pastikan user sudah login
if(!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit();
}

$data_produk = null;
if(isset($_GET['kode_produk'])) {
    $kode_produk = mysqli_real_escape_string($connection, $_GET['kode_produk']);
    $query = mysqli_query($connection, "SELECT * FROM produk WHERE kode_produk='$kode_produk'");
    if($query && mysqli_num_rows($query) > 0) {
        $data_produk = mysqli_fetch_assoc($query);
    } else {
        $_SESSION['error'] = 'Produk tidak ditemukan';
        header('Location: index.php');
        exit();
    }
} else {
    $_SESSION['error'] = 'Parameter produk tidak valid';
    header('Location: index.php');
    exit();
}
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Detail Produk</h1>
    <div class="section-header-breadcrumb">
      <p>
        <a href="../layout/index.php">Home</a> / Detail Produk
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
          
          <form action="../pesanan/proses_pesanan.php" method="POST" id="formPesan">
            <input type="hidden" name="kode_produk" value="<?= $data_produk['kode_produk'] ?>">
            <div class="row">
              <div class="col-md-4 text-center">
                <img src="<?= $data_produk['gambar_produk'] ?>" 
                     alt="<?= $data_produk['nama_produk'] ?>" 
                     class="img-fluid rounded"
                     style="max-height: 200px;">
              </div>
              
              <div class="col-md-8">
                <table class="table table-bordered">
                  <tr>
                      <th width="30%">Nama Produk</th>
                      <td><?= htmlspecialchars($data_produk['nama_produk']) ?></td>
                  </tr>
                  
                  <tr>
                    <th>Harga</th>
                    <td>Rp<?= $data_produk['harga_produk'] ?></td>
                  </tr>
                      <th>Deskripsi</th>
                      <td><?= htmlspecialchars($data_produk['deskripsi']) ?></td>
                  </tr>
                  <tr>
                    <th>Jumlah Pesan</th>
                    <td>
                      <input type="number" name="jumlah_pesan" class="form-control" 
                             min="1" max="10" required>
                    </td>
                  </tr>
                  <tr>
                    <th>Metode Pembayaran</th>
                    <td>
                      <select name="metode_pembayaran" class="form-control" required>
                        <option value="Transfer">Transfer</option>
                        <option value="Cash">Cash</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2" class="text-center">
                      <button type="submit" name="btn_pesan" value="pesan" class="btn btn-primary">
                        <i class="fas fa-shopping-cart"></i> Pesan Sekarang
                      </button>
                      <a href="../layout/index.php" class="btn btn-secondary ml-2">Kembali</a>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once '../layout/bottom.php'; ?>