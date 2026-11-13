<?php
/**
 * Theme setup (Rules 13, 14, 18).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme supports and text domain.
 *
 * @return void
 */
function bdy_setup() {
	load_child_theme_textdomain( 'bdyculture', THEME_DIR . '/languages' );

	register_nav_menus( bdy_menu_locations() );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 300,
			'width'       => 520,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Editor styles so WYSIWYG content keeps the front-end type scale.
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/main.css' );
}
add_action( 'after_setup_theme', 'bdy_setup' );

/**
 * Content width (used by oEmbeds).
 *
 * @return void
 */
function bdy_content_width() {
	$GLOBALS['content_width'] = 1440;
}
add_action( 'after_setup_theme', 'bdy_content_width', 0 );

/**
 * Body classes used by the design (no-js fallback for reveal animations).
 *
 * @param array $classes Existing classes.
 * @return array
 */
function bdy_body_classes( $classes ) {
	$classes[] = 'bdy';

	if ( is_front_page() ) {
		$classes[] = 'is-front-page';
	}

	return $classes;
}
add_filter( 'body_class', 'bdy_body_classes' );

/**
 * The design's reveal animations depend on JS. This class is removed by
 * main.js as soon as it runs, and CSS shows everything when JS is off.
 *
 * @return void
 */
function bdy_no_js_class() {
	// Printed inline so it is applied before first paint.
	echo "<script>document.documentElement.classList.remove('no-js');document.documentElement.classList.add('js');</script>\n";
}
add_action( 'wp_head', 'bdy_no_js_class', 1 );

