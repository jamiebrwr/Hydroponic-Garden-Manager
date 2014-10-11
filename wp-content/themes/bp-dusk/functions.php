<?php
/**
 * custody-agreements functions and definitions
 *
 * @package custody-agreements
 */
 
// Set path to WooFramework and theme specific functions
$functions_path = STYLESHEETPATH . '/functions/';
$includes_path = STYLESHEETPATH . '/inc/';

// Theme specific functionality
//require_once ($includes_path . 'srh-image-sizes.php'); 			// Register custom image sizes
require_once ($includes_path . 'theme-actions.php'); 		// Register Custom Wigetized Areas
require_once ($includes_path . 'srh-post-types.php'); 		// Custom Actions and Filters
require_once ($includes_path . 'srh-classes.php'); 		// Custom Actions and Filters

//require_once ($functions_path . 'srh-admin-hooks.php'); 		// Custom Actions and Filters

function fod_post_author_avatar() {
global $post;

if ( function_exists('bp_core_fetch_avatar') ) {
    echo apply_filters( 'bp_post_author_avatar', bp_core_fetch_avatar( array( 'item_id' => $post->post_author, 'type' => 'full' ) ) );  
} else if ( function_exists('get_avatar') ) {
    get_avatar();
}
}


if ( !function_exists( 'bp_dtheme_enqueue_styles' ) ) :
    function bp_dtheme_enqueue_styles() {}
endif;

function srh_enqueue_scripts() {
 
    // You should bump this version when changes are made to bust cache
    $version = '20130629';
 
    // Register stylesheet of bp-dusk child theme
    wp_register_style( 'bp-dusk', get_stylesheet_directory_uri() . '/style.css', array(), $version );
 
    // Enqueue stylesheet of bp-dusk chid theme
    wp_enqueue_style( 'bp-dusk' );
    
    wp_enqueue_style( 'style.default', get_stylesheet_directory_uri() . '/css/style.default.css', array(), '1.0.0', true );
    
}
add_action( 'wp_enqueue_scripts', 'srh_enqueue_scripts' );
            
            
add_theme_support( 'post-thumbnails', array( 'my_garden' ) );          // Posts only
if ( function_exists( 'add_image_size' ) ) { 
	//add_image_size( 'journal-thumb', 305 ); //300 pixels wide (and unlimited height)
	//add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
}

add_theme_support( 'buddypress' );




/* Preloader */
function srh_preloader(){
	echo '<!-- Preloader -->
	<div id="preloader">
	    <div id="status" style="display: none;">
	    	<i class="fa fa-spinner fa-spin"></i>
	    </div>
	</div>';
}

/* Hide the adminbar on the frontend */
//show_admin_bar( false );




function srh_login_form_top() {
	return '<h4 class="nomargin">Sign In</h4><p>Login to access your account.</p>';
}
add_filter( 'login_form_top', 'srh_login_form_top' );




$defaults = array( 
 	'after'           => '', 
 	'before'          => '', 
 	'container'       => 'div', 
 	'container_class' => '', 
 	'container_id'    => '', 
 	'depth'           => 0, 
 	'echo'            => true, 
 	'fallback_cb'     => false, 
 	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>', 
 	'link_after'      => '', 
 	'link_before'     => '', 
 	'menu_class'      => 'menu', 
 	'menu_id'         => '', 
 	'walker'          => '', 
 	);
$items = apply_filters( 'bp_nav_menu_items', $items, $args );






// my custom notification menu www.cityflavourmagazine.com

function my_bp_adminbar_notifications_menu() {
global $bp;

if ( !is_user_logged_in() )
    return false;

if ( $notifications = bp_core_get_notifications_for_user( $bp->loggedin_user->id ) ) {
	
	/* Notifications override for testing */
	$notifications = 16;
?>
    <span class="badge"><?php echo count( $notifications ) ?></span>
<?php
}

echo '<h5 class="title">You Have '.$notifications.' New Notifications</h5>';
echo '<ul class="dropdown-list gen-list">';

if ($notificaions ) {
    $counter = 0;
    for ( $i = 0; $i < count($notifications); $i++ ) {
        $alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>

        <li<?php echo $alt ?> class="new">
        	
        	<?php echo $notifications[$i] ?>
        	<a href="">
				<span class="thumb"><img src="images/photos/user4.png" alt=""></span>
				<span class="desc">
					<span class="name">Zaham Sindilmaca <span class="badge badge-success">new</span>
				</span>
				<span class="msg">is now following you</span>
				</span>
			</a>
        </li>
		<li class="new"><a href="">See All Notifications</a></li>
        <?php $counter++;
    }
} else { ?>

    <li><a href="<?php echo $bp->loggedin_user->domain ?>"><?php _e( '<span class="badge">'.$notifications.'</span>', 'buddypress' ); ?></a></li>

<?php
}

echo '</ul>';
}

















