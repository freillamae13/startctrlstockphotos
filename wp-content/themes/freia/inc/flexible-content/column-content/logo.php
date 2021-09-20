<?php
	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];
?>

<div class="column-content__l cell small-11 large-10">
	<div class="column-content__l-items grid-x align-center">
		<?php if ( $title['text'] ) : ?>
			<<?= $title['html_tag']; ?> class="column-content__l-title cell small-12 text-center"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
		<?php endif; ?>

		<?php if ( have_rows('row_items') ) : while ( have_rows('row_items') ) : the_row(); ?>
			<div class="column-content__l-row cell small-12">
				<div class="grid-x align-center align-middle">
					<?php
						if ( have_rows('column_items') ) : while ( have_rows('column_items') ) : the_row();
							$image = acf_get_image( get_sub_field('image') );
							
							$link = [
								'link' => acf_get_link( get_sub_field('link_type'), get_sub_field('custom_link'), get_sub_field('page_link') ),
								'tab' => acf_open_in_new_tab( get_sub_field('open_in_new_tab') )
							];
					?>
						<div class="column-content__l-item cell small-12 medium-shrink text-center">
							<a href="<?= $link['link']; ?>" <?= $link['tab']; ?>>
								<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
							</a>
						</div>
					<?php endwhile; endif; ?>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>