# Site Settings — setup guide, tab by tab

**Where:** WordPress admin → **BDYCULTURE → Theme Settings**.

Everything on this screen is written **once** and used by every page: the phone number, the address, the header buttons, the two closing bands (contact + map) and the footer. Pages never hold a second copy — they only decide whether a band shows and where it sits.

**Golden rule:** leave a field empty and the theme falls back to the approved design copy. Nothing here can break a page, and every change is live the moment you press **Update**.

---

## Before you start

Have these ready — you will be asked for them in the first three tabs:

| What | Used by |
| --- | --- |
| Phone number (how it reads **and** how it dials) | Header, footer, contact band, mobile bar, every `{phone}` |
| Enquiries email + referrals email | Contact form *To* address, footer, contact band |
| Street address + suburb/state/postcode | Footer address column, map card, contact band |
| Nookal booking link | Every *Book Online* button and the enquiry card alt line |
| Opening hours (one line) | Contact band *Opening hours* row, `{hours}` |
| Two logos — dark for the header, white for the footer | Header, footer |
| Contact Form 7 installed and two forms created | Contact band + enquiry card (optional but recommended) |

---

## Order of work (about 25 minutes)

| # | Tab | Time | What you do | Why in this order |
| --- | --- | --- | --- | --- |
| 1 | Clinic details | 5 min | Phone ×2, both emails, address ×2, Nookal link, hours, tagline, both logos. | Every other tab and every `{token}` reads from here, so getting it right first means no copy-pasting numbers later. |
| 2 | Header & navigation | 1 min | Three button labels; assign the header menu in Appearance → Menus. | The labels appear on every page, so they come before page work. |
| 3 | Contact Form 7 (plugin) | 5 min | Create the two forms from `docs/cf7-contact-form.txt` and `docs/cf7-enquiry-form.txt`, then copy their shortcodes. | Both bands need a shortcode; without one the forms are display-only. |
| 4 | Contact band | 3 min | Tag, heading, intro, detail rows, button, form shortcode, note. | The band shows on every page — one copy here instead of per page. |
| 5 | Enquiry card | 2 min | Tag, heading, form shortcode, note, alt line. | The card appears beside every inner-page hero. |
| 6 | Map band | 3 min | Coordinates, zoom, card text, suburb chips, two buttons. | Copy the coordinates once from Google Maps — do not guess them. |
| 7 | Footer | 3 min | Logo, tagline, button, bottom bar, credit, disclaimer; assign the two footer menus. | The footer closes every page and carries the legal lines. |
| 8 | Mobile action bar | 1 min | Two short labels. | Shown on phones only, but on every page of them. |

Nothing is mandatory except Clinic details — a fresh install already shows the full approved design copy.

---

## Tabs at a glance

| # | Tab | Controls | Appears on |
| --- | --- | --- | --- |
| 1 | Clinic details | The single source of truth for the practice. Every phone number, email, address, booking link and hours printed anywhere on the site is read from here. | Header · Footer · Contact band · Map card · Enquiry card · every `{phone}`, `{email}`, `{address}` and `{hours}` token in body copy |
| 2 | Header & navigation | Button labels only. The menu itself is a normal WordPress menu, not a field. | Sticky header · Mobile drawer |
| 3 | Enquiry card | The dark card beside every inner-page hero. The form inside it is a Contact Form 7 form, so only the shortcode, the tag, the heading and the lines around it are stored here. | Services, Physiotherapy, Exercise Physiology, Occupational Therapy, Clinical Pilates, Referrers, Contact, Location, Practice and Privacy Policy heroes |
| 4 | Contact band | The dark "Get in touch" band printed at the end of the homepage, every inner page, the blog index and single posts. Written once here; each page only decides whether it shows and where. | Homepage · All inner pages · Blog index · Single post |
| 5 | Map band | The "Find the clinic" band with the Leaflet map, suburb chips and address card. Same rule as the contact band: one copy, shown everywhere unless a page switches it off. | Homepage · All inner pages · Blog index · Single post |
| 6 | Footer | Tagline, button, bottom bar and credit. The three link columns are WordPress menus and the address column is built from Clinic details. | Site footer · Mobile action bar |
| 7 | Mobile action bar | The two sticky buttons pinned to the bottom of the screen on phones and small tablets. | Below 1100 px wide only |

