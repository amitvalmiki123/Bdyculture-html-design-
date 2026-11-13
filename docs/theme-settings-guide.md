# Theme Settings — the one place for everything that repeats

**Where:** WordPress admin → **BDYCULTURE → Theme Settings**.

Everything in this screen is written **once** and used by every page: the phone number, the address, the header buttons, the footer, and the two closing bands (contact + map). Pages never hold a second copy of that text — they only decide whether a band shows and where it sits.

Changes are live as soon as you press **Update**. Nothing here can break a page: leave a field empty and the theme falls back to the approved design copy.

---

## 1. Tabs at a glance

| # | Tab | Controls | Appears on |
| --- | --- | --- | --- |
| 1 | Clinic details | The single source of truth for the practice. Every phone number, email, address, booking link and hours shown anywhere on the site comes from here. | Header (top bar, drawer, book button), Footer contact column, Contact band, Map card, Enquiry card, Every `{phone}`, `{email}`, `{address}` token in body copy |
| 2 | Header & navigation | Button labels in the sticky header and the mobile drawer. The menu itself is a normal WordPress menu (Appearance → Menus). | Sticky header, Mobile drawer |
| 3 | Enquiry card | The short "Request a call back" card beside every inner-page hero. The form inside it is a Contact Form 7 form — only its shortcode, tag, heading and the lines under it are stored here. | Hero card on the homepage, Hero card on inner pages |
| 4 | Contact band | The dark "Get in touch" band. Written **once** here and printed at the end of the homepage, every inner page, the blog index and single posts. Each page only decides *whether* it shows and in what order. The form inside it is a Contact Form 7 form — only its shortcode, heading and the line under it are stored here. | Homepage, All inner pages, Blog index, Single post |
| 5 | Map band | The "Find the clinic" band with the Leaflet map, suburb chips and address card. Same rule as the contact band: one copy, shown everywhere unless a page switches it off. | Homepage, All inner pages, Blog index, Single post |
| 6 | Footer | Footer tagline, copyright line, privacy link, the three link columns and the credit line. | Site footer |
| 7 | Mobile action bar | The two sticky buttons at the bottom of the screen on phones. | Mobile viewport only |

---

## 2. Field reference

The **Default** column is what the theme ships with — leave the field untouched and that is what the site shows.

### 1. Clinic details

The single source of truth for the practice. Every phone number, email, address, booking link and hours shown anywhere on the site comes from here.

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| Phone (display) | `clinic_phone_display` | text | 07 3073 1616 |
| Phone (tel: link) | `clinic_phone_tel` | text | 0730731616 |
| General enquiries email | `clinic_email` | email | hello@bdyculture.com.au |
| Referrals email | `clinic_email_referrals` | email | referrals@bdyculture.com.au |
| Address line 1 | `clinic_address_1` | text | 671 Gympie Road, Suite 5, Level 1 |
| Address line 2 | `clinic_address_2` | text | Chermside QLD 4032 |
| Online booking URL (Nookal) | `clinic_booking_url` | url | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-F… |
| Directions URL | `clinic_directions_url` | url | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road… |
| Opening hours | `clinic_hours` | text | Placeholder — client to confirm clinic hours |
| Clinic tagline | `clinic_tagline` | text (multi-line) | Allied health and rehabilitation in Chermside, Brisbane. |
| Header logo (dark) | `clinic_logo` | image | — |
| Footer logo (light) | `clinic_logo_light` | image | — |
### 2. Header & navigation

Button labels in the sticky header and the mobile drawer. The menu itself is a normal WordPress menu (Appearance → Menus).

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| "Enquire" button label | `header_enquire_text` | text | Enquire |
| "Book Online" button label | `header_book_text` | text | Book Online |
| Mobile drawer enquiry label | `header_drawer_enquire_text` | text | Send an enquiry |
### 3. Enquiry card

