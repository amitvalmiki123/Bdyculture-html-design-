<?php
/**
 * Image helpers — 3-tier alt text and performance attributes (Rules 15, 18).
 *
 * Alt text tiers:
 *   1. WordPress Media Library alt text
 *   2. Dedicated ACF alt text field (passed in $args['alt'])
 *   3. Empty string alt="" (valid HTML, correct for decorative images)
 *
 * Performance:
 *   - above-the-fold images get loading="eager" + fetchpriority="high"
 *   - everything else gets loading="lazy" + decoding="async"
 *   - width/height are always emitted when they can be resolved
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Resolve a theme asset (fallback) image.
 *
 * @param string $file File name inside assets/images/.
 * @return array {url,width,height}
 */
function bdy_theme_image( $file ) {
	static $cache = array();

	$file = ltrim( (string) $file, '/' );

	if ( isset( $cache[ $file ] ) ) {
		return $cache[ $file ];
	}

	$path = THEME_DIR . '/assets/images/' . $file;
	$data = array(
		'url'    => THEME_URI . '/assets/images/' . $file,
		'width'  => 0,
		'height' => 0,
	);

	if ( $file && file_exists( $path ) ) {
		$size = @getimagesize( $path ); // phpcs:ignore WordPress.PHP.NoSilencedErrors -- local theme asset.
		if ( is_array( $size ) ) {
			$data['width']  = (int) $size[0];
			$data['height'] = (int) $size[1];
		}
	}

	$cache[ $file ] = $data;

	return $data;
}

/**
 * Is this string an absolute/protocol-relative URL (as opposed to a theme file)?
 *
 * @param string $value Value.
 * @return bool
 */
function bdy_is_url( $value ) {
	return (bool) preg_match( '#^(https?:)?//#i', (string) $value );
}

/**
 * Render an <img> tag.
 *
 * $image accepts: ACF image array (return format: array), attachment ID,
 * absolute URL, theme asset file name, or an empty value.
 *
 * @param mixed $image Image value.
 * @param array $args  class, alt, sizes, srcset, loading, fetchpriority, eager,
 *                     decorative, width, height, fallback, attr, echo.
 * @return string
 */
function bdy_image( $image, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'class'         => '',
			'alt'           => '',
			'sizes'         => '',
			'srcset'        => '',
			'loading'       => 'lazy',
			'fetchpriority' => '',
			'eager'         => false,
			'decorative'    => false,
			'width'         => 0,
			'height'        => 0,
			'fallback'      => '',
			'attr'          => array(),
			'echo'          => false,
		)
	);

	$html = bdy_image_html( $image, $args );

	if ( $args['echo'] ) {
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput -- built with esc_* below.
	}

	return $html;
}

/**
 * Build the <img> markup.
 *
 * @param mixed $image Image value.
 * @param array $args  See bdy_image().
 * @return string
 */
