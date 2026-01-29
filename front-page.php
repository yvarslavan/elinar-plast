<?php
// Форма обрабатывается универсальным обработчиком в functions.php (elinar_handle_project_form_universal)
get_header();
?>

<main>

    <!-- 1. HERO BLOCK -->
    <section class="hero">
        <!-- Hero Background Image Layer - Optimized for LCP -->
        <?php
        $template_uri = esc_url(get_template_directory_uri());
        ?>
        <div class="hero-bg-image">
            <picture>
                <!-- Адаптивные WebP изображения -->
                <source media="(max-width: 768px)" srcset="<?php echo $template_uri; ?>/assets/images/hero-bg-mobile-main.webp" type="image/webp">
                <source media="(max-width: 1024px)" srcset="<?php echo $template_uri; ?>/assets/images/hero-bg-tablet-main.webp" type="image/webp">
                <source srcset="<?php echo $template_uri; ?>/assets/images/hero-bg-desktop-main.webp" type="image/webp">
                <!-- WebP fallback для десктопа -->
                <img src="<?php echo $template_uri; ?>/assets/images/hero-bg-desktop-main.webp"
                    alt="Производство пластиковых профилей Элинар Пласт"
                    class="hero-bg-img"
                    fetchpriority="high"
                    decoding="sync"
                    width="1920"
                    height="1080">
            </picture>
        </div>

        <div class="container">
            <div class="hero-content">
                <h1>
                    <span class="hero-title-line">ПРОФИЛИ, КОТОРЫЕ</span>
                    <span class="hero-title-line">СЛУЖАТ <span class="text-orange">ДЕСЯТИЛЕТИЯМИ</span></span>
                </h1>
                <p class="hero-subtitle">Профессиональное производство изделий из пластмасс с 2001 года</p>
                <div class="hero-actions">
                    <a href="#contact-form" class="btn btn-primary">Связаться с нами</a>
                    <a href="<?php echo home_url('/quote-request'); ?>" class="btn btn-accent">Заполнить детальную заявку</a>
                </div>
            </div>
        </div>

        <!-- Scroll Down Button -->
        <?php get_template_part('template-parts/scroll-down-btn'); ?>
    </section>

    <!-- 2. MODERN PRODUCTION SLIDER -->
    <?php include get_template_directory() . '/template-parts/production-slider.php'; ?>

    <!-- 2.1. STATS BLOCK -->
    <section class="section bg-dark text-white stats-section stats-tech-design">
        <div class="container">
            <div class="section-title text-white">
                <h2 style="color: #fff;">Рост компании за 10 лет</h2>
                <p style="color: #cbd5e1;">Эти результаты подтверждают устойчивое развитие, инвестиции в технологии и высокую оценку нашей работы клиентами.</p>
            </div>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div class="stat-number" data-target="13" data-prefix="×">0</div>
                    <div class="stat-label">Рост выручки</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="stat-number" data-target="16" data-prefix="×">0</div>
                    <div class="stat-label">Увеличение объема производства</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div class="stat-number" data-target="8" data-prefix="×">0</div>
                    <div class="stat-label">Рост выпуска профильной продукции</div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon-wrapper">
                        <svg class="stat-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="stat-number" data-target="5" data-prefix="×">0</div>
                    <div class="stat-label">Увеличение числа клиентов</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2.5. KEY DIRECTIONS - INDUSTRIAL TECH -->
    <?php include get_template_directory() . '/template-parts/key-directions.php'; ?>

    <!-- 2.1. SPECIALIZED SOLUTIONS (Fixed Styles) -->
    <section class="section solutions-section">
        <div class="container">
            <!-- Header -->
            <div class="section-title text-center">
                <h2>Контрактное производство полимерных профилей и изделий по ТЗ</h2>
                <div class="section-intro-text">
                    <p>От компонентов для фасадных систем до высокоточных узлов приборостроения. Реализуем проекты, где требуются уникальные физико-механические свойства и безупречная точность.</p>
                </div>
            </div>

            <!-- Grid -->
            <div class="solutions-grid">

                <!-- Card 1: Термовставки -->
                <div class="solution-card group">
                    <div class="solution-icon icon-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="18" rx="2"></rect>
                            <line x1="8" y1="3" x2="8" y2="21"></line>
                            <line x1="16" y1="3" x2="16" y2="21"></line>
                        </svg>
                    </div>
                    <h3 class="solution-title">Термовставки из ПВХ</h3>
                    <p class="solution-desc">
                        Ударопрочный материал для фасадных систем. Стабильная геометрия и высокие теплоизоляционные свойства.
                    </p>
                    <button class="solution-link product-modal-trigger" data-modal-target="pvc-modal">
                        Подробнее <span>→</span>
                    </button>
                </div>

                <!-- Card 2: Фаскообразователи -->
                <div class="solution-card group">
                    <div class="solution-icon icon-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 21h18"></path>
                            <path d="M5 21V7l8-4 8 4v14"></path>
                            <path d="M5 7l14 14"></path>
                        </svg>
                    </div>
                    <h3 class="solution-title">Фаскообразователи</h3>
                    <p class="solution-desc">
                        Профили для создания фасок на железобетонных изделиях. Обеспечивают ровные края и защиту углов при распалубке.
                    </p>
                    <button class="solution-link product-modal-trigger" data-modal-target="chamfer-modal">
                        Подробнее <span>→</span>
                    </button>
                </div>

                <!-- Card 3: Осветительный шинопровод -->
                <div class="solution-card group">
                    <div class="solution-icon icon-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v4"></path>
                            <path d="M12 18v4"></path>
                            <path d="M4.93 4.93l2.83 2.83"></path>
                            <path d="M16.24 16.24l2.83 2.83"></path>
                            <path d="M2 12h4"></path>
                            <path d="M18 12h4"></path>
                            <path d="M4.93 19.07l2.83-2.83"></path>
                            <path d="M16.24 7.76l2.83-2.83"></path>
                        </svg>
                    </div>
                    <h3 class="solution-title">Профили для осветительного шинопровода</h3>
                    <p class="solution-desc">
                        Обеспечивают установку источников света с надежным креплением и высокой электробезопасностью.
                    </p>
                    <button class="solution-link product-modal-trigger" data-modal-target="profiles-modal">
                        Подробнее <span>→</span>
                    </button>
                </div>

                <!-- Card 4: Бытовая техника -->
                <div class="solution-card group">
                    <div class="solution-icon icon-cyan">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="4" y="2" width="16" height="20" rx="2"></rect>
                            <line x1="4" y1="10" x2="20" y2="10"></line>
                            <path d="M12 14h.01"></path>
                        </svg>
                    </div>
                    <h3 class="solution-title">Профили для бытовой техники</h3>
                    <p class="solution-desc">
                        Производство сложных профилей для холодильников, плит и стиральных машин. Точное соответствие чертежам.
                    </p>
                    <button class="solution-link product-modal-trigger" data-modal-target="injection-modal">
                        Подробнее <span>→</span>
                    </button>
                </div>

                <!-- Card 5: Втулки -->
                <div class="solution-card group">
                    <div class="solution-icon icon-pink">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <circle cx="12" cy="12" r="4"></circle>
                        </svg>
                    </div>
                    <h3 class="solution-title">Полимерные втулки</h3>
                    <p class="solution-desc">
                        Шпули для намотки изоленты, медпластыря и пленок. Материал, длина и цвет — строго по ТЗ заказчика.
                    </p>
                    <button class="solution-link product-modal-trigger" data-modal-target="extruded-modal">
                        Подробнее <span>→</span>
                    </button>
                </div>

                <!-- Card 6: Профили для фургонов -->
                <div class="solution-card group">
                    <div class="solution-icon icon-slate">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="1" y="3" width="15" height="13"></rect>
                            <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                            <circle cx="5.5" cy="18.5" r="2.5"></circle>
                            <circle cx="18.5" cy="18.5" r="2.5"></circle>
                        </svg>
                    </div>
                    <h3 class="solution-title">Профили для фургонов</h3>
                    <p class="solution-desc">
                        Прочные профили 140×55 мм для обвязки каркаса фургона. Защита от износа и механических повреждений.
                    </p>
                    <button class="solution-link product-modal-trigger" data-modal-target="truck-profile-modal">
                        Подробнее <span>→</span>
                    </button>
                </div>

            </div>
        </div>
    </section>

    <?php if (!defined('ELINAR_OPT_FRONT_PAGE_ASSETS') || !ELINAR_OPT_FRONT_PAGE_ASSETS): ?>
        <style>
            .solutions-section {
                padding: 6rem 0;
                background-color: #fff;
            }

            .solutions-section .section-title {
                margin-bottom: 4rem;
            }

            .solutions-grid {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            @media (min-width: 768px) {
                .solutions-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (min-width: 1024px) {
                .solutions-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            .solution-card {
                background: #fff;
                padding: 2rem;
                border-radius: 2.5rem;
                /* 40px */
                border: 1px solid #f1f5f9;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                transition: all 0.5s ease;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .solution-card:hover {
                transform: translateY(-0.5rem);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .solution-icon {
                width: 4rem;
                height: 4rem;
                border-radius: 1rem;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 1.5rem;
                transition: all 0.3s ease;
            }

            .solution-icon svg {
                transition: color 0.3s ease;
            }

            /* Icon Colors */
            .icon-blue {
                background-color: #eff6ff;
                color: #2563eb;
            }

            .solution-card:hover .icon-blue {
                background-color: #2563eb;
                color: #fff;
            }

            .icon-orange {
                background-color: #fff7ed;
                color: #ea580c;
            }

            .solution-card:hover .icon-orange {
                background-color: #ea580c;
                color: #fff;
            }

            .icon-purple {
                background-color: #faf5ff;
                color: #9333ea;
            }

            .solution-card:hover .icon-purple {
                background-color: #9333ea;
                color: #fff;
            }

            .icon-cyan {
                background-color: #ecfeff;
                color: #0891b2;
            }

            .solution-card:hover .icon-cyan {
                background-color: #0891b2;
                color: #fff;
            }

            .icon-pink {
                background-color: #fdf2f8;
                color: #db2777;
            }

            .solution-card:hover .icon-pink {
                background-color: #db2777;
                color: #fff;
            }

            .icon-slate {
                background-color: #f1f5f9;
                color: #475569;
            }

            .solution-card:hover .icon-slate {
                background-color: #334155;
                color: #fff;
            }

            .solution-title {
                font-size: 1.25rem;
                font-weight: 700;
                color: #0f172a;
                margin-bottom: 0.75rem;
            }

            .solution-desc {
                color: #64748b;
                line-height: 1.625;
                font-size: 0.95rem;
                margin-bottom: 1.5rem;
                flex-grow: 1;
            }

            .solution-link {
                color: #0052D4;
                font-weight: 600;
                font-size: 0.95rem;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: none;
                border: none;
                padding: 0;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .solution-card:hover .solution-link {
                gap: 0.75rem;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // 1. Открытие модальных окон
                const triggers = document.querySelectorAll('.product-modal-trigger');
                triggers.forEach(function(trigger) {
                    trigger.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const targetId = this.getAttribute('data-modal-target');
                        if (targetId) {
                            const modal = document.getElementById(targetId);
                            if (modal) {
                                modal.classList.add('show');
                                document.body.style.overflow = 'hidden';
                            } else {
                                console.error('Modal not found:', targetId);
                            }
                        }
                    });
                });

                // 2. Закрытие модальных окон (крестик)
                const closeButtons = document.querySelectorAll('.modal-close');
                closeButtons.forEach(function(button) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        const modal = this.closest('.modal');
                        if (modal) {
                            modal.classList.remove('show');
                            document.body.style.overflow = '';
                        }
                    });
                });

                // 3. Закрытие по клику вне контента (на затемненный фон)
                const modals = document.querySelectorAll('.modal');
                modals.forEach(function(modal) {
                    modal.addEventListener('click', function(e) {
                        if (e.target === this) {
                            this.classList.remove('show');
                            document.body.style.overflow = '';
                        }
                    });
                });
            });
        </script>
    <?php endif; ?>



    <!-- FAQ Cross-Promo Banner -->
    <section class="section faq-cross-promo-section">
        <div class="container">
            <div class="faq-cross-promo" id="faq-cross-promo" data-page="home">
                <div class="faq-cross-promo-content">
                    <div class="faq-cross-promo-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    </div>
                    <div class="faq-cross-promo-text">
                        <h3 class="faq-cross-promo-title">Вопросы по срокам, партиям и оснастке?</h3>
                        <p class="faq-cross-promo-desc">Готовые ответы по контрактному производству</p>
                    </div>
                    <a href="<?php echo home_url('/technologies-and-contract-manufacturing/#faq'); ?>" class="faq-cross-promo-btn" data-faq-teaser="cross-promo-home">
                        Смотреть ответы
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
                <button class="faq-cross-promo-close" aria-label="Закрыть" data-close-banner="faq-cross-promo">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- 4. FEATURES (Why Choose Us) -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Почему выбирают нас</h2>
            </div>
            <div class="advantages-grid">
                <div class="advantage-card">
                    <div class="advantage-card-inner">
                        <div class="advantage-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <!-- Здание завода -->
                                <rect x="3" y="11" width="18" height="10" rx="0.5" stroke="#0056B3" stroke-width="1" fill="none" />
                                <rect x="6" y="14" width="2.5" height="2.5" stroke="#0056B3" stroke-width="1" fill="none" />
                                <rect x="10" y="14" width="2.5" height="2.5" stroke="#0056B3" stroke-width="1" fill="none" />
                                <rect x="14.5" y="14" width="2.5" height="2.5" stroke="#0056B3" stroke-width="1" fill="none" />
                                <!-- Труба -->
                                <rect x="18" y="7" width="2" height="4" stroke="#0056B3" stroke-width="1" fill="none" />
                                <!-- Дым из трубы -->
                                <path d="M18.5 6.5 Q18 5.5 18.5 4.5" stroke="#0056B3" stroke-width="1" fill="none" />
                                <path d="M19.5 6.5 Q20 5.5 19.5 4.5" stroke="#0056B3" stroke-width="1" fill="none" />
                                <!-- Флаг РФ (триколор) -->
                                <path d="M4 11 L4 5 L10 5 L10 11" stroke="#0056B3" stroke-width="1" fill="none" />
                                <!-- Белая полоса -->
                                <rect x="4" y="5" width="6" height="2" fill="#FFFFFF" stroke="#0056B3" stroke-width="0.5" />
                                <!-- Синяя полоса -->
                                <rect x="4" y="7" width="6" height="2" fill="#0056B3" stroke="none" />
                                <!-- Красная полоса -->
                                <rect x="4" y="9" width="6" height="2" fill="#D52B1E" stroke="none" />
                            </svg>
                        </div>
                        <h4 class="advantage-card-title">Локальное производство в России</h4>
                        <div class="advantage-card-description">
                            <p>Наш офис и производственная площадка расположены в Московской области рядом с Наро-Фоминском. Мы обеспечиваем стабильные сроки, прозрачную логистику и быстрое выполнение заказов без зависимости от импортных цепочек.</p>
                        </div>
                    </div>
                </div>

                <div class="advantage-card">
                    <div class="advantage-card-inner">
                        <div class="advantage-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0056B3" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M3 12c0-1.5.5-3 1.5-4.2M21 12c0 1.5-.5 3-1.5 4.2" />
                                <path d="M12 3v2M12 19v2" />
                                <path d="M9 8h2v3h3" />
                                <path d="M13 13l2 2" />
                            </svg>
                        </div>
                        <h4 class="advantage-card-title">Более 20 лет опыта и репутации</h4>
                        <div class="advantage-card-description">
                            <p>С 2001 года мы производим пластиковые профили и инженерные изделия для предприятий промышленности, строительства и энергетики. Наши заказчики ценят стабильность качества, предсказуемость поставок и профессиональный подход.</p>
                        </div>
                    </div>
                </div>

                <div class="advantage-card">
                    <div class="advantage-card-inner">
                        <div class="advantage-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0056B3" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M7 3v3c0 2 1 3 3 3h4c2 0 3-1 3-3V3" />
                                <path d="M7 21v-3c0-2 1-3 3-3h4c2 0 3 1 3 3v3" />
                                <path d="M3 7h3c2 0 3 1 3 3v4c0 2-1 3-3 3H3" />
                                <path d="M21 7h-3c-2 0-3 1-3 3v4c0 2 1 3 3 3h3" />
                            </svg>
                        </div>
                        <h4 class="advantage-card-title">Гибкость в выполнении заказов</h4>
                        <div class="advantage-card-description">
                            <p>Изготавливаем профили нужной длины без доплат и подбираем цвет под вашу задачу. Быстро адаптируем производство под нестандартные требования.</p>
                        </div>
                    </div>
                </div>

                <div class="advantage-card">
                    <div class="advantage-card-inner">
                        <div class="advantage-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0056B3" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="9" y="9" width="6" height="6" rx="1" />
                                <path d="M12 9V3M12 21v-6" />
                                <path d="M9 12H3M21 12h-6" />
                                <path d="M9.88 9.88L6 6M18 18l-3.88-3.88" />
                                <path d="M14.12 9.88L18 6M6 18l3.88-3.88" />
                                <circle cx="12" cy="12" r="1.5" />
                            </svg>
                        </div>
                        <h4 class="advantage-card-title">Производственные возможности в одном месте</h4>
                        <div class="advantage-card-description">
                            <p>На одной площадке объединены несколько технологий переработки пластмасс: экструзия и литье под давлением. Мы выполняем комплексные проекты без привлечения сторонних подрядчиков.</p>
                        </div>
                    </div>
                </div>

                <div class="advantage-card">
                    <div class="advantage-card-inner">
                        <div class="advantage-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0056B3" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12a9 9 0 1 1-9-9" />
                                <path d="M12 3a9 9 0 0 1 9 9" />
                                <polyline points="12 8 12 12 15 15" />
                                <circle cx="7" cy="12" r="0.5" />
                                <circle cx="12" cy="17" r="0.5" />
                                <circle cx="17" cy="12" r="0.5" />
                            </svg>
                        </div>
                        <h4 class="advantage-card-title">Полный цикл: от оснастки до серии</h4>
                        <div class="advantage-card-description">
                            <p>Производство изделий «под ключ»: организуем изготовление оснастки, запускаем серийное производство.</p>
                        </div>
                    </div>
                </div>

                <div class="advantage-card">
                    <div class="advantage-card-inner">
                        <div class="advantage-card-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0056B3" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="9" />
                                <path d="M9 12l2 2 4-4" />
                                <path d="M12 3v2M12 19v2" />
                                <path d="M3 12h2M19 12h2" />
                            </svg>
                        </div>
                        <h4 class="advantage-card-title">Цена и качество в балансе</h4>
                        <div class="advantage-card-description">
                            <p>Помогаем реализовать технические и дизайнерские идеи с оптимальными затратами. Используем эффективные технологии и материалы без потери качества.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- 7. PRODUCTION CYCLE - Progress Pipeline -->
    <?php include get_template_directory() . '/template-parts/production-cycle.php'; ?>

    <!-- 9. FINAL CTA - TECHNICAL AUDIT SECTION -->
    <?php include get_template_directory() . '/template-parts/audit-form-section.php'; ?>

