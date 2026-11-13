# ACF field reference

Every visible string, image, link, repeatable row and toggle in the theme is an ACF field,
registered in code with `acf_add_local_field_group()` (nothing lives in the database UI only,
so the site can be rebuilt from the theme). Field keys follow `field_{name}` and are globally
unique.

| Group | Key | Location | Tabs |
| --- | --- | --- | --- |
| Site Settings — clinic, shared bands, header & footer | `group_bdy_global` | `options_page` == `bdyculture-settings` | Clinic details, Header & navigation, Enquiry card, Contact band, Map band, Footer, Mobile action bar |
| Home page — all sections | `group_bdy_home` | `page_type` == `front_page` | 1. Hero, 2. Marquee, 3. Services, 4. More than a consulting room, 5. Photo ribbon, 6. Visit us, 7. What to expect, 8. Funding, 9. Home visits & refer, 10. FAQ, 11. Contact band & map (shared) |
| Page — sections, shared bands & fallback | `group_bdy_page` | `post_type` == `page` AND `page_type` != `front_page` | 1. Page sections, 2. Shared bands (contact & map), 3. Fallback hero |

## Site Settings — clinic, shared bands, header & footer

Group key: `group_bdy_global`  ·  location: `options_page` == `bdyculture-settings`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| **Clinic details** | — | tab | — |
| _note_ | `bdy_msg_clinic` | message | These values feed the header, footer, contact section, buttons and the {phone_link} / {email_link} tokens used in text f |
| Phone (display) | `clinic_phone_display` | text | — |
| Phone (tel: link) | `clinic_phone_tel` | text | Digits only, e.g. 0730731616. Used for every tel: link. |
| General enquiries email | `clinic_email` | email | — |
| Referrals email | `clinic_email_referrals` | email | — |
| Address line 1 | `clinic_address_1` | text | — |
| Address line 2 | `clinic_address_2` | text | — |
| Online booking URL (Nookal) | `clinic_booking_url` | url | — |
| Directions URL | `clinic_directions_url` | url | — |
| Opening hours | `clinic_hours` | text | One line, e.g. Mon–Fri 7am–7pm · Sat 7am–1pm. Prints wherever you type {hours}. |
| Clinic tagline | `clinic_tagline` | textarea | One sentence under the logo. Also used as the footer tagline when that field is empty. |
| Header logo (dark) | `clinic_logo` | image | returns: array |
| Footer logo (light) | `clinic_logo_light` | image | White version of the logo. Used in the footer when no Footer logo is chosen.; returns: array |
| **Header & navigation** | — | tab | — |
| _note_ | `bdy_msg_header_nav_note` | message | <strong>Navigation lives in Appearance → Menus</strong><br>Assign a menu to “Header — primary navigation”. Sub-items bec |
| "Enquire" button label | `header_enquire_text` | text | — |
| "Book Online" button label | `header_book_text` | text | — |
| Mobile drawer enquiry label | `header_drawer_enquire_text` | text | — |
| **Enquiry card** | — | tab | — |
| _note_ | `bdy_msg_enquiry` | message | The short form that sits beside the hero on every inner page. It is a Contact Form 7 form — the theme stores the shortco |
| Tag | `enquiry_tag` | text | — |
| Heading | `enquiry_title` | text | — |
| _note_ | `bdy_msg_enquiry_form` | message | The form itself is built in Contact Form 7 — paste its shortcode below. Only the tag, the heading and the lines under th |
| Form shortcode | `enquiry_shortcode` | text | Paste the shortcode from Contact Form 7 → Forms. Leave empty and the design's own form is  |
| Alt action — text | `enquiry_alt_text` | text | — |
| Alt action — link label | `enquiry_alt_link_text` | text | — |
| Line under the form | `enquiry_note` | textarea | Privacy line under the fields. Use {privacy_link} for the linked Privacy Policy. |
| **Contact band** | — | tab | — |
| _note_ | `bdy_msg_contact_band` | message | The dark "Get in touch" band. It closes the homepage and every inner page, so edit it once here. Show/order per page is  |
| Tag | `contact_tag` | text | — |
| Heading (H2) | `contact_title` | textarea | — |
| Intro | `contact_intro` | textarea | — |
| Contact details | `contact_list` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `contact_list_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Value | `contact_list_value` | text | Accepts {phone_link}, {email_link}, {address_html}. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Placeholder | `contact_list_placeholder` | true_false | — |
| Button text | `contact_btn_text` | text | — |
| Button link | `contact_btn_url` | text | — |
| Button icon | `contact_btn_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| _note_ | `bdy_msg_contact_form` | message | The form itself is built in Contact Form 7 (or any form plugin). Paste its shortcode below. Only this heading and the no |
| Form shortcode | `contact_form_shortcode` | text | Paste the shortcode from Contact Form 7 → Forms. Leave empty and the design's own form is  |
| Form heading (H3) | `contact_form_title` | text | — |
| Line under the form | `contact_form_note` | textarea | Privacy line shown under the submit button. Use {privacy_link} for the linked Privacy Poli |
| **Map band** | — | tab | — |
| _note_ | `bdy_msg_map_band` | message | The "Find the clinic" band with the Leaflet map. Edited once here; each page decides whether it shows. |
| Tag | `map_tag` | text | — |
| Heading (H2) | `map_title` | text | — |
| Latitude | `map_lat` | text | — |
| Longitude | `map_lng` | text | — |
| Zoom | `map_zoom` | number | — |
| "Load map" button label | `map_load_label` | text | — |
| Map card heading (H3) | `map_card_title` | text | — |
| Map card address | `map_card_text` | textarea | — |
| "Around the clinic" label | `map_chips_label` | text | — |
| Nearby suburbs | `map_chips` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Suburb | `chip_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Latitude | `chip_lat` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Longitude | `chip_lng` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Zoom | `chip_zoom` | text | — |
| Button 1 — text | `map_btn_1_text` | text | — |
| Button 1 — link | `map_btn_1_url` | text | — |
| Button 2 — text | `map_btn_2_text` | text | — |
| Button 2 — link | `map_btn_2_url` | text | — |
| **Footer** | — | tab | — |
| Footer logo | `footer_logo` | image | returns: array |
| Footer tagline | `footer_tagline` | textarea | — |
| Footer button label | `footer_cta_text` | text | — |
| Footer button link | `footer_cta_url` | text | — |
| Copyright line | `footer_copyright` | text | Left side of the bottom bar. Write the © year as text — it is not updated automatically. |
| Privacy link label | `footer_privacy_text` | text | — |
| Privacy link URL | `footer_privacy_url` | text | — |
| _note_ | `bdy_msg_footer_nav_note` | message | <strong>Footer link columns live in Appearance → Menus</strong><br>Assign one menu to “Footer — services column” and one |
| Credit line | `footer_credit` | text | Use {credit_link} where the linked agency name should appear. |
| Credit — agency name | `footer_credit_label` | text | — |
| Credit — link URL | `footer_credit_url` | url | — |
| Footer disclaimer | `footer_note` | textarea | — |
| **Mobile action bar** | — | tab | — |
| _note_ | `bdy_msg_mobile_bar` | message | The sticky Call / Book Online bar shown below 1100px. Phone number and booking URL come from Clinic details. |
| Call button label | `mobile_bar_call_text` | text | — |
| Book button label | `mobile_bar_book_text` | text | — |

## Home page — all sections

Group key: `group_bdy_home`  ·  location: `page_type` == `front_page`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| **1. Hero** | — | tab | — |
| Show this section | `home_hero_show` | true_false | — |
| Order | `home_hero_order` | number | Lower numbers render first. |
| Hero background photo | `home_hero_image` | image | Fills the hero behind a dark wash. Leave empty to use the bundled photo.; returns: array |
| Hero heading (H1) | `home_hero_title` | textarea | Allowed markup: &lt;br&gt;, &lt;span class="amp"&gt; and &lt;span class="hero__highlight"& |
| Hero lead paragraph | `home_hero_lead` | textarea | — |
| Hero buttons | `home_hero_buttons` | repeater | max 3; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `hero_btn_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `hero_btn_url` | text | Use tel for the phone number, /page/ for a page, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style | `hero_btn_style` | select | options: signal, ink, ghost, light, outline-light, call |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `hero_btn_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon side | `hero_btn_icon_pos` | select | options: auto, right, left |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `hero_btn_new_tab` | true_false | — |
| Hero checklist | `home_hero_checks` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `hero_check_text` | text | — |
| **2. Marquee** | — | tab | — |
| Show this section | `home_marquee_show` | true_false | — |
| Order | `home_marquee_order` | number | Lower numbers render first. |
| Marquee items | `home_marquee_items` | repeater | min 2; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `marquee_item_text` | text | — |
| **3. Services** | — | tab | — |
| Show this section | `home_services_show` | true_false | — |
| Order | `home_services_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_services_tag` | text | — |
| Heading (H2) | `home_services_title` | textarea | Basic HTML allowed, e.g. &lt;br&gt;. |
| Intro | `home_services_intro` | textarea | — |
| Service tabs & panels | `home_services_panels` | repeater | min 1; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Tab label | `panel_tab_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Tab icon | `panel_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Image chip label | `panel_chip` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel photo | `panel_image` | image | returns: array |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo focus — X | `panel_img_x` | text | 70 or 70% — left ↔ right. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo focus — Y | `panel_img_y` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo zoom | `panel_img_scale` | text | 1 = no zoom, 1.5 = 50% bigger, up to 4. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel heading (H3) | `panel_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel lead | `panel_lead` | textarea | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel body | `panel_body` | textarea | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Tick list | `panel_ticks` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Text | `panel_tick_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Primary button — text | `panel_btn_1_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Primary button — link | `panel_btn_1_url` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Primary icon | `panel_btn_1_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Secondary button — text | `panel_btn_2_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Secondary button — link | `panel_btn_2_url` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Secondary opens in new tab | `panel_btn_2_new_tab` | true_false | — |
| **4. More than a consulting room** | — | tab | — |
| Show this section | `home_continuum_show` | true_false | — |
| Order | `home_continuum_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_continuum_tag` | text | — |
| Heading (H2) | `home_continuum_title` | textarea | — |
| Intro | `home_continuum_intro` | textarea | — |
| Main photo | `home_continuum_photo` | image | returns: array |
| Main photo alt text | `home_continuum_photo_alt` | text | Used only when the Media Library has no alt text. |
| Photo caption | `home_continuum_caption` | text | — |
| Main photo focus — X | `home_continuum_photo_x` | text | 38 or 38%. |
| Main photo focus — Y | `home_continuum_photo_y` | text | 50 or 50%. |
| Main photo zoom | `home_continuum_photo_scale` | text | 1 = no zoom, up to 4. |
| Inset photo | `home_continuum_inset` | image | returns: array |
| Inset focus — X | `home_continuum_inset_x` | text | — |
| Inset focus — Y | `home_continuum_inset_y` | text | — |
| Inset zoom | `home_continuum_inset_scale` | text | — |
| Badge number | `home_continuum_badge_number` | text | — |
| Badge text | `home_continuum_badge_text` | textarea | — |
| Approach steps | `home_continuum_steps` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `continuum_step_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `continuum_step_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `continuum_step_text` | textarea | — |
| "Read more" label | `home_continuum_more_closed` | text | — |
| "Show less" label | `home_continuum_more_open` | text | — |
| Expandable paragraphs | `home_continuum_paragraphs` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Paragraph | `continuum_para_text` | textarea | — |
| Button 1 — text | `home_continuum_btn_1_text` | text | — |
| Button 1 — link | `home_continuum_btn_1_url` | text | — |
| Button 2 — text | `home_continuum_btn_2_text` | text | — |
| Button 2 — link | `home_continuum_btn_2_url` | text | — |
| **5. Photo ribbon** | — | tab | — |
| Show this section | `home_ribbon_show` | true_false | — |
| Order | `home_ribbon_order` | number | Lower numbers render first. |
| Ribbon photos | `home_ribbon_images` | repeater | layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo | `ribbon_image` | image | returns: array |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Focus — X | `ribbon_x` | text | 70 or 70%. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Focus — Y | `ribbon_y` | text | 60 or 60%. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Zoom | `ribbon_scale` | text | 1 = no zoom, up to 4. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Swept corner | `ribbon_swept` | true_false | — |
| **6. Visit us** | — | tab | — |
| Show this section | `home_visit_show` | true_false | — |
| Order | `home_visit_order` | number | Lower numbers render first. |
| Tag | `home_visit_tag` | text | — |
| Heading (H2) | `home_visit_title` | text | — |
| Paragraph 1 | `home_visit_text_1` | textarea | — |
| Paragraph 2 | `home_visit_text_2` | textarea | — |
| Photo — window signage | `home_visit_main_image` | image | Portrait crop (4:5). Leave empty to use the bundled photo.; returns: array |
| Photo focus — X | `home_visit_main_x` | text | 50 or 50%. |
| Photo focus — Y | `home_visit_main_y` | text | 40 or 40%. |
| Photo zoom | `home_visit_main_scale` | text | 1 = no zoom, up to 4. |
| Alt text — window signage | `home_visit_main_alt` | text | — |
| Photo — door signage | `home_visit_door_image` | image | Small overlapping card. Leave empty to use the bundled photo.; returns: array |
| Alt text — door signage | `home_visit_door_alt` | text | — |
| Button 1 — label | `home_visit_cta_1_text` | text | — |
| Button 1 — link | `home_visit_cta_1_url` | text | — |
| Button 1 — style | `home_visit_cta_1_style` | select | options: signal, ink, ghost, light, outline-light, call |
| Button 2 — label | `home_visit_cta_2_text` | text | — |
| Button 2 — link | `home_visit_cta_2_url` | text | — |
| Button 2 — style | `home_visit_cta_2_style` | select | options: signal, ink, ghost, light, outline-light, call |
| **7. What to expect** | — | tab | — |
| Show this section | `home_expect_show` | true_false | — |
| Order | `home_expect_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_expect_tag` | text | — |
| Heading (H2) | `home_expect_title` | textarea | — |
| Intro | `home_expect_intro` | textarea | — |
| Steps | `home_expect_steps` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `expect_step_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `expect_step_text` | textarea | — |
| Button 1 — text | `home_expect_btn_1_text` | text | — |
| Button 1 — link | `home_expect_btn_1_url` | text | — |
| Button 1 icon | `home_expect_btn_1_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| Button 2 — text | `home_expect_btn_2_text` | text | — |
| Button 2 — link | `home_expect_btn_2_url` | text | — |
| **8. Funding** | — | tab | — |
| Show this section | `home_funding_show` | true_false | — |
| Order | `home_funding_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_funding_tag` | text | — |
| Heading (H2) | `home_funding_title` | textarea | — |
| Intro | `home_funding_intro` | textarea | — |
| Second paragraph | `home_funding_text` | textarea | — |
| Funding pathways | `home_funding_pathways` | repeater | layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `pathway_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Note | `pathway_text` | text | — |
| **9. Home visits & refer** | — | tab | — |
| Show this section | `home_pair_show` | true_false | — |
| Order | `home_pair_order` | number | Lower numbers render first. |
| Card 1 — tag | `pair_1_tag` | text | — |
| Card 1 — style | `pair_1_style` | select | options: ink, signal |
| Card 1 — heading (H2) | `pair_1_title` | text | — |
| Card 1 — text | `pair_1_text` | textarea | — |
| Card 1 — button 1 text | `pair_1_btn_1_text` | text | — |
| Card 1 — button 1 link | `pair_1_btn_1_url` | text | — |
| Card 1 — button 1 style | `pair_1_btn_1_style` | select | options: signal, ink, ghost, light, outline-light, call |
| Card 1 — button 2 text | `pair_1_btn_2_text` | text | — |
| Card 1 — button 2 link | `pair_1_btn_2_url` | text | — |
| Card 1 — button 2 style | `pair_1_btn_2_style` | select | options: signal, ink, ghost, light, outline-light, call |
| Card 2 — tag | `pair_2_tag` | text | — |
| Card 2 — style | `pair_2_style` | select | options: ink, signal |
| Card 2 — heading (H2) | `pair_2_title` | text | — |
| Card 2 — text | `pair_2_text` | textarea | Use {referrals_email_link} to insert the referrals email link from Site Settings. |
| Card 2 — button 1 text | `pair_2_btn_1_text` | text | — |
| Card 2 — button 1 link | `pair_2_btn_1_url` | text | — |
| Card 2 — button 1 style | `pair_2_btn_1_style` | select | options: signal, ink, ghost, light, outline-light, call |
| Card 2 — button 1 icon | `pair_2_btn_1_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| Card 2 — button 2 text | `pair_2_btn_2_text` | text | — |
| Card 2 — button 2 link | `pair_2_btn_2_url` | text | — |
| **10. FAQ** | — | tab | — |
| Show this section | `home_faq_show` | true_false | — |
| Order | `home_faq_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_faq_tag` | text | — |
| Heading (H2) | `home_faq_title` | textarea | — |
| Intro | `home_faq_intro` | textarea | Use {phone_link} for the clinic phone link. |
| Button text | `home_faq_btn_text` | text | — |
| Button link | `home_faq_btn_url` | text | — |
| Questions | `home_faq_items` | repeater | layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Question | `faq_question` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Answer | `faq_answer` | textarea | — |
| **11. Contact band & map (shared)** | — | tab | — |
| _note_ | `bdy_msg_shared` | message | Both bands are edited once in BDYCULTURE → Theme Settings, then shown here and on every inner page. Set the order below  |
| Show this section | `home_contact_show` | true_false | — |
| Order | `home_contact_order` | number | Lower numbers render first. |
| Show this section | `home_map_show` | true_false | — |
| Order | `home_map_order` | number | Lower numbers render first. |

