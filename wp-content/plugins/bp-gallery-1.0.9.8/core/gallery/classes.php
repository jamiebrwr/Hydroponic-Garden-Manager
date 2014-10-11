<?php
/* 
 * Gallery Class for handing db
 * 
 */
class BP_Gallery_Gallery{
    var $id;
    var $parent_id;//for future use
    var $creator_id;//who created this
    var $title;
    var $slug;
    var $description;
    var $cover_mini;//the cover image
    var $cover_mid;
    var $cover_orig;
    var $status;//who can view this gallery
    var $owner_object_type;//which object owns this gallery
    var $owner_object_id;//id of the woner object
    var $sort_order;//order of galleries
    var $date_created;
    var $date_updated;
    var $gallery_type;//type of media uploaded to this galler/audio/video/doc/images
//v 1.1
   // var $user_dataset;

	

/** single will be used in the next release*/ //v1.1 inspiration from BP_Groups_Group class at some extent
	function bp_gallery_gallery( $id = null, $single = false, $get_user_dataset = false ) {
		if ( $id ) {
			$this->id = $id;
			$this->populate( $get_user_dataset );//not used in v1.0, will be used if I create Single Standalone galleries in next release
		}

		
	}

	function populate( $get_user_dataset ) {
		global $wpdb, $bp;

		$sql = $wpdb->prepare( "SELECT * FROM {$bp->gallery->table_galleries_data} WHERE id = %d", $this->id );
		$gallery = $wpdb->get_row($sql);

		if ( $gallery ) {
			$this->id = $gallery->id;
			$this->parent_id = $gallery->parent_id;
                        $this->creator_id = $gallery->creator_id;
                        $this->title = stripslashes($gallery->title);
			$this->slug = $gallery->slug;
			$this->description = stripslashes($gallery->description);
			$this->cover_mini =$gallery->cover_mini;
			$this->cover_mid =$gallery->cover_mid;
			$this->cover_orig =$gallery->cover_orig;

			$this->status = $gallery->status;
                        $this->gallery_type=$gallery->gallery_type;
			$this->owner_object_type = $gallery->owner_object_type;
			$this->owner_object_id = $gallery->owner_object_id;
			$this->date_created = strtotime($gallery->date_created);
                        $this->date_updated = strtotime($gallery->date_updated);
                        $this->sort_order=$gallery->sort_order;
//			$this->total_member_count = $gallery->total_member_count;

			
		}
	}


