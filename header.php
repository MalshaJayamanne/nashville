<!doctype html>
<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php wp_title('|', true, 'right'); ?></title>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php
$enable_sticky_header = get_field('enable_sticky_header', 'option');
$logo                 = get_field('logo', 'option');
$left_menu            = get_field('left_menu', 'option');
$right_menu           = get_field('right_menu', 'option');
$footer_mobile        = get_field('footer_mobile', 'option');
$footer_link          = get_field('footer_link', 'option');

// Optional new ACF true/false (Header tab): header overlays the hero
$transparent_header   = get_field('transparent_header', 'option');

$header_classes = 'main-header';
if ($transparent_header) {
    $header_classes .= ' is-transparent';
}
if ($enable_sticky_header) {
    $header_classes .= ' is-sticky';
}
?>

<div id="page">

    <header class="<?php echo esc_attr($header_classes); ?>">

        <div class="container">

            <div class="header-wrapper">

            <!-- LEFT -->

            <div class="left">

                <div class="header-top">

                    <?php if (!empty($footer_mobile)) : ?>

                        <a
                            class="header-phone"
                            href="<?php echo esc_url($footer_mobile['url']); ?>"
                            target="<?php echo esc_attr($footer_mobile['target'] ?? '_self'); ?>"
                            <?php if (($footer_mobile['target'] ?? '') === '_blank') : ?>
                                rel="noopener noreferrer"
                            <?php endif; ?>
                        >
                            <i class="fa-solid fa-phone" aria-hidden="true"></i><?php echo esc_html($footer_mobile['title']); ?>
                        </a>

                    <?php endif; ?>

                </div>

                <?php if ($left_menu) : ?>

                    <div class="menu-wrapper">

                        <?php
                        wp_nav_menu([
                            'menu'                 => $left_menu,
                            'container'            => 'nav',
                            'container_class'      => 'header-nav',
                            'container_aria_label' => 'Left navigation',
                            'menu_class'           => 'menu',
                            'fallback_cb'          => false,
                            'items_wrap'           => '<ul id="%1$s" class="menu">%3$s</ul>',
                            'depth'                => 1,
                        ]);
                        ?>

                    </div>

                <?php endif; ?>

            </div>


            <!-- LOGO -->

            <div class="logo-wrapper">

                <a href="<?php echo esc_url(home_url('/')); ?>">

                    <?php if ($logo) : ?>

                        <?php
                        get_image(
                            $logo,
                            'logo',
                            get_bloginfo('name')
                        );
                        ?>

                    <?php endif; ?>

                </a>

            </div>


            <!-- RIGHT -->

            <div class="right">

                <div class="header-top">

                    <?php
                    get_template_part('templates/social', 'media');
                    ?>

                </div>

                <div class="menu-wrapper">

                    <?php if ($right_menu) : ?>

                        <?php
                        wp_nav_menu([
                            'menu'                 => $right_menu,
                            'container'            => 'nav',
                            'container_class'      => 'header-nav',
                            'container_aria_label' => 'Right navigation',
                            'menu_class'           => 'menu',
                            'fallback_cb'          => false,
                            'items_wrap'           => '<ul id="%1$s" class="menu">%3$s</ul>',
                            'depth'                => 1,
                        ]);
                        ?>

                    <?php endif; ?>


                    <!-- APPOINTMENT BUTTON -->

                    <a
                        class="theme-brown"
                        href="<?php echo esc_url(!empty($footer_link['url']) ? $footer_link['url'] : home_url('/#cta')); ?>"
                        target="<?php echo esc_attr($footer_link['target'] ?? '_self'); ?>"
                    >
                        Schedule an appointment
                    </a>

                </div>

            </div>

            </div>

        </div>

    </header>
    