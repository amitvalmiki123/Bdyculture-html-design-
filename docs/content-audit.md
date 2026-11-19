# Content audit table

Phase 1 of the workflow: every piece of visible content in `design-reference/index.html` is inventoried
before it is wired to ACF. The table below is the contract between the approved design and the theme —
nothing in the design is missing here, and nothing here is invented.

* **Design content** — the exact copy/asset that appears in the reference HTML (tags stripped, long copy shortened with `…`).
* **ACF field** — the field name that edits it. Every name is registered in `inc/acf/*.php` with a matching `field_{name}` key.
* **Fallback** — `defaults.php` stores the same value, so the theme renders the original design before a single field is saved.

Global content (header, drawer, footer, mobile bar) is edited once on the **BDYCULTURE → Theme Settings** options page and
is reused by every template, so it is never duplicated per page. In the table below a value such as
`Call {phone}` is the token form stored in `defaults.php`; it renders as the phone number from Clinic details,
so changing the number once updates every button, link, FAQ answer, footer line and the JSON-LD.

## 1. Global content — edited once, used everywhere

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| clinic phone display | 07 3073 1616 | `clinic_phone_display` | text |
| clinic phone tel | 0730731616 | `clinic_phone_tel` | text |
| clinic email | hello@bdyculture.com.au | `clinic_email` | email |
| clinic email referrals | referrals@bdyculture.com.au | `clinic_email_referrals` | email |
| clinic address 1 | 671 Gympie Road, Suite 5, Level 1 | `clinic_address_1` | text |
| clinic address 2 | Chermside QLD 4032 | `clinic_address_2` | text |
| clinic booking url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `clinic_booking_url` | url |
| clinic directions url | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032 | `clinic_directions_url` | url |
| clinic hours | Placeholder — client to confirm clinic hours | `clinic_hours` | text |
| clinic tagline | Allied health and rehabilitation in Chermside, Brisbane. | `clinic_tagline` | textarea |
| enquiry tag | Enquire online | `enquiry_tag` | text |
| enquiry title | Request an appointment or ask a question | `enquiry_title` | text |
| enquiry intro | Our Chermside team will get back to you. For urgent medical help, call 000. | — | Contact Form 7 |
| enquiry shortcode | — | `enquiry_shortcode` | text |
| enquiry label name | Full name | — | Contact Form 7 |
| enquiry label phone | Phone | — | Contact Form 7 |
| enquiry label email | Email | — | Contact Form 7 |
| enquiry label service | I’m interested in | — | Contact Form 7 |
| enquiry button | Send enquiry | — | Contact Form 7 |
| enquiry note | By submitting this form, you acknowledge the BDYCULTURE {privacy_link}. Please do not include sensitive med… | `enquiry_note` | textarea |
| enquiry alt text | Prefer to book yourself? | `enquiry_alt_text` | text |
| enquiry alt link text | Book Online with Nookal | `enquiry_alt_link_text` | text |
| enquiry success title | Thanks — enquiry received | — | Contact Form 7 |
| enquiry success text | We’ll be in touch shortly. To speak to someone now, call 07 3073 1616. | — | Contact Form 7 |
| enquiry options (repeater) | 6 row(s) — Physiotherapy | — | Contact Form 7 |
| article checks (repeater) | 3 row(s) — General information only | `article_checks` | repeater |
| &nbsp;&nbsp;└ text | General information only | `text` | — |
| article toc title | In this article | `article_toc_title` | — |
| article side book title | Book an appointment | `article_side_book_title` | — |
| article side book text | Choose a time online or speak to our Chermside team. | `article_side_book_text` | — |
| article side services title | Our services | `article_side_services_title` | — |
| article related tag | Keep reading | `article_related_tag` | — |
| article related title | Related articles. | `article_related_title` | — |
| article cta title | Ready to talk to someone? | `article_cta_title` | — |
| article cta text | Book an appointment online through Nookal, call the clinic on 07 3073 1616, or send an enquiry. | `article_cta_text` | — |
| article byline | BDYCULTURE clinical team | `article_byline` | — |
| article byline note | placeholder — content team to confirm author and reviewer | `article_byline_note` | — |
| article disclaimer | This article is general information only and is not a substitute for individual health advice. Results vary… | `article_disclaimer` | — |
| header enquire text | Enquire | `header_enquire_text` | text |
| header drawer enquire text | Send an enquiry | `header_drawer_enquire_text` | text |
| header book text | Book Online | `header_book_text` | text |
| mobile bar call text | Call | `mobile_bar_call_text` | text |
| mobile bar book text | Book Online | `mobile_bar_book_text` | text |
| footer tagline | Allied health and rehabilitation in Chermside, Brisbane. | `footer_tagline` | textarea |
| footer copyright | © 2026 BDYCULTURE. All rights reserved. | `footer_copyright` | text |
| footer privacy text | Privacy Policy | `footer_privacy_text` | text |
| footer privacy url | /privacy-policy/ | `footer_privacy_url` | text |
| footer credit | Web Design by {credit_link} | `footer_credit` | text |
| footer credit label | Digital Movement | `footer_credit_label` | text |
| footer credit url | https://www.digitalmovement.com.au/ | `footer_credit_url` | url |
| footer note | Information on this website is general in nature and is not a substitute for individual health advice. Resu… | `footer_note` | textarea |
| header nav (repeater) | 4 row(s) — Home / / | `header_nav` | repeater |
| &nbsp;&nbsp;└ nav label | Home | `nav_label` | — |
| &nbsp;&nbsp;└ nav link | / | `nav_link` | — |
| &nbsp;&nbsp;└ nav children | 0 nested row(s) | `nav_children` | repeater |
| footer columns (repeater) | 3 row(s) — Services / — | `footer_columns` | repeater |
| &nbsp;&nbsp;└ col title | Services | `col_title` | — |
| &nbsp;&nbsp;└ col text | — | `col_text` | — |
| &nbsp;&nbsp;└ col links | 4 nested row(s) | `col_links` | repeater |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ link label | Physiotherapy | `link_label` | — |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ link url | /physiotherapy/ | `link_url` | — |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ link type | link | `link_type` | — |
| contact tag | Get in touch | `contact_tag` | text |
| contact title | Let’s get you moving. | `contact_title` | textarea |
| contact intro | Book online in minutes, call the clinic, or send us a message and we’ll come back to you. Referrers are wel… | `contact_intro` | textarea |
| contact list (repeater) | 4 row(s) — Visit us / 671 Gympie Road, Suite 5, Level 1 / Chermside QLD 4032 / no | `contact_list` | repeater |
| &nbsp;&nbsp;└ contact list label | Visit us | `contact_list_label` | text |
| &nbsp;&nbsp;└ contact list value | 671 Gympie Road, Suite 5, Level 1 / Chermside QLD 4032 | `contact_list_value` | text |
| &nbsp;&nbsp;└ contact list placeholder | no | `contact_list_placeholder` | true_false |
| contact btn text | Book Online with Nookal | `contact_btn_text` | text |
| contact btn url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `contact_btn_url` | text |
| contact btn icon | arrow | `contact_btn_icon` | select |
| contact form shortcode | — | `contact_form_shortcode` | text |
| contact form title | Send us a message | `contact_form_title` | text |
| contact form intro | We’ll reply during business hours. For urgent medical help, call 000. | — | Contact Form 7 |
| contact form label name | Full name | — | Contact Form 7 |
| contact form label phone | Phone | — | Contact Form 7 |
| contact form label email | Email | — | Contact Form 7 |
| contact form label type | Enquiry type | — | Contact Form 7 |
| contact form label interest | I’m interested in | — | Contact Form 7 |
| contact form label message | Message | — | Contact Form 7 |
| contact form types (repeater) | 4 row(s) — Book an appointment | — | Contact Form 7 |
| contact form interests (repeater) | 5 row(s) — Physiotherapy | — | Contact Form 7 |
| contact form note | By submitting this form, you acknowledge the BDYCULTURE Privacy Policy. Please do not include sensitive med… | `contact_form_note` | textarea |
| contact form button | Send message | — | Contact Form 7 |
| contact form success title | Thanks — message received | — | Contact Form 7 |
| contact form success text | We’ll be in touch shortly. To speak to someone now, call 07 3073 1616. | — | Contact Form 7 |
| map tag | Find the clinic | `map_tag` | text |
| map title | On Gympie Road, Chermside. | `map_title` | text |
| map lat | -27.3852 | `map_lat` | text |
| map lng | 153.0306 | `map_lng` | text |
| map zoom | 16 | `map_zoom` | number |
| map load label | Load interactive map | `map_load_label` | text |
| map card title | BDYCULTURE | `map_card_title` | text |
| map card text | Rehab & Performance Clinic671 Gympie Road, Suite 5, Level 1 / Chermside QLD 4032 | `map_card_text` | textarea |
| map chips label | Around the clinic: | `map_chips_label` | text |
| map chips (repeater) | 7 row(s) — Chermside / -27.3852 / 153.0306 | `map_chips` | repeater |
| &nbsp;&nbsp;└ chip label | Chermside | `chip_label` | text |
| &nbsp;&nbsp;└ chip lat | -27.3852 | `chip_lat` | text |
| &nbsp;&nbsp;└ chip lng | 153.0306 | `chip_lng` | text |
| &nbsp;&nbsp;└ chip zoom | 16 | `chip_zoom` | text |
| map btn 1 text | Get directions | `map_btn_1_text` | text |
| map btn 1 url | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032 | `map_btn_1_url` | text |
| map btn 2 text | Call | `map_btn_2_text` | text |
| map btn 2 url | tel | `map_btn_2_url` | text |

