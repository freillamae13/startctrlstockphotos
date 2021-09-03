<?php
	get_header();

	// $resources_single_form = get_field('resources_single_form');
?>

	<?php require get_stylesheet_directory() . '/inc/functions/flexible-content.php'; ?>

	<!-- <section class="banner">
		<div class="banner__resources-single">
			<div class="grid-x align-center grid-container">
				<div class="cell small-11 large-10">
					<div class="grid-x">
						<div class="banner__resources-single-content cell small-12 large-7">
							<h1 class="banner__resources-single-title"><?php // the_title(); ?></h1>

							<?php // if ( get_the_content() ) : ?>
								<div class="banner__resources-single-text">
									<?php //the_content(); ?>
								</div>
							<?php // endif; ?>
						</div>

						<div class="banner__resources-single-form cell small-12 large-5">
							<?php // $resources_single_form; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->

<?php get_footer(); ?>