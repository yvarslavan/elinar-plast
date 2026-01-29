<?php
/**
 * Key Directions Section - Industrial Tech / Premium B2B
 * Секция "Ключевые направления" с новым дизайном (Grid, Cards)
 */
?>

<section id="key-directions" class="section-key-directions">
    <div class="key-directions-container">

        <!-- Header: Grid Layout -->
        <div class="directions-header">
            <h2 class="directions-title">КЛЮЧЕВЫЕ<br>НАПРАВЛЕНИЯ</h2>
            <div class="directions-lead">
                <p>Производим пластиковые профили и литьевые изделия для различных отраслей промышленности. Мы предлагаем <span class="highlight">передовые решения</span> для производства погонажных изделий любой сложности, используя современные экструзионные линии.</p>
            </div>
        </div>

        <!-- Industry Cards Grid -->
        <div class="directions-grid">

            <!-- Card 1: Строительство -->
            <a href="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro1.webp" class="industry-card glightbox" data-gallery="key-directions" data-title="СТРОИТЕЛЬСТВО">
                <div class="card-bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro1.webp" alt="Строительство" loading="lazy">
                </div>
                <div class="card-overlay">
                    <h3>СТРОИТЕЛЬСТВО</h3>
                    <div class="card-description">
                        <p>Термовставки для фасадных систем, профили для ЖБИ, профили для осветительного шинопровода, отделочные профили.</p>
                    </div>
                </div>
            </a>

            <!-- Card 2: Машиностроение -->
            <a href="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro2.webp" class="industry-card glightbox" data-gallery="key-directions" data-title="МАШИНОСТРОЕНИЕ">
                <div class="card-bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro2.webp" alt="Машиностроение" loading="lazy">
                </div>
                <div class="card-overlay">
                    <h3>МАШИНОСТРОЕНИЕ</h3>
                    <div class="card-description">
                        <p>Высокопрочные профили для фургонов.</p>
                    </div>
                </div>
            </a>

            <!-- Card 3: Бытовая техника -->
            <a href="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro3.webp" class="industry-card glightbox" data-gallery="key-directions" data-title="БЫТОВАЯ ТЕХНИКА">
                <div class="card-bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro3.webp" alt="Бытовая техника" loading="lazy">
                </div>
                <div class="card-overlay">
                    <h3>БЫТОВАЯ ТЕХНИКА</h3>
                    <div class="card-description">
                        <p>Производство отделочных профилей для стеклянных полок холодильников.</p>
                    </div>
                </div>
            </a>

            <!-- Card 4: Упаковка -->
            <a href="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro4.webp" class="industry-card glightbox" data-gallery="key-directions" data-title="УПАКОВКА">
                <div class="card-bg">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/plastic_profile_slice_macro4.webp" alt="Упаковка" loading="lazy">
                </div>
                <div class="card-overlay">
                    <h3>УПАКОВКА</h3>
                    <div class="card-description">
                        <p>Пластиковые трубы и втулки для намотки фольги, пленки, бумаги.</p>
                    </div>
                </div>
            </a>

        </div>

        <!-- Custom Order Banner (Moved inside container) -->
        <div class="custom-order-banner custom-order-banner-wrapper">
            <div class="banner-blueprint-overlay"></div>
            <div class="banner-content-wrapper">
                <div class="banner-text">
                    <h3>Индивидуальный заказ</h3>
                    <p>Разработка и производство изделий по вашим чертежам и техническому заданию. Полный цикл от проектирования до серийного выпуска.</p>
                </div>
                <div class="banner-cta">
                    <a href="<?php echo home_url('/quote-request'); ?>" class="btn-custom-order">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14,2 14,8 20,8" />
                            <line x1="16" y1="13" x2="8" y2="13" />
                            <line x1="16" y1="17" x2="8" y2="17" />
                        </svg>
                        Запросить расчет
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>