## 2. Hero (`.hero`)

Single-column hero: H1, lead paragraph, three buttons and three trust checks (no enquiry card — the form lives in the Contact band). Full-bleed street-photo background with the ROM gauge marker.

- ACF tab: **hero**  ·  toggle `home_hero_show` = `true`  ·  order `home_hero_order` = `10`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home hero title | Allied Health & Rehabilitation in Chermside | `home_hero_title` | textarea |
| home hero lead | A multidisciplinary clinic combining expert allied health care with a dedicated rehabilitation and exercise… | `home_hero_lead` | textarea |
| home hero buttons (repeater) | 3 row(s) — Book Online / https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select / signal | `home_hero_buttons` | repeater |
| &nbsp;&nbsp;└ hero btn text | Book Online | `hero_btn_text` | text |
| &nbsp;&nbsp;└ hero btn url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `hero_btn_url` | text |
| &nbsp;&nbsp;└ hero btn style | signal | `hero_btn_style` | select |
| &nbsp;&nbsp;└ hero btn icon | arrow | `hero_btn_icon` | select |
| &nbsp;&nbsp;└ hero btn new tab | yes | `hero_btn_new_tab` | true_false |
| home hero checks (repeater) | 3 row(s) — Online booking via Nookal | `home_hero_checks` | repeater |
| &nbsp;&nbsp;└ hero check text | Online booking via Nookal | `hero_check_text` | text |

