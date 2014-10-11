<?php
//function to process upload

/*include required files from the wp-admin/includes*/
//include the media processing files from wp onl if required

function bp_gallery_include_wp_media_helper(){
    require_once ABSPATH."wp-admin/includes/file.php";
    require_once ABSPATH."wp-admin/includes/image.php";
}
/**
 * This is a helper function, just returns meaning full error messages as array
 * @param <int> $allowed_size
 * @return <array> array of errors as error_code=>error_description pair
 */
function bp_gallery_get_possible_upload_errors($allowed_size=null){
    $upload_errors = array(
                        UPLOAD_ERR_OK => __("Great! the file uploaded successfully!", 'bp-gallery'),
                        UPLOAD_ERR_INI_SIZE => __("Your file size was bigger than the maximum allowed file size of: ", 'bp-gallery') .  $allowed_size,
                        UPLOAD_ERR_FORM_SIZE => __("Your file was bigger than the maximum allowed file size of: ", 'bp-gallery') .  $allowed_size,
                        UPLOAD_ERR_PARTIAL => __("The uploaded file was only partially uploaded", 'bp-gallery'),
                        UPLOAD_ERR_NO_FILE=>__("No file was uploaded",'bp-gallery'),
                        UPLOAD_ERR_NO_TMP_DIR=> __("Missing a temporary folder", 'bp-gallery')
                );

    return $upload_errors;
}


/**
 * TODO: refractor
 * @param $file, $_FILES array,
 * @param $action
 * @param $gallery object
 * @desc Handle the media upload
 */


/*this is a reproduced version of wp_handle_upload for gallery*/
function gallery_handle_file_upload( &$file,$gallery, $overrides = false, $time = null ) {

    bp_gallery_include_wp_media_helper();//include the required wp files

    // The default error handler.
    
	if (! function_exists( 'wp_handle_upload_error' ) ) {
		function wp_handle_upload_error( &$file, $message ) {
			return array( 'error'=>$message );
		}
	}

        // You may define your own function and pass the name in $overrides['upload_error_handler']
	$upload_error_handler = 'wp_handle_upload_error';

        //check for space in user's account
         //if user has the quota to upload
        if ( !gallery_check_available_space($gallery->owner_object_type, $gallery->owner_object_id)  )
		return $upload_error_handler( $file, __("Your Quota Has exceeded.",'bp-gallery') );



	$file = apply_filters( 'wp_handle_upload_prefilter', $file );

	// You may define your own function and pass the name in $overrides['unique_filename_callback']
	$unique_filename_callback = null;
	$action = 'wp_handle_upload';
	// Courtesy of php.net, the strings that describe the error indicated in $_FILES[{form field}]['error'].
         $upload_error_strings = array( false,
		__( "The uploaded file exceeds the <code>upload_max_filesize</code> directive in <code>php.ini</code>.",'bp-gallery' ),
		__( "The uploaded file exceeds the <em>MAX_FILE_SIZE</em> directive that was specified in the HTML form.",'bp-gallery' ),
		__( "The uploaded file was only partially uploaded.",'bp-gallery' ),
		__( "No file was uploaded.",'bp-gallery' ),
		'',
		__( "Missing a temporary folder.",'bp-gallery' ),
		__( "Failed to write file to disk.",'bp-gallery' ),
		__( "File upload stopped by extension.",'bp-gallery' ));

	// All tests are on by default. Most can be turned off by $override[{test_name}] = false;
	$test_form = true;
	$test_size = true;

	// If you override this, you must provide $ext and $type!!!!
	$test_type = true;
	$mimes = false;

	// Install user overrides. Did we mention that this voids your warranty?
	if ( is_array( $overrides ) )
		extract( $overrides, EXTR_OVERWRITE );

	// A successful upload will pass this test. It makes no sense to override this one.
	if ( $file['error'] > 0 )
		return $upload_error_handler( $file, $upload_error_strings[$file['error']] );

	// A non-empty file will pass this test.
	if ( $test_size && !($file['size'] > 0 ) )
		return $upload_error_handler( $file, __( 'File is empty. Please upload something more substantial.','bp-gallery' ));

	// A properly uploaded file will pass this test. There should be no reason to override this one.
	if (! @ is_uploaded_file( $file['tmp_name'] ) )
		return $upload_error_handler( $file, __( 'Specified file failed upload test.','bp-gallery' ));

	// A correct MIME type will pass this test. Override $mimes or use the upload_mimes filter.
	if ( $test_type ) {
		$wp_filetype = wp_check_filetype( $file['name'], $mimes );

		extract( $wp_filetype );

//		if ( ( !$type || !$ext ) && !current_user_can( 'unfiltered_upload' ) )
//			return $upload_error_handler( $file, __( 'File type does not meet security guidelines. Try another.' ));

		if ( !$ext )
			$ext = ltrim(strrchr($file['name'], '.'), '.');

		if ( !$type )
			$type = $file['type'];
	} else {
		$type = '';
	}

	// A writable uploads dir will pass this test. Again, there's no point overriding this one.
	if ( ! ( ( $uploads = bp_get_gallery_upload_dir($gallery) ) && false === $uploads['error'] ) )
		return $upload_error_handler( $file, $uploads['error'] );

	$filename = wp_unique_filename( $uploads['path'], $file['name'], $unique_filename_callback );

	// Move the file to the uploads dir
	$new_file = $uploads['path'] . "/$filename";
	if ( false === @ move_uploaded_file( $file['tmp_name'], $new_file ) ) {
		return $upload_error_handler( $file, __('The uploaded file could not be moved to the upload folder.','bp-gallery' ) );
	}

	// Set correct file permissions
	$stat = stat( dirname( $new_file ));
	$perms = $stat['mode'] & 0000666;
	@ chmod( $new_file, $perms );

	// Compute the URL
	$url = $uploads['url'] . "/$filename";

	return apply_filters( 'gallery_handle_upload', array( 'file' => $new_file, 'url' => $url, 'type' => $type ) );
}



