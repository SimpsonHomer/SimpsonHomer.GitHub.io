jQuery(document).ready(function($) {

    // Color Scheme Options - These array names should match
    // the values in color_scheme of options.php
    
    var green = new Array();
    green['primary_color']='#58A623';
    green['action_border']='#d2e5ae';
	green['action_border_hover']='#A5CB5E';
    green['shortcode_color']='#a0ce4e';
    green['button_border_color']='#95b959';
    green['button_gradient_top_color']='#cae387';
    green['button_gradient_bottom_color']='#a5cb5e';
	green['button_text_color']='#5A742D';
    green['button_text_shadow_color']='#DFF4BC';
	green['pb_hover_color']='#b4e56b';
	green['footer_link_color']='#77b31d';

    var yellow = new Array();
    yellow['primary_color']='#e9a825';
    yellow['action_border']='#fedfa6';
	yellow['action_border_hover']='#febf4d';
    yellow['shortcode_color']='#FEBF4D';
    yellow['button_border_color']='#e6b650';
    yellow['button_gradient_top_color']='#ffd974';
    yellow['button_gradient_bottom_color']='#febf4d';
	yellow['button_text_color']='#986A39';	
    yellow['button_text_shadow_color']='#FBE5AC';
	yellow['pb_hover_color']='#ffde46';
	yellow['footer_link_color']='#db9615';

    var purple = new Array();
    purple['primary_color']='#e67fb9';
    purple['action_border']='#ebcbe8';
	purple['action_border_hover']='#D798D1';
    purple['shortcode_color']='#D798D1';
    purple['button_border_color']='#CD93C6';
    purple['button_gradient_top_color']='#E9C4E3';
    purple['button_gradient_bottom_color']='#D798D1';
	purple['button_text_color']='#7E5D7C';		
    purple['button_text_shadow_color']='#F1CEEF';
	purple['pb_hover_color']='#e76ae8';
	purple['footer_link_color']='#bf5bb5';	

    var grey = new Array();
    grey['primary_color']='#9e9e9e';
    grey['action_border']='#f0f0f0';
	grey['action_border_hover']='#E1E1E1';
    grey['shortcode_color']='#cccccc';
    grey['button_border_color']='#D0D0D0';
    grey['button_gradient_top_color']='#EDEDED';
    grey['button_gradient_bottom_color']='#E1E1E1';
	grey['button_text_color']='#444444';
    grey['button_text_shadow_color']='#ffffff';
	grey['pb_hover_color']='#c2c2c2';	
	grey['footer_link_color']='#9e9e9e';	

    var red = new Array();
    red['primary_color']='#fa5a5a';
    red['action_border']='#fab3bd';
	red['action_border_hover']='#F6677B';
    red['shortcode_color']='#E4436C';
    red['button_border_color']='#D96D7C';
    red['button_gradient_top_color']='#F997B0';
    red['button_gradient_bottom_color']='#F6677B';
	red['button_text_color']='#923C47';	
    red['button_text_shadow_color']='#FDBCC7';
	red['pb_hover_color']='#ff4747';
	red['footer_link_color']='#c94949';
		

    var blue = new Array();
    blue['primary_color']='#2799d6';
    blue['action_border']='#b9e7f8';
	blue['action_border_hover']='#73D0F1';
    blue['shortcode_color']='#51C4ED';
    blue['button_border_color']='#6FB1C7';
    blue['button_gradient_top_color']='#AAE5F7';			
    blue['button_gradient_bottom_color']='#73D0F1';
	blue['button_text_color']='#41788C';
    blue['button_text_shadow_color']='#BFEAFB';
	blue['pb_hover_color']='#3cbafd';	
	blue['footer_link_color']='#2190b8';	
	
	var black = new Array();
    black['primary_color']='#303030';
    black['action_border']='#a2a2a2';
	black['action_border_hover']='#454545';
    black['shortcode_color']='#444444';
    black['button_border_color']='#4D4D4D';
    black['button_gradient_top_color']='#656565';
    black['button_gradient_bottom_color']='#454545';
	black['button_text_color']='#ffffff';
    black['button_text_shadow_color']='#6D6D6D';
	black['pb_hover_color']='#585858';	
	black['footer_link_color']='#999999';	

    // When the select box #base_color_scheme changes
    // of_update_color updates each of the color pickers
    $('#color_scheme').change(function() {
        colorscheme = $(this).val();
        if (colorscheme == 'green') { colorscheme = green; }
        if (colorscheme == 'yellow') { colorscheme = yellow; }
        if (colorscheme == 'purple') { colorscheme = purple; }
        if (colorscheme == 'grey') { colorscheme = grey; }
        if (colorscheme == 'red') { colorscheme = red; }
        if (colorscheme == 'blue') { colorscheme = blue; }
		if (colorscheme == 'black') { colorscheme = black; }

        for (id in colorscheme) {
            of_update_color(id,colorscheme[id]);
        }
    });
    
    // This does the heavy lifting of updating all the colorpickers and text
    function of_update_color(id,hex) {
        $('#section-' + id + ' .of-color').css({backgroundColor:hex});
        $('#section-' + id + ' .colorSelector').ColorPickerSetColor(hex);
        $('#section-' + id + ' .colorSelector').children('div').css('backgroundColor', hex);
        $('#section-' + id + ' .of-color').val(hex);
        $('#section-' + id + ' .of-color').animate({backgroundColor:'#ffffff'}, 600);
    }
});
