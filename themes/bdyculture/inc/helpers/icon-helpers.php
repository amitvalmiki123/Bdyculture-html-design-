<?php
/**
 * Icon helpers — the design's inline SVG set.
 *
 * Icons are chosen from an ACF select instead of free-text SVG so the markup
 * stays identical to the original design and no unsafe SVG can be injected
 * (Rule 17). All SVG is decorative: aria-hidden="true", with the label
 * supplied by the adjacent text.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Icon path library (24×24 grid, stroke based).
 *
 * @return array
 */
function bdy_icon_paths() {
	return array(
		'physiotherapy'        => '<path d="M3 12h4l2-6 4 12 2-6h6"/>',
		'exercise-physiology'  => '<path d="M3 9v6M6 7v10M18 7v10M21 9v6M6 12h12"/>',
		'occupational-therapy' => '<rect x="6" y="4" width="12" height="17" rx="2"/><path d="M9 4h6v3H9zM9.5 14.5l2 2 3.5-4"/>',
		'clinical-pilates'     => '<circle cx="12" cy="5" r="2"/><path d="M4 11.5h16M9 11.5l-2 8.5M15 11.5l2 8.5"/>',
		'search'               => '<circle cx="11" cy="11" r="6.5"/><path d="M16 16l5 5"/>',
		'heart'                => '<path d="M12 20s-7-4.5-7-10a4 4 0 017-2.6A4 4 0 0119 10c0 5.5-7 10-7 10z"/>',
		'trend'                => '<path d="M4 17l5-5 4 4 7-8"/><path d="M15 8h5v5"/>',
		'clipboard'            => '<rect x="5" y="4" width="14" height="17" rx="2"/><path d="M9 4h6v3H9zM8.5 12h7M8.5 16h4"/>',
		'calendar'             => '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
		'location'             => '<path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.6"/>',
		'check'                => '<path d="M4 12.5l5 5L20 6.5"/>',
		'star'                 => '<path d="M12 3.5l2.6 5.6 6 .8-4.4 4.2 1.1 6-5.3-2.9-5.3 2.9 1.1-6L3.4 9.9l6-.8z"/>',
	);
}

/**
 * Icon select choices for ACF.
 *
 * @return array
 */
function bdy_icon_choices() {
	$choices = array( '' => '— None —' );

	foreach ( array_keys( bdy_icon_paths() ) as $name ) {
		$choices[ $name ] = ucwords( str_replace( '-', ' ', $name ) );
	}

	return $choices;
}

/**
 * Render an icon.
 *
 * @param string $name Icon slug (or "arrow" / "phone" for the special cases).
 * @param array  $args size, class, stroke, echo.
 * @return string
 */
function bdy_icon( $name, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'size'   => 24,
			'class'  => '',
			'stroke' => '1.7',
			'echo'   => false,
		)
	);

	$name  = sanitize_html_class( (string) $name );
	$html  = '';
	$class = $args['class'] ? ' class="' . esc_attr( $args['class'] ) . '"' : '';

	if ( 'arrow' === $name ) {
		$html = '<span aria-hidden="true">→</span>';
	} elseif ( 'phone' === $name ) {
		$size = (int) $args['size'];
		$html = '<svg' . $class . ' width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2a1 1 0 011-.25 11.4 11.4 0 003.6.57 1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1z"/></svg>';
	} else {
		$paths = bdy_icon_paths();

		if ( ! isset( $paths[ $name ] ) ) {
			return '';
		}

		$size = (int) $args['size'];
		$html = '<svg' . $class . ' width="' . $size . '" height="' . $size . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="' . esc_attr( $args['stroke'] ) . '" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths[ $name ] . '</svg>';
	}

	if ( $args['echo'] ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput -- static, whitelisted SVG.
	}

	return $html;
}
