<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

// Pastikan hanya penjual yang bisa akses
if($_SESSION['login']['level_user'] != 'Penjual') {
    header('Location: ../login.php');
    exit();
}

$result = mysqli_query($connection, "SELECT
    p.id_pesanan,
    p.tgl_pesan,
    u.nama_user,
    u.alamat
FROM
    pesanan p
JOIN
    users u ON p.id_user = u.id_user
JOIN
    keranjang k ON p.id_pesanan = k.id_pesanan
JOIN
    produk pr ON k.kode_produk = pr.kode_produk 
WHERE
    p.status_pesanan = 'Diproses'
GROUP BY 
    p.id_pesanan, p.tgl_pesan, p.tgl_kirim, u.nama_user, u.alamat");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Pesanan Terbaru</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ Pesanan Terbaru
      </p>
    </div>
  </div>
  
  <?php if(isset($_SESSION['info'])): ?>
    <div class="alert alert-<?= $_SESSION['info']['status'] == 'success' ? 'success' : 'danger' ?>">
      <?= $_SESSION['info']['message'] ?>
    </div>
    <?php unset($_SESSION['info']); ?>
  <?php endif; ?>
  
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr>
                  <th>ID Pesanan</th>
                  <th>Nama Pelanggan</th>
                  <th>Alamat</th>
                  <th>Tanggal Pesan</th>
                  <th style="width: 8%">Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                ?>
                  <tr>
                    <td><?= $data['id_pesanan'] ?></td>
                    <td><?= $data['nama_user'] ?></td>
                    <td><?= $data['alamat'] ?> </td>
                    <td><?= $data['tgl_pesan'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-info mb-md-0 mb-1" href="detail.php?id_pesanan=<?= $data['id_pesanan'] ?>">
                        <i class="fas fa-eye"></i>
                      </a>                  
                    </td>
                  </tr>
                <?php
                endwhile;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>
<script src="../amanah_assets/js/page/modules-datatables.js"></script>