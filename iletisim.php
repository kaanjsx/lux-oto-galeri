<?php include 'includes/header.php'; ?>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <section class="contact-ultra-modern">
        <div class="contact-bg-blur"></div>
        
        <div class="container relative-z">
            <div class="contact-intro text-center" data-aos="zoom-in">
                <h1 class="glitch-text">BİZE <span>ULAŞIN</span></h1>
                <div class="dynamic-line"></div>
                <p>KRC Dünyasına açılan kapıdasınız. Prestij bir telefon uzağınızda.</p>
            </div>

            <div class="contact-main-grid">
                
                <div class="contact-cards-stack">
                    <div class="ultra-card" data-aos="fade-right" data-aos-delay="100">
                        <div class="card-icon-box red-glow">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="card-content">
                            <h3>SATIŞ DEPARTMANI</h3>
                            <a href="https://wa.me/905316350034" class="wa-num">eklenecek</a>
                            <p>Satış ve kiralama talepleri için aktif.</p>
                        </div>
                    </div>

                    <div class="ultra-card" data-aos="fade-right" data-aos-delay="300">
                        <div class="card-icon-box green-glow">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="card-content">
                            <h3>VIP REZERVASYON</h3>
                            <a href="https://wa.me/905326599934" class="wa-num">eklenecek</a>
                            <p>Transfer ve özel rezervasyon hattı.</p>
                        </div>
                    </div>

                    <div class="ultra-card phone-special" data-aos="fade-right" data-aos-delay="500">
                        <div class="card-icon-box white-glow">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                        <div class="card-content">
                            <h3>SANTRAL</h3>
                            <a href="tel:08503404436" class="wa-num">eklenecek</a>
                            <p>Resmi yazışmalar ve genel bilgi.</p>
                        </div>
                    </div>
                </div>

                <div class="branches-panel" data-aos="fade-left">
                    <div class="branch-selector">
                        <button class="branch-tab active" onclick="switchMap('istanbul')">İSTANBUL</button>
                    </div>
                    
                    <div class="map-container-vip">
                        <div id="map-istanbul" class="map-item active">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3005.823674488806!2d28.985655776632734!3d41.11651841341113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14cab13f961152df%3A0xc6829107954e3a47!2sSkyland%20Istanbul!5e0!3m2!1str!2str!4v1710000000000" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                       
                    </div>

                  
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true });

        function switchMap(type) {
            document.querySelectorAll('.map-item').forEach(m => m.classList.remove('active'));
            document.querySelectorAll('.branch-tab').forEach(b => b.classList.remove('active'));
            
            if(type === 'istanbul') {
                document.getElementById('map-istanbul').classList.add('active');
                document.querySelector('[onclick="switchMap(\'istanbul\')"]').classList.add('active');
                document.getElementById('branch-text').innerText = "Skyland Residence B Blok Daire: 150 Sarıyer / İstanbul";
            } else {
                document.getElementById('map-bodrum').classList.add('active');
                document.querySelector('[onclick="switchMap(\'bodrum\')"]').classList.add('active');
                document.getElementById('branch-text').innerText = "Küçükbük Mah. 42. Sok. No:27 Türkbükü / Bodrum";
            }
        }
    </script>

<?php include 'includes/footer.php'; ?>