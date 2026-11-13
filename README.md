# BDYCULTURE — HTML design → custom WordPress theme

The uploaded HTML design (`bdyculture-website.zip`) converted into an installable, ACF-driven WordPress
theme following `Claude Code Updated Instructions.docx` (Phase 1 = 1:1 conversion, Phase 2 = the 19 rules).

```
design-reference/        the uploaded HTML/CSS/JS, untouched (the fidelity reference)
themes/bdyculture-parent/   minimal parent theme — 3 files
themes/bdyculture/          the child theme: everything lives here
docs/                    audit table, ACF reference, homepage fill guide, install steps, preservation evidence
dist/                    installable zips (upload these in wp-admin)
```

## Install

Upload `dist/bdyculture-parent.zip`, then `dist/bdyculture.zip`, activate the child theme, activate
**ACF PRO** — full steps in [`docs/install.md`](docs/install.md).

## Documentation

| File | What it covers |
| --- | --- |
| [`docs/content-audit.md`](docs/content-audit.md) | Phase-1 content audit: every design element → its ACF field → its PHP fallback |
| [`docs/acf-fields.md`](docs/acf-fields.md) | All 3 field groups, 226 fields, 16 repeaters, tabs, locations, defaults |
| [`docs/theme-settings-guide.md`](docs/theme-settings-guide.md) | Everything that repeats — phone, address, header, footer and the two shared bands — edited once in BDYCULTURE → Theme Settings |
| [`docs/inner-pages-guide.md`](docs/inner-pages-guide.md) | How each inner page is built from blocks: ordering, show/hide, the shared bands, images, adding a page |
| [`docs/contact-form-7.md`](docs/contact-form-7.md) | Connecting the "Get in touch" form to Contact Form 7 — ready-made form code in [`docs/cf7-contact-form.txt`](docs/cf7-contact-form.txt) |
| [`docs/install.md`](docs/install.md) | Requirements, installation, first-run checklist, editing guide, theme structure |
| [`docs/homepage-setup-guide.md`](docs/homepage-setup-guide.md) | Field-by-field walkthrough for filling the Home page by hand — every tab, every field, the exact copy |
| [`docs/preservation.md`](docs/preservation.md) | Proof the design did not change: DOM parity, CSS-cascade equivalence, runtime checks |

## What is where

| Concern | File |
| --- | --- |
| Child theme header (`Template: bdyculture-parent`) | `themes/bdyculture/style.css` |
| Constants + include manifest | `themes/bdyculture/functions.php` |
| All original copy/images as PHP fallbacks | `themes/bdyculture/defaults.php` |
| ACF groups (registered in code, no import needed) | `themes/bdyculture/inc/acf/` |
| Section engine (show / order / `get_template_part()`) | `themes/bdyculture/inc/helpers/section-helpers.php` |
| Sections | `themes/bdyculture/template-parts/sections/` |
| Base CSS (0 media queries) / media queries only | `themes/bdyculture/assets/css/main.css`, `responsive.css` |
| Design tokens, Customizer, live preview | `themes/bdyculture/inc/customizer.php` |
| Security hardening | `themes/bdyculture/inc/security.php` |

## Deviations from the written rules (requested by the client)

The workflow document forbids ACF Pro, repeaters and options pages. The brief from the client explicitly
asked for **ACF Pro**, **repeater fields wherever content repeats**, and **global sections managed in one
place**. This build therefore uses ACF Pro, 15 repeaters and one *BDYCULTURE → Theme Settings* options
page. Navigation is the exception: the header dropdown, the mobile drawer and the footer link columns are
native WordPress menus (*Appearance → Menus*), because that is the screen the client already knows.
Everything else in the 19 rules is implemented as written, and the deviation is documented in
`docs/install.md`. Every ACF field has a `defaults.php` fallback, so the theme still renders without ACF.

## Where content is edited

| Content | Location |
| --- | --- |
| Header buttons, footer options, mobile bar, phone / emails / address / hours | **BDYCULTURE → Theme Settings** (one options page) |
| Header navigation, footer link columns | **Appearance → Menus** (four locations; shipped defaults show until a menu is assigned) |
| Home page sections (copy, images, links, order, show/hide) | Pages → *Home*, one tab per section |
| Inner page sections (copy, images, links, order, show/hide) | Pages → *(page)* → **1. Page sections** tab (a block stack — drag to reorder, remove to hide; see [`docs/inner-pages-guide.md`](docs/inner-pages-guide.md)) |
| Enquiry card beside every hero | Theme Settings → **Enquiry card** |
| Contact band + map band (the two closing bands) | Theme Settings → **Contact band** / **Map band** — written once, per-page show/order on the page itself |
| Blog posts | Posts — standard WordPress; the posts page lists them, each article uses `single.php` |
| Colours, fonts, sizes, spacing, container width | Appearance → Customize → **Theme Design** |

Clinic details are a single source: buttons, footer links, contact list, FAQ answers, map card and the JSON-LD read
them through `{phone}`, `{email}`, `{address}` tokens (full list in `docs/install.md` §5). Titles and meta descriptions
are left to the SEO plugin — the theme ships no SEO fields.

## Open items for the client

1. **Clinic hours** — currently the design's placeholder text.
2. **Inner pages** — built 1:1 from the v2 upload as a per-page block stack (`page.php`, `home.php`,
   `single.php` + `defaults-pages.php`): Services, the four service pages, Referrers, Contact,
   Location — Chermside, Practice from BDYCULTURE, Privacy Policy, the blog index and the article template.
   Every page reuses the shared contact band, map, enquiry card and footer, so those are edited once.
3. **Forms** — paste a Contact Form 7 shortcode into the Contact section's *Form shortcode* field to go live;
   until then the design-identical fallback form is used.
