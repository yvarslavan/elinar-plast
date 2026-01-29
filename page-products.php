<?php
/*
Template Name: Products Page
*/
// Форма обрабатывается универсальным обработчиком в functions.php (elinar_handle_project_form_universal)

get_header();
?>

<!-- Schema.org Product Catalog Structured Data -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "ItemList",
        "name": "Каталог полимерных изделий Элинар-Пласт",
        "description": "Производство полимерных изделий по немецким технологиям: термовставки, фаскообразователи, технические профили",
        "url": "<?php echo esc_url(get_permalink()); ?>",
        "numberOfItems": 6,
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "item": {
                    "@type": "Product",
                    "name": "Термовставки из ПВХ",
                    "description": "Ударопрочные профили для фасадных алюминиевых систем",
                    "category": "Строительные системы",
                    "manufacturer": {
                        "@type": "Organization",
                        "name": "Элинар-Пласт"
                    }
                }
            },
            {
                "@type": "ListItem",
                "position": 2,
                "item": {
                    "@type": "Product",
                    "name": "Фаскообразователи",
                    "description": "Профили для формирования точных углов на железобетонных изделиях",
                    "category": "Строительные системы"
                }
            },
            {
                "@type": "ListItem",
                "position": 3,
                "item": {
                    "@type": "Product",
                    "name": "Профили для осветительного шинопровода",
                    "description": "Погонажные изделия для приборостроения, электротехники и легкой промышленности",
                    "category": "Инженерные профили"
                }
            },
            {
                "@type": "ListItem",
                "position": 4,
                "item": {
                    "@type": "Product",
                    "name": "Профили для бытовой техники",
                    "description": "Пластиковые профили и детали для холодильников, плит, стиральных машин и другой бытовой техники",
                    "category": "Комплектующие"
                }
            },
            {
                "@type": "ListItem",
                "position": 5,
                "item": {
                    "@type": "Product",
                    "name": "Полимерные втулки и кольца",
                    "description": "Шпули для намотки изоленты, медицинского пластыря и упаковочных пленок",
                    "category": "Комплектующие"
                }
            },
            {
                "@type": "ListItem",
                "position": 6,
                "item": {
                    "@type": "Product",
                    "name": "Профили для фургонов",
                    "description": "Облицовочные профили для обвязки каркаса грузового транспорта",
                    "category": "Инженерные профили"
                }
            }
        ]
    }
</script>

<!-- CRITICAL CSS FIX: Slider Images Display -->
<style>
    /* Критическое исправление для отображения изображений в слайдерах */
    .production-gallery-slider .slider-image,
    .zigzag-slider .slider-image,
    .product-row__slider .slider-image {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
    }

    /* Контейнеры слайдера */
    .product-row__slider {
        position: relative !important;
        min-height: 400px !important;
        aspect-ratio: 4 / 3 !important;
        background: #f1f5f9;
        /* Light gray background instead of white just in case */
        overflow: hidden;
        /* Ensure no overflow */
    }

    .zigzag-slider,
    .production-gallery-slider {
        width: 100% !important;
        height: 100% !important;
        position: relative !important;
    }

    .slider-container {
        width: 100% !important;
        height: 100% !important;
        position: relative !important;
    }

    .slide {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }

    /* СПЕЦИФИЧНОЕ ИСПРАВЛЕНИЕ ДЛЯ СЛАЙДЕРА ПРОФИЛЕЙ */
    #profiles-slider-fix .slider-image,
    #profiles-slider-fix img {
        width: 100% !important;
        height: 100% !important;
        max-width: 100% !important;
        max-height: 100% !important;
        object-fit: cover !important;
        object-position: center center !important;
        display: block !important;
    }

    #profiles-slider-fix .slide {
        position: absolute !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }

    #profiles-slider-fix .slider-container {
        position: relative !important;
        width: 100% !important;
        height: 100% !important;
    }

    .product-row__details-summary span {
        margin-bottom: 0.5rem;
    }
</style>

<!-- HERO SECTION - Масштаб и технология -->
<section class="products-hero" id="products-hero">
    <div class="products-hero__bg" data-parallax="0.3">
        <picture>
            <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-mobile_product.webp" type="image/webp">
            <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-tablet_product.webp" type="image/webp">
            <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_product.webp" type="image/webp">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop_product.webp"
                alt="Производство полимерных изделий - немецкие технологии экструзии"
                class="products-hero__img"
                width="1920"
                height="800"
                fetchpriority="high"
                loading="eager"
                decoding="async">
        </picture>
    </div>
    <div class="products-hero__overlay"></div>
    <div class="products-hero__content">
        <div class="container">
            <h1 class="products-hero__title">
                ЭТАЛОННАЯ ГЕОМЕТРИЯ <span class="text-accent">ГАРАНТИРОВАННЫЙ</span> РЕСУРС
            </h1>
            <p class="products-hero__subtitle">
                Изготовление технических профилей любой сложности. Решения, сохраняющие свои эксплуатационные свойства десятилетиями.
            </p>
            <a href="#products-catalog" class="products-hero__cta" data-animate="fade-up" data-delay="0.4">
                <span>Смотреть продукцию</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12l7 7 7-7" />
                </svg>
            </a>
        </div>
    </div>
    <div class="products-hero__scroll-indicator">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
    </div>
</section>

