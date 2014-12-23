<?php // Template Name: Comments and Reviews ?>
<?php get_header(); ?>
		<div class="row">
            	<?php while(have_posts()): the_post(); ?>                	          	
			    	<?php the_content(); ?>
                    
                    <?php comments_template('', true); ?> 
                                   
                <?php endwhile; ?> 
        </div>        
       <div class="clr"></div>		
<?php get_footer(); ?>