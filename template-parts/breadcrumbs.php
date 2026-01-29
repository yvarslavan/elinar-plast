<?php

/**
 * Breadcrumbs Component with Schema.org markup
 *
 * @package Elinar_Plast
 */

// Не показываем на главной странице
if (is_front_page()) {
    return;
}

// Собираем данные для breadcrumbs
$breadcrumbs = array();
$home_url = home_url('/');
$home_title = 'Главная';

// Всегда добавляем главную
$breadcrumbs[] = array(
    'url' => $home_url,
    'title' => $home_title,
    'is_home' => true
);

// Определяем текущую страницу и строим цепочку
if (is_category()) {
    $category = get_queried_object();
    $breadcrumbs[] = array(
        'url' => '',
        'title' => $category->name,
        'is_current' => true
    );
} elseif (is_single()) {
    $categories = get_the_category();
    if (!empty($categories)) {
        $category = $categories[0];
        $breadcrumbs[] = array(
            'url' => get_category_link($category->term_id),
            'title' => $category->name
        );
    }
    $breadcrumbs[] = array(
        'url' => '',
        'title' => get_the_title(),
        'is_current' => true
    );
} elseif (is_page()) {
    $post = get_post();
    $current_slug = $post->post_name;

    // Маппинг страниц к родительским пунктам меню
    // Только для страниц, которые являются подпунктами меню
    $menu_mapping = array(
        // 'products' убран, так как это страница верхнего уровня
    );

    // Добавляем родительский пункт меню, если он определён
    if (isset($menu_mapping[$current_slug])) {
        $breadcrumbs[] = array(
            'url' => $menu_mapping[$current_slug]['url'],
            'title' => $menu_mapping[$current_slug]['title']
        );
    }

    // Для страниц с родителями в иерархии WordPress
    if ($post->post_parent) {
        $parent_id = $post->post_parent;
        $parents = array();
        while ($parent_id) {
            $page = get_post($parent_id);
            $parents[] = array(
                'url' => get_permalink($page->ID),
                'title' => get_the_title($page->ID)
            );
            $parent_id = $page->post_parent;
        }
        $breadcrumbs = array_merge($breadcrumbs, array_reverse($parents));
    }

    $breadcrumbs[] = array(
        'url' => '',
        'title' => get_the_title(),
        'is_current' => true
    );
} elseif (is_archive()) {
    $breadcrumbs[] = array(
        'url' => '',
        'title' => get_the_archive_title(),
        'is_current' => true
    );
} elseif (is_search()) {
    $breadcrumbs[] = array(
        'url' => '',
        'title' => 'Результаты поиска: ' . get_search_query(),
        'is_current' => true
    );
} elseif (is_404()) {
    $breadcrumbs[] = array(
        'url' => '',
        'title' => 'Страница не найдена',
        'is_current' => true
    );
}

// Если нет элементов кроме главной, не показываем breadcrumbs
if (count($breadcrumbs) <= 1) {
    return;
}

// Формируем Schema.org разметку
$schema_items = array();
foreach ($breadcrumbs as $index => $crumb) {
    $schema_items[] = array(
        '@type' => 'ListItem',
        'position' => $index + 1,
        'name' => $crumb['title'],
        'item' => !empty($crumb['url']) ? $crumb['url'] : null
    );
}

$schema = array(
    '@context' => 'https://schema.org',
    '@type' => 'BreadcrumbList',
    'itemListElement' => $schema_items
);
?>

<!-- Schema.org JSON-LD -->
<script type="application/ld+json">
    <?php echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE); ?>
</script>

<!-- Breadcrumbs HTML -->
<nav class="breadcrumbs" aria-label="Навигационная цепочка">
    <ol class="breadcrumbs-list">
        <?php foreach ($breadcrumbs as $index => $crumb): ?>
            <li class="breadcrumbs-item <?php echo !empty($crumb['is_current']) ? 'is-current' : ''; ?>">
                <?php if (!empty($crumb['is_home'])): ?>
                    <!-- Иконка домика для главной -->
                    <?php if (empty($crumb['is_current'])): ?>
                        <a href="<?php echo esc_url($crumb['url']); ?>" class="breadcrumbs-link breadcrumbs-home" title="<?php echo esc_attr($crumb['title']); ?>">
                            <svg class="breadcrumbs-home-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="sr-only"><?php echo esc_html($crumb['title']); ?></span>
                        </a>
                    <?php else: ?>
                        <span class="breadcrumbs-text breadcrumbs-home">
                            <svg class="breadcrumbs-home-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                            <span class="sr-only"><?php echo esc_html($crumb['title']); ?></span>
                        </span>
                    <?php endif; ?>
                <?php else: ?>
                    <!-- Обычные элементы -->
                    <?php if (empty($crumb['is_current']) && !empty($crumb['url']) && $crumb['url'] !== '#'): ?>
                        <a href="<?php echo esc_url($crumb['url']); ?>" class="breadcrumbs-link">
                            <?php echo esc_html($crumb['title']); ?>
                        </a>
                    <?php else: ?>
                        <span class="breadcrumbs-text">
                            <?php echo esc_html($crumb['title']); ?>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if ($index < count($breadcrumbs) - 1): ?>
                    <span class="breadcrumbs-separator" aria-hidden="true">›</span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ol>
</nav>
