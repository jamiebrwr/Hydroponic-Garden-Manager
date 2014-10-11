<?php
/**
 * @package custody-agreements
 */
?>
<?php		 
$custom_field_keys = get_post_custom_keys();

//$ph_level = get_post_meta($post->ID, 'ecpt_ph_level', true);
//$ppm_level = get_post_meta($post->ID, 'ecpt_ppm_level', true);
//$ec_level = get_post_meta($post->ID, 'ecpt_ec_level', true);
//$tempature_level = get_post_meta($post->ID, 'ecpt_tempature_level', true);

//$chart_value = get_post_meta($post->ID, 'ecpt_environment_tempature_level', true);
//$chart_value = get_post_meta($post->ID, 'ecpt_humidity_level', true);
//$chart_value = get_post_meta($post->ID, 'ecpt_co_two_level', true);
//$chart_value = get_post_meta($post->ID, 'ecpt_plant_height', true);

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
							
							<?php
								foreach ( $custom_field_keys as $key => $value ) {
								    $valuet = trim($value);
								    if ( '_' == $valuet{0} )
								        continue;
								    $result = get_post_meta($post->ID,  $value , true); ?>
								    
								    <span class="sublabel"><?php the_title(); ?> - <?php echo $result;?></span>
									<div class="progress progress-sm">
										<div style="width: <?php echo $result;?>%" aria-valuemax="14" aria-valuemin="0" aria-valuenow="<?php echo $result;?>" role="progressbar" class="progress-bar progress-bar-primary"></div>
									</div><!-- progress -->
								<?php } ?>
			</div><!-- col-sm-4 -->
		</div><!-- row -->
	</div><!-- panel-body -->
</div><!-- panel -->
</div>

