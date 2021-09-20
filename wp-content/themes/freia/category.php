<?php
	/* Template Name: Blog List */

	get_header();

	
	$current_category = get_queried_object();

	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-blog-list.php',
		
	));

	if(isset($pages[0])) {
		$all_url = get_page_link($pages[0]->post_id);
	}

?>
	<div class="blog-list grid-x align-center">
		<div class="cell small-12 blog-list__featured-container blog-list__featured-container--category">
			<h1 class="blog-list__title text-center blog-list__title--category"><?= $current_category->name; ?></h1>

			<div class="banner__pattern blog-list__featured-banner__pattern">
				<img class="lazy" data-src="<?= get_stylesheet_directory_uri(); ?>/assets/images/banner-pattern.png" alt="Banner Pattern">
			</div>
		</div>

		<div class="blog-list__body-container grid-container">
			<div class="blog-list__filter grid-x align-spaced align-middle">
				<div class="blog-list__filter-categories-container cell xlarge-7 medium-7 small-12">
					<ul class="blog-list__filter-categories grid-x">
					<li class="blog-list__filter-categories-item"><a href="<?= $all_url; ?>"><span>All</span></a></li>
					<?php
						$filter_categories = get_categories(); 
						foreach ($filter_categories as $cat_filter) : 
							$selected = '';
							if (strtolower($cat_filter->slug) != 'featured') :
							$cat_link = get_category_link($cat_filter->cat_ID);
							if (strtolower($cat_filter->cat_ID) == $current_category->term_id) :
								$selected = 'selected';
							endif;
					?>	  
							<li class="blog-list__filter-categories-item"><a href="<?= $cat_link; ?>" class="<?= $selected; ?>"><span><?= $cat_filter->cat_name; ?></span></a></li>   
						<?php endif; endforeach; ?>		
					</ul>
					<select class="blog-list__filter-categories--mobile category-dropdown" name="category-dropdown">
					<option value="">Choose Category</option>	
					<option value="<?= $all_url; ?>">All</option>
					<?php	foreach ($filter_categories as $cat_filter) : 
							if (strtolower($cat_filter->slug) != 'featured') :
							$cat_link = get_category_link($cat_filter->cat_ID); 							
					?>
							<option value="<?=$cat_link?>"><?=$cat_filter->cat_name; ?></option>
					<?php endif; endforeach; ?>				
					</select>
				</div>	
				<div class="blog-list__filter-seach-container cell xlarge-auto medium-7 small-12">
					<form class="blog-list__search">
						<div class="blog-list__search-text">
							<input type="text" placeholder="Search">
							<button class="blog-list__search-btn"></button>
						</div>
					</form>
                	<div class="blog-list__search-result"></div>			
				</div>	
			</div>		
			<div class="blog-list__list grid-x">
				<?php
					$featured_category = '-' . $featured_category;

					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

					$blog_list_query = new WP_Query(
						array(
							'post_type' => 'post',
							'posts_per_page' => 9,
							'paged' => $paged,
							'post_status' => 'publish',
							'orderby' => 'date',
							'order' => 'DESC',
							'cat' => $current_category->term_id,
						)
					);
	
					if ( $blog_list_query->have_posts() ) : while ( $blog_list_query->have_posts() ) : $blog_list_query->the_post();
						$categories = get_the_category();
						$feat_img = get_field('featured_image', $post->ID);
						if($feat_img) :
							$image = $feat_img;
						else :
							$image = wp_image_to_acf_get_image(get_post_thumbnail_id($post->ID));
						endif;
						$content = wpautop( wp_trim_words( get_the_content() ) );
						$author = get_the_author();
						$date = get_the_date();
						$category = '';
						$overwrite_author = get_field('overwrite_author',$post->ID);
						if	($overwrite_author) :
							$author = $overwrite_author;
						else :
							$author = get_the_author();
						endif;
						foreach ($categories as $cat) {	
							if ($cat->slug != 'featured') {
								$category .= $cat->name . ' ';
							}
						}	
				?>
					<div class="blog-list__item cell small-12 medium-6 large-6 xlarge-4">
						<div class="blog-list__item-wrap grid-x">
							<div class="blog-list__item-image cell" style="background-image: url('<?= $image['url']; ?>');"></div>
							<div class="blog-list__item-content cell">
								<h2 class="blog-list__item-category"><?= $category; ?><span><?= do_shortcode('[rt_reading_time label= "|" postfix="MIN READ" postfix_singular="MIN READ" post_id="' . $post->ID . '"]'); ?></h2>
								<h3 class="blog-list__item-title"><?php the_title(); ?></h3>

								<div class="blog-list__item-meta cell">
								<span class="blog-list__item-date"><?= $date; ?></span><span class="blog-list__item-author">By <?= $author; ?></span>
								</div>
							</div>

							<a href="<?php the_permalink(); ?>" class="dropanchor"></a>
						</div>
					</div>
				<?php endwhile; ?>
				
					<div class="blog-list__pagination cell small-12">
						<div class="text-center">
							<?php
								echo paginate_links( 
									array(
										'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
										'total'        => $blog_list_query->max_num_pages,
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

	<div class="flexspace desktop" style="margin-bottom: 25rem"></div>
	<div class="flexspace tablet" style="margin-bottom: 5rem"></div>
	<div class="flexspace mobile" style="margin-bottom: 5rem"></div>

<?php get_footer(); ?>