<?php
$privacy_url = get_privacy_policy_url() ?: '#';
?>

<!-- ============================================
     REDESIGNED FOOTER - TAILWIND CSS
     Строгий, технологичный, премиальный
     ============================================ -->
<footer class="footer-redesign">
    <!-- Main Footer Content -->
    <div class="footer-main-section" style="background: linear-gradient(to bottom, rgba(13, 19, 31, 0.80), rgba(13, 19, 31, 0.80)), url('<?php echo get_template_directory_uri(); ?>/assets/images/footer-bg-dark-polymer.webp'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="container">
            <!-- Main Grid - 4 Columns -->
            <div class="footer-grid-new">
                <!-- Column 1: О компании -->
                <div class="footer-column" style="gap: 1rem;">
                    <h3 class="footer-column-title">Инновационные технологии пластика</h3>

                    <div class="footer-brand-row-inner" style="display: flex; align-items: center; gap: 1.5rem;">
                        <a href="<?php echo home_url(); ?>" class="footer-brand-link" style="margin-bottom: 0; flex-shrink: 0;">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-color-200.webp"
                                alt="Логотип компании ЭЛИНАР ПЛАСТ"
                                class="footer-brand-logo"
                                loading="lazy"
                                width="160"
                                height="48"
                                style="height: 48px; width: auto;">
                        </a>

                        <div style="display: flex; align-items: center; gap: 0.75rem; padding-left: 1.5rem; border-left: 1px solid rgba(255, 255, 255, 0.1);">
                            <div style="color: #ff6b35; flex-shrink: 0;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                    <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                </svg>
                            </div>
                            <span style="color: #94a3b8; font-size: 0.75rem; line-height: 1.25; font-weight: 500; max-width: 130px;">
                                Гарантия стабильной<br>геометрии 100%
                            </span>
                        </div>
                    </div>

                    <p class="footer-column-desc" style="color: #cbd5e1; font-size: 0.875rem; line-height: 1.625; font-weight: 500; margin-bottom: 0;">
                        Собственное производство пластмассовых изделий с 2001 года.<br>
                        Экструзия, литье под давлением.<br>
                        Поставки по России и СНГ.
                    </p>

                    <!-- Address -->
                    <div class="footer-address-block">
                        <div class="footer-address-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                        </div>
                        <p class="footer-address-text">
                            143322, Московская область,<br>
                            Наро-Фоминский городской округ, село Атепцево,<br>
                            площадь Купца Алёшина, вл. №1
                        </p>
                    </div>
                    <button class="footer-btn-outline" id="footer-map-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                        </svg>
                        Как добраться
                    </button>
                </div>

                <!-- Column 2: Продукция -->
                <div class="footer-column">
                    <h3 class="footer-column-title">Продукция</h3>
                    <ul class="footer-nav-list">
                        <li><a href="#" id="pvc-modal-trigger-footer">Термовставки из ПВХ</a></li>
                        <li><a href="#" id="chamfer-modal-trigger-footer">Фаскообразователи</a></li>
                        <li><a href="#" id="profiles-modal-trigger-footer">Профили для осветительного шинопровода</a></li>
                        <li><a href="#" id="injection-modal-trigger-footer">Профили для бытовой техники</a></li>
                        <li><a href="#" id="extruded-modal-trigger-footer">Полимерные втулки</a></li>
                        <li><a href="#" id="truck-profile-modal-trigger-footer">Профили для фургонов</a></li>
                        <li><a href="<?php echo home_url('/products'); ?>">Все решения</a></li>
                    </ul>
                </div>

                <!-- Column 3: Контакты -->
                <div class="footer-column">
                    <h3 class="footer-column-title">Контакты</h3>

                    <!-- Phone -->
                    <a href="tel:+74963477944" class="footer-phone">
                        +7 (496) 34-77-944
                    </a>
                    <a href="tel:+79169785814" class="footer-phone">
                        +7 916 978 58 14
                    </a>

                    <!-- Callback Button -->
                    <button class="footer-btn-primary" id="footer-callback-btn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                        </svg>
                        Обратный звонок
                    </button>

                    <!-- Email -->
                    <div class="footer-contact-row">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" class="footer-contact-icon-new">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                        </svg>
                        <a href="mailto:plast@elinar.ru" class="footer-contact-link-new">plast@elinar.ru</a>
                    </div>

                    <!-- Working Hours -->
                    <div class="footer-contact-row">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="footer-contact-icon-new">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                        <span class="footer-contact-text">8:00 — 17:00</span>
                    </div>
                </div>

                <!-- Column 4: CTA -->
                <div class="footer-column">
                    <h3 class="footer-column-title">Запрос расчёта</h3>
                    <p class="footer-cta-desc">
                        Отправьте чертёж или ТЗ — рассчитаем стоимость в течение 24 часов
                    </p>

                    <!-- Main CTA Button -->
                    <a href="<?php echo home_url('/quote-request'); ?>" class="footer-btn-cta">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14,2 14,8 20,8" />
                            <line x1="12" y1="18" x2="12" y2="12" />
                            <line x1="9" y1="15" x2="15" y2="15" />
                        </svg>
                        Запросить расчёт
                    </a>

                    <!-- Messengers -->
                    <div class="footer-messengers-label">Быстрая связь:</div>
                    <div class="footer-messengers">
                        <a href="https://t.me/+79169785814" target="_blank" class="footer-messenger-btn footer-messenger-telegram" title="Telegram">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.361 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar (Copyright) -->
    <div class="footer-bottom-bar">
        <div class="container">
            <div class="footer-bottom-content">
                <div class="footer-bottom-left">
                    <a href="<?php echo esc_url($privacy_url); ?>" class="footer-bottom-link">Политика конфиденциальности</a>
                    <span class="footer-bottom-sep">•</span>
                    <span class="footer-bottom-text">Работаем с НДС</span>
                </div>
                <div class="footer-bottom-right">
                    <span class="footer-copyright">&copy; <?php echo date('Y'); ?> ООО «Элинар Пласт». Все права защищены.</span>
                </div>
                <div class="footer-bottom-right">
                    <span class="footer-copyright">ИНН 5030039170</span>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Product Modals (Available on all pages) -->