## 3. Marquee band (`.marquee`)

Dark infinite ticker: the four service labels separated by a dot, duplicated once so the loop is seamless.

- ACF tab: **marquee**  ·  toggle `home_marquee_show` = `true`  ·  order `home_marquee_order` = `20`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home marquee items (repeater) | 4 row(s) — Physiotherapy | `home_marquee_items` | repeater |
| &nbsp;&nbsp;└ marquee item text | Physiotherapy | `marquee_item_text` | text |

## 4. Services (`.services`)

Sticky tab list on the left, four panels on the right. Each panel: number, icon, title, paragraph, four benefit ticks, a photo and an "Explore …" button.

- ACF tab: **services**  ·  toggle `home_services_show` = `true`  ·  order `home_services_order` = `30`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home services tag | Our core services | `home_services_tag` | text |
| home services title | Four disciplines.One joined-up clinic. | `home_services_title` | textarea |
| home services intro | Integrated allied health care built around rehabilitation, movement and long-term function. Choose a discip… | `home_services_intro` | textarea |
| home services panels (repeater) | 4 row(s) — Physiotherapy / physiotherapy / gym-chermside-1920.jpg | `home_services_panels` | repeater |
| &nbsp;&nbsp;└ panel tab label | Physiotherapy | `panel_tab_label` | text |
| &nbsp;&nbsp;└ panel icon | physiotherapy | `panel_icon` | select |
| &nbsp;&nbsp;└ panel image | gym-chermside-1920.jpg | `panel_image` | image |
| &nbsp;&nbsp;└ panel img x | 28% | `panel_img_x` | text |
| &nbsp;&nbsp;└ panel img y | 62% | `panel_img_y` | text |
| &nbsp;&nbsp;└ panel img scale | 1.5 | `panel_img_scale` | text |
| &nbsp;&nbsp;└ panel chip | Physiotherapy | `panel_chip` | text |
| &nbsp;&nbsp;└ panel title | Physiotherapy | `panel_title` | text |
| &nbsp;&nbsp;└ panel lead | Assessment, treatment and progressive rehabilitation for pain, injury, post-operative recovery and movement… | `panel_lead` | textarea |
| &nbsp;&nbsp;└ panel body | Physiotherapy at BDYCULTURE starts with understanding how you move and what is getting in the way. Your phy… | `panel_body` | textarea |
| &nbsp;&nbsp;└ panel ticks | 4 nested row(s) | `panel_ticks` | repeater |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ panel tick text | Pain and injury assessment | `panel_tick_text` | text |
| &nbsp;&nbsp;└ panel btn 1 text | Explore Physiotherapy | `panel_btn_1_text` | text |
| &nbsp;&nbsp;└ panel btn 1 url | /physiotherapy/ | `panel_btn_1_url` | text |
| &nbsp;&nbsp;└ panel btn 1 icon | arrow | `panel_btn_1_icon` | select |
| &nbsp;&nbsp;└ panel btn 2 text | Book Online | `panel_btn_2_text` | text |
| &nbsp;&nbsp;└ panel btn 2 url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `panel_btn_2_url` | text |
| &nbsp;&nbsp;└ panel btn 2 new tab | yes | `panel_btn_2_new_tab` | true_false |

