<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo get_theme_option('tag_header_script'); ?>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php echo get_theme_option('tag_body_script'); ?>
    <div id="page">
        <header class="main-header">
            <div class="container">
                <div class="left">
                    <div class="top">
                        <?php if ($telephone = get_theme_option('telephone')) : ?>
                            <a href="tel:<?php echo $telephone; ?>" class="telephone">
                                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.1293 9.18626L10.2855 7.96749C10.164 7.91571 10.029 7.90481 9.90074 7.9364C9.77252 7.968 9.65803 8.04039 9.57451 8.14269L8.31512 9.68139C6.33861 8.74948 4.74798 7.15885 3.81607 5.18234L5.35477 3.92294C5.45727 3.83958 5.52982 3.72509 5.56143 3.59681C5.59304 3.46853 5.582 3.33344 5.52997 3.21199L4.3112 0.368194C4.2541 0.23728 4.15311 0.130393 4.02564 0.065964C3.89817 0.00153493 3.75222 -0.0163977 3.61294 0.0152583L0.972274 0.624644C0.837998 0.655651 0.718197 0.731256 0.632423 0.839118C0.54665 0.946981 0.499969 1.08073 0.5 1.21854C0.5 7.73135 5.7788 13 12.2815 13C12.4193 13.0001 12.5531 12.9534 12.661 12.8677C12.7689 12.7819 12.8446 12.662 12.8756 12.5277L13.485 9.88705C13.5164 9.7471 13.4981 9.60057 13.4332 9.47266C13.3683 9.34475 13.2608 9.24348 13.1293 9.18626Z" fill="#257DCA" />
                                </svg>
                                <?php echo esc_html($telephone); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="menu-wrapper">
                        <?php if ($left_menu = get_theme_option('left_menu')): ?>
                            <nav class="navbar navbar-expand-md p-0">
                                <?php wp_nav_menu(array(
                                    'menu'            => $left_menu,
                                    'container'       => false,
                                    'menu_class'      => 'menu',
                                    'echo'            => true,
                                    'fallback_cb'     => '',
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s navbar-nav">%3$s</ul>',
                                    'depth'           => 0
                                )); ?>
                            </nav>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="logo-wrapper">
                    <?php if ($logo = get_theme_option('logo')) : ?>
                        <a href="<?php echo site_url(); ?>">
                            <?php get_image($logo, 'logo', get_bloginfo('name'), FALSE); ?>
                        </a>
                        <script>
                            const SITE_LOGO = '<?php echo wp_get_attachment_url($logo); ?>';
                        </script>
                    <?php endif; ?>
                </div>
                <div class="right">
                    <div class="top">
                        <?php get_template_part('templates/social', 'media'); ?>
                    </div>
                    <div class="menu-wrapper">
                        <?php if ($right_menu = get_theme_option('right_menu')): ?>
                            <nav class="navbar navbar-expand-md p-0">
                                <?php wp_nav_menu(array(
                                    'menu'            => $right_menu,
                                    'container'       => false,
                                    'menu_class'      => 'menu',
                                    'echo'            => true,
                                    'fallback_cb'     => '',
                                    'items_wrap'      => '<ul id="%1$s" class="%2$s navbar-nav">%3$s</ul>',
                                    'depth'           => 0
                                )); ?>
                            </nav>
                        <?php endif; ?>
                        
                        <?php echo get_appointment_link('theme-btn'); ?>
                    </div>
                </div>

                <?php if ($mobile_menu = merge_menus([$left_menu, $right_menu])): ?>
                    <a class="menu-icon" href="#navbarCollapse"><i class="fa-solid fa-bars"></i></a>
                <?php endif; ?>
            </div>

            <?php if ($mobile_menu): ?>
                <div class="mobile-menu">
                    <div id="navbarCollapse">
                        <?php echo $mobile_menu; ?>
                    </div>
                </div>
            <?php endif; ?>

        </header>

        <main>