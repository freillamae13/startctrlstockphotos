(function($) {
	var $document = $(document);
	var $window = $(window);
	var $body = $('body');
	
	var media767 = window.matchMedia("(max-width: 767px)");

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

	function sameHeight(element) {
		var maxHeight = 0;

		$(element).each(function(){
			if ( $(this).height() > maxHeight ) { 
				maxHeight = $(this).height(); 
			}
		});

		$(element).height( maxHeight );
	}
  
	$document.ready(function(e) {
		// Hamburger Menu

		$('.header__hamburger').on('click', function(e) {
			$('body').toggleClass('hamburger-active');
		});

		//blog search
		$('.blog-list__search input').on('keyup', function() {
			var searchValue = $(this).val();

			$.ajax({
				url: php_vars.admin_ajax_url,
				type: 'post',
				data: { 
					action: 'blog_list_search_ajax', 
					keyword: searchValue 
				},
				success: function(html) {
					if ( searchValue ) {
						$('.blog-list__search-result').html(html);
						$('.blog-list__search-result').slideDown();
					} else {
						$('.blog-list__search-result').slideUp();
						$('.blog-list__search-result').empty();
					}
				}
			});
		});

		var $catSelect = $('.category-dropdown');

		if ( $catSelect.length ) {
	
		  $catSelect.val('');
	
		  $catSelect.on('change', function() {
	
			var $selectPath = this.value;
	
			if ( $selectPath.length ) {
			  window.location.href = $selectPath;
			}
	
		  });
	
		}
	});

	$document.click(function(e) {
	});

	$window.on('load', function() {
		// Photo Content - Centered

		if ( !media767.matches ) {
			sameHeight('.photo-content__c-column-item');
		} else {
			$('.photo-content__c-column-item').css('height', '');
		}
	});

	$window.on('scroll', function() {
	});

	$window.resize(function() {
		// Photo Content - Centered

		if ( !media767.matches ) {
			sameHeight('.photo-content__c-column-item');
		} else {
			$('.photo-content__c-column-item').css('height', '');
		}
	});

	// Lazy Load

	var myLazyLoad = new LazyLoad();
})(jQuery);