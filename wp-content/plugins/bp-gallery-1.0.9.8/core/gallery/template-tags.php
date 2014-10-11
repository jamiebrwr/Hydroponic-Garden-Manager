<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*****************************************************************************
 * Gallery Template Class/Tags
 **/

class BP_Gallery_Template {
	var $current_gallery = -1;
	var $gallery_count;
	var $galleries;
	var $gallery;

	var $in_the_loop;

	var $pag_page;
	var $pag_num;
	var $pag_links;
	var $total_gallery_count;

	var $single_gallery = false;

	var $sort_by;
	var $order;
    
   //$owner_type,$owner_id, $type, $per_page, $max, $slug,$filter
	function bp_gallery_template( $owner_type,$owner_id,$scope, $type, $per_page,$page, $max, $slug, $filter,$search_terms,$order_by,$sort_order ) {
		global $bp;

                $this->pag_page = isset( $_REQUEST['glpage'] ) ? intval( $_REQUEST['glpage'] ) : $page;
		$this->pag_num = isset( $_REQUEST['num'] ) ? intval( $_REQUEST['num'] ) : $per_page;
                
//echo "scope".$scope.$owner_type.$owner_id;
        switch ( $scope ) {
            case 'single-gallery':
                 
                 $gallery_id=BP_Gallery_Gallery::get_id_from_slug($slug,$owner_type,$owner_id);//do not implement the privacy here
                 $this->galleries=array(0=>$gallery_id);
                
		break;
            case 'my-group-galleries':
                 $this->galleries =gallery_get_user_group_galleries($filter,$type,$owner_type,$owner_id, $this->pag_num, $this->pag_page,$search_terms,$order_by,$sort_order );
                 break;
            default:
                $this->galleries = BP_Gallery_Gallery::get_all($filter,$type,$owner_type,$owner_id, $this->pag_num, $this->pag_page,$search_terms,$order_by,$sort_order );
                 break;

		}
 
        if ( 'single-gallery' == $scope ) {
		$this->single_gallery = true;
		$this->total_gallery_count = 1;
		$this->gallery_count = 1;
            } else {
                if ( !$max || $max >= (int)$this->galleries['total'] )
                    $this->total_gallery_count = (int)$this->galleries['total'];
		else
                    $this->total_gallery_count = (int)$max;

                $this->galleries = $this->galleries['galleries'];
             //  $this->gallery=$this->galleries;
		if ( $max ) {
			if ( $max >= count($this->galleries) )
                            $this->gallery_count = count($this->galleries);
			else
                            $this->gallery_count = (int)$max;
			} else {
                            $this->gallery_count = count($this->galleries);
                        }
		}

	$this->pag_links = paginate_links( array(
            	'base' => add_query_arg( array( 'glpage' => '%#%', 'num' => $this->pag_num, 's' => isset($_REQUEST['s'])?$_REQUEST['s']:'', 'sortby' => $this->sort_by, 'order' => $this->order ) ),
		'format' => '',
		'total' => ceil($this->total_gallery_count / $this->pag_num),
		'current' => $this->pag_page,
		'prev_text' => '&laquo;',
		'next_text' => '&raquo;',
		'mid_size' => 1
		));
}

function has_galleries() {
    if ( $this->gallery_count )
        	return true;

    return false;
}

function next_gallery() {
    $this->current_gallery++;
    $this->gallery = $this->galleries[$this->current_gallery];
    return $this->gallery;
}

function rewind_galleries() {
    $this->current_gallery = -1;
    if ( $this->gallery_count > 0 ) {
        $this->gallery = $this->galleries[0];
	}
}

function user_galleries() {
    if ( $this->current_gallery + 1 < $this->gallery_count ) 
            return true;
    elseif ( $this->current_gallery + 1 == $this->gallery_count ) {
	do_action('loop_end');
	$this->rewind_galleries();
        }

    $this->in_the_loop = false;
        return false;
}

function the_gallery() {
    
    $this->in_the_loop = true;
    $this->gallery = $this->next_gallery();
   
    // If this is a single gallery then instantiate gallery meta when creating the object.
    if ( $this->single_gallery )
        $gallery = new BP_Gallery_Gallery( $this->gallery, true );

    else {
       
        $gallery=bp_get_gallery($this->gallery);
	}

    $this->gallery = $gallery;//well update gallery to contain current object
    if ( 0 == $this->current_gallery ) // loop has just started
	do_action('loop_start');
    }

    
}//end of BP_Gallery_Template Class

