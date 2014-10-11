<?php
/* 
 * Media Template tags
 */

class BP_Gallery_Media_Template
{
        var $current_media = -1;
	var $media_count;//for this user
	var $medias;//all media ahh,I know media is correct in english not medias :D
	var $media;//current media object
	var $gallery;//the gallery to which this media belongs to
	var $in_the_loop;
        var $extra;//added in rc5 for storing extra info
	var $pag_page;
	var $pag_num;
	var $pag_links;
	var $total_media_count;//total media in the gallery
   /*
 * constructor
 */
function bp_gallery_media_template($gallery_id, $user_id, $per_page,$page, $max ,$type,$filter,$orderby,$sort_order) {
    global $bp;
    $this->gallery=$gallery_id;

    $this->pag_page = isset( $_REQUEST['fpage'] ) ? intval( $_REQUEST['fpage'] ) : $page;
    $this->pag_num = isset( $_REQUEST['num'] ) ? intval( $_REQUEST['num'] ) : $per_page;//how many per page
    $this->extra["current_filter"]=$filter;
    $this->extra["orderby"]=$orderby;
    if($type=="single-media")
            $slug=$bp->action_variables[1];

 
    switch($type){
      
        case "single-media":
            //check the access level here
            $media_id=BP_Gallery_Media::get_id_from_slug($slug,$bp->gallery->current_gallery->id);
            
            $this->medias=array("media"=>array(0=>$media_id),"total"=>1);
          
            break;
        default:
           $this->medias=BP_Gallery_Media::get_all($filter,$type,$gallery_id,$user_id, $this->pag_num, $this->pag_page,$orderby,$sort_order );//only public medias
          break;

        }


//how many medias to be shown
		if ( !$max )
			$this->total_media_count = (int)$this->medias['total'];
		else
			$this->total_media_count = (int)$max;

           

    $this->medias=$this->medias['media'];//just some arrangement
    if ( $max ) {
    	if ( $max >= count($this->medias) )
            $this->media_count = count($this->medias);
	else
            $this->media_count = (int)$max;
	} else {
            $this->media_count = count($this->medias);
	}

	$this->pag_links = paginate_links( array(
            'base' => add_query_arg( 'fpage', '%#%' ),
            'format' => '',
            'total' => ceil($this->total_media_count / $this->pag_num),
            'current' => $this->pag_page,
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'mid_size' => 1
	));

}

function has_medias() {
    if ( $this->media_count )
        return true;

    return false;
}

function next_media() {
    $this->current_media++;
    $this->media = $this->medias[$this->current_media];
    return $this->media;
}

function rewind_medias() {
    $this->current_media = -1;
    if ( $this->media_count > 0 ) {
	$this->media = $this->medias[0];
	}
}

function user_medias() {
    if ( $this->current_media + 1 < $this->media_count ) {
        	return true;
    } elseif ( $this->current_media + 1 == $this->media_count ) {
    	do_action('loop_end');
       
        $this->rewind_medias();
    }

    $this->in_the_loop = false;
    return false;
}

function the_media() {
    global $single_media_template;
    $this->in_the_loop = true;
    $this->media = $this->next_media();
      
      //  print_r($this->media);
     if ( !$media = wp_cache_get( 'gallery_gallery_media_' . $this->media, 'bp' ) ) {
        $media = new BP_Gallery_Media($this->media);
	wp_cache_set( 'gallery_gallery_media_' . $this->media, $media, 'bp' );
    }

    $this->media=$media;


    if ( 0 == $this->current_media ) // loop has just started
    	do_action('loop_start');
}




}

