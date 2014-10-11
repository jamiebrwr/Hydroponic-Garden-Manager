<?php
/*
Plugin Name: Easy Content Types: Bonus Meta Field Types
Plugin URI: http://pippinsplugins.com/easy-content-types-bonus-fields/
Description: Provides several additional field types for the Easy Content Types Plugin, including taxonomy select, menu select, color picker, google map, and separator
Author: Pippin Williamson
Author URI: http://pippinsplugins.com
Version: 1.1.6
*/

/******************************************************
* globals
******************************************************/

define( 'ECPT_BF_URL', plugin_dir_url( __FILE__ ) );
define( 'ECPT_BF_PATH', plugin_dir_path( __FILE__ ) );

/******************************************************
* includes
******************************************************/
if(is_admin()) {
	include( ECPT_BF_PATH . 'includes/help.php');
}
include( ECPT_BF_PATH . 'includes/scripts.php');
include( ECPT_BF_PATH . 'includes/shortcodes.php');
include( ECPT_BF_PATH . 'includes/functions.php');

// displays a message if ECPT is below the required version
function ecpt_plugin_version_notice() {
	// not sure the is_admin check is necessary, but just to be safe because get_plugin_data is only avail in admin
	if(is_admin()) {
	  	$ecpt = get_plugin_data(WP_PLUGIN_DIR . '/easy-content-types/easy-content-types.php');
		if( $ecpt['Version'] < '2.3.3' ) {

			$message = 'Your copy of Easy Content Types is below the required version. Please upgrade.';

			echo '<div id="message" class="error"><p><strong>' . $message . '</strong></p></div>';
		}
	}
}
add_action('admin_notices', 'ecpt_plugin_version_notice');


// makes additionals field types available
function ecpt_bonus_field_types($field_types) {

	$field_types[] = 'taxonomy';
	$field_types[] = 'separator';
	$field_types[] = 'header';
	$field_types[] = 'menu';
	$field_types[] = 'colorpicker';
	$field_types[] = 'map';

	return $field_types;
}
add_filter('ecpt_field_types','ecpt_bonus_field_types');


// generates the HTML for the additional fields
function ecpt_bonus_fields_html($field_html, $field, $meta) {

	switch($field['type']) :

		case 'taxonomy' :
			// returns the options html for select fields
			$field_options = ecpt_get_field_options($field, $meta);
			$field_html =  '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . $field_options . '</select><br/>' . $field['desc'];
			break;

		case 'separator' :
			$field_html = '<hr/>';
			break;

		case 'header' :
			$field_html = '<p>' . $field['desc'] . '</p>';
			break;

		case 'menu' :
			// returns the options html for select fields
			$field_options = ecpt_get_field_options($field, $meta);
			$field_html = '<select name="' . $field['id'] . '" id="' . $field['id'] . '">' . $field_options . '</select><br/>' . $field['desc'];
			break;

		case 'colorpicker' :
			if (empty($meta)) $meta = '#';
			$field_html = "<input class='ecpt-color' type='text' name='" . $field['id'] . "' id='" . $field['id'] . "' value='" . $meta . "' size='8' />
					<a href='#' class='ecpt-color-select' rel='" . $field['id'] . "'>" . __('Select a color') . "</a>
					<a href='#' class='ecpt-color-select' style='display: none;'>" . __('Hide Picker') . "</a>
					<div style='display:none; position: absolute; background: #f0f0f0; border: 1px solid #ccc; z-index: 100;' class='ecpt-color-picker' rel='" . $field['id'] . "'></div>";
			break;

		case 'map' :
			$field_html = '<input type="text" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" style="width:97%" /><br/>' . $field['desc'];
			break;
		default :
			$field_html = $field_html;

	endswitch;

	return $field_html;
}
add_filter('ecpt_fields_html', 'ecpt_bonus_fields_html', 10, 3);


function ecpt_get_field_options($field, $meta) {

	$field_options = '';

	// sets up the select options for the taxonomy field
	if($field['type'] == 'taxonomy') {

		$taxonomies = get_taxonomies('', 'names');

		foreach($taxonomies as $t) {
			$selected = '';
			if($meta == $t) { $selected = 'selected="selected"'; }
			$field_options .= '<option value="' . $t . '"' . $selected . '>' . $t . '</option>';
		}
	}
	if($field['type'] == 'menu') {
		$menus = wp_get_nav_menus( array('orderby' => 'name') );

		foreach($menus as $index => $menu) {
			$selected = '';
			if($meta == $menu->slug) { $selected = 'selected="selected"'; }
			$field_options .= '<option value="' . $menu->slug . '"' . $selected . '>' . $menu->name . '</option>';
		}
	}

	return $field_options;
}

// modify the labels for the bonus fields (if needed)
function ecpt_bonus_fields_labels($label, $field) {

	if($field['type'] == 'separator') {
		// removes the label for the separator field
		return;
	}
	if($field['type'] == 'header') {
		return '<h4>' . $label . '</h4>';
	}
	return $label;
}
add_filter('ecpt_field_label_filter', 'ecpt_bonus_fields_labels', 10, 2);

function ecpt_show_bonus_field_types_in_auto_display($display, $value, $field, $descriptions = false ) {
	switch($field->type) :
		case 'map' :
			if( strlen( trim( $value ) ) > 1 ) {
				$display .= '<li class="ecpt_field ecpt_' . $field->type . '_field" id="ecpt_' . $field->name . '">';
					$display .= '<div class="ecpt_field_name">' . $field->nicename . '</div>';
					if( $descriptions ) {
						$display .= '<div class="ecpt_field_desc">' . $field->description . '</div>';
					}
					$display .= '<div class="ecpt_field_content ecpt_map">' . ecpt_display_map( array( 'id' => $field->name ) ) . '</div>';
				$display .= '</li>';
			}
		break;
	endswitch;
	return $display;
}
add_filter('ecpt_display_fields', 'ecpt_show_bonus_field_types_in_auto_display', 10, 4);

function ecpt_add_settings_for_bonus_fields($post_type) {

	global $ecpt_options;
	?>
	<!--map field-->
	<div style="border-left: 1px solid #ccc; padding-left: 25px;" class="meta-field-option">
		<input class="checkbox" id="ecpt_settings[meta_fields_<?php echo $post_type; ?>_map]" name="ecpt_settings[meta_fields_<?php echo $post_type; ?>_map]" type="checkbox" value="1" <?php if ( isset($ecpt_options['meta_fields_' . $post_type . '_map']) && $ecpt_options['meta_fields_' . $post_type . '_map'] == 1) echo 'checked="checked"'; ?>/>
		<label class="description" for="ecpt_settings[meta_fields_<?php echo $post_type; ?>_map]"><?php _e( 'Check this box to automatically display a google map for map fields.', 'ecpt'); ?></label>
	</div>
	<?php
}
add_action('ecpt_settings_for_bonus_field_types', 'ecpt_add_settings_for_bonus_fields', 10);

function ecpt_setup_enabled_types_for_auto_display($types, $post_type) {

	global $ecpt_options;

	if( isset( $ecpt_options['meta_fields_' . $post_type . '_map'] ) )
		$types[] = 'map';

	return $types;
}
add_filter('ecpt_enabled_types_for_auto_display', 'ecpt_setup_enabled_types_for_auto_display', 10, 2);