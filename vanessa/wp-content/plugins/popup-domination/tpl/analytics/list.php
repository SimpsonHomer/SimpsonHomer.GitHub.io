<div class="wrap" id="popup_domination">
	<?PHP
	$header_link = 'Go To Campaigns';
	$header_url = 'admin.php?page=popup-domination/campaigns';
	require $this->plugin_path.'tpl/header.php';
	?>
	<div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
	<div class="clear"></div>
	<div id="popup_domination_container" class="has-left-sidebar">
	<div style="display:none" id="popup_domination_hdn_div2"></div>
	<div class="mainbox" id="popup_domination_campaign_list">
		<div class="clear"></div>
		<?PHP foreach ($data as $campaign):?>
		<div class="camprow">
			<div class="tmppreview">
				<div class="preview_crop">
					<div class="spacing">
						<div class="slider"><h2><?PHP echo $temppreview; ?></h2></div>
						<img src="<?PHP echo $previewurl[$campaign->id]; ?>" height="<?PHP echo $height[$campaign->id]; ?>" width="<?PHP echo $width[$campaign->id]; ?>" />
					</div>
				</div>
			</div>
			<div class="namedesc">
				<a href="<?PHP echo 'admin.php?page='.$this->menu_url.'analytics&id='.$campaign->id; ?>"><?PHP echo $campaign->campaign; ?></a><br/>
				<p class="description"><?PHP echo $campaign->desc; ?></p>
			</div>
			<div class="current_analytics">
				<?PHP
				$analytics = unserialize($campaign->analytics);
				$year = date('Y'); $month = date('m');
				$thismonth = (isset($analytics[$year][$month]) ? $analytics[$year][$month] : 0);
				$percent = array();
				if($thismonth['conversions'] != 0 && $thismonth['views'] != 0){
					$percent = round((intval($thismonth['conversions']) / intval($thismonth['views'])) * 100).'%';
				}else{
					$percent = '0%';
				}
				?>
				<span class="percent_converse"><?PHP echo $percent;?><br/><span class="smaller">Conversion rate this month</span></span>
			</div>
			<div class="actions">
		       	<?PHP
		       	$has_previous = false;
		       	$monthcount = 0;
		       	$yearcount = count($analytics);
		       	if ($yearcount > 0){
			       	$monthcount += count($analytics[$year]);
			       	if ($monthcount > 1){
				       	$has_previous = true;
			       	}
		       	}
		       	$i = 1; $total = 0;
		       	$recorded = 1;
		       	if($has_previous){
		       		while($i <= 5){
		       			$time = strtotime("-$i month");
		       			$month = date('m', $time);
			       		if ($month != 12){
				       		if (is_array($analytics[$year]) && array_key_exists($month, $analytics[$year])){
				       			$views = $analytics[$year][$month]['views'];
				       			$conversions = $analytics[$year][$month]['conversions'];
				       			if ($views != 0){
					       			$total += abs(round(100 * intval($conversions) / intval($views)));
				       			}
				       			$recorded = $i;
				       		}
			       		} else {
			       			$time = strtotime('-1 year');
				       		$year = date('Y', $time);
			       		}
			       		$i++;
		       		}
		       		$average = abs(round($total / $recorded));
			       	if (($percent - $total) > 0){
				       	echo '<span class="green">'.$average.'%';
						echo '&uarr;</span>';
			       	} else {
				       	echo '<span class="red">'.$average.'%';
						echo '&darr;</span>';
			       	}
			       	echo '<br/><br/><span class="smaller">Compared to previous months average</span>';
		       	} else {
			       	echo '<span class="smaller">No Previous Data</span>';
		       	}
				?>
			</div>
			<div class="clear"></div>
		</div>
	<?PHP endforeach; ?>
	<div class="camprow">How would these figures look with <a href="<?PHP echo 'admin.php?page='.$this->menu_url.'theme_upload#themebuy' ?>">another theme</a>?</div>
	</div>
	<div class="clearfix"></div>
	<?PHP
	$page_javascript = '';
	$page_javascript = 'var popup_domination_delete_table = "campaigns", popup_domination_delete_stats = "analytics";';
	include $this->plugin_path.'tpl/footer.php'; ?>
</div>