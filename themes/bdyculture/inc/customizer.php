<?php
/**
 * WordPress Customizer — Theme Design panel (Rule 19).
 *
 * Every design token from Rules 6–9 is editable here with live preview.
 * Only values that differ from the stylesheet defaults are printed, as a
 * single inline <style> block in wp_head.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sanitize a CSS length (clamp(), rem, px, vw, %…).
 *
 * @param string $value Raw value.
 * @return string
 */
function bdy_sanitize_css_length( $value ) {
	$value = wp_strip_all_tags( (string) $value );
	$value = preg_replace( '/[^a-zA-Z0-9%.,()\s+\-*\/]/', '', $value );
	$value = trim( preg_replace( '/\s+/', ' ', $value ) );

	if ( '' === $value ) {
		return '';
	}

	// A bare number is treated as pixels.
	if ( preg_match( '/^-?\d+(\.\d+)?$/', $value ) ) {
		return $value . 'px';
	}

	// Fluid helpers: clamp(), calc(), min(), max().
	if ( preg_match( '/^(clamp|calc|min|max)\(.+?\)$/', $value ) ) {
		return $value;
	}

	// Plain lengths with a unit.
	if ( preg_match( '/^-?\d*\.?\d+(px|rem|em|vw|vh|vmin|vmax|%|pt|ch)$/', $value ) ) {
		return $value;
	}

	return '';
}

/**
 * Sanitize a font stack.
 *
 * @param string $value Raw value.
 * @return string
 */
function bdy_sanitize_font_stack( $value ) {
	$value = wp_strip_all_tags( (string) $value );
	$value = preg_replace( '/[^a-zA-Z0-9 ,"\'\-]/', '', $value );

	return trim( (string) $value );
}

/**
 * Setting definitions — the single source of truth for the Customizer,
 * the inline CSS output and the live-preview map.
 *
 * @return array
 */
function bdy_customizer_settings() {
	return array(
		/* -------- Colours (Rule 6) -------- */
		'bdy_color_primary'      => array(
			'label'    => __( 'Primary colour (ink + body text)', 'bdyculture' ),
			'section'  => 'bdy_colors',
			'type'     => 'color',
			'default'  => '#0b0b0c',
			'var'      => '--primary-color',
			'sanitize' => 'sanitize_hex_color',
		),
		'bdy_color_secondary'    => array(
			'label'    => __( 'Secondary colour (paper)', 'bdyculture' ),
			'section'  => 'bdy_colors',
			'type'     => 'color',
			'default'  => '#f5f5f1',
			'var'      => '--secondary-color',
			'sanitize' => 'sanitize_hex_color',
		),
		'bdy_color_accent'       => array(
			'label'    => __( 'Accent colour (signal lime)', 'bdyculture' ),
			'section'  => 'bdy_colors',
			'type'     => 'color',
			'default'  => '#cfff3e',
			'var'      => '--accent-color',
			'sanitize' => 'sanitize_hex_color',
		),
		'bdy_color_text_muted'   => array(
			'label'    => __( 'Muted text colour', 'bdyculture' ),
			'section'  => 'bdy_colors',
			'type'     => 'color',
			'default'  => '#55554f',
			'var'      => '--text-muted',
			'sanitize' => 'sanitize_hex_color',
		),
		'bdy_color_bg'           => array(
			'label'    => __( 'Background colour', 'bdyculture' ),
			'section'  => 'bdy_colors',
			'type'     => 'color',
			'default'  => '#ffffff',
			'var'      => '--bg-color',
			'sanitize' => 'sanitize_hex_color',
		),
		'bdy_color_border'       => array(
			'label'    => __( 'Border colour', 'bdyculture' ),
			'section'  => 'bdy_colors',
			'type'     => 'color',
			'default'  => '#d8d8d1',
			'var'      => '--border-color',
			'sanitize' => 'sanitize_hex_color',
		),

		/* -------- Typography (Rule 7) -------- */
		'bdy_font_body'          => array(
			'label'       => __( 'Body font stack', 'bdyculture' ),
			'section'     => 'bdy_typography',
			'type'        => 'text',
			'default'     => '"Neue Haas Grotesk Display Pro", "Host Grotesk", "Helvetica Neue", Helvetica, Arial, sans-serif',
			'var'         => '--font-body',
			'sanitize'    => 'bdy_sanitize_font_stack',
			'description' => __( 'CSS font-family list, in priority order.', 'bdyculture' ),
		),
		'bdy_font_mono'          => array(
			'label'    => __( 'Mono / label font stack', 'bdyculture' ),
			'section'  => 'bdy_typography',
			'type'     => 'text',
			'default'  => '"DM Mono", ui-monospace, "SF Mono", Menlo, Consolas, monospace',
			'var'      => '--font-mono',
			'sanitize' => 'bdy_sanitize_font_stack',
		),
		'bdy_body_size'          => array(
			'label'    => __( 'Body font size', 'bdyculture' ),
			'section'  => 'bdy_typography',
			'type'     => 'text',
			'default'  => '1.0625rem',
			'var'      => '--body-size',
			'sanitize' => 'bdy_sanitize_css_length',
		),
		'bdy_h1_size'            => array(
			'label'       => __( 'H1 size', 'bdyculture' ),
			'section'     => 'bdy_typography',
			'type'        => 'text',
			'default'     => 'clamp(2.35rem, 1.1rem + 4.6vw, 4.9rem)',
			'var'         => '--h1-size',
			'sanitize'    => 'bdy_sanitize_css_length',
			'description' => __( 'Fluid value, e.g. clamp(2.35rem, 1.1rem + 4.6vw, 4.9rem).', 'bdyculture' ),
		),
		'bdy_h2_size'            => array(
			'label'    => __( 'H2 size', 'bdyculture' ),
			'section'  => 'bdy_typography',
			'type'     => 'text',
			'default'  => 'clamp(2rem, 1.1rem + 3vw, 3.9rem)',
			'var'      => '--h2-size',
			'sanitize' => 'bdy_sanitize_css_length',
		),
		'bdy_h3_size'            => array(
			'label'    => __( 'H3 size', 'bdyculture' ),
			'section'  => 'bdy_typography',
			'type'     => 'text',
			'default'  => 'clamp(1.35rem, 1.1rem + .9vw, 1.9rem)',
			'var'      => '--h3-size',
			'sanitize' => 'bdy_sanitize_css_length',
		),

		/* -------- Spacing (Rules 8, 9) -------- */
		'bdy_section_padding'    => array(
			'label'    => __( 'Section padding', 'bdyculture' ),
			'section'  => 'bdy_spacing',
			'type'     => 'text',
			'default'  => 'clamp(64px, 5vw + 40px, 136px)',
			'var'      => '--section-padding',
			'sanitize' => 'bdy_sanitize_css_length',
		),

		/* -------- Container (Rule 9) -------- */
		'bdy_container_width'    => array(
			'label'       => __( 'Container max width (px)', 'bdyculture' ),
			'section'     => 'bdy_container',
			'type'        => 'number',
			'default'     => 1440,
			'var'         => '--container-max-width',
			'sanitize'    => 'absint',
			'unit'        => 'px',
			'description' => __( 'Applied above 1600px screens the design grows to 1560px automatically.', 'bdyculture' ),
		),
		'bdy_container_padding'  => array(
			'label'    => __( 'Container side padding', 'bdyculture' ),
			'section'  => 'bdy_container',
			'type'     => 'text',
			'default'  => 'clamp(16px, 4vw, 48px)',
			'var'      => '--container-padding',
			'sanitize' => 'bdy_sanitize_css_length',
		),
	);
}