## 5. More than a consulting room (`.continuum`)

Split band: heading + four numbered steps on the left, clinic photo with badge and floating card on the right.

- ACF tab: **continuum**  ·  toggle `home_continuum_show` = `true`  ·  order `home_continuum_order` = `40`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home continuum tag | More than a consulting room | `home_continuum_tag` | text |
| home continuum title | From first assessment to long-term capacity — in one place. | `home_continuum_title` | textarea |
| home continuum intro | Our Chermside clinic combines clinical allied health care with a dedicated rehabilitation and exercise envi… | `home_continuum_intro` | textarea |
| home continuum photo | gym-chermside-1920.jpg | `home_continuum_photo` | image |
| home continuum photo alt | BDYCULTURE rehabilitation gym in Chermside, Brisbane, with strength equipment, cable machines, free weights… | `home_continuum_photo_alt` | text |
| home continuum photo x | 38% | `home_continuum_photo_x` | text |
| home continuum photo y | 50% | `home_continuum_photo_y` | text |
| home continuum photo scale | 1 | `home_continuum_photo_scale` | text |
| home continuum caption | Our rehab & exercise space · Level 1, Chermside | `home_continuum_caption` | text |
| home continuum inset | hero-gym-bright.webp | `home_continuum_inset` | image |
| home continuum inset x | 70% | `home_continuum_inset_x` | text |
| home continuum inset y | 60% | `home_continuum_inset_y` | text |
| home continuum inset scale | 1.9 | `home_continuum_inset_scale` | text |
| home continuum badge number | 7 | `home_continuum_badge_number` | text |
| home continuum badge text | consulting rooms+ rehab & exercise space | `home_continuum_badge_text` | textarea |
| home continuum steps (repeater) | 4 row(s) — search / Assess / Your practitioner listens, examines and explains what is going on and what your options are. | `home_continuum_steps` | repeater |
| &nbsp;&nbsp;└ continuum step icon | search | `continuum_step_icon` | select |
| &nbsp;&nbsp;└ continuum step title | Assess | `continuum_step_title` | text |
| &nbsp;&nbsp;└ continuum step text | Your practitioner listens, examines and explains what is going on and what your options are. | `continuum_step_text` | textarea |
| home continuum more closed | Read more about our approach | `home_continuum_more_closed` | text |
| home continuum more open | Show less | `home_continuum_more_open` | text |
| home continuum paragraphs (repeater) | 3 row(s) — Many people only ever see a health professional in a consulting room, then are sent elsewhere to find somew… | `home_continuum_paragraphs` | repeater |
| &nbsp;&nbsp;└ continuum para text | Many people only ever see a health professional in a consulting room, then are sent elsewhere to find somew… | `continuum_para_text` | textarea |
| home continuum btn 1 text | Book an Appointment | `home_continuum_btn_1_text` | text |
| home continuum btn 1 url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `home_continuum_btn_1_url` | text |
| home continuum btn 2 text | Call 07 3073 1616 | `home_continuum_btn_2_text` | text |
| home continuum btn 2 url | tel | `home_continuum_btn_2_url` | text |