---

## Tab by tab

The **Default** column is what the theme ships with — leave the field alone and that is what the site shows.

### 1. Clinic details

The single source of truth for the practice. Every phone number, email, address, booking link and hours printed anywhere on the site is read from here.

**Shows on:** Header · Footer · Contact band · Map card · Enquiry card · every `{phone}`, `{email}`, `{address}` and `{hours}` token in body copy

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| Phone (display) | text | How the number reads on the page: `07 3073 1616`. Spaces are fine. | 07 3073 1616 |
| Phone (tel: link) | text | Same number, digits only: `0730731616`. No spaces, no `+61` — this is the `tel:` target for every Call button. | 0730731616 |
| General enquiries email | email | The mailbox that receives website enquiries. Use one somebody monitors. | hello@bdyculture.com.au |
| Referrals email | email | Where GP/allied-health referrals go. Printed on Referrers and wherever `{referrals_email}` is typed. | referrals@bdyculture.com.au |
| Address line 1 | text | Street, suite and level only: `671 Gympie Road, Suite 5, Level 1`. | 671 Gympie Road, Suite 5, Level 1 |
| Address line 2 | text | Suburb, state and postcode: `Chermside QLD 4032`. | Chermside QLD 4032 |
| Online booking URL (Nookal) | url | Paste the full Nookal booking link (starts with `https://`). Every Book Online button uses it. | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-F… |
| Directions URL | url | Google Maps link for the clinic. The `?api=1&query=…` form opens the native app on phones. | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road… |
| Opening hours | text | One short line, e.g. `Mon–Fri 7am–7pm · Sat 7am–1pm`. Prints wherever you type `{hours}` — the contact band ships with it already. | Placeholder — client to confirm clinic hours |
| Clinic tagline | text (multi-line) | One sentence under the logo. Also becomes the footer tagline if that field is empty. | Allied health and rehabilitation in Chermside, Brisbane. |
| Header logo (dark) | image | Dark logo on a transparent background, at least 240 px tall — it sits on the white header. | — |
| Footer logo (light) | image | White/inverse logo for the dark footer. Used when *Footer logo* is empty. | — |

**Watch out**

- **Phone — fill both fields.** The display one is what people read; the `tel:` one is what their phone dials. If the display number changes, change the digits too.
- **Booking URL must be the full Nookal link** (`https://book.nookal.com/…`). It powers every *Book Online* button, the header button, the footer button and the phone action bar.
- **Address — line 1 is street/suite/level, line 2 is suburb/state/postcode.** Suburb and postcode on line 2 keeps the footer and map card stacking correctly.
- **Logos:** PNG or SVG with a transparent background, at least 240 px tall. Upload the **dark** logo for the white header and the **white/inverse** one for the dark footer.
- Opening hours is one short line — anything longer wraps badly in the contact band.

### 2. Header & navigation

Button labels only. The menu itself is a normal WordPress menu, not a field.

**Shows on:** Sticky header · Mobile drawer

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| "Enquire" button label | text | Label of the header button that jumps to the enquiry card. 1–2 words. | Enquire |
| "Book Online" button label | text | Label of the gold button. Keep "Book Online" unless the client asks otherwise. | Book Online |
| Mobile drawer enquiry label | text | Longer label used inside the phone menu, where there is room. | Send an enquiry |

**Watch out**

- These three fields are **labels**, not links — the links come from Appearance → Menus.
- Keep the labels to 1–2 words; the header button has a fixed width on tablets.
- The drawer label can be longer because it sits on its own line in the phone menu.

### 3. Enquiry card

The dark card beside every inner-page hero. The form inside it is a Contact Form 7 form, so only the shortcode, the tag, the heading and the lines around it are stored here.

