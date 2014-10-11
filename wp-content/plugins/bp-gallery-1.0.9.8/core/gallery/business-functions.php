<?php
/********************************************************************************
 * Business Functions
 *
 * Business functions are where all the magic happens in BuddyPress. They will
 * handle the actual saving or manipulation of information. Usually they will
 * hand off to a database class for data access, then return
 * true or false on success or failure.
 */
/*
 * The Gallery Business function handles all the gallery related logic, for media, please see business-functions-media.php
 */

/*
 * ---------------------------- Gallery Creation, Gallery Editing, Gallery deletion--------------------------
 */

/**
 * @desc Creating new Gallery
 * @global <type> $bp
 * @param <string> $args: a & separated stirng args
 * @return <int> Gallery Id
 */
function gallery_create_gallery( $args = '' ) {
	global $bp;
	extract( $args );

	/**
	 * Possible parameters (pass as assoc array):
	 *  'gallery_id'
	 *  'creator_id'
	 *  'title'
	 *  'description'
	 *  'slug'
	 *  'status'
         *  'gallery_type'
         *  'owner_object_id'
         *  'owner_object_type'
	 *  'date_created'
	 */

	if ( !empty($gallery_id ))
		$gallery = new BP_Gallery_Gallery( $gallery_id );
	else
		$gallery = new BP_Gallery_Gallery;

	if ( $creator_id ) {
		$gallery->creator_id = $creator_id;
	} else {
		$gallery->creator_id = $bp->loggedin_user->id;
	}

    if($owner_object_id)
        $gallery->owner_object_id=$owner_object_id;

    else
        $gallery->owner_object_id=$bp->loggedin_user->id;

    if($owner_object_type)
        $gallery->owner_object_type=$owner_object_type;
     else
     //assume to be users gallery,YUP
     $gallery->owner_object_type="user";//yeh make it users personal gallery


    if ( isset($title) )
	$gallery->title = $title;

    if ( isset( $description ) )
	$gallery->description = $description;
    
    if(isset($gallery_type))
        $gallery->gallery_type=$gallery_type;
    else
        $gallery->gallery_type="photo";//assume
   

    if ( isset( $slug ) && gallery_check_slug( $slug,$gallery->creator_id ) )//we will use owner id here
    	$gallery->slug = $slug;

    if ( isset( $status ) ) {
        if ( gallery_is_valid_gallery_status( $status ) )
			$gallery->status = $status;
	}




    if ( isset( $date_created ) )
	$gallery->date_created = $date_created;


    if ( !$gallery->save() )
    	return false;

    if ( !$gallery_id ) {
    	/* If this is a new gallery, set up the creator as the first member and admin */
		$member = new BP_Gallery_Member;
		$member->gallery_id = $gallery->id;
		$member->user_id = $gallery->creator_id;
		$member->is_admin = 1;
                $member->can_upload=1;
                $member->can_view=1;
		$member->user_title = __( 'Gallery Admin', 'bp-gallery' );
		$member->is_confirmed = 1;

		$member->save();
	}
do_action("bp_gallery_gallery_created",$gallery);
	return $gallery->id;
}
/**
 * @desc Update Existing Gallery
 * @global <type> $bp
 * @param <type> $gallery_id
 * @param <type> $gallery_title
 * @param <type> $gallery_desc
 * @param <type> $privacy
 * @return <type> 
 */
//improve
function gallery_update_gallery_details( $args ) {
	global $bp;

        extract( $args );
	if ( empty( $id ) || empty( $title ) )
		return false;

        $gallery = new BP_Gallery_Gallery( $id, false, false );

        if($title)
            $gallery->title = $title;
        if($description)
            $gallery->description = $description;
        if($status)
            $gallery->status=$status;
        if($order)
            $gallery->sort_order=$order;
        if($type)
            $gallery->gallery_type=$type;
    
	if ( !$gallery->save() )
		return false;

	do_action( 'gallery_details_updated', $gallery->id );

	return $gallery;
}
/**
 * @desc deleting gallery, removing gallery data/members/media
 * @global <type> $bp
 * @param <type> $gallery_id
 * @return <type>
 * Not Used currently
 */