## 6. Photo ribbon (`.ribbon`)

Six-viewpoint photo strip, alternating heights and swept corners, duplicated once so the marquee loops.

- ACF tab: **ribbon**  ·  toggle `home_ribbon_show` = `true`  ·  order `home_ribbon_order` = `50`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home ribbon images (repeater) | 6 row(s) — gym-chermside-1920.jpg / 22% / 70% | `home_ribbon_images` | repeater |
| &nbsp;&nbsp;└ ribbon image | gym-chermside-1920.jpg | `ribbon_image` | image |
| &nbsp;&nbsp;└ ribbon x | 22% | `ribbon_x` | text |
| &nbsp;&nbsp;└ ribbon y | 70% | `ribbon_y` | text |
| &nbsp;&nbsp;└ ribbon scale | 1.6 | `ribbon_scale` | text |
| &nbsp;&nbsp;└ ribbon swept | yes | `ribbon_swept` | true_false |

## 7. Visit us (`.visit`)

Clinic signage: a portrait window-signage photo with a small door-signage card overlapping it, plus the address copy and two buttons (directions / book online).

- ACF tab: **visit**  ·  toggle `home_visit_show` = `true`  ·  order `home_visit_order` = `55`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home visit tag | Visit us | `home_visit_tag` | text |
| home visit title | Find us on Gympie Road, Chermside. | `home_visit_title` | text |
| home visit text 1 | BDYCULTURE is located at Suite 5, Level 1, 671 Gympie Road, Chermside QLD 4032, with lift access available.… | `home_visit_text_1` | textarea |
| home visit text 2 | Enter 671 Gympie Road, Chermside QLD 4032 into your GPS or maps app. Visitor parking is available at the re… | `home_visit_text_2` | textarea |
| home visit main image | — | `home_visit_main_image` | image |
| home visit main x | 50% | `home_visit_main_x` | text |
| home visit main y | 50% | `home_visit_main_y` | text |
| home visit main scale | 1 | `home_visit_main_scale` | text |
| home visit main alt | BDYCULTURE window signage at the Chermside clinic listing Physiotherapy, Exercise Physiology, Occupational… | `home_visit_main_alt` | text |
| home visit door image | — | `home_visit_door_image` | image |
| home visit door alt | BDYCULTURE clinic door signage, Suite 5, Level 1, Chermside | `home_visit_door_alt` | text |
| home visit cta 1 text | Get directions | `home_visit_cta_1_text` | text |
| home visit cta 1 url | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032 | `home_visit_cta_1_url` | text |
| home visit cta 1 style | ink | `home_visit_cta_1_style` | select |
| home visit cta 2 text | Book Online | `home_visit_cta_2_text` | text |
| home visit cta 2 url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `home_visit_cta_2_url` | text |
| home visit cta 2 style | ghost | `home_visit_cta_2_style` | select |

