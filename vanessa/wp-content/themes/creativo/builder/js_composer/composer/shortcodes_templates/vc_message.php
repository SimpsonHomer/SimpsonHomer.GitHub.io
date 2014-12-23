<?php
$output = $color = $el_class = $css_animation = '';
extract(shortcode_atts(array(
    'color' => 'alert',
    'el_class' => '',
    'css_animation' => ''
), $atts));
$el_class = $this->getExtraClass($el_class);

if ($color == "warning") $color = "notice";
//$color = ( $color != '' ) ? ' wpb_'.$color : '';
//$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'alert '.$color.$el_class, $this->settings['base']);
//$css_class .= $this->getCSSAnimation($css_animation);
$output .= '<div class="alert '.$color.' '.$el_class.'">';
$output .= '<div class="msg">'.wpb_js_remove_wpautop($content).'</div>';
$output .= '<div class="tg"><a href="#" class="toggle-alert">Toggle</a></div>';
$output .= '</div>'.$this->endBlockComment('alert box')."\n";

//$output .='<div class="alert error"><div class="msg">This is an Error Message.</div><a href="#" class="toggle-alert">Toggle</a></div>';

echo $output;
