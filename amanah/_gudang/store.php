<?php
session_start();
require_once '../helper/connection.php';

// Function to generate new item code
function generateKodeItem($connection) {
    $query = mysqli_query($connection, "SELECT kode_item FROM inventori ORDER BY kode_item DESC LIMIT 1");
    $data = mysqli_fetch_assoc($query);

    if ($data) {
        $last_code = $data['kode_item'];
        $number = (int) substr($last_code, 4);
        $number++;
    } else {
        $number = 1;
    }
    
    return 'ITM-' . sprintf('%07d', $number);
}

$kode_produk = $_POST['kode_produk'] ?? '';
$tgl_masuk = $_POST['tgl_masuk'] ?? date('Y-m-d');
$jumlah_stok = (int) ($_POST['jumlah_stok'] ?? 0);

// Validate inputs
if (empty($kode_produk)) {
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Kode produk harus dipilih'
    ];
    header('Location: ./restock.php');
    exit();
}

if ($jumlah_stok < 1) {
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Jumlah stok minimal 1'
    ];
    header('Location: ./restock.php');
    exit();
}

// Determine status based on product type
$status_produk = ($kode_produk == 'PRD-001') ? 'Ada isi' : 'Tersedia';

// Start transaction
mysqli_begin_transaction($connection);

try {
    for ($i = 0; $i < $jumlah_stok; $i++) {
        $kode_item = generateKodeItem($connection);
        $query = "INSERT INTO inventori (kode_item, tgl_masuk, status_produk, kode_produk) 
                  VALUES ('$kode_item', '$tgl_masuk', '$status_produk', '$kode_produk')";
        
        if (!mysqli_query($connection, $query)) {
            throw new Exception(mysqli_error($connection));
        }
    }

    // Commit transaction if all inserts succeed
    mysqli_commit($connection);
    
    $_SESSION['info'] = [
        'status' => 'success',
        'message' => 'Berhasil menambahkan ' . $jumlah_stok . ' item stok baru'
    ];
    header('Location: ./index.php');
    exit();

} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($connection);
    
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Gagal menambahkan stok: ' . $e->getMessage()
    ];
    header('Location: ./restock.php');
    exit();
}
?>