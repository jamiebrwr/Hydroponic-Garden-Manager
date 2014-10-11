<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package custody-agreements
 */
?>
<?php
$monetary_value_max = get_post_meta($post->ID, 'ecpt_total_amount_of_expense', true);
$partial_amount_spent = get_post_meta($post->ID, 'ecpt_expense_partial_amount_spent', true);
?>
<tr class="gradeA odd">
	<td>
		<?php the_title('<h3>', '</h3>'); ?>
		<h5><em><?php the_date('l jS \of F Y h:i:s A'); ?></em></h5>
		<?php// the_excerpt(); ?>
		<small><strong>$<?php echo $partial_amount_spent; ?></strong> <em>spent out if</em> <strong>$<?php echo $monetary_value_max; ?></strong> <em>which is a difference of</em> <strong>$<?php echo $differecnce = $monetary_value_max - $partial_amount_spent; ?></strong></small>
		<div class="progress progress-striped active">
			<div id="progressbar" class="progress-bar progress-bar-primary tooltips" role="progressbar" aria-valuenow="<?php echo $partial_amount_spent; ?>" aria-valuemin="0" aria-valuemax="<?php echo $monetary_value_max; ?>" data-placement="top" data-toggle="tooltip" data-original-title="Tooltip on top" style="width: <?php echo $partial_amount_spent; ?>%"></div>
			<span class="sr-only"><?php echo $partial_amount_spent; ?>% Complete (success)</span>
		</div>
	</td>
</tr>

