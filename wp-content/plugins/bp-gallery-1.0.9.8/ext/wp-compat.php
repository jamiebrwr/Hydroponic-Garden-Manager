<?php
/* 
 * This file contains functions needed for Single User(Standard) wp support
 * These are mostly replicated from wpmu, thanks to Donncha for his great work
 */
if(!function_exists("get_dirsize")):
function get_dirsize( $directory ) {
	$dirsize = get_transient( 'dirsize_cache' );
	if ( is_array( $dirsize ) && isset( $dirsize[ $directory ][ 'size' ] ) ) {
		return $dirsize[ $directory ][ 'size' ];
	}
	if ( false == is_array( $dirsize ) ) {
		$dirsize = array();
	}
	$dirsize[ $directory ][ 'size' ] = recurse_dirsize( $directory );

	set_transient( 'dirsize_cache', $dirsize, 3600 );
	return $dirsize[ $directory ][ 'size' ];
}
endif;
if(!function_exists("clear_dirsize_cache")):
function clear_dirsize_cache( $file = true ) {
	delete_transient( 'dirsize_cache' );
	return $file;
}
endif;
add_filter( 'gallery_handle_upload', 'clear_dirsize_cache' );
add_action( 'delete_media', 'clear_dirsize_cache' );
add_action( 'delete_gallery', 'clear_dirsize_cache' );
if(!function_exists("recurse_dirsize")):
function recurse_dirsize( $directory ) {
	$size = 0;
	if(substr($directory,-1) == '/') $directory = substr($directory,0,-1);
	if(!file_exists($directory) || !is_dir($directory) || !is_readable($directory)) return false;
	if($handle = opendir($directory)) {
		while(($file = readdir($handle)) !== false) {
			$path = $directory.'/'.$file;
			if($file != '.' && $file != '..') {
				if(is_file($path)) {
					$size += filesize($path);
				} elseif(is_dir($path)) {
					$handlesize = recurse_dirsize($path);
					if($handlesize >= 0) {
						$size += $handlesize;
					} else {
						return false;
					}
				}
			}
		}
		closedir($handle);
	}
	return $size;
}
endif;
if(!function_exists("check_upload_mimes")):
function check_upload_mimes($mimes) {
	$site_exts = explode( " ", get_site_option( "upload_filetypes" ) );
	foreach ( $site_exts as $ext ) {
		foreach ( $mimes as $ext_pattern => $mime ) {
			if( $ext != '' && strpos( $ext_pattern, $ext ) !== false ) {
				$site_mimes[$ext_pattern] = $mime;
			}
		}
	}
	return $site_mimes;
}
endif;
?>