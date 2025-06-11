<?php
session_start();
require_once '../helper/connection.php';

// Data dari form
$id_user = $_POST['id_user'];
$nama_user = $_POST['nama_user'];
$email = $_POST['email'];
$no_telepon = $_POST['no_telepon'];
$sandi = !empty($_POST['sandi']) ? password_hash($_POST['sandi'], PASSWORD_DEFAULT) : null;

// Handle file upload
$foto_user = $_SESSION['login']['foto_user']; // Default ke foto lama

if ($_FILES['foto_user']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "../uploads/profiles/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    
    // Hapus foto lama jika ada dan bukan default
    if (!empty($foto_user) && strpos($foto_user, 'logo amanah') === false) {
        @unlink($foto_user);
    }
    
    $file_ext = pathinfo($_FILES['foto_user']['name'], PATHINFO_EXTENSION);
    $new_filename = 'profile_' . $id_user . '_' . time() . '.' . $file_ext;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($_FILES['foto_user']['tmp_name'], $target_file)) {
        $foto_user = $target_file;
    }
}

// Query update
$query = "UPDATE users SET 
          nama_user = '$nama_user',
          email = '$email',
          no_telepon = '$no_telepon',
          foto_user = '$foto_user'";
          
if ($sandi) {
    $query .= ", sandi = '$sandi'";
}

$query .= " WHERE id_user = '$id_user'";

$result = mysqli_query($connection, $query);

if ($result) {
    // Update session
    $_SESSION['login']['nama_user'] = $nama_user;
    $_SESSION['login']['email'] = $email;
    $_SESSION['login']['foto_user'] = $foto_user;
    
    $_SESSION['info'] = [
        'status' => 'success',
        'message' => 'Profil berhasil diperbarui'
    ];
} else {
    $_SESSION['info'] = [
        'status' => 'error',
        'message' => 'Gagal memperbarui profil: ' . mysqli_error($connection)
    ];
}

header('Location: ./index.php');
exit;
?>