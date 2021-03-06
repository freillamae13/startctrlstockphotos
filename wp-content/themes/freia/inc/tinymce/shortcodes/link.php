<?php

	function misfit_sc_link( $atts, $content = "" ) {
		$atts = shortcode_atts(array(
			'link_url' => '',
			'link_text' => '',
			'open_in_new_tab' => '',
			'popup_type' => '',
			'link_style' => ''
		), $atts );

		// OPEN IN NEW TAB

		$open_in_new_tab = '';
		if ( $atts['open_in_new_tab'] == 'true' ) :
			$open_in_new_tab = 'target="_blank"';
		endif;

		// LINK STYLE
		$link_style = '';
		if ( $atts['link_style'] == 'red-underline' ) :
			$link_style = 'link--underline';
		endif;

		$html = '<a ' . $open_in_new_tab . ' class="link ' . $link_style . ' ' . $atts['popup_type'] . '" href="' . $atts['link_url'] . '">' . $atts['link_text'] . '</a>';

		return $html;
	}
	add_shortcode( 'link', 'misfit_sc_link' );