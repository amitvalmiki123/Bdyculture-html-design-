<?php
/**
 * BDYCULTURE Parent — functions.php
 *
 * Rule 1: the parent theme stays minimal. Basic theme supports only.
 * No styling, no layout logic, no third-party dependency, no content.
 *
 * @package BDYCULTURE_Parent
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Basic theme supports.
 */
function bdyculture_parent_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
	);
}
add_action( 'after_setup_theme', 'bdyculture_parent_setup' );
