<?php
/**
 * Inner-page blocks — one renderer per design section type.
 *
 * Every inner page is a list of blocks. The list comes from the ACF
 * flexible-content field `page_sections`; when that is empty (fresh install,
 * or ACF not active) it falls back to `defaults-pages.php`, so the site always
 * renders the approved design.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Slug of the page being rendered.
 *
 * Known design pages map to their own fallback set; anything else uses the
 * generic page defaults.
 *
 * @return string
 */
function bdy_page_key() {
	if ( ! empty( $GLOBALS['bdy_page_key'] ) ) {
		return (string) $GLOBALS['bdy_page_key'];
	}

	$id = get_queried_object_id();

	if ( $id && function_exists( 'get_post_field' ) ) {
		$slug = get_post_field( 'post_name', $id );
		if ( $slug ) {
			return (string) $slug;
		}
	}

	return 'page';
}

/**
 * Blocks for a page: ACF rows first, shipped defaults second.
 *
 * @param string|null $slug Page key (defaults to the current page).
 * @return array
 */
function bdy_page_blocks( $slug = null ) {
	$slug = $slug ? $slug : bdy_page_key();

	$rows = bdy_rows( 'page_sections', array() );

	if ( $rows ) {
		return bdy_normalise_blocks( $rows );
	}

	$pages = bdy_page_defaults();

	if ( isset( $pages[ $slug ]['sections'] ) ) {
		return $pages[ $slug ]['sections'];
	}

	if ( isset( $pages['page']['sections'] ) ) {
		return $pages['page']['sections'];
	}

	return array();
}

/**
 * ACF flexible-content rows in the same shape as the defaults arrays.
 *
 * ACF stores the layout type in `acf_fc_layout`; the renderers only care about
 * `type`.
 *
 * @param array $rows Raw rows.
 * @return array
 */
function bdy_normalise_blocks( $rows ) {
	$blocks = array();

	foreach ( (array) $rows as $row ) {
		if ( ! is_array( $row ) ) {
			continue;
		}

		if ( isset( $row['acf_fc_layout'] ) && ! isset( $row['type'] ) ) {
			$row['type'] = $row['acf_fc_layout'];
		}

		if ( empty( $row['type'] ) ) {
			continue;
		}

		$blocks[] = $row;
	}

	return $blocks;
}

/**
 * Render every block of a page.
 *
 * @param string|null $slug Page key.
 * @return void
 */
function bdy_render_page_blocks( $slug = null ) {
	foreach ( bdy_page_blocks( $slug ) as $block ) {
		$type = isset( $block['type'] ) ? $block['type'] : '';

		if ( ! $type ) {
			continue;
		}

		$file = str_replace( '_', '-', $type );

		get_template_part( 'template-parts/blocks/' . $file, null, $block );
	}
}

/**
 * Block value with a default.
 *
 * @param array  $block Block data.
 * @param string $key   Key.
 * @param mixed  $fall  Fallback.
 * @return mixed
 */
function bdy_b( $block, $key, $fall = '' ) {
	if ( isset( $block[ $key ] ) && '' !== $block[ $key ] && array() !== $block[ $key ] ) {
		return $block[ $key ];
	}

	return $fall;
}

/**
 * Truthy flag from a block ("1", true, "yes").
 *
 * @param array  $block Block data.
 * @param string $key   Key.
 * @return bool
 */
function bdy_b_flag( $block, $key ) {
	$value = isset( $block[ $key ] ) ? $block[ $key ] : false;

	return (bool) $value;
}

/**
 * Repeater rows of a block.
 *
 * @param array  $block Block data.
 * @param string $key   Key.
 * @return array
 */
function bdy_b_items( $block, $key = 'items' ) {
	$rows = isset( $block[ $key ] ) ? $block[ $key ] : array();

	return is_array( $rows ) ? $rows : array();
}

/**
 * Row value with a default.
 *
 * @param array  $row Row.
 * @param string $key Key.
 * @param string $fall Fallback.
 * @return string
 */
