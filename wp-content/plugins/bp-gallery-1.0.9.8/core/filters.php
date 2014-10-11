<?php
/*** Various filters for Gallery**/

/*** LINK Filters**********/
add_filter("bp_get_user_gallery_permalink","bp_gallery_user_gallery_permalink",10,2);

/**
 * @desc gallery permalink fixing for user gallery
 */
function bp_gallery_user_gallery_permalink($link,$gallery){
    global $bp;
     return  bp_core_get_user_domain($gallery->owner_object_id).BP_GALLERY_SLUG."/my-galleries/".$gallery->slug;
}


/***** filter for Group gallery**********/

/*********filter the thumb HTML by media type************/
/*********add the filters now to filter thumb html**********/
add_filter("bp_get_gallery_media__thumb_html","bp_get_gallery_media_photo_thumb_html",10,2);//fallback if $type is empty
add_filter("bp_get_gallery_media_photo_thumb_html","bp_get_gallery_media_photo_thumb_html",10,2);
add_filter("bp_get_gallery_media_video_thumb_html","bp_get_gallery_media_video_thumb_html",10,2);
add_filter("bp_get_gallery_media_audio_thumb_html","bp_get_gallery_media_audio_thumb_html",10,2);

function bp_get_gallery_media_photo_thumb_html($content,$media){
    if($media->is_remote)
        $url=bp_get_media_meta ($media->id, "embeded_media_thumb_content");//we are sure it exists
    else
        $url=gallery_get_media_full_url($media->local_thumb_path);
     $content="<img src='".$url."' alt='".  esc_attr(bp_get_media_title($media))."' />";
     $content="<a class='media-linked' href='".bp_get_media_permalink($media)."'>".$content."</a>";
    return $content;
}
function bp_get_gallery_media_video_thumb_html($content,$media){
    if($media->is_remote)
        $content=bp_get_media_meta ($media->id, "embeded_media_thumb_content");
    else
      $content="<a class='media media-thumb gallery-video video video-thumb' href='".gallery_get_media_full_url($media->local_thumb_path)."'>".$media->title."</a>";
    return $content;
}
function bp_get_gallery_media_audio_thumb_html($content,$media){
    $content="<a class='media media-thumb gallery-audio audio audio-thumb' href='".gallery_get_media_full_url($media->local_thumb_path)."'>".$media->title."</a>";
    return $content;
}



/**************** filter the media html for photo, video, audio***********/
///add filters now for showing full html of media types
add_filter("bp_get_gallery_media__full_html","bp_get_gallery_media_photo_full_html");//fallback if $type is empty
add_filter("bp_get_gallery_media_photo_full_html","bp_get_gallery_media_photo_full_html");
add_filter("bp_get_gallery_media_video_full_html","bp_get_gallery_media_video_full_html");
add_filter("bp_get_gallery_media_audio_full_html","bp_get_gallery_media_audio_full_html");

function bp_get_gallery_media_photo_full_html($media){
    if($media->is_remote){
        $url=bp_get_media_meta ($media->id, "embeded_media_orig_content");
        if(!$url){//generate one
             $gallery=bp_get_gallery($media->gallery_id);
            $media_settings=gallery_get_media_size_settings($gallery->gallery_type) ;
            $embed=bp_gallery_get_emebed_media_details ($media->remote_url,$media_settings['larger']);
        if($embed){
             bp_update_media_meta ($media->id, "embeded_media_orig_content",$embed->url);
                $url=$embed->url;
        }
        }
    }
    else
        $url=gallery_get_media_full_url($media->local_orig_path);
   $content="<img src='".$url."' alt='".  esc_attr(bp_get_media_title($media))."' />";
   $content="<a class='media-linked' href='".bp_get_media_permalink($media)."'>".$content."</a>";
   return $content;
}
function bp_get_gallery_media_video_full_html($media){
      //will be used by flower player
     if($media->is_remote){
        $content=bp_get_media_meta ($media->id, "embeded_media_orig_content");
      if(!$content){//generate one
          $gallery=bp_get_gallery($media->gallery_id);
          $media_settings=gallery_get_media_size_settings($gallery->gallery_type);
            $embed=bp_gallery_get_emebed_media_details ($media->remote_url,$media_settings['larger']);
        if($embed){
             bp_update_media_meta ($media->id, "embeded_media_orig_content",$embed->html);
                $content=$embed->html;
        }
        }
     }
    else
   $content="<a class='media media-full gallery-video video video-full' href='".gallery_get_media_full_url($media->local_orig_path)."'>".$media->title."</a>";
   return $content;
}

function bp_get_gallery_media_audio_full_html($media){
    $content="<a class='media media-full gallery-audio audio audio-full' href='".gallery_get_media_full_url($media->local_orig_path)."'>".$media->title."</a>";
    return $content;
}


