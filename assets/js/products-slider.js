/**
 * Products Page Slider - v6 Complete
 * Базовый слайдер + hover-плашки + кастомная плашка в GLightbox
 */

(function () {
    'use strict';

    console.log('[ProductsSlider v6] Loading...');

    /* === LEGACY FIXER === */
    // Нейтрализуем старый код, который может остаться в кэше HTML
    try {
        if (typeof window.openProductsGallery === 'function') {
            console.log('[ProductsSlider v6] Neutralizing legacy openProductsGallery');
            window.openProductsGallery = function () {
                console.log('[ProductsSlider v6] Legacy call intercepted and blocked');
            };
        }
        if (window.productsLightbox && typeof window.productsLightbox.destroy === 'function') {
            console.log('[ProductsSlider v6] Destroying legacy monolithic lightbox');
            window.productsLightbox.destroy();
            window.productsLightbox = null;
        }
    } catch (e) { console.error('[ProductsSlider v6] Fixer error:', e); }
    /* ==================== */

    let glightboxOpen = false;
    let activeCounterCurrent = null;
    let activeCounterTotal = null;
    let glightboxCounterEl = null;

    // Описания для всех галерей
    const slideDescriptions = {
        pvc: [
            {
                title: 'Экструзионная оснастка: Инжиниринг и Точность',
                intro: 'Собственный инструментальный цех полного цикла позволяет нам проектировать и изготавливать фильеры и калибраторы любой сложности. Мы контролируем каждый этап — от чертежа до финишной полировки, гарантируя идеальную геометрию профиля и стабильность серийного производства.',
                features: [
                    { label: 'Высококачественные легированные стали', text: 'Использование специальных марок нержавеющей и инструментальной стали обеспечивает высокую коррозионную стойкость и долговечность оснастки даже при круглосуточной эксплуатации.' },
                    { label: 'Прецизионная металлообработка', text: 'Изготовление формообразующих деталей на электроэрозионных и фрезерных станках с ЧПУ позволяет достигать микронной точности, необходимой для соблюдения строгих допусков готового изделия.' },
                    { label: 'Эффективная система вакуумирования и охлаждения', text: 'Оптимизированная конструкция каналов охлаждения в калибраторах обеспечивает равномерное остывание профиля, предотвращая деформации, коробление и внутренние напряжения в пластике.' },
                    { label: 'Сложная геометрия и тонкие стенки', text: 'Наши технологии позволяют создавать оснастку для многокамерных профилей, изделий с тонкими стенками, сложными замковыми соединениями и закладными элементами.' },
                    { label: 'Финишная обработка поверхности', text: 'Многоступенчатая полировка рабочих поверхностей канала ("зеркало") гарантирует безупречную гладкость выпускаемого пластикового профиля и улучшает скольжение материала.' },
                    { label: 'Оперативность и ремонтопригодность', text: 'Наличие собственного цеха позволяет сократить срок запуска новых проектов в 2 раза по сравнению с заказом оснастки на стороне, а также оперативно вносить корректировки.' }
                ]
            },
            {
                title: 'Многокамерная термовставка: Технология и Материал',
                intro: 'Высокотехнологичное решение из армированного полиамида, обеспечивающее превосходную теплоизоляцию и структурную надежность в составе комбинированного профиля.',
                features: [
                    { label: 'Максимальная теплоэффективность', text: 'Сопротивление теплопередаче R₀ = 0,85 м²·°C/Вт достигнуто за счет оптимизированного расположения воздушных камер, что превосходит стандартные решения.' },
                    { label: 'Особый состав полимера', text: 'Использование полиамида, армированного стекловолокном (PA66 GF25), гарантирует высокую прочность на сдвиг и коэффициент линейного расширения, идентичный алюминию.' },
                    { label: 'Высокоточное производство', text: 'Экструзия на высокоточных линиях обеспечивает идеальный допуск ±0.05 мм, что критически важно для монолитной и герметичной сборки фасадного профиля.' }
                ]
            },
            {
                title: 'Многокамерная термовставка: Технология и Материал',
                intro: 'Оптимизированная геометрия многокамерного профиля гарантирует исключительные теплофизические свойства и долговечность всей фасадной системы.',
                features: [
                    { label: 'Максимальная теплоэффективность', text: 'Трехкамерная структура термовставки оптимизирована для достижения высоких показателей сопротивления теплопередаче (R₀ > 0,85 м²·°C/Вт), что соответствует самым строгим стандартам энергосбережения.' },
                    { label: 'Особый состав полимера', text: 'Использование высокопрочного армированного полиамида, устойчивого к УФ-излучению и агрессивным средам, сохраняет физические свойства материала десятилетиями.' },
                    { label: 'Высокоточное производство', text: 'Экструзия на оборудовании «Элинар Пласт» обеспечивает идеальное сопряжение пазов и допусков, гарантируя монолитность конструкции, водонепроницаемость и защиту от ветровых нагрузок.' }
                ]
            },
            {
                title: 'Жесткие многокамерные профили: Конструктив и Эстетика',
                intro: 'Мы специализируемся на экструзии конструкционных профилей сложного сечения. Сочетание продуманной геометрии и качественных полимеров позволяет создавать легкие, но сверхпрочные элементы для строительных, мебельных и инженерных систем.',
                features: [
                    { label: 'Усиленная структура (Ребра жесткости)', text: 'Наличие внутренних перегородок обеспечивает профилю высокую прочность на изгиб и сжатие, позволяя выдерживать значительные нагрузки без деформации при сохранении малого веса.' },
                    { label: 'Высокое качество поверхности (High Gloss)', text: 'Использование полированных фильер и качественного сырья позволяет получать изделия с идеально гладкой, глянцевой поверхностью, которая не требует дополнительной обработки и выглядит эстетично.' },
                    { label: 'Окрашивание в массе', text: 'Глубокий черный цвет и однородность тона по всей толщине стенки достигаются за счет добавления пигментов (мастербатчей) на этапе плавления гранул, что делает царапины в процессе эксплуатации незаметными.' },
                    { label: 'Точность сопряжения', text: 'Строгий контроль геометрии "замков" и пазов на профиле гарантирует плотную и надежную стыковку с ответными деталями при сборке готовых конструкций.' },
                    { label: 'Ударопрочные материалы', text: 'Для производства подобных профилей мы используем модифицированные компаунды (АБС, ПВХ), обладающие повышенной ударной вязкостью и стойкостью к механическим повреждениям.' },
                    { label: 'Стабильность размеров', text: 'Оптимизированный процесс охлаждения в вакуумных калибраторах исключает коробление профиля и усадку после выхода из экструдера, обеспечивая прямизну длинномерных изделий.' }
                ]
            },
            {
                title: 'Экструзия сложных профилей: От гранулы до изделия',
                intro: 'Полный цикл производства позволяет нам контролировать качество на этапе подготовки сырья и создавать профили с высокой конструктивной сложность. Мы превращаем полимерные гранулы в высокоточные изделия с заданными физико-механическими свойствами.',
                features: [
                    { label: 'Индивидуальный подбор компаундов', text: 'Работаем с широким спектром полимеров (АБС, ПВХ, ПА, ПП, ПЭ). Подбираем или разрабатываем рецептуру смеси под конкретные условия эксплуатации (морозостойкость, ударопрочность, негорючесть).' },
                    { label: 'Многокамерная геометрия', text: 'На фото представлен профиль со сложным сечением. Внутренние камеры и перегородки обеспечивают высокую жесткость на изгиб и кручение при снижении общего веса изделия.' },
                    { label: 'Высокая конструктивная прочность', text: 'Толстостенные профили, изготовленные методом экструзии, способны выдерживать значительные механические нагрузки, выполняя роль несущих элементов в строительстве и машиностроении.' },
                    { label: 'Строгое соблюдение допусков', text: 'Автоматизированные линии с лазерным контролем размеров гарантируют стабильность геометрии по всей длине изделия, что критически важно для дальнейшей автоматической сборки.' },
                    { label: 'Качество поверхности (Глянец/Матовость)', text: 'Обеспечиваем требуемую фактуру поверхности (гладкую, глянцевую или тисненую) непосредственно в процессе производства, без необходимости дополнительной покраски или шлифовки.' },
                    { label: 'Стабильность цвета и УФ-защита', text: 'Окрашивание в массе (на этапе смешивания гранул с пигментом) гарантирует, что профиль сохранит свой цвет даже при появлении царапин и воздействии солнечных лучей.' }
                ]
            }
        ],
        chamfer: [
            {
                title: 'Фаскообразователи для ЖБИ',
                intro: 'Профили для формирования точных углов на железобетонных изделиях.',
                features: [
                    { label: 'Идеальная эстетика', text: 'Чистый, аккуратный скос для профессионального вида' },
                    { label: 'Защита от брака', text: 'Минимизация сколов и трещин на уязвимых углах' }
                ]
            },
            {
                title: 'Фаскообразователь ПВХ: Идеальная геометрия бетона',
                intro: 'Незаменимый элемент опалубочных систем для монолитного строительства. Профиль формирует аккуратную фаску (скос) на углах бетонных конструкций, предотвращая сколы граней при распалубке и эксплуатации.',
                features: [
                    { label: 'Герметичность стыков опалубки', text: 'Профиль перекрывает щели между щитами опалубки, предотвращая вытекание "цементного молочка". Это гарантирует прочность бетона в угловых зонах и отсутствие раковин.' },
                    { label: 'Удобство монтажа (С "полками")', text: 'Наличие крепежных "ушей" (фланцев) позволяет легко и надежно фиксировать фаскообразователь к опалубке с помощью гвоздей или скоб, исключая его смещение при заливке.' },
                    { label: 'Многократное использование (Оборачиваемость)', text: 'Изготовлен из жесткого, но эластичного ПВХ, который не вступает в реакцию с бетоном. Гладкая поверхность позволяет легко очищать профиль и использовать его повторно в нескольких циклах заливки.' },
                    { label: 'Эстетика и безопасность углов', text: 'Формирует ровный срез угла под 45°. Это не только улучшает визуальное восприятие колонн и стен, но и делает углы безопасными (не острыми) и устойчивыми к механическим ударам.' },
                    { label: 'Химическая стойкость', text: 'Материал профиля инертен к щелочной среде бетонной смеси и не подвержен коррозии, что исключает появление пятен ржавчины на готовом бетонном изделии.' },
                    { label: 'Жесткость конструкции', text: 'Внутреннее ребро жесткости (треугольная камера) предотвращает смятие профиля под давлением бетонной массы, сохраняя идеальную геометрию фаски на всей длине.' }
                ]
            }
        ],
        profiles: [
            {
                title: 'Технические профили',
                intro: 'Погонажные изделия для приборостроения и электротехники.',
                features: [
                    { label: 'Точность', text: 'Высокая геометрическая точность' },
                    { label: 'Качество', text: 'Стабильные характеристики' }
                ]
            }
        ],
        injection: [
            {
                title: 'Литье под давлением',
                intro: 'Серийное производство пластиковых деталей.',
                features: [
                    { label: 'Объём', text: 'От 1 грамма до 5 килограммов' },
                    { label: 'Серийность', text: 'Крупные и средние партии' }
                ]
            }
        ],
        vtulki: [
            {
                title: 'Кольца намоточные с фланцем (Полистирол)',
                intro: 'Специализированные кольца из ударопрочного полистирола. Предназначены для намотки электроизоляционных лент, пленки и фольгированных материалов. Конструкция с бортиком обеспечивает ровный край намотки и предотвращает смещение слоев материала (телескопирование).',
                features: [
                    { label: 'Материал', text: 'Жесткий полистирол (PS), выдерживающий сильное натяжение ленты.' },
                    { label: 'Геометрия', text: 'Наличие ограничительного фланца для формирования идеального торца рулона.' },
                    { label: 'Размеры', text: 'Изготовление под любой диаметр вала и ширину ленты.' }
                ]
            },
            {
                title: 'Намоточные кольца и торцевые заглушки',
                intro: 'Специализированные изделия из ударопрочного полистирола. Предназначены для фиксации и намотки рулонных материалов: электроизоляционных лент, технических пленок и фольгированных основ. Конструкция обеспечивает жесткость намотки и защиту торцов рулона.',
                features: [
                    { label: 'Материал', text: 'Высококачественный полистирол (PS), обеспечивающий стабильность размеров.' },
                    { label: 'Конструктив', text: 'Наличие технологических пазов для фиксации на валу оборудования.' },
                    { label: 'Исполнение', text: 'Возможность изготовления в разных цветах (прозрачный, тонированный, RAL) для цветовой маркировки продукции.' },
                    { label: 'Размеры', text: 'Внутренний и внешний диаметр — по требованию заказчика.' }
                ]
            },
            {
                title: 'Комплектующие для намотки: кольца, втулки, заглушки',
                intro: 'Широкий спектр изделий из ударопрочного полистирола для линий намотки и упаковки. Производим как стандартные торцевые заглушки с пазами, так и гладкие намоточные кольца, дистанционные проставки и переходные втулки.',
                features: [
                    { label: 'Любая геометрия', text: 'Изготовим детали нужной вам высоты, толщины и диаметра.' },
                    { label: 'Материал', text: 'Жесткий полистирол (обеспечивает геометрию рулона) или другие полимеры под заказ.' },
                    { label: 'Цветовая кодировка', text: 'Прозрачные, окрашенные и глухие цвета для маркировки разных типоразмеров продукции.' }
                ]
            }
        ],
        truck: [
            {
                title: 'Профили для фургонов',
                intro: 'Облицовочные профили для грузового транспорта.',
                features: [
                    { label: 'Прочность', text: 'Устойчивость к нагрузкам' },
                    { label: 'Долговечность', text: 'Стойкость к износу' }
                ]
            }
        ]
    };

    // Функция создания HTML описания
    function createDescriptionHTML(desc) {
        let html = `
            <h4 class="slider-description-panel__title">${desc.title}</h4>
            <p class="slider-description-panel__intro">${desc.intro}</p>
        `;

        if (desc.features && desc.features.length > 0) {
            html += '<ul class="slider-description-panel__features">';
            desc.features.forEach(feature => {
                html += `
                    <li class="slider-description-panel__feature">
                        <strong>${feature.label}</strong>
                        <span>${feature.text}</span>
                    </li>
                `;
            });
            html += '</ul>';
        }

        return html;
    }

    // Функция обновления описания в hover-плашке
    function updateDescription(panel, galleryId, index) {
        const content = panel.querySelector('.slider-description-panel__content');
        if (!content) return;

        const descriptions = slideDescriptions[galleryId];

        // Если описания нет для этого слайда (например, слайды 6-11), скрываем плашку
        if (!descriptions || !descriptions[index]) {
            panel.style.opacity = '0';
            panel.style.visibility = 'hidden';
            panel.style.pointerEvents = 'none';
            content.innerHTML = '';
            return;
        }

        // Если описание есть - сбрасываем инлайн-стили, чтобы работали CSS-классы
        panel.style.opacity = '';
        panel.style.visibility = '';
        panel.style.pointerEvents = '';
        content.innerHTML = createDescriptionHTML(descriptions[index]);
    }

    function initSliders() {
        const sliders = document.querySelectorAll('.production-gallery-slider');
        console.log('[ProductsSlider v6] Found sliders:', sliders.length);

        sliders.forEach(slider => {
            if (slider.dataset.initV6) {
                console.log('[ProductsSlider v6] Slider already initialized, skipping');
                return;
            }
            slider.dataset.initV6 = 'true';

            const slides = slider.querySelectorAll('.slide');
            const dots = slider.querySelectorAll('.slider-dot');
            const prevBtn = slider.querySelector('.slider-prev');
            const nextBtn = slider.querySelector('.slider-next');
            const panel = slider.closest('.product-row__slider')?.querySelector('.slider-description-panel');
            const galleryId = panel?.dataset.slider || 'pvc';
            const counter = slider.querySelector('.slider-counter');
            const counterCurrent = slider.querySelector('.slider-counter__current');
            const counterTotal = slider.querySelector('.slider-counter__total');

            // На мобильных показываем счётчик всегда
            const isMobile = window.innerWidth <= 768;
            if (counter && isMobile) {
                counter.style.opacity = '1';
            }

            let idx = 0;
            let autoplay = null;

            let isHovered = false;

            function show(i) {
                slides.forEach(s => s.classList.remove('active'));
                dots.forEach(d => d.classList.remove('active'));
                if (slides[i]) slides[i].classList.add('active');
                if (dots[i]) dots[i].classList.add('active');
                idx = i;

                // Обновляем счётчик слайдов
                if (counterCurrent) {
                    counterCurrent.textContent = i + 1;
                }

                if (glightboxOpen && activeCounterCurrent) {
                    activeCounterCurrent.textContent = i + 1;
                }

                // Обновляем описание в hover-плашке
                if (panel) {
                    updateDescription(panel, galleryId, i);
                }
            }

            function next() { show((idx + 1) % slides.length); }
            function prev() { show((idx - 1 + slides.length) % slides.length); }

            function startAuto() {
                if (autoplay) clearInterval(autoplay);

                // Если мышь находится над слайдером или плашкой, таймер не запускаем
                if (isHovered) return;

                if (slides.length > 1) {
                    autoplay = setInterval(() => {
                        if (!glightboxOpen) next();
                    }, 6000);
                }
            }

            // Навигация
            if (prevBtn) prevBtn.onclick = (e) => { e.preventDefault(); e.stopPropagation(); prev(); startAuto(); };
            if (nextBtn) nextBtn.onclick = (e) => { e.preventDefault(); e.stopPropagation(); next(); startAuto(); };
            dots.forEach((dot, i) => { dot.onclick = (e) => { e.preventDefault(); e.stopPropagation(); show(i); startAuto(); }; });

            /* Hover - показ плашки и остановка автопрокрутки */
            const handleMouseEnter = () => {
                isHovered = true;
                if (autoplay) clearInterval(autoplay);
                if (panel && !glightboxOpen) {
                    panel.classList.add('is-hovered');
                }
            };

            const handleMouseLeave = (e) => {
                // Если мы уходим с слайдера на плашку (или обратно) - не считаем это уходом
                if (panel && e.relatedTarget && (panel.contains(e.relatedTarget) || e.relatedTarget === panel)) return;
                if (slider.contains(e.relatedTarget)) return;

                isHovered = false;
                if (!glightboxOpen) startAuto();
                if (panel) {
                    panel.classList.remove('is-hovered');
                }
            };

            slider.addEventListener('mouseenter', handleMouseEnter);
            slider.addEventListener('mouseleave', handleMouseLeave);

            // Также вешаем события на плашку, чтобы она тоже останавливала таймер
            // (на случай, если pointer-events будут включены или структура изменится)
            if (panel) {
                panel.addEventListener('mouseenter', handleMouseEnter);
                panel.addEventListener('mouseleave', (e) => {
                    // Если уходим с плашки на слайдер - не считаем это уходом
                    if (e.relatedTarget && (slider.contains(e.relatedTarget) || e.relatedTarget === slider)) return;
                    handleMouseLeave(e);
                });
            }

            // Touch
            let touchX = 0;
            slider.ontouchstart = (e) => { touchX = e.changedTouches[0].screenX; isHovered = true; if (autoplay) clearInterval(autoplay); };
            slider.ontouchend = (e) => {
                const diff = touchX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) diff > 0 ? next() : prev();
                isHovered = false; // На мобильных сбрасываем hover состояние после тача
                startAuto();
            };

            show(0);
            startAuto();
            console.log('[ProductsSlider v6] Slider initialized for gallery:', galleryId);
        });
    }

    // Изолированная инициализация GLightbox для каждой галереи
    function initGLightboxIsolated() {
        if (typeof GLightbox === 'undefined') {
            console.warn('[ProductsSlider v6] GLightbox not found/loaded');
            return;
        }

        const galleries = Object.keys(slideDescriptions);
        let initializedCount = 0;

        galleries.forEach(galleryId => {
            const selector = `.custom-lightbox-trigger[data-gallery="${galleryId}"]`;
            // Проверяем наличие элементов, чтобы не создавать пустые инстансы
            const elements = document.querySelectorAll(selector);
            if (elements.length > 0) {
                const lightbox = GLightbox({
                    selector: selector,
                    touchNavigation: true,
                    loop: true,
                    zoomable: true,
                    draggable: true,
                    openEffect: 'zoom',
                    closeEffect: 'fade',
                    cssEfects: {
                        fade: { in: 'fadeIn', out: 'fadeOut' },
                        zoom: { in: 'zoomIn', out: 'zoomOut' }
                    }
                });

                // Sync UI state while GLightbox is open
                lightbox.on('open', () => {
                    glightboxOpen = true;
                    document.body.classList.add('glightbox-open');

                    if (!glightboxCounterEl) {
                        glightboxCounterEl = document.createElement('div');
                        glightboxCounterEl.className = 'glightbox-slider-counter';
                        glightboxCounterEl.innerHTML = '<span class="glightbox-slider-counter__current">1</span><span class="glightbox-slider-counter__separator">/</span><span class="glightbox-slider-counter__total">' + elements.length + '</span>';
                        document.body.appendChild(glightboxCounterEl);
                    }

                    // Bind counter from the corresponding slider (galleryId)
                    const slider = document.querySelector(`.production-gallery-slider[data-slider="${galleryId}"]`) ||
                        document.querySelector(`.product-row__slider [data-slider="${galleryId}"]`)?.closest('.product-row__slider')?.querySelector('.production-gallery-slider');

                    activeCounterCurrent = slider ? slider.querySelector('.slider-counter__current') : null;
                    activeCounterTotal = slider ? slider.querySelector('.slider-counter__total') : null;

                    if (activeCounterTotal) {
                        activeCounterTotal.textContent = elements.length;
                    }
                });

                lightbox.on('close', () => {
                    glightboxOpen = false;
                    document.body.classList.remove('glightbox-open');
                    activeCounterCurrent = null;
                    activeCounterTotal = null;

                    if (glightboxCounterEl) {
                        glightboxCounterEl.remove();
                        glightboxCounterEl = null;
                    }
                });

                lightbox.on('slide_changed', ({ current }) => {
                    if (activeCounterCurrent && current && typeof current.index === 'number') {
                        activeCounterCurrent.textContent = current.index + 1;
                    }

                    if (glightboxCounterEl && current && typeof current.index === 'number') {
                        const el = glightboxCounterEl.querySelector('.glightbox-slider-counter__current');
                        if (el) el.textContent = String(current.index + 1);
                    }
                });

                // Принудительная обработка кликов для предотвращения перехода по ссылке
                elements.forEach((el, idx) => {
                    el.addEventListener('click', (e) => {
                        e.preventDefault();
                        lightbox.openAt(idx);
                    });
                });

                initializedCount++;
            }
        });

        console.log(`[ProductsSlider v6] Initialized ${initializedCount} isolated GLightbox galleries`);
    }

    // Инициализация
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initSliders();
            initGLightboxIsolated();
        });
    } else {
        initSliders();
        initGLightboxIsolated();
    }

    console.log('[ProductsSlider v6] Loaded');
})();