function bp_gallery_delete_gallery( $gallery_id ) {
	global $bp;

	// Check the user is the gallery admin.
	if ( !$bp->is_item_admin )
		return false;

	// Get the gallery object
	$gallery = bp_get_gallery( $gallery_id );

	if ( !$gallery->delete() )
		return false;

	/* Delete all gallery activity from activity streams */
	if ( function_exists( 'bp_activity_delete_by_item_id' ) ) {
		bp_activity_delete_by_item_id( array( 'item_id' => $gallery, 'component_name' => $bp->gallery->id ) );
	}

	do_action( 'gallery_delete_gallery', $gallery_id );

	return true;
}

/*
 * SLUG Manipulation
 * Find slugs of gallery from gallery id, find gallery slug from id, check for existance of the gallery using slug
 */
/**
 * @desc check the slug and create a new one if it already exists in the DB
 * @global <unknown> $bp
 * @param <string> $slug
 * @param <string> $owner_type: unique component_name with which gallery is associated
 * @param <int> $owner_id : the id of current owner of gallery, eg: group id for group gallery, user_id fror user gallery
 * @return <string> The New slug
 */
function gallery_check_slug( $slug,$owner_type=null,$owner_id=null ) {
	global $bp;

	if ( 'wp' == substr( $slug, 0, 2 ) )
		$slug = substr( $slug, 2, strlen( $slug ) - 2 );

	if ( in_array( $slug, (array)$bp->gallery->forbidden_names ) ) 
		$slug = $slug . '-' . rand();
	

    if ( BP_Gallery_Gallery::check_slug( $slug,$owner_type,$owner_id ) ) {
		do {
			$slug = $slug . '-' . rand();
		}
        while ( BP_Gallery_Gallery::check_slug( $slug,$owner_type,$owner_id ) );
	}

	return $slug;
}
/**
 * @desc Get gallery slug from gallery Id
 */

function gallery_get_slug( $gallery_id ) {
    $gallery = bp_get_gallery($gallery_id);
    return $gallery->slug;
}


/**
 * @desc check if a gallery exists using gallery slug, owner object type, owner object id
 * @param <type> $gallery_slug
 * @param <type> $owner_type
 * @param <type> $owner_id
 * @return <type> 
 */
function gallery_check_gallery_exists( $gallery_slug,$owner_type,$owner_id ) {
    return BP_Gallery_Gallery::gallery_exists( $gallery_slug,$owner_type,$owner_id );
}


/**********Gallery Status /privacy*****************************/
/**
 * @desc Is the status a valid/allowed status for the gallery
 * @global <type> $bp
 * @param <type> $status
 * @return <type> 
 */
function gallery_is_valid_gallery_status( $status ) {
	global $bp;
	return in_array( $status, (array)$bp->gallery->valid_status );
}
/**
 *@desc Valid status for the gallery, other plugins can extend this
 * @return <type>
 */
function gallery_get_valid_gallery_status(){
    $status=array("public"=>__("Public","bp-gallery"),"private"=>__("Private","bp-gallery"),"friendsonly"=>__("Friends Only","bp-gallery"));
    return apply_filters("gallery_get_valid_status",$status);
}



/*
 *  Status of gallery Manipulations
 */

/**
 * Get the list of valid status for the gallery
 * @return <array> of string, these are the valid status
 */
function gallery_get_valid_status(){
   return array( 'public', 'private', 'hidden','membersonly','friendsonly','groupsonly' );
}

/********************* Type manipulations here, for allowed media types etc**************/
/**
 * @desc Which gallery types are allowed
 * @return array with $key=>$val where $key is gallery type and $val is gallery name
 */
function gallery_get_allowed_gallery_types(){
        $allowed= get_site_option( 'gallery_allowed_type', array("photo"=>__("Photo","bp-gallery"),"video"=>__("Video","bp-gallery"),"audio"=>__("Audio","bp-gallery") ));
        return apply_filters("gallery_allowed_type",$allowed);
}

function gallery_get_allowed_gallery_type_plurals(){
    //register your custom plurals here
     $allowed= apply_filters("gallery_allowed_type_plurals", array("photo"=>__("Photos","bp-gallery"),"video"=>__("Videos","bp-gallery"),"audio"=>__("Audios","bp-gallery") ));
     return $allowed;
}
/**
 * @desc check whether this gallery type is valid/allowed or not
 * @param <string> $type: deemed gallery type
 * @return <bool> is the type allowed or not
 */
function gallery_is_valid_gallery_type($type){
    if(empty ($type))
        return false;
        $allowed_types=gallery_get_allowed_gallery_types();

    if(array_key_exists($type, $allowed_types))
        return true;

    return false;

    }