</main>

<?php if (!defined('ELINAR_OPT_FRONT_PAGE_ASSETS') || !ELINAR_OPT_FRONT_PAGE_ASSETS): ?>
    <style>
        /* Стили формы для главной страницы */
        .cta-section .cta-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        .cta-section .cta-form-wrapper {
            width: 100%;
        }

        @media (max-width: 768px) {
            .cta-section .cta-wrapper {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        .cta-section .project-form .form-group {
            margin-bottom: 1rem;
        }

        .cta-section .project-form input,
        .cta-section .project-form textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            font-size: 1rem;
            font-family: inherit;
            box-sizing: border-box;
        }

        .cta-section .project-form input::placeholder,
        .cta-section .project-form textarea::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .cta-section .project-form input:focus,
        .cta-section .project-form textarea:focus {
            outline: none;
            border-color: #f59e0b;
            background: rgba(255, 255, 255, 0.15);
        }

        .cta-section .file-upload-group {
            margin: 1rem 0;
        }

        .cta-section .file-upload-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border: 2px dashed rgba(255, 255, 255, 0.4);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            flex-wrap: wrap;
            line-height: 1.4;
        }

        .cta-section .file-upload-label:hover {
            border-color: #f59e0b;
            background: rgba(245, 158, 11, 0.1);
        }

        .cta-section .file-upload-label svg {
            flex-shrink: 0;
        }

        .cta-section .file-upload-label span {
            flex: 1;
            min-width: 0;
            word-wrap: break-word;
        }

        .cta-section .file-info {
            margin-top: 8px;
            padding: 8px 12px;
            background: rgba(34, 197, 94, 0.2);
            border-radius: 6px;
            color: #86efac;
            font-size: 0.9rem;
            display: none;
        }

        .cta-section .file-info.show {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cta-section .file-info .remove-file {
            cursor: pointer;
            color: #fca5a5;
            font-weight: bold;
            padding: 2px 8px;
        }

        .cta-section .form-message {
            margin-bottom: 1rem;
            padding: 12px 16px;
            border-radius: 8px;
            text-align: center;
        }

        .cta-section .form-message.success {
            background: rgba(34, 197, 94, 0.2);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.4);
        }

        .cta-section .form-message.error {
            background: rgba(239, 68, 68, 0.2);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.4);
        }

        .cta-section .form-error {
            display: block;
            color: #fca5a5;
            font-size: 0.85rem;
            margin-top: 4px;
        }

        .cta-section .form-note {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 1rem;
            text-align: center;
        }

        .cta-section .form-note a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: underline;
        }

        .cta-section .form-buttons {
            margin-top: 1rem;
        }

        .cta-section .close-message {
            cursor: pointer;
            float: right;
            font-weight: bold;
            margin-left: 10px;
        }

        /* ============================================
           AUDIT SECTION - TECHNICAL AUDIT REDESIGN
           ============================================ */
        .audit-section {
            background: linear-gradient(135deg, #0a1628 0%, #1e3a5f 50%, #0d2137 100%);
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .audit-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(ellipse at 20% 20%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(ellipse at 80% 80%, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .audit-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            position: relative;
            z-index: 1;
        }

        .audit-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            align-items: start;
        }

        @media (min-width: 1024px) {
            .audit-grid {
                grid-template-columns: 7fr 5fr;
                gap: 4rem;
            }
        }

        /* LEFT COLUMN - Content */
        .audit-content {
            color: #fff;
        }

        .audit-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(59, 130, 246, 0.2);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 9999px;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #93c5fd;
            margin-bottom: 1.5rem;
        }

        .audit-badge svg {
            color: #60a5fa;
        }

        .audit-title {
            font-size: 2rem;
            line-height: 1.25;
            font-weight: 700;
            color: #fff;
            margin: 0 0 2.5rem 0;
        }

        @media (min-width: 768px) {
            .audit-title {
                font-size: 2.5rem;
            }
        }

        .audit-highlight {
            color: #ff6b35;
            position: relative;
        }

        .audit-highlight::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, #ff6b35, #e85a2a);
            border-radius: 2px;
        }

        .audit-benefits {
            margin-bottom: 2.5rem;
        }

        .benefits-heading {
            font-size: 1.125rem;
            font-weight: 600;
            color: #ffffff;
            margin: 0 0 1.5rem 0;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .benefit-item {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.25rem;
            align-items: flex-start;
        }

        .benefit-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .benefit-icon--blue {
            background: rgba(59, 130, 246, 0.2);
            color: #60a5fa;
        }

        .benefit-icon--green {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
        }

        .benefit-icon--orange {
            background: rgba(255, 107, 53, 0.2);
            color: #ff6b35;
        }

        .benefit-icon--purple {
            background: rgba(168, 85, 247, 0.2);
            color: #c084fc;
        }

        .benefit-text {
            flex: 1;
        }

        .benefit-text strong {
            display: block;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .benefit-text p {
            font-size: 0.9375rem;
            color: #94a3b8;
            line-height: 1.5;
            margin: 0;
        }

        /* Bonus Banner */
        .audit-bonus {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.15) 0%, rgba(234, 88, 12, 0.1) 100%);
            border: 1px solid rgba(255, 107, 53, 0.3);
            border-radius: 1rem;
            padding: 1.25rem 1.5rem;
        }

        .bonus-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #ff6b35 0%, #e85a2a 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #fff;
        }

        .bonus-text {
            font-size: 0.9375rem;
            color: #e2e8f0;
            line-height: 1.5;
        }

        .bonus-text strong {
            color: #ff6b35;
        }

        /* RIGHT COLUMN - Form Card */
        .audit-form-wrapper {
            width: 100%;
        }

        .audit-form-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 3rem;
            padding: 2.5rem;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                0 0 0 1px rgba(255, 255, 255, 0.1);
        }

        @media (min-width: 768px) {
            .audit-form-card {
                padding: 3rem;
            }
        }

        .form-card-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 0.5rem 0;
            text-align: center;
        }

        .form-card-subtitle {
            font-size: 0.9375rem;
            color: #64748b;
            text-align: center;
            margin: 0 0 2rem 0;
        }

        .audit-form-group {
            margin-bottom: 1rem;
        }

        .audit-input,
        .audit-textarea {
            width: 100%;
            padding: 1rem 1.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 9999px;
            background: #f8fafc;
            color: #0f172a;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .audit-textarea {
            border-radius: 1.5rem;
            resize: vertical;
            min-height: 100px;
        }

        .audit-input::placeholder,
        .audit-textarea::placeholder {
            color: #94a3b8;
        }

        .audit-input:focus,
        .audit-textarea:focus {
            outline: none;
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .audit-file-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1.25rem;
            border: 2px dashed #cbd5e1;
            border-radius: 1rem;
            background: #f8fafc;
            color: #64748b;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .audit-file-label:hover {
            border-color: #3b82f6;
            background: #eff6ff;
            color: #3b82f6;
        }

        .audit-file-label svg {
            color: #64748b;
            flex-shrink: 0;
        }

        .audit-file-label:hover svg {
            color: #3b82f6;
        }

        .audit-submit-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border: none;
            border-radius: 9999px;
            background: linear-gradient(135deg, #ff6b35 0%, #e85a2a 100%);
            color: #fff;
            font-size: 1.125rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);
            margin-top: 1.5rem;
        }

        .audit-submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(255, 107, 53, 0.5);
        }

        .audit-submit-btn:active {
            transform: translateY(-1px);
        }

        .audit-submit-btn svg {
            transition: transform 0.3s ease;
        }

        .audit-submit-btn:hover svg {
            transform: translateX(4px);
        }

        .audit-form-note {
            font-size: 0.75rem;
            color: #94a3b8;
            text-align: center;
            margin: 1rem 0 0 0;
            line-height: 1.5;
        }

        .audit-form-note a {
            color: #3b82f6;
            text-decoration: underline;
        }

        .audit-form-note a:hover {
            color: #2563eb;
        }

        /* Form messages */
        .audit-form-card .form-message {
            padding: 1rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.9375rem;
        }

        .audit-form-card .form-message.success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .audit-form-card .form-message.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .audit-form-card .form-error {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 0.25rem;
            display: block;
        }

        .audit-form-card .file-info {
            display: none;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem 1rem;
            background: #eff6ff;
            border-radius: 0.5rem;
            margin-top: 0.5rem;
            font-size: 0.875rem;
            color: #3b82f6;
        }

        .audit-form-card .file-info.show {
            display: flex;
        }

        .audit-form-card .remove-file {
            cursor: pointer;
            color: #dc2626;
            font-weight: bold;
        }

        /* Alternative CTA - Detailed Request */
        .audit-alternative-cta {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .alternative-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .alternative-divider::before,
        .alternative-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        }

        .alternative-divider span {
            color: #64748b;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .audit-detailed-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.75rem;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.25);
            border-radius: 9999px;
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .audit-detailed-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .audit-detailed-btn svg {
            color: #ff6b35;
            flex-shrink: 0;
        }

        .alternative-note {
            font-size: 0.8125rem;
            color: #64748b;
            margin: 0.75rem 0 0 0;
        }

        /* Mobile adjustments */
        @media (max-width: 767px) {
            .audit-section {
                padding: 4rem 0;
            }

            .audit-title {
                font-size: 1.75rem;
            }

            .audit-form-card {
                padding: 2rem 1.5rem;
                border-radius: 2rem;
            }

            .benefit-item {
                flex-direction: column;
                gap: 0.75rem;
            }

            .benefit-icon {
                width: 40px;
                height: 40px;
            }

            .audit-bonus {
                flex-direction: column;
                text-align: center;
            }

            .bonus-icon {
                margin: 0 auto;
            }

            .audit-alternative-cta {
                text-align: center;
            }

            .audit-detailed-btn {
                width: 100%;
                justify-content: center;
            }

            .alternative-note {
                text-align: center;
            }
        }
    </style>

    <script>
        (function() {
            'use strict';

            // Очищаем URL от параметров формы после загрузки
            if (window.location.search.includes('form=')) {
                const cleanUrl = window.location.pathname + window.location.hash;
                window.history.replaceState({}, document.title, cleanUrl);
            }

            // Маска телефона +7 (999) 999-99-99
            const phoneInput = document.getElementById('form-phone');
            if (phoneInput) {
                phoneInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 0) {
                        if (value[0] === '8') value = '7' + value.slice(1);
                        if (value[0] !== '7') value = '7' + value;
                    }
                    let formatted = '';
                    if (value.length > 0) formatted = '+7';
                    if (value.length > 1) formatted += ' (' + value.slice(1, 4);
                    if (value.length > 4) formatted += ') ' + value.slice(4, 7);
                    if (value.length > 7) formatted += '-' + value.slice(7, 9);
                    if (value.length > 9) formatted += '-' + value.slice(9, 11);
                    e.target.value = formatted;
                });
                phoneInput.addEventListener('focus', function() {
                    if (!this.value) this.value = '+7 (';
                });
                phoneInput.addEventListener('blur', function() {
                    if (this.value === '+7 (' || this.value === '+7') this.value = '';
                });
            }

            // Обработка файла
            const fileInput = document.getElementById('form-file');
            const fileInfo = document.getElementById('file-info');
            if (fileInput && fileInfo) {
                const allowedExtensions = ['.pdf', '.dwg', '.dxf', '.jpg', '.jpeg', '.png', '.zip'];
                const maxSize = 15 * 1024 * 1024;

                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    const fileError = document.getElementById('file-error');
                    if (!file) {
                        fileInfo.classList.remove('show');
                        fileInfo.innerHTML = '';
                        return;
                    }
                    const ext = '.' + file.name.split('.').pop().toLowerCase();
                    if (!allowedExtensions.includes(ext)) {
                        if (fileError) fileError.textContent = 'Недопустимый формат файла.';
                        this.value = '';
                        fileInfo.classList.remove('show');
                        return;
                    }
                    if (file.size > maxSize) {
                        if (fileError) fileError.textContent = 'Файл слишком большой. Максимум 15 МБ.';
                        this.value = '';
                        fileInfo.classList.remove('show');
                        return;
                    }
                    if (fileError) fileError.textContent = '';
                    const sizeMB = (file.size / 1024 / 1024).toFixed(2);
                    fileInfo.innerHTML = '<span>' + file.name + ' (' + sizeMB + ' МБ)</span><span class="remove-file" onclick="removeFile()">✕</span>';
                    fileInfo.classList.add('show');
                });
            }

            window.removeFile = function() {
                if (fileInput) fileInput.value = '';
                if (fileInfo) {
                    fileInfo.classList.remove('show');
                    fileInfo.innerHTML = '';
                }
            };
        })();

        // === FAQ CROSS-PROMO BANNER FUNCTIONALITY ===
        (function() {
            'use strict';

            // Закрытие баннера с сохранением в localStorage
            function closeBanner(bannerId) {
                const banner = document.getElementById(bannerId);
                if (banner) {
                    banner.classList.add('hidden');
                    localStorage.setItem('faq_banner_' + bannerId + '_closed', 'true');

                    // Отслеживание закрытия для аналитики
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'faq_banner_closed', {
                            'event_category': 'FAQ Banner',
                            'event_label': bannerId + '_home',
                            'value': 1
                        });
                    }
                }
            }

            // Обработчик закрытия баннера
            const closeButton = document.querySelector('[data-close-banner="faq-cross-promo"]');
            if (closeButton) {
                closeButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeBanner('faq-cross-promo');
                });
            }

            // Проверка localStorage при загрузке страницы
            const banner = document.getElementById('faq-cross-promo');
            if (banner && localStorage.getItem('faq_banner_faq-cross-promo_closed') === 'true') {
                banner.classList.add('hidden');
            }

            // Отслеживание клика на кнопку тизера
            const promoBtn = document.querySelector('[data-faq-teaser="cross-promo-home"]');
            if (promoBtn) {
                promoBtn.addEventListener('click', function() {
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'faq_teaser_click', {
                            'event_category': 'FAQ Teaser',
                            'event_label': 'cross-promo-home',
                            'value': 1
                        });
                    }
                    if (typeof ym !== 'undefined') {
                        ym(window.yaCounterId || 0, 'reachGoal', 'faq_teaser_click', {
                            teaser_type: 'cross-promo-home'
                        });
                    }
                });
            }
        })();
    </script>
<?php endif; ?>

<?php get_footer(); ?>
