<?php /* Template Name: Contact */ ?>
<?php get_header(); ?>

<?php get_template_part('templates/sub-page', 'banner'); ?>

<?php
$googleMap = get_theme_option('google_map');
$content = get_page_data('top_content');
if ($googleMap || $content): ?>
    <section class="contact-top">
        <div class="container">
            <div class="row">
                <?php if ($googleMap): ?>
                    <div class="col-sm-12 col-lg-<?php echo ($content) ? '7' : '12'; ?>">
                        <div class="map">
                            <?php echo $googleMap; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($content): ?>
                    <div class="col-sm-12 col-lg-<?php echo ($googleMap) ? '5' : '12'; ?>">
                        <div class="content-wrapper">
                            <?php echo $content; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="contact-us">
    <div class="container">
        <div class="left">
            <?php if ($content = get_page_data('contact_left_content')): ?>
                <div class="content-wrapper"><?php echo $content; ?></div>
            <?php endif; ?>
            <div class="contact-details">
                <?php if ($telephone = get_theme_option('telephone')) : ?>
                    <div class="contact-row">
                        <i class="fa-solid fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>
                                <?php
                                $telephone = explode(',', $telephone);
                                if (is_array($telephone)) : ?>
                                    <?php foreach ($telephone as $item) : ?>
                                        <a href="tel:<?php echo trim($item); ?>"><?php echo trim($item); ?></a><br>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a href="tel:<?php echo trim($telephone); ?>"><?php echo trim($telephone); ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($email = get_theme_option('email')) : ?>
                    <div class="contact-row">
                        <i class="fa-solid fa-at"></i>
                        <div>
                            <h4>Email</h4>
                            <p>
                                <?php
                                $email = explode(',', $email);
                                if (is_array($email)) : ?>
                                    <?php foreach ($email as $item) : ?>
                                        <a href="mailto:<?php echo trim($item); ?>"><?php echo trim($item); ?></a><br>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <a href="mailto:<?php echo trim($email); ?>"><?php echo trim($email); ?></a>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if ($address = get_theme_option('address')) : ?>
                    <div class="contact-row">
                        <i class="fa-solid fa-map-marker-alt"></i>
                        <div>
                            <h4>Address</h4>
                            <p><?php echo nl2br($address); ?></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($formShortcode = get_page_data('contact_form')) : ?>
            <div class="contact-form">
                <?php if ($title = get_page_data('contact_form_title')): ?>
                    <div class="content-wrapper default"><?php echo $title; ?></div>
                <?php endif; ?>
                <?php echo do_shortcode($formShortcode); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>