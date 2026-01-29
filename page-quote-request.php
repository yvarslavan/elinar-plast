<?php
/**
 * Template Name: Запрос расчета
 * Page template for Quote Request Form
 */
get_header();
?>

<!-- HERO BLOCK -->
<div class="page-hero page-hero-compact quote-hero">
    <!-- Hero Background Image -->
    <picture class="hero-bg-picture">
        <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-mobile_quote-request.webp" type="image/webp">
        <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-tablet_quote-request.webp" type="image/webp">
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_quote-request.webp" type="image/webp">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_quote-request.webp"
             alt="Запрос на расчет производства"
             class="hero-bg-img"
             width="1920"
             height="1080"
             fetchpriority="high"
             loading="eager"
             decoding="async">
    </picture>
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="text-white">Запрос на <span class="text-orange">расчет производства</span></h1>
        <p class="lead">Заполните форму, и мы подготовим техническое и коммерческое предложение под вашу задачу в течение 1-2 рабочих дней.</p>
    </div>
</div>

<main class="section page-content quote-page">
    <div class="container">
        <?php include get_template_directory() . '/template-parts/quote-form.php'; ?>

        <!-- Дополнительная информация -->
        <div class="quote-info-section">
            <div class="quote-info-grid">
                <div class="quote-info-card">
                    <div class="quote-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12,6 12,12 16,14"/>
                        </svg>
                    </div>
                    <h4>Быстрый ответ</h4>
                    <p>Наш инженер свяжется с вами в течение 1 рабочего дня</p>
                </div>
                <div class="quote-info-card">
                    <div class="quote-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <polyline points="14,2 14,8 20,8"/>
                            <line x1="16" y1="13" x2="8" y2="13"/>
                            <line x1="16" y1="17" x2="8" y2="17"/>
                        </svg>
                    </div>
                    <h4>Детальный расчет</h4>
                    <p>Получите КП с точными сроками и стоимостью производства</p>
                </div>
                <div class="quote-info-card">
                    <div class="quote-info-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                    </div>
                    <h4>Конфиденциально</h4>
                    <p>Ваши данные и чертежи защищены NDA</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>

