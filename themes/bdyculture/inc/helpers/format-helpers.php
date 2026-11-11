<?php
/**
 * Formatting helpers — links, buttons, tokens, forms (Rules 12, 16).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve a link value.
 *
 * - "tel" or "tel:..." → the clinic phone number from Site Settings
 * - "mailto"           → the general enquiries email
 * - "/path/"           → home_url( '/path/' )
 * - "#anchor"          → unchanged
 * - absolute URL       → unchanged
 *
 * @param string $value Raw link value.
 * @return string
 */
function bdy_link( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}

	if ( 'tel' === $value ) {
		return 'tel:' . bdy_phone_number();
	}

	if ( 'mailto' === $value ) {
		return 'mailto:' . bdy_clinic_email();
	}

	if ( 0 === strpos( $value, '#' ) ) {
		return $value;
	}

	if ( 0 === strpos( $value, '/' ) && 0 !== strpos( $value, '//' ) ) {
		return home_url( $value );
	}

	return $value;
}

/**
 * Is this link the page currently being viewed?
 *
 * @param string $value Raw link value.
 * @return bool
 */
function bdy_is_current( $value ) {
	$url = bdy_link( $value );

	if ( ! $url ) {
		return false;
	}

	$current = home_url( '/' );

	if ( isset( $GLOBALS['wp'] ) && is_object( $GLOBALS['wp'] ) && isset( $GLOBALS['wp']->request ) ) {
		$request = trim( (string) $GLOBALS['wp']->request, '/' );
		$current = $request ? home_url( '/' . $request . '/' ) : home_url( '/' );
	}

	return untrailingslashit( $url ) === untrailingslashit( $current );
}

/**
 * Clinic phone number in tel: format.
 *
 * @return string
 */
function bdy_phone_number() {
	$global = bdy_defaults( 'global' );
	$number = bdy_option( 'clinic_phone_tel', $global['clinic_phone_tel'] );

	return preg_replace( '/[^0-9+]/', '', (string) $number );
}

/**
 * Clinic phone as displayed.
 *
 * @return string
 */
function bdy_phone_display() {
	$global = bdy_defaults( 'global' );

	return bdy_text( 'clinic_phone_display', $global['clinic_phone_display'], 'option' );
}

/**
 * Clinic phone link markup.
 *
 * @return string
 */
function bdy_phone_link() {
	$display = bdy_phone_display();

	if ( '' === $display ) {
		return '';
	}

	return '<a href="' . esc_url( 'tel:' . bdy_phone_number() ) . '">' . $display . '</a>';
}

/**
 * General enquiries email.
 *
 * @return string
 */
function bdy_clinic_email() {
	$global = bdy_defaults( 'global' );

	return (string) bdy_option( 'clinic_email', $global['clinic_email'] );
}

/**
 * Referrals email.
 *
 * @return string
 */
function bdy_referrals_email() {
	$global = bdy_defaults( 'global' );

	return (string) bdy_option( 'clinic_email_referrals', $global['clinic_email_referrals'] );
}

/**
 * Address line 1.
 *
 * @return string
 */
function bdy_address_1() {
	$global = bdy_defaults( 'global' );

	return (string) bdy_option( 'clinic_address_1', $global['clinic_address_1'] );
}

/**
 * Address line 2.
 *
 * @return string
 */
function bdy_address_2() {
	$global = bdy_defaults( 'global' );

	return (string) bdy_option( 'clinic_address_2', $global['clinic_address_2'] );
}

/**
 * Booking URL (Nookal).
 *
 * @return string
 */
function bdy_booking_url() {
	$global = bdy_defaults( 'global' );

	return (string) bdy_option( 'clinic_booking_url', $global['clinic_booking_url'] );
}

/**
 * Directions URL.
 *
 * @return string
 */
function bdy_directions_url() {
	$global = bdy_defaults( 'global' );

	return (string) bdy_option( 'clinic_directions_url', $global['clinic_directions_url'] );
}

/**
 * Replace content tokens with clinic details (single source of truth).
 *
 * @param string $html Escaped HTML.
 * @return string
 */