<main class="products-page">
    <!-- STICKY PRODUCT NAVIGATION -->
    <div class="products-sticky-nav" id="products-nav">
        <div class="container">
            <nav class="products-sticky-nav__container">
                <a href="#section-pvc" class="products-nav__link active" data-target="section-pvc">Термовставки</a>
                <a href="#section-chamfer" class="products-nav__link" data-target="section-chamfer">Фаскообразователи</a>
                <a href="#section-profiles" class="products-nav__link" data-target="section-profiles">Шинопровод</a>
                <a href="#section-appliances" class="products-nav__link" data-target="section-appliances">Бытовая техника</a>
                <a href="#section-truck" class="products-nav__link" data-target="section-truck">Фургоны</a>
                <a href="#section-vtulki" class="products-nav__link" data-target="section-vtulki">Втулки</a>
            </nav>
        </div>
    </div>

    <!-- КАТАЛОГ РЕШЕНИЙ -->
    <section class="section products-catalog" id="products-catalog">
        <div class="container-wide">


            <div class="products-zigzag">

                <!-- Карточка 1: Термовставки из ПВХ -->
                <article id="section-pvc" class="product-row product-row--blue" data-material="pvc" data-industry="facades" data-animate="fade-up">
                    <div class="product-row__slider">
                        <div class="zigzag-slider production-gallery-slider">
                            <?php
                            $pvc_images = [
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-1.webp', 'alt' => 'Комбинированный фасадный профиль с многокамерной термовставкой. Высокотехнологичное решение для «теплых» светопрозрачных конструкций. Система включает в себя несущий алюминиевый профиль и многокамерную полимерную термовставку производства «Элинар Пласт».', 'loading' => 'eager'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-2.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-3.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-4.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-5.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-6.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-7.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-8.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-9.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-10.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-11.webp', 'alt' => 'Многокамерная термовставка: Технология и Материал', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-12.webp', 'alt' => 'Экструзионный инструмент (Фильеры): Формообразующая оснастка для производства термовставок и технических профилей', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-13.webp', 'alt' => 'Калибратор для прямоугольного профиля: Оснастка сухого типа для экструзии коробов и кабель-каналов', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/termovstavki/termovstavki-14.webp', 'alt' => 'Калибратор для U-образного профиля: Сухой калибратор разъемной конструкции для производства открытых каналов и лотков', 'loading' => 'lazy'],
                            ];
                            ?>
                            <div class="slider-container">
                                <?php foreach ($pvc_images as $index => $img): ?>
                                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                        <a href="<?php echo $img['src']; ?>" class="custom-lightbox-trigger glightbox" data-gallery="pvc" data-index="<?php echo $index; ?>" style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $img['src']; ?>"
                                                alt="<?php echo $img['alt']; ?>"
                                                class="slider-image"
                                                width="1000" height="750" loading="<?php echo $img['loading']; ?>"
                                                style="width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center !important;">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-nav slider-prev" aria-label="Предыдущее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="15 18 9 12 15 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <button class="slider-nav slider-next" aria-label="Следующее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="9 18 15 12 9 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <div class="slider-dots">
                                <?php foreach ($pvc_images as $index => $img): ?>
                                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Фото <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                            <div class="slider-counter">
                                <span class="slider-counter__current">1</span>
                                <span class="slider-counter__separator">/</span>
                                <span class="slider-counter__total"><?php echo count($pvc_images); ?></span>
                            </div>
                        </div>
                        <!-- Плашка описания при масштабировании -->
                        <!--
                        <div class="slider-description-panel" data-slider="pvc">
                            <div class="slider-description-panel__content">
                                <h4 class="slider-description-panel__title">Экструзионная оснастка: Инжиниринг и Точность</h4>
                                <p class="slider-description-panel__intro">Собственный инструментальный цех полного цикла позволяет нам проектировать и изготавливать фильеры и калибраторы любой сложности. Мы контролируем каждый этап — от чертежа до финишной полировки, гарантируя идеальную геометрию профиля и стабильность серийного производства.</p>
                                <ul class="slider-description-panel__features">
                                    <li class="slider-description-panel__feature">
                                        <strong>Высококачественные легированные стали</strong>
                                        <span>Использование специальных марок нержавеющей и инструментальной стали обеспечивает высокую коррозионную стойкость и долговечность оснастки даже при круглосуточной эксплуатации.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Прецизионная металлообработка</strong>
                                        <span>Изготовление формообразующих деталей на электроэрозионных и фрезерных станках с ЧПУ позволяет достигать микронной точности, необходимой для соблюдения строгих допусков готового изделия.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Эффективная система вакуумирования и охлаждения</strong>
                                        <span>Оптимизированная конструкция каналов охлаждения в калибраторах обеспечивает равномерное остывание профиля, предотвращая деформации, коробление и внутренние напряжения в пластике.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Сложная геометрия и тонкие стенки</strong>
                                        <span>Наши технологии позволяют создавать оснастку для многокамерных профилей, изделий с тонкими стенками, сложными замковыми соединениями и закладными элементами.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Финишная обработка поверхности</strong>
                                        <span>Многоступенчатая полировка рабочих поверхностей канала ("зеркало") гарантирует безупречную гладкость выпускаемого пластикового профиля и улучшает скольжение материала.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Оперативность и ремонтопригодность</strong>
                                        <span>Наличие собственного цеха позволяет сократить срок запуска новых проектов в 2 раза по сравнению с заказом оснастки на стороне, а также оперативно вносить корректировки.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="product-row__content">
                        <div class="product-row__header">
                            <div class="product-row__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M5 3v18" />
                                    <path d="M19 3v18" />
                                    <path d="M5 7h14" />
                                    <path d="M5 17h14" />
                                    <path d="M9 7v10" />
                                    <path d="M15 7v10" />
                                </svg>
                            </div>
                            <h3 class="product-row__title">Термовставки из ПВХ</h3>
                        </div>
                        <p class="product-row__description">Ударопрочные профили для фасадных алюминиевых систем. Изготовление по индивидуальным чертежам с точным соблюдением допусков.</p>
                        <ul class="product-row__features">
                            <li><strong>Ударопрочный ПВХ</strong> — стойкость к климатическим нагрузкам, УФ-излучению и перепадам температур</li>
                            <li><strong>Стабильная геометрия</strong> — точное прилегание элементов без деформаций в эксплуатации</li>
                            <li><strong>Любая сложность</strong> — многокамерные и функциональные профили любой геометрии</li>
                            <li><strong>Соответствие чертежам</strong> — чёткое следование допускам и требованиям фасадных систем</li>
                        </ul>
                    </div>
                </article>

                <!-- Карточка 2: Фаскообразователи -->
                <article id="section-chamfer" class="product-row product-row--green" data-material="pvc,pe" data-industry="construction" data-animate="fade-up">
                    <div class="product-row__slider">
                        <div class="zigzag-slider production-gallery-slider">
                            <?php
                            $chamfer_images = [
                                ['src' => get_template_directory_uri() . '/assets/images/faskoobrazovateli/faskoobrazovateli-1.webp', 'alt' => 'Фаскообразователи - пример 1', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/faskoobrazovateli/faskoobrazovateli-2.webp', 'alt' => 'Фаскообразователи - пример 2', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/faskoobrazovateli/faskoobrazovateli-3.webp', 'alt' => 'Фаскообразователи - пример 3', 'loading' => 'lazy'],
                            ];
                            ?>
                            <div class="slider-container">
                                <?php foreach ($chamfer_images as $index => $img): ?>
                                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                        <a href="<?php echo $img['src']; ?>" class="custom-lightbox-trigger glightbox" data-gallery="chamfer" data-index="<?php echo $index; ?>" style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $img['src']; ?>"
                                                alt="<?php echo $img['alt']; ?>"
                                                class="slider-image"
                                                width="1000" height="750" loading="<?php echo $img['loading']; ?>"
                                                style="width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center !important;">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-nav slider-prev" aria-label="Предыдущее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="15 18 9 12 15 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <button class="slider-nav slider-next" aria-label="Следующее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="9 18 15 12 9 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <div class="slider-dots">
                                <?php foreach ($chamfer_images as $index => $img): ?>
                                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Фото <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Плашка описания -->
                        <!--
                        <div class="slider-description-panel" data-slider="chamfer">
                            <div class="slider-description-panel__content">
                                <h4 class="slider-description-panel__title">Описание слайда 1</h4>
                                <p class="slider-description-panel__intro">Заглушка для слайда фаскообразователей.</p>
                                <ul class="slider-description-panel__features">
                                    <li class="slider-description-panel__feature">
                                        <strong>Характеристика 1</strong>
                                        <span>Описание характеристики 1</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Характеристика 2</strong>
                                        <span>Описание характеристики 2</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="product-row__content">
                        <div class="product-row__header">
                            <div class="product-row__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M20 20H4" />
                                    <path d="M4 20L20 4V20H4Z" />
                                    <path d="M10 14L14 10" />
                                </svg>
                            </div>
                            <h3 class="product-row__title">Фаскообразователи</h3>
                        </div>
                        <div class="product-row__problem">
                            <span class="problem-label">Проблема:</span>
                            <p>Сколы и брак углов ЖБИ при распалубке</p>
                        </div>
                        <div class="product-row__solution">
                            <span class="solution-label">Решение:</span>
                            <p>Профили для формирования точных углов на железобетонных изделиях</p>
                        </div>
                        <ul class="product-row__features">
                            <li><strong>Идеальная эстетика</strong> — чистый, аккуратный скос для профессионального вида</li>
                            <li><strong>Защита от брака</strong> — минимизация сколов и трещин на уязвимых углах</li>
                            <li><strong>Долговечность оснастки</strong> — ударопрочный материал продлевает срок службы опалубки</li>
                            <li><strong>Скорость формовки</strong> — упрощает извлечение изделий из форм</li>
                        </ul>
                    </div>
                </article>


                <!-- Карточка 3: Профили для осветительного шинопровода -->
                <article id="section-profiles" class="product-row product-row--orange" data-material="pvc,pe,pp,abs" data-industry="electro" data-animate="fade-up">
                    <div class="product-row__slider" id="profiles-slider-fix" style="aspect-ratio: 4/3 !important; min-height: 400px !important; position: relative !important; overflow: hidden !important;">
                        <div class="zigzag-slider production-gallery-slider" style="height: 100% !important; width: 100% !important; position: relative !important;">
                            <?php
                            $profiles_images = [
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Shinoprovod/profile-shinoprovod-01.webp', 'alt' => 'Профили для шинопровода - пример 1', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Shinoprovod/profile-shinoprovod-02.webp', 'alt' => 'Профили для шинопровода - пример 2', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Shinoprovod/profile-shinoprovod-03.webp', 'alt' => 'Профили для шинопровода - пример 3', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Shinoprovod/profile-shinoprovod-04.webp', 'alt' => 'Профили для шинопровода - пример 4', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Shinoprovod/profile-shinoprovod-05.webp', 'alt' => 'Профили для шинопровода - пример 5', 'loading' => 'lazy'],
                            ];
                            ?>
                            <div class="slider-container" style="width: 100% !important; height: 100% !important; position: relative !important;">
                                <?php foreach ($profiles_images as $index => $img): ?>
                                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" style="position: absolute !important; top: 0 !important; left: 0 !important; width: 100% !important; height: 100% !important;">
                                        <a href="<?php echo $img['src']; ?>" class="custom-lightbox-trigger glightbox" data-gallery="profiles" data-index="<?php echo $index; ?>" style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $img['src']; ?>"
                                                alt="<?php echo $img['alt']; ?>"
                                                class="slider-image"
                                                width="1000" height="750" loading="<?php echo $img['loading']; ?>"
                                                style="width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center !important; display: block !important;">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-nav slider-prev" aria-label="Предыдущее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="15 18 9 12 15 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <button class="slider-nav slider-next" aria-label="Следующее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="9 18 15 12 9 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <div class="slider-dots">
                                <?php foreach ($profiles_images as $index => $img): ?>
                                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Фото <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Плашка описания -->
                        <!--
                        <div class="slider-description-panel" data-slider="profiles">
                            <div class="slider-description-panel__content">
                                <h4 class="slider-description-panel__title">Описание слайда 1</h4>
                                <p class="slider-description-panel__intro">Заглушка для первого слайда технических профилей.</p>
                                <ul class="slider-description-panel__features">
                                    <li class="slider-description-panel__feature">
                                        <strong>Характеристика 1</strong>
                                        <span>Описание характеристики 1</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Характеристика 2</strong>
                                        <span>Описание характеристики 2</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="product-row__content">
                        <div class="product-row__header">
                            <div class="product-row__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="3" y="3" width="7" height="7" rx="1" />
                                    <path d="M14 3h7v7h-3V6h-4v4" />
                                    <path d="M3 14h7v7H7v-4H3v-3" />
                                    <circle cx="17.5" cy="17.5" r="3.5" />
                                </svg>
                            </div>
                            <h3 class="product-row__title">Профили для осветительного шинопровода</h3>
                        </div>
                        <p class="product-row__description">Проектирование и экструзия сложных пластиковых профилей для светотехнических шинопроводов. Мы обеспечиваем строгий контроль допусков для надежного контакта токоведущих жил и создаем изделия, устойчивые к нагреву и деформации.</p>
                        <ul class="product-row__features">
                            <li><strong>Точность геометрии</strong> — идеальная фиксация токоведущих шин и легкая сборка готовых изделий.</li>
                            <li><strong>Эстетика</strong> — гладкая поверхность, стойкость к УФ-излучению и подбор цвета по RAL.</li>
                        </ul>
                    </div>
                </article>

                <!-- Карточка 4: Профили для бытовой техники -->
                <article id="section-appliances" class="product-row product-row--purple" data-material="pp,pe,abs,pc,pa" data-industry="electro,auto" data-animate="fade-up">
                    <div class="product-row__slider">
                        <div class="zigzag-slider production-gallery-slider">
                            <?php
                            $appliances_images = [
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-01.webp', 'alt' => 'Профиль для бытовой техники 1', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-02.webp', 'alt' => 'Профиль для бытовой техники 2', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-03.webp', 'alt' => 'Профиль для бытовой техники 3', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-04.webp', 'alt' => 'Профиль для бытовой техники 4', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-05.webp', 'alt' => 'Профиль для бытовой техники 5', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-06.webp', 'alt' => 'Профиль для бытовой техники 6', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-07.webp', 'alt' => 'Профиль для бытовой техники 7', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-08.webp', 'alt' => 'Профиль для бытовой техники 8', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-HomeAppliances/profile-home-09.webp', 'alt' => 'Профиль для бытовой техники 9', 'loading' => 'lazy'],
                            ];
                            ?>
                            <div class="slider-container">
                                <?php foreach ($appliances_images as $index => $img): ?>
                                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                        <a href="<?php echo $img['src']; ?>" class="custom-lightbox-trigger glightbox" data-gallery="appliances" data-index="<?php echo $index; ?>" style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $img['src']; ?>"
                                                alt="<?php echo $img['alt']; ?>"
                                                class="slider-image"
                                                width="1000" height="750" loading="<?php echo $img['loading']; ?>"
                                                style="width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center !important;">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-nav slider-prev" aria-label="Предыдущее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="15 18 9 12 15 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <button class="slider-nav slider-next" aria-label="Следующее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="9 18 15 12 9 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <div class="slider-dots">
                                <?php foreach ($appliances_images as $index => $img): ?>
                                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Фото <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Плашка описания -->
                        <!--
                        <div class="slider-description-panel" data-slider="appliances">
                            <div class="slider-description-panel__content">
                                <h4 class="slider-description-panel__title">Направляющие и декоративные профили</h4>
                                <p class="slider-description-panel__intro">Изготавливаем видимые детали корпуса и функциональные элементы интерьера бытовой техники. На фото — профиль-направляющая с высокой чистотой поверхности (глянец). Работаем с АБС-пластиком, полистиролом и специальными компаундами, устойчивыми к бытовой химии и перепадам температур.</p>
                                <ul class="slider-description-panel__features">
                                    <li class="slider-description-panel__feature">
                                        <strong>Идеальная поверхность</strong>
                                        <span>Отсутствие царапин, утяжин и облоя.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Цвет</strong>
                                        <span>Точный подбор оттенка (белый, металлик, прозрачный) под корпус техники.</span>
                                    </li>
                                    <li class="slider-description-panel__feature">
                                        <strong>Функционал</strong>
                                        <span>Сочетание декоративных свойств с конструкционной прочностью.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="product-row__content">
                        <div class="product-row__header">
                            <div class="product-row__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="4" y="2" width="16" height="20" rx="2" />
                                    <line x1="4" y1="10" x2="20" y2="10" />
                                    <circle cx="12" cy="6" r="1.5" />
                                    <rect x="8" y="13" width="8" height="5" rx="1" />
                                </svg>
                            </div>
                            <h3 class="product-row__title">Профили для бытовой техники</h3>
                        </div>
                        <p class="product-row__description">Производим пластиковые профили и детали для холодильников, плит, стиральных машин и другой бытовой техники. Обеспечиваем точное соответствие чертежам, высокую чистоту поверхности и соблюдение строгих допусков.</p>
                        <ul class="product-row__features">
                            <li><strong>Высокая точность</strong> — минимальные допуски благодаря современному оборудованию</li>
                            <li><strong>Сложная геометрия</strong> — внутренние полости, закладные элементы</li>
                            <li><strong>Серийное производство</strong> — оптимизированные процессы для больших партий</li>
                        </ul>
                    </div>
                </article>

                <!-- Карточка 5: Профили для фургонов -->
                <article id="section-truck" class="product-row product-row--cyan" data-material="pvc,pe" data-industry="auto" data-animate="fade-up">
                    <div class="product-row__slider">
                        <div class="zigzag-slider production-gallery-slider">
                            <?php
                            $truck_images = [
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Furgon/profile-furgon-01.webp', 'alt' => 'Профили для фургонов - пример 1', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Profiles-Furgon/profile-furgon-02.webp', 'alt' => 'Профили для фургонов - пример 2', 'loading' => 'lazy'],
                            ];
                            ?>
                            <div class="slider-container">
                                <?php foreach ($truck_images as $index => $img): ?>
                                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                        <a href="<?php echo $img['src']; ?>" class="custom-lightbox-trigger glightbox" data-gallery="truck" data-index="<?php echo $index; ?>" style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $img['src']; ?>"
                                                alt="<?php echo $img['alt']; ?>"
                                                class="slider-image"
                                                width="1000" height="750" loading="<?php echo $img['loading']; ?>"
                                                style="width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center !important;">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-nav slider-prev" aria-label="Предыдущее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="15 18 9 12 15 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <button class="slider-nav slider-next" aria-label="Следующее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="9 18 15 12 9 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <div class="slider-dots">
                                <?php foreach ($truck_images as $index => $img): ?>
                                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Фото <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Плашка описания -->
                        <!--
                        <div class="slider-description-panel" data-slider="truck">
                            <div class="slider-description-panel__content">
                                <h4 class="slider-description-panel__title">Описание слайда 1</h4>
                                <p class="slider-description-panel__intro">Заглушка для первого слайда профилей для фургонов.</p>
                                <ul class="slider-description-panel__features">
                                    <li class="slider-description-panel__feature">
                                        <strong>Характеристика 1</strong>
                                        <span>Описание характеристики 1</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="product-row__content">
                        <div class="product-row__header">
                            <div class="product-row__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="1" y="6" width="22" height="10" rx="2" />
                                    <circle cx="6" cy="16" r="2" />
                                    <circle cx="18" cy="16" r="2" />
                                    <path d="M4 6V4h16v2" />
                                </svg>
                            </div>
                            <h3 class="product-row__title">Профили для фургонов</h3>
                        </div>
                        <div class="product-row__specs">
                            <div class="spec-badge">140×55 мм</div>
                            <div class="spec-badge">3 мм толщина</div>
                        </div>
                        <p class="product-row__description">Облицовочные профили для обвязки каркаса грузового транспорта. Защита от износа и механических повреждений.</p>
                        <ul class="product-row__features">
                            <li><strong>Прочный материал</strong> — толщина стенки 3 мм для максимальной надежности</li>
                            <li><strong>Защита каркаса</strong> — предотвращает износ и повреждения при эксплуатации</li>
                            <li><strong>Простой монтаж</strong> — специальный профиль для быстрой установки</li>
                            <li><strong>УФ-стойкость</strong> — устойчивость к солнечному излучению и температурным перепадам</li>
                        </ul>
                    </div>
                </article>

                <!-- Карточка 6: Полимерные втулки и кольца -->
                <article id="section-vtulki" class="product-row product-row--rose" data-material="pvc,pe,pp" data-industry="electro" data-animate="fade-up">
                    <div class="product-row__slider">
                        <div class="zigzag-slider production-gallery-slider">
                            <?php
                            $vtulki_images = [
                                ['src' => get_template_directory_uri() . '/assets/images/Polymer-Bushings-Spools/Spool%20Rings-1.webp', 'alt' => 'Полимерные втулки и кольца - пример 1', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Polymer-Bushings-Spools/Spool%20Rings-2.webp', 'alt' => 'Полимерные втулки и кольца - пример 2', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Polymer-Bushings-Spools/Spool%20Rings-3.webp', 'alt' => 'Полимерные втулки и кольца - пример 3', 'loading' => 'lazy'],
                                ['src' => get_template_directory_uri() . '/assets/images/Polymer-Bushings-Spools/Spool%20Rings-4.webp', 'alt' => 'Полимерные втулки и кольца - пример 4', 'loading' => 'lazy'],
                            ];
                            ?>
                            <div class="slider-container">
                                <?php foreach ($vtulki_images as $index => $img): ?>
                                    <div class="slide <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>">
                                        <a href="<?php echo $img['src']; ?>" class="custom-lightbox-trigger glightbox" data-gallery="vtulki" data-index="<?php echo $index; ?>" style="display: block; width: 100%; height: 100%;">
                                            <img src="<?php echo $img['src']; ?>"
                                                alt="<?php echo $img['alt']; ?>"
                                                class="slider-image"
                                                width="1000" height="750" loading="<?php echo $img['loading']; ?>"
                                                style="width: 100% !important; height: 100% !important; object-fit: cover !important; object-position: center !important;">
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button class="slider-nav slider-prev" aria-label="Предыдущее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="15 18 9 12 15 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <button class="slider-nav slider-next" aria-label="Следующее фото">
                                <span style="display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display: block; stroke: white !important; width: 24px; height: 24px;">
                                        <polyline points="9 18 15 12 9 6" style="stroke: white !important; fill: none !important;" />
                                    </svg>
                                </span>
                            </button>
                            <div class="slider-dots">
                                <?php foreach ($vtulki_images as $index => $img): ?>
                                    <button class="slider-dot <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>" aria-label="Фото <?php echo $index + 1; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <!-- Плашка описания -->
                        <!--
                        <div class="slider-description-panel" data-slider="vtulki">
                            <div class="slider-description-panel__content">
                                <h4 class="slider-description-panel__title">Описание слайда 1</h4>
                                <p class="slider-description-panel__intro">Заглушка для первого слайда втулок.</p>
                                <ul class="slider-description-panel__features">
                                    <li class="slider-description-panel__feature">
                                        <strong>Характеристика 1</strong>
                                        <span>Описание характеристики 1</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                    <div class="product-row__content">
                        <div class="product-row__header">
                            <div class="product-row__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="12" r="9" />
                                    <circle cx="12" cy="12" r="5" />
                                    <circle cx="12" cy="12" r="2" />
                                </svg>
                            </div>
                            <h3 class="product-row__title">Полимерные втулки и кольца</h3>
                        </div>
                        </details>
                        <ul class="product-row__features">
                            <li><strong>Индивидуальные размеры</strong> — внутренний и внешний диаметр по вашим требованиям</li>
                            <li><strong>Выбор материала</strong> — в зависимости от условий эксплуатации</li>
                            <li><strong>Цветовые решения</strong> — любой цвет по каталогу RAL или образцу</li>
                            <li><strong>Стабильные поставки</strong> — объём партии — по согласованию, с гарантией качества</li>
                        </ul>
                    </div>
                </article>


            </div>
        </div>
    </section>

    <!-- FAQ Cross-Promo Banner -->
    <div class="faq-cross-promo" id="faq-cross-promo" data-animate="fade-up">
        <div class="faq-cross-promo-content">
            <div class="faq-cross-promo-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
            </div>
            <div class="faq-cross-promo-text">
                <h3 class="faq-cross-promo-title">Вопросы по срокам, партиям и оснастке?</h3>
                <p class="faq-cross-promo-desc">Готовые ответы по контрактному производству</p>
            </div>
            <a href="<?php echo home_url('/technologies-and-contract-manufacturing/#faq'); ?>" class="faq-cross-promo-btn">
                Смотреть ответы
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </a>
        </div>
        <button class="faq-cross-promo-close" aria-label="Закрыть">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
            </svg>
        </button>
    </div>

    <!-- FAQ Cross-Promo Banner Ends -->

    <!-- STATS COUNTER SECTION -->
    <section class="section stats-section">
        <div class="container">
            <div class="stats-grid">
                <!-- Item 1 -->
                <div class="stat-item">
                    <span class="stat-number" data-target="20" data-suffix="+">0</span>
                    <span class="stat-label">Лет на рынке</span>
                </div>
                <!-- Item 2 -->
                <div class="stat-item">
                    <span class="stat-number" data-target="500" data-suffix="+">0</span>
                    <span class="stat-label">Реализованных проектов</span>
                </div>
                <!-- Item 3 -->
                <div class="stat-item">
                    <span class="stat-number" data-target="24" data-suffix="/7">0</span>
                    <span class="stat-label">Производство</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ПРОЦЕСС РАБОТЫ - Timeline (Redesigned) -->
    <section class="process-timeline-section" id="process-timeline">
        <div class="container">
            <div class="section-header" data-animate="fade-up">
                <h2 class="section-header__title"><span>От чертежа</span> <span class="highlight">до серии</span></h2>
                <p class="section-header__desc">Системный подход к производству полимерных изделий</p>
            </div>

            <div class="process-timeline">
                <div class="timeline-track">
                    <div class="timeline-progress-bar"></div>
                </div>

                <!-- Step 1 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </span>
                                Заявка и анализ
                            </h4>
                            <p class="timeline-desc">Анализируем ваш чертеж или 3D-модель. Подбираем оптимальный материал (ПВХ, ПЭ, ПП, АБС) и рассчитываем стоимость проекта.</p>
                            <div class="timeline-meta">
                                <span>Чертеж / 3D модель</span>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">1</span></div>
                    </div>
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                </div>

                <!-- Step 2 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">2</span></div>
                    </div>
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                    </svg>
                                </span>
                                Проектирование оснастки
                            </h4>
                            <p class="timeline-desc">Совместно с партнерами проектируем и изготавливаем пресс-форму или экструзионную оснастку (срок: 2-4 месяца).</p>
                            <div class="timeline-meta">
                                <span>Опыт и надёжность</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                    </svg>
                                </span>
                                Образцы и испытания
                            </h4>
                            <p class="timeline-desc">Запускаем пилотную партию для проверки геометрии и физико-механических свойств. Вы получаете эталонный образец перед началом серийного производства.</p>
                            <div class="timeline-meta">
                                <span>Контроль качества</span>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">3</span></div>
                    </div>
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                </div>

                <!-- Step 4 -->
                <div class="timeline-item">
                    <div class="timeline-content-wrapper"><!-- Empty for layout balance --></div>
                    <div class="timeline-marker-wrapper">
                        <div class="timeline-marker"><span class="timeline-number">4</span></div>
                    </div>
                    <div class="timeline-content-wrapper">
                        <div class="timeline-content">
                            <h4 class="timeline-title">
                                <span class="timeline-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                        <rect x="1" y="3" width="22" height="5"></rect>
                                        <line x1="10" y1="12" x2="14" y2="12"></line>
                                    </svg>
                                </span>
                                Серийное производство
                            </h4>
                            <p class="timeline-desc">Запускаем полномасштабное производство с постоянным контролем качества. Упаковываем и доставляем готовую продукцию на ваш склад.</p>
                            <div class="timeline-meta">
                                <span>Объем партии по запросу</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- AUDIT FORM SECTION -->
    <?php include get_template_directory() . '/template-parts/audit-form-section.php'; ?>

