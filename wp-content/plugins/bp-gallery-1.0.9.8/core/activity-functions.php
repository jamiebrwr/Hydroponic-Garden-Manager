<?php
/* 
 * Handle all the activity related functions for the gallery
 * 
 */



//get the total comments for a media
function gallery_get_media_comment_count($media_id,$show_hidden=true){
    global $bp,$wpdb;
    if(bp_is_active("activity")){
    $ac_id=BP_Activity_Activity::get_id(false,null,"new_media_update",null,$media_id,false,false,false);


  if(empty( $ac_id))
        return 0;
  $filter = array( 'user_id' => false, 'object' => $bp->activity->id,  'primary_id' => $ac_id );
  $where_conditions=array();
		/* Filtering */
    if ( $filter && $filter_sql = BP_Activity_Activity::get_filter_sql( $filter ) )
	$where_conditions['filter_sql'] = $filter_sql;

    $from_sql = " FROM {$bp->activity->table_name} a ";
	/* Hide Hidden Items? */
    if ( !$show_hidden )
	$where_conditions['hidden_sql'] = "a.hide_sitewide = 0";

  /* Alter the query based on whether we want to show activity item comments in the stream like normal comments or threaded below the activity */

    $where_conditions[] = "a.type = 'activity_comment'";
    $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );
    $total_activities = $wpdb->get_var( $wpdb->prepare( "SELECT count(a.id) {$from_sql} {$where_sql} " ) );
    return $total_activities;
    }
    else
        return __("Disabled","bp-gallery");

}

/**
 * Determine if current media is unpublished in the feed
 * @param <type> $gallery_id
 * @param <type> $media_id
 * @return <type>
 */
function bp_gallery_is_unpublished_media($gallery_id,$media_id){
     $unpublished_media= bp_gallery_get_unpublished_media($gallery_id);

         if(in_array($media_id,$unpublished_media))
                 return true;
         else return false;
}
/**
 * Check if current gallery has unpublished media
 * @param <type> $gallery_id
 * @return <type>
 */

function bp_gallery_has_unpublished_media($gallery_id){
if(bp_is_active("activity")&& bp_get_gallery_unpublished_media_count($gallery_id)>0)
    return true;
else
    return false;
}

/**
 * Get the Number of unpublished media in the gallery
 * @param <type> $gallery_id
 * @return <type>
 */
function bp_get_gallery_unpublished_media_count($gallery_id){
   $unpublished_media= bp_gallery_get_unpublished_media($gallery_id);
  if(!empty ($unpublished_media))
         return count($unpublished_media);
  else
      return 0;
}
/**
 * Get the list of Unpublished media ids as array
 * @param <type> $gallery_id
 * @return <type>
 */
function bp_gallery_get_unpublished_media($gallery_id){
          $unpublished_media=bp_get_gallery_meta($gallery_id, "unpublished_media");
           return $unpublished_media;
}

function bp_gallery_set_unpublished_media($gallery_id, $unpublished_media){
     bp_update_gallery_meta($gallery_id,"unpublished_media",$unpublished_media);
}
/**
 * Delete all unpublished media ids from gallery meta
 * @param <type> $gallery_id
 * @return <type>
 */
function bp_gallery_delete_all_unpublished_media($gallery_id){
    //remnove the unpublished media
 
 return  bp_delete_gallery_meta($gallery_id,"unpublished_media");
}

function bp_gallery_remove_media_from_unpublished($gallery_id,$media_id){
    $unpublished_media=bp_gallery_get_unpublished_media($gallery_id);
    if(empty($unpublished_media))
        return;
    if(in_array($media_id, $unpublished_media))
            foreach($unpublished_media as $key=>$val)
                if($val==$media_id)
                  unset($unpublished_media[$key]);


 bp_gallery_set_unpublished_media($gallery_id, $unpublished_media);//update meta

}
/**
 * Publish all unpublished media to the activity
 */
