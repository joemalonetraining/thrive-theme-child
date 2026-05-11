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

add_action('wp_enqueue_scripts', function () {
    $support_page_templates = [
        'page-calendar.php',
        'page-memberships.php',
        'page-pistol.php',
        'page-rifle.php',
        'page-rifle-pistol.php',
        'page-blog.php',
        'page-about-us.php',
        'page-16-hour-illinois-ccl.php',
        'page-3-hour-renewal.php',
    ];

    $support_page_slugs = [
        'calendar',
        'memberships',
        'pistol',
        'rifle',
        'rifle-pistol',
        'blog',
        'about-us',
        '16-hour-illinois-ccl',
        '3-hour-renewal',
    ];

    if (! is_page_template($support_page_templates) && ! is_page($support_page_slugs)) {
        return;
    }

    wp_enqueue_style(
        'jm-support-pages',
        get_stylesheet_directory_uri() . '/assets/css/support-pages.css',
        ['child-style'],
        filemtime(get_stylesheet_directory() . '/assets/css/support-pages.css')
    );
}, 100);
