<?php
/** Plugin Name: Bp Gallery
  * Version: 1.0.9.8
  * Author: Buddydev,Brajesh Singh
  * Author URI: http://buddydev.com/members/sbrajesh/
  * Plugin URI: http://buddydev.com/plugins/bp-gallery/
  * Description: The Ultimate Gallery Plugin for buddypress. Must be used with current  bp 1.5+
  * Date:March 15, 2012
  * # with mediaelement
 */
    /* Define Constants */
    define ( 'BP_GALLERY_IS_INSTALLED', 1 );
    define ( 'BP_GALLERY_VERSION', '1.0.9.7' );
    define ( 'BP_GALLERY_DB_VERSION', 22);
    define ( 'BP_GALLERY_PLUGIN_NAME', 'bp-gallery' );

    if ( !defined( 'BP_GALLERY_SLUG' ) )
            define ( 'BP_GALLERY_SLUG', 'gallery' );


    $bp_gallery_dir =str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

    define("BP_GALLERY_DIR_NAME",$bp_gallery_dir);//the directory name of bp-gallery
    define("BP_GALLERY_PLUGIN_DIR",WP_PLUGIN_DIR."/".BP_GALLERY_DIR_NAME);//WITH ANY TRAILING SLASH..MIND IT
    define("BP_GALLERY_PLUGIN_URL",WP_PLUGIN_URL."/".BP_GALLERY_DIR_NAME);//WITH ANY TRAILING SLASH..MIND IT

    add_action("bp_loaded","bp_gallery_init",1);//Hook to bp_loaded for loading the plugin, making it bp aware :)

/**
 * Load the required Files for Gallery
 * This method is hooked to bp_loaded to avoid WSOD
 */