function bp_gallery_handle_media_upload($file,$gallery) {
	global $wp_upload_error;

/*call the method to handle error check and uploading*/
$res = gallery_handle_file_upload( $file,$gallery);
if ( !in_array('error', array_keys($res) ) ) {
		return $res;
	} else {
		$wp_upload_error = $res['error'];
		return false;/*upload has errors*/
	}
}

//process Upload new
/**
 * External sections call this to handle upload, this is only function exposed to outside
 * This is an enty point for all the uploads
 * @global  $wp_upload_error
 * @param <type> $user_id: who is uploading
 * @param <type> $gallery
 * @param <type> $file
 * @param <type> $key
 * @return <type>
 */
function bp_gallery_process_upload($user_id,$file,$gallery,$key='file'){
    global $wp_upload_error;
    $error="";
    $allowed_size = size_format(gallery_get_max_media_size());
    $upload_errors =bp_gallery_get_possible_upload_errors($allowed_size);//what could be possible errors

//if the file was uploaded
//if a file was uploaded 4:NO FILE UPLOADED
if ( UPLOAD_ERR_NO_FILE !== $file[$key]['error'] ) {

            //check for upload errors
	if ( !$checked_upload = bp_core_check_avatar_upload($file[$key]) )
            $error=sprintf(__("There was an error uploading the file. Error details:%s ","bp-gallery"),$upload_errors[$file[$key]['error']]);

            // check for maximum upload size
        if ( $checked_upload && !$checked_size = gallery_check_file_size($file[$key]) )
            $error = sprintf( __('The file you uploaded is too big. Please upload a file under %s', 'bp-gallery'), $allowed_size);

	//check for file type:allowed are jpeg/jpg/png/gif

        if ( $checked_upload && $checked_size && !$checked_type =bp_gallery_is_media_of_type($file[$key],$gallery->gallery_type) ) {
		$error = sprintf(__('Please upload only %s', 'bp-gallery'),gallery_get_verbose_explanation_for_extension($gallery->gallery_type)." ".gallery_get_type_name_plural($gallery->gallery_type));
	}
        //remember we are doing progressive checking here

        //if all is well
	// "Handle" upload into temporary location
	if ( $checked_upload && $checked_size && $checked_type && !$media = bp_gallery_handle_media_upload($file[$key],$gallery))
		$error= sprintf( __('Upload Failed! Error was: %s', 'bp-gallery'), $wp_upload_error );

        //so all the checks are done now, let us see were there some errorrs
        if(!($checked_upload&&$checked_size&&$checked_type&&$media))
                $file_error=true;//doh! we have some error sir

	//if there are no errors and file was uploaded ,we have uploaded the file successfully
        if (!$file_error){
             $file_type=$gallery->gallery_type;
               // $file_type=gallery_get_media_type($file);
              //$image_orig_path = $media['file'];//we have the abs path of file
              $upload_info=apply_filters("gallery_media_".$file_type."_process",$media);

             return $upload_info;
              }
  }else{
         $error=__('There was an error while uploading file. No file uploaded','bp-gallery');
             }


$media_uplod_info=array("error"=>$error);
return $media_uplod_info;

}