	function save() {
     
		global $wpdb, $bp;
                $gallery_order=BP_Gallery_Gallery::get_order($this->owner_object_type,$this->owner_object_id,$this->gallery_type);
		$this->parent_id = apply_filters( 'gallery_gallery_parent_id_before_save', $this->parent_id, $this->id );
		$this->creator_id = apply_filters( 'gallery_gallery_creator_id_before_save', $this->creator_id, $this->id );
		$this->title = apply_filters( 'gallery_gallery_name_before_save', $this->title, $this->id );
 		$this->slug = apply_filters( 'gallery_gallery_slug_before_save', $this->slug, $this->id );
		$this->description = apply_filters( 'gallery_gallery_description_before_save', $this->description, $this->id );
 		$this->cover_mini = apply_filters( 'gallery_gallery_cover_mini_before_save', $this->cover_mini, $this->id );
 		$this->cover_mid = apply_filters( 'gallery_gallery_cover_mid_before_save', $this->cover_mid, $this->id );
 		$this->cover_orig = apply_filters( 'gallery_gallery_cover_orig_before_save', $this->cover_orig, $this->id );
		$this->status = apply_filters( 'gallery_gallery_status_before_save', $this->status, $this->id );
		$this->gallery_type = apply_filters( 'gallery_gallery_type_before_save', $this->gallery_type, $this->id );
		$this->owner_object_type = apply_filters( 'gallery_gallery_owner_object_type_before_save', $this->owner_object_type, $this->id );
		$this->owner_object_id = apply_filters( 'gallery_gallery_owner_object_id_before_save', $this->owner_object_id, $this->id );
		$this->date_created = apply_filters( 'gallery_gallery_date_created_before_save', $this->date_created, $this->id );
                if(!$this->date_created)
                        $this->date_created=time();
                if(!$this->id)
                    $this->sort_order = apply_filters( 'gallery_gallery_sort_order_before_save', $gallery_order, $this->id );
                 else
                    $this->sort_order = apply_filters( 'gallery_gallery_sort_order_before_save', $this->sort_order, $this->id );

		do_action( 'gallery_gallery_before_save', $this );

		if ( $this->id ) {
			$sql = $wpdb->prepare("UPDATE {$bp->gallery->table_galleries_data} SET
					parent_id = %d,
                                        creator_id = %d,
					title = %s,
					slug = %s,
					description = %s,
					cover_mini = %s,
                                        cover_mid =%s,
                                        cover_orig= %s,
					status = %s,
                                        gallery_type= %s,
                                        sort_order= %d,
					owner_object_type = %s,
					owner_object_id = %d,
					date_created = FROM_UNIXTIME(%d)
                                        WHERE
					id = %d
                                        ",
					$this->parent_id,
					$this->creator_id,
					$this->title,
					$this->slug,
					$this->description,
					$this->cover_mini,
                                        $this->cover_mid,
                                        $this->cover_orig,
					$this->status,
                                        $this->gallery_type,
                                        $this->sort_order,
					$this->owner_object_type,
					$this->owner_object_id,
					$this->date_created,
					$this->id
                            );
                    } else {
			$sql = $wpdb->prepare(
				"INSERT INTO {$bp->gallery->table_galleries_data} (
					parent_id,
                                        creator_id,
					title,
					slug,
					description,
					cover_mini,
                                        cover_mid,
                                        cover_orig,
					status,
                                        gallery_type,
                                        sort_order,
					owner_object_type,
					owner_object_id,
					date_created
				) VALUES (
					%d, %d, %s, %s, %s, %s,%s,%s, %s,%s,%d, %s, %d, FROM_UNIXTIME(%d)
				)",
					$this->parent_id,
					$this->creator_id,
					$this->title,
					$this->slug,
					$this->description,
					$this->cover_mini,
                                        $this->cover_mid,
                                        $this->cover_orig,
					$this->status,
                                        $this->gallery_type,
                                        $this->sort_order,
					$this->owner_object_type,
					$this->owner_object_id,
					$this->date_created
                                );
                    }
 
	if ( false === $wpdb->query($sql) )
			return false;

	if ( !$this->id ) 
		$this->id = $wpdb->insert_id;
		
	do_action( 'gallery_gallery_after_save', $this );

	return true;
}

	
	
 //consideration
        //delete cover
        //delete meta
        //delete media
        //delete activity
        //delete cache
        //remove directory
function delete() {
    global $wpdb, $bp;

        $this->re_order();//reorder the gallery
         //delete all media
        BP_Gallery_Media::delete_for_gallery($this->id);//delete all media for this gallery
         
	//delete all activity which say created_gallery
    $activity_id=bp_get_gallery_meta($this->id,"bulk_published_activity_id");
    if(!empty($activity_id)&&bp_is_active("activity"))
        bp_activity_delete(array("id"=>$activity_id));
        
       BP_Gallery_Member::delete( $this->creator_id, $this->id, false );

        //Delete cover Image
        @unlink(ABSPATH.$this->cover_mini);
        @unlink(ABSPATH.$this->cover_mid);
        @unlink(ABSPATH.$this->cover_orig);

        //then we may need to unlink the directory, well let us keep it there for now
        //rmdir($dirname)
        if ( !$wpdb->query( $wpdb->prepare( "DELETE FROM {$bp->gallery->table_galleries_data} WHERE id = %d", $this->id ) ) )
			return false;
       bp_delete_gallery_meta($this->id);
        do_action("gallery_delete_gallery",$this);
        do_action("bp_gallery_gallery_deleted",$this);
		return true;


}

