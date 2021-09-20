<?php
	$header_cta = [
		'style' => acf_get_btn_style( get_field('header_cta_link_style', 'option') ),
		'image' => acf_get_image( get_field('header_cta_link_image', 'option') ),
		'link' => acf_get_link( get_field('header_cta_link_type', 'option'), get_field('header_cta_custom_link', 'option'), get_field('header_cta_page_link', 'option') ),
		'text' => get_field('header_cta_link_label', 'option'),
		'tab' => acf_open_in_new_tab( get_field('header_cta_open_in_new_tab', 'option') )
	];
?>

<nav class="slide-menu">
	<ul>
		<?php 
			wp_nav_menu([
				'menu_class' => '',
				'container' => '',
				'items_wrap' => '%3$s',
				'theme_location' => 'header_nav',
			]); 
		?>

		<?php if ( $header_cta['text'] || $header_cta['image'] ) : ?>
			<li class="slide-menu__cta">
				<a href="<?= $header_cta['link']; ?>" <?= $header_cta['tab']; ?> class="<?= $header_cta['style']; ?>">
					<?php if ( $header_cta['style'] == 'image' ) : ?>
						<img src="<?= $header_cta['image']['url']; ?>" alt="<?= $header_cta['image']['alt']; ?>">
					<?php
						else : 
							echo $header_cta['text'];
						endif; 
					?>
				</a>
			</li>
		<?php endif; ?>
	</ul>
</nav>