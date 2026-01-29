<?php

/**
 * Template Part: Audit Form Section
 * Секция с формой "Получите экспертный аудит вашего изделия"
 *
 * Используется на страницах: Products, Technologies, About, Contacts
 */

// Получаем статус формы из GET параметров (для PRG паттерна)
$form_status = isset($_GET['form']) ? sanitize_text_field($_GET['form']) : '';
$form_field = isset($_GET['field']) ? sanitize_text_field($_GET['field']) : '';

$form_message = '';
$form_success = false;

if ($form_status === 'success') {
    $form_success = true;
    $form_message = 'Спасибо! Ваша заявка принята, инженер свяжется с вами в ближайшее время.';
} elseif ($form_status === 'error') {
    switch ($form_field) {
        case 'name':
            $form_message = 'Пожалуйста, введите ваше имя.';
            break;
        case 'phone':
            $form_message = 'Пожалуйста, введите корректный номер телефона.';
            break;
        case 'email':
            $form_message = 'Пожалуйста, введите корректный email.';
            break;
        case 'file_type':
            $form_message = 'Недопустимый формат файла.';
            break;
        case 'file_size':
            $form_message = 'Файл слишком большой. Максимум 15 МБ.';
            break;
        case 'mail':
            $form_message = 'Ошибка отправки. Позвоните нам: +7 (496) 34-77-944';
            break;
        default:
            $form_message = 'Произошла ошибка. Попробуйте снова.';
    }
}
?>

