<?php
/* Template Name: Home */

get_header();

// Appointment button (shared by hero, about, select us and CTA)
$footer_link = get_field('footer_link', 'option');
?>

<main>

<?php

$hero_title   = get_field('hero_title');
$hero_video   = get_field('hero_video');
$hero_poster  = get_field('hero_poster');
$hero_content = get_field('hero_content');

?>

<section class="hero-section">

    <!-- HERO MEDIA -->

    <div class="hero-media">

        <?php if (!empty($hero_video['url'])) : ?>

            <video
                class="hero-video"
                autoplay
                muted
                loop
                playsinline
                preload="metadata"
                <?php if (!empty($hero_poster['url'])) : ?>
                    poster="<?php echo esc_url($hero_poster['url']); ?>"
                <?php endif; ?>
                aria-hidden="true"
            >
                <source
                    src="<?php echo esc_url($hero_video['url']); ?>"
                    type="<?php echo esc_attr($hero_video['mime_type'] ?? 'video/mp4'); ?>"
                >
            </video>

        <?php elseif ($hero_poster) : ?>

            <?php
            get_image(
                $hero_poster,
                'hero-poster-image',
                ''
            );
            ?>

        <?php endif; ?>

    </div>


    <!-- HERO CONTENT -->

    <div class="container">

        <div class="hero-inner">

            <?php if ($hero_title) : ?>

                <div class="hero-title">
                    <?php echo wp_kses_post($hero_title); ?>
                </div>

            <?php endif; ?>


            <!-- CONTENT + APPOINTMENT BUTTON -->

            <div class="hero-cta">

                <?php if ($hero_content) : ?>

                    <div class="hero-content">
                        <?php echo wp_kses_post($hero_content); ?>
                    </div>

                <?php endif; ?>

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

</section>


<?php

$about_text    = get_field('about_text');
$about_image   = get_field('about_image');
$about_content = get_field('about_content');
$about_link    = get_field('about_link');

// Optional: faint skyline image in the bottom-right of the card (ACF image field "about_watermark")
$about_watermark = get_field('about_watermark');

?>

<section class="about-section">

    <div class="container">

        <!-- TOP HEADING -->

        <?php if ($about_text) : ?>

            <h2>
                <?php echo esc_html($about_text); ?>
            </h2>

        <?php endif; ?>


        <div class="about-wrapper">

            <!-- IMAGE -->

            <?php if ($about_image) : ?>

                <div class="about-image">

                    <?php
                    get_image(
                        $about_image,
                        'about-img',
                        ''
                    );
                    ?>

                </div>

            <?php endif; ?>


            <!-- CONTENT CARD -->

            <div class="about-card">

                <?php if ($about_watermark) : ?>

                    <div class="about-watermark" aria-hidden="true">
                        <?php
                        get_image(
                            $about_watermark,
                            'about-watermark-image',
                            ''
                        );
                        ?>
                    </div>

                <?php endif; ?>

                <?php if ($about_content) : ?>

                    <div class="about-content">
                        <?php echo wp_kses_post($about_content); ?>
                    </div>

                <?php endif; ?>


                <div class="about-buttons">

                    <!-- APPOINTMENT BUTTON -->

                    <a
                        class="theme-brown"
                        href="<?php echo esc_url(!empty($footer_link['url']) ? $footer_link['url'] : home_url('/#cta')); ?>"
                        target="<?php echo esc_attr($footer_link['target'] ?? '_self'); ?>"
                    >
                        Schedule an appointment
                    </a>


                    <!-- LEARN MORE -->

                    <?php if (!empty($about_link)) : ?>

                        <a
                            class="theme-brown-light"
                            href="<?php echo esc_url($about_link['url']); ?>"
                            target="<?php echo esc_attr($about_link['target'] ?? '_self'); ?>"
                            <?php if (($about_link['target'] ?? '') === '_blank') : ?>
                                rel="noopener noreferrer"
                            <?php endif; ?>
                        >
                            <?php echo esc_html($about_link['title'] ?: 'Learn More'); ?>
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</section>


<?php

$selectus_image   = get_field('selectus_image');
$selectus_content = get_field('selectus_content');

?>