/**
 * @desc Used to upload gallery cover image, we will take it off in stable, It can be rather done by Photo Upload
 * @global <type> $wp_upload_error
 * @param <type> $file
 * @param <type> $gallery
 * @return <type>
 * ned to be deprected
 */
function gallery_upload_cover_image($file,$gallery){
    global $wp_upload_error;

    $error="";
    $allowed_size = size_format(gallery_get_max_media_size());
    $upload_errors = bp_gallery_get_possible_upload_errors($allowed_size);

if ( isset($file['file'])) {
//if the file was uploaded
//if a file was uploaded 4:NO FILE UPLOADED
if ( 4 !== $file['file']['error'] ) {
	//check for upload errors
	if ( !$checked_upload = bp_core_check_avatar_upload($file) )
        $error=__("There was an error uploading the file.Error details: ".$upload_errors[$file['file']['error']],"bp-gallery");

	/* check for maximum upload size*/
    if ( $checked_upload && !$checked_size = gallery_check_file_size($file) )
		$error = sprintf( __('The file you uploaded is too big. Please upload a file under %s', 'bp-gallery'), $allowed_size);


	//check for file type:allowed are jpeg/jpg/png/gif

    if ( $checked_upload && $checked_size && !$checked_type =bp_gallery_is_media_of_type($file,"photo") ) {
		$error = __('Please upload only '.gallery_get_verbose_explanation_for_extension($gallery->gallery_type)." ".$gallery->gallery_type, 'bp-gallery');
	}
//remember we are doing progressive checking here


	// "Handle" upload into temporary location
	if ( $checked_upload && $checked_size && $checked_type && !$media = bp_gallery_handle_media_upload($file['file'],$gallery))
		$error= sprintf( __('Upload Failed! Error was: %s', 'bp-gallery'), $wp_upload_error );

    //so all the checks are done now, let us see were there some errorrs
    if(!($checked_upload&&$checked_size&&$checked_type&&$media))
    $file_error=true;//doh! we have some error sir


	//if there are no errors and file was uploaded ,we have uploaded the file successfully
    if (!$file_error){
       $file_type="photo";
        // $image_orig_path = $media['file'];//we have the abs path of file
         $upload_info=apply_filters("gallery_media_".$file_type."_process",$media);
       return $upload_info;
              }
}else{
    $error=__('There was an error while uploading file. No file uploaded','bp-gallery');
 }

}

$image_uplod_info=array("error"=>$error);
return $image_uplod_info;
}



/********for specific media handling, we will hook them using filters*******************/

