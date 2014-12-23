<?php
$output = $category = $orderby = $options = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'fb_link' => '',
	'twitter_link' => '',
	'linkedin_link' => '',
	'tumblr_link' => '',
	'reddit_link' => '',
	'google_link' => '',
    'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass($el_class);

$output = '<div class="sidebar-widget vc_wp_social_links '.$el_class.'">';
$type = 'Social_Links_Widget';
$args = array( 'before_title'=>'<h3 class="sidebar-title">', 'after_title'=>'</h3><div class="split-line"></div><div class="clr"></div>');

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment('vc_wp_links') . "\n";

echo $output;