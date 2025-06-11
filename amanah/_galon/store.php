<?php
require_once '../helper/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_item = $_POST['kode_item'];
    $kode_produk = $_POST['kode_produk'];
    $tgl_masuk = $_POST['tgl_masuk'];
    $status_produk = $_POST['status_produk'];

    // Validate input
    if (empty($kode_item) || empty($kode_produk) || empty($tgl_masuk) || empty($status_produk)) {
        $_SESSION['error'] = 'Semua field harus diisi';
        header('Location: create.php');
        exit();
    }

    $query = "INSERT INTO inventori 
              (kode_item, kode_produk, tgl_masuk, status_produk) 
              VALUES ('$kode_item', '$kode_produk', '$tgl_masuk', '$status_produk')";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Galon berhasil ditambahkan'
        ];
        header('Location: index.php');
    } else {
        $_SESSION['info'] = [
            'status' => 'error',
            'message' => 'Gagal menambahkan galon: ' . mysqli_error($connection)
        ];
        header('Location: create.php');
    }
} else {
    $_SESSION['error'] = 'Invalid request method';
    header('Location: index.php');
}
?>