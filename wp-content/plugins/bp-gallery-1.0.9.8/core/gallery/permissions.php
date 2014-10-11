<?php
/* 
 * Managing various user related settings/permissions for gallery
 * 
 */
/**
 *
 * @global <type> $bp
 * @param <type> $component
 * @return <type> Current User access rights for galleries, based on the current component and id of the current object
 * for example, what rights user X has for the gallery of User Y/group Z or his own gallery depends on this
 */

function gallery_get_current_user_access($owner_type=null,$owner_id=null){
   if(!$owner_type)
      $owner_type=gallery_get_current_object_type();
   if(!$owner_id)
      $owner_id=gallery_get_current_object_id();
   //default public, let the specific comoponent handle it
   return apply_filters("gallery_get_current_user_".strtolower($owner_type."_gallery_access"),array("public"),$owner_id);
}

//component specific permission
//can a user create uer gallery
//can a user create group gallery

function user_can_create_gallery($component,$component_id=null){
    global $bp;

    if(!is_user_logged_in()||empty($component))
        return false;
    $can_do=false;
    if(bp_is_my_profile())//if is user home
        $can_do= true;

//otherwise it will be false, but give other component chance to allow cretion of gallery
  return apply_filters("user_can_create_gallery",$can_do,$component,$component_id);


}
//can current logged in user delete the gallery
function user_can_delete_gallery($user_id=null,$gallery=null){
    global $bp,$galleries_template;
     if(!$user_id)
            $user_id=$bp->loggedin_user->id;
     if(!$gallery)
            $gallery=$galleries_template->gallery;
	$can_do=false;
    if(gallery_is_user_admin($user_id,$gallery->id))
            $can_do= true;
  
   return apply_filters("user_can_delete_gallery",$can_do,$gallery);

}
function user_can_view_gallery($gallery_id){
    $gallery=bp_get_gallery($gallery_id);
    $can_view=apply_filters("current_user_can_view_".strtolower($gallery->owner_object_type)."_gallery",0,$gallery_id);
    return $can_view;
}


function gallery_user_can_upload($gallery){
    global $bp;
    if(!is_user_logged_in())
         return false;
    $component=$gallery->owner_object_type;
    $component_id=$gallery->owner_object_id;

    $can_do=false;
    if(is_super_admin()||gallery_is_user_admin($bp->loggedin_user->id,$gallery->id))
        $can_do=true;

//no need to check for user gallery as we have already done that, we may need to check for the group/events gallery though

//return "can_user_upload_to_".$component."_gallery";
return apply_filters("can_user_upload_to_".$component."_gallery", $can_do,$gallery);


}

/**
 *
 * @global <type> $bp
 * @param <type> $user_id
 * @param <type> $gallery_id
 * @return <type> Check users relation with gallery/media
 */
function gallery_is_user_admin( $user_id, $gallery_id ) {
    global $bp;
    if(is_super_admin())
            return true;
   
   $is_admin= BP_Gallery_Member::check_is_admin($user_id,$gallery_id);
   return apply_filters("gallery_is_user_admin",$is_admin,$user_id,$gallery_id);
    
}

function gallery_is_user_member( $user_id, $gallery_id ) {
	$is_member= BP_Gallery_Member::check_is_member( $user_id, $gallery_id );
        return apply_filters("gallery_is_user_member", $is_member,$gallery_id);//allow custom plugins to make a virtual user member
}



/*************** Modifying based on filters for user gallery*********/
function gallery_get_current_user_user_gallery_access($access,$user_id=null){
    global $bp;
    if(!$user_id)
        $user_id=$bp->displayed_user->id;
if(bp_is_my_profile()||is_super_admin())
    return array("public","private","friendsonly");

$access=array("public");//for everyone
if(is_user_logged_in())
    $access[]="loggedin";
if(bp_is_active('friends')&&('is_friend'==BP_Friends_Friendship::check_is_friend($bp->loggedin_user->id,$user_id)))
    $access[]="friendsonly";

return $access;
}


add_filter("gallery_get_current_user_user_gallery_access","gallery_get_current_user_user_gallery_access",10,2);//for user gallery access
add_filter("gallery_get_current_user__gallery_access","gallery_get_current_user_user_gallery_access",10,2);//for user gallery access




function current_user_can_view_user_gallery($perm,$gallery_id){
   global $bp;
  // $can_view=false;
$gallery=bp_get_gallery($gallery_id);
if($gallery->status=="public"||bp_is_my_profile()||is_super_admin())
    return true;

if(!is_user_logged_in())
    return false;

if($gallery->status=="friendsonly" && (class_exists("BP_Friends_Friendship")&&'is_friend'==BP_Friends_Friendship::check_is_friend($bp->loggedin_user->id,$bp->displayed_user->id)))
return true;

if($gallery->status=="private"&&bp_is_my_profile())
    return true;
return false;

}

add_filter("current_user_can_view_user_gallery","current_user_can_view_user_gallery",10,2);

function gallery_get_activity_permission($gallery_id){
    $gallery=bp_get_gallery($gallery_id);
  $is_hidden=0;
    if($gallery->owner_object_type=="user"&&$gallery->status!="public")
            $is_hidden=1;
  return apply_filters("gallery_get_activity_permission",$is_hidden,$gallery);
          
    
}
?>