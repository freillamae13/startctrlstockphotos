<?php
	$image = acf_get_image( get_sub_field('image') );

	$title = [
		'text' => get_sub_field('title'),
		'html_tag' => acf_html_tag(get_sub_field('title_html_tag'), 'h1')
	];

	$content = get_sub_field('content');

	$link = [
		'style' => acf_get_btn_style( get_sub_field('link_style') ),
		'image' => acf_get_image( get_sub_field('link_image') ),
		'link' => acf_get_link( get_sub_field('link_type'), get_sub_field('custom_link'), get_sub_field('page_link') ),
		'text' => get_sub_field('link_label'),
		'tab' => acf_open_in_new_tab( get_sub_field('open_in_new_tab') )
	];

	$column_image_left_array = [];
	$column_image_right_array = [];
	$column_image_array = [];
?>

<div class="photo-content__c cell small-11 large-9 xlarge-7 text-center">
	<?php if ( $title['text'] ) : ?>
		<<?= $title['html_tag']; ?> class="photo-content__c-title"><?= $title['text']; ?></<?= $title['html_tag']; ?>>
	<?php endif; ?>

	<?php if ( $content ) : ?>
		<div class="photo-content__c-text">
			<?= $content; ?>
		</div>
	<?php endif; ?>

	<div class="photo-content__c-column-items grid-x align-center align-stretch">
		<?php if ( $image ) : ?>
			<div class="photo-content__c-image cell small-12 large-shrink">
				<picture>
					<source media="(min-width: 1024px)" data-srcset="<?= $image['sizes']['image_size_658']; ?>">
					<source media="(min-width: 320px)" data-srcset="<?= $image['sizes']['image_size_512']; ?>">
					<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
				</picture>
			</div>
		<?php endif; ?>

		<div class="photo-content__c-column-item-group-left cell show-for-large large-auto">
			<?php 
				$counter = 0;

				if ( have_rows('column_image_left') ) : while ( have_rows('column_image_left') ) : the_row(); 
					$order = get_sub_field('order');
					$title_color = get_sub_field('title_color');
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$content = get_sub_field('content');

					if ( $title_color ) :
						$title_color = 'style="color: ' . $title_color . ';"';
					endif;

					$column_image_left_array[$counter]['order'] = $order;
					$column_image_left_array[$counter]['title_color'] = $title_color;
					$column_image_left_array[$counter]['image'] = $image;
					$column_image_left_array[$counter]['title'] = $title;
					$column_image_left_array[$counter]['content'] = $content;
			?>
				<div class="photo-content__c-column-item">
					<?php if ( $image ) : ?>
						<div class="photo-content__c-column-item-image">
							<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
						</div>
					<?php endif; ?>

					<?php if ( $title ) : ?>
						<h3 class="photo-content__c-column-item-title" <?= $title_color; ?>><?= $title; ?></h3>
					<?php endif; ?>

					<?php if ( $content ) : ?>
						<div class="photo-content__c-column-item-text">
							<?= $content; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php $counter++; endwhile; endif; ?>
		</div>

		<div class="photo-content__c-column-item-group-right cell show-for-large large-auto">
			<?php 
				$counter = 0;

				if ( have_rows('column_image_right') ) : while ( have_rows('column_image_right') ) : the_row(); 
					$order = get_sub_field('order');
					$title_color = get_sub_field('title_color');
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$content = get_sub_field('content');
						
					if ( $title_color ) :
						$title_color = 'style="color: ' . $title_color . ';"';
					endif;

					$column_image_right_array[$counter]['order'] = $order;
					$column_image_right_array[$counter]['title_color'] = $title_color;
					$column_image_right_array[$counter]['image'] = $image;
					$column_image_right_array[$counter]['title'] = $title;
					$column_image_right_array[$counter]['content'] = $content;
			?>
				<div class="photo-content__c-column-item">
					<?php if ( $image ) : ?>
						<div class="photo-content__c-column-item-image">
							<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
						</div>
					<?php endif; ?>

					<?php if ( $title ) : ?>
						<h3 class="photo-content__c-column-item-title" <?= $title_color; ?>><?= $title; ?></h3>
					<?php endif; ?>

					<?php if ( $content ) : ?>
						<div class="photo-content__c-column-item-text">
							<?= $content; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php $counter++; endwhile; endif; ?>
		</div>

		<div class="photo-content__c-column-item-group-mobile cell small-12 hide-for-large">
			<?php 
				$column_image_array = array_merge( $column_image_left_array, $column_image_right_array );

				function sortByOrder($a, $b) {
					return $a['order'] - $b['order'];
				}
				
				usort($column_image_array, 'sortByOrder');

				foreach ( $column_image_array as $column_image ) :
			?>
				<div class="photo-content__c-column-item">
					<?php if ( $column_image['image'] ) : ?>
						<div class="photo-content__c-column-item-image">
							<img src="<?= $column_image['image']['url']; ?>" alt="<?= $column_image['image']['alt']; ?>">
						</div>
					<?php endif; ?>

					<?php if ( $column_image['title'] ) : ?>
						<h3 class="photo-content__c-column-item-title" <?= $column_image['title_color']; ?>><?= $column_image['title']; ?></h3>
					<?php endif; ?>

					<?php if ( $column_image['content'] ) : ?>
						<div class="photo-content__c-column-item-text">
							<?= $column_image['content']; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php if ( $link['text'] || $link['image'] ) : ?>
		<div class="photo-content__c-link">
			<a href="<?= $link['link']; ?>" <?= $link['tab']; ?> class="<?= $link['style']; ?>">
				<?php if ( $link['style'] == 'image' ) : ?>
					<img src="<?= $link['image']['url']; ?>" alt="<?= $link['image']['alt']; ?>">
				<?php
					else : 
						echo $link['text'];
					endif; 
				?>
			</a>
		</div>
	<?php endif; ?>
</div>