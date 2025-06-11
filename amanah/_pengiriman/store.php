<?php

session_start();
require_once '../helper/connection.php';


if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan']; 

    $status_dikirim = 'Dikirim'; 

    $query = mysqli_query($connection, "UPDATE pesanan SET status_pesanan = '$status_dikirim' WHERE id_pesanan = '$id_pesanan'");

    if ($query) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Berhasil mengubah status pesanan!'
        ];
 
        header('Location: ./daftar.php'); 
        exit();
    } else {
        $_SESSION['info'] = [
            'status' => 'failed',
            'message' => 'Gagal mengubah status pesanan: ' . mysqli_error($connection)
        ];
        header('Location: ./daftar.php');
        exit();
    }
} else {

    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Id Pesanan tidak ditemukan untuk update.'
    ];
    header('Location: ./jadwal.php');
    exit();
}
?>