**Shows on:** Services, Physiotherapy, Exercise Physiology, Occupational Therapy, Clinical Pilates, Referrers, Contact, Location, Practice and Privacy Policy heroes

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| Tag | text | Small label above the card heading: `Enquire online`. Clear it to hide the label. | Enquire online |
| Heading | text | The card heading. A question reads best: "Request an appointment or ask a question". | Request an appointment or ask a question |
| Form shortcode | text | Paste `[contact-form-7 id="88" title="Enquiry card"]` (or whichever id the plugin shows). Empty = the built-in design form, which stores nothing. | (empty) |
| Alt action — text | text | Sentence before the booking link: "Prefer to book yourself?". Clear it to hide the whole line. | Prefer to book yourself? |
| Alt action — link label | text | The clickable part of that line. It always points at the booking URL in Clinic details. | Book Online with Nookal |
| Line under the form | text (multi-line) | Small print under the fields. `{privacy_link}` prints a linked Privacy Policy. Keep it — this is the consent line. | By submitting this form, you acknowledge the BDYCULTURE {privac… |

**Watch out**

- **Paste the shortcode or the card collects nothing.** An empty shortcode shows the design’s own form for looks only — no entry is stored or emailed.
- Labels, inputs, the service dropdown, the button and the success message are **not** in this tab on purpose: edit them in Contact → *Enquiry card* → Form tab.
- A hero section can carry its own card (per-page *Card — …* rows). The Practice page does this for its licence form, and that card ignores this tab.

### 4. Contact band

The dark "Get in touch" band printed at the end of the homepage, every inner page, the blog index and single posts. Written once here; each page only decides whether it shows and where.

**Shows on:** Homepage · All inner pages · Blog index · Single post

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| Tag | text | Small label above the heading: `Get in touch`. Clear it to hide the label. | Get in touch |
| Heading (H2) | text (multi-line) | Big band heading. Line breaks are kept, so press Enter where it should stack. | Let’s get you moving. |
| Intro | text (multi-line) | One to three sentences under the heading. `{phone}`, `{email}` and `{address}` tokens work here. | Book online in minutes, call the clinic, or send us a message a… |
| Contact details | repeater (rows) | Rows of label + value shown left of the form. Drag to reorder, add a row for a new detail. | 4 row(s) |
| ↳ Label | text | Bold left column: `Visit us`, `General enquiries`, `Referrals`, `Opening hours`. | Visit us |
| ↳ Value | text | Right column. Prefer `{address_html}`, `{phone_link}`, `{email_link}`, `{hours}` so it stays in sync with Clinic details. | {address_html} |
| ↳ Placeholder | on/off | On while the value is still TBC — prints in a muted style. Turn it off once the real value is in. | No |
| Button text | text | Gold button under the details: `Book Online with Nookal`. | Book Online with Nookal |
| Button link | text | Paste the booking link, or a `tel:` link if the button should call instead. Empty = booking URL from Clinic details. | https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-F… |
| Button icon | dropdown | Glyph printed after the button text: arrow, phone or calendar. Empty = no icon. | arrow |
| Form shortcode | text | Paste `[contact-form-7 id="87" title="Contact band"]`. Empty = the built-in design form, which stores nothing. | (empty) |
| Form heading (H3) | text | H3 above the fields, e.g. `Send us a message`. Keep it to a few words. | Send us a message |
| Line under the form | text (multi-line) | Privacy line under the submit button. `{privacy_link}` supported; simple links are allowed. | By submitting this form, you acknowledge the BDYCULTURE <a href… |

**Watch out**

- **Contact details rows** are the four lines left of the form. Drag to reorder, delete a row, or add one. Keep the labels short ("Visit us", "Call", "Open").
- Use tokens in the value (`{address_html}`, `{phone_link}`, `{email_link}`, `{hours}`) so the band updates itself when Clinic details change.
- Turn **Placeholder** on for a value you do not have yet — it prints in a muted "TBC" style instead of looking like final copy. Turn it off once the real value is in.
- The **button link** is optional: empty means the booking URL from Clinic details.
- The **form** is Contact Form 7. Empty shortcode = design form for looks only, no entries.
- **Hide it on one page only:** open the page → *2. Shared bands* → Show this section = No. The copy here is untouched.

### 5. Map band

The "Find the clinic" band with the Leaflet map, suburb chips and address card. Same rule as the contact band: one copy, shown everywhere unless a page switches it off.

**Shows on:** Homepage · All inner pages · Blog index · Single post

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| Tag | text | Label above the heading: `Find the clinic`. Clear it to hide the label. | Find the clinic |
| Heading (H2) | text | Band heading, e.g. `On Gympie Road, Chermside.` | On Gympie Road, Chermside. |
| Latitude | text | Latitude of the clinic, e.g. `-27.3852`. Right-click the pin in Google Maps to copy both numbers. | -27.3852 |
| Longitude | text | Longitude of the clinic, e.g. `153.0306`. | 153.0306 |
| Zoom | number | Number only, 10–18. 16 = street level, 14 = suburb level. | 16 |
| "Load map" button label | text | Text on the button that starts the map. The map loads on click to keep the page fast. | Load interactive map |
| Map card heading (H3) | text | Name on the white card over the map — usually the clinic name. | BDYCULTURE |
| Map card address | text (multi-line) | Two lines: what the place is, then the address. Keep `{address_html}` so the address follows Clinic details. | Rehab &amp; Performance Clinic<br>{address_html} |
| "Around the clinic" label | text | Lead-in before the suburb chips: `Around the clinic:`. | Around the clinic: |
| Nearby suburbs | repeater (rows) | One row per nearby suburb. Clicking a chip pans the map; it does not navigate. | 7 row(s) |
| ↳ Suburb | text | Chip text: `Chermside`, `Aspley`, `Wavell Heights` … | Chermside |
| ↳ Latitude | text | That suburb’s centre latitude. Rough is fine. | -27.3852 |
| ↳ Longitude | text | That suburb’s centre longitude. | 153.0306 |
| ↳ Zoom | text | Optional per chip (10–18). Empty = band zoom. | 16 |
| Button 1 — text | text | Primary button on the card: `Get directions`. | Get directions |
| Button 1 — link | text | Google Maps directions link for the clinic. | https://www.google.com/maps/search/?api=1&query=671+Gympie+Road… |
| Button 2 — text | text | Secondary button: `Call`. | Call |
| Button 2 — link | text | Where it goes — `tel:0730731616` or `{phone_link}` keeps it working on phones. | tel |

**Watch out**

- **Coordinates:** open Google Maps, right-click the clinic pin and click the `-27.…, 153.…` line — it copies both numbers. Latitude first, then longitude.
- **Zoom:** 16 is street level, 14 is suburb level. Keep it between 10 and 18.
- The map loads **after a click** (a privacy- and speed-friendly placeholder). The button label is what the visitor presses.
- **Suburb chips** pan the map; they do not open another page. Rough coordinates are fine. Leave a chip’s Zoom empty to reuse the band zoom.
- The card text accepts `{address_html}` — leave it in place so the address stays in sync.
- Button 2 is usually *Call* with `{phone_link}` or `tel:0730731616`.

### 6. Footer

Tagline, button, bottom bar and credit. The three link columns are WordPress menus and the address column is built from Clinic details.

**Shows on:** Site footer · Mobile action bar

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| Footer logo | image | White/inverse logo for the dark footer. Empty falls back to *Footer logo (light)*, then to the bundled file. | — |
| Footer tagline | text (multi-line) | One or two lines under the logo. Empty falls back to the Clinic tagline. | Allied health and rehabilitation in Chermside, Brisbane. |
| Footer button label | text | Label of the footer button. Empty falls back to the header "Book Online" label. | — |
| Footer button link | text | Where the footer button goes — usually the booking URL. Empty = booking URL from Clinic details. | — |
| Copyright line | text | Left side of the bottom bar, e.g. `© 2026 BDYCULTURE. All rights reserved.` The year is plain text — update it each January. | © 2026 BDYCULTURE. All rights reserved. |
| Privacy link label | text | Label of the Privacy Policy link in the bottom bar: `Privacy Policy`. | Privacy Policy |
| Privacy link URL | text | The Privacy Policy page — `/privacy-policy/` or the full URL. | /privacy-policy/ |
| Credit line | text | Credit sentence. Keep `{credit_link}` where the linked agency name should appear. | Web Design by {credit_link} |
| Credit — agency name | text | Agency name that fills `{credit_link}`: `Digital Movement`. | Digital Movement |
| Credit — link URL | url | Agency website: `https://www.digitalmovement.com.au/`. | https://www.digitalmovement.com.au/ |
| Footer disclaimer | text (multi-line) | Disclaimer paragraph under the credit line. Edit the wording only with the client’s approval. | Information on this website is general in nature and is not a s… |

**Watch out**

- **Footer logo** — white/inverse version. Empty falls back to *Footer logo (light)* in Clinic details, then to the bundled logo file.
- **Footer tagline** — empty falls back to the Clinic tagline.
- **Button label / link** — empty link means the booking URL. Empty label falls back to the header "Book Online" label.
- **Link columns** live in Appearance → Menus: assign a menu to *Footer — services column* and *Footer — quick links column*. The menu name becomes the column heading, and items can be pages, `tel:` or `mailto:` links.
- **Credit line** — keep `{credit_link}` where the linked agency name should appear; the two credit fields below it fill that link in.
- The **disclaimer** is the health information notice. Do not delete it without the client’s approval.

### 7. Mobile action bar

The two sticky buttons pinned to the bottom of the screen on phones and small tablets.

**Shows on:** Below 1100 px wide only

| Field | Type | How to fill it | Default |
| --- | --- | --- | --- |
| Call button label | text | Label on the phone button: `Call`. One word fits best. | Call |
| Book button label | text | Label on the booking button: `Book Online`. | Book Online |

**Watch out**

- Targets come from Clinic details — these are labels only.
- Keep each label to one short word: the two buttons share a narrow bar.
- The bar hides itself automatically if the phone number and booking URL are both empty.

---

## Tokens you can type into any text field

| Token | Prints |
| --- | --- |
| `{phone}` | Phone number as text — `07 3073 1616` |
| `{phone_link}` | Phone number as a tap-to-call link |
| `{phone_tel}` | Digits only, for `href="tel:…"` |
| `{email}` / `{email_link}` | Enquiries email, plain or as a `mailto:` link |
| `{referrals_email}` / `{referrals_email_link}` | Referrals email, plain or linked |
| `{address}` / `{address_html}` | Postal address, one line or two lines |
| `{hours}` | Opening hours from Clinic details |
| `{privacy}` / `{privacy_link}` | “Privacy Policy” as text or as a link |
| `{credit_link}` | Designer credit link |

Tokens are filled from the **Clinic details** tab, so they stay correct when the phone number or address changes. Type them exactly, curly braces included.

---

## The two forms

Both website forms are **Contact Form 7** forms. The theme stores only the shortcode; the labels, fields, dropdown options, button and success message live in the plugin.

| Form | Theme settings field | Paste-ready code |
| --- | --- | --- |
| Contact band | Contact band → **Form shortcode** | [`cf7-contact-form.txt`](cf7-contact-form.txt) |
| Enquiry card | Enquiry card → **Form shortcode** | [`cf7-enquiry-form.txt`](cf7-enquiry-form.txt) |

**One form covers every page.** The theme adds the page name to the email and pre-selects a dropdown option that matches the page, so you never build a form per page. Details: [`cf7-paste-forms.md`](cf7-paste-forms.md).

Copy-paste page with both codes and their Mail/Messages values: [`cf7-paste-forms.md`](cf7-paste-forms.md). Full walkthrough (spam, troubleshooting): [`contact-form-7.md`](contact-form-7.md).

---

## After saving — 2 minute check

1. Open the **homepage** and one **inner page** in a private window (so you are not looking at a logged-in, uncached view).
2. Check the phone number in the header, the footer, the contact band and the mobile bar — they must all be the same.
3. Click *Book Online* once: it should open the Nookal page in a new tab.
4. Send one test enquiry through **each** form and confirm the email arrives at the address in Clinic details.
5. On a phone (or a narrow window) confirm the bottom action bar shows Call + Book.
6. Open **Theme Settings → Contact band / Map band** and hide the band on one page to see the per-page switch work, then switch it back.

---

## What is *not* here

| Not in Theme Settings | Where it lives |
| --- | --- |
| Page headings and body sections | The page itself — Pages → *page* → **1. Page sections** |
| Per-page band show/order | The page — Pages → *page* → **2. Shared bands** |
| Menus (header, footer columns) | Appearance → Menus |
| Footer link columns | Appearance → Menus → *Footer — services column* / *Footer — quick links column* |
| Blog posts and categories | Posts — standard WordPress |
| SEO title, meta description, social preview | Your SEO plugin (Yoast / Rank Math / SEOPress) |
| Form labels and fields | Contact Form 7 → the form |
| Redirects, analytics | Their own plugins |

The theme deliberately ships **no SEO fields** — the SEO plugin manages titles and descriptions automatically, so there is nothing to keep in sync.
