<?php /* Template Name: About */ ?>

<?php get_header(); ?>

<?php get_template_part('templates/sub-page', 'banner'); ?>

<?php if ($content = get_page_data('doctor_content')) : ?>
    <section class="about-doctor">
        <div class="container">

            <div class="row">
                <?php if ($image = get_page_data('doctor_image')): ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="full-image-parent">
                            <?php get_image($image, 'full-image'); ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-sm-12 col-lg-<?php echo ($image) ? '6' : '12'; ?>">
                    <div class="content-wrapper">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('team')) : ?>
    <section class="about-team" id="team">
        <div class="container">
            <?php if ($title = get_page_data('team_title')): ?>
                <div class="content-wrapper center-content">
                    <?php echo $title; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php while (have_rows('team')) : the_row();
                    $title = get_sub_field('name'); ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="item">
                            <?php if ($image = get_sub_field('image')): ?>
                                <div class="image">
                                    <?php get_image($image, 'full-image'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="content">
                                <h4><?php echo $title; ?></h4>
                                <?php if ($designation = get_sub_field('designation')): ?>
                                    <h6><?php echo $designation; ?></h6>
                                <?php endif; ?>
                                <?php if ($content = get_sub_field('content')): ?>
                                    <p><?php echo $content; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php if ($gallery = get_page_data('gallery')) : ?>
    <section class="about-office-gallery">
        <div class="container">

            <?php if ($title = get_page_data('office_title')): ?>
                <div class="content-wrapper center-content">
                    <?php echo $title; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php foreach ($gallery as $image): ?>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-3">
                        <div class="gallery-thumb">
                            <?php get_image($image, 'full-image'); ?>
                            <a href="<?php echo wp_get_attachment_url($image); ?>" class="full-link" data-fancybox="gallery"></a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
<?php endif; ?>

<?php if ($content = get_page_data('cta_content')) : ?>
    <section class="home-cta">
        <div class="container">
            <div class="inner">
                <?php get_image(get_page_data('cta_image'), 'full-image'); ?>
                <div class="content-wrapper">
                    <?php echo $content; ?>
                    <?php get_theme_link(get_theme_option('appointment_link'), 'theme-btn'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>