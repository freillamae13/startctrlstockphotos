<?php
    /* Template Name: Privacy Policy */
    get_header();
?>

<?php

if ( have_rows('privacy_policy') ) : while ( have_rows('privacy_policy') ) : the_row();
	$row_layout = get_row_layout();
	$row_layout_file = str_replace('_', '-', $row_layout);
	$template_part = get_stylesheet_directory() . '/inc/flexible-content/'. $row_layout_file .'.php';

	require $template_part;
endwhile; endif;

get_footer(); ?>