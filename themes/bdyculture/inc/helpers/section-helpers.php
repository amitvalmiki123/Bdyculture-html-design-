<?php
/**
 * Section engine — show / hide / reorder every section (Rule 4).
 *
 * Each section is a self-contained file in template-parts/sections/ that
 * fetches its own data (Rule 10). This engine only decides *whether* and *in
 * which order* the sections render.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Should this section render?
 *
 * @param string          $page    Page key ("home" | "page").
 * @param string          $slug    Section slug.
 * @param int|string|null $context ACF context (defaults to current page).
 * @return bool
 */
function bdy_show( $page, $slug, $context = null ) {
	$defaults = bdy_section_defaults( $page, $slug );
	$default  = isset( $defaults['show'] ) ? (bool) $defaults['show'] : true;

	return bdy_flag( $page . '_' . $slug . '_show', $default, $context );
}

/**
 * Sort order for a section (defaults to 10, 20, 30…).
 *
 * @param string          $page    Page key.
 * @param string          $slug    Section slug.
 * @param int|string|null $context ACF context.
 * @return int
 */
function bdy_order( $page, $slug, $context = null ) {
	$defaults = bdy_section_defaults( $page, $slug );
	$default  = isset( $defaults['order'] ) ? (int) $defaults['order'] : 10;

	return (int) bdy_number( $page . '_' . $slug . '_order', $default, $context );
}

/**
 * Ordered, filtered list of section slugs for a page.
 *
 * @param string          $page    Page key.
 * @param int|string|null $context ACF context.
 * @return array
 */
function bdy_sections( $page = 'home', $context = null ) {
	$defaults = bdy_defaults( $page );
	$queue    = array();

	foreach ( $defaults as $slug => $data ) {
		if ( ! bdy_show( $page, $slug, $context ) ) {
			continue;
		}

		$order = bdy_order( $page, $slug, $context );
		$queue[] = array(
			'slug'  => $slug,
			'order' => $order,
		);
	}

	usort(
		$queue,
		static function ( $a, $b ) {
			if ( $a['order'] === $b['order'] ) {
				return 0;
			}
			return ( $a['order'] < $b['order'] ) ? -1 : 1;
		}
	);

	return array_column( $queue, 'slug' );
}

/**
 * Ordered slugs of the shared bands that should render (contact, map).
 *
 * @param string $page Page key.
 * @return array
 */
function bdy_shared_bands( $page = 'page' ) {
	$queue = array();

	foreach ( array( 'contact', 'map' ) as $slug ) {
		if ( ! bdy_show( $page, $slug ) ) {
			continue;
		}

		$queue[] = array(
			'slug'  => $slug,
			'order' => bdy_order( $page, $slug ),
		);
	}

	usort(
		$queue,
		static function ( $a, $b ) {
			if ( $a['order'] === $b['order'] ) {
				return 0;
			}
			return ( $a['order'] < $b['order'] ) ? -1 : 1;
		}
	);

	return array_column( $queue, 'slug' );
}

/**
 * Render the shared bands (contact, map) for a page that has body blocks.
 *
 * Their copy lives in Theme Settings; the page only stores show/order.
 *
 * @param string $page Page key ("page" | "single").
 * @return void
 */
function bdy_render_shared_bands( $page = 'page' ) {
	foreach ( bdy_shared_bands( $page ) as $slug ) {
		get_template_part( 'template-parts/sections/' . $slug );
	}
}

/**
 * Render every enabled section for a page.
 *
 * @param string $page Page key.
 * @return void
 */
function bdy_render_sections( $page = 'home' ) {
	foreach ( bdy_sections( $page ) as $slug ) {
		$part = 'template-parts/sections/' . $page . '-' . $slug . '.php';

		// Shared bands (contact, map) ship once and are used by every page.
		if ( ! file_exists( get_stylesheet_directory() . '/' . $part ) && ! file_exists( get_template_directory() . '/' . $part ) ) {
			$part = 'template-parts/sections/' . $slug . '.php';
		}

		get_template_part( substr( $part, 0, -4 ) );
	}
}
