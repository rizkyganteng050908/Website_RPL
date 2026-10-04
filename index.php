<?php
session_start();

// Pengaturan login
$valid_user = "Rpl 3";
$valid_pass = "Rpl 3";

$error = "";

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === $valid_user && $password === $valid_pass) {
        $_SESSION['logged_in'] = true;
        header("Location: ?page=beranda");
        exit;
    } else {
        $error = "❌ Username atau Password salah!";
    }
}

// Logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Khusus RPL</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', sans-serif; }
        body { background: linear-gradient(135deg, #1e3a8a, #3b82f6); min-height: 100vh; }

        /* Halaman Login */
        .login-container {
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; padding: 20px;
        }
        .login-box {
            background: white; padding: 40px 30px; border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); width: 100%; max-width: 400px;
            text-align: center;
        }
        .login-box h2 { color: #1e3a8a; margin-bottom: 10px; }
        .login-box p { color: #64748b; margin-bottom: 25px; }
        .login-box img {
            width: 120px; height: 120px; border-radius: 50%;
            object-fit: cover; margin-bottom: 20px; border: 3px solid #3b82f6;
        }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label {
            display: block; margin-bottom: 6px; color: #334155; font-weight: 600;
        }
        .form-group input {
            width: 100%; padding: 12px; border: 2px solid #e2e8f0;
            border-radius: 8px; font-size: 16px;
        }
        .form-group input:focus { outline: none; border-color: #3b82f6; }
        .btn {
            width: 100%; padding: 13px; background: #1e3a8a; color: white;
            border: none; border-radius: 8px; font-size: 16px; font-weight: bold;
            cursor: pointer; transition: 0.3s;
        }
        .btn:hover { background: #2563eb; }
        .error { color: #dc2626; margin-bottom: 15px; font-weight: 500; }

        /* Halaman Utama */
        .navbar {
            background: white; padding: 15px 30px; display: flex;
            justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .navbar h1 { color: #1e3a8a; font-size: 22px; }
        .navbar a {
            color: #ef4444; text-decoration: none; font-weight: bold;
            padding: 8px 20px; border: 2px solid #ef4444; border-radius: 8px;
            transition: 0.3s;
        }
        .navbar a:hover { background: #ef4444; color: white; }
        .content { padding: 40px 30px; max-width: 1200px; margin: 0 auto; }
        .hero {
            background: white; border-radius: 16px; padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1); text-align: center;
        }
        .hero img {
            max-width: 100%; border-radius: 12px; margin: 20px 0;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .hero h2 { color: #1e3a8a; margin-bottom: 15px; }
        .hero p { color: #47556b; font-size: 17px; line-height: 1.7; }
        .gallery {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px; margin-top: 30px;
        }
        .gallery-card {
            background: white; border-radius: 12px; overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .gallery-card img { width: 100%; height: 180px; object-fit: cover; }
        .gallery-card h3 { padding: 15px; color: #1e3a8a; font-size: 16px; }
    </style>
</head>
<body>

<?php if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true): ?>
    <!-- Halaman Login -->
    <div class="login-container">
        <div class="login-box">
            <img src="https://picsum.photos/id/180/300/300" alt="Logo RPL">
            <h2>🔐 Login RPL</h2>
            <p>Silakan masuk untuk mengakses website</p>
            <?php if ($error): ?><div class="error"><?= $error ?></div><?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" required placeholder="Masukkan Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Masukkan Password">
                </div>
                <button type="submit" class="btn">Masuk</button>
            </form>
        </div>
    </div>
<?php else: ?>
    <!-- Halaman Setelah Login -->
    <nav class="navbar">
        <h1>💻 Website Khusus RPL</h1>
        <a href="?action=logout">Keluar</a>
    </nav>

    <div class="content">
        <div class="hero">
            <h2>Selamat Datang di Website RPL 3 🎉</h2>
            <p>Website ini dibuat khusus untuk kelas RPL 3. Semangat belajar pemrograman dan wujudkan impianmu menjadi programmer hebat!</p>
            <img src="https://picsum.photos/id/0/800/400" alt="Foto RPL">
        </div>

        <div class="gallery">
            <div class="gallery-card">
                <img src="https://picsum.photos/id/48/400/300" alt="Belajar Koding">
                <h3>💻 Belajar Pemrograman</h3>
            </div>
            <div class="gallery-card">
                <img src="https://picsum.photos/id/20/400/300" alt="Kerja Sama">
                <h3>🤝 Kerja Sama Tim</h3>
            </div>
            <div class="gallery-card">
                <img src="https://picsum.photos/id/160/400/300" alt="Kreativitas">
                <h3>✨ Kreativitas Tanpa Batas</h3>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
