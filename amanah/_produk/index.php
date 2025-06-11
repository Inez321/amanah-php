<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT * FROM produk");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Daftar Produk</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ Daftar Produk
      </p>
    </div>
  </div> 

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr>
                  <th>Kode Produk</th>
                  <th>Nama Produk</th>
                  <th>Isi Produk</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th style="width: 100px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                  // Calculate available stock for each product
                  $kode_produk = $data['kode_produk'];
                  
                  // Different status conditions based on product type
                  if ($kode_produk == 'PRD-001') {
                    // For galon (19 liter), count 'Ada isi' status
                    $stock_query = mysqli_query($connection, 
                      "SELECT COUNT(*) as total FROM inventori 
                       WHERE kode_produk='$kode_produk' AND status_produk='Ada isi'");
                  } else {
                    // For bottles, count 'Tersedia' status
                    $stock_query = mysqli_query($connection, 
                      "SELECT COUNT(*) as total FROM inventori 
                       WHERE kode_produk='$kode_produk' AND status_produk='Tersedia'");
                  }
                  
                  $stock_data = mysqli_fetch_assoc($stock_query);
                  $stock = $stock_data['total'];
                  
                  // Format price exactly like in _pesanan/detail.php
                  $harga_tampil = 'Rp' . $data['harga_produk'];
                ?>
                  <tr>
                    <td><?= $data['kode_produk'] ?></td>
                    <td><?= $data['nama_produk'] ?></td>
                    <td><?= $data['deskripsi'] ?></td>
                    <td><?= $harga_tampil ?></td>
                    <td>
                      <?php 
                        if ($kode_produk == 'PRD-001') {
                          echo $stock . ' Galon';
                        } else {
                          echo $stock . ' Kardus';
                        }
                      ?>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning mb-md-0 mb-1" href="edit.php?kode_produk=<?= $data['kode_produk'] ?>">
                        <i class="fas fa-pencil-alt"></i> Edit
                      </a>
                    </td>
                  </tr>
                <?php
                endwhile;
                ?>
              </tbody>
            </table>
            <div class="mt-3">
              <a href="./create.php" class="btn btn-primary">Tambah Data</a>
            </div>            
          </div>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>
<!-- Page Specific JS File -->
<?php
if (isset($_SESSION['info'])) :
  if ($_SESSION['info']['status'] == 'success') {
?>
    <script>
      iziToast.success({
        title: 'Sukses',
        message: `<?= $_SESSION['info']['message'] ?>`,
        position: 'topCenter',
        timeout: 5000
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      iziToast.error({
        title: 'Gagal',
        message: `<?= $_SESSION['info']['message'] ?>`,
        timeout: 5000,
        position: 'topCenter'
      });
    </script>
<?php
  }

  unset($_SESSION['info']);
  $_SESSION['info'] = null;
endif;
?>
<script src="../amanah_assets/js/page/modules-datatables.js"></script>