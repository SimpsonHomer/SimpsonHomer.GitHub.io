<?php
/*
 Plugin Name: EasyAzon - Pro
 Plugin URI: http://easyazon.com/
 Description: Enhances the EasyAzon plugin by providing extended search and insert capabilities, link localization, and more. By installing this plugin, you agree to the <a href="http://easyazon.com/terms/" target="_blank">EasyAzon terms of service</a>.
 Version: 3.0.9
 Author: EasyAzon
 Author URI: http://easyazon.com/
 */

define('EASYAZON_PRO_VERSION', '3.0.9');

class EasyAzon_Pro {
	/// Constants

	//// Shortcodes
	const SHORTCODE_BLOCK = 'easyazon_block';
	const SHORTCODE_BLOCK_LEGACY = 'easyazon-block';
	const SHORTCODE_CTA = 'easyazon_cta';
	const SHORTCODE_CTA_LEGACY = 'easyazon-cta';
	const SHORTCODE_IMAGE = 'easyazon_image';
	const SHORTCODE_IMAGE_LEGACY = 'easyazon-image';
	const SHORTCODE_IMAGE_SIMPLEAZON = 'simpleazon-image';

	//// TRANSIENT KEYS
	const TRANSIENT_ASIN_ITEM = '_eapasin_';

	// Compliance for product advertising API - requires product information to be updated at least hourly or to display a notice
	// The UX we create doesn't allow for a notice, so this constant defines that product information should be refreshed
	// at least once an hour
	const TRANSIENT_ASIN_ITEM_TIMEOUT = 3600; // 1 hour

	//// Defaults
	private static $default_settings = null;

	//// GeoIP
	private static $geoip_database = null;

	public static function init() {
		self::add_actions();
		self::add_filters();
	}

	private static function add_actions() {
		$easyazon_installed = function_exists('easyazon_get_setting');

		remove_action('easyazon_after_search', array('EasyAzon_Core', 'display_search_upgrade_nag'));
		remove_action('easyazon_shortcode_after_actions', array('EasyAzon_Core', 'shortcode_after_actions'));

		add_action('easyazon_register_resources', array(__CLASS__, 'register_resources'), 11);
		add_action('easyazon_register_shortcodes', array(__CLASS__, 'register_shortcodes'), 11);
		add_action('easyazon_admin_enqueue_scripts', array(__CLASS__, 'admin_enqueue_scripts'), 11);
		add_action('easyazon_after_search_button', array(__CLASS__, 'output_search_terms_link'));

		if($easyazon_installed) {
			// Ajax
			add_action('wp_ajax_nopriv_easyazon_localize', array(__CLASS__, 'ajax_localize_links'));
			add_action('wp_ajax_easyazon_localize', array(__CLASS__, 'ajax_localize_links'));

			// Cloaking
			add_action('generate_rewrite_rules', array(__CLASS__, 'add_rewrite_rules'));
			add_action('parse_request', array(__CLASS__, 'cloaked'));
		}

		if(is_admin()) {
			add_action('easyazon_load_settings_page', array(__CLASS__, 'load_settings_page'), 11);
			add_action('easyazon_after_process', array(__CLASS__, 'get_media_upload_output'));
			add_action('easyazon_shortcode_link_options', array(__CLASS__, 'add_shortcode_link_options'));
		} else {
			if($easyazon_installed) {
				add_action('wp_head', array(__CLASS__, 'frontend_enqueue_scripts'));
			}
		}
	}

