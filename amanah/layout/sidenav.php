<?php
require_once '../helper/connection.php';

// Pastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek koneksi database
if (!$connection) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>

<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.php">
        <img src="../amanah_assets/img/logo amanah.jpg" alt="logo" width="150">
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.php">
        <img src="../amanah_assets/img/logo amanah 2.png" alt="logo" width="30">
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">DASHBOARD</li>
      <li>
        <a class="nav-link" href="../layout/index.php">
          <i class="fas fa-home"></i> 
          <span>Home</span>
        </a>
      </li>

      <li class="menu-header">MAIN FEATURE</li>
      
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
          <i class="fas fa-shopping-cart"></i> 
          <span>Pesanan</span>
        </a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="../pesanan/index.php">Pesanan Aktif</a></li>
          <li><a class="nav-link" href="../pesanan/riwayat.php">Riwayat Pesanan</a></li>
        </ul>
      </li>
      
      <li>
        <a class="nav-link" href="../profil/index.php">
          <i class="fas fa-camera-retro"></i> 
          <span>Profil</span>
        </a>
      </li>

      <li>
        <a class="nav-link" href="../faq/index.php">
          <i class="fas fa-comments"></i> 
          <span>FAQ</span>
        </a>
      </li>
    </ul>
  </aside>
</div>