<?php
// Translation
load_theme_textdomain('Creativo', get_template_directory() . '/languages');

require_once ('admin/index.php');
/*-----------------------------------------------------------------------------------*/
/*	Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'cr_register_menu' ) ) {
    function cr_register_menu() {
	    register_nav_menu('primary-menu', __('Primary Menu'));
    }

    add_action('init', 'cr_register_menu');
}

/**
 * Register our sidebars and widgetized areas. Also register the default Epherma widget.
 *
 * @since Twenty Eleven 1.0
 */
function creativo_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Blog Sidebar', 'Creativo' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div class="sidebar-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="sidebar-title">',
		'after_title' => '</h3><div class="split-line"></div><div class="clr"></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'WooCommerce Sidebar', 'Creativo' ),
		'id' => 'woocommerce-sidebar',
		'before_widget' => '<div class="sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="sidebar-title">',
		'after_title' => '</h3><div class="split-line"></div><div class="clr"></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Sidebar', 'Creativo' ),
		'id' => 'sidebar-2',
		'before_widget' => '<div class="footer_widget_content">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="footer-widget-title">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'creativo_widgets_init' );

add_filter('dynamic_sidebar_params','columnise_widgets');

function columnise_widgets($params) {

	$columnise2 = strstr($params[0]['before_widget'],'front_widget');
	$columnise3 = strstr($params[0]['before_widget'],'footer_widget_content');
	
	$add_mob_footer = '';
 	$add_footer = '';
 
	if($columnise2){
		
		global $my_widget_num, 
			   $sec_widget_num;
		
		$my_widget_num++; 
		$sec_widget_num++;
		
		if($my_widget_num %5 ==0){
			$add = ' forth'; $my_widget_num=1;
		}
		if($sec_widget_num %3 ==0){
			$add_mob = ' third'; $sec_widget_num =1;
		}
		$class = $add . $add_mob; 
		$params[0]['before_widget'] = substr_replace($params[0]['before_widget'], $class,24,0);
	}
	if($columnise3){
		
		global $my_footer_widget_num, 
			   $sec_footer_widget_num;
		
		$my_footer_widget_num++; 
		$sec_footer_widget_num++;
		
		if($my_footer_widget_num %5 ==0){
			$add_footer = ' forth'; $my_footer_widget_num=1;
		}
		if($sec_footer_widget_num %3 ==0){
			$add_mob_footer = ' third'; $sec_footer_widget_num =1;
		}
		$class_footer = $add_footer . $add_mob_footer; 
		$params[0]['before_widget'] = substr_replace($params[0]['before_widget'], $class_footer,33,0);
	}
	return $params;
}
add_filter('get_sidebar','columnise_widgets_counter_reset', 99);
function columnise_widgets_counter_reset($text) {
   global $my_widget_num;
   $my_widget_num = 0;
   return $text;
}

//fixing filtering for shortcodes
function shortcode_empty_paragraph_fix($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}

add_filter('the_content', 'shortcode_empty_paragraph_fix');

/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails 
/*-----------------------------------------------------------------------------------*/

if( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
// Add post thumbnail functionality
add_image_size('blog-large', 600, 273, true);
add_image_size('blog-medium', 320, 202, true);
//add_image_size('tabs-img', 52, 50, true); // aic scos
add_image_size('related-img', 180, 138, true);
add_image_size('portfolio-one', 540, 272, true);
add_image_size('portfolio-two', 460, 295, true);
add_image_size('portfolio-three', 300, 214, true);
add_image_size('portfolio-four', 220, 161, true);
//add_image_size('portfolio-full', 940, 400, true); // aici scos
add_image_size('recent-posts', 220, 135, true);
//add_image_size('recent-post-thumbnail',  66, 66, true);	// aici scos
//add_image_size('gallery-thumb',  90, 70, true);	// aici scos
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'cr_custom_gravatar' ) ) {
    function cr_custom_gravatar( $avatar_defaults ) {
        $cr_avatar = get_template_directory_uri() . '/images/gravatar.png';
        $avatar_defaults[$cr_avatar] = 'Custom Gravatar (/images/gravatar.png)';
        return $avatar_defaults;
    }
    
    add_filter( 'avatar_defaults', 'cr_custom_gravatar' );
}

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'comment_style' ) ) {
    function comment_style($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     
            <div id="comment-<?php comment_ID(); ?>">
            	<div style="width:80px; float:left">
                	<?php echo get_avatar($comment,$size='55'); ?>
                </div>
                <div style=" max-width:300px; float:left">
                    <div class="comment-author vcard">
                        <?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
                    </div>
    
                    <div class="comment-meta commentmetadata">
                        <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s', 'Creativo'), get_comment_date(),  get_comment_time()) ?></a>
                        <?php edit_comment_link(__('(Edit)', 'Creativo'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
          
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', 'Creativo') ?></em>
                        <br />
                    <?php endif; ?>
          
                    <div class="comment-body">
                        <?php comment_text() ?>
                    </div>
                </div>    
            </div>
            <div class="clear"></div>

    <?php
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'cr_list_pings' ) ) {
    function cr_list_pings($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
    	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
    	<?php 
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'cr_excerpt_length' ) ) {
    function cr_excerpt_length($length) {
    	return 40; 
    }
    
    add_filter('excerpt_length', 'cr_excerpt_length');
}


/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'cr_excerpt_more' ) ) {
    function cr_excerpt_more($excerpt) {
    	return str_replace('[...]', '...', $excerpt); 
    }
    
    add_filter('wp_trim_excerpt', 'cr_excerpt_more');
}

