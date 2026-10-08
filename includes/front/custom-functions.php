<?php

/**
 * Get latest blog posts
 *
 * @param   int     $limit      Posts limit
 * @return  WP_Query
 */
function get_latest_blog_posts($limit = 3)
{

	return new WP_Query(array(
		'post_type' => 'post',
		'order_by'  => 'date',
		'order'     => 'DESC',
		'posts_per_page' => $limit
	));
}

/**
 * Remove site title if rank math plugin exists
 */
function check_site_title($title, $sep, $seplocation)
{
    // rank math exists
    if (class_exists('RankMath')) {
        return $title;
    } else {
        return $title . get_bloginfo('name');
    }
}
add_filter('wp_title', 'check_site_title', 10, 3);

function wrap_last_word(string $string, string $class = ''): string
{
    $trimmedString = trim($string);
    $lastSpacePos = strrpos($trimmedString, ' ');

    if ($lastSpacePos === false) {
        // If there's only one word, return default string.
        return $string;
    }

    $beforeLastWord = substr($trimmedString, 0, $lastSpacePos);
    $lastWord = substr($trimmedString, $lastSpacePos + 1);

    $wrappedLastWord = $class ? "<span class=\"$class\">$lastWord</span>" : "<span>$lastWord</span>";

    return $beforeLastWord . ' ' . $wrappedLastWord;
}

/**
 * Change default arguments for Gravity Forms.
 *
 * This function modifies the default arguments for Gravity Forms.
 * It sets the 'ajax' property to true, which enables AJAX form submission.
 * It also sets the 'title' property to false, which removes the form title.
 *
 * @param array $form_args The default arguments for Gravity Forms.
 *
 * @return array The modified arguments for Gravity Forms.
 */
function changeGravityFormDefaultArguments($form_args)
{
    $form_args['ajax'] = true; // Enables AJAX for all forms.
    $form_args['title'] = false; // Disables the title for all forms.

    return $form_args; // Returns the modified arguments.
}

add_filter('gform_form_args', 'changeGravityFormDefaultArguments');