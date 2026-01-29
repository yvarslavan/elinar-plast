<?php
/*
Template Name: Technologies and Production
*/
// Форма обрабатывается универсальным обработчиком в functions.php (elinar_handle_project_form_universal)
get_header();
?>
<style>
    /* Переопределение цвета заголовков на темно-синий #1E293B */
    .site-main section:not(.audit-section) h2:not(.faq-hero-teaser-title):not(.hero-content h2),
    .site-main section:not(.audit-section) h2.text-primary:not(.faq-hero-teaser-title):not(.hero-content h2),
    .site-main section:not(.audit-section) h3:not(.faq-hero-teaser-title):not(.benefits-heading),
    .site-main section:not(.audit-section) h3.text-primary:not(.faq-hero-teaser-title):not(.benefits-heading),
    .site-main section:not(.audit-section) h4,
    .site-main section:not(.audit-section) h4.text-primary,
    .site-main .section-title h2,
    .site-main .case-title,
    .site-main .case-point-title,
    .site-main .faq-main-title,
    .site-main .materials-grid h4,
    .site-main h2.text-primary:not(.audit-title),
    .site-main h3.text-primary,
    .site-main h4.text-primary {
        color: #1E293B !important;
    }

    /* КРИТИЧЕСКИ ВАЖНО: Форма аудита должна иметь белый заголовок */
    html body.page-template-page-technologies-production #contact-form.audit-section .audit-title,
    html body.page-template-page-technologies-production #contact-form.audit-section h2.audit-title,
    html body.page-template-page-technologies-production #contact-form.audit-section .expertise-title,
    html body.page-template-page-technologies-production #contact-form.audit-section h2.expertise-title,
    html body.page-template-page-technologies-production #contact-form.audit-section .benefits-heading,
    html body.page-template-page-technologies-production #contact-form.audit-section h3.benefits-heading {
        color: #ffffff !important;
    }
</style>
<?php get_template_part('template-parts/hero-panorama-interactive'); ?>

