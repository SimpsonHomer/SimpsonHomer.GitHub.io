<?php
/**
 * WPBakery Visual Composer Shortcodes settings
 *
 * @package VPBakeryVisualComposer
 *
 */
$vc_is_wp_version_3_6_more = version_compare(preg_replace('/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo('version')), '3.6') >= 0;
// Used in "Button" and "Call to Action" blocks
$colors_arr = array(__("Grey", "Creativo") => "wpb_button", __("Blue", "Creativo") => "btn-primary", __("Turquoise", "Creativo") => "btn-info", __("Green", "Creativo") => "btn-success", __("Orange", "Creativo") => "btn-warning", __("Red", "Creativo") => "btn-danger", __("Black", "Creativo") => "btn-inverse");

$button_colors = array(__("Default", "Creativo") => "default",__("Green", "Creativo") => "green", __("Blue", "Creativo") => "blue", __("Red", "Creativo") => "red", __("Yellow", "Creativo") => "yellow", __("Purple", "Creativo") => "purple", __("Grey", "Creativo") => "grey", __("Black", "Creativo") => "black");

// Used in "Button" and "Call to Action" blocks
$size_arr = array( __("Small", "Creativo") => "small", __("Large", "Creativo") => "large");

$style_arr = array( __("Style1", "Creativo") => "style1", __("Style2", "Creativo") => "style2");

$target_arr = array(__("Same window", "Creativo") => "_self", __("New window", "Creativo") => "_blank");

$alignment = array(__("Center", "Creativo") => "center", __("Left", "Creativo") => "left", __("Right", "Creativo") => "right" );

$add_css_animation = array(
  "type" => "dropdown",
  "heading" => __("CSS Animation", "Creativo"),
  "param_name" => "css_animation",
  "admin_label" => true,
  "value" => array(__("No", "Creativo") => '', __("Top to bottom", "Creativo") => "top-to-bottom", __("Bottom to top", "Creativo") => "bottom-to-top", __("Left to right", "Creativo") => "left-to-right", __("Right to left", "Creativo") => "right-to-left", __("Appear from center", "Creativo") => "appear"),
  "description" => __("Select animation type if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.", "Creativo")
);

vc_map( array(
  "name" => __("Row", "Creativo"),
  "base" => "vc_row",
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "show_settings_on_create" => false,
  "category" => __('Content', 'Creativo'),
  "description" => __('Place content elements inside the row', 'Creativo'),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Layout Width", "Creativo"),
      "param_name" => "layout",
      "value" => array(__('Normal', "Creativo") => "normal", __('Wide', "Creativo") => "wide"),
      "description" => __("Select the layout width.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Margin Top", "Creativo"),
      "param_name" => "margintop",
      "value" => array(0,5,10,15,20,25,30,35,40,45,50),
      "description" => __("Select a value for the margin top. Select 0 for no margin top", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Margin Bottom", "Creativo"),
      "param_name" => "marginbottom",
      "value" => array(0,5,10,15,20,25,30,35,40,45,50),
      "description" => __("Select a value for the margin bottom. Select 0 for no margin bottom", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Padding Top", "Creativo"),
      "param_name" => "paddingtop",
      "value" => array(0,5,10,15,20,25,30,35,40,45,50),
      "description" => __("Select a value for the padding top. Select 0 for no padding top", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Padding Bottom", "Creativo"),
      "param_name" => "paddingbottom",
      "value" => array(0,5,10,15,20,25,30,35,40,45,50),
      "description" => __("Select a value for the padding bottom. Select 0 for no padding bottom", "Creativo")
    ),
  	array(
      "type" => "colorpicker",
      "class" => "",
      "heading" => __("Background color", 'Creativo'),
      "param_name" => "bg_color",
      "value" => '#fff', //Default White color
      "description" => __("Choose title color", 'Creativo')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcRowView'
) );
vc_map( array(
  "name" => __("Row", "Creativo"), //Inner Row
  "base" => "vc_row_inner",
  "content_element" => false,
  "is_container" => true,
  "icon" => "icon-wpb-row",
  "show_settings_on_create" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcRowView'
) );
vc_map( array(
  "name" => __("Column", "Creativo"),
  "base" => "vc_column",
  "is_container" => true,
  "content_element" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcColumnView'
) );

/* Box Title
---------------------------------------------------------- */

vc_map( array(
  "name" => __("Box Title", 'Creativo'),
  "base" => "ctitle",
  "class" => "",
  "controls" => "full",
  "icon" => "icon-wpb-title",
  "category" => __('Content', 'Creativo'),
  "description" => __('Add a descriptive Title to your section.', 'Creativo'),
  //'admin_enqueue_js' => array(plugins_url('Creativo_admin.js', __FILE__)),
//  'admin_enqueue_css' => array(plugins_url('Creativo_admin.css', __FILE__)),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h2",
      "class" => "",
      "heading" => __("Title", 'Creativo'),
      "param_name" => "title",
      "value" => __("We Sell Quality", 'Creativo'),
      "description" => __("Add a title to a section.", 'Creativo')
    ),
	array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title color", 'Creativo'),
      "param_name" => "color",
      "value" => '#666666', //Default Red color
      "description" => __("Choose title color", 'Creativo')
    ),
	array(
      "type" => "colorpicker",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title background color", 'Creativo'),
      "param_name" => "background",
      "value" => '#fff', //Default Red color
      "description" => __("Choose title background color", 'Creativo')
    ),
	 array(
      "type" => "dropdown",
      "heading" => __("Font Size", "Creativo"),
      "param_name" => "font_size",
      "admin_label" => true,
      "value" => array('30 - Default' ,10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 31, 32, 33, 34, 35, 36, 37, 38 , 39, 40),
      "description" => __("Select the font size of the Title, in pixels.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Title Positioning", "Creativo"),
      "param_name" => "position",
      "value" => array(__('Center', "Creativo") => "center", __('Left', "Creativo") => "left", __('Right', "Creativo") => "right"),
      "description" => __("Select the positioning of the Title.", "Creativo")
    )
	
  )
) );

/* Text Block
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Text Block", "Creativo"),
  "base" => "vc_column_text",
  "icon" => "icon-wpb-layer-shape-text",
  "wrapper_class" => "clearfix",
  "category" => __('Content', 'Creativo'),
   "description" => __('A block of text with WYSIWYG editor', 'Creativo'),
  "params" => array(
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Text", "Creativo"),
      "param_name" => "content",
      "value" => __("<p>I am text block. Click edit button to change this text.</p>", "Creativo")
    ),
    $add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Quote Box
---------------------------------------------------------- */

vc_map( array(
  "name" => __("Quote Box", 'Creativo'),
  "base" => "qbox",
  "class" => "qbox",
  "controls" => "full",
  "icon" => "icon-wpb-qbox",
   "description" => __('Add a Quote Box element.', 'Creativo'),
  "category" => __('Content', 'Creativo'),
  //'admin_enqueue_js' => array(plugins_url('Creativo_admin.js', __FILE__)),
  //'admin_enqueue_css' => array(plugins_url('../custom.css', __FILE__)),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h2",
      "class" => "",
      "heading" => __("Title Big", 'Creativo'),
      "param_name" => "title1",
      "value" => "",
      "description" => __("Enter text for Big Title on the left of the box.", 'Creativo')
    ),
	array(
      "type" => "textfield",
      "holder" => "h4",
      "class" => "",
      "heading" => __("Title Small", 'Creativo'),
      "param_name" => "title2",
      "value" => "",
      "description" => __("Enter text for Small Title on the right of the box.", 'Creativo')
    ),
	array(
      "type" => "attach_image",
      "heading" => __("Icon", "Creativo"),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Select image from media library.", "Creativo")
    ),
	array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "messagebox_text",
      "heading" => __("Message text", "Creativo"),
      "param_name" => "content",
      "value" => __("<p>Quisque justo lorem, condimentum condimentum ornare vel, consectetur id justo? Phasellus leo lacus, rhoncus dictum auctor.</p>", "Creativo")
    )
  )
) );

/* Latest tweets
---------------------------------------------------------- */
/*vc_map( array(
  "name" => __("Twitter Widget", "Creativo"),
  "base" => "vc_twitter",
  "icon" => 'icon-wpb-balloon-twitter-left',
  "category" => __('Social', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Twitter username", "Creativo"),
      "param_name" => "twitter_name",
      "admin_label" => true,
      "description" => __("Type in twitter profile name from which load tweets.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Tweets count", "Creativo"),
      "param_name" => "tweets_count",
      "admin_label" => true,
      "value" => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15),
      "description" => __("How many recent tweets to load.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );*/