<!-- PVC Modal (Термовставки ПВХ) -->
<div id="pvc-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <div class="pvc-modal-header">
            <h2 class="pvc-title">Термовставки из ПВХ</h2>
            <p class="pvc-description">
                Ключевой элемент энергоэффективности фасадных систем. Мы специализируемся на производстве по индивидуальным чертежам и техническим требованиям, гарантируя микронную точность сопряжения с алюминиевыми профилями.
            </p>

            <div class="pvc-features-title">ПРЕИМУЩЕСТВА НАШИХ ТЕРМОВСТАВОК:</div>

            <div class="pvc-features-grid">
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Климатическая стойкость</div>
                    <div class="pvc-feature-desc">Стабильность при перепадах температур от -50°C до +80°C без деформации.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Долговечность 50+ лет</div>
                    <div class="pvc-feature-desc">Без деградации материала благодаря UV-защите и ударопрочному ПВХ.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Геометрическая точность</div>
                    <div class="pvc-feature-desc">Строгое соответствие допускам для идеального сопряжения.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Сложные сечения</div>
                    <div class="pvc-feature-desc">Экструзия профилей любой конфигурации по чертежам заказчика.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Лабораторный контроль</div>
                    <div class="pvc-feature-desc">Проверка каждой партии сырья и готовой продукции.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Уникальные рецептуры</div>
                    <div class="pvc-feature-desc">Разработка композиций под конкретные задачи заказчика.</div>
                </div>
            </div>
        </div>

        <div class="pvc-dark-section">
            <h3 class="pvc-dark-title">Индивидуальное производство «под задачу»</h3>
            <p class="pvc-dark-subtitle">Мы не просто производим профиль, мы сопровождаем проект на всех этапах:</p>

            <div class="pvc-steps-grid">
                <div class="pvc-step">
                    <div class="pvc-step-num">01</div>
                    <div class="pvc-step-text">Анализ чертежей и<br>инжиниринг</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">02</div>
                    <div class="pvc-step-text">Адаптация к фасадной<br>системе заказчика</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">03</div>
                    <div class="pvc-step-text">Подбор материала и<br>оптимизация геометрии</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">04</div>
                    <div class="pvc-step-text">Выпуск опытных партий и<br>серийное производство</div>
                </div>
            </div>
        </div>

        <div class="pvc-modal-footer">
            <p class="pvc-footer-text">Термовставки из ПВХ обеспечивают энергоэффективность фасадных систем, снижают теплопотери и продлевают срок службы алюминиевых конструкций.</p>

            <div class="pvc-footer-action">
                <span class="pvc-cta-text">Нужно создать новую форму или работать по вашему чертежу?</span>
                <a href="<?php echo home_url('/quote-request'); ?>" class="btn-pvc-cta">ЗАПРОСИТЬ РАСЧЕТ</a>
            </div>
        </div>
    </div>
