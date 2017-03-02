<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package IH Photography
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function ih_photographer_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'ih_photographer_jetpack_setup' );
