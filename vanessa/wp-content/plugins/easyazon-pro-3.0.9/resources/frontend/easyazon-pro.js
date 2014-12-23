jQuery(document).ready(function($) {
	// Localize links appropriately
	function easyazon_localize() {
		var products = {};
		$('[data-easyazon-localize*="data-easyazon-localize"]').map(function(index, element) {
			var $element = $(element),
				asin = $element.data('easyazon-asin'),
				keywords = $element.data('easyazon-keywords'),
				locale = $element.data('easyazon-locale');

			if('undefined' === typeof products[locale]) {
				products[locale] = {asins: [], keywords: []};
			}

			if('undefined' !== typeof asin) {
				if(-1 === $.inArray(asin, products[locale].asins)) {
					products[locale].asins.push(asin)
				}
			} else if('undefined' !== typeof keywords) {
				if(-1 === $.inArray(keywords, products[locale].keywords)) {
					products[locale].keywords.push(keywords);
				}
			}

			return true;
		});

		for(var locale in products) {
			$.post(
				EasyAzon_Pro.ajaxUrl,
				{
					action: EasyAzon_Pro.ajaxActionLocalize,
					asins: products[locale].asins,
					keywords: products[locale].keywords,
					locale: locale
				},
				function(data, status) {
					var $localeLinks = $('a[data-easyazon-locale="' + data.locale + '"]');

					if(data.buyNowUrl) {
						$localeLinks.filter('[data-easyazon-buy="data-easyazon-buy"]').find('img').attr('src', data.buyNowUrl);
					}

					if(data.asins) {
						var asin;
						for(var asin_index = 0; asin_index < data.asins.length; asin_index++) {
							asin = data.asins[asin_index];

							$localeLinks.filter('[data-easyazon-asin="' + asin.asin + '"]').attr('href', asin.url).filter('[data-easyazon-price="data-easyazon-price"]').text(EasyAzon_Pro.clickToSeePrice);
						}
					}

					if(data.keywords) {
						var keywords;
						for(var keywords_index = 0; keywords_index < data.keywords.length; keywords_index++) {
							keywords = data.keywords[keywords_index];

							$localeLinks.filter('[data-easyazon-keywords="' + keywords.keywords + '"]').attr('href', keywords.url);
						}
					}
				},
				'json'
			);
		}
	}

	// Popups
	var $popoverShowing = null,
		_popupInterval = 1500,
		_popupTimeout = null,
		_clearPopupTimeout = function() {
			if(null !== _popupTimeout) {
				clearTimeout(_popupTimeout);

				_popupTimeout = null;
			}
		},
		_removePopover = function() {
			if(null !== $popoverShowing) {
				_clearPopupTimeout();

				$popoverShowing.popover('hide');
				$popoverShowing = null;
			}
		},
		_setPopupTimeout = function() {
			_popupTimeout = setTimeout(_removePopover, _popupInterval);
		};

	$('[data-easyazon-popups*="data-easyazon-popups"]').popover({
		container: 'body',
		content: function() {
			var $this = $(this);

			return $this.find('.easyazon-popup-hidden').html();
		},
		html: true,
		placement: 'auto bottom',
		template: '<div class="popover easyazon-popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content easyazon-popover-content easyazon-popover-content-actionable"></div></div>',
		trigger: 'manual'
	}).hover(function(event) {
		var $this = $(this);

		if(null === $popoverShowing || $this.get(0) !== $popoverShowing.get(0)) {
			_removePopover();
			$this.popover('show');
			$popoverShowing = $this;
		} else {
			_clearPopupTimeout();
		}
	}, function(event) {
		_setPopupTimeout();
	}).each(function(index, element) {
		// Pull out the content and place it into the hidden element
		var $element = $(element), $hidden = $('<div class="easyazon-popup-hidden"></div>');

		$hidden.html($element.data('content'));
		$element.append($hidden).removeAttr('data-content');
	});

	$(document).on('mouseenter', '.easyazon-popover-content.easyazon-popover-content-actionable', function() {
		_clearPopupTimeout();
	}).on('mouseleave', '.easyazon-popover-content', function() {
		_setPopupTimeout();
	});

	$('.easyazon-price-disclaimer').popover({
		container: 'body',
		html: true,
		placement: 'auto bottom',
		template: '<div class="popover easyazon-popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content easyazon-popover-content"></div></div>',
		trigger: 'hover'
	});

	easyazon_localize();
});

