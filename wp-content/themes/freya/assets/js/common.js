(function($) {
	var $document = $(document);
	var $window = $(window);
	var $body = $('body');
	var media1024 = window.matchMedia("(max-width: 1024px)");
	var media1023 = window.matchMedia("(max-width: 1023px)");

	document.addEventListener( 'wpcf7invalid', function( event ) {
		$('.wpcf7-response-output').removeClass('wpcf7-response-output--spam wpcf7-response-output--failed wpcf7-response-output--success');
		$('.wpcf7-response-output').addClass('wpcf7-response-output--invalid');
	}, false);
	document.addEventListener( 'wpcf7spam', function( event ) {
		$('.wpcf7-response-output').removeClass('wpcf7-response-output--invalid wpcf7-response-output--failed wpcf7-response-output--success');
		$('.wpcf7-response-output').addClass('wpcf7-response-output--spam');
	}, false);
	document.addEventListener( 'wpcf7mailfailed', function( event ) {
		$('.wpcf7-response-output').removeClass('wpcf7-response-output--spam wpcf7-response-output--invalid wpcf7-response-output--success');
		$('.wpcf7-response-output').addClass('wpcf7-response-output--failed');
	}, false);
	document.addEventListener( 'wpcf7mailsent', function( event ) {
		$('.wpcf7-response-output').removeClass('wpcf7-response-output--spam wpcf7-response-output--failed wpcf7-response-output--invalid');
		$('.wpcf7-response-output').addClass('wpcf7-response-output--success');
	}, false);

	// Single Blog

	function singleBlog() {
		var height = $('.blog-single__meta-2').height();
		
		if ( !media1023.matches ) {
			$('.blog-single__content').css('margin-top', -Math.abs(height));
			$('.blog-single__aside').css('margin-top', -Math.abs(height));	
		} else {
			$('.blog-single__content').css('margin-top', '');
			$('.blog-single__aside').css('margin-top', '');
		}
	}

	// Video Hover

	function videoHover() {
		var videoHover = $('.video-hover');
		videoHover.off();

		if ( !media1024.matches ) {
			videoHover.on({
				mouseenter: function() {
					$(this).find('video')[0].play();
					$(this).addClass('video-play');
				},
				mouseleave: function() {
					$(this).find('video')[0].pause();
					$(this).removeClass('video-play');
				}
			});
		} else {
			videoHover.on('click', function() {
				if ( $(this).hasClass('video-play') ) {
					videoHover.removeClass('video-play');
					$(this).find('video')[0].pause();
				} else {
					$(this).addClass('video-play');
					$(this).find('video')[0].play();
				}
			});
		}
	}

	function videoHoverOnly() {
		var videoHoverOnly = $('.video-hover-only');
		videoHoverOnly.off();

		if ( !media1024.matches ) {
			videoHoverOnly.on({
				mouseenter: function() {
					$(this).find('video')[0].play();
					$(this).addClass('video-play');
				},
				mouseleave: function() {
					$(this).find('video')[0].pause();
					$(this).removeClass('video-play');
				},
				click: function() {
					var src = $(this).attr('data-src');
					var poster = $(this).attr('data-poster');

					$('body').addClass('video-popup-active');
					$('.video-popup').find('video').attr('poster', poster);
					$('.video-popup').find('source').attr('src', src);
					$('.video-popup').find('video')[0].load();
					$('.video-popup').find('video')[0].play();
				}
			});
		} else {
			videoHoverOnly.on({
				click: function() {
					var src = $(this).attr('data-src');
					var poster = $(this).attr('data-poster');

					$('body').addClass('video-popup-active');
					$('.video-popup').find('video').attr('poster', poster);
					$('.video-popup').find('source').attr('src', src);
					$('.video-popup').find('video')[0].load();
					$('.video-popup').find('video')[0].play();
				}
			});
		}
	}

	$document.ready(function(e) {
		videoHover();
		videoHoverOnly();

		// Image Map Resizer

		$('map').imageMapResize();

		// Hamburger Menu

		$('.header__hamburger').on('click', function(e) {
			$('body').toggleClass('hamburger-active');
		});

		// Banner Video Form

		$('.banner__vf-video video').on('click', function(e) {
			if ( $(this).parent().hasClass('banner__vf-video--active') ) {
				$(this).parent().removeClass('banner__vf-video--active');
				$(this)[0].pause();
			} else {
				$(this).parent().addClass('banner__vf-video--active');
				$(this)[0].play();
			}
		});

		// Resources List Search

		$('.banner__resources-search input').on('keyup', function() {
			var searchValue = $(this).val();

			$.ajax({
				url: php_vars.admin_ajax_url,
				type: 'post',
				data: { 
					action: 'resources_search_ajax', 
					keyword: searchValue 
				},
				success: function(html) {
					if ( searchValue ) {
						$('.banner__resources-result ul').html(html);
						$('.banner__resources-result').slideDown();
					} else {
						$('.banner__resources-result').slideUp();
						$('.banner__resources-result ul').empty();
					}
				}
			});
		});

		$('.resources-list__search input').on('keyup', function() {
			var searchValue = $(this).val();

			$.ajax({
				url: php_vars.admin_ajax_url,
				type: 'post',
				data: { 
					action: 'resources_search_ajax', 
					keyword: searchValue 
				},
				success: function(html) {
					if ( searchValue ) {
						$('.resources-list__result ul').html(html);
						$('.resources-list__result').slideDown();
					} else {
						$('.resources-list__result').slideUp();
						$('.resources-list__result ul').empty();
					}
				}
			});
		});

		// Resources List Category

		$('.banner__resources-categories-mobile').on('click', function(e) {
			$(this).find('ul').stop().slideToggle();
			$(this).toggleClass('banner__resources-categories-mobile--active');
		});

		$('.resources-list__categories-mobile').on('click', function(e) {
			$(this).find('ul').stop().slideToggle();
			$(this).toggleClass('resources-list__categories-mobile--active');
		});
		
		// Video Popup

		$('a[href="#video-popup"]').on('click', function(e) {
			e.preventDefault();
			var src = $(this).attr('data-src');
			var poster = $(this).attr('data-poster');

			$('body').addClass('video-popup-active');
			$('.video-popup').find('video').attr('poster', poster);
			$('.video-popup').find('source').attr('src', src);
			$('.video-popup').find('video')[0].load();
			$('.video-popup').find('video')[0].play();
		});

		$('.video-popup__close').on('click', function(e) {
			$('body').removeClass('video-popup-active');
			$('.video-popup').find('video')[0].pause();
		});

		// Centered Content - Hover V2

		var ccHoverClass = '';

		$('.centered-content__d-image-v2 area').on({
			mouseover: function() {
				ccHoverClass = $(this).attr('class');
				$('#' + ccHoverClass).addClass('centered-content__d-hover-v2--active');
			},
			mouseout: function() {
				$('.centered-content__d-hover-v2').removeClass('centered-content__d-hover-v2--active');
			}
		})
	});

	$document.click(function(e) {
	});

	$window.on('load', function() {
		// Video Autoplay

		$('.video-autoplay').bind('inview', function (event, visible) {
			if ( visible == true ) {
				$(this).find('video')[0].play();
				$(this).addClass('video-play');
			}
		});

		// Centered Content - Slider

		$('.centered-content__d-slider').owlCarousel({
			items: 1,
			loop: true,
			margin: 10,
			nav: false
		});

		// Illustration - Slider

		$('.illustration__d-sub-slider').owlCarousel({
			items: 2,
			loop: true,
			margin: 10,
			nav: false,
			dots: true,
			autoplay: true,
			autoplayTimeout: 5000,
			autoplayHoverPause: false,
			responsive : {
				0 : {
					items: 1
				},
				768 : {
					items: 2
				}
			}
		});

		singleBlog();
	});

	$window.on('scroll', function() {
		// Onscroll

		if ( $document.scrollTop() > 0 ) {
			$('body').addClass('onscroll');
		} else {
			$('body').removeClass('onscroll');
		}
	});

	$window.resize(function() {
		singleBlog();
		videoHover();
		videoHoverOnly();
	});

	// Lazy Load

	var myLazyLoad = new LazyLoad();
})(jQuery);