</div>

<!-- Chamfer Modal (Фаскообразователи) -->
<div id="chamfer-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <div class="pvc-modal-header">
            <h2 class="pvc-title">Фаскообразователи</h2>
            <p class="pvc-description">
                Позволяют формировать аккуратные и устойчивые фаски на железобетонных изделиях. Материал профилей выдерживает многократные циклы заливки, не деформируется и не впитывает влагу, что снижает процент брака и обеспечивает стабильную геометрию кромок.
            </p>

            <div class="pvc-features-title">ТАКИЕ ПРОФИЛИ ПОМОГАЮТ:</div>

            <div class="pvc-features-grid">
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Улучшить внешний вид</div>
                    <div class="pvc-feature-desc">Улучшить внешний вид и качество ЖБИ за счёт чистой и точной фаски.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Защитить углы</div>
                    <div class="pvc-feature-desc">Защитить углы от сколов и повреждений в процессе эксплуатации.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Ускорить формовку</div>
                    <div class="pvc-feature-desc">Ускорить формовку изделий и сократить время обработки.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Продлить срок службы</div>
                    <div class="pvc-feature-desc">Продлить срок службы производственной оснастки.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Обеспечить качество</div>
                    <div class="pvc-feature-desc">Обеспечить предсказуемое качество при высокой интенсивности производства.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Универсальность</div>
                    <div class="pvc-feature-desc">Подходят для плит, блоков, лотков, лестничных элементов и других железобетонных конструкций, где важна долговечность и точность кромок.</div>
                </div>
            </div>
        </div>

        <div class="pvc-dark-section">
            <h3 class="pvc-dark-title">Индивидуальное производство «под задачу»</h3>
            <p class="pvc-dark-subtitle">Мы не просто производим профиль, мы сопровождаем проект на всех этапах:</p>

            <div class="pvc-steps-grid">
                <div class="pvc-step">
                    <div class="pvc-step-num">01</div>
                    <div class="pvc-step-text">Разработка совместно с<br>инженером-технологом</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">02</div>
                    <div class="pvc-step-text">Адаптация к конкретным ЖБИ<br>изделиям и формам</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">03</div>
                    <div class="pvc-step-text">Подбор материала и оптимизация<br>геометрии профиля</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">04</div>
                    <div class="pvc-step-text">Выпуск опытных партий и серийное<br>производство</div>
                </div>
            </div>
        </div>

        <div class="pvc-modal-footer">
            <p class="pvc-footer-text">Фаскообразователи обеспечивают стабильную геометрию кромок, снижают процент брака и повышают качество железобетонных изделий, что особенно важно для современных строительных проектов.</p>

            <div class="pvc-footer-action">
                <span class="pvc-cta-text">Нужно создать новую форму или работать по вашему чертежу?</span>
                <a href="<?php echo home_url('/quote-request'); ?>" class="btn-pvc-cta">ЗАПРОСИТЬ РАСЧЕТ</a>
            </div>
        </div>
    </div>
