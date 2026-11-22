<?php
session_start();
require_once '../db.php'; 

// Güvenlik Kontrolü
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

$mesaj = '';

// Form gönderildiğinde çalışacak ana blok
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brand     = $_POST['brand'];
    $model     = $_POST['model'];
    $year      = $_POST['year'];
    $km        = $_POST['km'];
    $price     = str_replace(['.', ','], '', $_POST['price']); // Fiyattaki noktaları temizler
    $category  = $_POST['category'];

    // --- DOSYA YÜKLEME SİSTEMİ ---
    $target_dir = "../assets/img/cars/"; 
    
    // Klasör yoksa oluştur (Hata almamak için)
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_extension = strtolower(pathinfo($_FILES["image_file"]["name"], PATHINFO_EXTENSION));
    $file_name = time() . '_' . uniqid() . '.' . $file_extension; // Benzersiz isim
    $target_file = $target_dir . $file_name;

    // Resim kontrolü
    $check = getimagesize($_FILES["image_file"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image_file"]["tmp_name"], $target_file)) {
            // DB'ye kaydedilecek yol (Site ön yüzünde çalışması için)
            $db_image_path = "assets/img/cars/" . $file_name;

            $sql = "INSERT INTO cars (brand, model, year, km, price, category, image_url) 
                    VALUES (:brand, :model, :year, :km, :price, :category, :image_url)";
            
            $stmt = $pdo->prepare($sql);
            try {
                $stmt->execute([
                    ':brand'     => $brand,
                    ':model'     => $model,
                    ':year'      => $year,
                    ':km'        => $km,
                    ':price'     => $price,
                    ':category'  => $category,
                    ':image_url' => $db_image_path
                ]);
                $mesaj = "<div class='alert success'><i class='fa-solid fa-check-circle'></i> Araç ve Görsel Başarıyla Sisteme İşlendi!</div>";
            } catch(PDOException $e) {
                $mesaj = "<div class='alert error'>Veritabanı Hatası: " . $e->getMessage() . "</div>";
            }
        } else {
            $mesaj = "<div class='alert error'>Dosya sunucuya taşınırken hata oluştu.</div>";
        }
    } else {
        $mesaj = "<div class='alert error'>Lütfen geçerli bir resim dosyası (JPG, PNG, WEBP) seçin.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VIP Araç Yönetimi | KRC CARS</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --krc-red: #e30613; --dark-bg: #0a0a0a; --input-bg: #151515; --border: rgba(255,255,255,0.1); }
        body { background: var(--dark-bg); color: #fff; font-family: 'Montserrat', sans-serif; margin: 0; padding: 0; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: #000; height: 100vh; position: fixed; padding: 40px 25px; border-right: 1px solid var(--border); box-sizing: border-box; z-index: 100; }
        .sidebar h2 { color: var(--krc-red); margin-bottom: 50px; font-weight: 900; font-size: 24px; letter-spacing: -1px; }
        .sidebar a { display: flex; align-items: center; gap: 15px; color: #888; text-decoration: none; padding: 16px 0; border-bottom: 1px solid rgba(255,255,255,0.03); transition: 0.3s; font-weight: 600; font-size: 14px; }
        .sidebar a:hover { color: #fff; padding-left: 8px; border-color: var(--krc-red); }

        /* Form Alanı */
        .content { margin-left: 260px; padding: 50px; display: flex; justify-content: center; }
        .form-container { background: #111; padding: 40px; border-radius: 12px; border: 1px solid var(--border); width: 100%; max-width: 800px; box-shadow: 0 20px 40px rgba(0,0,0,0.4); }
        .form-container h1 { font-size: 28px; font-weight: 900; margin-bottom: 10px; text-align: center; }
        .form-subtitle { text-align: center; color: #666; font-size: 11px; margin-bottom: 40px; text-transform: uppercase; letter-spacing: 2px; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .full-width { grid-column: span 2; }

        .form-group { margin-bottom: 10px; }
        label { display: block; font-size: 10px; font-weight: 800; color: #888; text-transform: uppercase; letter-spacing: 1.5px; margin-bottom: 10px; }
        
        input, select { 
            width: 100%; padding: 16px; background: var(--input-bg); border: 1px solid var(--border); 
            color: #fff; border-radius: 6px; outline: none; font-family: 'Montserrat', sans-serif; 
            font-size: 14px; transition: 0.3s; box-sizing: border-box;
        }
        input:focus, select:focus { border-color: var(--krc-red); background: #1a1a1a; box-shadow: 0 0 15px rgba(227, 6, 19, 0.1); }

        /* Dosya Yükleme Alanı Özel */
        input[type="file"] { padding: 12px; background: #000; cursor: pointer; border: 1px dashed var(--border); }
        input[type="file"]:hover { border-color: var(--krc-red); }

        .btn-submit { 
            width: 100%; background: var(--krc-red); color: #fff; padding: 18px; border: none; 
            border-radius: 6px; font-weight: 900; font-size: 15px; letter-spacing: 1px; 
            cursor: pointer; transition: 0.4s; margin-top: 20px;
        }
        .btn-submit:hover { background: #ff0000; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(227, 6, 19, 0.3); }

        .alert { padding: 20px; border-radius: 6px; margin-bottom: 30px; font-weight: 700; font-size: 14px; text-align: center; }
        .alert.success { background: rgba(46, 204, 113, 0.1); border: 1px solid #2ecc71; color: #2ecc71; }
        .alert.error { background: rgba(231, 76, 60, 0.1); border: 1px solid #e74c3c; color: #e74c3c; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>KRC ADMIN</h2>
        <a href="admin_panel.php"><i class="fa-solid fa-layer-group"></i> Envanter</a>
        <a href="admin_ekle.php" style="color: #fff; border-color: var(--krc-red);"><i class="fa-solid fa-circle-plus"></i> Araç Ekle</a>
        <a href="../index.php" target="_blank"><i class="fa-solid fa-house"></i> Siteye Git</a>
        <a href="logout.php" style="color: #e30613; margin-top: 50px; border: none;"><i class="fa-solid fa-power-off"></i> Güvenli Çıkış</a>
    </div>

    <div class="content">
        <div class="form-container">
            <h1>YENİ İLAN OLUŞTUR</h1>
            <div class="form-subtitle">Envantere Yeni Varlık Ekleme Paneli</div>
            
            <?php echo $mesaj; ?>

            <form action="admin_ekle.php" method="POST" enctype="multipart/form-data">
                <div class="form-grid">
                    <div class="form-group">
                        <label>MARKA / ÜRETİCİ</label>
                        <input type="text" name="brand" placeholder="Örn: LAMBORGHINI" required>
                    </div>
                    <div class="form-group">
                        <label>MODEL / SERİ</label>
                        <input type="text" name="model" placeholder="Örn: Aventador SVJ" required>
                    </div>
                    <div class="form-group">
                        <label>MODEL YILI</label>
                        <input type="number" name="year" placeholder="2025" required>
                    </div>
                    <div class="form-group">
                        <label>KİLOMETRE / DURUM</label>
                        <input type="text" name="km" placeholder="Örn: 0 KM" required>
                    </div>
                    <div class="form-group">
                        <label>SATIŞ FİYATI</label>
                        <input type="text" name="price" placeholder="Örn: 10.500.000" required>
                    </div>
                    <div class="form-group">
                        <label>ENVANTER KATEGORİSİ</label>
                        <select name="category" required>
                            <option value="">Kategori Seçiniz...</option>
                            <option value="suv">SUV Araçlar</option>
                            <option value="sedan">Sedan Araçlar</option>
                            <option value="cabrio">Cabrio / Üstü Açık</option>
                            <option value="sports">Sports / Süper Spor</option>
                            <option value="yacht">Deniz Araçları / Yat</option>
                            <option value="helicopter">Hava Araçları / Helikopter</option>
                            <option value="showcase">Vitrin Araçlar (Ana Sayfa)</option>
                            <option value="special_collection">Özel Koleksiyon</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label>ARAÇ GÖRSELİ (PC/Telefondan Seçin)</label>
                        <input type="file" name="image_file" accept="image/*" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-submit">SİSTEME KAYDET VE YAYINLA</button>
            </form>
        </div>
    </div>

</body>
</html>