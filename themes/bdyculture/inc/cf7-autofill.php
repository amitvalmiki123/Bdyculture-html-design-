<?php
/**
 * Contact Form 7 — fill the "which page" parts in by itself.
 *
 * One form is enough for the whole site. The theme adds a hidden
 * "sent from page" field to every Contact Form 7 form, drops that line into
 * the email automatically, and pre-selects an option when the page is about
 * that option (the Physiotherapy page opens with Physiotherapy chosen).
 *
 * Nothing here edits the form code: remove or re-add fields in the plugin and
 * the behaviour follows.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Title of the page the form is printed on.
 *
 * Cheap enough to call per form; a page holds at most two.
 *
 * @return string
 */
function bdy_form_source() {
	$source = '';

	if ( function_exists( 'is_admin' ) && is_admin() ) {
		return $source;
	}

	$id = function_exists( 'get_queried_object_id' ) ? (int) get_queried_object_id() : 0;

	if ( $id && function_exists( 'get_the_title' ) ) {
		$source = (string) get_the_title( $id );
	}

	if ( '' === $source && function_exists( 'get_the_title' ) ) {
		$source = (string) get_the_title();
	}

	if ( function_exists( 'wp_strip_all_tags' ) ) {
		$source = wp_strip_all_tags( $source );
	}

	$source = trim( $source );

	if ( '' === $source ) {
		$source = function_exists( 'get_bloginfo' ) ? (string) get_bloginfo( 'name' ) : '';
	}

	return $source;
}

/**
 * Add the hidden "sent from" field to every CF7 form.
 *
 * @param array $fields Hidden name => value pairs.
 * @return array
 */
function bdy_cf7_hidden_source( $fields ) {
	if ( ! is_array( $fields ) ) {
		return $fields;
	}

	$source = bdy_form_source();

	if ( '' !== $source ) {
		$fields['_bdy_source'] = $source;
	}

	return $fields;
}
add_filter( 'wpcf7_form_hidden_fields', 'bdy_cf7_hidden_source' );

/**
 * Pre-select a dropdown option that matches the page.
 *
 * A page called "Physiotherapy" opens the interest select on "Physiotherapy".
 * Forms that already choose a default (`default:…`) are left alone, and a page
 * that matches nothing (Contact, Referrers) keeps the neutral first option.
 *
 * @param object $tag CF7 form tag.
 * @return object
 */
function bdy_cf7_preselect_option( $tag ) {
	if ( ! is_object( $tag ) || empty( $tag->type ) || 'select' !== (string) $tag->type ) {
		return $tag;
	}

	$source = bdy_form_source();

	if ( '' === $source || empty( $tag->values ) || ! is_array( $tag->values ) ) {
		return $tag;
	}

	if ( ! isset( $tag->options ) || ! is_array( $tag->options ) ) {
		$tag->options = array();
	}

	// The form author already picked one — respect it.
	foreach ( $tag->options as $option ) {
		if ( 0 === stripos( ltrim( (string) $option ), 'default:' ) ) {
			return $tag;
		}
	}

	foreach ( $tag->values as $value ) {
		$value = trim( (string) $value );

		if ( '' !== $value && 0 === strcasecmp( $value, $source ) ) {
			$tag->options[] = 'default:' . $value;
			break;
		}
	}

	return $tag;
}
add_filter( 'wpcf7_form_tag', 'bdy_cf7_preselect_option' );

/**
 * Stamp the email with the page the enquiry came from.
 *
 * Appended once, and skipped when the Mail tab already uses the field.
 *
 * @param array  $components Mail components (subject, body, …).
 * @param object $form       CF7 contact form.
 * @return array
 */
function bdy_cf7_mail_source( $components, $form = null ) {
	if ( ! is_array( $components ) || empty( $components['body'] ) ) {
		return $components;
	}

	$body = (string) $components['body'];

	if ( false !== strpos( $body, '_bdy_source' ) ) {
		return $components;
	}

	$components['body'] = rtrim( $body ) . "\n\nSent from page: [_bdy_source]";

	return $components;
}
add_filter( 'wpcf7_mail_components', 'bdy_cf7_mail_source', 20, 2 );
