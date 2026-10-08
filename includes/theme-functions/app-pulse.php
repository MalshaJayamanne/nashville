<?php

/**
 * Registers REST API endpoint.
 */
function register_custom_endpoint()
{
	register_rest_route('api/v1', '/pulse', [
		'methods'  => 'GET',
		'permission_callback' => 'pulse_rest_api_permission',
		'callback' => 'pulse_rest_api_response',
	]);
}

add_action('rest_api_init', 'register_custom_endpoint');

/**
 * Callback function to verify the bearer token for authentication.
 *
 * @param WP_REST_Request $request The REST API request object.
 * @return bool|WP_Error Whether the request is authenticated or not.
 */
function pulse_rest_api_permission($request)
{
	$token = $request->get_header('Authorization');

	if (!$token || strpos($token, 'Bearer ') !== 0) {
		return new WP_Error('rest_forbidden', __('Authorization header is missing or invalid.', 'text-domain'), array('status' => 401));
	}

	$token = substr($token, 7);  // remove 'Bearer ' prefix

	if (validate_hash(get_site_url(), $token)) {
		return new WP_Error('rest_forbidden', __('Invalid token.', 'text-domain'), array('status' => 401));
	}

	return true;
}

/**
 * Callback function to retrieve information about activated plugins.
 *
 * @param WP_REST_Request $request The REST API request object.
 *
 * @return WP_REST_Response The REST API response object.
 */
function pulse_rest_api_response($request)
{
	return rest_ensure_response([
		'dependencies' => get_activated_plugins_info(),
		'last_backup' => get_last_backup_info()
	]);
}

/**
 * Validate hash.
 *
 * @param string $plaintext
 * @param string $hashedURL
 *
 * @return string|null
 */
function validate_hash($plaintext, $hashedURL)
{
	$calculatedHash = hash('sha256', $plaintext);
	return $calculatedHash === $hashedURL;
}

/**
 * Callback function to retrieve information about activated plugins.
 *
 * @return array response array.
 */
function get_activated_plugins_info()
{
	$plugins = get_option('active_plugins');

	$activated_plugins = [];

	foreach ($plugins as $plugin) {
		$data = get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);

		$update_info = get_site_transient('update_plugins');
		$update_data = [];

		if (!empty($update_info->response)) {
			foreach ($update_info->response as $plugin_file => $plugin_data) {
				if ($plugin_file === $plugin_data->slug . '/' . $data['TextDomain'] . '.php') {
					$update_data[] = $plugin_data;
				}
			}

			$activated_plugins[] = [
				'name'             => $data['Name'],
				'active_version'   => $data['Version'],
				'latest_version'   => isset($update_data['new_version']) ? $update_data['new_version'] : $data['Version'],
			];
		}
	}

	return $activated_plugins;
}

/**
 * Callback function to retrieve last backup information.
 *
 * @return array response array.
 */
function get_last_backup_info()
{
	$backup = get_option('updraft_last_backup');

	$backup_data = [
		'timestamp' => date('Y-m-d H:i:s', $backup['backup_time']),
		'status' => $backup['success'],
		'payload' => [
			'plugins' => $backup['backup_array']['plugins'],
			'themes' => $backup['backup_array']['themes'],
			'uploads' => $backup['backup_array']['uploads'],
			'others' => $backup['backup_array']['others'],
			'db' => $backup['backup_array']['db'],
		],
	];

	return $backup_data;
}
