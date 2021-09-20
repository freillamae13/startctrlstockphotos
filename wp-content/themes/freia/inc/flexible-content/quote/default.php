<?php
	$image = acf_get_image( get_sub_field('image') );
	$content = get_sub_field('content');
	$name = get_sub_field('name');
?>

<div class="quote__d cell small-11 large-10">
	<div class="grid-x align-center align-middle">
		<div class="quote__d-image cell small-12 large-6">
			<?php if ( $image ) : ?>
				<picture>
					<source media="(min-width: 1440px)" data-srcset="<?= $image['sizes']['image_size_569']; ?>">
					<source media="(min-width: 1366px)" data-srcset="<?= $image['sizes']['image_size_539']; ?>">
					<source media="(min-width: 1280px)" data-srcset="<?= $image['sizes']['image_size_503']; ?>">
					<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_396']; ?>">
					<source media="(min-width: 320px)" data-srcset="<?= $image['sizes']['image_size_704']; ?>">
					<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
				</picture>
			<?php endif; ?>
		</div>

		<div class="quote__d-content cell small-12 large-6">
			<?php if ( $content ) : ?>
				<div class="quote__d-text">
					<?= $content; ?>
				</div>
			<?php endif; ?>

			<?php if ( $name ) : ?>
				<h2 class="quote__d-name"><?= $name; ?></h2>
			<?php endif; ?>
		</div>
	</div>
</div>