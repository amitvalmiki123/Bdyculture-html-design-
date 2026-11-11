# Preservation confirmation (Phase 1 → Phase 2)

The brief's Phase 1 requires a 1:1 conversion and Phase 2 requires the 19 rules to be applied **without
changing the front-end appearance**. This page records the evidence, produced automatically, not by
eye-witness.

Reference: `design-reference/index.html` (+ `css/style.css`, `js/script.js`) — the uploaded package,
kept unmodified in the repo.

---

## 1. Markup fidelity

Rendered `front-page.php` with WordPress stubbed (no ACF saved values → `defaults.php` path) and compared
the DOM with the reference, element by element (tag + class list, in document order).

| Metric | Reference | Theme output |
| --- | --- | --- |
| Elements (tag + classes) | 524 | 524 |
| Text nodes | 281 | 285 |
| Images | 14 | 14 |
| Inline SVG icons | 17 | 17 |
| Sections on the home page | 11 | 11 |
| `<h1>` per template | 1 | 1 |

Every difference is accounted for below. There is **no missing section, no reordered block, no deleted
copy, no merged or split component**.

### Intentional class renames (Rule 5 — strict BEM, no utility classes)

| Reference class | Theme class | Reason |
| --- | --- | --- |
| `.wrap` | `.container` | BEM block for the layout container (also the Customizer token target) |
| `.dark` | `.section--dark` | modifier of the section block, not a standalone utility |
| `.skip` | `.skip-link` | named component |
| `.burger` | `.nav-toggle` | named component |
| `.mbar`, `.mbar__call`, `.mbar__book` | `.mobile-bar`, `.mobile-bar__call`, `.mobile-bar__book` | block name spelled out |
| `.ph` | `.contact__placeholder` | block + element instead of an abbreviation |
| `.crop` | `.img-crop` | BEM element name |
| `.swept` | `.media-frame--swept` | modifier of the media frame block |
| `.u-nowrap` | `.hero__highlight` | utility class replaced by a semantic element class |

CSS was renamed in exactly the same way, so the cascade is unchanged (see §2). The five
`<option>` elements that the reference markup had inside the *“I'm interested in”* select are present
again — they are generated from the ACF repeater.

### Other differences (non-visual)

1. **Arrow glyphs are wrapped** — `Explore Physiotherapy →` becomes
   `Explore Physiotherapy<span aria-hidden="true">→</span>`. Same glyph, same position (after the
   label); the span keeps screen readers from announcing “right arrow”.
2. **`<title>`** is produced by WordPress (`add_theme_support( 'title-tag' )`) instead of a hard-coded
   `<title>` tag.
3. **`aria-hidden="true"`** added to the six decorative stroke icons that the reference left unmarked.
4. **`<body>` classes** are WordPress' own `body_class()` output rather than the reference's single
   `page` class.
5. **Hero background** is the same file (`hero-gym-bright.webp`) injected through the
   `--hero-image` custom property so an ACF image can replace it.
6. **Logo `<img>`** carries `loading="eager" decoding="async" fetchpriority="high"` (Rule 18).
7. Decorative panel photos have `alt=""`; the content photo has the full description from the design
   brief.

---

## 2. CSS cascade equivalence

Splitting one 732-line stylesheet into `main.css` (base rules only, **0 media queries**) and
`responsive.css` (media queries only, 19 blocks) is the riskiest part of Rule 11 — a wrong order silently
changes the design at some widths.

The split was verified by simulating the cascade: every declaration was parsed with its media condition,
and for 16 viewport widths (360, 480, 599, 600, 700, 767, 768, 900, 1024, 1099, 1100, 1200, 1440, 1599,
1600, 1920 px) the **winning declaration for all 1,480 (selector, property) pairs** was computed for the
reference stylesheet and for `main.css` + `responsive.css` together, with the class renames applied to the
reference selectors.

Result: **0 differing declarations**, apart from two harmless notations (`#ececE6` upper-case hex vs
`#ecece6`, and `var(--white)` vs its alias `var(--bg-color)` — identical value). Colours were converted
from `rgba(r,g,b,a)` to `rgb(var(--token-rgb) / a)`, which resolves to the same colour.

