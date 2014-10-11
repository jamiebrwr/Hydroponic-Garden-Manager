<?php

/* displays a custom name menu
** @param $field_id string - the name of the ECPT field to retrieve the menu name from
*/
function ecpt_nav_menu($field_id) {

	global $post;
	global $ecpt_prefix;

	$menu_name = get_post_meta($post->ID, $ecpt_prefix . $field_id, true);
	if($menu_name && $menu_name != '')
		return wp_nav_menu( array( 'menu' => $menu_name, 'echo' => false ) );

	return;
}

// registers the "ecpt_menu" short code
function ecpt_nav_menu_shortcode($atts, $content = null) {
	extract( shortcode_atts( array(
			'id' => ''
		), $atts )
	);
	if($id != '')
		return ecpt_nav_menu($id);
	return;
}
add_shortcode('ecpt_menu', 'ecpt_nav_menu_shortcode');

/* display taxonomy term list
** @param $id string - the name of the ECPT field to retrieve the tax name from
** @param $attached bool - true/false - if true, the function will return a list of terms attached to the current post
*/
function ecpt_taxonomy_terms($id = '', $attached = 'true') {

	global $post;
	global $ecpt_prefix;

	$tax_name = get_post_meta($post->ID, $ecpt_prefix . $id, true);

	if($attached == 'true') {
		$terms = get_the_terms($post->ID, $tax_name);
		if($terms) {
			$term_list = '<ul class="ecpt_terms_list">';
			foreach($terms as $t) {
				$term_list .= '<li><a href="' . get_term_link($t, $tax_name) . '">' . $t->name . '</a></li>';
			}
			$term_list .= '</ul>';
		}
	} else {
		$terms = get_terms($tax_name);
		if($terms) {
			$term_list = '<ul class="ecpt_terms_list">';
			foreach($terms as $t) {
				$term_list .= '<li><a href="' . get_term_link($t, $tax_name) . '">' . $t->name . '</a></li>';
			}
			$term_list .= '</ul>';
		}
	}

	return $term_list;
}

// registers the "ecpt_taxonomy" shortcode
function ecpt_taxonomy_shortcode($atts, $content = null) {
	extract( shortcode_atts( array(
			'id' => '',
			'attached' => 'true'
		), $atts )
	);

	return ecpt_taxonomy_terms($id, $attached);

}
add_shortcode('ecpt_taxonomy', 'ecpt_taxonomy_shortcode');

function ecpt_display_map( $atts, $content = null ) {

	global $ecpt_prefix;

	$atts = shortcode_atts(
		array(
			'id'        => '',
			'width' 	=> '100%',
			'height' 	=> '400px'
		),
		$atts
	);

	$address = get_post_meta( get_the_ID(), $ecpt_prefix . $atts['id'], true );

	if( $address ) :

		wp_print_scripts( 'google-maps-api' );

		$coordinates = ecpt_map_get_coordinates( $address );

		if( !is_array( $coordinates ) )
			return;

		$map_id = uniqid( 'ecpt_map_' ); // generate a unique ID for this map

		ob_start(); ?>
		<div class="ecpt_map_canvas" id="<?php echo esc_attr( $map_id ); ?>" style="height: <?php echo esc_attr( $atts['height'] ); ?>; width: <?php echo esc_attr( $atts['width'] ); ?>"></div>
	    <script type="text/javascript">
			var map_<?php echo $map_id; ?>;
			function ecpt_run_map_<?php echo $map_id ; ?>(){
				var location = new google.maps.LatLng("<?php echo $coordinates['lat']; ?>", "<?php echo $coordinates['lng']; ?>");
				var map_options = {
					zoom: 15,
					center: location,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				map_<?php echo $map_id ; ?> = new google.maps.Map(document.getElementById("<?php echo $map_id ; ?>"), map_options);
				var marker = new google.maps.Marker({
				position: location,
				map: map_<?php echo $map_id ; ?>
				});
			}
			ecpt_run_map_<?php echo $map_id ; ?>();
		</script>
		<?php
	endif;
	return ob_get_clean();
}
add_shortcode('ecpt_map', 'ecpt_display_map');


// changes the shortcode displayed in the Meta Fields Edit page for the new field types
function ecpt_nav_menu_shortcode_filter($field, $shortcode) {
	if($field->type == 'menu') {
		$shortcode = '[ecpt_menu id="' . $field->name . '"]';
	} elseif($field->type == 'taxonomy') {
		$shortcode = '[ecpt_taxonomy id="' . $field->name . '" attached="true"]';
	} elseif($field->type == 'map') {
		$shortcode = '[ecpt_map id="' . $field->name . '"]';
	}
	return $shortcode;
}
add_filter('ecpt_field_shortcode', 'ecpt_nav_menu_shortcode_filter', 10, 2);