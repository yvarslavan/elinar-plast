<?php
/*
Template Name: Thank You Page
*/
get_header();
?>

<!-- HERO BLOCK - Thank You Page -->
<div class="page-hero page-hero-compact page-hero-thankyou">
  <!-- Hero Background Image -->
  <picture class="hero-bg-picture">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/thank-you.webp"
      alt="Спасибо за заявку"
      class="hero-bg-img"
      width="1920"
      height="1080"
      fetchpriority="high"
      loading="eager"
      decoding="sync">
  </picture>
  <div class="hero-overlay"></div>
  <div class="container">
    <h1 class="text-white">Спасибо за <span class="text-orange">вашу заявку!</span></h1>
    <p class="lead">Мы получили ваш запрос и свяжемся с вами в ближайшее время.</p>
  </div>
</div>

<main class="section page-content">
  <div class="container">
    <div class="thank-you-content" style="text-align: center; padding: 60px 20px; max-width: 800px; margin: 0 auto;">
      <div class="thank-you-icon" style="margin-bottom: 30px;">
        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="12" cy="12" r="10" stroke="#F97316" stroke-width="2" fill="none" />
          <path d="M8 12l2.5 2.5L16 9" stroke="#F97316" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </div>

      <h2 style="color: #1E293B; font-size: 2rem; margin-bottom: 20px;">Ваша заявка принята!</h2>

      <p style="color: #64748B; font-size: 1.125rem; line-height: 1.7; margin-bottom: 30px;">
        Наш инженер свяжется с вами в течение <strong>1 рабочего дня</strong> для уточнения деталей проекта и расчёта стоимости.
      </p>

      <div class="thank-you-info" style="background: #F8FAFC; border-radius: 12px; padding: 30px; margin-bottom: 40px; text-align: left;">
        <h3 style="color: #1E293B; font-size: 1.25rem; margin-bottom: 15px;">Что будет дальше:</h3>
        <ul style="color: #64748B; line-height: 1.8; padding-left: 20px;">
          <li>Мы изучим ваш запрос и подготовим техническое предложение</li>
          <li>Свяжемся с вами для уточнения деталей</li>
          <li>Предоставим точный расчёт стоимости и сроков</li>
        </ul>
      </div>

      <div class="thank-you-contacts" style="margin-bottom: 40px;">
        <p style="color: #64748B; margin-bottom: 15px;">Если у вас срочный вопрос, позвоните нам:</p>
        <a href="tel:+74963477944" style="color: #F97316; font-size: 1.5rem; font-weight: 600; text-decoration: none;">
          +7 (496) 34-77-944
        </a>
      </div>

      <a href="<?php echo home_url('/'); ?>" class="btn btn-primary" style="display: inline-block; background: #F97316; color: white; padding: 15px 40px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: background 0.3s;">
        Вернуться на главную
      </a>
    </div>
  </div>
</main>

<?php get_footer(); ?>
