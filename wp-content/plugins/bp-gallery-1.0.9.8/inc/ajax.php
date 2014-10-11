<?php
/***
 * Ajax Based gallery editing/media editing/ new gallery creation/upload etc is handled by this file
 */
/**
 *  This section contains functions which are used to create gallery, show gallery create from
 *  Edit gallery, delete gallery
 */
/**************************** Template/form loading via ajax*****************************************************************
 * ***************************************************************************************************************************
 */
add_action("wp_ajax_show_gallery_create_form","bp_gallery_show_gallery_create_form");//load gallery create form
add_action("wp_ajax_show_gallery_media_upload_form_activity","bp_gallery_show_activity_upload_form");//load upload form for upload from activity


//load gallery create form
function bp_gallery_show_gallery_create_form() {
    global $bp;
   
    $owner_type=gallery_get_current_object_type();
    $owner_id=gallery_get_current_object_id();

    if(!user_can_create_gallery($owner_type,$owner_id)) {
        _e("You don't have permissions to create gallery.","bp-gallery");
        exit(0);
        
    }
  check_admin_referer('create-gallery-form');//check, do we need the conditionals above
  locate_template( array( '/gallery/single/create-form.php' ), true );
  exit(0);
}

/***** Showing forms for single gallery editing Screen*******/
add_action("wp_ajax_show_media_edit_form","show_media_edit_form");//show bulk media edit form
add_action("wp_ajax_show_gallery_media_upload_form","show_gallery_media_upload_form");//show media upload form on gallery->edit
add_action("wp_ajax_show_media_add_from_web_form","show_media_add_from_web_form");//show media add form web gallery->edit
add_action("wp_ajax_show_media_reorder_form","show_media_reorder_form");//show  media re order form
add_action("wp_ajax_single_gallery_edit","show_single_gallery_edit_form");//show gallery info edit form
add_action("wp_ajax_show_gallery_cover_upload_form","show_single_gallery_cover_upload_form");//show gallery info edit form


// manage/edit-media in bulk form
function show_media_edit_form() {
    global $bp;
    //check referrer
    check_ajax_referer("edit_gallery_media");
    if(!empty($_POST["gallery_id"])&&gallery_is_user_admin($bp->loggedin_user->id,intval($_POST["gallery_id"]))) {
        $bp->gallery->current_gallery=bp_get_gallery(intval($_POST['gallery_id']));
        $bp->gallery->is_media_edit_screen=true;
        locate_template( array( '/gallery/single/edit.php' ), true );
    }
    exit(0);
}

 //  manage/uplod  show the Media upload form//to upload from local computer
 function show_gallery_media_upload_form() {
        global $bp;

        check_ajax_referer('upload-media-form');
        if(empty($_POST['gallery_id'])||!bp_gallery_exists(intval($_POST['gallery_id'])))
            return;

        $gallery=bp_get_gallery(intval($_POST["gallery_id"]));

        if(gallery_user_can_upload($gallery)) {
            //check whether the gallery exists or not
            $bp->gallery->is_single_gallery=true;
            $bp->gallery->current_gallery=bp_get_gallery(intval($_POST['gallery_id']));
            $bp->gallery->is_upload_screen=true;
            locate_template( array( '/gallery/single/edit.php' ), true );

        }
        exit(0);
}
function show_media_add_from_web_form(){
  global $bp;

        check_ajax_referer('add-from-web-form');
        if(empty($_POST['gallery_id'])||!bp_gallery_exists(intval($_POST['gallery_id'])))
            return;

        $gallery=bp_get_gallery(intval($_POST["gallery_id"]));

        if(gallery_user_can_upload($gallery)) {
            //check whether the gallery exists or not
            $bp->gallery->is_single_gallery=true;
            $bp->gallery->current_gallery=bp_get_gallery(intval($_POST['gallery_id']));
            $bp->gallery->is_add_from_web_screen=true;
            locate_template( array( '/gallery/single/edit.php' ), true );

        }
        exit(0);
}

 // manage/redorde-media
function show_media_reorder_form() {
    global $bp;
    //check ajax referrer
    check_ajax_referer("reorder-media");
    if((!empty($_POST["gallery_id"]))&&gallery_is_user_admin($bp->loggedin_user->id,intval($_POST["gallery_id"]))) {
            $bp->gallery->current_gallery=bp_get_gallery(intval($_POST['gallery_id']));
            $bp->gallery->is_media_reorder_screen=true;
            locate_template( array( '/gallery/single/edit.php' ), true );
    }
    exit(0);
}


// Manage/edit-info

function show_single_gallery_edit_form() {
    global $bp;
    check_ajax_referer('edit-gallery');

    if(!empty($_POST["gallery_id"])&&gallery_is_user_admin($bp->loggedin_user->id,intval($_POST["gallery_id"]))) {
        $bp->gallery->current_gallery=bp_get_gallery(intval($_POST['gallery_id']));
        $bp->gallery->is_edit_details_screen=true;
        locate_template( array( '/gallery/single/edit.php' ), true );
    }
    exit(0);
}

