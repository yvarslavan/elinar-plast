<?php get_header(); ?>

<main class="section page-content">
    <div class="container">
        <div class="page-header">
            <h1><?php the_title(); ?></h1>
        </div>

        <div class="entry-content">
            <?php
            while (have_posts()) : the_post();
                the_content();
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>
