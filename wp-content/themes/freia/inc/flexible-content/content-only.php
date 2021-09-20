<?php 
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

<div class="grid-container content-only">
    <div class="grid-x align-center center-content-wrapper">
		<?php if ( $title['text'] ) : ?>
        	<div class="cell large-10 small-11"><<?= $title['html_tag']; ?> class="content-only__title"><?= $title['text']; ?></<?= $title['html_tag']; ?>></div>
		<?php endif; ?>

		<?php if ( $content ) : ?>
        	<div class="cell large-10 small-11 content-only__body"><?= $content; ?></div>
		<?php endif; ?>

		<?php if ( $link['text'] || $link['image'] ) : ?>
			<div class="content-only__link cell small-10 text-center">
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
</div>