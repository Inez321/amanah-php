<?php
require_once '../_layout/_top.php';
require_once '../helper/connection.php';

// Function to generate new item code
function generateKodeItem($connection) {
    $query_item_terakhir = mysqli_query($connection, "SELECT kode_item FROM inventori ORDER BY kode_item DESC LIMIT 1");
    $data_item_terakhir = mysqli_fetch_assoc($query_item_terakhir);

    if ($data_item_terakhir) {
        $kode_item_terakhir = $data_item_terakhir['kode_item'];
        $angka_item = (int) substr($kode_item_terakhir, 4); 
        $angka_item++; 
    } else {
        $angka_item = 1; 
    }
    
    return 'ITM-'. sprintf('%07d', $angka_item);
}

// Initialize variables
$kode_produk = '';
$tgl_masuk = date('Y-m-d');
$jumlah_stok = 1;
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_produk = $_POST['kode_produk'] ?? '';
    $tgl_masuk = $_POST['tgl_masuk'] ?? '';
    $jumlah_stok = (int)($_POST['jumlah_stok'] ?? 0);

    if (!$kode_produk) {
        $error = "Produk harus dipilih.";
    } elseif (!$tgl_masuk) {
        $error = "Tanggal restock harus diisi.";
    } elseif ($jumlah_stok < 1) {
        $error = "Jumlah stok minimal 1.";
    } else {
        // Determine status based on product type
        $status_produk = ($kode_produk == 'PRD-001') ? 'Ada isi' : 'Tersedia';
        
        $success = true;
        mysqli_begin_transaction($connection);
        
        try {
            for ($i = 0; $i < $jumlah_stok; $i++) {
                $newKodeItem = generateKodeItem($connection);
                $query = "INSERT INTO inventori (kode_item, tgl_masuk, status_produk, kode_produk) 
                          VALUES ('$newKodeItem', '$tgl_masuk', '$status_produk', '$kode_produk')";
                
                if (!mysqli_query($connection, $query)) {
                    throw new Exception(mysqli_error($connection));
                }
            }
            
            mysqli_commit($connection);
            $_SESSION['info'] = [
                'status' => 'success',
                'message' => 'Data restock berhasil disimpan.'
            ];
            
            // Pastikan tidak ada output sebelum ini
            if (!headers_sent()) {
                header('Location: index.php');
                exit();
            } else {
                echo '<script>window.location.href="index.php";</script>';
                exit();
            }
        } catch (Exception $e) {
            mysqli_rollback($connection);
            $error = "Gagal menyimpan data restock: " . $e->getMessage();
        }
    }
}

// Get product list after potential redirect
$products = mysqli_query($connection, "SELECT * FROM produk");
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Data Restock</h1>
    <div class="section-header-breadcrumb">
      <p>
      <a href="../_layout/index.php">Home </a>
      <a href="index.php">/ Data Gudang </a>/ Tambah Restock
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <?php if ($error): ?>
            <div class="alert alert-danger">
              <?= $error ?>
            </div>
          <?php endif; ?>
          
          <form action="" method="post">
            <div class="form-group">
              <label for="kode_produk">Pilih Produk</label>
              <select class="form-control" name="kode_produk" id="kode_produk" required>
                <?php while ($product = mysqli_fetch_assoc($products)): ?>
                  <option value="<?= $product['kode_produk'] ?>" <?= ($kode_produk == $product['kode_produk']) ? 'selected' : '' ?>>
                    <?= $product['nama_produk'] ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group">
              <label for="tgl_masuk">Tanggal Restock</label>
              <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk" required 
                     value="<?= $tgl_masuk ?>">
            </div>

            <div class="form-group">
              <label for="jumlah_stok">Jumlah Stok</label>
              <input type="number" class="form-control" id="jumlah_stok" name="jumlah_stok" min="1" required 
                     value="<?= $jumlah_stok ?>">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="index.php" class="btn btn-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require_once '../_layout/_bottom.php';
?>