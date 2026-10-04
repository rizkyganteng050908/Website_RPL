<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    if ($user === ADMIN_USER && $pass === ADMIN_PASS) {
        $_SESSION['role'] = 'admin';
        $_SESSION['nama'] = '👑 Admin';
        header('Location: index.php');
        exit;
    }
    if ($user === MEMBER_USER && $pass === MEMBER_PASS) {
        $_SESSION['role'] = 'member';
        $_SESSION['nama'] = '👤 Member';
        header('Location: index.php');
        exit;
    }
    $error = '❌ Username atau password salah!';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — RPL 3</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
html,body{height:100%}
body{
    font-family:Arial,sans-serif;
    background:linear-gradient(135deg,#2563eb,#7c3aed);
    display:flex;align-items:center;justify-content:center;
    padding:20px;
}
.login-box{
    width:100%;max-width:400px;padding:35px 30px;
    background:#fff;border-radius:20px;
    box-shadow:0 20px 50px rgba(0,0,0,.25);text-align:center;
}
.logo{
    width:80px;height:80px;margin:0 auto 15px;
    border-radius:50%;background:#2563eb;color:#fff;
    font-size:28px;font-weight:bold;display:flex;align-items:center;justify-content:center;
}
h1{margin-bottom:8px;font-size:22px}
p.desc{margin-bottom:25px;color:#777}
.form-group{margin-bottom:15px;text-align:left}
label{display:block;margin-bottom:7px;font-weight:bold}
input{
    width:100%;padding:13px;border:1px solid #ddd;
    border-radius:10px;outline:none;font-size:15px;
}
input:focus{border-color:#2563eb}
button{
    width:100%;padding:13px;border:0;border-radius:10px;
    background:#2563eb;color:#fff;font-size:16px;font-weight:bold;
    cursor:pointer;transition:.2s;
}
button:hover{background:#1d4ed8}
.error{margin-top:15px;color:#dc2626}
</style>
</head>
<body>
<div class="login-box">
    <div class="logo">R3</div>
    <h1>RPL 3</h1>
    <p class="desc">Silakan login untuk masuk</p>
    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>
        <button type="submit">🔐 Login</button>
        <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif ?>
    </form>
</div>
</body>
</html>
