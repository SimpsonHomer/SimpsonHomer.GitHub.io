<?php
//////////////////////////////////////////////////////////////////
// Youtube shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('youtube', 'shortcode_youtube');
	function shortcode_youtube($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 600,
				'height' => 360
			), $atts);
		
			return '<iframe title="YouTube video player" width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="http://www.youtube.com/embed/' . $atts['id'] . '" frameborder="0" allowfullscreen></iframe>';
	}
	
//////////////////////////////////////////////////////////////////
// Vimeo shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('vimeo', 'shortcode_vimeo');
	function shortcode_vimeo($atts) {
		$atts = shortcode_atts(
			array(
				'id' => '',
				'width' => 600,
				'height' => 360
			), $atts);
		
			return '<iframe src="http://player.vimeo.com/video/' . $atts['id'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '" frameborder="0"></iframe>';
	}
	
//////////////////////////////////////////////////////////////////
// SoundCloud shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('soundcloud', 'shortcode_soundcloud');
	function shortcode_soundcloud($atts) {
		$params = $atts['params'];
		$atts = shortcode_atts(
			array(
				'url' => '',
				'width' => '100%',
				'height' => 166,
				'comments' => 'true',
				'params' => 'auto_play=false&show_artwork=false&color=8bc84f'
			), $atts);
			return 
			
				'<iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player/?url='.urlencode($atts['url']). '&amp;'.$atts['params'].'"></iframe>';


				
	}
	
//////////////////////////////////////////////////////////////////
// Button shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('button', 'shortcode_button');
	function shortcode_button($atts, $content = null) {	
		if( $atts['style']){ $style='button_'. $atts['style']; } else{ $style='button_default'; }		
			return '<a class="button ' . $atts['size'] . ' ' .  $style . '" href="'.$atts['link'].'" target="' . $atts['target'] . '" style="float:'.$atts['float'].'; margin:'.$atts['margin'].'px;">' .do_shortcode($content). '</a>';
	}
	
	
//////////////////////////////////////////////////////////////////
// Divider shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('divider', 'shortcode_divider');
	function shortcode_divider($atts) {
			return '<div class="divider_'.$atts['style'].'"></div>';
	}	
	
//////////////////////////////////////////////////////////////////
// Dropcap shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('dropcap', 'shortcode_dropcap');
	function shortcode_dropcap( $atts, $content = null ) {  
		$color = $atts['color'];
		if(!$color){ $color = 'default'; }
		$bg = $atts['background'];
		if($atts['size']=='small'){
			$class='dropcap_sm';
		}
		else{
			$class='dropcap';
		}
		switch ($bg){
			case 'green':
				$bg = 'background-color:#A5CB5E;';
			break;
			case 'yellow':
				$bg = 'background-color:#FEBF4D;';
			break;
			case 'black':
				$bg = 'background-color:#454545;';
			break;
			case 'grey':
				$bg = 'background-color:#E1E1E1;';
			break;
			case 'red':
				$bg = 'background-color:#F6677B;';
			break;
			case 'blue':
				$bg = 'background-color:#73D0F1;';
			break;
			case 'purple':
				$bg = 'background-color:#D798D1;';
			break;
			case 'white':
				$bg = 'background-color:#fff;';
			break;
		}
		$style = $atts['style'];		
		return '<span class="'.$class.' '.$atts['style'].' '.$color.'_dc" style="'.$bg.'">' .do_shortcode($content). '</span>';  	
}

//////////////////////////////////////////////////////////////////
// Quotebox shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('qbox', 'shortcode_qbox');
function shortcode_qbox( $atts, $content = null ) {
	extract(shortcode_atts(array(			
			'icon' => '',
			'title1' => '',
			'title2' => '',					
			'el_class' => ''
	), $atts));

	$output = '';  
	
	if($icon){		
		$img = wp_get_attachment_image_src($icon);		
		$icon = '<div class="qbox_icon"><img src="'.$img[0].'"></div>';
	}
		
		$output .= '<div class="outer_qbox"><div class="qbox">';
		if($title1){
			$output .= '<div class="qbox_title1">'.$title1.'</div>';
		}
		
		$output .= '<div class="qbox_title2">';
		if($title2){
			$output .= '<h2>'.$title2.'</h2>'; 
		}
		$output .= $icon .do_shortcode($content);
		$output .= '</div><div class="clear"></div></div></div>';  
	return $output;	
}

//////////////////////////////////////////////////////////////////
// Highlight shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('highlight', 'shortcode_highlight');
	function shortcode_highlight($atts, $content = null) {
		if($atts['style']){
			$style = $atts['style'];
		}
		else{
			$style='default';
		}
		return '<span class="high_'.$style.'">' .do_shortcode($content). '</span>';				
	}
	
//////////////////////////////////////////////////////////////////
// Check list shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('checklist', 'shortcode_checklist');
	function shortcode_checklist( $atts, $content = null ) {
	
	$content = str_replace('<ul>', '<ul class="cool_list">', do_shortcode($content));
	$content = str_replace('<li>', '<li class="'.$atts['style'].'_style">', do_shortcode($content));
	
	return $content;
	
}

//////////////////////////////////////////////////////////////////
// Tabs shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('tabs', 'shortcode_tabs');
	function shortcode_tabs( $atts, $content = null ) {
		extract(shortcode_atts(array(
		), $atts));
	
			$out .= '<div class="tab-holder shortcode-tabs">';		
			$out .= '<div class="tab-hold tabs-wrapper">';
			$out .= '<ul id="tabs" class="tabs">';
			$color = $atts['color'];
			if( !$color || ($color != 'green' && $color != 'yellow' && $color != 'blue' && $color != 'red' && $color != 'purple' && $color != 'grey' && $color != 'black')){ 
				$button = 'default'; 
				$border='border_default'; 
			}
			else{
				$button = 'button_'.$color;
				switch ($color){
					case 'yellow':
						$border = 'border_yellow';
					break;
					case 'blue':
						$border = 'border_blue';
					break;
					case 'red':
						$border = 'border_red';
					break;
					case 'purple':
						$border = 'border_purple';
					break;
					case 'green':
						$border = 'border_green';
					break;
					case 'black':
						$border = 'border_black';
					break;
					default:
						$border = 'border_grey';					
				}
			}
			foreach ($atts as $key => $tab) {
				if($key != 'color' && $key != 'hint'){
					$out .= '<li class="'.$border.'"><a href="#' . $key . '" class="'.$button.'">' . $tab . '</a></li>';		
				}
			}
	$out .= '</ul>';	
	$out .= '<div class="tab-containe '.$border.'">';
	$out .= do_shortcode($content) .'</div></div></div>';	
	return $out;
}

add_shortcode('tab', 'shortcode_tab');
	function shortcode_tab( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
	
	$out .= '<div id="tab' . $atts['id'] . '" class="tab tab_content">' . do_shortcode($content) .'</div>';
	
	return $out;
}
	
//////////////////////////////////////////////////////////////////
// Toggle shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('toggle', 'shortcode_toggle');
	function shortcode_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'title' => '',
        'open' => 'no'
    ), $atts));
	
	$style = $atts['style'];
	if(!$style){ $style = 'default'; }

	if($open == 'yes'){
		$toggleclass = "active";
		$toggleclass2 = "default-open";
		$togglestyle = "display: block;";
	}

	$out .= '<div class="outer_toggle"><h5 class="toggle '.$toggleclass.'"><a href="#" class="'.$style.'_color"><span class="'.$style.'_style"></span>' .$title. '</a></h5>';
	$out .= '<div class="toggle-content '.$toggleclass2.'" style="'.$togglestyle.'">';
	$out .= do_shortcode($content);
	$out .= '</div></div>';
	
   return $out;
}

