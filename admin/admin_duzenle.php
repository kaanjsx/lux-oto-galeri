<?php
session_start();
require_once '../db.php';

// Güvenlik Kontrolü
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) { header("Location: admin_panel.php"); exit; }

$mesaj = '';

// Mevcut araç bilgilerini çek
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$id]);
$araba = $stmt->fetch();

if (!$araba) {
    die("Araç bulunamadı.");
}

// Güncelleme işlemi tetiklendiğinde
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand     = $_POST['brand'];
    $model     = $_POST['model'];
    $year      = $_POST['year'];
    $km        = $_POST['km'];
    $price     = str_replace(['.', ','], '', $_POST['price']);
    $category  = $_POST['category'];
    $image_url = $araba['image_url']; // Varsayılan olarak eski resmi tutuyoruz

    // Yeni bir resim yüklendi mi kontrol et
    if (!empty($_FILES["image_file"]["name"])) {
        $target_dir = "../assets/img/cars/";
        $file_extension = strtolower(pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION));
        $file_name = time() . '_' . uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            // Yeni resim yüklendi, eskisini sistemden silelim (dosya varsa)
            if (file_exists("../" . $araba['image_url']) && !empty($araba['image_url'])) {
                unlink("../" . $araba['image_url']);
            }
            $image_url = "assets/img/cars/" . $file_name;
        }
    }

    $sql = "UPDATE cars SET brand=?, model=?, year=?, km=?, price=?, category=?, image_url=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    
    try {
        $stmt->execute([
            $brand, $model, $year, $km, $price, $category, $image_url, $id
        ]);
        header("Location: admin_panel.php?durum=guncellendi");
        exit;
    } catch(PDOException $e) {
        $mesaj = "<div class='alert error'>Hata: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>İlanı Düzenle | KRC CARS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --krc-red: #e30613; --dark-bg: #0a0a0a; --border: rgba(255,255,255,0.1); }
        body { background: var(--dark-bg); color: #fff; font-family: 'Montserrat', sans-serif; display: flex; justify-content: center; padding: 40px 20px; }
        .admin-box { background: #111; padding: 40px; border-radius: 12px; border: 1px solid var(--border); width: 100%; max-width: 700px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
        h2 { text-align: center; color: var(--krc-red); margin-bottom: 30px; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; }
        
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full-width { grid-column: span 2; }
        
        label { display: block; margin-bottom: 8px; font-size: 11px; font-weight: 700; color: #666; text-transform: uppercase; }
        input, select { width: 100%; padding: 14px; background: #050505; border: 1px solid var(--border); color: #fff; margin-bottom: 5px; border-radius: 6px; box-sizing: border-box; outline: none; }
        input:focus, select:focus { border-color: var(--krc-red); }
        
        .current-img-preview { margin: 15px 0; padding: 10px; background: #000; border-radius: 6px; text-align: center; border: 1px solid #222; }
        .current-img-preview img { max-height: 150px; border-radius: 4px; }
        
        button { width: 100%; background: var(--krc-red); color: #fff; padding: 18px; border: none; font-weight: 800; cursor: pointer; border-radius: 6px; transition: 0.3s; margin-top: 20px; }
        button:hover { background: #ff0000; transform: translateY(-2px); }
        
        .back-link { display: block; text-align: center; margin-top: 20px; color: #888; text-decoration: none; font-size: 13px; font-weight: 600; }
        .alert { padding: 15px; border-radius: 6px; margin-bottom: 20px; text-align: center; background: rgba(231, 76, 60, 0.1); border: 1px solid #e74c3c; color: #e74c3c; }
    </style>
</head>
<body>
    <div class="admin-box">
        <h2>İLANIDÜZENLE</h2>
        <?php echo $mesaj; ?>
        
        <form method="POST" enctype="multipart/form-data">
            <div class="form-grid">
                <div class="form-group">
                    <label>MARKA</label>
                    <input type="text" name="brand" value="<?= htmlspecialchars($araba['brand']) ?>" required>
                </div>
                <div class="form-group">
                    <label>MODEL</label>
                    <input type="text" name="model" value="<?= htmlspecialchars($araba['model']) ?>" required>
                </div>
                <div class="form-group">
                    <label>MODEL YILI</label>
                    <input type="number" name="year" value="<?= htmlspecialchars($araba['year'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label>KİLOMETRE</label>
                    <input type="text" name="km" value="<?= htmlspecialchars($araba['km'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label>FİYAT</label>
                    <input type="text" name="price" value="<?= htmlspecialchars($araba['price']) ?>" required>
                </div>
                <div class="form-group">
                    <label>KATEGORİ</label>
                    <select name="category" required>
                        <option value="suv" <?= $araba['category'] == 'suv' ? 'selected' : '' ?>>SUV Araçlar</option>
                        <option value="sedan" <?= $araba['category'] == 'sedan' ? 'selected' : '' ?>>Sedan Araçlar</option>
                        <option value="cabrio" <?= $araba['category'] == 'cabrio' ? 'selected' : '' ?>>Cabrio / Üstü Açık</option>
                        <option value="sports" <?= $araba['category'] == 'sports' ? 'selected' : '' ?>>Sports / Süper Spor</option>
                        <option value="yacht" <?= $araba['category'] == 'yacht' ? 'selected' : '' ?>>Deniz Araçları / Yat</option>
                        <option value="helicopter" <?= $araba['category'] == 'helicopter' ? 'selected' : '' ?>>Hava Araçları / Helikopter</option>
                        <option value="showcase" <?= $araba['category'] == 'showcase' ? 'selected' : '' ?>>Vitrin Araçlar</option>
                        <option value="special_collection" <?= $araba['category'] == 'special_collection' ? 'selected' : '' ?>>Özel Koleksiyon</option>
                    </select>
                </div>
                
                <div class="form-group full-width">
                    <label>MEVCUT GÖRSEL</label>
                    <div class="current-img-preview">
                        <img src="../<?= htmlspecialchars($araba['image_url']) ?>" alt="Mevcut">
                    </div>
                    
                    <label>GÖRSELİ DEĞİŞTİR (Boş bırakırsanız aynı kalır)</label>
                    <input type="file" name="image_file" accept="image/*">
                </div>
            </div>
            
            <button type="submit">DEĞİŞİKLİKLERİ KAYDET</button>
            <a href="admin_panel.php" class="back-link"><i class="fa-solid fa-arrow-left"></i> İptal Et ve Geri Dön</a>
        </form>
    </div>
</body>
</html>