function bdy_image_html( $image, $args ) {
	$attachment_id = 0;
	$url           = '';
	$theme_asset   = false;
	$width         = (int) $args['width'];
	$height        = (int) $args['height'];
	$media_alt     = '';
	$srcset        = '';
	$sizes         = (string) $args['sizes'];

	// Normalise the incoming value.
	if ( is_array( $image ) ) {
		$attachment_id = isset( $image['ID'] ) ? (int) $image['ID'] : 0;
		$url           = isset( $image['url'] ) ? (string) $image['url'] : '';
		$width         = ! empty( $image['width'] ) ? (int) $image['width'] : $width;
		$height        = ! empty( $image['height'] ) ? (int) $image['height'] : $height;
		$media_alt     = isset( $image['alt'] ) ? (string) $image['alt'] : '';
	} elseif ( is_numeric( $image ) ) {
		$attachment_id = (int) $image;
		$src           = wp_get_attachment_image_src( $attachment_id, 'full' );
		if ( $src ) {
			$url    = (string) $src[0];
			$width  = (int) $src[1];
			$height = (int) $src[2];
		}
	} elseif ( is_string( $image ) ) {
		$image = trim( $image );
		if ( bdy_is_url( $image ) ) {
			$url = $image;
		} elseif ( '' !== $image ) {
			$asset       = bdy_theme_image( $image );
			$url         = $asset['url'];
			$theme_asset = true;
			$width = $width ? $width : $asset['width'];
			$height = $height ? $height : $asset['height'];
		}
	}

	// Fallback theme asset when nothing has been chosen yet.
	if ( '' === $url && $args['fallback'] ) {
		$asset       = bdy_theme_image( $args['fallback'] );
		$url         = $asset['url'];
		$theme_asset = true;
		$width  = $width ? $width : $asset['width'];
		$height = $height ? $height : $asset['height'];
	}

	if ( '' === $url ) {
		return '';
	}

	// Optional srcset for the theme's own responsive crops.
	if ( $args['srcset'] && $theme_asset ) {
		$sources = array();
		foreach ( explode( ',', $args['srcset'] ) as $part ) {
			$bits = preg_split( '/\s+/', trim( $part ) );
			if ( empty( $bits[0] ) ) {
				continue;
			}
			$src     = bdy_is_url( $bits[0] ) ? $bits[0] : bdy_theme_image( $bits[0] )['url'];
			$sources[] = esc_url( $src ) . ( isset( $bits[1] ) ? ' ' . esc_attr( $bits[1] ) : '' );
		}
		$srcset = implode( ', ', $sources );
	}

	// Alt text: media library → dedicated ACF field → empty (Rule 15).
	$alt = $media_alt ? $media_alt : (string) $args['alt'];
	if ( $args['decorative'] ) {
		$alt = '';
	}

	// Above-the-fold images (Rule 18).
	$loading       = $args['eager'] ? 'eager' : $args['loading'];
	$fetchpriority = $args['fetchpriority'] ? $args['fetchpriority'] : ( $args['eager'] ? 'high' : '' );

	$attr = array(
		'class'    => $args['class'],
		'alt'      => $alt,
		'loading'  => $loading,
		'decoding' => 'async',
	);

	if ( $fetchpriority ) {
		$attr['fetchpriority'] = $fetchpriority;
	}
	if ( $width ) {
		$attr['width'] = $width;
	}
	if ( $height ) {
		$attr['height'] = $height;
	}
	// Focus/zoom photos sit in fixed frames and are displayed larger than their
	// layout box (a CSS transform does not affect layout). A `sizes` value that
	// only describes the box makes the browser download a file that is barely
	// big enough, so the photo looks soft once it is scaled — aim ~2× the layout
	// size, and never less than the zoom factor.
	$bdy_zoom = bdy_image_zoom( $args['attr'] );
	$bdy_crop = $bdy_zoom > 1 || ( is_array( $args['attr'] ) && ! empty( $args['attr']['style'] ) );

	if ( $bdy_crop ) {
		$bdy_factor = max( 2, $bdy_zoom );
		$sizes      = ( '' === trim( (string) $sizes ) )
			? ( $width ? min( $width, 1600 ) . 'px' : '1200px' )
			: bdy_sizes_scale( $sizes, $bdy_factor );
	}

	if ( $sizes ) {
		$attr['sizes'] = $sizes;
	}
	if ( $srcset ) {
		$attr['srcset'] = $srcset;
	}

	// Extra attributes (crop/zoom CSS variables, object-position…) must be set
	// before either branch below, otherwise a Media Library image would lose
	// them — the reason focus/zoom fields appeared to do nothing.
	if ( is_array( $args['attr'] ) ) {
		foreach ( $args['attr'] as $bdy_name => $bdy_value ) {
			if ( '' === $bdy_value || null === $bdy_value ) {
				continue;
			}
			if ( 'class' === $bdy_name && ! empty( $attr['class'] ) ) {
				$attr['class'] = trim( $attr['class'] . ' ' . $bdy_value );
				continue;
			}
			$attr[ $bdy_name ] = $bdy_value;
		}
	}

	// Use core's image markup when we have a real attachment, so WordPress
	// can add responsive srcset/sizes and its own performance filters.
	if ( $attachment_id ) {
		$attr['loading'] = $loading;
		if ( $fetchpriority ) {
			$attr['fetchpriority'] = $fetchpriority;
		}
		return wp_get_attachment_image( $attachment_id, 'full', false, $attr );
	}

	$output = '<img src="' . esc_url( $url ) . '" alt="' . esc_attr( $alt ) . '"';
	foreach ( $attr as $name => $value ) {
		if ( 'alt' === $name || '' === $value || null === $value ) {
			continue;
		}
		if ( 'class' === $name ) {
			$output .= ' class="' . esc_attr( $value ) . '"';
			continue;
		}
		$output .= ' ' . esc_attr( $name ) . '="' . esc_attr( $value ) . '"';
	}
	$output .= '>';

	return $output;
}

