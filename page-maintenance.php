<?php /* Template Name: Maintenance */ ?>

<?php get_header(); ?>

<main>
	<section class="default-content-section maintenance">
		<div class="container">
			<?php if (get_the_content()) : ?>
				<div class="content-wrapper"><?php the_content(); ?></div>
			<?php else : ?>
				<h1>Site Undergoing Maintenance</h1>
			<?php endif; ?>
		</div>
	</section>
</main>

<style>
	footer,
	header {
		display: none;
	}

	.maintenance h1 {
		text-align: center;
		font-size: 36px;
		font-family: sans-serif;
		padding: 40px 0;
	}
</style>

<?php get_footer();