//missing, manage/cover upload
function show_single_gallery_cover_upload_form() {
    global $bp;
    check_ajax_referer('cover-upload');

    if(!empty($_POST["gallery_id"])&&gallery_is_user_admin($bp->loggedin_user->id,intval($_POST["gallery_id"]))) {
        $bp->gallery->current_gallery=bp_get_gallery(intval($_POST['gallery_id']));
        $bp->gallery->is_cover_upload_screen=true;
        locate_template( array( '/gallery/single/edit.php' ), true );
    }
    exit(0);
}

//load activity upload form
function bp_gallery_show_activity_upload_form(){
    //check referrer
    //we are not checking the form referrer, don't worry, It will not affect the security at all
    global $bp;
    if(!is_user_logged_in())
        return;
    $type=$_POST["gallery_type"];
     if(!gallery_is_valid_gallery_type($type))
         return;

     $bp->gallery->gallery_type=$type;
     $owner_type=gallery_get_current_object_type();
     $owner_id=gallery_get_current_object_id();

     if(gallery_get_gallery_count_by_gallery_type($type, $owner_type, $owner_id))
        locate_template( array( '/gallery/single/media/activity-upload-form.php' ), true );
exit(0);
 }

/*************************** Action Functions, used to save info/upload data****************************************
 * ******************************************************************************************************************
 */
//gallery related actions
 add_action("wp_ajax_delete_gallery","bp_gallery_ajax_delete_gallery");
 add_action("wp_ajax_gallery_create_save","bp_gallery_ajax_create_save");
 add_action("wp_ajax_inline_update_gallery","bp_gallery_inline_gallery_save");
 add_action("wp_ajax_reorder_gallery_media","bp_gallery_update_gallery_media_order");
 add_action("wp_ajax_save_gallery_cover","bp_gallery_change_gallery_cover");
/**
 * @desc Save New gallery Using ajax
 * @global <type> $bp
 */
function bp_gallery_ajax_create_save() {
    global $bp,$current_user;

    $response=array();//we will send the response as json

    check_ajax_referer('gallery_create_save');

    $owner_type=gallery_get_current_object_type();
    $owner_id=intval($_POST['component_id']);

    if(user_can_create_gallery($owner_type,$owner_id)) {
        if(empty($_POST["gallery_title"]))
            $response["error"]=array("msg"=>__("Gallery Title Can not be left Blank","bp-gallery"));
        else {
            if(empty($owner_id))
                $owner_id=$bp->loggedin_user->id;
            //let us save the gallery data
            if(($id= gallery_create_gallery(array( "title"=>stripslashes($_POST["gallery_title"]),
                    "description"=>stripslashes($_POST["gallery_description"]),
                    "owner_object_id"=>$owner_id,
                    "slug"=> gallery_check_slug(sanitize_title($_POST["gallery_title"]),$owner_type,$owner_id),
                    "status"=>$_POST["gallery_status"],
                    "gallery_type"=>$_POST["gallery_type"],
                    "owner_object_type"=>$owner_type)
                    )

                 )) {
                $gallery= bp_get_gallery($id);
                $response["data"]=build_json_for_gallery($gallery);
                $response["data"]["msg"]=__("Gallery created successfully.", "bp-gallery");
            }
            else
            //there were some error
                $response["error"]=array("msg"=>__("Some Error Occured. Please Try again.","bp-gallery"));

        }
    }
    else
        $response["error"]=array("msg"=>__("You don't have sufficient permission to create gallery.","bp-gallery"));

    echo json_encode($response);
    exit(0);
}

/**
 * @desc for Deleting Gallery
 */
function bp_gallery_ajax_delete_gallery() {
    global $bp;
    check_ajax_referer('delete-gallery');
    $gallery_id=$_POST["gallery_id"];

    $response=array();
    $gallery=bp_get_gallery($gallery_id);

    if(user_can_delete_gallery($bp->loggedin_user->id,$gallery)) {
        if($gallery->delete())//if gallery deleted successfully
            $response["data"]=array("msg"=>sprintf(__("You deleted the Gallery %s","bp-gallery"),$gallery->title),
                    "action"=>"success",
                    "id"=>$gallery->id);
        else
            $response["error"]=array("msg"=>sprintf(__("There Was a problem deleting the Gallery %s","bp-gallery" ),$gallery->title));

    }
    else
        $response["error"]=array("msg"=>sprintf(__("You don't have sufficient permissions to delete the Gallery %s ","bp-gallery"  ),$gallery->title));

  echo json_encode($response);
  exit(0);
}

/*
 * Allow changing of gallery cover
 */


