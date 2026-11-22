<?php
/**
 * KRC CARS - Şifre Sıfırlama ve Tamir Sihirbazı
 * Bu dosya admin şifresini "12345" olarak günceller.
 */

// db.php'nin yolunu kontrol et. Eğer admin klasöründeyse 'db.php', 
// ama admin klasörünün içindeki bir dosyadaysan ve db.php dışarıdaysa '../db.php' yap.
require_once '../db.php'; 

echo "<body style='background:#050505; color:#fff; font-family:sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; margin:0;'>";
echo "<div style='background:#111; padding:40px; border:1px solid #333; border-radius:8px; text-align:center; max-width:500px;'>";

try {
    // 1. Şifreyi güvenli hale getiriyoruz
    $yeni_sifre = '12345';
    $kriptolu_sifre = password_hash($yeni_sifre, PASSWORD_DEFAULT);

    // 2. Önce mevcut tüm adminleri temizleyelim (Çakışma olmasın)
    $pdo->query("TRUNCATE TABLE admins");

    // 3. Yeni admini temiz bir şekilde ekleyelim
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES ('admin', ?)");
    $stmt->execute([$kriptolu_sifre]);

    echo "<h2 style='color:#2ecc71; margin-bottom:20px;'>SİSTEM TAMİR EDİLDİ!</h2>";
    echo "<p style='color:#aaa; line-height:1.6;'>Artık aşağıdaki bilgilerle giriş yapabilirsin:</p>";
    echo "<div style='background:#000; padding:15px; margin:20px 0; border:1px solid #e30613; font-family:monospace; font-size:18px;'>";
    echo "Kullanıcı Adı: <span style='color:#fff;'>admin</span><br>";
    echo "Şifre: <span style='color:#fff;'>12345</span>";
    echo "</div>";
    echo "<a href='login.php' style='display:inline-block; background:#e30613; color:#fff; padding:12px 25px; text-decoration:none; font-weight:bold; border-radius:4px;'>GİRİŞ SAYFASINA GİT</a>";

} catch (PDOException $e) {
    echo "<h2 style='color:#e30613;'>BİR HATA OLUŞTU!</h2>";
    echo "<p>Hata Mesajı: " . $e->getMessage() . "</p>";
    echo "<p style='font-size:12px; color:#555;'>Not: Veritabanı tablonun 'admins' olduğundan ve sütun isimlerinin (username, password) doğru olduğundan emin ol.</p>";
}

echo "</div></body>";
?>