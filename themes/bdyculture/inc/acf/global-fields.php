<?php
/**
 * Global field group — Site Settings (header, footer, mobile bar, clinic).
 *
 * Location: ACF Options page "Site Settings".
 * Edited once, used by every page (header.php, footer.php, tokens).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the global field group.
 *
 * @return void
 */
function bdy_acf_global_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_bdy_global',
			'title'                 => __( 'Site Settings — clinic, shared bands, header & footer', 'bdyculture' ),
			'fields'                => array(

				bdy_acf_tab( 'clinic', __( 'Clinic details', 'bdyculture' ) ),
				bdy_acf_message(
					'clinic',
					__( 'These values feed the header, footer, contact section, buttons and the {phone_link} / {email_link} tokens used in text fields.', 'bdyculture' )
				),
				bdy_acf_field( 'clinic_phone_display', __( 'Phone (display)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field(
					'clinic_phone_tel',
					__( 'Phone (tel: link)', 'bdyculture' ),
					'text',
					array(
						'wrapper'      => array( 'width' => '50' ),
						'instructions' => __( 'Digits only, e.g. 0730731616. Used for every tel: link.', 'bdyculture' ),
					)
				),
				bdy_acf_field( 'clinic_email', __( 'General enquiries email', 'bdyculture' ), 'email', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'clinic_email_referrals', __( 'Referrals email', 'bdyculture' ), 'email', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'clinic_address_1', __( 'Address line 1', 'bdyculture' ), 'text' ),
				bdy_acf_field( 'clinic_address_2', __( 'Address line 2', 'bdyculture' ), 'text' ),
				bdy_acf_field( 'clinic_booking_url', __( 'Online booking URL (Nookal)', 'bdyculture' ), 'url' ),
				bdy_acf_field( 'clinic_directions_url', __( 'Directions URL', 'bdyculture' ), 'url' ),
				bdy_acf_field(
					'clinic_hours',
					__( 'Opening hours', 'bdyculture' ),
					'text',
					array(
						'instructions' => __( 'One line, e.g. Mon–Fri 7am–7pm · Sat 7am–1pm. Prints wherever you type {hours}.', 'bdyculture' ),
					)
				),
				bdy_acf_textarea(
					'clinic_tagline',
					__( 'Clinic tagline', 'bdyculture' ),
					array( 'instructions' => __( 'One sentence under the logo. Also used as the footer tagline when that field is empty.', 'bdyculture' ) )
				),
				bdy_acf_image( 'clinic_logo', __( 'Header logo (dark)', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_image(
					'clinic_logo_light',
					__( 'Footer logo (light)', 'bdyculture' ),
					array(
						'wrapper'      => array( 'width' => '50' ),
						'instructions' => __( 'White version of the logo. Used in the footer when no Footer logo is chosen.', 'bdyculture' ),
					)
				),

				bdy_acf_tab( 'header', __( 'Header & navigation', 'bdyculture' ) ),
				bdy_acf_message(
					'header_nav_note',
					'<strong>' . __( 'Navigation lives in Appearance → Menus', 'bdyculture' ) . '</strong><br>' . __( 'Assign a menu to “Header — primary navigation”. Sub-items become the Services drop-down; the icon is picked automatically from the page slug (or add a class like <code>icon-heart</code> to a menu item). The mobile drawer uses the same menu.', 'bdyculture' )
				),
		bdy_acf_field( 'header_enquire_text', __( '"Enquire" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
		bdy_acf_field( 'header_enquire_url', __( '"Enquire" button URL', 'bdyculture' ), 'url', array( 'wrapper' => array( 'width' => '50' ), 'placeholder' => '/#enquire', 'instructions' => __( 'Leave empty to link to the enquiry section on the homepage.', 'bdyculture' ) ) ),
		bdy_acf_field( 'header_book_text', __( '"Book Online" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'header_drawer_enquire_text', __( 'Mobile drawer enquiry label', 'bdyculture' ), 'text' ),

				bdy_acf_tab( 'enquiry', __( 'Enquiry card', 'bdyculture' ) ),
				bdy_acf_message(
					'enquiry',
					__( 'The short form that sits beside the hero on every inner page. It is a Contact Form 7 form — the theme stores the shortcode, the tag, the heading and the lines under it.', 'bdyculture' )
				),
				bdy_acf_field( 'enquiry_tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'enquiry_title', __( 'Heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_acf_message(
					'enquiry_form',
					__( 'The form itself is built in Contact Form 7 — paste its shortcode below. Only the tag, the heading and the lines under the form are editable here; labels, fields, the button and validation live in the plugin (the intro line ships inside the form code). Ready-made form code: docs/cf7-enquiry-form.txt.', 'bdyculture' )
				),
				bdy_acf_field( 'enquiry_shortcode', __( 'Form shortcode', 'bdyculture' ), 'text', array( 'placeholder' => '[contact-form-7 id="123" title="Enquiry card"]', 'instructions' => __( 'Paste the shortcode from Contact Form 7 → Forms. Leave empty and the design\'s own form is shown (it does not send anything until the plugin is connected).', 'bdyculture' ) ) ),
				bdy_acf_field( 'enquiry_alt_text', __( 'Alt action — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'enquiry_alt_link_text', __( 'Alt action — link label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_textarea( 'enquiry_note', __( 'Line under the form', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Privacy line under the fields. Use {privacy_link} for the linked Privacy Policy.', 'bdyculture' ) ) ),

				bdy_acf_tab( 'contact_band', __( 'Contact band', 'bdyculture' ) ),
				bdy_acf_message(
					'contact_band',
					__( 'The dark "Get in touch" band. It closes the homepage and every inner page, so edit it once here. Show/order per page is set on the page itself.', 'bdyculture' )
				),
				bdy_acf_field( 'contact_tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_textarea( 'contact_title', __( 'Heading (H2)', 'bdyculture' ), array( 'rows' => 2 ) ),
				bdy_acf_textarea( 'contact_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 2 ) ),
				bdy_acf_field(
					'contact_list',
					__( 'Contact details', 'bdyculture' ),
					'repeater',
					array(
						'layout'       => 'table',
						'button_label' => __( 'Add row', 'bdyculture' ),
						'sub_fields'   => array(
							bdy_acf_field( 'contact_list_label', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
							bdy_acf_field( 'contact_list_value', __( 'Value', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ), 'instructions' => __( 'Accepts {phone_link}, {email_link}, {address_html}.', 'bdyculture' ) ) ),
							bdy_acf_field( 'contact_list_placeholder', __( 'Placeholder', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '20' ) ) ),
						),
					)
				),
				bdy_acf_field( 'contact_btn_text', __( 'Button text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_field( 'contact_btn_url', __( 'Button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_field(
					'contact_btn_icon',
					__( 'Button icon', 'bdyculture' ),
					'select',
					array( 'wrapper' => array( 'width' => '20' ), 'choices' => bdy_icon_choices(), 'allow_null' => 1 )
				),
				bdy_acf_message(
					'contact_form',
					__( 'The form itself is built in Contact Form 7 (or any form plugin). Paste its shortcode below. Only this heading and the note under the form are editable here — labels, fields, options, the button and the validation all live in the form plugin. Ready-made form code for the design: docs/cf7-contact-form.txt.', 'bdyculture' )
				),
				bdy_acf_field( 'contact_form_shortcode', __( 'Form shortcode', 'bdyculture' ), 'text', array( 'placeholder' => '[contact-form-7 id="123" title="Contact form"]', 'instructions' => __( 'Paste the shortcode from Contact Form 7 → Forms. Leave empty and the design\'s own form is shown (it does not send anything until the plugin is connected).', 'bdyculture' ) ) ),
				bdy_acf_field( 'contact_form_title', __( 'Form heading (H3)', 'bdyculture' ), 'text' ),
				bdy_acf_textarea( 'contact_form_note', __( 'Line under the form', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Privacy line shown under the submit button. Use {privacy_link} for the linked Privacy Policy.', 'bdyculture' ) ) ),

				bdy_acf_tab( 'map_band', __( 'Map band', 'bdyculture' ) ),
				bdy_acf_message(
					'map_band',
					__( 'The "Find the clinic" band with the Leaflet map. Edited once here; each page decides whether it shows.', 'bdyculture' )
				),
				bdy_acf_field( 'map_tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'map_title', __( 'Heading (H2)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'map_lat', __( 'Latitude', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) ),
				bdy_acf_field( 'map_lng', __( 'Longitude', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '20' ) ) ),
				bdy_acf_field( 'map_zoom', __( 'Zoom', 'bdyculture' ), 'number', array( 'wrapper' => array( 'width' => '20' ), 'min' => 10, 'max' => 19 ) ),
				bdy_acf_field( 'map_load_label', __( '"Load map" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
				bdy_acf_field( 'map_card_title', __( 'Map card heading (H3)', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_textarea( 'map_card_text', __( 'Map card address', 'bdyculture' ), array( 'rows' => 3 ) ),
				bdy_acf_field( 'map_chips_label', __( '"Around the clinic" label', 'bdyculture' ), 'text' ),
				bdy_acf_field(
					'map_chips',
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
				),
				bdy_acf_field( 'map_btn_1_text', __( 'Button 1 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'map_btn_1_url', __( 'Button 1 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_acf_field( 'map_btn_2_text', __( 'Button 2 — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'map_btn_2_url', __( 'Button 2 — link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),

				bdy_acf_tab( 'footer', __( 'Footer', 'bdyculture' ) ),
				bdy_acf_image( 'footer_logo', __( 'Footer logo', 'bdyculture' ) ),
				bdy_acf_textarea( 'footer_tagline', __( 'Footer tagline', 'bdyculture' ) ),
				bdy_acf_field( 'footer_cta_text', __( 'Footer button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'footer_cta_url', __( 'Footer button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field(
					'footer_copyright',
					__( 'Copyright line', 'bdyculture' ),
					'text',
					array( 'instructions' => __( 'Left side of the bottom bar. Write the © year as text — it is not updated automatically.', 'bdyculture' ) )
				),
				bdy_acf_field( 'footer_privacy_text', __( 'Privacy link label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'footer_privacy_url', __( 'Privacy link URL', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_message(
					'footer_nav_note',
					'<strong>' . __( 'Footer link columns live in Appearance → Menus', 'bdyculture' ) . '</strong><br>' . __( 'Assign one menu to “Footer — services column” and one to “Footer — quick links column”. The column heading is the menu name; items can be pages, <code>tel:</code> or <code>mailto:</code> links. The “Visit us” column is built from Clinic details.', 'bdyculture' )
				),
				bdy_acf_field(
					'footer_credit',
					__( 'Credit line', 'bdyculture' ),
					'text',
					array(
						'wrapper'      => array( 'width' => '100' ),
						'instructions' => __( 'Use {credit_link} where the linked agency name should appear.', 'bdyculture' ),
					)
				),
				bdy_acf_field( 'footer_credit_label', __( 'Credit — agency name', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'footer_credit_url', __( 'Credit — link URL', 'bdyculture' ), 'url', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_textarea( 'footer_note', __( 'Footer disclaimer', 'bdyculture' ) ),

				bdy_acf_tab( 'mobile_bar', __( 'Mobile action bar', 'bdyculture' ) ),
				bdy_acf_message(
					'mobile_bar',
					__( 'The sticky Call / Book Online bar shown below 1100px. Phone number and booking URL come from Clinic details.', 'bdyculture' )
				),
				bdy_acf_field( 'mobile_bar_call_text', __( 'Call button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'mobile_bar_book_text', __( 'Book button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'options_page',
						'operator' => '==',
						'value'    => 'bdyculture-settings',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
			'description'           => __( 'Global sections: edited once, used everywhere.', 'bdyculture' ),
		)
	);
}
add_action( 'acf/init', 'bdy_acf_global_fields' );
