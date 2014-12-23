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
                	
					<div class="blogpost">
                    <section class="page-content clearfix">
					<?php woocommerce_content(); ?>	
                    </section>
                    </div>
                    

             </div>
              <!--BEGIN #sidebar .aside-->
            <div class="sidebar" style="<?php echo $sidebar; ?>">                
               <?php dynamic_sidebar('woocommerce-sidebar'); ?>            
            <!--END #sidebar .aside-->
            </div>
             <div class="clr"></div>   
        </div>        
       <div class="clr"></div>		
<?php get_footer(); ?>