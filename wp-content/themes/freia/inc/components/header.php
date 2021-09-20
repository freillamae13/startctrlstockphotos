<?php
	$header_logo = acf_get_image( get_field('header_logo', 'option') );
?>

<header class="header">
	<div class="grid-x grid-container align-center">
		<div class="cell small-11 large-12">
			<div class="grid-x align-middle">
				<nav class="header__menu cell large-5 text-right">
					<ul>
						<li><a href="#" class="animsition-link">Home</a></li>
						<li><a href="#" class="animsition-link">Explore</a></li>
					</ul>
				</nav>

				<div class="header__logo cell auto text-center">
					<a href="<?= home_url(); ?>">
						<picture>
							<source media="(min-width: 1024px)" data-srcset="<?= $header_logo['sizes']['image_size_319']; ?>">
							<img class="lazy" data-src="<?= $header_logo['url']; ?>" alt="<?= $header_logo['alt']; ?>">
						</picture>
					</a>
				</div>

				<nav class="header__menu cell large-5 text-left">
				<ul>
					<li><a href="#" class="animsition-link">Brands</a></li>
					<li><a href="#" class="animsition-link">Login</a></li>
				</ul>

			</div>
		</div>
	</div>
</header>