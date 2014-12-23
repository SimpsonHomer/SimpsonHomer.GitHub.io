<?php get_header(); ?>    
        <?php
		
		if(get_post_meta($post->ID, 'pyre_en_sidebar', true) == 'yes'){
			$en_sidebar = 'yes';
			$outer_container = 'post_container';
			$extra = 'extra-width';
			$coloane = 3;	
			$items = $data['related_items'];		
			if(get_post_meta($post->ID, 'pyre_sidebar_pos', true) == 'left') { 
				$container= 'float: right;';
				$sidebar = 'float: left;';	
			}
			else{ 
				$container= 'float: left;';
				$sidebar = 'float: right;';	
			}	
		}
		else{
			$outer_container = 'post_container_full';
			$coloane = 5;
			$extra ='extra-width-full';
			$items = $data['related_items'];			
		}
	?>  
    <div class="row">
        	<div class="<?php echo $outer_container; ?>" style="<?php echo $container; ?>">            
            <?php				
				while(have_posts()): the_post(); 	
				?>
					<div class="blogpost">
                    <?php 
					if($data['show_post_navi']){	?>
                    	<div class="portfolio-navigation">
							<?php previous_post_link('%link', '<div class="portfolio-navi-next">'.__('Previous: ','Creativo').'</div>'); ?>
                            <?php next_post_link('%link', '<div class="portfolio-navi-previous">'.__('Next: ','Creativo').'</div>'); ?>
                            <div class="clear"></div>
                        </div>
					<?php
					}
					if(get_post_meta(get_the_ID(), 'pyre_show_featured', true)=='yes') {
						if(has_post_thumbnail() || get_post_meta(get_the_ID(), 'pyre_youtube', true) || get_post_meta(get_the_ID(), 'pyre_vimeo', true)):
						?>
							<div class="flexslider" data-interval="0" data-flex_fx="fade">
								<ul class="slides">
									<?php if( get_post_meta($post->ID, 'pyre_youtube', true) != ''){ ?>
                                    <li class="video-container">                        	
                                        <?php echo  do_shortcode('[youtube id="'.get_post_meta($post->ID, 'pyre_youtube', true).'" ]'); ?>                               
                                    </li>
                                    <?php } ?>
                                    <?php if( get_post_meta($post->ID, 'pyre_vimeo', true) != ''){ ?>
                                    <li class="video-container">                        
                                        <?php echo  do_shortcode('[vimeo id="'.get_post_meta($post->ID, 'pyre_vimeo', true).'" width="600" height="350"]'); ?>
                                    </li>
                                    <?php } ?>
                                    
                                    <?php
                                    if(has_post_thumbnail()){	
                                    ?>						   
                                        <?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
                                        <?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
                                        <li>
                                            <a href="<?php echo $full_image[0]; ?>" rel="prettyPhoto['gallery']"><?php the_post_thumbnail('full');?></a>                                    
                                        </li>
                                    <?php } 
                                    
                                    $i = 2;
                                    while($i <= $data['featured_images_count']):
										$attachment = new StdClass();
                                        $attachment->ID = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post');
                                        if($attachment->ID):										
                                        ?>                                       
                                        <?php $full_image = wp_get_attachment_image_src($attachment->ID, 'full'); ?>
                                        <?php $attachment_data = wp_get_attachment_metadata($attachment->ID); ?>
                                            <li>	
                                                <a href="<?php echo $full_image[0] ?>" rel="prettyPhoto['gallery']"><img src="<?php echo $full_image[0]; ?>" alt="<?php echo $attachment->post_title; ?>" /></a>	
                                            </li>                                                        
                                        <?php 
                                        endif; 
                                        $i++; 
                                    endwhile; 
                                    ?>		
                                </ul>
								<div class="clear"></div>
							</div>
						<?php
						endif;
						}
						?>
                        <h1><?php the_title(); ?></h1>
                        <div class="post-content">
                            <?php the_content(''); ?>
                        </div>                        
                        <?php 
						if($data['show_date'] || $data['show_author'] || $data['show_categories'] || $data['show_tags'] || $data['show_comments'] || $data['show_view_more']){
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
                                        <?php  _e('Under: ','Creativo'); the_category(', '); ?><span>|</span>
                                    <?php } ?>
                                        
                                    <?php if($data['show_comments']){ ?>    
                                         <?php _e('Comments: ','Creativo');  comments_popup_link('0', '1', '%'); ?><span>|</span>
                                    <?php } ?>
                                    
                                    <?php if($data['show_tags']){ ?>    
                                        <?php _e('Tags: ','Creativo');  the_tags('',', '); ?>
                                    <?php } ?>                                   
                                    
                                </div>                                  
                                <div class="clr"></div>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <?php
						if($data['social_icons']){
					?>
                    	<div class="blogpost_split"></div> 
                            <div class="social_icons">
                                <?php _e('Like this post? Share it with your friends:','Creativo'); ?>      
                                <ul class="get_social">
                                    <li><a class="fb" href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php the_permalink(); ?>&p&#91;title&#93;=<?php the_title(); ?>" target="_blank"><span><?php _e('Share on Facebook','Creativo');?></span></a></li>
                                    <li><a class="tw" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank"><span>Share on Twitter</span></a></li>
                                    <li><a class="lnk" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank"><span><?php _e('Share on LinkedIn','Creativo');?></span></a></li>
                                    <li><a class="rd" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank"><span><?php _e('Share on Reddit','Creativo');?></span></a></li>
                                    <li><a class="tu" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank"><span><?php _e('Share on Tumblr','Creativo');?></span></a></li>
                                    <li><a class="gp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><span><?php _e('Share on Google+','Creativo');?></span></a></li>
                                </ul>
                                <div class="clr"></div>
                            </div>
                    <?php
						}
					?>
                     <?php
						if($data['show_author']){
					?>
                        <div class="posts-boxes">
                            <div class="content_box_title"><span class="white smaller"><?php _e('About the Author', 'Creativo'); ?></span></div>
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
                     <?php } ?>   
                     <?php
				    if($data['related_posts']) { 
					?>
					 <?php $relate = get_related_posts($post->ID,$items); ?>
							<?php if($relate->have_posts()): ?>
							<div class="posts-boxes">
								<div class="content_box_title">
                                	<span class="white smaller"><?php _e('Related Posts', 'Creativo'); ?></span>
                                </div>
                                <div class="recent_posts_container">
                                	<?php
									$count = 1;
									$i = 3;
									
									while($relate->have_posts()): $relate->the_post();						
										if(($count == $i) && ($count < $coloane)){
											echo '<div class="clear-responsive"></div><article class="col '.$extra.'">';
											$i = $i + 2;
										}
										elseif(($count == $i) && ($count == $coloane)){
											echo '<div class="clear-responsive"></div><article class="col '.$extra.' last">';
											$i = $i + 2;
										}
										else{
											echo '<article class="col '.$extra.'">';
										}
										
										?>
                                        
                                       
                                        
                                        <?php

										if(has_post_thumbnail() || get_post_meta($post->ID, 'pyre_youtube', true) || get_post_meta($post->ID, 'pyre_vimeo', true)):
										?>
                                        	<div class="flexslider mini">
                                            	<ul class="slides">
                                                <?php
													if(get_post_meta($post->ID, 'pyre_youtube', true)):
														echo '<li><div class="video-container" style="height:12px;"><iframe title="YouTube video player" width="218px" height="134px" src="http://www.youtube.com/embed/' . get_post_meta($post->ID, 'pyre_youtube', true) . '" frameborder="0" allowfullscreen></iframe></div></li>';
													endif;
													if(get_post_meta($post->ID, 'pyre_vimeo', true)):
														echo '<li><div class="video-container" style="height:12px;"><iframe src="http://player.vimeo.com/video/' . get_post_meta($post->ID, 'pyre_vimeo', true) . '" width="220px" height="161px" frameborder="0"></iframe></div></li>';
													endif;													
													
													if(has_post_thumbnail()):
													
														$attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'recent-posts');
														$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
														$attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id());														
															echo '<li><div class="one-fourth-recent"><a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'recent-posts');
																echo '<span class="gallery_zoom" ><img src="'.get_bloginfo('template_directory').'/images/img-ovr-recent.png" /></span></a>';
															echo '</div></li>';																										
													endif;													
													
												?>
                                                </ul>
                                            </div>
                                        <?php
										endif;	
											echo '<div class="description">';
												echo '<center><h4><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h4></center>';												
											echo '</div>';
										echo'</article>';
										$count++;								
									endwhile;
									
									?>
                                <div class="clear"></div>
                             </div>   
                         </div>                                
                               
						<?php endif; wp_reset_query(); ?>
                     <?php } ?>
                            
              		<div class="blogpost_split"></div> 
                    <?php
						if($data['show_comments']){
					?>                    
                    	<?php comments_template('', true); ?>  
                    <?php
						}
				endwhile;	
				?>
             </div>
             <?php
			 if($en_sidebar == 'yes'){
			 ?>
				 <!--BEGIN #sidebar .aside-->
				<div class="sidebar" style="<?php echo $sidebar; ?>">                
					<?php
					if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Blog Sidebar')): 
					endif;
					?>            
				<!--END #sidebar .aside-->
				</div>
              <?php 
			  }
			  ?>  
             <div class="clr"></div>   
        </div>        
       <div class="clr"></div>		
	
<?php get_footer(); ?>