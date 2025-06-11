<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

$data_produk = null;
if (isset($_GET['kode_produk'])) {
    $kode_produk = mysqli_real_escape_string($connection, $_GET['kode_produk']);

    $query = mysqli_query($connection, "SELECT * FROM produk WHERE kode_produk='$kode_produk'");

    if ($query && mysqli_num_rows($query) > 0) {
        $data_produk = mysqli_fetch_assoc($query);
    }
}
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Detail Produk</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>
      <a href="../_produk/index.php">/ Daftar Produk </a>/ Detail Produk
      </p>
    </div>
  </div>
    <div class="col-12">
      <div class="card">
        <div class="col-md-8"> 
        <div class="card-body">
            <?php
            if ($data_produk) {
            ?>
            <div class="row"> 
            <div class="card card-statistic-4">
              <div class="card-icon center-flex bg-secondary">
                <img src="<?php echo $data_produk['gambar_produk'];?>" alt="logo" width="200px">
              </div>

            </div>              

          <div class="col-md-8"> 
            <form>
              <table cellpadding="8" class="w-100">
                <tr>
                  <td>Nama Produk</td>
                  <td>
                    <input type="text" class="form-control" id="nama_produk" value="<?= htmlspecialchars($data_produk['nama_produk']) ?>" disabled>
                  </td>
                </tr>
                <tr>
                  <td>Harga Produk</td>
                  <td>
                    <input type="text" class="form-control" id="harga_produk" value="<?= htmlspecialchars($data_produk['harga_produk']) ?>" disabled>
                  </td>
                </tr>
                <tr>
                  <td>Jumlah Produk</td>
                  <td>
                    <input type="text" class="form-control" id="deskripsi" value="<?= htmlspecialchars($data_produk['deskripsi']) ?>" disabled>
                  </td>
                </tr>                                         
              </table>
                    </form>
                </div>
             <?php
            } else {
                // Opsional: Pesan jika data produk tidak ditemukan
                echo "<p class='text-center text-muted'>Data produk tidak ditemukan.</p>";
            }
            ?>
        </div>
      </div>
        </div>
    </div>
  </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>