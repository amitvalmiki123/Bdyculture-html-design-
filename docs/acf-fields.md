# ACF field reference

Every visible string, image, link, repeatable row and toggle in the theme is an ACF field,
registered in code with `acf_add_local_field_group()` (nothing lives in the database UI only,
so the site can be rebuilt from the theme). Field keys follow `field_{name}` and are globally
unique.

| Group | Key | Location | Tabs |
| --- | --- | --- | --- |
| Site Settings — clinic, header, footer | `group_bdy_global` | `options_page` == `bdyculture-settings` | Clinic details, Header & navigation, Footer, Mobile action bar |
| Home page — all sections | `group_bdy_home` | `page_type` == `front_page` | 1. Hero, 2. Marquee, 3. Services, 4. More than a consulting room, 5. Photo ribbon, 6. What to expect, 7. Funding, 8. Home visits & refer, 9. FAQ, 10. Contact, 11. Map |
| Page — hero & SEO | `group_bdy_page` | `post_type` == `page` AND `page_type` != `front_page` | Page hero, SEO |

## Site Settings — clinic, header, footer

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
| Opening hours | `clinic_hours` | text | — |
| Clinic tagline | `clinic_tagline` | textarea | — |
| Default meta description | `clinic_meta_description` | textarea | Used when a page has no meta description of its own. |
| Header logo (dark) | `clinic_logo` | image | returns: array |
| Footer logo (light) | `clinic_logo_light` | image | returns: array |
| **Header & navigation** | — | tab | — |
| Primary navigation | `header_nav` | repeater | min 1 / max None; layout: block; Drop-down menus use the "Sub-menu" rows inside an item. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `nav_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `nav_link` | text | Use /physiotherapy/ for a page on this site, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Sub-menu | `nav_children` | repeater | min None / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Label | `child_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Link | `child_link` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `child_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Secondary link | `child_alt` | true_false | Shown in the desktop drop-down only (not the mobile drawer). |
| "Enquire" button label | `header_enquire_text` | text | — |
| "Book Online" button label | `header_book_text` | text | — |
| Mobile drawer enquiry label | `header_drawer_enquire_text` | text | — |
| **Footer** | — | tab | — |
| Footer logo | `footer_logo` | image | returns: array |
| Footer tagline | `footer_tagline` | textarea | — |
| Footer button label | `footer_cta_text` | text | — |
| Footer button link | `footer_cta_url` | text | — |
| Footer columns | `footer_columns` | repeater | min None / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Column title | `col_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Column text | `col_text` | textarea | Optional. Basic HTML allowed, e.g. a postal address with line breaks. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Column links | `col_links` | repeater | min None / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Label | `link_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Link | `link_url` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└ Type | `link_type` | select | options: link, tel, email |
| Copyright line | `footer_copyright` | text | — |
| Privacy link label | `footer_privacy_text` | text | — |
| Privacy link URL | `footer_privacy_url` | text | — |
| Credit line | `footer_credit` | text | — |
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
| Hero buttons | `home_hero_buttons` | repeater | min None / max 3; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `hero_btn_text` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Link | `hero_btn_url` | text | Use tel for the phone number, /page/ for a page, or a full URL. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style | `hero_btn_style` | select | options: signal, ink, ghost, light, outline-light, call |
| &nbsp;&nbsp;&nbsp;&nbsp;└ After-icon | `hero_btn_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ New tab | `hero_btn_new_tab` | true_false | — |
| Hero checklist | `home_hero_checks` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `hero_check_text` | text | — |
| Enquiry form shortcode (Contact Form 7) | `home_hero_form_shortcode` | text | Paste a CF7 shortcode, e.g. [contact-form-7 id="123"]. Leave empty to use the built-in des |
| Form tag | `home_hero_form_tag` | text | — |
| Form heading (H2) | `home_hero_form_title` | text | — |
| Form intro | `home_hero_form_intro` | textarea | — |
| Label — name | `home_hero_form_label_name` | text | — |
| Label — phone | `home_hero_form_label_phone` | text | — |
| Label — email | `home_hero_form_label_email` | text | — |
| Label — service select | `home_hero_form_label_service` | text | — |
| Service select options | `home_hero_form_options` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Option | `hero_form_option_text` | text | — |
| Submit button label | `home_hero_form_button` | text | — |
| Alt action — text | `home_hero_form_alt_text` | text | — |
| Alt action — link label | `home_hero_form_alt_link_text` | text | — |
| Success heading | `home_hero_form_success_title` | text | — |
| Success message | `home_hero_form_success_text` | textarea | Use {phone_link} to print the clinic phone link. |
| **2. Marquee** | — | tab | — |
| Show this section | `home_marquee_show` | true_false | — |
| Order | `home_marquee_order` | number | Lower numbers render first. |
| Marquee items | `home_marquee_items` | repeater | min 2 / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `marquee_item_text` | text | — |
| **3. Services** | — | tab | — |
| Show this section | `home_services_show` | true_false | — |
| Order | `home_services_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_services_tag` | text | — |
| Heading (H2) | `home_services_title` | textarea | Basic HTML allowed, e.g. &lt;br&gt;. |
| Intro | `home_services_intro` | textarea | — |
| Service tabs & panels | `home_services_panels` | repeater | min 1 / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Tab label | `panel_tab_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Tab icon | `panel_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Image chip label | `panel_chip` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel photo | `panel_image` | image | returns: array |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo focus — X | `panel_img_x` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo focus — Y | `panel_img_y` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo zoom | `panel_img_scale` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel heading (H3) | `panel_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel lead | `panel_lead` | textarea | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Panel body | `panel_body` | textarea | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Tick list | `panel_ticks` | repeater | min None / max None; layout: table |
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
| Inset photo | `home_continuum_inset` | image | returns: array |
| Inset focus — X | `home_continuum_inset_x` | text | — |
| Inset focus — Y | `home_continuum_inset_y` | text | — |
| Inset zoom | `home_continuum_inset_scale` | text | — |
| Badge number | `home_continuum_badge_number` | text | — |
| Badge text | `home_continuum_badge_text` | textarea | — |
| Approach steps | `home_continuum_steps` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Icon | `continuum_step_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `continuum_step_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `continuum_step_text` | textarea | — |
| "Read more" label | `home_continuum_more_closed` | text | — |
| "Show less" label | `home_continuum_more_open` | text | — |
| Expandable paragraphs | `home_continuum_paragraphs` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Paragraph | `continuum_para_text` | textarea | — |
| Button 1 — text | `home_continuum_btn_1_text` | text | — |
| Button 1 — link | `home_continuum_btn_1_url` | text | — |
| Button 2 — text | `home_continuum_btn_2_text` | text | — |
| Button 2 — link | `home_continuum_btn_2_url` | text | — |
| **5. Photo ribbon** | — | tab | — |
| Show this section | `home_ribbon_show` | true_false | — |
| Order | `home_ribbon_order` | number | Lower numbers render first. |
| Ribbon photos | `home_ribbon_images` | repeater | min None / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Photo | `ribbon_image` | image | returns: array |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Focus — X | `ribbon_x` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Focus — Y | `ribbon_y` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Zoom | `ribbon_scale` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Swept corner | `ribbon_swept` | true_false | — |
| **6. What to expect** | — | tab | — |
| Show this section | `home_expect_show` | true_false | — |
| Order | `home_expect_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_expect_tag` | text | — |
| Heading (H2) | `home_expect_title` | textarea | — |
| Intro | `home_expect_intro` | textarea | — |
| Steps | `home_expect_steps` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `expect_step_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Text | `expect_step_text` | textarea | — |
| Button 1 — text | `home_expect_btn_1_text` | text | — |
| Button 1 — link | `home_expect_btn_1_url` | text | — |
| Button 1 icon | `home_expect_btn_1_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| Button 2 — text | `home_expect_btn_2_text` | text | — |
| Button 2 — link | `home_expect_btn_2_url` | text | — |
| **7. Funding** | — | tab | — |
| Show this section | `home_funding_show` | true_false | — |
| Order | `home_funding_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_funding_tag` | text | — |
| Heading (H2) | `home_funding_title` | textarea | — |
| Intro | `home_funding_intro` | textarea | — |
| Second paragraph | `home_funding_text` | textarea | — |
| Funding pathways | `home_funding_pathways` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Title | `pathway_title` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Note | `pathway_text` | text | — |
| **8. Home visits & refer** | — | tab | — |
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
| **9. FAQ** | — | tab | — |
| Show this section | `home_faq_show` | true_false | — |
| Order | `home_faq_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_faq_tag` | text | — |
| Heading (H2) | `home_faq_title` | textarea | — |
| Intro | `home_faq_intro` | textarea | Use {phone_link} for the clinic phone link. |
| Button text | `home_faq_btn_text` | text | — |
| Button link | `home_faq_btn_url` | text | — |
| Questions | `home_faq_items` | repeater | min None / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Question | `faq_question` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Answer | `faq_answer` | textarea | — |
| **10. Contact** | — | tab | — |
| Show this section | `home_contact_show` | true_false | — |
| Order | `home_contact_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_contact_tag` | text | — |
| Heading (H2) | `home_contact_title` | textarea | — |
| Intro | `home_contact_intro` | textarea | — |
| Contact details list | `home_contact_list` | repeater | min None / max None; layout: block |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Label | `contact_list_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Value | `contact_list_value` | textarea | Tokens: {phone_link}, {email_link}, {referrals_email_link}. Basic HTML allowed. |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Style as placeholder | `contact_list_placeholder` | true_false | — |
| Booking button — text | `home_contact_btn_text` | text | — |
| Booking button — link | `home_contact_btn_url` | text | — |
| Booking button icon | `home_contact_btn_icon` | select | options: , physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search |
| Contact form shortcode (Contact Form 7) | `home_contact_form_shortcode` | text | Paste a CF7 shortcode. Leave empty to use the built-in designed form. |
| Form heading (H3) | `home_contact_form_title` | text | — |
| Form intro | `home_contact_form_intro` | text | — |
| Label — name | `home_contact_form_label_name` | text | — |
| Label — phone | `home_contact_form_label_phone` | text | — |
| Label — email | `home_contact_form_label_email` | text | — |
| Label — enquiry type | `home_contact_form_label_type` | text | — |
| Label — interest | `home_contact_form_label_interest` | text | — |
| Label — message | `home_contact_form_label_message` | text | — |
| Enquiry type options | `home_contact_form_types` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Option | `contact_type_option_text` | text | — |
| Interest options | `home_contact_form_interests` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Option | `contact_interest_option_text` | text | — |
| Submit button label | `home_contact_form_button` | text | — |
| Success heading | `home_contact_form_success_title` | text | — |
| Success message | `home_contact_form_success_text` | textarea | Use {phone_link} for the clinic phone link. |
| **11. Map** | — | tab | — |
| Show this section | `home_map_show` | true_false | — |
| Order | `home_map_order` | number | Lower numbers render first. |
| Eyebrow tag | `home_map_tag` | text | — |
| Heading (H2) | `home_map_title` | text | — |
| Latitude | `home_map_lat` | text | — |
| Longitude | `home_map_lng` | text | — |
| Zoom | `home_map_zoom` | number | — |
| "Load map" button label | `home_map_load_label` | text | — |
| Map card heading (H3) | `home_map_card_title` | text | — |
| Map card address | `home_map_card_text` | textarea | — |
| "Around the clinic" label | `home_map_chips_label` | text | — |
| Nearby suburbs | `home_map_chips` | repeater | min None / max None; layout: table |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Suburb | `chip_label` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Latitude | `chip_lat` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Longitude | `chip_lng` | text | — |
| &nbsp;&nbsp;&nbsp;&nbsp;└ Zoom | `chip_zoom` | text | — |
| Button 1 — text | `home_map_btn_1_text` | text | — |
| Button 1 — link | `home_map_btn_1_url` | text | — |
| Button 2 — text | `home_map_btn_2_text` | text | — |
| Button 2 — link | `home_map_btn_2_url` | text | — |

## Page — hero & SEO

Group key: `group_bdy_page`  ·  location: `post_type` == `page` AND `page_type` != `front_page`

| Field | Name | Type | Flags |
| --- | --- | --- | --- |
| **Page hero** | — | tab | — |
| Show this section | `page_hero_show` | true_false | — |
| Order | `page_hero_order` | number | Lower numbers render first. |
| Eyebrow tag | `page_hero_tag` | text | — |
| Lead image | `page_hero_image` | image | returns: array |
| Intro | `page_hero_intro` | textarea | — |
| Lead image focal point | `page_hero_image_position` | text | CSS object-position, e.g. 40% 60%. |
| **SEO** | — | tab | — |
| Meta description | `page_meta_description` | textarea | Leave empty to use the default from Site Settings. |