</div>

<!-- Profiles Modal (Профили для осветительного шинопровода) -->
<div id="profiles-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <div class="pvc-modal-header">
            <h2 class="pvc-title">Профили для осветительного шинопровода</h2>
            <div class="pvc-subtitle">Инженерные решения для систем современного освещения</div>
            <p class="pvc-description">
                Основной задачей осветительного шинопровода является установка в него источников света с последующим креплением их на потолки, стены и другие рабочие поверхности. Мы производим <strong>высокоточные пластиковые профили (корпуса и изоляторы)</strong>, которые обеспечивают надёжную фиксацию компонентов и электробезопасность всей осветительной системы.
            </p>

            <div class="pvc-features-title">ПРЕИМУЩЕСТВА НАШИХ ПРОФИЛЕЙ ДЛЯ ШИНОПРОВОДА:</div>

            <div class="pvc-features-grid">
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Высокие диэлектрические свойства</div>
                    <div class="pvc-feature-desc">Использование специальных полимеров гарантирует отличную электрическую изоляцию токоведущих частей.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Стабильность геометрии сечения</div>
                    <div class="pvc-feature-desc">Прецизионная точность изготовления обеспечивает легкую установку светильников и надежный контакт.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Термостойкость</div>
                    <div class="pvc-feature-desc">Материалы сохраняют свои свойства и форму при длительном нагреве от источников света.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Любая цветовая гамма</div>
                    <div class="pvc-feature-desc">Производим профили в различных цветах (черный, белый, серый и др.) для соответствия дизайну интерьера.</div>
                </div>
            </div>
        </div>

        <div class="pvc-dark-section">
            <h3 class="pvc-dark-title">Полный цикл реализации проекта</h3>
            <p class="pvc-dark-subtitle">От проектирования оснастки до серийных поставок на сборочное производство:</p>

            <div class="pvc-steps-grid">
                <div class="pvc-step">
                    <div class="pvc-step-num">01</div>
                    <div class="pvc-step-text">Согласование конструкторской<br>документации на профиль</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">02</div>
                    <div class="pvc-step-text">Проектирование и изготовление<br>высокоточной фильеры</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">03</div>
                    <div class="pvc-step-text">Испытание образцов и подбор<br>оптимального полимера</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">04</div>
                    <div class="pvc-step-text">Серийный выпуск и контроль<br>качества каждой партии</div>
                </div>
            </div>
        </div>

        <div class="pvc-modal-footer">
            <p class="pvc-footer-text">Наши профили для осветительного шинопровода сочетают в себе эстетику, функциональность и безопасность, отвечая самым современным требованиям светотехнической отрасли.</p>

            <div class="pvc-footer-action">
                <span class="pvc-cta-text">Нужно изготовить профиль для системы освещения?</span>
                <a href="<?php echo home_url('/quote-request'); ?>" class="btn-pvc-cta">ЗАПРОСИТЬ РАСЧЕТ</a>
            </div>
        </div>
    </div>
</div>

