<div class="blog-item">
    <div class="image">
        <?php if (get_the_post_thumbnail_url()): ?>
            <?php the_post_thumbnail('full', array('class' => 'full-image')); ?>
        <?php else: ?>
            <?php get_image(get_theme_option('default_blog_image'), 'full-image'); ?>
        <?php endif; ?>
    </div>
    <p class="date"><?php echo get_the_date('F d, Y', get_the_ID()); ?></p>
    <h3><?php the_title(); ?></h3>
    <?php if ($excerpt = get_the_excerpt()): ?>
        <p class="excerpt"><?php echo wp_trim_words($excerpt, 20, '...'); ?></p>
    <?php endif; ?>
    <a href="<?php the_permalink(); ?>" class="full-link"></a>
</div>