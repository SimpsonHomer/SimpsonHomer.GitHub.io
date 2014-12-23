jQuery(document).ready(function($) {
	$('#_easyazon_settings-links_cloaking_yes').change(function(event) {
		var $this = $(this),
			$next = $this.parents('tr').next('tr');

		if($this.is(':checked')) {
			$next.show();
		} else {
			$next.hide();
		}
	}).change();
});

window.EAVM_CALLBACKS = window.EAVM_CALLBACKS || [];

window.EAVM_CALLBACKS.push(function(EAVM) {
	// Shortcodes

	// Data
	EAVM.shortcodeAlignment = ko.observable('left');
	EAVM.shortcodeAlignmentBlock = ko.observable('left');
	EAVM.shortcodeAltText = ko.observable('');
	EAVM.shortcodeImageObject = ko.observable({});
	EAVM.shortcodeImageObjectSrc = ko.computed(function() { var obj = EAVM.shortcodeImageObject(); return obj && obj.URL ? obj.URL : EasyAzon.placeholderUrl; });
	EAVM.shortcodeImageObjectHeight = ko.computed(function() { var obj = EAVM.shortcodeImageObject(); return obj && obj.Height ? obj.Height : EasyAzon.placeholderHeight; });
	EAVM.shortcodeImageObjectWidth = ko.computed(function() { var obj = EAVM.shortcodeImageObject(); return obj && obj.Width ? obj.Width : EasyAzon.placeholderWidth; });
	EAVM.shortcodeCallToActionKey = ko.observable('');
	EAVM.shortcodeLayout = ko.observable('top');
	EAVM.shortcodeLinkAddToCart = ko.observable('default');
	EAVM.shortcodeLinkCloaking = ko.observable('default');
	EAVM.shortcodeLinkLocalization = ko.observable('default');
	EAVM.shortcodeLinkNofollow = ko.observable('default');
	EAVM.shortcodeLinkPopups = ko.observable('default');
	EAVM.shortcodeSearchTerms = ko.observable('');

	EAVM.shortcodeImages = ko.computed(function() {
		var images = [],
			result = EAVM.shortcodeProduct(),
			product = (false === result) ? false : result.original;

		if(!((false === product) || ('undefined' === (typeof product.ImageSets) || 'undefined' === typeof(product.ImageSets.ImageSet) || 0 === product.ImageSets.ImageSet.length))) {
			jQuery.map(product.ImageSets.ImageSet, function(item, key) {
				if(item.URL) {
					images.push(jQuery.extend(item, {
						Key: key,
						Size: key.replace('Image', '') + ' - ' + item.Width + ' x ' + item.Height
					}));
				}
			});
		}

		return images;
	});
	EAVM.hasShortcodeImages = ko.computed(function() { return EAVM.shortcodeImages().length > 0; });
	EAVM.chooseShortcodeImage = function() {
		var images = EAVM.shortcodeImages(),
			mediumImage = ko.utils.arrayFirst(images, function(image) {
				return 'MediumImage' === image.Key;
			});

		if(mediumImage) {
			EAVM.shortcodeImageObject(mediumImage);
		}
	};

	EAVM.shortcodeCallsToAction = ko.computed(function() {
		return ('undefined' !== typeof EasyAzon.callsToAction[EAVM.locale()]) ? EasyAzon.callsToAction[EAVM.locale()] : [];
	});
	EAVM.shortcodeCallToActionObject = ko.computed(function() {
		return ko.utils.arrayFirst(EAVM.shortcodeCallsToAction(), function(item) { return EAVM.shortcodeCallToActionKey() === item.key; });
	});
	EAVM.chooseCallToAction = function() {
		var callsToAction = EAVM.shortcodeCallsToAction();
		if('' === EAVM.shortcodeCallToActionKey() && callsToAction.length > 0) {
			EAVM.shortcodeCallToActionKey(callsToAction[0].key);
		}
	};

	/// Block
	EAVM.gatherShortcodeBlockAttributes = function() {
		return {
			add_to_cart: EAVM.shortcodeLinkAddToCart(),
			align: EAVM.shortcodeAlignmentBlock(),
			asin: EAVM.shortcodeProduct().original.ASIN,
			cloaking: EAVM.shortcodeLinkCloaking(),
			layout: EAVM.shortcodeLayout(),
			localization: EAVM.shortcodeLinkLocalization(),
			locale: EAVM.locale(),
			nofollow: EAVM.shortcodeLinkNofollow(),
			new_window: EAVM.shortcodeLinkNewWindow(),
			tag: EAVM.shortcodeTagFormatted()
		};
	};
	EAVM.insertShortcodeBlock = function() {
		EAVM.insertShortcode(EasyAzon.shortcodeBlock, EAVM.gatherShortcodeBlockAttributes(), EAVM.shortcodeContent());
	}
	EAVM.shortcodeBlock = function(searchResult) {
		EAVM.shortcodeProduct(searchResult);

		EAVM.chooseLocaleTag();

		EAVM.state('shortcodeBlock');
	};
	EAVM.shortcodeBlockStateActive = ko.computed(function() { return 'shortcodeBlock' === EAVM.state(); });

	/// Call to action
	EAVM.gatherShortcodeCallToActionAttributes = function() {
		return {
			add_to_cart: EAVM.shortcodeLinkAddToCart(),
			align: EAVM.shortcodeAlignment(),
			asin: EAVM.shortcodeProduct().original.ASIN,
			cloaking: EAVM.shortcodeLinkCloaking(),
			height: EAVM.shortcodeCallToActionObject().height,
			key: EAVM.shortcodeCallToActionObject().key,
			localization: EAVM.shortcodeLinkLocalization(),
			locale: EAVM.locale(),
			nofollow: EAVM.shortcodeLinkNofollow(),
			new_window: EAVM.shortcodeLinkNewWindow(),
			tag: EAVM.shortcodeTagFormatted(),
			width: EAVM.shortcodeCallToActionObject().width
		};
	};
	EAVM.insertShortcodeCallToAction = function() {
		EAVM.insertShortcode(EasyAzon.shortcodeCallToAction, EAVM.gatherShortcodeCallToActionAttributes(), EAVM.shortcodeContent());
	}
	EAVM.shortcodeCallToAction = function(searchResult) {
		EAVM.shortcodeAltText(searchResult.title);
		EAVM.shortcodeProduct(searchResult);
		EAVM.state('shortcodeCallToAction');

		EAVM.chooseLocaleTag();
		EAVM.chooseCallToAction();
	};
	EAVM.shortcodeCallToActionStateActive = ko.computed(function() { return 'shortcodeCallToAction' === EAVM.state(); });

	/// Image
	EAVM.gatherShortcodeImageAttributes = function() {
		return {
			add_to_cart: EAVM.shortcodeLinkAddToCart(),
			align: EAVM.shortcodeAlignment(),
			asin: EAVM.shortcodeProduct().original.ASIN,
			cloaking: EAVM.shortcodeLinkCloaking(),
			height: EAVM.shortcodeImageObject().Height,
			localization: EAVM.shortcodeLinkLocalization(),
			locale: EAVM.locale(),
			nofollow: EAVM.shortcodeLinkNofollow(),
			new_window: EAVM.shortcodeLinkNewWindow(),
			src: EAVM.shortcodeImageObject().URL,
			tag: EAVM.shortcodeTagFormatted(),
			width: EAVM.shortcodeImageObject().Width
		};
	};
	EAVM.insertShortcodeImage = function() {
		EAVM.insertShortcode(EasyAzon.shortcodeImage, EAVM.gatherShortcodeImageAttributes(), EAVM.shortcodeContent());
	}
	EAVM.shortcodeImage = function(searchResult) {
		EAVM.shortcodeAltText(searchResult.title);
		EAVM.shortcodeProduct(searchResult);

		EAVM.chooseLocaleTag();
		EAVM.chooseShortcodeImage();

		EAVM.state('shortcodeImage');
	};
	EAVM.shortcodeImageStateActive = ko.computed(function() { return 'shortcodeImage' === EAVM.state(); });

	/// Search
	EAVM.gatherShortcodeSearchAttributes = function() {
		return {
			cloaking: EAVM.shortcodeLinkCloaking(),
			keywords: EAVM.shortcodeSearchTerms(),
			localization: EAVM.shortcodeLinkLocalization(),
			locale: EAVM.locale(),
			nofollow: EAVM.shortcodeLinkNofollow(),
			new_window: EAVM.shortcodeLinkNewWindow(),
			tag: EAVM.shortcodeTagFormatted()
		};
	};
	EAVM.insertShortcodeSearch = function() {
		EAVM.insertShortcode(EasyAzon.shortcodeText, EAVM.gatherShortcodeSearchAttributes(), EAVM.shortcodeContent());
	};
	EAVM.shortcodeSearch = function() {
		EAVM.shortcodeContent(EAVM.searchTerms());
		EAVM.shortcodeSearchTerms(EAVM.searchTerms());

		EAVM.chooseLocaleTag();

		EAVM.state('shortcodeSearch');
	};
	EAVM.shortcodeSearchStateActive = ko.computed(function() { return 'shortcodeSearch' === EAVM.state(); });

	/// Text
	EAVM.gatherShortcodeTextAttributesOriginal = EAVM.gatherShortcodeTextAttributes;
	EAVM.gatherShortcodeTextAttributes = function() {
		return jQuery.extend(EAVM.gatherShortcodeTextAttributesOriginal(), {
			add_to_cart: EAVM.shortcodeLinkAddToCart(),
			cloaking: EAVM.shortcodeLinkCloaking(),
			localization: EAVM.shortcodeLinkLocalization(),
			nofollow: EAVM.shortcodeLinkNofollow(),
			popups: EAVM.shortcodeLinkPopups()
		});
	};
});