</main>

</div>

<?php if ((get_theme_option('appointment_link_type') == 2) && ($form_shortcode = get_theme_option('appointment_form'))): ?>
    <!-- Offer Modal -->
    <div class="modal theme-modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="content-wrapper">
                        <h2><?php echo get_theme_option('appointment_modal_title') ?: 'Schedule an Appointment'; ?></h2>
                    </div>
                    <?php echo do_shortcode($form_shortcode); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<footer class="main-footer">
    <div class="container">
        <div class="inner">
            <div class="left">
                <div class="top">
                    <?php if ($logo = get_theme_option('footer_logo')): ?>
                        <div class="logo"><?php get_image($logo, 'logo', get_bloginfo('name')); ?></div>
                    <?php endif; ?>
                    <?php get_template_part('templates/social', 'media'); ?>
                </div>

                <div class="middle">
                    <?php if ($footerMenu = get_theme_option('footer_menu')) : ?>
                        <div class="footer-menu">
                            <h3 class="footer-subheading"><?php echo $footerMenu; ?></h3>
                            <?php
                            wp_nav_menu(array(
                                'menu'            => $footerMenu,
                                'container'       => false,
                                'menu_class'      => 'menu',
                                'echo'            => true,
                                'fallback_cb'     => '',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s navbar-nav">%3$s</ul>',
                                'depth'           => 1
                            ));
                            ?>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('office_hours', 'option')) : ?>
                        <div class="office-hours">
                            <h4 class="footer-subheading">Office Hours</h4>
                            <?php while (have_rows('office_hours', 'option')): the_row(); ?>
                                <p><?php the_sub_field('day'); ?> <span><?php the_sub_field('time'); ?></span></p>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <div class="contact-details">
                        <h4 class="footer-subheading">Contact Us</h4>

                        <?php if ($address = get_theme_option('address')) : ?>
                            <p><?php echo nl2br($address); ?></p>
                        <?php endif; ?>

                        <?php if ($telephone = get_theme_option('telephone')) : ?>
                            <p>
                                <?php
                                $telephone = explode(',', $telephone);
                                if (is_array($telephone)) : ?>
                                    <?php foreach ($telephone as $number) : ?>
                                        <a href="tel:<?php echo trim($number); ?>"><?php echo trim($number); ?></a><br>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a href="tel:<?php echo trim($telephone); ?>"><?php echo trim($telephone); ?></a>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>

                        <?php if ($email = get_theme_option('email')) : ?>
                            <p>
                                <?php
                                $email = explode(',', $email);
                                if (is_array($email)) : ?>
                                    <?php foreach ($email as $item) : ?>
                                        <a href="mailto:<?php echo trim($item); ?>"><?php echo trim($item); ?></a><br>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a href="mailto:<?php echo trim($email); ?>"><?php echo trim($email); ?></a>
                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if ($formShortcode = get_theme_option('footer_contact_form')): ?>
                <div class="right">
                    <?php if ($title = get_theme_option('footer_contact_title')): ?>
                        <div class="content-wrapper white-heading"><?php echo $title; ?></div>
                    <?php endif; ?>
                    <?php echo do_shortcode($formShortcode); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="copyrights">
            <p class="edm-wrapper"><a href="https://easydentalmarketing.com/" target="_blank">Website By <img src="<?php echo THEME_IMAGES; ?>logo-edm.png" alt="Easy Dental Marketing"></a></p>
            <p class="maya-wrapper"><a href="https://mayahive.com/" target="_blank">Website By Maya<span>Hive</span></a></p>
            <p class="copyrights-text"><?php echo str_replace('[year]', date('Y'), get_theme_option('copyrights_text')); ?></p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>