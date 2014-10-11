<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package custody-agreements
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function custody_agreements_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'custody_agreements_jetpack_setup' );
