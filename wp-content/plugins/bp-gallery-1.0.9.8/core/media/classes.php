<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class BP_Gallery_Media  {
    var $id;
    var $gallery_id;
    var $user_id;
    var $title;
    var $slug;
    var $description;
    var $type;//audio,video,image,data etc
    var $is_remote;//local or remote
    var $status;
    var $sort_order;
    var $enable_wire;//is wire enabled..comment enabled..
    var $remote_url;//if remote..let us have the url
    var $local_orig_path;
    var $local_mid_path;
    var $local_thumb_path;
    var $date_updated;
   function bp_gallery_media( $id = null) {
		if ( $id ) {
			$this->id = $id;
			$this->populate($id);
		}


	}

	function populate( $id ) {
		global $wpdb, $bp;

		$sql = $wpdb->prepare( "SELECT * FROM {$bp->gallery->table_media_data} WHERE id = %d", $this->id );
		$media = $wpdb->get_row($sql);
                
		if ( $media ) {
			$this->id = $media->id;
			$this->gallery_id = $media->gallery_id;
                        $this->title = stripslashes($media->title);
			$this->slug = $media->slug;
			$this->description = stripslashes($media->description);
			$this->type =$media->type;
			$this->user_id =$media->user_id;
			$this->is_remote =$media->is_remote;
			$this->status = $media->status;
                        $this->sort_order=$media->sort_order;
			$this->enable_wire = $media->enable_wire;
			$this->remote_url = $media->remote_url;
			$this->local_orig_path = $media->local_orig_path;
			$this->local_mid_path = $media->local_mid_path;
			$this->local_thumb_path =$media->local_thumb_path;
			$this->date_updated =$media->date_updated;


		}
	}


	function save() {
		global $wpdb, $bp;

		$this->gallery_id = apply_filters( 'gallery_media_gallery_id_before_save', $this->gallery_id, $this->id );
		$this->title = apply_filters( 'gallery_media_title_before_save', $this->title, $this->id );
 		$this->slug = apply_filters( 'gallery_media_slug_before_save', $this->slug, $this->id );
		$this->description = apply_filters( 'gallery_media_description_before_save', $this->description, $this->id );
 		$this->type = apply_filters( 'gallery_media_type_before_save', $this->type, $this->id );
 		$this->user_id = apply_filters( 'gallery_media_user_id_before_save', $this->user_id, $this->id );
 		$this->is_remote = apply_filters( 'gallery_gallery_cover_image_before_save', $this->is_remote, $this->id );
		$this->status = apply_filters( 'gallery_media_status_before_save', $this->status, $this->id );
		$this->enable_wire = apply_filters( 'gallery_media_enable_wire_before_save', $this->enable_wire, $this->id );
		$this->remote_url = apply_filters( 'gallery_media_remote_url_before_save', $this->remote_url, $this->id );
		$this->local_orig_path = apply_filters( 'gallery_media_local_orig_path_before_save', $this->local_orig_path, $this->id );
		$this->local_mid_path = apply_filters( 'gallery_media_local-mid_path_before_save', $this->local_mid_path, $this->id );
		$this->local_thumb_path = apply_filters( 'gallery_media_local_thumb_path_before_save', $this->local_thumb_path, $this->id );

                if(!$this->id)
                     $this->sort_order= apply_filters( 'gallery_media_sort_order_before_save',BP_Gallery_Media::get_order($this->gallery_id), $this->id );
                else
                     $this->sort_order = apply_filters( 'gallery_media_sort_order_before_save', $this->sort_order, $this->id );

		do_action( 'gallery_media_before_save', $this );

		if ( $this->id ) {
			$sql = $wpdb->prepare("UPDATE {$bp->gallery->table_media_data} SET
					gallery_id = %d,
                                        title = %s,
					slug = %s,
					description = %s,
					type = %s,
                                        user_id= %d,
                                        is_remote= %d,
                                        status = %s,
                                        sort_order= %d,
					remote_url = %s,
					local_orig_path = %s,
                                        local_mid_path= %s,
                                        local_thumb_path= %s,
					date_updated = %s
                                        WHERE
					id = %d
                                        ",
					$this->gallery_id,
					$this->title,
					$this->slug,
					$this->description,
					$this->type,
                                        $this->user_id,
                                        $this->is_remote,
					$this->status,
                                        $this->sort_order,
					$this->remote_url,
					$this->local_orig_path,
					$this->local_mid_path,
                                        $this->local_thumb_path,
                                        $this->date_updated,
					$this->id
                            );
		} else {
                    $sql = $wpdb->prepare("INSERT INTO {$bp->gallery->table_media_data} (
					gallery_id,
                                        title,
					slug,
					description,
					type,
                                        user_id,
                                        is_remote,
					status,
                                        sort_order,
					remote_url,
                                        local_orig_path,
                                        local_mid_path,
                                        local_thumb_path,
					date_updated
                                    ) VALUES (
					%d, %s, %s, %s, %s, %d, %d, %s,%d, %s, %s, %s, %s, %s
                                    )",
					$this->gallery_id,
					$this->title,
					$this->slug,
					$this->description,
					$this->type,
                                        $this->user_id,
                                        $this->is_remote,
					$this->status,
                                        $this->sort_order,
					$this->remote_url,
					$this->local_orig_path,
                                        $this->local_mid_path,
                                        $this->local_thumb_path,
					$this->date_updated
			);
		}
	if ( false === $wpdb->query($sql) )
		return false;

	if ( !$this->id ) 
            $this->id = $wpdb->insert_id;
	

	do_action( 'gallery_media_after_save', $this );

	return true;
}

