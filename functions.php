<?php

include_once(__DIR__ . '/widgets/callie-recent-posts.php');
include_once(__DIR__ . '/widgets/callie-social-media.php');

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

    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('Callie_Widget_Recent_Posts');

    register_widget('Callie_Widget_Social_Media');
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

    $layout = '';

    $reviews = callie_get_reviews($atts['cnt']);

    foreach ($reviews as $review) {

        $layout .=
            "<blockquote class=\"blockquote\">
                <p>{$review->post_content}</p>
                <footer class=\"blockquote-footer\">{$review->post_title}</footer>
             </blockquote>";
    }

    return $layout;
});

add_shortcode('callie_single_review', function ($atts) {
    $review = get_post($atts['id']);

    return
        "<blockquote class=\"blockquote\">
            <p>{$review->post_content}</p>
            <footer class=\"blockquote-footer\">{$review->post_title}</footer>
        </blockquote>";
});
