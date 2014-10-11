<?php

/*** Gallery Media Business functions  ****************************************************************/

/***************Business functions for media*/
/*check and create slug for media*/
/**
 * @desc Check for a media slug
 * @global <type> $bp
 * @param <string> $slug: slug to be checked
 * @param <int> $gallery_id
 * @return <string> Slug
 */
function  gallery_check_media_slug($slug,$gallery_id){
    global $bp;
    if ( BP_Gallery_Media::check_slug($slug,$gallery_id) ) {
		do {
			$slug = $slug . '-' . rand();
		}
        while ( BP_Gallery_Media::check_slug($slug,$gallery_id) );
	}

	return $slug;
}

/*get media slug from media id*/
function  gallery_get_media_slug($media_id){
    return BP_Gallery_Media::get_slug($media_id);
}

/**************Fetching****************************/
function gallery_get_all_media($gallery_id,$status=array("public"),$limit=null,$pag=null,$order_by="sort_order"){
    return BP_Gallery_Media::get_all($status,null,$gallery_id,$limit,$pag,$order_by);
}
//get all media for a user
function gallery_get_all_media_for_user($user_id,$type=null,$status=array("public"),$limit=null,$pag=null,$order_by="sort_order"){
  return BP_Gallery_Media::get_all($status,$type,null,$user_id,$limit,$pag,$order_by);
}

//get the random media for gallery, no need of type as Each gallery have media of a single type associated with them
function gallery_get_random_media($gallery_id,$limit=5,$status=array("public"),$pag=1){
     return BP_Gallery_Media::get_all($status,null,$gallery_id,null,$limit,$pag,"random");
}
/*
 * Get rando media for user, use type=phopto/audio/video to separeate the medias
 */
function gallery_get_random_media_for_user($user_id,$limit,$type=null,$status=array("public"),$pag=1){
    return BP_Gallery_Media::get_all($status,$type,null,$user_id,$limit,$pag,"random");
}

/*******Create, edit,delete media********************/
/*add media to the gallery*/
function gallery_add_media( $args = '' ) {
	global $bp;
//print_r($args);
	extract( $args );

	/**
	 * Possible parameters (pass as assoc array):
	 *	'gallery_id'
	 *	'creator_id'
	 *	'title'
	 *	'description'
	 *	'slug'
	 *	'status'
     * 'owner_object_id'
     * 'owner_object_type'
	 *	'date_created'
	 */

	/*we are adding media here right*/


   if(!$gallery_id)
        return false;//media must be associated with a gallery
   $media=new BP_Gallery_Media;

   $media->gallery_id=$gallery_id;

    if ( $user_id ) 
	$media->user_id = $user_id;
    else 
        $media->user_id = $bp->loggedin_user->id;
	
    if ( isset($title) )
		$media->title = $title;

    if ( isset( $description ) )
		$media->description = $description;


    if ( isset( $slug ) && gallery_check_media_slug( $slug,$gallery_id ) )//we will use owner id here
		$media->slug = $slug;

    if ( isset( $status ) ) {
	if ( gallery_is_valid_media_status( $status ) )
			$media->status = $status;
        else
            $media->status="public";//default to public
	}



    if ( isset( $date_updated ) )
		$media->date_updated = $date_updated;
    else
         $media->date_updated=gmdate( "Y-m-d H:i:s" );//current time
    if(!empty($local_thumb_path))
        $media->local_thumb_path=$local_thumb_path;
    

    if(!empty($local_mid_path))
        $media->local_mid_path=$local_mid_path;

    if(!empty($local_orig_path))
        $media->local_orig_path=$local_orig_path;

    if(!empty($is_remote))
        $media->is_remote=true;
    else
        $media->is_remote=false;
if(!empty($remote_url))
        $media->remote_url=$remote_url;

if(isset($type))
        $media->type=$type;
//nope, let us upload the images man..
//thn ....save,else return false
//print_r($media);
    if ( !$media->save() )
		return false;
return $media->id;
}

//update a media

function gallery_update_media( $args = '' ) {
    global $bp;
    extract( $args );
    /**
     * Possible parameters (pass as assoc array):
     *  'media_id'
     *  'gallery_id'
     *	'user_id'
     *	'title'
     *	'description'
     *	'slug'
     *	'status'
     *	'date_updated'
     */

    /*we are adding media here right*/


    if(!$id)
       return false;//media must be associated with a gallery

    $media=bp_gallery_get_media($id);
    if($gallery_id)
        $media->gallery_id=$gallery_id;

    if ( isset($title) )
		$media->title = $title;

    if ( isset( $description ) )
		$media->description = $description;


    if ( isset( $slug ) && gallery_check_media_slug( $slug,$gallery_id ) )//we will use owner id here
	$media->slug = $slug;

    if ( isset( $status ) ) {
	if ( gallery_is_valid_media_status( $status ) )
			$media->status = $status;
	}
        
if(empty($media->date_updated)||isset( $date_updated )){
    if ( isset( $date_updated ) )
		$media->date_updated = $date_updated;
    else
     $media->date_updated=gmdate( "Y-m-d H:i:s" );//current time
}

    if ( !$media->save() )
		return false;
do_action("gallery_media_updated",$media->id);
return $media;//return the media object
}



