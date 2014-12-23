<?php
$output = $el_class = '';
extract(shortcode_atts(array(
	'layout' => 'normal',
	'margintop' => '0',
	'marginbottom' => '0',
	'paddingtop' => '0',
	'paddingbottom' => '0',
	'bg_color' => '',
    'el_class' => '',
), $atts));

wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
wp_enqueue_style('js_composer_custom_css');

$el_class = $this->getExtraClass($el_class);

$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_row '.get_row_css_class().$el_class, $this->settings['base']);

if ( $paddingtop != '0' ) $paddingt='padding-top:'.$paddingtop.'px; ';
if ( $paddingbottom != '0' ) $paddingb='padding-bottom:'.$paddingbottom.'px; ';

if ( $margintop != '0' ) $margint='margin-top:'.$margintop.'px; ';
if ( $marginbottom != '0' ) $marginb='margin-bottom:'.$marginbottom.'px; ';

$bg = 'background-color:'.$bg_color.';'; 

$output .= '<div class="'.$css_class.' outer_wrap" style="'.$margint.$marginb.$bg.$paddingt.$paddingb.'">';

if($layout == 'normal'): $class = 'inner_wrap '; endif;
$output .= '<div class="'.$class.'clearfix">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= '</div>'.$this->endBlockComment('row');

echo $output;