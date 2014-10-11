<?php
/*
 * @package: bp-gallery
 * Media meta API
 * 
 */


/*****
 *  Functions to handle Media meta
 * These functions are taken from wordpress user meta handling functions and are slightly modified to work for gallery
 */
/**
 *
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <type> $media_id
 * @param <type> $meta_key
 * @return <type> Media meta
 */

function bp_get_media_meta($media_id,$meta_key=''){
    global $wpdb,$bp;
	$media_id = (int) $media_id;
	if ( !$media_id )
		return false;

	if ( !empty($meta_key) ) {
		$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);
		$media =bp_gallery_get_media($media_id); //wp_cache_get("gallery_".$media_id, 'galleries');
		// Check the cached
		if ( false !== $media && isset($media->$meta_key) )
			$metas = array($media->$meta_key);
		else
			$metas = $wpdb->get_col( $wpdb->prepare("SELECT meta_value FROM {$bp->gallery->table_media_meta} WHERE media_id = %d AND meta_key = %s", $media_id, $meta_key) );
	} else {
		$metas = $wpdb->get_col( $wpdb->prepare("SELECT meta_value FROM $bp->gallery->table_media_meta WHERE media_id = %d", $media_id) );
	}

	if ( empty($metas) ) {
		if ( empty($meta_key) )
			return array();
		else
			return '';
	}

	$metas = array_map('maybe_unserialize', $metas);

	if ( count($metas) == 1 )
		return $metas[0];
	else
		return $metas;
}

/**
 * Update or create gallery meta if not exists
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <type> $media_id
 * @param <type> $meta_key
 * @param <type> $meta_value
 * @return <type>
 */

function bp_update_media_meta( $media_id, $meta_key, $meta_value ) {
	global $wpdb,$bp;
	if ( !is_numeric( $media_id ) )
		return false;
	$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);


	if ( is_string($meta_value) )
		$meta_value = stripslashes($meta_value);
	$meta_value = maybe_serialize($meta_value);

	if (empty($meta_value)) {
		return bp_delete_media_meta($media_id, $meta_key);
	}

	$cur = $wpdb->get_row( $wpdb->prepare("SELECT * FROM {$bp->gallery->table_media_meta} WHERE media_id = %d AND meta_key = %s", $media_id, $meta_key) );

	if ( $cur )
		do_action( 'bp_gallery_update_media_meta', $cur->id, $media_id, $meta_key, $meta_value );

	if ( !$cur )
		$wpdb->insert($bp->gallery->table_media_meta, compact('media_id', 'meta_key', 'meta_value') );
	else if ( $cur->meta_value != $meta_value )
		$wpdb->update($bp->gallery->table_media_meta, compact('meta_value'), compact('media_id', 'meta_key') );
	else
		return false;

	wp_cache_delete("gallery_gallery_media_".$media_id, 'bp');

	if ( !$cur )
		do_action( 'bp_gallery_added_media_ymeta', $wpdb->insert_id, $media_id, $meta_key, $meta_value );
	else
		do_action( 'bp_gallery_updated_media_meta', $cur->id, $media_id, $meta_key, $meta_value );

	return true;
}
/**
 * Delete Media meta
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <type> $media_id
 * @param <type> $meta_key
 * @param <type> $meta_value
 * @return <type>
 */

function bp_delete_media_meta( $media_id, $meta_key='', $meta_value = '' ) {
	global $wpdb,$bp;
	if ( !is_numeric( $media_id ) )
		return false;
        if(empty($meta_key)&&empty ($meta_value)){//we want all the meta to be dropped for this gallery
            $wpdb->query( $wpdb->prepare("DELETE FROM {$bp->gallery->table_media_meta} WHERE media_id = %d ", $media_id) );
	return true;
        }
	$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);

	if ( is_array($meta_value) || is_object($meta_value) )
		$meta_value = serialize($meta_value);
	$meta_value = trim( $meta_value );

	$cur = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->gallery->table_media_meta WHERE media_id = %d AND meta_key = %s", $media_id, $meta_key) );

	if ( $cur && $cur->id )
		do_action( 'bp_gallery_delete_media_meta', $cur->id, $media_id, $meta_key, $meta_value );

	if ( ! empty($meta_value)||$meta_value===0||$meta_value===false )
		$wpdb->query( $wpdb->prepare("DELETE FROM {$bp->gallery->table_media_meta} WHERE media_id = %d AND meta_key = %s AND meta_value = %s", $media_id, $meta_key, $meta_value) );
	else
		$wpdb->query( $wpdb->prepare("DELETE FROM {$bp->gallery->table_media_meta} WHERE media_id = %d AND meta_key = %s", $media_id, $meta_key) );

	wp_cache_delete("gallery_gallery_media_".$media_id, 'bp');

	if ( $cur && $cur->id )
		do_action( 'bp_gallery_deleted_media_meta', $cur->id, $media_id, $meta_key, $meta_value );

	return true;
}

?>