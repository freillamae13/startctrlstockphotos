<?php 
	$no_of_columns = get_sub_field('no_of_columns'); 

	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];
?>

<div class="column-content__n cell small-11 large-10">
	<div class="column-content__n-items grid-x align-center">
		<?php if ( $title['text'] ) : ?>
			<<?= $title['html_tag']; ?> class="column-content__n-title cell small-12 text-center"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
		<?php endif; ?>

		<?php
			$counter = 1;
			if ( have_rows('column_items') ) : while ( have_rows('column_items') ) : the_row();
				$image = acf_get_image( get_sub_field('image') );

				$title = [
					'text' => get_sub_field('title'),
					'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
				];
			
				$content = get_sub_field('content');
		?>
			<div class="column-content__n-item cell small-12 medium-6 large-<?= $no_of_columns; ?> text-center">
				<div class="column-content__n-item-number"><?= $counter; ?></div>
				
				<?php if ( $title['text'] ) : ?>
					<<?= $title['html_tag']; ?> class="column-content__n-item-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
				<?php endif; ?>
			</div>
		<?php $counter++; endwhile; endif; ?>
	</div>
</div>