/* Separator (Divider)
---------------------------------------------------------- */
vc_map( array(
  "name"		=> __("Separator", "Creativo"),
  "base"		=> "vc_separator",
  'icon'		=> 'icon-wpb-ui-separator',
  "category"  => __('Content', 'Creativo'),
  "description" => __('Add an horizontal separator.', 'Creativo'),
  "params" => array(
  	array(
      "type" => "dropdown",
      "heading" => __("Style", "Creativo"),
      "param_name" => "style",
      "value" => array(__('Dotted', "Creativo") => "dotted", __('Solid', "Creativo") => "solid", __('Double', "Creativo") => "double"),
      "description" => __("Select the style for the separator.", "Creativo")
    )	
  ),
  "js_view" => 'VcDivider'
) );

/* Textual block
---------------------------------------------------------- */
/*
vc_map( array(
  "name" => __("Separator with Text", "Creativo"),
  "base" => "vc_text_separator",
  "icon" => "icon-wpb-ui-separator-label",
  "category" => __('Content', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", "Creativo"),
      "param_name" => "title",
      "holder" => "div",
      "value" => __("Title", "Creativo"),
      "description" => __("Separator title.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Title position", "Creativo"),
      "param_name" => "title_align",
      "value" => array(__('Align center', "Creativo") => "separator_align_center", __('Align left', "Creativo") => "separator_align_left", __('Align right', "Creativo") => "separator_align_right"),
      "description" => __("Select title location.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcTextSeparatorView'
) );


/* Message box
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Message Box", "Creativo"),
  "base" => "vc_message",
  "icon" => "icon-wpb-information-white",
  "wrapper_class" => "alert",
  "category" => __('Content', 'Creativo'),
  "description" => __('Notification box', 'Creativo'),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Message box type", "Creativo"),
      "param_name" => "color",
      "value" => array(__('General', "Creativo") => "general", __('Error', "Creativo") => "error", __('Success', "Creativo") => "success", __('Warning', "Creativo") => "warning"),
      "description" => __("Select message type.", "Creativo")
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "messagebox_text",
      "heading" => __("Message text", "Creativo"),
      "param_name" => "content",
      "value" => __("<p>I am message box. Click edit button to change this text.</p>", "Creativo")
    ),
//    $add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcMessageView'
) );

/* Facebook like button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Facebook Like", "Creativo"),
  "base" => "vc_facebook",
  "icon" => "icon-wpb-balloon-facebook-left",
  "category" => __('Social', 'Creativo'),
  "description" => __('Facebook like button', 'Creativo'),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Button type", "Creativo"),
      "param_name" => "type",
      "admin_label" => true,
      "value" => array(__("Standard", "Creativo") => "standard", __("Button count", "Creativo") => "button_count", __("Box count", "Creativo") => "box_count"),
      "description" => __("Select button type.", "Creativo")
    )
  )
) );

/* Tweetmeme button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Tweetmeme Button", "Creativo"),
  "base" => "vc_tweetmeme",
  "icon" => "icon-wpb-tweetme",
  "category" => __('Social', 'Creativo'),
  "description" => __('Share on twitter button', 'Creativo'),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Button type", "Creativo"),
      "param_name" => "type",
      "admin_label" => true,
      "value" => array(__("Horizontal", "Creativo") => "horizontal", __("Vertical", "Creativo") => "vertical", __("None", "Creativo") => "none"),
      "description" => __("Select button type.", "Creativo")
    )
  )
) );

/* Google+ button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Google+ Button", "Creativo"),
  "base" => "vc_googleplus",
  "icon" => "icon-wpb-application-plus",
  "category" => __('Social', 'Creativo'),
  "description" => __('Recommend on Google', 'Creativo'),
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Button size", "Creativo"),
      "param_name" => "type",
      "admin_label" => true,
      "value" => array(__("Standard", "Creativo") => "", __("Small", "Creativo") => "small", __("Medium", "Creativo") => "medium", __("Tall", "Creativo") => "tall"),
      "description" => __("Select button size.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Annotation", "Creativo"),
      "param_name" => "annotation",
      "admin_label" => true,
      "value" => array(__("Inline", "Creativo") => "inline", __("Bubble", "Creativo") => "", __("None", "Creativo") => "none"),
      "description" => __("Select annotation type.", "Creativo")
    )
  )
) );

/* Google+ button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Pinterest Button", "Creativo"),
  "base" => "vc_pinterest",
  "icon" => "icon-wpb-pinterest",
  "category" => __('Social', 'Creativo'),
  "description" => __('Pinterest button', 'Creativo'),
  "params"	=> array(
    array(
      "type" => "dropdown",
      "heading" => __("Button layout", "Creativo"),
      "param_name" => "type",
      "admin_label" => true,
      "value" => array(__("Horizontal", "Creativo") => "", __("Vertical", "Creativo") => "vertical", __("No count", "Creativo") => "none"),
      "description" => __("Select button layout.", "Creativo")
    )
  )
) );

/* Toggle (FAQ)
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Toggle", "Creativo"),
  "base" => "vc_toggle",
  "icon" => "icon-wpb-toggle-small-expand",
  "category" => __('Content', 'Creativo'),
  "description" => __('Add a Toggle element.', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h4",
      "class" => "toggle_title",
      "heading" => __("Toggle title", "Creativo"),
      "param_name" => "title",
      "value" => __("Toggle title", "Creativo"),
      "description" => __("Toggle block title.", "Creativo")
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "class" => "toggle_content",
      "heading" => __("Toggle content", "Creativo"),
      "param_name" => "content",
      "value" => __("<p>Toggle content goes here, click edit button to change this text.</p>", "Creativo"),
      "description" => __("Toggle block content.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Default state", "Creativo"),
      "param_name" => "open",
      "value" => array(__("Closed", "Creativo") => "false", __("Open", "Creativo") => "true"),
      "description" => __('Select "Open" if you want toggle to be open by default.', "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Toggle Color", "Creativo"),
      "param_name" => "color",
      "value" => $button_colors,
      "description" => __('Select the color for the toggle.', "Creativo")
    ),
    //$add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcToggleView'
) );

/* Single image */
vc_map( array(
  "name" => __("Single Image", "Creativo"),
  "base" => "vc_single_image",
  "icon" => "icon-wpb-single-image",
  "category" => __('Content', 'Creativo'),
  "description" => __('Simple image with CSS animation', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "Creativo"),
      "param_name" => "image",
      "value" => "",
      "description" => __("Select image from media library.", "Creativo")
    ),
    $add_css_animation,
    array(
      "type" => "textfield",
      "heading" => __("Image size", "Creativo"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "Creativo")
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Link to large image?", "Creativo"),
      "param_name" => "img_link_large",
      "description" => __("If selected, image will be linked to the bigger image.", "Creativo"),
      "value" => Array(__("Yes, please", "Creativo") => 'yes')
    ),
	array(
      "type" => "textfield",
      "heading" => __("Image link", "Creativo"),
      "param_name" => "img_link",
      "description" => __("Enter url if you want this image to have link.", "Creativo"),
      "dependency" => Array('element' => "img_link_large", 'is_empty' => true, 'callback' => 'wpb_single_image_img_link_dependency_callback')
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Link Target", "Creativo"),
      "param_name" => "img_link_target",
      "value" => array(__("PrettyPhoto", "Creativo") => "pretty_photo",__("Same window", "Creativo") => "_self", __("New window", "Creativo") => "_blank"),
      "dependency" => Array('element' => "img_link", 'not_empty' => true)
    ),

    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
));

