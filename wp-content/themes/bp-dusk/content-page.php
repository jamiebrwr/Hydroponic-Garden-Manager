<?php

$chart_value = get_post_meta($post->ID, 'ecpt_allottedhours', true);
$pickup_hour = get_post_meta($post->ID, 'ecpt_hour', true);
$drop_off_hour = get_post_meta($post->ID, 'ecpt_dropoffhour', true);
$pickup_minute = get_post_meta($post->ID, 'ecpt_minute', true);
$drop_off_minute = get_post_meta($post->ID, 'ecpt_dropoffminute', true);

$time_evaulation = new srhTime($chart_value,$pickup_hour,$pickup_minute, $drop_off_hour, $drop_off_minute,'','','','','','','');

$remaing_value = 100 - $final_time_value;
the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentytwelve' ) );
//wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) );
?>

<tr class="gradeA odd">
	<td style="width: 13%;"><?php the_date(); ?></td>
	<td style="width: 10%;" class="center">Tuesday</td>
	
	
	<!-- jQuery progress bar effect below -->
	
	<td style="width: 48%;" class="center ">
	<div id="progressbar" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo round($time_evaulation->setProperty()); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($time_evaulation->setProperty()); ?>%"><div class="progress-label">Loading...</div></div>
		<div class="progress progress-striped active">
				<div id="progressbar" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="<?php echo round($time_evaulation->setProperty()); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($time_evaulation->setProperty()); ?>%"></div>
				<span class="sr-only"><?php echo round($time_evaulation->setProperty()); ?>% Complete (success)</span>
		</div>
	</td>
	
	<!-- END jQuery progress bar effect -->
	
	
	
	<td style="width: 13%;" class="center"><?php echo $time_evaulation->_chart_value; ?></td>
	<td class="center "><?php echo date('g:i a',$time_evaulation->getTwelveHourPickUp()); ?></td>
	<td class="center "><?php echo date('g:i a',$time_evaulation->getTwelveHourDropOff()); ?></td>
</tr>
	
	