if ( is_admin() ) {
    $of_page= 'appearance_page_options-framework';
    add_action( "admin_print_scripts-$of_page", 'optionsframework_custom_js', 0 );
}

function creativo_js_scripts() {

	wp_enqueue_script( 'jquery' );
	
    wp_register_script( 'navi', get_bloginfo('template_directory').'/js/navigation.js');
	wp_enqueue_script( 'navi' );
	
	wp_register_script('flexslider', get_template_directory_uri() . '/flexislider/jquery.flexslider.js', 'flexslider', TRUE);
	wp_enqueue_script('flexslider');

    wp_register_script( 'modernizr', get_bloginfo('template_directory').'/js/modernizr.min.js');
	wp_enqueue_script( 'modernizr' );
	
    wp_register_script( 'custom_modernizr', get_bloginfo('template_directory').'/js/modernizr.custom.79639.js');
	wp_enqueue_script( 'custom_modernizr' );	

    wp_register_script( 'jquery.elastislide', get_bloginfo('template_directory').'/js/jquery.elastislide.js');
	wp_enqueue_script( 'jquery.elastislide' );

    wp_register_script( 'jquery.prettyPhoto', get_bloginfo('template_directory').'/js/jquery.prettyPhoto.js');
	wp_enqueue_script( 'jquery.prettyPhoto' );

    wp_register_script( 'jquery.isotope', get_bloginfo('template_directory').'/js/jquery.isotope.min.js');
	wp_enqueue_script( 'jquery.isotope' );

    wp_register_script( 'jquery.cycle', get_bloginfo('template_directory').'/js/jquery.cycle.lite.js');
	wp_enqueue_script( 'jquery.cycle' );

    wp_register_script( 'jquery.hover', get_bloginfo('template_directory').'/js/hover.js');
	wp_enqueue_script( 'jquery.hover' );

    wp_register_script( 'creativo.main', get_bloginfo('template_directory').'/js/main.js');
	wp_enqueue_script( 'creativo.main' );
   
	
}
add_action('wp_enqueue_scripts', 'creativo_js_scripts');

function optionsframework_custom_js () {
	wp_register_script( 'creativo_custom_js', get_template_directory_uri() .'/js/options-custom.js', array( 'jquery') );
	wp_enqueue_script( 'creativo_custom_js' );
}

/* WOOCOMMERCE FILTER HOOKS
	================================================== */
		
	/************************************************
	*	WooCommerce Functions		       	     	* 
	/************************************************/
	
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
	add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);
	
	function my_theme_wrapper_start() {
	  echo '<div class="page-content clearfix">';
	}
	 
	function my_theme_wrapper_end() {
	  echo '</div>';
	}

// Auto plugin activation
require_once('functions/plugin/class-tgm-plugin-activation.php');
add_action('tgmpa_register', 'cr_register_required_plugins');
function cr_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Layer Slider 5.1.2', // The plugin name
			'slug'     				=> 'LayerSlider', // The plugin slug (typically the folder name)
			'source'   				=> get_bloginfo('template_directory') . '/functions/plugin/layersliderwp.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Revolution Slider 4.5.95', // The plugin name
			'slug'     				=> 'revslider', // Theplugin slug (typically the folder name)
			'source'   				=> get_bloginfo('template_directory') . '/functions/plugin/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Breadcrumb NavXT', // The plugin name
			'slug'     				=> 'breadcrumb', // Theplugin slug (typically the folder name)
			'source'   				=> get_bloginfo('template_directory') . '/functions/plugin/breadcrumb-navxt.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WordPress Live Chat 1.5', // The plugin name
			'slug'     				=> 'screets-chat', // Theplugin slug (typically the folder name)
			'source'   				=> get_bloginfo('template_directory') . '/functions/plugin/screets-chat.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'Creativo';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
}

