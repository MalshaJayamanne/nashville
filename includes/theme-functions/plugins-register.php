<?php

/**
 * Plugins regsiter function
 *
 * @uses TGM-Plugin-Activation
 * @link https://github.com/TGMPA/TGM-Plugin-Activation
 */
function theme_required_plugins_register()
{
	if (!function_exists('tgmpa')) return;

	$plugins = [
		[
			'name'      => 'Classic Editor',
			'slug'      => 'classic-editor',
			'required'  => true,
		],
		[
			'name'                  => 'Advanced Custom Fields Pro', // The plugin name
			'slug'                  => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name)
			'source'                => THEME_PLUGIN_ACTIVATION_PLUGINS . 'advanced-custom-fields-pro.zip', // The plugin source
			'required'              => true, // If false, the plugin is only 'recommended' instead of required
			'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url'          => '', // If set, overrides default API URL and points to an external URL
		],
	];

	/*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
	$config = [
		'page_title'   => __('Install Required Plugins'),
		'id'           => 'plugin-page', // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '', // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php', // Parent menu slug.
		'capability'   => 'manage_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true, // Show admin notices or not.
		'dismissable'  => true, // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '', // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false, // Automatically activate plugins after installation or not.
		'message'      => '', // Message to output right before the plugins table.
	];

	tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'theme_required_plugins_register');