<main>
    <!-- 2. PRODUCTION CAPABILITIES -->
    <section class="section production-capabilities-section">
        <div class="container">
            <div class="production-capabilities-header">
                <h2 class="production-capabilities-title">Наши производственные возможности</h2>
                <p class="production-capabilities-subtitle">Мы предлагаем передовые решения для производства профильно-погонажных и литьевых изделий любой сложности, используя современное оборудование</p>
            </div>
            <div class="production-capabilities-grid">
                <!-- Экструзия -->
                <div class="production-capability-card production-capability-card--blue">
                    <div class="capability-card-content">
                        <div class="capability-icon capability-icon--blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2 12h20" />
                                <path d="M2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6" />
                                <path d="M12 2v20" />
                                <path d="M2 12V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v6" />
                            </svg>
                        </div>
                        <h3 class="capability-title">Экструзия профилей</h3>
                        <p class="capability-description">Классическая технология для создания изделий постоянного сечения. Производим профили по чертежам заказчика любой сложности: от профиля для шинопровода до многокамерных профилей из жёсткого ПВХ, а также профилей, сочетающих в себе свойства разных полимеров (например, жесткая основа и мягкий уплотнитель) за один производственный цикл.</p>
                        <ul class="capability-list">
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Профили любой геометрии по чертежам заказчика</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Стабильность размеров по всей длине изделия</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Многокамерные и армированные профили</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Нарезка в размер и упаковка под заказ</span>
                            </li>
                        </ul>
                        <div class="capability-materials">
                            <span class="material-chip">ПВХ</span>
                            <span class="material-chip">АБС</span>
                            <span class="material-chip">ПЭ</span>
                            <span class="material-chip">ПП</span>
                            <span class="material-chip">ТПЭ</span>
                        </div>
                    </div>
                    <a href="#contact-form" class="capability-cta-btn">Рассчитать проект</a>
                </div>

                <!-- Литье -->
                <div class="production-capability-card production-capability-card--green">
                    <div class="capability-card-content">
                        <div class="capability-icon capability-icon--green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <rect x="7" y="7" width="10" height="10" />
                                <circle cx="17" cy="7" r="1" />
                                <path d="M7 17v-4" />
                            </svg>
                        </div>
                        <h3 class="capability-title">Литьё пластмасс под давлением</h3>
                        <p class="capability-description">Серийное производство технических и декоративных деталей на современном парке термопластавтоматов. Полный цикл: от 3D-прототипа и изготовления пресс-формы до серийного выпуска.</p>
                        <ul class="capability-list">
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Комплектующие для корпусных изделий</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Кольца для намотки электроизоляционных материалов</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Изделия по индивидуальным чертежам заказчика</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span>Стабильные поставки с гарантией качества</span>
                            </li>
                        </ul>
                        <div class="capability-materials">
                            <span class="material-chip">ПС</span>
                            <span class="material-chip">АБС</span>
                        </div>
                    </div>
                    <a href="#contact-form" class="capability-cta-btn">Рассчитать проект</a>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Hero Teaser -->
    <div class="container">
        <div class="faq-hero-teaser">
            <div class="faq-hero-teaser-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div class="faq-hero-teaser-content">
                <h3 class="faq-hero-teaser-title">Есть вопросы по контрактному производству?</h3>
                <p class="faq-hero-teaser-subtitle">Собрали готовые ответы на типовые запросы клиентов</p>
            </div>
            <a href="#faq" class="faq-hero-teaser-btn" data-faq-teaser="hero">
                Смотреть 8 ответов
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>
    </div>

    <!-- 3. MATERIALS -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-title">
                <h2>Используемые материалы</h2>
                <p>Мы подбираем сырье под конкретные условия эксплуатации (мороз, УФ-излучение, ударные нагрузки).</p>
            </div>
            <div class="materials-grid">
                <!-- Верхняя строка -->
                <div class="material-card">
                    <div class="material-badge">PVC</div>
                    <h4>ПВХ</h4>
                    <p>Термопласт общего назначения</p>
                </div>
                <div class="material-card">
                    <div class="material-badge">ABS</div>
                    <h4>АБС-пластик</h4>
                    <p>Универсальный конструкционный материал</p>
                </div>
                <div class="material-card">
                    <div class="material-badge">PE</div>
                    <h4>Полиэтилен</h4>
                    <p>Термопласт общего назначения</p>
                </div>
                <!-- Нижняя строка -->
                <div class="material-card">
                    <div class="material-badge">PP</div>
                    <h4>Полипропилен</h4>
                    <p>Термопласт общего назначения</p>
                </div>
                <div class="material-card">
                    <div class="material-badge">TPE</div>
                    <h4>ТПЭ</h4>
                    <p>Термопластичный эластомер</p>
                </div>
                <div class="material-card">
                    <div class="material-badge">HIPS</div>
                    <h4>Полистирол</h4>
                    <p>Ударопрочный полистирол</p>
                </div>
            </div>
            <div class="materials-note">
                <p class="text-center" style="color: var(--color-text); margin-top: 2rem;"><strong>Опции:</strong> Подбор цвета, добавок против старения и работа с сырьем заказчика.</p>
            </div>
        </div>
    </section>

    <!-- 4. ORDER STEPS -->
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>От чертежа до серийной партии</h2>
            </div>
            <div class="steps-grid order-steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Заявка и анализ</h4>
                    <p>Вы присылаете чертеж или 3D-модель, указываете материал и тираж. Мы рассчитываем стоимость.</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Проектирование оснастки</h4>
                    <p>Совместно с партнерами проектируем и изготавливаем пресс-форму или экструзионную оснастку (срок: 2-4 месяца).</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Образцы и испытания</h4>
                    <p>Запуск опытной партии, настройка режимов, проверка геометрии, предоставление образцов продукции.</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h4>Серийное производство</h4>
                    <p>Изготовление промышленной партии (объём – по согласованию с заказчиком), контроль качества, упаковка и доставка.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4.6 CASES -->
    <section class="section bg-light section-cases">
        <div class="container">
            <div class="section-title">
                <h2>Реальные кейсы контрактного производства: от задачи до серии</h2>
                <p>Ниже — типовые сценарии, с которыми к нам приходят. Под каждую задачу подбираем материал, технологию (экструзия или литьё) и режимы, чтобы партия была стабильной и предсказуемой.</p>
            </div>

            <div class="cases-grid">
                <article class="case-card">
                    <div class="case-card-header">
                        <span class="case-badge">Экструзия</span>
                        <h3 class="case-title">Термовставка (ПВХ) для фасадной системы</h3>
                    </div>
                    <div class="case-points">
                        <div class="case-point">
                            <div class="case-point-title">Задача</div>
                            <div class="case-point-text">Стабильная геометрия и повторяемость профиля, чтобы сборка проходила без подгонки.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Решение</div>
                            <div class="case-point-text">Подбор ПВХ-композиции и режимов экструзии, контроль профиля по критическим размерам.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Результат</div>
                            <div class="case-point-text">Параметры профиля повторяются от запуска к запуску, сборка проходит предсказуемо.</div>
                        </div>
                    </div>
                </article>

                <article class="case-card">
                    <div class="case-card-header">
                        <span class="case-badge">Экструзия</span>
                        <h3 class="case-title">Профиль для стеклянных полок холодильников</h3>
                    </div>
                    <div class="case-points">
                        <div class="case-point">
                            <div class="case-point-title">Задача</div>
                            <div class="case-point-text">Аккуратная посадка и стабильная работа в условиях бытовой химии и температурных перепадов.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Решение</div>
                            <div class="case-point-text">Подбор материала, производство профиля под ответные детали, контроль внешнего вида.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Результат</div>
                            <div class="case-point-text">Ровная посадка и предсказуемое качество изделия в серии.</div>
                        </div>
                    </div>
                </article>

                <article class="case-card">
                    <div class="case-card-header">
                        <span class="case-badge case-badge-injection">Литьё под давлением</span>
                        <h3 class="case-title">Техническая литьевая деталь для упаковки шпуль</h3>
                    </div>
                    <div class="case-points">
                        <div class="case-point">
                            <div class="case-point-title">Задача</div>
                            <div class="case-point-text">Серийное производство с необходимой прочностью и стабильным внешним видом.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Решение</div>
                            <div class="case-point-text">Проверка конструкции на технологичность, подбор пластика, настройка режимов литья, контроль первых изделий.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Результат</div>
                            <div class="case-point-text">Повторяемость геометрии и стабильное качество в партии.</div>
                        </div>
                    </div>
                </article>

                <article class="case-card">
                    <div class="case-card-header">
                        <span class="case-badge">Экструзия</span>
                        <h3 class="case-title">Профиль для осветительного шинопровода</h3>
                    </div>
                    <div class="case-points">
                        <div class="case-point">
                            <div class="case-point-title">Задача</div>
                            <div class="case-point-text">Стабильные геометрические размеры, прочность и гибкость, надёжность сборки.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Решение</div>
                            <div class="case-point-text">Подбор материала, контроль профиля по критическим размерам.</div>
                        </div>
                        <div class="case-point">
                            <div class="case-point-title">Результат</div>
                            <div class="case-point-text">Стабильный внешний вид и геометрия, единый стандарт качества в партии.</div>
                        </div>
                    </div>
                </article>
            </div>

            <div class="cases-cta">
                <div class="cases-cta-text">
                    Есть похожая задача? Пришлите чертёж/эскиз — инженер проверит технологичность, подберёт материал и предложит оптимальный маршрут производства.
                </div>
                <a class="btn btn-accent" href="#contact-form">Отправить чертёж на расчёт</a>
            </div>
        </div>
    </section>

    <!-- 4.7 TECHNICAL EQUIPMENT -->
    <section class="section equipment-section">
        <div class="container">
            <div class="section-title equipment-title">
                <h2>Производственные мощности и оборудование</h2>
                <p class="equipment-lead">Мы не просто декларируем качество, мы обеспечиваем его технически. Наш цех оснащен немецкими экструзионными линиями IDE и высокоточными термопластавтоматами с сервоприводами, что гарантирует стабильность размеров и физико-механических свойств изделий.</p>
            </div>

            <div class="equipment-grid">
                <article class="equipment-card">
                    <a class="equipment-media glightbox" href="<?php echo get_template_directory_uri(); ?>/assets/images/technologies-and-contract-manufacturing/technologies-and-contract-manufacturing-2.webp" data-gallery="equipment" data-glightbox="title: Прецизионное литье на ТПА Union (Тайвань); description: Термопластавтомат Union серии UN M7II">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/technologies-and-contract-manufacturing/technologies-and-contract-manufacturing-2.webp" alt="Термопластавтомат Union UN M7II" loading="lazy">
                    </a>
                    <div class="equipment-content">
                        <h3>Прецизионное литье на ТПА Union (Тайвань)</h3>
                        <p>Парк оборудования включает термопластавтоматы серии <strong>UN M7II (Precision Energy Saving)</strong>. Это станки нового поколения с сервоприводами, обеспечивающие максимальную точность литья технических изделий.</p>
                        <ul class="equipment-list">
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Высокая точность:</strong> Сервосистема гарантирует повторяемость размеров сложных корпусных деталей до сотых долей миллиметра.</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Стабильность процесса:</strong> Минимальные пульсации давления позволяют работать с тонкими стенками и ответственными лицевыми деталями.</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Цифровой контроль:</strong> Оператор отслеживает параметры каждого цикла и сохраняет паспорта плавок через интеллектуальную панель управления.</span>
                            </li>
                        </ul>
                    </div>
                </article>

                <article class="equipment-card">
                    <a class="equipment-media glightbox" href="<?php echo get_template_directory_uri(); ?>/assets/images/technologies-and-contract-manufacturing/technologies-and-contract-manufacturing-3.webp" data-gallery="equipment" data-glightbox="title: Немецкие линии IDE (Bernhard Ide GmbH); description: Крупный план пульта управления экструзионной линии">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/technologies-and-contract-manufacturing/technologies-and-contract-manufacturing-3.webp" alt="Экструзионная линия IDE Германия" loading="lazy">
                    </a>
                    <div class="equipment-content">
                        <h3>Немецкие линии IDE (Bernhard Ide GmbH)</h3>
                        <p>Основа нашего парка — оборудование немецкой фирмы Bernhard Ide GmbH. Это эталон точности в производстве профилей.</p>
                        <ul class="equipment-list">
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Экструзия IDE:</strong> Одношнековые системы с автоматической синхронизацией исключают пульсацию расплава, гарантируя равномерную толщину стенок и гомогенность материала.</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Вакуумная калибровка:</strong> Система распределения вакуума и воды фиксирует идеальную геометрию даже многокамерных изделий сразу на выходе из фильеры.</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Гусеничная протяжка:</strong> В отличие от роликов, гусеничное тянущее устройство исключает проскальзывание и деформацию профиля при вытягивании.</span>
                            </li>
                            <li>
                                <span class="check-icon">✓</span>
                                <span><strong>Цифровой контроль и резка:</strong> Автоматическое поддержание температурных зон и встроенный пильный узел для чистого реза без заусенцев.</span>
                            </li>
                        </ul>
                    </div>
                </article>
            </div>

            <div class="equipment-footer">
                <div class="equipment-footer-grid">
                    <div class="equipment-footer-col">
                        <h4 class="equipment-footer-col-title">Инженерные сети</h4>
                        <p class="equipment-footer-col-text">Собственная система водоподготовки и промышленные чиллеры для сокращения цикла литья.</p>
                    </div>
                    <div class="equipment-footer-col">
                        <h4 class="equipment-footer-col-title">Ремонт оснастки</h4>
                        <p class="equipment-footer-col-text">Свой слесарный участок для оперативного обслуживания и мелкого ремонта пресс-форм на месте.</p>
                    </div>
                    <div class="equipment-footer-col">
                        <h4 class="equipment-footer-col-title">Экономика и Zero Waste</h4>
                        <p class="equipment-footer-col-text">Продаем технологические отходы (литники) переработчикам, снижая себестоимость вашей продукции.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4.7 ENGINEERING OTK -->
    <section class="section engineering-otk-section">
        <div class="container">
            <div class="engineering-otk-grid">
                <div class="engineering-otk-media">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/manufacture_team.webp" alt="Инженеры-технологи проводят инструментальную проверку экструзионной оснастки и сверку чертежей" loading="lazy" decoding="async">
                </div>
                <div class="engineering-otk-content">
                    <h2 class="engineering-otk-title">Инженерный надзор и метрологический контроль</h2>
                    <p class="engineering-otk-text">Технологическая база «Элинар Пласт» — это не только парк станков, но и строгий инженерный регламент. Мы исключаем работу «на глаз»: каждый этап, от сборки формующей головы до выхода готового профиля, сопровождается инструментальными замерами. Это гарантирует идеальную повторяемость изделий в каждой партии.</p>
                    <ul class="engineering-otk-list">
                        <li>
                            <span class="check-icon">✓</span>
                            <span><strong>Верификация оснастки:</strong> На фото запечатлен аудит формующего инструмента (матриц и дорнов). Перед каждым запуском инженеры проверяют сопряжение деталей и чистоту каналов, чтобы исключить дефекты поверхности и разностенность профиля.</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span><strong>Прецизионные измерения:</strong> Мы используем поверенный измерительный инструмент и калибры для контроля критических допусков. Сверка геометрии образцов с конструкторской документацией (КД) проводится на старте и в процессе производства.</span>
                        </li>
                        <li>
                            <span class="check-icon">✓</span>
                            <span><strong>Технологическая экспертиза:</strong> Наши специалисты решают задачи любой сложности: от подбора оптимальных полимерных композиций до разработки оснастки для профилей со сложной геометрией и внутренними перегородками.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- 4.7 PRODUCTION GALLERY -->
    <?php get_template_part('template-parts/production-gallery'); ?>

    <!-- 4.8 PRODUCTION VIDEO - Overlap Design -->
    <?php get_template_part('template-parts/production-video'); ?>

    <!-- 6. FAQ -->
    <style>
        .faq-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
        }

        @media (min-width: 768px) {
            .faq-grid {
                grid-template-columns: repeat(2, 1fr);
                align-items: start;
            }
        }

        .faq-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .faq-card-header {
            width: 100%;
            text-align: left;
            padding: 20px 24px;
            background: #fff;
            border: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .faq-card-title {
            font-weight: 700;
            color: #1e293b;
            font-size: 1.1rem;
            line-height: 1.4;
            transition: color 0.3s ease;
            padding-right: 16px;
        }

        .faq-icon-wrapper {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .faq-arrow {
            width: 20px;
            height: 20px;
            stroke: #64748b;
            stroke-width: 2.5;
            transition: stroke 0.3s ease, transform 0.3s ease;
        }

        /* Active State */
        .faq-item[aria-expanded="true"] .faq-card-header {
            background-color: #0f4c5c;
        }

        .faq-item[aria-expanded="true"] .faq-card-title {
            color: #ffffff;
        }

        .faq-item[aria-expanded="true"] .faq-icon-wrapper {
            background-color: #22c55e;
        }

        .faq-item[aria-expanded="true"] .faq-arrow {
            stroke: #ffffff;
            transform: rotate(180deg);
        }

        .faq-card-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out;
            background: #fff;
        }

        .faq-item[aria-expanded="true"] .faq-card-body {
            max-height: 1000px;
            /* Достаточно для длинного текста */
        }

        .faq-answer-content {
            padding: 0 24px 24px 24px;
            color: #334155;
            line-height: 1.6;
        }

        .faq-answer-content p {
            margin-bottom: 0.75rem;
        }

        .faq-answer-content p:last-child {
            margin-bottom: 0;
        }

        /* FAQ Header Styles */
        .faq-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .faq-label {
            display: inline-block;
            color: #f59e0b;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .faq-main-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .faq-subtitle {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .faq-main-title {
                font-size: 2rem;
            }

            .faq-subtitle {
                font-size: 1rem;
            }
        }

        /* ============================================
           PRODUCTION CAPABILITIES SECTION
           ============================================ */
        .production-capabilities-section {
            padding: 5rem 0;
            background: #ffffff;
        }

        .production-capabilities-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .production-capabilities-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 1rem 0;
            line-height: 1.2;
        }

        .production-capabilities-subtitle {
            font-size: 1.125rem;
            color: #64748b;
            line-height: 1.6;
            max-width: 800px;
            margin: 0 auto;
        }

        @media (min-width: 1024px) {
            .production-capabilities-title {
                font-size: 3rem;
            }
        }

        .production-capabilities-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .production-capabilities-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2.5rem;
            }
        }

        @media (min-width: 1024px) {
            .production-capabilities-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 2.5rem;
                max-width: 900px;
            }
        }

        .production-capability-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .production-capability-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }

        .capability-card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .capability-icon {
            width: 64px;
            height: 64px;
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            flex-shrink: 0;
        }

        .capability-icon--blue {
            background: #eff6ff;
            color: #2563eb;
        }

        .capability-icon--green {
            background: #f0fdf4;
            color: #16a34a;
        }


        .capability-icon svg {
            width: 48px;
            height: 48px;
        }

        .capability-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0052D4;
            margin: 0 0 1rem 0;
            line-height: 1.3;
        }

        .capability-description {
            font-size: 1rem;
            color: #475569;
            line-height: 1.6;
            margin: 0 0 1.5rem 0;
            min-height: 4.8rem;
            /* ~3 lines */
        }

        .capability-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem 0;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            flex: 1;
        }

        .capability-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.9375rem;
            line-height: 1.5;
            color: #475569;
        }

        .check-icon {
            color: #ff6b35;
            font-weight: 700;
            font-size: 1.125rem;
            flex-shrink: 0;
            margin-top: 0.125rem;
        }

        /* Цвет галочек для разных карточек */
        .production-capability-card--blue .check-icon {
            color: #2563eb;
        }

        .production-capability-card--green .check-icon {
            color: #16a34a;
        }

        .capability-list li span:last-child {
            flex: 1;
        }

        .capability-list li strong {
            color: #0f172a;
            font-weight: 600;
        }

        /* Material chips/tags */
        .capability-materials {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e2e8f0;
        }

        .material-chip {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            border: 1px solid #e2e8f0;
            border-radius: 2rem;
            font-size: 0.8125rem;
            font-weight: 600;
            color: #475569;
            transition: all 0.2s ease;
        }

        .material-chip:hover {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-color: #93c5fd;
            color: #1d4ed8;
        }

        /* CTA Button */
        .capability-cta-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 1rem 1.5rem;
            background-color: #f59e0b;
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 0.75rem;
            transition: all 0.3s ease;
            margin-top: auto;
        }

        .capability-cta-btn:hover {
            background-color: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
            color: #ffffff;
        }

        /* Mobile adjustments */
        @media (max-width: 767px) {
            .production-capabilities-section {
                padding: 3rem 0;
            }

            .production-capabilities-title {
                font-size: 2rem;
            }

            .production-capabilities-subtitle {
                font-size: 1rem;
            }

            .production-capability-card {
                padding: 2rem 1.5rem;
            }

            .capability-title {
                font-size: 1.25rem;
            }

            .capability-description {
                min-height: auto;
            }

            .capability-materials {
                gap: 0.375rem;
            }

            .material-chip {
                padding: 0.25rem 0.625rem;
                font-size: 0.75rem;
            }

            .capability-cta-btn {
                padding: 0.875rem 1.25rem;
                font-size: 0.9375rem;
            }
        }

        /* ============================================
           ENGINEERING OTK SECTION
           ============================================ */
        .engineering-otk-section {
            padding: 5rem 0;
            background: #ffffff;
        }

        .engineering-otk-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
            align-items: center;
        }

        @media (min-width: 900px) {
            .engineering-otk-grid {
                grid-template-columns: 1.05fr 0.95fr;
                gap: 3rem;
            }
        }

        .engineering-otk-media img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 1.5rem;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.12);
        }

        .engineering-otk-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0 0 1.25rem 0;
            line-height: 1.2;
        }

        .engineering-otk-text {
            font-size: 1rem;
            color: #475569;
            line-height: 1.7;
            margin: 0 0 1rem 0;
        }

        .engineering-otk-list {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0 0 0;
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .engineering-otk-list li {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            font-size: 0.975rem;
            line-height: 1.6;
            color: #475569;
        }

        .engineering-otk-list li strong {
            color: #0f172a;
            font-weight: 600;
        }

        @media (max-width: 767px) {
            .engineering-otk-section {
                padding: 3rem 0;
            }

            .engineering-otk-title {
                font-size: 1.75rem;
            }
        }
    </style>
    <section id="faq" class="section bg-light" itemscope itemtype="https://schema.org/FAQPage">
        <div class="container">
            <div class="faq-header">
                <div class="faq-label">ГОТОВЫЕ ОТВЕТЫ</div>
                <h2 class="faq-main-title">Самые Популярные Вопросы</h2>
                <p class="faq-subtitle">Здесь мы собрали вопросы, которые наши заказчики задают чаще всего.</p>
                <button class="faq-expand-all-btn" id="faq-expand-all" aria-label="Развернуть все вопросы">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="17 11 12 6 7 11"></polyline>
                        <polyline points="17 18 12 13 7 18"></polyline>
                    </svg>
                    <span>Развернуть все</span>
                </button>
            </div>
            <div class="faq-grid faq-accordion">
                <!-- Карточка 1 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">Как быстро вы можете изготовить профиль или деталь?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Если у вас уже есть готовая оснастка — запуск производства занимает от нескольких дней до 2 недель (в зависимости от загрузки линий). Если требуется изготовление экструзионной оснастки или пресс-формы «с нуля»,процесс занимает от 2 до 4 месяцев (включая проектирование, производство инструмента и пуско-наладку).</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 2 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">Какие минимальные партии вы берете в работу?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Мы ориентированы на серийное промышленное производство.</p>
                            <p>Для экструзии: оптимальная партия — от 1000–3000 погонных метров (в зависимости от веса профиля).</p>
                            <p>Для литья: от 1000 единиц изделий.</p>
                            <p>Для постоянных клиентов и крупных проектов мы готовы обсуждать индивидуальные условия и тестовые партии меньшего объема.</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 3 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">Кому принадлежит пресс-форма или фильера после изготовления?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Если вы оплачиваете изготовление оснастки, она является вашей собственностью. Мы берем её на ответственное хранение и проводим бесплатное техническое обслуживание (чистку, смазку, консервацию) на протяжении всего срока сотрудничества. Вы в любой момент можете забрать оснастку.</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 4 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">С какими видами пластиков вы работаете?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Мы перерабатываем широкий спектр полимеров. Основные материалы: жесткий и мягкий ПВХ (PVC), полиэтилен (PE), полипропилен (PP), АБС-пластик (ABS). Если вашему проекту требуется специфический компаунд, наши технологи помогут подобрать сырье с нужными характеристиками (морозостойкость, УФ-стабильность, ударопрочность).</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 5 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">У меня нет чертежа, только образец или идея. Вы поможете?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Да. Совместно с разработчиками оснастки оказываем услуги реверс-инжиниринга. Мы можем разработать 3D-модель и чертеж на основе вашего физического образца, эскиза или технического задания, адаптировав изделие под технологии экструзии или литья.</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 6 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">Предоставляете ли вы образцы продукции?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Да. При запуске нового изделия мы обязательно предоставляем опытные образцы (отливки или метры профиля) для утверждения геометрии и качества перед запуском серии. Образцы стандартной продукции могут быть предоставлены по запросу.</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 7 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">Как осуществляется контроль качества?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>На производстве внедрена многоступенчатая система контроля. Мы проверяем входное сырье, контролируем геометрию первых изделий при запуске линии и проводим выборочную проверку партии в процессе производства. При необходимости предоставляем паспорт качества на партию.</p>
                        </div>
                    </div>
                </div>

                <!-- Карточка 8 -->
                <div class="faq-item faq-card" aria-expanded="false" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                    <button class="faq-question faq-card-header">
                        <span class="faq-card-title" itemprop="name">Есть ли у вас доставка?</span>
                        <div class="faq-icon-wrapper">
                            <svg class="faq-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </button>
                    <div class="faq-answer faq-card-body" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                        <div class="faq-answer-content" itemprop="text">
                            <p>Наше производство находится в Московской области. Мы отгружаем продукцию по всей России и странам СНГ через транспортные компании (Деловые Линии, ПЭК и др.) или отдельными машинами. Возможен самовывоз со склада готовой продукции.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 7. CTA AND CONTACTS -->
    <?php include get_template_directory() . '/template-parts/audit-form-section.php'; ?>
</main>

<script>
    (function() {
        'use strict';

        // Очищаем URL от параметров формы после загрузки (чтобы при обновлении не показывалось сообщение)
        if (window.location.search.includes('form=')) {
            const cleanUrl = window.location.pathname + window.location.hash;
            window.history.replaceState({}, document.title, cleanUrl);
        }
    })();

    // === FAQ TEASERS FUNCTIONALITY ===
    (function() {
        'use strict';

        // 1. Плавная прокрутка к якорю #faq
        function smoothScrollToFAQ(e) {
            const targetLink = e.currentTarget.getAttribute('href');
            if (targetLink && targetLink.includes('#faq')) {
                e.preventDefault();
                const faqSection = document.getElementById('faq');
                if (faqSection) {
                    const headerOffset = 100; // Отступ для фиксированного хедера
                    const elementPosition = faqSection.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });

                    // Отслеживание клика для аналитики
                    const teaserType = e.currentTarget.getAttribute('data-faq-teaser');
                    if (typeof gtag !== 'undefined') {
                        gtag('event', 'faq_teaser_click', {
                            'event_category': 'FAQ Teaser',
                            'event_label': teaserType,
                            'value': 1
                        });
                    }
                    if (typeof ym !== 'undefined') {
                        ym(window.yaCounterId || 0, 'reachGoal', 'faq_teaser_click', {
                            teaser_type: teaserType
                        });
                    }
                }
            }
        }

        // Применяем плавную прокрутку ко всем ссылкам на FAQ
        const faqLinks = document.querySelectorAll('a[href*="#faq"]');
        faqLinks.forEach(link => {
            link.addEventListener('click', smoothScrollToFAQ);
        });

        // 3. Кнопка "Развернуть все" для FAQ
        const expandAllBtn = document.getElementById('faq-expand-all');
        if (expandAllBtn) {
            let allExpanded = false;

            expandAllBtn.addEventListener('click', function() {
                const faqItems = document.querySelectorAll('.faq-item');
                allExpanded = !allExpanded;

                faqItems.forEach(item => {
                    item.setAttribute('aria-expanded', allExpanded ? 'true' : 'false');
                });

                // Обновляем текст кнопки
                const btnText = this.querySelector('span');
                if (btnText) {
                    btnText.textContent = allExpanded ? 'Свернуть все' : 'Развернуть все';
                }

                // Добавляем класс для анимации иконки
                this.classList.toggle('expanded', allExpanded);

                // Отслеживание для аналитики
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'faq_expand_all', {
                        'event_category': 'FAQ',
                        'event_label': allExpanded ? 'expanded' : 'collapsed',
                        'value': 1
                    });
                }
            });
        }

        // 4. Отслеживание раскрытия отдельных вопросов FAQ
        // Функция для переключения FAQ элемента
        function toggleFAQItem(faqItem, questionText) {
            if (!faqItem) return;

            const isExpanded = faqItem.getAttribute('aria-expanded') === 'true';
            faqItem.setAttribute('aria-expanded', !isExpanded ? 'true' : 'false');

            // Отслеживание для аналитики
            if (typeof gtag !== 'undefined' && !isExpanded) {
                gtag('event', 'faq_question_opened', {
                    'event_category': 'FAQ',
                    'event_label': questionText || 'Unknown',
                    'value': 1
                });
            }
            if (typeof ym !== 'undefined' && !isExpanded) {
                ym(window.yaCounterId || 0, 'reachGoal', 'faq_question_opened', {
                    question: questionText || 'Unknown'
                });
            }
        }

        // Обработчик для кнопки .faq-question / .faq-card-header (весь заголовок)
        const faqQuestions = document.querySelectorAll('.faq-question, .faq-card-header');
        faqQuestions.forEach(question => {
            // Помечаем, чтобы main.js не обрабатывал
            question.setAttribute('data-faq-handled', 'true');

            question.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const faqItem = this.closest('.faq-item');
                const questionText = this.querySelector('.faq-card-title')?.textContent ||
                    faqItem?.querySelector('.faq-card-title')?.textContent || 'Unknown';

                toggleFAQItem(faqItem, questionText);
            });
        });

        // Дополнительный обработчик для .faq-icon-wrapper (иконка)
        const faqIconWrappers = document.querySelectorAll('.faq-icon-wrapper');
        faqIconWrappers.forEach(iconWrapper => {
            iconWrapper.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const faqItem = this.closest('.faq-item');
                const questionText = faqItem?.querySelector('.faq-card-title')?.textContent || 'Unknown';

                toggleFAQItem(faqItem, questionText);
            });
        });

        // 5. Отслеживание scroll depth до FAQ
        let faqScrollTracked = false;

        function trackFAQScroll() {
            if (faqScrollTracked) return;

            const faqSection = document.getElementById('faq');
            if (!faqSection) return;

            const faqPosition = faqSection.getBoundingClientRect().top + window.pageYOffset;
            const scrollPosition = window.pageYOffset + window.innerHeight;

            if (scrollPosition >= faqPosition) {
                faqScrollTracked = true;

                if (typeof gtag !== 'undefined') {
                    gtag('event', 'faq_section_reached', {
                        'event_category': 'Scroll Depth',
                        'event_label': 'FAQ Section',
                        'value': 1
                    });
                }
                if (typeof ym !== 'undefined') {
                    ym(window.yaCounterId || 0, 'reachGoal', 'faq_section_reached');
                }
            }
        }

        window.addEventListener('scroll', trackFAQScroll);
    })();
</script>

<?php get_footer(); ?>