</main>

<script>
    // === PRODUCTS PAGE SCRIPTS ===
    (function() {
        'use strict';

        // === PARALLAX HERO ===
        const heroSection = document.querySelector('.products-hero');
        const heroBg = document.querySelector('.products-hero__bg');

        if (heroSection && heroBg && window.innerWidth > 768) {
            const parallaxFactor = parseFloat(heroBg.dataset.parallax) || 0.3;

            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const heroHeight = heroSection.offsetHeight;

                if (scrolled <= heroHeight) {
                    heroBg.style.transform = `translateY(${scrolled * parallaxFactor}px)`;
                }
            }, {
                passive: true
            });
        }

        // === SMOOTH SCROLL TO CATALOG ===
        const ctaBtn = document.querySelector('.products-hero__cta');
        if (ctaBtn) {
            ctaBtn.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        }

        // === INTERSECTION OBSERVER FOR ANIMATIONS ===
        const animateElements = document.querySelectorAll('[data-animate]');

        const observerOptions = {
            root: null,
            rootMargin: '0px 0px -100px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = parseFloat(el.dataset.delay) || 0;

                    setTimeout(() => {
                        el.classList.add('animated');
                    }, delay * 1000);

                    observer.unobserve(el);
                }
            });
        }, observerOptions);

        animateElements.forEach(el => observer.observe(el));

        // === TIMELINE ANIMATION ===
        // Moved to assets/js/products-timeline.js

        // === CUSTOM LIGHTBOX - Данные для GLightbox ===
        // Логика слайдеров и описаний перенесена в products-slider.js
        const galleriesData = {
            'pvc': <?php echo json_encode(array_map(function ($img) {
                        return ['href' => $img['src'], 'type' => 'image', 'alt' => $img['alt']];
                    }, $pvc_images)); ?>,
            'chamfer': <?php echo json_encode(array_map(function ($img) {
                            return ['href' => $img['src'], 'type' => 'image', 'alt' => $img['alt']];
                        }, $chamfer_images)); ?>,
            'profiles': <?php echo json_encode(array_map(function ($img) {
                            return ['href' => $img['src'], 'type' => 'image', 'alt' => $img['alt']];
                        }, $profiles_images)); ?>,
            'appliances': <?php echo json_encode(array_map(function ($img) {
                                return ['href' => $img['src'], 'type' => 'image', 'alt' => $img['alt']];
                            }, $appliances_images)); ?>,
            'vtulki': <?php echo json_encode(array_map(function ($img) {
                            return ['href' => $img['src'], 'type' => 'image', 'alt' => $img['alt']];
                        }, $vtulki_images)); ?>,
            'truck': <?php echo json_encode(array_map(function ($img) {
                            return ['href' => $img['src'], 'type' => 'image', 'alt' => $img['alt']];
                        }, $truck_images)); ?>
        };

        // Экспортируем данные для products-slider.js
        window.productGalleriesData = galleriesData;

        // Защита от повторной инициализации
        if (window.productsGLightboxInitialized) {
            console.log('GLightbox already initialized, skipping');
            return;
        }
        window.productsGLightboxInitialized = true;

        // Code for monolithic GLightbox has been removed to support isolated galleries.
        // See assets/js/products-slider.js for Isolated GLightbox initialization.

        // === FAQ BANNER CLOSE ===
        const faqBanner = document.getElementById('faq-cross-promo');
        const faqClose = document.querySelector('.faq-cross-promo-close');

        if (faqBanner && faqClose) {
            faqClose.addEventListener('click', function() {
                faqBanner.style.opacity = '0';
                setTimeout(() => {
                    faqBanner.style.display = 'none';
                }, 300);
            });
        }
    })();
