<?php
require_once 'top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT * FROM produk");
if (mysqli_num_rows($result) > 0) {
    $produk = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $produk = [];
}
?>
<section class="section">
  <div class="section-header">
    <h1>Home</h1>
      <div class="section-header-breadcrumb">
        <p>
          <a href="index.php">Air Amanah Boja </a>
          / Home
        </p>
      </div>
  </div>  
  
  <div class="column">
    <div class="row">
      <div class="col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card card-statistic-4" style="background:white; padding:0;"> <!-- Lapisan Putih -->
          <div class="bg-secondary" style="width:100%; height:100%; padding:5px;"> <!-- Lapisan Abu -->
            <div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
              <img src="../amanah_assets/img/thumbnail/thumbnail.png" alt="logo" 
                  style="max-width:100%; max-height:100%; object-fit:contain;"> <!-- Gambar -->
            </div>
          </div>
        </div>
      </div>     
    </div>
  </div>
</section>
<section class="section">
  <div class="section-header">
    <h1>Rekomendasi Produk</h1>
  </div>
  <div class="column">
    <div class="row">
      <?php
        foreach ($produk as $index => $data) {
          if ($index >= 4) {
            break;
          }
            $image_src = "";
            if ($index == 0) {
              $image_src = "../amanah_assets/img/produk/produk 4.avif";
            } elseif ($index == 1) {
              $image_src = "../amanah_assets/img/produk/produk 3.avif";
            } elseif ($index == 2) {
              $image_src = "../amanah_assets/img/produk/produk 2.avif";
            } elseif ($index == 3) {
              $image_src = "../amanah_assets/img/produk/produk 1.avif";
            }
        ?>
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card card-statistic-3">
          <div class="card-icon center-flex bg-secondary">
              <img src="<?= $image_src ?>" alt="logo" width="90">
          </div>        
          <div class="card-wrap">
            <div class="card-header">
              <h4><a href="detail.php?kode_produk=<?= $data['kode_produk'] ?>"><?= $data['nama_produk']?></a></h4>
            </div>
            <div class="card-body">
              Rp<?= $data['harga_produk']?>
            </div>
            <div class="card-body">
              <?= $data['deskripsi'] ?>
            </div>        
          </div>             
        </div>
        
      </div>     
      <?php
      } 
      ?>
    </div>
  </div>
</section>


<?php
require_once 'bottom.php'; 
?>
