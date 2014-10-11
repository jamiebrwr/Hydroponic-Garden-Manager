<?php
/* 
 * Meta data for gallery/medias/users
 */


/*****
 *  Functions to handle Gallery meta
 * These functions are taken from wordpress user meta handling functions and are slightly modified to work for gallery
 */
/**
 *
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <type> $gallery_id
 * @param <type> $meta_key
 * @return <type> Gallery meta
 */
function bp_get_gallery_meta($gallery_id,$meta_key=''){
    global $wpdb,$bp;
	$gallery_id = (int) $gallery_id;
	if ( !$gallery_id )
		return false;

	if ( !empty($meta_key) ) {
		$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);
		$gallery = wp_cache_get("gallery_".$gallery_id, 'galleries');
		// Check the cached
		if ( false !== $gallery && isset($gallery->$meta_key) )
			$metas = array($gallery->$meta_key);
		else
			$metas = $wpdb->get_col( $wpdb->prepare("SELECT meta_value FROM {$bp->gallery->table_gallery_meta} WHERE gallery_id = %d AND meta_key = %s", $gallery_id, $meta_key) );
	} else {
		$metas = $wpdb->get_col( $wpdb->prepare("SELECT meta_value FROM $bp->gallery->table_gallery_meta WHERE gallery_id = %d", $gallery_id) );
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
 * @param <type> $gallery_id
 * @param <type> $meta_key
 * @param <type> $meta_value
 * @return <type>
 */

function bp_update_gallery_meta( $gallery_id, $meta_key, $meta_value ) {
	global $wpdb,$bp;
	if ( !is_numeric( $gallery_id ) )
		return false;
	$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);


	if ( is_string($meta_value) )
		$meta_value = stripslashes($meta_value);
	$meta_value = maybe_serialize($meta_value);

	if (empty($meta_value)) {
		return bp_delete_gallery_meta($gallery_id, $meta_key);
	}

	$cur = $wpdb->get_row( $wpdb->prepare("SELECT * FROM {$bp->gallery->table_gallery_meta} WHERE gallery_id = %d AND meta_key = %s", $gallery_id, $meta_key) );

	if ( $cur )
		do_action( 'update_gallerymeta', $cur->id, $gallery_id, $meta_key, $meta_value );

	if ( !$cur )
		$wpdb->insert($bp->gallery->table_gallery_meta, compact('gallery_id', 'meta_key', 'meta_value') );
	else if ( $cur->meta_value != $meta_value )
		$wpdb->update($bp->gallery->table_gallery_meta, compact('meta_value'), compact('gallery_id', 'meta_key') );
	else
		return false;

	wp_cache_delete("gallery_".$gallery_id, 'bp');

	if ( !$cur )
		do_action( 'added_gallerymeta', $wpdb->insert_id, $gallery_id, $meta_key, $meta_value );
	else
		do_action( 'updated_gallerymeta', $cur->id, $gallery_id, $meta_key, $meta_value );

	return true;
}
/**
 * Delete Gallery meta
 * @global <type> $wpdb
 * @global <type> $bp
 * @param <type> $gallery_id
 * @param <type> $meta_key
 * @param <type> $meta_value
 * @return <type>
 */

function bp_delete_gallery_meta( $gallery_id, $meta_key='', $meta_value = '' ) {
	global $wpdb,$bp;
	if ( !is_numeric( $gallery_id ) )
		return false;
        if(empty($meta_key)&&empty ($meta_value)){//we want all the meta to be dropped for this gallery
            $wpdb->query( $wpdb->prepare("DELETE FROM {$bp->gallery->table_gallery_meta} WHERE gallery_id = %d ", $gallery_id) );
	return true;
        }
	$meta_key = preg_replace('|[^a-z0-9_]|i', '', $meta_key);

	if ( is_array($meta_value) || is_object($meta_value) )
		$meta_value = serialize($meta_value);
	$meta_value = trim( $meta_value );

	$cur = $wpdb->get_row( $wpdb->prepare("SELECT * FROM $wpdb->gallery->table_gallery_meta WHERE gallery_id = %d AND meta_key = %s", $gallery_id, $meta_key) );

	if ( $cur && $cur->id )
		do_action( 'delete_gallerymeta', $cur->id, $gallery_id, $meta_key, $meta_value );

	if ( ! empty($meta_value)||$meta_value===0||$meta_value===false )
		$wpdb->query( $wpdb->prepare("DELETE FROM {$bp->gallery->table_gallery_meta} WHERE gallery_id = %d AND meta_key = %s AND meta_value = %s", $gallery_id, $meta_key, $meta_value) );
	else
		$wpdb->query( $wpdb->prepare("DELETE FROM {$bp->gallery->table_gallery_meta} WHERE gallery_id = %d AND meta_key = %s", $gallery_id, $meta_key) );

	wp_cache_delete("gallery_".$gallery_id, 'bp');

	if ( $cur && $cur->id )
		do_action( 'deleted_gallerymeta', $cur->id, $gallery_id, $meta_key, $meta_value );

	return true;
}

?>