//////////////////////////////////////////////////////////////////
// Column wrapper shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('outter_wrapper', 'shortcode_outer_wrapper');
	function shortcode_outer_wrapper($atts, $content = null) {
		if($atts['background'] == 'white') { $class='white'; } else $class='grey';
		if($atts['title']) { $title = '<div class="content_box_title"><span class="'.$class.'">'.$atts['title'].'</span></div>'; }
		if(!$atts['title']){ $margin = 'style="margin-top:0px;"'; }
		return '<div class="outer_wrap ' . $atts['background'].'" '.$margin.'><div class="inner_wrap">'.$title .do_shortcode($content). '</div></div>';
	}	
	
//////////////////////////////////////////////////////////////////
// Column one_half shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_half', 'shortcode_one_half');
	function shortcode_one_half($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s1_2 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s1_2">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_third', 'shortcode_one_third');
	function shortcode_one_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s1_3 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s1_3">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column two_third shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('two_third', 'shortcode_two_third');
	function shortcode_two_third($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s2_3 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s2_3">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_fourth', 'shortcode_one_fourth');
	function shortcode_one_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s1_4 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s1_4">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column three_fourth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('three_fourth', 'shortcode_three_fourth');
	function shortcode_three_fourth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s3_4 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s3_4">' .do_shortcode($content). '</div>';
			}

	}
	
//////////////////////////////////////////////////////////////////
// Column one_fifth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('one_fifth', 'shortcode_one_fifth');
	function shortcode_one_fifth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s1_5 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s1_5">' .do_shortcode($content). '</div>';
			}

	}
//////////////////////////////////////////////////////////////////
// Column two_fifth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('two_fifth', 'shortcode_two_fifth');
	function shortcode_two_fifth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s2_5 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s2_5">' .do_shortcode($content). '</div>';
			}

	}
//////////////////////////////////////////////////////////////////
// Column three_fifth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('three_fifth', 'shortcode_three_fifth');
	function shortcode_three_fifth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s3_5 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s3_5">' .do_shortcode($content). '</div>';
			}

	}

