<?php
/**
 * Structured data — parity with the original HTML (MedicalClinic + FAQPage).
 *
 * Values come from Site Settings and the Home FAQ repeater, so the schema
 * stays correct when content is edited.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Split "Chermside QLD 4032" into locality / region / postcode.
 *
 * @param string $line Address line.
 * @return array
 */
function bdy_parse_address_line( $line ) {
	$parts = array(
		'locality' => '',
		'region'   => '',
		'postcode' => '',
	);

	if ( preg_match( '/^(.*?)\s+([A-Z]{2,3})\s+(\d{4})$/', trim( (string) $line ), $matches ) ) {
		$parts['locality'] = $matches[1];
		$parts['region']   = $matches[2];
		$parts['postcode'] = $matches[3];
	} else {
		$parts['locality'] = trim( (string) $line );
	}

	return $parts;
}

/**
 * Service names for the schema (from the services repeater).
 *
 * @return array
 */
function bdy_schema_services() {
	$defaults = bdy_section_defaults( 'home', 'services' );
	$rows     = bdy_rows( 'home_services_panels', $defaults['home_services_panels'] );
	$services = array();

	foreach ( $rows as $row ) {
		$title = isset( $row['panel_title'] ) ? wp_strip_all_tags( $row['panel_title'] ) : '';
		if ( $title ) {
			$services[] = array(
				'@type' => 'MedicalTherapy',
				'name'  => $title,
			);
		}
	}

	return $services;
}

/**
 * FAQ questions for the schema (from the FAQ repeater).
 *
 * @return array
 */
function bdy_schema_faqs() {
	$defaults = bdy_section_defaults( 'home', 'faq' );
	$rows     = bdy_rows( 'home_faq_items', $defaults['home_faq_items'] );
	$faqs     = array();

	foreach ( $rows as $row ) {
		$question = isset( $row['faq_question'] ) ? wp_strip_all_tags( bdy_tokens( (string) $row['faq_question'], false ) ) : '';
		$answer   = isset( $row['faq_answer'] ) ? wp_strip_all_tags( bdy_tokens( (string) $row['faq_answer'], false ) ) : '';

		if ( ! $question || ! $answer ) {
			continue;
		}

		$faqs[] = array(
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $answer,
			),
		);
	}

	return $faqs;
}


/**
 * FAQ items of the current inner page (from its FAQ sections).
 *
 * The approved inner pages each ship FAQPage data, so the schema follows the
 * blocks: whatever questions are published are the questions in the markup.
 *
 * @return array
 */
function bdy_schema_page_faqs() {
	if ( is_front_page() ) {
		return array();
	}

	$faqs = array();

	foreach ( bdy_page_blocks() as $block ) {
		if ( ! isset( $block['type'] ) || 'faq' !== $block['type'] ) {
			continue;
		}

		foreach ( bdy_b_items( $block ) as $row ) {
			$question = wp_strip_all_tags( (string) bdy_b_row( $row, 'q' ) );
			$answer   = wp_strip_all_tags( bdy_tokens( (string) bdy_b_row( $row, 'a' ), false ) );

			if ( ! $question || ! $answer ) {
				continue;
			}

			$faqs[] = array(
				'@type'          => 'Question',
				'name'           => $question,
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $answer,
				),
			);
		}
	}

	return $faqs;
}

/**
 * Breadcrumb trail of the current page: Home → section → this page.
 *
 * The trail mirrors the visible breadcrumb in the hero, so the markup and the
 * JSON-LD always agree.
 *
 * @return array List of array( 'name', 'url' ).
 */
function bdy_schema_crumbs() {
	if ( is_front_page() ) {
		return array();
	}

	$trail = array(
		array( __( 'Home', 'bdyculture' ), home_url( '/' ) ),
	);

	if ( is_singular( 'post' ) ) {
		$blog_id = (int) get_option( 'page_for_posts' );

		if ( $blog_id ) {
			$trail[] = array( get_the_title( $blog_id ), get_permalink( $blog_id ) );
		}

		$trail[] = array( get_the_title(), get_permalink() );

		return $trail;
	}

	$current = '';

	foreach ( bdy_page_blocks() as $block ) {
		if ( ! isset( $block['type'] ) || 'hero' !== $block['type'] ) {
			continue;
		}

		$current = wp_strip_all_tags( (string) bdy_b( $block, 'crumb_current' ) );

		foreach ( bdy_b_items( $block, 'crumbs' ) as $crumb ) {
			$label = wp_strip_all_tags( (string) bdy_b_row( $crumb, 'label' ) );
			$url   = (string) bdy_b_row( $crumb, 'url' );

			if ( ! $label || ! $url || bdy_is_current( $url ) ) {
				continue;
			}

			$trail[] = array( $label, bdy_link( $url ) );
		}

		break;
	}

	$trail[] = array( $current ? $current : wp_strip_all_tags( get_the_title() ), get_permalink() );

	return $trail;
}

/**
 * Output the JSON-LD blocks.
 *
 * @return void
 */
function bdy_schema_output() {
	$defaults = bdy_defaults( 'global' );
	$address  = bdy_parse_address_line( bdy_address_2() );
	$hero     = bdy_section_defaults( 'home', 'hero' );
	$image    = bdy_image_url( bdy_get( 'home_hero_image', '', bdy_context() ), 'hero-gym-bright.webp' );

	$clinic = array(
		'@context'           => 'https://schema.org',
		'@type'              => 'MedicalClinic',
		'name'               => get_bloginfo( 'name' ),
		'url'                => home_url( '/' ),
		'telephone'          => '+' . preg_replace( '/^0/', '61', bdy_phone_number() ),
		'email'              => bdy_clinic_email(),
		'image'              => $image,
		'address'            => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => bdy_address_1(),
			'addressLocality' => $address['locality'],
			'addressRegion'   => $address['region'],
			'postalCode'      => $address['postcode'],
			'addressCountry'  => 'AU',
		),
		'areaServed'         => array( 'Chermside', 'Brisbane' ),
		'medicalSpecialty'   => array( 'Physiotherapy', 'Occupational Therapy' ),
		'availableService'   => bdy_schema_services(),
	);

	// Drop empty keys so the markup stays clean.
	$clinic = array_filter(
		$clinic,
		static function ( $value ) {
			return '' !== $value && array() !== $value;
		}
	);

	$flags = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG;

	echo '<script type="application/ld+json">' . wp_json_encode( $clinic, $flags ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON-LD.

	$faqs = is_front_page() ? bdy_schema_faqs() : bdy_schema_page_faqs();

	if ( $faqs ) {
		$faq_schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $faqs,
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, $flags ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON-LD.
	}

	$trail = bdy_schema_crumbs();

	if ( count( $trail ) > 1 ) {
		$items = array();

		foreach ( $trail as $i => $crumb ) {
			$item = array(
				'@type'    => 'ListItem',
				'position' => $i + 1,
				'name'     => $crumb[0],
			);

			if ( $crumb[1] ) {
				$item['item'] = $crumb[1];
			}

			$items[] = $item;
		}

		$crumb_schema = array(
			'@context'        => 'https://schema.org',
			'@type'           => 'BreadcrumbList',
			'itemListElement' => $items,
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $crumb_schema, $flags ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON-LD.
	}
}
add_action( 'wp_head', 'bdy_schema_output', 5 );