</script>

<!-- MODAL: Термовставки из ПВХ -->
<div id="pvc-modal-products" class="product-modal" role="dialog" aria-modal="true" aria-labelledby="pvc-modal-title">
    <div class="product-modal__backdrop"></div>
    <!-- ... -->
    <div class="product-modal__container">
        <!-- Header -->
        <header class="product-modal__header product-modal__header--blue">
            <div class="product-modal__header-content">
                <div class="product-modal__icon product-modal__icon--blue">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M5 3v18" />
                        <path d="M19 3v18" />
                        <path d="M5 7h14" />
                        <path d="M5 17h14" />
                        <path d="M9 7v10" />
                        <path d="M15 7v10" />
                    </svg>
                </div>
                <h2 id="pvc-modal-title" class="product-modal__title">Термовставки из ударопрочного ПВХ</h2>
            </div>
            <button type="button" class="product-modal__close" data-close-modal="pvc" aria-label="Закрыть">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </header>

        <!-- Scrollable Content -->
        <div class="product-modal__body">
            <!-- Lead Section -->
            <section class="modal-section modal-lead modal-lead--blue">
                <p class="lead-text">
                    Надёжное, долговечное и технологичное решение для современной архитектуры.
                    Производим <strong>термовставки для фасадных систем по индивидуальным чертежам</strong> и техническим требованиям заказчика.
                </p>
                <p class="lead-subtext">
                    Специализируемся на изготовлении профилей сложной геометрии, обеспечивающих стабильную термоизоляцию,
                    высокую механическую прочность и точность сопряжения элементов.
                </p>
            </section>

            <!-- Capabilities Grid -->
            <section class="modal-section">
                <h3 class="modal-section__title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3" />
                        <path d="M12 2v2" />
                        <path d="M12 20v2" />
                        <path d="M2 12h2" />
                        <path d="M20 12h2" />
                    </svg>
                    Почему наши термовставки — оптимальный выбор
                </h3>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--blue">
                        <div class="capability-card__icon capability-card__icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                                <path d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Ударопрочный ПВХ</h4>
                        <p class="capability-card__desc">С повышенной стойкостью к климатическим нагрузкам, ультрафиолету и перепадам температур</p>
                    </div>
                    <div class="capability-card capability-card--blue">
                        <div class="capability-card__icon capability-card__icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <line x1="9" y1="9" x2="15" y2="15" />
                                <line x1="15" y1="9" x2="9" y2="15" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Стабильная геометрия</h4>
                        <p class="capability-card__desc">Точное прилегание элементов и отсутствие деформаций в процессе эксплуатации</p>
                    </div>
                    <div class="capability-card capability-card--blue">
                        <div class="capability-card__icon capability-card__icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                <line x1="12" y1="22.08" x2="12" y2="12" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Любая сложность</h4>
                        <p class="capability-card__desc">Многокамерные и функциональные профили любой геометрии</p>
                    </div>
                    <div class="capability-card capability-card--blue">
                        <div class="capability-card__icon capability-card__icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Соответствие чертежам</h4>
                        <p class="capability-card__desc">Чёткое следование допускам и требованиям фасадных систем</p>
                    </div>
                    <div class="capability-card capability-card--blue">
                        <div class="capability-card__icon capability-card__icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <line x1="8" y1="6" x2="21" y2="6" />
                                <line x1="8" y1="12" x2="21" y2="12" />
                                <line x1="8" y1="18" x2="21" y2="18" />
                                <line x1="3" y1="6" x2="3.01" y2="6" />
                                <line x1="3" y1="12" x2="3.01" y2="12" />
                                <line x1="3" y1="18" x2="3.01" y2="18" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Равномерность</h4>
                        <p class="capability-card__desc">Идеальная повторяемость геометрии благодаря современному оборудованию</p>
                    </div>
                    <div class="capability-card capability-card--blue">
                        <div class="capability-card__icon capability-card__icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 14s1.5 2 4 2 4-2 4-2" />
                                <line x1="9" y1="9" x2="9.01" y2="9" />
                                <line x1="15" y1="9" x2="15.01" y2="9" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Качество поверхности</h4>
                        <p class="capability-card__desc">Гарантированная гладкость и максимальная однородность материала</p>
                    </div>
                </div>
            </section>

            <!-- Application Areas -->
            <section class="modal-section">
                <h3 class="modal-section__title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    Применение
                </h3>
                <p class="modal-section__subtitle">Термовставки обеспечивают энергоэффективность, долговечность и высокую точность сборки фасадных конструкций</p>
                <ul class="use-cases-list">
                    <li>Фасадные алюминиевые системы</li>
                    <li>Оконные и дверные конструкции</li>
                    <li>Светопрозрачные фасады</li>
                    <li>Зимние сады и атриумы</li>
                </ul>
            </section>

            <!-- Workflow Timeline -->
            <section class="modal-section">
                <h3 class="modal-section__title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" />
                    </svg>
                    Индивидуальное производство «под задачу»
                </h3>
                <p class="modal-section__subtitle">Мы не просто производим профиль, мы сопровождаем проект на всех этапах</p>
                <div class="workflow-timeline">
                    <div class="workflow-step">
                        <div class="workflow-step__marker workflow-step__marker--blue">1</div>
                        <div class="workflow-step__content">
                            <h4>Разработка с инженером-технологом</h4>
                            <p>Совместная работа над оптимальным решением</p>
                        </div>
                    </div>
                    <div class="workflow-step">
                        <div class="workflow-step__marker workflow-step__marker--blue">2</div>
                        <div class="workflow-step__content">
                            <h4>Адаптация к фасадной системе</h4>
                            <p>Учёт особенностей конкретной конструкции</p>
                        </div>
                    </div>
                    <div class="workflow-step">
                        <div class="workflow-step__marker workflow-step__marker--blue">3</div>
                        <div class="workflow-step__content">
                            <h4>Подбор материала и оптимизация</h4>
                            <p>Выбор оптимального состава и геометрии</p>
                        </div>
                    </div>
                    <div class="workflow-step">
                        <div class="workflow-step__marker workflow-step__marker--blue">4</div>
                        <div class="workflow-step__content">
                            <h4>Опытные партии и серийное производство</h4>
                            <p>Тестирование и запуск в серию</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer CTA -->
        <footer class="product-modal__footer">
            <a href="<?php echo home_url('/quote-request'); ?>" class="modal-cta-primary modal-cta-primary--blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="1" y="4" width="22" height="16" rx="2" ry="2" />
                    <line x1="1" y1="10" x2="23" y2="10" />
                </svg>
                Запросить расчет
            </a>
            <a href="#" id="btn-download-requirements-pvc" class="modal-cta-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                    <polyline points="7 10 12 15 17 10" />
                    <line x1="12" y1="15" x2="12" y2="3" />
                </svg>
                Скачать технические требования
            </a>
        </footer>
    </div>