function bp_gallery_change_gallery_cover() {
//change gallery cover
    gallery_fix_flash_upload();//fix the problems with flash upload
    global $bp,$current_user;
    //check rfrerer

    $gallery= bp_get_gallery(intval($_POST["gallery_id"]));
    if(gallery_is_user_admin($bp->loggedin_user->id,$gallery->id)) {
        if(!empty($_FILES)) {//if file was uploaded
            $file=$_FILES;
            $upload=gallery_upload_cover_image($file,$gallery);
            if(!empty($upload['files'])) {
                //delete older files as ther are not connected to images anymore
                @unlink(ABSPATH.$gallery->cover_mini);
                @unlink(ABSPATH.$gallery->cover_mid);
                @unlink(ABSPATH.$gallery->cover_orig);
                if(bp_get_gallery_meta($gallery->id,"cover_image"))
                        //delete the cover image from meta table too
                        bp_delete_gallery_meta($gallery->id, "cover_image");
                $gallery->cover_mini=$upload['files']['thumb'];
                $gallery->cover_mid=$upload['files']['mid'];
                $gallery->cover_orig=$upload['files']['larger'];
                //save gallery
                $gallery->save();
            }
        }//file cover upload ends here
        $response["data"]=build_json_for_gallery($gallery);
        $response["data"]["msg"]=__('Updated The Cover.', 'bp-gallery');

    }
    else
        $response["error"]["msg"]=__('Could not update the Cover.', 'bp-gallery');

    echo json_encode($response);
    exit(0);
}

/**
 * @desc Save  editing of Gallery Using ajax
 * @global <type> $bp
 */
function bp_gallery_inline_gallery_save() {
    global $bp;
    check_ajax_referer('gallery_edit_save');
    /*only gallery edmin can save gallery */

    $response=array();

    $title=$_POST["gallery_title"];
    $description=$_POST["gallery_description"];
   

    $status=$_POST["gallery_status"];
    $gallery_id=$_POST["gallery_id"];
    if(gallery_is_user_admin($bp->loggedin_user->id,intval($_POST["gallery_id"]))) {
        if(empty($title))
            $response["error"]=array("msg"=>__("Gallery Title can not be empty!","bp-gallery"));
        else {
            if( !$gallery=gallery_update_gallery_details(array("id"=>$gallery_id,
            "status"=>$status,
            "title"=>stripslashes($title),
            "description"=>stripslashes($description)
            ) ))
                $response["error"]=array("msg"=>__("There were problems saving your information.","bp-gallery"));
            else {
                $response["data"]=build_json_for_gallery($gallery);
                $response["data"]["msg"]=__('Gallery updated successfully', 'bp-gallery');
            }
        }
    }
    else
        $response["error"]=array("msg"=>__("You don't have permission to perform this operation","bp-gallery"));
    //return false;
    echo  json_encode($response);
    exit(0);
}


//for ordering gallery
//certified to be secure
function bp_gallery_update_gallery_media_order() {
global $bp;
//let us get the current order stack and update its order
//there are two ways to do this
//1.get the id of the gallery+current order
//2.Get the old order and the current order
    
check_ajax_referer("gallery_media_reorder");
if(gallery_is_user_admin($bp->loggedin_user->id,intval($_POST["gallery_id"]))){
    //allow to re order
    $order=count($_POST["gallery_media"]);
    foreach($_POST["gallery_media"] as $media_id) {
        $media=bp_gallery_get_media($media_id);
        $media->sort_order=$order;
        $order--;
        if(false===$media->save()) {
            //invalidate media cache sir
             $response["error"]=array("msg"=>__("Unable to update order.Some problem occured, please try again later.","bp-gallery"));
            break;
        }
    }

    $response['msg']= __("Updated Order.","bp-gallery");
}
else
       $response["error"]=array("msg"=>__("Sorry! You don't have sufficient permission to do this.","bp-gallery"));

echo json_encode($response);
exit(0);
}

/**
 *
 * Media Media Medai
 * Media Management functions for ajax functionality
 */
/***********************************For Media Files ******************************/
/***************************************************************************/

/**
 * @desc Save media files using ajax
 * @global <type> $bp
 * @return <type>
 */
add_action("wp_ajax_save_gallery_media_bulk","bp_gallery_ajax_save_gallery_media");
//for deleting gallery
add_action("wp_ajax_delete_media","bp_gallery_ajax_delete_media");
add_action("wp_ajax_inline_update_media","bp_gallery_inline_update_media");
add_action("wp_ajax_bulk_media_update","bp_gallery_bulk_media_update");
add_action("wp_ajax_add_gallery_media_form_web","add_gallery_media_from_web");


