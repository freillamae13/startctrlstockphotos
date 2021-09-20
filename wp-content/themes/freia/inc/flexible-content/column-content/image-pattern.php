<?php $no_of_columns = get_sub_field('no_of_columns'); ?>

<div class="column-content__ip cell small-11 <?= $large; ?>">
	<div class="column-content__ip-items grid-x align-center">
		<?php
			if ( have_rows('column_items') ) : while ( have_rows('column_items') ) : the_row();
				$image = acf_get_image( get_sub_field('image') );

				$title = [
					'text' => get_sub_field('title'),
					'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
				];
		?>
			<div class="column-content__ip-item cell small-12 medium-6 large-<?= $no_of_columns; ?> text-center">
				<?php if ( $image ) : ?>
					<div class="column-content__ip-item-image">
						<div class="column-content__ip-item-pattern">
							<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/column-image-pattern.png" alt="Coumn Content Pattern">
						</div>
						
						<picture>
							<source media="(min-width: 1440px)" data-srcset="<?= $image['sizes']['image_size_339']; ?>">
							<source media="(min-width: 1366px)" data-srcset="<?= $image['sizes']['image_size_319']; ?>">
							<source media="(min-width: 1280px)" data-srcset="<?= $image['sizes']['image_size_295']; ?>">
							<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_224']; ?>">
							<source media="(min-width: 768px)" data-srcset="<?= $image['sizes']['image_size_292']; ?>">
							<source media="(min-width: 320px)" data-srcset="<?= $image['sizes']['image_size_339']; ?>">
							<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
						</picture>
					</div>
				<?php endif; ?>

				<?php if ( $title['text'] ) : ?>
					<<?= $title['html_tag']; ?> class="column-content__ip-item-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
				<?php endif; ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>