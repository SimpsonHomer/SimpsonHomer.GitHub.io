<?php
$output = $title = $el_class = $open = $css_animation = '';
extract(shortcode_atts(array(
    'title' => __("Click to toggle", "js_composer"),
    'el_class' => '',
    'open' => 'false',
    'color' => 'green'
), $atts));

$el_class = $this->getExtraClass($el_class);
$open = ( $open == 'true' ) ? ' active' : '';
$toggle = ( $open == ' active' ) ? ' default-open' : '';

//$el_class .= ( $open == ' wpb_toggle_title_active' ) ? ' wpb_toggle_open' : '';

//$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_toggle'.$open, $this->settings['base']);
//$css_class .= $this->getCSSAnimation($css_animation);

$output .= '<div class="outer_toggle'.$el_class.'">';
$output .= apply_filters('wpb_toggle_heading', '<h5 class="toggle '.$open.'"><a href="#" class="'.$color.'_color"><span class="'.$color.'_style"></span>'.$title.'</a></h5>', array('title'=>$title, 'open'=>$open));
//$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_toggle_content'.$el_class, $this->settings['base']);
$output .= '<div class="toggle-content'.$toggle.'">'.wpb_js_remove_wpautop($content).'</div>';
$output .= '</div>'.$this->endBlockComment('toggle')."\n";
echo $output;