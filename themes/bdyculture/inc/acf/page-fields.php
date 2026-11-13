<?php
/**
 * Inner page field group — the block list that builds every inner page.
 *
 * Each page is a stack of blocks (hero, services, split, steps, funding, FAQ,
 * CTA, ways, suburbs, prose, blog). The list is edited with a flexible-content
 * field, so the client can reorder, duplicate, add or remove blocks. When a
 * page has no rows yet the theme falls back to `defaults-pages.php`, which
 * carries the approved design for that page.
 *
 * Location: any page except the static front page (the posts page included).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Field inside a flexible-content layout (unique key per layout).
 *
 * @param string $layout Layout slug.
 * @param string $name   Field name.
 * @param string $label  Label.
 * @param string $type   ACF type.
 * @param array  $args   Extra settings.
 * @return array
 */
function bdy_pf( $layout, $name, $label, $type = 'text', $args = array() ) {
	return bdy_acf_field(
		$name,
		$label,
		$type,
		array_merge( array( 'key' => 'field_' . $layout . '_' . $name ), $args )
	);
}

/**
 * Repeater inside a layout, with unique keys for every sub-field.
 *
 * @param string $layout Layout slug.
 * @param string $name   Repeater name.
 * @param string $label  Label.
 * @param array  $subs   Sub-fields: array( name, label, type, args ).
 * @param array  $args   Extra repeater settings.
 * @return array
 */
function bdy_pf_rep( $layout, $name, $label, $subs, $args = array() ) {
	$sub_fields = array();

	foreach ( $subs as $sub ) {
		$sub_args = isset( $sub[3] ) ? $sub[3] : array();
		$sub_args['key'] = 'field_' . $layout . '_' . $name . '_' . $sub[0];
		$sub_fields[] = bdy_acf_field( $sub[0], $sub[1], isset( $sub[2] ) ? $sub[2] : 'text', $sub_args );
	}

	return bdy_acf_field(
		$name,
		$label,
		'repeater',
		array_merge(
			array(
				'key'          => 'field_' . $layout . '_' . $name,
				'layout'       => 'block',
				'button_label' => __( 'Add row', 'bdyculture' ),
				'sub_fields'   => $sub_fields,
			),
			$args
		)
	);
}

/**
 * Shared sub-field sets.
 *
 * @return array
 */