function bp_gallery_has_medias( $args = '' ) {
    global $medias_template,$bp;
    $defaults = array(
        'type'=>'',
	'user_id' => false,
	'per_page' => 12,
        'page'=>1,
        'max' => false,
        'sitewide'=>false,
        'orderby'=>'sort_order',
        'sort_order'=>'',//add sor_order arg for asc/desc
	'gallery_id'=>'',
	'filter'=>''
    );
$owner_type=null;
$owner_id=null;
    $r = wp_parse_args( $args, $defaults );
   
    extract( $r, EXTR_SKIP );

    if(!$sitewide){
            if(empty($type)&& bp_is_single_media())
                $type="single-media";

            if(empty($user_id)&&bp_is_user())
                $user_id=$bp->displayed_user->id;
            if(empty($gallery_id)&&!empty($bp->gallery->current_gallery->id))
                $gallery_id=$bp->gallery->current_gallery->id;

   }
   else
       $filter=array("public");//only public mediafor sitewide
   
         if($gallery_id) {
             $gallery=bp_get_gallery($gallery_id);
             $owner_type=$gallery->owner_object_type;
             $owner_id=$gallery->owner_object_id;
         }
         else if($user_id){
             $owner_id=$user_id;
             $owner_type="user";
         }
if(!$filter)
    $filter=gallery_get_current_user_access($owner_type,$owner_id);//access level

//print_r($filter);
if ( $max ) {
	if ( $per_page > $max )
			$per_page = $max;
	}
//echo $type;
    $medias_template = new BP_Gallery_Media_Template($gallery_id, $user_id, $per_page,$page, $max,$type,$filter,$orderby,$sort_order );

   
  return $medias_template->has_medias();
}

function bp_gallery_medias() {
    global $medias_template;
    return $medias_template->user_medias();
}

function bp_gallery_the_media() {
    global $medias_template;
    return $medias_template->the_media();
}

function bp_gallery_medias_pagination_count() {
	global $bp, $medias_template;

	$from_num = intval( ( $medias_template->pag_page - 1 ) * $medias_template->pag_num ) + 1;
	$to_num = ( $from_num + ( $medias_template->pag_num - 1 ) > $medias_template->total_media_count ) ? $medias_template->total_media_count : $from_num + ( $medias_template->pag_num - 1 ) ;

	echo sprintf( __( 'Viewing media %d to %d (of %d medias)', 'bp-gallery' ), $from_num, $to_num, $medias_template->total_media_count ); ?> &nbsp;
	<img id="ajax-loader-gallery" src="<?php echo $bp->core->media_base ?>/ajax-loader.gif" height="7" alt="<?php _e( "Loading", "bp-gallery" ) ?>" style="display: none;" /><?php
}

function bp_gallery_medias_pagination_links() {
	echo bp_get_gallery_medias_pagination_links();
}
	function bp_get_gallery_medias_pagination_links() {
		global $medias_template;

		return apply_filters( 'bp_get_gallery_medias_pagination_links', $medias_template->pag_links );
	}

/*
 * Function for Next and Previous media
 */
function next_gallery_media_link($format='%link &raquo;', $link='%title') {
	adjacent_gallery_media_link($format, $link, true);
}

function previous_gallery_media_link($format='&laquo; %link  ', $link='%title') {
	adjacent_gallery_media_link($format, $link, false);
}
function adjacent_gallery_media_link($format, $link, $previous = true) {
    //$status_filter=
    $media=BP_Gallery_Media::get_adjacent_gallery_media($previous);
   
	if ( !$media )
		return;

	$title = $media->title;

	if ( empty($media->title) )
		$title = $previous ? __('Previous','bp-gallery') : __('Next','bp-gallery');

	

    $string = '<a href="'.bp_get_media_permalink($media).'">';
	$link = str_replace('%title', $title, $link);
	$link = $string . $link . '</a>';

	$format = str_replace('%link', $link, $format);

	$adjacent = $previous ? 'previous' : 'next';
	echo apply_filters( "gallery_media_link", $format, $link );
}


