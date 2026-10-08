<?php

/**
 * Print attachement image.
 *
 * @param   int         $imageID        ID of the image
 * @param   string      $class          ID of the image
 * @param   string      $alt            Alternative text
 * @param   string      $lazyLoad       Lazyload
 * @return  void
 */
function get_image($imageID = '', $class = '', $alt = '', $lazyLoad = 'lazy')
{
    if (empty($imageID)) {
        return false;
    }

    $attr = array(
        'class' => $class,
        'loading' => $lazyLoad,
    );

    if ($alt) {
        $attr['alt'] = $alt;
    }

    echo wp_get_attachment_image($imageID, 'full', false, $attr);
    return;
}

/**
 * Get social media links for menu as array
 */
function get_social_links()
{

    $socialMedia = [];

    if ($facebook = get_theme_option('facebook')) {
        $socialMedia[] = '<a href="' . $facebook . '" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>';
    }

    if ($youtube = get_theme_option('youtube')) {
        $socialMedia[] = '<a href="' . $youtube . '" target="_blank"><i class="fa-brands fa-youtube"></i></a>';
    }

    if ($linkedin = get_theme_option('linkedin')) {
        $socialMedia[] = '<a href="' . $linkedin . '" target="_blank"><i class="fa-brands fa-linkedin"></i></a>';
    }

    if ($instagram = get_theme_option('instagram')) {
        $socialMedia[] = '<a href="' . $instagram . '" target="_blank"><i class="fa-brands fa-instagram"></i></a>';
    }

    if ($tiktok = get_theme_option('tiktok')) {
        $socialMedia[] = '<a href="' . $tiktok . '" target="_blank"><i class="fa-brands fa-tiktok"></i></a>';
    }

    if ($yelp = get_theme_option('yelp')) {
        $socialMedia[] = '<a href="' . $yelp . '" target="_blank"><i class="fa-brands fa-yelp"></i></a>';
    }

    if ($twiiter_x = get_theme_option('twitter_x')) {
        $socialMedia[] = '<a href="' . $twiiter_x . '" target="_blank"><i class="fa-brands fa-x-twitter"></i></a>';
    }

    return $socialMedia;
}

/**
 * Retrieves and sets the Advanced Custom Fields (ACF) options if not already set.
 *
 * This code checks if the global variable $acfOptions is set. If it is not set,
 * it retrieves the ACF options using the get_fields function with 'options' as the parameter
 * and assigns the result to the $acfOptions variable.
 *
 * @global array $acfOptions The global variable to store ACF options.
 * @return void
 */
global $acfOptions;
if (function_exists('get_fields') && !isset($acfOptions)) {
    $acfOptions = get_fields('options');
}

/**
 * Retrieve a theme option value.
 *
 * This function fetches the value of a specified theme option key.
 *
 * @param string $key The key of the theme option to retrieve. Default is an empty string.
 * @return mixed The value of the theme option associated with the provided key, or null if the key does not exist.
 */
function get_theme_option($key = '')
{
    global $acfOptions;
    if (isset($acfOptions[$key])) {
        return $acfOptions[$key];
    }

    return FALSE;
}

add_action('wp', function () {
    global $pageData;
    if (function_exists('get_fields') && !isset($pageData)) {
        $pageData = get_fields(get_the_ID()); // This works after WordPress has loaded the global post object.
    }
});

function get_page_data($key = '')
{
    global $pageData;
    if (isset($pageData[$key])) {
        return $pageData[$key];
    }

    return FALSE;
}


/**
 * Print ancher tag.
 *
 * @param   int         $acf_obj        ACF object or URL
 * @param   string      $class          Class of the link
 * @return  void
 */
function get_theme_link($acf_obj, $class = '')
{

    if (!empty($acf_obj)) {
        if (is_array($acf_obj)) {

            $link_title = $acf_obj['title'];
            $link_url = !empty($acf_obj['url']) ? $acf_obj['url'] : '#';
            $link_target = !empty($acf_obj['target']) ? 'target="' . $acf_obj['target'] . '"' : '';
            $link_class = !empty($class) ? 'class="' . $class . '"' : '';

            echo '<a href="' . $link_url . '" ' . $link_class . ' ' . $link_target . '>' . $link_title . '</a>';
        } else if (filter_var($acf_obj, FILTER_VALIDATE_URL)) {

            echo '<a href="' . $acf_obj . '" class="' . $class . '"></a>';
        }
    }

    return;
}

/**
 * Get the appointment link
 */
function get_appointment_link($class = '')
{
    if (!function_exists('get_theme_option')) {
        return false;
    }

    $type = get_theme_option('appointment_link_type');
    switch ($type) {
        case 1:
            return get_theme_link(get_theme_option('appointment_link'), $class);
        case 2:
            if (get_theme_option('appointment_form')) {
                $btn_title = get_theme_option('appointment_btn_title');
                return sprintf(
                    '<button class="appointment-btn %s">%s</button>',
                    $class,
                    $btn_title ? esc_html($btn_title) : 'Schedule an Appointment'
                );
            }
            break;
    }

    return false;
}

/**
 * Merge multiple menus
 */
function merge_menus(mixed $menus, string $class = ''): array|string|false
{
    if (empty($menus)) {
        return false;
    }

    if (!is_array($menus)) {
        $menus = [$menus];
    }

    $combined_menu = [];
    foreach ($menus as $menu) {
        if ( ! $menu ) {
            continue;
        }

        $combined_menu = array_merge($combined_menu, wp_get_nav_menu_items($menu));
    }

    return '<ul class="' . esc_attr($class) . '">' . walk_nav_menu_tree($combined_menu, 0, (object) array('before' => '', 'after' => '', 'link_before' => '', 'link_after' => '')) . '</ul>';
}
