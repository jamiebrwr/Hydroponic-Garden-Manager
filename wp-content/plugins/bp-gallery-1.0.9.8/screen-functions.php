<?php

/********************************************************************************
 * Screen Functions
 *
 * Screen functions are the controllers of BuddyPress. They will execute when their
 * specific URL is caught. They will first save or manipulate data using business
 * functions, then pass on the user to a template file.
 */

/*show the my-galleries screen*/
/*working*/

/*****************************************************************************
 ****************************Handling User Galleries ************************/
/**
 * @desc Handle My galleries Screen of Users
 * @global <type> $bp 
 */
function gallery_screen_my_galleries() {
    global $bp;
    do_action( 'gallery_screen_my_galleries' );
    $filter=$bp->action_variables[0];
    if((empty($bp->action_variables)||gallery_is_valid_gallery_type($filter))){
        $bp->gallery->is_home=true;
    }
    if($bp->current_action=="my-galleries")
        bp_core_load_template( apply_filters( 'gallery_template_my_galleries_'.$filter, 'gallery/index' ) );
      

}

/*for creating gallery*/
/**
 * @desc Handle User gallery Creation screen
 * e.g http://mysite.com/members/admin/gallery/create
 * @global <type> $bp 
 */
function gallery_screen_create_gallery($owner_type="user",$owner_id=null) {
  gallery_action_create_gallery("user");
}
/**
 * @desc Single Gallery editing/uploading/magaing and all
 * Currently Upload is supported via ajax only, this function just sets the conditionals
 */
function gallery_screen_edit_gallery() {
    global $bp;
    if(($bp->current_action=="manage"&&bp_is_current_component($bp->gallery->slug))||($bp->current_action==$bp->gallery->slug&&$bp->action_variables[0]=="manage")){
        $actions=$bp->action_variables;
    
    $gallery_slug=array_shift($actions);//so remove the gallery slug from the action
        $bp->gallery->is_manage=true;

    if($bp->current_action!="manage")//i.e the first variable is manage
       $gallery_slug=array_shift($actions);//double shift in case of events/groups gallery
     if($gallery_id=BP_Gallery_Gallery::gallery_exists( $gallery_slug,$bp->gallery->owner_type,$bp->gallery->owner_id)){
         $bp->gallery->current_gallery=new BP_Gallery_Gallery($gallery_id);
        $bp->gallery->is_single_gallery=true;
     }
    //now do the security check here
     if(!user_can_delete_gallery($bp->loggedin_user->id,$bp->gallery->current_gallery))
        return;

     if(empty ($actions))
        $action="upload";//default to upload
    else
        $action=array_shift($actions);
   
    $bp->gallery->current_action=$action;
        switch($action)
        {
            case "upload":
                $bp->gallery->is_upload_screen=true;
                break;
            case "edit-media":
                $bp->gallery->is_media_edit_screen=true;
                break;
           case "edit-info":
               $bp->gallery->is_edit_details_screen=true;
            break;
            case "reorder":
                $bp->gallery->is_media_reorder_screen=true;
                break;
            case "cover-upload":
                 $bp->gallery->is_cover_upload_screen=true;
                break;
            case "add-from-web":
                $bp->gallery->is_add_from_web_screen=true;
                break;
           case "delete":
               $bp->gallery->is_delete_screen=true;
                break;
        }

  //we have some action
  //print_r($bp->gallery->current_gallery);
  
//if action is empty we should default to gallery/
//wp_die("whwhwhw");
    
//check for the screen
//Is the bulk edit
//is it single gallery
//is it single media
//$action=$bp->action_variables[0];
//if(empty($action))
//$type="bulkgroup";
//else if($action=="gallery")//this is single gallery edit link
///$type="single-gallery";
//else if($action=="media")
//$type="single-media";
//echo $type;
if ( isset( $_POST['save'] ) ) {
    
        //process it baby
//if bulk group

   
    /*
      Check the nonce */
	 
//check_admin_referer('gallery_edit_save',"_wpnonce-edit-save-gallery");

//for each gallery let us update the gallery
foreach($_POST["gallery_title"] as $gallery_id=> $gallery_title)
    {
        $gallery_description=$_POST["gallery_description"][$gallery_id];//get description for current gallery
             $status=$_POST["gallery_status"][$gallery_id];
         if(empty ($status))
              $status="public";

        gallery_update_gallery_details(array("id"=>$gallery_id,
                                            "title"=>$gallery_title,
                                            "description"=>stripslashes($gallery_description),
                                            "status"=>$status)
                                            );
                            
   
    }
	
bp_core_add_message("Updated!",'bp-gallery');
    }
do_action( 'gallery_edit_gallery_complete' );

  
$bp->gallery->is_edit_screen=true;
bp_core_load_template( apply_filters( 'gallery_template_edit_gallery', 'gallery/index' ) );

}
}
add_action("wp","gallery_screen_edit_gallery",1);
function gallery_screen_edit_media(){
    //catch media edit screen and then edit
}

