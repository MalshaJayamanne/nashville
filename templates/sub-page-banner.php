<section class="sub-page-banner">
    <?php if (!is_category() && has_post_thumbnail(get_the_ID())) : ?>
        <?php the_post_thumbnail('full', ['class' => 'full-image']); ?>
    <?php else : ?>
        <?php get_image(get_theme_option('default_banner_image'), 'full-image'); ?>
    <?php endif; ?>
    <div class="container">
        <div class="content-wrapper title-content center-content">
            <?php if (!empty($args['showContent']) && $args['showContent']) : ?>
                <?php echo $args['showContent']; ?>
            <?php elseif (is_category()) : ?>
                <h1 class="mb-0"><?php single_term_title(''); ?></h1>
            <?php else : ?>
                <h1 class="mb-0"><?php the_title(); ?></h1>
            <?php endif; ?>
        </div>
    </div>
</section>