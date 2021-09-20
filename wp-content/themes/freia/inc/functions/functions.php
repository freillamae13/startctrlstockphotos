<?php

// FUNCTION: IS_SUBPAGE()

function is_subpage() {
	global $post;
	if ( is_page() && $post->post_parent ) {
		return $post->post_parent;
	} else { return false; }
}


function hexrgb($hexstr) {
	$int = hexdec($hexstr);
	return array("red" => 0xFF & ($int >> 0x10), "green" => 0xFF & ($int >> 0x8), "blue" => 0xFF & $int);
}


// WORDPRESS IMAGE TO ACF GET IMAGE

function wp_image_to_acf_get_image($thumbnail_id) {

	$image_array = false;
	$thumbnail_id = (int)$thumbnail_id;

	if ( $thumbnail_id !== 0 ) :

		// IMAGE FULL URL
			$image_full_url = wp_get_attachment_image_src($thumbnail_id, 'full');
			if ( $image_full_url ) :
				$image_full_url = $image_full_url[0];
			endif;


		// GET ALL IMAGE URL|WIDTH|HEIGHT BY IMAGE SIZE
			$image_sizes = get_intermediate_image_sizes();
			$image_array_sizes = array();

			foreach ( $image_sizes as $image_size ) :

				$image_item = wp_get_attachment_image_src($thumbnail_id, $image_size);

				if ( $image_item ) :
					$image_array_sizes[$image_size] = $image_item[0];
					// $image_array_sizes[$image_size . '-width'] = $image_item[1];
					// $image_array_sizes[$image_size . '-height'] = $image_item[2];
				endif;

			endforeach;


		// ADD EVERYTHING TO ARRAY
			$image_array = array(
				'ID' => $thumbnail_id,
				'id' => $thumbnail_id,
				'url' => $image_full_url,
				'title' => get_the_title($thumbnail_id),
				'alt' => wp_image_alt($thumbnail_id),
				'sizes' => $image_array_sizes,
			);

	endif;

	return $image_array;

}


// FUNCTION: WORDPRESS IMAGE ALT

function wp_image_alt($thumbnail_id) {
	$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);
	if ( $alt == '' ) {
		$alt = get_the_title($thumbnail_id);
	}
	return $alt;
}


// ADD CATEGORY TO PAGES

add_action( 'init', 'add_taxonomies_to_pages' );
function add_taxonomies_to_pages() {
	register_taxonomy_for_object_type( 'post_tag', 'page' );
	register_taxonomy_for_object_type( 'category', 'page' );
}


// ACF: WP AUTOP

//add_filter('acf/format_value/type=wysiwyg', 'format_value_wysiwyg', 10, 3);
//function format_value_wysiwyg( $value, $post_id, $field ) {
//	$value = apply_filters( 'the_content', $value );
//	return $value;
//}


// ADD CLASS TO MENU LINKS?

add_filter( 'nav_menu_link_attributes', 'add_menu_atts', 10, 3 );
function add_menu_atts( $atts, $item, $args ) {
	$atts['class'] = 'animsition-link';
	return $atts;
}


// REMOVE COMMENT FUNCTIONS

require( get_stylesheet_directory() . '/inc/functions/remove-comment-functions.php');


// ADD LANG TEXT DOMAIN

load_theme_textdomain( 'adolphus', get_template_directory() . '/languages' );


// REMOVE CONTACT FORM 7 CSS STYLES?

add_action( 'wp_print_styles', 'wps_deregister_styles', 100 );
function wps_deregister_styles() {
	wp_deregister_style( 'contact-form-7' );
}


// REMOVE GUTENBURG VISUAL/TEXT EDITOR?

if ( is_admin() ) {
	add_filter('use_block_editor_for_post', '__return_false', 10);
	add_filter('use_block_editor_for_post_type', '__return_false', 10);
}


// ADD PHP VARS SCRIPT VARIABLE

function php_vars() {
	$php_vars = array(
		'admin_ajax_url' => admin_url('admin-ajax.php'),
		'get_bloginfo_url' => get_bloginfo('url'),
		'get_stylesheet_directory' => get_stylesheet_directory(),
		'get_stylesheet_directory_uri' => get_stylesheet_directory_uri(),
		'get_template_directory' => get_template_directory(),
		'get_template_directory_uri' => get_template_directory_uri(),
	);
	echo '<script type="text/javascript">var php_vars =' . json_encode($php_vars) . ';</script>';
}
add_action('wp_head', 'php_vars');

function sc_anti_wpautop($content) {
	$array = array (
		'<p>[' => '[',
		']</p>' => ']',
		']<br />' => ']'
	);
	$content = strtr( $content, $array );

	$get_first_string = substr($content, 0, 4);
	$get_last_string = substr($content, -3);

	// check if $content starts with </p>
	if ( preg_match('/<\/p>/', $get_first_string) ) :
		$content = substr($content, 4);
	endif;

	// check if $content ends with <p>
	if ( preg_match('/<p>/', $get_last_string) ) :
		$content = substr($content, 0, -3);
	endif;

	// var_dump($content);

	return $content;
}

