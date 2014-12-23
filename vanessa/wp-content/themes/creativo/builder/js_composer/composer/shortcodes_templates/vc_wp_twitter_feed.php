<?php
$output = $category = $orderby = $options = $el_class = '';
extract( shortcode_atts( array(
    'title' => '',
    'consumer_key' => '',
	'consumer_secret' => '',
	'access_token' => '',
	'access_token_secret' => '',
	'twitter_id' => '',
	'count' => '',
    'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass($el_class);

$output = '<div class="sidebar-widget vc_wp_twitter_feed '.$el_class.'">';
$type = 'Tweets_Widget';
$args = array( 'before_title'=>'<h3 class="sidebar-title">', 'after_title'=>'</h3><div class="split-line"></div><div class="clr"></div>');

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment('vc_wp_links') . "\n";

echo $output;