function bp_has_galleries( $args = '' ) {
    global $galleries_template, $bp;

    $defaults = array(
	'type' =>false,//can a be audio,video
	'user_id' => false,
	'per_page' => 10,
        'sitewide'=>false,
        'scope'=>false,
        'page'=>1,
        'owner_type'=>'',
        'owner_id'=>false,
        'search_terms'=>false,
        'orderby'=>'sort_order',
        'sort_order'=>'ASC',
        'max' => false,
	'slug' => false,
        'filter'=>false //this is status filter public/private etc
	);

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );
    if(!$sitewide){
       if($scope){
       //if scope is define
         if($scope=="personal"){
             $owner_type="user";
             $owner_id=$user_id;
             $scope='user-personal';
         }
      else if($scope=="groups")
          $scope="my-group-galleries";

     }
     //note,other components should specify the owner type/owner id
        if((bp_is_user()||(bp_is_active("groups")&&bp_is_group()))){
            if(!$owner_type)
                $owner_type=gallery_get_current_object_type();
            if(!$owner_id)
                $owner_id=gallery_get_current_object_id();//get the current object id
   

            }
     

    if ( $bp->gallery->is_home ) {
        
           //gallery/video,gallery/audio etc and the my-galleries/public/private,other gallery id
        //do we want to filter by type here
        $action_filter = isset($bp->action_variables[0])? $bp->action_variables[0]:false;//filter by gallery type
        /**if no gallery type was specified and the current action is a valid type*/
        if(empty($type)&&gallery_is_valid_gallery_type($action_filter))
             $type=$action_filter;
        }
        else if(bp_is_my_group_galleries()){
          $scope='my-group-galleries';
        }
     else if ( $bp->gallery->current_gallery->slug ) {//if single gallery/media
      
	$scope = 'single-gallery';
	$slug = $bp->gallery->current_gallery->slug;
        $filter=array("public","private","friendsonly");
    }
    else if(bp_is_gallery_directory()){
        
        if(!$scope){
            $owner_type=false;
            $owner_id=false;
        $filter=array("public");//only public galleries should be listed for gallery directory
        }
    }


  }
  if(!$filter)
       $filter=gallery_get_current_user_access($owner_type,$owner_id);//access level
  if ( $max ) {
    	if ( $per_page > $max )
			$per_page = $max;
	}

$galleries_template = new BP_Gallery_Template( $owner_type,$owner_id,$scope, $type, $per_page,$page, $max, $slug,$filter,$search_terms,$orderby,$sort_order );
  
 return apply_filters( 'bp_has_galleries', $galleries_template->has_galleries(), $galleries_template );
}

function bp_galleries() {
	global $galleries_template;
	return $galleries_template->user_galleries();
}

function bp_the_gallery() {
	global $galleries_template;
	return $galleries_template->the_gallery();
}

/*
 * Function for Next and Previous Gallery
 */
function next_gallery_link($format='%link &raquo;', $link='%title') {
	adjacent_gallery_link($format, $link, true);
}

function previous_gallery_link($format='&laquo; %link  ', $link='%title') {
	adjacent_gallery_link($format, $link, false);
}
function adjacent_gallery_link($format, $link, $previous = true) {

    $gallery=BP_Gallery_Gallery::get_adjacent_gallery($previous);

	if ( !$gallery )
		return;

$title = $gallery->title;

if ( empty($gallery->title) )
		$title = $previous ? __('Previous','bp-gallery') : __('Next','bp-gallery');



    $string = '<a href="'.bp_get_gallery_permalink($gallery).'">';
	$link = str_replace('%title', $title, $link);
	$link = $string . $link . '</a>';

	$format = str_replace('%link', $link, $format);

	$adjacent = $previous ? 'previous' : 'next';
	echo apply_filters( "gallery_link", $format, $link );
}

/********************* General Template Tags ********************/


function bp_gallery_id() {
	echo bp_get_gallery_id();
}
    function bp_get_gallery_id( $gallery = false ) {
	global $galleries_template;

	if ( !$gallery )
            $gallery = $galleries_template->gallery;

	return apply_filters( 'bp_get_gallery_id', $gallery->id );
	}

function bp_gallery_title() {
     echo bp_get_gallery_title();
}
	function bp_get_gallery_title( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;

		return apply_filters( 'bp_get_gallery_titile', $gallery->title );
	}

function bp_gallery_type() {
	echo bp_get_gallery_type();
}
	function bp_get_gallery_type( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;

		/*if ( 'photo' == $gallery->gallery_type ) {
			$status = __( "Photo Gallery", "bp-gallery" );
		} else if ( 'video' == $gallery->gallery_type ) {
			$status = __( "Video Gallery", "bp-gallery" );
		} else if ( 'audio' == $gallery->gallery_type ) {
			$status = __( "Audio Gallery", "bp-gallery" );
		} else {
			$status = ucwords( $gallery->gallery_type ) . ' ' . __( 'Gallery', 'bp-gallery' );
		}
                */
		return apply_filters( 'bp_get_gallery_type', $gallery->gallery_type );
	}

function bp_gallery_status() {
	echo bp_get_gallery_status();
}
	function bp_get_gallery_status( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;
                       
		return apply_filters( 'bp_get_gallery_status', $gallery->status );
	}

/*
 * print the abs url of gallery cover mini
 */
