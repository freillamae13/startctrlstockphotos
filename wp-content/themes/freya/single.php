<?php
	get_header();
	
	global $post;

	if ( get_field('post_single_banner') ) :
		$image = acf_get_image( get_field('post_single_banner') );
	else :
		$image = wp_image_to_acf_get_image( get_post_thumbnail_id( $post->ID ) );
	endif;
	
	$current_post = $post->ID;
	$categories = get_the_terms( $post->ID, 'category' );
	$date = get_the_date();

	if ( get_field('post_author') ) :
		$author = get_field('post_author');
	else :
		$author = get_the_author();
	endif;

	$blog_newsletter_title = get_field('blog_newsletter_title', 'option');
	$blog_newsletter_content = get_field('blog_newsletter_content', 'option');
	$blog_newsletter_link = get_field('blog_newsletter_link', 'option');
	$blog_newsletter_link_url = $blog_newsletter_link['url'];
    $blog_newsletter_link_text = $blog_newsletter_link['title'];
    $blog_newsletter_link_target = $blog_newsletter_link['target'] ? $blog_newsletter_link['target'] : '_self';
?>

	<section class="blog-single">
		<div class="blog-single__top">
			<div class="grid-x align-center grid-container">
				<div class="cell small-11 large-10">
					<div class="grid-x">
						<div class="blog-single__spacer cell small-12 large-3"></div>

						<div class="cell small-12 large-6">
							<div class="blog-single__meta-1">
								<ul>
									<?php 
										$counter = 0;
										$current_category = '';

										foreach ( $categories as $category ) : 
											if ( ( $category->term_id != $blog_featured_category ) && ( $counter < 1 ) ) :
												$current_category = $category->term_id;
									?>
										<li><?= $category->name; ?></li>
									<?php $counter++; endif; endforeach; ?>
									<li><?= reading_time(); ?></li>
								</ul>
							</div>

							<h1 class="blog-single__title"><?php the_title(); ?></h1>
						</div>
						
						<div class="blog-single__spacer cell small-12 large-3"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="blog-single__middle">
			<div class="grid-x align-center grid-container">
				<div class="cell small-11 large-10">
					<div class="grid-x">

						<div class="blog-single__meta-2 cell small-12 large-3 show-for-large">
							<ul>
								<li><?= $author; ?></li>
								<li><?= $date; ?></li>
								<li>
									<ul class="blog-single__social">
										<li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(the_permalink()); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
										<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&hashtags=<?= sanitize_title( get_the_title() ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
									</ul>
								</li>
							</ul>
						</div>	

						<div class="blog-single__spacer cell small-12 large-6"></div>

						<div class="blog-single__spacer cell small-12 large-3"></div>

					</div>
				</div>
			</div>
		</div>

		<div class="blog-single__bottom">
			<div class="grid-x align-center grid-container">
				<div class="cell small-11 large-10">
					<div class="grid-x">
						<div class="blog-single__spacer cell small-12 large-3"></div>

						<div class="blog-single__content cell small-12 large-6">
							<?php if ( $image ) : ?>
								<div class="blog-single__image lazy" data-bg="<?= $image['url']; ?>"></div>
							<?php endif; ?>

							<?php if ( get_the_content() ) : ?>
								<div class="blog-single__text">
									<?php the_content(); ?>
								</div>
							<?php endif; ?>

							<div class="blog-single__meta-2 blog-single__meta-2--mobile cell small-12 large-3 hide-for-large">
								<ul>
									<li><?= $author; ?></li>
									<li><?= $date; ?></li>
									<li>
										<ul class="blog-single__social">
											<li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(the_permalink()); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
											<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&hashtags=<?= sanitize_title( get_the_title() ); ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
										</ul>
									</li>
								</ul>
							</div>	
						</div>

						<div class="blog-single__aside cell small-12 large-3">
							<div class="blog-single__newsletter">
								<?php if ( $blog_newsletter_title ) : ?>
									<h2 class="blog-single__newsletter-title"><?= $blog_newsletter_title; ?></h2>
								<?php endif; ?>

								<?php if ( $blog_newsletter_content ) : ?>
									<div class="blog-single__newsletter-text">
										<?= $blog_newsletter_content; ?>
									</div>
								<?php endif; ?>

								<?php if ( $blog_newsletter_link_text ) : ?>
									<div class="blog-single__newsletter-link text-center">
										<a href="<?= $blog_newsletter_link_url; ?>" <?= $blog_newsletter_link_target; ?> class="button"><?= $blog_newsletter_link_text; ?></a>
									</div>
								<?php endif; ?>
							</div>
									
							<div class="blog-single__related-post grid-x">
								<?php	
									$related_post_query = new WP_Query(
										array(
											'post_type' => 'post',
											'post_status' => 'publish',
											'posts_per_page' => 2,
											'orderby' => 'date',
											'order' => 'DESC',
											'paged' => $paged,
											'category__in' => array( $current_category ),
											'post__not_in' => array( $current_post )
										)
									);

									if ( $related_post_query->have_posts() ) : while ( $related_post_query->have_posts() ) : $related_post_query->the_post();
										$categories = get_the_terms( $post->ID, 'category' );
										$image = wp_image_to_acf_get_image( get_post_thumbnail_id( $post->ID ) );
								?>
									<div class="blog-single__related-post-item cell small-12 medium-6 large-12">
										<div class="blog-single__related-post-wrapper">
											<div class="blog-single__related-image lazy" data-bg="<?= $image['url']; ?>"></div>

											<div class="blog-single__related-content">
												<div class="blog-single__related-meta">
													<ul>
														<?php 
															$counter = 0;

															foreach ( $categories as $category ) : 
																if ( ( $category->term_id != $blog_featured_category ) && ( $counter < 1 ) ) :
														?>
															<li><?= $category->name; ?></li>
														<?php $counter++; endif; endforeach; ?>
														<li><?= reading_time(); ?></li>
													</ul>
												</div>

												<h2 class="blog-single__related-title"><?php the_title(); ?></h2>
											</div>

											<a href="<?php the_permalink(); ?>" class="dropanchor"></a>
										</div>
									</div>
								<?php endwhile; endif; wp_reset_postdata(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php get_footer(); ?>