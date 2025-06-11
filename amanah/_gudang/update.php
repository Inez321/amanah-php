<?php
session_start();
require_once '../helper/connection.php';

$kode_item = $_POST['kode_item'] ?? '';
$tgl_kembali = $_POST['tgl_kembali'] ?? date('Y-m-d');

// Validate inputs
if (empty($kode_item)) {
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Kode item harus dipilih'
    ];
    header('Location: ./return.php');
    exit();
}

// Check if the item exists and is a galon with 'Kosong' status
$check_query = "SELECT * FROM inventori 
                WHERE kode_item = '$kode_item' 
                AND kode_produk = 'PRD-001' 
                AND status_produk = 'Kosong'";
$check_result = mysqli_query($connection, $check_query);

if (mysqli_num_rows($check_result) == 0) {
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Item tidak valid atau bukan galon kosong'
    ];
    header('Location: ./return.php');
    exit();
}

// Update the item status to 'Ada isi' and clear tgl_keluar
$update_query = "UPDATE inventori 
                 SET status_produk = 'Ada isi', 
                     tgl_keluar = NULL
                 WHERE kode_item = '$kode_item'";

if (mysqli_query($connection, $update_query)) {
    $_SESSION['info'] = [
        'status' => 'success',
        'message' => 'Galon berhasil dikembalikan ke gudang'
    ];
    header('Location: ./index.php');
    exit();
} else {
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Gagal mengembalikan galon: ' . mysqli_error($connection)
    ];
    header('Location: ./return.php');
    exit();
}
?>