function bdy_b_row( $row, $key, $fall = '' ) {
	return ( isset( $row[ $key ] ) && '' !== $row[ $key ] ) ? $row[ $key ] : $fall;
}

/**
 * Render a list of buttons from a block (or an explicit row list).
 *
 * @param array  $buttons Button rows.
 * @param string $size    Button size class.
 * @return void
 */
function bdy_b_buttons( $buttons, $size = 'lg' ) {
	if ( ! is_array( $buttons ) ) {
		return;
	}

	foreach ( $buttons as $btn ) {
		$text = isset( $btn['text'] ) ? $btn['text'] : '';

		if ( '' === trim( (string) $text ) ) {
			continue;
		}

		$style = isset( $btn['style'] ) ? $btn['style'] : 'signal';
		$icon  = isset( $btn['icon'] ) ? $btn['icon'] : 'arrow';

		echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
			$text,
			isset( $btn['url'] ) ? $btn['url'] : '',
			$style,
			array(
				'size'    => $size,
				'new_tab' => ! empty( $btn['new_tab'] ),
				'icon'    => $icon,
			)
		);
	}
}

/**
 * The little "tag" line above a heading.
 *
 * @param string $text Tag text.
 * @param bool   $light Light variant (dark sections).
 * @return void
 */
function bdy_b_tag( $text, $light = false ) {
	if ( '' === trim( (string) $text ) ) {
		return;
	}
	?>
	<p class="tag<?php echo $light ? ' tag--light' : ''; ?> reveal"><?php echo esc_html( $text ); ?></p>
	<?php
}

/**
 * Normalise design class names inside rich-text bodies.
 *
 * The approved HTML uses the short names (wrap / swept / crop / dark / ph);
 * the theme stylesheet uses the prefixed ones.
 *
 * @param string $html Body HTML.
 * @return string
 */
function bdy_b_body( $html ) {
	$html = (string) $html;

	if ( '' === trim( $html ) ) {
		return '';
	}

	// WYSIWYG fields can retain empty paragraphs after imported/editing passes.
	// They become empty grid items in blocks such as the FAQ header, adding gaps.
	$html = preg_replace( '/<p\b[^>]*>\s*(?:&nbsp;|&#0*160;|&#x0*a0;|<br\s*\/?\s*>|\x{00a0}|\s)*<\/p>/iu', '', $html );

	$map = array(
		'wrap'  => 'container',
		'swept' => 'media-frame--swept',
		'crop'  => 'img-crop',
		'ph'    => 'contact__placeholder',
	);

	$html = preg_replace_callback(
		'/class="([^"]*)"/',
		static function ( $matches ) use ( $map ) {
			$parts = preg_split( '/\s+/', trim( $matches[1] ) );
			$parts = array_map(
				static function ( $class ) use ( $map ) {
					return isset( $map[ $class ] ) ? $map[ $class ] : $class;
				},
				$parts
			);
			return 'class="' . implode( ' ', array_filter( $parts ) ) . '"';
		},
		$html
	);

	return wp_kses_post( $html );
}

/**
 * Render a centered booking CTA after selected service-page sections only.
 *
 * The section content remains ACF-managed; this adds a shared Nookal button
 * without changing any saved page data.
 *
 * @return void
 */
function bdy_service_booking_cta() {
	$service_pages = array( 'physiotherapy', 'exercise-physiology', 'occupational-therapy', 'clinical-pilates' );

	if ( ! in_array( bdy_page_key(), $service_pages, true ) ) {
		return;
	}

	$booking_url = bdy_booking_url();
	if ( '' === trim( $booking_url ) ) {
		return;
	}
	?>
	<div class="service-section__cta" style="grid-column: 1 / -1; display: flex; justify-content: center; margin-top: clamp(24px, 3vw, 40px);">
		<?php
		echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
			__( 'Book Online', 'bdyculture' ),
			$booking_url,
			'signal',
			array(
				'size'    => 'lg',
				'icon'    => 'arrow',
				'new_tab' => true,
			)
		);
		?>
	</div>
	<?php
}
