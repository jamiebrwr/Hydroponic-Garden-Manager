<?php
/**
 * Plugin Name: #SRH⌥Tricks→
 * Plugin URI: http://brewerjwebdesign.com/
 * Description: WordPress Utility Plugin to show and hide Core WordPress Elements.
 * Author: Jamie Brewer
 * Version: 1.0.1
 * Author URI: http://jamiebrewer.com/
 *
 * @package WordPress 3.9.1
 * @sub_package #SRH⌥Tricks→ 1.0
 * @version 1.0
*/

/*-------------------------------------------------------------------------------------------*/
/* Hide admin menus from all users except for login_id "jamie" */
/*-------------------------------------------------------------------------------------------*/
/**
 * Pluggable
 *
 * Tap User Metadata
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
if(!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php"); 
}


add_action( 'admin_menu', 'srh_remove_menu_pages' );
/**
 * Remove Admin Pages
 *
 * Removes Admin pages from the backend administration menu.
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
function srh_remove_menu_pages() {
     
    /* admin_menu hook function/callback */
    add_action('admin_init', 'srh_check_username');
 
    function srh_check_username() {
     
        /* Retrieve the current user object (WP_User) */
        $user = wp_get_current_user();
 
        if( $user && isset( $user->user_login ) && 'tom' !== $user->user_login ) {
            /* Hide other users menus */
            /* Top level core menu items */
            remove_menu_page('link-manager.php');
            remove_menu_page('srh-tricks');
            remove_menu_page('users.php');
            remove_menu_page('edit.php');
            //remove_menu_page('edit.php?post_type=slide');
            remove_menu_page('edit.php?post_type=portfolio');
            remove_menu_page('edit-comments.php');
            remove_menu_page('edit.php?post_type=feedback');
            remove_menu_page('tools.php');
            remove_menu_page('edit.php?post_type=page');
            //remove_menu_page('options-general.php');
            //remove_menu_page('update-core.php');
            /* Top level plugin menu items */
            remove_menu_page('edit.php?post_type=logos');
            remove_menu_page('viva_plugins');
            //remove_menu_page('easy-content-types');
            remove_menu_page('ot-settings');
            //remove_menu_page('pb_backupbuddy_getting_started');
            //remove_menu_page('wp_stream');
            remove_menu_page( 'jetpack'  );
            /* Sub Menus */
            remove_submenu_page( 'themes.php', 'theme-editor.php'  );
            //remove_submenu_page( 'themes.php', 'widgets.php'  );
            remove_submenu_page( 'themes.php', 'customize.php'  );
            remove_submenu_page( 'themes.php', 'editcss'  );
            remove_submenu_page( 'themes.php', 'themes.php'  );
            remove_submenu_page( 'themes.php', 'ot-theme-options'  );
            remove_submenu_page( 'index.php', 'update-core.php'  );
            //remove_submenu_page( 'plugins.php', 'plugin-editor.php'  );
            remove_submenu_page( 'woothemes', 'woo-meta-manager'  );
            remove_submenu_page( 'woothemes', 'woo-hook-manager'  );
            remove_submenu_page( 'woothemes', 'woo-layout-manager'  );
            remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' );
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'edit.php?post_type=page', 'ce-page-column-editor'  );
			remove_submenu_page( 'edit.php?post_type=feature', 'ce-feature-column-editor');
			remove_submenu_page( 'edit.php?post_type=products', 'ce-products-column-editor');
			remove_submenu_page( 'edit.php?post_type=slides', 'ce-slides-column-editor');
            
            
            remove_submenu_page( 'gf_edit_forms', 'gf_settings'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_export'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_update'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_addons'  );
            remove_submenu_page( 'gf_edit_forms', 'gf_help'  );
            
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            
            
            remove_submenu_page( 'edit.php?post_type=page', 'ce-page-column-editor'  );
			//remove_submenu_page( 'edit.php?post_type=projects', 'ce-projects-column-editor');
			remove_submenu_page( 'edit.php?post_type=testimonial', 'ce-testimonial-column-editor');
        } else {
            /* hide admin menus from user_login 'jamie' */
            remove_menu_page('link-manager.php');
            remove_menu_page('edit.php');
            remove_menu_page('users.php');
            //remove_menu_page('edit.php?post_type=slide');
            remove_menu_page('edit.php?post_type=portfolio');
            remove_menu_page('edit.php?post_type=feedback');
            remove_menu_page('tools.php');
            /* Sub Menus */
            //remove_submenu_page( 'plugins.php', 'plugin-editor.php'  );
            remove_submenu_page( 'edit.php', 'ce-post-column-editor'  );
            remove_submenu_page( 'woothemes', 'woo-meta-manager'  );
            remove_submenu_page( 'woothemes', 'woo-hook-manager'  );
            remove_submenu_page( 'woothemes', 'woo-layout-manager'  );
            remove_submenu_page( 'edit.php?post_type=page', 'easy-content-types'  );
            remove_submenu_page( 'edit.php?post_type=page', 'ce-page-column-editor'  );
        }
    }
}