function bp_gallery_cover_mini_src(){
    echo bp_gallery_get_cover_mini_src($gallery);
}
/*
 * Return the abs url of gallery cover mini
 */
 function bp_gallery_get_cover_mini_src($gallery=null){
        global $bp, $galleries_template;
        if(!$gallery)
             $gallery=$galleries_template->gallery;
        return bp_gallery_get_cover_src("mini",$gallery);
    }


function bp_gallery_cover_mid_src(){
    echo bp_gallery_get_cover_mid_src($gallery);
}
 function bp_gallery_get_cover_mid_src($gallery=null){
        global $bp, $galleries_template;
        if(!$gallery)
             $gallery=$galleries_template->gallery;
        return bp_gallery_get_cover_src("mid",$gallery);
    }

function bp_gallery_cover_full_src(){
    echo bp_gallery_get_cover_full_src($gallery);
}

     function bp_gallery_get_cover_full_src($gallery=null){
        global $bp, $galleries_template;
        if(!$gallery)
             $gallery=$galleries_template->gallery;
        return bp_gallery_get_cover_src("full",$gallery);
    }
    
function bp_gallery_get_cover_src($type="mid",$gallery=null){
    global $bp, $galleries_template;
      if(!$gallery)
          $gallery=$galleries_template->gallery;

      if($type=="mid")
            $image=$gallery->cover_mid;
      else if($type=="mini")
            $image=$gallery->cover_mini;
      else
             $image=$gallery->cover_orig;

      if(empty($image)) //if there is no cover, get a defult one i.e the first image from the gallery
             $image_url=gallery_get_default_cover($gallery,$type);//get the defaukt cover image
      else
             $image_url=gallery_get_media_full_url($image);
      return $image_url;
}

function bp_gallery_cover_image($type="mid" ) {
	echo bp_get_gallery_cover_image( $type);
}
	function bp_get_gallery_cover_image($type="mid", $gallery =null,$height=200,$width=200 ) {
            global $galleries_template;
            if(!$gallery)
                $gallery=$galleries_template->gallery;
              $image_url=bp_gallery_get_cover_src($type,$gallery);
              $css="class='cover_".$type."'";
              $html="<img src='".$image_url."' alt='".esc_attr($gallery->title)."'". $css. "/>";
              return apply_filters( 'bp_get_gallery_cover_image', $html,$image_url );
	}

        
function bp_gallery_is_cover_image($gallery_id,$image_id){
    if(bp_get_gallery_meta($gallery_id,"cover_image")==$image_id)
            return true;
    else
        return false;
}

function bp_gallery_cover_mid() {
	echo bp_get_gallery_cover_mid();
}
	function bp_get_gallery_cover_mid( $gallery = false ) {
            return bp_get_gallery_cover_image("mid",$gallery );
	}

function bp_gallery_cover_mini() {
	echo bp_get_gallery_cover_mini();
}
	function bp_get_gallery_cover_mini( $gallery = false ) {
        return bp_get_gallery_cover_image( "mini",$gallery );
	}

function bp_gallery_has_cover_image($gallery=null) {
	global $bp,$galleries_template;
        if(!$gallery)
            $gallery=$galleries_template->gallery;
	if(!empty($gallery->cover_orig)||bp_get_gallery_meta($gallery->id, "cover_image"))
             return true;
        else
            
            return false;
}

function gallery_get_default_cover($gallery,$type){
    $cover_image=bp_get_gallery_meta($gallery->id, "cover_image");
    if(empty($cover_image)&&$gallery->gallery_type=="photo"&&gallery_has_media($gallery))//if this is an image gallery and has images
        {//get the first image of the gallery and set it as the cover
            $cover_image=BP_Gallery_Media::get_first_media_id($gallery);
            bp_update_gallery_meta($gallery->id, "cover_image", $cover_image);//store
        }
    if(!empty($cover_image)){
        $image=bp_gallery_get_media($cover_image);

        if($type=="mini")
            $image_rel_path=$image->local_thumb_path;
        else if($type=="mid")
            $image_rel_path=$image->local_mid_path;
        else
            $image_rel_path=$image->local_orig_path;
        return gallery_get_media_full_url($image_rel_path);
             
    }
    
   else
     return $image_url=bp_gallery_get_template_url()."/inc/images/gallery-cover.jpg";
}

/**
 * Lnk Template Tags
 */
function bp_gallery_permalink() {
    echo bp_get_gallery_permalink();
}
  function bp_get_gallery_permalink( $gallery = false ) {
		global $galleries_template, $bp;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;
            $link=$bp->root_domain . '/' . $bp->gallery->slug . '/' . $gallery->slug ;
                //needs attention
           $permalink_for_component=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_permalink",$link,$gallery);
           return apply_filters( 'bp_get_gallery_permalink',$permalink_for_component );
	}
        