function generate_random_seed($length = 6) {
	$seed = str_split(
		'abcdefghijklmnopqrstuvwxyz'
		.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
		//.'0123456789!@#$%^&*()'
	);
	shuffle($seed);
	$string = '';
	foreach (array_rand($seed, $length) as $k) $string .= $seed[$k];
	return $string;
}

function excerpt($content, $limit) {
	$excerpt = explode(' ', $content, $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}


function get_user_ip() {

	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	return $ip;

}

function get_user_ip_data() {

	$user_ip = get_user_ip();

	// CURL

		// from: https://geojs.io/
		$api_url = 'https://get.geojs.io/v1/ip/geo.json?ip=' . $user_ip;

		// Get cURL resource
		$api_curl = curl_init();

		// Set some options - we are passing in a useragent too here
		curl_setopt_array($api_curl, array(
			CURLOPT_URL => $api_url,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_NOBODY => 0,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
		));

		// Send the request & save response to $api_json
		$api_json = curl_exec($api_curl);

		// Close request to clear up some resources
		curl_close($api_curl);

	// PHP

		// convert json to php object
		// get first array index only
		$api_json = json_decode($api_json)[0];

		// return false if $api_json is null or empty
		if ( !isset($api_json) || empty($api_json) ) $api_json = false;

		return $api_json;	

}

function responsiveHeight( $desktop = 100, $tablet = 100, $mobile = 100 ) {
	$heightClass = array();

	if($desktop)
		$heightClass[] = 'height__desktop--' . $desktop;

	if($tablet)
		$heightClass[] = 'height__tablet--' . $tablet;

	if($mobile)
		$heightClass[] = 'height__mobile--' . $mobile;

	return implode(' ', $heightClass);
}

function dynamicImageSetup($desktop, $tablet, $mobile, $class = '') {
	$responsiveData = array();

	if( $desktop ) {
		$responsiveData[] = array(
								'class' => 'show-for-large',
								'data' => $desktop,
								'size' => 'xxl'
							);
		responsive_background_image($desktop, 'landscape', $class.'.show-for-large', 'xxl', false, false);
	}

	$tablet_image = $tablet;
	if( !$tablet_image )
		$tablet_image = $desktop;

	if( $tablet_image ) {
		$responsiveData[] = array(
								'class' => 'show-for-medium-only',
								'data' => $tablet_image,
								'size' => 'large'
							);
		responsive_background_image( $tablet_image, 'landscape', $class.'.show-for-medium-only', 'large', false, false);
	}

	$mobile_image = $mobile;
	if( !$mobile_image )
		$mobile_image = ($tablet) ? $tablet_image : $desktop;

	if( $mobile_image ) {
		$responsiveData[] = array(
								'class' => 'show-for-small-only',
								'data' => $mobile_image,
								'size' => 'medium'
							);
		responsive_background_image($mobile_image, 'landscape', $class.'.show-for-small-only', 'medium', false, false);
	}

	return $responsiveData;
}

function acf_link( $link_text, $link_type, $custom_link, $page_link ) {
	$link = array();

	if( $link_text && ( $custom_link || $page_link ) ) {
		$link['text'] = $link_text;

		if( $link_type == 'external' )
			$link['url'] = $custom_link;
		else
			$link['url'] = $page_link;

		return $link;

	} else
		return false;
}

function acf_load_field_default_header_menu_value( $field ) {
	$data = array();
	foreach ( get_terms( 'nav_menu', array( 'hide_empty' => true ) ) as $key => $value) {
		$data[$value->term_id] = $value->name;
	}

	$field['choices'] = $data;

	return $field;
}

/*name=property_default_value*/
add_filter('acf/load_field/name=default_header_menu', 'acf_load_field_default_header_menu_value');


function acf_load_field_header_menu_value( $field ) {
	$data = array();

	foreach ( get_terms( 'nav_menu', array( 'hide_empty' => true ) ) as $key => $value) {
		$data[$value->term_id] = $value->name;
	}

	$field['choices'] = $data;

	return $field;
}

add_filter('acf/load_field/name=header_menu', 'acf_load_field_header_menu_value');

add_action( 'wp_ajax_nopriv_blog_list', 'blog_list' );
add_action( 'wp_ajax_blog_list', 'blog_list' );
function blog_list() {
	$blogList = new WP_Query(
					array(
						'post_type' => 'post',
						'order' => 'desc',
						'post_status' => 'publish',
						'orderby' => 'publish_date',
						'posts_per_page' => 9,
						'paged' => $_POST['paged'],
						'post__not_in' => explode(',', $_POST['exclude'])
					)
				);

	if( $blogList->have_posts() ) : while( $blogList->have_posts() ) : $blogList->the_post();
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogList->post->ID ), 'landscape-xxl')[0];
		$image_alt = get_post_meta( get_post_thumbnail_id($blogList->post->ID) , '_wp_attachment_image_alt');
		$blogCategory = array();

		if( $image_src )
			$style = 'style="background: url(\'' . wp_get_attachment_image_src( get_post_thumbnail_id( $blogList->post->ID ), 'landscape-xxl')[0] .'\')"';
		else
			$style = '';

		if( get_field( 'list_image', $blogList->post->ID ) )
			$style = 'style="background: url(\'' . get_field('list_image', $blogList->post->ID) . '\')"';

		if(get_the_category($blogList->post->ID)) {
			foreach (get_the_category($blogList->post->ID) as $category) {
				$blogCategory[] = $category->name;
			}
		}
