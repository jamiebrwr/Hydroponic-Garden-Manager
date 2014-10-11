<?php

// login form fields
function rcp_login_form_fields( $args = array() ) {

	global $rcp_login_form_args;

	// parse the arguments passed
	$defaults = array (
 		'redirect' => rcp_get_current_url(),
	);
	$rcp_login_form_args = wp_parse_args( $args, $defaults );

	ob_start();

	do_action( 'rcp_before_login_form' );

	rcp_get_template_part( 'login' );

	do_action( 'rcp_after_login_form' );

	return ob_get_clean();
}

// registration form fields
function rcp_registration_form_fields( $id = null ) {

	global $rcp_level;

	$rcp_level = $id;

	ob_start();

	do_action( 'rcp_before_register_form', $id );

	if( ! is_null( $id ) ) {

		if( rcp_locate_template( array( 'register-single-' . $id . '.php' ), false ) ) {

			rcp_get_template_part( 'register', 'single-' . $id );

		} else {

			rcp_get_template_part( 'register', 'single' );
			
		}

	} else {

		rcp_get_template_part( 'register' );

	}

	do_action( 'rcp_after_register_form', $id );

	return ob_get_clean();
}

function rcp_change_password_form( $args = array() ) {

	global $rcp_password_form_args;

	// parse the arguments passed
	$defaults = array (
 		'redirect' => rcp_get_current_url(),
	);
	$rcp_password_form_args = wp_parse_args( $args, $defaults );

	ob_start();
	do_action( 'rcp_before_password_form' );
	rcp_get_template_part( 'change-password' );
	do_action( 'rcp_after_password_form' );
	return ob_get_clean();
}

function rcp_add_auto_renew( $levels = array() ) {
	if( '3' == rcp_get_auto_renew_behavior() ) : ?>
	<p id="rcp_auto_renew_wrap">
		<input name="rcp_auto_renew" id="rcp_auto_renew" type="checkbox" checked="checked"/>
		<label for="rcp_auto_renew"><?php echo apply_filters ( 'rcp_registration_auto_renew', __( 'Auto Renew', 'rcp' ) ); ?></label>
	</p>
	<?php endif;
}
add_action( 'rcp_before_registration_submit_field', 'rcp_add_auto_renew' );