/****other tags*/
function bp_get_the_media(){
    global $medias_template;
    return $medias_template->media;
}
function bp_media_id(){
    echo bp_get_media_id();
}
    function bp_get_media_id($media=null){
            global $medias_template;
            if(!$media)
                $media=$medias_template->media;
        return  apply_filters( 'bp_get_media_id', $media->id);
    }
 function bp_media_is_remote($media=null){
    global $medias_template;
            if(!$media)
                $media=$medias_template->media;
    return  apply_filters( 'bp_get_media_is_remote', $media->is_remote);
 }
function bp_media_title() {
	echo bp_get_media_title();
}
	function bp_get_media_title($media=null) {
		global $medias_template;
            if(!$media)
			$media=$medias_template->media;

		return apply_filters( 'bp_get_media_title', $media->title);
	}

function bp_media_description() {
	echo bp_get_media_description();
}
	function bp_get_media_description($media=null) {
		global $medias_template;
            if(!$media)
			$media=$medias_template->media;

		return apply_filters( 'bp_get_media_description', $media->description);
	}

/*links tag*/
function bp_media_permalink(){
    echo bp_get_media_permalink();
}

    function bp_get_media_permalink( $media=null ) {
        global $medias_template;
            if(!$media)
                $media=$medias_template->media;

        $gallery_permalink=bp_get_gallery_permalink(new BP_Gallery_Gallery($media->gallery_id));
        return apply_filters( 'bp_get_media_permalink', $gallery_permalink."/".gallery_get_media_slug($media->id ));
}

function bp_media_edit_link(){
    echo bp_get_media_edit_link();

}
    function bp_get_media_edit_link($media=null){//change
        global $medias_template,$bp;
            if(!$media)
                $media=$medias_template->media;
               
           // $link=bp_get_gallery_bulk_edit_link()."/media/".$media->slug."/?_wpnonce=".wp_create_nonce("edit-media");
       return $link;//needs improvement
    }

function bp_media_delete_link(){
        echo bp_get_media_delete_link();
}
    function bp_get_media_delete_link($media=null){
        global $medias_template;
            if(!$media)
			$media=$medias_template->media;
       //improve
        $link=bp_get_gallery_permalink()."/delete-medias/?_wpnonce=".wp_create_nonce("delete-media")."&media_id=".$media->id;
    return  $link;//needs improvenemt
    }

 /*for medias*/
function bp_media_css(){
echo bp_get_media_css();

}
function  bp_get_media_css($media=null){
     global $bp;
     global $medias_template;

            if(!$media)
                $media=$medias_template->media;

return apply_filters("bp_get_media_css","class='bp-media media_".$media->type."'");
}
 function bp_media_html(){
        echo bp_get_media_html();
     
 }
 function bp_get_media_html($media=null){
     global $bp;
     global $medias_template;
    
            if(!$media)
                $media=$medias_template->media;
            // print_r($medias_template->media);
    if($bp->gallery->is_single_media)
            return bp_get_gallery_media_full_html($media);
   else
    
     return bp_get_gallery_media_thumb_html($media);
     
 }

 
function bp_media_thumb_src(){
	echo bp_get_media_thumb_src();
}
    function bp_get_media_thumb_src($media=null){
        global $medias_template;
            if(!$media)
			$media=$medias_template->media;
        return bp_gallery_get_media_url($media,"thumb");

    }
function bp_media_mid_src(){
    echo bp_get_media_mid_src();
}
    function bp_get_media_mid_src($media=null){
        global $medias_template;
            if(!$media)
                $media=$medias_template->media;
        return bp_gallery_get_media_url($media,"mid");
    }
    
function bp_media_full_src(){
    echo bp_get_media_full_src();
}
    function bp_get_media_full_src($media=null){
        global $medias_template;
            if(!$media)
			$media=$medias_template->media;
        return bp_gallery_get_media_url($media,"full");
    }
 /*stats*/
function  bp_media_modification_date(){
        return bp_get_media_modification_date();
  }
    function bp_get_media_modification_date($media=null){
    global $medias_template;
            if(!$media)
			$media=$medias_template->media;
            
         return $media->date_modified; //improve

    }
