<?php

/**
 * Enqueue scripts.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
 */
function theme_front_scripts()
{
    wp_enqueue_script('jquery');

    $version = get_theme_cache_version();

    // Swiper CSS and JS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.2.10'
    );

    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.2.10',
        true
    );

    // Fancybox
    if (!is_page_template('page-home.php') && !is_page_template('page-contact.php')) {
        wp_enqueue_script(
            'fancybox',
            'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
            array(),
            '5.0',
            true
        );
    }

    // Theme JavaScript
    wp_enqueue_script(
        'custom-js',
        THEME_JS . 'custom.js',
        array('jquery', 'swiper-js'),
        file_exists(get_template_directory() . '/assets/js/custom.js')
            ? filemtime(get_template_directory() . '/assets/js/custom.js')
            : $version,
        true
    );

    $customParams = array(
        'ADMIN_AJAX_URL' => admin_url('admin-ajax.php'),
        'SOCIAL_MEDIA'   => get_social_links(),
        'STICKY_HEADER'  => get_theme_option('enable_sticky_header', 'option')
    );

    wp_localize_script(
        'custom-js',
        'THEME_PARAMS',
        $customParams
    );

    wp_dequeue_script('comment-reply');
    wp_dequeue_script('wp-embed');
}

add_action('wp_enqueue_scripts', 'theme_front_scripts');


/**
 * Enqueue styles.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
 */
function theme_front_styles()
{
    global $wp_styles;

    /*
     * Google Fonts
     */
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&family=Marcellus&display=swap',
        array(),
        null
    );

    /*
     * Fancybox
     */
    if (!is_page_template('page-home.php') && !is_page_template('page-contact.php')) {

        wp_enqueue_style(
            'fancybox',
            'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css',
            array(),
            '5.0',
            'screen'
        );
    }

    /*
     * Compiled LESS/CSS (loads first)
     */
    $version = get_theme_cache_version();

    wp_enqueue_style(
        'master-styles',
        THEME_CSS . 'master.min.css',
        array('google-fonts'),
        $version,
        'screen'
    );

    /*
     * Theme stylesheet (loads last so it wins over master.min.css)
     */
    $style_path    = get_template_directory() . '/style.css';
    $style_version = file_exists($style_path) ? filemtime($style_path) : '1.0';

    wp_enqueue_style(
        'theme-styles',
        THEME_THEMEROOT . '/style.css',
        array('google-fonts', 'master-styles'),
        $style_version,
        'screen'
    );

    /*
     * Remove unnecessary WordPress styles
     */
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style');
}

add_action('wp_print_styles', 'theme_front_styles');


/**
 * Get the theme cache version.
 */
function get_theme_cache_version()
{
    return get_option('custom_theme_cache_version', '1.0.0');
}