<?php get_header(); ?>

<?php get_template_part('templates/sub-page', 'banner'); ?>

<?php if (get_the_content()) : ?>
    <section class="default-content-section">
        <div class="container">
            <div class="row blog-listing">
                <div class="col-sm-12 col-lg-3">
                    <?php get_template_part('templates/blog', 'sidebar'); ?>
                </div>
                <div class="col-sm-12 col-lg-9">
                    <div class="content-wrapper default"><?php the_content(); ?></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>