<!-- Injection Molding Modal (Профили для бытовой техники) -->
<div id="injection-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <div class="pvc-modal-header">
            <h2 class="pvc-title">Профили для бытовой техники</h2>
            <div class="pvc-subtitle">Производство сложных комплектующих для электроники</div>
            <p class="pvc-description">
                Производим пластиковые профили и детали для холодильников, плит, стиральных машин и другой бытовой техники. Обеспечиваем точное соответствие чертежам, высокую чистоту поверхности и соблюдение строгих допусков, необходимых для автоматизированной сборки на конвейерах.
            </p>

            <div class="pvc-features-title">ПРЕИМУЩЕСТВА НАШЕГО ПРОИЗВОДСТВА:</div>

            <div class="pvc-features-grid">
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Высокая точность</div>
                    <div class="pvc-feature-desc">Точное соблюдение геометрических размеров деталей с минимальными допусками благодаря современному оборудованию.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Широкий диапазон веса</div>
                    <div class="pvc-feature-desc">Изготовление профилей различного веса и площади сечения, адаптированных под требования различных отраслей промышленности.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Сложная геометрия</div>
                    <div class="pvc-feature-desc">Производство изделий с внутренними полостями, закладными элементами и другими сложными формами.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Разнообразие материалов</div>
                    <div class="pvc-feature-desc">Работа с различными видами пластиков: ПВХ, АБС, ТПЭ и другими, в зависимости от требований заказчика.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Серийное производство</div>
                    <div class="pvc-feature-desc">Оптимизированные процессы для выпуска больших партий с высокой производительностью и стабильным качеством.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Качество поверхности</div>
                    <div class="pvc-feature-desc">Отличное качество поверхности готовых изделий без дополнительной механической обработки.</div>
                </div>
            </div>
        </div>

        <div class="pvc-dark-section">
            <h3 class="pvc-dark-title">Индивидуальное производство «под задачу»</h3>
            <p class="pvc-dark-subtitle">Мы не просто производим детали, мы сопровождаем проект на всех этапах:</p>

            <div class="pvc-steps-grid">
                <div class="pvc-step">
                    <div class="pvc-step-num">01</div>
                    <div class="pvc-step-text">Анализ чертежей и выбор<br>технологии литья</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">02</div>
                    <div class="pvc-step-text">Проектирование и изготовление<br>пресс-формы</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">03</div>
                    <div class="pvc-step-text">Подбор материала и<br>настройка параметров литья</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">04</div>
                    <div class="pvc-step-text">Изготовление опытных образцов<br>и серийное производство</div>
                </div>
            </div>
        </div>

        <div class="pvc-modal-footer">
            <p class="pvc-footer-text">Литье под давлением обеспечивает высокую производительность, точность и экономичность при производстве пластиковых деталей, что особенно важно для серийного производства в различных отраслях промышленности.</p>

            <div class="pvc-footer-action">
                <span class="pvc-cta-text">Нужно создать новую форму или работать по вашему чертежу?</span>
                <a href="<?php echo home_url('/quote-request'); ?>" class="btn-pvc-cta">ЗАПРОСИТЬ РАСЧЕТ</a>
            </div>
        </div>
    </div>
</div>

