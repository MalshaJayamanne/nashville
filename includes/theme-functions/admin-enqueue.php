<?php

/**
 * Enqueue admin scripts.
 *
 * @see https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts
 */
function theme_admin_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('admin-js', THEME_JS . 'admin.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'theme_admin_scripts');
