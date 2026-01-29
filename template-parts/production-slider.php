<?php

/**
 * Production Section - Modern Engineering Redesign
 * Секция "О производстве" с новым дизайном (v5.0)
 */
?>

<section class="section-production-modern" id="about-production">
    <div class="production-grid-container">

        <!-- Area: Title (Top Left) -->
        <div class="production-title-area">
            <h2 class="engineering-title">ПЕРЕДОВЫЕ<br>ИНЖЕНЕРНЫЕ<br>РЕШЕНИЯ</h2>
        </div>

        <!-- Area: Logo (Top Right, aligned with title) -->
        <div class="production-logo-area">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-color.webp"
                 alt="Элинар Пласт"
                 class="production-logo-image"
                 loading="lazy"
                 width="200"
                 height="60">
        </div>

        <!-- Area: Text Content (Left, below title) -->
        <div class="production-content-area">
            <h3 class="engineering-subtitle">Производство погонажных изделий любой сложности на современных экструзионных линиях.</h3>

            <div class="engineering-body">
                <p>
                    «Элинар Пласт» ведёт свою историю с 2001 года. Мы осуществляем два вида производства изделий из пластмасс: <span class="highlight-tech">экструзионное и литьевое</span>. Работаем по чертежам заказчика, поставляя комплектующие со стабильной геометрией и точными характеристиками. Наши изделия заслужили доверие клиентов и на практике подтвердили свою прочность, износостойкость, надёжность и долговечность.
                </p>
                <p>
                    Наш фундамент — технологические стандарты, заложенные немецкой компанией-учредителем, и высокоточная оснастка, изготовленная российскими партнёрами. Всё это позволяет нам реализовывать сложные проекты.
                </p>
                <p>
                    Наши клиенты могут быть уверены, что для решения поставленных ими задач применяются современные высокопроизводительные экструзионные линии и ТПА.
                </p>
                <p>
                    Мы ценим доверие наших заказчиков и работаем с каждым из них, исходя из принципов комплексного подхода к поставленным задачам, взаимного долгосрочного партнерства и информационной открытости.
                </p>
            </div>
        </div>

        <!-- Area: Visual (Right, spanning height of content) -->
        <div class="production-visual-area">
            <div class="slider-container-modern">
                <div class="slider-track" id="productionSliderTrack">
                    <?php
                    // Массив данных для 18 слайдов (инженерная тематика)
                    $slides_data = [
                        1 => [
                            'title' => 'ВЫСОКОТЕХНОЛОГИЧНЫЙ ПАРК ЭКСТРУЗИОННЫХ ЛИНИЙ',
                            'desc'  => 'Автоматизированные линии последнего поколения, обеспечивающие идеальную геометрию профиля. Гарантируем эталонную геометрию профилей любой сложности.',
                            'alt'   => 'Цех экструзии ПВХ профилей'
                        ],
                        2 => [
                            'title' => 'ГАРАНТИЯ ТЕХНОЛОГИЧЕСКОЙ СТАБИЛЬНОСТИ',
                            'desc'  => 'Многоуровневая система контроля на всех этапах — от подачи сырья до выхода готового профиля — обеспечивает максимальный ресурс и долговечность изделий.',
                            'alt'   => 'Контроль качества экструзии'
                        ],
                        3 => [
                            'title' => 'ЭКСПЕРТНОЕ УПРАВЛЕНИЕ ПРОЦЕССОМ',
                            'desc'  => 'Опытные инженеры и современные системы автоматизации работают в едином цикле для достижения исключительной точности геометрии ваших изделий.',
                            'alt'   => 'Инженерный контроль качества'
                        ],
                        4 => [
                            'title' => 'ПРЕЦИЗИОННЫЙ КОНТРОЛЬ ПАРАМЕТРОВ',
                            'desc'  => 'Непрерывный мониторинг технологического цикла и тонкая настройка режимов экструзии гарантируют стабильно высокое качество каждой партии продукции.',
                            'alt'   => 'Мониторинг параметров экструзии'
                        ],
                        5 => [
                            'title' => 'ТОЧНОСТЬ, СООТВЕТСТВУЮЩАЯ ВАШИМ ЧЕРТЕЖАМ',
                            'desc'  => 'Мы контролируем каждый этап экструзии, чтобы вы получили готовый продукт с минимальными допусками для самых ответственных проектов.',
                            'alt'   => 'Высокоточное соответствие чертежам'
                        ],
                        6 => [
                            'title' => 'БЕЗУПРЕЧНОЕ СООТВЕТСТВИЕ ДОПУСКАМ',
                            'desc'  => 'Ручная проверка параметров в сочетании с автоматикой исключает риск отклонений и обеспечивает высокое качество сборки ваших конструкций.',
                            'alt'   => 'Контроль допусков профиля'
                        ],
                        7 => [
                            'title' => 'ИНТЕЛЛЕКТУАЛЬНОЕ УПРАВЛЕНИЕ КАЧЕСТВОМ',
                            'desc'  => 'Тонкая программная настройка режимов работы линий гарантирует идеальную повторяемость характеристик изделий в каждой партии.',
                            'alt'   => 'Программное управление экструзией'
                        ],
                        8 => [
                            'title' => 'АВТОМАТИЗИРОВАННЫЙ КОНТРОЛЬ ПРОЦЕССА',
                            'desc'  => 'Цифровое управление параметрами экструзии на каждом этапе гарантирует стабильность характеристик и долговечность изделий на весь срок эксплуатации.',
                            'alt'   => 'Цифровое управление экструзией'
                        ],
                        9 => [
                            'title' => 'ГАРАНТИЯ НАДЕЖНОСТИ КАЖДОГО МЕТРА',
                            'desc'  => 'Мощности «Элинар Пласт» позволяют выпускать длинномерные изделия любой сложности с гарантированным длительным сроком службы.',
                            'alt'   => 'Производство длинномерных профилей'
                        ],
                        10 => [
                            'title' => 'КОНТРОЛЬ КАЧЕСТВА НА ВЫХОДЕ ИЗ ЛИНИИ',
                            'desc'  => 'Мы проверяем каждый метр выпускаемой продукции, чтобы гарантировать стабильную геометрию и идеальное сопряжение деталей в ваших конструкциях.',
                            'alt'   => 'Контроль качества на линии'
                        ],
                        11 => [
                            'title' => 'БЕРЕЖНАЯ УПАКОВКА И СОХРАНЕНИЕ КАЧЕСТВА',
                            'desc'  => 'Каждое изделие проходит финальный контроль и защищается специальной пленкой для сохранения безупречного товарного вида при транспортировке и хранении.',
                            'alt'   => 'Защитная упаковка продукции'
                        ],
                        12 => [
                            'title' => 'АРХИВ ТЕХНОЛОГИЧЕСКОЙ ОСНАСТКИ ЛЮБОЙ СЛОЖНОСТИ',
                            'desc'  => 'Наша библиотека экструзионных фильер насчитывает сотни уникальных решений, разработанных для ведущих предприятий промышленности и строительства.',
                            'alt'   => 'Архив экструзионных фильер'
                        ],
                        13 => [
                            'title' => 'СООТВЕТСТВИЕ ЭТАЛОННЫМ ПАРАМЕТРАМ',
                            'desc'  => 'Огромный фонд освоенных изделий позволяет нам быстро подбирать готовые решения или разрабатывать уникальные профили под ваши задачи с максимальным ресурсом службы.',
                            'alt'   => 'Фонд освоенных изделий'
                        ],
                        14 => [
                            'title' => 'ВЫСОКОТЕХНОЛОГИЧНОЕ ЛИТЬЕ ПОД ДАВЛЕНИЕМ',
                            'desc'  => 'Современный парк ТПА нового поколения позволяет производить сложные инженерные детали весом от 1 грамма до 5 кг с гарантированным запасом прочности для работы под нагрузкой.',
                            'alt'   => 'Парк термопластавтоматов'
                        ],
                        15 => [
                            'title' => 'КАЧЕСТВЕННОЕ СЫРЬЕ — ОСНОВА ДОЛГОВЕЧНОСТИ',
                            'desc'  => 'Мы используем только первичные полимеры высшего сорта от проверенных поставщиков. Это фундамент надежности и максимального ресурса эксплуатации наших изделий.',
                            'alt'   => 'Первичное полимерное сырье'
                        ],
                        16 => [
                            'title' => 'ВЫСОКОТОЧНАЯ ТЕХНОЛОГИЧЕСКАЯ ОСНАСТКА',
                            'desc'  => 'Проектирование и эксплуатация пресс-форм любой сложности. Мы гарантируем идеальную геометрию деталей и миллионы циклов литья без потери качества.',
                            'alt'   => 'Высокоточная технологическая оснастка'
                        ],
                        17 => [
                            'title' => 'БЕЗУПРЕЧНЫЙ ВЫХОД ГОТОВОЙ ПРОДУКЦИИ',
                            'desc'  => 'Автоматизированный цикл литья под давлением обеспечивает мгновенное получение деталей с эталонной поверхностью, полностью готовой к сборке.',
                            'alt'   => 'Готовая продукция литья'
                        ],
                        18 => [
                            'title' => 'БЕСПЕРЕБОЙНОСТЬ И МАСШТАБ ПОСТАВОК',
                            'desc'  => 'Собственные складские мощности и значительный запас сырья гарантируют стабильность производства и оперативную отгрузку ваших заказов точно в срок.',
                            'alt'   => 'Склад сырья и готовой продукции'
                        ]
                    ];

                    for ($i = 1; $i <= 18; $i++) {
                        $is_active = ($i === 1) ? 'active' : '';
                        $aria_hidden = ($i === 1) ? 'false' : 'true';
                        $tabindex = ($i === 1) ? '0' : '-1';
                        $slide_src_base = get_template_directory_uri() . '/assets/images/home-slider-main/production-slide-' . $i;
                        $data = $slides_data[$i] ?? [
                            'title' => 'Производственный процесс',
                            'desc' => 'Высокие стандарты качества Элинар Пласт',
                            'alt' => 'Производство пластика'
                        ];

                        // First slide: no lazy loading, sync decoding, high priority, full resolution only
                        // Other slides: lazy loading with srcset for responsive images
                        $is_first_slide = ($i === 1);
                    ?>
                        <!-- Slide <?php echo $i; ?> -->
                        <div class="slider-slide <?php echo $is_active; ?>" aria-hidden="<?php echo $aria_hidden; ?>">
                            <div class="slide-image">
                                <a href="<?php echo $slide_src_base; ?>.webp"
                                    class="glightbox"
                                    data-gallery="production-gallery"
                                    data-title="<?php echo esc_attr($data['title']); ?>"
                                    data-description="<?php echo esc_attr($data['desc']); ?>"
                                    tabindex="<?php echo $tabindex; ?>">
                                    <?php
                                    // Loading strategy:
                                    // Slide 1: High priority, sync decoding (LCP)
                                    // Slides 2-3: Eager loading (preload next for smooth start)
                                    // Slides 4-18: Lazy loading
                                    $loading = ($i <= 3) ? 'eager' : 'lazy';
                                    $decoding = ($i === 1) ? 'sync' : 'async';
                                    $fetchpriority = ($i === 1) ? 'fetchpriority="high"' : '';
                                    ?>
                                    <img src="<?php echo $slide_src_base; ?>.webp"
                                        alt="<?php echo esc_attr($data['alt']); ?>"
                                        loading="<?php echo $loading; ?>"
                                        decoding="<?php echo $decoding; ?>"
                                        <?php echo $fetchpriority; ?>
                                        width="1200"
                                        height="538">
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
            <!-- Modern Controls - outside slider-container to avoid overflow:hidden clipping -->
            <div class="slider-controls-modern">
                <button class="slider-btn-modern prev" id="productionSliderPrev" aria-label="Предыдущий слайд">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <div class="slider-counter-modern">
                    <span id="current-slide">01</span> / <span id="total-slides">18</span>
                </div>
                <button class="slider-btn-modern next" id="productionSliderNext" aria-label="Следующий слайд">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Area: Stats (Bottom) -->
        <div class="production-stats-area">
            <div class="stat-item-modern">
                <div class="stat-header">
                    <span class="tech-dot"></span>
                    <span class="stat-value" data-target="2001">2001</span>
                </div>
                <div class="stat-desc">Год основания</div>
            </div>

            <div class="stat-divider"></div>

            <div class="stat-item-modern">
                <div class="stat-header">
                    <span class="tech-dot"></span>
                    <span class="stat-value text-value">ВЫСОКИЕ</span>
                </div>
                <div class="stat-desc">Стандарты качества</div>
            </div>

            <div class="stat-divider"></div>

            <div class="stat-item-modern">
                <div class="stat-header">
                    <span class="tech-dot"></span>
                    <span class="stat-value text-value">ТЕХНОЛОГИИ</span>
                </div>
                <div class="stat-desc">Экструзия, литьё под давлением</div>
            </div>
        </div>

    </div>
</section>
