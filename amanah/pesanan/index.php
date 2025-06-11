<?php
require_once '../layout/top.php';
require_once '../helper/connection.php';

// Pastikan user sudah login
if(!isset($_SESSION['login']['id_user'])) {
    header('Location: ../login.php');
    exit();
}

// Hanya tampilkan pesanan milik user yang login
$id_user = $_SESSION['login']['id_user'];
$result = mysqli_query($connection, "SELECT
    p.id_pesanan,
    p.tgl_pesan,
    p.tgl_kirim,
    p.status_pesanan,
    p.metode_pembayaran
FROM
    pesanan p
WHERE
    p.id_user = '$id_user' AND
    (p.status_pesanan = 'Diproses' OR p.status_pesanan = 'Dikirim')
ORDER BY p.tgl_pesan DESC");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Pesanan Aktif</h1>
    <div class="section-header-breadcrumb">
      <p>
        <a href="../layout/index.php">Home</a> / Pesanan Aktif
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
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Kirim</th>
                  <th>Status</th>
                  <th>Metode Pembayaran</th>
                  <th style="width: 15%">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                ?>
                  <tr>
                    <td><?= $data['id_pesanan'] ?></td>
                    <td><?= $data['tgl_pesan'] ?></td>
                    <td><?= $data['tgl_kirim'] ? $data['tgl_kirim'] : '-' ?></td>
                    <td>
                      <span class="badge badge-<?= 
                        $data['status_pesanan'] == 'Diproses' ? 'warning' : 
                        ($data['status_pesanan'] == 'Dikirim' ? 'primary' : 'success')
                      ?>">
                        <?= $data['status_pesanan'] ?>
                      </span>
                    </td>
                    <td><?= $data['metode_pembayaran'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-info mb-md-0 mb-1" href="detail.php?id_pesanan=<?= $data['id_pesanan'] ?>">
                        <i class="fas fa-eye"></i> Detail
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
require_once '../layout/bottom.php';
?>
<script src="../amanah_assets/js/page/modules-datatables.js"></script>