/**
 * Zoom factor carried by an image's inline style.
 *
 * Reads both shapes the theme emits: the `--s` custom property used by
 * `.img-crop`, and a plain `transform: scale()` used on photos that are not
 * cropped through that class.
 *
 * @param array $attr Extra attributes passed to bdy_image().
 * @return float 1 when there is no zoom.
 */
function bdy_image_zoom( $attr ) {
	if ( ! is_array( $attr ) || empty( $attr['style'] ) ) {
		return 1;
	}

	$style = (string) $attr['style'];

	if ( preg_match( '/--s\s*:\s*([0-9.]+)/', $style, $m ) ) {
		return max( 1, (float) $m[1] );
	}
	if ( preg_match( '/scale\(\s*([0-9.]+)/', $style, $m ) ) {
		return max( 1, (float) $m[1] );
	}

	return 1;
}

/**
 * Multiply the layout widths inside a `sizes` attribute.
 *
 * Used so a zoomed photo asks for a file with enough real pixels instead of the
 * smallest one that fits its (untransformed) layout box.
 *
 * @param string $sizes  e.g. "(min-width: 1100px) 46vw, 100vw".
 * @param float  $factor Multiplier.
 * @return string
 */
function bdy_sizes_scale( $sizes, $factor ) {
	$factor  = max( 1, (float) $factor );
	$entries = array();

	foreach ( explode( ',', (string) $sizes ) as $entry ) {
		$depth = 0;
		$cut   = 0;

		// The width is the last space-separated token outside a media
		// condition, so "(min-width: 1100px) 46vw" keeps its 1100px intact.
		for ( $i = 0, $len = strlen( $entry ); $i < $len; $i++ ) {
			if ( '(' === $entry[ $i ] ) {
				$depth++;
			} elseif ( ')' === $entry[ $i ] ) {
				$depth--;
			} elseif ( 0 === $depth && ' ' === $entry[ $i ] ) {
				$cut = $i + 1;
			}
		}

		$head = substr( $entry, 0, $cut );
		$tail = trim( substr( $entry, $cut ) );

		if ( preg_match( '/^([0-9]*\.?[0-9]+)(vw|px)$/', $tail, $m ) ) {
			$value = (float) $m[1] * $factor;
			if ( 'vw' === $m[2] ) {
				$value = min( 100, $value );
			}
			$tail = ( floor( $value ) == $value ? (string) (int) $value : (string) round( $value, 1 ) ) . $m[2];
		}

		$entries[] = $head . $tail;
	}

	return implode( ',', $entries );
}

/**
 * CSS variables that drive the `.img-crop` focus/zoom.
 *
 * Accepts what a client is likely to type: `70`, `70%`, `1.9`. Numbers without
 * a unit become percentages for X/Y; the zoom is kept between 1 and 4 so a
 * typo can never make the photo disappear or turn into a gap.
 *
 * @param string|int $x     object-position X / transform-origin X.
 * @param string|int $y     object-position Y / transform-origin Y.
 * @param string|int $scale Zoom factor.
 * @return string e.g. "--x:70%;--y:60%;--s:1.9"
 */
