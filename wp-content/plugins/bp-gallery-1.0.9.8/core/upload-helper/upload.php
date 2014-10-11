<?php
/**
 * @package bp-gallery
 * @subpackage media
 * @author Brajesh Singh <brajesh@cosmiccoders.com>
 */
//include other upload related files
require ( BP_GALLERY_PLUGIN_DIR . 'core/upload-helper/media.php' );
require ( BP_GALLERY_PLUGIN_DIR . 'core/upload-helper/space.php' );
require ( BP_GALLERY_PLUGIN_DIR . 'core/upload-helper/upload-processing.php' );



/************** Upload Path Determination***************/

/**
 * @desc Returns the base directory for uploading gallery files for the owner(user/groups/others)
 *
 **/
function bp_gallery_get_owner_base_dir($owner_type,$owner_id){
    global $wpdb;
    $upload_path_info=gallery_get_upload_base();
    return   $upload_path_info['path']."/gallery/".$owner_type."/".$owner_id."/";
}
/*
 * @ return array of upload base path and upload base url
 *  array('url'=>Upload base url,'path'=>upload_base_path)
 */
function gallery_get_upload_base(){
  // $siteurl = get_option( 'siteurl' );
  $upload= wp_upload_dir();
    return apply_filters("gallery_get_upload_base",array('url'=>$upload['baseurl'],'path'=>$upload['basedir']));//hook to this filter if you want to change path
}


/**
 * @desc return correct settings for uploading files to a gallery based on gallery owner and gallery id
 */

function bp_get_gallery_upload_dir($gallery ) {
    //get the base path info
    $upload_path_info=gallery_get_upload_base();

	$bdir = $dir=$upload_path_info['path'];
	$burl = $url=$upload_path_info['url'];
    //now for specific gallery
	$subdir = '';


    $subdir="/gallery/".$gallery->owner_object_type."/".$gallery->owner_object_id."/".$gallery->id;
	//echo $subdir;
    $dir .= $subdir;
    $url .= $subdir;

    $uploads = apply_filters( 'gallery_upload_dir', array( 'path' => $dir, 'url' => $url, 'subdir' => $subdir, 'basedir' => $bdir, 'baseurl' => $burl, 'error' => false ) );

	// Make sure we have an uploads dir
	if ( ! wp_mkdir_p( $uploads['path'] ) ) {
		$message = sprintf( __( 'Unable to create directory %s. Is its parent directory writable by the server?','bp-gallery' ), $uploads['path'] );
		return array( 'error' => $message );
	}

	return $uploads;
}


/*************** MISC functions*****************************/
/**
 * @desc Check for PHP causing Empty $_POST/$_FILES array in case the upload size is greater than post_max_size
 * very large file can cause $_POST and $_FILES array to be empty
 * @return <bool> true/false,
 * credits: this method is a slighly modified contribution from php.net forums
 */
function gallery_server_unable_to_handle_upload(){
    $POST_MAX_SIZE = ini_get('post_max_size');//what is the maximum post _size

    $mul = substr($POST_MAX_SIZE, -1);

    $mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
    $max_post_size=intval( $POST_MAX_SIZE)*$mul;


    if (($_SERVER['CONTENT_LENGTH'] > $max_post_size) && $max_post_size)
        return true;
    else
        return false;
}

?>