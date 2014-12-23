<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract(shortcode_atts(array(
    'color' => 'green',
    'size' => '',
    'align' => 'center',
    'target' => '_self',
    'href' => '',
    'el_class' => '',
    'title' => __('Text on the button', "js_composer"),
    'position' => ''
), $atts));
$a_class = '';

if ( $el_class != '' ) {
    $tmp_class = explode(" ", strtolower($el_class));
    $tmp_class = str_replace(".", "", $tmp_class);
    if ( in_array("prettyphoto", $tmp_class) ) {
        wp_enqueue_script( 'prettyphoto' );
        wp_enqueue_style( 'prettyphoto' );
        $a_class .= ' prettyphoto';
        $el_class = str_ireplace("prettyphoto", "", $el_class);
    }
}

if ( $target == 'same' || $target == '_self' ) { $target = ''; }
$target = ( $target != '' ) ? ' target="'.$target.'"' : '';

$color = ( $color != '' ) ? $color = 'button_'.$color : '';
if($align == 'center'): $div_add = 'aligncenter'; endif;
$align = ( $align !='' ) ? 'style="float:'.$align.';"' : '';

$clear = '<div class="clear"></div>';
$el_class = $this->getExtraClass($el_class);

//$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_button '.$color.$size.$el_class, $this->settings['base']);
/*
if ( $href != '' ) {
    $output .= '<span class="'.$css_class.'">'.$title.$i_icon.'</span>';
    $output = '<a class="wpb_button_a'.$a_class.'" title="'.$title.'" href="'.$href.'"'.$target.'>' . $output . '</a>';
*/	
	$output = '<div class="clearfix bottommargin '. $div_add .'"><a class="button ' . $size . ' ' .  $color . ' ' . $el_class . '" href="'.$href.'" target="' . $target . '" ' . $align . '>' .$title. '</a></div>';
/*
} else {
    $output .= '<button class="button ' . $size . ' ' .  $color . '">'.$title.'</button>';

}
*/
echo $output . $this->endBlockComment('button') . "\n";
