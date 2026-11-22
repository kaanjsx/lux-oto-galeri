<?php
// Admin klasöründe olduğumuz için bir üst klasördeki db.php'yi çağırıyoruz
require_once '../db.php';

// Güvenlik: Giriş yapılmadıysa login'e at
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

// Silme İşlemi Başarılı Mesajı İçin
$mesaj = "";
if(isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $stmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
    if($stmt->execute([$id])) {
        header("Location: admin_panel.php?durum=silindi");
        exit;
    }
}

if(isset($_GET['durum']) && $_GET['durum'] == 'silindi') {
    $mesaj = "<div class='alert success'>Araç başarıyla sistemden kaldırıldı.</div>";
}

// Tüm Araçları Çek
$stmt = $pdo->query("SELECT * FROM cars ORDER BY id DESC");
$arabalar = $stmt->fetchAll();

// Kategori İsimlerini Güzelleştirme Fonksiyonu
function kategoriYaz($key) {
    $liste = [
        'special_collection' => 'Özel Koleksiyon',
        'showcase' => 'Vitrin Araçlar',
        'suv' => 'Lüks SUV',
        'sedan' => 'Sedan Serisi',
        'new_arrival' => 'Yeni Gelenler'
    ];
    return $liste[$key] ?? $key;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | KRC CARS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --krc-red: #e30613;
            --dark-bg: #0a0a0a;
            --sidebar-bg: #000;
            --border: rgba(255,255,255,0.08);
        }

        body { background: var(--dark-bg); color: #fff; font-family: 'Montserrat', sans-serif; margin: 0; padding: 0; }
        
        /* Sidebar Geliştirmeleri */
        .sidebar { width: 260px; background: var(--sidebar-bg); height: 100vh; position: fixed; padding: 40px 25px; border-right: 1px solid var(--border); box-sizing: border-box; }
        .sidebar h2 { color: var(--krc-red); margin-bottom: 50px; font-weight: 900; letter-spacing: -1px; font-size: 24px; }
        .sidebar a { display: flex; align-items: center; gap: 15px; color: #888; text-decoration: none; padding: 16px 0; border-bottom: 1px solid rgba(255,255,255,0.03); transition: 0.3s; font-weight: 600; font-size: 14px; }
        .sidebar a i { width: 20px; font-size: 18px; }
        .sidebar a:hover { color: #fff; padding-left: 8px; border-color: var(--krc-red); }
        .sidebar a.active { color: #fff; border-color: var(--krc-red); }

        /* İçerik Alanı */
        .content { margin-left: 260px; padding: 50px; min-height: 100vh; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .header h1 { font-size: 28px; font-weight: 800; letter-spacing: -1px; }
        
        .btn-add { background: var(--krc-red); color: #fff; padding: 12px 25px; text-decoration: none; border-radius: 4px; font-weight: 800; font-size: 13px; letter-spacing: 1px; transition: 0.3s; box-shadow: 0 4px 15px rgba(227, 6, 19, 0.2); }
        .btn-add:hover { background: #b0050f; transform: translateY(-2px); }

        /* Mesaj Kutuları */
        .alert { padding: 15px 20px; border-radius: 4px; margin-bottom: 30px; font-weight: 600; font-size: 14px; }
        .alert.success { background: rgba(46, 204, 113, 0.1); border: 1px solid #2ecc71; color: #2ecc71; }

        /* Tablo Tasarımı */
        .table-container { background: #111; border-radius: 8px; border: 1px solid var(--border); overflow: hidden; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #181818; color: #555; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; padding: 20px; text-align: left; border-bottom: 1px solid var(--border); }
        td { padding: 20px; font-size: 14px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.01); }

        td img { width: 100px; height: 65px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border); }
        .car-title { font-weight: 700; color: #fff; font-size: 16px; margin-bottom: 4px; display: block; }
        .car-model { color: #666; font-size: 12px; font-weight: 500; }
        .price-tag { font-weight: 800; color: #fff; font-size: 15px; }
        .category-badge { background: rgba(255,255,255,0.05); padding: 5px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; color: #aaa; border: 1px solid var(--border); }

        /* İşlem Butonları */
        .actions { display: flex; gap: 20px; }
        .btn-edit { color: #3498db; text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.3s; }
        .btn-edit:hover { color: #5dade2; }
        .btn-delete { color: var(--krc-red); text-decoration: none; font-weight: 700; font-size: 13px; transition: 0.3s; }
        .btn-delete:hover { opacity: 0.7; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>KRC ADMIN</h2>
        <a href="admin_panel.php" class="active"><i class="fa-solid fa-layer-group"></i> Envanter</a>
        <a href="admin_ekle.php"><i class="fa-solid fa-circle-plus"></i> Araç Ekle</a>
        <a href="../index.php" target="_blank"><i class="fa-solid fa-house"></i> Siteye Git</a>
        <a href="logout.php" style="color: #e30613; margin-top: 50px; border: none;"><i class="fa-solid fa-power-off"></i> Güvenli Çıkış</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>Araç Envanteri</h1>
            <a href="admin_ekle.php" class="btn-add">YENİ ARAÇ EKLE</a>
        </div>

        <?php echo $mesaj; ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Araç Detayı</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arabalar as $araba): ?>
                    <tr>
                        <td><img src="<?= htmlspecialchars($araba['image_url']) ?>" alt="Car"></td>
                        <td>
                            <span class="car-title"><?= htmlspecialchars($araba['brand']) ?></span>
                            <span class="car-model"><?= htmlspecialchars($araba['model']) ?> (<?= htmlspecialchars($araba['year'] ?? '2024') ?>)</span>
                        </td>
                        <td><span class="category-badge"><?= kategoriYaz($araba['category']) ?></span></td>
                        <td><span class="price-tag"><?= htmlspecialchars($araba['price']) ?></span></td>
                        <td>
                            <div class="actions">
                                <a href="admin_duzenle.php?id=<?= $araba['id'] ?>" class="btn-edit"><i class="fa-solid fa-pen-to-square"></i> DÜZENLE</a>
                                <a href="admin_panel.php?sil=<?= $araba['id'] ?>" class="btn-delete" onclick="return confirm('Bu araç kalıcı olarak silinecektir. Emin misiniz?');"><i class="fa-solid fa-trash-can"></i> SİL</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    
                    <?php if(empty($arabalar)): ?>
                    <tr>
                        <td colspan="5" style="text-align:center; padding: 60px; color: #555;">
                            <i class="fa-solid fa-car-rear" style="font-size: 40px; margin-bottom: 20px; display: block; opacity: 0.2;"></i>
                            Henüz kayıtlı araç bulunmuyor.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>