function bp_gallery_edit_link(){
    echo bp_get_gallery_edit_link();
}
function bp_get_edit_gallery_base_link($gallery=null){
      global $galleries_template,$bp;
	if ( !$gallery )
		$gallery = $galleries_template->gallery;

        $link=bp_get_gallery_home_url()."/manage/".$gallery->slug;
        return $link;
}
    function bp_get_gallery_edit_link($gallery=null){
        global $galleries_template,$bp;
	if ( !$gallery )
		$gallery = $galleries_template->gallery;
         $link= bp_get_edit_gallery_base_link($gallery)."/edit-info/?_wpnonce=".wp_create_nonce("edit-gallery")."&gallery_id=".$gallery->id;
            $link=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_edit_link", $link);
        return $link;
    }
 function bp_get_gallery_publish_activity_link($gallery=null){
        global $galleries_template,$bp;
	if ( !$gallery )
		$gallery = $galleries_template->gallery;
         $link= bp_get_edit_gallery_base_link($gallery)."/publish-media/?_wpnonce=".wp_create_nonce("publish-media")."&gallery_id=".$gallery->id."&publish=1";
         $link=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_publish_link", $link);
        return $link;
    }

function bp_get_gallery_unpublish_activity_link($gallery=null){
        global $galleries_template,$bp;
	if ( !$gallery )
		$gallery = $galleries_template->gallery;
         $link= bp_get_edit_gallery_base_link($gallery)."/publish-media/?_wpnonce=".wp_create_nonce("publish-media")."&gallery_id=".$gallery->id."&publish=0";
         $link=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_publish_link", $link);
        return $link;
    }
    
function bp_gallery_reorder_link(){
    echo bp_get_gallery_reorder_link();
}
    function bp_get_gallery_reorder_link($gallery=null){
         global $galleries_template,$bp;
        	if ( !$gallery )
                $gallery = $galleries_template->gallery;
                $link= bp_get_edit_gallery_base_link($gallery)."/reorder/?_wpnonce=".wp_create_nonce("reorder-media")."&gallery_id=".$gallery->id;
                $link=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_reorder_link", $link);
            return $link;
    }
function bp_get_gallery_cover_upload_link($gallery=null){
     global $galleries_template,$bp;
if ( !$gallery )
	$gallery = $galleries_template->gallery;
        $link=bp_get_edit_gallery_base_link($gallery)."/cover-upload/?_wpnonce=".wp_create_nonce("cover-upload")."&gallery_id=".$gallery->id;
        $link=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_cover_upload_link", $link);
       return $link;
}
function bp_gallery_delete_link(){
    echo bp_get_gallery_delete_link();

}
    function bp_get_gallery_delete_link($gallery=null){
           global $galleries_template,$bp;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;
              $link=bp_get_edit_gallery_base_link($gallery)."/delete/?_wpnonce=".wp_create_nonce("delete-gallery")."&gallery_id=".$gallery->id;
             $link=apply_filters("bp_get_".strtolower($gallery->owner_object_type)."_gallery_delete_link", $link);
                  return $link;
            }

   
function bp_gallery_slug() {
	echo bp_get_gallery_slug();
}
	function bp_get_gallery_slug( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;

		return apply_filters( 'bp_get_gallery_slug', $gallery->slug );
	}

function bp_gallery_description() {
		echo bp_get_gallery_description();
}
	function bp_get_gallery_description( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;

		return apply_filters( 'bp_get_gallery_description', stripslashes($gallery->description) );
	}


function bp_gallery_date_created() {
	echo bp_get_gallery_date_created();
}
	function bp_get_gallery_date_created( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;

		return  apply_filters( 'bp_get_gallery_date_created', date( get_option( 'date_format' ), $gallery->date_created ) );
	}

function bp_gallery_last_updated() {
	echo bp_get_gallery_last_updated();
}
	function bp_get_gallery_last_updated( $gallery = false ) {
		global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;

		return "Updated:".apply_filters( 'bp_get_gallery_date_created', date( get_option( 'date_format' ), $gallery->date_updated ) );
	}
function bp_gallery_creator_id(){
    echo bp_get_gallery_creator_id();
}

function bp_get_gallery_creator_id($gallery=null){
    global $galleries_template;

		if ( !$gallery )
			$gallery = $galleries_template->gallery;
              
        return $gallery->creator_id;
}
/** pagination**/
function bp_gallery_pagination() {
	echo bp_get_gallery_pagination();
}
	function bp_get_gallery_pagination() {
		global $galleries_template;

		return apply_filters( 'bp_get_gallery_pagination', $galleries_template->pag_links );
	}

function bp_gallery_pagination_count() {
	global $bp, $galleries_template;

	$from_num = intval( ( $galleries_template->pag_page - 1 ) * $galleries_template->pag_num ) + 1;
	$to_num = ( $from_num + ( $galleries_template->pag_num - 1 ) > $galleries_template->total_gallery_count ) ? $galleries_template->total_gallery_count : $from_num + ( $galleries_template->pag_num - 1) ;

	echo sprintf( __( 'Viewing gallery %d to %d (of %d galleries)', 'bp-gallery' ), $from_num, $to_num, $galleries_template->total_gallery_count ); ?> &nbsp;
	<?php
}


