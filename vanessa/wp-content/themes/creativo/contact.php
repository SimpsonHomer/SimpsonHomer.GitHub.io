<?php 
// Template Name: Contact Us
get_header(); ?>
<?php
//If the form is submitted
if(isset($_POST['submit'])) {
	//Check to make sure that the name field is not empty
	if(trim($_POST['contact_name']) == '' || trim($_POST['contact_name']) == 'Name (required)') {
		$hasError = true;
	} else {
		$name = trim($_POST['contact_name']);
	}

	//Check to make sure that the subject field is not empty
	if(trim($_POST['url']) == '' || trim($_POST['url']) == 'Subject (required)') {
		$hasError = true;
	} else {
		$subject = trim($_POST['url']);
	}

	//Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '' || trim($_POST['email']) == 'Email (required)')  {
		$hasError = true;
	} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	//Check to make sure comments were entered
	if(trim($_POST['comment']) == '' || trim($_POST['comment']) == 'Message') {
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comment']));
		} else {
			$comments = trim($_POST['comment']);
		}
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = get_post_meta($post->ID, 'pyre_email', true); //Put your own email address here
		$body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
		$headers = 'From: '.get_bloginfo('name').' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		$mail = wp_mail($emailTo, $subject, $body, $headers);
		
		$emailSent = true;
	}
}
?>

    
		<div class="row_full">
        	<?php if(is_page_template('contact.php') && get_post_meta($post->ID, 'pyre_gmap', true)): ?>
            <div id="contact_map">
                <iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo urlencode(get_post_meta($post->ID, 'pyre_gmap', true)); ?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo urlencode(get_post_meta($post->ID, 'pyre_gmap', true)); ?>&amp;t=m&amp;z=<?php echo get_post_meta($post->ID, 'pyre_zoom', true); ?>&amp;output=embed"></iframe>
            </div>     
            <?php endif; ?>
            <div class="row">
                <div class="<?php echo $outer_container; ?>" style="<?php echo $container; ?>">
                    <?php while(have_posts()): the_post(); ?>
                        <div class="blogpost">
                        <div class="post-content">
                            <?php the_content(); ?>
                            
                            <?php if(isset($hasError)) { //If errors are found ?>
                                <div class="alert error"><div class="msg"><?php _e("Please check if you've filed all the fields with valid information. Thank you.", 'Creativo'); ?></div></div>
                                <br />
                            <?php } ?>
            
                            <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
                                <p class="success-heading"><strong><?php _e('Email Successfully Sent!', 'Creativo'); ?></strong></p>
                                <div class="alert success"><div class="msg"><?php _e('Thank you', 'Creativo'); ?> <strong><?php echo $name;?></strong> <?php _e('for using my contact form! Your email was successfully sent!', 'Creativo'); ?></div></div>
                                
                            <?php } ?>
                        </div>
                        <div class="contact-form">
                        <form action="" method="post">                            
                                <div>        
                                    <input type="text" name="contact_name" id="author" value="<?php _e('Name (required)', 'Creativo'); ?>" size="22" tabindex="1" aria-required="true" class="input-name">        
                                    <input type="text" name="email" id="email" value="<?php _e('Email (required)', 'Creativo'); ?>" size="22" tabindex="2" aria-required="true" class="input-email">                            
                                    <input type="text" name="url" id="url" value="<?php _e('Subject', 'Creativo'); ?>" size="22" tabindex="3" class="final">                                
                                </div>                            
                                <div>                                
                                    <textarea name="comment" id="comment" cols="39" rows="8" tabindex="4" class="textarea-comment"><?php _e('Message', 'Creativo'); ?></textarea>                            
                                </div>                            
                                <div id="comment-submit">        
                                    <p><div><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Form', 'Creativo'); ?>" class="button small default"></div></p>			
                                </div>        
                        </form>
                        </div>
                    </div>
                    <?php endwhile; ?>
                 </div>
              </div>
             <div class="clr"></div>   
        </div>        
       <div class="clr"></div>		
<?php get_footer(); ?>