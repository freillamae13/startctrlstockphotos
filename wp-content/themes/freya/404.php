<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); 
$image = acf_get_image( get_field('error_image','option') );

?>

<div class="error-page grid-container">
<section class="error-page__main-container grid-x align-middle align-center text-center large-10 small-12">
	<div class="error-page__image_container cell small-10">
		<?php if ( $image ) : ?>
			<picture>
				<source media="(min-width: 1660px)" data-srcset="<?= $image['sizes']['image_size_1000']; ?>">
				<source media="(min-width: 1440px)" data-srcset="<?= $image['sizes']['image_size_710']; ?>">
				<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_430']; ?>">
				<img class="lazy" data-src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
			</picture>
		<?php endif; ?>
	</div>

	<div class="error-page__content-container cell xlarge-7 small-10">
		<div class="error-page__title-wrapper">	
			<h1 class="error-page__title"><?= get_field('error_title', 'option'); ?></h1>
		</div>
		<div class="error-page__content-wrapper">	
			<?= get_field('error_content','option'); ?>
		</div>	
	</div>
	<?php 
		$link = [
			'style' => acf_get_btn_style( get_field('link_style','option') ),
			'link' => acf_get_link( get_field('link_type','option'), get_field('custom_link','option'), get_field('page_link','option') ),
			'text' => get_field('link_label','option'),
			'tab' => acf_open_in_new_tab( get_field('open_in_new_tab','option') )
		];
	?>		
		<?php if ( $link['text'] ) : ?>
			<div class="error-page__link cell small-12">
				<a href="<?= $link['link']; ?>" <?= $link['tab']; ?> class="<?= $link['style']; ?>"><?= $link['text']; ?></a>
			</div>
		<?php endif; ?>
</section>
</div>
<?php get_footer();