function bp_gallery_publish_all_media_to_activity($gallery_id){
if(!bp_is_active("activity"))
    return;
global $bp;
/** Bulk publish**/
    $count=bp_get_gallery_unpublished_media_count($gallery_id);
if(!$count)
    return;
$gallery=bp_get_gallery($gallery_id);

$type=$gallery->gallery_type;
    $type=gallery_get_type_name($gallery->gallery_type);
 if($count>1)
    $type=gallery_get_type_name_plural($gallery->gallery_type);//$type."s";//videos audios photos

//publish 5 medias to the stream

$unpublished_media=bp_gallery_get_unpublished_media($gallery_id);
//get first 5 uploaded media ids
$publising_media=array();
global $bp;
$publish_settings=bp_gallery_get_activity_publishing_settings($bp->owner_object_id);
$content="";
$unpublished_media=array_slice($unpublished_media,0,$publish_settings['max_media_count']);//how many to publish
$publising_media=$unpublished_media;

//if($gallery)
foreach($unpublished_media as $media_id)
        $content.=bp_get_gallery_media_thumb_html(bp_gallery_get_media($media_id),true);

$content=apply_filters( 'gallery_activity_media_content',$content,$gallery,$unpublished_media  );
$activity_action=sprintf( __( "%s uploaded %d %s to %s" , 'bp-gallery'),bp_core_get_userlink( $bp->loggedin_user->id ),$count,$type,'<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>'.":"  );


$hide_sitewide=gallery_get_activity_permission($gallery->id);


$hide_sitewide=apply_filters("gallery_media_activity_status", $hide_sitewide,$gallery);
//
 if($gallery->owner_object_type ==$bp->groups->id)
        $component_name=$bp->groups->id;
 else
       $component_name=$bp->gallery->id;//attribute to gallery component

 $primary_id=$gallery->owner_object_id;

  $parent_activity_id= gallery_record_activity( array(
                      'content' => $content,
                      'primary_link' => apply_filters( 'gallery_activity_uploaded_media_primary_link', bp_get_gallery_permalink( $gallery ) ),
                      'component_action' => 'new_media_update',
                      'item_id' =>  $primary_id,
                      'action'=>$activity_action,
                      'component_name'=>$component_name,
                      'hide_sitewide'=>$hide_sitewide
                        ) );
if($parent_activity_id){
    bp_gallery_delete_all_unpublished_media($gallery_id);
       // bp_update_gallery_meta($gallery_id,"bulk_published_activity_id",$parent_activity_id);//we do not need this, or we may need this, but it will be overwritten innext publishing
    foreach($unpublished_media as $media_id)
        bp_update_media_meta ($media_id, "bulk_published_activity_id", $parent_activity_id);
        bp_activity_update_meta( $parent_activity_id, "associated_media", $unpublished_media );
        bp_activity_update_meta( $parent_activity_id, "associated_gallery_id", $gallery->id );
    //for each
	do_action("gallery_media_published_to_activity",$parent_activity_id);
    return true;
}else
return false;
}