//////////////////////////////////////////////////////////////////
// Column four_fifth shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('four_fifth', 'shortcode_four_fifth');
	function shortcode_four_fifth($atts, $content = null) {
		$atts = shortcode_atts(
			array(
				'last' => 'no',
			), $atts);
			
			if($atts['last'] == 'yes') {
				return '<div class="s4_5 final">' .do_shortcode($content). '</div><div class="clearall"></div>';
			} else {
				return '<div class="s4_5">' .do_shortcode($content). '</div>';
			}

	}


//////////////////////////////////////////////////////////////////
// Tagline box shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('tagline_box', 'shortcode_tagline_box');
	function shortcode_tagline_box($atts, $content = null) {
		extract(shortcode_atts(array(
		'color' => 'green',
		'size' => '',
		'target' => '',
		'href' => '',
		'title' => '',
		'call_text' => __('Big text here', "js_composer"),
		'call_text_small' => __('Small text here', "js_composer"),
		'action_box_style' => 'style1',
		'margin' => '0',
		'el_class' => ''
	), $atts));
		
		//$style = $atts['style'];
		//if( $atts['style']){ $style='button_'. $atts['style']; } else{ $style='default'; }
		$str = '';		
		if($margin != '0'): $margin = 'style="margin-bottom:'.$margin.'px";';
		else : $margin='';
		endif;
		if($action_box_style == 'style1') {
			$str .= '<section class="reading-box '.$color.'_border" '.$margin.'>';
			
				if($href):
				$str .= '<a href="'.$href.'" class="continue button button_'.$color.' ' . $size . '" target="'.$target.'">'.$title.'</a>';
				endif;
				
				if($atts['call_text']):
				$str .= '<h2>'.$call_text.'</h2>';
				endif;
				
				if($atts['call_text_small']):
				$str.= '<p>'.$call_text_small.'</p>';
				endif;	
				
			$str .= '</section>';
		}
		else{
			$str .= '<section class="reading-box '.$color.'_border centered" '.$margin.'>';
				
				if($atts['call_text']):
				$str .= '<h2>'.$call_text.'</h2>';
				endif;
				
				if($atts['call_text_small']):
				$str.= '<p>'.$call_text_small.'</p>';
				endif;
				
				if($href):
				$str .= '<a href="'.$href.'" class="button button_'.$color.' ' . $size . '" target="'.$target.'">'.$title.'</a>';
				endif;
	
			$str .= '</section>';
		}

		return $str;
	}


//////////////////////////////////////////////////////////////////
// Content box shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('content_boxes', 'shortcode_content_boxes');
	function shortcode_content_boxes($atts, $content = null) {
		$str = '';
		//$str .= '<div class="outer_wrap"><div class="front_page_in"><div class="content_box_title"><span class="grey">WE SELL QUALITY</span></div>';
		$str .= do_shortcode($content);
		$str .= '<div class="clr"></div>';
		
		$i=1;

		return $str;
	}


//////////////////////////////////////////////////////////////////
// 4 Boxes as Content box shortcode 
//////////////////////////////////////////////////////////////////

add_shortcode('content_box', 'shortcode_content_box');
	function shortcode_content_box($atts, $content = null) {
		
		$str = '';
		$str .= '<div class="front_widget '.$atts['id'].'">';
		if($atts['image'] || $atts['title']):
		//$str .=	'<div style="">';
		if($atts['image']):
		$str .= $i.'<div class="shortcode_img"><img src="'.$atts['image'].'" alt=""></div>';
		endif;
		if($atts['title']):
			if($atts['link']){
				$str .= '<h3 class="widget-title"><a href="'.$atts['link'].'">'.$atts['title'].'</a></h3>';
			}
			else { $str .='<h3 class="widget-title">'.$atts['title'].'</h3>';}
		endif;
		//$str .= '</div>';
		endif;

		$str .= '<div class="content_box_text">'.do_shortcode($content).'</div>';	
		
		$str .= '</div>';
		if($atts['id'] == 'second'): $str.='<div class="div_bar"></div>';
		endif;

		return $str;
	}

//////////////////////////////////////////////////////////////////
// Service box shortcode 
//////////////////////////////////////////////////////////////////
	
add_shortcode('vc_service_box', 'shortcode_service_box');
	function shortcode_service_box($atts, $content = null) {
		extract(shortcode_atts(array(			
			'title' => '',
			'href' => '',
			'target' => '',					
			'icon' => '',			
			'el_class' => ''
		), $atts));
		
		$str = '';


		$str .= '<div class="vc_front_widget '.$el_class.'">';	
		if($icon):
			$img = wp_get_attachment_image_src($atts['icon']);
			$str .= '<div class="shortcode_img"><img src="'.$img[0].'" alt=""></div>';
		endif;
		if($title):
			if($href){
				$str .= '<h3 class="widget-title"><a href="'.$href.'" target="'.$target.'">'.$title.'</a></h3>';
			}
			else { $str .='<h3 class="widget-title">'.$title.'</h3>';}
		endif;

		$str .= '<div class="content_box_text">'.do_shortcode($content).'</div>';	
		
		$str .= '</div>';

		return $str;
	}	

