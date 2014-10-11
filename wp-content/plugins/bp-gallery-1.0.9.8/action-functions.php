<?php
/********************************************************************************
 * Action Functions
 *
 * Action functions are exactly the same as screen functions, however they do not
 * have a template screen associated with them. Usually they will send the user
 * back to the default screen after execution.
 */

/**
 * @desc: deleting a gallery
 * @global <type> $bp
 * @return <type>
 * TODO: Cleanup and make it work in non ajax mode, it does not work as of yet
 */
function gallery_action_delete_gallery(){
    global $bp;

    if ( $bp->current_action != 'delete'||!bp_is_current_component($bp->gallery->slug ))
		return false;
    if(!empty($bp->action_variables)){
    
    $action=$bp->action_variables[0];
    if($action=="media")
    {
       $media_id=$bp->action_variables[1]; //this is a media delete request
    if(gallery_user_can_delete_media($media_id))//if current user can delete media
        {
            //delete media
        }
    }
 else {
 //this is a gallery delete request
 $id=$action;//this is gallry id
  if(gallery_user_can_delete_gallery($id)) //if current user can delete the gallery
    {
        //delete gallery
    }
 
 }
if (! $bp->is_item_admin )
{
    bp_core_add_message("You Don't have rights to delete this gallery.",'bp-gallery');
  	bp_core_redirect( wp_get_referer() );
    return false;
}

 bp_core_add_message("You deleted this gallery.",'bp-gallery');	//return wherewe were
bp_core_redirect( wp_get_referer() );//return where we were

}
}
add_action( 'wp', 'gallery_action_delete_gallery', 3 );
/********************************************************************************
 * Activity  Functions
 *
 * These functions handle the recording, deleting and formatting of activity 
 * 
 */

function bp_gallery_register_activity_actions() {
	global $bp;

	if ( !function_exists( 'bp_activity_set_action' ) )
		return false;

	//bp_activity_set_action( $bp->gallery->id, 'created_gallery', __( 'Created a gallery', 'buddypress' ) );
	bp_activity_set_action( $bp->gallery->id, 'new_media_update', __( 'Media Update', 'bp-gallery' ) );
	do_action( 'gallery_register_activity_actions' );
}
add_action( 'bp_init', 'bp_gallery_register_activity_actions' );

/**
 * @desc This should be rather considered as a Business function
 * @global <type> $bp
 * @param <type> $args
 * @return <type> 
 */
function gallery_record_activity( $args = '' ) {
	global $bp;

	if ( !function_exists( 'bp_activity_add' ) )
		return false;
    	$defaults = array(
		'user_id' => $bp->loggedin_user->id,
		'content' => false,
                'action'=>false,
		'primary_link' => false,
		'component_name' => $bp->gallery->id,
		'component_action' => false,
		'item_id' => false,
		'secondary_item_id' => false,
		'recorded_time' => gmdate( "Y-m-d H:i:s" ),
		'hide_sitewide' => false
	);


        $r = wp_parse_args( $args, $defaults );
        
	extract( $r, EXTR_SKIP );

	return bp_activity_add( array( 'user_id' => $user_id, 'content' => $content,'action'=>$action, 'primary_link' => $primary_link, 'component_name' => $component_name, 'component_action' => $component_action, 'item_id' => $item_id, 'secondary_item_id' => $secondary_item_id, 'recorded_time' => $recorded_time, 'hide_sitewide' => $hide_sitewide ) );
}
//update a recorded activity
function gallery_update_recorded_activity($args=''){
  	global $bp;

	if ( !function_exists( 'bp_activity_add' ) )
		return false;
        

        $r = wp_parse_args( $args);//, $defaults );
        extract($r,EXTR_SKIP);
        if(!$activity_id)
            return;
        $activity = new BP_Activity_Activity( $activity_id );
        if($action)
            $activity->action = $action;
	if($content)
            $activity->content = $content;
	
	if ( !$activity->save() )
		return false;

	return true;
	
}
/**
 * @desc Handle the create gallery action used by other screen functionss
 * @global <type> $bp
 * @param <type> $owner_type
 * @param <type> $owner_id 
 */

