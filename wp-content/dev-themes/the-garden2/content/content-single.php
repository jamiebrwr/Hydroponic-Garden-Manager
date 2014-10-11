<?php
/**
 * @package custody-agreements
 */
?>


			<?php
			$chart_value = get_post_meta($post->ID, 'ecpt_allottedhours', true);
			$pickup_hour = get_post_meta($post->ID, 'ecpt_hour', true);
			$drop_off_hour = get_post_meta($post->ID, 'ecpt_dropoffhour', true);
			$pickup_minute = get_post_meta($post->ID, 'ecpt_minute', true);
			$drop_off_minute = get_post_meta($post->ID, 'ecpt_dropoffminute', true);
			//echo $date = date('F j, Y g:i a',get_post_meta($post->ID, 'ecpt_date', true));
			$time_evaulation = new srhTime($chart_value,$pickup_hour,$pickup_minute, $drop_off_hour, $drop_off_minute,'','','','','','','');
			?>
			
		

			<?php
			$remaing_value = 100 - $time_evaulation->setProperty();
			$xtime = $time_evaulation->setProperty();
			$string = str_replace(array(' ','-'), '', $post->post_name);
			
			$res1 = ($pickup_hour / $drop_off_hour) * 100;
			$res = ($pickup_hour / $drop_off_hour) * 100;
			
			$res3 = $drop_off_hour-$pickup_hour;
			if ( 4 == $res3 ){
				$res4 = 100;
			} elseif ( 3 == $res3 ){
				$res4 = 75;
			} elseif ( 2 == $res3 ){
				$res4 = 50;
			} elseif ( 1 == $res3 ){
				$res4 = 25;
			} else {
				
			}
		?>

		<div class="col-sm-8 col-md-9">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-sm-8">
						<h5 class="subtitle mb5">Visitation Stats</h5>
						<p class="mb15">visitation stats for a particular day...</p>
						<div id="basicflot" style="width: 100%; height: 300px; margin-bottom: 20px; padding: 0px; position: relative;">
							<canvas class="flot-base" width="540" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 540px; height: 300px;"></canvas>
							<div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
								<div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 29px; text-align: center;">Sunday</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 111px; text-align: center;">Monday</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 193px; text-align: center;">Tuesday</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 275px; text-align: center;">Wednesday</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 357px; text-align: center;">Thursday</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 439px; text-align: center;">Friday</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; max-width: 77px; top: 278px; left: 521px; text-align: center;">Saturday</div>
							</div>
							<div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;">
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 258px; left: 9px; text-align: right;">0.0</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 215px; left: 9px; text-align: right;">2.5</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 172px; left: 9px; text-align: right;">5.0</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 129px; left: 9px; text-align: right;">25</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 86px; left: 1px; text-align: right;">50</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 43px; left: 1px; text-align: right;">75</div>
								<div class="flot-tick-label tickLabel" style="position: absolute; top: 1px; left: 1px; text-align: right;">100</div>
							</div>
						</div>
						
						<canvas class="flot-overlay" width="540" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 540px; height: 300px;"></canvas>
						<div class="legend">
							<div style="position: absolute; width: 79px; height: 42px; top: 16px; left: 43px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div>
							<table style="position:absolute;top:16px;left:43px;;font-size:smaller;color:#545454">
								<tbody>
									<tr>
										<td class="legendColorBox">
											<div style="border:1px solid #ccc;padding:1px">
												<div style="width:4px;height:0;border:5px solid #1CAF9A;overflow:hidden"></div>
											</div>
										</td>
										<td class="legendLabel">Uploads</td>
									</tr>
								<tr>
									<td class="legendColorBox">
										<div style="border:1px solid #ccc;padding:1px">
											<div style="width:4px;height:0;border:5px solid #428BCA;overflow:hidden"></div>
										</div>
									</td>
									<td class="legendLabel">Downloads</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div><!-- col-sm-8 -->
			
			<div class="col-sm-4">
				<h5 class="subtitle mb5">Server Status</h5>
				<p class="mb15">Summary of the status of your server.</p>
				
				<span class="sublabel">Actual Time (<?php echo $res4; ?>% - <?php echo $res3; ?> hours)</span>
				<div class="progress progress-sm">
					<div style="width: <?php echo $res4; ?>%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-primary"></div>
				</div><!-- progress -->
				
				<span class="sublabel">Memory Usage (32.2%)</span>
				<div class="progress progress-sm">
					<div style="width: 32%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
				</div><!-- progress -->
				
				<span class="sublabel">Disk Usage (82.2%)</span>
				<div class="progress progress-sm">
					<div style="width: 82%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-danger"></div>
				</div><!-- progress -->
				
				<span class="sublabel">Databases (63/100)</span>
				<div class="progress progress-sm">
					<div style="width: 63%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-warning"></div>
				</div><!-- progress -->
				
				<span class="sublabel">Domains (2/10)</span>
				<div class="progress progress-sm">
					<div style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
				</div><!-- progress -->
				
				<span class="sublabel">Email Account (13/50)</span>
				<div class="progress progress-sm">
					<div style="width: 26%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success"></div>
				</div><!-- progress -->
				
			</div><!-- col-sm-4 -->
		</div><!-- row -->
	</div><!-- panel-body -->
</div><!-- panel -->
</div>

