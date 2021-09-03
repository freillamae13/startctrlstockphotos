<?php
	$footer_logo = get_field('footer_logo', 'option');
	$footer_copyright = get_field('footer_copyright', 'option');
?>

<footer class="footer">
	<div class="grid-x grid-container align-center">
		<?php if ( $footer_logo ) : ?>
			<div class="footer__logo cell small-11 text-center">
				<a href="<?= home_url(); ?>">
					<picture>
						<source media="(min-width: 768px)" data-srcset="<?= $footer_logo['sizes']['image_size_142']; ?>">
						<source media="(min-width: 320px)" data-srcset="<?= $footer_logo['sizes']['image_size_284']; ?> 2x">
						<img class="lazy" data-src="<?= $footer_logo['url']; ?>" alt="<?= $footer_logo['alt']; ?>">
					</picture>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( have_rows('social_items', 'option') ) : ?>
			<ul class="footer__social cell small-11 text-center">
				<?php 
					while ( have_rows('social_items', 'option') ) : the_row(); 
						$icon_class = get_sub_field('icon_class');
						$link = get_sub_field('link');
				?>
					<li>
						<a href="<?= $link; ?>" target="_blank"><i class="<?= $icon_class; ?>"></i></a>
					</li>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>

		<?php if ( $footer_copyright ) : ?>
			<div class="footer__copyright cell small-11 medium-8 text-center">
				<?= $footer_copyright; ?>
			</div>
		<?php endif; ?>
	</div>
</footer>