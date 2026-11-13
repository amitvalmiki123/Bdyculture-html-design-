<?php
/**
 * defaults.php — the original HTML content as PHP arrays (Rule 3).
 *
 * This is the FALLBACK layer, not the only place to edit. Every value here is
 * mirrored by an ACF field of the same name, so the site renders identically
 * with zero ACF data entered, and the client can override any value from
 * wp-admin without touching code.
 *
 * Naming contract (Rule 2):
 *   field group  → home / global / page
 *   field name   → {page}_{section}_{property}
 *   repeater row → keys are the ACF sub-field names, e.g. panel_title
 *
 * Section arrays always contain `show` and `order` (Rule 4).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * All fallback content.
 *
 * @return array
 */
function bdy_defaults_all() {
	static $defaults = null;

	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(

		/* =================================================================
		   GLOBAL — header, footer, clinic details (ACF Options page).
		   Managed from ONE place: Site Settings.
		   ================================================================= */
		'global' => array(
			'clinic_phone_display'      => '07 3073 1616',
			'clinic_phone_tel'          => '0730731616',
			'clinic_email'              => 'hello@bdyculture.com.au',
			'clinic_email_referrals'    => 'referrals@bdyculture.com.au',
			'clinic_address_1'          => '671 Gympie Road, Suite 5, Level 1',
			'clinic_address_2'          => 'Chermside QLD 4032',
			'clinic_booking_url'        => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
			'clinic_directions_url'     => 'https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032',
			'clinic_hours'              => 'Placeholder — client to confirm clinic hours',
			'clinic_tagline'            => 'Allied health and rehabilitation in Chermside, Brisbane.',
			'clinic_meta_description'   => 'Physiotherapy, exercise physiology, occupational therapy and clinical Pilates in Chermside, Brisbane. Book online or call {phone}.',

			'header_enquire_text'       => 'Enquire',
			'header_drawer_enquire_text' => 'Send an enquiry',
			'header_book_text'          => 'Book Online',

			'mobile_bar_call_text'      => 'Call',
			'mobile_bar_book_text'      => 'Book Online',

			'footer_tagline'            => 'Allied health and rehabilitation in Chermside, Brisbane.',
			'footer_copyright'          => '© 2026 BDYCULTURE. All rights reserved.',
			'footer_privacy_text'       => 'Privacy Policy',
			'footer_privacy_url'        => '/privacy-policy/',
			'footer_credit'             => 'Web Design by {credit_link}',
			'footer_credit_label'       => 'Digital Movement',
			'footer_credit_url'         => 'https://www.digitalmovement.com.au/',
			'footer_note'               => 'Information on this website is general in nature and is not a substitute for individual health advice. Results vary between individuals.',

			/* Primary navigation (repeater). */
			'header_nav'                => array(
				array(
					'nav_label'    => 'Home',
					'nav_link'     => '/',
					'nav_children' => array(),
				),
				array(
					'nav_label'    => 'Services',
					'nav_link'     => '/services/',
					'nav_children' => array(
						array(
							'child_label' => 'Physiotherapy',
							'child_link'  => '/physiotherapy/',
							'child_icon'  => 'physiotherapy',
							'child_alt'   => false,
						),
						array(
							'child_label' => 'Exercise Physiology',
							'child_link'  => '/exercise-physiology/',
							'child_icon'  => 'exercise-physiology',
							'child_alt'   => false,
						),
						array(
							'child_label' => 'Occupational Therapy',
							'child_link'  => '/occupational-therapy/',
							'child_icon'  => 'occupational-therapy',
							'child_alt'   => false,
						),
						array(
							'child_label' => 'Clinical Pilates',
							'child_link'  => '/clinical-pilates/',
							'child_icon'  => 'clinical-pilates',
							'child_alt'   => false,
						),
						array(
							'child_label' => 'Practice from BDYCULTURE',
							'child_link'  => '/practice-from-bdyculture/',
							'child_icon'  => '',
							'child_alt'   => true,
						),
					),
				),
				array(
					'nav_label'    => 'Referrers',
					'nav_link'     => '/referrers/',
					'nav_children' => array(),
				),
				array(
					'nav_label'    => 'Contact',
					'nav_link'     => '/contact/',
					'nav_children' => array(),
				),
			),

			/* Footer columns (repeater). col_links is a nested repeater. */
			'footer_columns'            => array(
				array(
					'col_title' => 'Services',
					'col_text'  => '',
					'col_links' => array(
						array( 'link_label' => 'Physiotherapy', 'link_url' => '/physiotherapy/', 'link_type' => 'link' ),
						array( 'link_label' => 'Exercise Physiology', 'link_url' => '/exercise-physiology/', 'link_type' => 'link' ),
						array( 'link_label' => 'Occupational Therapy', 'link_url' => '/occupational-therapy/', 'link_type' => 'link' ),
						array( 'link_label' => 'Clinical Pilates', 'link_url' => '/clinical-pilates/', 'link_type' => 'link' ),
					),
				),
				array(
					'col_title' => 'Quick links',
					'col_text'  => '',
					'col_links' => array(
						array( 'link_label' => 'All Services', 'link_url' => '/services/', 'link_type' => 'link' ),
						array( 'link_label' => 'Referrers', 'link_url' => '/referrers/', 'link_type' => 'link' ),
						array( 'link_label' => 'Contact', 'link_url' => '/contact/', 'link_type' => 'link' ),
						array( 'link_label' => 'Blog', 'link_url' => '/blog/', 'link_type' => 'link' ),
						array( 'link_label' => 'Chermside', 'link_url' => '/location-chermside/', 'link_type' => 'link' ),
						array( 'link_label' => 'Practice from BDYCULTURE', 'link_url' => '/practice-from-bdyculture/', 'link_type' => 'link' ),
					),
				),
				array(
					'col_title' => 'Visit us',
					'col_text'  => '{address_html}',
					'col_links' => array(
						array( 'link_label' => '{phone}', 'link_url' => '{phone_tel}', 'link_type' => 'tel' ),
						array( 'link_label' => '{email}', 'link_url' => '{email}', 'link_type' => 'email' ),
						array( 'link_label' => '{referrals_email}', 'link_url' => '{referrals_email}', 'link_type' => 'email' ),
					),
				),
			),
		),

		/* =================================================================
		   HOME
		   ================================================================= */
		'home' => array(

			/* ---------------- HERO ---------------- */
			'hero' => array(
				'show'                    => true,
				'order'                   => 10,
				'home_hero_title'         => 'Allied Health <span class="amp">&amp;</span> Rehabilitation in <span class="hero__highlight">Chermside</span>',
				'home_hero_lead'          => 'A multidisciplinary clinic combining expert allied health care with a dedicated rehabilitation and exercise environment.',
				'home_hero_buttons'       => array(
					array(
						'hero_btn_text'    => 'Book Online',
						'hero_btn_url'     => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
						'hero_btn_style'   => 'signal',
						'hero_btn_icon'    => 'arrow',
						'hero_btn_new_tab' => true,
					),
					array(
						'hero_btn_text'    => 'Call {phone}',
						'hero_btn_url'     => 'tel',
						'hero_btn_style'   => 'call',
						'hero_btn_icon'    => 'phone',
						'hero_btn_new_tab' => false,
					),
					array(
						'hero_btn_text'    => 'Refer a Patient',
						'hero_btn_url'     => '/referrers/',
						'hero_btn_style'   => 'ghost',
						'hero_btn_icon'    => '',
						'hero_btn_new_tab' => false,
					),
				),
				'home_hero_checks'        => array(
					array( 'hero_check_text' => 'Online booking via Nookal' ),
					array( 'hero_check_text' => 'Physio · Exercise Physiology · OT · Pilates' ),
					array( 'hero_check_text' => 'Home visits by arrangement' ),
				),

			),

			/* ---------------- MARQUEE ---------------- */
			'marquee' => array(
				'show'                  => true,
				'order'                 => 20,
				'home_marquee_items'    => array(
					array( 'marquee_item_text' => 'Physiotherapy' ),
					array( 'marquee_item_text' => 'Exercise Physiology' ),
					array( 'marquee_item_text' => 'Occupational Therapy' ),
					array( 'marquee_item_text' => 'Clinical Pilates' ),
				),
			),

			/* ---------------- SERVICES ---------------- */
			'services' => array(
				'show'                  => true,
				'order'                 => 30,
				'home_services_tag'     => 'Our core services',
				'home_services_title'   => 'Four disciplines.<br>One joined-up clinic.',
				'home_services_intro'   => 'Integrated allied health care built around rehabilitation, movement and long-term function. Choose a discipline to see how it can help, then book online or enquire — whichever suits you.',
				'home_services_panels'  => array(
					array(
						'panel_tab_label'   => 'Physiotherapy',
						'panel_icon'        => 'physiotherapy',
						'panel_image'       => 'gym-chermside-1920.jpg',
						'panel_img_x'       => '28%',
						'panel_img_y'       => '62%',
						'panel_img_scale'   => '1.5',
						'panel_chip'        => 'Physiotherapy',
						'panel_title'       => 'Physiotherapy',
						'panel_lead'        => 'Assessment, treatment and progressive rehabilitation for pain, injury, post-operative recovery and movement limitations.',
						'panel_body'        => 'Physiotherapy at BDYCULTURE starts with understanding how you move and what is getting in the way. Your physiotherapist assesses the problem, explains what they find in plain language and builds a plan that moves from symptom management towards strength and confidence — with the clinic’s rehabilitation space on hand when exercise becomes part of the plan.',
						'panel_ticks'       => array(
							array( 'panel_tick_text' => 'Pain and injury assessment' ),
							array( 'panel_tick_text' => 'Post-operative recovery' ),
							array( 'panel_tick_text' => 'Movement limitations' ),
							array( 'panel_tick_text' => 'Progressive rehabilitation programs' ),
						),
						'panel_btn_1_text'  => 'Explore Physiotherapy',
						'panel_btn_1_url'   => '/physiotherapy/',
						'panel_btn_1_icon'  => 'arrow',
						'panel_btn_2_text'  => 'Book Online',
						'panel_btn_2_url'   => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
						'panel_btn_2_new_tab' => true,
					),
					array(
						'panel_tab_label'   => 'Exercise Physiology',
						'panel_icon'        => 'exercise-physiology',
						'panel_image'       => 'hero-gym-bright.webp',
						'panel_img_x'       => '52%',
						'panel_img_y'       => '45%',
						'panel_img_scale'   => '1.5',
						'panel_chip'        => 'Exercise Physiology',
						'panel_title'       => 'Exercise Physiology',
						'panel_lead'        => 'Clinical exercise prescription for chronic conditions, injury rehabilitation, strength, mobility and long-term health.',
						'panel_body'        => 'Exercise physiology uses carefully prescribed, supervised exercise as the treatment. Sessions are planned around your health history and goals, then progressed as you build capacity — making full use of the equipped exercise environment that sits alongside our consulting rooms.',
						'panel_ticks'       => array(
							array( 'panel_tick_text' => 'Chronic condition management' ),
							array( 'panel_tick_text' => 'Injury rehabilitation' ),
							array( 'panel_tick_text' => 'Strength and mobility' ),
							array( 'panel_tick_text' => 'Long-term health and capacity' ),
						),
						'panel_btn_1_text'  => 'Explore Exercise Physiology',
						'panel_btn_1_url'   => '/exercise-physiology/',
						'panel_btn_1_icon'  => 'arrow',
						'panel_btn_2_text'  => 'Book Online',
						'panel_btn_2_url'   => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
						'panel_btn_2_new_tab' => true,
					),
					array(
						'panel_tab_label'   => 'Occupational Therapy',
						'panel_icon'        => 'occupational-therapy',
						'panel_image'       => 'hero-gym-bright.webp',
						'panel_img_x'       => '8%',
						'panel_img_y'       => '55%',
						'panel_img_scale'   => '1.9',
						'panel_chip'        => 'Occupational Therapy',
						'panel_title'       => 'Occupational Therapy',
						'panel_lead'        => 'Practical assessment and therapy to support independence, daily function, participation and everyday activities.',
						'panel_body'        => 'Occupational therapy looks at the activities that matter in your day and what makes them harder than they should be. Your therapist works with you on practical strategies and supports that help you stay as independent and involved as you want to be.',
						'panel_ticks'       => array(
							array( 'panel_tick_text' => 'Independence and daily function' ),
							array( 'panel_tick_text' => 'Participation in everyday activities' ),
							array( 'panel_tick_text' => 'Practical assessment' ),
							array( 'panel_tick_text' => 'Strategies and supports' ),
						),
						'panel_btn_1_text'  => 'Explore Occupational Therapy',
						'panel_btn_1_url'   => '/occupational-therapy/',
						'panel_btn_1_icon'  => 'arrow',
						'panel_btn_2_text'  => 'Book Online',
						'panel_btn_2_url'   => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
						'panel_btn_2_new_tab' => true,
					),
					array(
						'panel_tab_label'   => 'Clinical Pilates',
						'panel_icon'        => 'clinical-pilates',
						'panel_image'       => 'hero-gym-bright.webp',
						'panel_img_x'       => '96%',
						'panel_img_y'       => '78%',
						'panel_img_scale'   => '2.2',
						'panel_chip'        => 'Clinical Pilates',
						'panel_title'       => 'Clinical Pilates',
						'panel_lead'        => 'Pilates-based exercise to support rehabilitation, strength, movement and physical capacity, delivered by an Accredited Exercise Physiologist or Physiotherapist.',
						'panel_body'        => 'Clinical Pilates is delivered by an Accredited Exercise Physiologist or Physiotherapist, so each session is guided by clinical assessment rather than a generic class format. It sits naturally alongside the rest of the clinic’s rehabilitation pathway.',
						'panel_ticks'       => array(
							array( 'panel_tick_text' => 'Rehabilitation-focused movement' ),
							array( 'panel_tick_text' => 'Strength and control' ),
							array( 'panel_tick_text' => 'Physical capacity' ),
							array( 'panel_tick_text' => 'Led by an AEP or Physiotherapist' ),
						),
						'panel_btn_1_text'  => 'Explore Clinical Pilates',
						'panel_btn_1_url'   => '/clinical-pilates/',
						'panel_btn_1_icon'  => 'arrow',
						'panel_btn_2_text'  => 'Book Online',
						'panel_btn_2_url'   => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
						'panel_btn_2_new_tab' => true,
					),
				),
			),

			/* ---------------- CONTINUUM ("More than a consulting room") ---------------- */
			'continuum' => array(
				'show'                       => true,
				'order'                      => 40,
				'home_continuum_tag'         => 'More than a consulting room',
				'home_continuum_title'       => 'From first assessment to long-term capacity — in one place.',
				'home_continuum_intro'       => 'Our Chermside clinic combines clinical allied health care with a dedicated rehabilitation and exercise environment, allowing care to progress from assessment and symptom management through to strength, conditioning and long-term physical capacity.',
				'home_continuum_photo'       => 'gym-chermside-1920.jpg',
				'home_continuum_photo_alt'   => 'BDYCULTURE rehabilitation gym in Chermside, Brisbane, with strength equipment, cable machines, free weights and open functional exercise space',
				'home_continuum_caption'     => 'Our rehab &amp; exercise space · Level 1, Chermside',
				'home_continuum_inset'       => 'hero-gym-bright.webp',
				'home_continuum_inset_x'     => '70%',
				'home_continuum_inset_y'     => '60%',
				'home_continuum_inset_scale' => '1.9',
				'home_continuum_badge_number' => '7',
				'home_continuum_badge_text'  => 'consulting rooms<br>+ rehab &amp; exercise space',
				'home_continuum_steps'       => array(
					array(
						'continuum_step_icon'  => 'search',
						'continuum_step_title' => 'Assess',
						'continuum_step_text'  => 'Your practitioner listens, examines and explains what is going on and what your options are.',
					),
					array(
						'continuum_step_icon'  => 'heart',
						'continuum_step_title' => 'Settle',
						'continuum_step_text'  => 'Treatment and guidance focus on managing symptoms so you can start moving with more confidence.',
					),
					array(
						'continuum_step_icon'  => 'exercise-physiology',
						'continuum_step_title' => 'Strengthen',
						'continuum_step_text'  => 'Supervised exercise builds strength, mobility and control in the clinic’s dedicated rehab space.',
					),
					array(
						'continuum_step_icon'  => 'trend',
						'continuum_step_title' => 'Sustain',
						'continuum_step_text'  => 'You leave with the capacity and the know-how to keep going well beyond the clinic.',
					),
				),
				'home_continuum_more_closed' => 'Read more about our approach',
				'home_continuum_more_open'   => 'Show less',
				'home_continuum_paragraphs'  => array(
					array( 'continuum_para_text' => 'Many people only ever see a health professional in a consulting room, then are sent elsewhere to find somewhere to exercise. Having seven consulting rooms and a fully equipped rehabilitation and exercise space under the same roof means your care does not need to be handed off at the moment it becomes most active.' ),
					array( 'continuum_para_text' => 'Because physiotherapists, exercise physiologists and occupational therapists work from the same clinic, the people involved in your care can stay across what the others are doing. That makes it easier to keep goals consistent, to adjust a program when something changes and to avoid repeating the same assessment in three different places.' ),
					array( 'continuum_para_text' => 'Every plan is individual. Your practitioner will talk through the options and what each involves, and you stay in charge of the decisions. Results and recovery times differ from person to person.' ),
				),
				'home_continuum_btn_1_text'  => 'Book an Appointment',
				'home_continuum_btn_1_url'   => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
				'home_continuum_btn_2_text'  => 'Call {phone}',
				'home_continuum_btn_2_url'   => 'tel',
			),

			/* ---------------- PHOTO RIBBON ---------------- */
			'ribbon' => array(
				'show'                 => true,
				'order'                => 50,
				'home_ribbon_images'   => array(
					array( 'ribbon_image' => 'gym-chermside-1920.jpg', 'ribbon_x' => '22%', 'ribbon_y' => '70%', 'ribbon_scale' => '1.6', 'ribbon_swept' => true ),
					array( 'ribbon_image' => 'hero-gym-bright.webp', 'ribbon_x' => '96%', 'ribbon_y' => '75%', 'ribbon_scale' => '2.3', 'ribbon_swept' => false ),
					array( 'ribbon_image' => 'hero-gym-bright.webp', 'ribbon_x' => '52%', 'ribbon_y' => '40%', 'ribbon_scale' => '1.5', 'ribbon_swept' => true ),
					array( 'ribbon_image' => 'gym-chermside-1920.jpg', 'ribbon_x' => '60%', 'ribbon_y' => '65%', 'ribbon_scale' => '1.3', 'ribbon_swept' => false ),
					array( 'ribbon_image' => 'hero-gym-bright.webp', 'ribbon_x' => '8%', 'ribbon_y' => '55%', 'ribbon_scale' => '2', 'ribbon_swept' => true ),
					array( 'ribbon_image' => 'hero-gym-bright.webp', 'ribbon_x' => '34%', 'ribbon_y' => '35%', 'ribbon_scale' => '2', 'ribbon_swept' => false ),
				),
			),

			/* ---------------- VISIT US (v2: clinic signage + directions) ---------------- */
			'visit' => array(
				'show'                        => true,
				'order'                       => 55,
				'home_visit_tag'              => 'Visit us',
				'home_visit_title'            => 'Find us on Gympie Road, Chermside.',
				'home_visit_text_1'           => 'BDYCULTURE is located at Suite 5, Level 1, 671 Gympie Road, Chermside QLD 4032, with lift access available. Look for our window signage listing Physiotherapy, Exercise Physiology, Occupational Therapy and Clinical Pilates.',
				'home_visit_text_2'           => 'Enter 671 Gympie Road, Chermside QLD 4032 into your GPS or maps app. Visitor parking is available at the rear of the building, with additional 3-hour parking within the adjacent precinct.',
				'home_visit_main_image'       => '',
				'home_visit_main_position'    => '50% 50%',
				'home_visit_main_alt'         => 'BDYCULTURE window signage at the Chermside clinic listing Physiotherapy, Exercise Physiology, Occupational Therapy and Clinical Pilates',
				'home_visit_door_image'       => '',
				'home_visit_door_alt'         => 'BDYCULTURE clinic door signage, Suite 5, Level 1, Chermside',
				'home_visit_cta_1_text'       => 'Get directions',
				'home_visit_cta_1_url'        => 'https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032',
				'home_visit_cta_1_style'      => 'ink',
				'home_visit_cta_2_text'       => 'Book Online',
				'home_visit_cta_2_url'        => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
				'home_visit_cta_2_style'      => 'ghost',
			),

			/* ---------------- WHAT TO EXPECT ---------------- */
			'expect' => array(
				'show'                   => true,
				'order'                  => 60,
				'home_expect_tag'        => 'What to expect',
				'home_expect_title'      => 'Three steps from “I need help” to a plan.',
				'home_expect_intro'      => 'Getting started should be the easy part. Whether you book yourself or a GP, specialist or case manager refers you, the path looks the same.',
				'home_expect_steps'      => array(
					array(
						'expect_step_title' => 'Book or refer',
						'expect_step_text'  => 'Book online through Nookal in a couple of minutes, call the clinic on {phone}, or send an enquiry. Referrers can email the team directly. If you are not sure which service you need, tell us what is going on and we will help you choose.',
					),
					array(
						'expect_step_title' => 'Your first appointment',
						'expect_step_text'  => 'Your practitioner takes time to understand your history, goals and concerns, assesses how you move, and explains the findings and options clearly. Wear comfortable clothing and bring any referral letters, reports or imaging you already have.',
					),
					array(
						'expect_step_title' => 'Your plan, in motion',
						'expect_step_text'  => 'Together you agree on a plan. Depending on your needs that might include treatment, supervised exercise in the rehab space, Clinical Pilates, practical strategies for daily life, or a mix — reviewed and adjusted as you progress.',
					),
				),
				'home_expect_btn_1_text' => 'Book Online',
				'home_expect_btn_1_url'  => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
				'home_expect_btn_1_icon' => 'arrow',
				'home_expect_btn_2_text' => 'Send an enquiry',
				'home_expect_btn_2_url'  => '#contact',
			),

			/* ---------------- FUNDING ---------------- */
			'funding' => array(
				'show'                  => true,
				'order'                 => 70,
				'home_funding_tag'      => 'Funding &amp; referrals',
				'home_funding_title'    => 'Funding pathways that fit how you’re covered.',
				'home_funding_intro'    => 'Our services can be accessed through a range of funding pathways. Eligibility and availability differ by service and by person — for example, Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service — so check with our team before you book.',
				'home_funding_text'     => 'Each service page sets out the pathways for that discipline, along with what a referral involves and what to bring. If you are working with a case manager, insurer or support coordinator, we are happy to talk through their requirements with you.',
				'home_funding_pathways' => array(
					array( 'pathway_title' => 'Private', 'pathway_text' => 'Book directly, no third party required' ),
					array( 'pathway_title' => 'WorkCover Queensland', 'pathway_text' => 'Work-related injury claims' ),
					array( 'pathway_title' => 'Medicare Chronic Condition Management', 'pathway_text' => 'Eligible chronic conditions via your GP' ),
					array( 'pathway_title' => 'Queensland CTP', 'pathway_text' => 'Compulsory third party motor vehicle claims' ),
					array( 'pathway_title' => 'NDIS', 'pathway_text' => 'Participants with funded supports' ),
					array( 'pathway_title' => 'DVA', 'pathway_text' => 'Veteran Cards — Gold and White' ),
				),
			),

			/* ---------------- PAIR (home visits + refer) ---------------- */
			'pair' => array(
				'show'                    => true,
				'order'                   => 80,
				'pair_1_tag'              => 'More than a consulting room',
				'pair_1_title'            => 'Home Visits Available by Arrangement',
				'pair_1_text'             => 'Physiotherapy and exercise physiology home visits may be available across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability. Contact our team to enquire.',
				'pair_1_style'            => 'ink',
				'pair_1_btn_1_text'       => 'Call {phone}',
				'pair_1_btn_1_url'        => 'tel',
				'pair_1_btn_1_style'      => 'signal',
				'pair_1_btn_2_text'       => 'Ask about home visits',
				'pair_1_btn_2_url'        => '#contact',
				'pair_1_btn_2_style'      => 'outline-light',
				'pair_2_tag'              => 'For GPs, specialists &amp; case managers',
				'pair_2_title'            => 'Ready to get started? Refer a patient.',
				'pair_2_text'             => 'Whether you’re booking care or referring a patient, we’ll make the next step simple. Email {referrals_email_link} with the subject “Patient Referral – BDYCULTURE”, or visit the Referrers page for the full steps.',
				'pair_2_style'            => 'signal',
				'pair_2_btn_1_text'       => 'Refer a Patient',
				'pair_2_btn_1_url'        => '/referrers/',
				'pair_2_btn_1_style'      => 'ink',
				'pair_2_btn_1_icon'       => 'arrow',
				'pair_2_btn_2_text'       => '',
				'pair_2_btn_2_url'        => '',
				'pair_2_btn_2_style'      => '',
			),

			/* ---------------- FAQ ---------------- */
			'faq' => array(
				'show'               => true,
				'order'              => 90,
				'home_faq_tag'       => 'FAQs',
				'home_faq_title'     => 'Questions we’re often asked.',
				'home_faq_intro'     => 'Can’t see yours? Call {phone_link} or send us a message — we’re happy to help.',
				'home_faq_btn_text'  => 'Ask a question',
				'home_faq_btn_url'   => '#contact',
				'home_faq_items'     => array(
					array(
						'faq_question' => 'Do I need a referral to book an appointment?',
						'faq_answer'   => 'It depends on the service and how your care is funded. Private appointments can be booked online through Nookal. Funded pathways such as Medicare Chronic Condition Management, WorkCover Queensland, Queensland CTP, NDIS and DVA can have their own paperwork or referral requirements, so call {phone} and our team will confirm what applies to you.',
					),
					array(
						'faq_question' => 'Which service is right for me?',
						'faq_answer'   => 'Physiotherapy suits pain, injury, post-operative recovery and movement limitations. Exercise physiology focuses on clinical exercise for chronic conditions, injury rehabilitation, strength and mobility. Occupational therapy supports independence and everyday function. Clinical Pilates is a Pilates-based approach to rehabilitation and movement. If you are unsure, contact our team and we will point you to the right starting point.',
					),
					array(
						'faq_question' => 'Which funding pathways are available?',
						'faq_answer'   => 'Our service pages list Private, WorkCover Queensland, Medicare Chronic Condition Management, Queensland CTP, NDIS and DVA Veteran Cards (Gold and White). Availability differs by service. For example, Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service. Contact us to confirm eligibility before you book.',
					),
					array(
						'faq_question' => 'Where is the clinic?',
						'faq_answer'   => 'We are at {address}, Brisbane. Use the map on this page for directions.',
					),
					array(
						'faq_question' => 'Do you offer home visits?',
						'faq_answer'   => 'Physiotherapy and exercise physiology home visits may be available by arrangement across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability. Contact our team to enquire.',
					),
					array(
						'faq_question' => 'Who delivers Clinical Pilates?',
						'faq_answer'   => 'Clinical Pilates at BDYCULTURE is delivered by an Accredited Exercise Physiologist or a Physiotherapist, as part of a rehabilitation and movement approach.',
					),
					array(
						'faq_question' => 'What happens at a first appointment?',
						'faq_answer'   => 'Your practitioner will talk through your history, goals and concerns, assess how you move and explain the options for your care before anything starts. You will be involved in decisions about your plan. Wear comfortable clothing and bring any referrals, reports or imaging you have.',
					),
					array(
						'faq_question' => 'How do I refer a patient?',
						'faq_answer'   => 'Email {referrals_email} with the subject line “Patient Referral – BDYCULTURE”, or call {phone}. Visit our Referrers page for the full steps, including secure messaging advice.',
					),
				),
			),

			/* ---------------- CONTACT ---------------- */
			'contact' => array(
				'show'                   => true,
				'order'                  => 100,
				'home_contact_tag'       => 'Get in touch',
				'home_contact_title'     => 'Let’s get you moving.',
				'home_contact_intro'     => 'Book online in minutes, call the clinic, or send us a message and we’ll come back to you. Referrers are welcome to use the form or email the team directly.',
				'home_contact_list'      => array(
					array( 'contact_list_label' => 'Visit us', 'contact_list_value' => '{address_html}', 'contact_list_placeholder' => false ),
					array( 'contact_list_label' => 'General enquiries', 'contact_list_value' => '{email_link}', 'contact_list_placeholder' => false ),
					array( 'contact_list_label' => 'Referrals', 'contact_list_value' => '{referrals_email_link}', 'contact_list_placeholder' => false ),
					array( 'contact_list_label' => 'Opening hours', 'contact_list_value' => 'Placeholder — client to confirm clinic hours', 'contact_list_placeholder' => true ),
				),
				'home_contact_btn_text'  => 'Book Online with Nookal',
				'home_contact_btn_url'   => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
				'home_contact_btn_icon'  => 'arrow',

				'home_contact_form_shortcode'   => '',
				'home_contact_form_title'       => 'Send us a message',
				'home_contact_form_intro'       => 'We’ll reply during business hours. For urgent medical help, call 000.',
				'home_contact_form_label_name'  => 'Full name',
				'home_contact_form_label_phone' => 'Phone',
				'home_contact_form_label_email' => 'Email',
				'home_contact_form_label_type'  => 'Enquiry type',
				'home_contact_form_label_interest' => 'I’m interested in',
				'home_contact_form_label_message'  => 'Message',
				'home_contact_form_types'       => array(
					array( 'contact_type_option_text' => 'Book an appointment' ),
					array( 'contact_type_option_text' => 'Home visit enquiry' ),
					array( 'contact_type_option_text' => 'Referring a patient' ),
					array( 'contact_type_option_text' => 'General question' ),
				),
				'home_contact_form_interests'   => array(
					array( 'contact_interest_option_text' => 'Physiotherapy' ),
					array( 'contact_interest_option_text' => 'Exercise Physiology' ),
					array( 'contact_interest_option_text' => 'Occupational Therapy' ),
					array( 'contact_interest_option_text' => 'Clinical Pilates' ),
					array( 'contact_interest_option_text' => 'I’m not sure yet' ),
				),
				'home_contact_form_note'         => 'By submitting this form, you acknowledge the BDYCULTURE <a href="/privacy-policy/">Privacy Policy</a>. Please do not include sensitive medical or health information in this form.',
				'home_contact_form_button'        => 'Send message',
				'home_contact_form_success_title' => 'Thanks — message received',
				'home_contact_form_success_text'  => 'We’ll be in touch shortly. To speak to someone now, call {phone_link}.',
			),

			/* ---------------- MAP ---------------- */
			'map' => array(
				'show'                  => true,
				'order'                 => 110,
				'home_map_tag'          => 'Find the clinic',
				'home_map_title'        => 'On Gympie Road, Chermside.',
				'home_map_lat'          => '-27.3852',
				'home_map_lng'          => '153.0306',
				'home_map_zoom'         => '16',
				'home_map_load_label'   => 'Load interactive map',
				'home_map_card_title'   => 'BDYCULTURE',
				'home_map_card_text'    => 'Rehab &amp; Performance Clinic<br>{address_html}',
				'home_map_chips_label'  => 'Around the clinic:',
				'home_map_chips'        => array(
					array( 'chip_label' => 'Chermside', 'chip_lat' => '-27.3852', 'chip_lng' => '153.0306', 'chip_zoom' => '16' ),
					array( 'chip_label' => 'Chermside West', 'chip_lat' => '-27.3790', 'chip_lng' => '153.0120', 'chip_zoom' => '14' ),
					array( 'chip_label' => 'Kedron', 'chip_lat' => '-27.4060', 'chip_lng' => '153.0430', 'chip_zoom' => '14' ),
					array( 'chip_label' => 'Wavell Heights', 'chip_lat' => '-27.3930', 'chip_lng' => '153.0560', 'chip_zoom' => '14' ),
					array( 'chip_label' => 'Aspley', 'chip_lat' => '-27.3680', 'chip_lng' => '153.0170', 'chip_zoom' => '14' ),
					array( 'chip_label' => 'Geebung', 'chip_lat' => '-27.3680', 'chip_lng' => '153.0480', 'chip_zoom' => '14' ),
					array( 'chip_label' => 'Stafford', 'chip_lat' => '-27.4130', 'chip_lng' => '153.0100', 'chip_zoom' => '14' ),
				),
				'home_map_btn_1_text'   => 'Get directions',
				'home_map_btn_1_url'    => 'https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032',
				'home_map_btn_2_text'   => 'Call',
				'home_map_btn_2_url'    => 'tel',
			),
		),

		/* =================================================================
		   INNER PAGES — generic page hero (no inner-page design existed in
		   the supplied HTML package; this reuses the site design language).
		   ================================================================= */
		'page' => array(
			'hero' => array(
				'show'                    => true,
				'order'                   => 10,
				'page_hero_tag'           => '',
				'page_hero_intro'         => '',
				'page_hero_image'         => '',
				'page_hero_image_position' => '50% 50%',
			),
		),
	);

	return $defaults;
}

/**
 * Defaults for one page ("home" | "global" | "page").
 *
 * @param string $page Page key.
 * @return array
 */
function bdy_defaults( $page = 'home' ) {
	$all = bdy_defaults_all();
	return isset( $all[ $page ] ) ? $all[ $page ] : array();
}