if (!class_exists('WPBakeryVisualComposerAbstract')) {
  $dir = dirname(__FILE__) . '/builder/';
  $composer_settings = Array(
      'APP_ROOT'      => $dir . '/js_composer',
      'WP_ROOT'       => dirname( dirname( dirname( dirname($dir ) ) ) ). '/',
      'APP_DIR'       => basename( $dir ) . '/js_composer/',
      'CONFIG'        => $dir . '/js_composer/config/',
      'ASSETS_DIR'    => 'assets/',
      'COMPOSER'      => $dir . '/js_composer/composer/',
      'COMPOSER_LIB'  => $dir . '/js_composer/composer/lib/',
      'SHORTCODES_LIB'  => $dir . '/js_composer/composer/lib/shortcodes/',
      'USER_DIR_NAME'  => 'vc_templates', /* Path relative to your current theme, where VC should look for new shortcode templates */
 
      //for which content types Visual Composer should be enabled by default
      'default_post_types' => Array('page')
  );
  require_once locate_template('/builder/js_composer/js_composer.php');
  $wpVC_setup->init($composer_settings);
}

require_once('functions/plugin/multiple-featured-images/multiple-featured-images.php');

if( class_exists( 'kdMultipleFeaturedImages' )) {
		$i = 2;

		while($i <= $data['featured_images_count']) {
	        $args = array(
	                'id' => 'featured-image-'.$i,
	                'post_type' => 'post',      // Set this to post or page
	                'labels' => array(
	                    'name'      => __( 'Featured image ', 'Creativo' ).$i,
	                    'set'       => __( 'Set featured image ', 'Creativo' ).$i,
	                    'remove'    => __( 'Remove featured image ', 'Creativo' ).$i,
	                    'use'       => __( 'Use as featured image ', 'Creativo' ).$i,
	                )
	        );

	        new kdMultipleFeaturedImages( $args );

	        $args = array(
	                'id' => 'featured-image-'.$i,
	                'post_type' => 'page',      // Set this to post or page
	                'labels' => array(
	                    'name'      => __( 'Featured image ', 'Creativo' ).$i,
	                    'set'       => __( 'Set featured image ', 'Creativo' ).$i,
	                    'remove'    => __( 'Remove featured image ', 'Creativo' ).$i,
	                    'use'       => __( 'Use as featured image ', 'Creativo' ).$i,
	                )
	        );

	        new kdMultipleFeaturedImages( $args );

	        $args = array(
	                'id' => 'featured-image-'.$i,
	                'post_type' => 'creativo_portfolio',      // Set this to post or page
	                'labels' => array(
	                    'name'      => __( 'Featured image ', 'Creativo' ).$i,
	                    'set'       => __( 'Set featured image ', 'Creativo' ).$i,
	                    'remove'    => __( 'Remove featured image ', 'Creativo' ).$i,
	                    'use'       => __( 'Use as featured image ', 'Creativo' ).$i,
	                )
	        );

	        new kdMultipleFeaturedImages( $args );

	        $i++;
    	}

}

/*
function vc_theme_vc_row($atts, $content = null) {
   return '<div class=""><div>'.wpb_js_remove_wpautop($content).'</div></div>';
}
*/



/*-----------------------------------------------------------------------------------*/
/*	Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/

// More custom functions
include_once('functions/custom_functions.php');

// Add the Theme Shortcodes
include("functions/shortcodes.php");
 
// Add meta boxes
include('functions/metaboxes.php');

// Add the post types
include("functions/theme-posttypes.php");

// Add flickr widget
include("functions/widget-flickr.php");

// Add contact info widget
include("functions/widget-contact.php");

// Add latest tweets widget
include("functions/widget-tweets.php");

// Add the Custom Youtube Widget
include("functions/widget-youtube.php");

// Add the Custom Vimeo Widget
include("functions/widget-vimeo.php");

// Add the Popular/Recent Tabs Widget
include("functions/widget-tabs.php");

// Add Custom Blog Posts Widget
include('functions/widget-blogposts.php'); 

// Add socila links widget
include("functions/widget-social.php");

// Add Custom Recent Portfolios Widget
include('functions/widget-recentportfolios.php');

// Add the post types
include_once('functions/plugin/multiple_sidebars.php');

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


function SearchFilter($query) {
	if ($query->is_search) {
		$query->set('post_type', array('post','page'));
	}
	return $query;
}

//add_filter('pre_get_posts','SearchFilter');

function custom_sanitize_textarea($input) {
    global $allowedposttags;
    $custom_allowedtags["embed"] = array(
      "src" => array(),
      "type" => array(),
      "allowfullscreen" => array(),
      "allowscriptaccess" => array(),
      "height" => array(),
          "width" => array()
      );
      $custom_allowedtags["script"] = array();
      $custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
      $output = wp_kses( $input, $custom_allowedtags);
    return $output;
}
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

require_once('wp-updates-theme.php');
new WPUpdatesThemeUpdater_398( 'http://wp-updates.com/api/2/theme', basename( get_stylesheet_directory() ) );