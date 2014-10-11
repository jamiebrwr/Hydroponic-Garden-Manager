<?php


add_action( 'wp_print_scripts', 'bp_gallery_load_scripts' );
add_action( 'wp_print_styles', 'bp_gallery_load_style' );
add_action("wp_footer","gallery_print_settings_js");

/*load any required stylesheet files*/
function bp_gallery_load_style(){
         do_action("bp_gallery_css_loaded");
     
}
/*load any Js required*/
function bp_gallery_load_scripts(){
    if(is_admin())
        return;
    wp_enqueue_script("jquery");
    wp_enqueue_script("flash-detect",BP_GALLERY_PLUGIN_URL."inc/js/flash-detect.js");//for detecting flash
    if(is_user_logged_in()){
         wp_enqueue_script("json2");
         wp_enqueue_script('jquery-ui-core',array('jquery'));
         wp_enqueue_script('jquery-ui-draggable',array('jquery-ui-core'));
         wp_enqueue_script('jquery-ui-droppable', array('jquery-ui-draggable'));
         wp_enqueue_script('jquery-ui-selectable',  array('jquery-ui-core'));
         wp_enqueue_script('jquery-ui-sortable',  array('jquery-ui-core'));
         
       //  wp_enqueue_script("jqueryui",BP_GALLERY_PLUGIN_URL."inc/js/jquery-ui-1.7.2.custom.min.js");//for sorting dragging/dropping
        
    }
    wp_enqueue_script("bp-gallery-general",BP_GALLERY_PLUGIN_URL."inc/js/general.js");
    wp_localize_script("bp-gallery-general","bp_gallery_js_terms",bp_gallery_get_localizable_js_vars());
   
        
    do_action("bp_gallery_js_loaded");//allow template to hook other js here
}

/* for loading some scripts when we are at gallery component*/

function gallery_print_settings_js(){
 ?>   <script type='text/javascript'>
     cur_component='<?php echo gallery_get_current_object_type(); ?>';
     cur_component_id='<?php echo gallery_get_current_object_id(); ?>';
//alert(cur_component_id);
    gallery_home_url="<?php echo bp_get_gallery_home_url();?>";
 
    gallery_plugin_url="<?php echo BP_GALLERY_PLUGIN_URL;?>";
    gallery_debaug_mode="<?php echo bp_gallery_is_debug_mode();?>";

</script>
<?php
do_action("gallery_settings_js_loaded");//load to override the above js values
}
function bp_gallery_is_debug_mode(){

    return bool_from_yn(get_site_option("gallery_debug_mode","n"));//by default no
}
function bp_gallery_is_flash_uploader_enabled(){

    return bool_from_yn(get_site_option("gallery_enable_flash_uploader","y"));//by default yes
}


function bp_gallery_get_localizable_js_vars(){
    return array("delete_media_confirm"=>__("Are You sure? You will lose all the comments and the media permanently!","bp-gallery"),
                 "delete_gallery_confirm_message"=>__("Are You sure? You will lose all the media/comments!","bp-gallery")

    );
}


//find the url of the gallery template

function bp_gallery_get_template_url(){
    $theme_dir="";
    $stylesheet_dir="";
    global $bp,$current_blog;
   if(is_multisite()&&$current_blog->blog_id!=BP_ROOT_BLOG){
   //find the stylesheet path and 
    $stylesheet =  get_blog_option(BP_ROOT_BLOG,'stylesheet');
    $theme_root = get_theme_root( $stylesheet );
    $stylesheet_dir = "$theme_root/$stylesheet";
    $template=get_blog_option(BP_ROOT_BLOG,'template');
    $theme_root = get_theme_root( $template );
    $template_dir = "$theme_root/$template";
    $theme_root_uri = get_theme_root_uri( $stylesheet );
    $stylesheet_dir_uri = "$theme_root_uri/$stylesheet";
    $theme_root_uri = get_theme_root_uri( $template );
    $template_dir_uri = "$theme_root_uri/$template";
   }
   else{
     $stylesheet_dir=STYLESHEETPATH;
     $template_dir=TEMPLATEPATH;
     $stylesheet_dir_uri=get_stylesheet_directory_uri();
     $template_dir_uri=get_template_directory_uri();

   }
     if ( file_exists( $stylesheet_dir. '/gallery'))
            $theme_uri=$stylesheet_dir_uri;//child theme
    else if ( file_exists( $template_dir. '/gallery') )
	    $theme_uri=$template_dir_uri;//parent theme
if($theme_uri)
    return $theme_uri."/gallery";
return false;////template is not present in the active theme/child theme
}

function bp_gallery_get_template_dir(){
global $bp,$current_blog;

    $theme_dir="";
    $stylesheet_dir="";
   if(is_multisite()&&$current_blog->blog_id!=BP_ROOT_BLOG){
    $stylesheet =  get_blog_option(BP_ROOT_BLOG,'stylesheet');
    $theme_root = get_theme_root( $stylesheet );
    $stylesheet_dir = "$theme_root/$stylesheet";
    $template=get_blog_option(BP_ROOT_BLOG,'template');
    $theme_root = get_theme_root( $template );
    $template_dir = "$theme_root/$template";
    }
    else{
    $stylesheet_dir=get_stylesheet_directory();
    $temnp_dir=get_template_directory();
    }
    
    
if ( file_exists( $stylesheet_dir. '/gallery/'))
            $theme_dir=$stylesheet_dir;//child theme
    else if ( file_exists($temnp_dir . '/gallery/') )
	    $theme_dir=$temnp_dir;//parent theme
if($theme_dir)
    return $theme_dir."/gallery";

return false;////template is not present in the active theme/child theme
    
}


//in multisite, the functions.php should be loaded from the root blogs theme directory


?>