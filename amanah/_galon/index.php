<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

// Fetch data for galon from the inventori table
$result = mysqli_query($connection, "SELECT
    kode_item AS kode_galon,
    CASE 
        WHEN status_produk = 'Kosong' THEN 'Pelanggan'
        ELSE 'Gudang'
    END AS lokasi,
    tgl_masuk AS tanggal_diterima,
    status_produk AS status_galon
FROM
    inventori");

?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Daftar Galon</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ Daftar Galon
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
                  <th>Kode Galon</th>
                  <th>Lokasi</th>
                  <th>Tanggal Diterima</th>
                  <th>Status Galon</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                ?>
                  <tr>
                    <td><?= $data['kode_galon'] ?></td>
                    <td><?= $data['lokasi'] ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tanggal_diterima'])) ?></td> <!-- Format date -->
                    <td><?= $data['status_galon'] ?></td>
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
