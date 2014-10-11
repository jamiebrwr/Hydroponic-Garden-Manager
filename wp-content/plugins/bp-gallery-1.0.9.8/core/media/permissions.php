<?php
/*permissions for media*/

//can user delete the media
function user_can_delete_media($user_id,$media){//if the user is admin of gallery
   return BP_Gallery_Member::check_is_admin($user_id,$media->gallery_id);

}

//can user view the media
function user_can_view_current_media($media_id){
    $media=bp_gallery_get_media($media_id);
    $gallery=bp_get_gallery($media->gallery_id);
    $can_view=apply_filters("current_user_can_view_".strtolower($gallery->owner_object_type)."_media",0,$media);

    return $can_view;
}
add_filter("current_user_can_view_user_media","current_user_can_view_user_media",10,2);//need to give a goo dname

function current_user_can_view_user_media($perm,$media){
   global $bp;
  //check if current user can view parent gallery
   $can_view_galley=user_can_view_gallery($media->gallery_id);
   if(!$can_view_galley)
       return $can_view_galley;
   //if user can see the gallery, let us check for media permission
   

if(bp_is_my_profile()||is_super_admin())//for my own gallery or for site admin return true
    return true;

//if private gallery or private media, return false for any other user
if(($media->status=="private"))
        return false;
if($can_view_galley&&$media->status=='public')
        return true;

if($can_view_galley&&$media->status=="friendsonly" && class_exists("BP_Friends_Friendship")&&'is_friend'==BP_Friends_Friendship::check_is_friend($bp->loggedin_user->id,$bp->displayed_user->id))
return true;

return false;

}


function gallery_get_media_activity_permission($media_id){
  $media=bp_gallery_get_media($media_id);
 //handle for user media, deligate for group media
  $is_hidden=gallery_get_activity_permission($media->gallery_id);
  if(!$is_hidden){
      //cherck for media
   if($media->status!="public")
           $is_hidden=1;
  }

return $is_hidden;
}

function bp_gallery_media_is_user_owner($user_id,$media_id){
    $media=bp_gallery_get_media($media_id);
    if($media->user_id==$user_id)
        return true;
    return false;
}
?>