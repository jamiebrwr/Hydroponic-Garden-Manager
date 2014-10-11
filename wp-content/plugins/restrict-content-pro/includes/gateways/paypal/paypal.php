<?php

function rcp_process_paypal( $subscription_data ) {

	global $rcp_options;

	if( isset( $rcp_options['sandbox'] ) ) {
		$paypal_redirect = 'https://www.sandbox.paypal.com/cgi-bin/webscr/?';
	} else {
		$paypal_redirect = 'https://www.paypal.com/cgi-bin/webscr/?';
	}

	// Setup PayPal arguments
	$paypal_args = array(
		'business'      => trim( $rcp_options['paypal_email'] ),
		'email'         => $subscription_data['user_email'],
		'item_number'   => $subscription_data['key'],
		'item_name'     => $subscription_data['subscription_name'],
		'no_shipping'   => '1',
		'shipping'      => '0',
		'no_note'       => '1',
		'currency_code' => $subscription_data['currency'],
		'charset'       => get_bloginfo( 'charset' ),
		'custom'        => $subscription_data['user_id'],
		'rm'            => '2',
		'return'        => $subscription_data['return_url'],
		'cancel_return' => home_url(),
		'notify_url'    => home_url( '/' ) . '?listener=IPN',
		'cbt'			=> get_bloginfo( 'name' ),
		'tax'           => 0,
		'page_style'    => ! empty( $rcp_options['paypal_page_style'] ) ? trim( $rcp_options['paypal_page_style'] ) : '',
	);


	// recurring paypal payment
	if( $subscription_data['auto_renew'] && ! empty( $subscription_data['length'] ) ) {
		// recurring paypal payment
		$paypal_args['cmd'] = '_xclick-subscriptions';
		$paypal_args['src'] = '1';
		$paypal_args['sra'] = '1';
		$paypal_args['a3'] = $subscription_data['price'];

		if( ! empty( $subscription_data['fee'] ) ) {
			$paypal_args['a1'] = number_format( $subscription_data['fee'] + $subscription_data['price'], 2 );
		}

		$paypal_args['p3'] = $subscription_data['length'];

		if( ! empty( $subscription_data['fee'] ) ) {
			$paypal_args['p1'] = $subscription_data['length'];
		}

		switch ( $subscription_data['length_unit'] ) :
			case "day" :
				$paypal_args['t3'] = 'D';
				if( ! empty( $subscription_data['fee'] ) ) {
					$paypal_args['t1'] = 'D';
				}
			break;
			case "month" :
				$paypal_args['t3'] = 'M';
				if( ! empty( $subscription_data['fee'] ) ) {
					$paypal_args['t1'] = 'M';
				}
			break;
			case "year" :
				$paypal_args['t3'] = 'Y';
				if( ! empty( $subscription_data['fee'] ) ) {
					$paypal_args['t1'] = 'Y';
				}
			break;
		endswitch;
	} else {
		// one time payment
		$paypal_args['cmd'] = '_xclick';
		$paypal_args['amount'] = $subscription_data['price'];
	}

	$paypal_args = apply_filters( 'rcp_paypal_args', $paypal_args, $subscription_data );

	$paypal_redirect .= http_build_query( $paypal_args );

	// Redirect to paypal
	header( 'Location: ' . $paypal_redirect );
	exit;

}
add_action( 'rcp_gateway_paypal', 'rcp_process_paypal' );

