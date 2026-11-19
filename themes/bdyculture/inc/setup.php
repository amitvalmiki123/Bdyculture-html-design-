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

/**
 * Contact Form 7 — keep the form template exactly as typed.
 *
 * The form code shipped in docs/cf7-contact-form.txt is written with the
 * design's own classes and markup. CF7's automatic <p>/<br> insertion would
 * break that layout, so it is switched off (it only affects the theme's forms).
 *
 * @return bool
 */
function bdy_cf7_autop() {
	return false;
}
add_filter( 'wpcf7_autop_or_not', 'bdy_cf7_autop' );

/**
 * Keep uploaded photos at full resolution.
 *
 * WordPress scales any upload wider than 2560 px down and stores that file as
 * the "full" size. The design's photo frames zoom into an image (a CSS scale
 * does not change layout), so a 2560 px cap becomes the sharpness ceiling: the
 * browser has no bigger file to pick. Returning false keeps the original and
 * lets the zoomed frame stay sharp on retina screens.
 *
 * @return false
 */
function bdy_keep_full_uploads() {
	return false;
}
add_filter( 'big_image_size_threshold', 'bdy_keep_full_uploads' );