//////////////////////////////////////////////////////////////////
// Slider
//////////////////////////////////////////////////////////////////
add_shortcode('slider', 'shortcode_slider');
	function shortcode_slider($atts, $content = null) {
		$str = '';
		$str .= '<div class="flexslider add_margin">';
		$str .= '<ul class="slides">';
		$str .= do_shortcode($content);
		$str .= '</ul>';
		$str .= '</div>';

		return $str;
	}

//////////////////////////////////////////////////////////////////
// Slide
//////////////////////////////////////////////////////////////////
add_shortcode('slide', 'shortcode_slide');
	function shortcode_slide($atts, $content = null) {
		$str = '';
		if($atts['type'] == 'video') {
			$str .= '<li class="video">';
		} else {
			$str .= '<li class="image">';
		}
		if($atts['link']):
		$str .= '<a href="'.$atts['link'].'">';
		endif;
		if($atts['type'] == 'video') {
			$str .= $content;
		} else {
			$str .= '<img src="'.$content.'" alt="" />';
		}
		if($atts['link']):
		$str .= '</a>';
		endif;
		$str .= '</li>';

		return $str;
	}
//////////////////////////////////////////////////////////////////
// Testimonials
//////////////////////////////////////////////////////////////////
add_shortcode('testimonials', 'shortcode_testimonials');
	function shortcode_testimonials($atts, $content = null) {
		$str = '';
		$str .= '<div class="reviews">';
		$str .= do_Shortcode($content);
		$str .= '</div>';

		return $str;
	}


//////////////////////////////////////////////////////////////////
// Testimonial
//////////////////////////////////////////////////////////////////
add_shortcode('testimonial', 'shortcode_testimonial');
	function shortcode_testimonial($atts, $content = null) {
		$style = $atts['style'];
		switch($style){
			case 'green':
				$border ='border-color:#A5CB5E;';
				$name = 'color:#58A623;';
			break;
			case 'yellow':
				$border ='border-color:#FEBF4D;';
				$name = 'color:#FEAD4D;';
			break;
			case 'blue':
				$border ='border-color:#51C4ED;';
				$name = 'color:#51C4ED;';
			break;
			case 'red':
				$border ='border-color:#E4436C;';
				$name = 'color:#E4436C;';
			break;
			case 'purple':
				$border ='border-color:#D798D1;';
				$name = 'color:#D798D1;';
			break;
			case 'black':
				$border ='border-color:#444;';
				$name = 'color:#444;';
			break;
			case 'grey':
				$border ='border-color: #ccc;';
				$name = 'color:#666;';
			break;	
		}
		$str = '';
		$str .= '<div class="review">';
		$str .= '<blockquote>';
		$str .= '<q style="'.$border.'">';
		$str .= do_Shortcode($content);
		$str .= '</q>';
		if($atts['name']):
			$str .= '<div>';
			$str .= '<strong style="'.$name.'">'.$atts['name'].'</strong>';
			if($atts['company']):
				$str .= '<span> - '.$atts['company'].'</span>';
			endif;
			$str .= '</div>';
		endif;
		$str .= '</blockquote>';
		$str .= '</div>';

		return $str;
	}

//////////////////////////////////////////////////////////////////
// Custom Custom BlockQuote
//////////////////////////////////////////////////////////////////
add_shortcode('custom_blockquote', 'shortcode_custom_blockquote');
	function shortcode_custom_blockquote($atts, $content = null) {
		$style = $atts['style'];
		switch($style){
			case 'green':
				$border ='border-color:#A5CB5E;';
			break;
			case 'yellow':
				$border ='border-color:#FEBF4D;';
			break;
			case 'blue':
				$border ='border-color:#51C4ED;';
			break;
			case 'red':
				$border ='border-color:#E4436C;';
			break;
			case 'purple':
				$border ='border-color:#D798D1;';
			break;
			case 'black':
				$border ='border-color:#444;';
			break;
			case 'grey':
				$border ='border-color: #ccc;';				
			break;	
		}
		$str = '';
		$str .= '<blockquote style="'.$border.'">';		
		$str .= do_Shortcode($content);		
		$str .= '</blockquote>';
		return $str;
	}

	
//////////////////////////////////////////////////////////////////
// Progess Bar
//////////////////////////////////////////////////////////////////
add_shortcode('bar', 'shortcode_progress');
function shortcode_progress($atts, $content = null) {
	$style = $atts['style'];
		switch($style){
			case 'green':
				$bg ='background-color:#A5CB5E;';
			break;
			case 'yellow':
				$bg ='background-color:#FEBF4D;';
			break;
			case 'blue':
				$bg ='background-color:#51C4ED;';
			break;
			case 'red':
				$bg ='background-color:#E4436C;';
			break;
			case 'purple':
				$bg ='background-color:#D798D1;';
			break;
			case 'black':
				$bg ='background-color:#444;';
			break;
			case 'grey':
				$bg ='background-color: #ccc;';				
			break;	
		}
		$width=$atts['percentage']-7;
	$html = '';
	$html = '<div class="progress-title">' . $content . ': <strong>' . $atts['percentage'] . '%</strong></div>';
	$html .= '<div class="progress-bar">';
	$html .= '<div class="progress-bar-content" data-percentage="'.$atts['percentage'].'" style="width: ' . $width . '%;'.$bg.'">';
	$html .= '</div>';
//	$html .= '<span class="progress-title">' . $content . ' ' . $atts['percentage'] . '%</span>';
	$html .= '</div>';

	return $html;
}

