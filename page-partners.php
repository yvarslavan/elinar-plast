<?php
/*
Template Name: Partners Page
*/
get_header();
?>

<!-- HERO BLOCK - Optimized for LCP -->
<div class="page-hero page-hero-fullheight">
    <!-- Hero Background Image - LCP optimized -->
    <picture class="hero-bg-picture">
        <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-mobile.webp" type="image/webp">
        <source media="(max-width: 1024px)" srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-tablet.webp" type="image/webp">
        <source srcset="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg-desktop.webp" type="image/webp">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.webp" 
             alt="Партнеры Элинар Пласт" 
             class="hero-bg-img"
             width="1920" 
             height="1080"
             fetchpriority="high"
             loading="eager"
             decoding="async">
    </picture>
    <div class="hero-overlay"></div>
    <div class="container">
        <h1 class="text-white" style="font-size: 2.5rem; margin-bottom: 1.5rem; font-weight: 600;">Партнеры</h1>
        <p class="lead" style="font-size: 1.35rem; color: #ffffff; line-height: 1.6; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); max-width: 800px;">
            <?php
            if (have_posts()) {
                while (have_posts()) : the_post();
                    if (get_the_content()) {
                        the_excerpt();
                    } else {
                        echo 'Наши надежные партнеры и долгосрочное сотрудничество в сфере производства пластмассовых изделий.';
                    }
                endwhile;
            } else {
                echo 'Наши надежные партнеры и долгосрочное сотрудничество в сфере производства пластмассовых изделий.';
            }
            ?>
        </p>
    </div>
</div>

<main class="section page-content">
    <div class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) : the_post();
                if (get_the_content() && !empty(trim(strip_tags(get_the_content())))) {
                    // Если есть контент, показываем его
                    echo '<div class="entry-content">';
                    the_content();
                    echo '</div>';
                } else {
                    // Заглушка, если контента нет
                    echo '<div class="entry-content">';
                    echo '<p>Контент страницы будет добавлен позже.</p>';
                    echo '</div>';
                }
            endwhile;
        }
        ?>
    </div>
</main>

<?php get_footer(); ?>

