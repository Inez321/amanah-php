<?php
require_once '_top.php';
require_once '../helper/connection.php';

$galon = mysqli_query($connection, "SELECT COUNT(*) FROM inventori WHERE status_produk = 'Ada isi'");
$galon_kosong = mysqli_query($connection, "SELECT COUNT(*) FROM inventori WHERE status_produk = 'Kosong'");
$botol_500 = mysqli_query($connection, "SELECT COUNT(*) FROM inventori WHERE kode_produk='PRD-002'AND status_produk = 'Tersedia'");
$botol_330 = mysqli_query($connection, "SELECT COUNT(*) FROM inventori WHERE kode_produk='PRD-003'AND status_produk = 'Tersedia'");
$botol_200 = mysqli_query($connection, "SELECT COUNT(*) FROM inventori WHERE kode_produk='PRD-004'AND status_produk = 'Tersedia'");




$total_galon = mysqli_fetch_array($galon)[0];
$total_galon_kosong = mysqli_fetch_array($galon_kosong)[0];
$total_botol_500 = mysqli_fetch_array($botol_500)[0];
$total_botol_330 = mysqli_fetch_array($botol_330)[0];
$total_botol_200 = mysqli_fetch_array($botol_200)[0];


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
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
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
  
  
  <div class="column">
    <div class="row">
      <div class="col-md-6 col-xl-4">
        <div class="card card-statistic-1">
          <div class="card-icon center-flex bg-secondary">
              <img src="../amanah_assets/img/produk/produk 4.avif" alt="logo" width="90">
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Stok Galon</h4> 
            </div>
            <div class="card-body">
              <?= $total_galon ?> Biji
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-4">
        <div class="card card-statistic-1">
          <div class="card-icon center-flex bg-secondary">
            <img src="../amanah_assets/img/produk/produk 8.png" alt="logo" width="70">
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Galon Kosong</h4> 
            </div>
            <div class="card-body">
              <?= $total_galon_kosong ?> Biji
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-4">
        <div class="card card-statistic-1">
          <div class="card-icon center-flex bg-secondary">
            <img src="../amanah_assets/img/produk/produk 3.avif" alt="logo" width="100">
          </div>
          <div class="card-wrap">
            <div class="card-header">
             <h4>Stok Botol 500 ml</h4> 
            </div>  
            <div class="card-body">
              <?= $total_botol_500?> Kardus
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-xl-4">
        <div class="card card-statistic-1">
          <div class="card-icon center-flex bg-secondary">
            <img src="../amanah_assets/img/produk/produk 2.avif" alt="logo" width="115">
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Stok Botol 330 ml</h4>
            </div>
            <div class="card-body">
              <?= $total_botol_330 ?> Kardus
            </div>
          </div>
        </div>
      </div> 

      <div class="col-md-6 col-xl-4">
        <div class="card card-statistic-1">
          <div class="card-icon center-flex bg-secondary ">
            <img src="../amanah_assets/img/produk/produk 1.avif" alt="logo" width="150">
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Stok Botol 200 ml</h4>
            </div>
            <div class="card-body">
              <?= $total_botol_200?> Kardus
            </div>
          </div>
        </div>
      </div>          

    </div>
  </div>
</section>

<?php
require_once '_bottom.php'; 
?>