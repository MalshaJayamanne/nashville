<?php /* Template Name: Home */ ?>

<?php get_header(); ?>

<section class="home-banner">
    <?php get_image(get_page_data('banner_image'), 'full-image'); ?>
    <div class="container">
        <div class="content-wrapper">
            <?php echo get_page_data('banner_content'); ?>
            <?php echo get_appointment_link('theme-btn'); ?>
        </div>
    </div>
</section>

<?php get_footer();
