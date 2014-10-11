<?php
// registration code for schedule post type
	function register_schedule_posttype() {
		$labels = array(
			'name' 				=> _x( 'Schedules', 'post type general name' ),
			'singular_name'		=> _x( 'Schedule', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Schedule' ),
			'edit_item' 		=> __( 'Edit Schedule' ),
			'new_item' 			=> __( 'New Schedule' ),
			'view_item' 		=> __( 'View Schedule' ),
			'search_items' 		=> __( 'Search Schedules' ),
			'not_found' 		=> __( 'No Schedules found' ),
			'not_found_in_trash'=> __( 'No Schedules found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Schedule' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Schedule'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'schedule', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-calendar',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('schedule',$post_type_args);
	}
	add_action('init', 'register_schedule_posttype');// registration code for reports post type
	function register_reports_posttype() {
		$labels = array(
			'name' 				=> _x( 'Reports', 'post type general name' ),
			'singular_name'		=> _x( 'Report', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Report' ),
			'edit_item' 		=> __( 'Edit Report' ),
			'new_item' 			=> __( 'New Report' ),
			'view_item' 		=> __( 'View Report' ),
			'search_items' 		=> __( 'Search Reports' ),
			'not_found' 		=> __( 'No Reports found' ),
			'not_found_in_trash'=> __( 'No Report found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Reports' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Report'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'tracking-reports', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-chart-area',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('reports',$post_type_args);
	}
	add_action('init', 'register_reports_posttype');// registration code for plan post type
	function register_plan_posttype() {
		$labels = array(
			'name' 				=> _x( 'Plan', 'post type general name' ),
			'singular_name'		=> _x( 'Plan', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Plan' ),
			'edit_item' 		=> __( 'Edit Plan' ),
			'new_item' 			=> __( 'New Plan' ),
			'view_item' 		=> __( 'View Plan' ),
			'search_items' 		=> __( 'Search Plan' ),
			'not_found' 		=> __( 'No Plan found' ),
			'not_found_in_trash'=> __( 'No Plan found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( '' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Plan'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'plan', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-analytics',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('plan',$post_type_args);
	}
	add_action('init', 'register_plan_posttype');// registration code for actualtime post type
	function register_actualtime_posttype() {
		$labels = array(
			'name' 				=> _x( 'Actual Times', 'post type general name' ),
			'singular_name'		=> _x( 'Actual Time', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Track' ),
			'edit_item' 		=> __( 'Edit Track' ),
			'new_item' 			=> __( 'New Track' ),
			'view_item' 		=> __( 'View Track' ),
			'search_items' 		=> __( 'Search Track' ),
			'not_found' 		=> __( 'No Track found' ),
			'not_found_in_trash'=> __( 'No Track found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Actual Time' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','comments');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Actual Time'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'time-tracking', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://captainslog.jamiebrewer.com/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('actualtime',$post_type_args);
	}
	add_action('init', 'register_actualtime_posttype');// registration code for exspenses post type
	function register_exspenses_posttype() {
		$labels = array(
			'name' 				=> _x( 'Exspenses', 'post type general name' ),
			'singular_name'		=> _x( 'Exspense', 'post type singular name' ),
			'add_new' 			=> __( 'Add Exspense' ),
			'add_new_item' 		=> __( 'Add New Exspense' ),
			'edit_item' 		=> __( 'Edit Exspense' ),
			'new_item' 			=> __( 'New Exspense' ),
			'view_item' 		=> __( 'View Exspense' ),
			'search_items' 		=> __( 'Search Exspenses' ),
			'not_found' 		=> __( 'No Exspenses found' ),
			'not_found_in_trash'=> __( 'No Exspenses found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Exspenses' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Exspense'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'track-exspenses', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://captainslog.jamiebrewer.com/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('exspenses',$post_type_args);
	}
	add_action('init', 'register_exspenses_posttype');// registration code for payments post type
	function register_payments_posttype() {
		$labels = array(
			'name' 				=> _x( 'Payment', 'post type general name' ),
			'singular_name'		=> _x( 'Payments', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Payments' ),
			'edit_item' 		=> __( 'Edit Payments' ),
			'new_item' 			=> __( 'New Payments' ),
			'view_item' 		=> __( 'View Payments' ),
			'search_items' 		=> __( 'Search Payment' ),
			'not_found' 		=> __( 'No Payment found' ),
			'not_found_in_trash'=> __( 'No Payment found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Payments' )
		);
		
		$taxonomies = array();

		$supports = array('title','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Payments'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'payments', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://captainslog.jamiebrewer.com/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('payments',$post_type_args);
	}
	add_action('init', 'register_payments_posttype');// registration code for journaling post type
	function register_journaling_posttype() {
		$labels = array(
			'name' 				=> _x( 'Journal Entries', 'post type general name' ),
			'singular_name'		=> _x( 'Journal', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Journal' ),
			'edit_item' 		=> __( 'Edit Journal' ),
			'new_item' 			=> __( 'New Journal' ),
			'view_item' 		=> __( 'View Journal' ),
			'search_items' 		=> __( 'Search Journal Entries' ),
			'not_found' 		=> __( 'No Journal Entries found' ),
			'not_found_in_trash'=> __( 'No Journal Entries found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Journal' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Journal'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'track-journal-entries', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'http://captainslog.jamiebrewer.com/wp-content/plugins/easy-content-types/includes/images/icon.png',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('journaling',$post_type_args);
	}
	add_action('init', 'register_journaling_posttype');// registration code for familyroadmap post type
	function register_familyroadmap_posttype() {
		$labels = array(
			'name' 				=> _x( 'Family Roadmap', 'post type general name' ),
			'singular_name'		=> _x( 'Family Roadmap', 'post type singular name' ),
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> __( 'Add New Family Roadmap' ),
			'edit_item' 		=> __( 'Edit Family Roadmap' ),
			'new_item' 			=> __( 'New Family Roadmap' ),
			'view_item' 		=> __( 'View Family Roadmap' ),
			'search_items' 		=> __( 'Search Family Roadmap' ),
			'not_found' 		=> __( 'No Family Roadmap found' ),
			'not_found_in_trash'=> __( 'No Family Roadmap found in the trash' ),
			'parent_item_colon' => __( '' ),
			'menu_name'			=> __( 'Family Roadmap' )
		);
		
		$taxonomies = array();

		$supports = array('title','editor','author','thumbnail','excerpt','custom-fields','comments','revisions');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> __('Family Roadmap'),
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'exclude_from_search'=> false,
			'show_in_nav_menus'	=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => 'family-roadmap', 'with_front' => false ),
			'supports' 			=> $supports,
			'menu_position' 	=> 5,
			'menu_icon' 		=> 'dashicons-location-alt',
			'taxonomies'		=> $taxonomies
		 );
		 register_post_type('familyroadmap',$post_type_args);
	}
	add_action('init', 'register_familyroadmap_posttype');

//Taxonomy Export Code
	

		// registration code for typeoffood taxonomy
		function register_typeoffood_tax() {
			$labels = array(
				'name' 					=> _x( 'Type of Food', 'taxonomy general name' ),
				'singular_name' 		=> _x( 'Type of Food', 'taxonomy singular name' ),
				'add_new' 				=> _x( 'Add New Type of Food', 'Type of Food'),
				'add_new_item' 			=> __( 'Add New Type of Food' ),
				'edit_item' 			=> __( 'Edit Type of Food' ),
				'new_item' 				=> __( 'New Type of Food' ),
				'view_item' 			=> __( 'View Type of Food' ),
				'search_items' 			=> __( 'Search Type of Food' ),
				'not_found' 			=> __( 'No Type of Food found' ),
				'not_found_in_trash' 	=> __( 'No Type of Food found in Trash' ),
			);
			
			$pages = array('actualtime');
			
			$args = array(
				'labels' 			=> $labels,
				'singular_label' 	=> __('Type of Food'),
				'public' 			=> true,
				'show_ui' 			=> true,
				'hierarchical' 		=> true,
				'show_tagcloud' 	=> true,
				'show_in_nav_menus' => true,
				'rewrite' 			=> array('slug' => 'type_of_food', 'with_front' => false ),
			 );
			register_taxonomy('typeoffood', $pages, $args);
		}
		add_action('init', 'register_typeoffood_tax');

//Meta Box Export Code
$visitationdetails_1_metabox = array(
	'id' => 'visitationdetails',
	'title' => 'Visitation Details',
	'page' => array('actualtime'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(


				array(
					'name' 			=> 'Pickup Time Details',
					'desc' 			=> 'The date and time of the scheduled visit. What time Stacey picked the kids up and amount of time she is allowed to have for visitation.',
					'id' 				=> 'ecpt_pickuptimedetails',
					'class' 			=> 'ecpt_pickuptimedetails',
					'type' 			=> 'header',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Date',
					'desc' 			=> '',
					'id' 				=> 'ecpt_date',
					'class' 			=> 'ecpt_date',
					'type' 			=> 'date',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Visitation Type',
					'desc' 			=> '',
					'id' 				=> 'ecpt_visitationtype',
					'class' 			=> 'ecpt_visitationtype',
					'type' 			=> 'radio',
					'rich_editor' 	=> 0,
					'options' => array('Week Day','Weekend'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Allotted Hours',
					'desc' 			=> '',
					'id' 				=> 'ecpt_allottedhours',
					'class' 			=> 'ecpt_allottedhours',
					'type' 			=> 'select',
					'rich_editor' 	=> 1,
					'options' => array('1','2','3','4','5','6','12','24','48'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Time Divider',
					'desc' 			=> '',
					'id' 				=> 'ecpt_timedivider',
					'class' 			=> 'ecpt_timedivider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Hour',
					'desc' 			=> '',
					'id' 				=> 'ecpt_hour',
					'class' 			=> 'ecpt_hour',
					'type' 			=> 'select',
					'rich_editor' 	=> 0,
					'options' => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Minute',
					'desc' 			=> '',
					'id' 				=> 'ecpt_minute',
					'class' 			=> 'ecpt_minute',
					'type' 			=> 'select',
					'rich_editor' 	=> 1,
					'options' => array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Drop Off Hour',
					'desc' 			=> '',
					'id' 				=> 'ecpt_dropoffhour',
					'class' 			=> 'ecpt_dropoffhour',
					'type' 			=> 'select',
					'rich_editor' 	=> 0,
					'options' => array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Drop Off Minute',
					'desc' 			=> '',
					'id' 				=> 'ecpt_dropoffminute',
					'class' 			=> 'ecpt_dropoffminute',
					'type' 			=> 'select',
					'rich_editor' 	=> 1,
					'options' => array('01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'DIVIDER',
					'desc' 			=> '',
					'id' 				=> 'ecpt_divider',
					'class' 			=> 'ecpt_divider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
				)
);

add_action('admin_menu', 'ecpt_add_visitationdetails_1_meta_box');
function ecpt_add_visitationdetails_1_meta_box() {

	global $visitationdetails_1_metabox;

	foreach($visitationdetails_1_metabox['page'] as $page) {
		add_meta_box($visitationdetails_1_metabox['id'], $visitationdetails_1_metabox['title'], 'ecpt_show_visitationdetails_1_box', $page, 'normal', 'high', $visitationdetails_1_metabox);
	}
}

// function to show meta boxes
function ecpt_show_visitationdetails_1_box() {
	global $post;
	global $visitationdetails_1_metabox;
	global $ecpt_prefix;
	global $wp_version;

	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_visitationdetails_1_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($visitationdetails_1_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'date':
				if($meta) { $value = ecpt_timestamp_to_date($meta); } else {  $value = ''; }
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. $value . '" size="30" style="width:97%" />' . '' . stripslashes($field['desc']);
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'textarea':

				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : '', '</textarea></div>', '', stripslashes($field['desc']);
				}

				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', stripslashes($field['desc']);
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'multicheck':
				if( ! is_array( $meta ) ) {
					$meta = array();
				}
				foreach ($field['options'] as $option) {
					echo '<input type="checkbox" name="' . $field['id'] . '[' . $option . ']" value="' . $option . '"' . checked( true, in_array( $option, $meta ), false ) . '/> ' . $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo stripslashes($field['desc']);
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';
				echo '<div style="width: 100%; clear: both;">' . stripslashes($field['desc']) . '</div>';
				break;
			case 'repeatable' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;

			case 'repeatable upload' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;
		}
		echo     '<td>',
			'</tr>';
	}

	echo '</table>';
}

// Save data from meta box
add_action('save_post', 'ecpt_visitationdetails_1_save');
function ecpt_visitationdetails_1_save($post_id) {
	global $post;
	global $visitationdetails_1_metabox;

	// verify nonce
	if ( ! isset( $_POST['ecpt_visitationdetails_1_meta_box_nonce'] ) || ! wp_verify_nonce($_POST['ecpt_visitationdetails_1_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($visitationdetails_1_metabox['fields'] as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				}
				update_post_meta($post_id, $field['id'], $new);


			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

$mealdetails_4_metabox = array(
	'id' => 'mealdetails',
	'title' => 'Meal Details',
	'page' => array('actualtime'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(


				array(
					'name' 			=> 'Meals',
					'desc' 			=> 'Logging the amount of times stacey feeds them meals during her visitation time and what type of food they are eating.',
					'id' 				=> 'ecpt_meals',
					'class' 			=> 'ecpt_meals',
					'type' 			=> 'header',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'DIVIDER',
					'desc' 			=> '',
					'id' 				=> 'ecpt_divider',
					'class' 			=> 'ecpt_divider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Meal Supplied',
					'desc' 			=> '',
					'id' 				=> 'ecpt_meal_supplied',
					'class' 			=> 'ecpt_meal_supplied',
					'type' 			=> 'radio',
					'rich_editor' 	=> 1,
					'options' => array('Yes','No'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'DIVIDER',
					'desc' 			=> '',
					'id' 				=> 'ecpt_divider',
					'class' 			=> 'ecpt_divider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Type of Meal',
					'desc' 			=> '',
					'id' 				=> 'ecpt_type_of_meal',
					'class' 			=> 'ecpt_type_of_meal',
					'type' 			=> 'radio',
					'rich_editor' 	=> 0,
					'options' => array('Fast Food','Restaurant','Homemade','Nothing'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'DIVIDER',
					'desc' 			=> '',
					'id' 				=> 'ecpt_divider',
					'class' 			=> 'ecpt_divider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Foods?',
					'desc' 			=> 'The different types of food they had as a meal.',
					'id' 				=> 'ecpt_foods',
					'class' 			=> 'ecpt_foods',
					'type' 			=> 'repeatable',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
				)
);

add_action('admin_menu', 'ecpt_add_mealdetails_4_meta_box');
function ecpt_add_mealdetails_4_meta_box() {

	global $mealdetails_4_metabox;

	foreach($mealdetails_4_metabox['page'] as $page) {
		add_meta_box($mealdetails_4_metabox['id'], $mealdetails_4_metabox['title'], 'ecpt_show_mealdetails_4_box', $page, 'normal', 'high', $mealdetails_4_metabox);
	}
}

// function to show meta boxes
function ecpt_show_mealdetails_4_box()	{
	global $post;
	global $mealdetails_4_metabox;
	global $ecpt_prefix;
	global $wp_version;

	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_mealdetails_4_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($mealdetails_4_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'date':
				if($meta) { $value = ecpt_timestamp_to_date($meta); } else {  $value = ''; }
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. $value . '" size="30" style="width:97%" />' . '' . stripslashes($field['desc']);
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'textarea':

				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : '', '</textarea></div>', '', stripslashes($field['desc']);
				}

				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', stripslashes($field['desc']);
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'multicheck':
				if( ! is_array( $meta ) ) {
					$meta = array();
				}
				foreach ($field['options'] as $option) {
					echo '<input type="checkbox" name="' . $field['id'] . '[' . $option . ']" value="' . $option . '"' . checked( true, in_array( $option, $meta ), false ) . '/> ' . $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo stripslashes($field['desc']);
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';
				echo '<div style="width: 100%; clear: both;">' . stripslashes($field['desc']) . '</div>';
				break;
			case 'repeatable' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;

			case 'repeatable upload' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;
		}
		echo     '<td>',
			'</tr>';
	}

	echo '</table>';
}

// Save data from meta box
add_action('save_post', 'ecpt_mealdetails_4_save');
function ecpt_mealdetails_4_save($post_id) {
	global $post;
	global $mealdetails_4_metabox;

	// verify nonce
	if ( ! isset( $_POST['ecpt_mealdetails_4_meta_box_nonce'] ) || ! wp_verify_nonce($_POST['ecpt_mealdetails_4_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($mealdetails_4_metabox['fields'] as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				}
				update_post_meta($post_id, $field['id'], $new);


			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

$timedetails_5_metabox = array(
	'id' => 'timedetails',
	'title' => 'Time Details',
	'page' => array('actualtime'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(


				array(
					'name' 			=> 'Pickup Details',
					'desc' 			=> 'The date and time of the scheduled visit. The Custody Agreement defines what time Stacey is able to pickup the kids, drop off the kids and the total amount of time she is allowed to have for visitation.',
					'id' 				=> 'ecpt_pickup_time_details',
					'class' 			=> 'ecpt_pickup_time_details',
					'type' 			=> 'header',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'DIVIDER',
					'desc' 			=> '',
					'id' 				=> 'ecpt_divider',
					'class' 			=> 'ecpt_divider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Visitation Type',
					'desc' 			=> '',
					'id' 				=> 'ecpt_visitation_type',
					'class' 			=> 'ecpt_visitation_type',
					'type' 			=> 'radio',
					'rich_editor' 	=> 1,
					'options' => array('Week Day','Weekend'),
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Date',
					'desc' 			=> 'Date of return (used for overnight stays)',
					'id' 				=> 'ecpt_return_date',
					'class' 			=> 'ecpt_return_date',
					'type' 			=> 'date',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'DIVIDER',
					'desc' 			=> '',
					'id' 				=> 'ecpt_divider',
					'class' 			=> 'ecpt_divider',
					'type' 			=> 'separator',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Pickup Time',
					'desc' 			=> '24hr format',
					'id' 				=> 'ecpt_pickup_time',
					'class' 			=> 'ecpt_pickup_time',
					'type' 			=> 'text',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
			
				array(
					'name' 			=> 'Drop Off Time',
					'desc' 			=> '24hr format',
					'id' 				=> 'ecpt_drop_off_time',
					'class' 			=> 'ecpt_drop_off_time',
					'type' 			=> 'text',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
				)
);



$relatedcontent_9_metabox = array(
	'id' => 'relatedcontent',
	'title' => 'Related Content',
	'page' => array('actualtime'),
	'context' => 'normal',
	'priority' => 'default',
	'fields' => array(


				array(
					'name' 			=> '',
					'desc' 			=> '',
					'id' 				=> 'ecpt_linktoposts',
					'class' 			=> 'ecpt_linktoposts',
					'type' 			=> 'repeatable',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
				)
);

add_action('admin_menu', 'ecpt_add_relatedcontent_9_meta_box');
function ecpt_add_relatedcontent_9_meta_box() {

	global $relatedcontent_9_metabox;

	foreach($relatedcontent_9_metabox['page'] as $page) {
		add_meta_box($relatedcontent_9_metabox['id'], $relatedcontent_9_metabox['title'], 'ecpt_show_relatedcontent_9_box', $page, 'normal', 'default', $relatedcontent_9_metabox);
	}
}

// function to show meta boxes
function ecpt_show_relatedcontent_9_box()	{
	global $post;
	global $relatedcontent_9_metabox;
	global $ecpt_prefix;
	global $wp_version;

	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_relatedcontent_9_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($relatedcontent_9_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'date':
				if($meta) { $value = ecpt_timestamp_to_date($meta); } else {  $value = ''; }
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. $value . '" size="30" style="width:97%" />' . '' . stripslashes($field['desc']);
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'textarea':

				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : '', '</textarea></div>', '', stripslashes($field['desc']);
				}

				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', stripslashes($field['desc']);
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'multicheck':
				if( ! is_array( $meta ) ) {
					$meta = array();
				}
				foreach ($field['options'] as $option) {
					echo '<input type="checkbox" name="' . $field['id'] . '[' . $option . ']" value="' . $option . '"' . checked( true, in_array( $option, $meta ), false ) . '/> ' . $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo stripslashes($field['desc']);
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';
				echo '<div style="width: 100%; clear: both;">' . stripslashes($field['desc']) . '</div>';
				break;
			case 'repeatable' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;

			case 'repeatable upload' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;
		}
		echo     '<td>',
			'</tr>';
	}

	echo '</table>';
}

// Save data from meta box
add_action('save_post', 'ecpt_relatedcontent_9_save');
function ecpt_relatedcontent_9_save($post_id) {
	global $post;
	global $relatedcontent_9_metabox;

	// verify nonce
	if ( ! isset( $_POST['ecpt_relatedcontent_9_meta_box_nonce'] ) || ! wp_verify_nonce($_POST['ecpt_relatedcontent_9_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($relatedcontent_9_metabox['fields'] as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				}
				update_post_meta($post_id, $field['id'], $new);


			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

$audiolink_10_metabox = array(
	'id' => 'audiolink',
	'title' => 'Audio Link',
	'page' => array('post','actualtime'),
	'context' => 'normal',
	'priority' => 'default',
	'fields' => array(


				array(
					'name' 			=> '',
					'desc' 			=> '',
					'id' 				=> 'ecpt_audio_link',
					'class' 			=> 'ecpt_audio_link',
					'type' 			=> 'repeatable',
					'rich_editor' 	=> 1,
					'max' 			=> 0				),
				)
);

add_action('admin_menu', 'ecpt_add_audiolink_10_meta_box');
function ecpt_add_audiolink_10_meta_box() {

	global $audiolink_10_metabox;

	foreach($audiolink_10_metabox['page'] as $page) {
		add_meta_box($audiolink_10_metabox['id'], $audiolink_10_metabox['title'], 'ecpt_show_audiolink_10_box', $page, 'normal', 'default', $audiolink_10_metabox);
	}
}

// function to show meta boxes
function ecpt_show_audiolink_10_box() {
	global $post;
	global $audiolink_10_metabox;
	global $ecpt_prefix;
	global $wp_version;

	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_audiolink_10_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($audiolink_10_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'date':
				if($meta) { $value = ecpt_timestamp_to_date($meta); } else {  $value = ''; }
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. $value . '" size="30" style="width:97%" />' . '' . stripslashes($field['desc']);
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'textarea':

				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : '', '</textarea></div>', '', stripslashes($field['desc']);
				}

				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', stripslashes($field['desc']);
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'multicheck':
				if( ! is_array( $meta ) ) {
					$meta = array();
				}
				foreach ($field['options'] as $option) {
					echo '<input type="checkbox" name="' . $field['id'] . '[' . $option . ']" value="' . $option . '"' . checked( true, in_array( $option, $meta ), false ) . '/> ' . $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo stripslashes($field['desc']);
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';
				echo '<div style="width: 100%; clear: both;">' . stripslashes($field['desc']) . '</div>';
				break;
			case 'repeatable' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;

			case 'repeatable upload' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;
		}
		echo     '<td>',
			'</tr>';
	}

	echo '</table>';
}

// Save data from meta box
add_action('save_post', 'ecpt_audiolink_10_save');
function ecpt_audiolink_10_save($post_id) {
	global $post;
	global $audiolink_10_metabox;

	// verify nonce
	if ( ! isset( $_POST['ecpt_audiolink_10_meta_box_nonce'] ) || ! wp_verify_nonce($_POST['ecpt_audiolink_10_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($audiolink_10_metabox['fields'] as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				}
				update_post_meta($post_id, $field['id'], $new);


			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

$paymentdetails_11_metabox = array(
	'id' => 'paymentdetails',
	'title' => 'Payment Details',
	'page' => array('payments'),
	'context' => 'normal',
	'priority' => 'default',
	'fields' => array(


				array(
					'name' 			=> 'Amount Received',
					'desc' 			=> '',
					'id' 				=> 'ecpt_amount_received',
					'class' 			=> 'ecpt_amount_received',
					'type' 			=> 'text',
					'rich_editor' 	=> 0,
					'max' 			=> 0				),
				)
);

add_action('admin_menu', 'ecpt_add_paymentdetails_11_meta_box');
function ecpt_add_paymentdetails_11_meta_box() {

	global $paymentdetails_11_metabox;

	foreach($paymentdetails_11_metabox['page'] as $page) {
		add_meta_box($paymentdetails_11_metabox['id'], $paymentdetails_11_metabox['title'], 'ecpt_show_paymentdetails_11_box', $page, 'normal', 'default', $paymentdetails_11_metabox);
	}
}

// function to show meta boxes
function ecpt_show_paymentdetails_11_box()	{
	global $post;
	global $paymentdetails_11_metabox;
	global $ecpt_prefix;
	global $wp_version;

	// Use nonce for verification
	echo '<input type="hidden" name="ecpt_paymentdetails_11_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	echo '<table class="form-table">';

	foreach ($paymentdetails_11_metabox['fields'] as $field) {
		// get current post meta data

		$meta = get_post_meta($post->ID, $field['id'], true);

		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', stripslashes($field['name']), '</label></th>',
				'<td class="ecpt_field_type_' . str_replace(' ', '_', $field['type']) . '">';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:97%" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'date':
				if($meta) { $value = ecpt_timestamp_to_date($meta); } else {  $value = ''; }
				echo '<input type="text" class="ecpt_datepicker" name="' . $field['id'] . '" id="' . $field['id'] . '" value="'. $value . '" size="30" style="width:97%" />' . '' . stripslashes($field['desc']);
				break;
			case 'upload':
				echo '<input type="text" class="ecpt_upload_field" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : '', '" size="30" style="width:80%" /><input class="ecpt_upload_image_button" type="button" value="Upload Image" /><br/>', '', stripslashes($field['desc']);
				break;
			case 'textarea':

				if($field['rich_editor'] == 1) {
					if($wp_version >= 3.3) {
						echo wp_editor($meta, $field['id'], array('textarea_name' => $field['id']));
					} else {
						// older versions of WP
						$editor = '';
						if(!post_type_supports($post->post_type, 'editor')) {
							$editor = wp_tiny_mce(true, array('editor_selector' => $field['class'], 'remove_linebreaks' => false) );
						}
						$field_html = '<div style="width: 97%; border: 1px solid #DFDFDF;"><textarea name="' . $field['id'] . '" class="' . $field['class'] . '" id="' . $field['id'] . '" cols="60" rows="8" style="width:100%">'. $meta . '</textarea></div><br/>' . __(stripslashes($field['desc']));
						echo $editor . $field_html;
					}
				} else {
					echo '<div style="width: 100%;"><textarea name="', $field['id'], '" class="', $field['class'], '" id="', $field['id'], '" cols="60" rows="8" style="width:97%">', $meta ? $meta : '', '</textarea></div>', '', stripslashes($field['desc']);
				}

				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option value="' . $option . '"', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>', '', stripslashes($field['desc']);
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option, '"', $meta == $option ? ' checked="checked"' : '', ' /> ', $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'multicheck':
				if( ! is_array( $meta ) ) {
					$meta = array();
				}
				foreach ($field['options'] as $option) {
					echo '<input type="checkbox" name="' . $field['id'] . '[' . $option . ']" value="' . $option . '"' . checked( true, in_array( $option, $meta ), false ) . '/> ' . $option;
				}
				echo '<br/>' . stripslashes($field['desc']);
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' /> ';
				echo stripslashes($field['desc']);
				break;
			case 'slider':
				echo '<input type="text" rel="' . $field['max'] . '" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="1" style="float: left; margin-right: 5px" />';
				echo '<div class="ecpt-slider" rel="' . $field['id'] . '" style="float: left; width: 60%; margin: 5px 0 0 0;"></div>';
				echo '<div style="width: 100%; clear: both;">' . stripslashes($field['desc']) . '</div>';
				break;
			case 'repeatable' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:90%" />';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_wrapper"><input type="text" class="ecpt_repeatable_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:90%" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;

			case 'repeatable upload' :

				$field_html = '<input type="hidden" id="' . $field['id'] . '" class="ecpt_repeatable_upload_field_name" value=""/>';
				if(is_array($meta)) {
					$count = 1;
					foreach($meta as $key => $value) {
						$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta[$key] . '" size="30" style="width:80%" /><button class="button-secondary ecpt_upload_image_button">Upload File</button>';
						if($count > 1) {
							$field_html .= '<a href="#" class="ecpt_remove_repeatable button-secondary">x</a><br/>';
						}
						$field_html .= '</div>';
						$count++;
					}
				} else {
					$field_html .= '<div class="ecpt_repeatable_upload_wrapper"><input type="text" class="ecpt_repeatable_upload_field ecpt_upload_field" name="' . $field['id'] . '[]" id="' . $field['id'] . '[]" value="' . $meta . '" size="30" style="width:80%" /><input class="button-secondary ecpt_upload_image_button" type="button" value="Upload File" /></div>';
				}
				$field_html .= '<button class="ecpt_add_new_upload_field button-secondary">' . __('Add New', 'ecpt') . '</button>  ' . __(stripslashes($field['desc']));

				echo $field_html;

				break;
		}
		echo     '<td>',
			'</tr>';
	}

	echo '</table>';
}

// Save data from meta box
add_action('save_post', 'ecpt_paymentdetails_11_save');
function ecpt_paymentdetails_11_save($post_id) {
	global $post;
	global $paymentdetails_11_metabox;

	// verify nonce
	if ( ! isset( $_POST['ecpt_paymentdetails_11_meta_box_nonce'] ) || ! wp_verify_nonce($_POST['ecpt_paymentdetails_11_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	foreach ($paymentdetails_11_metabox['fields'] as $field) {

		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];

		if ($new && $new != $old) {
			if($field['type'] == 'date') {
				$new = ecpt_format_date($new);
				update_post_meta($post_id, $field['id'], $new);
			} else {
				if(is_string($new)) {
					$new = $new;
				}
				update_post_meta($post_id, $field['id'], $new);


			}
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}


function ecpt_export_ui_scripts() {

	global $ecpt_options, $post;
	?>
	<script type="text/javascript">
			jQuery(document).ready(function($)
			{

				if($('.form-table .ecpt_upload_field').length > 0 ) {
					// Media Uploader
					window.formfield = '';

					$('body').on('click', '.ecpt_upload_image_button', function() {
					window.formfield = $('.ecpt_upload_field',$(this).parent());
						tb_show('', 'media-upload.php?type=file&post_id=<?php echo $post->ID; ?>&TB_iframe=true');
										return false;
						});

						window.original_send_to_editor = window.send_to_editor;
						window.send_to_editor = function(html) {
							if (window.formfield) {
								imgurl = $('a','<div>'+html+'</div>').attr('href');
								window.formfield.val(imgurl);
								tb_remove();
							}
							else {
								window.original_send_to_editor(html);
							}
							window.formfield = '';
							window.imagefield = false;
						}
				}
				if($('.form-table .ecpt-slider').length > 0 ) {
					$('.ecpt-slider').each(function(){
						var $this = $(this);
						var id = $this.attr('rel');
						var val = $('#' + id).val();
						var max = $('#' + id).attr('rel');
						max = parseInt(max);
						//var step = $('#' + id).closest('input').attr('rel');
						$this.slider({
							value: val,
							max: max,
							step: 1,
							slide: function(event, ui) {
								$('#' + id).val(ui.value);
							}
						});
					});
				}

				if($('.form-table .ecpt_datepicker').length > 0 ) {
					var dateFormat = 'mm/dd/yy';
					$('.ecpt_datepicker').datepicker({dateFormat: dateFormat});
				}

				// add new repeatable field
				$(".ecpt_add_new_field").on('click', function() {
					var field = $(this).closest('td').find("div.ecpt_repeatable_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_wrapper:last');
					// set the new field val to blank
					$('input', field).val("");
					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// add new repeatable upload field
				$(".ecpt_add_new_upload_field").on('click', function() {
					var container = $(this).closest('tr');
					var field = $(this).closest('td').find("div.ecpt_repeatable_upload_wrapper:last").clone(true);
					var fieldLocation = $(this).closest('td').find('div.ecpt_repeatable_upload_wrapper:last');
					// set the new field val to blank
					$('input[type="text"]', field).val("");

					field.insertAfter(fieldLocation, $(this).closest('td'));

					return false;
				});

				// remove repeatable field
				$('.ecpt_remove_repeatable').on('click', function(e) {
					e.preventDefault();
					var field = $(this).parent();
					$('input', field).val("");
					field.remove();
					return false;
				});

			});
	  </script>
	<?php
}

function ecpt_export_datepicker_ui_scripts() {
	global $ecpt_base_dir;
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}
function ecpt_export_datepicker_ui_styles() {
	global $ecpt_base_dir;
	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css', false, '1.8', 'all');
}

// these are for newest versions of WP
add_action('admin_print_scripts-post.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-edit.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_scripts-post-new.php', 'ecpt_export_datepicker_ui_scripts');
add_action('admin_print_styles-post.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-edit.php', 'ecpt_export_datepicker_ui_styles');
add_action('admin_print_styles-post-new.php', 'ecpt_export_datepicker_ui_styles');

if ((isset($_GET['post']) && (isset($_GET['action']) && $_GET['action'] == 'edit') ) || (strstr($_SERVER['REQUEST_URI'], 'wp-admin/post-new.php')))
{
	add_action('admin_head', 'ecpt_export_ui_scripts');
}

// converts a time stamp to date string for meta fields
if(!function_exists('ecpt_timestamp_to_date')) {
	function ecpt_timestamp_to_date($date) {

		return date('m/d/Y', $date);
	}
}
if(!function_exists('ecpt_format_date')) {
	function ecpt_format_date($date) {

		$date = strtotime($date);

		return $date;
	}
}