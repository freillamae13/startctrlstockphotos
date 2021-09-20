<div class="team__d cell small-11 large-10">
	<div class="team__d-items grid-x">
		<?php 
			if ( have_rows('column_items') ) : while ( have_rows('column_items') ) : the_row(); 
				$image = acf_get_image( get_sub_field('image') );
				$name = get_sub_field('name');
				$description = get_sub_field('description');
		?>
			<div class="team__d-item cell small-12 medium-6 xlarge-4 text-center">
				<?php if ( $image ) : ?>
					<div class="team__d-item-image">
						<div class="team__d-item-image-wrapper">
							<img class="lazy" data-src="<?= $image['sizes']['image_size_227']; ?>" alt="<?= $image['alt']; ?>">
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $name ) : ?>
					<h2 class="team__d-item-name"><?= $name; ?></h2>
				<?php endif; ?>

				<?php if ( $description ) : ?>
					<div class="team__d-item-description">
						<?= $description; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>