<?php get_header(); ?>

<main class="section single-post">
    <div class="container">
        <?php while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta text-muted">
                        <?php echo get_the_date(); ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $tags_list = get_the_tag_list('', ', ');
                    if ($tags_list) {
                        printf('<div class="tags-links">Теги: %1$s</div>', $tags_list);
                    }
                    ?>
                </footer>
            </article>

            <div class="post-navigation">
                <?php the_post_navigation(); ?>
            </div>

        <?php endwhile; ?>
    </div>
</main>

<?php get_footer(); ?>
