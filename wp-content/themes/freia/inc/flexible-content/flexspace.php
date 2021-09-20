<?php
	$backgroundColor = '';
	$prefix = 'margin';
	
	if ( get_sub_field('flexspace_enable_background_color') && get_sub_field('flexspace_background_color') ) :
		$prefix = 'padding';
		$backgroundColor = 'background-color: ' . get_sub_field('flexspace_background_color');
	endif;

	if ( have_rows('flexspace') ) : while ( have_rows('flexspace') ) : the_row();

		$visibility = get_sub_field('visibility');
		$margin_top = get_sub_field('margin_top');
		$margin_bottom = get_sub_field('margin_bottom');

		if ( $margin_top ) :
			$margin_top_style = $prefix . '-top: ' . $margin_top . 'rem;';
		else :
			$margin_top_style = '';
		endif;

		if ( $margin_bottom ) :
			$margin_bottom_style = $prefix . '-bottom: ' . $margin_bottom . 'rem;';
		else :
			$margin_bottom_style = '';
		endif;

?>
	<div class="flexspace <?php echo $visibility; ?>" style="<?php echo $margin_top_style; ?> <?php echo $margin_bottom_style; ?> <?= $backgroundColor; ?>"></div>
<?php endwhile; endif; ?>