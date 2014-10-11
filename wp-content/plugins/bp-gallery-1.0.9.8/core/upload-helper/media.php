<?php
/* 
 * Contains various functions for handling media 
 * 
 */

/**
 * @desc Return the Media Dimensions settings for the gallery
 * @return array of dimensions
 */
//addedd media type in v 1.0.3
function gallery_get_media_size_settings($media_type=null){
    /** set the default media size settings*/
    $default['thumb']=array('height'=>150,'width'=>150);
    $default['mid']=array('height'=>300,'width'=>300);
    $default['larger']=array('height'=>600,'width'=>600);
    /** get current settings orthe default if settings was not saved */
    $settings=get_site_option("bp_gallery_".$media_type."_size");
    //$settings=apply_filters("bp_get_gallery_media_sizes",$settings)
    if(empty($settings))
        $settings=get_site_option("gallery_media_size",$default);//do we need to unserialize
    
    return apply_filters("bp_get_gallery_media_sizes",$settings,$media_type);//use it to add as many more dimensions as you want or modify existing dimensions

}

/**
 * @desc if we had to work with the size allowed by site option, we can skip this function for bp_core_check_avatar_size
 */
function gallery_check_file_size(&$file,$user_id=null,$group_id=null){
    if($user_id&&$group_id)
       $user_id=null;//we will check for group only
//if($user_id)
  //  $allowed_size=gallery_get_max_media_size_for_user($user_id);//what is the maximum media size allowed
//else if($group_id)
   // $allowed_size=gallery_get_max_media_size_for_group($group_id);//what is the maximum media size allowed
    $allowed_size=gallery_get_max_media_size();
if ( $file['size'] >  $allowed_size )
		return false;
	return true;
}


/*get the maximum media size allowed by the administartor*/
function gallery_get_max_media_size($converted=true){
    $size_in_kb=get_site_option( 'gallery_fileupload_maxk' );
    if(empty ($size_in_kb))
        $size_in_kb=2000;
        if(!$converted)
        return  apply_filters("gallery_get_max_media_size_kb",$size_in_kb);
   $allowed_size=$size_in_kb*1024;// * 1024;//in bytes
   return apply_filters("gallery_get_max_media_size_bytes",$allowed_size);//may be you want to change it programatically
}



/**
 * @desc get the type of media as in $media->type eg.photo,audio,video from file extensions
 *
 */
function bp_gallery_get_media_type_from_file($file){
    //for each allowed gallery type, check is this of the allowed type,if yes return
    $allowed_types=gallery_get_allowed_gallery_types();
    foreach($allowed_types as $type=>$type_name)
    if(bp_gallery_is_media_of_type($file,$type))
        return $type;

    return null;//if none of the allowed type
}


/************ File Extension/type Manipulation**************/


/**
 *
 * @param <type> $file:the uploaded file
 * @param <type> $type: the type of gallery(audio,video etc)
 * @return bool: true if the uploaded file is of type $type
 */
function bp_gallery_is_media_of_type(&$file,$type){
 //get extensions for the type
 $exts=gallery_get_valid_file_extension_by_type($type);
 //now e need to get a reg exp expression from it
 $testexp=implode("|",$exts);//so we have this of the form ext1|ext2|ext3 etc
    $testexp="/(".$testexp.")$/";//good we have the regular expression here
if ( ( strlen(strtolower($file['type'])) && !preg_match($testexp, strtolower($file['type'] )) ) && !preg_match( $testexp, strtolower($file['name'] )) )
		return false;
return true;
}

/**
 * @desc Get arry of valid extensions for a file type
 * allow other developers to hook specific extensions here using filter
 * @return the array of file extensions allowed for a gallery type
 * @param <type> $type :gallery type: eg image,video,audio etc
 *
 */
function gallery_get_valid_file_extension_by_type($type){
    $exts=array("jpg","jpeg","png","gif");//hmm out default for image
    return apply_filters("gallery_valid_file_extension_for_".$type,$exts);
}
/**
 * @desc: all allowed extensions for the gallery, which 9includes video/audio/phot type
 * @return <type> array of all allowed extensions for all the gallery types
 */
function gallery_get_all_allowed_file_extensions(){
//all the allowed extension for the type
    $gallery_types=gallery_get_allowed_gallery_types();
    $exts=array();
    foreach($gallery_types as $gallery_type=>$gallery_name)
        $exts=array_merge($exts, gallery_get_valid_file_extension_by_type($gallery_type));//merge all extensions here

return $exts;
}
/**
 * @desc Get a verbose explanation about which file extensions are allowed for a perticular media type
 * @param <type> $type
 * @return <type>
 */
function gallery_get_verbose_explanation_for_extension($type){
    $types=gallery_get_valid_file_extension_by_type($type);
$types=implode(",",$types);
return $types;

}
/********************************************************************************/
/***************Filter functions allow valid file extensions for gallery types*/
function gallery_allowed_extension_for_image($exts){
$exts=array("jpg","jpeg","png","gif");

return $exts;
}
/**
 * @desc Valid Extensions for Videos
 * @param <type> $exts
 * @return <type>
 */
function gallery_allowed_extension_for_video($exts){
$exts=array("flv","mp4","avi","mov","wmv","m4v");
return $exts;
}
/**
 * TODO: Should we add filtes here or devs can extend using other filter ?
 * @param <array> $exts
 * @return <type>
 */
function gallery_allowed_extension_for_audio($exts){
    $exts=array("mp3","m4a");//wav,"wma","midi"
return $exts;
}


//add filters to allow a file extensions for the various types of gallery
add_filter("gallery_valid_file_extension_for_photo","gallery_allowed_extension_for_image");//you can override it
add_filter("gallery_valid_file_extension_for_video","gallery_allowed_extension_for_video");
add_filter("gallery_valid_file_extension_for_audio","gallery_allowed_extension_for_audio");

function gallery_get_file_extension_from_media($media){
    if(!$media->is_remote)
    return end(explode('.', $media->local_thumb_path));
}
?>