<?php
/*
Template Name: Contacts Page
*/
get_header();
?>

<!-- HERO BLOCK - Optimized for LCP -->
<div class="page-hero page-hero-compact page-hero-contacts">
    <!-- Hero Background Image - LCP optimized (Contacts specific) -->
    <picture class="hero-bg-picture">
        <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about_mobile.webp" type="image/webp">
        <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about_tablet.webp" type="image/webp">
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about.webp" type="image/webp">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg_about.webp"
            alt="Контакты Элинар Пласт"
            class="hero-bg-img"
            width="1920"
            height="1080"
            fetchpriority="high"
            loading="eager"
            decoding="sync">
    </picture>
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="text-white">Всегда рады вашему <span class="text-orange">звонку</span>, <span class="text-orange">письму</span> или <span class="text-orange">встрече</span> в офисе</h1>
    </div>
</div>

<main class="section page-content">
    <div class="container contacts-section">
        <div class="contacts-grid">
            <!-- Левая колонка: Контактная информация -->
            <div class="contacts-info">
                <h2 class="contacts-title">Наш офис и производство</h2>

                <ul class="contacts-list">
                    <li class="contact-item contact-main-phone">
                        <a href="tel:+74963477944" class="contact-link">
                            <div class="icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="contact-icon">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="currentColor" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <span class="value">+7 (496) 34-77-944</span>
                            </div>
                        </a>
                    </li>
                    <li class="contact-item">
                        <a href="tel:+79169785814" class="contact-link">
                            <div class="icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="contact-icon">
                                    <path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z" fill="currentColor"/>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <span class="value">+7 916 978 58 14</span>
                            </div>
                        </a>
                    </li>
                    <li class="contact-item">
                        <a href="mailto:plast@elinar.ru" class="contact-link contact-email">
                            <div class="icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="contact-icon">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <span class="value">plast@elinar.ru</span>
                            </div>
                        </a>
                    </li>
                    <li class="contact-item">
                        <div class="contact-link contact-address">
                            <div class="icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="contact-icon">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <span class="value">143322, Московская область, Наро-Фоминский городской округ, село Атепцево, площадь Купца Алёшина, вл.№1</span>
                            </div>
                        </div>
                    </li>
                    <li class="contact-item">
                        <div class="contact-link contact-hours">
                            <div class="icon-wrapper">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="contact-icon">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                                    <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <span class="value">Пн-Пт: 8:00 — 17:00</span>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="messengers-block">
                    <p class="messengers-hint">Для быстрых вопросов</p>
                    <a href="https://t.me/+79169785814" target="_blank" class="btn btn-telegram" title="Написать в Telegram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.361 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                        </svg>
                        <span>Telegram</span>
                    </a>
                </div>
            </div>

            <!-- Правая колонка: Форма обратной связи -->
            <div class="contacts-form-wrapper">
                <div class="contacts-form-card">
                    <h2 class="contacts-form-title">Обратная связь, замечания и предложения</h2>
                    <form class="simple-form contacts-form" action="#" method="post">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Имя (необязательно)">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Ваш E-mail">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Контактный номер телефона *" required>
                        </div>
                        <div class="form-group">
                            <textarea name="question" placeholder="Ваш вопрос *" rows="3" required></textarea>
                        </div>
                        <div class="form-buttons">
                            <button type="submit" class="btn btn-accent full-width">ОТПРАВИТЬ</button>
                        </div>
                        <div class="form-consent">
                            <label>
                                <input type="checkbox" name="consent" required>
                                <span>Нажимая на кнопку «Отправить», я даю согласие на обработку своих <a href="#" style="color: inherit; text-decoration: underline;">персональных данных</a>.</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
