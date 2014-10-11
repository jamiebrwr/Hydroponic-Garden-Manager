<?php
$payment_id = ! empty( $_GET['payment_id'] ) ? absint( $_GET['payment_id'] ) : 0;
$payments   = new RCP_Payments;
$payment    = $payments->get_payment( $payment_id );
$user       = get_userdata( $payment->user_id );
?>
<h2>
	<?php _e( 'Edit Payment', 'rcp' ); ?> - 
	<a href="<?php echo admin_url( '/admin.php?page=rcp-payments' ); ?>" class="button-secondary">
		<?php _e( 'Cancel', 'rcp' ); ?>
	</a>
</h2>
<form id="rcp-edit-member" action="" method="post">
	<table class="form-table">
		<tbody>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-user-id"><?php _e( 'User', 'rcp' ); ?></label>
				</th>
				<td>
					<input type="text" name="user" autocomplete="off" id="rcp-user" class="regular-text rcp-user-search" value="<?php echo esc_attr( $user->user_login ); ?>"/>
					<img class="rcp-ajax waiting" src="<?php echo admin_url('images/wpspin_light.gif'); ?>" style="display: none;"/>
					<div id="rcp_user_search_results"></div>
					<p class="description"><?php _e('The user name this payment belongs to.', 'rcp'); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-amount"><?php _e( 'Amount', 'rcp' ); ?></label>
				</th>
				<td>
					<input name="amount" id="rcp-amount" type="text" value="<?php echo esc_attr( $payment->amount ); ?>"/>
					<p class="description"><?php _e( 'The amount of this payment', 'rcp' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-date"><?php _e( 'Payment Date', 'rcp' ); ?></label>
				</th>
				<td>
					<input name="date" id="rcp-date" type="text" class="rcp-datepicker" value="<?php echo esc_attr( date( 'Y-m-d', strtotime( $payment->date ) ) ); ?>"/>
					<p class="description"><?php _e( 'The date for this payment in the format of yyyy-mm-dd', 'rcp' ); ?></p>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row" valign="top">
					<label for="rcp-date"><?php _e( 'Transaction ID', 'rcp' ); ?></label>
				</th>
				<td>
					<input name="transaction-id" id="rcp-transaction-id" type="text" class="regular-text" value="<?php echo esc_attr( $payment->transaction_id ); ?>"/>
					<p class="description"><?php _e( 'The transaction ID for this payment, if any', 'rcp' ); ?></p>
				</td>
			</tr>
		</tbody>
	</table>
	<p class="submit">
		<input type="hidden" name="rcp-action" value="edit-payment"/>
		<input type="hidden" name="payment-id" value="<?php echo esc_attr( $payment_id ); ?>"/>
		<input type="submit" value="<?php _e( 'Update Payment', 'rcp' ); ?>" class="button-primary"/>
	</p>
</form>