<?php 
include 'includes/header.php'; 

// Arama ve Kategori terimlerini alıyoruz
$cat = $_GET['cat'] ?? null;
$search = $_GET['q'] ?? null;

// Dinamik Sorgu Hazırlama
if ($search) {
    // Arama yapılıyorsa (Marka veya Model içinde ara)
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE (brand LIKE ? OR model LIKE ?) ORDER BY id DESC");
    $stmt->execute(["%$search%", "%$search%"]);
} elseif ($cat) {
    // Sadece kategori seçiliyse
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE category = ? ORDER BY id DESC");
    $stmt->execute([$cat]);
} else {
    // Hiçbir şey seçili değilse hepsini getir
    $stmt = $pdo->query("SELECT * FROM cars ORDER BY id DESC");
}
$cars = $stmt->fetchAll();
?>

<div class="page-bg-glow"></div>

<section class="inventory-elite">
    <div class="container">
        <div class="elite-filter-bar" data-aos="fade-down">
            <div class="filter-group">
                <a href="araclarimiz.php" class="filter-link <?= !isset($_GET['cat']) && !$search ? 'active' : '' ?>">HEPSİ</a>
                <a href="araclarimiz.php?cat=suv" class="filter-link <?= ($cat == 'suv') ? 'active' : '' ?>">SUV</a>
                <a href="araclarimiz.php?cat=sedan" class="filter-link <?= ($cat == 'sedan') ? 'active' : '' ?>">SEDAN</a>
                <a href="araclarimiz.php?cat=cabrio" class="filter-link <?= ($cat == 'cabrio') ? 'active' : '' ?>">CABRIO</a>
                <a href="araclarimiz.php?cat=sports" class="filter-link <?= ($cat == 'sports') ? 'active' : '' ?>">SPORTS</a>
                <a href="araclarimiz.php?cat=yacht" class="filter-link <?= ($cat == 'yacht') ? 'active' : '' ?>">YAT</a>
                <a href="araclarimiz.php?cat=helicopter" class="filter-link <?= ($cat == 'helicopter') ? 'active' : '' ?>">HELİKOPTER</a>
            </div>

            <form action="araclarimiz.php" method="GET" class="elite-search-form">
                <input type="text" name="q" placeholder="Araç ara..." value="<?= htmlspecialchars($search ?? '') ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <div class="elite-grid">
            <?php if (count($cars) > 0): ?>
                <?php foreach($cars as $car): ?>
                <div class="elite-card" data-aos="fade-up">
                    <div class="elite-card-img">
                        <img src="<?= htmlspecialchars($car['image_url']) ?>" alt="Car" onerror="this.src='assets/img/fallback-car.jpg'">
                        <div class="elite-badge"><?= strtoupper(htmlspecialchars($car['category'])) ?></div>
                    </div>
                    
                    <div class="elite-card-body">
                        <div class="brand-info">
                            <h3><?= htmlspecialchars($car['brand']) ?> <span><?= htmlspecialchars($car['model']) ?></span></h3>
                        </div>
                        
                        <div class="elite-specs">
                            <span><i class="fa-solid fa-gas-pump"></i> Benzin</span>
                            <span><i class="fa-solid fa-gear"></i> Otomatik</span>
                        </div>

                        <div class="elite-footer">
                            <div class="elite-price">
                                <?php 
                                    $clean_price = (float) str_replace(['.', ','], '', $car['price']);
                                    echo number_format($clean_price, 0, ',', '.') . ' ₺'; 
                                ?>
                            </div>
                            <a href="https://wa.me/" class="elite-btn">Bize Ulaşın</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
          <div class="no-results-container" data-aos="zoom-in">
    <div class="no-results-icon">
        <i class="fa-solid fa-car-rear"></i>
        <div class="icon-pulse"></div>
    </div>
    <h2>Sonuç Bulunamadı</h2>
    <p>Aradığınız kriterlere uygun bir araç şu an stoklarımızda bulunmuyor. <br> Farklı bir arama yapabilir veya tüm koleksiyonumuza göz atabilirsiniz.</p>
    <div class="no-results-actions">
        <a href="araclarimiz.php" class="elite-btn outline">Filtreleri Temizle</a>
        <a href="iletisim.php" class="elite-btn">Özel Araç Talep Et</a>
    </div>
</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>