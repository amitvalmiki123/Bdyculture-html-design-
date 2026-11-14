<?php
/**
 * Asset loading (Rules 11, 18).
 *
 * - Desktop/base styles in main.css, media queries only in responsive.css.
 * - Fonts use display=swap.
 * - JS is deferred and loaded in the footer.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Front-end styles and scripts.
 *
 * @return void
 */
function bdy_enqueue_assets() {
	wp_enqueue_style(
		'bdyculture-fonts',
		'https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Host+Grotesk:wght@400;500;600;700;800&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'bdyculture-main', THEME_URI . '/assets/css/main.css', array(), THEME_VERSION );
	wp_enqueue_style( 'bdyculture-responsive', THEME_URI . '/assets/css/responsive.css', array( 'bdyculture-main' ), THEME_VERSION );

	wp_enqueue_script(
		'bdyculture-main',
		THEME_URI . '/assets/js/main.js',
		array(),
		THEME_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	wp_localize_script( 'bdyculture-main', 'bdyTheme', bdy_script_data() );
}
add_action( 'wp_enqueue_scripts', 'bdy_enqueue_assets' );

/**
 * Data handed to main.js.
 *
 * @return array
 */
function bdy_script_data() {
	$defaults = bdy_defaults( 'global' );

	return array(
		'map'     => array(
			'center'   => array(
				(float) bdy_number( 'map_lat', (float) $defaults['map_lat'], 'option' ),
				(float) bdy_number( 'map_lng', (float) $defaults['map_lng'], 'option' ),
			),
			'zoom'     => (int) bdy_number( 'map_zoom', (int) $defaults['map_zoom'], 'option' ),
			'title'    => wp_strip_all_tags( bdy_string( 'map_card_title', $defaults['map_card_title'], 'option' ) . ' – ' . bdy_address_1() ),
			'street'   => 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}',
			'satellite' => 'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
			'leafletCss' => 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css',
			'leafletJs'  => 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js',
			'unavailable' => __( 'Map unavailable offline — use “Get directions”.', 'bdyculture' ),
			'embedUrl'  => 'https://www.google.com/maps?q=' . rawurlencode( bdy_address_1() . ', ' . bdy_address_2() ) . '&output=embed',
		),
		'labels'  => array(
			'openMenu'  => __( 'Open menu', 'bdyculture' ),
			'closeMenu' => __( 'Close menu', 'bdyculture' ),
			'street'    => __( 'Street', 'bdyculture' ),
			'satellite' => __( 'Satellite', 'bdyculture' ),
			'mapRegion' => __( 'Interactive map of BDYCULTURE, Chermside', 'bdyculture' ),
		),
	);
}

/**
 * Preconnect to the font hosts (Rule 18).
 *
 * @param array  $urls          Resource hint URLs.
 * @param string $relation_type Relation type.
 * @return array
 */
function bdy_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
		$urls[] = 'https://fonts.googleapis.com';
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'bdy_resource_hints', 10, 2 );

/**
 * Customizer live-preview script (Rule 19).
 *
 * @return void
 */
function bdy_customize_preview_js() {
	wp_enqueue_script(
		'bdyculture-customizer-preview',
		THEME_URI . '/assets/js/customizer-preview.js',
		array( 'customize-preview' ),
		THEME_VERSION,
		true
	);

	wp_localize_script( 'bdyculture-customizer-preview', 'bdyCustomizer', array( 'settings' => bdy_customizer_preview_map() ) );
}
add_action( 'customize_preview_init', 'bdy_customize_preview_js' );