</div>

<!-- MODAL: Chamfer (Green) -->
<div id="chamfer-modal-products" class="product-modal" role="dialog" aria-modal="true" aria-labelledby="chamfer-modal-title">
    <div class="product-modal__backdrop"></div>
    <div class="product-modal__container">
        <header class="product-modal__header product-modal__header--green">
            <div class="product-modal__header-content">
                <div class="product-modal__icon product-modal__icon--green">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M9 12l2 2 4-4" />
                    </svg>
                </div>
                <h2 id="chamfer-modal-title" class="product-modal__title">ФАСКООБРАЗОВАТЕЛИ: ИДЕАЛЬНАЯ ГЕОМЕТРИЯ ЖБИ</h2>
            </div>
            <button type="button" class="product-modal__close product-modal__close--green" data-close-modal="chamfer" aria-label="Закрыть">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </header>
        <div class="product-modal__body">
            <section class="modal-section modal-lead modal-lead--green">
                <p class="lead-text">Надежное решение для формирования <strong>точных углов</strong> и предотвращения брака на железобетонных изделиях. Производство по индивидуальным размерам и конфигурациям.</p>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">Почему наши фаскообразователи — оптимальный выбор</h3>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--green">
                        <div class="capability-card__icon capability-card__icon--green"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2v20M2 12h20" />
                            </svg></div>
                        <h4 class="capability-card__title">Эстетика скоса</h4>
                        <p class="capability-card__desc">Чистый, аккуратный срез для профессионального вида</p>
                    </div>
                    <div class="capability-card capability-card--green">
                        <div class="capability-card__icon capability-card__icon--green"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg></div>
                        <h4 class="capability-card__title">Защита от сколов</h4>
                        <p class="capability-card__desc">Минимизация трещин при распалубке</p>
                    </div>
                    <div class="capability-card capability-card--green">
                        <div class="capability-card__icon capability-card__icon--green"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                            </svg></div>
                        <h4 class="capability-card__title">Износостойкий материал</h4>
                        <p class="capability-card__desc">Ударопрочный полимер, продлевающий срок службы</p>
                    </div>
                    <div class="capability-card capability-card--green">
                        <div class="capability-card__icon capability-card__icon--green"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8" />
                            </svg></div>
                        <h4 class="capability-card__title">Многоразовое использование</h4>
                        <p class="capability-card__desc">Высокая прочность для долгой эксплуатации</p>
                    </div>
                    <div class="capability-card capability-card--green">
                        <div class="capability-card__icon capability-card__icon--green"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M17 21v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                            </svg></div>
                        <h4 class="capability-card__title">Простота демонтажа</h4>
                        <p class="capability-card__desc">Упрощает извлечение изделия из формы</p>
                    </div>
                    <div class="capability-card capability-card--green">
                        <div class="capability-card__icon capability-card__icon--green"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                            </svg></div>
                        <h4 class="capability-card__title">Индивидуальные размеры</h4>
                        <p class="capability-card__desc">Производство под любые требования проекта</p>
                    </div>
                </div>
            </section>
        </div>
        <footer class="product-modal__footer">
            <a href="<?php echo home_url('/quote-request'); ?>" class="modal-cta-primary modal-cta-primary--green">Заказать партию</a>
            <a href="#" id="btn-download-spec-chamfer" class="modal-cta-secondary modal-cta-secondary--green">Скачать спецификацию</a>
        </footer>
    </div>
