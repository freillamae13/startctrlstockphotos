<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WKZWS86');</script>
	<!-- End Google Tag Manager -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<title>
		<?php wp_title(); ?>
	</title>

	<?php
		echo '<style>';
		require get_stylesheet_directory() . '/assets/css/critical.css.php';
		echo '</style>';
	?>

	<link rel="preload" id="style" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/style.css" as="style" media="screen" crossorigin="anonymous">
	<link rel="shortcut icon" href="<?= get_stylesheet_directory_uri(); ?>/assets/images/favicon.png">

	<script>
		document.addEventListener("DOMContentLoaded", function () {
			var this_preload = document.querySelectorAll('link[rel="preload"][as="style"]');
			for ( var i = 0; i < this_preload.length; i++ ) {
				var preload = this_preload[i];
				preload.rel = 'stylesheet';
			}
			this_preload.forEach(function(preload) { //IE 11: forEach Object doesn't support this property or method
				preload.rel = 'stylesheet';
			});
		});

		var url_vars = {
			'get_stylesheet_directory_uri': '<?= get_stylesheet_directory_uri(); ?>',
			'ajax_url' : '<?= admin_url( 'admin-ajax.php' ); ?>'
		};
	</script>

	<noscript>
		<link rel="preload" type="text/css" media="screen" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/style.css">
		<link rel="preload" type="text/css" media="screen" href="<?= get_stylesheet_directory_uri(); ?>/assets/css/components.css">
	</noscript>

	<?php 
		wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WKZWS86"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->	
	<?php 
		require get_stylesheet_directory() . '/inc/components/header.php';
		require get_stylesheet_directory() . '/inc/components/slide-menu.php'; 
	?>

	<main class="wrapper">