//for user galleries deletion
/*
 *Delet all gallries for User $user_id
 */
function delete_gallery_for_user($user_id){
       BP_Gallery_Gallery::delete_gallery_for_owner("user",$user_id);
  }
 function delete_gallery_for_owner($owner_type,$owner_id){
    global $bp,$wpdb;
    $query="SELECT id from {$bp->gallery->table_galleries_data} WHERE owner_object_type='".$owner_type."' AND owner_object_id=".$owner_id;
    $galleries=$wpdb->get_col($wpdb->prepare($query));

    foreach($galleries as $gid){
         $gallery=bp_get_gallery($gid);
         $gallery->delete();//delete them
       }
}

function delete_gallery_for_group($group_id){
       BP_Gallery_Gallery::delete_gallery_for_owner("groups",$group_id);
   }
/*
 *  Helper Functions
 */
/*
 * On gallery delete we will use this to re order the gallery orders
 * for all gallery below this gallery update order
 */
function re_order(){
    global $bp,$wpdb;
    $sql=$wpdb->prepare("UPDATE {$bp->gallery->table_galleries_data} set sort_order= sort_order -1 WHERE sort_order > %d and owner_object_type= %s and owner_object_id= %d ",$this->sort_order,$this->owner_object_type,$this->owner_object_id);
    $wpdb->query($sql);
  return true;
}


/**
 * Get the Order of New Gallery In it's owner's galleries
 * @global <type> $bp
 * @global <type> $wpdb
 * @param <string> $owner_type
 * @param <int> $owner_id
 * @param <string> $gallery_type
 * @return <int> Order of the Gallery
 */
function get_order($owner_type,$owner_id,$gallery_type){
    global $bp,$wpdb;
        $where_sql = null;
        $where_conditions = array();

        if ( $owner_type)
            $where_conditions[] = $wpdb->prepare( "g.owner_object_type ='".$owner_type."'");

        if ( $owner_id)
            $where_conditions[] = $wpdb->prepare( "g.owner_object_id =".$owner_id);

        if($gallery_type)
            $where_conditions[] = $wpdb->prepare( "g.gallery_type ='".$gallery_type."'");
		// Build where sql statement if necessary

        if ( !empty( $where_conditions ) )
            $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );

        $sql=$wpdb->prepare("SELECT max(sort_order) as sort_order from {$bp->gallery->table_galleries_data} g {$where_sql}");

        $order=$wpdb->get_var($sql);

        if(empty($order))
            return 1; //first Gallery of this type for the owner
        else
            return intval($order)+1;
}

//helper function for preparing the order by sql
function get_orderby_sql($order_by,$sort_order){
global $wpdb;

$sql="";
switch ($order_by){
case "random":
    $sql=$wpdb->prepare("ORDER BY RAND() ");
    break;

case "date":
    $sql=$wpdb->prepare("ORDER BY g.date_updated {$sort_order}");
    break;
case "alphabet":
    $sql=$wpdb->prepare("ORDER BY g.title {$sort_order} ");
    break;
case "sort_order":
default:
     $sql=$wpdb->prepare("ORDER BY g.sort_order {$sort_order}");
 break;

}

return $sql;

}

/**
 * Static Functions
 * 
 */


/*
 * -------------------------------------------- Listing /accessing functions for Gallery -----------------------------------
 */
/**
 * Generic functions for getting gallery ids
 */