</div>

<!-- MODAL: Profiles (Orange) -->
<div id="profiles-modal-products" class="product-modal" role="dialog" aria-modal="true" aria-labelledby="profiles-modal-title">
    <div class="product-modal__backdrop"></div>
    <div class="product-modal__container">
        <header class="product-modal__header product-modal__header--orange">
            <div class="product-modal__header-content">
                <div class="product-modal__icon product-modal__icon--orange">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M12 20h9" />
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                    </svg>
                </div>
                <h2 id="profiles-modal-title" class="product-modal__title">ПРОФИЛИ ДЛЯ ОСВЕТИТЕЛЬНОГО ШИНОПРОВОДА</h2>
            </div>
            <button type="button" class="product-modal__close product-modal__close--orange" data-close-modal="profiles" aria-label="Закрыть">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </header>
        <div class="product-modal__body">
            <section class="modal-section modal-lead modal-lead--orange">
                <p class="lead-text"><strong>Инженерные решения для систем современного освещения.</strong> Основной задачей осветительного шинопровода является установка в него источников света с последующим креплением их на потолки, стены и другие рабочие поверхности. Мы производим <strong>высокоточные пластиковые профили (корпуса и изоляторы)</strong>, которые обеспечивают надёжную фиксацию компонентов и электробезопасность всей осветительной системы.</p>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">ПРЕИМУЩЕСТВА НАШИХ ПРОФИЛЕЙ ДЛЯ ШИНОПРОВОДА:</h3>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--orange">
                        <div class="capability-card__icon capability-card__icon--orange"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M22 12h-4" />
                                <path d="M6 12H2" />
                                <path d="M12 6V2" />
                                <path d="M12 22v-4" />
                            </svg></div>
                        <h4 class="capability-card__title">Высокие диэлектрические свойства</h4>
                        <p class="capability-card__desc">Использование специальных полимеров гарантирует отличную электрическую изоляцию токоведущих частей.</p>
                    </div>
                    <div class="capability-card capability-card--orange">
                        <div class="capability-card__icon capability-card__icon--orange"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="3" width="20" height="14" rx="2" />
                                <line x1="8" y1="21" x2="16" y2="21" />
                                <line x1="12" y1="17" x2="12" y2="21" />
                            </svg></div>
                        <h4 class="capability-card__title">Стабильность геометрии сечения</h4>
                        <p class="capability-card__desc">Прецизионная точность изготовления обеспечивает легкую установку светильников и надежный контакт.</p>
                    </div>
                    <div class="capability-card capability-card--orange">
                        <div class="capability-card__icon capability-card__icon--orange"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8" />
                            </svg></div>
                        <h4 class="capability-card__title">Термостойкость</h4>
                        <p class="capability-card__desc">Материалы сохраняют свои свойства и форму при длительном нагреве от источников света.</p>
                    </div>
                    <div class="capability-card capability-card--orange">
                        <div class="capability-card__icon capability-card__icon--orange"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="4" />
                            </svg></div>
                        <h4 class="capability-card__title">Любая цветовая гамма</h4>
                        <p class="capability-card__desc">Производим профили в различных цветах (черный, белый, серый и др.) для соответствия дизайну интерьера.</p>
                    </div>
                </div>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">Полный цикл реализации проекта</h3>
                <p class="modal-section__subtitle">От проектирования оснастки до серийных поставок на сборочное производство:</p>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--orange">
                        <h4 class="capability-card__title">01</h4>
                        <p class="capability-card__desc">Согласование конструкторской документации на профиль</p>
                    </div>
                    <div class="capability-card capability-card--orange">
                        <h4 class="capability-card__title">02</h4>
                        <p class="capability-card__desc">Проектирование и изготовление высокоточной фильеры</p>
                    </div>
                    <div class="capability-card capability-card--orange">
                        <h4 class="capability-card__title">03</h4>
                        <p class="capability-card__desc">Испытание образцов и подбор оптимального полимера</p>
                    </div>
                    <div class="capability-card capability-card--orange">
                        <h4 class="capability-card__title">04</h4>
                        <p class="capability-card__desc">Серийный выпуск и контроль качества каждой партии</p>
                    </div>
                </div>
            </section>

            <section class="modal-section">
                <p class="lead-text">Наши профили для осветительного шинопровода сочетают в себе эстетику, функциональность и безопасность, отвечая самым современным требованиям светотехнической отрасли.</p>
            </section>
        </div>
        <footer class="product-modal__footer">
            <a href="<?php echo home_url('/quote-request'); ?>" class="modal-cta-primary modal-cta-primary--orange">Рассчитать стоимость</a>
            <a href="#" class="modal-cta-secondary modal-cta-secondary--orange">Скачать каталог</a>
        </footer>
    </div>