<section class="selectus-section">

    <div class="selectus-image">

        <?php if ($selectus_image) : ?>

            <?php
            get_image(
                $selectus_image,
                'selectus-bg-image',
                ''
            );
            ?>

        <?php endif; ?>


        <div class="selectus-inner">

            <?php if ($selectus_content) : ?>

                <div class="selectus-content">
                    <?php echo wp_kses_post($selectus_content); ?>
                </div>

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

</section>


<?php

$service_video     = get_field('service_background_video');
$service_poster    = get_field('service_poster');
$service_watermark = get_field('service_watermark');
$service_left      = get_field('service_left');
$service_right     = get_field('service_right');

// Appointment link from Theme General Settings.
$appointment_link = get_field('appointment_link', 'option');

$appointment_url = (
    is_array($appointment_link) &&
    !empty($appointment_link['url'])
)
    ? $appointment_link['url']
    : home_url('/#contact');

$appointment_target = (
    is_array($appointment_link) &&
    !empty($appointment_link['target'])
)
    ? $appointment_link['target']
    : '_self';

?>

<section class="services-section">

    <!-- Background video or poster -->

    <div class="services-media">

        <?php if (is_array($service_video) && !empty($service_video['url'])) : ?>

            <video
                class="services-video"
                autoplay
                muted
                loop
                playsinline
                preload="metadata"
                <?php if (is_array($service_poster) && !empty($service_poster['url'])) : ?>
                    poster="<?php echo esc_url($service_poster['url']); ?>"
                <?php endif; ?>
                aria-hidden="true"
                tabindex="-1"
            >
                <source
                    src="<?php echo esc_url($service_video['url']); ?>"
                    type="<?php echo esc_attr($service_video['mime_type'] ?? 'video/mp4'); ?>"
                >
            </video>

        <?php elseif ($service_poster) : ?>

            <?php
            get_image(
                $service_poster,
                'services-poster-image',
                ''
            );
            ?>

        <?php endif; ?>

    </div>

    <!-- Background watermark -->

    <?php if ($service_watermark) : ?>

        <div class="services-watermark" aria-hidden="true">
            <?php
            get_image(
                $service_watermark,
                'services-watermark-image',
                ''
            );
            ?>
        </div>

    <?php endif; ?>

    <div class="container">

        <!-- Section heading and introduction -->

        <div class="services-head">

            <?php if ($service_left) : ?>

                <div class="services-left">
                    <?php echo wp_kses_post($service_left); ?>
                </div>

            <?php endif; ?>

            <?php if ($service_right) : ?>

                <div class="services-right">

                    <div class="services-right-content">
                        <?php echo wp_kses_post($service_right); ?>
                    </div>

                    <a
                        class="theme-white"
                        href="<?php echo esc_url($appointment_url); ?>"
                        target="<?php echo esc_attr($appointment_target); ?>"
                        <?php if ($appointment_target === '_blank') : ?>
                            rel="noopener noreferrer"
                        <?php endif; ?>
                    >
                        Schedule an appointment
                    </a>

                </div>

            <?php endif; ?>

        </div>

        <!-- Services Swiper -->

        <?php if (have_rows('services')) : ?>

            <div class="services-swiper swiper">

                <div class="swiper-wrapper">

                    <?php while (have_rows('services')) : the_row(); ?>

                        <?php
                        $service_image   = get_sub_field('image');
                        $service_title   = get_sub_field('title');
                        $service_content = get_sub_field('content');
                        $service_link    = get_sub_field('link');
                        ?>

                        <article class="service-card swiper-slide">

                            <?php if ($service_image) : ?>

                                <div class="service-image">
                                    <?php
                                    get_image(
                                        $service_image,
                                        'service-img',
                                        $service_title ?: 'Dental service'
                                    );
                                    ?>
                                </div>

                            <?php endif; ?>

                            <div class="service-body">

                                <?php if ($service_title) : ?>

                                    <h3>
                                        <?php echo esc_html($service_title); ?>
                                    </h3>

                                <?php endif; ?>

                                <?php if ($service_content) : ?>

                                    <p>
                                        <?php echo esc_html($service_content); ?>
                                    </p>

                                <?php endif; ?>

                                <?php if (is_array($service_link) && !empty($service_link['url'])) : ?>

                                    <a
                                        class="service-readmore"
                                        href="<?php echo esc_url($service_link['url']); ?>"
                                        target="<?php echo esc_attr($service_link['target'] ?? '_self'); ?>"
                                        <?php if (($service_link['target'] ?? '') === '_blank') : ?>
                                            rel="noopener noreferrer"
                                        <?php endif; ?>
                                    >
                                        <?php
                                        echo esc_html(
                                            !empty($service_link['title'])
                                                ? $service_link['title']
                                                : 'Read More'
                                        );
                                        ?>
                                    </a>

                                <?php endif; ?>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>

            </div>

        <?php endif; ?>

    </div>

