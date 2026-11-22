<?php include 'includes/header.php'; ?>

<div class="page-bg-glow"></div>

<section class="gallery-header-section" data-aos="fade-down">
    <div class="container text-center">
        <h1 class="gallery-main-title">Galeri</h1>
        <div class="red-line-center" data-aos="zoom-in" data-aos-delay="400"></div> 
        <p class="gallery-subtitle" data-aos="fade-up" data-aos-delay="600">
            Amiral Motors'un lüks dünyasından kareler. Filomuzun gücünü ve <br> ihtişamını keşfedin.
        </p>
    </div>
</section>

<section class="gallery-grid-section container">
    <div class="video-grid-amiral">
        
        <div class="video-card-vip" onclick="playVipVideo('assets/img/galeri1.mp4')" data-aos="fade-up" data-aos-delay="100">
            <div class="video-thumb-box">
                <video autoplay muted loop playsinline class="preview-video">
                    <source src="assets/img/galeri1.mp4" type="video/mp4">
                </video>
                <div class="play-overlay">
                    <i class="fa-solid fa-play"></i>
                </div>
            </div>
            <div class="video-card-content">
                <h3>Lüks Filomuz</h3>
                <p>Premium araçlarımızla tanışın.</p>
            </div>
        </div>

        <div class="video-card-vip" onclick="playVipVideo('assets/img/galeri2.mp4')" data-aos="fade-up" data-aos-delay="300">
            <div class="video-thumb-box">
                <video autoplay muted loop playsinline class="preview-video">
                    <source src="assets/img/galeri2.mp4" type="video/mp4">
                </video>
                <div class="play-overlay">
                    <i class="fa-solid fa-play"></i>
                </div>
            </div>
            <div class="video-card-content">
                <h3>Ayrıcalıklı Deneyim</h3>
                <p>Her yolculuğu unutulmaz kılan detaylar.</p>
            </div>
        </div>

        <div class="video-card-vip" onclick="playVipVideo('assets/img/galeri3.mp4')" data-aos="fade-up" data-aos-delay="500">
            <div class="video-thumb-box">
                <video autoplay muted loop playsinline class="preview-video">
                    <source src="assets/img/galeri3.mp4" type="video/mp4">
                </video>
                <div class="play-overlay">
                    <i class="fa-solid fa-play"></i>
                </div>
            </div>
            <div class="video-card-content">
                <h3>Güç ve Tutku</h3>
                <p>V12 motorların eşsiz senfonisi.</p>
            </div>
        </div>

        <div class="video-card-vip" onclick="playVipVideo('assets/img/galeri4.mp4')" data-aos="fade-up" data-aos-delay="700">
            <div class="video-thumb-box">
                <video autoplay muted loop playsinline class="preview-video">
                    <source src="assets/img/galeri4.mp4" type="video/mp4">
                </video>
                <div class="play-overlay">
                    <i class="fa-solid fa-play"></i>
                </div>
            </div>
            <div class="video-card-content">
                <h3>Konforun Zirvesi</h3>
                <p>Sizin için tasarlanmış VIP iç mekanlar.</p>
            </div>
        </div>

    </div>
</section>

<div id="vipVideoModal" class="vip-modal">
    <span class="close-vip-modal">&times;</span>
    <div class="vip-modal-body">
        <video id="vipPlayer" controls>
            <source src="" type="video/mp4">
        </video>
    </div>
</div>

<script>
    const modal = document.getElementById('vipVideoModal');
    const player = document.getElementById('vipPlayer');
    const closeBtn = document.querySelector('.close-vip-modal');

    function playVipVideo(videoSrc) {
        player.src = videoSrc;
        modal.style.display = "flex";
        player.play();
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
        player.pause();
        player.src = "";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
            player.pause();
            player.src = "";
        }
    }
</script>

<?php include 'includes/footer.php'; ?>