function bp_gallery_init(){

    //we did not use plugins_url to avoid issues with pre 2.8
    require ( BP_GALLERY_PLUGIN_DIR . 'admin/install.php' );
    if(is_admin())
    require ( BP_GALLERY_PLUGIN_DIR . 'admin/admin.php' );
    /** Include the files**/
    //load gallery core files
    require ( BP_GALLERY_PLUGIN_DIR . 'core/gallery/classes.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/gallery/template-tags.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/gallery/business-functions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/gallery/permissions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/gallery/meta-functions.php' );
    //require ( BP_GALLERY_PLUGIN_DIR . 'inc/bp-gallery-templatetags.php' );
    //require ( BP_GALLERY_PLUGIN_DIR . 'inc/gallery-meta-functions.php' );
    //require ( BP_GALLERY_PLUGIN_DIR . 'inc/gallery-permissions.php' );
    //load media core files
    require ( BP_GALLERY_PLUGIN_DIR . 'core/media/classes.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/media/template-tags.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/media/business-functions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/media/permissions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/media/meta-functions.php' );

    //load members core files
    require ( BP_GALLERY_PLUGIN_DIR . 'core/members/classes.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/members/template-tags.php' );
    //require ( BP_GALLERY_PLUGIN_DIR . 'inc/core/media/business-functions.php' );
    //require ( BP_GALLERY_PLUGIN_DIR . 'inc/core/media/permissions.php' );
    //require ( BP_GALLERY_PLUGIN_DIR . 'inc/core/media/meta-functions.php' );
  
    //load screen and action functions file
    require ( BP_GALLERY_PLUGIN_DIR . 'screen-functions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'action-functions.php' );
   
    require ( BP_GALLERY_PLUGIN_DIR . 'inc/ajax.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'inc/css-js.php' );
    //upload helpers
    require ( BP_GALLERY_PLUGIN_DIR . 'core/upload-helper/upload.php' );

    require ( BP_GALLERY_PLUGIN_DIR . 'core/filters.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/widgets.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/shortcodes.php' );

   
    require ( BP_GALLERY_PLUGIN_DIR . 'ext/wp-compat.php' );
    
    //for cleaning up
    require ( BP_GALLERY_PLUGIN_DIR . 'core/activity-functions.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'core/cleanup.php' );

    //load api
    require ( BP_GALLERY_PLUGIN_DIR . 'api/component-extension.php' );
    require ( BP_GALLERY_PLUGIN_DIR . 'api/media-extension.php' );

    if ( bp_is_active( 'groups' ) )
          require ( BP_GALLERY_PLUGIN_DIR . 'ext/groups/main.php' );
    //load the pluggable functions.php from theme/gallery/functions.php
    if(bp_gallery_get_template_dir()&&file_exists(bp_gallery_get_template_dir()."/functions.php"))
        include_once(bp_gallery_get_template_dir()."/functions.php");//allow for the separation of the theme based players etc

    do_action("bp_gallery_init");
}

/*
 * Localization support
 * Put your files into
 * bp-gallery/languages/bp-gallery-your_local.mo
 */
function bp_gallery_load_textdomain() {
        $locale = apply_filters( 'bp_gallery_load_textdomain_get_locale', get_locale() );
	// if load .mo file
	if ( !empty( $locale ) ) {
		$mofile_default = sprintf( '%s/languages/%s-%s.mo', BP_GALLERY_PLUGIN_DIR, BP_GALLERY_PLUGIN_NAME, $locale );
		$mofile = apply_filters( 'bp_gallery_load_textdomain_mofile', $mofile_default );
		
                if ( file_exists( $mofile ) ) {
                    // make sure file exists, and load it
			load_textdomain( BP_GALLERY_PLUGIN_NAME, $mofile );
		}
	}
}
add_action ( 'bp_init', 'bp_gallery_load_textdomain', 2 );

/**
 * @desc Setup globals for the gallery
 * @global <type> $bp
 * @global <type> $wpdb 
 */

function bp_gallery_setup_globals() {
	global $bp, $wpdb;

	/* For internal identification */
	$bp->gallery->id = 'gallery';
	$bp->gallery->search_string = __('Search Gallery','bp-gallery');
	$bp->gallery->name = __('Gallery','bp-gallery');

	$bp->gallery->table_galleries_data = $wpdb->base_prefix . 'bp_gallery_galleries';
	$bp->gallery->table_media_data = $wpdb->base_prefix . 'bp_gallery_media';
	$bp->gallery->table_gallery_users = $wpdb->base_prefix . 'bp_gallery_members';
        $bp->gallery->table_gallery_meta=$wpdb->base_prefix . 'bp_gallery_galleries_meta';//meta data for gallery added in rc3
        $bp->gallery->table_media_meta=$wpdb->base_prefix . 'bp_gallery_media_meta';//meta data for gallery added in rc3
       
        //$bp->gallery->format_notification_function = 'gallery_format_notifications';

        $bp->gallery->slug = BP_GALLERY_SLUG;
        $bp->gallery->root_slug = BP_GALLERY_SLUG;

	/* Register this in the active components array */
	$bp->active_components[$bp->gallery->slug] = $bp->gallery->id;

	//which names are not allowed
	$bp->gallery->forbidden_names = apply_filters( 'gallery_forbidden_names', array( 'gallery','galleries','my-gallery', 'add-gallery', 'invites', 'delete', 'add','edit', 'admin', 'request','upload','tags','audio','video','photo' ) );

        //use this to extend the valid status
	$bp->gallery->valid_status = apply_filters( 'gallerey_valid_status', gallery_get_valid_status() );
	do_action( 'gallery_setup_globals' );
}

add_action( 'bp_loaded', 'bp_gallery_setup_globals', 6 );

/**
 * @desc Setup gallery as the root component
 * http://example.com/gallery/
 */

function bp_gallery_setup_root_component() {
    /* Register 'gallery' as a root component */
	bp_core_add_root_component( BP_GALLERY_SLUG );
}
add_action( 'bp_setup_root_components', 'bp_gallery_setup_root_component', 2 );



/**
 * @desc Setup Navigation menus for the gallery depending on the gallery type
 * @global <type> $bp
 */


function bp_gallery_setup_nav() {
    global $bp;
    $bp->gallery->owner_id=gallery_get_current_object_id();
    $bp->gallery->owner_type=gallery_get_current_object_type();
    
  if($gallery_id=BP_Gallery_Gallery::gallery_exists( bp_action_variable(0),$bp->gallery->owner_type,$bp->gallery->owner_id)){
    //in case of user gallery , group gallery, event gallery it will work for single gallery
        $bp->gallery->is_single_gallery = true;/* So, It is a single gallery or media right ?*/
        $bp->gallery->current_gallery=new BP_Gallery_Gallery($gallery_id);
         //check for single media
       
        if($media_id=BP_Gallery_Media::media_exists($bp->action_variables[1],$gallery_id)){
                $bp->gallery->is_single_media=true;
                $bp->gallery->current_media=new BP_Gallery_Media($media_id);
        }

        if ( is_super_admin() )
                    $bp->is_item_admin = 1;
		else
                    $bp->is_item_admin = gallery_is_user_admin( $bp->loggedin_user->id, $bp->gallery->current_gallery->id );

		/* If the user is not an admin, check if they are a moderator */
//		if ( !$bp->is_item_admin ) //for v1.1
//			$bp->is_item_mod = gallery_is_user_mod( $bp->loggedin_user->id, $bp->gallery->current_gallery->id);

		/* Is the logged in user a member of the gallery? */
		$bp->gallery->current_gallery->is_user_member = ( is_user_logged_in() && gallery_is_user_member( $bp->loggedin_user->id, $bp->gallery->current_gallery->id ) ) ? true : false;

		/* Should this gallery be visible to the logged in user? */
		$bp->gallery->current_gallery->is_gallery_visible_to_member = ( 'public' == $bp->groups->current_gallery->status ||$bp->gallery->current_gallery->is_user_member ) ? true : false;

    }

//now set various variables for the gallery
if(bp_is_current_component($bp->gallery->slug)){
  /**
   * If current component is gallery, It must be either the User gallery or the Standalone gallery
   */
   if(bp_is_user())
       /* this is a users gallery i.e members/admin/gallery/some gallery */
      $bp->gallery->is_user_gallery=true;//this belongs to user/users
      
   else     /*** This is a stand alone gallery*/
       $bp->gallery->is_standalone_gallery=true;//no implemented in v1.0
 }/*** else if gallery is the current action, It is associated gallery**/
else if($bp->current_action==$bp->gallery->slug){
        $allowed_components=bp_gallery_get_allowed_components();
        if(in_array($bp->current_component,$allowed_components)){
             $bp->gallery->is_associated_gallery=true;
                 }
    }

	/**
     *  User Profile Navigation Items
     */
    /**
     *  Add 'Gallery' to the User's main navigation
     *  */
    if(!bp_is_gallery_enabled_for('user'))//allow to disable user galleries in case they don't want it
        return false;
     bp_core_new_nav_item( array( 'name' =>  sprintf( __( 'Gallery <span>%d</span>', 'bp-gallery' ),gallery_total_gallery_for_user()), 'slug' => $bp->gallery->slug, 'position' => 86, 'screen_function' => 'gallery_screen_my_galleries', 'default_subnav_slug' => 'my-galleries', 'item_css_id' => $bp->gallery->id ) );
     $gallery_link = $bp->loggedin_user->domain . $bp->gallery->slug . '/';

    /* Add the subnav items to the gallery nav item */
    bp_core_new_subnav_item( array( 'name' => __( 'My Gallery', 'bp-gallery' ), 'slug' => 'my-galleries', 'parent_url' => $gallery_link, 'parent_slug' => $bp->gallery->slug, 'screen_function' => 'gallery_screen_my_galleries', 'position' => 10, 'item_css_id' => 'gallery-my-gallery' ) );
    bp_core_new_subnav_item( array( 'name' => __( 'Create a Gallery', 'bp-gallery' ), 'slug' => 'create', 'parent_url' => $gallery_link, 'parent_slug' => $bp->gallery->slug, 'screen_function' => 'gallery_screen_create_gallery', 'position' => 20, 'user_has_access' => bp_is_my_profile() ) );
    //bp_core_new_subnav_item( array( 'name' => __( 'Edit Galleries', 'bp-gallery' ), 'slug' => 'edit', 'parent_url' => $gallery_link, 'parent_slug' => $bp->gallery->slug, 'screen_function' => 'gallery_screen_edit_gallery', 'position' => 20, 'user_has_access' => bp_is_my_profile() ) );
    bp_core_new_subnav_item( array( 'name' => __( 'Upload', 'bp-gallery' ), 'slug' => 'upload', 'parent_url' => $gallery_link, 'parent_slug' => $bp->gallery->slug, 'screen_function' => 'gallery_screen_upload_media', 'position' => 20, 'user_has_access' => bp_is_my_profile() ) );
 
    //do not setup the navigation item for other components here, let them do it for themself
    $access=isset($bp->gallery->current_gallery->user_has_access)?$bp->gallery->current_gallery->user_has_access:'';
    do_action( 'gallery_setup_nav',$access );


}

add_action( 'bp_setup_nav', 'bp_gallery_setup_nav',10 );
/** Setup admin bar when using the WP Admin Bar*/

function bp_gallery_setup_wp_adminbar(){
        global $bp;
        if ( defined( 'DOING_AJAX' ) )
                return;

        // Do not proceed if BP_USE_WP_ADMIN_BAR constant is not set or is false
        if ( !bp_use_wp_admin_bar() )
                return;
        global $wp_admin_bar;
        
        if ( is_user_logged_in() ) {

			// Setup the logged in user variables
			$user_domain = $bp->loggedin_user->domain;
			
			$gallery_link = $user_domain  . $bp->gallery->slug . '/';

		
			$title   = sprintf( __( 'Gallery <span class="count">%s</span>','bp-gallery' ), gallery_total_gallery_for_user() );
				
			

			// Add the "My Account" sub menus
			$wp_admin_nav[] = array(
				'parent' => $bp->my_account_menu_id,
				'id'     => 'my-account-gallery',
				'title'  => $title,
				'href'   => trailingslashit( $gallery_link)
			);

			// My Groups
			$wp_admin_nav[] = array(
				'parent' => 'my-account-gallery',
				'id'     => 'my-account-gallery'. '-my-gallery',
				'title'  => __( 'My Gallery', 'bp-gallery' ),
				'href'   => trailingslashit( $gallery_link )
			);

			// Invitations
			$wp_admin_nav[] = array(
				'parent' => 'my-account-gallery',
				'id'     => 'my-account-gallery-create',
				'title'  => __('Create a Gallery', 'bp-gallery'),
				'href'   => trailingslashit( $gallery_link . 'create' ));
			$wp_admin_nav[] = array(
				'parent' => 'my-account-gallery',
				'id'     => 'my-account-gallery-upload',
				'title'  => __( 'Upload', 'bp-gallery' ),
				'href'   => trailingslashit( $gallery_link . 'upload' ));
			
		}
         foreach( $wp_admin_nav as $admin_menu )
				$wp_admin_bar->add_menu( $admin_menu );       
}
add_action('bp_setup_admin_bar','bp_gallery_setup_wp_adminbar');

/**
 * @desc gallery directory page
 * @global <type> $bp
 */
function bp_gallery_directory_gallery_setup() {
	global $bp;
    if(!function_exists("bp_core_load_template"))
        return;
if ( !bp_is_user()&&bp_is_current_component($bp->gallery->slug) && empty( $bp->current_action ) && empty( $bp->current_item ) ) {
		$bp->is_directory = true;
                $bp->gallery->is_directory=true;
		do_action( 'gallery_directory_gallery_setup' );
		bp_core_load_template( apply_filters( 'gallery_directory_gallery_setup', 'gallery/index' ) );
	}
}
//for v1.1
add_action( 'bp_screens', 'bp_gallery_directory_gallery_setup', 4 );






/**
 * @desc Add menu to wp-dashboard| Buddypress->Gallery Settings for basic settings of the gallery
 * @global <type> $wpdb
 * @global <type> $bp
 * @return <type>
 */

function bp_gallery_add_admin_menu() {
	global $wpdb, $bp;

	if ( !is_super_admin() )
		return false;
	/* Add the administration tab under the "BuddyPress" tab for site administrators */
	add_submenu_page( 'bp-general-settings', __("Gallery", 'bp-gallery'), __("Gallery Settings", 'bp-gallery'), 'manage_options', "gallery_admin_settings", "gallery_admin_settings" );
}
add_action( is_multisite() ? 'network_admin_menu' : 'admin_menu', 'bp_gallery_add_admin_menu' ,20);




/**
 * @desc Fixing Problem for front end flash upload issue
 *  Store Auth cookie for Site front end
 */
/*because wordpress will not set authentication cookie for front page, but for Flashupload we need them, other wise it will not work, so let us set them here*/
add_action("set_auth_cookie","bp_gallery_set_site_cookie",10,5);

function bp_gallery_set_site_cookie($auth_cookie, $expire, $expiration, $user_id, $scheme){

$secure = is_ssl() ? true : false;
if ( $secure ) {
		$auth_cookie_name = SECURE_AUTH_COOKIE;
		$scheme = 'secure_auth';
	} else {
		$auth_cookie_name = AUTH_COOKIE;
		$scheme = 'auth';
	}

// Set httponly if the php version is >= 5.2.0
	if ( version_compare(phpversion(), '5.2.0', 'ge') ) {
		setcookie($auth_cookie_name, $auth_cookie, $expire, SITECOOKIEPATH, COOKIE_DOMAIN, $secure, true);
	} else {
		$cookie_domain = COOKIE_DOMAIN;
		if ( !empty($cookie_domain) )
			$cookie_domain .= '; HttpOnly';
		setcookie($auth_cookie_name, $auth_cookie, $expire, SITECOOKIEPATH, $cookie_domain, $secure);
	}
}


/** 
 * @desc Clear the authentication cookie when User logs out
 */
add_action("clear_auth_cookie","bp_gallery_clear_site_cookie");
function bp_gallery_clear_site_cookie(){
        setcookie(AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
	// Old cookies
	setcookie(AUTH_COOKIE, ' ', time() - 31536000, COOKIEPATH, COOKIE_DOMAIN);
	setcookie(AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
	setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
	setcookie(SECURE_AUTH_COOKIE, ' ', time() - 31536000, SITECOOKIEPATH, COOKIE_DOMAIN);
}


/************ Gallery Cleanup Functions ****************************************************/
//when user is deleted
//when group is deleted, delete associated gallery or attribute to someone else
//when user is spammed/banned
//when gallery is deleted

//clear chache when gallery is deleted/user is deleted/group is deleted/gallery updated/,media updated , file uploaded
/* -------------------------------- Cache Cleanup function ----------------------------------------------------------*/



/*-- Gallery deleting/synchronization functions ---------------------------------------------------------------------*/

add_action( 'wpmu_delete_user', 'gallery_delete_galleries_for_user', 1 );
add_action( 'delete_user', 'gallery_delete_galleries_for_user', 1 );
add_action( 'make_spam_user', 'gallery_delete_galleries_for_user', 1 );
//add_action("wpmu_delete_user","gallery_delete_galleries_for_user");
//add_action("delete_user","gallery_delete_galleries_for_user");
function gallery_delete_galleries_for_user($user_id){
    BP_Gallery_Gallery::delete_gallery_for_user($user_id);
}
//delete user

// List actions to clear object caches on
//add_action( 'gallery_gallery_deleted', 'gallery_clear_gallery_object_cache' );
//add_action( 'gallery_details_updated', 'gallery_clear_gallery_object_cache' );



function bp_gallery_action_search_site( $search_url,$search_term ) {
	global $bp;
        $search_which = $_POST['search-which'];
        $search_terms = $_POST['search-terms'];
	if($search_which==BP_GALLERY_SLUG){
		$search_url = site_url( BP_GALLERY_SLUG . "?s=" . urlencode($search_terms) );
        }
     return $search_url;
}
add_filter( "bp_core_search_site", "bp_gallery_action_search_site",12,2 );

//v 1.0





?>