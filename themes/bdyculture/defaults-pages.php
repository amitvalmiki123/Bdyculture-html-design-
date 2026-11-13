<?php
/**
 * defaults-pages.php — fallback content for every inner page (v2 design).
 *
 * Each page is a list of blocks in design order. The same shape is stored by
 * the ACF flexible-content field `page_sections`, so editing a block in
 * wp-admin overrides the matching array here.
 *
 * Block types: hero, services, svc_mini, features, split, steps, funding, faq,
 * cta, ways, suburbs, prose, posts_featured, posts_grid.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inner-page fallback blocks, keyed by page slug.
 *
 * @return array
 */
function bdy_page_defaults() {
	static $pages = null;

	if ( null !== $pages ) {
		return $pages;
	}

	$pages = array(
		'services' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Allied Health Services in Chermside',
					'lead' => 'Physiotherapy, Exercise Physiology, Occupational Therapy and Clinical Pilates delivered within a multidisciplinary rehabilitation clinic and dedicated exercise environment.',
					'crumb_current' => 'Services',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'Physio · Exercise Physiology · OT · Pilates',
						'Home visits by arrangement',
					),
					'form' => true,
				),
				array(
					'type' => 'services',
					'variant' => '',
					'paper' => true,
					'tag' => 'Four disciplines',
					'title' => 'Explore Our Services',
					'intro' => 'Choose the service that best matches your needs, or contact our team if you’re unsure where to start.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'physiotherapy',
							'title' => 'Physiotherapy',
							'text' => 'Assessment, treatment and progressive rehabilitation for musculoskeletal pain, injury, post-operative recovery and movement limitations.',
							'btn_text' => 'Explore Physiotherapy',
							'btn_url' => '/physiotherapy/',
							'link_text' => 'Book Online',
							'link_url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'link_new_tab' => true,
						),
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Exercise Physiology',
							'text' => 'Clinical exercise prescription for chronic conditions, injury rehabilitation, strength, mobility and long-term health.',
							'btn_text' => 'Explore Exercise Physiology',
							'btn_url' => '/exercise-physiology/',
							'link_text' => 'Book Online',
							'link_url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'link_new_tab' => true,
						),
						array(
							'icon' => 'occupational-therapy',
							'title' => 'Occupational Therapy',
							'text' => 'Practical assessment and therapy to support independence, daily function, participation and everyday activities.',
							'btn_text' => 'Explore Occupational Therapy',
							'btn_url' => '/occupational-therapy/',
							'link_text' => 'Book Online',
							'link_url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'link_new_tab' => true,
						),
						array(
							'icon' => 'clinical-pilates',
							'title' => 'Clinical Pilates',
							'text' => 'Pilates-based exercise to support rehabilitation, strength, movement and physical capacity, delivered by an Accredited Exercise Physiologist or Physiotherapist.',
							'btn_text' => 'Explore Clinical Pilates',
							'btn_url' => '/clinical-pilates/',
							'link_text' => 'Book Online',
							'link_url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'link_new_tab' => true,
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => false,
					'tag' => 'Where to start',
					'title' => 'Not sure which service you need? Start with a conversation.',
					'body' => '<p>Choosing between four disciplines can feel like a lot, particularly if you are managing pain or recovering from a procedure. The good news is that the choice rarely has to be perfect. Practitioners at BDYCULTURE work in the same clinic, so if you start in one service and a different one would suit you better, the people involved in your care can talk to each other.</p> <h3>A simple way to think about it</h3> <ul class="checklist"> <li><strong>Pain, injury or recovery after surgery</strong> — physiotherapy is usually the natural starting point.</li> <li><strong>A chronic condition, or building strength and fitness safely</strong> — exercise physiology focuses on clinical exercise prescription.</li> <li><strong>Everyday tasks have become harder</strong> — occupational therapy looks at independence, function and participation.</li> <li><strong>Movement-based rehabilitation with close guidance</strong> — clinical Pilates is led by an Accredited Exercise Physiologist or Physiotherapist.</li> </ul> <p>If you are still unsure, call 07 3073 1616 or send an enquiry. Tell us briefly what is going on and our team will suggest a sensible first appointment. Individual results vary, and your practitioner will talk through what is realistic for you.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'hero-gym-bright.webp',
						'alt' => 'Open rehabilitation and exercise space with mats, rollers and strength equipment',
						'crop' => '--x:88%;--y:70%;--s:1.9',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'funding',
					'paper' => true,
					'tag' => 'Funding & referrals',
					'title' => 'Funding pathways across our services.',
					'intro' => 'Our services can be accessed through a range of funding pathways. Eligibility and availability differ by service and by person, so please check with our team before you book.',
					'body' => '<p>Each service page lists the pathways for that discipline. For example, Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service. If you are working with an insurer, case manager or support coordinator, we are happy to talk through their requirements. You will find the referral steps for GPs and other health professionals on our <a href="referrers.html">Referrers page</a>.</p>',
					'items' => array(
						array(
							'title' => 'Private',
							'text' => 'Book directly, no third party required',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'Work-related injury claims',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible chronic conditions via your GP',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Compulsory third party motor vehicle claims',
						),
						array(
							'title' => 'NDIS',
							'text' => 'Participants with funded supports',
						),
						array(
							'title' => 'DVA',
							'text' => 'Veteran Cards — Gold and White',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'Our services',
					'title' => 'Integrated allied health care, built around movement and long-term function.',
					'body' => '<p>BDYCULTURE Rehab & Performance Clinic brings four allied health disciplines together in Chermside: physiotherapy, exercise physiology, occupational therapy and clinical Pilates. Each one approaches your health from a different angle, and having them under one roof means your care does not have to stop at the consulting room door.</p> <p>Some people arrive with a clear question, such as a painful shoulder or a recent surgery. Others come with a longer story, perhaps a chronic condition, a workplace injury or a change in how they manage day-to-day tasks. Whatever the starting point, our practitioners begin by listening, assessing and explaining what they find in plain language before any plan is agreed.</p> <p>Our Chermside clinic combines clinical allied health care with a dedicated rehabilitation and exercise environment. That allows care to progress from assessment and symptom management through to strength, conditioning and long-term physical capacity, with seven consulting rooms and a fully equipped exercise space available as your plan develops.</p> <p>Below you will find an overview of each service, guidance on choosing where to start, and a summary of the funding pathways we work with. You can book online at any time, call the clinic on 07 3073 1616, or send an enquiry and our team will help you find the right starting point.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'BDYCULTURE rehabilitation gym in Chermside with strength equipment, cable machines and open exercise space',
						'crop' => '--x:30%;--y:62%;--s:1.35',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Questions about our services.',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or send us a message.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'Which service should I book first?',
							'a' => '<p>It depends on what brings you in. Physiotherapy suits pain, injury and post-operative recovery. Exercise physiology focuses on clinical exercise for chronic conditions and long-term health. Occupational therapy supports everyday function and independence. If you are unsure, call the clinic and our team will suggest a starting point.</p>',
							'open' => true,
						),
						array(
							'q' => 'Do I need a referral?',
							'a' => '<p>It depends on the service and the funding pathway. Private appointments can be booked online through Nookal. Funded pathways such as Medicare Chronic Condition Management, WorkCover Queensland, Queensland CTP, NDIS and DVA may have their own paperwork, so please check with us before you book.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can I see more than one practitioner?',
							'a' => '<p>Yes. Because physiotherapists, exercise physiologists and occupational therapists work from the same clinic, many people use more than one service over the course of their care. Your practitioners can stay across each other’s goals and plans.</p>',
							'open' => false,
						),
						array(
							'q' => 'Which funding pathways are available?',
							'a' => '<p>Private, WorkCover Queensland, Medicare Chronic Condition Management, Queensland CTP, NDIS and DVA Veteran Cards (Gold and White) are listed on our service pages. Availability differs by service, for example Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service.</p>',
							'open' => false,
						),
						array(
							'q' => 'Do you offer home visits?',
							'a' => '<p>Physiotherapy and exercise physiology home visits may be available by arrangement across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability. Contact our team to enquire.</p>',
							'open' => false,
						),
						array(
							'q' => 'Where is the clinic?',
							'a' => '<p>We are at 671 Gympie Road, Suite 5, Level 1, Chermside QLD 4032, Brisbane. Use the map at the bottom of this page for directions.</p>',
							'open' => false,
						),
					),
				),
			),
		),
		'physiotherapy' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Physiotherapy in Chermside',
					'lead' => 'Evidence-based Physiotherapy for pain, injury, post-operative recovery and movement limitations, supported by progressive rehabilitation in our dedicated clinic and exercise environment.',
					'crumb_current' => 'Physiotherapy',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
						array(
							'label' => 'Services',
							'url' => '/services/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'Private, WorkCover QLD, Medicare CDM, CTP, NDIS and DVA',
						'Home visits by arrangement',
					),
					'form' => true,
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'About physiotherapy',
					'title' => 'Physiotherapy that starts with understanding how you move.',
					'body' => '<p>Physiotherapy at BDYCULTURE begins with a conversation. Your physiotherapist wants to know what has changed, what you can no longer do comfortably and what you would like to get back to. They then assess how you move, explain what they find in plain language and agree a plan with you before treatment begins.</p> <p>Treatment can include hands-on techniques, guided movement, education and a progressive exercise program. Because our Chermside clinic includes a dedicated rehabilitation and exercise space, care can move from symptom management towards strength, conditioning and long-term physical capacity without sending you elsewhere to find the right equipment.</p> <p>Physiotherapy is one of four allied health services at the clinic, alongside exercise physiology, occupational therapy and clinical Pilates. If your needs change, the practitioners involved in your care work from the same building and can stay across your goals.</p> <p>Appointments can be booked online through Nookal in a couple of minutes, or you can call the clinic on 07 3073 1616. If you are referred by a GP, specialist, insurer or case manager, bring any referral details and reports with you.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'Physiotherapy rehabilitation space at BDYCULTURE in Chermside',
						'crop' => '--x:70%;--y:55%;--s:1.5',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'features',
					'variant' => '',
					'paper' => true,
					'tag' => 'How physiotherapy can help',
					'title' => 'How Physiotherapy Can Help',
					'intro' => 'Our Physiotherapists assess the factors contributing to pain, injury and movement limitations, then develop an individual treatment and rehabilitation plan focused on restoring function and helping you move with confidence.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'physiotherapy',
							'title' => 'Musculoskeletal Pain',
							'text' => 'Assessment and management of muscle, joint and soft-tissue pain, including what may be contributing to it and how it affects your day.',
						),
						array(
							'icon' => 'shield',
							'title' => 'Back & Neck Pain',
							'text' => 'Assessment, treatment and guided exercise for back and neck pain, with advice on movement and activity.',
						),
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Sports & Exercise Injuries',
							'text' => 'Treatment and rehabilitation for injuries that happen in sport, training or exercise, through to a supervised return to activity.',
						),
						array(
							'icon' => 'clinical-pilates',
							'title' => 'Joint, Muscle & Tendon Conditions',
							'text' => 'Assessment and a rehabilitation plan for conditions affecting joints, muscles and tendons.',
						),
						array(
							'icon' => 'home',
							'title' => 'Post-Operative Rehabilitation',
							'text' => 'Structured rehabilitation after surgery to rebuild movement, strength and confidence, alongside your surgeon’s guidance.',
						),
						array(
							'icon' => 'occupational-therapy',
							'title' => 'Persistent Pain & Reduced Function',
							'text' => 'Support for pain that has lasted, with a focus on restoring function and helping you move with confidence.',
						),
					),
				),
				array(
					'type' => 'steps',
					'dark' => true,
					'light' => false,
					'paper' => false,
					'tag' => 'What to expect',
					'title' => 'What to Expect From Physiotherapy',
					'intro' => 'Your Physiotherapist will assess your symptoms, movement and functional goals, explain the findings clearly, and develop a treatment and rehabilitation plan tailored to your needs.',
					'body' => '',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'outline-light',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'items' => array(
						array(
							'title' => 'Assessment',
							'text' => 'We assess your symptoms, movement, function and goals to understand what is contributing to the problem.',
						),
						array(
							'title' => 'Treatment',
							'text' => 'Your treatment plan may include hands-on therapy, education, exercise and strategies to improve movement and reduce symptoms.',
						),
						array(
							'title' => 'Progressive Rehabilitation',
							'text' => 'We progressively build strength, mobility and confidence to support recovery and long-term function.',
						),
					),
				),
				array(
					'type' => 'funding',
					'paper' => false,
					'tag' => 'Funding & referrals',
					'title' => 'Physiotherapy Funding & Referrals',
					'intro' => 'We support a range of private and referral pathways for physiotherapy, depending on eligibility and individual circumstances.',
					'body' => '<p>If you hold a referral, an approved claim or a funded plan, bring the details to your first appointment, or send them ahead through the enquiry form or by email. GPs and other health professionals can find the referral steps on our <a href="referrers.html">Referrers page</a>. Private patients can book directly online without a third party.</p>',
					'items' => array(
						array(
							'title' => 'Private Patients',
							'text' => 'Book directly with our Physiotherapy team. A referral is not required for private Physiotherapy.',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'We can support eligible workers with Physiotherapy following workplace injury, subject to claim and referral requirements.',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible patients may access Medicare-subsidised physiotherapy when referred under a GP Chronic Condition Management Plan.',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Physiotherapy may be provided as part of rehabilitation following a motor vehicle accident, subject to the relevant CTP insurer’s approval.',
						),
						array(
							'title' => 'NDIS',
							'text' => 'Physiotherapy may be provided where it is an appropriate funded therapy support within a participant’s NDIS plan.',
						),
						array(
							'title' => 'DVA Veteran Cards (Gold and White)',
							'text' => 'Accepted as payment upon a GP referral.',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => true,
					'tag' => 'When to see a physiotherapist',
					'title' => 'You do not need to wait until it gets worse.',
					'body' => '<p>Many people put off seeing a physiotherapist because they hope a problem will settle on its own. Sometimes it does, but early advice can make it clearer what is safe to keep doing and what to change. If something has been bothering you for more than a few days, has returned repeatedly, or is limiting work, sport or sleep, it is reasonable to get it assessed.</p> <h3>Consider booking if you:</h3> <ul class="checklist"> <li>have pain that is not settling, or that keeps coming back</li> <li>are recovering from surgery and want structured rehabilitation</li> <li>have been injured at work or in a motor vehicle accident and hold a claim</li> <li>feel stiff, weak or unsteady and are unsure why</li> <li>want a safe plan for returning to exercise after an injury</li> </ul> <p>If you experience sudden severe symptoms, chest pain, or loss of function after an accident, seek urgent medical help or call 000. This page is general information and is not a substitute for individual health advice.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'hero-gym-bright.webp',
						'alt' => 'Exercise equipment and open floor space used for physiotherapy rehabilitation',
						'crop' => '--x:50%;--y:45%;--s:1.5',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Physiotherapy FAQs',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or send us a message.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'Do I need a referral to see a Physiotherapist?',
							'a' => '<p>No referral is required for private Physiotherapy appointments. Some funded or insurance pathways may require a referral, claim approval or other documentation.</p>',
							'open' => true,
						),
						array(
							'q' => 'What should I expect at my first Physiotherapy appointment?',
							'a' => '<p>Your Physiotherapist will discuss your symptoms, medical history and goals, assess your movement and function, explain the findings and develop an individual treatment and rehabilitation plan.</p>',
							'open' => false,
						),
						array(
							'q' => 'What should I bring to my appointment?',
							'a' => '<p>Bring any relevant referrals, imaging, reports or claim information, and wear comfortable clothing that allows the affected area to be assessed where appropriate.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can Physiotherapy include exercise rehabilitation?',
							'a' => '<p>Yes. Where appropriate, Physiotherapy may include individually prescribed exercise in our dedicated rehabilitation and exercise environment to improve strength, mobility, function and confidence as part of your rehabilitation plan.</p>',
							'open' => false,
						),
						array(
							'q' => 'Do you offer physiotherapy home visits?',
							'a' => '<p>Physiotherapy and Exercise Physiology home visits may be available by arrangement, depending on location, clinical needs and practitioner availability. Please use the contact form to enquire.</p>',
							'open' => false,
						),
						array(
							'q' => 'Where is the clinic?',
							'a' => '<p>We are at 671 Gympie Road, Chermside QLD 4032, Suite 5, Level 1, with lift access available. Visitor parking is available at the rear of the building.</p>',
							'open' => false,
						),
					),
				),
				array(
					'type' => 'cta',
					'title' => 'Ready to Book Physiotherapy?',
					'text' => 'Book an appointment with our physiotherapy team in Chermside, or send a referral directly to the clinic.',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ink',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
				),
			),
		),
		'exercise-physiology' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Exercise Physiology in Chermside',
					'lead' => 'Evidence-based exercise physiology for chronic conditions, injury rehabilitation, strength, mobility and long-term health, delivered within our dedicated rehabilitation and exercise environment.',
					'crumb_current' => 'Exercise Physiology',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
						array(
							'label' => 'Services',
							'url' => '/services/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'Private, WorkCover QLD, Medicare CDM, CTP, NDIS and DVA',
						'Home visits by arrangement',
					),
					'form' => true,
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'About exercise physiology',
					'title' => 'Exercise, prescribed and supervised like a treatment.',
					'body' => '<p>Exercise physiology uses carefully planned, supervised exercise as the treatment. At BDYCULTURE, your exercise physiologist starts by understanding your health history, your current capacity and what you want to be able to do. They then design a program around you, rather than handing over a generic routine.</p> <p>Sessions take place in the clinic’s dedicated rehabilitation and exercise space, which sits alongside our consulting rooms. That means your exercise physiologist can explain what you are doing and why, adjust loads and movements on the spot, and progress your program as your capacity builds.</p> <p>Exercise physiology is often used for chronic conditions, for rehabilitation after injury, and for building strength, mobility and long-term health. It sits naturally alongside physiotherapy, occupational therapy and clinical Pilates, and because these practitioners work from the same clinic, your goals can stay consistent across your care.</p> <p>You can book online through Nookal in a couple of minutes, or call 07 3073 1616. If a GP, specialist, insurer or case manager has referred you, bring the referral details and any reports to your first appointment.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'hero-gym-bright.webp',
						'alt' => 'Strength and conditioning equipment in the BDYCULTURE exercise space, Chermside',
						'crop' => '--x:52%;--y:45%;--s:1.5',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'features',
					'variant' => '',
					'paper' => true,
					'tag' => 'How exercise physiology can help',
					'title' => 'How Exercise Physiology Can Help',
					'intro' => 'Our Accredited Exercise Physiologists assess your health, movement, strength and exercise capacity, then develop an individual exercise plan to support rehabilitation, chronic disease management and long-term function.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'physiotherapy',
							'title' => 'Chronic Disease Management',
							'text' => 'Exercise programs designed around a long-term health condition and planned with your health history in mind.',
						),
						array(
							'icon' => 'shield',
							'title' => 'Persistent Pain & Functional Recovery',
							'text' => 'Graded exercise to support function when pain has lasted, progressed at a pace that suits you.',
						),
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Injury & Musculoskeletal Rehabilitation',
							'text' => 'Supervised exercise to rebuild strength, control and confidence after an injury.',
						),
						array(
							'icon' => 'clinical-pilates',
							'title' => 'Healthy Ageing, Balance & Falls Prevention',
							'text' => 'Strength and balance work to support healthy ageing and everyday confidence.',
						),
						array(
							'icon' => 'home',
							'title' => 'Strength, Mobility & Deconditioning',
							'text' => 'Progressive programs to build strength and mobility when fitness or capacity has dropped.',
						),
						array(
							'icon' => 'occupational-therapy',
							'title' => 'Disability & Exercise Capacity Building',
							'text' => 'Exercise plans that build capacity and support disability-related mobility, function and wellbeing goals.',
						),
					),
				),
				array(
					'type' => 'steps',
					'dark' => true,
					'light' => false,
					'paper' => false,
					'tag' => 'What to expect',
					'title' => 'What to Expect From Exercise Physiology',
					'intro' => 'Your Accredited Exercise Physiologist will assess your health, movement, exercise capacity and goals, then develop an individual exercise plan tailored to your needs and current level of function.',
					'body' => '',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'outline-light',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'items' => array(
						array(
							'title' => 'Assessment',
							'text' => 'We review your health history, symptoms, movement, strength, fitness and functional goals to understand your starting point.',
						),
						array(
							'title' => 'Exercise Prescription',
							'text' => 'We develop an individual exercise program using appropriate strength, aerobic, mobility and balance training.',
						),
						array(
							'title' => 'Progression & Review',
							'text' => 'We progressively adjust your program as your capacity changes, with ongoing review to support rehabilitation and long-term function.',
						),
					),
				),
				array(
					'type' => 'funding',
					'paper' => false,
					'tag' => 'Funding & referrals',
					'title' => 'Exercise Physiology Funding & Referrals',
					'intro' => 'We support a range of private and referral pathways for Exercise Physiology, depending on eligibility, funding and individual circumstances.',
					'body' => '<p>If you hold a referral, an approved claim or a funded plan, bring the details to your first appointment or send them ahead using the enquiry form or by email. GPs and other health professionals can find the referral steps on our <a href="referrers.html">Referrers page</a>. Private patients can book directly online.</p>',
					'items' => array(
						array(
							'title' => 'Private Patients',
							'text' => 'Book directly with our Accredited Exercise Physiologists. No referral is required for private appointments.',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'Exercise Physiology may be provided for eligible work-related injuries, subject to claim requirements and insurer approval.',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible patients may access Medicare-subsidised Exercise Physiology when referred under a GP Chronic Condition Management Plan.',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Exercise Physiology may form part of rehabilitation following a motor vehicle injury, subject to the relevant CTP insurer’s approval.',
						),
						array(
							'title' => 'NDIS',
							'text' => 'Exercise Physiology may be funded where it meets NDIS funding criteria and supports disability-related mobility, function or wellbeing goals.',
						),
						array(
							'title' => 'DVA Veteran Cards (Gold and White)',
							'text' => 'Accepted as payment upon a GP referral.',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => true,
					'tag' => 'Who it suits',
					'title' => 'Exercise physiology is for more than athletes.',
					'body' => '<p>Many people assume exercise physiology is only for sport. In practice, it is used by people of many ages and abilities, particularly where exercise needs to be planned carefully around health history, pain or confidence. If you have been told to “get more active” but are not sure where to start, a supervised program can take the guesswork out of it.</p> <h3>You might consider exercise physiology if you:</h3> <ul class="checklist"> <li>are managing a chronic condition and want a safe plan for exercise</li> <li>are recovering from an injury and want to rebuild strength</li> <li>want help to improve strength, mobility or general fitness</li> <li>have a GP-supported chronic condition plan, or a funded claim or plan</li> <li>feel unsure how hard to push and want clear guidance</li> </ul> <p>If you experience chest pain, severe breathlessness or sudden unexplained symptoms, stop and seek urgent medical help or call 000. This page is general information and is not a substitute for individual health advice.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'Cable machines and free weights in the BDYCULTURE rehabilitation gym',
						'crop' => '--x:75%;--y:55%;--s:1.5',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Exercise Physiology FAQs',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or send us a message.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'Do I need a referral to see an Exercise Physiologist?',
							'a' => '<p>No referral is required for private Exercise Physiology appointments. Some funded or insurance pathways may require a referral, approval or other documentation.</p>',
							'open' => true,
						),
						array(
							'q' => 'What should I expect at my first Exercise Physiology appointment?',
							'a' => '<p>Your Accredited Exercise Physiologist will discuss your health history, current symptoms, activity levels and goals, assess relevant aspects of your movement and exercise capacity, and develop an individual exercise plan.</p>',
							'open' => false,
						),
						array(
							'q' => 'What should I bring to my appointment?',
							'a' => '<p>Bring any relevant referrals, medical reports, imaging, medication information or claim details, and wear comfortable clothing suitable for movement and exercise.</p>',
							'open' => false,
						),
						array(
							'q' => 'Is Exercise Physiology only for people with injuries?',
							'a' => '<p>No. Exercise Physiology may support people with chronic health conditions, musculoskeletal injuries, persistent pain, deconditioning, reduced mobility, disability-related goals and healthy ageing.</p>',
							'open' => false,
						),
						array(
							'q' => 'Do you offer exercise physiology home visits?',
							'a' => '<p>Physiotherapy and Exercise Physiology home visits may be available by arrangement, depending on location, clinical needs and practitioner availability. Please use the contact form to enquire.</p>',
							'open' => false,
						),
						array(
							'q' => 'Where is the clinic?',
							'a' => '<p>We are at 671 Gympie Road, Chermside QLD 4032, Suite 5, Level 1, with lift access available. Visitor parking is available at the rear of the building.</p>',
							'open' => false,
						),
					),
				),
				array(
					'type' => 'cta',
					'title' => 'Ready to Book Exercise Physiology?',
					'text' => 'Book an appointment with our Accredited Exercise Physiologists in Chermside, or send a referral directly to the clinic.',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ink',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
				),
			),
		),
		'occupational-therapy' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Occupational Therapy in Chermside',
					'lead' => 'Occupational Therapy focused on improving independence, safety and participation in everyday activities, with assessment and practical strategies tailored to your individual needs and goals.',
					'crumb_current' => 'Occupational Therapy',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
						array(
							'label' => 'Services',
							'url' => '/services/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'Private, WorkCover QLD, Medicare CDM, CTP, NDIS and DVA',
						'Home visits by arrangement',
					),
					'form' => true,
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'About occupational therapy',
					'title' => 'Occupational therapy starts with what matters in your day.',
					'body' => '<p>In occupational therapy, “occupation” simply means the everyday things you need, want or are expected to do: getting ready in the morning, working, caring for others, cooking, getting around, enjoying hobbies. Your occupational therapist looks at what makes those activities harder than they should be and works with you on practical ways to change that.</p> <p>An assessment may consider your physical abilities, your environment and your routines, as well as what you want to achieve. From there, your therapist agrees a plan with you, which might include strategies, practice, adjustments to how tasks are done, or recommendations about equipment and supports.</p> <p>Occupational therapy at BDYCULTURE sits alongside physiotherapy, exercise physiology and clinical Pilates in the same Chermside clinic. If your plan includes strength, conditioning or movement work, those practitioners are close by and can stay across your goals.</p> <p>You can book online through Nookal, call 07 3073 1616, or send an enquiry. If an insurer, case manager, support coordinator or GP has referred you, bring the details and any reports to your first appointment.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'hero-gym-bright.webp',
						'alt' => 'Bright, open therapy and exercise space at BDYCULTURE in Chermside',
						'crop' => '--x:8%;--y:55%;--s:1.9',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'features',
					'variant' => '',
					'paper' => true,
					'tag' => 'How occupational therapy can help',
					'title' => 'How Occupational Therapy Can Help',
					'intro' => 'Our Occupational Therapists assess how injury, illness, disability and environmental factors affect your ability to manage everyday activities, then develop practical strategies to support independence, safety and participation.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'physiotherapy',
							'title' => 'Daily Activities & Independence',
							'text' => 'Practical support for the everyday tasks that matter to you, to help you do more for yourself.',
						),
						array(
							'icon' => 'shield',
							'title' => 'Functional Capacity & Participation',
							'text' => 'Assessment of what you can do now and strategies to support participation in the activities you value.',
						),
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Home & Community Function',
							'text' => 'Support for managing at home and getting out and about in your community.',
						),
						array(
							'icon' => 'clinical-pilates',
							'title' => 'Disability & Capacity Building',
							'text' => 'Strategies and supports that build capacity and support disability-related functional goals.',
						),
						array(
							'icon' => 'home',
							'title' => 'Return to Work & Productive Roles',
							'text' => 'Support for returning to work and other productive roles after injury or illness.',
						),
						array(
							'icon' => 'occupational-therapy',
							'title' => 'Healthy Ageing & Falls Prevention',
							'text' => 'Practical strategies to support safety and independence as you age.',
						),
					),
				),
				array(
					'type' => 'steps',
					'dark' => true,
					'light' => false,
					'paper' => false,
					'tag' => 'What to expect',
					'title' => 'What to Expect From Occupational Therapy',
					'intro' => 'Your Occupational Therapist will discuss your health, daily activities and goals, assess the factors affecting your function and participation, and develop practical strategies tailored to your individual needs.',
					'body' => '',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'outline-light',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'items' => array(
						array(
							'title' => 'Assessment',
							'text' => 'We review your health, daily routines, functional abilities, environment and goals to understand the barriers affecting your independence and participation.',
						),
						array(
							'title' => 'Strategies & Intervention',
							'text' => 'Your plan may include task-specific practice, education, practical strategies, environmental modifications and equipment recommendations where appropriate.',
						),
						array(
							'title' => 'Progression & Review',
							'text' => 'We review your progress and adjust strategies as your needs change to support greater independence, safety and participation in everyday life.',
						),
					),
				),
				array(
					'type' => 'funding',
					'paper' => false,
					'tag' => 'Funding & referrals',
					'title' => 'Occupational Therapy Funding & Referrals',
					'intro' => 'We support a range of private and referral pathways for Occupational Therapy, depending on eligibility, funding and individual circumstances.',
					'body' => '<p>If you have an NDIS plan, a WorkCover or CTP claim, or another funded arrangement, bring the relevant details to your first appointment or send them ahead. Insurers, case managers and support coordinators are welcome to contact our team, and GPs can find the referral steps on our <a href="referrers.html">Referrers page</a>.</p>',
					'items' => array(
						array(
							'title' => 'Private Patients',
							'text' => 'Book directly with our Occupational Therapists. A referral is not required for private Occupational Therapy.',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'Occupational Therapy may be provided for eligible work-related injuries, subject to claim requirements and insurer approval.',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible patients may access Medicare-subsidised Occupational Therapy when referred under a GP Chronic Condition Management Plan.',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Occupational Therapy may form part of rehabilitation following a motor vehicle injury, subject to the relevant CTP insurer’s approval.',
						),
						array(
							'title' => 'NDIS',
							'text' => 'Occupational Therapy may be funded where it meets NDIS funding criteria and supports disability-related functional goals.',
						),
						array(
							'title' => 'DVA Veteran Cards (Gold and White)',
							'text' => 'Accepted as payment upon a GP referral.',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => true,
					'tag' => 'Who it suits',
					'title' => 'Occupational therapy is about your everyday life.',
					'body' => '<p>People are often referred to occupational therapy after an injury, illness or change in circumstances, but you do not need a dramatic event to benefit. If everyday tasks are taking more effort than they used to, or you are worried about safety or independence, an assessment can clarify what is going on and what might help.</p> <h3>You might consider occupational therapy if you:</h3> <ul class="checklist"> <li>find some daily tasks harder than they used to be</li> <li>are returning to work, study or activities after an injury or illness</li> <li>want to maintain independence at home</li> <li>have an NDIS plan, WorkCover or CTP claim that includes occupational therapy</li> <li>would like practical strategies rather than general advice</li> </ul> <p>If you are worried about your immediate safety or experience a medical emergency, call 000. This page is general information and is not a substitute for individual health advice.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'Open practice space at the BDYCULTURE clinic in Chermside',
						'crop' => '--x:30%;--y:58%;--s:1.35',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Occupational Therapy FAQs',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or send us a message.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'Do I need a referral to see an Occupational Therapist?',
							'a' => '<p>No referral is required for private Occupational Therapy appointments. Some funded or insurance pathways may require a referral, approval or other documentation.</p>',
							'open' => true,
						),
						array(
							'q' => 'What should I expect at my first Occupational Therapy appointment?',
							'a' => '<p>Your Occupational Therapist will discuss your health, daily activities, current challenges and goals, and assess the factors affecting your function, independence and participation.</p>',
							'open' => false,
						),
						array(
							'q' => 'What should I bring to my appointment?',
							'a' => '<p>Bring any relevant referrals, medical reports, assessments, equipment information or claim details that may help your Occupational Therapist understand your needs.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can Occupational Therapy help with equipment or changes to my environment?',
							'a' => '<p>Where appropriate, Occupational Therapy may include recommendations for equipment, assistive technology or environmental modifications to support safety, independence and everyday function.</p>',
							'open' => false,
						),
						array(
							'q' => 'Where is the clinic?',
							'a' => '<p>We are at 671 Gympie Road, Chermside QLD 4032, Suite 5, Level 1, with lift access available. Visitor parking is available at the rear of the building.</p>',
							'open' => false,
						),
						array(
							'q' => 'Which funding pathways are available?',
							'a' => '<p>Private, WorkCover Queensland, Medicare Chronic Condition Management, Queensland CTP, NDIS and DVA Veteran Cards (Gold and White), depending on eligibility and individual circumstances. Please confirm with our team before booking.</p>',
							'open' => false,
						),
					),
				),
				array(
					'type' => 'cta',
					'title' => 'Ready to Book Occupational Therapy?',
					'text' => 'Book an appointment with our Occupational Therapists in Chermside, or send a referral directly to the clinic.',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ink',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
				),
			),
		),
		'clinical-pilates' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Clinical Pilates in Chermside',
					'lead' => 'Clinical Pilates combines individually prescribed Pilates-based exercise with rehabilitation principles to improve strength, movement, control and physical capacity in a supervised clinical environment.',
					'crumb_current' => 'Clinical Pilates',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
						array(
							'label' => 'Services',
							'url' => '/services/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'Led by an AEP or Physiotherapist',
						'Private, WorkCover QLD, Medicare CDM, CTP and NDIS',
					),
					'form' => true,
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'About clinical Pilates',
					'title' => 'Pilates, guided by clinical assessment.',
					'body' => '<p>Clinical Pilates uses Pilates-based exercise within a rehabilitation setting. At BDYCULTURE it is delivered by our Physiotherapists and Accredited Exercise Physiologists, so each session is shaped by an assessment of you rather than a one-size-fits-all class format.</p> <p>Your practitioner begins by understanding your history, your goals and how you move. They then select and adapt exercises to support rehabilitation, strength, movement and physical capacity, explaining the purpose of each one so you understand what you are working on and why.</p> <p>Because clinical Pilates is part of the same Chermside clinic as physiotherapy, exercise physiology and occupational therapy, it can sit comfortably within a broader plan. For some people it follows treatment; for others it runs alongside it, supported by the clinic’s rehabilitation and exercise space.</p> <p>You can book online through Nookal, call 07 3073 1616, or send an enquiry. If you have been referred, bring the details and any reports to your first appointment. Clinical Pilates is available as one-to-one private sessions or small-group sessions, using reformer, mat and other Pilates-based exercises.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'hero-gym-bright.webp',
						'alt' => 'Exercise mat and foam roller in the BDYCULTURE movement space, Chermside',
						'crop' => '--x:96%;--y:78%;--s:2.2',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'features',
					'variant' => '',
					'paper' => true,
					'tag' => 'How clinical Pilates can help',
					'title' => 'How Clinical Pilates Can Help',
					'intro' => 'Our Physiotherapists and Accredited Exercise Physiologists use individually prescribed Pilates-based exercise to support rehabilitation, strength, movement control, mobility and physical capacity, delivered through one-to-one private sessions or small-group Clinical Pilates classes, with exercises progressed according to your needs and goals.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'physiotherapy',
							'title' => 'Strength & Conditioning',
							'text' => 'Controlled, progressive exercises that build strength, with technique coached as you go.',
						),
						array(
							'icon' => 'shield',
							'title' => 'Movement Control & Coordination',
							'text' => 'Attention to how you move, including control and coordination, to support everyday activities.',
						),
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Injury Rehabilitation',
							'text' => 'Pilates-based exercise that can form part of rehabilitation after an injury.',
						),
						array(
							'icon' => 'clinical-pilates',
							'title' => 'Post-Operative Rehabilitation',
							'text' => 'Exercise that can be modified and progressed as part of rehabilitation after surgery, where appropriate.',
						),
						array(
							'icon' => 'home',
							'title' => 'Mobility & Flexibility',
							'text' => 'Exercises that support mobility and flexibility, matched to your current capacity.',
						),
						array(
							'icon' => 'occupational-therapy',
							'title' => 'Balance & Functional Capacity',
							'text' => 'Work on balance and functional capacity, progressed according to your needs and goals.',
						),
					),
				),
				array(
					'type' => 'steps',
					'dark' => true,
					'light' => false,
					'paper' => false,
					'tag' => 'What to expect',
					'title' => 'What to Expect From Clinical Pilates',
					'intro' => 'Your Physiotherapist or Accredited Exercise Physiologist will assess your movement, strength, physical capacity and goals, then develop an individual Clinical Pilates program suited to your needs and current level of function.',
					'body' => '',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'outline-light',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'items' => array(
						array(
							'title' => 'Assessment',
							'text' => 'We assess your movement, strength, function, health history and goals to understand your starting point and determine an appropriate exercise approach.',
						),
						array(
							'title' => 'Individualised Exercise',
							'text' => 'Your program may use reformer, mat and other Pilates-based exercises selected and adapted to support your rehabilitation, strength, mobility and movement control.',
						),
						array(
							'title' => 'Progression & Review',
							'text' => 'Exercises are progressively adjusted as your capacity changes, with ongoing review to ensure your program remains appropriate to your needs and goals.',
						),
					),
				),
				array(
					'type' => 'funding',
					'paper' => false,
					'tag' => 'Funding & referrals',
					'title' => 'Funding & Referral Pathways',
					'intro' => 'Clinical Pilates is not a standalone funding category. Depending on your eligibility, Pilates-based exercise may form part of an eligible Physiotherapy or Exercise Physiology service under some funding and insurance pathways.',
					'body' => '<p>If you hold a referral, an approved claim or a funded plan, bring the details to your first appointment or send them ahead using the enquiry form or by email. GPs and other health professionals can find the referral steps on our <a href="referrers.html">Referrers page</a>. Private patients can book directly online.</p>',
					'items' => array(
						array(
							'title' => 'Private Sessions',
							'text' => 'Private one-to-one and small-group Clinical Pilates sessions are available. A referral is not required for private sessions.',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'Pilates may form part of treatment delivered by a registered Physiotherapist or Exercise Physiologist, subject to applicable WorkCover Queensland claim and approval requirements.',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible individual Physiotherapy or Exercise Physiology services may attract a Medicare benefit under a GP Chronic Condition Management Plan. Pilates-based exercise may be incorporated into these services where clinically appropriate.',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Pilates-based exercise may form part of reasonable and appropriate treatment or rehabilitation following a motor vehicle injury, subject to the relevant CTP insurer’s approval.',
						),
						array(
							'title' => 'NDIS',
							'text' => 'NDIS funding may apply to eligible Physiotherapy or Exercise Physiology therapy supports where Pilates-based exercise is used as part of that therapy and the support meets NDIS funding criteria.',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => true,
					'tag' => 'Clinical vs general Pilates',
					'title' => 'How clinical Pilates differs from a general class.',
					'body' => '<p>General Pilates classes can be a great way to stay active, but they are usually designed for a group. Clinical Pilates is different because the person guiding you is a qualified clinician who has assessed you, and the exercises are chosen and modified around your history and goals.</p> <h3>You might consider clinical Pilates if you:</h3> <ul class="checklist"> <li>want movement-based rehabilitation with close professional guidance</li> <li>are building strength and control after an injury or procedure</li> <li>prefer an individualised approach to a group class</li> <li>want exercise to complement physiotherapy or exercise physiology</li> <li>hold a funded claim or plan that includes clinical Pilates</li> </ul> <p>If you experience sudden severe symptoms or a medical emergency, call 000. This page is general information and is not a substitute for individual health advice.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'Open movement and exercise floor at BDYCULTURE, Chermside',
						'crop' => '--x:45%;--y:62%;--s:1.4',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Clinical Pilates FAQs',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or send us a message.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'Do I need a referral for Clinical Pilates?',
							'a' => '<p>No referral is required for private Clinical Pilates sessions. Some funded or insurance pathways may require a referral, approval or other documentation.</p>',
							'open' => true,
						),
						array(
							'q' => 'What should I expect at my first Clinical Pilates session?',
							'a' => '<p>Your Physiotherapist or Accredited Exercise Physiologist will discuss your health, movement, current capacity and goals, assess your individual needs and develop an appropriate Pilates-based exercise program.</p>',
							'open' => false,
						),
						array(
							'q' => 'Are Clinical Pilates sessions one-to-one or small group?',
							'a' => '<p>Both options are available. One-to-one sessions allow for individual assessment and closely supervised exercise, while small-group sessions may be appropriate once your needs, goals and exercise program have been established.</p>',
							'open' => false,
						),
						array(
							'q' => 'Is Clinical Pilates suitable for injury rehabilitation or after surgery?',
							'a' => '<p>Clinical Pilates may form part of rehabilitation following injury or surgery where it is considered appropriate for your individual circumstances. Exercises can be modified and progressed according to your current capacity, recovery and goals.</p>',
							'open' => false,
						),
						array(
							'q' => 'Who delivers Clinical Pilates?',
							'a' => '<p>Clinical Pilates is delivered by our Physiotherapists and Accredited Exercise Physiologists.</p>',
							'open' => false,
						),
						array(
							'q' => 'Where is the clinic?',
							'a' => '<p>We are at 671 Gympie Road, Chermside QLD 4032, Suite 5, Level 1, with lift access available. Visitor parking is available at the rear of the building.</p>',
							'open' => false,
						),
					),
				),
				array(
					'type' => 'cta',
					'title' => 'Ready to Book Clinical Pilates?',
					'text' => 'Book a one-to-one or small-group Clinical Pilates session with our Physiotherapists and Accredited Exercise Physiologists in Chermside, or send a referral directly to the clinic.',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ink',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
				),
			),
		),
		'referrers' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Refer to BDYCULTURE',
					'lead' => 'Refer patients to our multidisciplinary team for Physiotherapy, Exercise Physiology, Occupational Therapy and rehabilitation-focused care in Chermside.',
					'crumb_current' => 'Referrers',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Email referrals@bdyculture.com.au',
						'Phone 07 3073 1616',
						'Online booking via Nookal',
					),
					'form' => true,
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'Referrers · Chermside',
					'title' => 'Allied Health Referrals Chermside',
					'body' => '<p>Send referrals directly to our team for Physiotherapy, Exercise Physiology, Occupational Therapy and multidisciplinary rehabilitation.</p> <h3>Refer a Patient</h3> <p><a href="mailto:referrals@bdyculture.com.au?subject=Patient%20Referral%20%E2%80%93%20BDYCULTURE">referrals@bdyculture.com.au</a></p> <p>Please include the patient’s contact details, relevant clinical information and any supporting referral documents where available.</p> <p>For sensitive health information, we recommend using your organisation’s secure messaging system or an encrypted/password-protected attachment where available.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => '',
						'alt' => '',
						'crop' => '',
					),
					'panel' => array(
						'kind' => 'note-card',
						'title' => 'Need to Discuss a Referral?',
						'body' => '<p>Patients can also book online through Nookal, and our team can help with funding questions before the first appointment.</p>',
						'rows' => array(

						),
						'links' => array(

						),
						'buttons' => array(
							array(
								'text' => '07 3073 1616',
								'url' => 'tel:0730731616',
								'style' => 'signal',
								'new_tab' => false,
								'icon' => 'phone',
							),
							array(
								'text' => 'Book Online',
								'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
								'style' => 'outline-light',
								'new_tab' => true,
								'icon' => '',
							),
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'For referrers',
					'title' => 'A joined-up team for the patients you refer.',
					'body' => '<p>BDYCULTURE Rehab & Performance Clinic is a multidisciplinary clinic in Chermside combining physiotherapy, exercise physiology, occupational therapy and clinical Pilates with a dedicated rehabilitation and exercise environment. For referrers, that means one clinic to contact for patients whose care may need more than one discipline.</p> <p>Our practitioners work from the same building, so the people involved in a patient’s care can stay across goals and progress. Care can move from assessment and symptom management through to strength, conditioning and long-term physical capacity, without the patient needing to be sent elsewhere for the exercise component of their plan.</p> <p>We welcome referrals from GPs, specialists, allied health professionals, insurers, case managers and support coordinators. Patients can also book themselves online through Nookal if they prefer, and referrers are welcome to encourage that where it suits the patient.</p> <p>The sections below set out how to send a referral, what is helpful to include, the funding pathways we work with and some practical notes on secure communication. If you would like to speak to someone first, call the clinic on 07 3073 1616.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'Rehabilitation and exercise space at BDYCULTURE, Chermside',
						'crop' => '--x:45%;--y:58%;--s:1.4',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'steps',
					'dark' => false,
					'light' => true,
					'paper' => true,
					'tag' => 'How to refer',
					'title' => 'Three steps to send a referral.',
					'intro' => 'The process is deliberately simple. Referrals are sent by email, with phone and online options for patients.',
					'body' => '',
					'buttons' => array(
						array(
							'text' => 'Email a referral',
							'url' => 'mailto:referrals@bdyculture.com.au?subject=Patient%20Referral%20%E2%80%93%20BDYCULTURE',
							'style' => 'ink',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'items' => array(
						array(
							'title' => 'Email the referral',
							'text' => 'Send your referral to <a href="mailto:referrals@bdyculture.com.au?subject=Patient%20Referral%20%E2%80%93%20BDYCULTURE">referrals@bdyculture.com.au</a> with the subject line “Patient Referral – BDYCULTURE”. Please state which service you are referring to, or ask us to recommend one.',
						),
						array(
							'title' => 'Tell the patient',
							'text' => 'Let your patient know the referral is on its way. They can book online through Nookal or call 07 3073 1616. Patients who prefer help with booking are welcome to phone the clinic.',
						),
						array(
							'title' => 'We take it from there',
							'text' => 'Our team confirms the funding pathway, books the first appointment and the treating practitioner begins with an assessment. If you need to discuss a patient, call the clinic.',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => false,
					'tag' => 'What to include',
					'title' => 'Helpful details for your referral.',
					'body' => '<p>Please include the patient’s contact details, relevant clinical information and any supporting referral documents where available. The more context we receive, the easier it is to book the right practitioner and prepare for the first appointment. As a guide, the following is helpful where it is appropriate to share.</p> <ul class="checklist"> <li>The patient’s name, date of birth and best contact number</li> <li>The service you are referring to, or a request for our recommendation</li> <li>The reason for referral and any relevant history, reports or imaging</li> <li>The funding pathway, with claim, plan or referral numbers where relevant</li> <li>Any precautions, contraindications or goals you would like us to know about</li> <li>Your name, practice details and preferred way to receive updates</li> </ul> <h3>Secure communication</h3> <p>For sensitive health information, we recommend using your organisation’s secure messaging system or an encrypted/password-protected attachment where available. If you are unsure how to send a referral securely, call the clinic on 07 3073 1616 and we will help.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => '',
						'alt' => '',
						'crop' => '',
					),
					'panel' => array(
						'kind' => 'note-card',
						'title' => 'Referral contacts',
						'body' => '',
						'rows' => array(
							array(
								'label' => 'Email',
								'value' => '<a href="mailto:referrals@bdyculture.com.au">referrals@bdyculture.com.au</a>',
							),
							array(
								'label' => 'Phone',
								'value' => '<a href="tel:0730731616">07 3073 1616</a>',
							),
							array(
								'label' => 'Address',
								'value' => '671 Gympie Road, Suite 5, Level 1<br>Chermside QLD 4032',
							),
							array(
								'label' => 'Subject line',
								'value' => 'Patient Referral – BDYCULTURE',
							),
						),
						'links' => array(

						),
						'buttons' => array(

						),
					),
				),
				array(
					'type' => 'funding',
					'paper' => true,
					'tag' => 'Services & funding',
					'title' => 'Services and pathways we work with.',
					'intro' => 'You can refer to any of our four services, and funding is confirmed by our team before the first appointment.',
					'body' => '<p>Physiotherapy, exercise physiology, occupational therapy and clinical Pilates are each described on their own page, including who they can help and how a first appointment runs. The funding pathways listed here apply across our services, although availability differs by service. For example, Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service. If you are unsure whether a pathway applies to your patient, call us and we will check.</p>',
					'items' => array(
						array(
							'title' => 'Private',
							'text' => 'Book directly, no third party required',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'Work-related injury claims',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible chronic conditions via the patient’s GP',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Compulsory third party motor vehicle claims',
						),
						array(
							'title' => 'NDIS',
							'text' => 'Participants with funded supports',
						),
						array(
							'title' => 'DVA',
							'text' => 'Veteran Cards — Gold and White',
						),
					),
				),
				array(
					'type' => 'faq',
					'tag' => 'Referrer FAQs',
					'title' => 'Questions from referrers.',
					'intro' => 'For anything not covered here, call <a href="tel:0730731616">07 3073 1616</a>.',
					'body' => '',
					'btn_text' => 'Send a message',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'How do I send a referral?',
							'a' => '<p>Email referrals@bdyculture.com.au with the subject line “Patient Referral – BDYCULTURE”, including the patient’s details, the service you are referring to and the reason for referral. You can also call the clinic on 07 3073 1616.</p>',
							'open' => true,
						),
						array(
							'q' => 'Which services can I refer to?',
							'a' => '<p>Physiotherapy, exercise physiology, occupational therapy and clinical Pilates. If you are not sure which suits your patient, say so in the referral and our team will recommend a starting point.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can patients book themselves?',
							'a' => '<p>Yes. Patients can book online through Nookal or call the clinic. Some funding pathways need referral details or claim information to be confirmed first, which our team can help with.</p>',
							'open' => false,
						),
						array(
							'q' => 'Which funding pathways do you accept?',
							'a' => '<p>Private, WorkCover Queensland, Medicare Chronic Condition Management, Queensland CTP, NDIS and DVA Veteran Cards (Gold and White). Availability differs by service, so please check with us for your patient.</p>',
							'open' => false,
						),
						array(
							'q' => 'How is patient information kept secure?',
							'a' => '<p>Please use secure messaging where it is available to you and avoid sending identifiable health information over unsecured channels. Our privacy policy explains how BDYCULTURE handles personal information. If you need help sending a referral securely, call the clinic.</p>',
							'open' => false,
						),
						array(
							'q' => 'Will I receive updates on my patient?',
							'a' => '<p>Tell us in your referral how you would like to receive updates and we will do our best to accommodate that, in line with the patient’s consent and privacy requirements.</p>',
							'open' => false,
						),
					),
				),
			),
		),
		'contact' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Contact BDYCULTURE Chermside',
					'lead' => 'Contact our team, book an appointment or find directions to the clinic.',
					'crumb_current' => 'Contact',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Email the clinic',
							'url' => 'mailto:hello@bdyculture.com.au',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'Call 07 3073 1616',
						'Referrals welcome',
					),
					'form' => false,
				),
				array(
					'type' => 'ways',
					'items' => array(
						array(
							'icon' => 'calendar',
							'title' => 'Book online',
							'text' => 'Choose a time through Nookal',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'new_tab' => true,
						),
						array(
							'icon' => 'phone',
							'title' => 'Call the clinic',
							'text' => '07 3073 1616',
							'url' => 'tel:0730731616',
							'new_tab' => false,
						),
						array(
							'icon' => 'mail',
							'title' => 'Email us',
							'text' => 'hello@bdyculture.com.au',
							'url' => 'mailto:hello@bdyculture.com.au',
							'new_tab' => false,
						),
						array(
							'icon' => 'arrow',
							'title' => 'Refer a patient',
							'text' => 'referrals@bdyculture.com.au',
							'url' => '/referrers/',
							'new_tab' => false,
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => true,
					'tag' => 'Contact & location · Chermside',
					'title' => 'Find BDYCULTURE at:',
					'body' => '<p><strong>671 Gympie Road, Chermside QLD 4032</strong><br>Suite 5, Level 1</p> <p>Contact our team, book an appointment or find directions to the clinic.</p> <p><a class="btn btn--ink btn--lg" href="tel:0730731616">☏ 07 3073 1616</a></p> <h3>Getting Here</h3> <p>Enter 671 Gympie Road, Chermside QLD 4032 into your GPS or maps app. BDYCULTURE is located at Suite 5, Level 1, with lift access available.</p> <p>Visitor parking is available at the rear of the building, with additional 3-hour parking within the adjacent precinct.</p> <h3>Home Visit Enquiries</h3> <p>Physiotherapy and Exercise Physiology home visits may be available by arrangement, depending on location, clinical needs and practitioner availability. Please use the contact form below to enquire.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => '',
						'alt' => '',
						'crop' => '',
					),
					'panel' => array(
						'kind' => 'note-card',
						'title' => 'Clinic details',
						'body' => '',
						'rows' => array(
							array(
								'label' => 'Address',
								'value' => '671 Gympie Road<br>Suite 5, Level 1<br>Chermside QLD 4032',
							),
							array(
								'label' => 'Phone',
								'value' => '<a href="tel:0730731616">07 3073 1616</a>',
							),
							array(
								'label' => 'Email',
								'value' => '<a href="mailto:hello@bdyculture.com.au">hello@bdyculture.com.au</a>',
							),
							array(
								'label' => 'Referrals',
								'value' => '<a href="mailto:referrals@bdyculture.com.au">referrals@bdyculture.com.au</a>',
							),
						),
						'links' => array(

						),
						'buttons' => array(

						),
					),
				),
			),
		),
		'location-chermside' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Allied Health & Physiotherapy in Chermside',
					'lead' => 'A multidisciplinary clinic on Gympie Road, Chermside, combining physiotherapy, exercise physiology, occupational therapy and clinical Pilates with a rehab and exercise space.',
					'crumb_current' => 'Chermside',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
						array(
							'label' => 'Services',
							'url' => '/services/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Online booking via Nookal',
						'671 Gympie Road, Chermside',
						'Home visits by arrangement',
					),
					'form' => true,
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'Our Chermside clinic',
					'title' => 'Allied health care on Gympie Road, in the heart of Chermside.',
					'body' => '<p>BDYCULTURE Rehab & Performance Clinic is based at 671 Gympie Road, Suite 5, Level 1, Chermside. We are a multidisciplinary clinic, which means physiotherapy, exercise physiology, occupational therapy and clinical Pilates are all delivered from the same address, with a dedicated rehabilitation and exercise space alongside seven consulting rooms.</p> <p>For people who live or work in and around Chermside, that makes it simpler to organise care. You can book one appointment or several, see the practitioner who suits each stage of your plan, and keep everything in one place rather than travelling between separate clinics and gyms.</p> <p>Our Chermside clinic combines clinical allied health care with a dedicated rehabilitation and exercise environment, allowing care to progress from assessment and symptom management through to strength, conditioning and long-term physical capacity.</p> <p>Whether you are recovering from surgery, managing pain, building strength after an injury, or looking for support with everyday tasks, our team can help you work out where to start. Book online through Nookal, call 07 3073 1616, or use the enquiry form on this page.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'BDYCULTURE rehabilitation and exercise space in Chermside, Brisbane',
						'crop' => '--x:35%;--y:60%;--s:1.3',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'svc_mini',
					'paper' => true,
					'tag' => 'Services in Chermside',
					'title' => 'Four allied health services, one Chermside address.',
					'intro' => 'Each service has its own page with detail on who it can help, what to expect and the funding pathways that apply.',
					'body' => '',
					'items' => array(
						array(
							'title' => 'Physiotherapy',
							'text' => 'Pain, injury, post-operative recovery and movement limitations.',
							'url' => '/physiotherapy/',
						),
						array(
							'title' => 'Exercise Physiology',
							'text' => 'Clinical exercise for chronic conditions, strength, mobility and long-term health.',
							'url' => '/exercise-physiology/',
						),
						array(
							'title' => 'Occupational Therapy',
							'text' => 'Independence, daily function, participation and everyday activities.',
							'url' => '/occupational-therapy/',
						),
						array(
							'title' => 'Clinical Pilates',
							'text' => 'Pilates-based rehabilitation led by an AEP or Physiotherapist.',
							'url' => '/clinical-pilates/',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => true,
					'paper' => false,
					'tag' => 'Finding the clinic',
					'title' => 'How to find us in Chermside.',
					'body' => '<p>The clinic is at <strong>671 Gympie Road, Suite 5, Level 1, Chermside QLD 4032</strong>. Gympie Road is one of Brisbane’s main northern routes, so the clinic is easy to place on a map or a navigation app. Our address is on Level 1, so please allow a little time to find Suite 5 on your first visit.</p> <p>The interactive map at the bottom of this page shows the clinic location and lets you switch between street and satellite views. Use the “Get directions” button to open turn-by-turn directions in Google Maps from wherever you are.</p> <h3>Before you arrive</h3> <p>Enter 671 Gympie Road, Chermside QLD 4032 into your GPS or maps app. BDYCULTURE is located at Suite 5, Level 1, with lift access available.</p> <p>Visitor parking is available at the rear of the building, with additional 3-hour parking within the adjacent precinct.</p> <h3>Before you arrive</h3> <ul class="checklist"> <li>Book online through Nookal, or call 07 3073 1616 if you would like help</li> <li>Bring any referral letters, reports, imaging and claim or plan details</li> <li>Wear comfortable clothing that lets you move</li> </ul>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'hero-gym-bright.webp',
						'alt' => 'Open exercise floor at the Chermside clinic',
						'crop' => '--x:40%;--y:50%;--s:1.4',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'suburbs',
					'paper' => true,
					'tag' => 'Around Chermside',
					'title' => 'Serving Chermside and surrounding suburbs.',
					'intro' => 'People visit us from across Brisbane’s northern suburbs, and home visits may be available by arrangement.',
					'body' => '<p>Physiotherapy and exercise physiology home visits may be available across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability. If a visit to the clinic is difficult, contact our team to ask what can be arranged.</p> <p>Suburbs nearby include the areas below. Each one will have its own dedicated page as the site grows, so you can see how we help people close to where you live.</p>',
					'note' => 'Placeholder — final list of 20 suburb pages to be confirmed by the SEO team.',
					'items' => array(
						'Chermside',
						'Chermside West',
						'Kedron',
						'Wavell Heights',
						'Aspley',
						'Geebung',
						'Stafford',
					),
				),
				array(
					'type' => 'funding',
					'paper' => false,
					'tag' => 'Funding & referrals',
					'title' => 'Funding pathways at our Chermside clinic.',
					'intro' => 'Our services can be accessed through a range of pathways. Eligibility and availability differ by service and by person.',
					'body' => '<p>If your care is funded through WorkCover Queensland, Queensland CTP, the NDIS, DVA or Medicare Chronic Condition Management, bring your claim, plan or referral details and our team will confirm how it works for the service you need. Private patients can book directly. GPs and other health professionals can find the referral steps on our <a href="referrers.html">Referrers page</a>.</p>',
					'items' => array(
						array(
							'title' => 'Private',
							'text' => 'Book directly, no third party required',
						),
						array(
							'title' => 'WorkCover Queensland',
							'text' => 'Work-related injury claims',
						),
						array(
							'title' => 'Medicare Chronic Condition Management',
							'text' => 'Eligible chronic conditions via your GP',
						),
						array(
							'title' => 'Queensland CTP',
							'text' => 'Compulsory third party motor vehicle claims',
						),
						array(
							'title' => 'NDIS',
							'text' => 'Participants with funded supports',
						),
						array(
							'title' => 'DVA',
							'text' => 'Veteran Cards — Gold and White',
						),
					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Chermside clinic questions.',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or send us a message.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'Where exactly is the Chermside clinic?',
							'a' => '<p>671 Gympie Road, Suite 5, Level 1, Chermside QLD 4032, Brisbane. The map at the bottom of this page shows the location and gives directions.</p>',
							'open' => true,
						),
						array(
							'q' => 'Which services can I book in Chermside?',
							'a' => '<p>Physiotherapy, exercise physiology, occupational therapy and clinical Pilates are all delivered at the Chermside clinic, with a dedicated rehabilitation and exercise space on site.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can I book online?',
							'a' => '<p>Yes. You can book through our Nookal online booking system at any time, or call 07 3073 1616 if you would like help choosing a service or time.</p>',
							'open' => false,
						),
						array(
							'q' => 'Do you offer home visits around Chermside?',
							'a' => '<p>Physiotherapy and exercise physiology home visits may be available by arrangement across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability.</p>',
							'open' => false,
						),
						array(
							'q' => 'Which funding pathways can I use?',
							'a' => '<p>Private, WorkCover Queensland, Medicare Chronic Condition Management, Queensland CTP, NDIS and DVA Veteran Cards (Gold and White), with availability differing by service. Please confirm with our team before booking.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can my GP or specialist refer me?',
							'a' => '<p>Yes. Referrers can email referrals@bdyculture.com.au with the subject “Patient Referral – BDYCULTURE” or visit our Referrers page for the full steps.</p>',
							'open' => false,
						),
					),
				),
			),
		),
		'practice-from-bdyculture' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Practice from BDYCULTURE',
					'lead' => 'Build your independent practice within BDYCULTURE, a multidisciplinary rehabilitation clinic in Chermside featuring seven consulting rooms and a spacious, fully equipped rehabilitation and exercise environment. Access professional consulting facilities and the opportunity to practice alongside other allied-health professionals.',
					'crumb_current' => 'Practice from BDYCULTURE',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Enquire About a Licence',
							'url' => '#enquire',
							'style' => 'signal',
							'new_tab' => false,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ghost',
							'new_tab' => true,
							'icon' => '',
						),
					),
					'checks' => array(
						'Seven consulting rooms',
						'Rehabilitation and exercise space',
						'Chermside location',
					),
					'form' => true,
					'form_tag' => 'Licence enquiry',
					'form_title' => 'Interested in Practising from BDYCULTURE?',
					'form_intro' => 'Tell us a little about your profession, current practice and what you’re looking for. We’ll get in touch to discuss whether BDYCULTURE could be a good fit for your practice.',
					'form_button' => 'Enquire About a Licence',
					'form_note' => 'By submitting this form, you acknowledge our <a href="privacy-policy.html">Privacy Policy</a>.',
					'form_success_title' => 'Thanks — enquiry received',
					'form_success_text' => 'We’ll be in touch to discuss the fit. To speak to someone now, call <a href="tel:0730731616">07 3073 1616</a>.',
					'form_fields' => array(
						array(
							'label' => 'First name',
							'name' => 'first',
							'type' => 'text',
							'autocomplete' => 'given-name',
							'half' => true,
							'required' => true,
						),
						array(
							'label' => 'Last name',
							'name' => 'last',
							'type' => 'text',
							'autocomplete' => 'family-name',
							'half' => true,
							'required' => true,
						),
						array(
							'label' => 'Profession / Discipline',
							'name' => 'profession',
							'type' => 'text',
							'autocomplete' => '',
							'half' => false,
							'required' => true,
						),
						array(
							'label' => 'Email',
							'name' => 'email',
							'type' => 'email',
							'autocomplete' => 'email',
							'half' => true,
							'required' => true,
						),
						array(
							'label' => 'Phone',
							'name' => 'phone',
							'type' => 'tel',
							'autocomplete' => 'tel',
							'half' => true,
							'required' => true,
						),
						array(
							'label' => 'What are you looking for?',
							'name' => 'need',
							'type' => 'text',
							'autocomplete' => '',
							'half' => false,
							'required' => true,
						),
					),
				),
				array(
					'type' => 'features',
					'variant' => 'four',
					'paper' => false,
					'tag' => 'Clinician licence opportunities · Chermside',
					'title' => 'Why Practice from BDYCULTURE?',
					'intro' => 'BDYCULTURE offers independent allied-health clinicians the opportunity to practice within a professional multidisciplinary rehabilitation environment, with access to facilities designed to support both clinical care and progressive rehabilitation.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Purpose-Built Rehabilitation Environment',
							'text' => 'Professional consulting rooms combined with a dedicated rehabilitation and exercise space, allowing clinicians to work beyond the limitations of a standard consulting room.',
						),
						array(
							'icon' => '',
							'title' => 'Professional Clinic Presence',
							'text' => 'Operate from a professionally presented clinic environment without carrying the cost and complexity of establishing your own premises.',
						),
						array(
							'icon' => '',
							'title' => 'Multidisciplinary Setting',
							'text' => 'Practise alongside other allied-health professionals within a clinic designed around collaborative rehabilitation, while maintaining your own independent practice.',
						),
						array(
							'icon' => '',
							'title' => 'Chermside Location',
							'text' => 'Position your practice in a major Brisbane northside health and commercial precinct, with convenient access for patients from Chermside and surrounding suburbs.',
						),
					),
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => true,
					'tag' => 'The clinic',
					'title' => 'A Clinic Built for Rehabilitation',
					'body' => '<p>BDYCULTURE combines private consulting rooms with a large dedicated rehabilitation and exercise environment, giving clinicians the flexibility to assess, treat and progressively rehabilitate patients within the same facility.</p> <p>The clinic is at 671 Gympie Road, Suite 5, Level 1, Chermside, with lift access available. Visitor parking is available at the rear of the building, with additional 3-hour parking within the adjacent precinct.</p>',
					'note' => '',
					'buttons' => array(

					),
					'media' => array(
						'image' => 'gym-chermside-1920.jpg',
						'alt' => 'BDYCULTURE rehabilitation and exercise environment in Chermside',
						'crop' => '--x:45%;--y:60%;--s:1.35',
					),
					'panel' => array(

					),
				),
				array(
					'type' => 'features',
					'variant' => '',
					'paper' => false,
					'tag' => 'Who we’re looking for',
					'title' => 'Who We’re Looking For',
					'intro' => 'We’re interested in hearing from independent allied-health clinicians looking for a professional base in Chermside and who value working within a multidisciplinary rehabilitation environment while maintaining their own independent practice.',
					'body' => '',
					'items' => array(
						array(
							'icon' => 'shield',
							'title' => 'Complementary Allied-Health Disciplines',
							'text' => 'We welcome enquiries from clinicians whose services complement BDYCULTURE’s rehabilitation model, including areas such as psychology, dietetics, podiatry and other appropriate allied-health disciplines.',
						),
						array(
							'icon' => 'occupational-therapy',
							'title' => 'Independent Practitioners',
							'text' => 'The licence model is designed for clinicians operating their own independent practice who want access to professional facilities without taking on the cost and complexity of establishing a standalone clinic.',
						),
						array(
							'icon' => '',
							'title' => 'Collaborative, Patient-Focused Clinicians',
							'text' => 'We’re looking for clinicians who value high-quality care, professional communication and the opportunity to work alongside other health professionals when appropriate.',
						),
					),
				),
				array(
					'type' => 'features',
					'variant' => 'four',
					'paper' => true,
					'tag' => 'Your licence',
					'title' => 'What Your Licence Gives You Access To',
					'intro' => '',
					'body' => '',
					'items' => array(
						array(
							'icon' => '',
							'title' => 'Professional Consulting Space',
							'text' => 'Work from a professionally presented clinical environment designed for allied-health practice and patient care.',
						),
						array(
							'icon' => '',
							'title' => 'Multidisciplinary Clinic Environment',
							'text' => 'Operate alongside complementary allied-health professionals within a clinic designed around rehabilitation, collaboration and coordinated patient care.',
						),
						array(
							'icon' => 'exercise-physiology',
							'title' => 'Rehabilitation & Exercise Facilities',
							'text' => 'Access a dedicated rehabilitation environment with strength, conditioning and functional exercise equipment to support appropriate patient rehabilitation.',
						),
						array(
							'icon' => '',
							'title' => 'Chermside Clinic Location',
							'text' => 'Establish your practice presence in Chermside, with convenient access for patients from across Brisbane’s northside.',
						),
					),
				),
				array(
					'type' => 'steps',
					'dark' => true,
					'light' => false,
					'paper' => false,
					'tag' => 'The process',
					'title' => 'How the Licence Model Works',
					'intro' => '',
					'body' => '',
					'buttons' => array(
						array(
							'text' => 'Enquire About a Licence',
							'url' => '#enquire',
							'style' => 'signal',
							'new_tab' => false,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'outline-light',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'items' => array(
						array(
							'title' => 'Enquire',
							'text' => 'Tell us about your profession, current practice and what you’re looking for in a clinic environment.',
						),
						array(
							'title' => 'Discuss the Fit',
							'text' => 'We’ll discuss your clinical needs, preferred days, facility requirements and whether BDYCULTURE is the right fit for your practice.',
						),
						array(
							'title' => 'Agree & Commence',
							'text' => 'If there’s a good fit, we’ll confirm the licence arrangements and practical requirements before you begin practicing from the clinic.',
						),
					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'Licence enquiry questions.',
					'intro' => 'Can’t see yours? Call <a href="tel:0730731616">07 3073 1616</a> or use the licence enquiry form.',
					'body' => '',
					'btn_text' => 'Enquire About a Licence',
					'btn_url' => '#enquire',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'What facilities does a licence give access to?',
							'a' => '<p>A professionally presented consulting space, a multidisciplinary clinic environment, and a dedicated rehabilitation and exercise space with strength, conditioning and functional exercise equipment. BDYCULTURE has seven consulting rooms.</p>',
							'open' => true,
						),
						array(
							'q' => 'Who is the licence model designed for?',
							'a' => '<p>Independent allied-health clinicians operating their own practice who want access to professional facilities without the cost and complexity of establishing a standalone clinic.</p>',
							'open' => false,
						),
						array(
							'q' => 'Which disciplines are you interested in?',
							'a' => '<p>We welcome enquiries from clinicians whose services complement BDYCULTURE’s rehabilitation model, including areas such as psychology, dietetics, podiatry and other appropriate allied-health disciplines.</p>',
							'open' => false,
						),
						array(
							'q' => 'How does the licence process work?',
							'a' => '<p>You enquire, we discuss the fit including your clinical needs, preferred days and facility requirements, and if there is a good fit we confirm the licence arrangements and practical requirements before you begin practicing from the clinic.</p>',
							'open' => false,
						),
						array(
							'q' => 'Where is the clinic?',
							'a' => '<p>671 Gympie Road, Suite 5, Level 1, Chermside QLD 4032, with lift access available. Visitor parking is available at the rear of the building, with additional 3-hour parking within the adjacent precinct.</p>',
							'open' => false,
						),
					),
				),
				array(
					'type' => 'cta',
					'title' => 'Interested in Practising from BDYCULTURE?',
					'text' => 'Tell us a little about your profession, current practice and what you’re looking for. We’ll get in touch to discuss whether BDYCULTURE could be a good fit for your practice.',
					'buttons' => array(
						array(
							'text' => 'Enquire About a Licence',
							'url' => '#enquire',
							'style' => 'ink',
							'new_tab' => false,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ghost',
							'new_tab' => true,
							'icon' => '',
						),
					),
				),
			),
		),
		'privacy-policy' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Privacy Policy',
					'lead' => 'Last updated: 13 October 2026',
					'crumb_current' => 'Privacy Policy',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Email the clinic',
							'url' => 'mailto:hello@bdyculture.com.au',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Operated by Bdycorporation Pty Ltd',
						'Privacy Act 1988 (Cth)',
						'Australian Privacy Principles',
					),
					'form' => false,
				),
				array(
					'type' => 'prose',
					'paper' => false,
					'body' => '<h2>1. About this Privacy Policy</h2> <p>BDYCULTURE, operated by Bdycorporation Pty Ltd, is committed to protecting the privacy of our patients, clients, referrers and website users.</p> <p>We handle personal information in accordance with the Privacy Act 1988 (Cth), the Australian Privacy Principles and other applicable legal, professional and healthcare requirements.</p> <h2>2. Information We Collect</h2> <p>We may collect personal and sensitive information including:</p> <ul class="checklist"> <li>name, date of birth, address, phone number and email address</li> <li>health, medical, injury and disability information</li> <li>referral information and clinical history</li> <li>appointment and treatment information</li> <li>Medicare, DVA, NDIS, WorkCover, CTP, private health and other funding information where relevant</li> <li>payment and billing information</li> <li>emergency contact details</li> <li>correspondence, enquiries, feedback and complaints</li> <li>information submitted through our website, referral forms or online booking systems.</li> </ul> <p>We only collect information that is reasonably necessary for our functions and services.</p> <h2>3. How We Collect Information</h2> <p>We may collect information directly from you, from your authorised representative, or from third parties involved in your care or funding, including GPs, medical specialists, allied health professionals, hospitals, insurers, government agencies, NDIS participants and representatives, support coordinators and plan managers.</p> <p>Information may be collected in person, by telephone, email, online forms, referral documents, our practice management system or other secure electronic systems.</p> <h2>4. How We Use and Disclose Information</h2> <p>We may use or disclose your information for purposes including:</p> <ul class="checklist"> <li>providing allied health, rehabilitation and related services</li> <li>assessing, planning, delivering and reviewing your care</li> <li>communicating with you and other members of your healthcare team</li> <li>managing appointments, referrals and clinical records</li> <li>processing payments, claims and funding</li> <li>meeting Medicare, DVA, NDIS, WorkCover, CTP or other funding requirements where applicable</li> <li>responding to enquiries, feedback or complaints</li> <li>managing our clinic and improving our services</li> <li>complying with legal, regulatory, professional and insurance obligations.</li> </ul> <p>We will not sell your personal information.</p> <h2>5. Marketing Communications</h2> <p>Where you have consented, we may contact you about clinic updates, services, educational information or other relevant communications.</p> <p>You may opt out of marketing communications at any time. Opting out of marketing communications will not prevent us from contacting you about your healthcare, appointments or other necessary service-related matters.</p> <h2>6. Storage and Security</h2> <p>We take reasonable steps to protect personal and health information from misuse, interference, loss, unauthorised access, modification or disclosure.</p> <p>Information may be stored in secure electronic systems, cloud services and, where required, physical records. We use service providers and technology systems to support clinical care, administration, communication, website operation and business functions.</p> <p>We retain information for periods required by applicable laws, professional standards, funding requirements and clinical obligations.</p> <h2>7. Overseas Storage and Service Providers</h2> <p>Some technology and service providers used by BDYCULTURE may store, process or access information outside Australia. Where applicable, we take reasonable steps to ensure personal information is handled in accordance with Australian privacy requirements.</p> <p>We will update this policy where practicable to reflect material changes to the locations in which information is processed or stored.</p> <h2>8. Website, Cookies and Analytics</h2> <p>Our website may use cookies and analytics technologies to understand website use, improve performance and measure the effectiveness of our communications and marketing.</p> <p>Information collected through these technologies may include device information, browser information, pages visited and general website interaction data.</p> <h2>9. Accessing or Correcting Your Information</h2> <p>You may request access to personal information we hold about you or ask us to correct information that is inaccurate, incomplete or out of date.</p> <p>Requests can be made using the contact details below. In some circumstances, access may be limited where permitted or required by law.</p> <h2>10. Privacy Complaints</h2> <p>If you have concerns about how BDYCULTURE has handled your personal information, please contact us so we can investigate and respond.</p> <p>If you are not satisfied with our response, you may also contact the Office of the Australian Information Commissioner (OAIC).</p> <h2>11. Privacy Contact</h2> <p>BDYCULTURE – Rehab & Performance Clinic<br>671 Gympie Road<br>Suite 5, Level 1<br>Chermside QLD 4032</p> <p>Phone: <a href="tel:0730731616">07 3073 1616</a><br>Email: <a href="mailto:hello@bdyculture.com.au">hello@bdyculture.com.au</a></p> <h2>12. Changes to This Policy</h2> <p>We may update this Privacy Policy from time to time to reflect changes to our services, systems, legal obligations or information-handling practices. The current version will be published on our website.</p>',
					'variant' => 'legal',
				),
			),
		),
		'blog' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Health & Rehabilitation Blog',
					'lead' => 'General information from the BDYCULTURE team on movement, rehabilitation and everyday function. Not a substitute for individual health advice.',
					'crumb_current' => 'Blog',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'Physiotherapy',
						'Exercise physiology',
						'Occupational therapy',
						'Clinical Pilates',
					),
					'form' => true,
				),
				array(
					'type' => 'posts_featured',
					'tag' => 'Latest article',
					'title' => 'Fresh reading from our clinic.',
					'intro' => 'A new article is published each month. The titles and summaries on this page are sample content for the design; our content team will replace them with approved, AHPRA-compliant articles.',
					'body' => '',
					'btn_text' => 'Read the article',
					'btn_url' => 'blog-post.html',
					'post' => array(
						'title' => 'Sample article: Returning to exercise after an injury — what to consider',
						'excerpt' => 'A general overview of the questions people commonly ask when they want to get moving again after an injury, and why a gradual, supervised approach is often recommended. Placeholder summary for the content team.',
						'url' => '/blog-post/',
						'image' => 'gym-chermside-1920.jpg',
						'crop' => '--x:40%;--y:60%;--s:1.35',
						'meta' => array(
							'Physiotherapy',
							'Sample date',
							'5 min read',
						),
					),
				),
				array(
					'type' => 'posts_grid',
					'paper' => true,
					'tag' => 'All articles',
					'title' => 'Browse by topic.',
					'intro' => '',
					'body' => '',
					'note' => 'Placeholder — blog pagination and category filtering will be built in WordPress.',
					'items' => array(
						array(
							'title' => 'Sample article: What is clinical Pilates, and how is it different?',
							'excerpt' => 'Placeholder summary: an introduction to Pilates-based rehabilitation delivered by an Accredited Exercise Physiologist or Physiotherapist.',
							'url' => '/blog-post/',
							'image' => 'hero-gym-bright.webp',
							'crop' => '--x:90%;--y:75%;--s:2',
							'meta' => array(
								'Clinical Pilates',
								'5 min read',
							),
							'more' => 'Read more',
						),
						array(
							'title' => 'Sample article: Exercise and chronic conditions — where to start',
							'excerpt' => 'Placeholder summary: general information about clinical exercise and why a plan built around your health history matters.',
							'url' => '/blog-post/',
							'image' => 'gym-chermside-1920.jpg',
							'crop' => '--x:75%;--y:55%;--s:1.5',
							'meta' => array(
								'Exercise physiology',
								'4 min read',
							),
							'more' => 'Read more',
						),
						array(
							'title' => 'Sample article: How occupational therapy supports everyday independence',
							'excerpt' => 'Placeholder summary: an overview of how practical assessment and strategies can support daily function and participation.',
							'url' => '/blog-post/',
							'image' => 'hero-gym-bright.webp',
							'crop' => '--x:10%;--y:55%;--s:1.9',
							'meta' => array(
								'Occupational therapy',
								'4 min read',
							),
							'more' => 'Read more',
						),
						array(
							'title' => 'Sample article: Understanding funding pathways for allied health',
							'excerpt' => 'Placeholder summary: a plain-language guide to private, WorkCover, CTP, NDIS, DVA and Medicare pathways.',
							'url' => '/blog-post/',
							'image' => 'gym-chermside-1920.jpg',
							'crop' => '--x:25%;--y:70%;--s:1.6',
							'meta' => array(
								'Funding & referrals',
								'3 min read',
							),
							'more' => 'Read more',
						),
						array(
							'title' => 'Sample article: Preparing for rehabilitation after surgery',
							'excerpt' => 'Placeholder summary: general questions to ask and what a structured rehabilitation plan can involve.',
							'url' => '/blog-post/',
							'image' => 'hero-gym-bright.webp',
							'crop' => '--x:52%;--y:42%;--s:1.5',
							'meta' => array(
								'Physiotherapy',
								'5 min read',
							),
							'more' => 'Read more',
						),
						array(
							'title' => 'Sample article: When a home visit may be the right option',
							'excerpt' => 'Placeholder summary: how home visits by arrangement work across Chermside and surrounding suburbs.',
							'url' => '/blog-post/',
							'image' => 'gym-chermside-1920.jpg',
							'crop' => '--x:55%;--y:50%;--s:1.4',
							'meta' => array(
								'Home visits',
								'3 min read',
							),
							'more' => 'Read more',
						),
					),
					'chips' => array(
						'All',
						'Physiotherapy',
						'Exercise physiology',
						'Occupational therapy',
						'Clinical Pilates',
						'Funding & referrals',
					),
				),
				array(
					'type' => 'split',
					'reverse' => false,
					'paper' => false,
					'tag' => 'About our articles',
					'title' => 'Written by our clinic team, for people in Chermside and beyond.',
					'body' => '<p>The BDYCULTURE blog shares general information on physiotherapy, exercise physiology, occupational therapy and clinical Pilates. Articles are written to help you understand the questions to ask and the options that may be available, in plain language and without jargon.</p> <p>Everything we publish is general in nature. It cannot take account of your own history, and it is not a substitute for individual health advice. If something in an article sounds like your situation, the best next step is to talk to a practitioner who can assess you properly.</p> <p>You can book an appointment online through Nookal, call the clinic on 07 3073 1616 or send an enquiry. GPs and other health professionals can find the referral steps on our <a href="referrers.html">Referrers page</a>.</p>',
					'note' => '',
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'ink',
							'new_tab' => true,
							'icon' => '',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'media' => array(
						'image' => '',
						'alt' => '',
						'crop' => '',
					),
					'panel' => array(
						'kind' => 'note-card',
						'title' => 'Our services',
						'body' => '',
						'rows' => array(

						),
						'links' => array(
							array(
								'text' => 'Physiotherapy',
								'url' => '/physiotherapy/',
							),
							array(
								'text' => 'Exercise Physiology',
								'url' => '/exercise-physiology/',
							),
							array(
								'text' => 'Occupational Therapy',
								'url' => '/occupational-therapy/',
							),
							array(
								'text' => 'Clinical Pilates',
								'url' => '/clinical-pilates/',
							),
						),
						'buttons' => array(

						),
					),
				),
				array(
					'type' => 'faq',
					'tag' => 'FAQs',
					'title' => 'About our blog.',
					'intro' => 'Questions about an article? Call <a href="tel:0730731616">07 3073 1616</a>.',
					'body' => '',
					'btn_text' => 'Ask a question',
					'btn_url' => '#contact',
					'btn_style' => 'ink',
					'items' => array(
						array(
							'q' => 'How often is the blog updated?',
							'a' => '<p>A new article is planned each month, written by our content team and reviewed for accuracy and AHPRA compliance before it is published.</p>',
							'open' => true,
						),
						array(
							'q' => 'Is the information on the blog medical advice?',
							'a' => '<p>No. Articles are general information only and are not a substitute for individual health advice. If you have a concern about your health, speak to a qualified practitioner.</p>',
							'open' => false,
						),
						array(
							'q' => 'Can I ask for an article on a topic?',
							'a' => '<p>Yes. Send us a message through the contact form or call the clinic and we will pass your suggestion to the content team.</p>',
							'open' => false,
						),
						array(
							'q' => 'How do I book an appointment after reading an article?',
							'a' => '<p>Use the Book Online button to choose a time through Nookal, call 07 3073 1616, or send an enquiry using the form on this page.</p>',
							'open' => false,
						),
					),
				),
			),
		),
		'blog-post' => array(
			'sections' => array(
				array(
					'type' => 'hero',
					'title' => 'Sample article: Returning to exercise after an injury',
					'lead' => 'Placeholder article template. General information only — not a substitute for individual health advice. Content to be written and AHPRA-checked by the content team.',
					'crumb_current' => 'Sample article',
					'crumbs' => array(
						array(
							'label' => 'Home',
							'url' => '/',
						),
						array(
							'label' => 'Blog',
							'url' => '/blog/',
						),
					),
					'buttons' => array(
						array(
							'text' => 'Book Online',
							'url' => 'https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select',
							'style' => 'signal',
							'new_tab' => true,
							'icon' => 'arrow',
						),
						array(
							'text' => 'Call 07 3073 1616',
							'url' => 'tel:0730731616',
							'style' => 'call',
							'new_tab' => false,
							'icon' => '',
						),
						array(
							'text' => 'Refer a Patient',
							'url' => '/referrers/',
							'style' => 'ghost',
							'new_tab' => false,
							'icon' => '',
						),
					),
					'checks' => array(
						'General information only',
						'Reviewed before publishing',
						'Book via Nookal',
					),
					'form' => true,
				),
			),
		),
	);

	return $pages;
}
