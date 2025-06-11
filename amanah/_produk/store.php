<?php
require_once '../helper/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga_produk = $_POST['harga_produk'];

    // Handle file upload
    $target_dir = "../amanah_assets/img/produk/";
    $imageFileType = strtolower(pathinfo($_FILES["gambar_produk"]["name"], PATHINFO_EXTENSION));
    $file_name = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["gambar_produk"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error'] = "File bukan gambar.";
        header('Location: create.php');
        exit();
    }

    // Check file size (max 2MB)
    if ($_FILES["gambar_produk"]["size"] > 2000000) {
        $_SESSION['error'] = "Ukuran gambar terlalu besar (maks 2MB).";
        header('Location: create.php');
        exit();
    }

    // Allow certain file formats
    $allowed_types = ['jpg', 'jpeg', 'png'];
    if (!in_array($imageFileType, $allowed_types)) {
        $_SESSION['error'] = "Hanya format JPG, JPEG, PNG yang diperbolehkan.";
        header('Location: create.php');
        exit();
    }

    // Try to upload file
    if (move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $target_file)) {
        $query = "INSERT INTO produk (kode_produk, nama_produk, deskripsi, harga_produk, gambar_produk) 
                  VALUES ('$kode_produk', '$nama_produk', '$deskripsi', '$harga_produk', '$file_name')";

        $result = mysqli_query($connection, $query);

        if ($result) {
            $_SESSION['info'] = [
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan'
            ];
            header('Location: index.php');
        } else {
            // Delete uploaded file if query fails
            unlink($target_file);
            $_SESSION['info'] = [
                'status' => 'error',
                'message' => 'Gagal menambahkan produk: ' . mysqli_error($connection)
            ];
            header('Location: create.php');
        }
    } else {
        $_SESSION['error'] = "Terjadi kesalahan saat mengupload gambar.";
        header('Location: create.php');
    }
} else {
    $_SESSION['error'] = 'Invalid request method';
    header('Location: index.php');
}
?>