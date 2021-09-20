<?php 
	

	$footer_copyright = get_field('footer_copyright', 'option');
?>

<footer class="footer">
	<div class="grid-x grid-container align-center">
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
			<div class="footer__copyright cell small-11 medium-6 text-center">
				<?= $footer_copyright; ?>
			</div>
		<?php endif; ?>
	</div>
</footer>