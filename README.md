# BDYCULTURE — HTML design → custom WordPress theme

The uploaded HTML design (`bdyculture-website.zip`) converted into an installable, ACF-driven WordPress
theme following `Claude Code Updated Instructions.docx` (Phase 1 = 1:1 conversion, Phase 2 = the 19 rules).

```
design-reference/        the uploaded HTML/CSS/JS, untouched (the fidelity reference)
themes/bdyculture-parent/   minimal parent theme — 3 files
themes/bdyculture/          the child theme: everything lives here
docs/                    audit table, ACF reference, install steps, preservation evidence
dist/                    installable zips (upload these in wp-admin)
```

## Install

Upload `dist/bdyculture-parent.zip`, then `dist/bdyculture.zip`, activate the child theme, activate
**ACF PRO** — full steps in [`docs/install.md`](docs/install.md).

## Documentation

| File | What it covers |
| --- | --- |
| [`docs/content-audit.md`](docs/content-audit.md) | Phase-1 content audit: every design element → its ACF field → its PHP fallback |
| [`docs/acf-fields.md`](docs/acf-fields.md) | All 3 field groups, 260 fields, 20 repeaters, tabs, locations, defaults |
| [`docs/install.md`](docs/install.md) | Requirements, installation, first-run checklist, editing guide, theme structure |
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
place**. This build therefore uses ACF Pro, 20 repeaters and one *BDYCULTURE → Theme Settings* options
page. Everything else in the 19 rules is implemented as written, and the deviation is documented in
`docs/install.md`. Every ACF field has a `defaults.php` fallback, so the theme still renders without ACF.

## Where content is edited

| Content | Location |
| --- | --- |
| Header, navigation, mobile bar, footer, phone / emails / address / hours | **BDYCULTURE → Theme Settings** (one options page) |
| Home page sections (copy, images, links, order, show/hide) | Pages → *Home*, one tab per section |
| Inner pages | Pages → *(page)* → *Page hero* tab |
| Colours, fonts, sizes, spacing, container width | Appearance → Customize → **Theme Design** |

Clinic details are a single source: buttons, footer links, contact list, FAQ answers, map card, meta description and
the JSON-LD read them through `{phone}`, `{email}`, `{address}` tokens (full list in `docs/install.md` §5).

## Open items for the client

1. **Clinic hours** — currently the design's placeholder text.
2. **Inner pages** — the package only contained the homepage; `page.php` reuses the existing design
   language (hero + editor content). Send the inner-page designs and each becomes its own section set.
3. **Forms** — paste a Contact Form 7 shortcode into the hero/contact *Form shortcode* field to go live;
   until then the design-identical fallback form is used.
