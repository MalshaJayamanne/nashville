<?php if (have_rows('page_content')) :
    $accordionKey = 1;
    while (have_rows('page_content')) : the_row(); ?>
        <?php if ((get_row_layout() == 'default_content') && ($content = get_sub_field('content'))) :
            $image = get_sub_field('image');
            $linkType = get_sub_field('link_type');
            $link = get_sub_field('link');
            $imagePosition = get_sub_field('image_position');
            $keepImageSize = get_sub_field('keep_image_size');
            $sectionClasses = [];
            $sectionClasses[] = ($image) ? 'image' : '';
            $sectionClasses[] = ($imagePosition == 1) ? 'left' : 'right';
            $sectionClasses[] = ($keepImageSize) ? 'original-image' : '';
            $sectionClasses[] = (get_sub_field('content_padding')) ? 'content-padding' : '';
            $sectionClasses[] = (get_sub_field('center_content')) ? 'center-content' : '';
            $sectionClasses[] = (get_sub_field('remove_top_margin')) ? 'mt-0' : '';
            $sectionClasses[] = (get_sub_field('styled_list')) ? 'styled-ul' : '';

            switch (get_sub_field('background_type')) {
                case 2:
                    $sectionClasses[] = 'bg-color-light';
                    break;

                case 3:
                    $sectionClasses[] = 'bg-color-dark';
                    break;

                case 4:
                    $sectionClasses[] = 'bg-gradient-light';
                    break;
            }

            $imageClass = (!$keepImageSize) ? 'full-image' : '';
        ?>
            <section class="default-content-section <?php echo implode(" ", array_filter($sectionClasses)); ?>">
                <div class="container">
                    <div class="inner-bg">
                        <div class="row <?php echo ($image && ($imagePosition == 2)) ? 'flex-row-reverse' : ''; ?>">
                            <?php if ($image) : ?>
                                <div class="col-sm-12 col-lg-5">
                                    <div class="full-image-parent"><?php get_image($image, $imageClass); ?></div>
                                </div>
                            <?php endif; ?>
                            <div class="col-sm-12 col-lg-<?php echo ($image) ? '7' : '12'; ?>">
                                <div class="content-wrapper">
                                    <?php echo $content; ?>
                                    <?php if (($linkType == 1) && $link) : ?>
                                        <?php get_theme_link($link, 'theme-btn secondary'); ?>
                                    <?php elseif (($linkType == 2) ): ?>
                                        <?php echo get_appointment_link('theme-btn secondary'); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif (get_row_layout() == 'content_boxes'):
            $bgImage = get_sub_field('bg_image');
            $title = get_sub_field('title');
            $link = get_sub_field('link');
            $sectionClasses = [];
            $sectionClasses[] = (get_sub_field('text_align') == 2) ? 'text-left' : '';
            $sectionClasses[] = $bgImage ? 'has-bg' : '';
        ?>
            <?php if (have_rows('contents')) : ?>
                <section class="default-content-boxes <?php echo implode(" ", array_filter($sectionClasses)); ?>">
                    <?php get_image($bgImage, 'full-image bg-image'); ?>
                    <div class="container">
                        <?php if ($title): ?>
                            <div class="content-wrapper center-title">
                                <?php echo $title; ?>
                                
                                <?php get_theme_link($link, 'theme-btn secondary'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <?php while (have_rows('contents')): the_row();
                                $image = get_sub_field('image');
                                $link = get_sub_field('link');
                                $width = get_sub_field('width');

                                $colClass = 'col-md-6 col-lg-' . $columnsCount;
                                switch ($width) {
                                    case 1: // 33%
                                        $colClass = 'col-sm-12 col-md-12 col-lg-4';
                                        break;
                                    case 2: // Half
                                        $colClass = 'col-sm-12 col-lg-6';
                                        break;
                                    case 3: // Full
                                        $colClass = 'col-sm-12 ';
                                        break;
                                    case 4: // Quarter
                                        $colClass = 'col-sm-12 col-md-6 col-lg-3';
                                        break;
                                }
                            ?>
                                <div class="col-sm-12 <?php echo $colClass; ?>">
                                    <div class="item <?php echo ($image) ? 'has-image' : 'no-image'; ?>">
                                        <div class="top">
                                            <?php if ($image): ?>
                                                <div class="image">
                                                    <?php get_image($image, 'full-image'); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="content">
                                                <h4 class="title"><?php echo nl2br(get_sub_field('title')); ?></h4>
                                                <?php if ($description = get_sub_field('description')): ?>
                                                    <div class="content-wrapper default">
                                                        <?php echo $description; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <?php get_theme_link($link, 'theme-btn secondary'); ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

        <?php elseif (get_row_layout() == 'gallery' && ($gallery = get_sub_field('gallery'))): ?>
            <section class="default-content-gallery">
                <div class="container">
                    <?php if ($title = get_sub_field('title')): ?>
                        <div class="content-wrapper center-content"><?php echo $title; ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <?php foreach ($gallery as $image): ?>
                            <div class="col-sm-12 col-md-4 col-lg-3">
                                <div class="gallery-thumb">
                                    <?php get_image($image, 'full-image'); ?>
                                    <a href="<?php echo wp_get_attachment_url($image); ?>" class="full-link" data-fancybox="gallery"></a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>

        <?php elseif (get_row_layout() == 'accordion'): ?>
            <?php
            $title = get_sub_field('title');
            if (have_rows('content')): ?>
                <section class="default-content-accordion">
                    <div class="container">
                        <?php if ($title): ?>
                            <div class="content-wrapper center-content"><?php echo $title; ?></div>
                        <?php endif; ?>

                        <div class="accordion theme-accordion" id="accordion<?php echo $accordionKey; ?>">
                            <?php
                            $key = 1;
                            while (have_rows('content')): the_row(); ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#item-<?php echo $accordionKey . '-' . $key; ?>" aria-expanded="false" aria-controls="item-<?php $key; ?>">
                                            <?php the_sub_field('title'); ?>
                                        </button>
                                    </h2>
                                    <div id="item-<?php echo $accordionKey . '-' . $key; ?>" class="accordion-collapse collapse" data-bs-parent="#accordion<?php echo $accordionKey; ?>">
                                        <div class="accordion-body">
                                            <div class="content-wrapper">
                                                <?php the_sub_field('content'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $key++;
                            endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php $accordionKey++;
            endif; ?>

        <?php elseif ((get_row_layout() == 'cta_section') && ($content = get_sub_field('content'))):
            $image = get_sub_field('bg_image');
            $linkType = get_sub_field('link_type');
            $sectionClasses = [];
            $sectionClasses[] = ($image) ? 'bg-image' : '';
        ?>
            <section class="default-content-cta <?php echo implode(" ", array_filter($sectionClasses)); ?>">
                <div class="container">
                    <div class="inner">
                        <?php get_image($image, 'full-image'); ?>
                        <div class="content-wrapper center-content white-heading">
                            <?php echo $content; ?>
                            <?php if (($linkType == 1) && ($link = get_sub_field('link'))) : ?>
                                <?php get_theme_link($link, 'theme-btn secondary'); ?>
                            <?php elseif (($linkType == 2) ): ?>
                                <?php echo get_appointment_link('theme-btn secondary'); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php elseif ((get_row_layout() == 'financing_options')):
            $title = get_sub_field('title');
            $link = get_sub_field('link');
        ?>
            <?php if (have_rows('financing_options')) : ?>
                <section class="default-content-finance">
                    <div class="container">

                        <?php if ($title): ?>
                            <div class="content-wrapper center-content">
                                <?php echo $title; ?>

                                <?php get_theme_link($link, 'theme-btn secondary'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="options">
                            <?php while (have_rows('financing_options')): the_row(); ?>
                                <div class="item">
                                    <?php get_image(get_sub_field('logo'), 'full-image'); ?>
                                    <?php if ($link = get_sub_field('link')) : ?>
                                        <a href="<?php echo $link; ?>" class="full-link" target="_blank"></a>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

        <?php elseif (get_row_layout() == 'video_section'): ?>
            <?php
            $title = get_sub_field('title');
            $videoType = get_sub_field('video_type');
            $videoColumns = get_sub_field('video_columns');

            $videoTypeClass = [1 => 'popup', 2 => 'embed', 3 => 'upload'];
            $sectionClasses = array_filter([$videoTypeClass[$videoType] ?? '']);

            // Optimize column class assignment
            $colClasses = [
                1 => 'col-sm-12 col-md-10 col-lg-8', // Full
                2 => 'col-sm-12 col-lg-6',           // Half
                3 => 'col-sm-12 col-md-6 col-lg-4'   // 33%
            ];

            $colClass = $colClasses[$videoColumns] ?? 'col-sm-12 col-md-10 col-lg-9';

            if (have_rows('videos')): ?>
                <section class="default-content-videos <?php echo implode(" ", array_filter($sectionClasses)); ?>">
                    <div class="container">
                        <?php if ($title): ?>
                            <div class="content-wrapper center-content"><?php echo $title; ?></div>
                        <?php endif; ?>

                        <div class="row">
                            <?php while (have_rows('videos')): the_row();
                                $videoField = ($videoType == 1) ? 'video_url' : 'upload_video';
                                $videoUrl = get_sub_field($videoField);
                                $videoPoster = get_sub_field('video_poster');
                                $videoCode = get_sub_field('video_code');
                            ?>
                                <div class="<?php echo esc_attr($colClass); ?>">
                                    <div class="item">
                                        <div class="video">
                                            <?php if ($videoType == 2): ?>
                                                <?php echo $videoCode; ?>
                                            <?php else: ?>
                                                <?php get_image($videoPoster, 'full-image'); ?>
                                                <a href="<?php echo esc_url($videoUrl); ?>" class="full-link" <?php echo ($videoType == 1) ? 'data-fancybox="service"' : ''; ?>></a>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($title = get_sub_field('title')): ?>
                                            <h5><?php echo $title; ?></h5>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

        <?php elseif ((get_row_layout() == 'rounded_content_section') && ($content = get_sub_field('content'))):
            $imagePosition = get_sub_field('image_position');
            $formShortcode = get_sub_field('contact_form');
            $contentWidth = get_sub_field('content_width');
            $linkType = get_sub_field('link_type');
            $link = get_sub_field('link');
            $sectionClasses = [];
            $sectionClasses[] = ($imagePosition == 1) ? 'left' : 'right';
            $sectionClasses[] = ($formShortcode) ? 'has-form' : '';
            $sectionClasses[] = ($$contentWidth == 1) ? 'content-50' : 'content-45';
            $sectionClasses[] = (get_sub_field('center_content')) ? 'center-content' : '';
        ?>
            <section class="default-rounded-section service-rounded-section <?php echo implode(" ", array_filter($sectionClasses)); ?>">
                <div class="container">
                    <div class="inner">
                        <?php if ($image = get_sub_field('image')): ?>
                            <div class="side-image"><?php get_image($image, 'full-image'); ?></div>
                        <?php endif; ?>
                        <div class="content">
                            <div class="content-wrapper">
                                <?php echo $content; ?>
                                <?php if (($linkType == 1) && $link) : ?>
                                    <?php get_theme_link($link, 'theme-btn secondary'); ?>
                                <?php elseif (($linkType == 2) ): ?>
                                    <?php echo get_appointment_link('theme-btn secondary'); ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($formShortcode): ?>
                                <div class="contact-form">
                                    <?php echo do_shortcode($formShortcode); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

        <?php endif; ?>
<?php endwhile;
endif; ?>