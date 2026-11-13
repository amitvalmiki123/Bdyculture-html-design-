# Inner pages — how they are built and how to edit them

Every inner page is a **stack of blocks**. The design ships with a stack for each of the eleven
pages, so the site looks finished before you touch anything; editing means adding, removing or
reordering blocks on that page.

**Where:** WordPress admin → **Pages** → pick a page → the three tabs under the title:

| Tab | What it is for |
| --- | --- |
| **1. Page sections** | The page's own content. One block per band, top to bottom. |
| **2. Shared bands (contact & map)** | On/off + order for the two bands whose copy lives in Theme Settings. |

There are no SEO fields in the page group — the SEO plugin manages titles and descriptions.

> **Fields look empty on a fresh install?** That is the fallback design, not missing content: the page renders
> from `defaults-pages.php` while the blocks stay blank. A notice at the top of the page says so — press
> **Fill with design content** to copy that copy into the blocks. See
> [`fill-with-design.md`](fill-with-design.md).

---

## 1. The eleven shipped pages

The design is matched to the page **slug**, so a page must use the slug in the first column for its
stack to load automatically.

| Page | Slug | Shipped stack (top → bottom) |
| --- | --- | --- |
| Services | `services` | hero, services, split, funding, split, FAQ |
| Physiotherapy | `physiotherapy` | hero, split, features, steps, funding, split, FAQ, CTA |
| Exercise Physiology | `exercise-physiology` | hero, split, features, steps, funding, split, FAQ, CTA |
| Occupational Therapy | `occupational-therapy` | hero, split, features, steps, funding, split, FAQ, CTA |
| Clinical Pilates | `clinical-pilates` | hero, split, features, steps, funding, split, FAQ, CTA |
| Referrers | `referrers` | hero, split, split, steps, split, funding, FAQ |
| Contact | `contact` | hero, ways, split |
| Location — Chermside | `location-chermside` | hero, split, service cards, split, suburbs, funding, FAQ |
| Practice from BDYCULTURE | `practice-from-bdyculture` | hero, features, split, features, features, steps, FAQ, CTA |
| Privacy Policy | `privacy-policy` | hero, prose |
| Blog | `blog` (set as *Posts page*) | hero, featured post, post grid, split, FAQ |

Every one of them then closes with the **contact band** and the **map band** — but those two come
from Theme Settings (§4), not from this tab.

---

## 2. The block types

*Add section* at the bottom of tab 1 opens this list. Each block is self-contained: it holds only
its own copy, never the header, footer or bands.

| Block | Use it for |
| --- | --- |
| **Hero — inner page** | Breadcrumbs, H1, lead paragraph, 1–3 buttons, optional checklist. One per page. |
| **Service grid** | The four discipline cards (icon, title, text, link). Used on /services/. |
| **Service cards (compact)** | A tighter list of links — used on /location-chermside/. |
| **Feature grid** | Small icon + title + text trios. Used for "who we help" / "what we do" bands. |
| **Split** | Image one side, copy the other. Toggle *Reverse* to flip the sides. The workhorse block. |
| **Steps** | Numbered how-it-works list with a dark or light treatment. |
| **Funding** | The funding-pathway list (Private, Medicare, WorkCover, CTP, NDIS, DVA…). |
| **FAQ** | Accordion items plus an optional "ask a question" button. |
| **CTA band** | Dark closing band with heading, text and buttons — for pages that need a second call to action before the contact band. |
| **Ways to book** | Icon + title + text + link cards (phone, online, refer). Used on /contact/. |
| **Suburbs** | The "we also serve…" suburb chips. |
| **Prose** | Long-form legal/content text (Privacy Policy). |
| **Featured post** | One pulled-out article with image and meta. |
| **Post grid** | Filter chips + article cards. |

