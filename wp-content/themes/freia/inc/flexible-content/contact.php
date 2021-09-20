<section class="contact grid-x grid-container align-center align-middle">
	<?php
		if ( have_rows('contact') ) : while ( have_rows('contact') ) : the_row();
			$row_layout = get_row_layout();
			$row_layout_file = str_replace('_', '-', $row_layout);
			$template_part = get_stylesheet_directory() . '/inc/flexible-content/contact/'. $row_layout_file .'.php';

			require $template_part;
		endwhile; endif;
	?>
</section>