function bp_gallery_ajax_save_gallery_media() {
    /*
        * Fix Flash Authentication issue
    */
    gallery_fix_flash_upload();
    check_ajax_referer('save_gallery_media');//check for the referrer
    global $bp;
    $response=array();
    $file=$_FILES;
    /* check for the larger file causing empty $_POST/$_FILES array issue*/
    if(gallery_server_unable_to_handle_upload())
        $response['error']=array("msg"=>__("Server can not handle this much amount of data. Please upload a smaller file or ask your server administrator to change the settings.","bp-gallery"));
    else {
//check should be here
        $gallery=bp_get_gallery(intval($_POST['user-galleries']));
        $error=false;
//detect media type of uploaded file here and then upload it accordingly also check if the media type uploaded and the gallery type matches or not
//let us build our response for javascript
        $media_type=bp_gallery_get_media_type_from_file($file);
        if(!$media_type==$gallery->gallery_type)
            $response["error"]=array("msg"=>__('This file type is not allowed in current Gallery. You must upload a file which is '.gallery_get_verbose_explanation_for_extension($gallery->gallery_type), 'bp-gallery'));
        if(!gallery_user_can_upload($gallery)) {
            $response["error"]=array("msg"=>__("You don't have sufficient permissions.", "bp-gallery"));

        }
        if(!empty($response["error"])) {
            //do not proceed
            echo json_encode($response);
            return;
        }

//upload file
        $upload_info= bp_gallery_process_upload($bp->loggedin_user->id,$file,$gallery,'file');
        if(empty($upload_info['error'])) {
            /* if there are no upload errors , let us proceed*/
            $title=$_POST["media_title"];
            $description=$_POST["media_description"];
            $image_meta=null;
            if($media_type=="photo"){
             $image_meta=wp_read_image_metadata($upload_info['files']['larger']);
             //store the array in the database

                if(empty($title))/*we assume the image was bulk uploaded*/
                $title=$image_meta['title'];
                if(empty($description)&&!empty($image_meta["description"]))
                $description=$image_meta["description"];
            }
            if(empty($title))/*if title is empty*/
                $title=gallery_get_media_title_from_file_name($file["file"]["name"]);

            //check
            

            $status=$_POST["media_status"];

            if(empty($status))
                $status=$gallery->status;//inherit from parent,gallery must have an status
             //   print_r($upload_info);
            if(!($id=gallery_add_media(array("title"=>stripslashes($title),
                    "description"=>stripslashes($description),
                    "gallery_id"=>$gallery->id,
                    "user_id"=>$bp->loggedin_user->id,
                    "is_remote"=>false,
                    "type"=>$gallery->gallery_type,
                    "local_thumb_path"=>$upload_info['files']['thumb'],
                    "local_mid_path"=>$upload_info['files']['mid'],
                    "local_orig_path"=>$upload_info['files']['larger'],
                    "slug"=>gallery_check_media_slug(sanitize_title($title),$gallery->id),
                    "status"=>$status,
                    "enable_wire"=>1))))//if there is an error
                $response["error"]=array("msg"=>__('There were problems saving your information.', 'bp-gallery'));
            else {
                //success woo hoo
                $media = bp_gallery_get_media($id);//the uploaded media object
                //update meta if photo
                if(!empty($image_meta))
                    bp_update_media_meta ($media->id, "media_meta", $image_meta);
                $resp=build_json_for_media($media);
                //improve message
                $resp["msg"]=__('Media uploaded successfully', 'bp-gallery');
                $response["data"]=$resp;
          //do not publish this item
           //store it in gallery meta
         $unpublished_medis=array();
         $unpublished_medis=maybe_unserialize(bp_get_gallery_meta($gallery->id, "unpublished_media"));

         $unpublished_medis[]=$media->id;//store this too
         bp_update_gallery_meta($gallery->id, "unpublished_media", $unpublished_medis);//store
         bp_gallery_update_time($gallery->id);
          //do we need to publish it?
                $publish=bp_gallery_get_activity_publishing_settings($bp->loggedin_user->id);
                if($publish['is_automatic']&&!$publish['is_batch']){
                    bp_gallery_publish_media_to_activity($media->id);
                     $message=__("Published to activity stream successfully.", "bp-gallery");
                    bp_core_add_message($message);
                }
       do_action( 'gallery_media_upload_complete', $media );

            }
        }
        else
        $response["error"]=array("msg"=>__("Garr...").$upload_info['error']);
    }

    echo json_encode($response);
exit(0);
}


/**
 * @desc delete media Using Ajax
 *
 */

function bp_gallery_ajax_delete_media() {
    global $bp;

    check_ajax_referer('delete-media');
    $media_id=$_POST["media_id"];
    $media=bp_gallery_get_media($media_id);


    if(gallery_is_user_admin($bp->loggedin_user->id,$media->gallery_id)) {
        if($media->delete())
            $response["data"]=array("msg"=>sprintf(__("You deleted the media %s",'bp-gallery'),$media->title),
                    "action"=>"success",
                    "id"=>$media->id);
        else
            $response["error"]=array("msg"=>sprintf(__("There Was a problem deleting the media %s","bp-gallery"),$media->title));

    }
    else
        $response["error"]=array("msg"=>sprintf(__("You don't have sufficient permission to delete the media %s","bp-gallery" ),$media->title ));


    echo json_encode($response);
    exit(0);
}


/*
 * Manage/edit-info saving gallery information
 */
function bp_gallery_inline_update_media() {
    global $bp;

    check_ajax_referer('media_edit_save');

    $title=$_POST["media_title"];
    $description=$_POST["media_description"];
    //$user_id= $_POST["user_id"];
    $status=$_POST["media_status"];
    $media_id=intval($_POST["media_id"]);
    $media=bp_gallery_get_media($media_id);

 //only gallery admin can update media right ?
    if(gallery_is_user_admin($bp->loggedin_user->id, $media->gallery_id)){
            if($media=gallery_update_media(array("id"=>$media_id,
                "title"=>stripslashes($title),
                "description"=>stripslashes($description),
                "status"=>$status))

        ) {
        $resp=build_json_for_media($media);
        $resp["msg"]=__('Media updated successfully', 'bp-gallery');
        $response["data"]=$resp;

    }
    else
        $response["error"]=array("msg"=>__("Some error occured","bp-gallery"));
    }
    else
             $response["error"]=array("msg"=>sprintf(__("You don't have sufficient permission to edit this media %s","bp-gallery"),$media->title)  );

    //return false;
    echo json_encode($response);
    exit(0);
}


