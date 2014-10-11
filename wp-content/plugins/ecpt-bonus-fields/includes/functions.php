<?php


/**
 * Loads Google Map API
 *
 * @access      private
 * @since       1.1.6
 * @return      void
*/

function ecpt_map_load_scripts() {
	wp_register_script( 'google-maps-api', 'http://maps.google.com/maps/api/js?sensor=false' );
}
add_action( 'wp_enqueue_scripts', 'ecpt_map_load_scripts' );



/**
 * Retrieve coordinates for an address
 *
 * Coordinates are cached using transients and a hash of the address
 *
 * @access      private
 * @since       1.1.6
 * @return      void
*/

function ecpt_map_get_coordinates( $address, $force_refresh = false ) {

    $address_hash = md5( $address );

    $coordinates = get_transient( $address_hash );

    if ($force_refresh || $coordinates === false) {

    	$args       = array( 'address' => urlencode( $address ), 'sensor' => 'false' );
    	$url        = add_query_arg( $args, 'http://maps.googleapis.com/maps/api/geocode/json' );
     	$response 	= wp_remote_get( $url );

     	if( is_wp_error( $response ) )
     		return;

     	$data = wp_remote_retrieve_body( $response );

     	if( is_wp_error( $data ) )
     		return;

		if ( $response['response']['code'] == 200 ) {

			$data = json_decode( $data );
			if ( $data->status === 'OK' ) {

			  	$coordinates = $data->results[0]->geometry->location;

			  	$cache_value['lat'] 	= $coordinates->lat;
			  	$cache_value['lng'] 	= $coordinates->lng;
			  	$cache_value['address'] = (string) $data->results[0]->formatted_address;

			  	// cache coordinates for 3 months
			  	set_transient($address_hash, $cache_value, 3600*24*30*3);
			  	$data = $cache_value;

			} elseif ( $data->status === 'ZERO_RESULTS' ) {
			  	return __( 'No location found for the entered address.', 'pw-maps' );
			} elseif( $data->status === 'INVALID_REQUEST' ) {
			   	return __( 'Invalid request. Did you enter an address?', 'pw-maps' );
			} else {
				return __( 'Something went wrong while retrieving your map, please ensure you have entered the short code correctly.', 'pw-maps' );
			}

		} else {
		 	return __( 'Unable to contact Google API service.', 'pw-maps' );
		}

    } else {
       // return cached results
       $data = $coordinates;
    }

    return $data;
}


/**
 * Fixes a problem with responsive themes
 *
 * @access      private
 * @since       1.1.6
 * @return      void
*/

function ecpt_map_css() {
	echo '<style type="text/css">/* =Responsive Map fix
-------------------------------------------------------------- */
.ecpt_map_canvas img {
	max-width: none;
}</style>';

}
add_action( 'wp_head', 'ecpt_map_css' );