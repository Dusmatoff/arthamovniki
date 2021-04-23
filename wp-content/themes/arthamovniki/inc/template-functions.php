<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Art_Hamovniki
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function arthamovniki_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter( 'body_class', 'arthamovniki_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function arthamovniki_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}

add_action( 'wp_head', 'arthamovniki_pingback_header' );


/****************************************************
 * Theme Settings
 *****************************************************/
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
		'page_title' => 'Настройки сайта',
		'menu_title' => 'Настройки сайта',
		'menu_slug'  => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect'   => false
	] );
}
/****************************************************
 * Theme Settings
 *****************************************************/

add_filter( 'nav_menu_css_class', 'hamovniki_menu_item_class', 10, 2 );

function hamovniki_menu_item_class( $classes, $item ) {
	$classes[] = 'footer__nav-item';

	return $classes;
}