/********** For Bulk media saving inside a gallery********/


function bp_gallery_bulk_media_update() {
    global $bp;

    check_ajax_referer('media_edit_save','_wpnonce-media_edit_save');
    if(gallery_is_user_admin($bp->loggedin_user->id, intval($_POST["gallery_id"]))){ //find the cover image and set it as gallery cover
             if(isset($_POST["gallery_cover"])) {
             $media=bp_gallery_get_media(intval($_POST["gallery_cover"]));
              bp_update_gallery_meta($media->gallery_id, "cover_image", $media->id);
             }

       foreach($_POST["media_title"] as $media_id=> $media_title) {
        $description=$_POST["media_description"][$media_id];//get description for current gallery
        $status=$_POST["gallery_status"][$media_id];
        if(empty ($status))
            $status="public";

        gallery_update_media((array("id"=>$media_id,
                        "title"=>stripslashes($media_title),
                        "description"=>stripslashes($description),
                        "status"=>$status)
        ));

        do_action("gallery_media_bulk_edited",$media_id,$_POST);//what ever is in post
    }

     $response["msg"]=__("Updated!","bp-gallery"  );
    }
    else
        $response["error"]=array("msg"=>__("You don't have sufficient permission to do this.","bp-gallery"  ));

    echo json_encode($response);
    exit(0);
}
function add_gallery_media_from_web(){
    global $bp;
   //check referrer
    check_ajax_referer("save_gallery_media_from_web");
    $url=$_POST['url'];
    //echo $url;
   $status=$_POST["media_status"];//get the media status

   $gallery=bp_get_gallery(intval($_POST['gallery_id']));

   if(empty($status))
           $status=$gallery->status;//inherit from parent,gallery must have an status
    $media_settings=gallery_get_media_size_settings($gallery->gallery_type);
    //get the thumb size image/video initially
    $embed=bp_gallery_get_emebed_media_details($url,$media_settings['thumb']);//array("width"=>300,"height"=>300));
    //print_r($embed);
    if($embed){
            $media_type=$embed->type;//
          
            if($media_type=="rich")
                    $media_type="video";
            if($media_type!=$gallery->gallery_type)
            $response["error"]=sprintf(__('Invalid Url. You must enere a url from %s ', 'bp-gallery'),bp_gallery_get_allowed_external_service($gallery->gallery_type));
          else  {
              //type matched
            if(!($id=gallery_add_media(array("title"=>stripslashes($embed->title),
                    "description"=>stripslashes($description),
                    "gallery_id"=>$gallery->id,
                    "user_id"=>$bp->loggedin_user->id,
                    "is_remote"=>true,
                    "type"=>$gallery->gallery_type,/*
                    "local_thumb_path"=>$upload_info['files']['thumb'],
                    "local_mid_path"=>$upload_info['files']['mid'],
                    "local_orig_path"=>$upload_info['files']['larger'],*/
                    "slug"=>gallery_check_media_slug(sanitize_title($embed->title),$gallery->id),
                    "remote_url"=>  trim($url),
                    "status"=>$status,
                    "enable_wire"=>1))))//if there is an error
                _e('There were problems saving your information.', 'bp-gallery');
           
            else {
               //save into the media meta for the thumb
                if($media_type=="photo")
                bp_update_media_meta($id, "embeded_media_thumb_content", $embed->url);
                else
                    bp_update_media_meta($id, "embeded_media_thumb_content", $embed->html);

               //bp_update_media_meta($id, "embeded_media_content", $embed->html);
               //bp_update_media_meta($id, "embeded_media_content", $embed->html);
               if(function_exists("bp_get_gallery_media_audio_thumb_html_mep")){
                  $unpublished_medis=array();
                    $unpublished_medis=maybe_unserialize(bp_get_gallery_meta($gallery->id, "unpublished_media"));

                    $unpublished_medis[]=$id;//store this too
                    bp_update_gallery_meta($gallery->id, "unpublished_media", $unpublished_medis);//store
               }
                
        echo bp_get_media_html(bp_gallery_get_media($id));
       //do_action( 'gallery_media_upload_complete', $media );
       do_action( 'gallery_media_add_from_web_complete', $media );
            }
          }
    }
    else $response['error']=__("The url is invalid!","bp-gallery");
    if(!empty($response['error']))
        echo $response["error"];
    exit(0);
}