function gallery_action_create_gallery($owner_type="user",$owner_id=null) {
	global $bp;
    
	if ( isset( $_POST['save'] ) ) {


		/* Check the nonce */
	check_admin_referer('gallery_create_save',"_wpnonce-gallery_create_save");

	if ( empty( $_POST['gallery_title'] )  )  {
		bp_core_add_message( __( 'Please fill the title.', 'bp-gallery' ), 'error' );
                bp_core_redirect( wp_get_referer());//redirect from whereit was referred
	}
        else{
             if(!$owner_id)
                $owner_id=$bp->loggedin_user->id;

                if(($id= gallery_create_gallery(array(  "title"=>stripslashes($_POST["gallery_title"]),
                                          "description"=>stripslashes($_POST["gallery_description"]),
                                          "owner_object_id"=>$owner_id,
                                          "slug"=> gallery_check_slug(sanitize_title($_POST["gallery_title"]),$owner_type,$owner_id),
                                          "status"=>$_POST["gallery_status"],
                                          "gallery_type"=>$_POST["gallery_type"],
                                          "owner_object_type"=>$owner_type)
                                     )

                            ))
                            {
                            $gallery=new BP_Gallery_Gallery($id);
                         /*
                    if($gallery->status=="public")//only record for public galleries
                         gallery_record_activity( array(
                         'content' => apply_filters( 'gallery_activity_created_gallery', sprintf( __( '%s created the gallery %s', 'bp-gallery'), bp_core_get_userlink( $bp->loggedin_user->id ), '<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>' ) ),
                        'primary_link' => apply_filters( 'gallery_activity_created_gallery_primary_link', bp_get_gallery_permalink( $gallery ) ),
                        'component_action' => 'created_gallery',
                        'item_id' =>  $gallery->id,
                        'hide_sitewide'=>$hide_sitewide
			) );*/
//do action gallery created

         bp_core_add_message(__("Gallery Created Successfully.",'bp-gallery'));
          
         //redirect to upload screem
         //
         bp_core_redirect(bp_get_media_upload_link($gallery));//redirect to upload page for this gallery
                   }
          else
          bp_core_add_message(__("Error in gallery creation.",'bp-gallery'));
  }
 }
 do_action( 'gallery_create_gallery_complete' );


//no need to load template , just ask the home page to handle it for you

bp_core_load_template( apply_filters( 'gallery_template_create_gallery', 'gallery/index' ) );

}
/******** upload media function*******/
/**
 *
 * @global <type> $bp
 * @param <string> $owner_type : The Owner Object type of the gallery
 * @param <int> $owner_id :id of the owner object
 * @param <string> $status :status
 * @return <type> 
 */
function gallery_action_upload_media($owner_type="user",$owner_id='',$status='public'){
global $bp;


   if ( isset( $_POST['save-media'] ) ) {
       check_admin_referer('save_gallery_media','_wpnonce-save-gallery-image');//check for the referrer
    $response=array();
    $error='';
    $message='';
    $file=$_FILES;
    /* check for the larger file causing empty $_POST/$_FILES array issue*/
    if(gallery_server_unable_to_handle_upload())
        $error=__("Server can not handle this much amount of data. Please upload a smaller file or ask your server administrator to change the settings.","bp-gallery");
    else {
//check should be here
        $gallery=bp_get_gallery(intval($_POST['galleries-list']));
        $error=false;
//detect media type of uploaded file here and then upload it accordingly also check if the media type uploaded and the gallery type matches or not
//let us build our response for javascript
        $media_type=bp_gallery_get_media_type_from_file($file);
        if(!$media_type==$gallery->gallery_type)
            $error=__('This file type is not allowed in current Gallery. You must upload a file which is '.gallery_get_verbose_explanation_for_extension($gallery->gallery_type)."mtype".$media_type, 'bp-gallery');
        if(!gallery_user_can_upload($gallery)) {
            $error=__("You don't have sufficient permissions.", "bp-gallery");

        }
        if(!empty($error)) {
            bp_core_add_message($error,"error");
            return;
        }

//upload file
        $upload_info= bp_gallery_process_upload($bp->loggedin_user->id,$file,$gallery,'file');
        if(empty($upload_info['error'])) {
            /* if there are no upload errors , let us proceed*/
            $title=$_POST["media_title"];
            $description=$_POST["media_description"];

            if(empty($title))/*we assume the image was bulk uploaded*/
                $image_meta=wp_read_image_metadata($upload_info['files']['larger']);

            if(empty($title)&&empty($image_meta["title"]))/*if meta data is empty*/
                $title=gallery_get_media_title_from_file_name($file["file"]["name"]);

            //check
            if(empty($description)&&!empty($image_meta["description"]))
                $description=$image_meta["description"];

            $status=$_POST["media_status"];

            if(empty($status))
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
                $error=__('There were problems saving your information.', 'bp-gallery');
            else {
                //success woo hoo
                $media = bp_gallery_get_media($id);//the uploaded media object

                //$resp=build_json_for_media($media);
                //improve message
                $message=__('Media uploaded successfully', 'bp-gallery');
               // $response["data"]=$resp;
          //do not publish this item
           //store it in gallery meta
         $unpublished_medis=array();
         $unpublished_medis=maybe_unserialize(bp_get_gallery_meta($gallery->id, "unpublished_media"));

         $unpublished_medis[]=$media->id;//store this too
         bp_update_gallery_meta($gallery->id, "unpublished_media", $unpublished_medis);//store
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
        $error=__("Garr...").$upload_info['error'];
    }

    if($error)
        bp_core_add_message ($error,"error");
    else
        bp_core_add_message ($message);
    bp_core_redirect(wp_get_referer());
}
 

    return false;
}

?>