## 8. What to expect (`.expect`)

Dark band with three numbered cards, each with an icon and a short description.

- ACF tab: **expect**  ·  toggle `home_expect_show` = `true`  ·  order `home_expect_order` = `60`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home expect tag | What to expect | `home_expect_tag` | text |
| home expect title | Three steps from “I need help” to a plan. | `home_expect_title` | textarea |
| home expect intro | Getting started should be the easy part. Whether you book yourself or a GP, specialist or case manager refe… | `home_expect_intro` | textarea |
| home expect steps (repeater) | 3 row(s) — Book or refer / Book online through Nookal in a couple of minutes, call the clinic on 07 3073 1616, or send an enquiry. Ref… | `home_expect_steps` | repeater |
| &nbsp;&nbsp;└ expect step title | Book or refer | `expect_step_title` | text |
| &nbsp;&nbsp;└ expect step text | Book online through Nookal in a couple of minutes, call the clinic on 07 3073 1616, or send an enquiry. Ref… | `expect_step_text` | textarea |
| home expect btn 1 text | Book Online | `home_expect_btn_1_text` | text |
| home expect btn 1 url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select | `home_expect_btn_1_url` | text |
| home expect btn 1 icon | arrow | `home_expect_btn_1_icon` | select |
| home expect btn 2 text | Send an enquiry | `home_expect_btn_2_text` | text |
| home expect btn 2 url | #contact | `home_expect_btn_2_url` | text |

## 9. Funding (`.funding`)

Intro panel on the left, six funding cards on the right, each with a funding name, note and the services that accept it.

- ACF tab: **funding**  ·  toggle `home_funding_show` = `true`  ·  order `home_funding_order` = `70`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home funding tag | Funding & referrals | `home_funding_tag` | text |
| home funding title | Funding pathways that fit how you’re covered. | `home_funding_title` | textarea |
| home funding intro | Our services can be accessed through a range of funding pathways. Eligibility and availability differ by se… | `home_funding_intro` | textarea |
| home funding text | Each service page sets out the pathways for that discipline, along with what a referral involves and what t… | `home_funding_text` | textarea |
| home funding pathways (repeater) | 6 row(s) — Private / Book directly, no third party required | `home_funding_pathways` | repeater |
| &nbsp;&nbsp;└ pathway title | Private | `pathway_title` | text |
| &nbsp;&nbsp;└ pathway text | Book directly, no third party required | `pathway_text` | text |

## 10. Home visits & refer (`.pair`)

Two equal cards. Card one: home-visit copy plus phone button. Card two: referrer copy plus email button.

