<?php

/**
 * Template Part: Quote Request Form
 * Форма запроса коммерческого предложения
 */
?>

<div class="quote-form-wrapper" id="quote-form-wrapper">
    <!-- Progress Bar -->
    <div class="quote-progress">
        <div class="quote-progress-bar" id="quote-progress-bar"></div>
        <div class="quote-progress-steps">
            <div class="quote-progress-step active" data-step="0">
                <span class="step-number">1</span>
                <span class="step-label">Технология</span>
            </div>
            <div class="quote-progress-step" data-step="1">
                <span class="step-number">2</span>
                <span class="step-label">Проект</span>
            </div>
            <div class="quote-progress-step" data-step="2">
                <span class="step-number">3</span>
                <span class="step-label">Параметры</span>
            </div>
            <div class="quote-progress-step" data-step="3">
                <span class="step-number">4</span>
                <span class="step-label">Производство</span>
            </div>
            <div class="quote-progress-step" data-step="4">
                <span class="step-number">5</span>
                <span class="step-label">Файлы</span>
            </div>
            <div class="quote-progress-step" data-step="5">
                <span class="step-number">6</span>
                <span class="step-label">Контакты</span>
            </div>
        </div>
    </div>

    <form class="quote-form" id="quote-form" method="post" enctype="multipart/form-data">
        <!-- Honeypot field for spam protection -->
        <input type="text" name="website_url" class="quote-honeypot" tabindex="-1" autocomplete="off">

        <!-- БЛОК 0: Выбор технологии производства -->
        <div class="quote-step active" data-step="0">
            <div class="quote-step-header">
                <h3>Выберите технологию производства</h3>
                <p class="quote-step-desc">Это поможет нам подготовить наиболее точное предложение</p>
            </div>

            <div class="quote-tech-cards">
                <label class="quote-tech-card" data-tech="extrusion">
                    <input type="radio" name="technology" value="extrusion" required>
                    <div class="quote-tech-card-inner">
                        <div class="quote-tech-icon">
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="8" y="24" width="48" height="16" rx="2" stroke="currentColor" stroke-width="2" />
                                <path d="M8 32H0M64 32H56" stroke="currentColor" stroke-width="2" />
                                <rect x="20" y="20" width="8" height="24" rx="1" stroke="currentColor" stroke-width="2" />
                                <rect x="36" y="20" width="8" height="24" rx="1" stroke="currentColor" stroke-width="2" />
                                <path d="M56 28L64 24V40L56 36" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                        <h4>Экструзия</h4>
                        <p>Профили, трубки, погонажные изделия</p>
                        <ul class="quote-tech-features">
                            <li>Термовставки из ПВХ</li>
                            <li>Фаскообразователи</li>
                            <li>Уплотнители</li>
                        </ul>
                    </div>
                </label>

                <label class="quote-tech-card" data-tech="injection">
                    <input type="radio" name="technology" value="injection" required>
                    <div class="quote-tech-card-inner">
                        <div class="quote-tech-icon">
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="16" y="16" width="32" height="32" rx="4" stroke="currentColor" stroke-width="2" />
                                <rect x="24" y="24" width="16" height="16" rx="2" stroke="currentColor" stroke-width="2" />
                                <path d="M32 8V16M32 48V56M8 32H16M48 32H56" stroke="currentColor" stroke-width="2" />
                                <circle cx="32" cy="32" r="4" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                        <h4>Литье под давлением</h4>
                        <p>Детали, корпуса, комплектующие</p>
                        <ul class="quote-tech-features">
                            <li>Технические детали</li>
                            <li>Корпусные элементы</li>
                            <li>Крепежные изделия</li>
                        </ul>
                    </div>
                </label>

                <label class="quote-tech-card" data-tech="consultation">
                    <input type="radio" name="technology" value="consultation" required>
                    <div class="quote-tech-card-inner">
                        <div class="quote-tech-icon">
                            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="32" cy="32" r="24" stroke="currentColor" stroke-width="2" />
                                <path d="M32 20V32L40 40" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <circle cx="32" cy="44" r="2" fill="currentColor" />
                            </svg>
                        </div>
                        <h4>Требуется консультация</h4>
                        <p>Не уверены в выборе технологии</p>
                        <ul class="quote-tech-features">
                            <li>Поможем определить</li>
                            <li>Подберем оптимальное решение</li>
                            <li>Бесплатная консультация</li>
                        </ul>
                    </div>
                </label>
            </div>
        </div>

        <!-- БЛОК 1: Информация о проекте -->
        <div class="quote-step" data-step="1">
            <div class="quote-step-header">
                <h3>Информация о проекте</h3>
                <p class="quote-step-desc">Расскажите о вашем изделии</p>
            </div>

            <div class="quote-form-grid">
                <div class="quote-form-group full-width">
                    <label for="project_name">Название изделия или проекта <span class="required">*</span></label>
                    <input type="text" id="project_name" name="project_name" required
                        placeholder="Например: Уплотнительный профиль для фасадной системы"
                        minlength="5" maxlength="150">
                    <span class="quote-field-hint">От 5 до 150 символов</span>
                </div>

                <!-- Поля для экструзии -->
                <div class="quote-form-group tech-field extrusion-field">
                    <label for="product_type_extrusion">Тип изделия <span class="required">*</span></label>
                    <select id="product_type_extrusion" name="product_type_extrusion">
                        <option value="">Выберите тип</option>
                        <option value="profile_solid">Профиль сплошной</option>
                        <option value="profile_hollow">Профиль полый</option>
                        <option value="profile_multichamber">Профиль многокамерный</option>
                        <option value="tube">Трубка</option>
                        <option value="sheet">Лист / полоса</option>
                        <option value="special">Специальное изделие</option>
                    </select>
                </div>

                <!-- Поля для литья -->
                <div class="quote-form-group tech-field injection-field">
                    <label for="product_type_injection">Тип изделия <span class="required">*</span></label>
                    <select id="product_type_injection" name="product_type_injection">
                        <option value="">Выберите тип</option>
                        <option value="technical">Техническая деталь</option>
                        <option value="housing">Корпусной элемент</option>
                        <option value="fastener">Крепежный элемент</option>
                        <option value="decorative">Декоративный элемент</option>
                        <option value="other">Другое</option>
                    </select>
                </div>

                <div class="quote-form-group">
                    <label for="project_stage">Стадия проекта <span class="required">*</span></label>
                    <select id="project_stage" name="project_stage" required>
                        <option value="">Выберите стадию</option>
                        <option value="sample">Есть готовый образец изделия</option>
                        <option value="drawing">Есть чертеж / 3D-модель</option>
                        <option value="sketch">Есть эскиз / набросок</option>
                        <option value="description">Только техническое описание</option>
                        <option value="from_scratch">Требуется разработка с нуля</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- БЛОК 2: Технические параметры -->
        <div class="quote-step" data-step="2">
            <div class="quote-step-header">
                <h3>Технические параметры</h3>
                <p class="quote-step-desc">Укажите характеристики изделия</p>
            </div>

            <div class="quote-form-grid">
                <div class="quote-form-group">
                    <label for="material">Материал изделия <span class="required">*</span></label>
                    <select id="material" name="material" required>
                        <option value="">Выберите материал</option>
                        <option value="pvc_rigid">ПВХ жесткий (PVC-U)</option>
                        <option value="pvc_flex">ПВХ пластифицированный (PVC-P)</option>
                        <option value="pp">Полипропилен (PP)</option>
                        <option value="pe">Полиэтилен (PE)</option>
                        <option value="abs">АБС-пластик (ABS)</option>
                        <option value="pc">Поликарбонат (PC)</option>
                        <option value="pa">Полиамид (PA)</option>
                        <option value="composite">Композитные материалы</option>
                        <option value="undefined">Не определен / требуется подбор</option>
                        <option value="other">Другой материал</option>
                    </select>
                </div>

                <div class="quote-form-group" id="material_other_group" style="display: none;">
                    <label for="material_other">Укажите материал</label>
                    <input type="text" id="material_other" name="material_other" placeholder="Название материала">
                </div>

                <div class="quote-form-group">
                    <label>Цвет изделия</label>
                    <div class="quote-radio-group">
                        <label class="quote-radio">
                            <input type="radio" name="color_type" value="natural" checked>
                            <span>Натуральный (цвет материала)</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="color_type" value="colored">
                            <span>Окраска в массе</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="color_type" value="no_requirements">
                            <span>Без требований</span>
                        </label>
                    </div>
                </div>

                <div class="quote-form-group" id="color_value_group" style="display: none;">
                    <label for="color_value">Укажите цвет (RAL или описание)</label>
                    <input type="text" id="color_value" name="color_value" placeholder="Например: RAL 7035 или Светло-серый">
                </div>

                <!-- Габариты для экструзии -->
                <div class="quote-form-group tech-field extrusion-field">
                    <label>Ориентировочные габариты</label>
                    <div class="quote-dimensions-grid">
                        <div class="quote-dimension">
                            <input type="number" name="width_diameter" placeholder="Ширина/диаметр" min="0" step="0.1">
                            <span class="unit">мм</span>
                        </div>
                        <div class="quote-dimension">
                            <input type="number" name="height_extrusion" placeholder="Высота" min="0" step="0.1">
                            <span class="unit">мм</span>
                        </div>
                        <div class="quote-dimension">
                            <input type="number" name="wall_thickness" placeholder="Толщина стенки" min="0" step="0.1">
                            <span class="unit">мм</span>
                        </div>
                    </div>
                </div>

                <!-- Габариты для литья -->
                <div class="quote-form-group tech-field injection-field">
                    <label>Ориентировочные габариты</label>
                    <div class="quote-dimensions-grid four-cols">
                        <div class="quote-dimension">
                            <input type="number" name="length_injection" placeholder="Длина" min="0" step="0.1">
                            <span class="unit">мм</span>
                        </div>
                        <div class="quote-dimension">
                            <input type="number" name="width_injection" placeholder="Ширина" min="0" step="0.1">
                            <span class="unit">мм</span>
                        </div>
                        <div class="quote-dimension">
                            <input type="number" name="height_injection" placeholder="Высота" min="0" step="0.1">
                            <span class="unit">мм</span>
                        </div>
                        <div class="quote-dimension">
                            <input type="number" name="weight_injection" placeholder="Масса" min="0" step="0.1">
                            <span class="unit">г</span>
                        </div>
                    </div>
                </div>

                <div class="quote-form-group full-width">
                    <label for="special_requirements">Особые требования к изделию</label>
                    <textarea id="special_requirements" name="special_requirements" rows="4"
                        placeholder="Укажите требования к механическим свойствам, температурному режиму эксплуатации, стойкости к УФ, химической стойкости, твердости, пластичности и др."></textarea>
                    <div class="quote-field-examples">
                        <span>Примеры:</span>
                        <button type="button" class="quote-example-btn" data-example="Эксплуатация при температуре от -40°C до +80°C">Температура -40...+80°C</button>
                        <button type="button" class="quote-example-btn" data-example="Стойкость к УФ-излучению">УФ-стойкость</button>
                        <button type="button" class="quote-example-btn" data-example="Контакт с пищевыми продуктами">Пищевой контакт</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- БЛОК 3: Производственные параметры -->
        <div class="quote-step" data-step="3">
            <div class="quote-step-header">
                <h3>Производственные параметры</h3>
                <p class="quote-step-desc">Объемы и сроки производства</p>
            </div>

            <div class="quote-form-grid">
                <div class="quote-form-group">
                    <label>Планируемый объем производства <span class="required">*</span></label>
                    <div class="quote-radio-group">
                        <label class="quote-radio">
                            <input type="radio" name="production_volume" value="single" required>
                            <span>Разовая партия</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="production_volume" value="serial" required>
                            <span>Серийное производство</span>
                        </label>
                    </div>
                </div>

                <div class="quote-form-group" id="volume_monthly_group" style="display: none;">
                    <label for="volume_monthly">Объем в месяц</label>
                    <div class="quote-input-with-hint">
                        <input type="number" id="volume_monthly" name="volume_monthly" placeholder="Количество" min="1">
                        <select name="volume_unit" id="volume_unit">
                            <option value="pcs">шт.</option>
                            <option value="pm">п.м.</option>
                        </select>
                    </div>
                    <span class="quote-field-hint">Для профилей - в погонных метрах, для деталей - в штуках</span>
                </div>

                <div class="quote-form-group">
                    <label for="production_start">Срок начала производства</label>
                    <select id="production_start" name="production_start">
                        <option value="">Выберите срок</option>
                        <option value="1_month">В течение 1 месяца</option>
                        <option value="2_3_months">В течение 2-3 месяцев</option>
                        <option value="3_6_months">В течение 3-6 месяцев</option>
                        <option value="more_6_months">Более 6 месяцев</option>
                        <option value="later">Уточню позже</option>
                    </select>
                </div>

                <div class="quote-form-group">
                    <label for="target_price">Целевая стоимость изделия</label>
                    <div class="quote-input-with-suffix">
                        <input type="number" id="target_price" name="target_price" placeholder="Стоимость" min="0" step="0.01">
                        <span class="suffix">руб. за ед. (с НДС)</span>
                    </div>
                    <span class="quote-field-hint">Если у вас есть целевой бюджет на единицу изделия</span>
                </div>
            </div>
        </div>

        <!-- БЛОК 4: Техническая документация -->
        <div class="quote-step" data-step="4">
            <div class="quote-step-header">
                <h3>Техническая документация</h3>
                <p class="quote-step-desc">Приложите чертежи, модели или эскизы</p>
            </div>

            <div class="quote-form-grid">
                <div class="quote-form-group full-width">
                    <label>Загрузка файлов</label>
                    <div class="quote-file-upload" id="quote-file-upload">
                        <div class="quote-file-dropzone" id="quote-file-dropzone">
                            <div class="quote-file-dropzone-icon">
                                <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M32 8L32 40M32 8L20 20M32 8L44 20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8 40V52C8 54.2091 9.79086 56 12 56H52C54.2091 56 56 54.2091 56 52V40" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                            <p class="quote-file-dropzone-text">Перетащите файлы сюда или <span class="quote-file-browse">выберите файлы</span></p>
                            <p class="quote-file-dropzone-hint">Форматы: JPG, PNG, PDF, DWG, DXF, STEP, STP, IGES, STL<br>Максимум 5 файлов, до 10 МБ каждый</p>
                            <input type="file" id="quote-files" name="files[]" multiple accept=".jpg,.jpeg,.png,.pdf,.dwg,.dxf,.step,.stp,.iges,.igs,.stl" class="quote-file-input">
                        </div>
                        <div class="quote-file-list" id="quote-file-list"></div>
                    </div>
                </div>

                <!-- Наличие оснастки для литья -->
                <div class="quote-form-group full-width tech-field injection-field">
                    <label>Наличие оснастки (пресс-формы)</label>
                    <div class="quote-radio-group vertical">
                        <label class="quote-radio">
                            <input type="radio" name="tooling_status" value="ready">
                            <span>Есть пресс-форма (готова к работе)</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="tooling_status" value="needs_revision">
                            <span>Есть пресс-форма (требуется ревизия)</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="tooling_status" value="need_new">
                            <span>Нет оснастки (готовы инвестировать в изготовление)</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="tooling_status" value="need_consultation">
                            <span>Требуется консультация</span>
                        </label>
                    </div>
                </div>

                <div class="quote-form-group full-width">
                    <label for="additional_requirements">Дополнительные требования</label>
                    <textarea id="additional_requirements" name="additional_requirements" rows="3"
                        placeholder="Упаковка, маркировка, сопутствующие услуги (сборка, логистика и т.д.)"></textarea>
                </div>
            </div>
        </div>

        <!-- БЛОК 5: Контактная информация -->
        <div class="quote-step" data-step="5">
            <div class="quote-step-header">
                <h3>Контактная информация</h3>
                <p class="quote-step-desc">Как с вами связаться</p>
            </div>

            <div class="quote-form-grid">
                <div class="quote-form-group">
                    <label for="company">Компания <span class="required">*</span></label>
                    <input type="text" id="company" name="company" required placeholder="Название компании" minlength="2" maxlength="200">
                </div>

                <div class="quote-form-group">
                    <label for="contact_person">Контактное лицо <span class="required">*</span></label>
                    <input type="text" id="contact_person" name="contact_person" required placeholder="ФИО" minlength="2" maxlength="100">
                </div>

                <div class="quote-form-group">
                    <label for="position">Должность</label>
                    <input type="text" id="position" name="position" placeholder="Например: Инженер-конструктор">
                </div>

                <div class="quote-form-group">
                    <label for="phone">Телефон <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" required placeholder="+7 (___) ___-__-__"
                        pattern="\+?[0-9\s\-\(\)]{10,20}">
                </div>

                <div class="quote-form-group">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required placeholder="email@company.ru">
                </div>

                <div class="quote-form-group">
                    <label>Предпочтительный способ связи</label>
                    <div class="quote-radio-group horizontal">
                        <label class="quote-radio">
                            <input type="radio" name="contact_method" value="phone" checked>
                            <span>Телефон</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="contact_method" value="email">
                            <span>Email</span>
                        </label>
                        <label class="quote-radio">
                            <input type="radio" name="contact_method" value="telegram">
                            <span>Telegram</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Согласие и отправка -->
            <div class="quote-form-footer">
                <div class="quote-consent">
                    <label class="quote-checkbox">
                        <input type="checkbox" name="consent" required>
                        <span>Я согласен на обработку персональных данных в соответствии с <a href="<?php echo esc_url(get_privacy_policy_url() ?: '#'); ?>" target="_blank">Политикой конфиденциальности</a></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Навигация между шагами -->
        <div class="quote-navigation">
            <button type="button" class="quote-btn quote-btn-prev" id="quote-prev" style="display: none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 18L9 12L15 6" />
                </svg>
                Назад
            </button>
            <button type="button" class="quote-btn quote-btn-next" id="quote-next">
                Далее
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 6L15 12L9 18" />
                </svg>
            </button>
            <button type="submit" class="quote-btn quote-btn-submit" id="quote-submit" style="display: none;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 2L11 13M22 2L15 22L11 13M11 13L2 9L22 2" />
                </svg>
                Отправить запрос на расчет
            </button>
        </div>

        <!-- Индикатор автосохранения -->
        <div class="quote-autosave" id="quote-autosave">
            <span class="quote-autosave-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                    <polyline points="17,21 17,13 7,13 7,21" />
                    <polyline points="7,3 7,8 15,8" />
                </svg>
            </span>
            <span class="quote-autosave-text">Данные сохранены</span>
        </div>

        <?php wp_nonce_field('elinar_quote_form_nonce', 'quote_nonce'); ?>
    </form>

    <!-- Сообщение об успешной отправке -->
    <div class="quote-success" id="quote-success" style="display: none;">
        <div class="quote-success-icon">
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="32" cy="32" r="28" stroke="currentColor" stroke-width="2" />
                <path d="M20 32L28 40L44 24" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h3>Спасибо! Ваш запрос отправлен</h3>
        <p>После отправки запроса наш инженер свяжется с вами в течение 1 рабочего дня для уточнения деталей и подготовки коммерческого предложения.</p>
        <div class="quote-success-actions">
            <a href="<?php echo home_url(); ?>" class="quote-btn quote-btn-secondary">На главную</a>
            <button type="button" class="quote-btn quote-btn-primary" id="quote-new">Создать новый запрос</button>
        </div>
    </div>

    <!-- Индикатор загрузки -->
    <div class="quote-loading" id="quote-loading" style="display: none;">
        <div class="quote-loading-spinner"></div>
        <p>Отправка запроса...</p>
    </div>
</div>