All text blocks accept the tokens from
[`theme-settings-guide.md`](theme-settings-guide.md#tokens-you-can-type-into-any-text-field)
(`{phone_link}`, `{address_html}`, …), so phone numbers and addresses never go stale.

---

## 3. Order, show and hide

The stack **is** the order. There is nothing to number:

| To… | Do this |
| --- | --- |
| Change order | Drag the block header up or down. The page follows the list. |
| Hide a section | Click the block header → *Remove*. It is deleted from this page only; the shipped design is untouched, and you can add the block back. |
| Show a section again | *Add section* → pick the same block type → fill it in (or copy the copy back from this guide's page). |
| Duplicate a section | Block header → *Duplicate*. |
| Collapse everything | Block header → *Collapse all*. |

**A page with no blocks** falls back to the shipped design for its slug. If the slug matches nothing
shipped (a brand-new page), it uses tab 3: H1 = page title, optional lead image/intro, then the
normal editor content.

---

## 4. The two shared bands (contact + map)

The dark **"Get in touch"** band and the **"Find the clinic"** map band are written **once** in
Theme Settings and printed on every page. On each page you control only two things, in tab
**2. Shared bands (contact & map)**:

| Field | Name | Default | Meaning |
| --- | --- | --- | --- |
| Show this section | `page_contact_show` | On | Print the contact band on this page. |
| Order | `page_contact_order` | `900` | Position in the stack. Lower = earlier. |
| Show this section | `page_map_show` | On | Print the map band on this page. |
| Order | `page_map_order` | `910` | Position in the stack (map ships after contact). |

Both bands render **after** the page's blocks, so `900`/`910` only decide which of the two comes
first. Switch one off on, say, /privacy-policy/ and it disappears there only — the copy stays in
Theme Settings.

To change the words, the form or the map coordinates, go to **BDYCULTURE → Theme Settings →
Contact band / Map band**. One edit, every page.

The contact form itself is a **Contact Form 7** form: the theme stores only its heading, the line
under it and the shortcode. Ready-made form code that matches the design:
[`cf7-contact-form.txt`](cf7-contact-form.txt), walkthrough in [`contact-form-7.md`](contact-form-7.md).

---

## 5. Images

| Where | Suggested size | Notes |
| --- | --- | --- |
| Hero lead image (tab 3) | 1600 × 1000 | Only for the fallback hero. |
| Split block image | 1200 × 900 | Portrait-ish crops survive best; set *Focus & zoom* if the subject is off-centre. |
| Homepage — consulting-room photo & map inset, ribbon, cards, Visit us photo | as shipped | Each has its own *Photo focus — X / Y* + *Photo zoom*, so an upload re-frames exactly like the design photo. |
| Suburb / feature icons | — | Chosen from the icon dropdown, no upload. |
| Featured post image | 1200 × 800 | Post featured image, not a page field. |

Every image field falls back to the design's own photo, so an empty field never leaves a hole.

### Focus & zoom (crop position)

Every photo that sits in a fixed frame accepts the same three numbers — **focus X**, **focus Y**,
**zoom** — in the split block's *Focus & zoom* field or the separate *Photo focus — X / Y* and
*Photo zoom* fields on the homepage blocks:

| You type | You get |
| --- | --- |
| `70% 60% 1.9` | focus 70 % across, 60 % down, zoomed to 190 % |
| `70 60 1.9` | same — a number without a unit is read as a percentage |
| `1.4` | zoom only, focus stays centred |
| *(empty)* | centre, no zoom |
| `--x:70%;--y:60%;--s:1.9` | also accepted verbatim if you prefer raw CSS |

Zoom is clamped between **1** (no zoom) and **4**, so a stray `0` can never blank an image. The
framed photo uses `object-fit: cover`, so zooming in is how you remove unwanted edges — the frame
itself never resizes.

**Clarity:** a CSS zoom does not change the layout box, so the browser would normally download only
the smallest file that fits the *box* and the photo would look soft once scaled. The theme therefore
asks for **about twice** the layout size for every framed photo (and never less than the zoom
factor) — upload the original file (2000 px or more on the long edge) rather than a resized copy, and
the upload will look exactly like the design photo.

---

## 6. Adding a page that is not in the design

1. **Pages → Add New**, give it a title (e.g. *Pelvic Health*), publish.
2. Open tab **1. Page sections** → *Add section* → **Hero — inner page** → write the H1 and lead.
3. Add the blocks the page needs, in order (usually: split → features → FAQ).
4. Tab **2** decides whether the shared bands close the page.
5. Add it to the menu: **Appearance → Menus**.

Nothing else is required — no template, no code.

## 7. Copying a shipped page

Duplicate the page (Pages → hover → *Duplicate*, or re-create it), change the slug, then edit the
copied stack. The shipped stack for the old slug is never modified.

---

## 8. Blog pages are native WordPress

* **Blog index** — the page set as *Posts page* uses `home.php`: your posts, newest first, using the
  design's card grid. No theme settings.
* **Single post** — `single.php`: standard title, featured image, content, categories, related posts.
  Write in the normal editor; the theme adds no custom fields to posts.

## 9. Not editable in the theme (by design)

| Thing | Where it lives |
| --- | --- |
| Page title / meta description / social card | SEO plugin |
| Breadcrumb labels | The hero block's *Crumb* fields |
| Menus | Appearance → Menus |
| Header, footer, contact band, map band | Theme Settings |

---

## 10. If something looks wrong

| Symptom | Cause | Fix |
| --- | --- | --- |
| Page shows the shipped design after editing | No blocks saved, or the page slug changed | Check tab 1 has blocks; the fallback only kicks in when the stack is empty. |
| Contact band appears twice | The page stack is old and contains a `contact` block from an earlier version | Remove that block; bands are rendered once from tab 2. |
| Band missing on one page only | `page_contact_show` / `page_map_show` is off | Tab 2 → switch it back on. |
| Band order wrong | Both bands sit after the blocks; the numbers only sort them against each other | Set `900` / `910`. |
| Focus / zoom appears to do nothing | The value is not a length or the image is already at its frame ratio | Type numbers with or without `%` (`70 60 1.9`), not words. Zoom below `1` is ignored. |
| Uploaded photo looks softer than the design photo | The uploaded file is smaller than the shipped original (e.g. saved from the live site at 960 px) | Re-upload the original: 2000 px+ on the long edge. The theme already requests ~2× the frame size. |
| New page has a plain hero and body text | Its slug has no shipped design | That is the intended fallback — build it with blocks from tab 1. |