/**
 * Remove Admin Bar Links
 *
 * Removes specified links from the admin toolbar.
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
function remove_admin_bar_links() {
	    global $wp_admin_bar;
	    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
	    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
	    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
	    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
	    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
	    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
	    //$wp_admin_bar->remove_menu('site-name');      // Remove the site name menu
	    //$wp_admin_bar->remove_menu('view-site');      // Remove the view site link
	    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
	    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
	    //$wp_admin_bar->remove_menu('new-content');    // Remove the content link
	    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
	    //$wp_admin_bar->remove_menu('my-account');     // Remove the user details tab
	}
	add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );


/**
 * Remove Dashboard Metaboxes
 *
 * Removes metaboxes from the Dashboard.
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
//$user = wp_get_current_user();
if (is_admin() && $user && isset( $user->user_login ) && 'jamie' !== $user->user_login ) :
function remove_dashboard_widgets(){
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
    remove_meta_box('pb_backupbuddy_stats', 'dashboard', 'normal');   // Other WordPress News
    remove_meta_box('dashboard_stream_activity', 'dashboard', 'normal');   // Other WordPress News
    remove_meta_box('dashboard_stream_activity', '', 'normal');   // Other WordPress News
    remove_meta_box('tribe_dashboard_widget', '', 'normal');   // Events Calendar
// use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
endif;


/**
 * Append $string to OptionTree Admin Screen
 *
 * Appends a $string oran $array to the header bar
 * in the OptionTree admin screen.
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
add_action( 'ot_header_list', 'srhricks'); #TODO - This isn't quite Working
function srhricks(){
	//echo 'Sweet! It works!';
}

/**
 * Update Optiontree Version Number
 *
 * Updates the Version Number for Optiontree
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
add_action( 'ot_header_list', 'srh_switch');
function srh_switch(){
	remove_action('ot_header_version_text','Hello' . OT_VERSION, $page['id'], 20 );
}


/**
 * Hide from Plugins List
 *
 * Removes Plugins from the plugins admin screen.
 *
 * @since 3.9.1
 * @access (for functions: only use if private)
 *
 * @see Function/method/class relied on
 * @link URL
 * @global type $varname Short description.
 *
 * @param  type $var Description.
 * @param  type $var Optional. Description.
 * @return type Description.
 */
function hide_plugin_srhtrick() {
  global $wp_list_table;
  $hidearr = array(
		'jquery-accordion-slideshow/jquery-accordion-slideshow.php',
		'option-tree/ot-loader.php',
		'stream/stream.php','what-the-file/what-the-file.php',
		'backupbuddy/backupbuddy.php','srh/srh.php',
		'SRH-Tricks-master/srh.php',
		'user-switching/user-switching.php',
		'easy-content-types/easy-content-types.php',
		'column-editor/column-editor.php',
		'ecpt-bonus-fields/ecpt-bonus-fields.php',
	);
  $myplugins = $wp_list_table->items;
  foreach ($myplugins as $key => $val) {
	if (in_array($key,$hidearr)) {
	  unset($wp_list_table->items[$key]);
	}
  }
}
add_action('pre_current_active_plugins', 'hide_plugin_srhtrick');



?>
