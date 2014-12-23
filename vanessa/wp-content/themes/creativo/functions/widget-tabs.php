<?php
add_action('widgets_init', 'pyre_tabs_load_widgets');

function pyre_tabs_load_widgets()
{
	register_widget('Pyre_Tabs_Widget');
}

class Pyre_Tabs_Widget extends WP_Widget {
	
	function Pyre_Tabs_Widget()
	{
		$widget_ops = array('classname' => 'pyre_tabs', 'description' => __('Popular posts and recent posts.','Creativo'));

		$control_ops = array('id_base' => 'pyre_tabs-widget');

		$this->WP_Widget('pyre_tabs-widget', __('Popular / Recent Posts Tabs','Creativo'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		global $post;
		
		extract($args);
		
		$posts = $instance['posts'];
		$comments = $instance['comments'];
		$recent = $instance['recent'];
		$color = $instance['color'];
		$show_popular_posts = ( isset($instance['show_popular_posts']) && ($instance['show_popular_posts'])!='false' ) ? 'true' : 'false';
		$show_recent_posts = ( isset($instance['show_recent_posts']) && ($instance['show_recent_posts'])!='false'  ) ? 'true' : 'false';
		$show_comments = ( isset($instance['show_comments']) && ($instance['show_comments'])!='false'  ) ? 'true' : 'false';
		//output the right color for the tabs, according to the selection 
			if( $color == 'default'){ 
				$button = 'button_default'; 
				$border='border_default'; 
			}
			else{
				$button = 'button_'.$color;
				switch ($color){
						case 'yellow':
							$border = 'border_yellow';
						break;
						case 'blue':
							$border = 'border_blue';
						break;
						case 'red':
							$border = 'border_red';
						break;
						case 'purple':
							$border = 'border_purple';
						break;
						case 'green':
							$border = 'border_green';
						break;
						case 'black':
							$border = 'border_black';
						break;
						default:
							$border = 'border_grey';				
					}
			}
						
		echo $before_widget;
		?>
		<div class="tab-holder shortcode-tabs">
			<div class="tab-hold tabs-wrapper">
				<ul id="tabs" class="tabs">
					<?php if($show_popular_posts == 'true'): ?>
					<li class="<?php echo $border; ?>"><a href="#tab1" class="<?php echo $button;?>"><?php _e('Popular', 'Creativo'); ?></a></li>
					<?php endif; ?>
					<?php if($show_recent_posts == 'true'): ?>
					<li class="<?php echo $border; ?>"><a href="#tab2" class="<?php echo $button; ?>"><?php _e('Recent', 'Creativo'); ?></a></li>
					<?php endif; ?>
                    <?php if($show_comments == 'true'): ?>
					<li class="<?php echo $border; ?>"><a href="#tab3" class="<?php echo $button; ?>"><?php _e('Comments', 'Creativo'); ?></a></li>
					<?php endif; ?>
                    
				</ul>
				<div class="tab-container <?php echo $border; ?>">
					<?php if($show_popular_posts == 'true'): ?>
					<div id="tab1" class="tab tab_content">
						<?php
						$popular_posts = new WP_Query('showposts='.$posts.'&orderby=comment_count&order=DESC');
						if($popular_posts->have_posts()): ?>
						
							<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>                             
								 <div class="latest-posts">
								<?php 
                                     if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
                                        <div class="latest-posts-thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related-img'); ?></a></div>
                                        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                        <span>Comments: <?php comments_popup_link('0', '1', '%'); ?></span>
                                         <div class="clr"></div>                         
                                     <?php 
                                    } 
									else{?>
                                    	<div class="latest-posts-thumb"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/no-image.jpg" /></a></div>
                                        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                        <span>Comments: <?php comments_popup_link('0', '1', '%'); ?></span>
                                        <div class="clr"></div> 
                                    <?php
									}
                                ?>
                                </div>                 
							<?php endwhile; ?>
                        
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if($show_recent_posts == 'true'): ?>
					<div id="tab2" class="tab tab_content">
						<?php
						$recent_posts = new WP_Query('showposts='.$recent);
						if($recent_posts->have_posts()):
						?>
						
							<?php while($recent_posts->have_posts()): $recent_posts->the_post(); ?>
							<div class="latest-posts">
								<?php 
                                     if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) { ?>
                                        <div class="latest-posts-thumb"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('related-img'); ?></a></div>
                                        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                        <span><?php the_time( get_option('date_format') ); ?></span>
                                         <div class="clr"></div>                         
                                     <?php 
                                    } 
									else{?>
                                    	<div class="latest-posts-thumb"><a href="<?php the_permalink(); ?>"><img src="<?php bloginfo( 'template_url' ); ?>/images/no-image.jpg" /></a></div>
                                        <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
                                        <span>Comments: <?php comments_popup_link('0', '1', '%'); ?></span>
                                        <div class="clr"></div> 
                                    <?php
									}
                                ?>
                                </div> 
							<?php endwhile; ?>
						
						<?php endif; ?>
					</div>
					<?php endif; ?>
                    <?php if($show_comments == 'true'): ?>
                    <div id="tab3" class="tab tab_content">                    	
                    		
							<?php
							
							$number = $instance['comments'];
							
							global $wpdb;
							
							$recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
							
							$the_comments = $wpdb->get_results($recent_comments);
							
							foreach($the_comments as $comment) { ?>
                            <div class="latest-posts">	
                                <div class="latest-comm-thumb"><a href="<?php echo get_permalink($comment->ID); ?>"><?php echo get_avatar($comment, '72'); ?></a></div>
                                	<h2><strong><?php echo strip_tags($comment->comment_author); ?> says:</strong></h2>
                                    <span><a class="comment-text-side" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo $comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo $comment->post_title; ?>"><?php echo string_limit_words(strip_tags($comment->com_excerpt), 32); ?>...</a></span>
                            	<div class="clr"></div>
                            </div>    
							<?php
							 
							}
							 
							?>
                            
                    	
                    </div>
                    <?php endif; ?>

				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['posts'] = $new_instance['posts'];
		$instance['comments'] = $new_instance['comments'];
		$instance['recent'] = $new_instance['recent'];
		
		$instance['color'] = $new_instance['color'];
		
		$instance['show_popular_posts'] = $new_instance['show_popular_posts'];
		$instance['show_recent_posts'] = $new_instance['show_recent_posts'];
		$instance['show_comments'] = $new_instance['show_comments'];
	
		
		return $instance;
	}