?>

		<div class="blog-grid__col cell large-4 medium-6">
			<div class="blog-grid__img" <?= $style; ?>>
				<a class="dropanchor" href="<?= get_the_permalink($blogList->post->ID); ?>">
					<span class="visuallyhidden"><?php the_title(); ?></span>
				</a>
				<?php if( $image_src ) : ?>
					<picture>
						<img src="<?= $image_src; ?>" alt="<?= $image_alt; ?>">
					</picture>
				<?php endif; ?>
			</div>
			<div class="blog-grid__category">
				<span><?= date('M d, Y', strtotime($blogList->post->post_date)); ?></span>
				<?php if( $blogCategory ) : ?>
					<span><?= implode(', ', $blogCategory); ?></span>
				<?php endif; ?>
			</div>
			<h2 class="blog-grid__title">
				<a href="<?= get_the_permalink($blogList->post->ID); ?>">
					<?= $blogList->post->post_title; ?>
				</a>
			</h2>
			<div class="blog-grid__text">
				<?php
					if( get_field('short_description', $blogList->post->ID) )
						echo get_field('short_description', $blogList->post->ID);
					else
						the_excerpt($blogList->post->ID);
				?>
			</div>
		</div>

<?php
	endwhile; endif;
	die();
}

add_action( 'wp_ajax_nopriv_press_list', 'press_list' );
add_action( 'wp_ajax_press_list', 'press_list' );
function press_list() {
	$pressList = new WP_Query(
					array(
						'post_type' => 'press',
						'order' => 'desc',
						'post_status' => 'publish',
						'orderby' => 'publish_date',
						'posts_per_page' => 9,
						'paged' => $_POST['paged'],
						'post__not_in' => explode(',', $_POST['exclude'])
					)
				);

	if( $pressList->have_posts() ) : while( $pressList->have_posts() ) : $pressList->the_post();
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $pressList->post->ID ), 'landscape-xxl')[0];
		$image_alt = get_post_meta( get_post_thumbnail_id($pressList->post->ID) , '_wp_attachment_image_alt');
		$pressCategory = array();

		if( $image_src )
			$style = 'style="background: url(\'' . wp_get_attachment_image_src( get_post_thumbnail_id( $pressList->post->ID ), 'landscape-xxl')[0] .'\')"';
		else
			$style = '';

		if( get_field( 'list_image', $pressList->post->ID ) )
			$style = 'style="background: url(\'' . get_field('list_image', $pressList->post->ID) . '\')"';

		if(get_the_terms($pressList->post->ID, 'press-category')) {
			foreach (get_the_terms($pressList->post->ID, 'press-category') as $category) {
				$pressCategory[] = $category->name;
			}
		}
?>

		<div class="blog-grid__col cell large-4 medium-6">
			<div class="blog-grid__img" <?= $style; ?>>
				<a class="dropanchor" href="<?= get_the_permalink($pressList->post->ID); ?>">
					<span class="visuallyhidden"><?php the_title(); ?></span>
				</a>
				<?php if( $image_src ) : ?>
					<picture>
						<img src="<?= $image_src; ?>" alt="<?= $image_alt; ?>">
					</picture>
				<?php endif; ?>
			</div>
			<div class="blog-grid__category">
				<span><?= date('M d, Y', strtotime($pressList->post->post_date)); ?></span>
				<?php if( $pressCategory ) : ?>
					<span><?= implode(', ', $pressCategory); ?></span>
				<?php endif; ?>
			</div>
			<h2 class="blog-grid__title">
				<a href="<?= get_the_permalink($pressList->post->ID); ?>">
					<?= $pressList->post->post_title; ?>
				</a>
			</h2>
			<div class="blog-grid__text">
				<?php
					if( get_field('short_description', $pressList->post->ID) )
						echo get_field('short_description', $pressList->post->ID);
					else
						the_excerpt($pressList->post->ID);
				?>
			</div>
		</div>

