<?php

/**
 * Register cache purge button in admin bar.
 *
 * @param WP_Admin_Bar $wp_admin_bar
 * @return void
 */
function nginx_cache_manager_admin_bar_purge($wp_admin_bar)
{
	if (!is_admin()) return;

	$wp_admin_bar->add_node([
		'id' => 'nginx-cache-manager-button',
		'title' => 'Purge Cache',
		'href' => admin_url('admin-ajax.php'),
		'meta' => ['class' => 'nginx-cache-manager-button'],
	]);
}

add_action('admin_bar_menu', 'nginx_cache_manager_admin_bar_purge', 999);

/**
 * Handle cache purge AJAX Request.
 *
 * @return void
 */
function nginx_cache_manager_purge_ajax_action()
{
	$cache_purged = nginx_purge_cache();

	if ($cache_purged) {
		echo json_encode(['status' => true]);
	} else {
		echo json_encode(['status' => false]);
	}

	wp_die();
}

add_action('wp_ajax_nginx_cache_manager_purge_ajax_action',  'nginx_cache_manager_purge_ajax_action');

/**
 * Purge Nginx Fast CGI process manager cache.
 *
 * @return bool
 */
function nginx_purge_cache()
{
	$response = wp_remote_get(get_site_url(path: 'purge'), ['timeout' => 15]);

	if (wp_remote_retrieve_response_code($response) !== 200) {
		return false;
	}

	return true;
}