//update associated activity on media delete for bulk activity publishing
function bp_gallery_update_activity_on_media_delete($media_id){
    global $bp;
    $content="";
  $activity_id=bp_get_media_meta ($media_id, "bulk_published_activity_id");//, $parent_activity_id);
  
  if(!$activity_id)
      return;
  //otherwise we have it
  $published_media= bp_activity_get_meta( $activity_id, "associated_media");//, $unpublished_media );
 
  $gallery_id= bp_activity_get_meta( $activity_id, "associated_gallery_id");//, $gallery->id );

  if(!empty($published_media)&& in_array($media_id, $published_media)){
     
    //this media was published
    $gallery=bp_get_gallery($gallery_id);
      $type=$gallery->gallery_type;
    $type=gallery_get_type_name($gallery->gallery_type);
  foreach($published_media as $key=>$val)
      if($val==$media_id)
          unset($published_media[$key]);
 if(empty($published_media)){
     //delete this activity
 bp_activity_delete_by_activity_id($activity_id);
     return;
 }
  if(count($published_media)>1)
    $type=gallery_get_type_name_plural($gallery->gallery_type);//$type."s";//videos audios photos


foreach($published_media as $media_id)
        $content.=bp_get_gallery_media_thumb_html(bp_gallery_get_media($media_id),true);

$content=apply_filters( 'gallery_activity_media_content',$content,$gallery,$published_media  );
$activity_action=sprintf( __( "%s uploaded %d %s to %s" , 'bp-gallery'),bp_core_get_userlink( $bp->loggedin_user->id ),count($published_media),$type,'<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>'.":"  );


  $parent_activity_id= gallery_update_recorded_activity(array(
                        'activity_id'=>$activity_id,
                        'content' => $content,
                        'action'=>$activity_action
                        ) );
if($activity_id){
 bp_activity_update_meta( $activity_id, "associated_media", $published_media );//update the activity meta
	do_action("gallery_media_published_to_activity_updated",$activity_id);
    return true;
}else
return false;
  //we need to update the activity by stripping the content for this media
      
  }
    
}
//publish individual media to activity
function bp_gallery_publish_media_to_activity($media_id){
    global $bp;

//publish media to activity
    $media=bp_gallery_get_media($media_id);
    $gallery=bp_get_gallery($media->gallery_id);

  
    $type=gallery_get_type_name($gallery->gallery_type);
 
    $content="";
//if($gallery)

    $content=bp_get_gallery_media_thumb_html(bp_gallery_get_media($media_id),true);
    $content=apply_filters( 'gallery_activity_media_content_single_media',$content,$gallery );
    $a_or_an=($gallery->gallery_type=='audio')?"an":"a";
    $activity_action=sprintf( __( "%s uploaded %s %s to %s" , 'bp-gallery'),bp_core_get_userlink( $media->user_id ),$a_or_an,$type,'<a href="' . bp_get_gallery_permalink( $gallery ) . '">' . attribute_escape( $gallery->title ) . '</a>'.":"  );

$hide_sitewide=gallery_get_media_activity_permission($media_id);
$hide_sitewide=apply_filters("gallery_media_activity_status", $hide_sitewide,$gallery);
//
 if($gallery->owner_object_type ==$bp->groups->id)
        $component_name=$bp->groups->id;
 else
       $component_name=$bp->gallery->id;//attribute to gallery component

 $primary_id=$gallery->owner_object_id;
$secondary_id=$media_id;
  $parent_activity_id= gallery_record_activity( array(
                      'content' => $content,
                      'primary_link' => apply_filters( 'gallery_activity_uploaded_media_primary_link', bp_get_media_permalink( $media ) ),
                      'component_action' => 'new_media_update',
                      'item_id' =>  $primary_id,
                      'secondary_item_id'=>$secondary_id,
                      'action'=>$activity_action,
                      'component_name'=>$component_name,
                      'hide_sitewide'=>$hide_sitewide
                        ) );
if($parent_activity_id){
    bp_gallery_remove_media_from_unpublished($gallery->id,$media_id);

    bp_update_media_meta($media_id,"published_activity_id",$parent_activity_id);
    //bp_update_media_meta ($media_id, "bulk_published_activity_id", $parent_activity_id);
    bp_activity_update_meta( $parent_activity_id, "associated_media", array(0=>$media_id) );
        
	do_action("gallery_media_published_to_activity",$parent_activity_id);
    return true;
}else
return false;
}

add_filter("gallery_activity_media_content","gallery_video_audio_activity_content",10,3);

function gallery_video_audio_activity_content($content,$gallery,$unpublished_media){
    if($gallery->gallery_type=="audio"||$gallery->gallery_type=="video"){
           
     $content='<div class="player_wrapper">';

     $content.='<a  class="player plain" style="background-image:url('.bp_gallery_get_cover_mid_src($gallery).')">';
     $content.='<img src="'.  bp_gallery_get_template_url().'/inc/images/play_large.png" />';
     $content.='</a>';
     $content.='<div class="playlist">';

     foreach($unpublished_media as $media_id){
            $media=bp_gallery_get_media($media_id);

            $content.='<a href="'.bp_get_media_thumb_src($media).'" >';
            $content.='<strong>'.bp_get_media_title($media).'</strong>';
            $content.='</a>';
       
   }

   $content.="</div></div>";
    }
return $content;
}

add_action("bp_gallery_edit_template","bp_gallery_automatic_publish_to_activity");

function bp_gallery_automatic_publish_to_activity(){
    global $bp;
    //individual or batch
    //depending on post like that
    $gallery_id=  bp_get_single_gallery_id();//get_current_gallery
     //is user gallery admin
    if( bp_gallery_has_unpublished_media($gallery_id)&&gallery_is_user_admin($bp->loggedin_user->id, $gallery_id)){
            $publish=bp_gallery_get_activity_publishing_settings($bp->loggedin_user->id);

          if($publish['is_automatic']){//if auto publish is enabled
              if($publish['is_batch'])
                    bp_gallery_publish_all_media_to_activity($gallery_id);
              else if(!$publish['is_batch']){
                  $unpublised_media=bp_gallery_get_unpublished_media($gallery_id);
                  foreach($unpublised_media as $key=>$media_id){
                  // if(bp_gallery_media_is_user_owner($bp->loggedin_user->id, $media_id))
                      bp_gallery_publish_media_to_activity($media_id);
                    
                  }
              }
            $message=__("Published to activity stream successfully.", "bp-gallery");
            bp_core_add_message($message);
        }//end of automatic publishing section
        
    }


}