function bdy_tokens( $html ) {
	if ( '' === $html || false === strpos( $html, '{' ) ) {
		return $html;
	}

	$email           = bdy_clinic_email();
	$referrals_email = bdy_referrals_email();

	$replace = array(
		'{phone_link}'           => bdy_phone_link(),
		'{phone}'                => bdy_phone_display(),
		'{email_link}'           => $email ? '<a href="' . esc_url( 'mailto:' . $email ) . '">' . esc_html( $email ) . '</a>' : '',
		'{email}'                => esc_html( $email ),
		'{referrals_email_link}' => $referrals_email ? '<a href="' . esc_url( 'mailto:' . $referrals_email ) . '">' . esc_html( $referrals_email ) . '</a>' : '',
		'{referrals_email}'      => esc_html( $referrals_email ),
	);

	return strtr( $html, $replace );
}

/**
 * Build a button.
 *
 * Styles are whitelisted so an ACF select can never emit a stray class
 * (Rule 5 — strict BEM modifiers).
 *
 * @param string $text  Button label (plain text).
 * @param string $url   Link value (see bdy_link()).
 * @param string $style signal | ink | ghost | light | outline-light | call.
 * @param array  $args  size, block, icon, new_tab, class, attr.
 * @return string
 */
function bdy_button( $text, $url, $style = 'signal', $args = array() ) {
	$text = trim( (string) $text );
	if ( '' === $text ) {
		return '';
	}

	$args = wp_parse_args(
		$args,
		array(
			'size'    => '',
			'block'   => false,
			'icon'    => '',
			'new_tab' => false,
			'class'   => '',
			'attr'    => '',
			'icon_size' => 18,
		)
	);

	$allowed_styles = array( 'signal', 'ink', 'ghost', 'light', 'outline-light', 'call' );
	$style          = in_array( $style, $allowed_styles, true ) ? $style : 'signal';

	$classes = array( 'btn', 'btn--' . $style );

	if ( $args['size'] ) {
		$classes[] = 'btn--' . sanitize_html_class( $args['size'] );
	}
	if ( $args['block'] ) {
		$classes[] = 'btn--block';
	}
	if ( $args['class'] ) {
		$classes[] = sanitize_html_class( $args['class'] );
	}

	$link = bdy_link( $url );

	$target = '';
	if ( $args['new_tab'] && $link ) {
		$target = ' target="_blank" rel="noopener"';
	}

	// The design puts the phone icon before the label and the arrow after it.
	$icon       = $args['icon'] ? bdy_icon( $args['icon'], array( 'size' => (int) $args['icon_size'] ) ) : '';
	$icon_after = ( 'arrow' === $args['icon'] );
	$label      = esc_html( $text );

	if ( $icon_after ) {
		$label .= $icon;
		$icon   = '';
	}

	$extra = '';
	if ( $args['attr'] ) {
		$extra = ' ' . $args['attr']; // phpcs:ignore WordPress.Security.EscapeOutput -- caller passes pre-escaped attributes.
	}

	return '<a class="' . esc_attr( implode( ' ', $classes ) ) . '" href="' . esc_url( $link ) . '"' . $target . $extra . '>'
		. $icon . $label . '</a>';
}

/**
 * Render a CF7 shortcode with a design-identical fallback form (Rule 12).
 *
 * @param string   $shortcode        Shortcode stored in ACF.
 * @param callable $fallback_render  Callback that prints the native form.
 * @return void
 */
function bdy_form( $shortcode, $fallback_render ) {
	$shortcode = trim( (string) $shortcode );

	if ( '' !== $shortcode && false !== strpos( $shortcode, '[' ) ) {
		echo '<div class="card-form__embed">' . do_shortcode( wp_kses_post( $shortcode ) ) . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- shortcode output.
		return;
	}

	if ( is_callable( $fallback_render ) ) {
		call_user_func( $fallback_render );
	}
}

/**
 * Phone SVG icon (used inline in a few spots in the design).
 *
 * @return string
 */
function bdy_phone_svg( $size = 18 ) {
	$size = (int) $size;

	return '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2a1 1 0 011-.25 11.4 11.4 0 003.6.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1z"/></svg>';
}
