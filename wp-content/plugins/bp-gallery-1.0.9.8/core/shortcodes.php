<?php
/* 
 *Shortcode support for gallery
 *
 */
/** Example use
 * 
//[bp-gallery show="gallery/media" owner_type="user/groups" owner_id="some_id/username" type="audio/video/photo" max="max_number"]
 * 
 */
add_shortcode("bp-gallery", 'bp_gallery_shortcode_handler');

function bp_gallery_shortcode_handler($atts){
	extract(shortcode_atts(array(
		'show' =>'gallery',
                'owner_type'=>'',
                'owner_id'=>'',
                'owner_slug'=>'',
                'gallery_id'=>'',
                'gallery_slug'=>'',
                'media_slug'=>'',
                'orderby'=>'',
                'sort_order'=>'',
                'type'=>'',
                'max' => 5,
                'per_page'=>12,
                'thumb_size'=>'mini'

	), $atts));

$query_args=array();
$q=array();//prepare a query
//prepare args which applies to both gallery&media
if($max)
    $q['max']=$max;
$q['per_page']=$per_page;
if(!empty($type))
    $q["type"]=$type;
if(!empty($sort_order))
    $q['sort_order']=$sort_order;
if(!empty($orderby))
    $q['orderby']=$orderby;

//check for owner
 if(!empty($owner_id)&&!empty($owner_type))//owner id is only meaningful when owner_type is provided
    $q['owner_id']=$owner_id;
if(!$owner_id&&!empty($owner_type)&&!empty($owner_slug)){//if owner id is not given but owner_type and owner_slug is given
    if($owner_type=="user"){
        $user=get_user_by('login', $owner_slug);
        if($user)
        $q['owner_id']=$user->ID;//get user id from username

    }
    else if($owner_type=="groups"&&  class_exists("BP_Groups_Group"))
       $q['owner_id']=BP_Groups_Group::get_id_from_slug($owner_slug);
}
//we have got owner id by now
if($owner_type)
    $q['owner_type']=$owner_type;//get the owner type

 if(!empty($gallery_id)) //if gallery id is given
         $q['gallery_id']=$gallery_id;

 if(!$gallery_id&&!empty($q['owner_id'])&&!empty($q['owner_type'])&&!empty($gallery_slug))//if gallery slug is given and we have found the owner id, let us find the gallery id
        $q['gallery_id']= BP_Gallery_Gallery::get_id_from_slug( $gallery_slug,$q['owner_type'],$q['owner_id']);

    if($show=="gallery"){
       return "<div  class='bp-gallery-embeded-galleries'>".bp_gallery_list_galleries($q,FALSE)."</div>";
}

else if($show=="media"){
     if(!empty($q['owner_id']))
         $q["user_id"]=$q['owner_id'];
   
    
         return "<div  class='bp-gallery-embeded-media'>".bp_gallery_list_medias($q,false)."</div>";

}
}
function bp_gallery_list_galleries($args,$echo=true){
 $gcontent="";
$params=wp_parse_args($args,array("show_thumb"=>true,'thumb_size'=>'mini'));
extract($params);//


if(bp_has_galleries($args)):
    while(bp_galleries()):bp_the_gallery();
     $gcontent.="<div class='bp-gallery bp-gallery-embeded ' id='sitewide_gallery_".bp_get_gallery_id()."'>";

     //add thumbnail
     if($show_thumb){
     $gcontent.="<a href='". bp_get_gallery_permalink()."'>".bp_get_gallery_cover_image($thumb_size)."</a>";
     $gcontent.="<br />";
     }
      $gcontent.="<h5 >"."<a href='". bp_get_gallery_permalink()."'>".bp_get_gallery_title()."</a></h5>";
     $gcontent.="</div>";
endwhile;
$gcontent.="<br class='clear' />";//do not forget to clear the float
endif;

if(!$echo)
    return $gcontent;
else
    echo $gcontent;
    
}

function bp_gallery_list_medias($args,$echo=true){
$content="";
$params=wp_parse_args($args,array("show_thumb"=>true));
extract($params);
if(bp_gallery_has_medias($args)):
    while(bp_gallery_medias()):bp_gallery_the_media() ;

    $content.="<div ". bp_get_media_css()." id='gallery_media_".bp_get_media_id()."'>";
    $content.="<div class='media-content'>
           <h5 class='media-title'>". bp_get_media_title()."</h5>";
    if($show_thumb){
    $content.="<a href='".bp_get_media_permalink()."'>".bp_get_gallery_media_thumb_html()."</a>";
    $content.="<br class='clear' />";
    }
  //  $content.="<p class='media-description'>".bp_get_media_description()."</p>";
    $content.="</div>";//media content div ends here
    // endwhile;
$content.="</div>";
endwhile;
    $content.="<br class='clear' />";
endif;
if(!$echo)
return $content;
else
   echo $content;
}
?>