## Page — sections, shared bands & fallback

Group key: `group_bdy_page`  ·  location: `post_type` == `page` AND `page_type` != `front_page`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| **1. Page sections** | — | tab | — |
| _note_ | `bdy_msg_page_blocks` | message | <strong>This page is built from blocks</strong><br>Add, remove or drag the blocks to change the page. Left empty, the pa |
| Blocks | `page_sections` | flexible_content | — |
| **2. Shared bands (contact & map)** | — | tab | — |
| _note_ | `bdy_msg_page_shared` | message | The "Get in touch" and "Find the clinic" bands are written once in BDYCULTURE → Theme Settings. Here you only choose whe |
| Show this section | `page_contact_show` | true_false | — |
| Order | `page_contact_order` | number | Lower numbers render first. |
| Show this section | `page_map_show` | true_false | — |
| Order | `page_map_order` | number | Lower numbers render first. |
| **3. Fallback hero** | — | tab | — |
| _note_ | `bdy_msg_page_fallback` | message | Only used by a page that has no blocks and no shipped design — the H1 is the page title, then the editor content below. |
| Eyebrow tag | `page_hero_tag` | text | — |
| Lead image | `page_hero_image` | image | returns: array |
| Intro | `page_hero_intro` | textarea | — |
| Lead image focal point | `page_hero_image_position` | text | CSS object-position, e.g. 40% 60%. |