function get_all($status_filter=array('public'),$gallery_type=null,$owner_type=null,$owner_id=null,$limit = null, $page = null,$search_terms=null, $order_by = "sort_order",$sort_order="ASC" ) {
    global $wpdb, $bp;
   
    $access_cond=array();
    $where_sql = null;
    $where_conditions = array();

    
    foreach($status_filter as $key=>$ac_level)
      $access_cond[]="g.status='".$ac_level."'";

    $status_conditions="( ".implode(" OR ",$access_cond)." )";
    $where_conditions[]= $wpdb->prepare($status_conditions);

    if($gallery_type)
       $where_conditions[] = $wpdb->prepare( "g.gallery_type ='".$gallery_type."'");

      //should it belong to group/user
    if ( $owner_type)
	$where_conditions[] = $wpdb->prepare( "g.owner_object_type ='".$owner_type."'");
     //have a spcific owner specified
    if ( $owner_id)
         $where_conditions[] = $wpdb->prepare( "g.owner_object_id =".$owner_id);

    if ( $search_terms ) {
        $search_terms = like_escape( $wpdb->escape( $search_terms ) );
        $search_sql = " ( g.title LIKE '%%{$search_terms}%%' OR g.description LIKE '%%{$search_terms}%%' )";
        $where_conditions[]=$wpdb->prepare($search_sql);
	}

        

        // Build where sql statement if necessary
    if ( !empty( $where_conditions ) )
	  $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );

    
    if ( $limit && $page )
	    $pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );

		
    $order_sql = BP_Gallery_Gallery::get_orderby_sql($order_by,$sort_order) ;//"ORDER BY g.sort_order $order";

    $sql =  "SELECT id FROM {$bp->gallery->table_galleries_data} g {$where_sql} {$order_sql} {$pag_sql}";

    $galleries= $wpdb->get_col($sql);

    $total=$wpdb->get_var("select count(id) from {$bp->gallery->table_galleries_data} g {$where_sql}" );

    return array("galleries"=>$galleries,"total"=>$total);

}
//find all group galleries of a user
function get_all_user_group_galleries($gallery_type,$user_id,$limit, $page,$search_terms, $order_by,$sort_order ){

    global $wpdb, $bp;
    $total=0;
    $galleris=null;
    $where_sql = null;
    $where_conditions=array();
    $groups=groups_get_user_groups($user_id);
    $gids=$groups['groups'];

if(!empty($gids)){
    $gids="(".join(",", $gids).")";
    if($gallery_type)
       $where_conditions[] = $wpdb->prepare( "g.gallery_type ='".$gallery_type."'");

    $where_conditions[]=$wpdb->prepare("g.owner_object_type='groups' AND g.owner_object_id IN {$gids} ");
     // Build where sql statement if necessary
    if ( !empty( $where_conditions ) )
	  $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );


    if ( $limit && $page )
	    $pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );


    $order_sql = BP_Gallery_Gallery::get_orderby_sql($order_by,$sort_order) ;//"ORDER BY g.sort_order $order";

    $sql =  "SELECT id FROM {$bp->gallery->table_galleries_data} g {$where_sql} {$order_sql} {$pag_sql}";

    $galleries= $wpdb->get_col($sql);

    $total=$wpdb->get_var("select count(id) from {$bp->gallery->table_galleries_data} g {$where_sql}" );
}

    return array("galleries"=>$galleries,"total"=>$total);

}
    /*get gallery by gallery type*/
