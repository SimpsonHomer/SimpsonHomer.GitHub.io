<?PHP

/**
* page.php
*
* Template - This loads and displays all the fields and setup options for creating and editing campaigns.
*
* This holds the basic structure of the Campaign page
*/

?>
<?PHP if($this->success): ?>
<div id="message" class="updated"><p>Your Settings have been <strong>Saved</strong></p></div>
<?PHP endif; ?>
<div class="wrap with-sidebar" id="popup_domination">
	<?PHP
	$header_link = 'Back to Campaign Management';
	$header_url = 'admin.php?page=popup-domination/campaigns';
	include $this->plugin_path.'tpl/header.php';
	?>
	<form action="<?PHP echo $this->opts_url?>" method="post" id="popup_domination_form">
		<div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
		<div class="clear"></div>
		<div id="popup_domination_container" class="has-left-sidebar">
		<div style="display:none" id="popup_domination_hdn_div2"></div>
		
		
		<?PHP include $this->plugin_path.'tpl/promote/tabs.php'; ?>
		
		<div class="notices" style="display:none;">
			<p class="message"></p>
		</div>
		<div class="flotation-device">
			<?PHP include $this->plugin_path.'tpl/promote/promote.php'; ?>
		</div>
	
	
		<?PHP if(isset($camp_id)){ $disabled = ''; }else{ $disabled = 'style="display:none"';}
		$save_button = '<input class="savecamp save-btn" type="submit" name="update" value="'.__('Save Changes', 'popup_domination').'" />';
		include $this->plugin_path.'tpl/footer.php'; ?>
	</form>
</div>