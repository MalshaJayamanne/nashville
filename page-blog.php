<?php /* Template Name: Blog */ ?>
<?php get_header(); ?>

<?php get_template_part('templates/sub-page', 'banner'); ?>

<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type'         => 'post',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'posts_per_page'    => get_option('posts_per_page') ?: 12,
    'paged'             => $paged,
);
$blog = new WP_Query($args);
if ($blog->have_posts()) :
?>

    <section class="blog-section">
        <div class="container">
            <div class="row blog-listing">
                <div class="col-sm-12 col-lg-3">
                    <?php get_template_part('templates/blog', 'sidebar'); ?>
                </div>
                <div class="col-sm-12 col-lg-9">
                    <div class="row">
                        <?php while ($blog->have_posts()) : $blog->the_post(); ?>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <?php get_template_part('templates/blog', 'item'); ?>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>

                    <div class="pagination-wrapper">
                        <?php
                        $big = 999999999; // need an unlikely integer
                        echo paginate_links(array(
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => $paged,
                            'total' => $blog->max_num_pages,
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif; ?>

<?php get_footer(); ?>