</div>

<!-- MODAL: Appliances (Purple) -->
<div id="appliances-modal-products" class="product-modal" role="dialog" aria-modal="true" aria-labelledby="appliances-modal-title">
    <div class="product-modal__backdrop"></div>
    <div class="product-modal__container">
        <header class="product-modal__header product-modal__header--purple">
            <div class="product-modal__header-content">
                <div class="product-modal__icon product-modal__icon--purple">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="4" y="2" width="16" height="20" rx="2" />
                        <line x1="4" y1="10" x2="20" y2="10" />
                        <circle cx="12" cy="6" r="1.5" />
                        <rect x="8" y="13" width="8" height="5" rx="1" />
                    </svg>
                </div>
                <h2 id="appliances-modal-title" class="product-modal__title">ПРОФИЛИ ДЛЯ БЫТОВОЙ ТЕХНИКИ</h2>
            </div>
            <button type="button" class="product-modal__close product-modal__close--purple" data-close-modal="appliances" aria-label="Закрыть">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </header>
        <div class="product-modal__body">
            <section class="modal-section modal-lead modal-lead--purple">
                <p class="lead-text">Производство сложных комплектующих для электроники</p>
                <p>Производим пластиковые профили и детали для холодильников, плит, стиральных машин и другой бытовой техники. Обеспечиваем точное соответствие чертежам, высокую чистоту поверхности и соблюдение строгих допусков, необходимых для автоматизированной сборки на конвейерах.</p>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">Преимущества нашего производства</h3>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--purple">
                        <div class="capability-card__icon capability-card__icon--purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 6v6l4 2" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Высокая точность</h4>
                        <p class="capability-card__desc">Точное соблюдение геометрических размеров деталей с минимальными допусками благодаря современному оборудованию.</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <div class="capability-card__icon capability-card__icon--purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2L2 7l10 5 10-5-10-5z" />
                                <path d="M2 17l10 5 10-5" />
                                <path d="M2 12l10 5 10-5" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Широкий диапазон веса</h4>
                        <p class="capability-card__desc">Изготовление профилей различного веса и площади сечения, адаптированных под требования различных отраслей промышленности.</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <div class="capability-card__icon capability-card__icon--purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Сложная геометрия</h4>
                        <p class="capability-card__desc">Производство изделий с внутренними полостями, закладными элементами и другими сложными формами.</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <div class="capability-card__icon capability-card__icon--purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Разнообразие материалов</h4>
                        <p class="capability-card__desc">Работа с различными видами пластиков: ПВХ, АБС, ТПЭ и другими, в зависимости от требований заказчика.</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <div class="capability-card__icon capability-card__icon--purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Серийное производство</h4>
                        <p class="capability-card__desc">Оптимизированные процессы для выпуска больших партий с высокой производительностью и стабильным качеством.</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <div class="capability-card__icon capability-card__icon--purple">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 3v18" />
                                <rect x="4" y="8" width="16" height="8" rx="1" />
                            </svg>
                        </div>
                        <h4 class="capability-card__title">Качество поверхности</h4>
                        <p class="capability-card__desc">Отличное качество поверхности готовых изделий без дополнительной механической обработки.</p>
                    </div>
                </div>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">Индивидуальное производство «под задачу»</h3>
                <p class="lead-text">Мы не просто производим детали, мы сопровождаем проект на всех этапах:</p>
                <div class="capabilities-grid capabilities-grid--steps">
                    <div class="capability-card capability-card--purple">
                        <h4 class="capability-card__title">01</h4>
                        <p class="capability-card__desc">Анализ чертежей и выбор технологии литья</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <h4 class="capability-card__title">02</h4>
                        <p class="capability-card__desc">Проектирование и изготовление пресс-формы</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <h4 class="capability-card__title">03</h4>
                        <p class="capability-card__desc">Подбор материала и настройка параметров литья</p>
                    </div>
                    <div class="capability-card capability-card--purple">
                        <h4 class="capability-card__title">04</h4>
                        <p class="capability-card__desc">Изготовление опытных образцов и серийное производство</p>
                    </div>
                </div>
            </section>
            <section class="modal-section">
                <p class="lead-text">Литье под давлением обеспечивает высокую производительность, точность и экономичность при производстве пластиковых деталей, что особенно важно для серийного производства в различных отраслях промышленности.</p>
            </section>
        </div>
        <footer class="product-modal__footer">
            <a href="<?php echo home_url('/quote-request'); ?>" class="modal-cta-primary modal-cta-primary--purple">Рассчитать стоимость</a>
            <a href="#" class="modal-cta-secondary modal-cta-secondary--purple">Скачать каталог</a>
        </footer>
    </div>
</div>