	private static function add_filters() {
		$easyazon_installed = function_exists('easyazon_get_setting');

		// Cloaking
		add_filter('easyazon_get_product_link_url', array(__CLASS__, 'get_product_link_url_cart'), 11, 2);
		add_filter('easyazon_get_product_link_url', array(__CLASS__, 'get_product_link_url_cloaked'), 12, 2);

		if($easyazon_installed) {
			add_filter('query_vars', array(__CLASS__, 'add_query_vars'));
		}

		// Localize
		add_filter('easyazon_localize_script', array(__CLASS__, 'add_localize_script'));

		// Searchable
		add_filter('easyazon_get_associate_tags', array(__CLASS__, 'add_associate_tags'), 11);
		add_filter('easyazon_get_locales', array(__CLASS__, 'add_locales'));
		add_filter('easyazon_get_search_result_actions', array(__CLASS__, 'add_search_result_actions'));

		// Settings
		add_filter('easyazon_clean_settings', array(__CLASS__, 'clean_settings'));
		add_filter('easyazon_default_settings', array(__CLASS__, 'default_settings'));
		add_filter('easyazon_sanitize_settings', array(__CLASS__, 'sanitize_settings'), 10, 3);

		// Links
		add_filter('easyazon_get_product_link_attributes', array(__CLASS__, 'get_product_link_attributes'), 10, 2);

		// Shortcodes
		add_filter('easyazon_shortcode_default_attributes', array(__CLASS__, 'add_shortcode_default_attributes'), 10, 2);

		if($easyazon_installed && is_admin()) {
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(__CLASS__, 'add_settings_link'));
		}
	}

	/// Callbacks

	//// Ajax

	public static function ajax_localize_links() {
		$data = stripslashes_deep($_REQUEST);
		$products_locale = strtoupper($data['locale']);
		$visitor_locale = self::get_visitor_locale();

		$results = array(
			'asins' => array(),
			'buyNowUrl' => false,
			'keywords' => array(),
			'locale' => $products_locale,
		);

		if($products_locale !== $visitor_locale) {
			$results['buyNowUrl'] = plugins_url("resources/frontend/img/bn/{$visitor_locale}/buy-now.gif", __FILE__);

			$asins = isset($data['asins']) ? $data['asins'] : array();
			$keywords = isset($data['keywords']) ? $data['keywords'] : array();
			$tags = easyazon_get_associate_tags();
			$tld = EasyAzon_Amazon_API::get_locale_tld($visitor_locale);

			$tag = isset($tags[$visitor_locale]) && !empty($tags[$visitor_locale]) ? $tags[$visitor_locale][0] : false;

			$items = self::get_items($asins, $products_locale);
			foreach($items as $item) {
				$results['asins'][] = array(
					'asin' => $item['ASIN'],
					'locale' => $products_locale,
					'url' => easyazon_get_product_link_url(array(
						'locale' => $visitor_locale,
						'keywords' => self::_get_item_title($item),
						'tag' => $tag,
					)),
				);
			}

			foreach($keywords as $keyword) {
				$results['keywords'][] = array(
					'keywords' => $keyword,
					'locale' => $products_locale,
					'url' => easyazon_get_product_link_url(array(
						'locale' => $visitor_locale,
						'keywords' => $keyword,
						'tag' => $tag,
					)),
				);
			}
		}

		wp_send_json($results);
	}

	//// Administrative interface

	public static function add_localize_script($strings) {
		return array_merge($strings, array(
			'callsToAction' => self::get_calls_to_action(),

			'shortcodeBlock' => self::SHORTCODE_BLOCK,
			'shortcodeCallToAction' => self::SHORTCODE_CTA,
			'shortcodeImage' => self::SHORTCODE_IMAGE,
		));
	}

	public static function add_shortcode_link_options($context) {
		include('views/search/_inc/link-options.php');
	}

	public static function get_media_upload_output() {
		include('views/search/process.php');
	}

	public static function output_search_terms_link() {
		include('views/search/_inc/terms.php');
	}

	public static function register_resources() {
		wp_register_script('easyazon-bootstrap', plugins_url('resources/vendor/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'), '3.0.2.M');
		wp_register_style('easyazon-bootstrap', plugins_url('resources/vendor/bootstrap/css/bootstrap.min.css', __FILE__), array(), '3.0.2.M');

		wp_register_script('easyazon-pro-backend', plugins_url('resources/backend/easyazon-pro.js', __FILE__), array('jquery', 'easyazon-backend'), EASYAZON_PRO_VERSION, true);
		wp_register_style('easyazon-pro-backend', plugins_url('resources/backend/easyazon-pro.css', __FILE__), array('easyazon-backend'), EASYAZON_PRO_VERSION);

		wp_register_script('easyazon-pro-frontend', plugins_url('resources/frontend/easyazon-pro.js', __FILE__), array('jquery', 'easyazon-bootstrap'), EASYAZON_PRO_VERSION, true);
		wp_register_style('easyazon-pro-frontend', plugins_url('resources/frontend/easyazon-pro.css', __FILE__), array('easyazon-bootstrap'), EASYAZON_PRO_VERSION);

		wp_localize_script('easyazon-pro-frontend', 'EasyAzon_Pro', array(
			'ajaxActionLocalize' => 'easyazon_localize',
			'ajaxUrl' => admin_url('admin-ajax.php'),
			'clickToSeePrice' => __('Click to see...'),
		));
	}

	//// Frontend interface

	public static function frontend_enqueue_scripts() {
		wp_enqueue_script('easyazon-pro-frontend');
		wp_enqueue_style('easyazon-pro-frontend');
	}

	//// Output

	public static function get_product_link_attributes($attributes, $input) {
		if(isset($input['asin']) && !empty($input['asin'])) {
			$attributes['data-easyazon-asin'] = $input['asin'];
		}

		if(isset($input['locale'])) {
			$attributes['data-easyazon-locale'] = $input['locale'];
		}

		if(isset($input['keywords']) && !empty($input['keywords'])) {
			$attributes['data-easyazon-keywords'] = $input['keywords'];
		}

		if(isset($input['src'])) {
			$attributes['class'] = isset($attributes['class']) && is_array($attributes['class']) ? array_merge($attributes['class'], array('easyazon-link', 'easyazon-link-image')) : array('easyazon-link', 'easyazon-link-image');

			if(isset($input['align']) && 'none' !== $input['align']) {
				$attributes['class'][] = 'easyazon-link-image-align';
			}
		}

		if(isset($input['localization']) && ('yes' === $input['localization'] || ('default' === $input['localization'] && 'yes' === easyazon_get_setting('links_localization')))) {
			$attributes['data-easyazon-localize'] = isset($attributes['data-easyazon-localize']) && is_array($attributes['data-easyazon-localize']) ? array_merge($attributes['data-easyazon-localize'], array('data-easyazon-localize')) : array('data-easyazon-localize');
		}

		if(isset($input['popups']) && ('yes' === $input['popups'] || ('default' === $input['popups'] && 'yes' === easyazon_get_setting('links_popups')))) {
			if(isset($input['asin']) && !empty($input['asin']) && isset($input['locale']) && !empty($input['locale']) && ($item = self::get_item($input['asin'], $input['locale']))) {
				$attributes['data-easyazon-popups'] = isset($attributes['data-easyazon-popups']) && is_array($attributes['data-easyazon-popups']) ? array_merge($attributes['data-easyazon-popups'], array('data-easyazon-popups')) : array('data-easyazon-popups');

				$locale = strtoupper($input['locale']);

				$image = self::_get_item_image($item);
				$price_actual = self::_get_item_price_actual($item);
				$price_list = self::_get_item_price_list($item);
				$title = self::_get_item_title($item);

				$cloned_attributes = $input;
				unset($cloned_attributes['popups']);
				$link_attributes = easyazon_get_product_link_attributes($cloned_attributes);
				$link_attributes_string = easyazon_attributes_array_to_attributes_string($link_attributes);
				$link_url = easyazon_get_product_link_url($cloned_attributes);

				$content = '';
				$content .= '<div class="easyazon-popup">';

				if($image) {
					$content .= sprintf('<div class="easyazon-popup-image-container"><a %5$s href="%6$s"><img alt="%1$s" class="easyazon-popup-image" src="%2$s" height="%3$d" width="%4$d" /></a></div>', esc_attr($title), esc_attr(esc_url($image['URL'])), $image['Height'], $image['Width'], $link_attributes_string, $link_url);
				}

				$content .= '<div class="easyazon-popup-attributes">';
				$content .= sprintf('<div class="easyazon-popup-attribute"><a %2$s href="%3$s">%1$s</a></div>', esc_html($title), $link_attributes_string, esc_attr(esc_url($link_url)));

				if($price_list) {
					$content .= sprintf('<div class="easyazon-popup-attribute"><strong>%1$s</strong>: <a %3$s data-easyazon-price="data-easyazon-price" href="%4$s">%2$s</a></div>', esc_html(__('List Price')), esc_html($price_list), $link_attributes_string, esc_attr(esc_url($link_url)));
				}

				if($price_actual) {
					$content .= sprintf('<div class="easyazon-popup-attribute"><strong>%1$s</strong>: <a %3$s data-easyazon-price="data-easyazon-price" href="%4$s">%2$s</a></div>', esc_html(__('Current Price')), esc_html($price_actual), $link_attributes_string, esc_attr(esc_url($link_url)));
				}

				$content .= '<div class="easyazon-block-attribute easyazon-block-attribute-buy-now">';
				$content .= sprintf('<a %1$s data-easyazon-buy="data-easyazon-buy" href="%2$s"><img alt="%3$s" class="easyazon-buy-button" src="%4$s" /></a>', $link_attributes_string, esc_attr(esc_url($link_url)), __('Buy Now'), plugins_url("resources/frontend/img/bn/{$locale}/buy-now.gif", __FILE__));
				$content .= '</div>';

				$content .= '<div class="easyazon-block-attribute easyazon-block-attribute-price-disclaimer">';
				$content .= sprintf('<small class="easyazon-price-disclaimer">%1$s</small>', sprintf(__('Prices are accurate as of %1$s.'), date('m/d/Y \a\t g:i A', $item['Fetched'])));
				$content .= '</div>';

				$content .= '</div>';
				$content .= '<div class="easyazon-popup-clear"></div></div>';

				$attributes['data-content'] = $content;
			}
		}

		return $attributes;
	}

	//// Cloaking

	public static function add_query_vars($vars) {
		if('yes' === easyazon_get_setting('links_cloaking')) {
			$vars[] = 'easyazon-asin';
			$vars[] = 'easyazon-keywords';
			$vars[] = 'easyazon-locale';
			$vars[] = 'easyazon-tag';
		}

		return $vars;
	}

	public static function add_rewrite_rules($wp_rewrite) {
		if('yes' === easyazon_get_setting('links_cloaking')) {
			$cloaking_prefix = easyazon_get_setting('links_cloaking_prefix');

			$wp_rewrite->rules = array(
				sprintf('%1$s/([^/]+)/([^/]+)(/([^/]+))?/?$', $cloaking_prefix) => sprintf('index.php?easyazon-asin=%s&easyazon-locale=%s&easyazon-tag=%s', $wp_rewrite->preg_index(1), $wp_rewrite->preg_index(2), $wp_rewrite->preg_index(4)),
				sprintf('%1$ss/([^/]+)/([^/]+)(/([^/]+))?/?$', $cloaking_prefix) => sprintf('index.php?easyazon-keywords=%s&easyazon-locale=%s&easyazon-tag=%s', $wp_rewrite->preg_index(1), $wp_rewrite->preg_index(2), $wp_rewrite->preg_index(4)),
			) + $wp_rewrite->rules;
		}
	}

	public static function cloaked($wp) {
		if('yes' === easyazon_get_setting('links_cloaking')) {
			$add_to_cart = (isset($_GET['cart']) && 'yes' === $_GET['cart']) ? 'yes' : 'no';
			$asin = urldecode(isset($wp->query_vars['easyazon-asin']) ? $wp->query_vars['easyazon-asin'] : false);
			$keywords = urldecode(isset($wp->query_vars['easyazon-keywords']) ? $wp->query_vars['easyazon-keywords'] : false);
			$locale = urldecode(isset($wp->query_vars['easyazon-locale']) ? $wp->query_vars['easyazon-locale'] : false);
			$tag = urldecode(isset($wp->query_vars['easyazon-tag']) ? $wp->query_vars['easyazon-tag'] : false);

			if(($asin || $keywords) && $locale) {
				remove_filter('easyazon_get_product_link_url', array(__CLASS__, 'get_product_link_url_cloaked'), 12);

				easyazon_redirect(easyazon_get_product_link_url(compact('add_to_cart', 'asin', 'keywords', 'locale', 'tag')));
			}
		}
	}

	public static function get_product_link_url_cart($url, $attributes) {
		$add_to_cart = isset($attributes['add_to_cart']) && ('yes' === $attributes['add_to_cart'] || ('default' === $attributes['add_to_cart'] && 'yes' === easyazon_get_setting('links_add_to_cart')));
		if($add_to_cart) {
			$asin = isset($attributes['asin']) ? $attributes['asin'] : false;
			$locale = strtoupper(isset($attributes['locale']) ? $attributes['locale'] : 'US');
			$keywords = isset($attributes['keywords']) ? $attributes['keywords'] : false;
			$tag = isset($attributes['tag']) ? $attributes['tag'] : false;

			if($asin) {
				$access_key_id = easyazon_get_setting('access_key_id');
				$tld = EasyAzon_Amazon_API::get_locale_tld($locale);

				$url = sprintf('http://www.amazon.%s/gp/aws/cart/add.html?ASIN.1=%s&Quantity.1=1&AWSAccessKeyId=%s&AssociateTag=%s', $tld, $asin, $access_key_id, $tag);
			}
		}

		return $url;
	}

	public static function get_product_link_url_cloaked($url, $attributes) {
		$add_to_cart = isset($attributes['add_to_cart']) && ('yes' === $attributes['add_to_cart'] || ('default' === $attributes['add_to_cart'] && 'yes' === easyazon_get_setting('links_add_to_cart')));
		$cloaking = isset($attributes['cloaking']) && ('yes' === $attributes['cloaking'] || ('default' === $attributes['cloaking'] && 'yes' === easyazon_get_setting('links_cloaking')));
		if($cloaking) {
			$asin = isset($attributes['asin']) ? $attributes['asin'] : false;
			$locale = strtoupper(isset($attributes['locale']) ? $attributes['locale'] : 'US');
			$keywords = isset($attributes['keywords']) ? $attributes['keywords'] : false;
			$tag = isset($attributes['tag']) ? $attributes['tag'] : false;

			if($asin || $keywords) {
				$url = home_url('/');

				$cloaking_prefix = easyazon_get_setting('links_cloaking_prefix');

				if($asin) {
					$url .= sprintf('%3$s/%1$s/%2$s/', urlencode($asin), urlencode($locale), $cloaking_prefix);
				} else if($keywords) {
					$url .= sprintf('%3$ss/%1$s/%2$s/', urlencode($keywords), urlencode($locale), $cloaking_prefix);
				}

				if($tag) {
					$url .= trailingslashit(urlencode($tag));
				}

				if($add_to_cart) {
					$url = add_query_arg(array('cart' => 'yes'), $url);
				}
			}
		}

		return $url;
	}

	//// Shortcodes

	public static function add_shortcode_default_attributes($atts, $type) {
		$atts = array_merge($atts, array(
			'add_to_cart' => 'default',
			'cloaking' => 'default',
			'localization' => 'default',
			'nofollow' => 'default',
		));

		if(in_array($type, array('block', 'call-to-action', 'image'))) {
			$atts['align'] = 'left';
		}

		if(in_array($type, array('call-to-action', 'image'))) {
			$atts['alt'] = '';
			$atts['height'] = '';
			$atts['width'] = '';
		}

		if('block' === $type) {
			$atts['layout'] = 'left';
		}

		if('call-to-action' === $type) {
			$atts['key'] = '';
		}

		if('image' === $type) {
			$atts['src'] = '';
		}

		if('link' === $type) {
			$atts['keywords'] = '';
			$atts['popups'] = 'default';
		}

		return $atts;
	}

	public static function register_shortcodes() {
		add_shortcode(self::SHORTCODE_BLOCK, array(__CLASS__, 'shortcode_block'));
		add_shortcode(self::SHORTCODE_BLOCK_LEGACY, array(__CLASS__, 'shortcode_block'));

		add_shortcode(self::SHORTCODE_CTA, array(__CLASS__, 'shortcode_cta'));
		add_shortcode(self::SHORTCODE_CTA_LEGACY, array(__CLASS__, 'shortcode_cta'));

		add_shortcode(self::SHORTCODE_IMAGE, array(__CLASS__, 'shortcode_image'));
		add_shortcode(self::SHORTCODE_IMAGE_LEGACY, array(__CLASS__, 'shortcode_image'));
		add_shortcode(self::SHORTCODE_IMAGE_SIMPLEAZON, array(__CLASS__, 'shortcode_image'));
	}

	public static function shortcode_block($atts, $content = null) {
		$atts = shortcode_atts(apply_filters('easyazon_shortcode_default_attributes', array(), 'block'), $atts);

		extract($atts);

		if(empty($asin) || empty($locale) || false === ($item = self::get_item($asin, $locale))) {
			return '';
		} else {
			$link_attributes = easyazon_get_product_link_attributes($atts);
			$link_attributes_string = easyazon_attributes_array_to_attributes_string($link_attributes);
			$link_url = easyazon_get_product_link_url($atts);

			$buy_now_url = plugins_url("resources/frontend/img/bn/{$locale}/buy-now.gif", __FILE__);
			$image = self::_get_item_image($item);
			$price_actual = self::_get_item_price_actual($item);
			$price_list = self::_get_item_price_list($item);
			$title = self::_get_item_title($item);

			ob_start();
			include('views/shortcode/block.php');
			return ob_get_clean();
		}
	}

	public static function shortcode_cta($atts, $content = null) {
		$atts = shortcode_atts(apply_filters('easyazon_shortcode_default_attributes', array(), 'call-to-action'), $atts);
		$atts = array_merge(array(
			'src' => self::_shortcode_cta_src($atts['locale'], $atts['key'])
		), $atts);

		return self::shortcode_image($atts, $content);
	}

	private static function _shortcode_cta_src($locale, $key) {
		if(0 === strpos($key, 'amazon-us-')) {
			$locale = strtoupper(substr($key, 7, 2));
			$key = substr($key, 10);
		}

		$relative = sprintf('resources/frontend/img/cta/%1$s/%2$s.gif', $locale, $key);

		$file = path_join(dirname(__FILE__), $relative);
		$url = plugins_url($relative, __FILE__);

		return file_exists($file) ? $url : '';
	}

	public static function shortcode_image($atts, $content = null) {
		$atts = shortcode_atts(apply_filters('easyazon_shortcode_default_attributes', array(), 'image'), $atts);

		if(empty($atts['src'])) {
			return '';
		} else {
			$link_attributes = easyazon_get_product_link_attributes($atts);
			$link_url = easyazon_get_product_link_url($atts);

			$image_attributes = array(
				'alt' => $atts['alt'],
				'class' => array('easyazon-image', "align{$atts['align']}"),
				'height' => $atts['height'],
				'src' => esc_url($atts['src']),
				'width' => $atts['width'],
			);
			$image_tag = sprintf('<img %1$s />', easyazon_attributes_array_to_attributes_string($image_attributes));

			return sprintf('<a %1$s href="%2$s">%3$s</a>', easyazon_attributes_array_to_attributes_string($link_attributes), esc_attr(esc_url($link_url)), $image_tag);
		}
	}

	//// Search

	public static function add_search_result_actions($actions) {
		$actions[] = sprintf('<a href="#" data-bind="click: $parent.shortcodeImage">%1$s</a>', __('Image Link'));
		$actions[] = sprintf('<a href="#" data-bind="click: $parent.shortcodeBlock">%1$s</a>', __('Info Block'));
		$actions[] = sprintf('<a href="#" data-bind="click: $parent.shortcodeCallToAction">%1$s</a>', __('Call to Action'));

		return $actions;
	}

	//// Settings page

	public static function admin_enqueue_scripts() {
		wp_enqueue_script('easyazon-pro-backend');
		wp_enqueue_style('easyazon-pro-backend');
	}

	public static function load_settings_page() {
		if(isset($_GET['settings-updated'])) {
			flush_rewrite_rules();
		}

		add_settings_section('associates', __('Amazon Associates'), array(__CLASS__, 'display_settings_section__associates'), EasyAzon_Base::SETTINGS_PAGE);

		add_settings_field('links_new_window', __('New Window'), array(__CLASS__, 'display_settings_field__links__new_window'), EasyAzon_Base::SETTINGS_PAGE, 'links', array('label_for' => easyazon_get_settings_id('links_new_window_yes')));

		/* have to reset so that we can have the cloaking prefix in the correct place */
		global $wp_settings_fields;
		$wp_settings_fields[EasyAzon_Base::SETTINGS_PAGE]['links-extra'] = array();

		add_settings_section('links-extra', '', '__return_false', EasyAzon_Base::SETTINGS_PAGE);
		add_settings_field('links_nofollow', __('No Follow'), array(__CLASS__, 'display_settings_field__links__nofollow'), EasyAzon_Base::SETTINGS_PAGE, 'links-extra', array('label_for' => easyazon_get_settings_id('links_nofollow_yes')));
		add_settings_field('links_cloaking', __('Cloaking'), array(__CLASS__, 'display_settings_field__links__cloaking'), EasyAzon_Base::SETTINGS_PAGE, 'links-extra', array('label_for' => easyazon_get_settings_id('links_cloaking_yes')));
		add_settings_field('links_cloaking_prefix', __('Cloaking Prefix'), array(__CLASS__, 'display_settings_field__links__cloaking_prefix'), EasyAzon_Base::SETTINGS_PAGE, 'links-extra', array('label_for' => easyazon_get_settings_id('links_cloaking_prefix')));
		add_settings_field('links_popups', __('Product Popups'), array(__CLASS__, 'display_settings_field__links__popups'), EasyAzon_Base::SETTINGS_PAGE, 'links-extra', array('label_for' => easyazon_get_settings_id('links_popups_yes')));
		add_settings_field('links_add_to_cart', __('Add to Cart'), array(__CLASS__, 'display_settings_field__links__add_to_cart'), EasyAzon_Base::SETTINGS_PAGE, 'links-extra', array('label_for' => easyazon_get_settings_id('links_add_to_cart_yes')));
		add_settings_field('links_localization', __('Link Localization'), array(__CLASS__, 'display_settings_field__links__localization'), EasyAzon_Base::SETTINGS_PAGE, 'links-extra', array('label_for' => easyazon_get_settings_id('links_localization_yes')));

		add_settings_section('upsell', '', '__return_false', EasyAzon_Base::SETTINGS_PAGE);

		wp_enqueue_script('easyazon-pro-backend');
		wp_enqueue_style('easyazon-pro-backend');
	}

	public static function add_settings_link($actions) {
		if(function_exists('easyazon_get_settings_link')) {
			$actions = array('settings' => sprintf('<a href="%s" title="%s">%s</a>', easyazon_get_settings_link(), __('Configure EasyAzon Pro.'), __('Settings'))) + $actions;
		}

		return $actions;
	}

	//// Settings sections

	public static function display_settings_section__associates() {
		include('views/settings/associates.php');
	}

	//// Settings fields

	///// Links

	public static function display_settings_field__links__new_window() {
		$links_new_window = easyazon_get_setting('links_new_window');

		$settings_checked = 'yes' === $links_new_window ? 'checked="checked"' : '';
		$settings_error = easyazon_has_settings_error('links_new_window') ? 'easyazon-error' : '';
		$settings_id_no = easyazon_get_settings_id('links_new_window_no');
		$settings_id_yes = easyazon_get_settings_id('links_new_window_yes');
		$settings_name = easyazon_get_settings_name('links_new_window');

		printf('<input type="hidden" id="%1$s" name="%2$s" value="no" />', $settings_id_no, $settings_name);
		printf('<label><input type="checkbox" id="%1$s" name="%2$s" %3$s value="yes" /> %4$s</label>', $settings_id_yes, $settings_name, $settings_checked, __('I want EasyAzon links to open in a new window or tab'));
		easyazon_the_settings_error('links_new_window');
	}

	public static function display_settings_field__links__nofollow() {
		$links_nofollow = easyazon_get_setting('links_nofollow');

		$settings_checked = 'yes' === $links_nofollow ? 'checked="checked"' : '';
		$settings_error = easyazon_has_settings_error('links_nofollow') ? 'easyazon-error' : '';
		$settings_id_no = easyazon_get_settings_id('links_nofollow_no');
		$settings_id_yes = easyazon_get_settings_id('links_nofollow_yes');
		$settings_name = easyazon_get_settings_name('links_nofollow');

		printf('<input type="hidden" id="%1$s" name="%2$s" value="no" />', $settings_id_no, $settings_name);
		printf('<label><input type="checkbox" id="%1$s" name="%2$s" %3$s value="yes" /> %4$s</label>', $settings_id_yes, $settings_name, $settings_checked, __('I want the <code>nofollow</code> attribute applied to all EasyAzon links'));
		easyazon_the_settings_error('links_nofollow');
	}

	public static function display_settings_field__links__cloaking() {
		$links_cloaking = easyazon_get_setting('links_cloaking');

		$settings_checked = 'yes' === $links_cloaking ? 'checked="checked"' : '';
		$settings_error = easyazon_has_settings_error('links_cloaking') ? 'easyazon-error' : '';
		$settings_id_no = easyazon_get_settings_id('links_cloaking_no');
		$settings_id_yes = easyazon_get_settings_id('links_cloaking_yes');
		$settings_name = easyazon_get_settings_name('links_cloaking');

		printf('<input type="hidden" id="%1$s" name="%2$s" value="no" />', $settings_id_no, $settings_name);
		printf('<label><input type="checkbox" id="%1$s" name="%2$s" %3$s value="yes" /> %4$s</label>', $settings_id_yes, $settings_name, $settings_checked, __('I want to automatically cloak all EasyAzon links'));
		easyazon_the_settings_error('links_cloaking');
	}

	public static function display_settings_field__links__cloaking_prefix() {
		$links_cloaking_prefix = easyazon_get_setting('links_cloaking_prefix');

		$settings_error = easyazon_has_settings_error('links_cloaking_prefix') ? 'easyazon-error' : '';
		$settings_id = easyazon_get_settings_id('links_cloaking_prefix');
		$settings_name = easyazon_get_settings_name('links_cloaking_prefix');
		$settings_value = esc_attr($links_cloaking_prefix);

		printf('<code>%5$s</code><input type="text" class="small-text code easyazon-center %1$s" id="%2$s" name="%3$s" value="%4$s" /><code>/ASIN/LOCALE/TRACKING_ID/</code>', $settings_error, $settings_id, $settings_name, $settings_value, home_url('/'));
		printf('<p class="description">%1$s</p>', __('The cloaking prefix can be any combination of one or more alphabetical (<code>a-z</code>) characters'));
		easyazon_the_settings_error('links_cloaking_prefix');
	}

	public static function display_settings_field__links__popups() {
		$links_popups = easyazon_get_setting('links_popups');

		$settings_checked = 'yes' === $links_popups ? 'checked="checked"' : '';
		$settings_error = easyazon_has_settings_error('links_popups') ? 'easyazon-error' : '';
		$settings_id_no = easyazon_get_settings_id('links_popups_no');
		$settings_id_yes = easyazon_get_settings_id('links_popups_yes');
		$settings_name = easyazon_get_settings_name('links_popups');

		printf('<input type="hidden" id="%1$s" name="%2$s" value="no" />', $settings_id_no, $settings_name);
		printf('<label><input type="checkbox" id="%1$s" name="%2$s" %3$s value="yes" /> %4$s</label>', $settings_id_yes, $settings_name, $settings_checked, __('I want to display information popups when visitors hover over Amazon product links (text links only)'));
		easyazon_the_settings_error('links_popups');
	}

	public static function display_settings_field__links__add_to_cart() {
		$links_add_to_cart = easyazon_get_setting('links_add_to_cart');

		$settings_checked = 'yes' === $links_add_to_cart ? 'checked="checked"' : '';
		$settings_error = easyazon_has_settings_error('links_add_to_cart') ? 'easyazon-error' : '';
		$settings_id_no = easyazon_get_settings_id('links_add_to_cart_no');
		$settings_id_yes = easyazon_get_settings_id('links_add_to_cart_yes');
		$settings_name = easyazon_get_settings_name('links_add_to_cart');

		printf('<input type="hidden" id="%1$s" name="%2$s" value="no" />', $settings_id_no, $settings_name);
		printf('<label><input type="checkbox" id="%1$s" name="%2$s" %3$s value="yes" /> %4$s</label>', $settings_id_yes, $settings_name, $settings_checked, __('I want products to automatically be added to a visitor\'s cart when they click on an EasyAzon link'));
		printf('<p class="description easyazon-sell">%1$s</p>', __('<strong>Potential Extra Money Maker:</strong> When a visitor adds an item to their shopping cart after clicking through your link you now have an extra 89 day window to earn a commission if the visitor buys the item they added to their shopping cart instead of the usual cookie length of 24 hours.'));
		easyazon_the_settings_error('links_add_to_cart');
	}

	public static function display_settings_field__links__localization() {
		$links_localization = easyazon_get_setting('links_localization');

		$settings_checked = 'yes' === $links_localization ? 'checked="checked"' : '';
		$settings_error = easyazon_has_settings_error('links_localization') ? 'easyazon-error' : '';
		$settings_id_no = easyazon_get_settings_id('links_localization_no');
		$settings_id_yes = easyazon_get_settings_id('links_localization_yes');
		$settings_name = easyazon_get_settings_name('links_localization');

		printf('<input type="hidden" id="%1$s" name="%2$s" value="no" />', $settings_id_no, $settings_name);
		printf('<label><input type="checkbox" id="%1$s" name="%2$s" %3$s value="yes" /> %4$s</label>', $settings_id_yes, $settings_name, $settings_checked, __('I want all EasyAzon links to be localized (where possible)'));
		printf('<p class="description easyazon-sell">%1$s</p>', __('<strong>Potential Extra Money Maker:</strong> Automatically change your Amazon affiliate links to match the country your website visitor is viewing your website from (applicable to the countries you\'ve provided Tracking ID\'s for in the EasyAzon Settings above). This feature can help you earn commissions on traffic that you would otherwise not get paid on.'));
		printf('<p class="description easyazon-sell">%1$s</p>', __('<strong>For example:</strong> You create an affiliate link for the Xbox One product where your default search locale as listed in the EasyAzon settings above is the United States. A visitor from the United Kingdom visits your website and clicks your affiliate link to the Xbox One. Instead of going to Amazon.com, they are taken to a product search results page for "Xbox One" on the Amazon.co.uk website where you can now receive a commission if that visitor buys a product from Amazon.co.uk.'));
		easyazon_the_settings_error('links_localization');
	}

	//// Settings retrieval and sanitization

	public static function clean_settings($settings) {
		if(!isset($settings['links_cloaking_prefix']) || empty($settings['links_cloaking_prefix'])) {
			$settings['links_cloaking_prefix'] = 'product';
		}

		return $settings;
	}

	public static function default_settings($settings) {
		$settings_defaults = array(
			// Links
			'links_nofollow' => 'yes',
			'links_add_to_cart' => 'no',
			'links_cloaking' => 'no',
			'links_cloaking_prefix' => 'product',
			'links_localization' => 'no',
			'links_popups' => 'no',
		);

		return $settings + $settings_defaults;
	}

	public static function sanitize_settings($settings, $settings_defaults, $errors) {
		$settings['links_nofollow'] = (isset($settings['links_nofollow']) && 'yes' === $settings['links_nofollow']) ? 'yes' : 'no';
		$settings['links_add_to_cart'] = (isset($settings['links_add_to_cart']) && 'yes' === $settings['links_add_to_cart']) ? 'yes' : 'no';
		$settings['links_cloaking'] = (isset($settings['links_cloaking']) && 'yes' === $settings['links_cloaking']) ? 'yes' : 'no';
		$settings['links_cloaking_prefix'] = (isset($settings['links_cloaking_prefix']) && preg_match('/^[a-z]+$/i', $settings['links_cloaking_prefix'])) ? strtolower($settings['links_cloaking_prefix']) : $settings_defaults['links_cloaking_prefix'];
		$settings['links_localization'] = (isset($settings['links_localization']) && 'yes' === $settings['links_localization']) ? 'yes' : 'no';
		$settings['links_popups'] = (isset($settings['links_popups']) && 'yes' === $settings['links_popups']) ? 'yes' : 'no';

		return $settings;
	}

	/// Searchable

	public static function add_associate_tags($associate_tags) {
		$associate_tags = array();

		$locales = easyazon_get_locales();
		foreach($locales as $locale_key => $locale_data) {
			if(!isset($associate_tags[$locale_key])) {
				$associate_tags[$locale_key] = array();
			}

			$associate_tags[$locale_key] = array_merge($associate_tags[$locale_key], array_map('trim', explode(',', easyazon_get_setting("associates_tags_{$locale_key}"))));
		}

		return array_filter($associate_tags);
	}

	public static function add_locales($locales) {

		return $locales;
	}

	public static function get_calls_to_action() {
		$transient_key = '_easyazon_calls_to_action_' . EASYAZON_PRO_VERSION;
		$cta_info = get_transient($transient_key);

		if(!is_array($cta_info)) {
			$cta_info = array();

			$base_path = path_join(dirname(__FILE__), 'resources/frontend/img/cta/');
			$base_url = plugins_url('resources/frontend/img/cta/', __FILE__);

			$files = glob($base_path . '*/*.gif');
			if(is_array($files)) {
				foreach($files as $file) {
					$image_dimensions = getimagesize($file);
					if($image_dimensions) {
						$image_parts = explode('/', str_replace($base_path, '', $file));
						$image_locale = $image_parts[0];
						$image_name = $image_parts[1];
						$image_key = str_replace('.gif', '', $image_name);
						$image_url = path_join($base_url, "{$image_locale}/{$image_name}");

						$cta_info[$image_locale] = isset($cta_info[$image_locale]) && is_array($cta_info[$image_locale]) ? $cta_info[$image_locale] : array();
						$cta_info[$image_locale][] = array(
							'key' => $image_key,
							'height' => $image_dimensions[1],
							'url' => $image_url,
							'width' => $image_dimensions[0],
						);
					}
				}
			}

			set_transient($transient_key, $cta_info, 60 * 60 * 24);
		}

		return $cta_info;
	}

	private static function get_items($asins, $locale) {
		$items = array();

		foreach($asins as $key => $asin) {
			$item = self::get_cached_item($asin, $locale);

			if($item) {
				$items[] = $item;
				unset($asins[$key]);
			}
		}

		$amazon_api = new EasyAzon_Amazon_API(easyazon_get_setting('access_key_id'), easyazon_get_setting('secret_access_key'));
		$batches = array_chunk(array_map('trim', $asins), 10);
		foreach($batches as $batch) {
			$ids = join(',', $batch);
			$amazon_response = $amazon_api->item_lookup($ids, 'ASIN', null, $locale);

			if(!is_wp_error($amazon_response)) {
				$_items = $amazon_response['Items']['Item'];
				foreach($_items as $_item) {
					$_item['Fetched'] = current_time('timestamp');
					$items[] = $_item;

					self::set_cached_item($_item['ASIN'], $locale, $_item);
				}
			}
		}

		return $items;
	}

	private static function get_item($asin, $locale) {
		$item = self::get_cached_item($asin, $locale);

		if(false === $item) {
			$amazon_api = new EasyAzon_Amazon_API(easyazon_get_setting('access_key_id'), easyazon_get_setting('secret_access_key'));
			$amazon_response = $amazon_api->item_lookup($asin, 'ASIN', null, $locale);

			if(!is_wp_error($amazon_response) && isset($amazon_response['Items']) && isset($amazon_response['Items']['Item']) && isset($amazon_response['Items']['Item'][0]) && isset($amazon_response['Items']['Item'][0]['ASIN'])) {
				$item = $amazon_response['Items']['Item'][0];
				$item['Fetched'] = current_time('timestamp');

				self::set_cached_item($asin, $locale, $item);
			} else {
				$item = false;
			}
		}

		return is_array($item) ? $item : false;
	}

	private static function get_cached_item($asin, $locale) {
		$key = self::TRANSIENT_ASIN_ITEM . $asin . $locale;
		$item = get_transient($key);

		return (is_array($item) && !empty($item) && isset($item['ASIN'])) ? $item : false;
	}

	private static function set_cached_item($asin, $locale, $item) {
		$key = self::TRANSIENT_ASIN_ITEM . $asin . $locale;
		set_transient($key, $item, self::TRANSIENT_ASIN_ITEM_TIMEOUT);
	}

	private static function _get_item_image($item, $preference = 'Medium') {
		$image = '';

		if(is_array($item) && isset($item['ImageSets']) && isset($item['ImageSets']['ImageSet'])) {
			if(isset($item['ImageSets']['ImageSet']["{$preference}Image"])) {
				$image = $item['ImageSets']['ImageSet']["{$preference}Image"];
			} else {
				$image = current(array_reverse($item['ImageSets']['ImageSet']));
			}
		}

		return $image;
	}

	private static function _get_item_price_actual($item) {
		$price_actual = '';

		if(is_array($item) && isset($item['OfferSummary']) && isset($item['OfferSummary']['LowestNewPrice']) && isset($item['OfferSummary']['LowestNewPrice']['FormattedPrice'])) {
			$price_actual = $item['OfferSummary']['LowestNewPrice']['FormattedPrice'];
		}

		return $price_actual ? $price_actual : self::_get_item_price_list($item);
	}

	private static function _get_item_price_list($item) {
		$price_list = '';

		if(is_array($item) && isset($item['ItemAttributes']) && isset($item['ItemAttributes']['ListPrice']) && isset($item['ItemAttributes']['ListPrice']['FormattedPrice'])) {
			$price_list = $item['ItemAttributes']['ListPrice']['FormattedPrice'];
		}

		return $price_list;
	}

	private static function _get_item_title($item) {
		$title = '';

		if(is_array($item) && isset($item['ItemAttributes']) && isset($item['ItemAttributes']['Title'])) {
			$title = $item['ItemAttributes']['Title'];
		}

		return $title;
	}

	// GeoIP

	private static function get_visitor_locale() {
		$country_code = self::_get_country_code_for_ip_address(null);
		$locale_keys = array_keys(easyazon_get_locales());

		if('GB' === $country_code) {
			// Hack for locale code different than country code
			$country_code = 'UK';
		}

		return in_array($country_code, $locale_keys) ? $country_code : 'US';
	}

	private static function _get_geoip_database() {
		if(null === self::$geoip_database) {
			require_once('lib/geoip/geoip.inc.php');

			$geoip_database_path = path_join(dirname(__FILE__), 'lib/geoip/geoip.dat');
			self::$geoip_database = geoip_open($geoip_database_path, GEOIP_STANDARD);
		}

		return self::$geoip_database;
	}

	private static function _get_country_code_for_ip_address($ip_address = null) {
		$ip_address = is_null($ip_address) ? $_SERVER['REMOTE_ADDR'] : $ip_address;

		if('127.0.0.1' == $ip_address) {
			$country_code = 'US';
		} else {
			$geoip_database = self::_get_geoip_database();

			$country_code = geoip_country_code_by_addr($geoip_database, $ip_address);
		}

		return $country_code;
	}
}

add_action('plugins_loaded', array('EasyAzon_Pro', 'init'), 15);