/* AJAX update posting of comments for the medias on which there is no comment yet */
function bp_gallery_post_update() {
	global $bp;

	/* Check the nonce */
	check_admin_referer( 'post_update', '_wpnonce_post_update' );

	if ( !is_user_logged_in() ) {
		echo '-1';
		return false;
	}

	if ( empty( $_POST['content'] ) ) {
		echo '-1<div id="message" class="error"><p>' . __( 'Please enter some content to post.', 'bp-gallery' ) . '</p></div>';
		return false;
	}

if($_POST["comment_parent"]=="media")
    $is_media_comment=true;
else
  $is_media_comment=false;

gallery_post_comment($_POST['object'], $_POST['item_id'],  $_POST['content'],$is_media_comment);
exit(0);
}
add_action( 'wp_ajax_gallery_post_update', 'bp_gallery_post_update' );



//publishing gallery to activity

add_action("wp_ajax_publish_gallery_to_activity","bp_gallery_publish_activity");

function bp_gallery_publish_activity(){
    global $bp;
    check_ajax_referer('publish-media');
    $response=array();
    $gallery_id=intval($_POST["gallery_id"]);
     //is user gallery admin
    if(gallery_is_user_admin($bp->loggedin_user->id, $gallery_id)){
         $publish=$_POST["publish_status"];
        if($publish){
             bp_gallery_publish_all_media_to_activity($gallery_id);
            $response["msg"]=__("Published to activity stream successfully.", "bp-gallery");
        }
        else{
           bp_gallery_delete_all_unpublished_media($gallery_id);//delete from meta
            $response["msg"]=__("Media removed from activity publishing queue.", "bp-gallery");
           
        }
    }
else
     $response["error"]["msg"]=__("Sorry!, You don't have the permission.", "bp-gallery");

    echo json_encode($response);
exit(0);
}


//upload from activity

add_action("wp_ajax_upload_from_activity","gallery_upload_from_activity");

function gallery_upload_from_activity(){
  gallery_fix_flash_upload();
  check_ajax_referer('save_gallery_media');//check for the referrer

  global $bp;
  $response=array();

  $gallery=bp_get_gallery(intval($_POST['user-galleries']));

  if(!$gallery->id)
          return;
  
  $response=bp_gallery_handle_media_uplod($gallery);

  if(empty($response['error'])){
        $media_id=$response["data"]["id"];
        $media=bp_gallery_get_media($media_id);
        $type=gallery_get_type_name($gallery->gallery_type);
        $content=bp_get_gallery_media_thumb_html($media,true);
        $activity_action=sprintf( __( "%s uploaded a %s to %s" , 'bp-gallery'),bp_core_get_userlink( $bp->loggedin_user->id ),$type,'<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>'.":"  );

        $hide_sitewide=gallery_get_activity_permission($gallery->id);

        $hide_sitewide=apply_filters("gallery_media_activity_status", $hide_sitewide,$gallery);
//
        if($gallery->owner_object_type ==$bp->groups->id)
            $component_name=$bp->groups->id;
        else
            $component_name=$bp->gallery->id;//attribute to gallery component

         $primary_id=$gallery->owner_object_id;

        $parent_activity_id= gallery_record_activity( array(
                      'content' => apply_filters( 'gallery_activity_new_media_upload',$content  ),
                      'primary_link' => apply_filters( 'gallery_activity_uploaded_media_primary_link', bp_get_gallery_permalink( $gallery ) ),
                      'component_action' => 'new_media_update',
                      'item_id' => $primary_id,
                      'action'=>$activity_action,
                      'secondary_item_id'=>$media->id,
                      'component_name'=>$component_name,
                      'hide_sitewide'=>$hide_sitewide
                        ) );
        //we have gallery, we have media
        if ( bp_has_activities ( 'include=' . $parent_activity_id ) ) : ?>
		<?php while ( bp_activities() ) : bp_the_activity(); ?>
			<?php locate_template( array( 'activity/entry.php' ), true ) ?>
		<?php endwhile; ?>
	 <?php endif;
        //$response["test"]="test value";
        }

 //  echo json_encode($response);
        exit(0);
}

//for directory page
add_action("wp_ajax_gallery_filter","bp_gallery_object_template_loader");
function bp_gallery_object_template_loader(){
   global $bp;
    $bp->gallery->is_directory=true;
  //  add_filter("bp_dtheme_ajax_querystring","bp_gallery_filter_directory_data",12,7);
    bp_dtheme_object_template_loader();
    exit(0);
}
function bp_gallery_filter_directory_data($query_string,$object,$filter,$scope,$page,$search_term,$extras){

//echo "qs:". $query_string."object:". $object."filter:".$filter."scope:".$scope."page:".$page."search_term".$search_term."extras".$extras;
//echo $query_string;
    return $query_string;
}
/************************** Helper Functions for Ajax*******************/

/**
 * @desc Fix the flash upload issues which includes cookie overriding
 */

