<?php
$output = $title = $el_class = $text = $filter = '';
extract( shortcode_atts( array(
    'title' => '',
    'text' => '',
    'filter' => true,
    'el_class' => ''
), $atts ) );
$atts['filter'] = true; //Hack to make sure that <p> added

$el_class = $this->getExtraClass($el_class);

$output = '<div class="sidebar-widget vc_wp_text'.$el_class.'">';
$type = 'WP_Widget_Text';
$args = array( 'before_title'=>'<h3 class="sidebar-title">', 'after_title'=>'</h3><div class="split-line"></div><div class="clr"></div>');

ob_start();
the_widget( $type, $atts, $args );
$output .= ob_get_clean();

$output .= '</div>' . $this->endBlockComment('vc_wp_text') . "\n";

echo $output;