<?php
	endwhile; endif;
	die();
}

add_action( 'wp_ajax_nopriv_news_list', 'news_list' );
add_action( 'wp_ajax_news_list', 'news_list' );
function news_list() {

	$paged = $_POST['paged'];
	$args = array(
			'post_type' => 'news',
			'order' => 'desc',
			'post_status' => 'publish',
			'orderby' => 'publish_date',
			'posts_per_page' => 5,
			'paged' => $paged,

			/*'tax_query' => array(
				array(
					'taxonomy' => 'news-category',
					'field' => 'id',
					'terms' => '1259',
				)
			)*/
		);
	
	if( $_POST['search'] )
		$args['s'] = $_POST['search'];
		
	if( ((int)$_POST['year'] > 0 && is_int((int)$_POST['year'])) )
		$args['date_query'][0]['year'] = $_POST['year'];

	if( ((int)$_POST['month'] > 0 && is_int((int)$_POST['month'])) )
		$args['date_query'][0]['month'] = $_POST['month'];

	if( $_POST['category_id'] ) {
		$args['tax_query'] = array(
							array(
								'taxonomy' => 'news-category',
								'field' => 'id',
								'terms' => $_POST['category_id']
							)
						);
	}

	$news = new WP_Query( $args );

	if( $news->have_posts() ) : while( $news->have_posts() ) : $news->the_post();
?>
		<div class="newscontent__row grid-x cell large-9 align-middle">
			<div class="newscontent__imgbox cell large-2 medium-3">
				<?php
					$image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $news->post->ID ), 'landscape-xxl')[0];
					$image_alt = get_post_meta( get_post_thumbnail_id($news->post->ID) , '_wp_attachment_image_alt')[0];

					$style = '';
					if( $image_src )
						$style = 'style="background-image: url(\'' . $image_src . '\')"';
				?>
				<div class="newscontent__img" <?= $style; ?>></div>
			</div>
			<div class="newscontent__content cell large-6 medium-9">
				<span class="newscontent__content-date"><?= date('M d', strtotime($news->post->post_date)); ?></span>
				<h2 class="newscontent__content-title"><?= $news->post->post_title; ?></h2>
				<div class="newscontent__content-text">
					<?php
						if( get_field('short_description', $news->post->ID) )
							echo get_field('short_description', $news->post->ID);
						else
							echo '<p>' . excerpt(get_the_content($news->post->ID), 20) . '</p>';
					?>
				</div>
				<a href="<?= get_the_permalink( $news->post->ID ); ?>" class="dropanchor"></a>
			</div>
		</div>

	<?php endwhile; endif; ?>

	<div class="newscontent__row grid-x cell large-9">
		<div class="newscontent__pagination cell large-12">
			<ul>
				<?php

					for ($index=1; $index <= $news->max_num_pages; $index++) :
				?>
					<?php
						$style = '';
						if( $paged == $index)
							$style = 'newscontent__pagination-item--active';
					?>
					<li class="newscontent__pagination-item <?= $style; ?>"><button class="newscontent__pagination-link"><?= $index; ?></button></li>
				<?php endfor; ?>
			</ul>
		</div>
	</div>

<?php
die();
}
//blog list search
function blog_list_search() {
	$blog_list_query = new WP_Query( 
		array( 
			'posts_per_page' => 3, 
			's' => $_POST['keyword'], 
			'post_type' => 'post', 
			'post_status' => 'publish'
		) 
	);

	
	?>
	<ul>
	<?php
	if ( $blog_list_query->have_posts() ) : 
		while ( $blog_list_query->have_posts() ): $blog_list_query->the_post(); 
	?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
<?php 
		endwhile; ?>

	<?php else : ?>
	<li class="no-results">No results found</li>
	<?php	 
	endif; wp_reset_postdata(); ?>
	</ul>
	<?php 
	die();
}

add_action('wp_ajax_blog_list_search_ajax' , 'blog_list_search');
add_action('wp_ajax_nopriv_blog_list_search_ajax','blog_list_search');



add_action('wp_ajax_resources_search_ajax' , 'resources_search');
add_action('wp_ajax_nopriv_resources_search_ajax','resources_search');
function resources_search() {		
	$resources_query = new WP_Query(
		array(
			'post_type' => 'resources',
			's' => $_POST['keyword'],
			'post_status' => 'publish',
			'posts_per_page' => -1
		)
	);

	if ( $resources_query->have_posts() ) : while ( $resources_query->have_posts() ): $resources_query->the_post();
?>
		<li><a href="<?= get_permalink(); ?>"><?php the_title(); ?></a></li>
<?php 
	endwhile; endif; wp_reset_postdata(); 
	die();
}