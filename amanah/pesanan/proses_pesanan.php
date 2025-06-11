<?php
require_once '../helper/connection.php';
session_start();

// Debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek jika form sudah disubmit
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn_pesan'])) {
    
    // Cek jika user sudah login
    if(!isset($_SESSION['login']['id_user'])) {
        $_SESSION['error'] = 'Silakan login terlebih dahulu';
        header('Location: ../login.php');
        exit();
    }

    // Validasi input
    if(empty($_POST['kode_produk']) || empty($_POST['jumlah_pesan']) || empty($_POST['metode_pembayaran'])) {
        $_SESSION['error'] = 'Semua field harus diisi';
        header("Location: ../layout/detail.php?kode_produk=".$_POST['kode_produk']);
        exit();
    }

    // Ambil data dari form
    $kode_produk = mysqli_real_escape_string($connection, $_POST['kode_produk']);
    $jumlah_pesan = (int)$_POST['jumlah_pesan'];
    $metode_pembayaran = mysqli_real_escape_string($connection, $_POST['metode_pembayaran']);
    $id_user = $_SESSION['login']['id_user'];
    
    // Dapatkan info produk untuk menentukan jenis produk
    $produk_query = mysqli_query($connection, "SELECT * FROM produk WHERE kode_produk = '$kode_produk'");
    $produk_data = mysqli_fetch_assoc($produk_query);
    $is_galon = (strpos($produk_data['nama_produk'], 'Galon') !== false);
    
    // Generate ID Pesanan
    $query = mysqli_query($connection, "SELECT MAX(id_pesanan) as last_id FROM pesanan");
    $data = mysqli_fetch_assoc($query);
    $last_num = $data['last_id'] ? (int)substr($data['last_id'], 4) : 0;
    $id_pesanan = 'PSN-' . str_pad($last_num + 1, 6, '0', STR_PAD_LEFT);
    
    // Insert pesanan
    $tgl_pesan = date('Y-m-d');
    $sql = "INSERT INTO pesanan (id_pesanan, tgl_pesan, status_pesanan, metode_pembayaran, id_user) 
            VALUES ('$id_pesanan', '$tgl_pesan', 'Diproses', '$metode_pembayaran', '$id_user')";
    
    if(mysqli_query($connection, $sql)) {
        // Cari item yang tersedia
        $query_item = mysqli_query($connection, "SELECT kode_item FROM inventori 
                          WHERE kode_produk = '$kode_produk' 
                          AND status_produk IN ('Tersedia', 'Ada isi') 
                          ORDER BY tgl_masuk ASC 
                          LIMIT $jumlah_pesan");
        
        $items = [];
        while($row = mysqli_fetch_assoc($query_item)) {
            $items[] = $row['kode_item'];
        }
        
        if(count($items) >= $jumlah_pesan) {
            // Insert ke keranjang
            $query_keranjang = mysqli_query($connection, "SELECT MAX(id_keranjang) as last_id FROM keranjang");
            $data_keranjang = mysqli_fetch_assoc($query_keranjang);
            $last_num_keranjang = $data_keranjang['last_id'] ? (int)substr($data_keranjang['last_id'], 4) : 0;
            
            foreach($items as $kode_item) {
                $last_num_keranjang++;
                $id_keranjang = 'KJG-' . str_pad($last_num_keranjang, 6, '0', STR_PAD_LEFT);
                
                // Insert ke keranjang
                $insert_keranjang = mysqli_query($connection, "INSERT INTO keranjang 
                    (id_keranjang, id_pesanan, kode_item, kode_produk, id_user) 
                    VALUES ('$id_keranjang', '$id_pesanan', '$kode_item', '$kode_produk', '$id_user')");
                
                if(!$insert_keranjang) {
                    $_SESSION['error'] = 'Gagal menyimpan ke keranjang: ' . mysqli_error($connection);
                    header("Location: ../layout/detail.php?kode_produk=$kode_produk");
                    exit();
                }
                
                // Update status item berdasarkan jenis produk
                $new_status = $is_galon ? 'Kosong' : 'Terjual';
                $update_item = mysqli_query($connection, "UPDATE inventori 
                    SET status_produk = '$new_status', tgl_keluar = '$tgl_pesan' 
                    WHERE kode_item = '$kode_item'");
                
                if(!$update_item) {
                    $_SESSION['error'] = 'Gagal update status item: ' . mysqli_error($connection);
                    header("Location: ../layout/detail.php?kode_produk=$kode_produk");
                    exit();
                }
            }
            
            $_SESSION['info'] = [
                'status' => 'success',
                'message' => 'Pesanan berhasil dibuat! ID: ' . $id_pesanan
            ];
            header('Location: index.php');
            exit();
        } else {
            // Hapus pesanan jika stok tidak cukup
            mysqli_query($connection, "DELETE FROM pesanan WHERE id_pesanan = '$id_pesanan'");
            
            $_SESSION['error'] = 'Stok tidak mencukupi! Stok tersedia: ' . count($items);
            header("Location: ../layout/detail.php?kode_produk=$kode_produk");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Gagal membuat pesanan: ' . mysqli_error($connection);
        header("Location: ../layout/detail.php?kode_produk=$kode_produk");
        exit();
    }
} else {
    $_SESSION['error'] = 'Akses tidak valid';
    header('Location: ../layout/index.php');
    exit();
}
?>