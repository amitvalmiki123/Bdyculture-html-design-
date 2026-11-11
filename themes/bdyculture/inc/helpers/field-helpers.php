<?php
/**
 * Field helpers — the ACF ⇄ defaults.php bridge (Rules 2, 3, 16).
 *
 * Contract:
 *   - Field saved in the database → use it, even when it is empty
 *     (that is how "empty fields output nothing" stays possible).
 *   - Field never saved → fall back to defaults.php, so the site renders
 *     identically with zero ACF data entered.
 *   - ACF not installed → always fall back to defaults.php (no fatal errors).
 *
 * Every getter returns raw data; the *printers* escape for the target context.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Is ACF (with the functions we need) available?
 *
 * @return bool
 */
function bdy_acf_active() {
	return function_exists( 'get_field' ) && function_exists( 'acf_add_local_field_group' );
}

/**
 * Resolve the current post ID used for ACF lookups.
 *
 * @param int|string|null $context Optional explicit post ID or 'option'.
 * @return int|string
 */
function bdy_context( $context = null ) {
	if ( 'option' === $context ) {
		return 'option';
	}
	if ( is_numeric( $context ) && (int) $context > 0 ) {
		return (int) $context;
	}

	$id = get_queried_object_id();
	if ( ! $id ) {
		$id = get_the_ID();
	}
	if ( ! $id && is_front_page() ) {
		$id = (int) get_option( 'page_on_front' );
	}

	return $id ? (int) $id : 0;
}

/**
 * Has this exact field ever been saved?
 *
 * @param string          $selector Field name.
 * @param int|string|null $context  Post ID, 'option' or null for current page.
 * @return bool
 */
function bdy_is_set( $selector, $context = null ) {
	if ( ! bdy_acf_active() ) {
		return false;
	}

	if ( 'option' === bdy_context( $context ) ) {
		$missing = '__bdy_missing__';

		// ACF stores options-page values as their own option name. Some
		// setups prefix with "options_"; support both.
		if ( $missing !== get_option( $selector, $missing ) ) {
			return true;
		}
		return $missing !== get_option( 'options_' . $selector, $missing );
	}

	$id = bdy_context( $context );
	if ( ! $id ) {
		return false;
	}

	return metadata_exists( 'post', $id, $selector );
}

/**
 * Read an ACF value with a defaults.php fallback.
 *
 * Returns null when neither ACF nor a default exists.
 *
 * @param string          $selector Field name.
 * @param mixed           $default  Fallback value.
 * @param int|string|null $context  Post ID, 'option' or null for current page.
 * @return mixed
 */
function bdy_get( $selector, $default = null, $context = null ) {
	if ( ! bdy_is_set( $selector, $context ) ) {
		return $default;
	}

	$value = get_field( $selector, bdy_context( $context ) );

	return null === $value ? '' : $value;
}

/**
 * Read an ACF Options-page value with a defaults.php fallback.
 *
 * @param string $selector Field name.
 * @param mixed  $default  Fallback value.
 * @return mixed
 */
function bdy_option( $selector, $default = null ) {
	return bdy_get( $selector, $default, 'option' );
}

/**
 * Read a repeater with defaults.
 *
 * A saved-but-empty repeater returns an empty array (the client removed all
 * rows), which is different from "never saved" (defaults are shown).
 *
 * @param string          $selector     Field name.
 * @param array           $default_rows Fallback rows.
 * @param int|string|null $context      Post ID, 'option' or null.
 * @return array
 */
function bdy_rows( $selector, $default_rows = array(), $context = null ) {
	$value = bdy_get( $selector, null, $context );

	if ( null === $value ) {
		return is_array( $default_rows ) ? $default_rows : array();
	}

	return is_array( $value ) ? array_values( $value ) : array();
}

/**
 * Scalar string from a field.
 *
 * @param string          $selector Field name.
 * @param string          $default  Fallback.
 * @param int|string|null $context  Context.
 * @return string
 */
function bdy_string( $selector, $default = '', $context = null ) {
	$value = bdy_get( $selector, $default, $context );

	if ( is_scalar( $value ) ) {
		return (string) $value;
	}

	return '';
}

/**
 * Escaped plain text (Rule 16).
 *
 * @param string          $selector Field name.
 * @param string          $default  Fallback.
 * @param int|string|null $context  Context.
 * @return string
 */
function bdy_text( $selector, $default = '', $context = null ) {
	return bdy_tokens( esc_html( bdy_string( $selector, $default, $context ) ) );
}

/**
 * Escaped HTML for textarea fields (Rule 16) — allows <br>, <strong>, <em>,
 * <a>, <span>, <ul>, <li>, <p> via wp_kses_post.
 *
 * Also expands {phone}, {phone_link}, {email}, {referrals_email} tokens from
 * Site Settings so the clinic details stay in one place.
 *
 * @param string          $selector Field name.
 * @param string          $default  Fallback.
 * @param int|string|null $context  Context.
 * @return string
 */
function bdy_html( $selector, $default = '', $context = null ) {
	$value = bdy_get( $selector, $default, $context );

	if ( is_array( $value ) ) {
		return '';
	}

	return bdy_tokens( wp_kses_post( (string) $value ) );
}

/**
 * Escaped attribute value (Rule 16).
 *
 * @param string          $selector Field name.
 * @param string          $default  Fallback.
 * @param int|string|null $context  Context.
 * @return string
 */
function bdy_attr( $selector, $default = '', $context = null ) {
	return esc_attr( bdy_string( $selector, $default, $context ) );
}

/**
 * Escaped URL (Rule 16). Site-relative paths are resolved to home_url().
 *
 * @param string          $selector Field name.
 * @param string          $default  Fallback.
 * @param int|string|null $context  Context.
 * @return string
 */
function bdy_url( $selector, $default = '', $context = null ) {
	return esc_url( bdy_link( bdy_string( $selector, $default, $context ) ) );
}

/**
 * Boolean flag from a true_false field.
 *
 * @param string          $selector Field name.
 * @param bool            $default  Fallback.
 * @param int|string|null $context  Context.
 * @return bool
 */
function bdy_flag( $selector, $default = false, $context = null ) {
	$value = bdy_get( $selector, null, $context );

	if ( null === $value ) {
		return (bool) $default;
	}

	return (bool) $value;
}

/**
 * Number from a number/text field.
 *
 * @param string          $selector Field name.
 * @param float           $default  Fallback.
 * @param int|string|null $context  Context.
 * @return float
 */
function bdy_number( $selector, $default = 0, $context = null ) {
	$value = bdy_get( $selector, $default, $context );

	if ( is_numeric( $value ) ) {
		return (float) $value;
	}

	return (float) $default;
}

/**
 * Value constrained to a whitelist (used for style/icon selects).
 *
 * @param string          $selector Field name.
 * @param string          $default  Fallback.
 * @param array           $allowed  Allowed values.
 * @param int|string|null $context  Context.
 * @return string
 */
function bdy_choice( $selector, $default = '', $allowed = array(), $context = null ) {
	$value = bdy_string( $selector, $default, $context );

	if ( ! empty( $allowed ) && ! in_array( $value, $allowed, true ) ) {
		return (string) $default;
	}

	return $value;
}

/**
 * Defaults for one section.
 *
 * @param string $page Page key ("home" | "global" | "page").
 * @param string $slug Section slug.
 * @return array
 */
function bdy_section_defaults( $page, $slug ) {
	$defaults = bdy_defaults( $page );

	return isset( $defaults[ $slug ] ) ? $defaults[ $slug ] : array();
}
