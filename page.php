<?php get_header(); ?>

<?php get_template_part('templates/sub-page', 'banner'); ?>

<?php if (get_the_content()) : ?>
    <section class="default-content-section">
        <div class="container">
            <div class="content-wrapper"><?php the_content(); ?></div>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part('templates/page', 'layouts'); ?>

<?php get_footer(); ?>