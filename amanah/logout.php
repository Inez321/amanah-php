<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi
header('Location: login.php');
exit; // Penting untuk menghentikan eksekusi script setelah header
?>