//////////////////////////////////////////////////////////////////
// Gallery Shortcode
//////////////////////////////////////////////////////////////////
add_shortcode('postgallery', 'shortcode_postgallery');
function shortcode_postgallery($atts, $content = null) {
	$html = '<div class="post-gallery">';	
		$args = array(
			'post_type' => 'attachment',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => get_the_ID(),
			'orderby' => 'menu_order',
			'order' => 'ASC'
		);	
		$attachments = get_posts($args);
		$items = count($attachments);
		if($attachments || has_post_thumbnail()):
			$i=1;				
			foreach($attachments as $attachment):
				$image = wp_get_attachment_image_src($attachment->ID, 'related-img');				
				$full_image = wp_get_attachment_image_src($attachment->ID, 'full');
				$width = 90/$items;     
				if($i == $items){ $last='last'; }                                        
				$html .='<div class="post-gallery-item '.$last.'" style="width:'.$width.'%"><a href="'.$full_image[0].'" rel="prettyPhoto[\'gallery_easy\']"><img src="'.$image[0].'" alt="'. $attachment->post_title .'" /></a></div>';
				$i++;				
			endforeach;
		endif;	
	$html .= '<div class="clear"></div></div>';
	return $html;
}

//////////////////////////////////////////////////////////////////
// Person
//////////////////////////////////////////////////////////////////
add_shortcode('person', 'shortcode_person');
function shortcode_person($atts, $content = null) {
	$html = '';
	$html .= '<div class="person">';
	$html .= '<img class="person-img" src="' . $atts['picture'] . '" alt="' . $atts['name'] . '" />';
	if($atts['name'] || $atts['title'] || $atts['facebooklink'] || $atts['twitterlink'] || $atts['linkedinlink'] || $content) {
		$html .= '<div class="person-desc">';
			$html .= '<div class="person-author clearfix">';
				$html .= '<div class="person-author-wrapper"><span class="person-name">' . $atts['name'] . '</span>';
				$html .= '<span class="person-title">' . $atts['title'] . '</span></div>';
				if($atts['facebook']) {
					$html .= '<span class="social-icon"><a href="' . $atts['facebook'] . '" class="facebook">Facebook</a><div class="popup">
						<div class="holder">
							<p>Facebook</p>
						</div>
					</div></span>';
				}
				if($atts['twitter']) {
					$html .= '<span class="social-icon"><a href="' . $atts['twitter'] . '" class="twitter">Twitter</a><div class="popup">
						<div class="holder">
							<p>Twitter</p>
						</div>
					</div></span>';
				}
				if($atts['linkedin']) {
					$html .= '<span class="social-icon"><a href="' . $atts['linkedin'] . '" class="linkedin">LinkedIn</a><div class="popup">
						<div class="holder">
							<p>LinkedIn</p>
						</div>
					</div></span>';
				}
				if($atts['dribbble']) {
					$html .= '<span class="social-icon"><a href="' . $atts['dribbble'] . '" class="dribbble">Dribbble</a><div class="popup">
						<div class="holder">
							<p>Dribbble</p>
						</div>
					</div></span>';
				}
			$html .= '<div class="clear"></div></div>';
			$html .= '<div class="person-content">' . $content . '</div>';
		$html .= '</div>';
	}
	$html .= '</div>';

	return $html;
}

