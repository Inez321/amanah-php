<?php
session_start();
require_once '../helper/connection.php';

date_default_timezone_set('Asia/Jakarta');

if (isset($_GET['id_pesanan'])) {
    $id_pesanan = $_GET['id_pesanan']; 

    $status_diterima = 'Diterima'; 
    $tgl_kirim = date('Y-m-d');

    $query = mysqli_query($connection, "UPDATE pesanan SET status_pesanan = '$status_diterima' , tgl_kirim = '$tgl_kirim' WHERE id_pesanan = '$id_pesanan'");

    if ($query) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Pengiriman pesanan selesai!'
        ];
 
        header('Location: ./riwayat.php'); 
        exit();
    } else {
        $_SESSION['info'] = [
            'status' => 'failed',
            'message' => mysqli_error($connection)
        ];
        header('Location: ./index.php');
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