# Installation & handover

Two themes are produced: a minimal **parent** (`bdyculture-parent`) and the real **child** theme
(`bdyculture`) that holds all templates, sections, ACF fields, CSS and JS.

---

## 1. Requirements

| Item | Version | Why |
| --- | --- | --- |
| WordPress | 6.4+ | block editor + `wp_body_open()` + `strategy => defer` for scripts |
| PHP | 8.0+ | typed helpers, `str_contains`-style checks, null-safe defaults |
| **Advanced Custom Fields PRO** | 6.2+ | repeaters (service panels, ticks, funding cards, FAQ, nav, footer, map chips) and the options page |
| Contact Form 7 | optional | only if you want a real form instead of the built-in fallback form |
| LocalWP / standard LEMP | — | no page builder, no framework, no build step |

The child theme degrades gracefully: if ACF is not active the site still renders **the complete original
design** from `defaults.php`. Nothing breaks, but nothing is editable either.

> **Documented deviation from the brief's Rule 6.** The workflow document forbids ACF Pro, repeaters and
> options pages. The client explicitly asked for ACF Pro and repeaters, and for global sections to be
> managed from one place — which requires an options page. This build therefore uses ACF Pro, 20
> repeaters and one options page. Everything else in the 19 rules is applied as written.

---

## 2. Install

1. **Appearance → Themes → Add New → Upload Theme** → `bdyculture-parent.zip` → *Install* (activate is
   not needed yet).
2. **Upload Theme** again → `bdyculture.zip` → *Install* → **Activate**.
3. Activate **Advanced Custom Fields PRO** and enter the licence key.
4. If you want a real form, activate **Contact Form 7** (optional).

The parent folder must stay named `bdyculture-parent` — the child declares `Template: bdyculture-parent`
in its `style.css` header.

---

## 3. First-run checklist

| Step | Where | Notes |
| --- | --- | --- |
| Create a page called *Home* | Pages → Add New | leave it empty; the front page is assembled from sections |
| Set the static front page | Settings → Reading → *A static page* → Home | ACF home fields appear once the page is the front page |
| Fill the fields with the design | **BDYCULTURE → Fill with design content** | optional, one click: copies the shipped design copy into Site Settings, the front page and every inner page so nothing has to be retyped. See [`fill-with-design.md`](fill-with-design.md) |
| Fill the clinic details | **BDYCULTURE → Theme Settings → Clinic details** | phone, emails, address, booking URL, hours — field-by-field help in [`theme-settings-guide.md`](theme-settings-guide.md) |
| Confirm opening hours | same screen | shipped as *“Placeholder — client to confirm clinic hours”* |
| Build the menus | **Appearance → Menus** | four locations: *Header — primary navigation*, *Footer — services column*, *Footer — quick links column*, *Footer — legal bar*. Until a menu is assigned the shipped default links are used, so the site looks complete immediately |
| Review footer options | Theme Settings → Footer | logo, tagline, buttons, credit line and disclaimer (the link columns come from the menus) |
| Create inner pages | Pages → Add New | Services, Physiotherapy, Exercise Physiology, Occupational Therapy, Clinical Pilates, Referrers, Contact, Location — Chermside, Practice from BDYCULTURE, Privacy Policy. Use the page slug as the title's permalink (`/physiotherapy/`), so the design's links and the shipped fallbacks line up. Each page fills itself from its own section stack — nothing to paste |
| Create the blog | Pages → Add New → *Posts page* | a page called *Blog*, then Settings → Reading → *Posts page* → Blog. `home.php` lists your posts, `single.php` renders each article |
| Point the nav links at those pages | Appearance → Menus → *Header — primary navigation* | the design shipped links to pages whose designs weren't included; add the pages as menu items and edit their labels there |
| Add the contact form | **Theme Settings → Contact band** | install Contact Form 7, paste the form code from [`cf7-contact-form.txt`](cf7-contact-form.txt) into the form, then paste its shortcode into *Form shortcode*. Do the same for the **Enquiry card** using [`cf7-enquiry-form.txt`](cf7-enquiry-form.txt). Step by step: [`contact-form-7.md`](contact-form-7.md) — or the one-page copy-paste version: [`cf7-paste-forms.md`](cf7-paste-forms.md) |

Nothing else is required: every section is already populated from `defaults.php` with the approved copy.

---

## 4. Where each part is managed

