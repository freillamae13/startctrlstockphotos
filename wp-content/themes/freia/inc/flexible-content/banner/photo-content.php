<?php
	$image = acf_get_image( get_sub_field('image') );

	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];

	$content = get_sub_field('content');

	$link = [
		'style' => acf_get_btn_style( get_sub_field('link_style') ),
		'image' => acf_get_image( get_sub_field('link_image') ),
		'link' => acf_get_link( get_sub_field('link_type'), get_sub_field('custom_link'), get_sub_field('page_link') ),
		'text' => get_sub_field('link_label'),
		'tab' => acf_open_in_new_tab( get_sub_field('open_in_new_tab') )
	];
?>

<div class="banner__pc cell small-11 large-12">
	<div class="grid-x align-center align-middle">
		<div class="banner__pc-content cell small-<?= ( $banner_equal_side_padding ) ? '9' : '12' ?> large-6">
			<?php if ( $title['text'] ) : ?>
				<<?= $title['html_tag']; ?> class="banner__pc-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="banner__pc-text">
					<?= $content; ?>
				</div>
			<?php endif; ?>

			<?php if ( $link['text'] || $link['image'] ) : ?>
				<div class="banner__pc-link">
					<a href="<?= $link['link']; ?>" <?= $link['tab']; ?> class="<?= $link['style']; ?>">
						<?php if ( $link['style'] == 'image' ) : ?>
							<img src="<?= $link['image']['url']; ?>" alt="<?= $link['image']['alt']; ?>">
						<?php 
							else : 
								echo $link['text'];
							endif; 
						?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="banner__pc-image cell small-<?= ( $banner_equal_side_padding ) ? '9' : '12' ?> large-6">
			<?php if ( $image ) : ?>
				<picture>
					<?php if ( $banner_equal_side_padding ) : ?>
						<source media="(min-width: 1280px)" data-srcset="<?= $image['sizes']['image_size_426']; ?>">
						<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_326']; ?>">
						<source media="(min-width: 320px)" data-srcset="<?= $image['sizes']['image_size_569']; ?>">
					<?php else : ?>
						<source media="(min-width: 1440px)" data-srcset="<?= $image['sizes']['image_size_436']; ?>">
						<source media="(min-width: 1366px)" data-srcset="<?= $image['sizes']['image_size_598']; ?>">
						<source media="(min-width: 1280px)" data-srcset="<?= $image['sizes']['image_size_560']; ?>">
						<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_448']; ?>">
						<source media="(min-width: 320px)" data-srcset="<?= $image['sizes']['image_size_704']; ?>">
					<?php endif; ?>
					<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
				</picture>
			<?php endif; ?>
		</div>
	</div>
</div>