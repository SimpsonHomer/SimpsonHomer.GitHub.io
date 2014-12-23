<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $data; ?>
<?php
if($data['favicon']){
?>
    <link rel="shortcut icon" href="<?php echo $data['favicon']; ?>" type="image/x-icon" />
<?php
}
?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/3d.css" type="text/css">
<?php if ($data['responsiveness']) { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/responsive.css" type="text/css">
<?php } 
else {
	?>
    <link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/fixed.css" type="text/css">
    <?php
}
?>
<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/flexislider/flexslider.css" type="text/css">

<link rel="stylesheet" href="<?php bloginfo( 'template_url' ); ?>/css/prettyPhoto.css" type="text/css">

<?php if($data['body_font'] && $data['body_font'] != 'Select Font'): ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode($data['body_font']); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

<?php if($data['heading_font'] && $data['heading_font'] != 'Select Font'): ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode($data['heading_font']); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

<?php if($data['menu_font_family'] && $data['menu_font_family'] != 'Select Font'): ?>
	<link href='http://fonts.googleapis.com/css?family=<?php echo urlencode($data['menu_font_family']); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
<?php endif; ?>

 <?php wp_head(); ?> 
<style>
		body,#nav ul li ul li a,
		.more,
		.meta .date,
		.review blockquote q,
		.review blockquote div strong,
		.footer-area  h3,
		.image .image-extras .image-extras-content h4,
		.project-content .project-info h4,
		.post-content blockquote,
		.button.large,
		.button.small{
			font-family:'<?php echo $data['body_font']; ?>', Arial, Helvetica, sans-serif;
			font-size:<?php echo $data['font_size']; ?>px;
		}
		
		body {
			color: <?php echo $data['font_color']; ?>;
			background-color: <?php echo $data['body_bg_color'] ?>
		}
		
		h1, h2, h3, h4, h5, h6,  h3.sidebar-title, .content_box_title span.grey, .bellow_header_title,.qbox_title1,.content_box_title span.white,.full .title,.tab-holder .tabs li{
			font-family: '<?php echo $data['heading_font']; ?>', Arial, Helvetica, sans-serif !important;
		}
		.woocommerce h1,.woocommerce h2,.woocommerce h3,.woocommerce h4,.woocommerce h5 {
			font-family: '<?php echo $data['body_font']; ?>', Arial, Helvetica, sans-serif !important;
		}
		.main-navigation {
			font-family: '<?php echo $data['menu_font_family']; ?>', Arial, Helvetica, sans-serif !important;
		}
		.tp-bannertimer {
			background-image:none !important;			
			height:7px;
		}
		.latest-posts h2, .page-title, .action_bar_inner h2{
			font-family:'<?php echo $data['body_font']; ?>', Arial, Helvetica, sans-serif !important;
		}
		.container {
			background-color: <?php echo $data['body_bg_color_inside']; ?>;
		}
		
	<?php

	if(!$data['use_custom']){ 
		$primary_color = $data['primary_color'];
		$second_link_color = $data['second_link_color'];
		$pb_hover_color = $data['pb_hover_color'];
		$shortcode_color = $data['shortcode_color'];
		$button_text_color = $data['button_text_color'];
		$button_text_shadow_color = $data['button_text_shadow_color'];
		$button_gradient_top_color = $data['button_gradient_top_color'];
		$button_gradient_bottom_color = $data['button_gradient_bottom_color'];
		$button_border_color = $data['button_border_color'];
		$footer_link_color = $data['footer_widget_link_color'];
	}
	else{
		$primary_color = $data['custom_primary_color'];
		$second_link_color = $data['custom_second_link_color'];
		$pb_hover_color = $data['custom_pb_hover_color'];
		$shortcode_color = $data['custom_shortcode_color'];
		$button_text_color = $data['custom_button_text_color'];
		$button_text_shadow_color = $data['custom_button_text_shadow_color'];
		$button_gradient_top_color = $data['custom_button_gradient_top_color'];
		$button_gradient_bottom_color = $data['custom_button_gradient_bottom_color'];
		$button_border_color = $data['custom_button_border_color'];
		$footer_link_color = $data['custom_footer_widget_link_color'];		
	}
	?>
		a,.front_widget a, .vc_front_widget a,.shortcode-tabs, h5.toggle a.default_color,.portfolio-navigation a:hover,h2.page404,.project-feed .title a, .col:hover .date, .col h3 a:hover,.col h4 a:hover {
			color:<?php echo $primary_color ; ?>;
		}
		.high_default, #navigation > ul > li > a:hover, #navigation > ul li:hover > a, #navigation ul li li:hover > a,.sf-sub-indicator, #navigation > ul > li.current-menu-item > a, #navigation > ul > li.current-menu-parent > a, #navigation > ul > li.current-menu-parent > ul > li.current-menu-item > a {
			 background-color:<?php echo $data['menu_bg_color'] ; ?>;
		}
		.post-gallery-item a:hover img, .recent-portfolio a:hover img, .recent-flickr a:hover img{
			border-color:<?php $primary_color ; ?>; 
		}
		.default_dc{
			color:<?php echo $primary_color ; ?>;
		}
		
		/* Call to Action styling */
		.default_border{
			border:2px solid <?php echo $data['action_border']; ?>;
		}
		.default_border:hover{
			border-color: <?php echo $data['action_border_hover']; ?>;
		}
		.reading-box {
			background-color: <?php echo $data['action_bg']; ?>;
			color: <?php echo $data['action_text_color']; ?>;
		}
		.reading-box:hover {
			background-color: <?php echo $data['action_bg_hover']; ?>;
			color: <?php echo $data['action_text_color_hover']; ?>;
		}
		
	<?php
	if($pb_hover_color): ?>
		.gallery_zoom{
			background-color: <?php echo $pb_hover_color; ?>;
		}
	<?php
	endif;
	?>
	
		.vc_front_widget {
			background-color: <?php echo $data['featured_serv_bg']; ?>;
		}
		.vc_front_widget a{
			color: <?php echo $data['featured_serv_link']; ?>;
		}
		.vc_front_widget:hover {
			background-color: <?php echo $data['featured_serv_bg_hover']; ?>;
			color:#fff;
		}
		.vc_front_widget:hover a{
			color:#fff;
		}
	
	<?php
	
	if($shortcode_color): ?>
		.progress-bar-content,.ch-info-back4,.ch-info-back3,.ch-info-back2,.ch-info-back1,.col:hover .bottom,.tp-bannertimer {
			background-color:<?php echo $shortcode_color; ?>;
		}
		.front_widget:hover, .front_widget:hover a, .portfolio-tabs a:hover, .portfolio-tabs li.active a{
			color:#fff; background-color:<?php echo $shortcode_color; ?>;
		}
		._border:hover, .review blockquote q, .pagination a.inactive{
			border-color:<?php echo $shortcode_color; ?>;
		}
		.review blockquote div {
			color:<?php echo $shortcode_color; ?>;
		}
		.pagination .current, .pagination a.inactive:hover {
			background-color:<?php echo $shortcode_color; ?>; 
			border-color:<?php echo $shortcode_color; ?>;
		}
	<?php
	endif;
	if($button_text_color): ?>
		.button_default, .button_default:hover{
			color: <?php echo $button_text_color; ?> !important;
		}
	<?php
	endif;
	if($button_text_shadow_color): ?>
		.button_default{
			text-shadow: 1px 1px 1px <?php echo $button_text_shadow_color; ?>;
		}
	
	<?php
	endif;	
	if($button_gradient_top_color && $button_gradient_bottom_color && $button_border_color): ?>
		.border_default{
			border: 1px solid <?php echo $button_border_color; ?>;
		}
		
		.button_default{					
			border-color:<?php echo $button_border_color; ?>;
			background-image: -moz-linear-gradient(<?php echo $button_gradient_top_color; ?>, <?php echo $button_gradient_bottom_color; ?>);
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $button_gradient_top_color; ?>), to(<?php echo $button_gradient_bottom_color; ?>));
			background-image: -webkit-linear-gradient(<?php echo $button_gradient_top_color; ?>, <?php echo $button_gradient_bottom_color; ?>);
			background-image: -o-linear-gradient(<?php echo $button_gradient_top_color; ?>, <?php echo $button_gradient_bottom_color; ?>);
			background-color: <?php echo $button_gradient_bottom_color; ?>;	
		}
		.button_default:hover{
			border-color:<?php echo $button_border_color; ?>;
			background-image: -moz-linear-gradient(<?php echo $button_gradient_bottom_color; ?>, <?php echo $button_gradient_top_color; ?>);
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $button_gradient_bottom_color; ?>), to(<?php echo $button_gradient_top_color; ?>));
			background-image: -webkit-linear-gradient(<?php echo $button_gradient_bottom_color; ?>, <?php echo $button_gradient_top_color; ?>);
			background-image: -o-linear-gradient(<?php echo $button_gradient_bottom_color; ?>, <?php echo $button_gradient_top_color; ?>);
			background-color: <?php echo $button_gradient_top_color; ?>;
		}
	<?php
	endif;
	
	if($footer_link_color): ?>
		.footer_widget_content a, .footer_widget_content ul.twitter li span a{
			color:<?php echo $footer_link_color; ?> ;			
		}

	<?php
	endif;
	
	if($data['site_width']=='Boxed'){
		$bg = $data['boxed_bg'];
		$boxed='true';
		?>
			body{
				background-image: url(<?php echo $data['boxed_bg'];?>);
				background-repeat: <?php echo $data['bg_repeat'];?> ;
				background-position: top center;
				background-attachment: <?php echo $data['bg_attachment'];?>;				
				
				<?php if($data['bg_fullscreen']): ?>
					-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover;
					background-size: cover;
				<?php endif; ?>
				
				<?php
				if($data['enable_pattern']){					
				?>
					background-image: url("<?php echo $data['pattern']; ?>");
					background-repeat: repeat;
					background-attachment: fixed;
				<?php
				}
					
				?>
			
			<?php 
			if(get_post_meta($post->ID, 'pyre_background', true) || get_post_meta($post->ID,'pyre_bg_color', true)): ?>
				background:url(<?php echo get_post_meta($post->ID, 'pyre_background', true); ?>);
				background-color: <?php echo get_post_meta($post->ID, 'pyre_bg_color', true); ?>;
				background-repeat: <?php echo get_post_meta($post->ID, 'pyre_bg_repeat', true); ?>;
				background-position: <?php echo get_post_meta($post->ID, 'pyre_bg_position', true); ?>;
				background-attachment: <?php echo get_post_meta($post->ID, 'pyre_bg_attach', true); ?>;				
			<?php 
			endif; 
			?>
			}
			.container{				
				max-width:980px;	
				margin:<?php echo $data['margin_all']; ?>px auto;
				padding:<?php echo $data['padding_out']; ?>px;
				border:<?php echo $data['outer_border']; ?>px <?php echo $data['outer_border_type']; ?> <?php echo $data['outer_border_color']; ?>;
				<?php
				if($data['outer_shadow']){
				?>
				box-shadow: 0 0 10px rgba(0,0,0,0.3);
				-moz-box-shadow: 0 0 10px rgba(0,0,0,0.3);
				-webkit-box-shadow: 0 0 10px rgba(0,0,0,0.3);	
				<?php
				}
				?>
			}
		<?php
			
	}
	if($data['site_width']=='Extra Wide'){		

	?>
		.inner, .row, .front_page_in,.footer_widget_inside,.footer .inner{
			max-width:1160px;
		}
		.bellow_header_title{
			max-width:1120px;
		}
		.inner_wrap,.reading-box, .qbox {
			max-width:1140px;
		}
		.qbox_title1{
			width:34%;
		}
		.portfolio-four .portfolio-item{
			margin:4px;
		}
		.col{
			width:19%;
		}
		.blogpost_small_pic{ width:39.5%}.blogpost_small_desc{width:57%;}
	<?php
	}
	?>
	.header{
		margin-bottom: <?php echo $data['header_bottom_margin']; ?>px;
		margin-top: <?php echo $data['header_top_margin']; ?>px;
		padding-bottom: <?php echo $data['header_bottom_padding']; ?>px;
		padding-top: <?php echo $data['header_top_padding']; ?>px;
		
	
		<?php
		if($data['en_header_pattern']){
			$head_pattern = $data['header_patterns'];
		?>		
			background-image:url("<?php echo $head_pattern; ?>");		
		<?php
		}
		else{
		?>		
			background-color:<?php echo  $data['header_bg_color']; ?>;	
		<?php
		}
		if($data['header_bg_image']){			
		?>		
			background:url("<?php echo $data['header_bg_image']; ?>") <?php echo $data['header_bg_repeat']; ?>;		
		<?php
		}
		?>
	}

	<?php
	if($data['sidebar_pos'] == 'left') { ?>
			.post_container{
				float:right;
			}
			.sidebar{
				float:left;
			}
	<?php 
	}	
	
	//if($data['menu_float']!="left") { 
	?>
		.main-navigation {
			float:right;
		}
	<?php
	//}
	?>
	#navigation ul li {
		font-size: <?php echo $data['menu_font_size']; ?>px;
	}
	
	<?php
	if(!$data['submenu_indicator']) {
	?>
		.sf-sub-indicator {
			display: none;
		}
	<?php
	}
	
	if($data['force_uppercase']) {
	?>
		.main-navigation {
			text-transform: uppercase;
		}
	<?php
	}
	if($data['menu_color']){
	?>
		#navigation ul li a {
			color:<?php echo $data['menu_color']; ?> !important;
		}
		#navigation ul > li > ul > li > a {
			color: #777 !important;
		}
	<?php
	}
	if($data['menu_color_hover']){
	?>
		#navigation > ul > li > a:hover, #navigation > ul li:hover > a, #navigation ul li li:hover > a, .sf-sub-indicator, #navigation > ul > li.current-menu-item > a, #navigation > ul > li.current-menu-parent > a, #navigation > ul > li.current-menu-parent > ul > li.current-menu-item > a {
			color:<?php echo $data['menu_color_hover']; ?> !important;
		}
	<?php
	}

	?>
	
	#navigation ul > li > ul > li > a {
		color: <?php echo $data['submenu_color']; ?> !important;
	}
	
	#navigation ul > li > ul > li > a:hover {
		color: <?php echo $data['submenu_color_hover']; ?> !important;
	}

	#navigation ul ul, #navigation ul ul li {
		background-color:<?php echo $data['submenu_bg_color']; ?>;
	}
	
	#navigation ul ul a, #navigation ul ul ul a, #navigation ul ul a:link, #navigation ul ul ul a:link, #navigation ul ul a:visited, #navigation ul ul ul a:visited {
		border-bottom-color: <?php echo $data['submenu_separator']; ?>;
	}

	
	<?php
	if($data['header_style'] == "style2" ){
	?>
		.main-navigation {
			margin-bottom:0;
			margin-top: 5px;
		}
		.main-navigation #navigation {
			margin-top: 0;
		}
		.sf-sub-indicator {
			line-height: normal;
		}
		#navigation ul li {
			padding: 5px;
		}
		
		#navigation ul ul {
			top:44px;
		}
		.js .second_navi #navigation select {
			width:80%;
			margin: 20px 0;			
		}
		
		.second_navi {
			background-color: <?php echo $data['menu_bg_color_full']; ?>;
			border-color: <?php echo $data['menu_border_color']; ?>;
		}
	
		@media screen and (max-width: 960px) {
			#branding {
				float: none;
				margin: 10px auto;
				border: none;
				text-align: center;
				padding-bottom: 0px;
			}
		}
	<?php
	}
	?>
	
	<?php
	if($data['header_el_pos'] == "center") {
		?>
		#branding, .main-navigation, #navigation ul li  {
			float: none;
		}
		.main-navigation {
			margin-bottom: 0;
		}
		#branding, #navigation ul {
			text-align:center;
		}
		#navigation ul ul {
			text-align:left;
		}
		#navigation ul li {
			display: inline-block;
		}
		<?php
	}
	?>
	
	.footer {	
		<?php 
		if($data['en_footer_copy_pattern'] && !$data['footer_copyright_bg'] ) { ?>
			background: url("<?php echo $data['footer_copy_patterns']; ?>") repeat;
		<?php 
		} 
		if($data['footer_copyright_bg']) {
		?>
			background: url("<?php echo $data['footer_copyright_bg'] ?>") <?php echo $data['footer_copyright_bg_repeat']; ?>;	
		<?php
		}
		?>
			background-color: <?php echo $data['footer_copy_bg_color']; ?>;				
	}
	.footer_widget {
		<?php if($data['en_footer_pattern']) {  ?>
			background: url("<?php echo $data['footer_patterns'];?>") repeat;
		<?php } ?>
			background-color: <?php echo $data['footer_bg_color']; ?>;
	}
	.copyright {
		color: <?php echo $data['footer_text_color']; ?>;	
	}
	.footer .copyright a {
		color: <?php echo $data['footer_link_color']; ?>;
	}
	.footer .copyright a:hover {
		color: <?php echo $data['footer_link_color_hover']; ?>;
	}
	
	<?php
	if($data['en_footer_center']){
	?>
		.copyright, .footer_branding, .connect {
			float: none;
			text-align: center;
		}
		.connect {
			width:auto;
		}
		.connect li {
			float:none;
			display:inline-block;
		}
		.footer .top_social{
			width: 100%;
			text-align:center;
			margin-bottom:10px;
		}
		.footer .top_social a {
			float: none;
			display: inline-block;
			margin-bottom:10px;
		}
	<?php
	}
	?>
	
	<?php if($data['en_back_top']){ ?>
		#gotoTop {
			background-color: <?php echo $data['back_top_bg']; ?>;
		}
		#gotoTop:hover {
			background-color: <?php echo $data['back_top_bg_hover']; ?>;
		}
	<?php } ?>
	
	.bellow_header{
		background-color:<?php echo $data['tb_bg_color']; ?>;
	}
	.bellow_header_title, .page-title .breadcrumb, .page-title .breadcrumb a {
		color: <?php echo $data['tb_title_color']; ?>;
	}
	
	<?php
	
	if($data['logo_resize']){
		?>
		#branding img {
			max-width: 270px;; ?>
		}
		<?php
	}
	
	if(!$data['logo']) {
		?>
		#branding {
			margin-bottom:20px;
		}
		#branding h1.text a {
			color: <?php echo $data['text_logo_color']; ?>;
		}
		#branding h1.text a:hover {
			color: <?php echo $data['text_logo_color_hover']; ?>;
		}
		#branding .tagline {
			color: <?php echo $data['tagline_color']; ?>;
			font-size: <?php echo $data['tagline_font_size']; ?>px;  
		}
		<?php
	}
	
	if(!$data['white_circle']) {
		?>
		.shortcode_img {
			background-color: transparent;
			border-radius:0;
			width:100%;
			height:auto;
		}
		<?php
	}
	else{
		?>
		.shortcode_img img{
			max-width: 32px;
			height:auto;
		}
		<?php
	}
	
	if($data['en_top_bar']) {
		?>
		.top_nav_out {
			background-color: <?php echo $data['top_bar_bg']; ?>;
			border-color: <?php echo $data['top_bar_border'] ?>;
		}
		.top_social a {
			opacity: <?php echo ($data['social_icons_opacity']/100); ?>;
			filter: alpha(opacity=<?php echo ($data['social_icons_opacity']/100); ?>);			
		}
		.top_contact .contact_email span.email, .top_contact .contact_phone span.phone {
			opacity: <?php echo ($data['social_icons_opacity']/100); ?>;
			filter: alpha(opacity=<?php echo ($data['social_icons_opacity']/100); ?>);
		}
		.top_contact a{
			color:  <?php echo $data['contact_link']; ?>;
			border-color: <?php echo $data['top_bar_separator']; ?>;
		}
		.top_contact a:hover {
			color:  <?php echo $data['contact_link_hover']; ?>;
		}
		.top_contact {
			color: <?php echo $data['contact_text']; ?>;
		}
		<?php
	}
	
	if($data['en_cta']) {
	?>
		.action_bar {
			background-color: <?php echo $data['cta_bg']; ?>;
			color: <?php echo $data['cta_text']; ?>;
		}
		.action_bar:hover {
			background-color: <?php echo $data['cta_bg_hover']; ?>;
			color: <?php echo $data['cta_text_hover']; ?>;
		}	
		
		.action_bar_inner .button_default, .action_bar_inner .button_default:hover{
			color: <?php echo $data['cta_button_text_color']; ?> !important;
		}
		
		.action_bar_inner .button_default{
			text-shadow: none;
		}		
		
		.action_bar_inner .border_default{
			border: 1px solid <?php echo $data['cta_button_border_color']; ?>;
		}
			
		.action_bar_inner .button_default{					
			border-color:<?php echo $data['cta_button_border_color']; ?>;
			background-image: -moz-linear-gradient(<?php echo $data['cta_button_gradient_top_color']; ?>, <?php echo $data['cta_button_gradient_bottom_color']; ?>);
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $data['cta_button_gradient_top_color']; ?>), to(<?php echo $data['cta_button_gradient_bottom_color']; ?>));
			background-image: -webkit-linear-gradient(<?php echo $data['cta_button_gradient_top_color']; ?>, <?php echo $data['cta_button_gradient_bottom_color']; ?>);
			background-image: -o-linear-gradient(<?php echo $data['cta_button_gradient_top_color']; ?>, <?php echo $data['cta_button_gradient_bottom_color']; ?>);
			background-color: <?php echo $data['cta_button_gradient_bottom_color']; ?>;	
		}
		.action_bar_inner .button_default:hover{
			border-color:<?php echo $data['cta_button_border_color']; ?>;
			background-image: -moz-linear-gradient(<?php echo $data['cta_button_gradient_bottom_color']; ?>, <?php echo $data['cta_button_gradient_top_color']; ?>);
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(<?php echo $data['cta_button_gradient_bottom_color']; ?>), to(<?php echo $data['cta_button_gradient_top_color']; ?>));
			background-image: -webkit-linear-gradient(<?php echo $data['cta_button_gradient_bottom_color']; ?>, <?php echo $data['cta_button_gradient_top_color']; ?>);
			background-image: -o-linear-gradient(<?php echo $data['cta_button_gradient_bottom_color']; ?>, <?php echo $data['cta_button_gradient_top_color']; ?>);
			background-color: <?php echo $data['cta_button_gradient_top_color']; ?>;
		}
		<?php		
		
	}
	?>	