- ACF tab: **pair**  ·  toggle `home_pair_show` = `true`  ·  order `home_pair_order` = `80`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| pair 1 tag | More than a consulting room | `pair_1_tag` | text |
| pair 1 title | Home Visits Available by Arrangement | `pair_1_title` | text |
| pair 1 text | Physiotherapy and exercise physiology home visits may be available across Chermside and surrounding suburbs… | `pair_1_text` | textarea |
| pair 1 style | ink | `pair_1_style` | select |
| pair 1 btn 1 text | Call 07 3073 1616 | `pair_1_btn_1_text` | text |
| pair 1 btn 1 url | tel | `pair_1_btn_1_url` | text |
| pair 1 btn 1 style | signal | `pair_1_btn_1_style` | select |
| pair 1 btn 2 text | Ask about home visits | `pair_1_btn_2_text` | text |
| pair 1 btn 2 url | #contact | `pair_1_btn_2_url` | text |
| pair 1 btn 2 style | outline-light | `pair_1_btn_2_style` | select |
| pair 2 tag | For GPs, specialists & case managers | `pair_2_tag` | text |
| pair 2 title | Ready to get started? Refer a patient. | `pair_2_title` | text |
| pair 2 text | Whether you’re booking care or referring a patient, we’ll make the next step simple. Email referrals@bdycul… | `pair_2_text` | textarea |
| pair 2 style | signal | `pair_2_style` | select |
| pair 2 btn 1 text | Refer a Patient | `pair_2_btn_1_text` | text |
| pair 2 btn 1 url | /referrers/ | `pair_2_btn_1_url` | text |
| pair 2 btn 1 style | ink | `pair_2_btn_1_style` | select |
| pair 2 btn 1 icon | arrow | `pair_2_btn_1_icon` | select |
| pair 2 btn 2 text | — | `pair_2_btn_2_text` | text |
| pair 2 btn 2 url | — | `pair_2_btn_2_url` | text |
| pair 2 btn 2 style | — | `pair_2_btn_2_style` | — |

## 11. FAQ (`.faq`)

Eight question/answer rows in a native `<details>` accordion, one open at a time.

- ACF tab: **faq**  ·  toggle `home_faq_show` = `true`  ·  order `home_faq_order` = `90`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |
| home faq tag | FAQs | `home_faq_tag` | text |
| home faq title | Questions we’re often asked. | `home_faq_title` | textarea |
| home faq intro | Can’t see yours? Call 07 3073 1616 or send us a message — we’re happy to help. | `home_faq_intro` | textarea |
| home faq btn text | Ask a question | `home_faq_btn_text` | text |
| home faq btn url | #contact | `home_faq_btn_url` | text |
| home faq items (repeater) | 8 row(s) — Do I need a referral to book an appointment? / It depends on the service and how your care is funded. Private appointments can be booked online through No… | `home_faq_items` | repeater |
| &nbsp;&nbsp;└ faq question | Do I need a referral to book an appointment? | `faq_question` | text |
| &nbsp;&nbsp;└ faq answer | It depends on the service and how your care is funded. Private appointments can be booked online through No… | `faq_answer` | textarea |

## 12. Contact (`.contact`)

Dark band: heading, address/phone/email list with pin marker, the enquiry form card, the privacy note under the button, and the success state.

- ACF tab: **shared**  ·  toggle `home_contact_show` = `true`  ·  order `home_contact_order` = `100`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |

## 13. Map (`.mapsec`)

Heading + Leaflet map with a lazy "Load interactive map" button, Street/Satellite switch, suburb chips (Chermside / Aspley / Stafford / Wavell Heights) and the clinic address card.

- ACF tab: **shared**  ·  toggle `home_map_show` = `true`  ·  order `home_map_order` = `110`

| Element | Design content | ACF field | Type |
| --- | --- | --- | --- |

## 13. Inner pages — block library

Every inner page in the v2 design ships as a stack of **blocks**. The whole stack is edited in the
**Page — sections & SEO** group on the page itself (`page_sections`, a flexible-content field), so the client can
reorder, duplicate, remove or add a section without touching code. Each block's content falls back to
`defaults-pages.php`, so the approved design renders before a single field is saved.

