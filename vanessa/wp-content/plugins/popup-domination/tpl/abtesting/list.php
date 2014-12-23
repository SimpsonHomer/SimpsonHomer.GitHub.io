<?PHP
/*
* list.php
*
* PHP file used to display all current A/B campaigns
*/
?>
<div class="wrap" id="popup_domination">
	<?PHP
	$header_link = 'A/B Campaign Management';
	$header_url = '#';
	include $this->plugin_path.'tpl/header.php';
	?>
			
			
	<div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
	<div class="clear"></div>
	<div id="popup_domination_container" class="has-left-sidebar">
	<div style="display:none" id="popup_domination_hdn_div2"></div>
	<div class="mainbox" id="popup_domination_campaign_list">				
		<div class="newcampaign">
			<a class="green-btn" href="<?PHP echo 'admin.php?page='.$this->menu_url.'a-btesting&action=create'; ?>"><span>Create A/B Campaign</span></a>
			<p class="campaign-notice">You have <span id="row_count"><?PHP echo $count; ?></span> A/B campaign(s).</p>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<?PHP foreach($campaigns as $campaign): 
    		$campaign['previewurl'] = (!empty($campaign['previewurl'])) ? $campaign['previewurl'] : '';
		?>
		<div class="camprow" id="camprow_<?PHP echo $campaign['id']; ?>">
			<div class="tmppreview">
				<div class="preview_crop">
					<div class="spacing">
						<?PHP
							$campaign_count = count($campaign['campaigns']);
							$rand = rand(0, $campaign_count-1); ?>
						<div class="slider"><h2><?PHP echo $name; ?></h2></div>
						<img class="img" src="<?PHP echo $campaign['previewurl'][$rand]; ?>" />
					</div>
				</div>
			</div>
			<div class="namedesc">
				<a href="<?PHP echo 'admin.php?page='.$this->menu_url.'a-btesting&action=edit&id='.$campaign['id']; ?>"><?PHP echo $campaign['name']; ?></a><br/>
				<p class="description"><?PHP echo $campaign['description']; ?></p>
			</div>
			<ul class="actions">
				<li><a data-id="<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['name']; ?>" class="copy_button" href="#copy">Duplicate</a></li>
				<li><a data-id="<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['name']; ?>" class="toggle_button <?PHP echo (!$campaign['active']) ? 'on':'off';?>" href="#toggle"><?PHP echo (!$campaign['active']) ? "<span style='color:silver'>ON</span> | OFF":"ON | <span style='color:silver'>OFF</span>";?></a></li>
				<li><a data-id="<?PHP echo $campaign['id']; ?>" title="<?PHP echo $campaign['name']; ?>" class="deletecamp thedeletebutton" href="#deletecamp">Delete</a></li>
			</ul>
			
			<?PHP if(!empty($stats) || !empty($stats[0])): ?>
				<?PHP $stats = unserialize($c->astats);
    			$arr = 20;
    			$div = 100/5;
    			$percent = array();
        		foreach($stats as $k => $s){
        			if($s[date('m')]['optin'] == 0 || $s[date('m')]['show'] == 0){
    					$percent[$k]['percent'] = '0%';
    				}else{
        				$percent[$k]['percent'] = round((intval($s[date('m')]['optin']) / intval($s[date('m')]['show'])) * 100).'%';
        			}
    			}
    		?>
    		<div class="percentages">
    			<p class="sectitle">Template Conversion Percentage</p>                			
    			<?PHP $i = 0; foreach($percent as $k => $p): ?>
    				<div class="percent"><?PHP echo $tmpname[$i].' - <span class="numberper">'.$p['percent'].'</span>'; ?></div>
    			<?PHP $i++; endforeach; ?>
    		</div>
    		<?PHP endif; ?>
			<div class="clear"></div>
		</div>
		<?PHP endforeach; ?>
	</div>
	<?PHP
	$page_javascript = 'var popup_domination_delete_table = "ab", popup_domination_delete_stats = "";';
	include $this->plugin_path.'tpl/footer.php'; ?>
</div>