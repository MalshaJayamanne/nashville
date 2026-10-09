</main>

</div>

<?php
// ACF footer fields
$footer_logo      = get_field('footer_logo', 'option');
$footer_copyright = get_field('footer_copyright', 'option');
$edm_logo         = get_field('edm_logo', 'option');

$footer_mobile   = get_field('footer_mobile', 'option');
$footer_email    = get_field('footer_email', 'option');
$footer_location = get_field('footer_location', 'option');

$footer_content = get_field('footer_content', 'option');
$footer_link    = get_field('footer_link', 'option');

// Theme options
$footer_menu_name = get_theme_option('footer_menu');
$address          = get_theme_option('address');
$telephone        = get_theme_option('telephone');
$email             = get_theme_option('email');
$copyrights_text  = get_theme_option('copyrights_text');

// Home page video and poster fields
$front_page_id = (int) get_option('page_on_front');

$footer_video = $front_page_id
    ? get_field('footer_video', $front_page_id)
    : false;

$footer_poster = $front_page_id
    ? get_field('footer_poster', $front_page_id)
    : false;

// Get video URL
$footer_video_url = '';

if (is_array($footer_video) && !empty($footer_video['url'])) {
    $footer_video_url = $footer_video['url'];
} elseif (is_numeric($footer_video)) {
    $footer_video_url = wp_get_attachment_url((int) $footer_video);
} elseif (
    is_string($footer_video) &&
    filter_var($footer_video, FILTER_VALIDATE_URL)
) {
    $footer_video_url = $footer_video;
}

// Get video type
$footer_video_type = 'video/mp4';

if ($footer_video_url) {
    $file_type = wp_check_filetype($footer_video_url);

    if (!empty($file_type['type'])) {
        $footer_video_type = $file_type['type'];
    }
}

// Get poster URL
$footer_poster_url = '';

if (is_array($footer_poster) && !empty($footer_poster['ID'])) {
    $footer_poster_url = wp_get_attachment_image_url(
        (int) $footer_poster['ID'],
        'full'
    );
} elseif (is_array($footer_poster) && !empty($footer_poster['url'])) {
    $footer_poster_url = $footer_poster['url'];
} elseif (is_numeric($footer_poster)) {
    $footer_poster_url = wp_get_attachment_image_url(
        (int) $footer_poster,
        'full'
    );
} elseif (
    is_string($footer_poster) &&
    filter_var($footer_poster, FILTER_VALIDATE_URL)
) {
    $footer_poster_url = $footer_poster;
}

// Contact details: prefer ACF values, then Theme Options
$contact_address = $footer_location ?: $address;

$phone_text = is_array($footer_mobile)
    ? ($footer_mobile['title'] ?? '')
    : (is_string($footer_mobile) ? $footer_mobile : '');

$phone_url = is_array($footer_mobile)
    ? ($footer_mobile['url'] ?? '')
    : '';

if (!$phone_text && $telephone) {
    $phone_text = $telephone;
}

$email_text = is_array($footer_email)
    ? ($footer_email['title'] ?? '')
    : (is_string($footer_email) ? $footer_email : '');

$email_url = is_array($footer_email)
    ? ($footer_email['url'] ?? '')
    : '';

if (!$email_text && $email) {
    $email_text = $email;
}

// Copyright text
if ($footer_copyright) {
    $copyright_text = str_replace(
        '[year]',
        date('Y'),
        $footer_copyright
    );
} elseif ($copyrights_text) {
    $copyright_text = str_replace(
        '[year]',
        date('Y'),
        $copyrights_text
    );
} else {
    $copyright_text = 'All Rights Reserved ' . date('Y');
}

// Appointment modal settings
$appointment_link_type = get_theme_option('appointment_link_type');
$appointment_form      = get_theme_option('appointment_form');
$appointment_title     = get_theme_option('appointment_modal_title');
?>

