<?php
	$background_image = acf_get_image( get_sub_field('background_image') );

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
<div class="banner__cc" style="background-image:url(<?= $background_image['url']; ?>);">
	<div class="grid-x align-center align-middle grid-container">
		<div class="banner__cc-grid cell small-12 large-12">
			<div class="banner__cc-content text-center">
				<?php if ( $title['text'] ) : ?>
					<<?= $title['html_tag']; ?> class="banner__cc-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
				<?php endif; ?>

				<?php if ( $content ) : ?>
					<div class="banner__cc-text">
						<?= $content; ?>
					</div>
					<?php if ( $link['text'] || $link['image'] ) : ?>
						<div class="banner__cc-link">
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
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>