<!-- AUDIT FORM SECTION -->
<section id="contact-form" class="audit-section">
    <div class="audit-container">
        <div class="audit-grid">

            <!-- LEFT COLUMN: Value Proposition -->
            <div class="audit-content">
                <div class="audit-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5z" />
                        <path d="M2 17l10 5 10-5" />
                        <path d="M2 12l10 5 10-5" />
                    </svg>
                    <span>Технический аудит и расчет проекта</span>
                </div>

                <h2 class="expertise-title" style="color: #ffffff !important;">
                    ОБЕСПЕЧИМ ТЕХНИЧЕСКУЮ <span class="highlight">ЭКСПЕРТИЗУ</span> ЧЕРТЕЖА И РАСЧЕТ В КРАТЧАЙШИЕ СРОКИ
                </h2>

                <h3 class="benefits-heading" style="color: #ffffff !important;">Что вы получите на консультации:</h3>
                <div class="audit-benefits">

                    <div class="benefit-item">
                        <div class="benefit-icon benefit-icon--blue">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                <polyline points="14,2 14,8 20,8" />
                                <path d="M9 15l2 2 4-4" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <strong style="color: #ffffff !important;">Техническая экспертиза</strong>
                            <p>Проверим геометрию изделия на технологичность и соответствие стандартам экструзии/литья.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon benefit-icon--green">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M12 6v6l4 2" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <strong style="color: #ffffff !important;">Профессиональный подбор полимера</strong>
                            <p>Определим оптимальный материал (ПВХ, ПЭ, ТЭП и др.) под ваши условия эксплуатации.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon benefit-icon--orange">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="3" x2="7" y2="21" />
                                <path d="M7 3h6a4 4 0 0 1 0 8H7" />
                                <line x1="5" y1="15" x2="13" y2="15" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <strong style="color: #ffffff !important;">Оптимизация себестоимости</strong>
                            <p>Подскажем, как упростить конструкцию для снижения цены без потери качества.</p>
                        </div>
                    </div>

                    <div class="benefit-item">
                        <div class="benefit-icon benefit-icon--purple">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <path d="M3 9h18M9 21V9" />
                            </svg>
                        </div>
                        <div class="benefit-text">
                            <strong style="color: #ffffff !important;">Приоритетное КП</strong>
                            <p>Детальная смета с учетом стоимости оснастки, логистики и сроков запуска.</p>
                        </div>
                    </div>
                </div> <!-- /audit-benefits -->

                <!-- NEW: Alternative CTA for detailed quote -->
                <div class="audit-alternative-cta">
                    <div class="alternative-content">
                        <p class="alternative-phrase">Нужен максимально точный расчет под тендер или ТЗ?</p>
                        <a href="<?php echo home_url('/quote-request/'); ?>" class="audit-detailed-btn">
                            <span>ЗАПОЛНИТЬ ДЕТАЛЬНУЮ ЗАЯВКУ</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div> <!-- /audit-content -->

            <!-- RIGHT COLUMN: Form Card -->
            <div class="audit-form-wrapper">
                <div class="audit-form-card">
                    <h3 class="form-card-title">Запросить инженерную оценку</h3>
                    <p class="form-card-subtitle">Наш технолог свяжется с вами для уточнения технических деталей и подготовки предложения.</p>

                    <?php if (!empty($form_message)): ?>
                        <div class="form-message <?php echo $form_success ? 'success' : 'error'; ?>" id="form-result-message">
                            <?php echo esc_html($form_message); ?>
                            <span class="close-message" onclick="this.parentElement.style.display='none'">✕</span>
                        </div>
                    <?php endif; ?>

                    <form class="audit-form" id="project-form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="project_form_submit" value="1">
                        <?php wp_nonce_field('elinar_project_form', 'project_form_nonce'); ?>
                        <!-- Honeypot антиспам -->
                        <div style="position: absolute; left: -9999px;" aria-hidden="true">
                            <input type="text" name="website_url" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="audit-form-row">
                            <div class="audit-form-group">
                                <input type="text" name="name" id="form-name" class="audit-input" placeholder="Ваше имя *" required>
                                <span class="form-error" id="name-error"></span>
                            </div>

                            <div class="audit-form-group">
                                <input type="tel" name="phone" id="form-phone" class="audit-input" placeholder="Телефон *" required>
                                <span class="form-error" id="phone-error"></span>
                            </div>
                        </div>

                        <div class="audit-form-group">
                            <input type="email" name="email" id="form-email" class="audit-input" placeholder="E-mail *" required>
                            <span class="form-error" id="email-error"></span>
                        </div>

                        <div class="audit-form-group">
                            <textarea name="message" id="form-message" class="audit-textarea" placeholder="Опишите ваш проект" rows="3"></textarea>
                        </div>

                        <div class="audit-form-group">
                            <!-- Cloud Upload Drop Zone -->
                            <div class="cloud-upload-zone" id="cloud-upload-zone">
                                <input type="file" name="attachment[]" id="form-file" accept=".pdf,.dwg,.dxf,.step,.stp,.jpg,.jpeg,.png,.zip,.iges,.igs,.stl" multiple style="display: none;">

                                <div class="upload-zone-content">
                                    <!-- Cloud Icon -->
                                    <svg class="upload-icon" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <path d="M7 18a4.6 4.4 0 0 1 0 -9a5 4.5 0 0 1 11 2h1a3.5 3.5 0 0 1 0 7h-1" />
                                        <polyline points="9 15 12 12 15 15" />
                                        <line x1="12" y1="12" x2="12" y2="21" />
                                    </svg>

                                    <div class="upload-text">
                                        <p class="upload-title">Прикрепить чертеж</p>
                                        <p class="upload-subtitle">DWG, PDF, STEP, IGES, STL</p>
                                    </div>

                                    <button type="button" class="upload-browse-btn" id="upload-browse-btn">
                                        Выбрать файлы
                                    </button>

                                    <p class="upload-hint">или перетащите файлы сюда</p>
                                </div>
                            </div>

                            <!-- Files List -->
                            <div class="upload-files-list" id="upload-files-list"></div>

                            <span class="form-error" id="file-error"></span>
                        </div>

                        <div class="audit-form-agreement" style="margin-bottom: 0.5rem; display: flex; align-items: flex-start; gap: 0.5rem;">
                            <input type="checkbox" name="privacy_agreement" id="privacy_agreement" required style="margin-top: 3px;">
                            <label for="privacy_agreement" style="font-size: 13px; color: #666; line-height: 1.4; cursor: pointer;">
                                Я даю согласие на <a href="<?php echo home_url('/privacy-policy/'); ?>" target="_blank" style="text-decoration: underline; color: inherit;">обработку персональных данных</a>
                            </label>
                        </div>

                        <button type="submit" class="audit-submit-btn cta-button" id="submit-btn">
                            <span>ОТПРАВИТЬ НА ЭКСПЕРТИЗУ</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>
