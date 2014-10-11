<?php

function ecpt_settings_page()
{
	global $ecpt_options;
	global $ecpt_db_name;

	$user_levels = array('Admin', 'Editor', 'Author');
	
	$license_status = ! empty( $ecpt_options['license_status'] ) ? $ecpt_options['license_status'] : 'inactive';
	$license_key    = ! empty( $ecpt_options['license_key'] )    ? $ecpt_options['license_key']    : '';

	?>
	<div class="wrap">
		<div id="ecpt-wrap" class="ecpt-settings">
			<h2><?php _e('Easy Custom Content Types Settings', 'ecpt'); ?></h2>
			<?php
			if ( ! isset( $_REQUEST['updated'] ) )
				$_REQUEST['updated'] = false;
			?>
			<?php if ( false !== $_REQUEST['updated'] ) : ?>
			<div class="updated fade"><p><strong><?php _e( 'Options saved', 'ecpt' ); ?></strong></p></div>
			<?php endif; ?>
			<form method="post" action="options.php">

				<?php settings_fields( 'ecpt_settings_group' ); ?>
				
				<?php if(!is_writable(TEMPLATEPATH)) { ?>
				<div class="error fade"><p><strong><?php _e( 'Template folder is not writable! Please change permissions on your theme\'s root folder to 755 or 777 in order to enable these template settings', 'ecpt' ); ?></strong></p></div>
				<?php } ?>
				
				<h4><?php _e('License Key', 'ecpt'); ?></h4>
				
				<p>
					<input id="ecpt_settings[license_key]" name="ecpt_settings[license_key]" type="text" class="medium-text" value="<?php echo $license_key; ?>"/>
					<?php if( 'valid' === $license_status && ! empty( $license_key ) ) {
						echo '<input type="submit" class="button" name="ecpt_deactivate_license" value="' . esc_attr__( 'Deactivate License', 'ecpt' ) . '"/>';
						echo '<span style="color:green;">&nbsp;' . __( 'Your license is valid!', 'ecpt' ) . '</span>';
					} elseif( 'expired' === $license_status && ! empty( $license_key ) ) {
						$renewal_url = add_query_arg( array( 'edd_license_key' => $license_key, 'download_id' => 6908 ), 'https://pippinsplugins.com/checkout' );
						echo '<a href="' . esc_url( $renewal_url ) . '" class="button-primary">' . __( 'Renew Your License', 'ecpt' ) . '</a>';
						echo '<br/><span style="color:red;">&nbsp;' . __( 'Your license has expired, renew today to continue getting updates and support!', 'ecpt' ) . '</span>';
					} else {
						echo '<input type="submit" class="button" name="ecpt_activate_license" value="' . esc_attr__( 'Activate License', 'ecpt' ) . '"/>';
					}
					?><br/>
					<label class="description" for="ecpt_settings[license_key]"><?php printf( __( 'Enter license key for Easy Content Types. This is required for automatic updates and <a href="%s">support</a>.', 'rcp' ), 'http://pippinsplugins.com/plugin-support' ); ?></label>

				</p>

				<h4><?php _e('Post Type Templates', 'ecpt'); ?></h4>
				
				<p>
					<input id="ecpt_settings[create_single_templates]" name="ecpt_settings[create_single_templates]" type="checkbox" value="1" <?php if ( isset($ecpt_options['create_single_templates']) && $ecpt_options['create_single_templates'] == 1) echo 'checked="checked"'; ?> <?php if(!is_writable(TEMPLATEPATH)) { ?> disabled="disabled"<?php } ?>/>
					<label class="description" for="ecpt_settings[create_single_templates]"><?php _e( 'Check this box to enable automatic single template creation for custom post types', 'ecpt' ); ?></label>
				</p>
				<p>
					<input id="ecpt_settings[create_archive_templates]" name="ecpt_settings[create_archive_templates]" type="checkbox" value="1" <?php if ( isset($ecpt_options['create_archive_templates']) && $ecpt_options['create_archive_templates'] == 1) echo 'checked="checked"'; ?> <?php if(!is_writable(TEMPLATEPATH)) { ?> disabled="disabled"<?php } ?>/>
					<label class="description" for="ecpt_settings[create_archive_templates]"><?php _e( 'Check this box to enable automatic template creation for custom post types archives', 'ecpt' ); ?></label>
				</p>
				
				<h4><?php _e('Taxonomy Templates', 'ecpt'); ?></h4>
				
				<p>
					<input id="ecpt_settings[create_tax_templates]" name="ecpt_settings[create_tax_templates]" type="checkbox" value="1" <?php if ( isset($ecpt_options['create_tax_templates']) && $ecpt_options['create_tax_templates'] == 1) echo 'checked="checked"'; ?> <?php if(!is_writable(TEMPLATEPATH)) { ?> disabled="disabled"<?php } ?>/>
					<label class="description" for="ecpt_settings[create_tax_templates]"><?php _e( 'Check this box to enable automatic template creation for custom taxonomy archives', 'ecpt' ); ?></label>
				</p>
				
				<h4><?php _e('User Levels', 'ecpt'); ?></h4>
				<p>
                    <select name="ecpt_settings[menu_user_level]">
						<?php foreach ( $user_levels as $option) { ?>
							<option <?php if ($ecpt_options['menu_user_level'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
						<?php } ?>
					</select>					
					<label class="description" for="ecpt_settings[menu_user_level]"><?php _e( 'Choose the user level that can access the custom content menu', 'ecpt' ); ?></label>
				</p>
				<p>
                    <select name="ecpt_settings[posttype_user_level]">
						<?php foreach ( $user_levels as $option) { ?>
							<option <?php if ($ecpt_options['posttype_user_level'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
						<?php } ?>
					</select>					
					<label class="description" for="ecpt_settings[posttype_user_level]"><?php _e( 'Choose the user level that can create custom post types.', 'ecpt'); ?></label>
				</p>
				<p>
					<select name="ecpt_settings[tax_user_level]">
						<?php foreach ( $user_levels as $option) { ?>
							<option <?php if ($ecpt_options['tax_user_level'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
						<?php } ?>
					</select>					
					<label class="description" for="ecpt_settings[tax_user_level]"><?php _e( 'Choose the user level that can create custom taxonomies.', 'ecpt' ); ?></label>
				</p>
				<p>
					<select name="ecpt_settings[metabox_user_level]">
						<?php foreach ( $user_levels as $option) { ?>
							<option <?php if ($ecpt_options['metabox_user_level'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
						<?php } ?>
					</select>					
					<label class="description" for="ecpt_settings[metabox_user_level]"><?php _e( 'Choose the user level that can create custom meta boxes.', 'ecpt' ); ?></label>
				</p>
				
				<h4><?php _e('Render Short Codes in Meta Fields', 'ecpt'); ?></h4>
				
				<p>
					<input id="ecpt_settings[do_shortcode_filter]" name="ecpt_settings[do_shortcode_filter]" type="checkbox" value="1" <?php if ( isset($ecpt_options['do_shortcode_filter']) && $ecpt_options['do_shortcode_filter'] == 1) echo 'checked="checked"'; ?>/>
					<label class="description" for="ecpt_settings[do_shortcode_filter]"><?php _e( 'Check this box to render short codes that are placed in meta box fields. Note, this can occasionally cause conflicts, though very rarely <a href="#shopp-conflict">*</a>', 'ecpt' ); ?></label>
				</p>
				
				<h4><?php _e('Disable Taxonomy Archives Fix', 'ecpt'); ?></h4>
				
				<p>
					<input id="ecpt_settings[disable_filter_archive_post_types]" name="ecpt_settings[disable_filter_archive_post_types]" type="checkbox" value="1" <?php if ( isset($ecpt_options['disable_filter_archive_post_types']) && $ecpt_options['disable_filter_archive_post_types'] == 1) echo 'checked="checked"'; ?>/>
					<label class="description" for="ecpt_settings[disable_filter_archive_post_types]"><?php _e( 'Check this box to disable the automatic filter applied to taxonomy archives. This fixes the problem with 404s in taxonomy archives, but it\'s possible it could cause problems with some themes.', 'ecpt' ); ?></label>
				</p>
				
				<h4><?php _e('Date Picker Format', 'ecpt'); ?></h4>
				
				<p>
					<input id="ecpt_settings[date_format]" name="ecpt_settings[date_format]" type="text" value="<?php echo $ecpt_options['date_format']; ?>"/>
					<label class="description" for="ecpt_settings[date_format]"><?php _e( 'Enter the date format you would like used for the date picker, or leave blank for default. This format is only shown in the meta field output. Use <a href="http://codex.wordpress.org/Formatting_Date_and_Time">this page for reference.</a>', 'ecpt' ); ?></label>
				</p>
				
				<h4><?php _e('Auto Display Meta Field Values', 'ecpt'); ?></h4>
				<?php 
				$post_types = get_post_types(array('public' => true, 'show_ui' => true), 'objects');
				foreach($post_types as $post_type) { ?>
					<h5><?php echo $post_type->name; ?></h5>
					<p>
						<input id="ecpt_settings[auto_display_meta_fields_<?php echo $post_type->name; ?>]" name="ecpt_settings[auto_display_meta_fields_<?php echo $post_type->name; ?>]" type="checkbox" value="1" <?php if ( isset($ecpt_options['auto_display_meta_fields_' . $post_type->name]) && $ecpt_options['auto_display_meta_fields_' . $post_type->name] == 1) echo 'checked="checked"'; ?>/>
						<label class="description" for="ecpt_settings[auto_display_meta_fields_<?php echo $post_type->name; ?>]"><?php _e( 'Check this box to automatically display meta box field values after the item content for the ', 'ecpt') . '<strong>' . $post_type->name . '</strong>' . _e('post type', 'ecpt'); ?></label>
						
							<!--show desc-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_desc]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_desc]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_desc']) && $ecpt_options['meta_fields_' . $post_type->name . '_desc'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_desc]"><?php _e( 'Check this box to show field descriptions', 'ecpt'); ?></label>
							</div><br/>
							
							<!--text field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_text]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_text]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_text']) && $ecpt_options['meta_fields_' . $post_type->name . '_text'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_text]"><?php _e( 'Check this box to automatically display text fields', 'ecpt'); ?></label>
							</div>
							
							<!--textarea field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_textarea]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_textarea]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_textarea']) && $ecpt_options['meta_fields_' . $post_type->name . '_textarea'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_text]"><?php _e( 'Check this box to automatically display textarea fields', 'ecpt'); ?></label>
							</div>
							
							<!--date field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_date]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_date]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_date']) && $ecpt_options['meta_fields_' . $post_type->name . '_date'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_date]"><?php _e( 'Check this box to automatically display date fields', 'ecpt'); ?></label>
							</div>
							
							<!--slider field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_slider]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_slider]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_slider']) && $ecpt_options['meta_fields_' . $post_type->name . '_slider'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_slider]"><?php _e( 'Check this box to automatically display slider fields', 'ecpt'); ?></label>
							</div>
							
							<!--select field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_select]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_select]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_select']) && $ecpt_options['meta_fields_' . $post_type->name . '_select'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_select]"><?php _e( 'Check this box to automatically display the selected option for select fields', 'ecpt'); ?></label>
							</div>
							
							<!--radio field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_radio]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_radio]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_radio']) && $ecpt_options['meta_fields_' . $post_type->name . '_radio'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_radio]"><?php _e( 'Check this box to automatically display the selected option for radio fields', 'ecpt'); ?></label>
							</div>
							
							<!--checkbox field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_checkbox]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_checkbox]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_checkbox']) && $ecpt_options['meta_fields_' . $post_type->name . '_checkbox'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_checkbox]"><?php _e( 'Check this box to automatically display "yes" or "no" for checkbox fields', 'ecpt'); ?></label>
							</div>
							
							<!--multicheck field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_multicheck]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_multicheck]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_multicheck']) && $ecpt_options['meta_fields_' . $post_type->name . '_multicheck'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_multicheck]"><?php _e( 'Check this box to automatically display a list of selected multicheck options', 'ecpt'); ?></label>
							</div>
							
							<!--repeatable field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_repeatable']) && $ecpt_options['meta_fields_' . $post_type->name . '_repeatable'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable]"><?php _e( 'Check this box to automatically display repeatable field values', 'ecpt'); ?></label>
							</div>
							
							
							<!--upload field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_upload]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_upload]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_upload']) && $ecpt_options['meta_fields_' . $post_type->name . '_upload'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_upload]"><?php _e( 'Check this box to automatically display upload fields', 'ecpt'); ?></label>
								
								<!-- render images -->
								<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_upload_image]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_upload_image]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_upload_image']) && $ecpt_options['meta_fields_' . $post_type->name . '_upload_image'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_upload_image]"><?php _e( 'Check this box if you want to render images, rather than just displaying the url', 'ecpt'); ?></label>
								</div>							
							</div>
							
							<!--repeatable upload field-->
							<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable_upload]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable_upload]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_repeatable_upload']) && $ecpt_options['meta_fields_' . $post_type->name . '_repeatable_upload'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable_upload]"><?php _e( 'Check this box to automatically display repeatable upload fields', 'ecpt'); ?></label>
								
								<!-- render images -->
								<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
								<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable_upload_image]" name="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable_upload_image]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type->name . '_repeatable_upload_image']) && $ecpt_options['meta_fields_' . $post_type->name . '_repeatable_upload_image'] == 1) echo 'checked="checked"'; ?>/>
								<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type->name; ?>_repeatable_upload_image]"><?php _e( 'Check this box if you want to render images, rather than just displaying the urls', 'ecpt'); ?></label>
								</div>							
							</div>
							
							<?php do_action('ecpt_settings_for_bonus_field_types', $post_type->name); ?>
						
					</p>
					
				<?php } ?>
				<p><strong><?php _e('Note', 'ecpt'); ?></strong>: <?php _e('If you want more control over how meta field values are displayed, use this function:', 'ecpt'); ?> <a href="<?php echo admin_url('admin.php?page=easy-content-types-help#field-info'); ?>">ecpt_display_meta()</a></p>
				
				<p id="shopp-conflict"><strong>*</strong> <?php _e('Only one conflict has been found with this option. If you are using the Shopp Ecommerce plugin, then you should disable this option.', 'ecpt'); ?></p>
				<!-- save the options -->
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'ecpt' ); ?>" />
				</p>
								
				
			</form>
		</div><!--end ecpt-wrap-->
	</div><!--end wrap-->
		
	<?php
}