//////////////////////////////////////////////////////////////////
// Recent Posts
//////////////////////////////////////////////////////////////////
add_shortcode('recent_posts', 'shortcode_recent_posts');
function shortcode_recent_posts($atts, $content = null) {
	extract(shortcode_atts(array(
		'posts' => '4',
		'thumbnail' => 'yes',
		'show_title' => 'yes',
		'show_date' => 'yes',
		'show_excerpt' => 'yes',
		'category' => '',
		'el_class' => ''
	), $atts));
	
	global $data;
	
	$attachment = '';
	$html = '';
	if(($show_excerpt != "yes") || ($thumbnail != "yes")){
		$height = 'style="height:auto"';
	}

	$html .= '<div class="recent_posts_container">';
	
	$query = array(
		'showposts' => (int)$posts,
		'post_type'=>'post',
	);	
	
	if ( $category ) {
		$query['cat'] = $category;
	}
	
	if($category){
		$recent_posts = new WP_Query($query);		
	}
	else{
		$recent_posts = new WP_Query('showposts='.$posts);
	}
	$count = 1;
	$i = 3;
	
	while($recent_posts->have_posts()): $recent_posts->the_post();
		
		if($count == $i) {
			$html .= '<div class="clear-responsive"></div><article class="col">';
		}
		elseif($count == 4){
			$html .= '<article class="col last">';
			
		}
		elseif($count == 5) {
			$html .= '<div class="clear" style="height:30px;"></div>';
			$html .= '<article class="col">';
			$count = 1;			
		}
		else{
			$html .= '<article class="col">';
		}
		
		
		if($thumbnail == "yes"):
			$post = new StdClass();
			$post->ID = get_the_ID();
			
			if( has_post_thumbnail() || get_post_meta($post->ID, 'pyre_youtube', true) || get_post_meta($post->ID, 'pyre_vimeo', true)):
			$html .= '<div class="flexslider mini">';
				$html .= '<ul class="slides">';
					
						if(get_post_meta($post->ID, 'pyre_youtube', true)):
							$html .= '<li>';
								$html .= '<div class="video-container" style="height:12px;"><iframe title="YouTube video player" width="218px" height="134px" src="http://www.youtube.com/embed/' . get_post_meta($post->ID, 'pyre_youtube', true) . '" frameborder="0" allowfullscreen></iframe></div>';
							$html .= '</li>';
						endif;
						if(get_post_meta($post->ID, 'pyre_vimeo', true)):
							$html .= '<li>';
								$html .= '<div class="video-container" style="height:12px;"><iframe src="http://player.vimeo.com/video/' . get_post_meta($post->ID, 'pyre_vimeo', true) . '" width="220px" height="161px" frameborder="0"></iframe></div>';
							$html .= '</li>';
						endif;
						
						$extra ='';									
						$fi = 2;
						
                        while($fi <= $data['featured_images_count']):
							$attachment = new StdClass();
							$attachment->ID = kd_mfi_get_featured_image_id('featured-image-'.$fi, 'post');						
							
							if($attachment->ID):													
								$attachment_image = wp_get_attachment_image_src($attachment->ID, 'recent-posts'); 
								$full_image = wp_get_attachment_image_src($attachment->ID, 'full'); 
								$attachment_data = wp_get_attachment_metadata($attachment->ID); 										
								$extra .= '<li><a href="'.get_permalink().'"><img src="'.$attachment_image[0].'" alt="'.$attachment_data['image_meta']['title'].'" ></a></li>';                
							endif; 
							
							$fi++; 
						endwhile; 
						
						if($extra ==''){ $hover = '<span class="gallery_zoom"><img src="'.get_bloginfo('template_directory').'/images/img-ovr-recent.png" /></span>';} else $hover =''; 

						if(has_post_thumbnail()){	
								   
							$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
							$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());
							$html.='<li><div class="one-fourth-recent"><a href="'. get_permalink() .'">'.get_the_post_thumbnail($post->ID,'recent-posts').$hover.'</a></div></li>';
									
						}
						$html .= $extra;
					
				$html .= '</ul></div>';
			endif;
		endif;
		$html .= '<div class="description">';
			if($show_title == "yes"):	
				$html .= '<h3><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h3>';	
			endif;		
			if($show_date == "yes"):		
				$html .= '<div class="date">'.get_the_time('F j, Y', $post->ID).'</div>';				
			endif;
			if($show_excerpt == "yes"):
				$html .= ''.string_limit_words(get_the_excerpt(), 15).'...';
			endif;
		$html .= '</div>';
		$html .= '<div class="bottom"></div>';
		$html .= '</article>';
		$count++;
	endwhile;

	$html .= '<div class="clear"></div></div>';

	return $html;
}
//////////////////////////////////////////////////////////////////
// Recent Works
//////////////////////////////////////////////////////////////////

