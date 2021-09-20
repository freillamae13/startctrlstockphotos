<?php
	$banner_height = get_sub_field('banner_height');
	$banner_height_auto = get_sub_field('banner_height_auto');
?>


		<?php
			if ( have_rows('banner') ) : while ( have_rows('banner') ) : the_row();
				$row_layout = get_row_layout();
				$row_layout_file = str_replace('_', '-', $row_layout);
				$template_part = get_stylesheet_directory() . '/inc/flexible-content/banner/'. $row_layout_file .'.php';
		?>
			<section class="banner <?= ( !$banner_height_auto ) ? 'banner--height-' . $banner_height . ' ' : 'banner--height-auto' ?> <?= $row_layout_file . '-main' ?>">
				<?php require $template_part; ?>
			</section>
			<?php endwhile; endif;?>