	function form($instance)
	{
		$defaults = array('posts' => 3, 'comments' => '3', 'recent' => 5, 'show_popular_posts' => 'on', 'show_recent_posts' => 'on', 'show_comments' => 'on', 'show_recent_posts' =>  'on');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e('Number of popular posts:','Creativo');?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('recent'); ?>"><?php _e('Number of recent posts:','Creativo');?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('recent'); ?>" name="<?php echo $this->get_field_name('recent'); ?>" value="<?php echo $instance['recent']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('comments'); ?>"><?php _e('Number of comments:','Creativo');?></label>
			<input class="widefat" style="width: 30px;" id="<?php echo $this->get_field_id('comments'); ?>" name="<?php echo $this->get_field_name('comments'); ?>" value="<?php echo $instance['comments']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('color'); ?>"><?php _e('Tabs color:','Creativo');?></label>
			
            <select id="<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('color'); ?>" class="widefat" style="width:100%;">
            	<option value="default" <?php selected('default', $instance['color']); ?>><?php _e('Default','Creativo');?></option>
 				<option value="green" <?php selected('green', $instance['color']); ?>><?php _e('Green','Creativo');?></option>
 				<option value="blue" <?php selected('blue', $instance['color']); ?>><?php _e('Blue','Creativo');?></option>
 				<option value="red" <?php selected('red', $instance['color']); ?>><?php _e('Red','Creativo');?></option>
                <option value="yellow" <?php selected('yellow', $instance['color']); ?>><?php _e('Yellow','Creativo');?></option>
                <option value="grey" <?php selected('grey', $instance['color']); ?>><?php _e('Grey','Creativo');?></option>
                <option value="black" <?php selected('dark', $instance['color']); ?>><?php _e('Black','Creativo');?></option>
                 <option value="purple" <?php selected('purple', $instance['color']); ?>><?php _e('Purple','Creativo');?></option>
 			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_popular_posts'); ?>" name="<?php echo $this->get_field_name('show_popular_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_popular_posts'); ?>"><?php _e('Show popular posts','Creativo');?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_recent_posts'); ?>" name="<?php echo $this->get_field_name('show_recent_posts'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_recent_posts'); ?>"><?php _e('Show recent posts','Creativo');?></label>
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo $this->get_field_id('show_comments'); ?>" name="<?php echo $this->get_field_name('show_comments'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_comments'); ?>"><?php _e('Show comments','Creativo');?></label>
		</p>
	<?php }
}
?>