`contact` (dark band + form) and `map` are appended by `page.php` on every inner page — edit them once in
**Theme Settings** and **Home page → 12. Map**, and every page follows. The enquiry card beside each hero is edited
once in **Theme Settings → Enquiry card**; the Practice page carries its own card (licence enquiry) through the
hero's "Card — …" fields.

| Page | Template | Blocks (in order) |
| --- | --- | --- |

| Services | `page.php` | Hero, Service cards, Split (copy + media), Funding pathways, Split (copy + media), FAQ |
| Physiotherapy | `page.php` | Hero, Split (copy + media), Feature cards, Numbered steps, Funding pathways, Split (copy + media), FAQ, CTA band |
| Exercise Physiology | `page.php` | Hero, Split (copy + media), Feature cards, Numbered steps, Funding pathways, Split (copy + media), FAQ, CTA band |
| Occupational Therapy | `page.php` | Hero, Split (copy + media), Feature cards, Numbered steps, Funding pathways, Split (copy + media), FAQ, CTA band |
| Clinical Pilates | `page.php` | Hero, Split (copy + media), Feature cards, Numbered steps, Funding pathways, Split (copy + media), FAQ, CTA band |
| Referrers | `page.php` | Hero, Split (copy + media), Split (copy + media), Numbered steps, Split (copy + media), Funding pathways, FAQ |
| Contact | `page.php` | Hero, Ways to book, Split (copy + media) |
| Location — Chermside | `page.php` | Hero, Split (copy + media), Service links (compact), Split (copy + media), Suburb list, Funding pathways, FAQ |
| Practice from BDYCULTURE | `page.php` | Hero, Feature cards, Split (copy + media), Feature cards, Feature cards, Numbered steps, FAQ, CTA band |
| Privacy Policy | `page.php` | Hero, Long copy |
| Blog index | `home.php` | Hero, Featured post, Post grid, Split (copy + media), FAQ |
| Blog post | `single.php` | Hero, Article (rendered by `single.php`) |

### Block types

| ACF layout | Design section | What it edits |
| --- | --- | --- |
| `hero` | `.hero--inner` | Breadcrumb (auto: Home / page title), H1, lead, buttons, checklist, optional custom enquiry card |
| `services` | `.svc-grid` | Tag, heading, intro and four service cards (number, icon, title, text, ticks, photo, link) |
| `svc_mini` | `.svc-grid--compact` | Tag, heading, intro and four compact service links |
| `features` | `.feature-grid` | Tag, heading, intro and 3–4 feature cards (icon, title, text) |
| `split` | `.split` | Tag, heading, rich copy, buttons, note, photo and an optional info panel |
| `steps` | `.steps` | Tag, heading, intro and three numbered steps |
| `funding` | `.funding` | Tag, heading, intro and the funding cards (name, note, accepted services) |
| `faq` | `.faq` | Tag, heading, intro, "ask a question" button and the question/answer rows |
| `cta` | `.cta-band` | Heading, supporting line and the two buttons |
| `ways` | `.ways` | The four ways-to-book cards (title, text, detail, link) |
| `suburbs` | `.suburbs` | Tag, heading, intro, the suburb/topic list, copy and the placeholder note |
| `prose` | `.prose` | Long-form copy (used for the Privacy Policy, variant `legal`) |
| `posts_featured` | `.post-featured` | Tag, heading and the lead article (falls back to the latest post) |
| `posts_grid` | `.posts-grid` | Tag, heading and the article grid with topic chips (latest six posts) |
| — | `single.php` | Post title, meta (date · reading time · category), body, sidebar cards and the article CTA |

Blog content is real WordPress content: the blog index lists your published posts (`home.php`) and each article
renders through `single.php`. The shipped block copy is the fallback used until posts exist.


## 14. Not content-editable (by design)

These are structure only and stay in code: section wrappers and heading ids, `has-arcs` decoration,
the ROM gauge markup, the `.swept` media frames, the success-state artwork, the map tiles and the
ribbon duplication. Their text and images are all edited through the fields above.

