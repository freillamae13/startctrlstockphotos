<?php
	$content_position = get_sub_field('content_position');
	$image = acf_get_image( get_sub_field('image') );

	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];

	$content = get_sub_field('content');
?>

<div class="photo-content__d cell small-11 large-9">
	<div class="grid-x align-center align-middle <?= ( $content_position == 'left' ) ? 'flex-dir-row-reverse' : '' ?>">
		<div class="photo-content__d-image cell small-12 medium-6 large-5 text-center">
			<?php if ( $image ) : ?>
				<picture>
					<source media="(min-width: 1440px)" data-srcset="<?= $image['sizes']['image_size_450']; ?>">
					<source media="(min-width: 1366px)" data-srcset="<?= $image['sizes']['image_size_426']; ?>">
					<source media="(min-width: 1280px)" data-srcset="<?= $image['sizes']['image_size_400']; ?>">
					<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_320']; ?>">
					<source media="(min-width: 320px)" data-srcset="<?= $image['sizes']['image_size_704']; ?>">
					<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
				</picture>
			<?php endif; ?>
		</div>

		<div class="photo-content__d-content cell medium-7 small-12 large-7">
			<?php if ( $title['text'] ) : ?>
				<<?= $title['html_tag']; ?> class="photo-content__d-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="photo-content__d-text">
					<?= $content; ?>
				</div>
			<?php endif; ?>

			<?php if ( have_rows('icon_list') ) : ?>
				<div class="photo-content__d-il">
					<?php 
						while ( have_rows('icon_list') ) : the_row(); 
							$icon_class = get_sub_field('icon_class');
							$content = get_sub_field('content');
					?>
						<div class="photo-content__d-il-item">
							<?php if ( $icon_class ) : ?>
								<div class="photo-content__d-il-icon">
									<i class="<?= $icon_class; ?>"></i>
								</div>
							<?php endif; ?>

							<?php if ( $content ) : ?>
								<div class="photo-content__d-il-text">
									<?= $content; ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>