function bdy_crop_style( $x = '', $y = '', $scale = '' ) {
	$length = static function ( $value, $fallback ) {
		$value = trim( (string) $value );
		if ( '' === $value ) {
			return $fallback;
		}
		if ( is_numeric( $value ) ) {
			return (float) $value . '%';
		}
		return $value;
	};

	$zoom = trim( (string) $scale );
	if ( '' === $zoom || ! is_numeric( $zoom ) ) {
		$zoom = 1;
	}
	$zoom = max( 1, min( 4, (float) $zoom ) );

	return '--x:' . $length( $x, '50%' )
		. ';--y:' . $length( $y, '50%' )
		. ';--s:' . $zoom;
}

/**
 * Crop style from a single free-text field.
 *
 * Accepts either ready-made CSS variables ("--x:70%;--y:60%;--s:1.9") or the
 * short form the field placeholder shows ("70% 60% 1.9", "70 60 1.9", commas
 * allowed), so both ways of typing work.
 *
 * @param string $value Raw field value.
 * @return string
 */
function bdy_crop_style_from( $value ) {
	$value = trim( (string) $value );

	if ( '' === $value ) {
		return '';
	}
	if ( false !== strpos( $value, '--' ) ) {
		return $value;
	}

	$bits = preg_split( '/[\s,]+/', $value, -1, PREG_SPLIT_NO_EMPTY );
	if ( ! $bits ) {
		return '';
	}

	return bdy_crop_style( $bits[0], isset( $bits[1] ) ? $bits[1] : '', isset( $bits[2] ) ? $bits[2] : '' );
}

/**
 * Inline focus/zoom for a plain <img> inside a fixed frame (no .img-crop).
 *
 * The design paints these photos with `object-fit: cover`; focus/zoom is
 * expressed as object-position plus a transform, so the client can re-frame a
 * Media Library photo without touching CSS.
 *
 * @param string|int $x     Focus X.
 * @param string|int $y     Focus Y.
 * @param string|int $scale Zoom factor (1 = none).
 * @return string
 */
function bdy_focus_style( $x = '', $y = '', $scale = '' ) {
	$position = bdy_position( trim( (string) $x . ' ' . (string) $y ) );

	$zoom = trim( (string) $scale );
	$zoom = ( '' !== $zoom && is_numeric( $zoom ) ) ? max( 1, min( 4, (float) $zoom ) ) : 1;

	$style = 'object-position:' . $position;

	if ( $zoom > 1 ) {
		$style .= ';transform:scale(' . $zoom . ');transform-origin:' . $position;
	}

	return $style;
}

/** ("50% 40%", "60 40").
 *
 * @param string $value Raw field value.
 * @return string
 */
function bdy_position( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value ) {
		return '50% 50%';
	}

	$bits = preg_split( '/[\s,]+/', $value, -1, PREG_SPLIT_NO_EMPTY );
	$out  = array();
	foreach ( array_slice( (array) $bits, 0, 2 ) as $bit ) {
		$out[] = is_numeric( $bit ) ? (float) $bit . '%' : $bit;
	}

	return implode( ' ', $out );
}

/**
 * URL of an image value (for CSS backgrounds / schema).
 *
 * @param mixed  $image    Image value.
 * @param string $fallback Theme asset file name.
 * @return string
 */
function bdy_image_url( $image, $fallback = '' ) {
	$url = '';

	if ( is_array( $image ) ) {
		$url = isset( $image['url'] ) ? (string) $image['url'] : '';
	} elseif ( is_numeric( $image ) ) {
		$url = (string) wp_get_attachment_image_url( (int) $image, 'full' );
	} elseif ( is_string( $image ) ) {
		$image = trim( $image );
		$url   = bdy_is_url( $image ) ? $image : '';
	}

	if ( '' === $url && $fallback ) {
		$url = bdy_theme_image( $fallback )['url'];
	}

	return $url ? esc_url( $url ) : '';
}
