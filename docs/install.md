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
| Fill the clinic details | **BDYCULTURE → Theme Settings → Clinic details** | phone, emails, address, booking URL, hours |
| Confirm opening hours | same screen | shipped as *“Placeholder — client to confirm clinic hours”* |
| Review navigation | Theme Settings → Header & navigation | nav is ACF-driven (label + link + optional children + icon); WP menus are intentionally not used so the dropdown icons and drawer stay in sync |
| Review footer | Theme Settings → Footer | three columns of links + legal bar |
| Create inner pages | Pages → Add New | Physiotherapy, Exercise Physiology, Occupational Therapy, Clinical Pilates, Referrers, Contact, Practice from BDYCULTURE, Privacy Policy |
| Point the nav links at those pages | Theme Settings → Header & navigation | the design shipped links to pages whose designs weren't included; they are editable URLs |
| Add forms (optional) | Theme Settings / Home → Hero & Contact tabs | paste a CF7 shortcode into the *Form shortcode* field |

Nothing else is required: every section is already populated from `defaults.php` with the approved copy.

---

## 4. Editing content

* **Home page** — Pages → *Home*. The field group is split into tabs, one per section
  (`1. Hero` … `11. Map`). Each tab starts with `Show this section` and `Order`.
* **Global content** (header, drawer, footer, mobile bar, phone/email/address) — **BDYCULTURE → Theme
  Settings**. Edited once, used on every page.
* **Inner pages** — Pages → *(page)* → *Page hero* tab: tag, intro, hero image, image position, plus an
  optional meta description. Everything else is normal editor content.
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

## 5. Theme structure

```
bdyculture-parent/          # 3 files only: style.css, functions.php, index.php
bdyculture/
├── style.css               # child header (Template: bdyculture-parent) + theme meta
├── functions.php           # constants + include manifest only
├── defaults.php            # every string/image from the design as PHP fallbacks
├── inc/
│   ├── setup.php           # add_theme_support, image sizes, editor styles
│   ├── enqueue.php         # fonts, main.css, responsive.css, main.js, localised map data
│   ├── security.php        # generator, XML-RPC, REST user enumeration, headers
│   ├── customizer.php      # Theme Design panel + live preview + inline token CSS
│   ├── schema.php          # MedicalClinic + FAQPage JSON-LD
│   ├── acf/                # builder + 3 field groups + options page
│   └── helpers/            # field, format, icon, image, section helpers
├── template-parts/
│   ├── global/drawer.php
│   └── sections/           # home-hero … home-map + page-hero
├── assets/css/main.css     # base rules only (0 media queries)
├── assets/css/responsive.css  # media queries only
├── assets/js/main.js       # drawer, tabs, FAQ, reveal, map, form state
├── assets/js/customizer-preview.js
└── 404.php, header.php, footer.php, front-page.php, page.php, index.php
```

`docs/acf-fields.md` lists all 260 fields; `docs/content-audit.md` maps every design element to its
field; `docs/preservation.md` records the fidelity checks.

---

## 6. Support notes

* **Field keys** are `field_{name}` and unique across the theme. Do not rename a field in the ACF UI —
  change it in `inc/acf/*.php` so the code and the database stay aligned.
* **Syncing**: groups are registered in PHP (`acf_add_local_field_group`), not as JSON, so a deploy
  never needs a field-group import. ACF's *Sync available* screen will not appear for them.
* **Caching**: bump `THEME_VERSION` in `functions.php` after editing CSS/JS to bust browser caches.
* **Chinese/Arabic/etc. copy** is handled by normal WordPress translation (`bdyculture` text domain);
  all theme strings are wrapped in translation functions.
