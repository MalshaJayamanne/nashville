<?php

defined('ABSPATH') or die('Access Denied!');

define('THEME_SITE_URL', home_url());
define('THEME_THEMEROOT', get_stylesheet_directory_uri());
define('THEME_THEMEROOT_PATH', get_template_directory());

define('THEME_INCLUDES', get_stylesheet_directory() . '/includes/');
define('THEME_PLUGIN_ACTIVATION_PLUGINS', get_stylesheet_directory() . '/includes/admin/plugins/');

define('THEME_IMAGES', THEME_THEMEROOT . '/assets/images/');
define('THEME_JS', THEME_THEMEROOT . '/assets/js/');
define('THEME_CSS', THEME_THEMEROOT . '/assets/css/');

require_once(THEME_THEMEROOT_PATH . '/vendor/autoload.php');

$includes = [
	'acf',
	'mail-sendgrid',
	'front-head-cleanup',
	'front-enqueue',
	'front-compile-assets',
	'theme-support',
	'plugins-register',
	'admin-enqueue',
	'admin-login-logo',
	'admin-favicon',
    'admin-editor-menus',
	'app-pulse',
	// 'nginx-cache',
];

foreach ($includes as $file) {
	require_once(THEME_INCLUDES . '/theme-functions/' . $file . '.php');
}
unset($file, $filepath);

require_once(THEME_INCLUDES . '/front/index.php');