function get_all_by_type($gallery_type="all", $owner_type=null,$owner_id=null,$limit = null, $page = null, $status = "public",  $order = "DESC" ) {
	global $wpdb, $bp;

	// Default sql WHERE conditions are blank. TODO: generic handler function.
	$where_sql = null;
	$where_conditions = array();

        $access=gallery_get_current_user_access($owner_type,$owner_id);
        foreach($access as $key=>$ac_level)
         $cond[]="g.status='".$ac_level."'";

        $status_conditions="( ".implode(" OR ",$cond)." )";


        $where_conditions[]= $status_conditions;


        if ( $owner_type)
		$where_conditions[] = $wpdb->prepare( "g.owner_object_type ='".$owner_type."'");
        if ( $owner_id)
		$where_conditions[] = $wpdb->prepare( "g.owner_object_id =".$owner_id);
        if($gallery_type&&$gallery_type!='all')
        	$where_conditions[] = $wpdb->prepare( "g.gallery_type ='".$gallery_type."'");
		// Build where sql statement if necessary
	if ( !empty( $where_conditions ) )
		$where_sql = 'WHERE ' . join( ' AND ', $where_conditions );

	if ( $limit && $page )
		$pag_sql = $wpdb->prepare( " LIMIT %d, %d", intval( ( $page - 1 ) * $limit), intval( $limit ) );


	$sort_by = $wpdb->escape( $sort_by );
	$order = $wpdb->escape( $order );
	$order_sql = "ORDER BY g.sort_order $order";

	$sql = $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_galleries_data} g {$where_sql} {$order_sql} {$pag_sql}" );



	$galleries= $wpdb->get_col($sql);
        $total=$wpdb->get_var("select count(id) from {$bp->gallery->table_galleries_data} g {$where_sql}" );

    return array("galleries"=>$galleries,"total"=>$total);

}

/**
 * 
 */
function get_gallery_list($owner_type=null,$owner_id=null,$type=null){
//we may want to filter some time
   global $bp,$wpdb;
     $where_conditions=array();

     if($owner_type)
        $where_conditions[]="owner_object_type='".$owner_type."'";

     if($type)
        $where_conditions[]="gallery_type='".$type."'";

    if($owner_type&&$owner_id)
      $where_conditions[]="owner_object_id=".$owner_id;

    if(!empty ($where_conditions))
       $where_condition=implode(" AND ", $where_conditions);
       
    $sql="SELECT * FROM {$bp->gallery->table_galleries_data} WHERE  {$where_condition}";

    $r= $wpdb->get_results($wpdb->prepare($sql));

    return $r;
}


/*
 * Counting the galleris for users/by type/by owner etc
 */
/** a generic function to find the total gallery count*/
function total_gallery_count($owner_type=null,$owner_id=null, $access=array("public")){
   global $bp,$wpdb;
   $cond=array();
   $where_sql = null;
   $where_conditions = array();

  foreach($access as $key=>$ac_level)
       $cond[]="g.status='".$ac_level."'";

  $status_conditions="( ".implode(" OR ",$cond)." )";
  $where_conditions[]= $status_conditions;


  if ( $owner_type)
    $where_conditions[] = $wpdb->prepare( "g.owner_object_type ='".$owner_type."'");

  if ( $owner_id)
	$where_conditions[] = $wpdb->prepare( "g.owner_object_id =".$owner_id);

    // Build where sql statement if necessary
  if ( !empty( $where_conditions ) )
    $where_sql = 'WHERE ' . join( ' AND ', $where_conditions );

    //now the sql
    $q=$wpdb->prepare( "SELECT COUNT(DISTINCT id) FROM {$bp->gallery->table_galleries_data} g  {$where_sql} ");


    return $wpdb->get_var($q  );
}

function get_gallery_count_by_type($gallery_type, $owner_type, $owner_id, $status){

     global $wpdb, $bp;

	// Default sql WHERE conditions are blank. TODO: generic handler function.
    $where_sql = null;
    $where_conditions = array();

    if ( $status )
        $where_conditions[] = $wpdb->prepare( "g.status = '".$status."'" );

    if ( $owner_type)
	$where_conditions[] = $wpdb->prepare( "g.owner_object_type ='".$owner_type."'");

    if ( $owner_id)
	$where_conditions[] = $wpdb->prepare( "g.owner_object_id =".$owner_id);

    if($gallery_type)
       	$where_conditions[] = $wpdb->prepare( "g.gallery_type ='".$gallery_type."'");
		// Build where sql statement if necessary
    if ( !empty( $where_conditions ) )
	$where_sql = 'WHERE ' . join( ' AND ', $where_conditions );


    $total=$wpdb->get_var("SELECT COUNT(id) FROM {$bp->gallery->table_galleries_data} g {$where_sql}" );

    return $total;

}
function update_time($gallery_id){
    global $bp,$wpdb;
    $sql="update {$bp->gallery->table_galleries_data} set date_updated=NOW() where id=%d";
   $wpdb->query($wpdb->prepare($sql,$gallery_id));
}
/*
 * ---------------------------------------- Conditions and Slug testing/manipulation functions--------------------------------------------------------------------------------------
 */