/*
 * Used to save information about photo upload
 */
function gallery_media_process_image($media){

    //process the image, create the thumbnails etc
    $orig_image_path = $media['file'];//we have the abs path of file
    //and this will be the relative path right
    //$image_orig_rel_path=str_replace(array(ABSPATH),'',$image_orig_path);
    $settings=gallery_get_media_size_settings("photo");//return an array
   
    $is_crop=bp_gallery_get_media_crop_or_resize();
    //use image_resize instead of the wp_create_thumbnail as it allows creation of non squared images too
    foreach($settings as $size_type=>$dimensions){
        $resized_image =image_resize($media['file'], $settings[$size_type]['width'], $settings[$size_type]['height'],$is_crop );//create a mid size thumbnail

        if (is_wp_error($resized_image)||empty($resized_image))
            $resized_image = $orig_image_path;// If Original Image's Size is less than $mid_size

        $resized_image = str_replace( '//', '/', $resized_image );
     //now relative mid,path
    
     $image_path=str_replace(array(ABSPATH),'',$resized_image);
	//Small Size Picture - Will be used for thumbnails
         $path_info[$size_type]=$image_path;
    }
  
   //for original image
   $orig_image = str_replace( '//', '/', $orig_image_path );
     //now relative mid,path

  $orig_image=str_replace(array(ABSPATH),'',$orig_image);
     
//for image, we check if original file has to be kept
  if(bp_gallery_preserve_original_image()){
       
      $path_info['original']=$orig_image;//please do not use key 'original,mid,thum,larger' in the media size settings, those are  reserver and can cause issues
  }
$image_uplod_info=array("files"=>$path_info,"error"=>'');

if(!in_array($orig_image,$image_uplod_info['files']))
   @unlink ($media['file']);//remove the original file
//print_r($image_uplod_info);
return $image_uplod_info;///array with three relative urls


}
/**
 * @desc Handle Processing of Video Upload
 * @param <type> $media
 * @return <type>
 */
function gallery_media_process_video($media){
        //in case of videos, we assume that there is no need for thumb path and mid path, the original works fine, so just return that
     $orig_upload_file = $media['file'];//we have the abs path of file

    //and this will be the relative path right
    $orig_upload_file=str_replace(array(ABSPATH),'',$orig_upload_file);
    $orig_upload_file = str_replace( '//', '/', $orig_upload_file );
    $upload_info=array("files"=>array("larger"=>$orig_upload_file,"mid"=>$orig_upload_file ,"thumb"=>$orig_upload_file),"error"=>'');

    return $upload_info;///array with three relative urls

}
/**
 * @desc Handle processing of audio files upload
 * @param <type> $media
 * @return <type>
 */
function gallery_media_process_audio($media){
    $orig_upload_file = $media['file'];//we have the abs path of file

    //and this will be the relative path right
    $orig_upload_file=str_replace(array(ABSPATH),'',$orig_upload_file);
    $orig_upload_file = str_replace( '//', '/', $orig_upload_file );
    $upload_info=array("files"=>array("larger"=>$orig_upload_file,"mid"=>$orig_upload_file ,"thumb"=>$orig_upload_file),"error"=>'');

    return $upload_info;///array with three relative urls
}

//let us call the specific methods to process the files
add_filter("gallery_media_photo_process","gallery_media_process_image",10,1);
add_filter("gallery_media_video_process","gallery_media_process_video",10,1);
add_filter("gallery_media_audio_process","gallery_media_process_audio",10,1);


///crop or resize settings
function bp_gallery_get_media_crop_or_resize(){
    $crop_or_resize=get_site_option("bp-gallery-crop-or-resize",false);//by default false
    return apply_filters("bp_gallery_crop_image",$crop_or_resize);
}

function bp_gallery_preserve_original_image(){
    return apply_filters("bp_gallery_preserve_original_image",0);//may return true for preserving image
}
?>