// register the plugin settings
function ecpt_register_settings() {

  	global $ecpt_db_version;
  	global $ecpt_db_tax_version;
  	global $ecpt_db_name;
  	global $ecpt_db_tax_name;

	// create whitelist of options
	register_setting( 'ecpt_settings_group', 'ecpt_settings' );
}
//call register settings function
add_action( 'admin_init', 'ecpt_register_settings' );

function ecpt_activate_license() {

	global $ecpt_options;

	if( ! isset( $_POST['ecpt_settings'] ) )
		return;

	if( ! isset( $_POST['ecpt_activate_license'] ) )
		return;

	if( ! isset( $_POST['ecpt_settings']['license_key'] ) )
		return;

	// retrieve the license from the database
	$status  = ! empty( $ecpt_options['license_status'] ) ? $ecpt_options['license_status'] : 'invalid';
	$license = trim( $_POST['ecpt_settings']['license_key'] );

	if( 'valid' == $status )
		return; // license already activated and valid

	// data to send in our API request
	$api_params = array(
		'edd_action'=> 'activate_license',
		'license' 	=> $license,
		'item_name' => 'Easy Content Types',
		'url'       => home_url()
	);

	// Call the custom API.
	$response = wp_remote_post( 'https://pippinsplugins.com', array( 'timeout' => 35, 'sslverify' => false, 'body' => $api_params ) );

	// make sure the response came back okay
	if ( is_wp_error( $response ) )
		return false;

	// decode the license data
	$license_data = json_decode( wp_remote_retrieve_body( $response ) );

	$ecpt_options['license_status'] = $license_data->license;

	update_option( 'ecpt_settings', $ecpt_options );

	delete_transient( 'ecpt_license_check' );

}
add_action( 'admin_init', 'ecpt_activate_license' );