/* Gallery/Slideshow
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Image Gallery", "Creativo"),
  "base" => "vc_gallery",
  "icon" => "icon-wpb-images-stack",
  "category" => __('Content', 'Creativo'),
  "description" => __('Add an image gallery or slider', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Gallery type", "Creativo"),
      "param_name" => "type",
      "value" => array(__("Flex slider fade", "Creativo") => "flexslider_fade", __("Flex slider slide", "Creativo") => "flexslider_slide", __("Image grid", "Creativo") => "image_grid"),
      "description" => __("Select gallery type.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", "Creativo"),
      "param_name" => "interval",
      "value" => array(3, 5, 10, 15, __("Disable", "Creativo") => 0),
      "description" => __("Auto rotate slides each X seconds.", "Creativo"),
      "dependency" => Array('element' => "type", 'value' => array('flexslider_fade', 'flexslider_slide', 'nivo'))
    ),
    array(
      "type" => "attach_images",
      "heading" => __("Images", "Creativo"),
      "param_name" => "images",
      "value" => "",
      "description" => __("Select images from media library.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Slider Width", "Creativo"),
      "param_name" => "slider_width",
      "description" => __("Enter slider width size in pixels. Example: 200px, 500px.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Image size", "Creativo"),
      "param_name" => "img_size",
      "description" => __("Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use 'thumbnail' size.", "Creativo")
    ),	
    array(
      "type" => "dropdown",
      "heading" => __("On click", "Creativo"),
      "param_name" => "onclick",
      "value" => array(__("Open prettyPhoto", "Creativo") => "link_image", __("Do nothing", "Creativo") => "link_no", __("Open custom link", "Creativo") => "custom_link"),
      "description" => __("What to do when slide is clicked?", "Creativo")
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Custom links", "Creativo"),
      "param_name" => "custom_links",
      "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'Creativo'),
      "dependency" => Array('element' => "onclick", 'value' => array('custom_link'))
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Custom link target", "Creativo"),
      "param_name" => "custom_links_target",
      "description" => __('Select where to open  custom links.', 'Creativo'),
      "dependency" => Array('element' => "onclick", 'value' => array('custom_link')),
      'value' => $target_arr
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


/* Tabs
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
vc_map( array(
  "name"  => __("Tabs", "Creativo"),
  "base" => "vc_tabs",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "icon-wpb-ui-tab-content",
  "category" => __('Content', 'Creativo'),
  "description" => __('Tabbed content', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Color", "Creativo"),
      "param_name" => "color",
      "value" => $button_colors,
      "description" => __("Tabs color.", "Creativo")
    ),
	/*
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate tabs", "Creativo"),
      "param_name" => "interval",
      "value" => array(__("Disable", "Creativo") => 0, 3, 5, 10, 15),
      "description" => __("Auto rotate tabs each X seconds.", "Creativo")
    ),
	*/
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "custom_markup" => '
  <div class="wpb_tabs_holder wpb_holder vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Tab 1','Creativo').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Tab 2','Creativo').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );

/* Tour section
---------------------------------------------------------- */
$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
WPBMap::map( 'vc_tour', array(
  "name" => __("Tour Section", "Creativo"),
  "base" => "vc_tour",
  "show_settings_on_create" => false,
  "is_container" => true,
  "container_not_allowed" => true,
  "icon" => "icon-wpb-ui-tab-content-vertical",
  "category" => __('Content', 'Creativo'),
  "description" => __('Tabbed tour section', 'Creativo'),
  "wrapper_class" => "clearfix",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", "Creativo"),
      "param_name" => "interval",
      "value" => array(__("Disable", "Creativo") => 0, 3, 5, 10, 15),
      "description" => __("Auto rotate slides each X seconds.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "custom_markup" => '  
  <div class="wpb_tabs_holder wpb_holder clearfix vc_container_for_children">
  <ul class="tabs_controls">
  </ul>
  %content%
  </div>'
  ,
  'default_content' => '
  [vc_tab title="'.__('Slide 1','Creativo').'" tab_id="'.$tab_id_1.'"][/vc_tab]
  [vc_tab title="'.__('Slide 2','Creativo').'" tab_id="'.$tab_id_2.'"][/vc_tab]
  ',
  "js_view" => ($vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35')
) );

vc_map( array(
  "name" => __("Tab", "Creativo"),
  "base" => "vc_tab",
  "allowed_container_element" => 'vc_row',
  "is_container" => true,
  "content_element" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", "Creativo"),
      "param_name" => "title",
      "description" => __("Tab title.", "Creativo")
    ),
    array(
      "type" => "tab_id",
      "heading" => __("Tab ID", "Creativo"),
      "param_name" => "tab_id"
    )
  ),
  'js_view' => ($vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35')
) );

/* Accordion block
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Accordion", "Creativo"),
  "base" => "vc_accordion",
  "show_settings_on_create" => false,
  "is_container" => true,
  "icon" => "icon-wpb-ui-accordion",
  "category" => __('Content', 'Creativo'),
   "description" => __('jQuery UI accordion', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
	/*
	array(
      "type" => "dropdown",
      "heading" => __("Accordion Title color", "Creativo"),
      "param_name" => "color",
      "value" => $button_colors,
      "description" => __("Select a color for the accordion title.", "Creativo")
    ),
	*/
    array(
      "type" => "textfield",
      "heading" => __("Active tab", "Creativo"),
      "param_name" => "active_tab",
      "description" => __("Enter tab number to be active on load or enter false to collapse all tabs.", "Creativo")
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Allow collapsible all", "Creativo"),
      "param_name" => "collapsible",
      "description" => __("Select checkbox to allow for all sections to be be collapsible.", "Creativo"),
      "value" => Array(__("Allow", "Creativo") => 'yes')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "custom_markup" => '
  <div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
  %content%
  </div>
  <div class="tab_controls">
  <button class="add_tab" title="'.__("Add accordion section", "Creativo").'">'.__("Add accordion section", "Creativo").'</button>
  </div>
  ',
  'default_content' => '
  [vc_accordion_tab title="'.__('Section 1', "Creativo").'"][/vc_accordion_tab]
  [vc_accordion_tab title="'.__('Section 2', "Creativo").'"][/vc_accordion_tab]
  ',
  'js_view' => 'VcAccordionView'
) );
vc_map( array(
  "name" => __("Accordion Section", "Creativo"),
  "base" => "vc_accordion_tab",
  "allowed_container_element" => 'vc_row',
  "is_container" => true,
  "content_element" => false,
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Title", "Creativo"),
      "param_name" => "title",
      "description" => __("Accordion section title.", "Creativo")
    ),
  ),
  'js_view' => 'VcAccordionTabView'
) );

/* Posts Grid
---------------------------------------------------------- */

vc_map( array(
  "name" => __("Posts Grid", "Creativo"),
  "base" => "recent_posts",
  "icon" => "icon-wpb-application-icon-large",
  "category" => __('Content', 'Creativo'),
   "description" => __('Posts in grid view', 'Creativo'),
  "params" => array(
  	array(
      "type" => "textfield",
      "heading" => __("Posts Count", "Creativo"),
	  "admin_label" => true,
      "param_name" => "posts",
      "description" => __("Enter how many posts to show on the grid.", "Creativo")
    ),

	array(
      "type" => "dropdown",
      "heading" => __("Show Thumbnail", "Creativo"),
      "param_name" => "thumbnail",
	  "admin_label" => true,
      "value" => array(__("Yes", "Creativo") => "yes", __("No", "Creativo") => "no"),
      "description" => __("Show/hide post thumbnail.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Show Title", "Creativo"),
      "param_name" => "show_title",
	  "admin_label" => true,
      "value" => array(__("Yes", "Creativo") => "yes", __("No", "Creativo") => "no"),
      "description" => __("Show/hide post title.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Show Date", "Creativo"),
      "param_name" => "show_date",
	  "admin_label" => true,
      "value" => array(__("Yes", "Creativo") => "yes", __("No", "Creativo") => "no"),
      "description" => __("Show/hide post date.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Show Excerpt", "Creativo"),
      "param_name" => "show_excerpt",
	  "admin_label" => true,
      "value" => array(__("Yes", "Creativo") => "yes", __("No", "Creativo") => "no"),
      "description" => __("Show/hide post excerpt.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Category ID", "Creativo"),
      "param_name" => "category", 
	  "admin_label" => true,     
      "description" => __("Enter the categories id (numeric value) to show posts from. For multiple categories, separate them by comma. E.g: 4,5,20", "Creativo")
    ),
  )
) );

/* Portfolio items
---------------------------------------------------------- */