### Blocks of `page_sections`

Each layout below is one block in the page stack: pick it under *Add section*, then fill in its fields.

#### 1. Hero (breadcrumbs, H1, lead, buttons)  ·  `hero`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Heading (H1) | `title` | text | — |
| Lead paragraph | `lead` | textarea | — |
| Buttons | `buttons` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `url` | text | Use /page/ for a page, tel for the phone number, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style | `style` | select | options: signal, ink, ghost, light, outline-light, call |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , arrow, phone, check |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `new_tab` | true_false | — |
| Small checklist | `checks` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | text | — |
| Breadcrumb — this page | `crumb_current` | text | Leave empty to use the page title. "Home" is always added. |
| Show the enquiry card | `form` | true_false | The card itself is edited once in Site Settings → Enquiry card. |
| Card — tag | `form_tag` | text | Only needed for a card that differs from Site Settings. |
| Card — heading | `form_title` | text | — |
| Card — intro | `form_intro` | textarea | — |
| Card — fields (replaces the standard name/phone/email/service set) | `form_fields` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Field name | `name` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Type | `type` | select | options: text, email, tel, number |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Autocomplete | `autocomplete` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Half width | `half` | true_false | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Required | `required` | true_false | — |
| Card — submit button | `form_button` | text | — |
| Card — success heading | `form_success_title` | text | — |
| Card — privacy note | `form_note` | textarea | Use {privacy_link} for the linked Privacy Policy. |
| Card — success message | `form_success_text` | textarea | Use {phone_link} for the clinic phone link. |

