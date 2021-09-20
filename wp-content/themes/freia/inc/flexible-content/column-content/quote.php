<?php 
	$no_of_columns = get_sub_field('no_of_columns'); 

	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];
?>

<div class="column-content__q cell small-11">
	<div class="column-content__q-items grid-x align-center">
		<?php if ( $title['text'] ) : ?>
			<<?= $title['html_tag']; ?> class="column-content__q-title cell small-12 text-center"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
		<?php endif; ?>

		<?php
			$counter = 1;
			if ( have_rows('column_items') ) : while ( have_rows('column_items') ) : the_row();
				$content = get_sub_field('content');
		?>
			<div class="column-content__q-item cell small-12 medium-6 large-<?= $no_of_columns; ?>">
				<div class="column-content__q-item-wrapper">
					<?php if ( $content ) : ?>
						<div class="column-content__q-item-quote">
							<?= $content; ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		<?php $counter++; endwhile; endif; ?>
	</div>
</div>