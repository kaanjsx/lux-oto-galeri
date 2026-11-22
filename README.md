# lux-oto-galeri

<img width="1711" height="941" alt="image" src="https://github.com/user-attachments/assets/28acb5d0-a12a-44d4-b03e-1f4481e09c36" />

====================================================================
KRC CARS | LUXURY AUTOMOTIVE & PORTFOLIO MANAGEMENT SYSTEM
====================================================================

[TÜRKÇE]

KRC CARS, lüks otomotiv, süper spor araçlar, yat ve helikopter portföylerinin sergilenmesi ve yönetimi için geliştirilmiş, modern, hızlı ve tam mobil uyumlu (responsive) bir web platformudur.

ÖNE ÇIKAN ÖZELLİKLER:
* VIP & Lüks Tasarım: Siyah ve KRC Kırmızısı (#e30613) ağırlıklı, AOS kaydırma animasyonlarıyla desteklenmiş yüksek prestijli arayüz.
* Çoklu Dil Desteği (TR / EN): PHP Session tabanlı, sayfa yenileme hızını etkilemeyen anlık Türkçe ve İngilizce dil geçişi.
* Gelişmiş Yönetim Paneli (Admin): 
  - Güvenli (Bcrypt şifreli) oturum yönetimi.
  - Bilgisayar ve mobil cihazlardan doğrudan dosya yükleme (JPG, PNG, WEBP) ve otomatik sunucu temizliği (güncelleme/silme işlemlerinde eski görsellerin otomatik silinmesi).
  - Dinamik kategori yönetimi (SUV, Sedan, Cabrio, Sports, Yat, Helikopter, Vitrin, Özel Koleksiyon).
* Tam Mobil Uyumluluk: Mobil cihazlar için özel geliştirilmiş tam ekran açılır Hamburger Menü ve esnek kart yapıları.

KULLANILAN TEKNOLOJİLER:
* Backend: PHP 8+ (PDO Güvenli Veritabanı Mimarisi)
* Veritabanı: MySQL / MariaDB
* Frontend: HTML5, CSS3 (Custom Properties & Flexbox/Grid), Vanilla JavaScript
* Kütüphaneler: AOS (Animate On Scroll), FontAwesome 6, Google Fonts (Montserrat & Tenor Sans)

KURULUM VE YAYINA ALMA (DEPLOYMENT):
1. Dosyaları Yükleyin: Proje dosyalarını sunucunuzun ana dizinine (public_html veya www) aktarın.
2. Veritabanını Oluşturun: Hosting panelinizden (cPanel/DirectAdmin) bir MySQL veritabanı ve kullanıcısı oluşturun. phpMyAdmin üzerinden cars tablosunu içe aktarın (Import).
3. Bağlantı Ayarları: db.php dosyasını açarak sunucu bilgilerinizi girin:
   $host = 'localhost';
   $dbname = 'veritabani_adiniz';
   $username = 'kullanici_adiniz';
   $password = 'sifreniz';
4. Klasör İzinleri: Görsel yükleme sisteminin sorunsuz çalışması için assets/img/cars/ klasörünün yazma izinlerini (CHMOD) 755 veya 777 olarak ayarlayın.


====================================================================

[ENGLISH]

KRC CARS is a modern, fast, and fully responsive web platform engineered for showcasing and managing luxury automotive, supercar, yacht, and helicopter inventories.

KEY FEATURES:
* VIP & Luxury UI/UX: High-prestige interface dominated by deep black and KRC Red (#e30613), enhanced with AOS scroll animations.
* Bilingual Support (TR / EN): Lightweight PHP Session-based instant switching between Turkish and English.
* Advanced Admin Dashboard:
  - Secure authentication system with Bcrypt password hashing.
  - Direct image uploading from desktop and mobile devices (JPG, PNG, WEBP) with automated storage cleanup (old images are automatically unlinked upon update/deletion).
  - Dynamic category filtering (SUV, Sedan, Cabrio, Sports, Yacht, Helicopter, Showcase, Special Collection).
* Mobile-First Responsive Design: Custom full-screen mobile Hamburger Menu and adaptive grid layouts.

TECH STACK:
* Backend: PHP 8+ (PDO Prepared Statements)
* Database: MySQL / MariaDB
* Frontend: HTML5, CSS3 (Custom Variables, Flexbox & Grid), Vanilla JavaScript
* Libraries: AOS (Animate On Scroll), FontAwesome 6, Google Fonts (Montserrat & Tenor Sans)

INSTALLATION & DEPLOYMENT:
1. Upload Files: Upload all project files to your server's root directory (public_html or www).
2. Database Setup: Create a MySQL database and user via your hosting control panel (cPanel/DirectAdmin). Import the cars SQL table via phpMyAdmin.
3. Configuration: Open db.php and update your database credentials:
   $host = 'localhost';
   $dbname = 'your_database_name';
   $username = 'your_username';
   $password = 'your_password';
4. Directory Permissions: Ensure the assets/img/cars/ directory has proper write permissions (755 or 777 CHMOD) for seamless vehicle image uploads.

====================================================================
Developed for KRC Group — Luxury Automotive, Construction & Textiles.
====================================================================
