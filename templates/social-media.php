<div class="social-media-wrapper">
    <?php if($socialLinks = get_social_links()): ?>
        <?php echo implode("", $socialLinks); ?>
    <?php endif; ?>
</div>