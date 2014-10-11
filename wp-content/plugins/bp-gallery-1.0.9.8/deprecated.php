<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**********************************Media Wire functions*************************/
/**
 * @desc Delete all the media wire posts/media comments
 * @param <int> $wire_post_id
 * @return <bool>
 */
//we may not need this even
function gallery_media_delete_wire_post( $wire_post_id ) {
        /* Delete the activity stream item */
	if ( function_exists( 'bp_activity_delete_by_item_id' ) ) {
		bp_activity_delete_by_item_id( array( 'item_id' => $wire_post_id, 'component_name' => 'gallery', 'component_action' => 'new_wire_post' ) );
	//improve

	do_action( 'gallery_deleted_media_wire_post', $wire_post_id );
	return true;
}

return false;
}

/*
 * depricated
 * use: gallery_get_media_comment_count($media_id,$show_hidden)
 */
function get_activity_comment_count($media_id,$show_hidden=true){
    return gallery_get_media_comment_count($media_id,$show_hidden);
}
?>