<?php
	if($data['creativo_custom_css']) {
	?>    	
			<?php	
			echo $data['creativo_custom_css'];
			?>
        <?php
	}
?>
</style>
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/custom.css" />

<script type="text/javascript">
	jQuery(document).ready(function($) {	
		function onAfter(curr, next, opts, fwd) {
		  var $ht = $(this).height();
		  //set the container's height to that of the current slide
		  $(this).parent().animate({height: $ht});
		}
	    $('.reviews').cycle({
			fx: 'fade',
			after: onAfter,
			timeout: <?php echo $data['pause_time']*1000; ?>,
			<?php if($data['pause_hover']) : echo "pause:1"; endif;?>
		});
		$("a[rel^='prettyPhoto']").prettyPhoto();
	});
	</script>
 
<?php if($data['footer_code']) { echo $data['footer_code']; } ?>
	
</head>
<body <?php body_class(); ?>>

	<?php		
    if($boxed && get_post_meta($post->ID, 'pyre_background', true) && get_post_meta($post->ID, 'pyre_en_full_screen', 'no')=='yes'): 
    ?>
		<img id="background" src="<?php echo get_post_meta($post->ID, 'pyre_background', true); ?>" class="bgwidth">    
    <?php
    endif;
    ?>
	<div class="container">
    <?php if($data['en_top_bar']) { ?>
    	<div class="top_nav_out">
            <div class="top_nav clearfix">
                <div class="top_contact clearfix">
                	<?php 
					$white_class = ($data['top_bar_scheme'] == 'dark') ? '' : 'white_scheme';
					?>
                    
                    <?php
					if($data['contact_email']) {
					?>
                		<div class="contact_email"><span class="email <?php echo $white_class; ?>"></span><a href="mailto:<?php echo $data['contact_email']; ?>"><?php echo $data['contact_email']; ?></a></div>
                    <?php
					}
					if($data['contact_phone']) {
					?>
                    	<div class="contact_phone"><span class="phone <?php echo $white_class; ?>"></span><?php echo $data['contact_phone']; ?></div>
                    <?php
					}
					?>
                    
                </div>
                <?php 
				if($data['en_tap_call']) {
				?>
                    <div class="tap_to_call">
                        <a href="callto://<?php echo $data['contact_phone']; ?>" class="button button_default large" target="_self"><?php echo $data['tap_call_text'] ?></a>
                    </div>
                <?php 
				}
				if($data['en_social_icons_header']) { 
					$soc_class = ($data['top_bar_scheme'] == 'dark') ? '2' : '';
				?>
                    <div class="top_social clearfix">
                    	<?php if($data['twitter']) { ?><a href="<?php echo $data['twitter']; ?>" class="twitter<?php echo $soc_class; ?>" title="<?php _e('Follow on Twitter', 'Creativo');?>" target="_blank" rel="nofollow"><?php _e("Follow on Twitter", "Creativo"); ?></a> <?php } ?>
                        <?php if($data['facebook']) { ?><a href="<?php echo $data['facebook']; ?>" class="facebook<?php echo $soc_class; ?>" title="<?php _e("Follow on Facebook", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Facebook", "Creativo"); ?></a><?php } ?>
                        <?php if($data['instagram']) { ?><a href="<?php echo $data['instagram']; ?>" class="instagram<?php echo $soc_class; ?>" title="<?php _e("Follow on Instagram", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Instagram", "Creativo"); ?></a><?php } ?>
                        <?php if($data['google']) { ?><a href="<?php echo $data['google']; ?>" class="google<?php echo $soc_class; ?>" title="<?php _e("Follow on Google+", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Google+", "Creativo"); ?></a><?php } ?>
                        <?php if($data['linkedin']) { ?><a href="<?php echo $data['linkedin']; ?>" class="linkedin<?php echo $soc_class; ?>" title="<?php _e("Follow on LinkedIn", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on LinkedIn", "Creativo"); ?></a><?php } ?>
                        <?php if($data['pinterest']) { ?><a href="<?php echo $data['pinterest']; ?>" class="pinterest<?php echo $soc_class; ?>" title="<?php _e("Follow on LinkedIn", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on LinkedIn", "Creativo"); ?></a><?php } ?>
                        <?php if($data['flickr']) { ?><a href="<?php echo $data['flickr']; ?>" class="flickr<?php echo $soc_class; ?>" title="<?php _e("Follow on Flickr", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Flickr", "Creativo"); ?></a><?php } ?>
                        <?php if($data['tumblr']) { ?><a href="<?php echo $data['tumblr']; ?>" class="tumblr<?php echo $soc_class; ?>" title="<?php _e("Follow on Tumblr", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Tumblr", "Creativo"); ?></a><?php } ?>
                        <?php if($data['youtube']) { ?><a href="<?php echo $data['youtube']; ?>" class="youtube<?php echo $soc_class; ?>" title="<?php _e("Follow on YouTube", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on YouTube", "Creativo"); ?></a><?php } ?>
                        <?php if($data['behance']) { ?><a href="<?php echo $data['behance']; ?>" class="behance<?php echo $soc_class; ?>" title="<?php _e("Follow on Behance", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Behance", "Creativo"); ?></a><?php } ?>
                        <?php if($data['dribbble']) { ?><a href="<?php echo $data['dribbble']; ?>" class="dribbble<?php echo $soc_class; ?>" title="<?php _e("Follow on Dribbble", "Creativo"); ?>" target="_blank" rel="nofollow"><?php _e("Follow on Dribbble", "Creativo"); ?></a><?php } ?>
                        <?php if($data['rss']) { ?><a href="<?php echo $data['rss']; ?>" class="rss<?php echo $soc_class; ?>" title="<?php _e("Rss", "Creativo"); ?>" target="_blank"><?php _e("Rss", "Creativo"); ?></a><?php } ?>
                    </div>
            	<?php 
				} 
				?>        
            </div>
        </div>   
    <?php } ?>     
    	<header class="header">
        	<div class="inner">
            	<div id="branding"> 
                	<?php  
					if($data['logo']) {
					?>             	
						<h1>
							<a class="logo" href="<?php echo home_url(); ?>" rel="home" title="<?php bloginfo('name'); ?>">
								<img src="<?php echo $data['logo']; ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>">
							</a>
						</h1>                   
                    <?php    
					}
					else{
					?>
                    	<h1 class="text"><a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
                        
						<?php 
						if($data['en_tagline']) {
						?>
                        
                        	<span class="tagline"><?php echo get_bloginfo('description') ?></span>
                        
                    <?php
						}
					}
                    ?>    
                </div>
                <div class="main-navigation">
                	<?php if($data['header_style'] == 'style2') { ?>
						<?php if($data['header_banner']) { ?>                	
                            <div class="banner">
                                <?php echo $data['header_banner']; ?>
                            </div>
                    <?php 
					}
					} 
					else {
					?>
                	<div class="table">
                        <nav id="navigation">                    	
                            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>                    	        
                        </nav>
                    </div>  
                    <?php } ?>  
                </div>                 
                <div class="clr"></div>
            </div>
        </header>
        <?php if($data['header_style'] == 'style2') { ?>
        <div class="second_navi">
        	<div class="second_navi_inner">
                <div class="main-navigation nofloat">
                    <div class="table">
                        <nav id="navigation" class="clearfix">                    	
                            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'menu', 'container' => '' ) ); ?>                    	        
                        </nav>
                    </div> 
                </div>
			</div>
        </div>
        <?php
		}
		if(is_search()){ 
		?>
        	<div class="bellow_header">
                <div class="bellow_header_title">
                    <?php printf( __( 'Search Results for: %s', 'Creativo' ), '<span>' . get_search_query() . '</span>' ); ?>
                    <?php if(function_exists(bcn_display)):?>                               
                        <div class="page-title">
                            <div class="breadcrumb">
                                <?php bcn_display();  ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    <?php endif; ?>
                </div>
            </div>        
        <?php 
		} 
		if(is_category() ){
		?>
        <div class="bellow_header">
        	<div class="bellow_header_title">
            	<?php _e('Posts filed under: ','Creativo'); single_cat_title(); ?>
                <?php if(function_exists(bcn_display)):?>                               
                    <div class="page-title">
                        <div class="breadcrumb">
                            <?php bcn_display();  ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php endif; ?>
            </div>
        </div>
        <?php	
		}
		if(is_404()){
		?>
        <div class="bellow_header">
        	<div class="bellow_header_title">
            	<?php _e('404 Error ','Creativo'); ?>
                <?php if(function_exists(bcn_display)):?>                               
                    <div class="page-title">
                        <div class="breadcrumb">
                            <?php bcn_display();  ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php endif; ?>
            </div>
        </div>
        <?php	
		}
		if(is_tag() ){
		?>
        <div class="bellow_header">
        	<div class="bellow_header_title">
            	<?php _e('Posts tagged with: ','Creativo'); single_cat_title(); ?>
                <?php if(function_exists(bcn_display)):?>                               
                    <div class="page-title">
                        <div class="breadcrumb">
                            <?php bcn_display();  ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php endif; ?>
            </div>
        </div>
        <?php	
		}
		
		if(get_query_var('portfolio_category')){
		?>
        <div class="bellow_header">
        	<div class="bellow_header_title">
            	<?php _e('Projects filed under: ','Creativo'); single_cat_title(); ?>
                <?php if(function_exists(bcn_display)):?>                               
                    <div class="page-title">
                        <div class="breadcrumb">
                            <?php bcn_display();  ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php endif; ?>
            </div>
        </div>    
        <?php
		}
		if(is_author()) {
			if(have_posts() ) {									
					the_post();
					?>                
                    <div class="bellow_header">
                        <div class="bellow_header_title">
                            <?php _e('All posts by: ','Creativo') ; echo get_the_author(); ?>
                            <?php if(function_exists(bcn_display)):?>                               
                                <div class="page-title">
                                    <div class="breadcrumb">
                                        <?php bcn_display();  ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            <?php endif; ?>
                        </div>
                    </div>
					<?php
					rewind_posts();
			}
			wp_reset_query();
		}		
		
		if(is_month()) {
			if(have_posts() ) {									
					the_post();
					?>                
                    <div class="bellow_header">
                        <div class="bellow_header_title">
                            <?php printf( __( 'Monthly Archives: %s', 'Creativo' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'Creativo' ) ) ); ?>
                            <?php if(function_exists(bcn_display)):?>                               
                                <div class="page-title">
                                    <div class="breadcrumb">
                                        <?php bcn_display();  ?>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            <?php endif; ?>
                        </div>
                    </div>
					<?php
					rewind_posts();
			}
			wp_reset_query();
		}
				
		if(((is_page()  || is_single() || is_singular('creativo_portfolio')) &&  get_post_meta($post->ID, 'pyre_show_title', true) == 'yes') && !is_front_page()){
		?>
         <div class="bellow_header">
            <div class="bellow_header_title">           
                <?php the_title(); ?> 
                <?php if(function_exists(bcn_display)):?>                               
                    <div class="page-title">
                        <div class="breadcrumb">
                            <?php bcn_display();  ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php endif; ?>    
                    
            </div>
        </div>
        <?php
		}
		if(function_exists('is_product'))
		{
			if(is_product()) {
			?>
			 <div class="bellow_header">
				<div class="bellow_header_title">           
					<?php the_title(); ?>                                
					<?php if(function_exists(bcn_display)):?>                               
                        <div class="page-title">
                            <div class="breadcrumb">
                                <?php bcn_display();  ?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    <?php endif; ?>    
				</div>
			</div>
<section class="reading-box red_border centered" style="margin-bottom:10px";><h2>Get free tips to create a life with passion and style!</h2><p>Get free dance &amp; fitness videos, lifestyle news and updates delivered to your inbox.</p><a href="http://visitor.r20.constantcontact.com/d.jsp?llr=4cq6jhcab&amp;p=oi&amp;m=1101904396383&amp;sit=ut6ze79cb&amp;f=ea809a20-30ba-49cc-85f7-1788c3bf1a37" class="button button_red large" target="_blank">Subscribe Today!</a></section>
			<?php
			}
		}

		?>        
            