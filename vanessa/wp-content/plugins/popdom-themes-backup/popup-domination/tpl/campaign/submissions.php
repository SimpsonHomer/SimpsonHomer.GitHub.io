<div class="mainbox" id="popup_domination_tab_submissions" style="display:none;">
	<div class="popdom_contentbox the_help_box">
		<h3 class="help">Help</h3>
		<div class="popdom_contentbox_inside">
			<p><strong>Set up your campaign with alternative mailing lists.</strong></p>
			<p>If you are experiencing problems with your popup, please have a look at our help articles at:</p>
			<p><a href="https://popdom.assistly.com/">our Assistly Help Area.</a></p>
		</div>
	</div>
	<div class="inside twomaindivs">
		<div class="the_content_box">
			<div class="popdom_contentbox" style="margin-left:0px;">
				<div class="popdom_contentbox_inside" id="submissions_tab">
                                    
                <div class="aff-images">
                    <a href="http://www.incomediary.com/go/aweber" target="_blank"><img src="<?PHP echo $this->plugin_url.'images/aweber.jpg' ;?>" alt=""/></a>
                    <a href="https://signup.ontraport.com/index.php?orid=488233&opid=29" target="_blank"><img src="<?PHP echo $this->plugin_url.'images/ontraport.jpg' ;?>" alt=""/></a>
                </div>
					<div id="mailing_lists">
						<h3>Please select the Mailing List you would like to configure the pop up with</h3>
						<?PHP $lists = $this->get_mailing_lists(); ?>
						<select id="mailing_list" name="popup_domination_mailing[mailing_option]">
							<option value="-1">None required</option>
							<?PHP foreach($lists as $id => $name):
									if (!empty($mailing['id']) && $id == $mailing['id']):?>
							<option value="<?PHP echo $id; ?>" selected="selected"><?PHP echo $name; ?></option>
									<?PHP else: ?>
							<option value="<?PHP echo $id; ?>"><?PHP echo $name; ?></option>
									<?PHP endif; ?>
							<?PHP endforeach; ?>
						</select>
						<span class="example">
						  You will need to select a mailing list before you can start receiving opt-ins.
						  <br/>Need a new mailing list? <a href="/wp-admin/admin.php?page=popup-domination/mailinglist&action=create" target="_blank">Set one up.</a>
						</span>
					</div>
					<div id="redirect_option" <?PHP echo (!empty($mailing['id']) && $mailing['id'] != -1) ? 'style="display:none;"' : ''; ?>>
						<h3>Where would you like submissions to be directed to?</h3>
						<input type="text" id="redirect_url" name="popup_domination_mailing[redirect_url]" value="<?PHP echo (!empty($mailing['redirect_url'])) ? $mailing['redirect_url'] : '';?>" placeholder="Enter the URL here..." /><br>
						<labeL>New window/tab?<input type="checkbox" id="submit_new_window" name="popup_domination_mailing[new_window]" value="true" <?PHP echo (!empty($mailing['new_window'])) ? 'checked' : '';?> /></labeL>
					</div>
					<div id="mail_notify_option" >
  					<br/>
						<label for="mail_notify">Enter an email address here if you'd like to receive an email on each opt-in:</label>
						<input type="text" id="mail_notify" name="popup_domination_mailing[mail_notify]" value="<?PHP echo (!empty($mailing['mail_notify'])) ? $mailing['mail_notify']:'';?>" />
						
				    <br/>
						<label for="google_goal">Do you have a google goal code? ( for example... <code>_gaq.push(['_trackPageview', '/thank-you.html'])</code> )</label>
						<input type="text" id="google_goal" name="popup_domination_mailing[google_goal]" value="<?PHP echo (!empty($mailing['google_goal'])) ? $mailing['google_goal']:'';?>" />

						<!--<pre><?PHP print_r($mailing) ?></pre>-->
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>