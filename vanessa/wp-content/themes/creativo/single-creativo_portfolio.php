<?php get_header(); ?>
	
	<?php
	$items = $data['portfolio_related_items'];
	if(get_post_meta($post->ID, 'pyre_width', true) == 'half') {
		$portfolio_width = 'half';
		$desc_width = 'half_desc';
		$add_css = 'portfolio-misc-responsive';
		$margin = '';
		$featured_img = 'blog-large';
		
	} else {
		$portfolio_width = 'full';
		$desc_width = 'full_desc';
		$add_css = 'portfolio-misc-info-left';
		$margin = 'no-margin';
		$featured_img = 'portfolio-full';
	}
	?>
    <div class="row">
        <div class="portfolio-area <?php echo $margin; ?>">
        	<?php if($data['show_port_navi']) { ?>  
        	<div class="portfolio-navigation">
				<?php previous_post_link('%link', '<div class="portfolio-navi-next">'.__('Previous: ','Creativo').'</div>'); ?>
                <?php next_post_link('%link', '<div class="portfolio-navi-previous">'.__('Next: ','Creativo').'</div>'); ?>
                <div class="clear"></div>
            </div> 
            <?php } ?>         
            <?php while(have_posts()): the_post(); ?>
            <div id="post-<?php the_ID(); ?>" >
                <?php
                
                if(has_post_thumbnail() || get_post_meta($post->ID, 'pyre_youtube', true) || get_post_meta($post->ID, 'pyre_vimeo', true)):
                ?>
                <div class="flexslider <?php echo $portfolio_width; ?>" data-interval="0" data-flex_fx="fade">
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
							$attachment->ID = kd_mfi_get_featured_image_id('featured-image-'.$i, 'creativo_portfolio');
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
                <?php endif; ?>
                <div class="project-content <?php echo $desc_width; ?>">
                <?php if($data['project_details']){ ?>                	
                    <div class="portfolio-misc-info <?php echo $add_css; ?>">
                     	<?php if($data['project_details_text']) : ?>
                    		<h3><?php echo $data['project_details_text']; ?></h3> 
                        <?php endif; ?>
                        
                        <?php if(get_post_meta($post->ID, 'pyre_client_name', true)): ?>                  	
                            <div class="project-info-box">
                                <strong><?php _e('Client name', 'Creativo'); ?>:</strong>                            
                                <?php echo get_post_meta($post->ID, 'pyre_client_name', true); ?>                            
                            </div>
                        <?php endif; ?>
                        
                        <?php if(get_post_meta($post->ID, 'pyre_skills', true)): ?>
                            <div class="project-info-box">
                                <strong><?php _e('Skills', 'Creativo'); ?>:</strong>                           
                                    <?php echo get_post_meta($post->ID, 'pyre_skills', true); ?>                             
                            </div>
                        <?php endif; ?>
                        
                        <?php if(get_the_term_list($post->ID, 'portfolio_category', '', '<br />', '')): ?>
                            <div class="project-info-box">
                                <strong><?php _e('Filed in', 'Creativo'); ?>:</strong>                           
                                    <?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?>                            
                            </div>
                        <?php endif; ?>
                        
                        <?php if(get_post_meta($post->ID, 'pyre_website_text', true) && get_post_meta($post->ID, 'pyre_website_url', true)): ?>
                            <div class="project-info-box">
                                <strong><?php _e('Website', 'Creativo'); ?>:</strong>
                                <span><a href="<?php echo get_post_meta($post->ID, 'pyre_website_url', true); ?>" rel="nofollow" target="_blank"><?php echo get_post_meta($post->ID, 'pyre_website_text', true); ?></a></span>
                            </div>
                        <?php endif; ?>
                        <?php
							if($data['port_social_icons']){
						?>
                                <ul class="get_social no-float social_ic_margin">
                                    <li><a class="fb" href="http://www.facebook.com/sharer.php?s=100&p&#91;url&#93;=<?php the_permalink(); ?>&p&#91;title&#93;=<?php the_title(); ?>" target="_blank"><span><?php _e('Share on Facebook','Creativo');?></span></a></li>
                                    <li><a class="tw" href="http://twitter.com/home?status=<?php the_title(); ?> <?php the_permalink(); ?>" target="_blank"><span>Share on Twitter</span></a></li>
                                    <li><a class="lnk" href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank"><span><?php _e('Share on LinkedIn','Creativo');?></span></a></li>
                                    <li><a class="rd" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank"><span><?php _e('Share on Reddit','Creativo');?></span></a></li>
                                    <li><a class="tu" href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>" target="_blank"><span><?php _e('Share on Tumblr','Creativo');?></span></a></li>
                                    <li><a class="gp" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" target="_blank"><span><?php _e('Share on Google+','Creativo');?></span></a></li>
                                </ul>
                        <?php
							}
						?>       
                    </div> 
                    <?php } ?>                             
                    <div class="project-description">
                    	<?php if($data['project_description_text']) : ?>
                        	<h3><?php echo $data['project_description_text']; ?></h3>
                         <?php endif; ?>
						
						<?php the_content(); ?>
                    </div>
                </div>
                <div class="clear"></div>
               
            </div>
            <?php endwhile; ?>
        </div>
        <?php
        if($data['related_projects']) { 
		?>
         <?php $relate = get_related_projects($post->ID,$items); ?>
                <?php if($relate->have_posts()): ?>
                <div class="portfolio-related">
                    <div class="content_box_title"><span class="white smaller"><?php _e('Related Projects', 'Creativo'); ?></span></div>
                    <div class="recent_posts_container">
                    	<?php $count = 1; $j = 3; ?>
                    	<?php 
							while($relate->have_posts()): $relate->the_post(); 
						?>
                        		<?php
									if(($count == $j) && ($count < 5)){
										echo '<div class="clear-responsive"></div><article class="col extra-width-full-port">';
										$j = $j + 2;
									}
									elseif(($count == $j) && ($count == 5)){
										echo '<div class="clear-responsive"></div><article class="col extra-width-full-port last">';
										$j = $j + 2;
									}
									else{
										echo '<article class="col extra-width-full-port">';
									}
									
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
							?>
                            		<div class="flexslider mini">
                                    	<ul class="slides">
										<?php
										if(get_post_meta($post->ID, 'pyre_youtube', true) || get_post_meta($post->ID, 'pyre_vimeo', true)){
											if(get_post_meta($post->ID, 'pyre_youtube', true)):
												echo '<li><div class="video-container" style="height:12px;"><iframe title="YouTube video player" width="218px" height="134px" src="http://www.youtube.com/embed/' . get_post_meta($post->ID, 'pyre_youtube', true) . '" frameborder="0" allowfullscreen></iframe></div></li>';
											endif;
											
											if(get_post_meta($post->ID, 'pyre_vimeo', true)):
												echo '<li><div class="video-container" style="height:12px;"><iframe src="http://player.vimeo.com/video/' . get_post_meta($post->ID, 'pyre_vimeo', true) . '" width="220px" height="161px" frameborder="0"></iframe></div></li>';
											endif;	
											
											foreach($attachments_item as $attachment):
												$attachment_image = wp_get_attachment_image_src($attachment->ID,  'recent-posts');												
												echo '<li><a href="'.get_permalink($post->ID).'"><img src="'. $attachment_image[0].'" alt="'.$attachment->post_title.'" /></a></li>';
											endforeach;
											
										}
										else{
											echo '<li><div class="one-fourth-recent"><a href="'.get_permalink($post->ID).'">'.get_the_post_thumbnail($post->ID, 'recent-posts');
												echo '<span class="gallery_zoom"><img src="'.get_bloginfo('template_directory').'/images/img-ovr-recent.png" /></span></a>';
											echo '</div></li>';
										}
                                        ?>
                                        </ul>
                                    </div>  
                        	<?php
								echo '<div class="description">';
									echo '<center><h3><a href="'.get_permalink($post->ID).'">'.get_the_title().'</a></h3></center>';												
								echo '</div>';
							echo'</article>';
							$count++;
							endwhile;
						?>            
                    </div>
                </div>
                <?php endif; ?>
          <?php } ?>      
    </div>    
<?php get_footer(); ?>