| What you see | Where it is edited | Notes |
| --- | --- | --- |
| Logo, header row (Enquire / Book Online) | Theme Settings → **Header** | phone + booking URL come from Clinic details |
| Primary navigation + Services dropdown | **Appearance → Menus** → *Header — primary navigation* | sub-items become the Services dropdown; one menu drives the desktop nav **and** the mobile drawer |
| Mobile action bar (Call / Book Online) | Theme Settings → **Mobile action bar** | labels editable, numbers/URLs inherited |
| Footer link columns | **Appearance → Menus** → *Footer — services column* / *Footer — quick links column* | the column heading is the menu name; items can be pages, `tel:` or `mailto:` links. The third column is the clinic address block (Clinic details) |
| Footer logo, tagline, buttons, credit, legal bar | Theme Settings → **Footer** | the credit line uses `{credit_link}` for the linked agency name |
| Phone, emails, address, booking URL, hours | Theme Settings → **Clinic details** | see §5 — one change updates the whole site |
| Contact band ("Get in touch") | Theme Settings → **Contact band** | written once, printed on the homepage, every inner page, the blog and posts. Each page keeps its own show/order switch |
| Map band ("Find the clinic") | Theme Settings → **Map band** | same rule as the contact band — one copy, per-page show/order |
| Home page sections | Pages → *Home* → tab per section | show toggle + order per section |
| Inner pages | Pages → *(page)* → **Page sections** tab | a stack of blocks (hero, services, split, features, steps, funding, FAQ, CTA, ways, suburbs, prose, posts) that can be reordered, duplicated or removed. Each block falls back to the approved design copy |
| Inner page closing band + map | page **Contact** block / Home → **12. Map** | the dark contact band and the map are appended to every inner page from one place |
| Enquiry card beside every hero | Theme Settings → **Enquiry card** | one form for the whole site; the Practice page uses its own licence card via the hero's *Card — …* fields |
| Colours, fonts, sizes, spacing, container | Appearance → Customize → **Theme Design** | live preview, only changed values printed |

Navigation is a **normal WordPress menu** (`Appearance → Menus`), so the client uses the screen they already know:
manage pages, drag items, rename labels and add sub-items. The theme renders that menu with the design's own markup,
so the dropdown keeps its icons: each sub-item's icon is matched automatically from the page URL, and an item can be
forced to a specific icon by adding an `icon-*` class (e.g. `icon-heart`) in *Screen Options → CSS Classes*.

The dropdown's small secondary link (Practice from BDYCULTURE) is any sub-item given the class `nav__menu-alt`.
The footer's two link columns are menus too — the column heading is the menu name, so renaming the menu renames the
column. Nothing about the header, drawer or footer links is buried in an options page.

## 5. Single source of truth — clinic details & tokens

The phone number, both email addresses and the address exist **once**, in Theme Settings → *Clinic details*
(`defaults.php` only supplies the shipped fallback). Everything else reads them:

| Token | Renders as | Where it can be used |
| --- | --- | --- |
| `{phone}` | `07 3073 1616` | any text / textarea field, repeater row, button label, footer link label |
| `{phone_link}` | `<a href="tel:…">07 3073 1616</a>` | textarea / repeater fields (auto-downgrades to plain text in a button label) |
| `{phone_tel}` | `0730731616` | `tel` link values in the footer repeater |
| `{email}` / `{email_link}` | `hello@bdyculture.com.au` / as a link | same as above |
| `{referrals_email}` / `{referrals_email_link}` | `referrals@bdyculture.com.au` / as a link | same as above |
| `{address}` | `671 Gympie Road, Suite 5, Level 1, Chermside QLD 4032` | any text field |
| `{address_html}` | the same address with a `<br>` between the two lines | textarea / repeater fields |

The shipped copy already uses these tokens (hero/continuum/home-visit buttons, footer *Visit us* column, contact
list, FAQ intro and answers, expect step, map card, JSON-LD). So:

* change the phone once → 17 visible mentions, 13 `tel:` links and the schema update;
* change an email once → footer, contact section, referral copy and the FAQ answer follow;
* change the address once → footer column, contact list, map card and the "Where is the clinic?" answer follow.

Verified by rendering the front page with a swapped phone/email/address: **0 stale occurrences** of the old values.
Text is only rewritten if it uses a token — free-form prose you type yourself stays exactly as typed.

## 6. Editing content

