<?php
require 'config.php';
if (!is_admin()) {
    header('Location: index.php');
    exit;
}

$pesan = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto'])) {
    $namaFile = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $tipe = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
    
    if (!in_array($tipe, ['jpg','jpeg','png'])) {
        $pesan = '❌ Hanya file JPG, JPEG, PNG yang diperbolehkan!';
    } else {
        $namaBaru = 'Foto ' . (TOTAL_FOTO + 1) . '.' . $tipe;
        $tujuan = 'Foto/' . $namaBaru;
        if (move_uploaded_file($tmp, $tujuan)) {
            $pesan = "✅ Foto berhasil diupload sebagai: <strong>$namaBaru</strong><br>Ubah TOTAL_FOTO di config.php agar muncul di galeri!";
        } else {
            $pesan = '❌ Gagal menyimpan foto! Pastikan folder Foto bisa ditulis.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Foto — RPL 3</title>
<style>
*{margin:0;padding:0;box-sizing:border-box}
body{font-family:Arial,sans-serif;background:#f5f7fb;padding:30px;max-width:600px;margin:auto}
h1{color:#2563eb;margin-bottom:25px}
a{color:#2563eb;text-decoration:none;display:inline-block;margin-bottom:20px}
.card{background:#fff;padding:30px;border-radius:15px;box-shadow:0 5px 20px rgba(0,0,0,.07)}
.form-group{margin-bottom:20px}
label{display:block;margin-bottom:8px;font-weight:bold}
input[type=file]{padding:10px}
button{
    background:#2563eb;color:#fff;border:0;padding:12px 25px;
    border-radius:8px;font-size:16px;font-weight:bold;cursor:pointer;
}
button:hover{background:#1d4ed8}
.pesan{margin-top:20px;padding:15px;border-radius:8px;background:#f0fdf4;color:#166534}
</style>
</head>
<body>
<a href="index.php">← Kembali ke Galeri</a>
<div class="card">
    <h1>📤 Upload Foto Baru</h1>
    <?php if ($pesan): ?><div class="pesan"><?= $pesan ?></div><?php endif ?>
    <form method="post" enctype="multipart/form-data" style="margin-top:20px">
        <div class="form-group">
            <label>Pilih File Foto</label>
            <input type="file" name="foto" accept=".jpg,.jpeg,.png" required>
        </div>
        <button type="submit">Upload Foto</button>
    </form>
    <p style="margin-top:15px;color:#666;font-size:14px">
        Catatan: Setelah upload, ubah angka <code>TOTAL_FOTO</code> di <code>config.php</code> agar foto baru muncul.
    </p>
</div>
</body>
</html>