#### 2. Service cards  ·  `services`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Extra copy | `body` | wysiwyg | — |
| Paper background | `paper` | true_false | — |
| Cards | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search, heart, trend |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | textarea | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Button label | `btn_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Button link | `btn_url` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Extra link label | `link_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Extra link URL | `link_url` | text | — |

#### 3. Compact service links  ·  `svc_mini`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Paper background | `paper` | true_false | — |
| Links | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ URL | `url` | text | — |

#### 4. Feature cards  ·  `features`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Extra copy | `body` | wysiwyg | — |
| Paper background | `paper` | true_false | — |
| Columns | `variant` | select | options: , four |
| Cards | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search, heart, trend |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | textarea | — |

#### 5. Split (text + photo or info card)  ·  `split`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Body copy | `body` | wysiwyg | — |
| Small note under the buttons | `note` | wysiwyg | — |
| Buttons | `buttons` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `url` | text | Use /page/ for a page, tel for the phone number, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style | `style` | select | options: signal, ink, ghost, light, outline-light, call |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , arrow, phone, check |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `new_tab` | true_false | — |
| Photo on the left | `reverse` | true_false | — |
| Paper background | `paper` | true_false | — |
| Photo (leave empty to use the info card) | `media` | group | — |
| Info card | `panel` | group | — |

