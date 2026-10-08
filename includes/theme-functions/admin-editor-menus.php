<?php
/**
 * Allow Editors to manage WordPress Menus.
 *
 * WordPress restricts menu management to Administrators by default.
 * This function grants the necessary capability to Editors so they can manage menus.
 *
 * @return void
 */
function allow_editors_manage_menus() {
    // Get the Editor role
    $role = get_role('editor');

    // Check if the role exists before modifying capabilities
    if ($role) {
        // Grant the 'edit_theme_options' capability to the Editor role
        $role->add_cap('edit_theme_options');
    }
}

// Hook into 'init' to modify role capabilities
add_action('init', 'allow_editors_manage_menus');

/**
 * Restrict Editors from accessing Widgets in WordPress.
 *
 * Granting 'edit_theme_options' allows access to both Menus and Widgets.
 * This function removes the Widgets submenu from the Appearance menu for Editors.
 *
 * @return void
 */
function restrict_editor_from_widgets() {
    // Check if the current user is an Editor and is accessing the admin panel
    if (current_user_can('editor') && is_admin()) {
        // Remove the 'Widgets' submenu under 'Appearance'
        remove_submenu_page('themes.php', 'widgets.php');
    }
}

// Hook into 'admin_menu' to modify the admin menu
add_action('admin_menu', 'restrict_editor_from_widgets', 999);