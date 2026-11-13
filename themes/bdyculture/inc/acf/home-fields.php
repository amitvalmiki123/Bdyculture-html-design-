<?php
/**
 * Home page field group.
 *
 * One tab per HTML section, every visible element mapped (Rule 2). Repeating
 * content uses ACF Pro repeaters (nested where the design nests), and every
 * section has Show + Order controls (Rule 4).
 *
 * Location: static front page.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the home field group.
 *
 * @return void
 */
function bdy_acf_home_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$fields = array();

	/* ============================ HERO ============================ */
	$fields[] = bdy_acf_tab( 'hero', __( '1. Hero', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'hero', 10 ) );
	$fields[] = bdy_acf_image(
		'home_hero_image',
		__( 'Hero background photo', 'bdyculture' ),
		array( 'instructions' => __( 'Fills the hero behind a dark wash. Leave empty to use the bundled photo.', 'bdyculture' ) )
	);
	$fields[] = bdy_acf_textarea(
		'home_hero_title',
		__( 'Hero heading (H1)', 'bdyculture' ),
		array(
			'rows'         => 2,
			'instructions' => __( 'Allowed markup: &lt;br&gt;, &lt;span class="amp"&gt; and &lt;span class="hero__highlight"&gt; (the lime highlight).', 'bdyculture' ),
		)
	);
	$fields[] = bdy_acf_textarea( 'home_hero_lead', __( 'Hero lead paragraph', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_field(
		'home_hero_buttons',
		__( 'Hero buttons', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add button', 'bdyculture' ),
			'max'          => 3,
			'sub_fields'   => array(
				bdy_acf_field( 'hero_btn_text', __( 'Text', 'bdyculture' ) ),
				bdy_acf_field(
					'hero_btn_url',
					__( 'Link', 'bdyculture' ),
					'text',
					array( 'instructions' => __( 'Use tel for the phone number, /page/ for a page, or a full URL.', 'bdyculture' ) )
				),
				bdy_acf_button_style( 'hero_btn_style', __( 'Style', 'bdyculture' ) ),
				bdy_acf_icon( 'hero_btn_icon', __( 'Icon', 'bdyculture' ) ),
				bdy_acf_field(
					'hero_btn_icon_pos',
					__( 'Icon side', 'bdyculture' ),
					'select',
					array(
						'choices'    => array(
							'auto'  => __( 'Auto (design default)', 'bdyculture' ),
							'right' => __( 'Right of the text', 'bdyculture' ),
							'left'  => __( 'Left of the text', 'bdyculture' ),
						),
						'default_value' => 'auto',
					)
				),
				bdy_acf_field( 'hero_btn_new_tab', __( 'New tab', 'bdyculture' ), 'true_false', array( 'ui' => 1 ) ),
			),
		)
	);
	$fields[] = bdy_acf_field(
		'home_hero_checks',
		__( 'Hero checklist', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add checklist item', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'hero_check_text', __( 'Text', 'bdyculture' ) ),
			),
		)
	);
	/* ========================== MARQUEE ========================== */
	$fields[] = bdy_acf_tab( 'marquee', __( '2. Marquee', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'marquee', 20 ) );
	$fields[] = bdy_acf_field(
		'home_marquee_items',
		__( 'Marquee items', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add item', 'bdyculture' ),
			'min'          => 2,
			'sub_fields'   => array(
				bdy_acf_field( 'marquee_item_text', __( 'Text', 'bdyculture' ) ),
			),
		)
	);

	/* ========================== SERVICES ========================== */
	$fields[] = bdy_acf_tab( 'services', __( '3. Services', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'services', 30 ) );
	$fields[] = bdy_acf_field( 'home_services_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_services_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Basic HTML allowed, e.g. &lt;br&gt;.', 'bdyculture' ) ) );
	$fields[] = bdy_acf_textarea( 'home_services_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_field(
		'home_services_panels',
		__( 'Service tabs & panels', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'block',
			'button_label' => __( 'Add service panel', 'bdyculture' ),
			'min'          => 1,
			'sub_fields'   => array(
				bdy_acf_field( 'panel_tab_label', __( 'Tab label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_icon( 'panel_icon', __( 'Tab icon', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'panel_chip', __( 'Image chip label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_image( 'panel_image', __( 'Panel photo', 'bdyculture' ) ),
				bdy_acf_field( 'panel_img_x', __( 'Photo focus — X', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ), 'placeholder' => '50%' ) ),
				bdy_acf_field( 'panel_img_y', __( 'Photo focus — Y', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ), 'placeholder' => '50%' ) ),
				bdy_acf_field( 'panel_img_scale', __( 'Photo zoom', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ), 'placeholder' => '1' ) ),
				bdy_acf_field( 'panel_title', __( 'Panel heading (H3)', 'bdyculture' ), 'text' ),
				bdy_acf_textarea( 'panel_lead', __( 'Panel lead', 'bdyculture' ), array( 'rows' => 2 ) ),
				bdy_acf_textarea( 'panel_body', __( 'Panel body', 'bdyculture' ), array( 'rows' => 4 ) ),
				bdy_acf_field(
					'panel_ticks',
					__( 'Tick list', 'bdyculture' ),
					'repeater',
					array(
						'layout'       => 'table',
						'button_label' => __( 'Add tick', 'bdyculture' ),
						'sub_fields'   => array(
							bdy_acf_field( 'panel_tick_text', __( 'Text', 'bdyculture' ) ),
						),
					)
				),
				bdy_acf_field( 'panel_btn_1_text', __( 'Primary button — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_field( 'panel_btn_1_url', __( 'Primary button — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_icon( 'panel_btn_1_icon', __( 'Primary icon', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'panel_btn_2_text', __( 'Secondary button — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_field( 'panel_btn_2_url', __( 'Secondary button — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_field( 'panel_btn_2_new_tab', __( 'Secondary opens in new tab', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '20' ) ) ),
			),
		)
	);

	/* ========================= CONTINUUM ========================= */
	$fields[] = bdy_acf_tab( 'continuum', __( '4. More than a consulting room', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'continuum', 40 ) );
	$fields[] = bdy_acf_field( 'home_continuum_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_continuum_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_textarea( 'home_continuum_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_image( 'home_continuum_photo', __( 'Main photo', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_photo_alt', __( 'Main photo alt text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ), 'instructions' => __( 'Used only when the Media Library has no alt text.', 'bdyculture' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_caption', __( 'Photo caption', 'bdyculture' ), 'text' );
	$fields[] = bdy_acf_image( 'home_continuum_inset', __( 'Inset photo', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_inset_x', __( 'Inset focus — X', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '16' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_inset_y', __( 'Inset focus — Y', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '17' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_inset_scale', __( 'Inset zoom', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '17' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_badge_number', __( 'Badge number', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) );
	$fields[] = bdy_acf_textarea( 'home_continuum_badge_text', __( 'Badge text', 'bdyculture' ), array( 'rows' => 2, 'wrapper' => array( 'width' => '75' ) ) );
	$fields[] = bdy_acf_field(
		'home_continuum_steps',
		__( 'Approach steps', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add step', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_icon( 'continuum_step_icon', __( 'Icon', 'bdyculture' ) ),
				bdy_acf_field( 'continuum_step_title', __( 'Title', 'bdyculture' ) ),
				bdy_acf_textarea( 'continuum_step_text', __( 'Text', 'bdyculture' ), array( 'rows' => 2 ) ),
			),
		)
	);
	$fields[] = bdy_acf_field( 'home_continuum_more_closed', __( '"Read more" label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_more_open', __( '"Show less" label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field(
		'home_continuum_paragraphs',
		__( 'Expandable paragraphs', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add paragraph', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_textarea( 'continuum_para_text', __( 'Paragraph', 'bdyculture' ), array( 'rows' => 3 ) ),
			),
		)
	);
	$fields[] = bdy_acf_field( 'home_continuum_btn_1_text', __( 'Button 1 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_btn_1_url', __( 'Button 1 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '60' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_btn_2_text', __( 'Button 2 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
	$fields[] = bdy_acf_field( 'home_continuum_btn_2_url', __( 'Button 2 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '60' ) ) );

	/* =========================== RIBBON =========================== */
	$fields[] = bdy_acf_tab( 'ribbon', __( '5. Photo ribbon', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'ribbon', 50 ) );
	$fields[] = bdy_acf_field(
		'home_ribbon_images',
		__( 'Ribbon photos', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'block',
			'button_label' => __( 'Add photo', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_image( 'ribbon_image', __( 'Photo', 'bdyculture' ) ),
				bdy_acf_field( 'ribbon_x', __( 'Focus — X', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'ribbon_y', __( 'Focus — Y', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'ribbon_scale', __( 'Zoom', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'ribbon_swept', __( 'Swept corner', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '25' ) ) ),
			),
		)
	);

	/* ============================ VISIT ============================ */
	$fields[] = bdy_acf_tab( 'visit', __( '6. Visit us', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'visit', 55 ) );
	$fields[] = bdy_acf_field( 'home_visit_tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'home_visit_title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) );
	$fields[] = bdy_acf_textarea( 'home_visit_text_1', __( 'Paragraph 1', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_textarea( 'home_visit_text_2', __( 'Paragraph 2', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_field(
		'home_visit_main_image',
		__( 'Photo — window signage', 'bdyculture' ),
		'image',
		array(
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'wrapper'       => array( 'width' => '50' ),
			'instructions'  => __( 'Portrait crop (4:5). Leave empty to use the bundled photo.', 'bdyculture' ),
		)
	);
	$fields[] = bdy_acf_field( 'home_visit_main_position', __( 'Photo crop position', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ), 'default_value' => '50% 50%', 'instructions' => __( 'object-position, e.g. 50% 40%.', 'bdyculture' ) ) );
	$fields[] = bdy_acf_field( 'home_visit_main_alt', __( 'Alt text — window signage', 'bdyculture' ), 'text' );
	$fields[] = bdy_acf_field(
		'home_visit_door_image',
		__( 'Photo — door signage', 'bdyculture' ),
		'image',
		array(
			'return_format' => 'array',
			'preview_size'  => 'thumbnail',
			'wrapper'       => array( 'width' => '50' ),
			'instructions'  => __( 'Small overlapping card. Leave empty to use the bundled photo.', 'bdyculture' ),
		)
	);
	$fields[] = bdy_acf_field( 'home_visit_door_alt', __( 'Alt text — door signage', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_visit_cta_1_text', __( 'Button 1 — label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ) ) );
	$fields[] = bdy_acf_field( 'home_visit_cta_1_url', __( 'Button 1 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ) ) );
	$fields[] = bdy_acf_button_style( 'home_visit_cta_1_style', __( 'Button 1 — style', 'bdyculture' ) );
	$fields[] = bdy_acf_field( 'home_visit_cta_2_text', __( 'Button 2 — label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ) ) );
	$fields[] = bdy_acf_field( 'home_visit_cta_2_url', __( 'Button 2 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '33' ) ) );
	$fields[] = bdy_acf_button_style( 'home_visit_cta_2_style', __( 'Button 2 — style', 'bdyculture' ) );

	/* =========================== EXPECT =========================== */
	$fields[] = bdy_acf_tab( 'expect', __( '7. What to expect', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'expect', 60 ) );
	$fields[] = bdy_acf_field( 'home_expect_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_expect_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_textarea( 'home_expect_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_field(
		'home_expect_steps',
		__( 'Steps', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add step', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'expect_step_title', __( 'Title', 'bdyculture' ) ),
				bdy_acf_textarea( 'expect_step_text', __( 'Text', 'bdyculture' ), array( 'rows' => 3 ) ),
			),
		)
	);
	$fields[] = bdy_acf_field( 'home_expect_btn_1_text', __( 'Button 1 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'home_expect_btn_1_url', __( 'Button 1 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_icon( 'home_expect_btn_1_icon', __( 'Button 1 icon', 'bdyculture' ), array( 'wrapper' => array( 'width' => '20' ) ) );
	$fields[] = bdy_acf_field( 'home_expect_btn_2_text', __( 'Button 2 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'home_expect_btn_2_url', __( 'Button 2 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) );

	/* ========================== FUNDING ========================== */
	$fields[] = bdy_acf_tab( 'funding', __( '8. Funding', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'funding', 70 ) );
	$fields[] = bdy_acf_field( 'home_funding_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_funding_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_textarea( 'home_funding_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_textarea( 'home_funding_text', __( 'Second paragraph', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_field(
		'home_funding_pathways',
		__( 'Funding pathways', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add pathway', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'pathway_title', __( 'Title', 'bdyculture' ) ),
				bdy_acf_field( 'pathway_text', __( 'Note', 'bdyculture' ) ),
			),
		)
	);

	/* ============================ PAIR ============================ */
	$fields[] = bdy_acf_tab( 'pair', __( '9. Home visits & refer', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'pair', 80 ) );
	$fields[] = bdy_acf_field( 'pair_1_tag', __( 'Card 1 — tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) );
	$fields[] = bdy_acf_field(
		'pair_1_style',
		__( 'Card 1 — style', 'bdyculture' ),
		'select',
		array(
			'wrapper'       => array( 'width' => '30' ),
			'choices'       => array( 'ink' => __( 'Ink (photo)', 'bdyculture' ), 'signal' => __( 'Signal lime', 'bdyculture' ) ),
			'default_value' => 'ink',
		)
	);
	$fields[] = bdy_acf_field( 'pair_1_title', __( 'Card 1 — heading (H2)', 'bdyculture' ), 'text' );
	$fields[] = bdy_acf_textarea( 'pair_1_text', __( 'Card 1 — text', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_field( 'pair_1_btn_1_text', __( 'Card 1 — button 1 text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_1_btn_1_url', __( 'Card 1 — button 1 link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
	$fields[] = bdy_acf_button_style( 'pair_1_btn_1_style', __( 'Card 1 — button 1 style', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_1_btn_2_text', __( 'Card 1 — button 2 text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_1_btn_2_url', __( 'Card 1 — button 2 link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
	$fields[] = bdy_acf_button_style( 'pair_1_btn_2_style', __( 'Card 1 — button 2 style', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_2_tag', __( 'Card 2 — tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) );
	$fields[] = bdy_acf_field(
		'pair_2_style',
		__( 'Card 2 — style', 'bdyculture' ),
		'select',
		array(
			'wrapper'       => array( 'width' => '30' ),
			'choices'       => array( 'ink' => __( 'Ink (photo)', 'bdyculture' ), 'signal' => __( 'Signal lime', 'bdyculture' ) ),
			'default_value' => 'signal',
		)
	);
	$fields[] = bdy_acf_field( 'pair_2_title', __( 'Card 2 — heading (H2)', 'bdyculture' ), 'text' );
	$fields[] = bdy_acf_textarea( 'pair_2_text', __( 'Card 2 — text', 'bdyculture' ), array( 'rows' => 3, 'instructions' => __( 'Use {referrals_email_link} to insert the referrals email link from Site Settings.', 'bdyculture' ) ) );
	$fields[] = bdy_acf_field( 'pair_2_btn_1_text', __( 'Card 2 — button 1 text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_2_btn_1_url', __( 'Card 2 — button 1 link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
	$fields[] = bdy_acf_button_style( 'pair_2_btn_1_style', __( 'Card 2 — button 1 style', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_icon( 'pair_2_btn_1_icon', __( 'Card 2 — button 1 icon', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_2_btn_2_text', __( 'Card 2 — button 2 text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'pair_2_btn_2_url', __( 'Card 2 — button 2 link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );

	/* ============================= FAQ ============================ */
	$fields[] = bdy_acf_tab( 'faq', __( '10. FAQ', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'faq', 90 ) );
	$fields[] = bdy_acf_field( 'home_faq_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_faq_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_textarea( 'home_faq_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Use {phone_link} for the clinic phone link.', 'bdyculture' ) ) );
	$fields[] = bdy_acf_field( 'home_faq_btn_text', __( 'Button text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_faq_btn_url', __( 'Button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field(
		'home_faq_items',
		__( 'Questions', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'block',
			'button_label' => __( 'Add question', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'faq_question', __( 'Question', 'bdyculture' ) ),
				bdy_acf_textarea( 'faq_answer', __( 'Answer', 'bdyculture' ), array( 'rows' => 4 ) ),
			),
		)
	);

	/* =========================== CONTACT ========================== */
	$fields[] = bdy_acf_tab( 'contact', __( '11. Contact', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'contact', 100 ) );
	$fields[] = bdy_acf_field( 'home_contact_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_contact_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2 ) );
	$fields[] = bdy_acf_textarea( 'home_contact_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_field(
		'home_contact_list',
		__( 'Contact details list', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'block',
			'button_label' => __( 'Add detail', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'contact_list_label', __( 'Label', 'bdyculture' ) ),
				bdy_acf_textarea(
					'contact_list_value',
					__( 'Value', 'bdyculture' ),
					array( 'rows' => 2, 'instructions' => __( 'Tokens: {phone_link}, {email_link}, {referrals_email_link}. Basic HTML allowed.', 'bdyculture' ) )
				),
				bdy_acf_field( 'contact_list_placeholder', __( 'Style as placeholder', 'bdyculture' ), 'true_false', array( 'ui' => 1 ) ),
			),
		)
	);
	$fields[] = bdy_acf_field( 'home_contact_btn_text', __( 'Booking button — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_btn_url', __( 'Booking button — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_icon( 'home_contact_btn_icon', __( 'Booking button icon', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field(
		'home_contact_form_shortcode',
		__( 'Contact form shortcode (Contact Form 7)', 'bdyculture' ),
		'text',
		array( 'instructions' => __( 'Paste a CF7 shortcode. Leave empty to use the built-in designed form.', 'bdyculture' ) )
	);
	$fields[] = bdy_acf_field( 'home_contact_form_title', __( 'Form heading (H3)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_intro', __( 'Form intro', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_label_name', __( 'Label — name', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_label_phone', __( 'Label — phone', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_label_email', __( 'Label — email', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_label_type', __( 'Label — enquiry type', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_label_interest', __( 'Label — interest', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_label_message', __( 'Label — message', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field(
		'home_contact_form_types',
		__( 'Enquiry type options', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add option', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'contact_type_option_text', __( 'Option', 'bdyculture' ) ),
			),
		)
	);
	$fields[] = bdy_acf_field(
		'home_contact_form_interests',
		__( 'Interest options', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add option', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'contact_interest_option_text', __( 'Option', 'bdyculture' ) ),
			),
		)
	);
	$fields[] = bdy_acf_textarea(
		'home_contact_form_note',
		__( 'Privacy note under the button', 'bdyculture' ),
		array( 'rows' => 2, 'instructions' => __( 'Allows a link, e.g. to the privacy policy.', 'bdyculture' ) )
	);
	$fields[] = bdy_acf_field( 'home_contact_form_button', __( 'Submit button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_contact_form_success_title', __( 'Success heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_contact_form_success_text', __( 'Success message', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Use {phone_link} for the clinic phone link.', 'bdyculture' ) ) );

	/* ============================ MAP ============================= */
	$fields[] = bdy_acf_tab( 'map', __( '12. Map', 'bdyculture' ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'home', 'map', 110 ) );
	$fields[] = bdy_acf_field( 'home_map_tag', __( 'Eyebrow tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_map_title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_field( 'home_map_lat', __( 'Latitude', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) );
	$fields[] = bdy_acf_field( 'home_map_lng', __( 'Longitude', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) );
	$fields[] = bdy_acf_field( 'home_map_zoom', __( 'Zoom', 'bdyculture' ), 'number', array( 'wrapper' => array( 'width' => '20' ), 'min' => 10, 'max' => 19 ) );
	$fields[] = bdy_acf_field( 'home_map_load_label', __( '"Load map" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) );
	$fields[] = bdy_acf_field( 'home_map_card_title', __( 'Map card heading (H3)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) );
	$fields[] = bdy_acf_textarea( 'home_map_card_text', __( 'Map card address', 'bdyculture' ), array( 'rows' => 3 ) );
	$fields[] = bdy_acf_field( 'home_map_chips_label', __( '"Around the clinic" label', 'bdyculture' ), 'text' );
	$fields[] = bdy_acf_field(
		'home_map_chips',
		__( 'Nearby suburbs', 'bdyculture' ),
		'repeater',
		array(
			'layout'       => 'table',
			'button_label' => __( 'Add suburb', 'bdyculture' ),
			'sub_fields'   => array(
				bdy_acf_field( 'chip_label', __( 'Suburb', 'bdyculture' ) ),
				bdy_acf_field( 'chip_lat', __( 'Latitude', 'bdyculture' ) ),
				bdy_acf_field( 'chip_lng', __( 'Longitude', 'bdyculture' ) ),
				bdy_acf_field( 'chip_zoom', __( 'Zoom', 'bdyculture' ) ),
			),
		)
	);
	$fields[] = bdy_acf_field( 'home_map_btn_1_text', __( 'Button 1 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'home_map_btn_1_url', __( 'Button 1 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) );
	$fields[] = bdy_acf_field( 'home_map_btn_2_text', __( 'Button 2 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) );
	$fields[] = bdy_acf_field( 'home_map_btn_2_url', __( 'Button 2 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) );

	acf_add_local_field_group(
		array(
			'key'                   => 'group_bdy_home',
			'title'                 => __( 'Home page — all sections', 'bdyculture' ),
			'fields'                => $fields,
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
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
			'description'           => __( 'One tab per design section. Show/Order controls sit at the top of each tab.', 'bdyculture' ),
		)
	);
}
add_action( 'acf/init', 'bdy_acf_home_fields' );
