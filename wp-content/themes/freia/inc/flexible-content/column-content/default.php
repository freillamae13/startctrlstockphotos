<?php 
	$no_of_columns = get_sub_field('no_of_columns'); 
	$image_size = 'image_size_148';
	

	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];
?>

<div class="column-content__d cell small-11 large-10">
	<div class="column-content__d-items grid-x align-center">
		<?php if ( $title['text'] ) : ?>
			<<?= $title['html_tag']; ?> class="column-content__d-title cell small-12 text-center"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
		<?php endif; ?>

		<?php
			if ( have_rows('column_items') ) : while ( have_rows('column_items') ) : the_row();
				$image = acf_get_image( get_sub_field('image') );

				$title = [
					'text' => get_sub_field('title'),
					'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h3')
				];
			
				$content = get_sub_field('content');
		?>
			<div class="column-content__d-item cell small-12 medium-6 xlarge-<?= $no_of_columns; ?> text-center">
				<?php if ( $image ) : ?>
					<div class="column-content__d-item-image">
						<img class="lazy" data-src="<?= $image['sizes'][$image_size]; ?>" alt="<?= $image['alt']; ?>">
					</div>
				<?php endif; ?>
				<div class="column-content__d-item-content">
					<?php if ( $title['text'] ) : ?>
						<<?= $title['html_tag']; ?> class="column-content__d-item-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
					<?php endif; ?>

					<?php if ( $content ) : ?>
						<div class="column-content__d-item-text">
							<?= $content; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>