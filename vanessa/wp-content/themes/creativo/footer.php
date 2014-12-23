<?php global $data; ?>
		
		<footer class="footer">
        	<?php 
			if (  is_active_sidebar( 'sidebar-2'  )) {
			?>	
				<div class="footer_widget">
					<div class="footer_widget_inside">
						<?php
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-2')): 
						endif;
						?>
						<div class="clr"></div>
					</div>
				</div>
            <?php
			}
			?>  
            <?php
			if($data['en_cta']){
			?>
            <div class="action_bar">
                <div class="action_bar_inner">                
                	<h2><?php echo $data['cta_text_real']; ?></h2>
                	<a href="<?php echo $data['cta_button_link']; ?>" class="button button_default large custompos" target="_self"><?php echo $data['cta_button_text']; ?></a>
                </div>
            </div>  
            <?php 
			}
			?>
        	<div class="inner">
            	<div class="copyright">
                	<?php 
						if($data['footer_copyright']) { 
							echo $data['footer_copyright'];
						}
					?>                    
                </div>
                
             <?php 
			 		if($data['en_social_icons']){
				?>
                		<div class="top_social clearfix">
							<?php if($data['twitter']) { ?><a href="<?php echo $data['twitter']; ?>" class="twitter<?php echo $soc_class; ?>" title="<?php _e("Follow on Twitter", 'Creativo');?>" target="_blank" rel="nofollow"><?php _e("Follow on Twitter", "Creativo"); ?></a> <?php } ?>
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
        </footer>
	</div>
<?php if($data['en_back_top']) { ?>    
		<div id="gotoTop"></div>    
<?php
	}
	
	

	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	
	wp_footer();
	
?>
</body>
</html>