</section>


<?php

$reviews_image = get_field('reviews_image');
$review_title  = get_field('review_title');

?>

<section class="reviews-section" id="reviews">

    <!-- BACKGROUND IMAGE -->

    <?php if ($reviews_image) : ?>

        <div class="reviews-background" aria-hidden="true">
            <?php
            get_image(
                $reviews_image,
                'reviews-background-image',
                ''
            );
            ?>
        </div>

    <?php endif; ?>


    <!-- REVIEWS CONTENT -->

    <div class="reviews-container">

        <div class="reviews-content">

            <!-- TITLE -->

            <?php if ($review_title) : ?>

                <div class="reviews-heading">
                    <?php echo wp_kses_post($review_title); ?>
                </div>

            <?php endif; ?>


            <!-- REVIEW CARDS -->

            <?php if (have_rows('review')) : ?>

                <div class="reviews-list">

                    <?php while (have_rows('review')) : the_row(); ?>

                        <?php
                        $review_content = get_sub_field('content');
                        $review_name    = get_sub_field('name');
                        $review_icon    = get_sub_field('icon');
                        ?>

                        <article class="review-card">

                            <?php if ($review_icon) : ?>

                                <div class="review-icon">
                                    <?php
                                    get_image(
                                        $review_icon,
                                        'review-icon-image',
                                        'Review platform'
                                    );
                                    ?>
                                </div>

                            <?php endif; ?>


                            <?php if ($review_content) : ?>

                                <p class="review-text">
                                    <?php echo esc_html($review_content); ?>
                                </p>

                            <?php endif; ?>


                            <?php if ($review_name) : ?>

                                <p class="review-name">
                                    <?php echo esc_html($review_name); ?>
                                </p>

                            <?php endif; ?>

                        </article>

                    <?php endwhile; ?>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>


<?php
$doctor_lcontent = get_field('doctor_lcontent');
$doctor_image    = get_field('doctor_image');
$doctor_rcontent = get_field('doctor_rcontent');
$doctor_link     = get_field('doctor_link');
?>

