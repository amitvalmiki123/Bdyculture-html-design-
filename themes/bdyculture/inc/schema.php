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
		$question = isset( $row['faq_question'] ) ? wp_strip_all_tags( $row['faq_question'] ) : '';
		$answer   = isset( $row['faq_answer'] ) ? wp_strip_all_tags( $row['faq_answer'] ) : '';

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
		'name'               => 'BDYCULTURE Rehab & Performance Clinic',
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

	$faqs = bdy_schema_faqs();

	if ( $faqs && is_front_page() ) {
		$faq_schema = array(
			'@context'   => 'https://schema.org',
			'@type'      => 'FAQPage',
			'mainEntity' => $faqs,
		);

		echo '<script type="application/ld+json">' . wp_json_encode( $faq_schema, $flags ) . '</script>' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput -- JSON-LD.
	}
}
add_action( 'wp_head', 'bdy_schema_output', 5 );