#### 6. Steps  ·  `steps`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Dark band | `dark` | true_false | — |
| Light steps (on paper) | `light` | true_false | — |
| Paper background | `paper` | true_false | — |
| Steps | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | textarea | — |
| Buttons | `buttons` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `url` | text | Use /page/ for a page, tel for the phone number, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style | `style` | select | options: signal, ink, ghost, light, outline-light, call |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , arrow, phone, check |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `new_tab` | true_false | — |

#### 7. Funding pathways  ·  `funding`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Extra copy | `body` | wysiwyg | — |
| Paper background | `paper` | true_false | — |
| Pathways | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | textarea | — |

#### 8. FAQ accordion  ·  `faq`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | wysiwyg | — |
| Button label | `btn_text` | text | — |
| Button link | `btn_url` | text | — |
| Questions | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Question | `q` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Answer | `a` | wysiwyg | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Open by default | `open` | true_false | — |

#### 9. CTA band  ·  `cta`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Heading (H2) | `title` | text | — |
| Text | `text` | textarea | — |
| Buttons | `buttons` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `url` | text | Use /page/ for a page, tel for the phone number, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style | `style` | select | options: signal, ink, ghost, light, outline-light, call |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , arrow, phone, check |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `new_tab` | true_false | — |

#### 10. Ways to reach us  ·  `ways`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Cards | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search, heart, trend |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ URL | `url` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `new_tab` | true_false | — |

#### 11. Suburb list  ·  `suburbs`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Body copy | `body` | wysiwyg | — |
| Small print | `note` | text | — |
| Paper background | `paper` | true_false | — |
| Suburbs | `items` | repeater | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Suburb | `text` | text | — |

#### 12. Rich text  ·  `prose`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Heading (optional) | `title` | text | — |
| Content | `body` | wysiwyg | — |
| Paper background | `paper` | true_false | — |

#### 13. Blog — featured article  ·  `posts_featured`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |
| Sample article (used until posts exist) | `post` | group | — |

#### 14. Blog — article grid  ·  `posts_grid`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| Tag | `tag` | text | — |
| Heading (H2) | `title` | text | — |
| Intro | `intro` | textarea | — |