function  bp_media_creation_date(){
        return bp_get_media_creation_date();
  }
    function bp_get_media_creation_date($media=null){
    global $medias_template;
            if(!$media)
                $media=$medias_template->media;
           
                return $media->date_updated;//improve

    }
function bp_media_uploader_id(){
    echo bp_get_media_uploader_id();
}

function bp_get_media_uploader_id($media=null){
    global $medias_template;
            if(!$media)
                $media=$medias_template->media;

          return $media->user_id ;
    
}

function bp_media_status(){
    echo bp_get_media_status();
}
    function bp_get_media_status($media=null){
        global $medias_template;
            if(!$media)
			$media=$medias_template->media;
            if(!$media)
                $media=bp_get_single_media ();
        return $media->status;
    }
    
function bp_get_media_bulk_edit_link($gallery){
    $link=bp_get_edit_gallery_base_link($gallery)."/edit-media?_wpnonce=".wp_create_nonce("edit_gallery_media")."&gallery_id=".$gallery->id;
    return $link;
}
/******************************************************************************************************************************
 *******************************************************************************************************************************
 */
/*
 * Conditional Tags
 */

function bp_is_media_public($media){
   return bp_is_media_status($media,"public");
}
function bp_is_media_private($media){
    return bp_is_media_status($media,"private");
}
function bp_is_media_friends_only($media){
        return bp_is_media_status($media,"friends-only");
}

function bp_is_media_status($media,$type){
    if($type==$media->status)
        return true;
     else return false;
}

function bp_is_media_owner(){
    global $bp;
return $bp->is_item_admin;//improve
}

/*other*/

function bp_gallery_get_media_url($media,$type){
    if(!$media->is_remote){
    if($type=="thumb")
      $url=$media->local_thumb_path;
    else if($type=="mid")
        $url=$media->local_mid_path;
    else if($type=="full")
        $url=$media->local_orig_path;
    else //check if the media meta exists
      $url=bp_get_media_meta($media->id,$type);
    
//print_r($type);
 return  gallery_get_media_full_url($url);
    }
 else{
  //for remote media, if it is photo return the url
   if($type=="thumb")
       return bp_get_media_meta ($media->id, "embeded_media_thumb_content");
   else if($type=="mid"){
      //check if mid size exists
 $url=bp_get_media_meta ($media->id, "embeded_media_mid_content");
        if(!$url){//generate one
            $gallery=bp_get_gallery($media->gallery_id);
            $media_settings=gallery_get_media_size_settings($gallery->gallery_type);
            $embed=bp_gallery_get_emebed_media_details ($media->remote_url,$media_settings['mid']);
        if($embed){
             bp_update_media_meta ($media->id, "embeded_media_mid_content",$embed->url);
                $url=$embed->url;
        }
        }
       }
  else if($type=="full"){
  //check if original exists
 $url=bp_get_media_meta ($media->id, "embeded_media_orig_content");
        if(!$url){//generate one
            $gallery=bp_get_gallery($media->gallery_id);
            $media_settings=gallery_get_media_size_settings($gallery->gallery_type);
            $embed=bp_gallery_get_emebed_media_details ($media->remote_url,$media_settings['larger']);
        if($embed){
             bp_update_media_meta ($media->id, "embeded_media_orig_content",$embed->url);
                $url=$embed->url;
        }
        }
     return $url;
  }
  }
 
}
/*Misc General template tags*/
/**
 * @desc Media Upload Button
 */
function bp_gallery_media_upload_button($text=''){
    if(!$text)
        $text=__("Upload","bp-gallery");
    ?>
<a id="upload_media_link" href="<?php bp_media_upload_link();?>"><?php echo $text;?></a>
<?php
}