function bp_gallery_get_activity_publishing_settings($user_id=null){
 //returns array is_automatic, is_batch,
   $publishing_default=array("is_batch"=>false,"is_automatic"=>false,'max_media_count'=>5);
  if($user_id)
   $publishing_settings=get_user_meta($user_id, "gallery_publishing_settings",true);
  if(empty($publishing_settings))
      $publishing_settings=get_site_option ("gallery_publishing_settings");

  $settings=wp_parse_args($publishing_settings, $publishing_default);

return $settings;
  
}



/*add activity sy=ub tab on user profile*/
add_action("bp_activity_setup_nav","bp_gallery_add_my_gallery_activity_tab");
function bp_gallery_add_my_gallery_activity_tab(){
 global $bp;
    $user_domain = ( !empty( $bp->displayed_user->domain ) ) ? $bp->displayed_user->domain : $bp->loggedin_user->domain;
    $user_login = ( !empty( $bp->displayed_user->userdata->user_login ) ) ? $bp->displayed_user->userdata->user_login : $bp->loggedin_user->userdata->user_login;
    $activity_link = $user_domain . $bp->activity->slug . '/';

	/* Add the subnav items to the activity nav item if we are using a theme that supports this */
bp_core_new_subnav_item( array( 'name' => __( 'Gallery', 'bp-gallery' ), 'slug' => 'gallery', 'parent_url' => $activity_link, 'parent_slug' => $bp->activity->slug, 'screen_function' => 'bp_gallery_screen_my_activity', 'position' => 35 ) );
}

function bp_gallery_screen_my_activity(){

	do_action( 'bp_activity_screen_my_activity' );
	bp_core_load_template( apply_filters( 'bp_activity_template_my_activity', 'members/single/home' ) );

}
//filter on ajax query string and modify it for gallery subtab of activity
add_filter("bp_dtheme_ajax_querystring","bp_gallery_filter_activity_for_user_querystring",12,7);
function bp_gallery_filter_activity_for_user_querystring($qs, $object,$filter,$scope,$page,$search_term,$extra){
   global $bp;
  
   if(bp_is_activity_component()&&$bp->current_action==$bp->gallery->slug){
       $qs="action=new_media_update";
       if(bp_is_my_profile ())
           $qs.="&show_hidden=1";

   }
  if($scope=="gallery"&&  is_user_logged_in())
      $qs.="scope=gallery&action=new_media_update&show_hidden=1&user_id=".  bp_loggedin_user_id();
   return $qs;
}


add_filter("bp_activity_allowed_tags","bp_gallery_get_allowed_tags",20);
function bp_gallery_get_allowed_tags($allowed_tags){
$allowed_tags['object'] = array();
	$allowed_tags['object']['width'] = array();
	$allowed_tags['object']['height'] = array();
        $allowed_tags['video']['width'] = array();
	$allowed_tags['video']['height'] = array();
	$allowed_tags['video']['src'] = array();
        $allowed_tags['audio']['width'] = array();
	$allowed_tags['audio']['height'] = array();
	$allowed_tags['audio']['src'] = array();
        //iframe
        $allowed_tags['iframe']=array();
        $allowed_tags['iframe']['width'] = array();
	$allowed_tags['iframe']['height'] = array();
	$allowed_tags['iframe']['src'] = array();

    $allowed_tags['param'] = array();
	$allowed_tags['param']['name'] = array();
	$allowed_tags['param']['value'] = array();

    $allowed_tags['embed'] = array();
	$allowed_tags['embed']['src'] = array();
	$allowed_tags['embed']['type'] = array();
	$allowed_tags['embed']['allowscriptaccess'] = array();
	$allowed_tags['embed']['wmode'] = array();
	$allowed_tags['embed']['allowfullscreen'] = array();
	$allowed_tags['embed']['width'] = array();
	$allowed_tags['embed']['height'] = array();
	$allowed_tags['embed']['flashvars'] = array();

return $allowed_tags;
    
}
?>