add_shortcode('recent_works', 'shortcode_recent_works');
function shortcode_recent_works($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'items' => '8',
		'columns' => '4',
		'show_filters' => 'yes',
		'category_id' => '',
		'el_class' => ''
	), $atts));
	
	
	//selecting the css according to the number of columns
	switch ($columns){
		case 1:
			$css_out = 'portfolio-one';
			$nr = 1;
		break;
		case 2:
			$css_out = 'portfolio-two';
			$nr = 2;
		break;
		case 3:
			$css_out = 'portfolio-three';
			$nr = 3;
		break;
		default:
			$css_out = 'portfolio-four';
			$nr = 4;
		break;
	}

	$html .= '<div id="content" class="'.$css_out.'">';
		if($show_filters == 'yes'):
			if(!get_post_meta(get_the_ID(), 'pyre_portfolio_category', true)):
                $portfolio_category = get_terms('portfolio_category');
				if($portfolio_category):
					$html.='<ul class="portfolio-tabs clearfix">';
						$html .= '<li class="active"><a data-filter="*" href="#">All</a></li>';
						foreach($portfolio_category as $portfolio_cat):
							$html .= '<li><span>/</span><a data-filter=".'. $portfolio_cat->slug.'" href="#">'.$portfolio_cat->name.'</a></li>';
						endforeach; 
					$html.='</ul>';
				endif;
			endif;
		endif;	
		$html .= '<div class="portfolio-wrapper">';	
						 	
						$args = array(
                            'post_type' => 'creativo_portfolio',
                            'paged' => 1,
                            'posts_per_page' => $items,
                        );						
                        if($category_id){
                            $args['tax_query'][] = array(
                                'taxonomy' => 'portfolio_category',
                                'field' => 'ID',
                                'terms' => $category_id
                            );
                        }
						$works = new WP_Query($args);
						while($works->have_posts()): $works->the_post();
							$post = new StdClass();
							$post->ID = get_the_ID();
							if(has_post_thumbnail() || get_post_meta($post->ID, 'pyre_youtube', true) || get_post_meta($post->ID, 'pyre_vimeo', true)):
							
								$item_classes = '';
								$item_cats = get_the_terms($post->ID, 'portfolio_category');
								$portf_cat = wp_get_object_terms($post->ID, 'portfolio_category');
								if($item_cats):
								foreach($item_cats as $item_cat) {
									$item_classes .= $item_cat->slug . ' ';
								}
								endif;
								
								$args_item = array(
										'post_type' => 'attachment',
										'numberposts' => '4',
										'post_status' => null,
										'post_parent' => $post->ID,
										'orderby' => 'menu_order',
										'order' => 'ASC',
										'exclude' => get_post_thumbnail_id()
									);
								$attachments_item = get_posts($args_item);
								
								$html .='<div class="portfolio-item '.$item_classes.'">';
									if($nr == 1){
										$html .='<div class="project-feed clearfix">';
											$html .= '<div class="full">';
												$html .='<div class="image_show">';
													$html .='<div class="project-feed clearfix">';											
														$html .= '<div class="ch-item portfolio-1">';			
															$html .= '<div class="ch-info portfolio-1">';
																$html .= '<div class="ch-info-front1 ">'.get_the_post_thumbnail($post->ID, 'portfolio-one').'</div>';
																$html .= '<div class="ch-info-back1  portfolio-1">';
																if (get_post_meta($post->ID, 'pyre_custom_link', true) != '') {
																	$html .='<h3><a href="'.get_post_meta($post->ID, 'pyre_custom_link', true).'" target="'. get_post_meta($post->ID, 'pyre_custom_link_target', true).'">'.get_the_title().'</a></h3>';
																}
																else{
																	$html .='<h3><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h3>';
																}
																		$html .= '<div class="portfolio_tags">'.get_the_term_list($post->ID, 'portfolio_category', '', ', ', '').'</div>';
																$html .= '</div>';
															$html .= '</div>';
														$html .= '</div>';
													$html .='</div>';
												$html .='</div>';
												if (get_post_meta($post->ID, 'pyre_custom_link', true) != '') {
													$html .='<span class="title"><a href="'.get_post_meta($post->ID, 'pyre_custom_link', true).'" target="'. get_post_meta($post->ID, 'pyre_custom_link_target', true).'">'.get_the_title().'</a></span>';
												}
												else{
													$html .='<span class="title"><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></span>';
												}												
																							
															$html .='<p><span class="args">'.get_the_term_list($post->ID, 'portfolio_category', '', ', ', '').'</span></P>';                                    											
															$html .='<p>'.get_the_excerpt().'</p>';
															if (get_post_meta($post->ID, 'pyre_custom_link', true) != '') {
																$html .='<a href="'.get_post_meta($post->ID, 'pyre_custom_link', true).'" target="'. get_post_meta($post->ID, 'pyre_custom_link_target', true).'" class="button button_default small">View More</a>';
															}
															else{
																$html .='<a href="'.get_permalink($post->ID).'" class="button button_default small">View More</a><div class="clear"></div>';
															}															
											$html .= '</div>';	
										$html .= '</div>';

									}
									else{
											$html .='<div class="project-feed clearfix">';											
												$html .= '<div class="ch-item portfolio-'.$nr.'">';			
													$html .= '<div class="ch-info portfolio-'.$nr.'">';
														$html .= '<div class="ch-info-front'.$nr.' ">'.get_the_post_thumbnail($post->ID, $css_out).'</div>';
														$html .= '<div class="ch-info-back'.$nr.'  portfolio-'.$nr.'">';
															if (get_post_meta($post->ID, 'pyre_custom_link', true) != '') {
																$html .='<h3><a href="'.get_post_meta($post->ID, 'pyre_custom_link', true).'" target="'. get_post_meta($post->ID, 'pyre_custom_link_target', true).'">'.get_the_title().'</a></h3>';
															}
															else{
																$html .='<h3><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h3>';																
															}
															
																$html .= '<div class="portfolio_tags">'.get_the_term_list($post->ID, 'portfolio_category', '', ', ', '').'</div>';
														$html .= '</div>';
													$html .= '</div>';
												$html .= '</div>';
											$html .='</div>';									
									}
								$html .='</div>';
							endif;							
						endwhile;
		$html .= '</div>';
	$html .= '</div>';

	return $html;
}


