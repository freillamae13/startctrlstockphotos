<?php $header_logo = acf_get_image( get_field('header_logo', 'option') ); ?>

<header class="header">
	<div class="grid-x grid-container align-center">
		<div class="cell small-11 large-10">
			<div class="grid-x align-middle">
				<div class="header__logo cell auto xlarge-shrink">
					<a href="<?= home_url(); ?>">
						<img class="lazy" data-src="<?= $header_logo['url']; ?>" alt="<?= $header_logo['alt']; ?>">
					</a>
				</div>

				<nav class="header__menu cell auto text-right">
					<ul>
						<?php 
							wp_nav_menu([
								'menu_class' => '',
								'container' => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'header_nav',
							]); 
						?>

					</ul>
				</nav>

				<div class="header__hamburger cell shrink text-right">
					<div>
						<div></div>
						<div></div>
						<div></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>