<?php

function ecpt_register_taxonomies() {

	global $ecpt_options;

	$taxonomies = ecpt_get_cached_taxonomies();

	foreach( $taxonomies as $key => $tax) {


		$labels = array(
			'name' 							=> _x( $tax->plural_name, 'taxonomy general name' ),
			'singular_name' 				=> _x( $tax->singular_name, 'taxonomy singular name' ),
			'add_new' 						=> _x( 'Add New ' . $tax->singular_name, 'taxonomy add new'),
			'add_new_item' 					=> __( 'Add New ' . $tax->singular_name ),
			'edit_item' 					=> __( 'Edit ' . $tax->singular_name ),
			'new_item' 						=> __( 'New ' . $tax->singular_name ),
			'popular_items' 				=> __( 'Popular ' . $tax->plural_name ),
			'all_items' 					=> __( 'All ' . $tax->plural_name ),
			'view_item' 					=> __( 'View ' . $tax->singular_name ),
			'separate_items_with_commas'	=> __( 'Separate ' . $tax->plural_name . ' with commas' ),
			'choose_from_most_used'			=> __( 'Choose from the most used ' . $tax->plural_name),
			'search_items' 					=> __( 'Search ' . $tax->plural_name ),
			'not_found' 					=> __( 'No ' . $tax->singular_name . ' found' ),
			'not_found_in_trash' 			=> __( 'No ' . $tax->singular_name . ' found in Trash' ),
		);

		$hierarchical = $tax->hierarchical == 1      ? true : false;
		$tagcloud     = $tax->show_tagcloud == 1     ? true : false;
		$nav          = $tax->show_in_nav_menus == 1 ? true : false;
		$with_front   = $tax->with_front == 1        ? true : false;

		$pages = array();
		$pages = explode(',', $tax->page);

		$args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __( $tax->singular_name ),
			'public' 			=> true,
			'show_ui' 			=> true,
			'hierarchical' 		=> $hierarchical,
			'show_tagcloud' 	=> $tagcloud,
			'show_in_nav_menus' => $nav,
			'rewrite' 			=> array('slug' => $tax->slug, 'with_front' => $with_front, 'hierarchical' => $hierarchical),
			'query_var'			=> str_replace(' ', '_', strtolower( $tax->name ) ),
			'args'				=> array('orderby' => 'term_order')
		 );

		if(isset($ecpt_options['create_tax_templates']) && $ecpt_options['create_tax_templates'] == true) {
			 // create a template file for the taxonomy archives if it doesn't exist
			 if(!file_exists(get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php')) {
				if(file_exists(get_stylesheet_directory() . '/taxonomy.php')) {
					copy(get_stylesheet_directory() . '/taxonomy.php', get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php');
				} elseif (file_exists(get_stylesheet_directory() . '/archive.php')) {
					copy(get_stylesheet_directory() . '/archive.php', get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php');
				} elseif (file_exists(get_stylesheet_directory() . '/index.php')) {
					copy(get_stylesheet_directory() . '/index.php', get_stylesheet_directory() . '/taxonomy-' . str_replace(' ', '_', strtolower($tax->name)) . '.php');
				}
			 }
		}
		register_taxonomy(str_replace(' ', '_', strtolower($tax->name)), $pages, $args);
	}
}
add_action('init', 'ecpt_register_taxonomies', 10);