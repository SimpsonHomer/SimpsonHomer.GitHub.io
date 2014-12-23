<!--BEGIN #searchform-->
<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<fieldset style="border:none;">
		<input type="text" name="s" id="s" value="<?php _e('To search type and hit enter', 'Creativo') ?>" onfocus="if(this.value=='<?php _e('To search type and hit enter', 'Creativo') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e('To search type and hit enter', 'Creativo') ?>';" />
	</fieldset>
<!--END #searchform-->
</form>