/**** Stats**/
/** Must be used Inside the loop*/
function bp_total_gallery_count() {
	echo bp_get_total_gallery_count();
}
/** Must be used Inside the loop*/
	function bp_get_total_gallery_count() {
		global $galleries_template;

		return apply_filters( 'bp_get_total_gallery_count', $galleries_template->total_gallery_count );
	}

function bp_gallery_total_for_member() {
	echo bp_get_gallery_total_for_member();
}
	function bp_get_gallery_total_for_member() {
		return apply_filters( 'bp_get_gallery_total_for_member', BP_Gallery_Member::total_gallery_count() );
	}


/*********** General Gallery Template Tags *************/
/**
 * @desc Return  the home url of gallery
 */
function bp_get_gallery_home_url(){
    global $bp;
    $user_gallery_link=bp_core_get_user_domain($bp->displayed_user->id).BP_GALLERY_SLUG;
    $component=gallery_get_current_object_type();
    return apply_filters($component."_gallery_home_url",$user_gallery_link);
}

/**
 * @desc Display a create Gallery Button
 * @return <type>
 */
function bp_gallery_create_button(){
//check whether to display the link or not
$component=gallery_get_current_object_type();
$component_id=gallery_get_current_object_id();
if(!user_can_create_gallery($component,$component_id))
    return false;
    ?>
    <a id="add_new_gallery_link" href="<?php bp_gallery_create_link();?>">Add Gallery</a>
<?php }

function bp_gallery_create_link(){
    echo bp_get_gallery_create_link();
}
    function bp_get_gallery_create_link($owner_type="user"){
        global $bp;
        $link=bp_get_gallery_home_url()."/create?_wpnonce=".wp_create_nonce('create-gallery-form');
       return apply_filters("bp_get_".strtolower($owner_type)."_gallery_create_link", $link);
      }
  
/**** Conditional tags**/
    
function bp_is_gallery_home(){
       global $bp;
      return isset($bp->gallery->is_home)?$bp->gallery->is_home:false;
  }
 function bp_is_gallery_directory(){
     global $bp;
     return isset($bp->gallery->is_directory)?$bp->gallery->is_directory:false;
 }
 function bp_is_my_group_galleries(){
     global $bp;
     return isset($bp->gallery->is_my_group_gallery)?$bp->gallery->is_my_group_gallery:false;
 }
/***
 * Editing /creating screen conditionals****/
 /**
  * @desc Is this a gallery create page
  * @global <type> $bp
  * @return <type>
  */
function bp_is_gallery_create(){
     global $bp;
    return isset($bp->gallery->is_create_screen)?$bp->gallery->is_create_screen:false;
}
/**
 * Is this gallery edit page
 * @global <type> $bp
 * @return <type>
 */
function bp_is_gallery_edit(){
    global $bp;
    return isset($bp->gallery->is_edit_screen)?$bp->gallery->is_edit_screen:false;//needs to change
}


/**
 * @version 1.0
 * @desc Is this gallery  details edit page
 */
function bp_is_gallery_edit_details(){
  global $bp;
    return  isset($bp->gallery->is_edit_details_screen)?$bp->gallery->is_edit_details_screen:false;
}
/**
 * @version 1.0
 * @desc Is this Edit gallery->reorder media page
 * @global <type> $bp
 * @return <type>
 */
function bp_is_gallery_reorder_media(){
    global $bp;
    return isset($bp->gallery->is_media_reorder_screen)?$bp->gallery->is_media_reorder_screen:false;
}
/**
 * @version 1.0
 * @desc Is this gallery delete page
 * @global <type> $bp
 * @return <type>
 */
function bp_is_gallery_delete(){
    global $bp;
    return isset($bp->gallery->is_delete_screen)?$bp->gallery->is_delete_screen:false;
}
/**
 * @version 1.0
 * @desc Is this media edit page for the gallery
 */
function bp_is_media_edit(){
    global $bp;
    return isset($bp->gallery->is_media_edit_screen)?$bp->gallery->is_media_edit_screen:false;
}

function bp_is_gallery_upload(){
    global $bp;
    return isset($bp->gallery->is_upload_screen)?$bp->gallery->is_upload_screen:false;
}
function bp_is_gallery_add_from_web(){
  global $bp;
    return isset($bp->gallery->is_add_from_web_screen)?$bp->gallery->is_add_from_web_screen:false;
}

function bp_is_gallery_cover_upload(){
    global $bp;
    return isset($bp->gallery->is_cover_upload_screen)?$bp->gallery->is_cover_upload_screen:false;
}
/*for single galleries*/
/**
 * For Single gallery manipulation
 *
 */
function bp_is_single_gallery(){
    global $bp;
    return isset($bp->gallery->is_single_gallery)?$bp->gallery->is_single_gallery:false;
}

/** for single gallery/Editing single gallery page***/
function bp_get_single_gallery_id(){
    global $bp;
if($bp->gallery->current_gallery)
    return $bp->gallery->current_gallery->id;
    
}

