<body>

<main>    

<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<?php

$hero_title   = get_field('hero_title');
$hero_video   = get_field('hero_video');
$hero_poster  = get_field('hero_poster');
$hero_content = get_field('hero_content');

// Appointment button 
$footer_link  = get_field('footer_link', 'option');

?>

<section class="hero-section">

    <!-- BACKGROUND (video with poster, or image only) -->

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


    <div class="container">

        <div class="hero-inner">

            <!-- TITLE -->

            <?php if ($hero_title) : ?>

                <div class="hero-title">

                    <?php echo wp_kses_post($hero_title); ?>

                </div>

            <?php endif; ?>


            <!-- CONTENT + APPOINTMENT BUTTON -->

            <div class="hero-cta">

                <?php if ($hero_content) : ?>

                    <p class="hero-content">
                        <?php echo esc_html($hero_content); ?>
                    </p>

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

<?php get_footer();
