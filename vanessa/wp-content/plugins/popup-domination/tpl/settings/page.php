<?PHP
/*
* page.php
*
* Page which holds all the information required for the settings tab
*/
?>
<div class="wrap" id="popup_domination">
	<?PHP 
	   $header_link = 'Support';
	   $header_url = $this->plugin_url.'http://popdom.desk.com/';
	   include $this->plugin_url.'tpl/header.php'; 
	?>
	</div>
	<form action="<?PHP echo $this->opts_url?>" method="post" id="popup_domination_form">
	<div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
	<div class="clear"></div>
	<div id="popup_domination_container" class="has-left-sidebar">
	<div style="display:none" id="popup_domination_hdn_div2"></div>
	<div class="mainbox" id="popup_domination_campaign_list">				
		<div class="newcampaign">
			<a class="green-btn" href="<?PHP echo 'admin.php?page='.$this->menu_url.'#'; ?>"><span>Submit New Request</span></a>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		
	</div>
	<div class="clearfix"></div>
</div>
<div id="popup_domination_form_submit">
	<div id="popup_domination_current_version">
		<p>You are currently running <strong>version <?PHP echo $this->version; ?></strong></p>
	</div>
        <?PHP wp_nonce_field('update-options'); ?>
	</form>
</div>
<script type="text/javascript">
var popup_domination_admin_ajax = '<?PHP echo admin_url('admin-ajax.php') ?>', popup_domination_theme_url = '<?PHP echo $this->theme_url ?>', popup_domination_form_url = '<?PHP echo $this->opts_url ?>', popup_domination_url = '<?PHP echo $this->plugin_url ?>', popup_domination_delete_table = 'ab';
</script>