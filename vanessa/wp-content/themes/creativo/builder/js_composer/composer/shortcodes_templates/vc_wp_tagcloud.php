<?php
$output = $title = $el_class = $taxonomy = '';
extract( shortcode_atts( array(
    'title' => __( 'Tags' ),
    'taxonomy' => 'post_tag',
    'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass($el_class);

$output = '<div class="sidebar-widget vc_wp_tagcloud'.$el_class.'">';
$type = 'WP_Widget_Tag_Cloud';
$args = array( 'before_title'=>'<h3 class="sidebar-title">', 'after_title'=>'</h3><div class="split-line"></div><div class="clr"></div>');

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment('vc_wp_tagcloud') . "\n";

echo $output;