<?php if ((int) $appointment_link_type === 2 && $appointment_form) : ?>
    <div
        class="modal theme-modal fade"
        id="appointmentModal"
        tabindex="-1"
        aria-labelledby="appointmentModalLabel"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>

                <div class="modal-body">
                    <div class="content-wrapper">
                        <h2>
                            <?php
                            echo esc_html(
                                $appointment_title ?: 'Schedule an Appointment'
                            );
                            ?>
                        </h2>
                    </div>

                    <?php echo do_shortcode($appointment_form); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<footer class="site-footer">

    <!-- Background video -->
    <?php if ($footer_video_url) : ?>
        <div class="footer-background" aria-hidden="true">
            <video
                class="footer-background-video"
                autoplay
                muted
                loop
                playsinline
                preload="metadata"
                <?php if ($footer_poster_url) : ?>
                    poster="<?php echo esc_url($footer_poster_url); ?>"
                <?php endif; ?>
            >
                <source
                    src="<?php echo esc_url($footer_video_url); ?>"
                    type="<?php echo esc_attr($footer_video_type); ?>"
                >
            </video>
        </div>
    <?php endif; ?>

    <!-- Dark overlay -->
    <div class="footer-overlay" aria-hidden="true"></div>

    <!-- Footer columns -->
    <div class="footer-main">
        <div class="footer-container">
            <div class="footer-grid">

                <!-- Logo and social media -->
                <div class="footer-brand">
                    <?php if ($footer_logo) : ?>
                        <div class="footer-logo-wrapper">
                            <?php
                            get_image(
                                $footer_logo,
                                'footer-logo',
                                get_bloginfo('name')
                            );
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="footer-social">
                        <div class="footer-social-wrapper">
                            <?php get_template_part('templates/social', 'media'); ?>
                        </div>
                    </div>
                </div>

                <!-- Quick links -->
                <div class="footer-links-column">
                    <h4 class="footer-column-title">
                        <?php echo esc_html($footer_menu_name ?: 'Quick Links'); ?>
                    </h4>

                    <nav class="footer-navigation" aria-label="Footer navigation">
                        <?php
                        if ($footer_menu_name) {
                            wp_nav_menu(array(
                                'menu'        => $footer_menu_name,
                                'container'   => false,
                                'menu_class'  => 'footer-menu',
                                'fallback_cb' => false,
                                'depth'       => 1,
                            ));
                        } else {
                            wp_nav_menu(array(
                                'theme_location' => 'footer',
                                'container'      => false,
                                'menu_class'     => 'footer-menu',
                                'fallback_cb'    => false,
                                'depth'          => 1,
                            ));
                        }
                        ?>
                    </nav>
                </div>

                <!-- Contact details -->
                <div class="footer-contact-column">
                    <h4 class="footer-column-title">Contact Us</h4>

                    <?php if ($contact_address) : ?>
                        <div class="footer-contact-item">
                            <h5>Address</h5>
                            <p><?php echo nl2br(esc_html($contact_address)); ?></p>
                        </div>
                    <?php endif; ?>

                    <?php if ($phone_text || $phone_url) : ?>
                        <div class="footer-contact-item">
                            <h5>Contact Number</h5>

                            <?php if ($phone_url) : ?>
                                <a href="<?php echo esc_url($phone_url); ?>">
                                    <?php echo esc_html($phone_text ?: $phone_url); ?>
                                </a>
                            <?php else : ?>
                                <?php foreach (array_filter(array_map('trim', explode(',', $phone_text))) as $number) : ?>
                                    <a href="<?php echo esc_url('tel:' . preg_replace('/[^0-9+]/', '', $number)); ?>">
                                        <?php echo esc_html($number); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($email_text || $email_url) : ?>
                        <div class="footer-contact-item">
                            <h5>Email</h5>

                            <?php if ($email_url) : ?>
                                <a href="<?php echo esc_url($email_url); ?>">
                                    <?php echo esc_html($email_text ?: $email_url); ?>
                                </a>
                            <?php else : ?>
                                <?php foreach (array_filter(array_map('trim', explode(',', $email_text))) as $email_address) : ?>
                                    <a href="<?php echo esc_url('mailto:' . sanitize_email($email_address)); ?>">
                                        <?php echo esc_html($email_address); ?>
                                    </a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Office hours -->
                <div class="footer-hours-column">
                    <h4 class="footer-column-title">Office Hours</h4>

                    <?php if (have_rows('office_hours', 'option')) : ?>
                        <ul class="footer-office-hours">
                            <?php while (have_rows('office_hours', 'option')) : the_row(); ?>
                                <?php
                                $day  = get_sub_field('day');
                                $time = get_sub_field('time');
                                ?>

                                <?php if ($day || $time) : ?>
                                    <li>
                                        <span class="footer-hours-day">
                                            <?php echo esc_html($day); ?>
                                        </span>
                                        <span class="footer-hours-time">
                                            <?php echo esc_html($time); ?>
                                        </span>
                                    </li>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Copyright bar -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <p class="footer-legal">
                <?php echo esc_html($copyright_text); ?>
            </p>

            <div class="footer-website-credit">
                <span>Website By</span>

                <?php if ($edm_logo) : ?>
                    <?php
                    get_image(
                        $edm_logo,
                        'footer-edm-logo',
                        'Easy Dental Marketing'
                    );
                    ?>
                <?php else : ?>
                    <a
                        href="https://easydentalmarketing.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                        aria-label="Easy Dental Marketing"
                    >
                        <img
                            src="<?php echo esc_url(trailingslashit(THEME_THEMEROOT) . 'assets/images/logo-edm.png'); ?>"
                            alt="Easy Dental Marketing"
                            loading="lazy"
                        >
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>