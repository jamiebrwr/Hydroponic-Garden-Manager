<?php
/* 
 * Misc functions for managing gallery
 *  
 */
/*
 * remove  data for a user
 */
function gallery_remove_data_for_user( $user_id ) {
	BP_Gallery_Member::delete_all_for_user($user_id);

	do_action( 'gallery_remove_data_for_user', $user_id );
}
/**
 * Clear the  gallery Object cache for a gallery
 * @param <type> $gallery_id
 */
function gallery_clear_gallery_object_cache( $gallery_id ) {
	wp_cache_delete( 'gallery_gallery_nouserdata_' . $gallery_id, 'bp' );
	wp_cache_delete( 'gallery_gallery_' . $gallery_id, 'bp' );

}


?>