/***********MISC Functions***********************/

/**
 * @desc return allowed status of the gallery media
 * @return <array>: array of valid media status array("public","private",...);
 */
function get_gallery_media_valid_status(){
    $allowed_status=array("public","private","friendsonly","groupsonly","membersonly");
    return apply_filters("gallery_media_valid_status",$allowed_status);
}


/**
 * @desc Check whether the ststus is valid or not
 * @param <sring> $status
 * @return <bool> true/false
 */
function  gallery_is_valid_media_status($status){
    $allowed_status=get_gallery_media_valid_status();
if(in_array($status,$allowed_status))
    return true;

return false;

}


/**
 * @desc get media title from media file name
 * @param <string> $file_name
 * @return<string> the title [file name without extension]
 */

function gallery_get_media_title_from_file_name($file_name){
    $dot_pos=strrpos( $file_name,".");
    return substr($file_name,0,$dot_pos);
    
}
/**
 * @desc Get the total media count for a gallery
 */
function gallery_get_media_count($gallery_id){
    return BP_Gallery_Media::get_media_count($gallery_id);//force the privacy automatically
}




/**
 * Accessor for media, do not create Media directly by using new BP_Gallery_media, rather use bp_gallery_get_media();
 */
function bp_gallery_get_media($media_id){
     if ( !$media = wp_cache_get( 'gallery_gallery_media_' . $media_id, 'bp' ) ) {
        $media = new BP_Gallery_Media($media_id);
	wp_cache_set( 'gallery_gallery_media_' . $media_id, $media, 'bp' );
    }
    return $media;
}

function bp_gallery_delete_media_from_cache($media_old){
    $media_id=$media_old->id;
   if ($media = wp_cache_get( 'gallery_gallery_media_' . $media_id, 'bp' ) ) {
               wp_cache_delete('gallery_gallery_media_' . $media_id, 'bp');
        }

}

function bp_gallery_get_emebed_media_details( $url, $args = '' ) {
            require_once( ABSPATH . WPINC . '/class-oembed.php' );
		$provider = false;
                $oembed = _wp_oembed_get_object();
		if ( !isset($args['discover']) )
			$args['discover'] = true;

		foreach ( $oembed->providers as $matchmask => $data ) {
			list( $providerurl, $regex ) = $data;

			// Turn the asterisk-type provider URLs into regex
			if ( !$regex )
				$matchmask = '#' . str_replace( '___wildcard___', '(.+)', preg_quote( str_replace( '*', '___wildcard___', $matchmask ), '#' ) ) . '#i';

			if ( preg_match( $matchmask, $url ) ) {
				$provider = str_replace( '{format}', 'json', $providerurl ); // JSON is easier to deal with than XML
				break;
			}
		}

		if ( !$provider && $args['discover'] )
			$provider = $oembed->discover( $url );

		if ( !$provider || false === $data = $oembed->fetch( $provider, $url, $args ) )
			return false;

                return $data;
		//return apply_filters( 'oembed_result', $this->data2html( $data, $url ), $url, $args );
	}
 //get external supported media types and their details
  function bp_gallery_get_allowed_external_services_settings(){

      $info=array();
      $info['video']= array("YouTube","Vimeo","Viddler","Hulu","blip.tv");
      $info['photo']=array('Flickr','Smugmug');
          return apply_filters("bp_gallery_get_allowed_external_services_settings",$info);
  }
//is external service allowed for a media types
 function bp_gallery_is_external_service_allowed($type){
     $allowed=bp_gallery_get_allowed_external_services_settings();
     //print_r($allowed);
     $types=array_keys($allowed);
      if(in_array($type, $types))
             return true;
     return false;
 }

 function bp_gallery_get_allowed_external_service($type){
   $allowed=bp_gallery_get_allowed_external_services_settings();
   $services=$allowed[$type];
   if(!empty($services)) //in case the type has no allowed service
    return join(",",$services);
   else
       return false;
   
 }
function bp_gallery_get_media_type_from_service($service){
    //we could use service as key, but what happens in case the same site provides 2 type of media, so using the loop for now
    $allowed=bp_gallery_get_allowed_external_services_settings();
    foreach($allowed as $type=>$service_name)
        if(in_array($service_name,$service))
                return $type;
        return false;
}
//clear media cache
add_action("gallery_media_after_save","bp_gallery_delete_media_from_cache");
add_action("gallery_media_after_delete","bp_gallery_delete_media_from_cache");

?>