function delete(){
       //do the cleanup remove the media
    global $bp,$wpdb;
    //remove all the files from disk
    @unlink(ABSPATH.$this->local_thumb_path);
    @unlink(ABSPATH.$this->local_mid_path);
    @unlink(ABSPATH.$this->local_orig_path);

   //remove from activity stream too
    if(function_exists("bp_activity_delete")){//check for the activity is enabled or not
  
    bp_gallery_update_activity_on_media_delete($this->id);//delete it from bulk update
    //if it is unpublished,, remove it from unpublished media
     bp_gallery_remove_media_from_unpublished($this->gallery_id,$this->id);
    bp_activity_delete(array("type"=>"new_media_update","secondary_item_id"=>$this->id));
    }
    //delete media met
    bp_delete_media_meta($this->id);
    //we also need to find the activity associated with this media if it was published in bulk and update that activity
     //reorder media
     $this->re_order();
        
    $sql="DELETE FROM {$bp->gallery->table_media_data} WHERE id=".$this->id;
       //now delete from the database
     if($wpdb->query($wpdb->prepare($sql))){

         do_action("gallery_media_after_delete",$this);
         return true;

     }
     else
        return false;
}

function delete_for_gallery($gallery_id){
    global $bp,$wpdb;
     //get all media in the gallery and delete all one by one, we do one by one because we need to
      $medias=BP_Gallery_Media::get_all(array("public","private","friendsonly"),null,$gallery_id);
    foreach($medias['media'] as $media_id ){
        $media=bp_gallery_get_media($media_id);
        $media->delete();
     }
return true;
}
 /*get all media */
