<?php

function rcp_admin_notices() {
	global $rcp_options;

	$message = ! empty( $_GET['rcp_message'] ) ? urldecode( $_GET['rcp_message'] ) : false;
	$class   = 'updated';
	$text    = '';

	// only show notice if settings have never been saved
	if( ! is_array( $rcp_options ) || empty( $rcp_options ) ) {
		echo '<div class="updated"><p>' . __( 'You should now configure your Restrict Content Pro settings', 'rcp' ) . '</p></div>';
	}

	if( rcp_check_if_upgrade_needed() ) {
		echo '<div class="error"><p>' . __( 'The Restrict Content Pro database needs updated: ', 'rcp' ) . ' ' . '<a href="' . esc_url( add_query_arg( 'rcp-action', 'upgrade', admin_url() ) ) . '">' . __( 'upgrade now', 'rcp' ) . '</a></p></div>';
	}
	if( isset( $_GET['rcp-db'] ) && $_GET['rcp-db'] == 'updated' ) {
		echo '<div class="updated fade"><p>' . __( 'The Restrict Content Pro database has been updated', 'rcp' ) . '</p></div>';
	}


	switch( $message ) :

		case 'payment_deleted' :

			$text = __( 'Payment deleted', 'rcp' );
			break;

		case 'payment_added' :

			$text = __( 'Payment added', 'rcp' );
			break;

		case 'payment_not_added' :

			$text = __( 'Payment creation failed', 'rcp' );
			$class = 'error';
			break;

		case 'payment_updated' :

			$text = __( 'Payment updated', 'rcp' );
			break;

		case 'payment_not_updated' :

			$text = __( 'Payment update failed', 'rcp' );
			break;

		case 'upgrade-complete' :

			$text =  __( 'Database upgrade complete', 'rcp' );
			break;

		case 'user_added' :

			$text = __( 'The user\'s subscription has been added', 'rcp' );
			break;

		case 'user_not_added' :

			$text = __( 'The user\'s subscription could not be added', 'rcp' );
			$class = 'error';
			break;

		case 'user_updated' :

			$text = __( 'Member updated' );
			break;

		case 'level_added' :

			$text = __( 'Subscription level added', 'rcp' );
			break;

		case 'level_updated' :

			$text = __( 'Subscription level updated', 'rcp' );
			break;

		case 'level_not_added' :

			$text = __( 'Subscription level could not be added', 'rcp' );
			$class = 'error';
			break;

		case 'level_not_updated' :

			$text = __( 'Subscription level could not be updated', 'rcp' );
			$class = 'error';
			break;

		case 'discount_added' :

			$text = __( 'Discount code created', 'rcp' );
			break;

		case 'discount_not_added' :

			$text = __( 'The discount code could not be created due to an error', 'rcp' );
			$class = 'error';
			break;

	endswitch;

	if( $message )
		echo '<div class="' . $class . '"><p>' . $text . '</p></div>';

}
add_action( 'admin_notices', 'rcp_admin_notices' );