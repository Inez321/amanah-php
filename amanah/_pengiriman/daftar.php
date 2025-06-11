<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

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
    p.id_pesanan, p.tgl_pesan, p.tgl_kirim,  u.nama_user, u.alamat");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Daftar Pesanan Belum Terkirim</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ 
        <a href="../_pengiriman/index.php">/ Jadwal Pengiriman </a>/ Daftar Pesanan

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
                  <th>Nama Pelanggan</th>
                  <th>Alamat</th>
                  <th>Tanggal Pesan</th>
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
                    <td><?= $data['alamat'] ?> </td>
                    <td><?= $data['tgl_pesan'] ?></td>
                    <td>
                      <a class="btn btn-sm btn-info mb-md-0 mb-1" href="detail.php?id_pesanan=<?= $data['id_pesanan'] ?>">
                        <i class="fas fa-eye"></i>
                      </a>
                      <a class="btn btn-sm btn-warning" href="store.php?id_pesanan=<?= $data['id_pesanan'] ?>">
                        <i class="fas fa-plus"></i>
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