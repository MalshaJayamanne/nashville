<?php

/**
 * Add Favicon to admin pannel.
 */
function add_custom_favicon()
{
	if (
		function_exists('get_field') &&
		$favicon = get_field('theme_appearance_favicon', 'option')
	) {
		echo '<link rel="shortcut icon" href="' . $favicon . '" />';
	} else {
		return;
	}
}
add_action('admin_head', 'add_custom_favicon');
