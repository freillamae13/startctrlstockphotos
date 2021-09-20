<section class="photo-content grid-x grid-container align-center align-middle">
	<?php
		if ( have_rows('photo_content') ) : while ( have_rows('photo_content') ) : the_row();
			$row_layout = get_row_layout();
			$row_layout_file = str_replace('_', '-', $row_layout);
			$template_part = get_stylesheet_directory() . '/inc/flexible-content/photo-content/'. $row_layout_file .'.php';

			require $template_part;
		endwhile; endif;
	?>
</section>