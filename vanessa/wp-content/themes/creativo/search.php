<?php get_header(); ?>		
        <?php
		$full_width ='';
		if($data['sidebar_pos'] == 'left') {
			$content_css = 'float:right;';
			$sidebar_css = 'float:left;';
		} else {
			$content_css = 'float:left;';
			$sidebar_css = 'float:right;';
		}
		if($data['blog_images'] == 'Small Style') {
			$add = ' <div class="blogpost_small_pic">';
			$add_close = '</div>';
			$add2 = '<div class="blogpost_small_desc">';
			$add2_close = '</div><div class="clr"></div>';
			$thumbnail = 'blog-medium';
			$icon = 'img-ovr7.png';
		}	
		else{
			$thumbnail = 'blog-large';
			$icon = 'img-ovr6.png';
		}
		?>        
        <div class="row">
        	<div class="post_container" style="<?php echo $container; ?>">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                		
					<div class="blogpost">
					<?php					
						$args = array(
							'post_type' => 'attachment',
							'numberposts' => '5',
							'post_status' => null,
							'post_parent' => $post->ID,
							'orderby' => 'menu_order',
							'order' => 'ASC',
							'exclude' => get_post_thumbnail_id()
						);
						$attachments = get_posts($args);
						if($attachments || has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_youtube', true) || get_post_meta(get_the_ID(), 'pyre_vimeo', true)):
						?>
                        <?php echo $add; ?>
							<div class="flexslider">
								<ul class="slides">
									<?php if( get_post_meta($post->ID, 'pyre_youtube', true) != ''){ ?>
									<li class="video-container">                        	
										<?php echo  do_shortcode('[youtube id="'.get_post_meta($post->ID, 'pyre_youtube', true).'"]'); ?>                               
									</li>
									<?php } ?>
									<?php if( get_post_meta($post->ID, 'pyre_vimeo', true) != ''){ ?>
									<li class="video-container">                        
										<?php echo  do_shortcode('[vimeo id="'.get_post_meta($post->ID, 'pyre_vimeo', true).'"]'); ?>
									</li>
									<?php } ?>
                                    
									<?php if(has_post_thumbnail()): ?>
										<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-large'); ?>
                                        <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
                                        <li>
                                            <div class="full-blog">                                                                                          	
                                            	<?php 
                                                if(count($attachments)==0){ $hover = '<span class="gallery_zoom"><img src="'.get_bloginfo('template_directory').'/images/'.$icon.'" /></span>';} else $hover =''; 
                                                ?>
                                                <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail($thumbnail); echo $hover; ?></a>                   
                                            </div>   
                                        </li>
									<?php endif; ?>
									
									<?php foreach($attachments as $attachment): ?>
											<?php $image = wp_get_attachment_image_src($attachment->ID, $thumbnail); ?>                                                                                          
                                            <li>
                                                <a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a>										
                                            </li>
									<?php endforeach; ?>
								</ul>
								<div class="clear"></div>
							</div>
						<?php
						echo $add_close;
						else:
							$add2 = '<div class="blogpost_small_desc" style="width:100%; float:none;">'; 
							$add2_close = '</div>';
						endif;
						
						?>
                        <?php echo $add2; ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-content">
                            <?php the_excerpt(''); ?>
                        </div>
                        <?php echo $add2_close; ?>
                        <?php 
						if($data['show_author'] || $data['show_categories'] || $data['show_tags'] || $data['show_comments'] || $data['show_view_more']){
						?>
                            <div class="post-atts">
                                <div class="left-atts">
                                    <?php if($data['show_author']){ ?>
                                        <?php _e('By: ','Creativo'); the_author_posts_link(); ?><span class="sep">|</span>
                                    <?php } ?> 
                                    
                                    <?php if($data['show_categories']){ ?>   
                                        <?php the_category(', '); ?><span>|</span>
                                    <?php } ?>
                                    
                                    <?php if($data['show_tags']){ ?>    
                                        <?php _e('Tags: ','Creativo'). count($posttags); ?><span>|</span>
                                    <?php } ?>
                                        
                                    <?php if($data['show_comments']){ ?>    
                                        <?php _e('Comments: ','Creativo'); comments_popup_link('0', '1', '%'); ?>
                                    <?php } ?>
                                    
                                </div>
                                <?php if($data['show_view_more']){ ?>
                                    <div class="right-atts"><a href="<?php the_permalink(); ?>"><?php _e('View More ', 'Creativo'); ?></a></div>
                                <?php } ?>    
                                <div class="clr"></div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="blogpost_split"></div>   
                    <?php
				endwhile;
				?>				
				<?php kriesi_pagination($blog->max_num_pages, $range = 20); ?>
				<?php else: ?>
                    <h2 class="page404"><?php _e('No relevant search results found','Creativo'); ?></h2>
                    <div class="post-content">
                        <?php _e('Try a different search query.','Creativo'); ?>
                    </div>
                <?php endif; ?>
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