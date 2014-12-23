<?php get_header(); ?>
    <?php 
		if(get_post_meta($post->ID, 'pyre_sidebar_pos', true) == 'left') { 
			$container= 'float: right;';
			$sidebar = 'float: left;';	
		}
		else{ 
			$container= 'float: left;';
			$sidebar = 'float: right;';	
		}		
	?>
	<div class="row">
       	<div class="post_container" style="<?php echo $container; ?>">       
			<h2 class="page404"><?php _e('404: Page Not Found','Creativo'); ?></h2>
			<div class="post-content">
				<?php _e('Sorry, but the page you are looking for has not been found. Try Checking the URL for Errors, then hit the refresh button on your browser','Creativo'); ?>
			</div>    
			<div class="blogpost_split"></div>      
		</div>
		<!--BEGIN #sidebar .aside-->
		<div class="sidebar" style="<?php echo $sidebar; ?>">       
			<?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) ?>  
		<!--END #sidebar .aside-->
		</div>
		<div class="clr"></div>   
	</div>        
	<div class="clr"></div>		
<?php get_footer(); ?>