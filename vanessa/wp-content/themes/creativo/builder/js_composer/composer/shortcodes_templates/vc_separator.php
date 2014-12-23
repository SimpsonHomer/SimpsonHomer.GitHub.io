<?php
$output = '';

extract(shortcode_atts(array(
    'style' => 'dotted',
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_content_element', $this->settings['base']);
$output .= '<div class="divider_' . $style . ' ' . $css_class . '"></div>' . $this->endBlockComment('separator')."\n";

echo $output;