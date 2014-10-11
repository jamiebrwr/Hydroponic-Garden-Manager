<?php

function rcp_email_subscription_status( $user_id, $status = 'active' ) {

	global $rcp_options;

	$user_info = get_userdata($user_id);
	$message = '';
	$admin_message = '';

	$admin_emails = array();
	$admin_emails[] = get_option('admin_email');
	$admin_emails = apply_filters( 'rcp_admin_notice_emails', $admin_emails );

	$site_name = stripslashes_deep( html_entity_decode( get_bloginfo('name'), ENT_COMPAT, 'UTF-8' ) );

	switch ($status) :

		case "active" :

			if( ! isset( $rcp_options['disable_active_email'] ) ) {

				$message = apply_filters( 'rcp_subscription_active_email', $rcp_options['active_email'], $user_id, $status );
				wp_mail( $user_info->user_email, $rcp_options['active_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			}

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('is now subscribed to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Subscription level', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_active_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_emails, __('New subscription on ', 'rcp') . $site_name, $admin_message );
			}
		break;

		case "cancelled" :

			if( ! isset( $rcp_options['disable_cancelled_email'] ) ) {

				$message = apply_filters( 'rcp_subscription_cancelled_email', $rcp_options['cancelled_email'], $user_id, $status );
				wp_mail( $user_info->user_email, $rcp_options['cancelled_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			}

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('has cancelled their subscription to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Their subscription level was', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_cancelled_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_emails, __('Cancelled subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		case "expired" :

			if( ! isset( $rcp_options['disable_expired_email'] ) ) {

				$message = apply_filters( 'rcp_subscription_expired_email', $rcp_options['expired_email'], $user_id, $status );
				wp_mail( $user_info->user_email, $rcp_options['expired_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			}

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name . "'s " . __('subscription has expired', 'rcp') . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_expired_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_emails, __('Expired subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		case "free" :

			if( ! isset( $rcp_options['disable_free_email'] ) ) {

				$message = apply_filters( 'rcp_subscription_free_email', $rcp_options['free_email'], $user_id, $status );
				wp_mail( $user_info->user_email, $rcp_options['free_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			}

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('is now subscribed to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Subscription level', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_free_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_emails, __('New free subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		case "trial" :

			if( ! isset( $rcp_options['disable_trial_email'] ) ) {

				$message = apply_filters( 'rcp_subscription_trial_email', $rcp_options['trial_email'], $user_id, $status );
				wp_mail( $user_info->user_email, $rcp_options['trial_subject'], rcp_filter_email_tags($message, $user_id, $user_info->display_name) );

			}

			if( ! isset( $rcp_options['disable_new_user_notices'] ) ) {
				$admin_message = __('Hello', 'rcp') . "\n\n" . $user_info->display_name .  ' ' . __('is now subscribed to', 'rcp') . ' ' . $site_name . ".\n\n" . __('Subscription level', 'rcp') . ': ' . rcp_get_subscription($user_id) . "\n\n";
				$admin_message = apply_filters('rcp_before_admin_email_trial_thanks', $admin_message, $user_id);
				$admin_message .= __('Thank you', 'rcp');
				wp_mail( $admin_emails, __('New trial subscription on ', 'rcp') . $site_name, $admin_message );
			}

		break;

		default:
			break;

	endswitch;
}

function rcp_email_expiring_notice( $user_id = 0 ) {

	global $rcp_options;
	$user_info = get_userdata( $user_id );
	$message   = ! empty( $rcp_options['renew_notice_email'] ) ? $rcp_options['renew_notice_email'] : false;

	if( ! $message )
		return;

	$message   = rcp_filter_email_tags( $message, $user_id, $user_info->display_name );

	wp_mail( $user_info->user_email, $rcp_options['renewal_subject'], $message );
}

function rcp_filter_email_tags( $message, $user_id, $display_name ) {

	$user = get_userdata( $user_id );

	$site_name = stripslashes_deep( html_entity_decode( get_bloginfo('name'), ENT_COMPAT, 'UTF-8' ) );

	$rcp_payments = new RCP_Payments();

	$message = str_replace('%blogname%', $site_name, $message);
	$message = str_replace('%username%', $user->user_login, $message);
	$message = str_replace('%firstname%', $user->user_firstname, $message);
	$message = str_replace('%lastname%', $user->user_lastname, $message);
	$message = str_replace('%displayname%', $display_name, $message);
	$message = str_replace('%expiration%', rcp_get_expiration_date($user_id), $message);
	$message = str_replace('%subscription_name%', rcp_get_subscription($user_id), $message);
	$message = str_replace('%subscription_key%', rcp_get_subscription_key($user_id), $message);
	$message = str_replace('%amount%', html_entity_decode( rcp_currency_filter( $rcp_payments->last_payment_of_user( $user_id ) ), ENT_COMPAT, 'UTF-8' ), $message);

	return apply_filters( 'rcp_email_tags', htmlspecialchars( $message ), $user_id );
}