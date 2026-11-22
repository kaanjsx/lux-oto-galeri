

https://github.com/user-attachments/assets/2b35494b-f2c4-4d57-8535-9fa82cd6c92c



https://github.com/user-attachments/assets/978a6677-1173-4707-883b-01ef1fc4b997


# 🏎️ KRC CARS - Lüks Otomotiv & Portföy Yönetim Sistemi / Luxury Automotive & Portfolio Management System

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-RDBMS-4479A1?style=for-the-badge&logo=mysql&logoColor=white) ![CSS3](https://img.shields.io/badge/CSS3-Responsive_UI-1572B6?style=for-the-badge&logo=css3&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) ![Security](https://img.shields.io/badge/Security-PDO%20%7C%20Bcrypt%20%7C%20Session-red?style=for-the-badge) ![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

[🇹🇷 Türkçe](#-türkçe) | [🇬🇧 English](#-english)

---

## 🇹🇷 Türkçe

**KRC CARS**, lüks otomotiv, süper spor araçlar, yat ve helikopter portföylerinin yüksek prestij standartlarında sergilenmesi ve dinamik olarak yönetilmesi amacıyla geliştirilmiş modern bir web otomasyon ve vitrin sistemidir.

Sistem; ziyaretçilere VIP bir showroom deneyimi sunarken, yönetim paneli üzerinden araç envanterinin, medya dosyalarının ve kategori akışının tek bir merkezden sıfır eforla yönetilmesini sağlar.

### 📸 Uygulama Arayüzleri ve Ekran Görüntüleri

Projede derin siyah ve KRC Kırmızısı (`#e30613`) renk paleti, cam efektleri ve AOS (Animate On Scroll) kaydırma animasyonları kullanılarak yüksek UI/UX standartları sağlanmıştır.

| **Ana Sayfa & VIP Vitrin** | **Dinamik Araç Envanteri** |
| --- | --- |
| ![Ana Sayfa](https://github.com/user-attachments/assets/28acb5d0-a12a-44d4-b03e-1f4481e09c36) | ![Araçlar](screenshot/cars.png) |
| **Admin Kontrol Paneli** | **Mobil Hamburger Menü** |
| ![Admin Panel](screenshot/admin.png) | ![Mobil Arayüz](screenshot/mobile.png) |

### 🌟 Öne Çıkan Özellikler

#### 🖥️ VIP Vitrin & Kullanıcı Arayüzü
- Lüks otomobil, süper spor, SUV, yat ve helikopter kategorilerine göre anlık dinamik listeleme
- **AOS (Animate On Scroll)** entegrasyonu ile akıcı sayfa geçişleri ve etkileşimli araç kartları
- Ziyaretçilerin tek tıkla doğrudan satış danışmanlarına ulaşmasını sağlayan hızlı iletişim entegrasyonu

#### 🌐 Çoklu Dil Desteği (TR / EN)
- Harici çeviri API'lerine ihtiyaç duymadan doğrudan sunucu oturumu (**PHP Session**) üzerinden çalışan sıfır gecikmeli **Türkçe / İngilizce** dil motoru
- Sağ üst köşedeki `TR | EN` anahtarı ile tüm navigasyon, kurumsal metinler ve arayüz etiketlerinin anlık güncellenmesi

#### 🛠️ Gelişmiş Yönetim Paneli (Admin Dashboard)
- Yöneticilerin yeni araç ekleyebildiği, mevcut araçların fiyat/kilometre/durum bilgilerini güncelleyebildiği ve envanterden kaldırabildiği kontrol merkezi
- **Doğrudan Medya Yükleme Motoru:** URL yapıştırma zahmetini ortadan kaldıran; hem masaüstü hem de mobil cihazlardan doğrudan `JPG`, `PNG` ve `WEBP` formatında görsel yükleme desteği
- **Otomatik Depolama Temizliği:** Bir araç güncellendiğinde veya silindiğinde, sunucuda gereksiz yer kaplamaması için eski görsel dosyaları `unlink()` fonksiyonu ile fiziksel olarak temizlenir

#### 📱 Mobil Uyumlu (Responsive) Tasarım
- Mobil cihazlar için özel geliştirilmiş, animasyonlu ve tam ekran açılan **Hamburger Menü**
- CSS3 Flexbox, Grid ve Media Query kuralları ile masaüstü, tablet ve akıllı telefon ekranlarında kusursuz hizalama

### 🔐 Güvenlik Mimarisi

- **SQL Injection Koruması:** Veritabanı katmanında yalnızca **PDO (Prepared Statements)** kullanılır; dışarıdan gelen hiçbir parametre doğrudan sorguya dahil edilmez
- **Parola Güvenliği:** Yönetici giriş şifreleri veritabanında düz metin olarak değil, tek yönlü **Bcrypt (`password_hash`)** algoritması ile şifrelenerek saklanır
- **XSS Koruması:** İstemci-sunucu arası veri alışverişinde tüm çıktılar `htmlspecialchars()` filtresinden geçirilir
- **Oturum ve Dosya Güvenliği:** Yönetim sayfaları PHP Session kontrolü ile korunur; dosya yükleme modülünde yalnızca izin verilen resim uzantıları kabul edilerek zararlı dosya yüklemeleri engellenir

### 🛠️ Teknik Mimari ve Dosya Yapısı

```
KRC-CARS/
├── admin/                # Yönetim paneli modülleri
│   ├── login.php         # Yönetici giriş ve oturum doğrulama ekranı
│   ├── dashboard.php     # Envanter listeleme ve yönetim merkezi
│   ├── admin_ekle.php    # Dosya yüklemeli yeni araç ekleme modülü
│   ├── admin_duzenle.php # Mevcut araç güncelleme ve görsel değiştirme
│   └── logout.php        # Güvenli oturum sonlandırma
├── assets/               # Statik ve dinamik medya dosyaları
│   └── img/
│       └── cars/         # Admin panelinden yüklenen araç görselleri
├── db.php                # PDO veritabanı bağlantı ve yapılandırma dosyası
├── lang.php              # TR / EN çoklu dil sözlüğü ve oturum yöneticisi
├── header.php            # Ortak üst menü, SEO meta etiketleri ve mobil menü
├── footer.php            # Ortak alt bilgi ve script bağlantıları
├── index.php             # Ana sayfa ve vitrin araçları
├── araclarimiz.php       # Kategorize edilmiş tüm araç envanteri
├── galeri.php            # Yüksek çözünürlüklü medya galerisi
├── hakkimizda.php        # KRC Group kurumsal vizyon ve tanıtım sayfası
├── iletisim.php          # İletişim bilgileri ve erişim kanalları
├── style.css             # Özel VIP tema stilleri ve mobil responsive kuralları
└── README.md             # Proje dokümantasyonu
```

### 🚀 Kurulum ve Canlıya Alma (Deployment) Kılavuzu

1. **Dosyaları Sunucuya Aktarın:** Proje dosyalarını yerel ortamda `htdocs/krc-cars` dizinine, canlı sunucuda ise doğrudan `public_html` dizinine yükleyin.
2. **Veritabanını Oluşturun:** Hosting panelinizden yeni bir MySQL veritabanı ve tam yetkili (`All Privileges`) bir kullanıcı oluşturun. **phpMyAdmin** arayüzüne girerek **SQL** sekmesinden aşağıdaki tabloyu oluşturun:

```sql
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `km` varchar(50) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

3. **Bağlantı Ayarlarını Yapılandırın (`db.php`):**

```php
$host     = 'localhost';
$dbname   = 'veritabani_adiniz';
$username = 'veritabani_kullaniciniz';
$password = 'guclu_sifreniz';
```

4. **Klasör Yazma İzinleri (CHMOD):** Admin panelinden yüklenen araç fotoğraflarının sunucuya kaydedilebilmesi için `assets/img/cars/` klasörünün dosya izinlerini **`755`** (gerekirse **`777`**) olarak ayarlayın.

---

## 🇬🇧 English

**KRC CARS** is a modern web automation and showcase platform engineered for displaying and dynamically managing luxury automotive, supercar, yacht, and helicopter portfolios with high-prestige standards.

While offering visitors a VIP showroom experience, the system enables administrators to effortlessly manage vehicle inventory, media assets, and category workflows from a single centralized dashboard.

### 📸 UI & Screenshots

Built with a deep black and KRC Red (`#e30613`) color palette, glassmorphism accents, and AOS (Animate On Scroll) animations to deliver top-tier UI/UX standards.

| **Home & VIP Showcase** | **Dynamic Vehicle Inventory** |
| --- | --- |
| ![Home](screenshot/home.png) | ![Cars](screenshot/cars.png) |
| **Admin Control Panel** | **Mobile Hamburger Menu** |
| ![Admin Panel](screenshot/admin.png) | ![Mobile UI](screenshot/mobile.png) |

### 🌟 Key Features

#### 🖥️ VIP Showcase & User Interface
- Real-time dynamic filtering across luxury cars, supercars, SUVs, yachts, and helicopters
- Smooth scroll transitions and interactive vehicle cards powered by **AOS (Animate On Scroll)**
- Direct, one-click communication channels connecting prospective buyers with sales consultants

#### 🌐 Bilingual Support (TR / EN)
- Zero-latency **Turkish / English** language engine powered natively via server-side **PHP Sessions** without external translation APIs
- Instant switching of navigation menus, corporate copy, and UI labels via the top-right `TR | EN` toggle

#### 🛠️ Advanced Admin Dashboard
- Centralized control panel to add new vehicles, update pricing/mileage/status details, and remove sold inventory
- **Direct Media Upload Engine:** Eliminates manual URL pasting by supporting direct `JPG`, `PNG`, and `WEBP` uploads from both desktop and mobile devices
- **Automated Storage Cleanup:** Automatically deletes obsolete image files from the server via `unlink()` whenever a vehicle is updated or deleted

#### 📱 Mobile-First Responsive Design
- Custom animated, full-screen **Hamburger Menu** tailored for mobile devices
- Seamless alignment across desktop, tablet, and smartphone viewports using CSS3 Flexbox, Grid, and Media Queries

### 🔐 Security Architecture

- **SQL Injection Protection:** Strictly utilizes **PDO (Prepared Statements)** across the database layer; no raw external input is ever concatenated into queries
- **Password Security:** Admin credentials are never stored in plain text; passwords are hashed using one-way **Bcrypt (`password_hash`)** encryption
- **XSS Protection:** All client-server data outputs are sanitized through `htmlspecialchars()` filters
- **Session & File Security:** Admin routes are guarded via PHP Session authentication, and file uploads strictly validate image MIME types/extensions to block malicious payloads

### 🚀 Installation & Deployment Guide

1. **Upload Files:** Upload project files to `htdocs/krc-cars` for local development or directly into `public_html` on your live production server.
2. **Database Setup:** Create a MySQL database and a user with `All Privileges` in your hosting control panel. Run the following SQL query in **phpMyAdmin**:

```sql
CREATE TABLE IF NOT EXISTS `cars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` int(4) NOT NULL,
  `km` varchar(50) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

3. **Configure Connection (`db.php`):**

```php
$host     = 'localhost';
$dbname   = 'your_database_name';
$username = 'your_database_user';
$password = 'your_strong_password';
```

4. **Directory Permissions (CHMOD):** Set write permissions on the `assets/img/cars/` directory to **`755`** (or **`777`** if required by your server) to allow seamless image uploads.

---

## ⚠️ Bilinen Sınırlamalar / Known Limitations

- **TR:** Çoklu dil desteği dinamik veritabanı içeriklerini (araç açıklamaları vb.) değil, arayüzdeki sabit metinleri ve kurumsal içerikleri kapsar.
- **EN:** Bilingual support covers static UI labels and corporate copy rather than dynamic database-driven vehicle descriptions.

## 🧰 Teknolojiler / Tech Stack

`PHP 8.x` · `MySQL / MariaDB` · `PDO` · `HTML5` · `CSS3` · `JavaScript (ES6+)` · `AOS.js` · `FontAwesome 6`

## 📄 Lisans / License

Bu proje **KRC Group** için geliştirilmiş olup [MIT Lisansı](LICENSE) altında lisanslanmıştır. / Developed for **KRC Group** and licensed under the [MIT License](LICENSE).
