<?php

include_once(__DIR__ . '/widgets/callie-recent-posts.php');
include_once(__DIR__ . '/widgets/callie-social-media.php');
include_once(__DIR__ . '/widgets/callie-newsletter-form.php');
include_once(__DIR__ . '/widgets/callie-categories.php');

add_filter('show_admin_bar', '__return_false');

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'callie-bootstrap-style',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css'
    );
    wp_enqueue_style(
        'callie-font-awesome-style',
        get_template_directory_uri() . '/assets/css/font-awesome.min.css'
    );
    wp_enqueue_style('callie-main-style', get_stylesheet_uri());

    wp_enqueue_script(
        'callie-jquery-script',
        get_template_directory_uri() . '/assets/js/jquery.min.js',
        [],
        null,
        true
    );
    wp_enqueue_script(
        'callie-bootstrap-script',
        get_template_directory_uri() . '/assets/js/bootstrap.min.js',
        ['callie-jquery-script'],
        null,
        true
    );
    wp_enqueue_script(
        'callie-jquery-stellar-script',
        get_template_directory_uri() . '/assets/js/jquery.stellar.min.js',
        ['callie-jquery-script', 'callie-bootstrap-script'],
        null,
        true
    );
    wp_enqueue_script(
        'callie-main-script',
        get_template_directory_uri() . '/assets/js/main.js',
        ['callie-jquery-script', 'callie-bootstrap-script', 'callie-jquery-stellar-script'],
        null,
        true
    );
});

add_action('after_setup_theme', function () {
    register_nav_menu('top', 'Верхнее меню');
    register_nav_menu('aside', 'Выдвижное меню');
    register_nav_menu('bottom', 'Меню в подвале');
    register_nav_menu('landing', 'Меню для лендинг-страницы');

    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
});

add_action('widgets_init', function () {
    register_sidebar([
        'name' => 'Правый сайдбар',
        'id' => 'sidebar-right',
        'description' => 'Сайдбар в правой колонке',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => "</div>\n"
    ]);

    register_sidebar([
        'name' => 'Сайдбар в подвале',
        'id' => 'sidebar-bottom',
        'description' => 'Сайдбар в подвале',
        'before_widget' => '<div class="widget col-md-3 %2$s">',
        'after_widget' => "</div>\n",
        'class' => ''
    ]);

    register_sidebar([
        'name' => 'Сайдбар в Вакансиях (сбоку)',
        'id' => 'sidebar-jobs-aside',
        'description' => 'Сайдбар в Вакансиях сбоку',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => "</div>\n"
    ]);

    register_sidebar([
        'name' => 'Сайдбар в Вакансиях (подвал)',
        'id' => 'sidebar-jobs-bottom',
        'description' => 'Сайдбар в Вакансиях в подвале',
        'before_widget' => '<div class="widget col-md-3 %2$s">',
        'after_widget' => "</div>\n",
        'class' => ''
    ]);

    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Categories');

    register_widget('Callie_Widget_Recent_Posts');
    register_widget('Callie_Widget_Social_Media');
    register_widget('Callie_Widget_Newsletter_Form');
    register_widget('Callie_Widget_Categories');
});


add_action('init', function () {
    register_post_type('reviews', [
        'labels' => array(
            'name'               => 'Отзывы',
            'singular_name'      => 'Отзыв',
            'add_new'            => 'Добавить новый',
            'add_new_item'       => 'Добавление отзыва',
            'edit_item'          => 'Редактирование отзыва',
            'new_item'           => 'Новый отзыв',
            'view_item'          => 'Смотреть отзыв',
            'search_items'       => 'Искать отзыв',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Отзывы',
        ),
        'description'         => '',
        'public'              => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-format-quote',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor'],
        // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
    ]);

    register_post_type('jobs', [
        'labels' => array(
            'name'               => 'Вакансии',
            'singular_name'      => 'Вакансия',
            'add_new'            => 'Добавить новую',
            'add_new_item'       => 'Добавление вакансии',
            'edit_item'          => 'Редактирование вакансии',
            'new_item'           => 'Новая вакансия',
            'view_item'          => 'Смотреть вакансию',
            'search_items'       => 'Искать вакансию',
            'not_found'          => 'Не найдено',
            'not_found_in_trash' => 'Не найдено в корзине',
            'parent_item_colon'  => '',
            'menu_name'          => 'Вакансии',
        ),
        'description'         => '',
        'public'              => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-hammer',
        'hierarchical'        => false,
        'supports'            => ['title', 'editor', 'thumbnail'],
        'has_archive'         => true
    ]);

    register_taxonomy('city', ['jobs'], [
        'labels'                => [
            'name'              => 'Города',
            'singular_name'     => 'Город',
            'search_items'      => 'Найти город',
            'all_items'         => 'Все города',
            'view_item '        => 'Посмотреть город',
            'edit_item'         => 'Редактировать город',
            'update_item'       => 'Обновить город',
            'add_new_item'      => 'Добавление города',
            'new_item_name'     => 'Добавить новый',
            'menu_name'         => 'Города',
        ],
        'description'           => '',
        'public'                => true,
        'hierarchical'          => false
    ]);
});

function callie_get_reviews($cnt = -1)
{
    return get_posts([
        'numberposts' => $cnt,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'reviews'
    ]);
}

add_shortcode('callie_reviews', function ($atts) {
    $atts = shortcode_atts([
        'cnt' => 5
    ], $atts);

    $layout = [];

    $reviews = callie_get_reviews($atts['cnt'] ?? null);

    foreach ($reviews as $review) {
        ob_start();
        include get_template_directory() . '/views/review.php';
        $layout[] = ob_get_clean();
    }

    return implode('', $layout);
});

add_shortcode('callie_single_review', function ($atts) {
    $review = get_post($atts['id']);

    ob_start();
    include get_template_directory() . '/views/review.php';
    return ob_get_clean();
});

add_shortcode('callie_contactme_form', function () {
    ob_start();
    include get_template_directory() . '/views/contactme-form.php';
    return ob_get_clean();
});


add_image_size('jobs-thumb', 440, 85, true);