function rcp_check_ipn() {

	global $rcp_options;

	if( !class_exists( 'IpnListener' ) ) {
		// instantiate the IpnListener class
		include( RCP_PLUGIN_DIR . 'includes/gateways/paypal/ipnlistener.php' );
	}

	$listener = new IpnListener();

	if( isset( $rcp_options['sandbox'] ) )
		$listener->use_sandbox = true;

	if( isset( $rcp_options['ssl'] ) ) {
		$listener->use_ssl = true;
	} else {
		$listener->use_ssl = false;
	}

	//To post using the fsockopen() function rather than cURL, use:
	if( isset( $rcp_options['disable_curl'] ) )
		$listener->use_curl = false;

	try {
		$listener->requirePostMethod();
		$verified = $listener->processIpn();
	} catch ( Exception $e ) {
		//exit(0);
	}

	/*
	The processIpn() method returned true if the IPN was "VERIFIED" and false if it
	was "INVALID".
	*/
	if ( $verified || isset( $_POST['verification_override'] ) || ( isset( $rcp_options['sandbox'] ) || isset( $rcp_options['disable_ipn_verify'] ) ) )  {

		$posted = apply_filters('rcp_ipn_post', $_POST); // allow $_POST to be modified

		$user_id 			= $posted['custom'];
		$subscription_name 	= $posted['item_name'];
		$subscription_key 	= $posted['item_number'];
		$amount 			= number_format( (float) $posted['mc_gross'], 2 );
		$amount2 			= number_format( (float) $posted['mc_amount3'], 2 );
		$payment_status 	= $posted['payment_status'];
		$currency_code		= $posted['mc_currency'];
		$subscription_id    = rcp_get_subscription_id( $user_id );
		$subscription_price = number_format( (float) rcp_get_subscription_price( rcp_get_subscription_id( $user_id ) ), 2) ;

		$user_data          = get_userdata( $user_id );

		if( ! $user_data || ! $subscription_id )
			return;

		if( ! rcp_get_subscription_details( $subscription_id ) )
			return;

		// setup the payment info in an array for storage
		$payment_data = array(
			'date'             => date( 'Y-m-d g:i:s', strtotime( $posted['payment_date'] ) ),
			'subscription'     => $posted['item_name'],
			'payment_type'     => $posted['txn_type'],
			'subscription_key' => $subscription_key,
			'amount'           => $amount,
			'user_id'          => $user_id,
			'transaction_id'   => $posted['txn_id']
		);

		do_action( 'rcp_valid_ipn', $payment_data, $user_id, $posted );

		if( $posted['txn_type'] == 'web_accept' || $posted['txn_type'] == 'subscr_payment' ) {
			// only check for an existing payment if this is a payment IPD request
			if( rcp_check_for_existing_payment( $posted['txn_type'], $posted['payment_date'], $subscription_key ) ) {

				$log_data = array(
				    'post_title'    => __( 'Duplicate Payment', 'rcp' ),
				    'post_content'  =>  __( 'A duplicate payment was detected. The new payment was still recorded, so you may want to check into both payments.', 'rcp' ),
				    'post_parent'   => 0,
				    'log_type'      => 'gateway_error'
				);

				$log_meta = array(
				    'user_subscription' => $posted['item_name'],
				    'user_id'           => $user_id
				);
				$log_entry = WP_Logging::insert_log( $log_data, $log_meta );

				return; // this IPN request has already been processed
			}


			/* do some quick checks to make sure all necessary data validates */

			if ( $amount < $subscription_price && $amount2 < $subscription_price ) {

				/*
				// the subscription price doesn't match, so lets check to see if it matches with a discount code
				if( ! rcp_check_paypal_return_price_after_discount( $subscription_price, $amount, $amount2, $user_id ) ) {

					$log_data = array(
					    'post_title'    => __( 'Price Mismatch', 'rcp' ),
					    'post_content'  =>  sprintf( __( 'The price in an IPN request did not match the subscription price. Payment data: %s', 'rcp' ), json_encode( $payment_data ) ),
					    'post_parent'   => 0,
					    'log_type'      => 'gateway_error'
					);

					$log_meta = array(
					    'user_subscription' => $posted['item_name'],
					    'user_id'           => $user_id
					);
					$log_entry = WP_Logging::insert_log( $log_data, $log_meta );

					//return;
				}

				*/
			}

			if( strtolower( $currency_code ) != strtolower( $rcp_options['currency'] ) ) {
				// the currency code is invalid

				$log_data = array(
				    'post_title'    => __( 'Invalid Currency Code', 'rcp' ),
				    'post_content'  =>  sprintf( __( 'The currency code in an IPN request did not match the site currency code. Payment data: %s', 'rcp' ), json_encode( $payment_data ) ),
				    'post_parent'   => 0,
				    'log_type'      => 'gateway_error'
				);

				$log_meta = array(
				    'user_subscription' => $posted['item_name'],
				    'user_id'           => $user_id
				);
				$log_entry = WP_Logging::insert_log( $log_data, $log_meta );

				return;
			}

		}

		if( isset( $rcp_options['email_ipn_reports'] ) ) {
			wp_mail( get_bloginfo('admin_email'), __( 'IPN report', 'rcp' ), $listener->getTextReport() );
		}


		if( rcp_get_subscription_key( $user_id ) != $subscription_key ) {
			// the subscription key is invalid

			$log_data = array(
			    'post_title'    => __( 'Subscription Key Mismatch', 'rcp' ),
			    'post_content'  =>  sprintf( __( 'The subscription key in an IPN request did not match the subscription key recorded for the user. Payment data: %s', 'rcp' ), json_encode( $payment_data ) ),
			    'post_parent'   => 0,
			    'log_type'      => 'gateway_error'
			);

			$log_meta = array(
			    'user_subscription' => $posted['item_name'],
			    'user_id'           => $user_id
			);
			$log_entry = WP_Logging::insert_log( $log_data, $log_meta );

			return;
		}


		/* now process the kind of subscription/payment */

		$rcp_payments = new RCP_Payments();

		// Subscriptions
		switch ( $posted['txn_type'] ) :

			case "subscr_signup" :
				// when a new user signs up

				// store the recurring payment ID
				update_user_meta( $user_id, 'rcp_paypal_subscriber', $posted['payer_id'] );

				// set the user's status to active
				rcp_set_status( $user_id, 'active' );

				if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {

					wp_new_user_notification( $user_id );

				}

				// send welcome email
				rcp_email_subscription_status( $user_id, 'active' );

				update_user_meta( $user_id, 'rcp_recurring', 'yes' );

				do_action( 'rcp_ipn_subscr_signup', $user_id );

			break;
			case "subscr_payment" :

				// when a user makes a recurring payment

				// record this payment in the database
				$rcp_payments->insert( $payment_data );

				$subscription = rcp_get_subscription_details( rcp_get_subscription_id( $user_id ) );

				// update the user's expiration to correspond with the new payment
				$member_new_expiration = date( 'Y-m-d H:i:s', strtotime( '+' . $subscription->duration . ' ' . $subscription->duration_unit . ' 23:59:59' ) );

				rcp_set_expiration_date( $user_id, $member_new_expiration );

				update_user_meta( $user_id, 'rcp_paypal_subscriber', $posted['payer_id'] );

				// make sure the user's status is active
				rcp_set_status( $user_id, 'active' );

				update_user_meta( $user_id, 'rcp_recurring', 'yes' );

				delete_user_meta( $user_id, '_rcp_expired_email_sent' );

				do_action( 'rcp_ipn_subscr_payment', $user_id );

			break;
			case "subscr_cancel" :

				// user is not canceled until end of term

				// set the use to no longer be recurring
				delete_user_meta( $user_id, 'rcp_recurring' );
				delete_user_meta( $user_id, 'rcp_paypal_subscriber' );

				// send sub cancelled email
				rcp_email_subscription_status( $user_id, 'cancelled' );

				do_action( 'rcp_ipn_subscr_cancel', $user_id );

			break;
			case "subscr_failed" :
				do_action( 'rcp_ipn_subscr_failed' );
				break;

			case "subscr_eot" :

				// user's subscription has reach the end of its term

				// set the use to no longer be recurring
				delete_user_meta( $user_id, 'rcp_recurring' );

				rcp_set_status( $user_id, 'expired' );

				// send expired email
				rcp_email_subscription_status( $user_id, 'expired' );

				do_action('rcp_ipn_subscr_eot', $user_id );

			break;

			case "cart" :
				return; // get out of here

			case "express_checkout" :
				return; // get out of here

			case "web_accept" :

				switch ( strtolower( $payment_status ) ) :
		            case 'completed' :

		            	if( isset( $_POST['verification_override'] ) ) {

		            		// this is a method for providing a new expiration if it doesn't exist

			            	$subscription = rcp_get_subscription_details_by_name( $payment_data['subscription'] );

			            	// update the user's expiration to correspond with the new payment
							$member_new_expiration = date( 'Y-m-d H:i:s', strtotime( '+' . $subscription->duration . ' ' . $subscription->duration_unit . ' 23:59:59' ) );

							rcp_set_expiration_date( $user_id, $member_new_expiration );

						}

						// set this user to active
						rcp_set_status( $user_id, 'active' );

						$rcp_payments->insert( $payment_data );

						rcp_email_subscription_status( $user_id, 'active' );

						if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
							// send welcome email here
							wp_new_user_notification( $user_id );

						}

						delete_user_meta( $user_id, '_rcp_expired_email_sent' );

		            break;
		            case 'denied' :
		            case 'expired' :
		            case 'failed' :
		            case 'voided' :
						rcp_set_status( $user_id, 'cancelled' );
						// send cancelled email here
		            break;
		        endswitch;

			break;
			default :
			break;

		endswitch;

	} else {
		if( isset( $rcp_options['email_ipn_reports'] ) ) {
			// an invalid IPN attempt was made. Send an email to the admin account to investigate
			wp_mail( get_bloginfo( 'admin_email' ), __( 'Invalid IPN', 'rcp' ), $listener->getTextReport() );
		}
	}
}
add_action( 'verify-paypal-ipn', 'rcp_check_ipn' );

function rcp_listen_for_paypal_ipn() {
	if( isset( $_GET['listener'] ) && $_GET['listener'] == 'IPN' ) {
		do_action( 'verify-paypal-ipn' );
	}
}
add_action( 'init', 'rcp_listen_for_paypal_ipn' );