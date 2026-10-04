<?php
session_start();

// Data Login
define('MEMBER_USER', 'Rpl3');
define('MEMBER_PASS', 'Rpl3');
define('ADMIN_USER', 'adminRpl3');
define('ADMIN_PASS', 'Rpl3');

// Jumlah foto tetap
define('TOTAL_FOTO', 65);

// Cek login
function is_login() {
    return isset($_SESSION['role']);
}

function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Redirect jika belum login
function butuh_login() {
    if (!is_login()) {
        header('Location: login.php');
        exit;
    }
}
?>
