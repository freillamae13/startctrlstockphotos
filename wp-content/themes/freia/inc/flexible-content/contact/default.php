<?php
	$google_maps_embed = get_sub_field('google_maps_embed');
	$form = get_sub_field('form');
?>

<div class="contact__d cell small-11 large-10">
	<div class="grid-x align-center">
		<div class="contact__d-map-address cell small-12 large-6">
			<?php if ( $google_maps_embed ) : ?>
				<div class="contact__d-map">
					<?= $google_maps_embed; ?>

					<div class="contact__d-map-pattern">
						<img src="<?= get_stylesheet_directory_uri(); ?>/assets/images/map-pattern.png" alt="Map Pattern">
					</div>
				</div>
			<?php endif; ?>

			<?php if ( have_rows('address_items') ) : ?>
				<div class="contact__d-address">
					<?php 
						while ( have_rows('address_items') ) : the_row(); 
							$icon_class = get_sub_field('icon_class');
							$content = get_sub_field('content');
					?>
						<div class="contact__d-address-item">
							<?php if ( $icon_class ) : ?>
								<div class="contact__d-address-item-icon">
									<i class="<?= $icon_class; ?>"></i>
								</div>
							<?php endif; ?>

							<?php if ( $content ) : ?>
								<div class="contact__d-address-item-text">
									<?= $content; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="contact__d-form cell small-12 large-6">
			<?= $form; ?>
		</div>
	</div>
</div>