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
				bdy_acf_field(
					'header_nav',
					__( 'Primary navigation', 'bdyculture' ),
					'repeater',
					array(
						'layout'        => 'block',
						'button_label'  => __( 'Add menu item', 'bdyculture' ),
						'min'           => 1,
						'instructions'  => __( 'Drop-down menus use the "Sub-menu" rows inside an item.', 'bdyculture' ),
						'sub_fields'    => array(
							bdy_acf_field( 'nav_label', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
							bdy_acf_field(
								'nav_link',
								__( 'Link', 'bdyculture' ),
								'text',
								array(
									'wrapper'      => array( 'width' => '50' ),
									'instructions' => __( 'Use /physiotherapy/ for a page on this site, or a full URL.', 'bdyculture' ),
								)
							),
							bdy_acf_field(
								'nav_children',
								__( 'Sub-menu', 'bdyculture' ),
								'repeater',
								array(
									'layout'       => 'block',
									'button_label' => __( 'Add sub-menu link', 'bdyculture' ),
									'sub_fields'   => array(
										bdy_acf_field( 'child_label', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '40' ) ) ),
										bdy_acf_field( 'child_link', __( 'Link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
										bdy_acf_icon( 'child_icon', __( 'Icon', 'bdyculture' ), array( 'wrapper' => array( 'width' => '30' ) ) ),
										bdy_acf_field(
											'child_alt',
											__( 'Secondary link', 'bdyculture' ),
											'true_false',
											array(
												'ui'           => 1,
												'instructions' => __( 'Shown in the desktop drop-down only (not the mobile drawer).', 'bdyculture' ),
											)
										),
									),
								)
							),
						),
					)
				),
				bdy_acf_field( 'header_enquire_text', __( '"Enquire" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'header_book_text', __( '"Book Online" button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'header_drawer_enquire_text', __( 'Mobile drawer enquiry label', 'bdyculture' ), 'text' ),

				bdy_acf_tab( 'footer', __( 'Footer', 'bdyculture' ) ),
				bdy_acf_image( 'footer_logo', __( 'Footer logo', 'bdyculture' ) ),
				bdy_acf_textarea( 'footer_tagline', __( 'Footer tagline', 'bdyculture' ) ),
				bdy_acf_field( 'footer_cta_text', __( 'Footer button label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'footer_cta_url', __( 'Footer button link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field(
					'footer_columns',
					__( 'Footer columns', 'bdyculture' ),
					'repeater',
					array(
						'layout'       => 'block',
						'button_label' => __( 'Add footer column', 'bdyculture' ),
						'sub_fields'   => array(
							bdy_acf_field( 'col_title', __( 'Column title', 'bdyculture' ), 'text' ),
							bdy_acf_textarea(
								'col_text',
								__( 'Column text', 'bdyculture' ),
								array(
									'rows'         => 3,
									'instructions' => __( 'Optional. Basic HTML allowed, e.g. a postal address with line breaks.', 'bdyculture' ),
								)
							),
							bdy_acf_field(
								'col_links',
								__( 'Column links', 'bdyculture' ),
								'repeater',
								array(
									'layout'       => 'block',
									'button_label' => __( 'Add link', 'bdyculture' ),
									'sub_fields'   => array(
										bdy_acf_field( 'link_label', __( 'Label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
										bdy_acf_field( 'link_url', __( 'Link', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '30' ) ) ),
										bdy_acf_field(
											'link_type',
											__( 'Type', 'bdyculture' ),
											'select',
											array(
												'wrapper'       => array( 'width' => '20' ),
												'choices'       => array(
													'link'  => __( 'Page / URL', 'bdyculture' ),
													'tel'   => __( 'Phone', 'bdyculture' ),
													'email' => __( 'Email', 'bdyculture' ),
												),
												'default_value' => 'link',
											)
										),
									),
								)
							),
						),
					)
				),
				bdy_acf_field( 'footer_copyright', __( 'Copyright line', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '50' ) ) ),
				bdy_acf_field( 'footer_privacy_text', __( 'Privacy link label', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'footer_privacy_url', __( 'Privacy link URL', 'bdyculture' ), 'text', array( 'wrapper' => array( 'width' => '25' ) ) ),
				bdy_acf_field( 'footer_credit', __( 'Credit line', 'bdyculture' ), 'text' ),
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
