	<div class="mainbox" id="popup_domination_tab_results">
	<?PHP if(!empty($split['results'])): ?>
    <div class="holdall">
		<div id="graph-wrapper">
			<div class="line-chart chart-one">
				<h2>Analytic Data for Split Campaign : <?PHP echo $name; ?> (Conversions)</h2>
				<br/>
				<table id="data-table-two" style="display:none;" border="1" cellpadding="10" cellspacing="0" summary="Analytic Data for Split Campaign : ">
					<caption>&nbsp;</caption>
					<thead>
						<tr>
							<th></th>
							<?PHP $c = 0; ?>
							<?PHP foreach($split['results'] as $k => $rr): ?>
								<?PHP if(count($rr) > $c){
									$max = $k;
									$c = count($rr);
								}?>
							<?PHP endforeach; ?>
							<?PHP foreach($split['results'][$max] as $k => $rr):
								$k = date("F", mktime(0, 0, 0, $k)); ?>
								<th scope="col"><?PHP echo $k; ?></th>
							<?PHP endforeach; ?>
						</tr>
					</thead>
					<tbody>
						<?PHP $i= 0; foreach($split['results'] as $r): ?>
						<tr>
							<th scope="row"><?PHP echo $campname[$i][0]->campaign; ?></th>
							<?PHP foreach($r as $k=> $rr): ?>
								<td><?PHP echo intval($rr['optin']); ?></td>
							<?PHP endforeach; ?>
						</tr>
						<?PHP $i++; endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?PHP else: ?>
		<h2>There is No Analytic Data Yet.</h2>
	<?PHP endif; ?>
</div>