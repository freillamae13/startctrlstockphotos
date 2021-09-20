<?php

	function misfit_sc_column_container( $atts, $content = "" ) {
		$atts = shortcode_atts(array(
			'colcount' => ''
		), $atts );

		if($atts['colcount'])
			$col = 'columnbox--' . $atts['colcount'];
		else
			$col = 'columnbox--2';

		$html = '<div class=" columnbox ' . $col . ' container grid-x">' . do_shortcode( sc_anti_wpautop( $content ) ) . '</div>';

		return $html;
	}
	add_shortcode( 'column_container', 'misfit_sc_column_container' );

?>