<?php
/**
 * ACF builder — tiny helpers so every field group stays readable.
 *
 * Field keys follow Rule 2: field_{field_name} (globally unique because every
 * field name in this theme is globally unique too).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Build one field definition.
 *
 * @param string $name  Field name (also used for the key).
 * @param string $label Admin label.
 * @param string $type  ACF field type.
 * @param array  $args  Extra ACF settings.
 * @return array
 */
function bdy_acf_field( $name, $label, $type = 'text', $args = array() ) {
	return array_merge(
		array(
			'key'   => 'field_' . $name,
			'label' => $label,
			'name'  => $name,
			'type'  => $type,
		),
		$args
	);
}

/**
 * Show / hide + order control pair for a section (Rule 4).
 *
 * @param string $page          Page key.
 * @param string $slug          Section slug.
 * @param int    $default_order Default order.
 * @return array
 */
function bdy_acf_layout_fields( $page, $slug, $default_order ) {
	return array(
		bdy_acf_field(
			$page . '_' . $slug . '_show',
			__( 'Show this section', 'bdyculture' ),
			'true_false',
			array(
				'ui'            => 1,
				'ui_on_text'    => __( 'Shown', 'bdyculture' ),
				'ui_off_text'   => __( 'Hidden', 'bdyculture' ),
				'default_value' => 1,
				'wrapper'       => array( 'width' => '50' ),
			)
		),
		bdy_acf_field(
			$page . '_' . $slug . '_order',
			__( 'Order', 'bdyculture' ),
			'number',
			array(
				'default_value' => (int) $default_order,
				'min'           => 0,
				'step'          => 10,
				'wrapper'       => array( 'width' => '50' ),
				'instructions'  => __( 'Lower numbers render first.', 'bdyculture' ),
			)
		),
	);
}

/**
 * Repeater sub-field presets.
 *
 * @param string $name  Field name.
 * @param string $label Label.
 * @param array  $args  Extra args.
 * @return array
 */
function bdy_acf_textarea( $name, $label, $args = array() ) {
	return bdy_acf_field( $name, $label, 'textarea', array_merge( array( 'rows' => 3, 'new_lines' => '' ), $args ) );
}

/**
 * Image field with the "image array" return format, which is what gives us
 * Media Library alt text + width/height (Rules 15, 18).
 *
 * @param string $name  Field name.
 * @param string $label Label.
 * @param array  $args  Extra args.
 * @return array
 */
function bdy_acf_image( $name, $label, $args = array() ) {
	return bdy_acf_field(
		$name,
		$label,
		'image',
		array_merge(
			array(
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
				'mime_types'    => 'jpg,jpeg,png,webp,gif,svg',
			),
			$args
		)
	);
}

/**
 * Button style select.
 *
 * @param string $name  Field name.
 * @param string $label Label.
 * @param array  $args  Extra args.
 * @return array
 */
function bdy_acf_button_style( $name, $label, $args = array() ) {
	return bdy_acf_field(
		$name,
		$label,
		'select',
		array_merge(
			array(
				'choices'       => array(
					'signal'        => __( 'Signal lime (primary)', 'bdyculture' ),
					'ink'           => __( 'Ink (dark)', 'bdyculture' ),
					'ghost'         => __( 'Ghost outline', 'bdyculture' ),
					'light'         => __( 'White', 'bdyculture' ),
					'outline-light' => __( 'White outline (on dark)', 'bdyculture' ),
					'call'          => __( 'Call', 'bdyculture' ),
				),
				'default_value' => 'signal',
				'allow_null'    => 0,
			),
			$args
		)
	);
}

/**
 * Icon select.
 *
 * @param string $name  Field name.
 * @param string $label Label.
 * @param array  $args  Extra args.
 * @return array
 */
function bdy_acf_icon( $name, $label, $args = array() ) {
	return bdy_acf_field(
		$name,
		$label,
		'select',
		array_merge(
			array(
				'choices'    => bdy_icon_choices(),
				'allow_null' => 1,
			),
			$args
		)
	);
}

/**
 * Tab field.
 *
 * @param string $key   Unique key suffix.
 * @param string $label Tab label.
 * @return array
 */
function bdy_acf_tab( $key, $label ) {
	return bdy_acf_field(
		'bdy_tab_' . $key,
		$label,
		'tab',
		array(
			'placement' => 'top',
			'endpoint'  => 0,
		)
	);
}

/**
 * Message field (inline instructions).
 *
 * @param string $key     Unique key suffix.
 * @param string $message Message HTML (trusted, authored here).
 * @return array
 */
function bdy_acf_message( $key, $message ) {
	return bdy_acf_field(
		'bdy_msg_' . $key,
		'',
		'message',
		array( 'message' => $message )
	);
}
