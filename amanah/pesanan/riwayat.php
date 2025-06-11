<?php
require_once '../layout/top.php';
require_once '../helper/connection.php';

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
    p.status_pesanan = 'Diterima'
ORDER BY p.tgl_pesan DESC");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Riwayat Pesanan</h1>
    <div class="section-header-breadcrumb">
      <p>
        <a href="../layout/index.php">Home</a> / Riwayat Pesanan
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
                  <th>ID Pesanan</th>
                  <th>Tanggal Pesan</th>
                  <th>Tanggal Kirim</th>
                  <th>Status</th>
                  <th>Metode Pembayaran</th>
                  <th style="width: 10%">Detail</th>
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
                      <span class="badge badge-success">
                        <?= $data['status_pesanan'] ?>
                      </span>
                    </td>
                    <td><?= $data['metode_pembayaran'] ?></td>
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
require_once '../layout/bottom.php';
?>
<script src="../amanah_assets/js/page/modules-datatables.js"></script>