/** filter gallery owner type */

add_filter("gallery_owner_type","gallery_owner_type_for_user");

function gallery_owner_type_for_user($owner_type){
    if(bp_is_user())
        return "user";
    return $owner_type;
}

/** Filter owner Id ***/


add_filter("get_gallery_owner_id","gallery_owner_id_for_user");//won't work in ajax mode


function gallery_owner_id_for_user($owner_id){
  global $bp;

 
  if(bp_is_user())
    return $bp->displayed_user->id;//that is displayed user id

  return $owner_id;
}






/**
 * Filter page title for BP Gallery Pages
 */
 
function bp_gallery_page_title($complete_title){
   global $bp;
   if(bp_is_current_component($bp->gallery->slug)||$bp->current_action==$bp->gallery->slug) { // echo bp_is_single_gallery();
     if(bp_is_single_gallery())
            $title=" &#124;".$bp->gallery->current_gallery->title;
     if(bp_is_single_media())
             $title.=" &#124;".$bp->gallery->current_media->title;
    return $complete_title.$title;
        }
return $complete_title;
}
add_filter("bp_page_title","bp_gallery_page_title");





/** for valid gallery status for group/members gallery**/
add_filter("gallery_get_valid_status","gallery_status_filter");
function gallery_status_filter($status){

    if(bp_is_user()){
       $status=array("public"=>__("Public","bp-gallery"),"private"=>__("Private","bp-gallery"));
       if(bp_is_active( 'friends' ))
             $status["friendsonly"]=__("Friends Only","bp-gallery");

    }else if(function_exists("bp_is_group")&&bp_is_group()){
       
        if(bp_get_group_status(groups_get_current_group())=='public')
            $status=array("public"=>__("Public","bp-gallery"),"private"=>__("Private","bp-gallery"));
        else
            $status=array("private"=>__("Private","bp-gallery"));
        
    }     
   return $status;
}

//save other media sizes
add_action("bp_gallery_media_saved","bp_gallery_save_other_image_sizes",10,2);
function bp_gallery_save_other_image_sizes($media,$path_array){
if($media->type!='photo')
        return false;
    $basic_keys=array("thumb","mid","larger","original");
    if(bp_gallery_preserve_original_image ())
        bp_update_media_meta ($media->id, "original_image", $path_array['original']);
    $gallery=bp_get_gallery($media->gallery_id);
    $media_size_settings=gallery_get_media_size_settings($gallery->gallery_type);
    $all_sizes=array_keys($media_size_settings);
    
    //we are using array_dis for php4 compatibility otherwise array_diff_keys would have been enough
    $keys=arry_diff($all_sizes,$basic_keys);

    if(!empty($keys))
        foreach($keys as $key)
            bp_update_media_meta ($media->id, $key, $path_array[$key]);//save to meta data
    return ;
}

//for activity status filtering
add_action("gallery_media_activity_status","gallery_filter_activity_status",10,2);
function gallery_filter_activity_status($show_hidden,$gallery){
    return $show_hidden;
    //we don't need it anymore, will deprecate in next version
 //if gallery is group gallery and group is not public, return 1, else return $status
 if($gallery->owner_object_type=="user")
     return $show_hidden;
 if($gallery->owner_object_type="groups"){
     //if group,check for private/hidden groups
     $group=new BP_Groups_Group($gallery->owner_object_id);
     if($group->status!="public")
         $show_hidden=1;
     
 }
return $show_hidden;
}

//add the hook for showing gallery activity of logged in user
add_action('bp_before_activity_type_tab_favorites',"bp_gallery_show_gallery_activity_for_current_user");
function bp_gallery_show_gallery_activity_for_current_user(){
 if(!is_user_logged_in())
     return false;

?>
    <li id="activity-gallery">
        <a href="<?php echo bp_loggedin_user_domain() .  bp_get_activity_slug() . '/' . BP_GALLERY_SLUG . '/' ?>" title="<?php _e( 'The activity of galleries.', 'bp-gallery' ) ?>">
                <?php printf( __( 'My Galleries <span>%d</span>', 'bp-gallery' ),gallery_total_gallery_for_user(bp_loggedin_user_id()) ); ?></a>
   </li>
							
<?php
}

add_filter("bp_gallery_is_method_enabled","bp_gallery_is_add_from_web_enabled",10,3);
function bp_gallery_is_add_from_web_enabled($is_enabled,$method,$gallery){
//check if methos is not add from web, return is_enabled
    if($method!="add_from_web")
    return $is_enabled;
  //check if current gallery type can be added from web
  if(bp_gallery_is_external_service_allowed($gallery->gallery_type))
       return true;
  return false;
 
}

?>