function get_all( $status_filter=array('public'),$type=null,$gallery_id=null,$user_id=null,$limit = null, $page = null, $order_by = "sort_order",$sort_order=null ) {
    global $wpdb, $bp;
   
    // Default sql WHERE conditions are blank. TODO: generic handler function.
    $where_sql = null;
    $where_conditions = array();
       
    foreach($status_filter as $key=>$ac_level)
        $cond[]="m.status='".$ac_level."'";

    $status_conditions="( ".implode(" OR ",$cond)." )";
      
     $where_conditions[]=$status_conditions;
    foreach($status_filter as $key=>$ac_level)
        $gcond[]="g.status='".$ac_level."'";

    $gstatus_conditions="( ".implode(" OR ",$gcond)." )";
    
    $where_conditions[]= $gstatus_conditions;

    if ( $gallery_id )
    	$where_conditions[] = $wpdb->prepare( "m.gallery_id =".$gallery_id);//limit to gallery
     if($type)
         $where_conditions[] = $wpdb->prepare( "m.type ='".$type."'");//limit to gallery
         //
$where_conditions[] = $wpdb->prepare( "m.gallery_id =g.id");//limit to gallery
//
if($user_id)
    $where_conditions[] = $wpdb->prepare( "m.user_id ='".$user_id."'");//limit to gallery


// Build where sql statement if necessary
    if ( !empty( $where_conditions ) )
        $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );

    if ( $limit && $page )
	$pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );

    $order_sql=BP_Gallery_Media::get_orderby_sql($order_by,$sort_order);
   			
    $sql = $wpdb->prepare( "SELECT m.id FROM {$bp->gallery->table_media_data} m,{$bp->gallery->table_galleries_data} g {$where_sql} {$order_sql} {$pag_sql}" );

    $media=$wpdb->get_col($sql);
    $total_media = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(m.id)From {$bp->gallery->table_media_data} m,{$bp->gallery->table_galleries_data} g {$where_sql}" ) );
    
    return array("media"=>$media,"total"=>$total_media);
    
}

//helper function for preparing the order by sql
function get_orderby_sql($order_by,$order=null){
global $wpdb;

    $sql="";
    switch ($order_by){
    case "random":
        $sql=$wpdb->prepare("ORDER BY RAND() ");
        break;

    case "date":
        if(empty($order))
            $order="DESC";
        $sql=$wpdb->prepare("ORDER BY m.date_updated ");
        break;
    case "alphabet":
         if(empty($order))
            $order="ASC";
        $sql=$wpdb->prepare("ORDER BY m.title ");
        break;
    case "sort_order":
    default:
         if(empty($order))
            $order="DESC";
         $sql=$wpdb->prepare("ORDER BY m.sort_order ");
     break;

}
  $sql=$wpdb->prepare($sql." ".$order);
return $sql;

}
/**
 *
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <type> $slug
 * @param <type> $gallery_id
 * @return <type> Check if a media exists inside a gallery
 */
function media_exists($slug,$gallery_id){
    global $wpdb, $bp;
    if ( !$slug )
	return false;

    return $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_media_data} WHERE slug = %s and gallery_id= %s", $slug,$gallery_id ) );
}
/**
 *
 * @param <type> $slug
 * @param <type> $gallery_id
 * @return <type>
 */
function get_id_from_slug( $slug,$gallery_id ) {
    return BP_Gallery_Media::media_exists( $slug,$gallery_id );
}
    
function check_slug( $slug,$gallery_id ) {
    global $wpdb, $bp;
    return $wpdb->get_var( $wpdb->prepare( "SELECT slug FROM {$bp->gallery->table_media_data} WHERE slug = %s and gallery_id=%d ", $slug,$gallery_id ) );
}


function get_slug( $media_id ) {
    global $wpdb, $bp;
    return $wpdb->get_var( $wpdb->prepare( "SELECT slug FROM {$bp->gallery->table_media_data} WHERE id = %d", $media_id ) );
}

