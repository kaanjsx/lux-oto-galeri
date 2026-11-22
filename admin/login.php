<?php
require_once '../db.php';

// Eğer zaten oturum açılmışsa direkt panele gönder
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    echo "<script>window.location.href = 'admin_panel.php';</script>";
    exit;
}

$hata = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim($_POST['username']);
    $pass = $_POST['password'];

    if(!empty($user) && !empty($pass)) {
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
        $stmt->execute([$user]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($pass, $admin['password'])) {
            // OTURUMU BAŞLAT
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $admin['username'];
            session_write_close(); // Oturumu diske yazmayı zorla

            // KESİN YÖNLENDİRME (JS)
            echo "<script>alert('Giriş Başarılı! Panele aktarılıyorsunuz.'); window.location.href = 'admin_panel.php';</script>";
            exit;
        } else {
            $hata = "Kullanıcı adı veya şifre hatalı!";
        }
    } else {
        $hata = "Lütfen boş alan bırakmayın!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>KRC CARS | LOGIN</title>
    <style>
        body { background: #050505; color: #fff; font-family: sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #111; padding: 40px; border-radius: 8px; border: 1px solid #333; width: 320px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        h2 { text-align: center; color: #e30613; margin-bottom: 25px; }
        input { width: 100%; padding: 12px; margin-bottom: 15px; background: #000; border: 1px solid #333; color: #fff; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #e30613; color: #fff; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { background: #b0050f; }
        .error { background: rgba(227, 6, 19, 0.2); color: #e30613; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center; font-size: 13px; border: 1px solid #e30613; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>KRC ADMIN</h2>
        <?php if($hata) echo "<div class='error'>$hata</div>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">SİSTEME GİRİŞ YAP</button>
        </form>
    </div>
</body>
</html>