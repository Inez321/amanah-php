<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT
        p.id_pesanan,
        u.nama_user,
        u.no_telepon,
        u.alamat,
        p.tgl_kirim, 
        p.status_pesanan 
    FROM
        pesanan p
    JOIN
        users u ON p.id_user = u.id_user
    WHERE
        p.status_pesanan='Diterima'
    ORDER BY
        p.tgl_kirim ASC, p.id_pesanan ");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Riwayat Pengiriman</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ Riwayat Pengiriman
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
                  <th>ID Pengiriman</th>
                  <th>Nama Pelanggan</th>
                  <th>No. Telepon</th>
                  <th>Alamat</th>
                  <th>Status Pengiriman</th>
                  <th>Tanggal Kirim</th>
                  <th style="width: 10%">Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                ?>
                  <tr>
                    <td><?= $data['id_pesanan'] ?></td>
                    <td><?= $data['nama_user'] ?></td>
                    <td><?= $data['no_telepon'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td>
                      <span class="badge <?= 
                        $data['status_pesanan'] == 'Dikirim' ? 'badge-info' : 
                        ($data['status_pesanan'] == 'Diterima' ? 'badge-success' : 
                        'badge-secondary')
                      ?>">
                        <?= $data['status_pesanan'] ?>
                      </span>
                    </td>
                    <td><?= date('d-m-Y', strtotime($data['tgl_kirim'])) ?></td>
                    <td>
                      <a class="btn btn-info mb-md-0 mb-1" href="detail2.php?id_pesanan=<?= $data['id_pesanan'] ?>">
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