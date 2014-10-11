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
            
            
add_theme_support( 'post-thumbnails', array( 'my_garden' ) );          // Posts only
if ( function_exists( 'add_image_size' ) ) { 
	//add_image_size( 'journal-thumb', 305 ); //300 pixels wide (and unlimited height)
	//add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
}
//add_theme_support( 'buddypress' );
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'custody_agreements_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function custody_agreements_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on custody-agreements, use a find and replace
	 * to change 'custody-agreements' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'custody-agreements', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'custody-agreements' ),
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'custody_agreements_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // custody_agreements_setup
add_action( 'after_setup_theme', 'custody_agreements_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function custody_agreements_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'custody-agreements' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'custody_agreements_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function custody_agreements_scripts() {
	wp_enqueue_style( 'custody-agreements-style', get_stylesheet_uri() );

	wp_enqueue_script( 'custody-agreements-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'custody-agreements-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'custody_agreements_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/*-------------------------------------------------------------------------------------------*/
/* ADDITIONS */
/*-------------------------------------------------------------------------------------------*/

/**
 * Enqueue scripts and styles
 */
function srh_enqueue_scripts() {
    wp_enqueue_style( 'style.default', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0', true );
    
    /*
    wp_enqueue_style( 'animate.delay', get_stylesheet_directory_uri() . '/css/animate.delay.css', array(), '1.0.0', true );
    wp_enqueue_style( 'animate.min', get_stylesheet_directory_uri() . '/css/animate.min.css', array(), '1.0.0', true );
    wp_enqueue_style( 'bootstrap-fileupload.min', get_stylesheet_directory_uri() . '/css/bootstrap-fileupload.min.css', array(), '1.0.0', true );
    wp_enqueue_style( 'bootstrap-override', get_stylesheet_directory_uri() . '/css/bootstrap-override.css', array(), '1.0.0', true );
    wp_enqueue_style( 'bootstrap-timepicker.min', get_stylesheet_directory_uri() . '/css/bootstrap-timepicker.min.css', array(), '1.0.0', true );
    
    wp_enqueue_style( 'bootstrap-wysihtml5', get_stylesheet_directory_uri() . '/css/bootstrap-wysihtml5.css', array(), '1.0.0', true );
    wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.css', array(), '1.0.0', true );
    wp_enqueue_style( 'bootstrap.min', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', true );
    wp_enqueue_style( 'chosen', get_stylesheet_directory_uri() . '/css/chosen.css', array(), '1.0.0', true );
    wp_enqueue_style( 'colorpicker', get_stylesheet_directory_uri() . '/css/colorpicker.css', array(), '1.0.0', true );
    
    wp_enqueue_style( 'dropzone', get_stylesheet_directory_uri() . '/css/dropzone.css', array(), '1.0.0', true );
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome.css', array(), '1.0.0', true );
    wp_enqueue_style( 'font-awesome.min', get_stylesheet_directory_uri() . '/css/font-awesome.min.css', array(), '1.0.0', true );
    wp_enqueue_style( 'font.helvetica-neue', get_stylesheet_directory_uri() . '/css/font.helvetica-neue.css', array(), '1.0.0', true );
    wp_enqueue_style( 'font.roboto', get_stylesheet_directory_uri() . '/css/font.roboto.css', array(), '1.0.0', true );
    
    wp_enqueue_style( 'fullcalendar', get_stylesheet_directory_uri() . '/css/fullcalendar.css', array(), '1.0.0', true );
    wp_enqueue_style( 'isotope', get_stylesheet_directory_uri() . '/css/isotope.css', array(), '1.0.0', true );
    wp_enqueue_style( 'jquery-jvectormap-1.2.2', get_stylesheet_directory_uri() . '/css/jquery-jvectormap-1.2.2.css', array(), '1.2.2', true );
    wp_enqueue_style( 'jquery-ui-1.10.3', get_stylesheet_directory_uri() . '/css/jquery-ui-1.10.3.css', array(), '1.10.3', true );
    wp_enqueue_style( 'jquery.datatables', get_stylesheet_directory_uri() . '/css/jquery.datatables.css', array(), '1.0.0', true );
    
    wp_enqueue_style( 'jquery.gritter', get_stylesheet_directory_uri() . '/css/jquery.gritter.css', array(), '1.0.0', true );
    wp_enqueue_style( 'jquery.tagsinput', get_stylesheet_directory_uri() . '/css/jquery.tagsinput.css', array(), '1.0.0', true );
    wp_enqueue_style( 'lato', get_stylesheet_directory_uri() . '/css/lato.css', array(), '1.0.0', true );
    wp_enqueue_style( 'morris', get_stylesheet_directory_uri() . '/css/morris.css', array(), '1.0.0', true );
    wp_enqueue_style( 'prettyPhoto', get_stylesheet_directory_uri() . '/css/prettyPhoto.css', array(), '1.0.0', true );
    
    wp_enqueue_style( 'roboto', get_stylesheet_directory_uri() . '/css/roboto.css', array(), '1.0.0', true );
    wp_enqueue_style( 'style.inverse', get_stylesheet_directory_uri() . '/css/style.inverse.css', array(), '1.0.0', true );
    wp_enqueue_style( 'toggles', get_stylesheet_directory_uri() . '/css/toggles.css', array(), '1.0.0', true );
    wp_enqueue_style( 'wysiwyg-color', get_stylesheet_directory_uri() . '/css/wysiwyg-color.css', array(), '1.0.0', true );
    */
    
    
    
    
    /*
    wp_enqueue_script( 'jquery-1.10.2.min.js', get_template_directory_uri() . '/js/jquery-1.10.2.min.js', array(), '1.10.2', true );
    wp_enqueue_script( 'jquery-migrate-1.2.1.min.js', get_template_directory_uri() . '/js/jquery-migrate-1.2.1.min.js', array(), '1.2.1', true );
    wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'modernizr.min.js', get_template_directory_uri() . '/js/modernizr.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery.sparkline.min.js', get_template_directory_uri() . '/js/jquery.sparkline.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'toggles.min.js', get_template_directory_uri() . '/js/toggles.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'retina.min.js', get_template_directory_uri() . '/js/retina.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery.cookies.js', get_template_directory_uri() . '/js/jquery.cookies.js', array(), '1.0.0', true );
    wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true );
    
    wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/js/jquery.sparkline.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/js/retina.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/js/jquery.cookies.js', array(), '1.0.0', true );
    wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/js/flot/flot.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'custom.js', get_template_directory_uri() . '/js/flot/flot.resize.min.js', array(), '1.0.0', true );
    
    wp_enqueue_script( 'morris.min.js', get_template_directory_uri() . '/js/morris.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'raphael-2.1.0.min.js', get_template_directory_uri() . '/js/raphael-2.1.0.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'jquery.datatables.min.js', get_template_directory_uri() . '/js/jquery.datatables.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'chosen.jquery.min.js', get_template_directory_uri() . '/js/chosen.jquery.min.js', array(), '1.0.0', true );
    wp_enqueue_script( 'dashboard.js', get_template_directory_uri() . '/js/dashboard.js', array(), '1.0.0', true );
	*/
}
 
add_action( 'wp_enqueue_scripts', 'srh_enqueue_scripts' );















