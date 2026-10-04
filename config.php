<?php
session_start();

// DATA LOGIN — PAKAI SPASI SESUAI ASLINYA
define('MEMBER_USER', 'Rpl 3');
define('MEMBER_PASS', 'Rpl 3');
define('ADMIN_USER', 'adminRpl 3');
define('ADMIN_PASS', 'Rpl 3');

// JUMLAH FOTO
define('TOTAL_FOTO', 65);

// FUNGSI CEK LOGIN
function is_login() {
    return isset($_SESSION['role']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function butuh_login() {
    if (!is_login()) {
        header('Location: login.php');
        exit;
    }
}
?>
