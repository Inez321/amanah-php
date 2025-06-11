<?php
session_start();

if (isset($_SESSION['login'])) {
    $level_user = $_SESSION['login']['level_user'];
    if ($level_user === 'Penjual') {
        header('Location: _layout/index.php');
        exit; 
    } elseif ($level_user === 'Pembeli') {
        header('Location: layout/index.php'); 
        exit; 
    } else {
        header('Location: ./login.php');
        exit;
    }
} else {
    header('Location: ./login.php');
    exit;
}
?>