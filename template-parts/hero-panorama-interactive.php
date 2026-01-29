<!-- Interactive Panorama Hero v4.0 -->
<div class="hero-panorama-container" id="heroPanorama">
    <!-- Panorama Images (Dual Layers for Synchronized Crossfade) -->
    <div class="hero-panorama-wrapper" id="panoramaWrapper">
        <!-- Image 1: Extrusion workshop - always visible first -->
        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_technologies-and-contract-manufacturing.webp"
            alt="Экструзионный цех"
            class="hero-panorama-image panorama-1"
            width="1920"
            height="1080"
            fetchpriority="high"
            loading="eager"
        />
        <!-- Image 2: Injection molding workshop - fades in/out -->
        <img
            src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_technologies-and-contract-manufacturing2.webp"
            alt="Литьевой цех"
            class="hero-panorama-image panorama-2"
            width="1920"
            height="1080"
            loading="eager"
            style="opacity: 0;"
        />
    </div>

    <!-- Overlay -->
    <div class="hero-overlay"></div>

    <!-- Content -->
    <div class="container hero-content-wrapper">
        <div class="hero-text-block">
            <h1 class="text-white hero-title-animated"><span class="accent-text">Немецкое</span> качество на российском производстве</h1>
            <p class="lead hero-text-animated">Российско-германское предприятие полного цикла. Экструзия и литьё пластмасс с европейской точностью для промышленности.</p>
            <div class="hero-cta-buttons hero-text-animated">
                <a href="#contact-form" class="btn-hero btn-hero-primary">Рассчитать проект</a>
                <a href="<?php echo home_url('/products'); ?>" class="btn-hero btn-hero-secondary">Смотреть продукцию</a>
            </div>
        </div>
    </div>

    <!-- Glitch Loader - Digital interference effect during crossfade -->
    <div class="glitch-loader" id="glitchLoader" style="opacity: 0; display: none;">
        <div class="glitch-layer"></div>
        <div class="glitch-layer"></div>
        <div class="glitch-layer"></div>
    </div>

    <!-- Scroll Down Button -->
    <?php get_template_part('template-parts/scroll-down-btn'); ?>
</div>