<!-- Truck Profile Modal (Профили облицовочные для фургонов) -->
<div id="truck-profile-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <div class="pvc-modal-header">
            <h2 class="pvc-title">Профили облицовочные 140×55 для фургонов</h2>
            <div class="pvc-subtitle">Надежная защита каркаса грузового транспорта</div>
            <p class="pvc-description">
                Специализированные облицовочные профили размером <strong>140×55 мм с толщиной стенки 3 мм</strong>, изготовленные из прочного пластика. Идеально подходят для обвязки каркаса фургона, обеспечивая надежную защиту от механических повреждений и износа в процессе интенсивной эксплуатации. Наши профили гарантируют долговечность и прочность конструкции коммерческого транспорта.
            </p>

            <div class="pvc-features-title">ПРЕИМУЩЕСТВА НАШИХ ПРОФИЛЕЙ:</div>

            <div class="pvc-features-grid">
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Высокая прочность</div>
                    <div class="pvc-feature-desc">Толщина стенки 3 мм обеспечивает устойчивость к ударным нагрузкам и механическим воздействиям при эксплуатации фургона.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Защита от износа</div>
                    <div class="pvc-feature-desc">Предотвращают повреждения каркаса фургона, возникающие при погрузке-разгрузке и транспортировке грузов.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Оптимальные размеры</div>
                    <div class="pvc-feature-desc">Профиль 140×55 мм идеально подходит для обвязки каркаса, обеспечивая надежное крепление и защиту конструкции.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Долговечность</div>
                    <div class="pvc-feature-desc">Устойчивость к атмосферным воздействиям, перепадам температур и влажности гарантирует длительный срок службы.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Простота монтажа</div>
                    <div class="pvc-feature-desc">Удобная геометрия профиля обеспечивает быструю и надежную установку на каркас фургона.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Стабильность формы</div>
                    <div class="pvc-feature-desc">Профиль сохраняет геометрию при эксплуатации, не деформируется под нагрузкой и воздействием температур.</div>
                </div>
            </div>
        </div>

        <div class="pvc-dark-section">
            <h3 class="pvc-dark-title">Применение в коммерческом транспорте</h3>
            <p class="pvc-dark-subtitle">Наши профили используются для:</p>

            <div class="pvc-steps-grid">
                <div class="pvc-step">
                    <div class="pvc-step-num">01</div>
                    <div class="pvc-step-text">Обвязка каркаса<br>фургонов</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">02</div>
                    <div class="pvc-step-text">Защита кромок и<br>углов конструкции</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">03</div>
                    <div class="pvc-step-text">Усиление несущих<br>элементов</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">04</div>
                    <div class="pvc-step-text">Декоративная отделка<br>и финишная облицовка</div>
                </div>
            </div>
        </div>

        <div class="pvc-modal-footer">
            <p class="pvc-footer-text">Профили облицовочные 140×55 мм — это надежное решение для производителей и ремонтников коммерческого транспорта, которое обеспечивает прочность конструкции фургонов и продлевает срок их эксплуатации.</p>

            <div class="pvc-footer-action">
                <span class="pvc-cta-text">Нужна консультация или расчет стоимости партии?</span>
                <a href="<?php echo home_url('/quote-request'); ?>" class="btn-pvc-cta">ЗАПРОСИТЬ РАСЧЕТ</a>
            </div>
        </div>
    </div>
</div>

<!-- Extruded Products Modal (Полимерные втулки) -->
<div id="extruded-modal" class="modal">
    <div class="modal-content">
        <span class="modal-close">&times;</span>

        <div class="pvc-modal-header">
            <h2 class="pvc-title">Полимерные втулки</h2>
            <div class="pvc-subtitle">Шпули для профессиональной намотки рулонных материалов</div>
            <p class="pvc-description">
                Производим полимерные втулки (шпули) для намотки <strong>изоляционной ленты, медицинского пластыря, различных видов пленок</strong> и других рулонных материалов. Наши изделия отличаются высокой прочностью, идеальной цилиндрической формой и отсутствием заусенцев, что критически важно для качественной намотки.
            </p>

            <div class="pvc-features-title">ПРЕИМУЩЕСТВА НАШИХ ВТУЛОК:</div>

            <div class="pvc-features-grid">
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Универсальность применения</div>
                    <div class="pvc-feature-desc">Идеально подходят для промышленной намотки лент, пластырей, технических и пищевых пленок различных форматов.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Точная геометрия</div>
                    <div class="pvc-feature-desc">Соблюдение допусков по внутреннему и внешнему диаметру обеспечивает совместимость с намоточным оборудованием.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Вариативность исполнения</div>
                    <div class="pvc-feature-desc">Материал, длина и цвет изделия подбираются индивидуально по требованию заказчика под конкретную задачу.</div>
                </div>
                <div class="pvc-feature-card">
                    <div class="pvc-feature-title">Стабильность качества</div>
                    <div class="pvc-feature-desc">Использование первичных полимеров гарантирует отсутствие деформаций и стабильность физико-механических свойств.</div>
                </div>
            </div>
        </div>

        <div class="pvc-dark-section">
            <h3 class="pvc-dark-title">Индивидуальное производство «под задачу»</h3>
            <p class="pvc-dark-subtitle">Мы не просто производим профиль, мы сопровождаем проект на всех этапах:</p>

            <div class="pvc-steps-grid">
                <div class="pvc-step">
                    <div class="pvc-step-num">01</div>
                    <div class="pvc-step-text">Анализ требований и подбор<br>материала</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">02</div>
                    <div class="pvc-step-text">Проектирование и изготовление<br>экструзионной оснастки</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">03</div>
                    <div class="pvc-step-text">Настройка процесса экструзии<br>и оптимизация параметров</div>
                </div>
                <div class="pvc-step">
                    <div class="pvc-step-num">04</div>
                    <div class="pvc-step-text">Контроль качества и серийное<br>производство</div>
                </div>
            </div>
        </div>

        <div class="pvc-modal-footer">
            <p class="pvc-footer-text">Наши погонажные изделия обеспечивают надежность, долговечность и отличные эксплуатационные характеристики, что особенно важно для технических применений в различных отраслях промышленности.</p>

            <div class="pvc-footer-action">
                <span class="pvc-cta-text">Нужно создать новую форму или работать по вашему чертежу?</span>
                <a href="<?php echo home_url('/quote-request'); ?>" class="btn-pvc-cta">ЗАПРОСИТЬ РАСЧЕТ</a>
            </div>
        </div>
    </div>
