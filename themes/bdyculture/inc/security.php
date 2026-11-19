<?php
/**
 * WordPress hardening (Rule 17).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove the WordPress version generator tag.
 *
 * @return void
 */
function bdy_remove_generator() {
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'bdy_remove_generator' );

/**
 * Also hide the version from feeds and the HTTP header.
 *
 * @param string $generator Current generator string.
 * @return string
 */
function bdy_filter_generator( $generator ) {
	return '';
}
add_filter( 'the_generator', 'bdy_filter_generator' );

/**
 * Disable XML-RPC (not used by this site).
 *
 * @return bool
 */
function bdy_disable_xmlrpc() {
	return false;
}
add_filter( 'xmlrpc_enabled', 'bdy_disable_xmlrpc' );

/**
 * Stop anonymous REST API user enumeration.
 *
 * @param array $endpoints REST endpoints.
 * @return array
 */
function bdy_rest_user_enumeration( $endpoints ) {
	if ( is_user_logged_in() ) {
		return $endpoints;
	}

	unset( $endpoints['/wp/v2/users'] );
	unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );

	return $endpoints;
}
add_filter( 'rest_endpoints', 'bdy_rest_user_enumeration' );

/**
 * Baseline security headers.
 *
 * @return void
 */
function bdy_security_headers() {
	if ( headers_sent() ) {
		return;
	}

	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: geolocation=(), microphone=(), camera=()' );
}
add_action( 'send_headers', 'bdy_security_headers' );

/**
 * Remove the version query string from theme assets for cleaner URLs.
 * (Kept because THEME_VERSION is already appended explicitly.)
 *
 * @param string $src Asset URL.
 * @return string
 */
function bdy_remove_version_query( $src ) {
	if ( false !== strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}
add_filter( 'style_loader_src', 'bdy_remove_version_query', 9999 );
add_filter( 'script_loader_src', 'bdy_remove_version_query', 9999 );
