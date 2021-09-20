<section class="team">
	<div class="grid-x align-center grid-container">
		<?php
			if ( have_rows('team') ) : while ( have_rows('team') ) : the_row();
				$row_layout = get_row_layout();
				$row_layout_file = str_replace('_', '-', $row_layout);
				$template_part = get_stylesheet_directory() . '/inc/flexible-content/team/'. $row_layout_file .'.php';

				require $template_part;
			endwhile; endif;
		?>
	</div>
</section>