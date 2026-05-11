<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );

    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        ['parent-style'],
        wp_get_theme()->get('Version')
    );
});

add_action('wp_enqueue_scripts', function () {
    if (! is_page_template('page-landing-test.php')) {
        return;
    }

    wp_enqueue_style(
        'jm-landing-test',
        get_stylesheet_directory_uri() . '/assets/css/landing-test.css',
        ['child-style'],
        filemtime(get_stylesheet_directory() . '/assets/css/landing-test.css')
    );

    wp_enqueue_script(
        'jm-landing-test',
        get_stylesheet_directory_uri() . '/assets/js/landing-test.js',
        [],
        filemtime(get_stylesheet_directory() . '/assets/js/landing-test.js'),
        true
    );
}, 99);