function bp_get_single_gallery(){
global $bp;
  if($bp->gallery->current_gallery)
      return $bp->gallery->current_gallery;
    return null;

}

function bp_get_gallery_current_edit_action(){
    global $bp;
    return $bp->gallery->current_action;//is it upload , edit
}

/*****************form actions***********/
//move to media tags
function bp_gallery_media_upload_form_action(){
  $action=bp_get_gallery_home_url()."/upload";
  echo $action;
}

function bp_gallery_media_edit_form_action(){
    global $bp;
    $gallery=bp_get_single_gallery();
    $link=bp_get_gallery_edit_link($gallery);
}
function bp_gallery_create_form_action(){
global $bp;
    echo bp_get_gallery_home_url()."/create";
}
function bp_gallery_edit_form_action(){
 $action=bp_get_gallery_home_url()."/manage";
 echo $action;
}

function bp_gallery_cover_upload_form_action(){
 global $bp;
    $gallery=bp_get_single_gallery();
    $link=bp_get_edit_gallery_base_link($gallery);
   echo $link."/cover-upload";
    
}
function bp_no_gallery_message(){
//detect the type here
global $bp;
$type=isset($bp->action_variables[0])? $bp->action_variables[0]:false;
$type_name=gallery_get_type_name_plural($type);
if(!empty($type_name))
    $message=sprintf(__("There is no %s yet.","bp-gallery"),$type_name);
else
    $message=__("There are no galleries yet.","bp-gallery");

echo $message;
}
/**
 * @desc Show Breadcrumb for gallery, It will be improved in 1.1
 * @global <type> $bp
 * @param <type> $separator
 */
function bp_gallery_bcomb($separator="&raquo;",$show_home=false){
    global $bp;
    $link='';
 if(bp_is_single_gallery())
    $link="<a href='". bp_get_gallery_home_url()."'>".__("Gallery","bp-gallery")."</a>{$separator}<span>".$bp->gallery->current_gallery->title."</span>";

if(bp_is_single_media())
    $link="<a href='". bp_get_gallery_home_url()."'>".__("Gallery","bp-gallery")."</a>{$separator}<a href='".bp_get_gallery_permalink($bp->gallery->current_gallery)."'>".$bp->gallery->current_gallery->title."</a>{$separator}<span>".$bp->gallery->current_media->title."</span>";

if(bp_is_gallery_home()&&$show_home)
    $link="<a href='". bp_get_gallery_home_url()."'>".__("Gallery","bp-gallery")."</a>";
   echo $link;
 
}



/*********** ******************************************8
 * Template Tags for Various link groups/tabs****************
 * 
 */

/**
 * @desc User navigation for gallery, we will use ids for ajax requests
 * @global <type> $bp
 *
 * @return <type>
 */
function bp_user_gallery_admin_tabs( ) {//do we really need it
    global $bp;
    $current_tab = isset($bp->action_variables[0])?$bp->action_variables[0]:false;
    ?>
    <li<?php if ( empty( $current_tab) ||!gallery_is_valid_gallery_type($current_tab) ) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url();?>/my-galleries/"><?php _e('My Galleries', 'bp-gallery') ?></a></li>
    
    <?php  if ( bp_is_my_profile()):?>
   
    <li<?php if ( 'create' == $current_tab ) : ?> class="current"<?php endif; ?>><a id="gallery_create" href="<?php echo bp_get_gallery_create_link();?>"><?php _e('Create Gallery', 'bp-gallery') ?></a></li>
    <?php endif;?>

    <?php if(gallery_is_valid_gallery_type("photo")):?>
        <li<?php if ( 'photo' == $current_tab ) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url();?>/my-galleries/photo"> <?php _e("Photo","bp-gallery");?></a></li>
    <?php endif;?>
    <?php if(gallery_is_valid_gallery_type("video")):?>
        <li<?php if ( 'video' == $current_tab ) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url();?>/my-galleries/video"> <?php _e("Video","bp-gallery");?></a></li>
    <?php endif;?>
    <?php if(gallery_is_valid_gallery_type("audio")):?>
        <li<?php if ( 'audio' == $current_tab ) : ?> class="current"<?php endif; ?>><a href="<?php echo bp_get_gallery_home_url();?>/my-galleries/audio"> <?php _e("Audio","bp-gallery");?></a></li>
<?php endif;?>

 <?php
    do_action('user_gallery_admin_tabs');
}

/** The admin tabs for single gallery*/