function ecpt_deactivate_license() {

	global $ecpt_options;

	if( ! isset( $_POST['ecpt_settings'] ) )
		return;

	if( ! isset( $_POST['ecpt_deactivate_license'] ) )
		return;

	if( ! isset( $_POST['ecpt_settings']['license_key'] ) )
		return;

	// retrieve the license from the database
	$license = trim( $_POST['ecpt_settings']['license_key'] );

	// data to send in our API request
	$api_params = array(
		'edd_action'=> 'deactivate_license',
		'license' 	=> $license,
		'item_name' => 'Easy Content Types',
		'url'       => home_url()
	);

	// Call the custom API.
	$response = wp_remote_post( 'https://pippinsplugins.com', array( 'timeout' => 35, 'sslverify' => false, 'body' => $api_params ) );

	// make sure the response came back okay
	if ( is_wp_error( $response ) )
		return false;

	$ecpt_options['license_status'] = 0;

	update_option( 'ecpt_settings', $ecpt_options );

	delete_transient( 'ecpt_license_check' );

}
add_action( 'admin_init', 'ecpt_deactivate_license' );

function ecpt_check_license() {

	global $ecpt_options;

	if( ! empty( $_POST['ecpt_settings'] ) ) {
		return; // Don't fire when saving settings
	}

	$status = get_transient( 'ecpt_license_check' );

	// Run the license check a maximum of once per day
	if( false === $status ) {

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'check_license',
			'license' 	=> $ecpt_options['license_key'],
			'item_name' => 'Easy Content Types',
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( 'https://pippinsplugins.com', array( 'timeout' => 35, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		$ecpt_options['license_status'] = $license_data->license;

		update_option( 'ecpt_settings', $ecpt_options );

		set_transient( 'ecpt_license_check', $license_data->license, DAY_IN_SECONDS );

		$status = $license_data->license;

	}

	return $status;

}
add_action( 'admin_init', 'ecpt_check_license' );