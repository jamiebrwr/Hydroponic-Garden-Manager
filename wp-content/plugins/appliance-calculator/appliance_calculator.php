<?php
/*
Plugin Name: Appliance Calculator
Plugin URI: http://www.webfulcreations.com/
Description: Calculates appliances electricity rates and KWH usage.
Version: 1.0
Author: Ateeq Rafeeq 
Author URI: http://www.webfulcreations.com/
License: Codecanyon All rights reserved..
*/

if (!defined('WP_CONTENT_DIR'))
    define('WP_CONTENT_DIR', ABSPATH.'wp-content');
if (!defined('FT_APPLIANCE_CALC_DIR'))
    define('FT_APPLIANCE_CALC_DIR', '/wp-content/plugins/appliance-calculator');
//end of defining locations. for plugin directory.

include_once(dirname(__FILE__) .'/activate.php'); //Activate plugin functions.
register_activation_hook(__FILE__, 'ft_appliance_calculator_install'); //plugin activation hook.


include_once(dirname(__FILE__).'/admin_menu.php'); //admin menu functions
add_action('admin_menu', 'ft_ad_pages'); // Hook for adding admin menus

//admin pages starts here.
include_once(dirname(__FILE__).'/includes/main_page.php'); //Main Page Function.
include_once(dirname(__FILE__).'/includes/ft_apperance.php'); //Add Category Function.
include_once(dirname(__FILE__).'/includes/ft_settings.php'); //Add Category Function.
include_once(dirname(__FILE__).'/includes/shortcodes.php'); //Add food Function.
include_once(dirname(__FILE__).'/includes/content_controls.php'); //Add food Function.
//admin pages ends here.


//adding styles and scripts to theme front end,.
function ft_enqeue_scripts() { 
	if(get_option('active_ft_tab_layout') == 'vertical') { 
		wp_register_style('sm-style', FT_APPLIANCE_CALC_DIR.'/css/vertical_layout.css', array());
	} else if(get_option('active_ft_tab_layout') == 'horizontal') { 
		wp_register_style('sm-style', FT_APPLIANCE_CALC_DIR.'/css/style.css', array());
	}
		wp_enqueue_style('sm-style');	
	//addingstyles
	wp_enqueue_script('jquery');
	wp_register_script('ft-front-js', FT_APPLIANCE_CALC_DIR.'/js/mycalculator.js', array('jquery'), '1.1');
    wp_enqueue_script('ft-front-js');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-accordion');
}
add_action('wp_enqueue_scripts', 'ft_enqeue_scripts');
//enque scripts and styles ends here. For theme front.

//adding styles and scripts for worpress admin
add_action('admin_enqueue_scripts', 'calculator_admin_scripts');
 
function calculator_admin_scripts() {
		//register admin js.
		if(isset($_GET['page']) && $_GET['page'] == 'ft_app_cal_appearance') { 
			wp_enqueue_script('jquery');
			wp_enqueue_script('iris');
			wp_register_script('ft-admin-js', FT_APPLIANCE_CALC_DIR.'/js/my-admin.js', array('jquery'), '1.1');
			wp_enqueue_script('ft-admin-js');
		}
}
//end of adding styles and scripts for wordpress admin.