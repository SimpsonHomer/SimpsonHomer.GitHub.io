<?php get_header(); ?>	
        <?php
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
        	<div class="post_container" style="<?php echo $content_css; ?>">
            	<?php if(is_author()){ ?>
            		<div class="posts-related">
                    	<div class="title_related"><h2><span><?php _e('About the Author', 'Creativo'); ?></span></h2></div>
                        <div class="author_box">
                        	<div class="author_pic">
								<?php 
                                    echo get_avatar( get_the_author_meta('id'), $size = '80'); 
                                ?>
                            </div>
                            <h3><?php the_author_posts_link(); ?></h3>
                        	<?php the_author_meta( 'description'); ?>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div class="blogpost_split"></div>
                <?php } ?> 
            <?php if (have_posts()) : ?>
				<?php while(have_posts()): the_post(); ?>
                	<?php $posttags = get_the_tags(); ?>	
					<div class="blogpost">
					<?php					
						
						if(has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_youtube', true) || get_post_meta(get_the_ID(), 'pyre_vimeo', true)):
						?>
                        <?php echo $add; ?>
							<div class="flexslider" data-interval="0" data-flex_fx="fade">
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
                                    
                                    
                                    <?php
									$extra ='';									
									$i = 2;
                                	while($i <= $data['featured_images_count']):
										$attachment = new StdClass();
										$attachment_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
										if($attachment_id):										
											?>
											<?php $attachment_image = wp_get_attachment_image_src($attachment_id, $thumbnail); ?>
											<?php $full_image = wp_get_attachment_image_src($attachment_id, 'full'); ?>
											<?php $attachment_data = wp_get_attachment_metadata($attachment_id); ?>										
											<?php $extra .= '<li><a href="'.get_permalink().'"><img src="'.$attachment_image[0].'" alt="'.$attachment_data['image_meta']['title'].'" ></a></li>'; ?>
                                        <?php    
										endif; 
										$i++; 
									endwhile; 
									
									?>
                                    <?php 
                                    	if($extra ==''){ $hover = '<span class="gallery_zoom"><img src="'.get_bloginfo('template_directory').'/images/'.$icon.'" /></span>';} else $hover =''; 
                                    ?>
                                    
                                     <?php
									if(has_post_thumbnail()){	
									?>			   
										
                                        <li>
                                        	<div class="full-blog">
                                            	<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($thumbnail); echo $hover; ?></a>  
                                            </div>                                      
                                        </li>
                                        <?php echo $extra; ?>
									<?php
									}
									?>

								</ul>
								<div class="clear"></div>
							</div>
						<?php
						echo $add_close;
						endif;
						?>
                        <?php echo $add2; ?>
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="post-content">
                            <?php 
							if($data['post_content']!='Full Content') { 
                            	 the_excerpt(''); 
							}
							else{
								the_content();
							}
							?>
                        </div>
                        <?php echo $add2_close; ?>
                        <?php 
						if($data['show_author'] || $data['show_categories'] || $data['show_tags'] || $data['show_comments'] || $data['show_view_more']){
						?>
                            <div class="post-atts">
                                <div class="left-atts">
                                	<?php if($data['show_date']){ ?>
                                        <?php _e('On: ','Creativo');  the_time( get_option('date_format') ); ?><span class="sep">|</span>
                                    <?php } ?> 
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
				endif;	
				?>
                <?php kriesi_pagination($blog->max_num_pages, $range = 2); ?>                 
             </div>
              <!--BEGIN #sidebar .aside-->
            <div class="sidebar" style="<?php echo $sidebar_css; ?>">                
                <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar() ) ?>            
            <!--END #sidebar .aside-->
            </div>
             <div class="clr"></div>   
        </div>        
       <div class="clr"></div> 
<?php get_footer(); ?>