<section class="doctor-section" id="doctor">
    <div class="doctor-container">

        <!-- Left Content Card -->
        <div class="doctor-left">
            <div class="doctor-left-content">
                <?php
                if ($doctor_lcontent) {
                    echo '<div class="doctor-left-editor">';
                    echo wp_kses_post($doctor_lcontent);
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <!-- Center Doctor Image -->
        <div class="doctor-image">
            <?php
            if ($doctor_image) {
                echo get_image(
                    $doctor_image,
                    'doctor',
                    'Dr. Homa Amedy, cosmetic dentist in Nashville'
                );
            }
            ?>
        </div>

        <!-- Right Biography Card -->
        <div class="doctor-right">
            <div class="doctor-right-content">
                <?php
                if ($doctor_rcontent) {
                    echo '<div class="doctor-right-editor">';
                    echo wp_kses_post($doctor_rcontent);
                    echo '</div>';
                }

                if ($doctor_link && !empty($doctor_link['url'])) :
                    $link_target = !empty($doctor_link['target'])
                        ? $doctor_link['target']
                        : '_self';
                ?>
                    <a
                        class="doctor-button"
                        href="<?php echo esc_url($doctor_link['url']); ?>"
                        target="<?php echo esc_attr($link_target); ?>"
                        <?php if ($link_target === '_blank') : ?>
                            rel="noopener noreferrer"
                        <?php endif; ?>
                    >
                        <?php
                        echo esc_html(
                            !empty($doctor_link['title'])
                                ? $doctor_link['title']
                                : 'Read more about the doctor'
                        );
                        ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>


<?php
$cta_image   = get_field('cta_image');
$cta_content = get_field('cta_content');

// Appointment button settings (uses the shared $footer_link from the top).
$button_url   = !empty($footer_link['url']) ? $footer_link['url'] : '#appointment';
$button_title = !empty($footer_link['title']) ? $footer_link['title'] : 'Schedule an Appointment';
$target       = !empty($footer_link['target']) ? $footer_link['target'] : '_self';
?>

<section class="cta-section">
    <div class="cta-image">
        <?php
        if ($cta_image) {
            if (is_array($cta_image)) {
                echo wp_get_attachment_image($cta_image['ID'], 'full', false, [
                    'alt' => 'Woman enjoying a warm sunset with a confident smile'
                ]);
            } elseif (is_numeric($cta_image)) {
                echo wp_get_attachment_image($cta_image, 'full', false, [
                    'alt' => 'Woman enjoying a warm sunset with a confident smile'
                ]);
            } else {
                echo '<img src="' . esc_url($cta_image) . '" alt="Woman enjoying a warm sunset with a confident smile" />';
            }
        }
        ?>

        <div class="cta-content">
            <div class="cta-content-inner">

                <?php if ($cta_content) : ?>
                    <?php echo wp_kses_post($cta_content); ?>
                <?php endif; ?>

                <!-- Appointment Button -->
                <a
                    class="cta-button"
                    href="<?php echo esc_url($button_url); ?>"
                    target="<?php echo esc_attr($target); ?>"
                    <?php if ($target === '_blank') : ?>
                        rel="noopener noreferrer"
                    <?php endif; ?>
                >
                    <?php echo esc_html($button_title); ?>
                </a>

            </div>
        </div>
    </div>
</section>


<?php
$gallery_title     = get_field('gallery_title');
$instagram_link    = get_field('instagram_link');
$instagram_gallery = get_field('instagram_gallery');

$instagram_url = !empty($instagram_link['url'])
    ? $instagram_link['url']
    : '';

$instagram_target = !empty($instagram_link['target'])
    ? $instagram_link['target']
    : '_blank';

$instagram_handle = '@NashvilleAesthetic';
?>

<section class="gallery-section" id="gallery">

    <div class="gallery-container">

        <!-- Gallery Heading -->
        <div class="gallery-heading">

            <?php if ($gallery_title) : ?>
                <div class="gallery-heading-content">
                    <?php echo wp_kses_post($gallery_title); ?>

                    <!-- Instagram Handle: same row as FOLLOW US -->
                    <?php if ($instagram_url) : ?>
                        <a
                            class="instagram-handle"
                            href="<?php echo esc_url($instagram_url); ?>"
                            target="<?php echo esc_attr($instagram_target); ?>"
                            <?php if ($instagram_target === '_blank') : ?>
                                rel="noopener noreferrer"
                            <?php endif; ?>
                        >
                            <?php echo esc_html($instagram_handle); ?>
                        </a>
                    <?php else : ?>
                        <span class="instagram-handle">
                            <?php echo esc_html($instagram_handle); ?>
                        </span>
                    <?php endif; ?>

                </div>
            <?php endif; ?>

        </div>

        <!-- Instagram Image Gallery -->
        <?php if (!empty($instagram_gallery) && is_array($instagram_gallery)) : ?>

            <div class="instagram-gallery">

                <?php foreach ($instagram_gallery as $image) : ?>

                    <?php
                    // Support ACF Gallery fields returning image IDs or arrays.
                    $image_id = is_array($image)
                        ? (int) ($image['ID'] ?? $image['id'] ?? 0)
                        : (int) $image;

                    if (!$image_id) {
                        continue;
                    }

                    $image_alt = is_array($image) && !empty($image['alt'])
                        ? $image['alt']
                        : 'Instagram gallery image';
                    ?>

                    <div class="instagram-gallery-item">
                        <?php
                        echo get_image(
                            $image_id,
                            'gallery',
                            $image_alt
                        );
                        ?>
                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>

</section>

</main>

<?php get_footer(); ?>