<?PHP
/*
* list.php
*
* PHP file used to display all current campaigns
*/
?>

<div class="wrap" id="popup_domination">
	<?PHP
    	$header_link = 'Mailing Configurations';
    	$header_url = '#';
    	include $this->plugin_path.'tpl/header.php';
	?>
	<div style="display:none" id="popup_domination_hdn_div"><?PHP echo isset($fields) ? $fields : ''; ?></div>
	<div class="clear"></div>
	<div id="popup_domination_container" class="has-left-sidebar">
	<div style="display:none" id="popup_domination_hdn_div2"></div>
	<div class="mainbox" id="popup_domination_campaign_list">
	
        <div class="popdom_contentbox the_help_box">
            <h3 class="help">Help</h3>
            <div class="popdom_contentbox_inside">
                <p><strong>How to first set up your PopUp Domination</strong></p>
                <iframe width="560" height="315" src="//www.youtube.com/embed/LKNM6enZysU?html5=1" frameborder="0" allowfullscreen></iframe>
                <p>Use the buttons below to create new mailing lists</p>
                <ul>
                    <li>Mailing Lists are required to collect email addresses.</li>
                    <li>If you don't have a mailing list you won't have any form fields on your popup.</li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
	
		<div class="newcampaign">
			<a class="green-btn" href="<?PHP echo 'admin.php?page='.$this->menu_url.'mailinglist&amp;action=create'; ?>"><span>Create New Mailing Configuration</span></a>
			<p class="campaign-notice">You have <span id="row_count"><?PHP echo $count; ?></span> mailing provider(s).</p>
			<div class="clear"></div>
		</div>
                <div class="aff-images">
                    <a href="http://www.incomediary.com/go/aweber" target="_blank"><img src="<?PHP echo $this->plugin_url.'images/aweber.jpg' ;?>" alt=""/></a>
                    <a href="https://signup.ontraport.com/index.php?orid=488233&opid=29" target="_blank"><img src="<?PHP echo $this->plugin_url.'images/ontraport.jpg' ;?>" alt=""/></a>
                </div>
		<div class="clear"></div>
		<?PHP foreach ($mailing_configs as $config): ?>
			<div class="camprow" id="camprow_<?PHP echo $config['id']; ?>" title="<?PHP echo $config['name']; ?>">
				<div class="tmppreview">
					<div class="preview_crop">
						<div class="spacing">
							<?PHP
							$alt = '';
							
							if($config['provider'] == 'mc'){
								$logo = $this->plugin_url.'css/img/mailchimp_preview.png';
							}else if($config['provider'] == 'aw'){
								$logo = $this->plugin_url.'css/img/aweber_preview.png';
							}else if($config['provider'] == 'ic'){
								$logo = $this->plugin_url.'css/img/icontact_preview.png';
							}else if($config['provider'] == 'cc'){
								$logo = $this->plugin_url.'css/img/constant_preview.png';
							}else if($config['provider'] == 'cm'){
								$logo = $this->plugin_url.'css/img/campaign_preview.png';
							}else if($config['provider'] == 'gr'){
								$logo = $this->plugin_url.'css/img/response_preview.png';
							}else if($config['provider'] == 'nm'){
								$logo = $this->plugin_url.'css/img/email.png';
								$alt = 'Send to Email';
							}else if ($config['provider'] == 'form'){
								$logo = $this->plugin_url.'css/img/htmlform.png';
								$alt = 'HTML Form Code';
							} else {
								$logo = '#';
								$alt = "Could not find a logo";
							} 
							?>
							<div class="slider"><h2><?PHP echo $config['provider']; ?></h2></div>
							<img class="img" id="logo_<?PHP echo $config['id']; ?>" src="<?PHP echo $logo; ?>" alt="<?PHP echo $alt; ?>" />
						</div>
					</div>
				</div>
				<div class="namedesc">
					<a href="<?PHP echo 'admin.php?page='.$this->menu_url.'mailinglist&amp;action=edit&amp;id='.$config['id']; ?>"><?PHP echo $config['name']; ?></a><br/>
					<p class="description"><?PHP echo $config['description']; ?></p>
				</div>
				<ul class="actions">
					<li><a href="#copy" class="copy_button" title="<?PHP echo $config['name']; ?>" data-id="<?PHP echo $config['id']; ?>">Duplicate</a></li>
					<li><a data-id="<?PHP echo $config['id']; ?>" title="<?PHP echo $config['name']; ?>" class="deletecamp thedeletebutton" href="#deletecamp">Delete</a></li>
				</ul>
				<div class="clear"></div>
			</div>
		<?PHP endforeach; ?>
		</div>
	<div class="clearfix"></div>
	<?PHP
	$page_javascript = 'var popup_domination_delete_table = "mailing", popup_domination_delete_stats = "";';
	include $this->plugin_path.'tpl/footer.php'; ?>
</div>
