<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon handled via functions.php -->

    <?php if (!defined('ELINAR_OPT_LOCAL_FONTS') || !ELINAR_OPT_LOCAL_FONTS): ?>
        <!-- Preconnect to font domains for faster loading -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Preload основного шрифта Inter для устранения FOUT -->
        <link rel="preload" href="https://fonts.gstatic.com/s/inter/v18/UcC73FwrK3iLTeHuS_nVMrMxCp50SjIa1ZL7.woff2" as="font" type="font/woff2" crossorigin>
    <?php else: ?>
        <!-- Preload local Inter + Manrope fonts for faster LCP rendering -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/UcC73FwrK3iLTeHuS_nVMrMxCp50SjIa1ZL7.woff2" as="font" type="font/woff2">
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/xn7gYHE41ni1AdIRggOxSuXd.woff2" as="font" type="font/woff2">
    <?php endif; ?>

    <?php
    $should_render_critical_css = !defined('ELINAR_OPT_CRITICAL_CSS_SCOPE')
        || !ELINAR_OPT_CRITICAL_CSS_SCOPE
        || (function_exists('is_front_page') && is_front_page());
    ?>
    <?php if ($should_render_critical_css): ?>
        <!-- Critical CSS для Hero-секции - устраняет render-blocking style.css -->
        <style id="critical-hero-css">
            :root {
                --header-height: 60px;
                --font-main: 'Inter', sans-serif;
                --font-heading: 'Manrope', sans-serif;
            }

            *,
            *::before,
            *::after {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: var(--font-main);
                line-height: 1.6;
                -webkit-font-smoothing: antialiased;
            }

            .container {
                max-width: 1280px;
                margin: 0 auto;
                padding: 0 1.5rem;
            }

            .site-header {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                z-index: 999;
                padding: 1rem 0;
                background: rgba(15, 23, 42, 0.9);
            }

            .site-header .container {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .hero {
                position: relative;
                background-color: #0f172a;
                color: #fff;
                padding: 6rem 0;
                min-height: 600px;
                display: flex;
                align-items: center;
                overflow: hidden;
                margin-top: 0;
                padding-top: calc(6rem + var(--header-height));
            }

            .hero-bg-image {
                position: absolute;
                inset: 0;
                z-index: 0;
                overflow: hidden;
            }

            .hero-bg-image picture,
            .hero-bg-image .hero-bg-img {
                width: 100%;
                height: 100%;
                display: block;
                object-fit: cover;
                object-position: center 20%;
            }

            .hero::before {
                content: '';
                position: absolute;
                inset: 0;
                background: radial-gradient(circle at 75% 50%, rgba(0, 0, 0, .2) 0%, rgba(0, 0, 0, .6) 100%), linear-gradient(to top, rgba(15, 23, 42, .9) 0%, rgba(15, 23, 42, .4) 50%, transparent 100%);
                z-index: 1;
                pointer-events: none;
            }

            .hero-content {
                max-width: 800px;
                position: relative;
                z-index: 2;
                margin-left: auto;
                margin-right: 4rem;
                width: 100%;
            }

            .hero h1 {
                margin: 0 0 2rem;
                color: #fff;
                font-family: var(--font-heading), var(--font-main), sans-serif;
                font-weight: 900;
                line-height: 1;
                text-align: left;
                text-shadow: 0 10px 30px rgba(0, 0, 0, .8);
                text-transform: uppercase;
            }

            .hero-title-line {
                display: block !important;
                font-size: clamp(2.5rem, 7vw, 5.5rem);
                letter-spacing: -.05em;
                line-height: 1;
            }

            .text-orange {
                color: #FFA500 !important;
            }

            .hero-subtitle {
                margin: 0 0 3rem;
                font-size: 1.5rem;
                color: rgba(255, 255, 255, .9);
                font-weight: 500;
                text-align: left;
                line-height: 1.6;
                max-width: 700px;
                text-shadow: 0 2px 10px rgba(0, 0, 0, .5);
            }

            .hero-actions {
                display: flex;
                gap: 1.5rem;
                flex-wrap: wrap;
            }

            .btn {
                display: inline-block;
                padding: .75rem 1.5rem;
                border-radius: 8px;
                font-weight: 600;
                text-align: center;
                border: none;
                font-size: 1rem;
                cursor: pointer;
            }

            .btn-primary {
                background-color: #0066cc;
                color: #fff;
            }

            .btn-accent {
                background-color: #FFA500;
                color: #fff;
            }

            @media (min-width: 1025px) {
                .hero {
                    min-height: 900px;
                }

                .hero-content {
                    margin-top: 8rem;
                    max-width: 1100px;
                    margin-right: 2rem;
                }

                .hero-title-line {
                    white-space: nowrap;
                }
            }

            @media (max-width: 768px) {
                .hero-title-line {
                    font-size: 2.5rem;
                }

                .hero-subtitle {
                    font-size: 1.25rem;
                }

                .hero-content {
                    margin-right: 1rem;
                }
            }
        </style>
    <?php endif; ?>

    <!-- GSAP Ready Wrapper - обеспечивает последовательность выполнения при defer -->
    <script>
        // Очередь callback'ов, ожидающих загрузку GSAP
        window.elinarGsapReady = (function() {
            var queue = [];
            var isReady = false;

            return function(callback) {
                if (typeof callback !== 'function') return;

                if (isReady && typeof window.gsap !== 'undefined') {
                    callback(window.gsap);
                } else {
                    queue.push(callback);
                }
            };

            // Не экспортируем _resolve наружу, вызывается автоматически
        })();

        // Проверка готовности GSAP каждые 50ms (максимум 5 сек)
        (function() {
            var checkCount = 0;
            var maxChecks = 100;

            function checkGsap() {
                if (typeof window.gsap !== 'undefined') {
                    window._gsapReadyQueue = window._gsapReadyQueue || [];
                    window._gsapReadyQueue.forEach(function(cb) {
                        cb(window.gsap);
                    });
                    window._gsapReadyQueue = [];
                    return;
                }

                checkCount++;
                if (checkCount < maxChecks) {
                    setTimeout(checkGsap, 50);
                }
            }

            // Старт проверки после DOMContentLoaded
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(checkGsap, 100);
                });
            } else {
                setTimeout(checkGsap, 100);
            }

            // Переопределяем elinarGsapReady с доступом к очереди
            var origFn = window.elinarGsapReady;
            window._gsapReadyQueue = [];
            window.elinarGsapReady = function(callback) {
                if (typeof callback !== 'function') return;
                if (typeof window.gsap !== 'undefined') {
                    callback(window.gsap);
                } else {
                    window._gsapReadyQueue.push(callback);
                }
            };
        })();
    </script>

    <!-- Preload Hero Background Images for LCP optimization - Responsive -->
    <?php if (is_front_page()): ?>
        <!-- Главная страница: файлы с суффиксом -main -->
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-mobile-main.webp"
            as="image"
            type="image/webp"
            media="(max-width: 768px)"
            fetchpriority="high">
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-tablet-main.webp"
            as="image"
            type="image/webp"
            media="(min-width: 769px) and (max-width: 1024px)"
            fetchpriority="high">
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop-main.webp"
            as="image"
            type="image/webp"
            media="(min-width: 1025px)"
            fetchpriority="high">

    <?php elseif (is_page_template('page-about.php') || is_page('about')): ?>
        <!-- Страница "О нас" -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about.webp" as="image" type="image/webp" fetchpriority="high">

    <?php elseif (is_page_template('page-products.php') || is_page('products')): ?>
        <!-- Страница "Продукция" -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_product.webp" as="image" type="image/webp" fetchpriority="high">

    <?php elseif (is_page_template('page-technologies-production.php') || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'technologies') !== false)): ?>
        <!-- Страница "Технологии" -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_technologies-and-contract-manufacturing.webp" as="image" type="image/webp" fetchpriority="high">

    <?php elseif (is_page_template('page-contacts.php') || is_page('contacts')): ?>
        <!-- Страница "Контакты" -->
        <link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_contact.webp" as="image" type="image/webp" fetchpriority="high">

    <?php else: ?>
        <!-- Другие страницы: стандартные файлы -->
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop.webp"
            as="image"
            type="image/webp"
            media="(min-width: 1025px)"
            fetchpriority="high">
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-tablet.webp"
            as="image"
            type="image/webp"
            media="(min-width: 769px) and (max-width: 1024px)"
            fetchpriority="high">
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-mobile.webp"
            as="image"
            type="image/webp"
            media="(max-width: 768px)"
            fetchpriority="high">
    <?php endif; ?>

    <!-- Preload video poster for About page (LCP optimization) -->
    <?php if (is_page_template('page-about.php')): ?>
        <link rel="preload"
            href="<?php echo get_template_directory_uri(); ?>/assets/video/poster.webp"
            as="image"
            type="image/webp"
            fetchpriority="high">
    <?php endif; ?>

    <?php wp_head(); ?>

    <!-- GLightbox - принудительная загрузка отключена (используется wp_enqueue_scripts в functions.php) -->
    <?php if (defined('ELINAR_ENABLE_HEADER_GLIGHTBOX') && constant('ELINAR_ENABLE_HEADER_GLIGHTBOX')): ?>
        <?php if (is_page_template('page-products.php') || (isset($_SERVER['REQUEST_URI']) && strpos($_SERVER['REQUEST_URI'], 'products') !== false)): ?>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css">
            <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/glightbox-custom.css">
            <script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!defined('ELINAR_OPT_OPERA_FIX_EXTERNAL') || !ELINAR_OPT_OPERA_FIX_EXTERNAL): ?>
        <!-- Opera Android Icon Fix - Inline script for early execution -->
        <script>
            (function() {
                // Detect Opera on Android
                var ua = navigator.userAgent || navigator.vendor || window.opera;
                var isOperaAndroid = /OPR|Opera/.test(ua) && /Android/.test(ua);

                if (isOperaAndroid) {
                    // Add class to body immediately
                    if (document.body) {
                        document.body.classList.add('opera-android-fix');
                    } else {
                        document.addEventListener('DOMContentLoaded', function() {
                            if (document.body) {
                                document.body.classList.add('opera-android-fix');
                            }
                        });
                    }

                    // Function to aggressively fix icon sizes and close cards
                    var fixOperaIcons = function() {
                        if (window.innerWidth > 768) return;

                        // Fix advantage card icons
                        var icons = document.querySelectorAll('.advantage-card-icon');
                        for (var i = 0; i < icons.length; i++) {
                            var icon = icons[i];
                            icon.style.cssText = 'width: 40px !important; height: 40px !important; max-width: 40px !important; max-height: 40px !important; min-width: 40px !important; min-height: 40px !important; box-sizing: border-box !important; overflow: hidden !important; flex-shrink: 0 !important;';

                            var svg = icon.querySelector('svg');
                            if (svg) {
                                svg.style.cssText = 'width: 40px !important; height: 40px !important; max-width: 40px !important; max-height: 40px !important; min-width: 40px !important; min-height: 40px !important; box-sizing: border-box !important; display: block !important; transform: scale(1) !important;';
                                svg.setAttribute('width', '40');
                                svg.setAttribute('height', '40');
                            }
                        }

                        // Close advantage card descriptions by default
                        var descriptions = document.querySelectorAll('.advantage-card-description');
                        for (var i = 0; i < descriptions.length; i++) {
                            var desc = descriptions[i];
                            desc.style.cssText = 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;';
                        }

                        // Fix breadcrumb icons and alignment
                        var figures = document.querySelectorAll('.breadcrumbs-list li a figure');
                        for (var i = 0; i < figures.length; i++) {
                            var figure = figures[i];
                            figure.style.cssText = 'width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; min-width: 16px !important; min-height: 16px !important; box-sizing: border-box !important; overflow: hidden !important; flex-shrink: 0 !important; margin: 0 !important; padding: 0 !important;';

                            var svg = figure.querySelector('svg');
                            if (svg) {
                                svg.style.cssText = 'width: 16px !important; height: 16px !important; max-width: 16px !important; max-height: 16px !important; min-width: 16px !important; min-height: 16px !important; box-sizing: border-box !important; display: block !important; transform: scale(1) !important; margin: 0 !important; padding: 0 !important; vertical-align: middle !important;';
                                svg.setAttribute('width', '16');
                                svg.setAttribute('height', '16');
                            }
                        }

                        // Fix breadcrumb list alignment
                        var breadcrumbLists = document.querySelectorAll('.breadcrumbs-list');
                        for (var i = 0; i < breadcrumbLists.length; i++) {
                            breadcrumbLists[i].style.cssText = 'align-items: center !important; display: flex !important; flex-wrap: wrap !important;';
                        }

                        var breadcrumbItems = document.querySelectorAll('.breadcrumbs-list li');
                        for (var i = 0; i < breadcrumbItems.length; i++) {
                            breadcrumbItems[i].style.cssText = 'display: flex !important; align-items: center !important; vertical-align: middle !important;';
                        }

                        var breadcrumbLinks = document.querySelectorAll('.breadcrumbs-list li a');
                        for (var i = 0; i < breadcrumbLinks.length; i++) {
                            breadcrumbLinks[i].style.cssText = 'display: flex !important; align-items: center !important; vertical-align: middle !important; line-height: 1 !important;';
                        }
                    };

                    // Apply immediately when DOM is ready
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(fixOperaIcons, 0);
                            setTimeout(fixOperaIcons, 100);
                            setTimeout(fixOperaIcons, 500);
                        });
                    } else {
                        setTimeout(fixOperaIcons, 0);
                        setTimeout(fixOperaIcons, 100);
                        setTimeout(fixOperaIcons, 500);
                    }

                    // Watch for changes
                    if (document.body) {
                        var observer = new MutationObserver(function() {
                            fixOperaIcons();
                        });
                        observer.observe(document.body, {
                            childList: true,
                            subtree: true
                        });
                    }

                    // Setup card click handlers for Opera Android
                    var setupOperaCardHandlers = function() {
                        var cards = document.querySelectorAll('.advantage-card');
                        for (var i = 0; i < cards.length; i++) {
                            // Use IIFE to create proper closure for each card
                            (function(currentCard) {
                                var card = currentCard;
                                var description = card.querySelector('.advantage-card-description');
                                if (description) {
                                    var isOpen = false;
                                    var touchTimeout;

                                    var openCard = function() {
                                        if (window.innerWidth <= 768) {
                                            isOpen = true;
                                            card.classList.add('touched');
                                            description.style.cssText = 'visibility: visible !important; max-height: 300px !important; opacity: 1 !important; margin-top: 1rem !important; overflow: hidden !important;';
                                        }
                                    };

                                    var closeCard = function() {
                                        if (window.innerWidth <= 768) {
                                            isOpen = false;
                                            card.classList.remove('touched');
                                            description.style.cssText = 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;';
                                        }
                                    };

                                    // Click handler
                                    card.addEventListener('click', function(e) {
                                        if (window.innerWidth <= 768) {
                                            e.preventDefault();
                                            e.stopPropagation();

                                            clearTimeout(touchTimeout);

                                            if (isOpen) {
                                                closeCard();
                                            } else {
                                                // Close other cards
                                                var allCards = document.querySelectorAll('.advantage-card');
                                                for (var j = 0; j < allCards.length; j++) {
                                                    if (allCards[j] !== card) {
                                                        var otherDesc = allCards[j].querySelector('.advantage-card-description');
                                                        if (otherDesc) {
                                                            allCards[j].classList.remove('touched');
                                                            otherDesc.style.cssText = 'max-height: 0 !important; opacity: 0 !important; overflow: hidden !important; margin-top: 0 !important; visibility: hidden !important;';
                                                        }
                                                    }
                                                }
                                                openCard();

                                                touchTimeout = setTimeout(function() {
                                                    closeCard();
                                                }, 5000);
                                            }
                                        }
                                    }, true);
                                }
                            })(cards[i]);
                        }
                    };

                    // Setup handlers when DOM is ready
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', function() {
                            setTimeout(setupOperaCardHandlers, 100);
                            setTimeout(setupOperaCardHandlers, 500);
                        });
                    } else {
                        setTimeout(setupOperaCardHandlers, 100);
                        setTimeout(setupOperaCardHandlers, 500);
                    }
                }
            })();
        </script>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <header class="site-header">
        <div class="container">
            <a href="<?php echo home_url(); ?>" class="brand-logo-container">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white-200.webp"
                    alt="Логотип компании ЭЛИНАР ПЛАСТ"
                    class="logo-image logo-white"
                    width="200"
                    height="80"
                    style="pointer-events: none !important; touch-action: none !important;">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-color-200.webp"
                    alt="Логотип компании ЭЛИНАР ПЛАСТ"
                    class="logo-image logo-color"
                    width="200"
                    height="80"
                    style="pointer-events: none !important; touch-action: none !important;">
            </a>

            <nav class="main-nav">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'items_wrap' => '<ul>%3$s</ul>',
                    'add_li_class' => 'menu-item',
                    // Fallback if no menu assigned (без пункта "Главная" - используется логотип)
                    'fallback_cb' => function () {
                        echo '<ul>
                        <li class="menu-item"><a href="' . home_url('/products') . '">Продукция</a></li>
                        <li class="menu-item"><a href="' . home_url('/partners') . '">Партнеры</a></li>
                        <li class="menu-item"><a href="' . home_url('/about') . '">О нас</a></li>
                        <li class="menu-item"><a href="' . home_url('/contacts') . '">Контакты</a></li>
                    </ul>';
                    }
                ));
                ?>
                <div class="mobile-menu-cta">
                    <div class="mobile-menu-cta-icons">
                        <a href="#" class="social-icon phone-icon" id="call-back-btn" title="Заказать звонок">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                        </a>
                        <a href="https://t.me/+79169785814" target="_blank" class="social-icon telegram-icon" title="Telegram">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036 .306.02.472-.18 1.898-.962 6.502-1.361 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>

            <div class="header-actions">
                <a href="#" class="social-icon phone-icon" id="call-back-btn-header" title="Заказать звонок">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                    </svg>
                </a>
                <div class="header-socials">
                    <a href="https://t.me/+79169785814" target="_blank" class="social-icon telegram-icon" title="Telegram">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036 .306.02.472-.18 1.898-.962 6.502-1.361 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Mobile menu toggle - outside header-actions so it's not hidden -->
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div><!-- /.container -->
    </header>

    <?php
    // Breadcrumbs - показываем на всех страницах кроме главной
    if (!is_front_page()):
    ?>
        <div class="breadcrumbs-wrapper">
            <div class="container">
                <?php get_template_part('template-parts/breadcrumbs'); ?>
            </div>
        </div>
    <?php endif; ?>
