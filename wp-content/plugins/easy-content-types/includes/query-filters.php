<?php

function ecpt_include_post_types_in_search( $query ) {
	if ( $query->is_main_query() && is_search() && isset( $query->query_vars['post_type'] ) && $query->query_vars['post_type'] != 'nav_menu_item' ) {
		$post_types = get_post_types( array( 'exclude_from_search' => false ), 'objects' );
		$searchable_types = array();
		if ( $post_types ) {
			foreach ( $post_types as $type ) {
				$searchable_types[] = $type->name;
			}
		}
		$query->set( 'post_type', $searchable_types );
	}
}
add_action( 'pre_get_posts', 'ecpt_include_post_types_in_search', 998 );


// fix taxonomy archives
function ecpt_filter_taxonomy_query( $query ) {
	global $ecpt_options;
	if ( $query->is_tax && ! isset( $query->query_vars['suppress_filters'] ) && !isset( $ecpt_options['disable_filter_archive_post_types'] ) ) {
		$post_types = array();
		$types      = get_post_types( array( 'exclude_from_search' => false ), 'objects' );
		if ( $types ) {
			foreach ( $types as $key => $type ) {
				$post_types[] = $type->name;
			}
		}
		$post_types[] = 'post';
		$post_types[] = 'page';

		$query->set( 'post_type', $post_types );
	}
}
add_action( 'pre_get_posts', 'ecpt_filter_taxonomy_query', 999 );
