<?php
get_header(); ?>
	<div class="row">
	    <div id="content" class="portfolio-one">
            <div class="portfolio-wrapper">
            	<?php
				while(have_posts()): the_post();
					if(has_post_thumbnail()):
				?>
                <?php
                $item_classes = '';
                $item_cats = get_the_terms($post->ID, 'portfolio_category');
				

                if($item_cats):
                foreach($item_cats as $item_cat) {
                    $item_classes .= $item_cat->slug . ' ';
                }
                endif;
                ?>
                <div class="portfolio-item <?php echo $item_classes; ?>">
                    <!-- Project Feed -->
                    <div class="project-feed clearfix">
                    	<div class="full">
                        	<div class="image_show">  
                            	<a href="<?php the_permalink(); ?>">                                      
                                	<?php the_post_thumbnail('portfolio-one'); ?> 
                                    <span class="gallery_zoom"><img src="<?php bloginfo('template_directory'); ?>/images/img-ovr4.png" /></span> 
                                </a> 
                            </div>                                          
                            <span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
                            <p><span class="args"><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></span></p>
                            <?php the_excerpt(); ?> 
                            <a href="<?php the_permalink(); ?>" class="button small default"><?php _e('View More','Creativo'); ?></a>
                            <div class="clear"></div>   
                        </div>                                
                    </div>
                   <!-- /Project Feed -->
                </div>                                
                <?php endif; endwhile; ?>
            </div>
        </div>    
		<?php kriesi_pagination($portf->max_num_pages, $range = 2); ?>
	</div>
<?php get_footer(); ?>