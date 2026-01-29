<?php

/**
 * Production Gallery Section - REWRITTEN (Clean Swiper.js Slider)
 */
?>

<style>
    .production-gallery-v3 {
        padding: 80px 0 0;
        margin-bottom: -20px;
        background-color: #ffffff;
        overflow: hidden;
    }

    .production-gallery-v3__container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .production-gallery-v3__header {
        margin-bottom: 40px;
        text-align: center;
    }

    .production-gallery-v3__title {
        font-family: 'Inter', sans-serif;
        font-size: clamp(28px, 4vw, 42px);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 15px;
        letter-spacing: -0.02em;
        text-transform: uppercase;
        color: #1e293b;
    }

    .production-gallery-v3__subtitle {
        font-family: 'Inter', sans-serif;
        font-size: 18px;
        font-weight: 600;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
    }

    .production-gallery-v3__subtitle::before,
    .production-gallery-v3__subtitle::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e2e8f0;
        max-width: 100px;
    }

    /* Swiper Styles */
    .production-gallery-v3__slider {
        position: relative;
        padding-bottom: 20px;
    }

    .swiper-production {
        width: 100%;
        border-radius: 8px;
        background: #f8fafc;
    }

    .swiper-production .swiper-slide {
        height: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .swiper-production .swiper-slide a {
        display: block;
        width: 100%;
        height: 100%;
        cursor: zoom-in;
    }

    .swiper-production img {
        width: 100%;
        height: 100%;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .swiper-production .swiper-slide:hover img {
        transform: scale(1.03);
    }

    /* Controls */
    .production-gallery-v3__controls {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 12px;
    }

    .production-gallery-v3__btn {
        width: 48px;
        height: 48px;
        border: 1px solid #e2e8f0;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #1e293b;
        padding: 0;
    }

    .production-gallery-v3__btn:hover:not(.swiper-button-disabled) {
        border-color: #0052D4;
        background: #0052D4;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0, 82, 212, 0.2);
    }

    .production-gallery-v3__btn.swiper-button-disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .production-gallery-v3__pagination {
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 600;
        color: #64748b;
        min-width: 60px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .production-gallery-v3 {
            padding: 50px 0;
        }

        .production-gallery-v3__controls {
            justify-content: center;
        }

        .swiper-production img {
            aspect-ratio: 4 / 3;
        }
    }
</style>

<section class="production-gallery-v3" id="production-visual-tour">
    <div class="production-gallery-v3__container">
        <header class="production-gallery-v3__header">
            <h2 class="production-gallery-v3__title">Наше производство изнутри</h2>
            <div class="production-gallery-v3__subtitle">Фотоэкскурсия по цехам</div>
        </header>

        <div class="production-gallery-v3__slider">
            <div class="swiper swiper-production">
                <div class="swiper-wrapper">
                    <?php
                    $gallery_images = [
                        [
                            'file' => 'technologies-and-contract-manufacturing-1.webp',
                            'title' => 'Производственный цех №1: Литье и экструзия',
                            'desc' => 'Общий вид основного производственного зала. Цех оснащен современными высокопроизводительными термопластавтоматами (слева) и линиями для экструзии профилей (справа). Просторное помещение и продуманная логистика позволяют эффективно организовать одновременную работу нескольких производственных линий, обеспечивая бесперебойный выпуск продукции.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-2.webp',
                            'title' => 'Участок литья под давлением: Настройка процесса',
                            'desc' => 'Оператор производит наладку термопластавтомата (ТПА) марки Taiwan Union Plastic. Современная система числового программного управления (ЧПУ) позволяет с высокой точностью задавать параметры литья: температуру, давление и скорость впрыска. Это гарантирует стабильное качество изделий и минимизацию брака в каждой партии.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-3.webp',
                            'title' => 'Цех экструзии: Производственные линии',
                            'desc' => 'Панорамный вид участка экструзии. В кадре — несколько параллельных автоматизированных линий полного цикла. Слева и в центре: Видны экструдеры (желтые агрегаты) и длинные калибровочные столы, необходимые для постепенного охлаждения и стабилизации геометрии пластикового профиля. Логистика: Широкие проходы и четкая напольная разметка обеспечивают безопасность и удобство перемещения готовой продукции и сырья.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-4.webp',
                            'title' => 'Контроль качества на линии экструзии',
                            'desc' => 'Оператор осуществляет визуальный осмотр готового профиля на выходе из зоны калибровки. Непрерывный мониторинг в процессе производства позволяет мгновенно выявлять малейшие отклонения в геометрии или качестве поверхности, гарантируя, что в упаковку попадет только продукция, соответствующая эталону.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-5.webp',
                            'title' => 'Профессиональная команда «Элинар Пласт»',
                            'desc' => 'Наши сотрудники — главная ценность производства. Оператор контролирует прохождение профиля по линии охлаждения. Высокая квалификация персонала и личная ответственность каждого мастера гарантируют соблюдение технологических регламентов на всех этапах выпуска продукции.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-6.webp',
                            'title' => 'Архив эталонных образцов (ОТК)',
                            'desc' => 'Сотрудник отдела технического контроля сверяет продукцию с утвержденным эталоном. На заводе ведется строгий учет и хранение образцов всех выпущенных изделий. Это гарантирует абсолютную повторяемость геометрии и цвета профиля, даже если заказчик обратится за повторной партией спустя несколько лет.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-7.webp',
                            'title' => 'Бережная упаковка продукции',
                            'desc' => 'Мы понимаем, как важно доставить продукцию без повреждений. На фото — процесс ручной упаковки готового профиля. Каждое изделие или пачка надежно фиксируется стрейч-пленкой и скотчем. Это защищает пластик от пыли, влаги и механических потерь (царапин, потертостей) во время транспортировки на склад заказчика.'
                        ],
                        [
                            'file' => 'technologies-and-contract-manufacturing-8.webp',
                            'title' => 'Склад сырья: Стратегический запас',
                            'desc' => 'Мы поддерживаем постоянный складской запас полимеров, чтобы гарантировать бесперебойное выполнение заказов. На фото — зона хранения сырья (ПВХ, АБС, полипропилен) в биг-бэгах и на паллетах. Наличие собственной сырьевой базы и механизированная погрузка позволяют нам не зависеть от колебаний логистики и оперативно запускать в работу крупные партии продукции.'
                        ],
                    ];
                    $base_path = get_template_directory_uri() . '/assets/images/technologies-and-contract-manufacturing/';

                    foreach ($gallery_images as $img) : ?>
                        <div class="swiper-slide">
                            <a href="<?php echo $base_path . $img['file']; ?>" class="glightbox-tech" data-gallery="tech-tour" data-title="<?php echo esc_attr($img['title']); ?>" data-description="<?php echo esc_attr($img['desc']); ?>">
                                <img src="<?php echo $base_path . $img['file']; ?>" alt="<?php echo esc_attr($img['title']); ?>" loading="lazy">
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="production-gallery-v3__controls">
                <div class="production-gallery-v3__pagination"></div>
                <button class="production-gallery-v3__btn prev-tech" aria-label="Назад">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button class="production-gallery-v3__btn next-tech" aria-label="Вперед">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swiper !== 'undefined') {
            const techSwiper = new Swiper('.swiper-production', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 800,
                grabCursor: true,
                navigation: {
                    nextEl: '.next-tech',
                    prevEl: '.prev-tech',
                },
                pagination: {
                    el: '.production-gallery-v3__pagination',
                    type: 'fraction',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 1,
                    },
                    1024: {
                        slidesPerView: 1,
                    }
                }
            });
        }

        if (typeof GLightbox !== 'undefined') {
            const techLightbox = GLightbox({
                selector: '.glightbox-tech',
                touchNavigation: true,
                loop: true,
                zoomable: true,
                draggable: false,
                openEffect: 'fade',
                closeEffect: 'fade',
                slideEffect: 'slide',
                descPosition: 'bottom',
                // Show text/captions
                titleSelector: 'data-title',
                descriptionSelector: 'data-description',
                svg: {
                    close: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                    next: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>',
                    prev: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>'
                }
            });

            // Ensure background is dark and no text is shown
            techLightbox.on('open', () => {
                const container = document.querySelector('.glightbox-container');
                if (container) {
                    container.style.backgroundColor = 'rgba(0,0,0,0.95)';
                }
            });
        }
    });
</script>
