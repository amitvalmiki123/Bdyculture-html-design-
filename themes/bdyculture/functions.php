<?php
/**
 * BDYCULTURE child theme — functions.php
 *
 * Rule 1: constants + require_once includes only. All behaviour lives in inc/.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme constants (Rule 1).
 */
if ( ! defined( 'THEME_VERSION' ) ) {
	$bdy_theme = wp_get_theme();
	define( 'THEME_VERSION', $bdy_theme->get( 'Version' ) ? $bdy_theme->get( 'Version' ) : '1.0.0' );
}
if ( ! defined( 'THEME_DIR' ) ) {
	define( 'THEME_DIR', get_stylesheet_directory() );
}
if ( ! defined( 'THEME_URI' ) ) {
	define( 'THEME_URI', get_stylesheet_directory_uri() );
}

/**
 * Fallback content — every original HTML string and image (Rule 3).
 */
require_once THEME_DIR . '/defaults.php';

/**
 * Helpers.
 */
require_once THEME_DIR . '/inc/helpers/field-helpers.php';
require_once THEME_DIR . '/inc/helpers/format-helpers.php';
require_once THEME_DIR . '/inc/helpers/icon-helpers.php';
require_once THEME_DIR . '/inc/helpers/image-helpers.php';
require_once THEME_DIR . '/inc/helpers/section-helpers.php';
require_once THEME_DIR . '/inc/helpers/menu-helpers.php';

/**
 * Core theme behaviour.
 */
require_once THEME_DIR . '/inc/setup.php';
require_once THEME_DIR . '/inc/enqueue.php';
require_once THEME_DIR . '/inc/security.php';
require_once THEME_DIR . '/inc/customizer.php';
require_once THEME_DIR . '/inc/schema.php';

/**
 * ACF field registration (one file per context, Rule 2).
 */
require_once THEME_DIR . '/inc/acf/builder.php';
require_once THEME_DIR . '/inc/acf/options.php';
require_once THEME_DIR . '/inc/acf/global-fields.php';
require_once THEME_DIR . '/inc/acf/home-fields.php';
require_once THEME_DIR . '/inc/acf/page-fields.php';
