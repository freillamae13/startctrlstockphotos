<?php

	function misfit_sc_bullet( $atts, $content = "" ) {
		$atts = shortcode_atts(array(
			'column' => '',
		), $atts );

		if ( $atts['column'] == 2 ) {
			$class = 'bullet--2-col';
		}

		return '<div class="bullet ' . $class . '">'. do_shortcode( sc_anti_wpautop( $content ) ) .'</div>';
	}
	add_shortcode( 'bullet', 'misfit_sc_bullet' );

?>