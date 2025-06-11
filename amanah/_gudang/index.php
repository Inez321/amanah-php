<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT
    i.kode_item,
    i.tgl_masuk,
    i.tgl_keluar,
    i.status_produk,
    i.kode_produk,
    p.nama_produk,
    CASE
        WHEN i.kode_produk = 'PRD-001' THEN
            CASE
                WHEN i.status_produk IN ('Ada isi', 'Tersedia') THEN 'Gudang'
                WHEN i.status_produk = 'Kosong' THEN 'Pelanggan'
                ELSE 'Gudang'
            END
        WHEN i.status_produk = 'Terjual' THEN '-'
        ELSE 'Gudang'
    END AS lokasi
FROM
    inventori i
JOIN produk p ON i.kode_produk = p.kode_produk
WHERE i.tgl_keluar IS NULL OR i.status_produk != 'Terjual'
ORDER BY i.tgl_masuk DESC");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Data Gudang Saat Ini</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>/ Data Gudang
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
                  <th>Kode Item</th>
                  <th>Tanggal Masuk</th>
                  <th>Status Produk</th>
                  <th>Produk</th>
                  <th>Lokasi</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($data = mysqli_fetch_array($result)): ?>
                  <tr>
                    <td><?= $data['kode_item'] ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tgl_masuk'])) ?></td>
                    <td>
                      <span class="badge <?= 
                        $data['status_produk'] == 'Ada isi' ? 'badge-success' : 
                        ($data['status_produk'] == 'Kosong' ? 'badge-warning' : 
                        ($data['status_produk'] == 'Tersedia' ? 'badge-info' : 
                        ($data['status_produk'] == 'Terjual' ? 'badge-primary' : 'badge-secondary')))
                      ?>">
                        <?= $data['status_produk'] ?>
                      </span>
                    </td>
                    <td><?= $data['nama_produk'] ?></td>
                    <td><?= $data['lokasi'] ?></td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
            <div class="mt-3">
              <a href="./restock.php" class="btn btn-primary">Tambah Data Restock</a>
              <a href="./return.php" class="btn btn-warning ml-2">Return Galon</a>
              <a href="./riwayat.php" class="btn btn-info ml-2">Lihat Riwayat Restock</a>
            </div>            
          </div>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>
<script src="../amanah_assets/js/page/modules-datatables.js"></script>