function gallery_fix_flash_upload() {
    global $current_user,$bp;

    bp_core_clear_user_object_cache($current_user->ID);

    if ( is_ssl()&& !empty($_POST['auth_cookie']) )
        $_COOKIE[SECURE_AUTH_COOKIE] = $_POST['auth_cookie'];
    elseif ( !empty($_POST['auth_cookie']) )
        $_COOKIE[AUTH_COOKIE] = $_POST['auth_cookie'];


    if ( !empty($_POST['logged_in_cookie']) )
        $_COOKIE[LOGGED_IN_COOKIE] = $_POST['logged_in_cookie'];

    unset($current_user);

    if($user_id=wp_validate_auth_cookie()) {
        wp_authenticate_cookie($user_id,'','');
        wp_set_auth_cookie($user_id);//let us do the validation of authentication and allow to set cookies
    }

    wp_set_current_user($user_id);/*force wordpress to reset $current_user global variable*/

    get_currentuserinfo();//just trying to initiate..may not be required
    $bp->core->setup_globals();
    //bp_core_setup_globals();/* force Bp to reset global variables and use the newly reset $current_user variable*/
}

/**
 * @desc convert $gallery object to array, to be used for JSOn response
 * @param <type> $gallery
 * @return <type>
 */
function build_json_for_gallery($gallery) {

    $data=array("title"=>$gallery->title,
            "desc"=>$gallery->description,
            "cover_image"=>$gallery->cover_mini,
            "link"=>bp_get_gallery_permalink($gallery),
            "thumb"=>"<a href='".bp_get_gallery_permalink($gallery)."'>".bp_get_gallery_cover_mini($gallery)."</a>",
            "add_media_link"=>bp_get_media_upload_link($gallery)
    );
    return $data;

}
/**
 * @desc Convert media Object to arry which can be used for JSON, request
 * @param <type> $media
 * @return <type>
 */
function build_json_for_media($media) {
    $data=array("id"=> $media->id ,
            "title"=> $media->title,
            "description"=> $media->description,
            "order"=>$media->sort_order,
            "link"=>bp_get_media_permalink($media),
            "thumb"=>bp_get_gallery_media_thumb_html($media,true),
            "type"=>$media->type
    );
    return $data;
}



//allow posting of comment on the media
function gallery_post_comment($object,$item_id,$content,$is_media_comment=true){
    global $bp;
    if(!$object=="gallery")
        return;


    $component=$_POST["component_type"];;//current component
    if($component=="user")
        $component="gallery";
    
   
    
if($is_media_comment){//for media comment
       $media=bp_gallery_get_media($item_id);
       $gallery=bp_get_gallery($media->gallery_id);
       $action="new_media_update";
       //    $media_type_name=gallery_get_type_description($gallery->gallery_type);
       /*boy! this is important to say what the user has done****/
      $activity_action=sprintf( __( "%s received comments on their %s " , 'bp-gallery'),bp_core_get_userlink( $media->user_id ),  gallery_get_type_name($media->type).":"  );
      $activity_content=bp_get_gallery_media_thumb_html($media,true);//sprintf( __( '%s uploaded the %s to %s  %s', 'bp-gallery'), bp_core_get_userlink( $bp->loggedin_user->id ), $media_type_name, '<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>',);

      $hide_sitewide=gallery_get_media_activity_permission($media->id);
         $primary_link=bp_get_media_permalink( $media );
    $user_id=$media->user_id;
    $secondary_id=$media->id;
    }
    else{
        //this is a gallery comment
        $action="gallery_new_comment";
        $gallery=bp_get_gallery($item_id);
        $user_id=$bp->loggedin_user->id;
         $activity_action=sprintf( __( "%s commented on gallery %s " , 'bp-gallery'),bp_core_get_userlink( $user_id ),bp_get_gallery_title($gallery).":"  );
         $activity_content=$content;//bp_get_gallery_media_thumb_html($media,true);//sprintf( __( '%s uploaded the %s to %s  %s', 'bp-gallery'), bp_core_get_userlink( $bp->loggedin_user->id ), $media_type_name, '<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>',);

      $hide_sitewide=gallery_get_activity_permission($gallery->id);

     $primary_link=bp_get_gallery_permalink( $gallery );
     $secondary_id=$gallery->id;
    }

     if($_POST["component_type"]==$bp->groups->id)
                    $primary_id=intval($_POST["component_id"]);
    else
        $primary_id=$gallery->id;

    $parent_activity_id= gallery_record_activity( array(
                      'user_id'=>$user_id,
                      'content' => apply_filters( 'gallery_activity_created_gallery',$activity_content  ),
                      'primary_link' => apply_filters( 'gallery_activity_uploaded_media_primary_link', $primary_link ),
                      'component_action' => $action,
                      'item_id' =>  $primary_id,
                      'action'=>$activity_action,
                      'component_name'=>$component,
                      'secondary_item_id'=>$secondary_id,
                      'hide_sitewide'=>$hide_sitewide
                        ) );
      if($is_media_comment)//record a sub comment
      $activity_id = bp_activity_new_comment( array(
		'content' =>$content,
		'activity_id' => $parent_activity_id,
		'parent_id' => $parent_activity_id
	));
if($parent_activity_id)
    bp_activity_update_meta( $parent_activity_id, "associated_media", array(0=>$media->id) );//store it
if ( bp_has_activities ( "action=$action&show_hidden=1&secondary_id=".$secondary_id)) : ?>
		<?php while ( bp_activities() ) : bp_the_activity(); ?>
			<?php if($is_media_comment)
                            locate_template( array( 'gallery/single/media/activity-entry.php' ), true );
                        else             
                         locate_template( array( 'activity/entry.php' ), true );
                        ?>
		<?php endwhile; ?>
	 <?php endif;

// 
      
      
 
 
}