/**
 * @desc Return descriptive type from gallery_type
 * @param <string> $type: media type i.e photo/video/audio
 * @return <string> description: Photo, Video, Audio etc
 */
function gallery_get_type_description($type){
    $allowed=gallery_get_allowed_gallery_types();
    if(array_key_exists($type, $allowed))
        return $allowed[$type];

return "";
}
/**
 * @desc get the type name e.g Audio,Video,Photo
 * @param <type> $type
 * @return <type>
 */
function gallery_get_type_name($type){
    return gallery_get_type_description($type);
}

function gallery_get_type_name_plural($type){
   $allowed=gallery_get_allowed_gallery_type_plurals();
    if(!empty($type)&&array_key_exists($type, $allowed))
        return $allowed[$type];

return "";
}
/**
 * Check if gallery exits by passing gallery slug or Id
 */

function bp_gallery_exists($slug_or_id,$owner_type=null,$owner_id=null){
    if(!$slug_or_id)
        return false;

    if(is_string($slug_or_id)){
        if(!$owner_type)
            $owner_type=gallery_get_current_object_type();
        if(!$owner_id)
            $owner_id=gallery_get_current_object_id();
         return BP_Gallery_Gallery::gallery_exists($slug_or_id,$owner_type,$owner_id );
    }
    else if(is_numeric($slug_or_id))
      return BP_Gallery_Gallery::gallery_exists_by_id($slug_or_id);

    return false;

}

/*
 * Get gallery by Gallery Id, used to improve the performance as it checks in Cache
 */
function bp_get_gallery($gallery_id){
    if (!$gallery = wp_cache_get( 'gallery_gallery_nouserdata_' . $gallery_id, 'bp' ) ) {
              $gallery = new BP_Gallery_Gallery( $gallery_id, false );
              wp_cache_set( 'gallery_gallery_nouserdata_' . $gallery_id, $gallery, 'bp' );
                 
            }

      return $gallery;
}

function bp_delete_gallery_from_cache($gallery_current){
    $gallery_id=$gallery_current->id;
   if ($gallery = wp_cache_get( 'gallery_gallery_nouserdata_' . $gallery_id, 'bp' ) ) {
               wp_cache_delete('gallery_gallery_nouserdata_' . $gallery_id,  'bp');
        }
      
}

add_action("gallery_delete_gallery","bp_delete_gallery_from_cache");
add_action("gallery_gallery_after_save","bp_delete_gallery_from_cache");


/*** Gallery Fetching, Filtering & Searching  *************************************/

function gallery_get_all( $limit = null, $page = 1, $only_public = false, $sort_by = false, $order = false ) {
	return BP_Gallery_Gallery::get_all( $limit, $page, $sort_by, $order );
}

/*fetch user galleries*/
function gallery_get_user_galleries( $user_id = false, $gallery_type=null,$search_terms=null,$limit = false, $page = false,$order=null ) {
	global $bp;

	if ( !$user_id )
		$user_id = $bp->displayed_user->id;

	return BP_Gallery_Gallery::get_all(array("public","private","friendsonly"),$gallery_type,"user",$user_id,$limit, $page,$search_terms, $order );

    }

function gallery_get_user_group_galleries($filter,$type,$owner_type,$owner_id, $pag_num, $pag_page,$search_terms,$order_by,$sort_order ){
global $bp;
  //  if ( !$user_id )
		$user_id = $bp->loggedin_user->id;

	return BP_Gallery_Gallery::get_all_user_group_galleries($type,$user_id,$limit, $page,$search_terms, $order_by,$sort_order );

    
}


/* how many galleries exists for this user*/
function gallery_total_gallery_for_user( $user_id = false ) {
	global $bp;

	if ( !$user_id )
		$user_id = $bp->displayed_user->id;

	return gallery_total_gallery_for_owner("user",$user_id);
}


function gallery_get_gallery_count_by_gallery_type($type, $owner_type, $owner_id, $status=null){
    //check for the vailidity of the gallery type
    if(!gallery_is_valid_gallery_type($type))
       return 0;//ahh , that's not right
    return BP_Gallery_Gallery::get_gallery_count_by_type($type, $owner_type, $owner_id, $status);
 }

function bp_get_total_gallery_count_for_dir(){
//if(bp_is_gallery_directory())
    return BP_Gallery_Gallery::total_gallery_count(null,null);

}

function bp_gallery_update_time($gallery_id){
    BP_Gallery_Gallery::update_time($gallery_id);
}
?>