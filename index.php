<?php 
// 1. Header ve fonksiyonları içeren parçayı çağırıyoruz
include 'includes/header.php'; 

// 2. Araçları kategorilerine göre veritabanından çekiyoruz
$special_cars  = getCarsByCategory($pdo, 'special_collection');
$showcase_cars = getCarsByCategory($pdo, 'showcase');
$suv_cars      = getCarsByCategory($pdo, 'suv');
$sedan_cars    = getCarsByCategory($pdo, 'sedan');
?>

    <section class="hero-section">
        <img src="assets/img/background-car.jpg" class="hero-video" alt="KRC Cars Bugatti">
        <div class="hero-overlay"></div>
        <div class="hero-content container">
            <h4 class="subtitle">PROJECT 2026</h4>
            <h1>GÜCÜN VE ZERAFETİN<br><em>TEK ADRESİ</em></h1>
            <div class="hero-line"></div>
        </div>
    </section>

    <section class="services-section container">
        <div class="services-grid">
            <a href="#" class="service-card">
                <div class="service-bg-img" style="background-image: url('https://images.pexels.com/photos/9187088/pexels-photo-9187088.jpeg');"></div>
                <div class="service-gradient"></div>
                <div class="service-content">
                    <h3>ARACINIZI NAKİTE DÖNÜŞTÜRÜN</h3>
                    <p>Hızlı, şeffaf ve güvenilir bir süreçle değerinde satın alıyoruz.</p>
                    <span class="arrow">›</span>
                </div>
            </a>
            <a href="#" class="service-card">
                <div class="service-bg-img" style="background-image: url('https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?q=80&w=1000&auto=format&fit=crop');"></div>
                <div class="service-gradient"></div>
                <div class="service-content">
                    <h3>KONSİNYE ARAÇ BIRAKIN</h3>
                    <p>Profesyonel ekiplerimizle en doğru kitleye ulaştırıyoruz.</p>
                    <span class="arrow">›</span>
                </div>
            </a>
            <a href="#" class="service-card">
                <div class="service-bg-img" style="background-image: url('https://images.unsplash.com/photo-1544829099-b9a0c07fad1a?q=80&w=1000&auto=format&fit=crop');"></div>
                <div class="service-gradient"></div>
                <div class="service-content">
                    <h3>ARADIĞINIZ ARACI GETİRELİM</h3>
                    <p>Dünyanın her yerinden anahtar teslim Türkiye'ye getiriyoruz.</p>
                    <span class="arrow">›</span>
                </div>
            </a>
        </div>
    </section>

    <section class="premium-promo">
        <div class="promo-row container">
            <div class="promo-content">
                <h2>Ayrıcalığı Hissedin</h2>
                <div class="gold-line-small"></div>
                <p>Size özel tasarlanmış lüks araç filomuzla seyahatlerinizi unutulmaz bir deneyime dönüştürün. Sadece bir araç kiralamıyor, prestiji ve konforu bir arada sunuyoruz.</p>
            </div>
            <div class="promo-media">
                <video autoplay muted loop playsinline class="luxury-video">
                    <source src="assets/img/luxury-video-1.mp4" type="video/mp4">
                    <img src="assets/img/fallback-1.jpg" alt="Luxury Car">
                </video>
            </div>
        </div>

        <div class="promo-row container reverse">
            <div class="promo-content">
                <h2>Güven ve Performans</h2>
                <div class="gold-line-small"></div>
                <p>Her bir aracımız mükemmel kondisyonda olup, en üst düzey güvenlik ve performans standartlarını karşılamak için düzenli bakımdan geçer.</p>
            </div>
            <div class="promo-media">
                <video autoplay muted loop playsinline class="luxury-video">
                    <source src="assets/img/luxury-video-2.mp4" type="video/mp4">
                    <img src="assets/img/fallback-2.jpg" alt="Luxury Interior">
                </video>
            </div>
        </div>
    </section>

    <?php if(!empty($special_cars)): ?>
    <section class="container">
        <div class="collection-header">
            <div class="title-box">
                <h2>ÖZEL KOLEKSİYON</h2>
                <div class="red-line"></div>
            </div>
        </div>
        <div class="car-grid">
            <?php foreach($special_cars as $car): ?>
            <div class="vip-card">
                <div class="card-header">
                    <div class="card-img-wrapper">
                        <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="Exclusive" class="main-car-img">
                    </div>
                </div>
                <div class="card-info">
                    <h3 class="car-title"><?= htmlspecialchars($car['brand']) ?> <span><?= htmlspecialchars($car['model']) ?></span></h3>
                    <div class="card-action-row">
                        <div class="price-display"><?= htmlspecialchars($car['price']) ?></div>
                        <a href="https://wa.me/905316350034" class="btn-contact-vip">Bize Ulaşın</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="catalog-section container">
        <div class="catalog-header">
            <h2>VİTRİN ARAÇLAR</h2>
            <a href="#" class="view-all">TÜMÜNÜ GÖSTER <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        <div class="catalog-grid">
            <?php foreach($showcase_cars as $car): ?>
            <div class="vip-card">
                <div class="card-header">
                    <div class="card-img-wrapper">
                        <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="Car" class="main-car-img">
                    </div>
                </div>
                <div class="card-info">
                    <h3 class="car-title"><?= htmlspecialchars($car['brand']) ?> <span><?= htmlspecialchars($car['model']) ?></span></h3>
                    <div class="card-tags">
                        <span class="tag">Benzin</span>
                        <span class="tag-dot">•</span>
                        <span class="tag">4 Koltuk</span>
                        <span class="tag-dot">•</span>
                        <span class="tag">Otomatik</span>
                    </div>
                    <div class="card-colors-row">
                        <div class="color-circles"><div class="circle red"></div><div class="circle yellow"></div></div>
                        <span class="color-label">RENKLER</span>
                    </div>
                    <div class="card-action-row">
                        <div class="price-display"><?= htmlspecialchars($car['price']) ?></div>
                        <a href="https://wa.me/905316350034" class="btn-contact-vip">Bize Ulaşın</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="catalog-section container">
        <div class="catalog-header"><h2>SUV ARAÇLAR</h2></div>
        <div class="catalog-grid">
            <?php foreach($suv_cars as $car): ?>
            <div class="vip-card">
                <div class="card-header"><div class="card-img-wrapper"><img src="<?= htmlspecialchars($car['image_url']) ?>" class="main-car-img"></div></div>
                <div class="card-info">
                    <h3 class="car-title"><?= htmlspecialchars($car['brand']) ?> <span><?= htmlspecialchars($car['model']) ?></span></h3>
                    <div class="card-action-row">
                        <div class="price-display"><?= htmlspecialchars($car['price']) ?></div>
                        <a href="https://wa.me/905316350034" class="btn-contact-vip">Bize Ulaşın</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="catalog-section container">
        <div class="catalog-header"><h2>SEDAN ARAÇLAR</h2></div>
        <div class="catalog-grid">
            <?php foreach($sedan_cars as $car): ?>
            <div class="vip-card">
                <div class="card-header"><div class="card-img-wrapper"><img src="<?= htmlspecialchars($car['image_url']) ?>" class="main-car-img"></div></div>
                <div class="card-info">
                    <h3 class="car-title"><?= htmlspecialchars($car['brand']) ?> <span><?= htmlspecialchars($car['model']) ?></span></h3>
                    <div class="card-action-row">
                        <div class="price-display"><?= htmlspecialchars($car['price']) ?></div>
                        <a href="https://wa.me/905316350034" class="btn-contact-vip">Bize Ulaşın</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="stats-section-vip">
        <div class="container text-center">
            <h2 class="stats-title-main">Rakamlarla KRC Motors</h2>
            <p class="stats-subtitle-main">Sizlere güvenilir ve lüks bir deneyim sunmak için her gün kendimizi geliştiriyoruz.</p>
            <div class="stats-grid-vip">
                <div class="stat-card-vip">
                    <div class="stat-number-vip">1200<span>+</span></div>
                    <div class="stat-label-vip">Kiralanan Araç</div>
                </div>
                <div class="stat-card-vip">
                    <div class="stat-number-vip">5000<span>+</span></div>
                    <div class="stat-label-vip">Mutlu Müşteri</div>
                </div>
                <div class="stat-card-vip">
                    <div class="stat-number-vip">10<span>+</span></div>
                    <div class="stat-label-vip">Hizmet Yılı</div>
                </div>
            </div>
        </div>
    </section>

   <section class="faq-section">
        <div class="container faq-wrapper">
            <h2 class="faq-main-title">SIKÇA SORULAN SORULAR</h2>
            
            <div class="accordion-list">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>KRC Cars hangi markaların satışını yapmaktadır?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <p>KRC Cars olarak Porsche, Ferrari, Lamborghini, Mercedes-Benz ve BMW gibi dünyanın önde gelen lüks ve spor otomobil markalarının seçkin modellerini portföyümüzde bulunduruyoruz.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>VIP Showroomunuz nerede bulunuyor?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <p>Showroomumuz İstanbul'un kalbinde, Skyland Residence Sarıyer adresinde hizmet vermektedir. Ayrıca Bodrum Türkbükü şubemizle yaz aylarında da yanınızdayız.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Aracımı nakit olarak satabilir miyim?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <p>Evet, "Aracınızı Nakite Dönüştürün" hizmetimizle, aracınızın ekspertiz işlemleri sonrası piyasa değerinde hızlı ve güvenilir bir şekilde nakit alım gerçekleştiriyoruz.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Konsiye araç bırakma süreci nasıl işliyor?</h3>
                        <span class="icon">+</span>
                    </div>
                    <div class="accordion-content">
                        <p>Aracınızı showroomumuza bıraktıktan sonra profesyonel çekimlerini yapıyor ve kendi müşteri ağımız ile dijital platformlarda pazarlıyoruz. Satış sonrası tüm devir işlemlerini biz yönetiyoruz.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const item = header.parentElement;
            
            // Diğer açık olanları kapat (Daha temiz görünüm için)
            document.querySelectorAll('.accordion-item').forEach(other => {
                if (other !== item) other.classList.remove('open');
            });

            // Tıklananı aç/kapat
            item.classList.toggle('open');
        });
    });
    </script>

<?php 
// 8. Footer parçasını çağırıyoruz
include 'includes/footer.php'; 
?>