<?PHP

/**
* page.php
*
* Template - This template is used to display all the analytic data for a campaign.
*/

$lastmonth = 0;
?>

<div class="wrap wider" id="popup_domination">
	<?PHP
	$header_link = 'Back to Analytics Menu';
	$header_url = 'admin.php?page=popup-domination/analytics';
	include $this->plugin_path.'tpl/header.php';
	?>
	<div style="display:none" id="popup_domination_hdn_div"><?PHP echo $fields?></div>
	<div class="clear"></div>
	<div id="popup_domination_container" class="has-left-sidebar">
		<div style="display:none" id="popup_domination_hdn_div2"></div>
		<div id="graph-wrapper">
			<div class="chart">
			<br/><br/>
				<h2>Current Month's Analytic Data for Campaign : <?PHP echo $campaign_name; ?></h2>
				<br/>
				<table style="display:none" id="data-table" border="1" cellpadding="10" cellspacing="0" summary="Current Month's Analytic Data for Campaign :">
					<tbody>
						<tr>
							<th scope="row">Views</th>
							<td><?PHP echo intval($months_views); ?></td>
						</tr>
						<tr>
							<th scope="row">Conversions</th>
							<td><?PHP echo intval($months_conversions); ?></td>
						</tr>
					</tbody>
				</table>
			</div>
			<?PHP $has_previous = true;
		       	$yearcount = count($analytics);
		       	if ($yearcount == 1){
			       	$monthcount = count($analytics[$year]);
			       	if ($monthcount == 1){
				       	$has_previous = false;
			       	}
		       	}
		       	if($has_previous && false):
		       		$monthsviews = 0; $monthsconv = 0 ?>
				<div class="charttwo">
				<br/><br/>
					<h2>Last 5 Month's Analytic Data for Campaign : <?PHP echo $campaign_name; ?></h2>
					<br/>
					<table id="data-table-two" style="display:none;" border="1" cellpadding="10" cellspacing="0" summary="Current Month's Analytic Data for Campaign :">
						<thead>
							<tr>
								<th></th>
							<?PHP foreach($previous_data as $month => $stats): ?>
								<th scope="col"><?PHP echo $month; ?></th>
							<?PHP endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Views</th>
								<?PHP foreach($previous_data as $stats): ?>
									<td><?PHP echo intval($stats['views']); ?></td>
								<?PHP endforeach; ?>
							</tr>
							<tr>
								<th scope="row">Conversions</th>
								<?PHP $avg = 0; $c = 0; foreach($previous_data as $stats): ?>
									<td><?PHP echo intval($stats['conversions']); ?></td>
									<?PHP $monthsconv = $monthsconv + intval($stats['conversions']);
									$monthsviews = $monthsviews + intval($stats['views']);
									$lstavg = (intval($monthsviews) != 0) ? round((intval($monthsconv) / intval($monthsviews)) * 100) : 0;
									$avg += $lstavg; $c++;
									endforeach; ?>
							</tr>
						</tbody>
					</table>
				</div>
			<?PHP endif; ?>
			
			
			<?PHP
				$all_months = array(); $all_views = array(); $all_conversions = array();
		       	$has_previous = false;
		       	$yearcount = count($analytics);
		       	if ($yearcount >= 1){
			       	$monthcount = count($analytics[$year]);
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
		       			$all_months[] = date('F', $time);
			       		if ($month != 12){
			       			$views = 0; $conversions = 0;
				       		if (is_array($analytics[$year]) && array_key_exists($month, $analytics[$year])){
				       			$views = $analytics[$year][$month]['views'];
				       			$conversions = $analytics[$year][$month]['conversions'];
				       			if ($views != 0){
					       			$total += abs(round(100 * intval($conversions) / intval($views)));
					       			if ($i == 1){
						       			$lastmonth = $total;
					       			}
				       			}
				       			$recorded = $i;
				       		}
				       		$all_views[] = $views;
				       		$all_conversions[] = $conversions;
				       	} else {
			       			$time = strtotime('-1 year');
				       		$year = date('Y', $time);
				       		//$i--;
			       		}
			       		$i++;
		       		}
		       		$average = abs(round($total / $recorded)); ?>
		       	
		       	<div class="charttwo">
					<br/><br/>
					<h2>Last 5 Month's Analytic Data for Campaign : <?PHP echo $campaign_name; ?></h2>
					<br/>
					<table id="data-table-two" style="display:none;" border="1" cellpadding="10" cellspacing="0" summary="Current Month's Analytic Data for Campaign :">
						<thead>
							<tr>
								<th></th>
							<?PHP foreach($all_months as $month): ?>
								<th scope="col"><?PHP echo $month; ?></th>
							<?PHP endforeach; ?>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">Views</th>
								<?PHP foreach($all_views as $view): ?>
									<td><?PHP echo $view; ?></td>
								<?PHP endforeach; ?>
							</tr>
							<tr>
								<th scope="row">Conversions</th>
								<?PHP foreach($all_conversions as $conversion): ?>
									<td><?PHP echo $conversion; ?></td>
								<?PHP endforeach; ?>
							</tr>
						</tbody>
					</table>
				</div>
		       	<?PHP } ?>
		       	
				
				
				
				
				
			<div class="averages">
				<div class="percent">
					<?PHP $math = (intval($months_views) == 0) ? 0: round((intval($months_conversions) / intval($months_views)) * 100); ?>
					<h2>Conversion Percentage:</h2>
					<?PHP $class = $math <= $lastmonth ? 'red': 'green'; ?>
					<h1 class="<?PHP echo $class; ?>"><?PHP echo $math.'%'; ?></h1>
				</div>
			<?PHP if($has_previous): ?>
				<div class="lst-average">
					<h2>Last Month's Conversion Percentage</h2>
					<center><h1><?PHP echo round($lastmonth).'%';?></h1></center>
				</div>
				<div class="average-percent">
					<h2>Last 5 Months Average Conversion</h2>
					<center><h1><?PHP echo $average.'%';?></h1></center>
				</div>
			<?PHP endif; ?>
			</div>
		</div>
	<?PHP include $this->plugin_path . 'tpl/footer.php'; ?>
</div>