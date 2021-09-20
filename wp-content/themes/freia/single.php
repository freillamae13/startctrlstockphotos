<?php
	get_header();
	$enable_full_width_related_post = get_field('enable_full_width_related_post');
	$overwrite_author = get_field('overwrite_author');
?>

<section class="blog-detail <?= ( $enable_full_width_related_post ) ? 'blog-detail--full' : '' ?>">
	<div class="blog-detail__header--container">
		<div class="grid-x grid-container align-center blog-detail__header-main">
			<div class="cell small-11 medium-10 blog-detail__header--wrapper align-middle">
				<div class="grid-x">
					<div class="cell large-6 small-12">	
						<header class="blog-detail__header <?= ( $enable_full_width_related_post ) ? 'text-center' : '' ?>">
							<?php
							foreach((get_the_category()) as $category) { 
								$cat_name = $category->cat_name . ' '; 
							} 
							?>
							<div class="blog-detail__reading-time"><span><?= $cat_name; ?></span><span><?= do_shortcode('[rt_reading_time label="|" postfix="MIN READ" postfix_singular="MIN READ"]'); ?></span></div>
							<h1 class="blog-detail__title"><?= get_the_title(); ?></h1>
							<?php if( get_field('date') ) : ?>
								<time datetime="<?= date( 'Y-m-d 12:00', strtotime(get_field( 'date') ) ); ?>"><?= get_field('date') ?></time>
							<?php endif; ?>
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
									if	($overwrite_author) :
										$author = $overwrite_author;
									else :
										$author = get_the_author();
									endif;	
							?>
								<div class="blog-detail__author"> <span><?php the_date(); ?></span> <span>By <?= $author; ?></span></div>		
							<?php endwhile; endif; ?>
							<ul class="blog-detail__social">
								<li><a href="https://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://twitter.com/share?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>&hashtags=<?= sanitize_title( get_the_title() ); ?>"><i class="fab fa-twitter"></i></a></li>
								<li><a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(get_permalink()); ?>"><i class="fab fa-linkedin-in"></i></a></li>					
							</ul>
						</header>
					</div>	

					<?php if ( get_post_thumbnail_id($post->ID) ) : ?>
						<div class="cell blog-detail__imagebox large-6 small-12">
							<?php
								if ( get_post_thumbnail_id($post->ID) ) :
									$image = wp_image_to_acf_get_image(get_post_thumbnail_id($post->ID));
								endif;
							?>
							<div class="blog-detail__image--decor-1"></div>
							<div class="blog-detail__image--decor-2">				
								<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/wave-top-decor.png" alt="">
							</div>
							<div class="blog-detail__image--wrapper" style="background-image: url('<?= $image['url']; ?>');">
								<img class="visuallyhidden" src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
							</div>
							<div class="blog-detail__image--decor-3">
								<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/dots-bottom-decor.png" alt="">
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="banner__pattern">
				<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/banner-pattern.png" alt="Banner Pattern">
				<div class="banner__pattern-background hide-for-large blog-detail__pattern-background"></div>
			</div>
		</div>
	</div>

	<div class="blog-detail__detail-body grid-x grid-container align-center">
		<div class="cell small-11 medium-10">		
			<div class="grid-x blog-detail__single-container">
				<div class="blog-detail__detailbox cell <?= ( $enable_full_width_related_post ) ? 'small-12' : 'xlarge-8 large-7' ?>">		
					<div class="blog-detail__content">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; endif; ?>
					</div>

				</div>


				<?php
					$related_post = new WP_Query(
						array(
							'post_type' => 'post',
							'post_status' => 'publish',
							'post__not_in' => array( $post->ID ),
							'posts_per_page' => 2
						)
					);
				?>

				<div class="blog-detail__related cell <?= ( $enable_full_width_related_post ) ? 'small-12' : 'xlarge-4 large-5' ?>">
				<div class="cell blog-detail__download-container">
					<div class="blog-detail__download-wrapper">
							<?php 
								$link_type = acf_get_link( get_field('link_type','option'), get_field('custom_link','option'), get_field('page_link','option') );
								$link_style = acf_get_btn_style( get_field('link_style', 'option') );
								$open_in_new_tab = acf_open_in_new_tab( get_field('open_in_new_tab','option') );
								$link_label = get_field('button_label','option');
								$link_title = get_field('content_title','option');
								$link_content = get_field('content','option');
								$link_enable = get_field('enable_download_link','option');
							?>
							<?php if ( $link_enable ) : ?>
									<h2 class="blog-detail__download-title"><?= $link_title; ?></h2>
									<p class="blog-detail__download-content"><?= $link_content?></p>
									<a class="<?= $link_style; ?>" href="<?= $link_type; ?>" <?= $open_in_new_tab; ?>><?= $link_label; ?></a>
							<?php endif ?>
						</div>
					</div>
					<header class="blog-detail__related-titlebox <?= ( $enable_full_width_related_post ) ? 'text-center' : ''; ?>">
						<h2 class="blog-detail__related-title">Related Articles</h2>
					</header>

					<?php if ( $related_post->have_posts() ) : ?>
						<div class="blog-detail__related-posts grid-x align-center">
							<div class="cell <?= ( $enable_full_width_related_post ) ? 'small-12 medium-10 large-9' : 'small-12' ?>">
								<div class="grid-x">
									<?php 
										while( $related_post->have_posts() ) : $related_post->the_post();
										$categories = get_the_category();
										$category = '';
										foreach ($categories as $cat) {	
											if ($cat->slug != 'featured') {
												$category .= $cat->name . ' ';
											}
										}
										$feat_img = get_field('featured_image', $post->ID);
										if($feat_img) :
											$image = $feat_img;
										else :
											$image = wp_image_to_acf_get_image(get_post_thumbnail_id($post->ID));
										endif; 
									?>
										<div class="blog-detail__post cell <?= ( $enable_full_width_related_post ) ? 'small-12 medium-6 large-6' : 'small-12' ?>">
											<div class="blog-detail__post-wrap">
												<div class="blog-detail__post-imagebox" style="background-image: url('<?= $image['url']; ?>');">
													<img class="visuallyhidden" src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">	
												</div>
												<div class="blog-detail__item-content">
													<h2 class="blog-detail__item-category"><?= $category; ?></h2>		
													<h3 class="blog-detail__post-title"><?php the_title(); ?></h3>						
												</div>
												<a href="<?= the_permalink($related_post->post->ID); ?>" class="dropanchor"></a>
											</div>
										</div>
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					<?php endif; wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="flexspace desktop" style="margin-bottom: 25rem"></div>
<div class="flexspace tablet" style="margin-bottom: 5rem"></div>
<div class="flexspace mobile" style="margin-bottom: 5rem"></div>

<?php get_footer(); ?>