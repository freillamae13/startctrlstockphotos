<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter( 'show_admin_bar', '__return_false' );

register_nav_menus(array(
	'header_nav' => __( 'Header Navigation', 'misfit' ),
	'footer_nav' => __( 'Footer Navigation', 'misfit' ),
	// 'footer_approach' => __( 'Footer Approach Nav', 'misfit' ),
	// 'footer_platform' => __( 'Footer Platform Nav', 'misfit' ),
	// 'footer_company' => __( 'Footer Company Nav', 'misfit' ),
	// 'footer_engage' => __( 'Footer Engage Nav', 'misfit' ),
	// 'footer_bottom_nav' => __( 'Footer Bottom Nav', 'misfit' ),
));