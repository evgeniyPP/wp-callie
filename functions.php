<?php

include_once(__DIR__ . '/widgets/callie-recent-posts.php');

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
});
