<?php $categories = get_terms(array(
    'taxonomy'   => 'category',
    'hide_empty' => false,
)); ?>
<?php if ($categories) : ?>

    <div class="blog-sidebar">
        <a class="theme-btn collapsed sidebar-trigger" data-bs-toggle="collapse" href="#blogFilterCollapse" role="button" aria-expanded="false" aria-controls="blogFilterCollapse">
            Categories <i class="fa-solid fa-chevron-down"></i>
        </a>
        <div class="collapse" id="blogFilterCollapse">
            <?php
                $categoryObj = [];
                foreach ($categories as $category) {
                    if( $category->slug == 'uncategorized' ) {
                        continue;
                    }
                    $categoryObj[] = $category;
                }
            ?>

            <?php if( $categoryObj ) : ?>
                <div class="item categories">
                    <h4>Categories</h4>
                    <ul>
                        <?php foreach ($categoryObj as $category) : ?>
                            <li>
                                <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?><span>(<?php echo $category->count; ?>)</span></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php
            $args = array(
                'post_type'   => 'post',
                'numberposts' => 4,
                'post_status' => 'publish',
                'exclude' => (is_single()) ? get_the_ID() : ''
            );
            if ($recentPosts = wp_get_recent_posts($args)) : ?>
                <div class="item recent-posts">
                    <h4>Recent Posts</h4>
                    <?php foreach ($recentPosts as $post) : ?>
                        <div class="post">
                            <div class="image">
                                <?php if ($thumbnail = get_the_post_thumbnail($post['ID'], 'full', array('class' => 'full-image'))): ?>
                                    <?php echo $thumbnail; ?>
                                <?php else: ?>
                                    <?php get_image(get_theme_option('default_blog_image'), 'full-image'); ?>
                                <?php endif; ?>
                            </div>
                            <div class="content">
                                <h5><?php echo $post['post_title'] ?></h5>
                                <p><?php echo get_the_date('F j, Y', $post['ID']); ?></p>
                            </div>
                            <a href="<?php echo get_permalink($post['ID']) ?>" class="full-link"></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata(); ?>