/**
 * @desc Catch the single gallery and Single media view
 * @global <type> $bp
 */
function gallery_screen_single_gallery_view(){

    global $bp;
    if($bp->gallery->is_single_media)
            $type=$bp->gallery->current_media->type;
    else
        $type=$bp->gallery->current_gallery->type;
    //check if current component is not enabled
    $component=gallery_get_current_object_type();
    if(!bp_is_gallery_enabled_for($component)||!gallery_is_enabled_for_current_item())
        return false;
     if($bp->gallery->is_single_media)
        bp_core_load_template( apply_filters( 'gallery_single_media_'.$type, 'gallery/index' ) );
    else if($bp->gallery->is_single_gallery)
        bp_core_load_template( apply_filters( 'gallery_single_gallery_'.$type, 'gallery/index' ) );

}
add_action( 'wp', 'gallery_screen_single_gallery_view', 6 );

/****************Media handling screens*/

/**
 * @desc Handle media upload screen for users
 * @global <type> $bp
 * @return <type>
 */
function gallery_screen_upload_media(){
global $bp;
gallery_action_upload_media();//well we use this for all uploads where group/events/user
bp_core_load_template( apply_filters( 'gallery_template_upload_media', 'gallery/index' ) );

}




/** add upload buttons to the activity stream**/

function gallery_upload_buttons_for_activity(){
    global $bp;
    if(!gallery_is_activity_stream_upload_enabled())
        return;
   
 //activate the buttons only when there is some gallery of a type available for upload
  //in 1.1 we will allow creating gallery from activity stream
    if(bp_is_current_component($bp->gallery->slug)||$bp->current_action==BP_GALLERY_SLUG||!empty($_GET['r']))
            return;
     $owner_type=gallery_get_current_object_type();
     $owner_id=gallery_get_current_object_id();

?>
<div id="gallery_upload_buttons_for_activity">
<?php if(gallery_is_valid_gallery_type("photo")&&gallery_get_gallery_count_by_gallery_type("photo", $owner_type, $owner_id)):?>
    <a href="#" id="photo"><img src="<?php echo bp_gallery_get_template_url().'/inc/images/media-button-image.gif'?>"/></a>
 <?php endif;?>
<?php if(gallery_is_valid_gallery_type("audio")&&gallery_get_gallery_count_by_gallery_type("audio", $owner_type, $owner_id)):?>
    <a href="#" id="audio"><img src="<?php echo bp_gallery_get_template_url().'/inc/images/media-button-music.gif'?>"/></a>
 <?php endif;?>

 <?php if(gallery_is_valid_gallery_type("video")&&gallery_get_gallery_count_by_gallery_type("video", $owner_type, $owner_id)):?>
    <a href="#" id="video"><img src="<?php echo bp_gallery_get_template_url().'/inc/images/media-button-video.gif'?>"/></a>
<?php endif;?>
 <?php do_action("gallery_activity_upload_button");//allow to add more type?>

</div>
  <?php
}

add_action("bp_after_activity_post_form","gallery_upload_buttons_for_activity");


//activity filter

function gallery_member_activity_filter_options(){
    ?>
     <option value="new_media_update"><?php _e( 'Recent Gallery Updates', 'bp-gallery' ) ?></option>

    <?php
}


?>