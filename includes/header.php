<?php 
// db.php'yi burada dahil ediyoruz ki tüm sayfalarda veritabanı hazır olsun
require_once 'db.php'; 

function getCarsByCategory($pdo, $category) {
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE category = ? ORDER BY id DESC");
    $stmt->execute([$category]);
    return $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRC CARS | The Ultimate Luxury</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Tenor+Sans&family=Montserrat:wght@300;400;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 1000, // Animasyon hızı (1 saniye)
    once: true,      // Sadece sayfa açıldığında bir kez çalışsın
    offset: 0       // Animasyonun başlaması için mesafe
  });
</script>
    <header>
        <div class="container navbar">
            <div class="logo">
                <a href="index.php"><span class="krc">KRC</span><span class="cars">CARS</span></a>
            </div>
            <nav>
                <ul class="nav-links">
                    <li><a href="index.php">ANASAYFA</a></li>
                    <li><a href="araclarimiz.php">TÜM ARAÇLAR</a></li>
                    <li><a href="galeri.php">GALERİ</a></li>
                    <li><a href="hakkimizda.php">HAKKIMIZDA</a></li>
                    <li><a href="iletisim.php">İLETİŞİM</a></li>
                </ul>
            </nav>
            <div class="header-right">
                <a href="admin/login.php" class="vip-btn">ADMIN PANEL</a>
            </div>
        </div>
    </header>