Two literal colours were deliberately left un-tokenised because tokenising them would have shifted the
value: `.contact--lime .contact__list dt` (`#3a3a2a`) and `.hero__checks` (`#ecece6`).

Dead rules found in the reference stylesheet (`.rom`, `.facts`, `.footer__wordmark`, `.map-switch`,
`.panel__num`, `.hero__photo`, …) were dropped: **no element in `index.html` uses them**. Nothing that
the reference actually renders lost its styling (`0` rendered classes are without a rule beyond the
bare section hooks `expect`, `faq`, `funding`, which the reference also had).

---

## 3. JavaScript behaviour

`assets/js/main.js` is a port of `js/script.js` with the same behaviours and the same DOM hooks:

| Behaviour | Reference | Theme |
| --- | --- | --- |
| Mobile drawer (aria-expanded, scroll lock, Esc, focus return) | ✓ | ✓ |
| `[data-focus-form]` scroll + focus into the enquiry card | ✓ | ✓ |
| Scroll reveal (`IntersectionObserver` → `.is-in`) | ✓ | ✓ |
| Services tabs (click + ←/→/Home/End, `aria-selected`, `hidden`) | ✓ | ✓ |
| FAQ accordion, one open at a time | ✓ | ✓ |
| Mock form submit → success state | ✓ | ✓ |
| Ribbon track duplication for the infinite loop | ✓ | ✓ |
| Lazy Leaflet map, Street/Satellite switch, marker, `data-fly` chips | ✓ | ✓ |
| Google-embed fallback when Leaflet cannot load | ✓ | ✓ |

Added: `prefers-reduced-motion` short-circuits the reveal and the ticker, all strings that JS needs come
from `wp_localize_script()` (`bdyTheme`), and no jQuery is required.

---

## 4. Runtime checks

* **PHP lint** — 37 PHP files parsed with `TOKEN_PARSE`, 0 failures.
* **Render** — `front-page.php`, `page.php`, `404.php`, `index.php` (search results **and** empty
  archive) were rendered against a WordPress API stub with a strict error handler that turns every
  notice/warning into an exception record: **0 notices, 0 warnings, 0 deprecations**.
* **ACF registration** — 3 groups, **260 fields**, **20 repeaters**, 1 options page, **0 duplicate field
  keys** (the theme refuses to ship until every `field_*` key is globally unique).
* **Customizer** — with no changes it prints **no** `<style>` block; changing the accent colour, body
  font, body size, H1 size, section padding and container width prints exactly one `:root{…}` block with
  those six values and nothing else; a garbage value (`not-a-length`) is rejected by the sanitizer.
* **CSS validity** — `main.css` and `responsive.css` parse with 0 errors (483 + 19 rule blocks, braces
  balanced).
* **Single source of truth** — the front page was rendered a second time with the phone, both emails and both
  address lines swapped in Site Settings: 17 phone labels, 13 `tel:` links, 5/8 email mentions, 6/5 address
  mentions and the JSON-LD all followed the new values, with **0 stale occurrences** of any old value.
* **Accessibility** — one `<h1>` per template, skip link, landmarks (`header`/`nav`/`main`/`footer`),
  `aria-current` on the active nav item, labelled tabs/accordion/map, `alt` on every image, focus-visible
  outlines preserved from the design.

---

## 5. What deliberately did *not* change

* Colours, type scale, spacing scale, container widths, breakpoints (600 / 768 / 1100 / 1600), image
  crops (`--x`, `--y`, `--s`), rotation/skew angles, borders, radii, shadows and hover states.
* Copy: every heading, paragraph, list item, button label, form label, placeholder, footer line and
  address/phone/email string is byte-identical to the reference (verified by text-node diff).
* Section order and section count.
* The 300 ms reveal timing, the marquee speed, the accordion behaviour.

## 6. Known gaps (data, not design)

1. **Opening hours** — the reference has a placeholder; ACF ships the same placeholder until the client
   confirms the real hours.
2. **Inner pages** — the package only contained the homepage. `page.php` reuses the existing design
   language (hero + editor content) and invents nothing. If designs for the inner pages arrive, each one
   becomes a new section set + template, exactly like the home page.
3. **Privacy policy copy** — link only; the page itself is not part of the package.
4. **Form destination** — the fallback form is client-side only. Paste a CF7 shortcode to make it live.