* **Home page** — Pages → *Home*. The field group is split into tabs, one per section
  (`1. Hero` … `11. Contact band & map (shared)`). Each tab starts with `Show this section` and `Order`.
  Tab 11 holds switches only — the contact and map copy lives in Theme Settings.
  **Filling it by hand?** Follow [`homepage-setup-guide.md`](homepage-setup-guide.md) — it lists every
  field of every tab with the exact content, in the order the fields appear.
* **Global content** (header, drawer, footer, mobile bar, phone/email/address) — **BDYCULTURE → Theme
  Settings**. Edited once, used on every page.
* **Inner pages** — Pages → *(page)* → **1. Page sections**. The page is a list of blocks; open a block to edit
  its tag, heading, copy, buttons, media, panel, checklist or question rows. Blocks can be dragged into a new
  order, duplicated or removed, and *Add section* offers every design section. Tab **2. Shared bands** holds the
  show/order switches for the contact and map bands, whose copy is written once in Theme Settings; tab
  **3. Fallback hero** is only used by a page with no blocks and no shipped design. A page with no blocks at all
  renders the block set shipped for its slug in `defaults-pages.php`, so the site is never blank. Full walkthrough:
  [`inner-pages-guide.md`](inner-pages-guide.md).
* **Blog** — the posts page lists your published articles (`home.php`); each article renders through
  `single.php` with meta (date, reading time, category), sidebar cards and the article CTA. Publish a post and
  it appears in the grid automatically — the shipped articles are the fallback used until then.
* **Design tokens** — Appearance → Customize → **Theme Design**: Colours, Typography, Spacing,
  Container. Live preview updates without a page reload; only changed values are printed.
* **Images** — every image is an ACF image field (return format: *Image Array*). Alt text is taken from
  the media library; if it is empty the theme falls back to the field's own alt text and then to the
  section title, so no `<img>` is ever shipped without an alt attribute.

### Section order

Order values ship as `10, 20, 30 … 110`. Change a number to move a section; the engine collects the
sections that are switched on, sorts by order, then renders each with `get_template_part()`.

### Forms

The hero and contact cards render one of two things:

1. the Contact Form 7 shortcode typed into the ACF *Form shortcode* field, or
2. a design-identical native form (no plugin) that shows the success state on submit.

CF7 output is styled by `.card-form__embed` in `main.css`, so standard CF7 markup drops into the card.

---

## 7. Theme structure

```
bdyculture-parent/          # 3 files only: style.css, functions.php, index.php
bdyculture/
├── style.css               # child header (Template: bdyculture-parent) + theme meta
├── functions.php           # constants + include manifest only
├── defaults.php            # every string/image from the design as PHP fallbacks
├── defaults-pages.php      # the same, per inner-page block stack
├── inc/
│   ├── setup.php           # add_theme_support, image sizes, editor styles
│   ├── enqueue.php         # fonts, main.css, responsive.css, main.js, localised map data
│   ├── security.php        # generator, XML-RPC, REST user enumeration, headers
│   ├── customizer.php      # Theme Design panel + live preview + inline token CSS
│   ├── schema.php          # MedicalClinic + FAQPage + BreadcrumbList JSON-LD
│   ├── acf/                # builder + 3 field groups + options page
│   └── helpers/            # field, format, icon, image, section, block, post helpers
├── template-parts/
│   ├── global/             # drawer, enquiry card
│   ├── blocks/             # one renderer per inner-page block
│   └── sections/           # home-hero … home-map
├── assets/css/main.css     # base rules only (0 media queries)
├── assets/css/responsive.css  # media queries only
├── assets/js/main.js       # drawer, tabs, FAQ, reveal, map, form state
├── assets/js/customizer-preview.js
└── 404.php, header.php, footer.php, front-page.php, page.php, single.php,
    home.php, index.php
```

`docs/acf-fields.md` lists every field; `docs/content-audit.md` maps every design element to its
field; `docs/preservation.md` records the fidelity checks.

---

## 8. Support notes

* **Field keys** are `field_{name}` and unique across the theme. Do not rename a field in the ACF UI —
  change it in `inc/acf/*.php` so the code and the database stay aligned.
* **Syncing**: groups are registered in PHP (`acf_add_local_field_group`), not as JSON, so a deploy
  never needs a field-group import. ACF's *Sync available* screen will not appear for them.
* **Caching**: bump `THEME_VERSION` in `functions.php` after editing CSS/JS to bust browser caches.
* **Chinese/Arabic/etc. copy** is handled by normal WordPress translation (`bdyculture` text domain);
  all theme strings are wrapped in translation functions.
