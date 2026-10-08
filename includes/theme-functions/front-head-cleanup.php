<?php

if (function_exists('remove_action')) {
	/** Remove emoji support. */
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');

	/** Remove RSS feed links */
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'feed_links', 2);
}
