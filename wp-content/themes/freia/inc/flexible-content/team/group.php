<div class="team__g cell small-11 large-10 text-center">
	<div class="grid-x align-center">
		<?php 
			if ( have_rows('row_items') ) : while ( have_rows('row_items') ) : the_row(); 
				$width = get_sub_field('width');

				if ( $width == 6 ) :
					$items_class = 'large-6';
				elseif ( $width == 12 ) :
					$items_class = 'large-6 xlarge-12';
				else :
					$items_class = 'medium-6 large-3';
				endif;
				
				$title = [
					'text' => get_sub_field('title'),
					'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
				];
		?>
			<div class="team__g-items cell small-12 <?= $items_class; ?>">
				<div class="grid-x align-center">
					<?php if ( $title['text'] ) : ?>
						<div class="team__g-title-box cell small-12">
						<<?= $title['html_tag']; ?> class="team__g-title cell small-12"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
						</div>
					<?php endif; ?>

					<?php 
						if ( $width == 6 ) :
							$item_class = 'medium-6';
						elseif ( $width == 12 ) :
							$item_class = 'medium-6 xlarge-3';
						else :
							$item_class = 'medium-12';
						endif;

						if ( have_rows('team') ) : while ( have_rows('team') ) : the_row(); 
							$image = acf_get_image( get_sub_field('image') );
							$name = get_sub_field('name');
					?>
						<div class="team__g-item cell small-12 <?= $item_class; ?> text-center">
						<div class=" team__g-item-box grid-y">
							<?php if ( $image ) : ?>
								<div class="team__g-item-image cell">
									<div class="team__g-item-image-wrapper">
										<img class="lazy" data-src="<?= $image['sizes']['image_size_177']; ?>" alt="<?= $image['alt']; ?>">
									</div>
								</div>
							<?php endif; ?>
							<div class="team__g-item-content cell">	
							<?php if ( $name ) : ?>
								<h2 class="team__g-item-name"><?= $name; ?></h2>
							<?php endif; ?>

							<?php if ( have_rows('social_items') ) : ?>
								<ul class="team__g-item-social">
									<?php 
										while ( have_rows('social_items') ) : the_row(); 
											$icon_class = get_sub_field('icon_class');
											$link = get_sub_field('link');
									?>
										<li>
											<a href="<?= $link; ?>" target="_blank"><i class="<?= $icon_class; ?>"></i></a>
										</li>
									<?php endwhile; ?>
								</ul>
							<?php endif; ?>
							</div>
						</div>
						</div>
					<?php 
						$title['text'] = '';
						$title['html_tag'] = '';
								
						endwhile; endif;
					?>
				</div>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>