function bdy_pf_sets() {
	$button = array(
		array( 'text', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
		array( 'url', __( 'Link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ), 'instructions' => __( 'Use /page/ for a page, tel for the phone number, or a full URL.', 'bdyculture' ) ) ),
		array(
			'style',
			__( 'Style', 'bdyculture' ),
			'select',
			array(
				'wrapper' => array( 'width' => '20' ),
				'choices' => array(
					'signal'        => __( 'Signal lime', 'bdyculture' ),
					'ink'           => __( 'Ink', 'bdyculture' ),
					'ghost'         => __( 'Ghost', 'bdyculture' ),
					'light'         => __( 'White', 'bdyculture' ),
					'outline-light' => __( 'White outline', 'bdyculture' ),
					'call'          => __( 'Call', 'bdyculture' ),
				),
			),
		),
		array(
			'icon',
			__( 'Icon', 'bdyculture' ),
			'select',
			array(
				'wrapper'    => array( 'width' => '10' ),
				'choices'    => array( '' => '—', 'arrow' => '→', 'phone' => 'Phone', 'check' => 'Tick' ),
				'allow_null' => 1,
			),
		),
		array( 'new_tab', __( 'New tab', 'bdyculture' ), 'true_false', array( 'wrapper' => array( 'width' => '10' ), 'ui' => 1 ) ),
	);

	return array(
		'buttons' => $button,
		'row_2'   => array(
			array( 'title', __( 'Title', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
			array( 'text', __( 'Text', 'bdyculture' ), 'textarea', array( 'rows' => 2, 'wrapper' => array( 'width' => '60' ) ) ),
		),
	);
}

/**
 * Layout definitions — one per block renderer.
 *
 * @param array $sets Sub-field presets.
 * @return array
 */
function bdy_pf_layouts( $sets ) {
	$icon_choices = bdy_icon_choices();
	$text_toggle  = array(
		'ui'            => 1,
		'default_value' => 0,
		'wrapper'       => array( 'width' => '25' ),
	);

	return array(
		'hero'          => array(
			'label'  => __( '1. Hero (breadcrumbs, H1, lead, buttons)', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'hero', 'title', __( 'Heading (H1)', 'bdyculture' ) ),
				bdy_pf( 'hero', 'lead', __( 'Lead paragraph', 'bdyculture' ), 'textarea', array( 'rows' => 3 ) ),
				bdy_pf_rep( 'hero', 'buttons', __( 'Buttons', 'bdyculture' ), $sets['buttons'] ),
				bdy_pf_rep( 'hero', 'checks', __( 'Small checklist', 'bdyculture' ), array( array( 'text', __( 'Text', 'bdyculture' ) ) ) ),
				bdy_pf( 'hero', 'crumb_current', __( 'Breadcrumb — this page', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ), 'instructions' => __( 'Leave empty to use the page title. "Home" is always added.', 'bdyculture' ) ) ),
				bdy_pf_rep(
					'hero',
					'crumbs',
					__( 'Breadcrumb — trail', 'bdyculture' ),
					array(
						array( 'label', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
						array( 'url', __( 'Link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
					),
					array( 'instructions' => __( 'The pages before this one, e.g. Home → /, Services → /services/. Leave empty for Home only.', 'bdyculture' ) )
				),
				bdy_pf( 'hero', 'form', __( 'Show the enquiry card', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'default_value' => 1, 'instructions' => __( 'The card itself is edited once in Site Settings → Enquiry card.', 'bdyculture' ) ) ),
				bdy_pf( 'hero', 'form_tag', __( 'Card — tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ), 'instructions' => __( 'Only needed for a card that differs from Site Settings.', 'bdyculture' ) ) ),
				bdy_pf( 'hero', 'form_title', __( 'Card — heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'hero', 'form_intro', __( 'Card — intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf_rep(
					'hero',
					'form_fields',
					__( 'Card — fields (replaces the standard name/phone/email/service set)', 'bdyculture' ),
					array(
						array( 'label', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
						array( 'name', __( 'Field name', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) ),
						array(
							'type',
							__( 'Type', 'bdyculture' ),
							'select',
							array(
								'wrapper' => array( 'width' => '15' ),
								'choices' => array( 'text' => 'Text', 'email' => 'Email', 'tel' => 'Phone', 'number' => 'Number' ),
							),
						),
						array( 'autocomplete', __( 'Autocomplete', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '15' ) ) ),
						array( 'half', __( 'Half width', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '10' ) ) ),
						array( 'required', __( 'Required', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '10' ) ) ),
					)
				),
				bdy_pf( 'hero', 'form_button', __( 'Card — submit button', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_pf( 'hero', 'form_success_title', __( 'Card — success heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_pf( 'hero', 'form_note', __( 'Card — privacy note', 'bdyculture' ), 'textarea', array( 'rows' => 2, 'instructions' => __( 'Use {privacy_link} for the linked Privacy Policy.', 'bdyculture' ) ) ),
				bdy_pf( 'hero', 'form_success_text', __( 'Card — success message', 'bdyculture' ), 'textarea', array( 'rows' => 2, 'instructions' => __( 'Use {phone_link} for the clinic phone link.', 'bdyculture' ) ) ),
			),
		),
		'services'      => array(
			'label'  => __( '2. Service cards', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'services', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'services', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'services', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'services', 'body', __( 'Extra copy', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf( 'services', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf_rep(
					'services',
					'items',
					__( 'Cards', 'bdyculture' ),
					array(
						array( 'icon', __( 'Icon', 'bdyculture' ), 'select', array( 'choices' => $icon_choices, 'allow_null' => 1, 'wrapper' => array( 'width' => '20' ) ) ),
						array( 'title', __( 'Title', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '80' ) ) ),
						array( 'text', __( 'Text', 'bdyculture' ), 'textarea', array( 'rows' => 3 ) ),
						array( 'btn_text', __( 'Button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
						array( 'btn_url', __( 'Button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
						array( 'link_text', __( 'Extra link label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) ),
						array( 'link_url', __( 'Extra link URL', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) ),
					)
				),
			),
		),
		'svc_mini'      => array(
			'label'  => __( '3. Compact service links', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'svc_mini', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'svc_mini', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'svc_mini', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'svc_mini', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf_rep( 'svc_mini', 'items', __( 'Links', 'bdyculture' ), array(
					array( 'title', __( 'Title', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '35' ) ) ),
					array( 'text', __( 'Text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '45' ) ) ),
					array( 'url', __( 'URL', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) ),
				) ),
			),
		),
		'features'      => array(
			'label'  => __( '4. Feature cards', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'features', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'features', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'features', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'features', 'body', __( 'Extra copy', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf( 'features', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf( 'features', 'variant', __( 'Columns', 'bdyculture' ), 'select', array( 'choices' => array( '' => __( 'Three', 'bdyculture' ), 'four' => __( 'Four', 'bdyculture' ) ), 'allow_null' => 1 ) ),
				bdy_pf_rep( 'features', 'items', __( 'Cards', 'bdyculture' ), array(
					array( 'icon', __( 'Icon', 'bdyculture' ), 'select', array( 'choices' => $icon_choices, 'allow_null' => 1, 'wrapper' => array( 'width' => '20' ) ) ),
					array( 'title', __( 'Title', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '80' ) ) ),
					array( 'text', __( 'Text', 'bdyculture' ), 'textarea', array( 'rows' => 3 ) ),
				) ),
			),
		),
		'split'         => array(
			'label'  => __( '5. Split (text + photo or info card)', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'split', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'split', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'split', 'body', __( 'Body copy', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf( 'split', 'note', __( 'Small note under the buttons', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf_rep( 'split', 'buttons', __( 'Buttons', 'bdyculture' ), $sets['buttons'] ),
				bdy_pf( 'split', 'reverse', __( 'Photo on the left', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf( 'split', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf(
					'split',
					'media',
					__( 'Photo (leave empty to use the info card)', 'bdyculture' ),
					'group',
					array(
						'layout'     => 'block',
						'sub_fields' => array(
							bdy_acf_field( 'image', __( 'Image', 'bdyculture' ), 'image', array( 'key' => 'field_split_media_image', 'return_format' => 'array', 'preview_size' => 'medium' ) ),
							bdy_acf_field( 'alt', __( 'Alt text', 'bdyculture' ), 'text', array( 'key' => 'field_split_media_alt' ) ),
							bdy_acf_field( 'crop', __( 'Focus & zoom', 'bdyculture' ), 'text', array( 'key' => 'field_split_media_crop', 'placeholder' => '70% 60% 1.4', 'instructions' => __( 'Three numbers: focus X, focus Y, zoom — e.g. 70% 60% 1.4. Leave empty for the centre at 100%.', 'bdyculture' ) ) ),
						),
					)
				),
				bdy_pf(
					'split',
					'panel',
					__( 'Info card', 'bdyculture' ),
					'group',
					array(
						'layout'     => 'block',
						'sub_fields' => array(
							bdy_acf_field( 'title', __( 'Card heading', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_title' ) ),
							bdy_acf_field( 'body', __( 'Card copy', 'bdyculture' ), 'wysiwyg', array( 'key' => 'field_split_panel_body', 'media_upload' => 0, 'toolbar' => 'basic' ) ),
							bdy_acf_field( 'rows', __( 'Definition rows', 'bdyculture' ), 'repeater', array(
								'key'          => 'field_split_panel_rows',
								'layout'       => 'table',
								'button_label' => __( 'Add row', 'bdyculture' ),
								'sub_fields'   => array(
									bdy_acf_field( 'label', __( 'Label', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_rows_label' ) ),
									bdy_acf_field( 'value', __( 'Value', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_rows_value' ) ),
								),
							) ),
							bdy_acf_field( 'links', __( 'Link list', 'bdyculture' ), 'repeater', array(
								'key'          => 'field_split_panel_links',
								'layout'       => 'table',
								'button_label' => __( 'Add link', 'bdyculture' ),
								'sub_fields'   => array(
									bdy_acf_field( 'text', __( 'Label', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_links_text' ) ),
									bdy_acf_field( 'url', __( 'URL', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_links_url' ) ),
								),
							) ),
							bdy_acf_field( 'buttons', __( 'Buttons', 'bdyculture' ), 'repeater', array(
								'key'          => 'field_split_panel_buttons',
								'layout'       => 'table',
								'button_label' => __( 'Add button', 'bdyculture' ),
								'sub_fields'   => array(
									bdy_acf_field( 'text', __( 'Label', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_buttons_text' ) ),
									bdy_acf_field( 'url', __( 'Link', 'bdyculture' ), 'text', array( 'key' => 'field_split_panel_buttons_url' ) ),
									bdy_acf_field( 'style', __( 'Style', 'bdyculture' ), 'select', array( 'key' => 'field_split_panel_buttons_style', 'choices' => array( 'signal' => 'Signal', 'ink' => 'Ink', 'ghost' => 'Ghost', 'light' => 'White', 'outline-light' => 'White outline', 'call' => 'Call' ) ) ),
									bdy_acf_field( 'new_tab', __( 'New tab', 'bdyculture' ), 'true_false', array( 'key' => 'field_split_panel_buttons_new_tab', 'ui' => 1 ) ),
								),
							) ),
						),
					)
				),
			),
		),
		'steps'         => array(
			'label'  => __( '6. Steps', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'steps', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'steps', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'steps', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'steps', 'dark', __( 'Dark band', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf( 'steps', 'light', __( 'Light steps (on paper)', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf( 'steps', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf_rep( 'steps', 'items', __( 'Steps', 'bdyculture' ), $sets['row_2'] ),
				bdy_pf_rep( 'steps', 'buttons', __( 'Buttons', 'bdyculture' ), $sets['buttons'] ),
			),
		),
		'funding'       => array(
			'label'  => __( '7. Funding pathways', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'funding', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'funding', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'funding', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'funding', 'body', __( 'Extra copy', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf( 'funding', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf_rep( 'funding', 'items', __( 'Pathways', 'bdyculture' ), $sets['row_2'] ),
			),
		),
		'faq'           => array(
			'label'  => __( '8. FAQ accordion', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'faq', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'faq', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'faq', 'intro', __( 'Intro', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf( 'faq', 'btn_text', __( 'Button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_pf( 'faq', 'btn_url', __( 'Button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_pf_rep(
					'faq',
					'items',
					__( 'Questions', 'bdyculture' ),
					array(
						array( 'q', __( 'Question', 'bdyculture' ) ),
						array( 'a', __( 'Answer', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
						array( 'open', __( 'Open by default', 'bdyculture' ), 'true_false', array( 'ui' => 1 ) ),
					)
				),
			),
		),
		'cta'           => array(
			'label'  => __( '9. CTA band', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'cta', 'title', __( 'Heading (H2)', 'bdyculture' ) ),
				bdy_pf( 'cta', 'text', __( 'Text', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf_rep( 'cta', 'buttons', __( 'Buttons', 'bdyculture' ), $sets['buttons'] ),
			),
		),
		'ways'          => array(
			'label'  => __( '10. Ways to reach us', 'bdyculture' ),
			'fields' => array(
				bdy_pf_rep( 'ways', 'items', __( 'Cards', 'bdyculture' ), array(
					array( 'icon', __( 'Icon', 'bdyculture' ), 'select', array( 'choices' => $icon_choices, 'allow_null' => 1, 'wrapper' => array( 'width' => '15' ) ) ),
					array( 'title', __( 'Title', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
					array( 'text', __( 'Text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '35' ) ) ),
					array( 'url', __( 'URL', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '15' ) ) ),
					array( 'new_tab', __( 'New tab', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '5' ) ) ),
				) ),
			),
		),
		'suburbs'       => array(
			'label'  => __( '11. Suburb list', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'suburbs', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'suburbs', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'suburbs', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'suburbs', 'body', __( 'Body copy', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'basic' ) ),
				bdy_pf( 'suburbs', 'note', __( 'Small print', 'bdyculture' ), 'text' ),
				bdy_pf( 'suburbs', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
				bdy_pf_rep( 'suburbs', 'items', __( 'Suburbs', 'bdyculture' ), array( array( 'text', __( 'Suburb', 'bdyculture' ) ) ) ),
			),
		),
		'prose'         => array(
			'label'  => __( '12. Rich text', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'prose', 'title', __( 'Heading (optional)', 'bdyculture' ) ),
				bdy_pf( 'prose', 'body', __( 'Content', 'bdyculture' ), 'wysiwyg', array( 'media_upload' => 0, 'toolbar' => 'full' ) ),
				bdy_pf( 'prose', 'paper', __( 'Paper background', 'bdyculture' ), 'true_false', $text_toggle ),
			),
		),
		'posts_featured' => array(
			'label'  => __( '13. Blog — featured article', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'posts_featured', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'posts_featured', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'posts_featured', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
				bdy_pf( 'posts_featured', 'post', __( 'Sample article (used until posts exist)', 'bdyculture' ), 'group', array(
					'layout'     => 'block',
					'sub_fields' => array(
						bdy_acf_field( 'title', __( 'Title', 'bdyculture' ), 'text', array( 'key' => 'field_posts_featured_post_title' ) ),
						bdy_acf_field( 'excerpt', __( 'Summary', 'bdyculture' ), 'textarea', array( 'key' => 'field_posts_featured_post_excerpt' ) ),
						bdy_acf_field( 'url', __( 'Link', 'bdyculture' ), 'text', array( 'key' => 'field_posts_featured_post_url' ) ),
						bdy_acf_field( 'image', __( 'Image filename or upload', 'bdyculture' ), 'text', array( 'key' => 'field_posts_featured_post_image' ) ),
					),
				) ),
			),
		),
		'posts_grid'    => array(
			'label'  => __( '14. Blog — article grid', 'bdyculture' ),
			'fields' => array(
				bdy_pf( 'posts_grid', 'tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_pf( 'posts_grid', 'title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_pf( 'posts_grid', 'intro', __( 'Intro', 'bdyculture' ), 'textarea', array( 'rows' => 2 ) ),
			),
		),
	);
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

	$sets    = bdy_pf_sets();
	$layouts = array();

	foreach ( bdy_pf_layouts( $sets ) as $name => $layout ) {
		$layouts[ 'layout_' . $name ] = array(
			'key'        => 'layout_' . $name,
			'name'       => $name,
			'label'      => $layout['label'],
			'display'    => 'block',
			'sub_fields' => $layout['fields'],
		);
	}

	$fields   = array();
	$fields[] = bdy_acf_tab( 'page_blocks', __( '1. Page sections', 'bdyculture' ) );
	$fields[] = bdy_acf_message(
		'page_blocks',
		'<strong>' . __( 'This page is built from blocks', 'bdyculture' ) . '</strong><br>'
		. __( 'Add, remove or drag the blocks to change the page. Left empty, the page shows the approved design from the theme — editing a block takes over from it.', 'bdyculture' )
	);
	$fields[] = bdy_acf_field(
		'page_sections',
		__( 'Blocks', 'bdyculture' ),
		'flexible_content',
		array(
			'button_label' => __( 'Add block', 'bdyculture' ),
			'layouts'      => $layouts,
		)
	);

	$fields[] = bdy_acf_tab( 'page_shared', __( '2. Shared bands (contact & map)', 'bdyculture' ) );
	$fields[] = bdy_acf_message(
		'page_shared',
		__( 'The "Get in touch" and "Find the clinic" bands are written once in BDYCULTURE → Theme Settings. Here you only choose whether this page shows them and where they sit in the stack. Lower order renders first.', 'bdyculture' )
	);
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'page', 'contact', 900 ) );
	$fields   = array_merge( $fields, bdy_acf_layout_fields( 'page', 'map', 910 ) );

	$fields[] = bdy_acf_tab( 'page_fallback', __( '3. Fallback hero', 'bdyculture' ) );
	$fields[] = bdy_acf_message(
		'page_fallback',
		__( 'Only used by a page that has no blocks and no shipped design — the H1 is the page title, then the editor content below.', 'bdyculture' )
	);
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

	acf_add_local_field_group(
		array(
			'key'                   => 'group_bdy_page',
			'title'                 => __( 'Page — sections, shared bands & fallback', 'bdyculture' ),
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