vc_map( array(
  "name" => __("3d Portfolio", "Creativo"),
  "base" => "recent_works",
  "icon" => "icon-wpb-portfolio",
  "category" => __('Content', 'Creativo'),
   "description" => __('Portfolio items with 3D Effect', 'Creativo'),
  "params" => array(
  	array(
      "type" => "textfield",
      "heading" => __("Items Count", "Creativo"),
      "param_name" => "items",
	  "admin_label" => true,
      "description" => __("Enter how many portfolio items to show.", "Creativo")
    ),

	array(
      "type" => "dropdown",
      "heading" => __("Show Filters", "Creativo"),
      "param_name" => "show_filters",
	  "admin_label" => true,
      "value" => array(__("Yes", "Creativo") => "yes", __("No", "Creativo") => "no"),
      "description" => __("Show/hide portfolio filters.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Columns", "Creativo"),
      "param_name" => "columns",
	  "admin_label" => true,
      "value" => array(4,3,2,1),
      "description" => __("Select the number of columns to use.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Category ID", "Creativo"),
      "param_name" => "category_id",  
	  "admin_label" => true,    
      "description" => __("Enter the category id to show posts from.", "Creativo")
    ),
  )
) );


/* Posts slider
---------------------------------------------------------- */
/*
vc_map( array(
  "name" => __("Posts Slider", "Creativo"),
  "base" => "vc_posts_slider",
  "icon" => "icon-wpb-slideshow",
  "category" => __('Content', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Slider type", "Creativo"),
      "param_name" => "type",
      "admin_label" => true,
      "value" => array(__("Flex slider fade", "Creativo") => "flexslider_fade", __("Flex slider slide", "Creativo") => "flexslider_slide", __("Nivo slider", "Creativo") => "nivo"),
      "description" => __("Select slider type.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Slides count", "Creativo"),
      "param_name" => "count",
      "description" => __('How many slides to show? Enter number or word "All".', "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Auto rotate slides", "Creativo"),
      "param_name" => "interval",
      "value" => array(3, 5, 10, 15, __("Disable", "Creativo") => 0),
      "description" => __("Auto rotate slides each X seconds.", "Creativo")
    ),
    array(
      "type" => "posttypes",
      "heading" => __("Post types", "Creativo"),
      "param_name" => "posttypes",
      "description" => __("Select post types to populate posts from.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Description", "Creativo"),
      "param_name" => "slides_content",
      "value" => array(__("No description", "Creativo") => "", __("Teaser (Excerpt)", "Creativo") => "teaser" ),
      "description" => __("Some sliders support description text, what content use for it?", "Creativo"),
      "dependency" => Array('element' => "type", 'value' => array('flexslider_fade', 'flexslider_slide')),
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Output post title?", "Creativo"),
      "param_name" => "slides_title",
      "description" => __("If selected, title will be printed before the teaser text.", "Creativo"),
      "value" => Array(__("Yes, please", "Creativo") => true),
      "dependency" => Array('element' => "slides_content", 'value' => array('teaser')),
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Link", "Creativo"),
      "param_name" => "link",
      "value" => array(__("Link to post", "Creativo") => "link_post", __("Link to bigger image", "Creativo") => "link_image", __("Open custom link", "Creativo") => "custom_link", __("No link", "Creativo") => "link_no"),
      "description" => __("Link type.", "Creativo")
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Custom links", "Creativo"),
      "param_name" => "custom_links",
      "dependency" => Array('element' => "link", 'value' => 'custom_link'),
      "description" => __('Enter links for each slide here. Divide links with linebreaks (Enter).', 'Creativo')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Thumbnail size", "Creativo"),
      "param_name" => "thumb_size",
      "description" => __('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).', "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Post/Page IDs", "Creativo"),
      "param_name" => "posts_in",
      "description" => __('Fill this field with page/posts IDs separated by commas (,), to retrieve only them. Use this in conjunction with "Post types" field.', "Creativo")
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Categories", "Creativo"),
      "param_name" => "categories",
      "description" => __("If you want to narrow output, enter category names here. Note: Only listed categories will be included. Divide categories with linebreaks (Enter).", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Order by", "Creativo"),
      "param_name" => "orderby",
      "value" => array( "", __("Date", "Creativo") => "date", __("ID", "Creativo") => "ID", __("Author", "Creativo") => "author", __("Title", "Creativo") => "title", __("Modified", "Creativo") => "modified", __("Random", "Creativo") => "rand", __("Comment count", "Creativo") => "comment_count", __("Menu order", "Creativo") => "menu_order" ),
      "description" => sprintf(__('Select how to sort retrieved posts. More at %s.', 'Creativo'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Order by", "Creativo"),
      "param_name" => "order",
      "value" => array( __("Descending", "Creativo") => "DESC", __("Ascending", "Creativo") => "ASC" ),
      "description" => sprintf(__('Designates the ascending or descending order. More at %s.', 'Creativo'), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Widgetised sidebar
---------------------------------------------------------- */

