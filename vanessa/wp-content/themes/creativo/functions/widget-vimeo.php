<?php

/*-----------------------------------------------------------------------------------

 	Plugin Name: Custom Video Widget
 	Plugin URI: http://www.premiumpixels.com
 	Description: A widget that displays your latest video
 	Version: 1.0
 	Author: Orman Clark
 	Author URI: http://www.premiumpixels.com
 
-----------------------------------------------------------------------------------*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'vimeo_widgets' );

// Register widget
function vimeo_widgets() {
	register_widget( 'vimeo_Widget' );
}

// Widget class
class vimeo_widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function vimeo_Widget() {

	// Widget settings
	$widget_ops = array(
		'classname' => 'vimeo_widget',
		'description' => __('A widget that displays your favorite Vimeo Video. ', 'Creativo')
	);

	// Widget control settings
	$control_ops = array(
		'width' => 300,
		'height' => 350,
		'id_base' => 'vimeo_widget'
	);

	/* Create the widget. */
	$this->WP_Widget( 'vimeo_widget', __('Custom Vimeo Video Widget', 'Creativo'), $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$id = $instance['id'];
	$desc = $instance['desc'];

	// Before widget (defined by theme functions file)
	echo $before_widget;

	// Display the widget title if one was input
	if ( $title )
		echo $before_title . $title . $after_title;

	// Display video widget
	?>
		
		<div class="video-container">
		<?php echo do_shortcode('[vimeo id="'.$id.'"]'); ?>
		</div>
		<?php if($desc != '') : ?>
		<p><?php echo $desc ?></p>
        <?php endif; ?>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['desc'] = stripslashes( $new_instance['desc']);
	$instance['id'] = stripslashes( $new_instance['id']);

	// No need to strip tags

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array(
		'title' => 'Vimeo Video',
		'id' => '51378164',
		'desc' => 'Check out my latest Vimeo video. Like it? Share it!',
	);
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'Creativo') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<!-- Vimeo ID: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'id' ); ?>"><?php _e('Vimeo ID:', 'Creativo') ?></label>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'id' ); ?>" name="<?php echo $this->get_field_name( 'id' ); ?>" value="<?php echo $instance['id']; ?>" />
		
	</p>
	
	<!-- Description: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Short Description:', 'Creativo') ?></label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['desc'] ), ENT_QUOTES)); ?>" />
	</p>
		
	<?php
	}
}
?>