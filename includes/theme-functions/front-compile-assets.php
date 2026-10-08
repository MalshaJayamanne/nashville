<?php

/**
 * Compile Less CSS To CSS.
 */
function compile_less_to_css()
{

    $parser = new Less_Parser();
    $parser->parseFile(
        THEME_THEMEROOT_PATH . '/assets/css/less/master.less',
        THEME_THEMEROOT_PATH . '/assets/css/less/' // relative path for imports
    );
    $css = $parser->getCss();
    file_put_contents(
        THEME_THEMEROOT_PATH . '/assets/css/master.css',
        $css
    );
}

use MatthiasMullie\Minify;

/**
 * Minify CSS.
 */
function minify_css_func()
{

    $minifier = new Minify\CSS(get_theme_file_path('assets/css/bootstrap.min.css'));

    $minifier->add(get_theme_file_path('assets/css/fontawesome.all.min.css'));

    $minifier->add(get_theme_file_path('assets/swiper/swiper-bundle.min.css'));

    $minifier->add(get_theme_file_path('assets/mmenu/mmenu.css'));

    $minifier->add(get_theme_file_path('assets/css/master.css'));

    // save minified file to disk
    $minifier->minify(get_theme_file_path('assets/css/master.min.css'));
}

/**
 * Minify Javascript.
 */
function minify_js_func()
{

    $minifier = new Minify\JS(get_theme_file_path('assets/js/bootstrap.bundle.min.js'));

    $minifier->add(get_theme_file_path('assets/swiper/swiper-bundle.min.js'));

    $minifier->add(get_theme_file_path('assets/mmenu/mmenu.js'));

    $minifier->add(get_theme_file_path('assets/js/custom.js'));

    // save minified file to disk
    $minifier->minify(get_theme_file_path('assets/js/custom.min.js'));
}

if (function_exists('get_field')) {
    define("COMPILE_ASSETS", (get_field('compile_assets', 'option')) ?? FALSE);

    if (COMPILE_ASSETS) {
        update_theme_cache_version();

        add_action('init', 'compile_less_to_css');
        add_action('init', 'minify_css_func');
        add_action('init', 'minify_js_func');
    }
}

/**
 * Update theme cache version.
 */
function update_theme_cache_version($version = null)
{
	if ($version === null) {
		$version = time();
	}

	update_option('custom_theme_cache_version', $version);
}

add_action('admin_bar_menu', function($admin_bar) {
    if (current_user_can('manage_options')) {
        $admin_bar->add_menu([
            'id'    => 'compile-assets',
            'title' => 'Compile Assets',
            'href'  => wp_nonce_url(admin_url('admin-post.php?action=compile_assets'), 'compile_assets_nonce'),
            'meta'  => ['title' => 'Compile and minify theme assets']
        ]);
    }
}, 100);

add_action('admin_post_compile_assets', function() {
    // Verify nonce
    if (!current_user_can('manage_options') || !isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'compile_assets_nonce')) {
        wp_die('Unauthorized action');
    }

    // Run asset compilation/minification
    if (function_exists('compile_less_to_css')) {
        compile_less_to_css();
    }
    if (function_exists('minify_css_func')) {
        minify_css_func();
    }
    if (function_exists('minify_js_func')) {
        minify_js_func();
    }
    update_theme_cache_version();

    // Redirect back with a success notice
    $redirect = (wp_get_referer()) ? wp_get_referer() : admin_url();
    $redirect = add_query_arg('compile_assets_done', 1, $redirect);
    wp_safe_redirect($redirect);
    exit;
});

// Optionally, show an admin notice after asset compilation
add_action('admin_notices', function() {
    if (isset($_GET['compile_assets_done'])) {
        echo '<div class="notice notice-success is-dismissible"><p>Theme assets successfully recompiled.</p></div>';
    }
});
