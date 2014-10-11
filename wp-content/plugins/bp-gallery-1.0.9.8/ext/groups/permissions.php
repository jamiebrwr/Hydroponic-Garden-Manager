<?php

/**
 * Filters on access rights
 *
 */
//can user create group gallery
add_filter("user_can_create_gallery", "can_user_create_group_gallery", 10, 3);

function can_user_create_group_gallery($can_create, $owner_type, $owner_id) {
    global $bp;

    if ($owner_type != $bp->groups->id)
        return $can_create;

    if (is_super_admin()||groups_is_user_admin($bp->loggedin_user->id, $owner_id) || groups_is_user_mod($bp->loggedin_user->id, $owner_id))
        return true;
    else
        return false;
}

add_filter("current_user_can_view_groups_media", "current_user_can_view_groups_media", 10, 2); //bad need to change
function current_user_can_view_groups_media($perm,$media){
    global $bp;
   $can_view_gallery=current_user_can_view_groups_gallery($perm,$media->gallery_id);
   if(!$can_view_gallery)
       return $can_view_gallery;
    $gallery = bp_get_gallery($media->gallery_id);
  //if can view gallery, check for media
   if ($media->status=="public")
           return true;//for members/non members
    if(is_user_logged_in()&&groups_is_user_member($bp->loggedin_user->id, $gallery->owner_object_id))
        return true;
return false;

}
/*
 * For groups modify the acess right
 */
add_filter("current_user_can_view_groups_gallery", "current_user_can_view_groups_gallery", 10, 2);

function current_user_can_view_groups_gallery($perm, $gallery_id) {
    global $bp;
    //$group = $bp->groups->current_group;
    $gallery = bp_get_gallery($gallery_id);
    $group_id=$gallery->owner_object_id;
    $group=new BP_Groups_Group($group_id);
    if ($group->status == "public" && $gallery->status == "public")
        return true;
    //in all other cases user must be member of the group to view the gallery

    if (groups_is_user_member($bp->loggedin_user->id, $group_id))
        return true;
    return false;
}

add_filter("gallery_get_current_user_groups_gallery_access", "gallery_get_current_user_groups_gallery_access", 10, 2); //for user gallery access

function gallery_get_current_user_groups_gallery_access($access, $group_id) {
    global $bp;
    if (!$group_id)
        $group = $bp->groups->current_group; //fallback
 else
        $group = new BP_Groups_Group($group_id);


    if (is_super_admin() || $bp->is_item_admin || groups_is_user_member($bp->loggedin_user->id, $group->id))
        return array("public", "private", "friendsonly");

    if ($group->status == "public")
        return array("public");

    return array("noaccessright");
}

add_filter("can_user_upload_to_groups_gallery", "can_user_upload_to_groups_gallery", 10, 2);

function can_user_upload_to_groups_gallery($perm, $gallery) {
    global $bp;
    return groups_is_user_member($bp->loggedin_user->id, $gallery->owner_object_id);
}

add_filter("gallery_get_activity_permission","gallery_get_geroup_gallery_activity_permission",10,2);
function gallery_get_geroup_gallery_activity_permission($is_hidden,$gallery){
  if($gallery->owner_object_type!="groups")
          return $is_hidden;
 //check if group is
  $group=new BP_Groups_Group($gallery->owner_object_id);
  if($group->status!="public")
          $is_hidden=1;
  else{//if group status is public
      if($gallery->status!="public")
       $is_hidden=1;
  }

return $is_hidden;
  }
      


?>