<!-- MODAL: Vtulki (Rose) -->
<div id="vtulki-modal-products" class="product-modal" role="dialog" aria-modal="true" aria-labelledby="vtulki-modal-title">
    <div class="product-modal__backdrop"></div>
    <div class="product-modal__container">
        <header class="product-modal__header product-modal__header--rose">
            <div class="product-modal__header-content">
                <div class="product-modal__icon product-modal__icon--rose">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="12" r="4" />
                    </svg>
                </div>
                <h2 id="vtulki-modal-title" class="product-modal__title">ПОЛИМЕРНЫЕ ВТУЛКИ: КАЧЕСТВО НАМОТКИ</h2>
            </div>
            <button type="button" class="product-modal__close product-modal__close--rose" data-close-modal="vtulki" aria-label="Закрыть">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </header>
        <div class="product-modal__body">
            <section class="modal-section modal-lead modal-lead--rose">
                <p class="lead-text">Производство шпуль и втулок для изоленты, пленок, пластыря и других материалов. Любые <strong>индивидуальные размеры</strong> и материалы (ПВХ, ПП, ПЭ).</p>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">Почему наши втулки — оптимальный выбор</h3>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--rose">
                        <div class="capability-card__icon capability-card__icon--rose"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 2a15 15 0 0 0 0 20M2 12h20" />
                            </svg></div>
                        <h4 class="capability-card__title">Любой диаметр</h4>
                        <p class="capability-card__desc">Производство по внутреннему и внешнему диаметру заказчика</p>
                    </div>
                    <div class="capability-card capability-card--rose">
                        <div class="capability-card__icon capability-card__icon--rose"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8" />
                            </svg></div>
                        <h4 class="capability-card__title">Выбор материала</h4>
                        <p class="capability-card__desc">ПВХ, ПП, ПЭ в зависимости от условий эксплуатации</p>
                    </div>
                    <div class="capability-card capability-card--rose">
                        <div class="capability-card__icon capability-card__icon--rose"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                            </svg></div>
                        <h4 class="capability-card__title">Точность формы</h4>
                        <p class="capability-card__desc">Идеальная цилиндричность для качественной намотки</p>
                    </div>
                    <div class="capability-card capability-card--rose">
                        <div class="capability-card__icon capability-card__icon--rose"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg></div>
                        <h4 class="capability-card__title">Стойкость к нагрузкам</h4>
                        <p class="capability-card__desc">Устойчивость к осевым и радиальным нагрузкам</p>
                    </div>
                    <div class="capability-card capability-card--rose">
                        <div class="capability-card__icon capability-card__icon--rose"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="12" r="4" />
                            </svg></div>
                        <h4 class="capability-card__title">Цветовое кодирование</h4>
                        <p class="capability-card__desc">Любой цвет по каталогу RAL</p>
                    </div>
                    <div class="capability-card capability-card--rose">
                        <div class="capability-card__icon capability-card__icon--rose"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                            </svg></div>
                        <h4 class="capability-card__title">Стабильность поставок</h4>
                        <p class="capability-card__desc">Гарантированные объемы от 1000 шт</p>
                    </div>
                </div>
            </section>
        </div>
        <footer class="product-modal__footer">
            <a href="<?php echo home_url('/quote-request'); ?>" class="modal-cta-primary modal-cta-primary--rose">Рассчитать стоимость</a>
            <a href="#" class="modal-cta-secondary modal-cta-secondary--rose">Скачать спецификацию</a>
        </footer>
    </div>
</div>

<!-- MODAL: Truck (Cyan) -->
<div id="truck-modal-products" class="product-modal" role="dialog" aria-modal="true" aria-labelledby="truck-modal-title">
    <div class="product-modal__backdrop"></div>
    <div class="product-modal__container">
        <header class="product-modal__header product-modal__header--cyan">
            <div class="product-modal__header-content">
                <div class="product-modal__icon product-modal__icon--cyan">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="1" y="3" width="15" height="13" />
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8" />
                        <circle cx="5.5" cy="18.5" r="2.5" />
                        <circle cx="18.5" cy="18.5" r="2.5" />
                    </svg>
                </div>
                <h2 id="truck-modal-title" class="product-modal__title">ПРОФИЛИ ДЛЯ ФУРГОНОВ: ЗАЩИТА И ДОЛГОВЕЧНОСТЬ</h2>
            </div>
            <button type="button" class="product-modal__close product-modal__close--cyan" data-close-modal="truck" aria-label="Закрыть">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>
        </header>
        <div class="product-modal__body">
            <section class="modal-section modal-lead modal-lead--cyan">
                <p class="lead-text">Облицовочные профили для обшивки каркаса <strong>грузового транспорта</strong>. Обеспечение защиты от механических повреждений и износа при эксплуатации.</p>
            </section>
            <section class="modal-section">
                <h3 class="modal-section__title">Почему наши профили для фургонов — оптимальный выбор</h3>
                <div class="capabilities-grid">
                    <div class="capability-card capability-card--cyan">
                        <div class="capability-card__icon capability-card__icon--cyan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 2v20M2 12h20" />
                            </svg></div>
                        <h4 class="capability-card__title">Прочный материал</h4>
                        <p class="capability-card__desc">Толщина стенки 3 мм (и более) для максимальной надежности</p>
                    </div>
                    <div class="capability-card capability-card--cyan">
                        <div class="capability-card__icon capability-card__icon--cyan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg></div>
                        <h4 class="capability-card__title">Защита каркаса</h4>
                        <p class="capability-card__desc">Предотвращение износа и повреждений при погрузочно-разгрузочных работах</p>
                    </div>
                    <div class="capability-card capability-card--cyan">
                        <div class="capability-card__icon capability-card__icon--cyan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="5" />
                                <line x1="12" y1="1" x2="12" y2="3" />
                                <line x1="12" y1="21" x2="12" y2="23" />
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                                <line x1="1" y1="12" x2="3" y2="12" />
                                <line x1="21" y1="12" x2="23" y2="12" />
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                            </svg></div>
                        <h4 class="capability-card__title">УФ-стойкость</h4>
                        <p class="capability-card__desc">Устойчивость к солнечному излучению и температурным перепадам</p>
                    </div>
                    <div class="capability-card capability-card--cyan">
                        <div class="capability-card__icon capability-card__icon--cyan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <polyline points="20 6 9 17 4 12" />
                            </svg></div>
                        <h4 class="capability-card__title">Быстрый монтаж</h4>
                        <p class="capability-card__desc">Специальный профиль для простоты и скорости установки</p>
                    </div>
                    <div class="capability-card capability-card--cyan">
                        <div class="capability-card__icon capability-card__icon--cyan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                            </svg></div>
                        <h4 class="capability-card__title">Стойкость к нагрузкам</h4>
                        <p class="capability-card__desc">Высокая механическая прочность</p>
                    </div>
                    <div class="capability-card capability-card--cyan">
                        <div class="capability-card__icon capability-card__icon--cyan"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <polyline points="12 6 12 12 16 14" />
                            </svg></div>
                        <h4 class="capability-card__title">Долговечность</h4>
                        <p class="capability-card__desc">Длительный срок службы без потери защитных свойств</p>
                    </div>
                </div>
            </section>
        </div>
        <footer class="product-modal__footer">
            <a href="<?php echo home_url('/quote-request'); ?>" class="modal-cta-primary modal-cta-primary--cyan">Заказать партию</a>
            <a href="#" class="modal-cta-secondary modal-cta-secondary--cyan">Скачать характеристики</a>
        </footer>
    </div>
</div>

<!-- Generic Modal Script -->
<script>
    (function() {
        'use strict';

        const modalTriggers = document.querySelectorAll('[data-modal]');
        const modalCloses = document.querySelectorAll('[data-close-modal]');

        // Open Modal
        modalTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const targetId = this.getAttribute('data-modal');
                // Support both legacy IDs (if any) and new standard IDs
                // Standard: name + '-modal-products'
                let modal = document.getElementById(targetId + '-modal-products');

                if (modal) {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                } else {
                    console.warn('Modal not found for:', targetId);
                }
            });
        });

        // Close Modal via Button
        modalCloses.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const modal = this.closest('.product-modal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close Modal via Backdrop or Escape
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('product-modal__backdrop')) {
                const modal = e.target.closest('.product-modal');
                if (modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const activeModal = document.querySelector('.product-modal.active');
                if (activeModal) {
                    activeModal.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        });
    })();
</script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/products-nav.js" defer></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/products-stats.css">
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/products-stats.js" defer></script>
<?php get_footer(); ?>