///////////////
function bp_gallery_handle_media_uplod($gallery) {
    /*
 * Fix Flash Authentication issue
    */
    global $bp;
    $response=array();
    $file=$_FILES;
    /* check for the larger file causing empty $_POST/$_FILES array issue*/
    if(gallery_server_unable_to_handle_upload())
        $response['error']=array("msg"=>__("Server can not handle this much amount of data. Please upload a smaller file or ask your server administrator to change the settings.","bp-gallery"));
    else {
        $media_type=bp_gallery_get_media_type_from_file($file);
        if(!$media_type==$gallery->gallery_type)
            $response["error"]=array("msg"=>__('This file type is not allowed in current Gallery. You must upload a file which is '.gallery_get_verbose_explanation_for_extension($gallery->gallery_type), 'bp-gallery'));
        if(!gallery_user_can_upload($gallery)) {
            $response["error"]=array("msg"=>__("You don't have sufficient permissions.", "bp-gallery"));

        }
        if(!empty($response["error"])) {
            //do not proceed
            return $response;
            
        }


        $upload_info= bp_gallery_process_upload($bp->loggedin_user->id,$file,$gallery,'file');
         
        if(empty($upload_info['error'])) {
               
                $image_meta=wp_read_image_metadata($upload_info['files']['larger']);
                $title=$image_meta["title"];
                if(empty($image_meta["title"]))/*if meta data is empty*/
                    $title=gallery_get_media_title_from_file_name($file["file"]["name"]);
                $description="";
                if(!empty($image_meta["description"]))
                    $description=$image_meta["description"];

            $status=$gallery->status;//inherit from parent,gallery must have an status

           if(!($id=gallery_add_media(array("title"=>stripslashes($title),
                        "description"=>stripslashes($description),
                        "gallery_id"=>$gallery->id,
                        "user_id"=>$bp->loggedin_user->id,
                        "is_remote"=>false,
                        "type"=>$gallery->gallery_type,
                        "local_thumb_path"=>$upload_info['files']['thumb'],
                        "local_mid_path"=>$upload_info['files']['mid'],
                        "local_orig_path"=>$upload_info['files']['larger'],
                        "slug"=>gallery_check_media_slug(sanitize_title($title),$gallery->id),
                        "status"=>$status,
                        "enable_wire"=>1))))//if there is an error
                                $response["error"]=array("msg"=>__('There were problems saving your information.', 'bp-gallery'));
            else {
                $media = bp_gallery_get_media($id);//the uploaded media object
                $resp=build_json_for_media($media);
                
                //improve message
                $resp["msg"]=__('Media uploaded successfully', 'bp-gallery');
                $response["data"]=$resp;
         
       do_action( 'gallery_media_upload_complete', $media );

            }
        }
        else
        $response["error"]=array("msg"=>__("Garr...","bp-gallery").$upload_info['error']);
    }

    return $response;

}
/*
 *
 */

//for loading comment on activity page

function bp_gallery_print_comments_for_media_ajax(){
    $media_id=$_POST['media_id'];
    if(!$media_id)
        return;
    global $bp;
    $bp->gallery->current_media=bp_gallery_get_media($media_id);
    $bp->gallery->is_single_media=true;
   // echo $media_id;
    include(locate_template( array( 'gallery/single/media/activity.php' ), false ) );
    exit(0);
}
add_action("wp_ajax_gallery_load_media_comments","bp_gallery_print_comments_for_media_ajax");


function bp_media_tag_friends_list() {
	global $bp;

	$friends = false;

	// Get the friend ids based on the search terms
	if ( function_exists( 'friends_get_friend_user_ids' ) )
		$friends = friends_get_friend_user_ids( $bp->loggedin_user->id );

	$friends = apply_filters( 'bp_media_tag_friends_autocomplete_list', $friends );
        $friends[]=$bp->loggedin_user->id;//allow to tag themself
	if ( $friends ) {
		foreach ( (array)$friends as $user_id ) {
			$ud = get_userdata($user_id);
			$username = $ud->user_login;
			echo "<option value=\"".$user_id."\">". bp_core_fetch_avatar( array( 'item_id' => $user_id, 'type' => 'thumb', 'width' => 15, 'height' => 15 ) ) . ' &nbsp;' . bp_core_get_user_displayname( $user_id ) . ' (' . $username . ')'."</option>";
			//';
		}
	}
}

add_action("wp_ajax_media_get_taggable_users","bp_media_tag_friends_list");

add_filter("gallery_activity_new_media_upload","bpg_include_comment");

function bpg_include_comment($content){
    if($_POST['comment_text'])
        $content=$_POST['comment_text'].$content;
    return $content;
    
}
        
?>