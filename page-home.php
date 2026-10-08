<?php
/* Template Name: Home */

get_header();

// Appointment button (shared by hero + about)
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

</main>

<?php get_footer(); ?>