//////////////////////////////////////////////////////////////////
// Alert Message
//////////////////////////////////////////////////////////////////
add_shortcode('alert', 'shortcode_alert');
function shortcode_alert($atts, $content = null) {
	$html = '';
	$html .= '<div class="alert '.$atts['type'].'">';
		$html .= '<div class="msg">'.do_shortcode($content).'</div>';
		$html .= '<a href="#" class="toggle-alert">Toggle</a>';
	$html .= '</div>';

	return $html;
}

// Cool Title
//////////////////////////////////////////////////////////////////

add_shortcode( 'ctitle', 'ctitle_func' );
function ctitle_func( $atts, $content = null ) {
  
  extract( shortcode_atts( array(
		'title' => 'We Sell Quality',
		'color' => '#666',
		'background' => '#fff',
		'font_size' => '30 - Default',
		'position' => 'center'
	  ), $atts ) );
	  
	  $font_size = ($font_size != '30 - Default') ? 'font-size: '. $font_size .'px;' : '';
	  
	  $margin = '';
	  
	  if ($position =='left') { $margin = 'padding-left:0;'; }
	  if ($position =='right') { $margin = 'padding-right:0;'; }
	  
	  $position = ($position != 'center') ? 'text-align:'.$position.';' : '';   	   
	  
	  $style = 'style="'. $font_size . $position . '"';  
  
  return '<div class="content_box_title" '.$style.'><span class="white" style="background-color: '.$background.'; color:'.$color.'; '.$margin.'">'.$title.'</span></div>';
}
/*
// Custom Flikr Widget vc_wp_custom_posts
//////////////////////////////////////////////////////////////////
add_shortcode('vc_wp_flickr_widget', 'shortcode_vc_wp_flickr_widget');
function shortcode_vc_wp_flickr_widget($atts) {

	extract( shortcode_atts( array(
		'title' => '',
		'screen_name' => 'eyetwist',
		'number' => '3',
		'el_class' => ''
	), $atts ) );
	
	$output = '<div class="sidebar-widget vc_wp_flickr_widget '.$el_class.'">';
	$type = 'Flickr_Widget';
	$args = array( 'before_title'=>'<h3 class="sidebar-title">', 'after_title'=>'</h3><div class="split-line"></div><div class="clr"></div>');
	
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();
	
	$output .= '</div>';
	
	echo $output;
}

// Custom Recent Post Widget vc_wp_custom_posts
//////////////////////////////////////////////////////////////////
add_shortcode('vc_wp_custom_posts', 'shortcode_vc_wp_custom_posts');
function shortcode_vc_wp_custom_posts($atts) {

	extract( shortcode_atts( array(
		'title' => '',
		'number' => '3',
		'el_class' => ''
	), $atts ) );
	
	
	$output = '<div class="sidebar-widget vc_wp_flickr_widget '.$el_class.'">';
	$type = 'TZ_Blog_Widget';
	$args = array( 'before_title'=>'<h3 class="sidebar-title">', 'after_title'=>'</h3><div class="split-line"></div><div class="clr"></div>');
	
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();
	
	$output .= '</div>';
	
	echo $output;
}
*/
//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
//////////////////////////////////////////////////////////////////
/*
add_action('init', 'add_button');
add_action('init', 'add_button_2');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons_3', 'register_button');  
   }  
}  

function add_button_2() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin_2');  
     add_filter('mce_buttons_4', 'register_button_2');  
   }  
}
/*
function register_button($buttons) {
   array_push($buttons, "youtube", "vimeo", "soundcloud", "qbox", "button", "divider", "dropcap", "outter_wrapper" ,"one_half", "one_third", "two_third", "one_fourth", "three_fourth", "one_fifth", "two_fifth", "three_fifth", "four_fifth");  
   return $buttons;
}  

function register_button_2($buttons) {
   array_push($buttons, "highlight", "checklist", "tabs", "toggle", "slider", "testimonial", "custom_blockquote", "progress", "alert", "recent_works", "tagline_box", "content_boxes", "recent_posts", "postgallery");
   return $buttons;
} 
*/
//////////////////////////////////////////////////////////////////
// Add buttons to tinyMCE
////////////////////////////////////////////////////////////////// 

add_action('init', 'add_button');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons_3', 'register_button');  
   }  
}  

function register_button($buttons) {  
   array_push($buttons, "button", "divider", "dropcap", "highlight", "checklist", "testimonial", "custom_blockquote");  
   return $buttons;  
} 

function add_plugin($plugin_array) {  

   
   $plugin_array['button'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['dropcap'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['divider'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['highlight'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['checklist'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['testimonial'] = get_template_directory_uri().'/tinymce/customcodes.js';
   $plugin_array['custom_blockquote'] = get_template_directory_uri().'/tinymce/customcodes.js';

   return $plugin_array;  
}  