</div>

<!-- Image Lightbox Modal -->
<div id="image-lightbox" class="lightbox-modal">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightbox-img">
    <div id="lightbox-caption"></div>
</div>

<!-- Floating Action Button - Glassmorphism Style -->
<div class="fab-container">
    <div class="fab-menu">
        <a href="https://t.me/+79169785814" target="_blank" class="fab-item-new fab-telegram" title="Telegram">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.361 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
            </svg>
        </a>
    </div>
    <div class="fab-trigger" id="fab-trigger" aria-label="Открыть меню связи">
        <svg width="26" height="26" viewBox="0 0 24 24" fill="none">
            <path d="M20 2H4C2.9 2 2 2.9 2 4V22L6 18H20C21.1 18 22 17.1 22 16V4C22 2.9 21.1 2 20 2ZM20 16H6L4 18V4H20V16Z" fill="currentColor" />
        </svg>
    </div>
</div>

<!-- Scroll To Top Button - Minimal Circle -->
<button id="scroll-top" class="scroll-top-btn" aria-label="Вернуться наверх">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 15l-6-6-6 6" />
    </svg>
</button>

<!-- Call Back Modal (Заказать звонок) -->
<div id="call-back-modal" class="callback-modal">
    <div class="callback-modal-overlay"></div>
    <div class="callback-modal-content">
        <button class="callback-modal-close" aria-label="Закрыть">&times;</button>
        <div class="callback-modal-inner">
            <h2 class="callback-modal-title">Оставьте заявку<br><span class="callback-title-light">И мы скоро с вами свяжемся!</span></h2>
            <div class="callback-contacts">
                <div class="callback-contact-group">
                    <p class="callback-contact-label">Вы можете позвонить нам по телефонам:</p>
                    <a href="tel:+74963477944" class="callback-contact-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="currentColor" />
                        </svg>
                        <span>+7 (496) 34-77-944</span>
                    </a>
                    <a href="tel:+79169785814" class="callback-contact-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="currentColor" />
                        </svg>
                        <span>+7 916 978 58 14</span>
                    </a>
                </div>
                <div class="callback-contact-group">
                    <p class="callback-contact-label">Или написать на E-mail:</p>
                    <a href="mailto:plast@elinar.ru" class="callback-contact-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor" />
                        </svg>
                        <span>plast@elinar.ru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Yandex Map Modal (Как добраться) -->
