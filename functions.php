<?php
if (! function_exists('jm_training_primary_landing_url')) {
    function jm_training_primary_landing_url()
    {
        static $landing_url = null;

        if ($landing_url !== null) {
            return $landing_url;
        }

        $landing_template = 'page-landing-test.php';
        $front_page_id = (int) get_option('page_on_front');

        if ($front_page_id > 0 && get_page_template_slug($front_page_id) === $landing_template) {
            $front_page_url = get_permalink($front_page_id);

            if ($front_page_url) {
                $landing_url = $front_page_url;
                return $landing_url;
            }
        }

        $landing_pages = get_pages([
            'meta_key' => '_wp_page_template',
            'meta_value' => $landing_template,
            'number' => 1,
            'post_status' => 'publish',
            'sort_column' => 'menu_order,post_title',
        ]);

        if (! empty($landing_pages)) {
            $template_page_url = get_permalink($landing_pages[0]->ID);

            if ($template_page_url) {
                $landing_url = $template_page_url;
                return $landing_url;
            }
        }

        $landing_url = '#top';
        return $landing_url;
    }
}

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
