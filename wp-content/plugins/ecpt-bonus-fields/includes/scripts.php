<?php

// load the bonus fields scripts
function ecpt_bonus_fields_scripts() {
	wp_enqueue_script('farbtastic');
	wp_enqueue_script('ecpt-bonus-fields-scripts', ECPT_BF_PATH . '/assets/js/bonus-fields.js');
}
add_action('admin_print_scripts-post.php', 'ecpt_bonus_fields_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_bonus_fields_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_bonus_fields_scripts');

// load the bonus fields styles
function ecpt_bonus_fields_styles() {
	wp_enqueue_style('farbtastic');
}
add_action('admin_print_styles-post.php', 'ecpt_bonus_fields_styles');
add_action('admin_print_styles-edit.php', 'ecpt_bonus_fields_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_bonus_fields_styles');

function ecpt_bonus_fields_help_styles() {
	wp_enqueue_style('ecpt-admin', ECPT_BF_PATH . 'includes/css/admin-styles.css');
}
if(isset($_GET['page']) && $_GET['page'] == 'ecpt-bonus-fiends-help') {
	add_action('admin_print_styles', 'ecpt_bonus_fields_help_styles');
}