function single_gallery_admin_tabs(){
    global $bp;
    $gallery=bp_get_single_gallery();
   
    if(!$gallery)
         return;//if not single gallery edit page, do not show
?>
<div class='single-gallery-header'>
    <?php if(gallery_is_user_admin($bp->loggedin_user->id,$gallery->id)):?>
    <a href="<?php echo bp_get_media_bulk_edit_link($gallery); ?> " id="gallery-media-edit" <?php if(bp_is_media_edit()) echo "class='current'";?>><?php _e("Edit Media","bp-gallery");?></a>
     <?php if(bp_gallery_is_method_enabled("upload",$gallery)):?>
    <a href="<?php echo  bp_get_media_upload_link($gallery);?>" id="gallery_media_upload" <?php if( bp_is_gallery_upload()) echo "class='current'";?>><?php _e("Upload","bp-gallery");?></a>
     <?php endif;
    if(bp_gallery_is_method_enabled("add_from_web",$gallery)):?>
    <a href="<?php echo  bp_get_media_add_from_web_link($gallery);?>" id="gallery_media_add_from_web" <?php if( bp_is_gallery_add_from_web()) echo "class='current'";?>><?php _e("Add from Web","bp-gallery");?></a>
     <?php endif;?>
    <a href="<?php echo  bp_get_gallery_reorder_link($gallery);?>" id="gallery_media_organize"  <?php if( bp_is_gallery_reorder_media()) echo "class='current'";?> ><?php  _e("Organize Media","bp-gallery");?></a>
    <a href="<?php  echo bp_get_gallery_edit_link($gallery);?>" id="gallery_gallery_edit" <?php if(bp_is_gallery_edit_details()) echo "class='current'";?>><?php  _e("Edit Info","bp-gallery");?></a>
    <a href="<?php  echo bp_get_gallery_cover_upload_link($gallery);?>" id="gallery_gallery_cover_upload" <?php if(bp_is_gallery_cover_upload()) echo "class='current'";?>><?php  _e("Cover Upload","bp-gallery");?></a>
    <a href="<?php echo bp_get_gallery_delete_link($gallery);?>" id="gallery_gallery_delete"><?php _e("Delete","bp-gallery");?></a>
  <?php else:?>
    <?php if(bp_gallery_is_method_enabled("upload",$gallery)):?>
     <a href="<?php echo  bp_get_media_upload_link($gallery);?>" id="gallery_media_upload" <?php if( bp_is_gallery_upload()) echo "class='current'";?>><?php _e("Upload","bp-gallery");?></a>
    <?php endif;
    if(bp_gallery_is_method_enabled("add_from_web",$gallery)):?>
     <a href="<?php echo  bp_get_media_add_from_web_link($gallery);?>" id="gallery_media_add_from_web" <?php if( bp_is_gallery_add_from_web()) echo "class='current'";?>><?php _e("Add from Web","bp-gallery");?></a>
     <?php endif;?>
     <?php endif;?>
</div>
<?php

}

function bp_gallery_add_media_button($gallery){
    if(apply_filters ("bp_gallery_show_add_media_button",true)){
    //this button defaullts to upload but if upload is not enabled, it will show add from web
    if(bp_gallery_is_method_enabled("upload",$gallery)):?>
    <a href="<?php echo  bp_get_media_upload_link($gallery);?>" id="gallery_media_upload" <?php if( bp_is_gallery_upload()) echo "class='current'";?>><?php _e("Upload","bp-gallery");?></a>
    <?php else :?>
    <a href="<?php echo  bp_get_media_add_from_web_link($gallery);?>" id="gallery_media_add_from_web" <?php if( bp_is_gallery_add_from_web()) echo "class='current'";?>><?php _e("Add from Web","bp-gallery");?></a>
    
    <?php    endif;
    }
    
    }
 function bp_gallery_add_media_link($gallery=null){
     global $galleries_template;
    if ( !$gallery )
        $gallery = $galleries_template->gallery;
 if(bp_gallery_is_method_enabled("upload",$gallery)):?>
    <a href="<?php echo  bp_get_media_upload_link($gallery);?>" class='upload'>[<?php _e("upload","bp-gallery");?>]</a>
    <?php else :?>
    <a href="<?php echo  bp_get_media_add_from_web_link($gallery);?>" class='add-web'>[<?php _e("add media","bp-gallery");?>]</a>

    <?php    endif;

 }
/**
 * @desc List of Galleries as drop down
 * @global <type> $bp
 */
function bp_list_galleries_dropdown($ctype=null){
global $bp;
$option="";
$opt_group="";
//since we are using the drop down to allow users to upload, it will be better if we restrict to logged in users directory
if(!is_user_logged_in())
    return;

    $owner_type=gallery_get_current_object_type();
    $owner_id=gallery_get_current_object_id();

    $allowed_types=gallery_get_allowed_gallery_types();
    
   
    if(!empty($ctype)&&!array_key_exists($ctype, $allowed_types))
            return;

    foreach($allowed_types as $type=>$name) {
        if(!empty($ctype)&&$ctype!==$type)
                continue;
     if(!$ctype)
    $option.="<optgroup label='".$name."'>";
    $galleries=BP_Gallery_Gallery::get_gallery_list($owner_type,$owner_id,$type);

    foreach($galleries as $gallery)
        $option.="<option value='".$gallery->id."'>".$gallery->title."</option>";
if(!$ctype)
     $option.="</optgroup>";

    }

echo "<select name='galleries-list' id='galleries-list'>".$option."</select>";
}


