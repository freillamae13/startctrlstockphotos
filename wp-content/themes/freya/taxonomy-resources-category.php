<?php
	/*
	Template Name: Resources List
	*/

	get_header();

	$current_category = get_queried_object();
	$resources_featured_category = get_field('resources_featured_category', 'option');
	$resources_list_page = get_field('resources_list_page', 'option');

	$categories = get_terms( 
		array(
		'taxonomy' => 'resources-category',
		'hide_empty' => false,
		) 
	);

	$title = $current_category;
?>

	<div class="banner">
		<div class="banner__resources lazy" data-bg="<?= get_stylesheet_directory_uri(); ?>/assets/images/banner-image.jpg">
			<div class="grid-x align-center grid-container">
				<div class="cell small-11 large-10">
					<div class="grid-x">
						<div class="banner__resources-content cell small-12 text-center">
							<?php if ( $title ) : ?>
								<h1 class="banner__resources-title"><?= $title->name; ?></h1>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>

			<div class="banner__overlay" style="background-color: rgba(0, 0, 0, 0.3);"></div>
		</div>
	</div>

	<div class="resources-list">
		<div class="grid-x align-center grid-container">
			<div class="cell small-11 large-10">
				<div class="grid-x">
					<div class="resources-list__spacer cell small-12 large-3">
						<div class="resources-list__search">
							<form>
								<div class="resources-list__form-field">
									<input type="text" placeholder="Search">
								</div>
								<div class="resources-list__form-submit">
									<i class="fas fa-search"></i>
								</div>
								<div class="resources-list__result">
									<ul></ul>
								</div>
							</form>
						</div>

						<div class="resources-list__categories show-for-large">
							<ul>
								<?php 
									foreach ( $categories as $category ) : 
										if ( $category->term_id != $resources_featured_category ) :
								?>
									<li><a href="<?= get_term_link( $category->term_id ); ?>"><?= $category->name; ?></a></li>
								<?php endif; endforeach; ?>
							</ul>
						</div>

						<div class="resources-list__categories-mobile hide-for-large">
							<span><?= $current_category->name; ?></span>
							<ul>
								<li><a href="<?= $resources_list_page; ?>">All</a></li>
								<?php 
									foreach ( $categories as $category ) : 
										if ( $category->term_id != $resources_featured_category ) :
								?>
									<li><a href="<?= get_term_link( $category->term_id ); ?>"><?= $category->name; ?></a></li>
								<?php endif; endforeach; ?>
							</ul>
						</div>
					</div>

					<div class="resources-list__items cell small-12 large-9">
						<div class="grid-x">
							<?php
								$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

								$list_query = new WP_Query(
									array(
										'post_type' => 'resources',
										'post_status' => 'publish',
										'posts_per_page' => 9,
										'orderby' => 'date',
										'order' => 'DESC',
										'paged' => $paged,
										'tax_query' => array(
											array(
												'taxonomy' => 'resources-category',
												'field'    => 'term_id',
												'terms'    => $current_category->term_id
											),
										),
									)
								);

								if ( $list_query->have_posts() ) : while ( $list_query->have_posts() ) : $list_query->the_post();
									$categories = get_the_terms( $post->ID, 'resources-category' );
									$image = wp_image_to_acf_get_image( get_post_thumbnail_id( $post->ID ) );
							?>
								<div class="resources-list__item cell small-12 medium-6 xlarge-4">
									<div class="resources-list__item-wrapper">
										<div class="resources-list__item-image lazy" data-bg="<?= $image['url']; ?>"></div>

										<div class="resources-list__item-content">
											<h2 class="resources-list__item-title"><?php the_title(); ?></h2>

											<div class="resources-list__item-categories">
												<ul>
													<?php 
														$counter = 0;

														foreach ( $categories as $category ) : 
															if ( ( $category->term_id != $resources_featured_category ) && ( $counter < 2 ) ) :
													?>
														<li><?= $category->name; ?></li>
													<?php $counter++; endif; endforeach; ?>
												</ul>
											</div>
										</div>

										<a href="<?php the_permalink(); ?>" class="dropanchor"></a>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>

						<div class="resources-list__pagination cell small-12">
							<div class="text-center">
								<?php
									echo paginate_links( 
										array(
											'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
											'total'        => $list_query->max_num_pages,
											'current'      => max( 1, get_query_var( 'paged' ) ),
											'format'       => '?paged=%#%',
											'show_all'     => false,
											'type'         => 'plain',
											'end_size'     => 4,
											'mid_size'     => 1,
											'prev_next'    => false,
											'prev_text'    => sprintf( '<i></i> %1$s', __( 'Newer Posts', 'text-domain' ) ),
											'next_text'    => sprintf( '%1$s <i></i>', __( 'Older Posts', 'text-domain' ) ),
											'add_args'     => false,
											'add_fragment' => '',
										) 
									);
								?>
							</div>
						</div>		

					<?php endif; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>									
	</div>

<?php get_footer(); ?>