The short "Request a call back" card beside every inner-page hero. The form inside it is a Contact Form 7 form — only its shortcode, tag, heading and the lines under it are stored here.

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| Tag | `enquiry_tag` | text | Enquire online |
| Heading | `enquiry_title` | text | Request an appointment or ask a question |
| Form shortcode | `enquiry_shortcode` | text | (empty) |
| Alt action — text | `enquiry_alt_text` | text | Prefer to book yourself? |
| Alt action — link label | `enquiry_alt_link_text` | text | Book Online with Nookal |
| Line under the form | `enquiry_note` | text (multi-line) | By submitting this form, you acknowledge the BDYCULTURE {privac… |
### 4. Contact band

The dark "Get in touch" band. Written **once** here and printed at the end of the homepage, every inner page, the blog index and single posts. Each page only decides *whether* it shows and in what order. The form inside it is a Contact Form 7 form — only its shortcode, heading and the line under it are stored here.

> Per-page control: each page has **Show this section** and **Order** for this band on its own edit screen. Hit *Hide* on one page and the band disappears there only — the copy stays here.

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| Tag | `contact_tag` | text | Get in touch |
| Heading (H2) | `contact_title` | text (multi-line) | Let’s get you moving. |
| Intro | `contact_intro` | text (multi-line) | Book online in minutes, call the clinic, or send us a message a… |
| Contact details | `contact_list` | repeater (rows) | 4 row(s) |
| ↳ Label | `contact_list_contact_list_label` | text | Visit us |
| ↳ Value | `contact_list_contact_list_value` | text | {address_html} |
| ↳ Placeholder | `contact_list_contact_list_placeholder` | on/off | No |
| Button text | `contact_btn_text` | text | Book Online with Nookal |
| Button link | `contact_btn_url` | text | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-F… |
| Button icon | `contact_btn_icon` | dropdown | arrow |
| Form shortcode | `contact_form_shortcode` | text | (empty) |
| Form heading (H3) | `contact_form_title` | text | Send us a message |
| Line under the form | `contact_form_note` | text (multi-line) | By submitting this form, you acknowledge the BDYCULTURE <a href… |
### 5. Map band

The "Find the clinic" band with the Leaflet map, suburb chips and address card. Same rule as the contact band: one copy, shown everywhere unless a page switches it off.

> Per-page control: each page has **Show this section** and **Order** for this band on its own edit screen. Hit *Hide* on one page and the band disappears there only — the copy stays here.

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| Tag | `map_tag` | text | Find the clinic |
| Heading (H2) | `map_title` | text | On Gympie Road, Chermside. |
| Latitude | `map_lat` | text | -27.3852 |
| Longitude | `map_lng` | text | 153.0306 |
| Zoom | `map_zoom` | number | 16 |
| "Load map" button label | `map_load_label` | text | Load interactive map |
| Map card heading (H3) | `map_card_title` | text | BDYCULTURE |
| Map card address | `map_card_text` | text (multi-line) | Rehab &amp; Performance Clinic<br>{address_html} |
| "Around the clinic" label | `map_chips_label` | text | Around the clinic: |
| Nearby suburbs | `map_chips` | repeater (rows) | 7 row(s) |
| ↳ Suburb | `map_chips_chip_label` | text | Chermside |
| ↳ Latitude | `map_chips_chip_lat` | text | -27.3852 |
| ↳ Longitude | `map_chips_chip_lng` | text | 153.0306 |
| ↳ Zoom | `map_chips_chip_zoom` | text | 16 |
| Button 1 — text | `map_btn_1_text` | text | Get directions |
| Button 1 — link | `map_btn_1_url` | text | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road… |
| Button 2 — text | `map_btn_2_text` | text | Call |
| Button 2 — link | `map_btn_2_url` | text | tel |
### 6. Footer

Footer tagline, copyright line, privacy link, the three link columns and the credit line.

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| Footer logo | `footer_logo` | image | — |
| Footer tagline | `footer_tagline` | text (multi-line) | Allied health and rehabilitation in Chermside, Brisbane. |
| Footer button label | `footer_cta_text` | text | — |
| Footer button link | `footer_cta_url` | text | — |
| Credit line | `footer_credit` | text | Web Design by {credit_link} |
| Credit — agency name | `footer_credit_label` | text | Digital Movement |
| Credit — link URL | `footer_credit_url` | url | https://www.digitalmovement.com.au/ |
| Footer disclaimer | `footer_note` | text (multi-line) | Information on this website is general in nature and is not a s… |
### 7. Mobile action bar

The two sticky buttons at the bottom of the screen on phones.

| Field | Name | Type | Default |
| --- | --- | --- | --- |
| Call button label | `mobile_bar_call_text` | text | Call |
| Book button label | `mobile_bar_book_text` | text | Book Online |

---

## 3. Tokens you can type into any text field

| Token | Prints |
| --- | --- |
| `{phone}` | Phone number as text — `07 3073 1616` |
| `{phone_link}` | Phone number wrapped in a `tel:` link |
| `{email}` / `{email_link}` | Enquiries email, plain or as a `mailto:` link |
| `{referrals_email}` / `{referrals_email_link}` | Referrals email, plain or linked |
| `{address}` / `{address_html}` | Postal address, one line or two lines |
| `{privacy}` / `{privacy_link}` | “Privacy Policy” as text or as a link |
| `{credit_link}` | Designer credit link |

Tokens are filled from the **Clinic details** tab, so they stay correct when the phone number or address changes.

## 4. What is *not* here

| Not in Theme Settings | Where it lives |
| --- | --- |
| Page headings and body sections | The page itself — Pages → *page* → **1. Page sections** |
| Menus | Appearance → Menus |
| Blog posts and categories | Posts — standard WordPress |
| SEO title, meta description, social preview | Your SEO plugin (Yoast / Rank Math / SEOPress) |
| Redirects, forms, analytics | Their own plugins |

The theme deliberately ships **no SEO fields** — the SEO plugin manages titles and descriptions automatically, so there is nothing to keep in sync.
