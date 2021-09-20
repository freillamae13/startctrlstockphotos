<?php
	$title = [
		'text' => get_field('newsletter_title', 'option'),
		'html_tag' => acf_html_tag(get_field('newsletter_title_html_tag', 'option'), 'h1')
	];

	$content = get_field('newsletter_content', 'option');

	$link = [
		'style' => acf_get_btn_style( get_field('newsletter_link_style', 'option') ),
		'image' => acf_get_image( get_field('newsletter_link_image', 'option') ),
		'link' => acf_get_link( get_field('newsletter_link_type', 'option'), get_field('newsletter_custom_link', 'option'), get_field('newsletter_page_link', 'option') ),
		'text' => get_field('newsletter_link_label', 'option'),
		'tab' => acf_open_in_new_tab( get_field('newsletter_open_in_new_tab', 'option') )
	];
?>

<section class="newsletter grid-x grid-container align-center">
	<div class="cell small-12 large-10">
		<div class="newsletter__illustration newsletter__illustration--1">
			<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/newsletter-illustration-1.png" alt="Newsletter Illustration 1">
		</div>

		<div class="newsletter__wrapper">
			<div class="newsletter__wrapper-inner">
				<div class="newsletter__pattern-wrapper">
					<div class="newsletter__pattern newsletter__pattern--left">
						<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/newsletter-pattern-left.png" alt="Newsletter Pattern Left">
					</div>

					<div class="newsletter__pattern newsletter__pattern--right">
						<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/newsletter-pattern-right.png" alt="Newsletter Pattern Right">
					</div>
				</div>

				<div class="grid-x align-middle">
					<div class="newsletter__content cell small-12 large-auto">
						<?php if ( $title['text'] ) : ?>
							<<?= $title['html_tag']; ?> class="newsletter__title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
						<?php endif; ?>

						<?php if ( $content ) : ?>
							<div class="newsletter__text">
								<?= $content; ?>
							</div>
						<?php endif; ?>
					</div>

					<?php if ( $link['text'] || $link['image'] ) : ?>
						<div class="newsletter__link cell small-12 large-shrink">
							<a href="<?= $link['link']; ?>" <?= $link['tab']; ?> class="<?= $link['style']; ?>">
								<?php if ( $link['style'] == 'image' ) : ?>
									<img class="lazy" data-src="<?= $link['image']['url']; ?>" alt="<?= $link['image']['alt']; ?>">
								<?php 
									else : 
										echo $link['text'];
									endif; 
								?>
							</a>
						</div>
					<?php endif; ?>

					<div class="newsletter__illustration newsletter__illustration--3">
						<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/newsletter-illustration-3.png" alt="Newsletter Illustration 3">
					</div>
				</div>
			</div>
		</div>

		<div class="newsletter__illustration newsletter__illustration--2">
			<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/newsletter-illustration-2.png" alt="Newsletter Illustration 2">
		</div>
	</div>
</section>