<div id="yandex-map-modal" class="yandex-map-modal">
    <div class="yandex-map-modal-overlay"></div>
    <div class="yandex-map-modal-content">
        <button class="yandex-map-modal-close" aria-label="Закрыть">&times;</button>
        <div class="yandex-map-modal-inner">
            <h2 class="yandex-map-modal-title">Как добраться</h2>
            <div class="yandex-map-address">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0; margin-right: 8px;">
                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="#666" />
                </svg>
                <span>143322, Московская область, Наро-Фоминский городской округ, село Атепцево, площадь Купца Алёшина, вл. №1</span>
            </div>
            <div id="yandex-map" style="width: 100%; height: 500px; border-radius: 8px; overflow: hidden;"></div>
        </div>
    </div>
</div>

<!-- Cookie Banner - Friendly Minimalism Design -->
<div id="cookie-banner" class="cookie-banner" role="dialog" aria-label="Уведомление о cookies" aria-live="polite">
    <div class="cookie-banner-content">
        <!-- Cookie Icon -->
        <div class="cookie-icon">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10" />
                <circle cx="8" cy="10" r="1" fill="currentColor" />
                <circle cx="16" cy="10" r="1" fill="currentColor" />
                <circle cx="12" cy="15" r="1" fill="currentColor" />
                <circle cx="9" cy="13" r="0.5" fill="currentColor" />
                <circle cx="15" cy="13" r="0.5" fill="currentColor" />
            </svg>
        </div>

        <div class="cookie-banner-main">
            <div class="cookie-banner-text">
                <h3 class="cookie-banner-title">Мы используем cookies</h3>
                <p>Мы используем файлы cookie и инструменты аналитики для улучшения работы сайта, сбора статистики и персонализации предложений.</p>
                <div class="cookie-banner-links">
                    <a href="<?php echo esc_url(get_privacy_policy_url() ?: '#'); ?>" class="cookie-banner-link">Политика конфиденциальности</a>
                </div>
            </div>

            <div class="cookie-banner-actions">
                <button id="cookie-accept-all" class="cookie-banner-btn cookie-banner-btn--primary" type="button">Принять</button>
                <button id="cookie-settings" class="cookie-banner-btn cookie-banner-btn--outline" type="button">Настроить</button>
                <button id="cookie-decline" class="cookie-banner-btn cookie-banner-btn--secondary" type="button">Отклонить</button>
            </div>
        </div>
    </div>

    <div class="cookie-banner-settings" hidden>
        <div class="cookie-settings-row">
            <div class="cookie-settings-item">
                <div class="cookie-settings-label">Обязательные cookie</div>
                <div class="cookie-settings-note">Всегда включены</div>
            </div>
            <input type="checkbox" checked disabled aria-label="Обязательные cookie (всегда включены)">
        </div>

        <div class="cookie-settings-row">
            <label class="cookie-settings-item" for="cookie-analytics">
                <div class="cookie-settings-label">Аналитика</div>
                <div class="cookie-settings-note">Yandex.Metrica</div>
            </label>
            <input id="cookie-analytics" type="checkbox" checked>
        </div>

        <div class="cookie-settings-row">
            <label class="cookie-settings-item" for="cookie-personalization">
                <div class="cookie-settings-label">Персонализация</div>
                <div class="cookie-settings-note">Рекомендации и предложения</div>
            </label>
            <input id="cookie-personalization" type="checkbox" checked>
        </div>

        <div class="cookie-settings-actions">
            <button id="cookie-save-settings" class="cookie-banner-btn cookie-banner-btn--primary" type="button">Сохранить</button>
            <button id="cookie-cancel-settings" class="cookie-banner-btn cookie-banner-btn--outline" type="button">Отмена</button>
        </div>
    </div>
</div>

<!-- HTML VERSION: 2.0.1 (<?php echo date('Y-m-d H:i:s'); ?>) -->
<?php wp_footer(); ?>
</body>

</html>
