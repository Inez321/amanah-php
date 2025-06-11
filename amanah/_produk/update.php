<?php
require_once '../helper/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kode_produk = $_POST['kode_produk'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga_produk = $_POST['harga_produk'];

    // Handle file upload
    if ($_FILES['gambar_produk']['name']) {
        $target_dir = "../amanah_assets/img/produk/";
        $target_file = $target_dir . basename($_FILES["gambar_produk"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["gambar_produk"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['info'] = [
                'status' => 'error',
                'message' => 'File yang diupload bukan gambar'
            ];
            header('Location: index.php');
            exit();
        }
        
        // Check file size (max 2MB)
        if ($_FILES["gambar_produk"]["size"] > 2000000) {
            $_SESSION['info'] = [
                'status' => 'error',
                'message' => 'Ukuran gambar terlalu besar (max 2MB)'
            ];
            header('Location: index.php');
            exit();
        }
        
        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            $_SESSION['info'] = [
                'status' => 'error',
                'message' => 'Hanya format JPG, JPEG, PNG & GIF yang diperbolehkan'
            ];
            header('Location: index.php');
            exit();
        }
        
        // Upload file
        $new_filename = "produk_" . uniqid() . "." . $imageFileType;
        $new_target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["gambar_produk"]["tmp_name"], $new_target_file)) {
            $gambar_produk = $new_target_file;
            
            // Delete old image if exists
            $query_old = mysqli_query($connection, "SELECT gambar_produk FROM produk WHERE kode_produk='$kode_produk'");
            $old_data = mysqli_fetch_assoc($query_old);
            if ($old_data['gambar_produk'] && file_exists($old_data['gambar_produk'])) {
                unlink($old_data['gambar_produk']);
            }
        } else {
            $_SESSION['info'] = [
                'status' => 'error',
                'message' => 'Gagal mengupload gambar'
            ];
            header('Location: index.php');
            exit();
        }
    } else {
        // Keep the old image if no new image is uploaded
        $query_old = mysqli_query($connection, "SELECT gambar_produk FROM produk WHERE kode_produk='$kode_produk'");
        $old_data = mysqli_fetch_assoc($query_old);
        $gambar_produk = $old_data['gambar_produk'];
    }

    $query = "UPDATE produk SET 
              nama_produk = '$nama_produk',
              deskripsi = '$deskripsi',
              harga_produk = '$harga_produk',
              gambar_produk = '$gambar_produk'
              WHERE kode_produk = '$kode_produk'";

    $result = mysqli_query($connection, $query);

    if ($result) {
        $_SESSION['info'] = [
            'status' => 'success',
            'message' => 'Produk berhasil diperbarui'
        ];
        header('Location: index.php');
    } else {
        $_SESSION['info'] = [
            'status' => 'error',
            'message' => 'Gagal memperbarui produk: ' . mysqli_error($connection)
        ];
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>