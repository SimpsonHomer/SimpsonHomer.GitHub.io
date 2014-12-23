<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "Creativo")
), $atts));

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'outer_toggle', $this->settings['base']);
$output .= "\n\t\t\t" . '<div class="'.$css_class.'">';
    $output .= "\n\t\t\t\t" . '<h5 class="toggle wpb_accordion_header ui-accordion-header"><a href="#" class="grey_color">'.$title.'</a></h5>';
    $output .= "\n\t\t\t\t" . '<div class="wpb_accordion_content ui-accordion-content clearfix">';
        $output .= ($content=='' || $content==' ') ? __("Empty section. Edit page to add content here.", "Creativo") : "\n\t\t\t\t" . wpb_js_remove_wpautop($content);
        $output .= "\n\t\t\t\t" . '</div>';
    $output .= "\n\t\t\t" . '</div> ' . $this->endBlockComment('.wpb_accordion_section') . "\n";

echo $output;