function bp_media_upload_link(){
        echo bp_get_media_upload_link();
}
    function bp_get_media_upload_link($gallery=null){
        global $bp,$galleries_template;
        if(!$gallery)
            $gallery=$galleries_template->gallery;
        $link= bp_get_edit_gallery_base_link($gallery)."/upload?_wpnonce=".wp_create_nonce ('upload-media-form');
             
        $link.="&gallery_id=".$gallery->id;
            return apply_filters("bp_get_media_upload_link",$link,$gallery);// $gallery added in v 1.0.7
       }
function bp_get_media_add_from_web_link($gallery){
     global $bp,$galleries_template;
        if(!$gallery)
            $gallery=$galleries_template->gallery;
        $link= bp_get_edit_gallery_base_link($gallery)."/add-from-web?_wpnonce=".wp_create_nonce ('add-from-web-form');

        $link.="&gallery_id=".$gallery->id;
            return apply_filters("bp_get_media_add_from_web_link",$link);
}
/****for complete html embedding of thumb*/
function bp_get_gallery_media_thumb_html($media=null){
   global $medias_template;
   if(!$media)
        $media=$medias_template->media;
     $content= apply_filters("bp_get_gallery_media_".$media->type."_thumb_html",'',$media);//let the filters play the magic
//if($linked)
        
      
return $content;

}


/************ for media full ****************/
function bp_get_gallery_media_full_html($media){
     return apply_filters("bp_get_gallery_media_".$media->type."_full_html",$media);

}
/**
 *
 * @param string $relpath relative path
 * @return absolute url for media
 */
function gallery_get_media_full_url($rel_path){
   //improve
    $abspath= bp_gallery_get_media_base_url();
    return apply_filters("gallery_media_absolute_url",$abspath."/".$rel_path,$rel_path);
}
/**
 * For Single media Page
 */

function bp_is_single_media(){
    global $bp;
    return isset($bp->gallery->is_single_media)?$bp->gallery->is_single_media:false;
}
/**
 *
 * @global <type> $bp
 * @return ID<int> of the Single media if we are on single media psge
 */
function bp_get_single_media_id(){
    global $bp;
    return $bp->gallery->current_media->id;
}

function bp_get_single_media(){
    global $bp;
    return $bp->gallery->current_media;
}

/***
 * Template dependent inline functions
 * */

 /** editable gallery content**/
function gallery_media_editable_content($media=null,$visibility=null){
    //first of all check if user is logged in and can admin the current media
    if(!is_user_logged_in())
        return false;

    //if(!$visibility)
        $style="style='display:none'";

    $form="<form action='edit-media' method='post' id='media-edit-inline-form_".bp_get_media_id()."' ". $style. ">";

	$form.="<p><input type='text' name='media_title' id='media_title' value='".esc_attr(bp_get_media_title())."' /></p>";
   $form.="<div class='media-thumb'>".bp_get_media_html()."</div>";
	$form.="<br class='clear' />";
    $form.="<textarea id='media_description' name='media_description'>".bp_get_media_description()."</textarea>";
	//$form.="<input type='hidden' name='user_id' class='user_id' value='".$bp->displayed_user->id."' />";
	//$form.="<input type='hidden' name='media_id' class='media_id' value='".bp_get_media_id($id)."' />";
   $form.=" <p>".__("Visibility ","bp-gallery"). gallery_valid_gallery_status_dd($media->status,1)."</p>";


	$form.= wp_nonce_field( 'media_edit_save','_wpnonce-edit-save-media',true,false );
	$form.="<div class='media-inline-actions'><a href='#' class='save'>".__("Save","bp-gallery")."</a><a href='#' class='cancel'> Cancel</a>";
	$form.="</div></form>";
echo $form;
}
//addded in Rc4
function bp_gallery_get_media_base_url(){
//if this is wpmu/ms, get the root site
    //else
    //bp_get_root_domain();
  //if()
   // http://<?php echo $current_site->domain . $current_site->path

  return apply_filters("bp_gallery_get_media_base_url", get_blog_option( 1, 'siteurl' ));
}
?>