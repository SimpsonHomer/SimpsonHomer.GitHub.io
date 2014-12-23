<?php
add_action('widgets_init', 'contact_info_load_widgets');

function contact_info_load_widgets()
{
	register_widget('Contact_Info_Widget');
}

class Contact_Info_Widget extends WP_Widget {
	
	function Contact_Info_Widget()
	{
		$widget_ops = array('classname' => 'contact_info', 'description' => __('Easily add yout contact info', 'Creativo'));

		$control_ops = array('id_base' => 'contact_info-widget');

		$this->WP_Widget('contact_info-widget', __('Contact us widget', 'Creativo'), $widget_ops, $control_ops);
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
        <div class="contact">
            <ul>
				<?php if($instance['address']): ?>
                <li class="address"><?php echo $instance['address']; ?></li>
                <?php endif; ?>
        
                <?php if($instance['phone']): ?>
                <li class="phone"><?php _e('Phone:', 'Creativo'); ?><?php echo $instance['phone']; ?><br /><?php if($instance['fax']): ?><?php _e('Fax:', 'Creativo'); ?><?php echo $instance['fax']; ?><?php endif; ?></li>
                <?php endif; ?>                
        
                <?php if($instance['email']): ?>
                <li class="email"><?php _e('Email:', 'Creativo'); ?> <a href="mailto:<?php echo $instance['email']; ?>"><?php echo $instance['email']; ?></a><br /><?php if($instance['web']): ?>
                	<?php _e('Web:', 'Creativo'); ?> <a href="<?php echo $instance['web']; ?>"><?php echo $instance['web']; ?></a><?php endif; ?></li>
                <?php endif; ?>  
            </ul>
        </div>
		<?php
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['address'] = $new_instance['address'];
		$instance['phone'] = $new_instance['phone'];
		$instance['fax'] = $new_instance['fax'];
		$instance['email'] = $new_instance['email'];
		$instance['web'] = $new_instance['web'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Contact Info');
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'Creativo');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('address'); ?>"><?php _e('Address:', 'Creativo');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('address'); ?>" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $instance['address']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('phone'); ?>"><?php _e('Phone:', 'Creativo');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('phone'); ?>" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $instance['phone']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('fax'); ?>"><?php _e('Fax:', 'Creativo');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $instance['fax']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('email'); ?>"><?php _e('Email:', 'Creativo');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('email'); ?>" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $instance['email']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('web'); ?>"><?php _e('Website URL:', 'Creativo');?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('web'); ?>" name="<?php echo $this->get_field_name('web'); ?>" value="<?php echo $instance['web']; ?>" />
		</p>
	<?php
	}
}
?>