function gallery_exists( $slug,$owner_type,$owner_id ) {
    global $wpdb, $bp;

    if ( !$slug )
	return false;

    if(empty($owner_type))
       $owner_type="user";

   $where_sql = null;
   $where_conditions = array();

    if(!empty($owner_type))
             $where_conditions[]=" owner_object_type='".$owner_type."'";

    if(!empty($owner_id))
           $where_conditions[]=" owner_object_id=".$owner_id;

    $where_conditions[]=" slug= %s";
    
    if(!empty($where_conditions))
            $where_sql=implode(" AND ", $where_conditions);

    $sql=$wpdb->prepare( "SELECT id FROM {$bp->gallery->table_galleries_data} WHERE ".$where_sql,$slug );
   
       return $wpdb->get_var( $sql );
}


function gallery_exists_by_id($id){
 global $wpdb, $bp;

    if ( !$id )
	return false;

    return $wpdb->get_var( $wpdb->prepare( "SELECT id FROM {$bp->gallery->table_galleries_data} WHERE id = %d ", $id ) );

}
/**
 * get The gallery Id from gallery slug and it's owner_type and owner_id
 * @param <string> $slug
 * @param <string> $owner_type
 * @param <int> $owner_id
 * @return <int> gallery Id
 */
function get_id_from_slug( $slug,$owner_type,$owner_id ) {
	return BP_Gallery_Gallery::gallery_exists( $slug,$owner_type,$owner_id );
}

/**
 *
 */
function check_slug( $slug,$owner_type=null,$owner_id=null ) {
    global $wpdb, $bp;

        $where_sql = null;
        $where_conditions = array();

        if(!empty($owner_type))
             $where_conditions[]=" owner_object_type='".$owner_type."'";

        if(!empty($owner_id))
            $where_conditions[]=" owner_object_id=".$owner_id;

        if(!empty($where_conditions))
           $where_sql=" AND ".implode(" AND ", $where_conditions);

        $slug_sql=$wpdb->prepare( "SELECT slug FROM {$bp->gallery->table_galleries_data} WHERE slug = %s ".$where_sql, $slug );

        return $wpdb->get_var( $slug_sql);
}

/**
 * get The gallery Slug from gallery Id
 */
function get_slug( $gallery_id ) {
    global $wpdb, $bp;

    return $wpdb->get_var( $wpdb->prepare( "SELECT slug FROM {$bp->gallery->table_galleries_data} WHERE id = %d", $gallery_id ) );
}


/**
 * For navigation between galleries
 * @global <type> $galleries_template
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <bool> $previous
 * @return <type> 
 */
function get_adjacent_gallery($previous = true) {
    global $galleries_template, $wpdb, $bp;

        $gallery= $galleries_template->gallery;
        $adjacent = $previous ? 'previous' : 'next';
        $op = $previous ? '<' : '>';
        $order = $previous ? 'DESC' : 'ASC';

        $where = $wpdb->prepare(" WHERE id $op %d and owner_object_type= %s and owner_object_id= %d ", $gallery->id,$gallery->owner_object_type,$gallery->owner_object_id);
        $sort  = " ORDER BY sort_order $order LIMIT 1";
        return $wpdb->get_row  ("SELECT * FROM {$bp->gallery->table_galleries_data} $where $sort ");
}

}//end of BP_Gallery_Gallery class
?>