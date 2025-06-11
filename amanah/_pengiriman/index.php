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
        p.status_pesanan='Dikirim'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Jadwal Pengiriman</h1>
        <p>
        <a href="../_layout/index.php">Home </a>
        / Jadwal Pengiriman
        </p>  
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
                  <th>No Telepon</th>
                  <th>Alamat</th>
                  <th>Tanggal Kirim</th>
                  <th style="width: 15%">Aksi</th>
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
                    <td><?= $data['tgl_kirim'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-primary mb-md-0 mb-1" href="update.php?id_pesanan=<?= $data['id_pesanan'] ?>"onclick="return confirm('Yakin ingin mengubah status pengiriman?');">
                        <i class="fas fa-check"></i>
                      </a>                                                  
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
            <a href="./daftar.php" class="btn btn-primary">Tambah Jadwal</a>
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