vc_map( array(
  "name" => __("Widgetised Sidebar", "Creativo"),
  "base" => "vc_widget_sidebar",
  "class" => "wpb_widget_sidebar_widget",
  "icon" => "icon-wpb-layout_sidebar",
  "category" => __('Structure', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "widgetised_sidebars",
      "heading" => __("Sidebar", "Creativo"),
      "param_name" => "sidebar_id",
      "description" => __("Select which widget area output.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Button
---------------------------------------------------------- */
/*
$icons_arr = array(
    __("None", "Creativo") => "none",
    __("Address book icon", "Creativo") => "wpb_address_book",
    __("Alarm clock icon", "Creativo") => "wpb_alarm_clock",
    __("Anchor icon", "Creativo") => "wpb_anchor",
    __("Application Image icon", "Creativo") => "wpb_application_image",
    __("Arrow icon", "Creativo") => "wpb_arrow",
    __("Asterisk icon", "Creativo") => "wpb_asterisk",
    __("Hammer icon", "Creativo") => "wpb_hammer",
    __("Balloon icon", "Creativo") => "wpb_balloon",
    __("Balloon Buzz icon", "Creativo") => "wpb_balloon_buzz",
    __("Balloon Facebook icon", "Creativo") => "wpb_balloon_facebook",
    __("Balloon Twitter icon", "Creativo") => "wpb_balloon_twitter",
    __("Battery icon", "Creativo") => "wpb_battery",
    __("Binocular icon", "Creativo") => "wpb_binocular",
    __("Document Excel icon", "Creativo") => "wpb_document_excel",
    __("Document Image icon", "Creativo") => "wpb_document_image",
    __("Document Music icon", "Creativo") => "wpb_document_music",
    __("Document Office icon", "Creativo") => "wpb_document_office",
    __("Document PDF icon", "Creativo") => "wpb_document_pdf",
    __("Document Powerpoint icon", "Creativo") => "wpb_document_powerpoint",
    __("Document Word icon", "Creativo") => "wpb_document_word",
    __("Bookmark icon", "Creativo") => "wpb_bookmark",
    __("Camcorder icon", "Creativo") => "wpb_camcorder",
    __("Camera icon", "Creativo") => "wpb_camera",
    __("Chart icon", "Creativo") => "wpb_chart",
    __("Chart pie icon", "Creativo") => "wpb_chart_pie",
    __("Clock icon", "Creativo") => "wpb_clock",
    __("Fire icon", "Creativo") => "wpb_fire",
    __("Heart icon", "Creativo") => "wpb_heart",
    __("Mail icon", "Creativo") => "wpb_mail",
    __("Play icon", "Creativo") => "wpb_play",
    __("Shield icon", "Creativo") => "wpb_shield",
    __("Video icon", "Creativo") => "wpb_video"
);
*/

vc_map( array(
  "name" => __("Button", "Creativo"),
  "base" => "vc_button",
  "icon" => "icon-wpb-ui-button",
  "category" => __('Content', 'Creativo'),
  "description" => __('Eye catching button', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Text on the button", "Creativo"),
      "holder" => "button",
      "class" => "wpb_button",
      "param_name" => "title",
      "value" => __("Text on the button", "Creativo"),
      "description" => __("Text on the button.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "Creativo"),
      "param_name" => "href",
      "description" => __("Button link.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Target", "Creativo"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Color", "Creativo"),
      "param_name" => "color",
      "value" => $button_colors,
      "description" => __("Button color.", "Creativo")
    ),

    array(
      "type" => "dropdown",
      "heading" => __("Size", "Creativo"),
      "param_name" => "size",
      "value" => $size_arr,
      "description" => __("Button size.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Align", "Creativo"),
      "param_name" => "align",
      "value" => $alignment,
      "description" => __("Button alignment.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcButtonView'
) );

/* Call to Action Button
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Call to Action Box", "Creativo"),
  "base" => "tagline_box",
  "icon" => "icon-wpb-call-to-action",
  "description" => __('Catch visitors attention with CTA block', 'Creativo'),
  "category" => __('Content', 'Creativo'),
  "params" => array(

	array(
      "type" => "dropdown",
      "heading" => __("Action Box Style", "Creativo"),
      "param_name" => "action_box_style",
      "value" => $style_arr,
      "description" => __("Select the style of the Action Box - Style 2 will center the elements of the Action Box.", "Creativo")
    ),
	  
    array(
      "type" => "textarea",
      'admin_label' => true,
      "heading" => __("Big Text", "Creativo"),
      "param_name" => "call_text",
      "value" => __("Creativo is a rocksolid multipurpose theme, with 7 ready to use colors system!", "Creativo"),
      "description" => __("Enter your content.", "Creativo")
    ),
	array(
      "type" => "textarea",
      'admin_label' => true,
      "heading" => __("Small Text", "Creativo"),
      "param_name" => "call_text_small",
      "value" => __("Plus we have integrated 2 premium sliders, infinite colors and a very friendly to use theme options to easily customize your theme!", "Creativo"),
      "description" => __("Enter your content.", "Creativo")
    ),
	
    array(
      "type" => "textfield",
      "heading" => __("Text on the button", "Creativo"),
      "param_name" => "title",
      "value" => __("Text on the button", "Creativo"),
      "description" => __("Text on the button.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "Creativo"),
      "param_name" => "href",
      "description" => __("Button link.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Target", "Creativo"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Color", "Creativo"),
      "param_name" => "color",
      "value" => $button_colors,
      "description" => __("Button color.", "Creativo")
    ),
	/*
    array(
      "type" => "dropdown",
      "heading" => __("Icon", "Creativo"),
      "param_name" => "icon",
      "value" => $icons_arr,
      "description" => __("Button icon.", "Creativo")
    ),
	*/
    array(
      "type" => "dropdown",
      "heading" => __("Size", "Creativo"),
      "param_name" => "size",
      "value" => $size_arr,
      "description" => __("Button size.", "Creativo")
    ),
	
	 array(
      "type" => "dropdown",
      "heading" => __("Bottom Margin", "Creativo"),
      "param_name" => "margin",
      "admin_label" => true,
      "value" => array(0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50),
      "description" => __("Insert a bottom margin to the entire call to action box.", "Creativo")
    ),
	/*
    array(
      "type" => "dropdown",
      "heading" => __("Button position", "Creativo"),
      "param_name" => "position",
      "value" => array(__("Align right", "Creativo") => "cta_align_right", __("Align left", "Creativo") => "cta_align_left", __("Align bottom", "Creativo") => "cta_align_bottom"),
      "description" => __("Select button alignment.", "Creativo")
    ),
	*/
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  ),
  "js_view" => 'VcCallToActionView'
) );

/* Featured Services
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Featured Services", "Creativo"),
  "base" => "vc_service_box",
  "icon" => "icon-wpb-service-box",
  "description" => __('Add featured services box element.', 'Creativo'),
  "category" => __('Content', 'Creativo'),
  "params" => array(
    	
    array(
      "type" => "textfield",
      "heading" => __("Heading Title", "Creativo"),
      "param_name" => "title",
	  "holder" => "h2",
      "value" => __("Design", "Creativo"),
      "description" => __("Text on the button.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("URL (Link)", "Creativo"),
      "param_name" => "href",
      "description" => __("Button link.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Target", "Creativo"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
	array(
      "type" => "attach_image",
      "heading" => __("Icon", "Creativo"),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Select/upload image from media library.", "Creativo")
    ),

array(
      "type" => "textarea",
      "holder" => "div",
      "heading" => __("Text", "Creativo"),
      "param_name" => "content",
      "value" => __("Add your text for the featured services here", "Creativo")
    ),
	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Video element
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Video Player", "Creativo"),
  "base" => "vc_video",
  "icon" => "icon-wpb-film-youtube",
  "category" => __('Content', 'Creativo'),
  "description" => __('Embed YouTube/Vimeo player', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Video link", "Creativo"),
      "param_name" => "link",
      "admin_label" => true,
      "description" => sprintf(__('Link to the video. More about supported formats at %s.', "Creativo"), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Google maps element
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Google Maps", "Creativo"),
  "base" => "vc_gmaps",
  "icon" => "icon-wpb-map-pin",
  "category" => __('Content', 'Creativo'),
  "description" => __('Map block', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Google map link", "Creativo"),
      "param_name" => "link",
      "admin_label" => true,
      "description" => sprintf(__('Link to your map. Visit %s find your address and then click "Link" button to obtain your map link.', "Creativo"), '<a href="http://maps.google.com" target="_blank">Google maps</a>')
    ),
    array(
      "type" => "textfield",
      "heading" => __("Map height", "Creativo"),
      "param_name" => "size",
      "description" => __('Enter map height in pixels. Example: 200.', "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Map type", "Creativo"),
      "param_name" => "type",
      "value" => array(__("Map", "Creativo") => "m", __("Satellite", "Creativo") => "k", __("Map + Terrain", "Creativo") => "p"),
      "description" => __("Select map type.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Map Zoom", "Creativo"),
      "param_name" => "zoom",
      "value" => array(__("14 - Default", "Creativo") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
    ),
    array(
      "type" => 'checkbox',
      "heading" => __("Remove info bubble", "Creativo"),
      "param_name" => "bubble",
      "description" => __("If selected, information bubble will be hidden.", "Creativo"),
      "value" => Array(__("Yes, please", "Creativo") => true),
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Raw HTML
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Raw HTML", "Creativo"),
	"base" => "vc_raw_html",
	"icon" => "icon-wpb-raw-html",
	"category" => __('Structure', 'Creativo'),
	"description" => __('Output raw html code on your page', 'Creativo'),
	"wrapper_class" => "clearfix",
	"params" => array(
		array(
  		"type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Raw HTML", "Creativo"),
			"param_name" => "content",
			"value" => base64_encode(__("<p>I am raw html block.<br/>Click edit button to change this html</p>", "Creativo")),
			"description" => __("Enter your HTML content.", "Creativo")
		),
	)
) );

/* Raw JS
---------------------------------------------------------- */
vc_map( array(
	"name" => __("Raw JS", "Creativo"),
	"base" => "vc_raw_js",
	"icon" => "icon-wpb-raw-javascript",
	"category" => __('Structure', 'Creativo'),
	"wrapper_class" => "clearfix",
	"description" => __('Output raw javascript code on your page', 'Creativo'),
	"params" => array(
  	array(
  		"type" => "textarea_raw_html",
			"holder" => "div",
			"heading" => __("Raw js", "Creativo"),
			"param_name" => "content",
			"value" => base64_encode(__("<script type='text/javascript'> alert('Enter your js here!'); </script>", "Creativo")),
			"description" => __("Enter your JS code.", "Creativo")
		),
	)
) );

/* Flickr
---------------------------------------------------------- */
vc_map( array(
  "base" => "vc_flickr",
  "name" => __("Flickr Widget", "Creativo"),
  "icon" => "icon-wpb-flickr",
  "category" => __('Content', 'Creativo'),
  "description" => __('Image feed from your flickr account', 'Creativo'),
  "params"	=> array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Flickr ID", "Creativo"),
      "param_name" => "flickr_id",
      'admin_label' => true,
      "description" => sprintf(__('To find your flickID visit %s.', "Creativo"), '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Number of photos", "Creativo"),
      "param_name" => "count",
      "value" => array(9, 8, 7, 6, 5, 4, 3, 2, 1),
      "description" => __("Number of photos.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Type", "Creativo"),
      "param_name" => "type",
      "value" => array(__("User", "Creativo") => "user", __("Group", "Creativo") => "group"),
      "description" => __("Photo stream type.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Display", "Creativo"),
      "param_name" => "display",
      "value" => array(__("Latest", "Creativo") => "latest", __("Random", "Creativo") => "random"),
      "description" => __("Photo order.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );




/* Graph
---------------------------------------------------------- */
vc_map( array(
  "name" => __("Progress Bar", "Creativo"),
  "base" => "vc_progress_bar",
  "icon" => "icon-wpb-graph",
  "category" => __('Content', 'Creativo'),
  "description" => __('Animated progress bar', 'Creativo'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
    ),
    array(
      "type" => "exploded_textarea",
      "heading" => __("Graphic values", "Creativo"),
      "param_name" => "values",
      "description" => __('Input graph values here. Divide values with linebreaks (Enter). Example: 90|Development', 'Creativo'),
      "value" => "90|Development,80|Design,70|Marketing"
    ),
    array(
      "type" => "textfield",
      "heading" => __("Units", "Creativo"),
      "param_name" => "units",
      "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Bar color", "Creativo"),
      "param_name" => "bgcolor",
      "value" => array(__("Grey", "Creativo") => "bar_grey", __("Blue", "Creativo") => "bar_blue", __("Purple", "Creativo") => "bar_purple", __("Green", "Creativo") => "bar_green", __("Yellow", "Creativo") => "bar_yellow", __("Red", "Creativo") => "bar_red", __("Black", "Creativo") => "bar_black", __("Custom Color", "Creativo") => "custom"),
      "description" => __("Select bar background color.", "Creativo"),
      "admin_label" => true
    ),
    array(
      "type" => "colorpicker",
      "heading" => __("Bar custom color", "Creativo"),
      "param_name" => "custombgcolor",
      "description" => __("Select custom background color for bars.", "Creativo"),
      "dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
    ),
	array(
      "type" => "colorpicker",
      "heading" => __("Bar custom text color", "Creativo"),
      "param_name" => "customtextcolor",
      "description" => __("Select custom text color for bars.", "Creativo"),
      "dependency" => Array('element' => "bgcolor", 'value' => array('custom'))
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Options", "Creativo"),
      "param_name" => "options",
      "value" => array(__("Add Stripes?", "Creativo") => "striped", __("Add animation? Will be visible with striped bars.", "Creativo") => "animated")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );
/**
 * Pic chat
 */
vc_map( array(
    "name" => __("Pie chart", 'Creativo'),
    "base" => "vc_pie",
    "class" => "",
    "icon" => "icon-wpb-vc_pie",
    "category" => __('Content', 'Creativo'),
	"description" => __('Animated pie chart', 'Creativo'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget title", "Creativo"),
            "param_name" => "title",
            "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pie value", "Creativo"),
            "param_name" => "value",
            "description" => __('Input graph value here. Witihn a range 0-100.', 'Creativo'),
            "value" => "50",
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pie label value", "Creativo"),
            "param_name" => "label_value",
            "description" => __('Input integer value for label. If empty "Pie value" will be used.', 'Creativo'),
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Units", "Creativo"),
            "param_name" => "units",
            "description" => __("Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.", "Creativo")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Bar color", "Creativo"),
            "param_name" => "color",
            "value" => $button_colors,//$pie_colors,
            "description" => __("Select pie chart color.", "Creativo"),
            "admin_label" => true
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "Creativo"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
        ),

    )
) );

/* Support for 3rd Party plugins
---------------------------------------------------------- */
// Contact form 7 plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) {
  global $wpdb;
  $cf7 = $wpdb->get_results( 
  	"
  	SELECT ID, post_title 
  	FROM $wpdb->posts
  	WHERE post_type = 'wpcf7_contact_form' 
  	"
  );
  $contact_forms = array();
  if ($cf7) {
    foreach ( $cf7 as $cform ) {
      $contact_forms[$cform->post_title] = $cform->ID;
    }
  } else {
    $contact_forms["No contact forms found"] = 0;
  }
  vc_map( array(
    "base" => "contact-form-7",
    "name" => __("Contact Form 7", "Creativo"),
    "icon" => "icon-wpb-contactform7",
    "category" => __('Content', 'Creativo'),
	"description" => __('Place Contact Form7', 'Creativo'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Form title", "Creativo"),
        "param_name" => "title",
        "admin_label" => true,
        "description" => __("What text use as form title. Leave blank if no title is needed.", "Creativo")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Select contact form", "Creativo"),
        "param_name" => "id",
        "value" => $contact_forms,
        "description" => __("Choose previously created contact form from the drop down list.", "Creativo")
      )
    )
  ) );
} // if contact form7 plugin active

if (is_plugin_active('LayerSlider/layerslider.php')) {
  global $wpdb;
  $ls = $wpdb->get_results( 
  	"
  	SELECT id, name, date_c
  	FROM ".$wpdb->prefix."layerslider
  	WHERE flag_hidden = '0' AND flag_deleted = '0'
  	ORDER BY date_c ASC LIMIT 100
  	"
  );
  $layer_sliders = array();
  if ($ls) {
    foreach ( $ls as $slider ) {
      $layer_sliders[$slider->name] = $slider->id;
    }
  } else {
    $layer_sliders["No sliders found"] = 0;
  }
  vc_map( array(
    "base" => "layerslider_vc",
    "name" => __("Layer Slider", "Creativo"),
    "icon" => "icon-wpb-layerslider",
    "category" => __('Content', 'Creativo'),
	"description" => __('Place LayerSlider', 'Creativo'),
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "Creativo"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("LayerSlider ID", "Creativo"),
        "param_name" => "id",
        "admin_label" => true,
        "value" => $layer_sliders,
        "description" => __("Select your LayerSlider.", "Creativo")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "Creativo"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
      )
    )
  ) );
} // if layer slider plugin active

if (is_plugin_active('revslider/revslider.php')) {
  global $wpdb;
  $rs = $wpdb->get_results( 
  	"
  	SELECT id, title, alias
  	FROM ".$wpdb->prefix."revslider_sliders
  	ORDER BY id ASC LIMIT 100
  	"
  );
  $revsliders = array();
  if ($rs) {
    foreach ( $rs as $slider ) {
      $revsliders[$slider->title] = $slider->alias;
    }
  } else {
    $revsliders["No sliders found"] = 0;
  }
  vc_map( array(
    "base" => "rev_slider_vc",
    "name" => __("Revolution Slider", "Creativo"),
    "icon" => "icon-wpb-revslider",
    "category" => __('Content', 'Creativo'),
	"description" => __('Place Revolution slider', 'Creativo'),
    "params"=> array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "Creativo"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Revolution Slider", "Creativo"),
        "param_name" => "alias",
        "admin_label" => true,
        "value" => $revsliders,
        "description" => __("Select your Revolution Slider.", "Creativo")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "Creativo"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
      )
    )
  ) );
} // if revslider plugin active

if (is_plugin_active('gravityforms/gravityforms.php')) {
  $gravity_forms_array[__("No Gravity forms found.", "Creativo")] = '';
  if ( class_exists('RGFormsModel') ) {
    $gravity_forms = RGFormsModel::get_forms(1, "title");
    if ($gravity_forms) {
      $gravity_forms_array = array(__("Select a form to display.", "Creativo") => '');
      foreach ( $gravity_forms as $gravity_form ) {
        $gravity_forms_array[$gravity_form->title] = $gravity_form->id;
      }
    }
  }
  vc_map( array(
    "name" => __("Gravity Form", "Creativo"),
    "base" => "gravityform",
    "icon" => "icon-wpb-vc_gravityform",
    "category" => __("Content", "Creativo"),
	"description" => __('Place Gravity form', 'Creativo'),
    "params" => array(
      array(
        "type" => "dropdown",
        "heading" => __("Form", "Creativo"),
        "param_name" => "id",
        "value" => $gravity_forms_array,
        "description" => __("Select a form to add it to your post or page.", "Creativo"),
        "admin_label" => true
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Display Form Title", "Creativo"),
        "param_name" => "title",
        "value" => array( __("No", "Creativo") => 'false', __("Yes", "Creativo") => 'true' ),
        "description" => __("Would you like to display the forms title?", "Creativo"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Display Form Description", "Creativo"),
        "param_name" => "description",
        "value" => array( __("No", "Creativo") => 'false', __("Yes", "Creativo") => 'true' ),
        "description" => __("Would you like to display the forms description?", "Creativo"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Enable AJAX?", "Creativo"),
        "param_name" => "ajax",
        "value" => array( __("No", "Creativo") => 'false', __("Yes", "Creativo") => 'true' ),
        "description" => __("Enable AJAX submission?", "Creativo"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      ),
      array(
        "type" => "textfield",
        "heading" => __("Tab Index", "Creativo"),
        "param_name" => "tabindex",
        "description" => __("(Optional) Specify the starting tab index for the fields of this form. Leave blank if you're not sure what this is.", "Creativo"),
        "dependency" => Array('element' => "id", 'not_empty' => true)
      )
    )
  ) );
} // if gravityforms active

/* WordPress default Widgets (Appearance->Widgets)
---------------------------------------------------------- */


vc_map( array(
  "name" => 'WP ' . __("Search"),
  "base" => "vc_wp_search",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => 'WP ' . __("Meta"),
  "base" => "vc_wp_meta",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => 'WP ' . __("Recent Comments"),
  "base" => "vc_wp_recentcomments",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Number of comments to show", "Creativo"),
      "param_name" => "number",
      "admin_label" => true
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => 'WP ' . __("Calendar"),
  "base" => "vc_wp_calendar",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => 'WP ' . __("Pages"),
  "base" => "vc_wp_pages",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Sort by", "Creativo"),
      "param_name" => "sortby",
      "value" => array(__("Page title", "Creativo") => "post_title", __("Page order", "Creativo") => "menu_order", __("Page ID", "Creativo") => "ID"),
      "admin_label" => true
    ),
    array(
      "type" => "textfield",
      "heading" => __("Exclude", "Creativo"),
      "param_name" => "exclude",
      "description" => __("Page IDs, separated by commas.", "Creativo"),
      "admin_label" => true
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

$tag_taxonomies = array();
foreach ( get_taxonomies() as $taxonomy ) :
  $tax = get_taxonomy($taxonomy);
	if ( !$tax->show_tagcloud || empty($tax->labels->name) )
  	continue;
	$tag_taxonomies[$tax->labels->name] = esc_attr($taxonomy);
endforeach;
vc_map( array(
  "name" => 'WP ' . __("Tag Cloud"),
  "base" => "vc_wp_tagcloud",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Taxonomy", "Creativo"),
      "param_name" => "taxonomy",
      "value" => $tag_taxonomies,
      "admin_label" => true
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

$custom_menus = array();
$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
if ( $menus ) {
  foreach ( $menus as $single_menu ) {
    $custom_menus[$single_menu->name] = $single_menu->term_id;
  }
  vc_map( array(
    "name" => 'WP ' . __("Custom Menu"),
    "base" => "vc_wp_custommenu",
    "icon" => "icon-wpb-wp",
    "category" => __("WordPress Widgets", "Creativo"),
    "class" => "wpb_vc_wp_widget",
    "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Widget title", "Creativo"),
        "param_name" => "title",
        "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Menu", "Creativo"),
        "param_name" => "nav_menu",
        "value" => $custom_menus,
        "description" => __("Select menu", "Creativo"),
        "admin_label" => true
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "Creativo"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
      )
    )
  ) );
}

vc_map( array(
  "name" => 'WP ' . __("Text"),
  "base" => "vc_wp_text",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textarea",
      "heading" => __("Text", "Creativo"),
      "param_name" => "text",
      "admin_label" => true
    ),
    /*array(
      "type" => "checkbox",
      "heading" => __("Automatically add paragraphs", "Creativo"),
      "param_name" => "filter"
    ),*/
	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


vc_map( array(
  "name" => 'WP ' . __("Recent Posts"),
  "base" => "vc_wp_posts",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Number of posts to show", "Creativo"),
      "param_name" => "number",
      "admin_label" => true
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Display post date?", "Creativo"),
      "param_name" => "show_date",
      "value" => array(__("Display post date?") => true )
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


$link_category = array(__("All Links", "Creativo") => "");
$link_cats = get_terms( 'link_category' );
foreach ( $link_cats as $link_cat ) {
  $link_category[$link_cat->name] = $link_cat->term_id;
}
vc_map( array(
  "name" => 'WP ' . __("Links"),
  "base" => "vc_wp_links",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "dropdown",
      "heading" => __("Link Category", "Creativo"),
      "param_name" => "category",
      "value" => $link_category,
      "admin_label" => true
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Sort by", "Creativo"),
      "param_name" => "orderby",
      "value" => array(__("Link title", "Creativo") => "name", __("Link rating", "Creativo") => "rating", __("Link ID", "Creativo") => "id", __("Random", "Creativo") => "rand")
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Options", "Creativo"),
      "param_name" => "options",
      "value" => array(__("Show Link Image", "Creativo") => "images", __("Show Link Name", "Creativo") => "name", __("Show Link Description", "Creativo") => "description", __("Show Link Rating", "Creativo") => "rating")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Number of links to show", "Creativo"),
      "param_name" => "limit"
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


vc_map( array(
  "name" => 'WP ' . __("Categories"),
  "base" => "vc_wp_categories",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Options", "Creativo"),
      "param_name" => "options",
      "value" => array(__("Display as dropdown", "Creativo") => "dropdown", __("Show post counts", "Creativo") => "count", __("Show hierarchy", "Creativo") => "hierarchical")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


vc_map( array(
  "name" => 'WP ' . __("Archives"),
  "base" => "vc_wp_archives",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Options", "Creativo"),
      "param_name" => "options",
      "value" => array(__("Display as dropdown", "Creativo") => "dropdown", __("Show post counts", "Creativo") => "count")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/* Custom Flickr Widget */

vc_map( array(
  "name" => __("Flickr Widget (Custom)", "Creativo"),
  "base" => "vc_wp_flickr_widget",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Screen name", "Creativo"),
      "param_name" => "screen_name",
	  "admin_label" => true,
      "description" => __("Inser the user name from flickr.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Picture count", "Creativo"),
      "param_name" => "number",
	  "admin_label" => true,
	  "description" => __("Select how many pictures to show.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => __("Recent Posts (Custom)", "Creativo"),
  "base" => "vc_wp_custom_posts",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text to use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Items count", "Creativo"),
      "param_name" => "number",
	  "admin_label" => true,
	  "description" => __("Select how many recent articles to show.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => __("Recent Portfolio (Custom)", "Creativo"),
  "base" => "vc_wp_custom_portf",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text to use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Items count", "Creativo"),
      "param_name" => "number",
	  "admin_label" => true,
	  "description" => __("Select how many recent articles to show.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12)
    ),
    array(
      "type" => "textfield",
      "heading" => __("Short Description", "Creativo"),
      "param_name" => "desc",
	  "admin_label" => true,
	  "value" => "",
      "description" => __("You can enter a short text to describe your portfolio.", "Creativo")
    ),	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => __("Popular / Recent Posts Tabs (Custom)", "Creativo"),
  "base" => "vc_wp_rec_pop_tabs",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text to use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Show popular posts", "Creativo"),
      "param_name" => "show_popular_posts",
	  "admin_label" => true,
      "value" => array( __("Yes", "Creativo") => 'true', __("No", "Creativo") => 'false' )
    ),

    array(
      "type" => "dropdown",
      "heading" => __("Popular posts count", "Creativo"),
      "param_name" => "posts",
	  "description" => __("Select how many popular posts to show in tabs.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12),
	  "dependency" => Array('element' => 'show_popular_posts', 'value' => array('true'))
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Show recent posts", "Creativo"),
      "param_name" => "show_recent_posts",
	  "admin_label" => true,
      "value" => array( __("Yes", "Creativo") => 'true', __("No", "Creativo") => 'false' )
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Recent posts count", "Creativo"),
      "param_name" => "recent",
	  "description" => __("Select how many recent posts to show in tabs.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12),
	  "dependency" => Array('element' => 'show_recent_posts', 'value' => array('true'))
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Show comments", "Creativo"),
      "param_name" => "show_comments",
	  "admin_label" => true,
      "value" => array( __("Yes", "Creativo") => 'true', __("No", "Creativo") => 'false' )
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Comments count", "Creativo"),
      "param_name" => "comments",
	  "description" => __("Select how many comments to show in tabs.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12),
	  "dependency" => Array('element' => 'show_comments', 'value' => array('true'))
    ),
	
	array(
      "type" => "dropdown",
      "heading" => __("Tabs Color", "Creativo"),
      "param_name" => "color",
	  "admin_label" => true,
	  "description" => __("Select the color of the tabs.", "Creativo"),
      "value" => $button_colors
    ),
	
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
  "name" => __("Contact us (Custom)", "Creativo"),
  "base" => "vc_wp_contact_us",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text to use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Address", "Creativo"),
      "param_name" => "address",
	  "admin_label" => true,
      "description" => __("Enter your contact address.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Phone", "Creativo"),
      "param_name" => "phone",
	  "admin_label" => true,
      "description" => __("Enter your contact phone.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Fax", "Creativo"),
      "param_name" => "fax",
	  "admin_label" => true,
      "description" => __("Enter your contact fax.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Email", "Creativo"),
      "param_name" => "email",
	  "admin_label" => true,
      "description" => __("Enter your contact email.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Website URL", "Creativo"),
      "param_name" => "web",
	  "admin_label" => true,
      "description" => __("Enter your contact website.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


vc_map( array(
  "name" => __("Social Links (Custom)", "Creativo"),
  "base" => "vc_wp_social_links",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text to use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Facbook Link", "Creativo"),
      "param_name" => "fb_link",
	  "admin_label" => true,
      "description" => __("Enter your facebook profile/page link.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Twitter Link", "Creativo"),
      "param_name" => "twitter_link",
	  "admin_label" => true,
      "description" => __("Enter your twitter profile link.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("LinkedIn Link", "Creativo"),
      "param_name" => "linkedin_link",
	  "admin_label" => true,
      "description" => __("Enter your linkedin profile link.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Tumblr Link", "Creativo"),
      "param_name" => "tumblr_link",
	  "admin_label" => true,
      "description" => __("Enter your tumblr profile link.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Reddit Link", "Creativo"),
      "param_name" => "reddit_link",
	  "admin_label" => true,
      "description" => __("Enter your reddit profile link.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Google Link", "Creativo"),
      "param_name" => "google_link",
	  "admin_label" => true,
      "description" => __("Enter your google profile link.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );


vc_map( array(
  "name" => __("Twitter Feed (Custom)", "Creativo"),
  "base" => "vc_wp_twitter_feed",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text to use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Consumer Key", "Creativo"),
      "param_name" => "consumer_key",
      "description" => __("Enter your twitter api consumer key.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Consumer Secret", "Creativo"),
      "param_name" => "consumer_secret",
      "description" => __("Enter your twitter api consumer secret.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Access Token", "Creativo"),
      "param_name" => "access_token",
      "description" => __("Enter your twitter api access token.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Access Token Secret", "Creativo"),
      "param_name" => "access_token_secret",
      "description" => __("Enter your twitter api access token secret.", "Creativo")
    ),
	array(
      "type" => "textfield",
      "heading" => __("Twitter ID", "Creativo"),
      "param_name" => "twitter_id",
	  "admin_label" => true,
      "description" => __("Enter your twitter id.", "Creativo")
    ),
	array(
      "type" => "dropdown",
      "heading" => __("Number of tweets", "Creativo"),
      "param_name" => "count",
	  "description" => __("Select how many tweets to show.", "Creativo"),
      "value" => array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15),
	  "admin_label" => true
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

/*
//BETA: Not ready for use on live website
vc_map( array(
  "name" => 'WP ' . __("RSS"),
  "base" => "vc_wp_rss",
  "icon" => "icon-wpb-wp",
  "category" => __("WordPress Widgets", "Creativo"),
  "class" => "wpb_vc_wp_widget",
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Widget title", "Creativo"),
      "param_name" => "title",
      "description" => __("What text use as a widget title. Leave blank to use default widget title.", "Creativo")
    ),
    array(
      "type" => "textfield",
      "heading" => __("RSS feed URL", "Creativo"),
      "param_name" => "url",
      "description" => __("Enter the RSS feed URL.", "Creativo"),
      "admin_label" => true
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Items", "Creativo"),
      "param_name" => "items",
      "value" => array(__("10 - Default", "Creativo") => '', 1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20),
      "description" => __("How many items would you like to display?", "Creativo"),
      "admin_label" => true
    ),
    array(
      "type" => "checkbox",
      "heading" => __("Options", "Creativo"),
      "param_name" => "options",
      "value" => array(__("Display item content?", "Creativo") => "show_summary", __("Display item author if available?", "Creativo") => "show_author", __("Display item date?", "Creativo") => "show_date")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "Creativo"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
    )
  )
) );

vc_map( array(
    "name" => __("Items", "Creativo"),
    "base" => "vc_items",
    "as_parent" => array('only' => 'vc_item'),
    "content_element" => true,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "Creativo"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
        )
    ),
    "js_view" => 'VcColumnView'
) );
vc_map( array(
    "name" => __("Item", "Creativo"),
    "base" => "vc_item",
    "content_element" => true,
    "as_child" => array('only' => 'vc_items'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "Creativo"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
        )
    )
) );

class WPBakeryShortCode_VC_Items extends WPBakeryShortCode_VC_Column {

}
/**
 * New teaser grid !!
 */
/*vc_map( array(
    "name" => __("Posts grid", "Creativo"),
    "base" => "vc_posts_grid",
    "is_container" => true,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget title", "Creativo"),
            "param_name" => "title",
            "description" => __("What text use as a widget title. Leave blank if no title is needed.", "Creativo")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns count", "Creativo"),
            "param_name" => "grid_columns_count",
            "value" => array(4, 3, 2, 1),
            "admin_label" => true,
            "description" => __("Select columns count.", "Creativo")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Content", "Creativo"),
            "param_name" => "grid_content",
            "value" => array(__("Teaser (Excerpt)", "Creativo") => "teaser", __("Full Content", "Creativo") => "content"),
            "description" => __("Teaser layout template.", "Creativo")
        ),
        array(
            "type" => "teaser_template",
            "heading" => __("Layout", "Creativo"),
            "param_name" => "grid_layout",
            "description" => __("Teaser layout.", "Creativo")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link", "Creativo"),
            "param_name" => "grid_link",
            "value" => array(__("Link to post", "Creativo") => "link_post", __("Link to bigger image", "Creativo") => "link_image", __("Thumbnail to bigger image, title to post", "Creativo") => "link_image_post", __("No link", "Creativo") => "link_no"),
            "description" => __("Link type.", "Creativo")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link target", "Creativo"),
            "param_name" => "grid_link_target",
            "value" => $target_arr,
            "dependency" => Array('element' => "grid_link", 'value' => array('link_post', 'link_image_post'))
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Teaser grid layout", "Creativo"),
            "param_name" => "grid_template",
            "value" => array(__("Grid", "Creativo") => "grid", __("Grid with filter", "Creativo") => "filtered_grid", __("Carousel", "Creativo") => "carousel"),
            "description" => __("Teaser layout template.", "Creativo")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Layout mode", "Creativo"),
            "param_name" => "grid_layout_mode",
            "value" => array(__("Fit rows", "Creativo") => "fitRows", __('Masonry', "Creativo") => 'masonry'),
            "dependency" => Array('element' => 'grid_template', 'value' => array('filtered_grid', 'grid')),
            "description" => __("Teaser layout template.", "Creativo")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Thumbnail size", "Creativo"),
            "param_name" => "grid_thumb_size",
            "description" => __('Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height).', "Creativo")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "Creativo"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "Creativo")
        ),
        array(
            "type" => "teaser_template",
            "heading" => __("Layout", "Creativo"),
            "param_name" => "grid_layout",
            "description" => __("Teaser layout.", "Creativo")
        ),
        array(
            "type" => "loop",
            "heading" => __("Loop", "Creativo"),
            "param_name" => "loop",
            'settings' => array(
                'size' => array('hidden' => false, 'value' => 90),
                'order_by' => array('value' => 'date'),
            ),
            "description" => __("Create super mega query.", "Creativo")
        ),
        array(
            "type" => "vc_link",
            "heading" => __("Link", "Creativo"),
            "param_name" => "link",
            "description" => __("This adds a link selection box", "Creativo")
        )
    )
    // 'html_template' => dirname(__DIR__).'/composer/shortcodes_templates/vc_posts_grid.php'
) );*/
/*
VcTeaserTemplates::getInstance('vc_posts_grid', 'teaser_template');

WPBMap::layout(array('id'=>'column_12', 'title'=>'1/2'));
WPBMap::layout(array('id'=>'column_12-12', 'title'=>'1/2 + 1/2'));
WPBMap::layout(array('id'=>'column_13', 'title'=>'1/3'));
WPBMap::layout(array('id'=>'column_13-13-13', 'title'=>'1/3 + 1/3 + 1/3'));
WPBMap::layout(array('id'=>'column_13-23', 'title'=>'1/3 + 2/3'));
WPBMap::layout(array('id'=>'column_14', 'title'=>'1/4'));
WPBMap::layout(array('id'=>'column_14-14-14-14', 'title'=>'1/4 + 1/4 + 1/4 + 1/4'));
WPBMap::layout(array('id'=>'column_16', 'title'=>'1/6'));
WPBMap::layout(array('id'=>'column_11', 'title'=>'1/1'));
*/

