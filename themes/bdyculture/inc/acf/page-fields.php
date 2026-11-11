<?php
/**
 * Inner page field group.
 *
 * The supplied HTML package only contained the homepage, so inner pages use
 * the site's existing design language: eyebrow tag, H1 (the page title),
 * intro, optional lead image, then the WordPress editor content. Nothing is
 * invented — every string comes from the page itself or these fields.
 *
 * Location: any page except the static front page.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the inner page field group.
 *
 * @return void
 */
function bdy_acf_page_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$fields   = array();
	$fields[] = bdy_acf_tab( 'page_hero', __( 'Page hero', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'page', 'hero', 10 ) );
	$fields[] = bdy_acf_field( 'page_hero_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_image( 'page_hero_image', __( 'Lead image', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'page_hero_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_field(
		'page_hero_image_position',
		__( 'Lead image focal point', 'bdyculture' ),
		'text',
		array(
			'placeholder'  => '50% 50%',
			'wrapper'      => array( 'width' => '50' ),
			'instructions' => __( 'CSS object-position, e.g. 40% 60%.', 'bdyculture' ),
		)
	);

	$fields[] = bdy_acf_tab( 'page_seo', __( 'SEO', 'bdyculture' ) );
	$fields[] = bdy_acf_textarea(
		'page_meta_description',
		__( 'Meta description', 'bdyculture' ),
		array(
			'rows'      => 2,
			'maxlength' => 180,
			'instructions' => __( 'Leave empty to use the default from Site Settings.', 'bdyculture' ),
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_bdy_page',
			'title'                 => __( 'Page — hero & SEO', 'bdyculture' ),
			'fields'                => $fields,
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
					array(
						'param'    => 'page_type',
						'operator' => '!=',
						'value'    => 'front_page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
add_action( 'acf/init', 'bdy_acf_page_fields' );
