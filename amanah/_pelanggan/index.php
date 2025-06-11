<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT * FROM users WHERE level_user = 'Pembeli'");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Data Pelanggan</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ Data Pelanggan
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
                  <th>ID Pelanggan</th>
                  <th>Nama Pelanggan</th>
                  <th>No Telepon</th>
                  <th>Alamat</th>                                    
                </tr>
              </thead>
              <tbody>
                <?php
                while ($data = mysqli_fetch_array($result)) :                
                ?>
                  <tr>
                    <td><?= $data['id_user'] ?></td>
                    <td><?= $data['nama_user'] ?></td>
                    <td><?= $data['no_telepon'] ?></td>
                    <td><?= $data['alamat'] ?></td>
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