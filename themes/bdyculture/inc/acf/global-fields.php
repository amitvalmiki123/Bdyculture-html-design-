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
			'title'                 => __( 'Site Settings — clinic, header, footer', 'bdyculture' ),
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
				bdy_acf_field( 'clinic_hours', __( 'Opening hours', 'bdyculture' ), 'text' ),
				bdy_acf_textarea( 'clinic_tagline', __( 'Clinic tagline', 'bdyculture' ) ),
				bdy_acf_textarea(
					'clinic_meta_description',
					__( 'Default meta description', 'bdyculture' ),
					array(
						'rows'         => 2,
						'maxlength'    => 180,
						'instructions' => __( 'Used when a page has no meta description of its own.', 'bdyculture' ),
					)
				),
				bdy_acf_image( 'clinic_logo', __( 'Header logo (dark)', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_image( 'clinic_logo_light', __( 'Footer logo (light)', 'bdyculture' ), array( 'wrapper' => array( 'width' => '50' ) ) ),

				bdy_acf_tab( 'header', __( 'Header & navigation', 'bdyculture' ) ),
				bdy_acf_message(
					'header_nav_note',
					'<strong>' . __( 'Navigation lives in Appearance → Menus', 'bdyculture' ) . '</strong><br>' . __( 'Assign a menu to “Header — primary navigation”. Sub-items become the Services drop-down; the icon is picked automatically from the page slug (or add a class like <code>icon-heart</code> to a menu item). The mobile drawer uses the same menu.', 'bdyculture' )
				),
				bdy_acf_field( 'header_enquire_text', __( '"Enquire" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'header_book_text', __( '"Book Online" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'header_drawer_enquire_text', __( 'Mobile drawer enquiry label', 'bdyculture' ), 'text' ),

				bdy_acf_tab( 'enquiry', __( 'Enquiry card', 'bdyculture' ) ),
				bdy_acf_message(
					'enquiry',
					__( 'The short form that sits beside the hero on every inner page. The answer appears in place, so no page reload.', 'bdyculture' )
				),
				bdy_acf_field( 'enquiry_tag', __( 'Tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'enquiry_title', __( 'Heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_acf_textarea( 'enquiry_intro', __( 'Intro', 'bdyculture' ), array( 'rows' => 2 ) ),
				bdy_acf_field( 'enquiry_label_name', __( 'Label — name', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'enquiry_label_phone', __( 'Label — phone', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'enquiry_label_email', __( 'Label — email', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'enquiry_label_service', __( 'Label — service select', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field(
					'enquiry_options',
					__( 'Service select options', 'bdyculture' ),
					'repeater',
					array(
						'layout'       => 'table',
						'button_label' => __( 'Add option', 'bdyculture' ),
						'sub_fields'   => array(
							bdy_acf_field( 'text', __( 'Option', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '80' ) ) ),
							bdy_acf_field( 'selected', __( 'Selected', 'bdyculture' ), 'true_false', array( 'ui' => 1, 'wrapper' => array( 'width' => '20' ) ) ),
						),
					)
				),
				bdy_acf_field( 'enquiry_button', __( 'Submit button', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'enquiry_alt_text', __( 'Alt action — text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'enquiry_alt_link_text', __( 'Alt action — link label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_textarea( 'enquiry_note', __( 'Privacy note', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Use {privacy_link} for the linked Privacy Policy.', 'bdyculture' ) ) ),
				bdy_acf_field( 'enquiry_success_title', __( 'Success heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_textarea( 'enquiry_success_text', __( 'Success message', 'bdyculture' ), array( 'rows' => 2, 'instructions' => __( 'Use {phone_link} for the clinic phone link.', 'bdyculture' ) ) ),

				bdy_acf_tab( 'article', __( 'Blog article', 'bdyculture' ) ),
				bdy_acf_message(
					'article',
					__( 'The article template around every blog post. The post title, excerpt, content, category and date come from the post itself.', 'bdyculture' )
				),
				bdy_acf_field(
					'article_checks',
					__( 'Hero checklist', 'bdyculture' ),
					'repeater',
					array(
						'layout'       => 'table',
						'button_label' => __( 'Add point', 'bdyculture' ),
						'sub_fields'   => array(
							bdy_acf_field( 'text', __( 'Text', 'bdyculture' ), 'text' ),
						),
					)
				),
				bdy_acf_field( 'article_toc_title', __( 'Sidebar — contents heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_side_services_title', __( 'Sidebar — services heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_side_book_title', __( 'Sidebar — booking heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_side_book_text', __( 'Sidebar — booking text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_cta_title', __( 'In-article CTA heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_cta_text', __( 'In-article CTA text', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_related_tag', __( 'Related — tag', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
				bdy_acf_field( 'article_related_title', __( 'Related — heading', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '70' ) ) ),
				bdy_acf_field( 'article_byline', __( 'Byline', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'article_byline_note', __( 'Byline note', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ), 'instructions' => __( 'Shown in brackets after the byline. Clear it once the author is confirmed.', 'bdyculture' ) ) ),
				bdy_acf_textarea( 'article_disclaimer', __( 'Disclaimer', 'bdyculture' ), array( 'rows' => 2 ) ),

				bdy_acf_tab( 'footer', __( 'Footer', 'bdyculture' ) ),
				bdy_acf_image( 'footer_logo', __( 'Footer logo', 'bdyculture' ) ),
				bdy_acf_textarea( 'footer_tagline', __( 'Footer tagline', 'bdyculture' ) ),
				bdy_acf_field( 'footer_cta_text', __( 'Footer button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'footer_cta_url', __( 'Footer button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
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
