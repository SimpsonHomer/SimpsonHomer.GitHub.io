<?php
add_action('widgets_init', 'social_links_load_widgets');

function social_links_load_widgets()
{
	register_widget('Social_Links_Widget');
}

class Social_Links_Widget extends WP_Widget {
	
	function Social_Links_Widget()
	{
		$widget_ops = array('classname' => 'social_links', 'description' => __('Add your social links ','Creativo'));

		$control_ops = array('id_base' => 'social_links-widget');

		$this->WP_Widget('social_links-widget', __('Social Links','Creativo'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		?>
		<ul class="get_social center">
			
			<?php if($instance['fb_link']): ?>
				<li><a class="fb" href="<?php echo $instance['fb_link']; ?>" target="_blank"><span><?php _e('Follow on Facebook','Creativo');?></span></a></li>		
			<?php endif; ?>
            
			<?php if($instance['twitter_link']): ?>
            	<li><a class="tw" href="<?php echo $instance['twitter_link']; ?>" target="_blank"><span><?php _e('Follow on Twitter','Creativo');?></span></a></li>
			<?php endif; ?>			
			
			<?php if($instance['linkedin_link']): ?>
				<li><a class="lnk" href="<?php echo $instance['linkedin_link']; ?>" target="_blank"><span><?php _e('Follow on LinkedIn','Creativo');?></span></a></li>
			<?php endif; ?>
			
			<?php if($instance['tumblr_link']): ?>
				<li><a class="tu" href="<?php echo $instance['tumblr_link']; ?>" target="_blank"><span><?php _e('Follow on Tumblr','Creativo');?></span></a></li>
			<?php endif; ?>
            
			<?php if($instance['reddit_link']): ?>
				<li><a class="rd" href="<?php echo $instance['reddit_link']; ?>" target="_blank"><span><?php _e('Follow on Reddit','Creativo');?></span></a></li>
			<?php endif; ?>		
			
            <?php if($instance['google_link']): ?>
				<li><a class="gp" href="<?php echo $instance['google_link']; ?>" target="_blank"><span><?php _e('Follow on Google+','Creativo');?></span></a></li>
			<?php endif; ?>
            
            <?php if($instance['youtube_link']): ?>
				<li><a class="yt" href="<?php echo $instance['youtube_link']; ?>" target="_blank"><span><?php _e('Follow on Youtube','Creativo');?></span></a></li>
			<?php endif; ?>
		</ul>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['fb_link'] = $new_instance['fb_link'];
		$instance['twitter_link'] = $new_instance['twitter_link'];
		$instance['google_link'] = $new_instance['google_link'];
		$instance['linkedin_link'] = $new_instance['linkedin_link'];
		$instance['tumblr_link'] = $new_instance['tumblr_link'];
		$instance['reddit_link'] = $new_instance['reddit_link'];
		$instance['youtube_link'] = $new_instance['youtube_link'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Social Links');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','Creativo');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fb_link'); ?>"><?php _e('Facebook Link:','Creativo');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('fb_link'); ?>" name="<?php echo $this->get_field_name('fb_link'); ?>" type="text" value="<?php echo $instance['fb_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e('Twitter Link:','Creativo');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo $instance['twitter_link']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('linkedin_link'); ?>"><?php _e('LinkedIn Link:','Creativo');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" type="text" value="<?php echo $instance['linkedin_link']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('reddit_link'); ?>"><?php _e('Reddit Link:','Creativo');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('reddit_link'); ?>" name="<?php echo $this->get_field_name('reddit_link'); ?>" type="text" value="<?php echo $instance['reddit_link']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('tumblr_link'); ?>"><?php _e('Tumblr Link:','Creativo');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('tumblr_link'); ?>" name="<?php echo $this->get_field_name('tumblr_link'); ?>" type="text" value="<?php echo $instance['tumblr_link']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('google_link'); ?>"><?php _e('Google+ Link:','Creativo');?></label>
			<input class="widefat"  id="<?php echo $this->get_field_id('google_link'); ?>" name="<?php echo $this->get_field_name('google_link'); ?>" type="text" value="<?php echo $instance['google_link']; ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id('youtube_link'); ?>"><?php _e('Youtube Link:','Creativo');?></label>
			<input class="widefat"  id="<?php echo $this->get_field_id('youtube_link'); ?>" name="<?php echo $this->get_field_name('youtube_link'); ?>" type="text" value="<?php echo $instance['youtube_link']; ?>" />
		</p>
	<?php
	}
}
?>