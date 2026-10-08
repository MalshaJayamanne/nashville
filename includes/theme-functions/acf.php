<?php

/**
 * Display ACF notice when not active.
 */
function display_acf_error_notice()
{
	if (!function_exists('is_plugin_active')) {
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	}

	if (!is_admin() && !is_plugin_active('advanced-custom-fields-pro/acf.php')) {
		wp_die('Please install and activate Advanced Custom Fields plugin before proceeding.');
	}
}
add_action('template_redirect', 'display_acf_error_notice');

/**
 * Set ACF Local JSON Cache

 * @param mixed $path
 * @see https://www.advancedcustomfields.com/resources/local-json/
 */
function my_acf_json_save_point($path)
{
	$path = THEME_INCLUDES . 'acf-json';

	return $path;
}
add_filter('acf/settings/save_json', 'my_acf_json_save_point');

/**
 * Get from Local JSON Cache
 * 
 * @param mixed $paths
 * @see https://www.advancedcustomfields.com/resources/local-json/
 */
function my_acf_json_load_point($paths)
{
	// Remove original path (optional)
	unset($paths[0]);

	$paths[] = THEME_INCLUDES . 'acf-json';

	return $paths;
}
add_filter('acf/settings/load_json', 'my_acf_json_load_point');


/**
 * ACF Add Options Page
 *
 * @see https://www.advancedcustomfields.com/resources/options-page/
 */
if (function_exists('acf_add_options_page')) {
	$parentConfig = [
		'page_title' => 'Theme General Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false,
	];

	$childConfig = [
		'page_title'  => __('Theme Configuration Settings'),
		'menu_title'  => __('Configuration Settings'),
		'parent_slug' => $parentConfig['menu_slug'],
	];

	acf_add_options_page($parentConfig);
	// acf_add_options_page($childConfig);
}