/*** Hook the nav bar for directory if enabled**/
function bp_gallery_show_directory_nav(){
    if(!bp_gallery_show_dir_link())
        return;
    ?>
   <li <?php if(bp_is_page(BP_GALLERY_SLUG)) echo "class='selected'";?>>
       <a href="<?php echo bp_get_root_domain() ?>/<?php echo BP_GALLERY_SLUG ?>/" title="<?php _e( 'Gallery', 'bp-gallery' ) ?>"><?php _e( 'Gallery', 'bp-gallery' ) ?></a></li>
 <?php
}

add_action("bp_nav_items","bp_gallery_show_directory_nav");
function bp_gallery_get_current_gallery_type(){
    global $bp;
    echo $bp->gallery->type;
    if(!empty($bp->gallery->current_gallery))
            return $bp->gallery->current_gallery->gallery_type;

    if(!empty($bp->gallery->type))
        return $bp->gallery->type;


     return null;

}

/**
 * @desc Get Gallery Status Dropdown to be used in theme
 * @param <type> $gallery
 */
function gallery_valid_gallery_status_dd($cur_status=null,$return=0){
    $status=gallery_get_valid_gallery_status();

    $html="<select name='gallery_status' id='gallery_status'>";
    foreach($status as $key=>$name)
    {
        if(!empty($cur_status)&&$cur_status==$key)
        $html.="<option value='".$key."' selected='selected' >".$name."</option>";
    else
        $html.="<option value='".$key."'>".$name."</option>";


    }
    $html.="</select>";
    if(!$return)
    echo $html;
    else
    return $html;
}

/**
 * @desc Used in template for editing gallery
 * @param <type> $gallery
 */
function gallery_valid_gallery_status_dd_bulkedit($cur_status,$id){
    $status=gallery_get_valid_gallery_status();

    $html="<select name='gallery_status[".$id."]' id='gallery_status[".$id."]'>";
    foreach($status as $key=>$name)
    {
        if(!empty($cur_status)&&$cur_status==$key)
        $html.="<option value='".$key."' selected='selected' >".$name."</option>";
    else
        $html.="<option value='".$key."'>".$name."</option>";


    }
    $html.="</select>";
    echo $html;
}


 /**
  * @desc Gallery Type drop down for use in themes
  */
 function gallery_allowed_type_dd(){
     $allowed_type=gallery_get_allowed_gallery_types();
  $html="";
    $html="<select name='gallery_type' id='gallery_type'>";
     foreach($allowed_type as $key=>$name)
          $html.="<option value='".$key."'>".$name." ".__("Gallery",'bp-gallery')."</option>";
    $html.="</select>";

 echo $html;

 }
function bp_directory_gallery_search_form() {
	global $bp;

	$search_value = __( 'Search anything...', 'bp-gallery' );
	if ( !empty( $_GET['s'] ) )
	 	$search_value = $_GET['s'];

	?>
	<form action="" method="get" id="search-gallery-form">
		<label><input type="text" name="s" id="gallery_search" value="<?php echo attribute_escape( $search_value ) ?>"  onfocus="if (this.value == '<?php _e( 'Search anything...', 'bp-gallery' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Search anything...', 'bp-gallery' ) ?>';}" /></label>
		<input type="submit" id="gallery_search_submit" name="gallery_search_submit" value="<?php _e( 'Search', 'bp-gallery' ) ?>" />
	</form>
<?php
}
 
function bp_gallery_directory_search_form() {
	global $bp;

	$default_search_value =bp_get_search_default_text('gallery');
	$search_value         = !empty( $_REQUEST['s'] ) ? stripslashes( $_REQUEST['s'] ) : $default_search_value; ?>

	<form action="" method="get" id="search-gallery-form">
		<label><input type="text" name="s" id="gallery_search" value="<?php echo esc_attr( $search_value ) ?>"  onfocus="if (this.value == '<?php echo $default_search_value ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php echo $default_search_value ?>';}" /></label>
		<input type="submit" id="gallery_search_submit" name="gallery_search_submit" value="<?php _e( 'Search', 'bp-gallery' ) ?>" />
	</form>

<?php
}
/**
 * @desc Whther to enable the directory link in Navigation or Not
 */
function bp_gallery_show_dir_link(){
   return bool_from_yn(get_site_option("gallery_enable_directory_link"),'y');//default yes
}


function bp_gallery_show_upload_quota(){
    return bool_from_yn(get_site_option("show_upload_quota",'y'));//default should be yes
   }
function gallery_has_media($gallery){
    //check the gallery has media
    return BP_Gallery_Media::gallery_has_media($gallery);
}

function gallery_is_activity_stream_upload_enabled(){

    return bool_from_yn(get_site_option("enable_activity_upload",'y'));//default should be yes
}
//for activity dd
add_action("bp_member_activity_filter_options","gallery_member_activity_filter_options");
add_action("bp_group_activity_filter_options","gallery_member_activity_filter_options");
add_action("bp_activity_filter_options","gallery_member_activity_filter_options");

?>