//need to be improved and code to be fine tuned, it is not good practice
function get_adjacent_gallery_media($previous = true,$status_filter=null) {
    global $medias_template, $wpdb, $bp;
    if(!$media)
	$media= $medias_template->media;
    $status_filter=$medias_template->extra["current_filter"];
       
     if(!empty($status_filter)){
         
        foreach($status_filter as $key=>$ac_level)
            $cond[]="m.status='".$ac_level."'";

    $status_conditions=" and ( ".implode(" OR ",$cond)." )";
     }
    $adjacent = $previous ? 'previous' : 'next';
    $op = $previous ? '<' : '>';
    
    $order = $previous ? 'DESC' : 'ASC';
//$order_by_sql=  BP_Gallery_Media::get_orderby_sql($medias_template->extra["orderby"],$order);

switch($medias_template->extra["orderby"]){
case "random":
        $sql=$wpdb->prepare("ORDER BY RAND() ");
   
    $compare_sql= "WHERE ";
        break;

    case "date":
          $sql=$wpdb->prepare("ORDER BY m.date_updated $order");
       
         $compare_sql="WHERE date_updated $op {$media->date_updated} and";
        break;
   
    case "sort_order":
    default:
         $sql=$wpdb->prepare("ORDER BY m.sort_order $order");
        $compare_sql="WHERE sort_order $op {$media->sort_order} and";
     break;
}


    $where = $wpdb->prepare(" $compare_sql  gallery_id= %d {$status_conditions} ",$media->gallery_id);
    $sort  = " $sql   LIMIT 1";
   
    return $wpdb->get_row  ("SELECT * FROM {$bp->gallery->table_media_data} m $where $sort  ");
}
/**
 * @desc reorder media when a media is deleted
 * 
 */
/** On gallery delete we will use this to re order the gallery orders*/
function re_order(){
//for all gallery below this gallery update order
    global $bp,$wpdb;
    $sql=$wpdb->prepare("UPDATE {$bp->gallery->table_media_data} set sort_order= sort_order -1 WHERE sort_order > %d and gallery_id= %d ",$this->sort_order,$this->gallery_id);
   // echo $sql;
   $wpdb->query($sql);
   return true;
}

/**
 * @desc Get the order for the current new media
 * @global <type> $bp
 * @global <type> $wpdb
 * @param <type> $gallery_id
 * @return <type> 
 */
function get_order($gallery_id){
//get the order of current gallery based on the owner object type,owner object id and the gallry type
    global $bp,$wpdb;
    $where_sql = null;
    $where_sql = $wpdb->prepare( " WHERE m.gallery_id =".$gallery_id);
    $sql=$wpdb->prepare("SELECT max(sort_order) as sort_order from {$bp->gallery->table_media_data} m {$where_sql}");

    $order=$wpdb->get_var($sql);
    if(empty($order))
	return 1; //first gallery of this type for the owner
    else
        return intval($order)+1;
}

/**
 * @desc return media count inside a gallery depending on who is viewing the gallery
 */
function get_media_count($gallery_id){
    global $wpdb,$bp;
    $where_conditions=array();
    $gallery=bp_get_gallery($gallery_id);
    $access=gallery_get_current_user_access($gallery->owner_object_type,$gallery->owner_object_id);
//force access level
    foreach($access as $key=>$ac_level)
        $cond[]="m.status='".$ac_level."'";

 $status_conditions="( ".implode(" OR ",$cond)." )";
 $where_conditions[]= $status_conditions;

 if($gallery_id)
   $where_conditions[]=" gallery_id = ".$gallery_id;

  $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );
  $sql="SELECT COUNT(id) FROM {$bp->gallery->table_media_data} m {$where_sql} ";
  $count=$wpdb->get_var($wpdb->prepare($sql));

   if(empty($count))
     $count=0;
return $count;
}

function gallery_has_media($gallery){
    return BP_Gallery_Media::get_media_count($gallery->id);

}

function get_first_media_id($gallery){
/** Get the first media in the gallery**/
 if(!gallery_has_media($gallery))
     return null;
global $bp,$wpdb;
 $sql=$wpdb->prepare("SELECT id FROM {$bp->gallery->table_media_data}  where gallery_id= %d",$gallery->id);
//echo $sql;
 return $wpdb->get_var($sql);

}
}//end of BP_Gallery_Media class
?>