/**
 * Register the panel, sections and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 * @return void
 */
function bdy_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'bdy_theme_design',
		array(
			'title'       => __( 'Theme Design', 'bdyculture' ),
			'description' => __( 'Colours, typography, spacing and container settings — every value is a CSS custom property, previewed live.', 'bdyculture' ),
			'priority'    => 20,
		)
	);

	$sections = array(
		'bdy_colors'     => __( 'Colours', 'bdyculture' ),
		'bdy_typography' => __( 'Typography', 'bdyculture' ),
		'bdy_spacing'    => __( 'Spacing', 'bdyculture' ),
		'bdy_container'  => __( 'Container', 'bdyculture' ),
	);

	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section(
			$id,
			array(
				'title' => $title,
				'panel' => 'bdy_theme_design',
			)
		);
	}

	foreach ( bdy_customizer_settings() as $id => $setting ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $setting['sanitize'],
				'transport'         => 'postMessage',
				'type'              => 'theme_mod',
			)
		);

		$args = array(
			'label'       => $setting['label'],
			'section'     => $setting['section'],
			'settings'    => $id,
			'description' => isset( $setting['description'] ) ? $setting['description'] : '',
		);

		if ( 'color' === $setting['type'] && class_exists( 'WP_Customize_Color_Control' ) ) {
			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, $args ) );
		} else {
			$args['type'] = $setting['type'];
			$args['input_attrs'] = array();
			$wp_customize->add_control( $id, $args );
		}
	}
}
add_action( 'customize_register', 'bdy_customize_register' );

/**
 * Map used by customizer-preview.js.
 *
 * @return array
 */
function bdy_customizer_preview_map() {
	$map = array();

	foreach ( bdy_customizer_settings() as $id => $setting ) {
		$map[ $id ] = array(
			'var'     => $setting['var'],
			'default' => (string) $setting['default'],
			'unit'    => isset( $setting['unit'] ) ? $setting['unit'] : '',
		);
	}

	return $map;
}

/**
 * Print only the values that differ from the stylesheet defaults.
 *
 * @return void
 */
function bdy_customizer_css() {
	$css = '';

	foreach ( bdy_customizer_settings() as $id => $setting ) {
		$value = get_theme_mod( $id, $setting['default'] );

		if ( '' === $value || null === $value || (string) $value === (string) $setting['default'] ) {
			continue;
		}

		$sanitize = $setting['sanitize'];
		$value    = is_callable( $sanitize ) ? call_user_func( $sanitize, $value ) : wp_strip_all_tags( (string) $value );

		if ( '' === $value ) {
			continue;
		}

		$unit = isset( $setting['unit'] ) ? $setting['unit'] : '';
		$css .= $setting['var'] . ':' . $value . $unit . ';';
	}

	if ( ! $css ) {
		return;
	}

	echo '<style id="bdy-theme-design">:root{' . $css . '}</style>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- sanitized above.
}
add_action( 'wp_head', 'bdy_customizer_css', 20 );
