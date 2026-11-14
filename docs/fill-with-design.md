# Fill the fields with the design content

The theme ships the whole design as **fallback copy**: a fresh install already looks finished even
though every field is empty. That is great for launch, annoying for editing — you open the Contact
page and see blank fields, so the only way to change one line is to retype the section.

**BDYCULTURE → Fill with design content** copies that shipped copy *into the fields*, once, so
everything on the site is visible on the edit screen and you only change what you actually want to
change.

---

## "My blocks are empty but the page looks finished"

That is the whole point of the fallback: the page renders the shipped design while the fields stay blank, so
nothing has to be copied by hand on day one. A blue notice sits at the top of every page edit screen (and on
Pages → All Pages) with a **Fill with design content** button — press it once and the blocks stop being empty.

---

| Where | What appears in the fields |
| --- | --- |
| **Site Settings** (every tab) | Phone, emails, address, booking link, hours, tagline, header labels, both bands' copy and detail rows, map coordinates and suburb chips, footer, mobile bar |
| **Front page** | Every homepage section — hero, marquee, service panels, continuum, ribbon, visit, expect, funding, pair, FAQ — plus each section's *Show* and *Order* |
| **10 inner pages** | The page is created if it does not exist (Services, Physiotherapy, Exercise Physiology, Occupational Therapy, Clinical Pilates, Referrers, Contact, Location — Chermside, Practice from BDYCULTURE, Privacy Policy) and every block is written in design order: hero, service cards, split, features, steps, funding, FAQ, CTA, ways to reach us, suburb list, rich text |
| **Blog index** | A *Blog* page is created and assigned as the posts page if none is set |
| **Shared bands** | Each page's contact/map switch is set to *Shown* with its default order |

Numbers are printed on the screen before you press the button, so you can see the size of the job
first (roughly 60 Site Settings fields, 10 pages, 65 blocks and 45 front-page fields).

## What it does **not** fill

| Left alone | Why |
| --- | --- |
| Photos and galleries | The design photos ship with the theme, not in the media library. An image field needs an attachment, so writing a filename would only give you a broken preview. Until you upload your own, the design photo keeps showing through the fallback. |
| Post pickers (featured article) | Same reason — they point at a post that may not exist yet |
| Menus | Assign them in **Appearance → Menus**: a menu for *Primary*, one for *Footer — services column*, one for *Footer — quick links column* |
| Blog posts | Standard WordPress — posts are your content, not the design |
| Blocks on a page you have already edited | Skipped unless you tick **Replace content that is already filled in** |

Because of the image rule, a section built entirely from photos (the homepage ribbon, for example)
stays on the fallback: its focus/zoom numbers are only meaningful together with the photo.

---

## How to run it

1. **BDYCULTURE → Fill with design content** (also listed under **Tools** if Advanced Custom Fields is
   not active).
2. Read the line under *This will fill* — it tells you exactly how many fields, pages and blocks.
3. Leave the checkbox **off** for a first run. It only writes into fields that are still empty, so it
   is safe to press twice.
4. Press **Fill the fields with the design content**.
5. The table tells you, page by page, whether it was *created*, *filled*, *overwritten*, *skipped* or
   failed.

### When to use the overwrite checkbox

Only after a design update, or when you want to throw away local edits and start again from the
shipped copy. It **replaces** whatever is in those fields — take a database backup first if the site
has been live for a while.

---

## Check it worked

| Check | Where |
| --- | --- |
| Site Settings shows the real phone, address and hours | BDYCULTURE → Site Settings → Clinic details |
| The Contact page has three blocks in the field | Pages → Contact → **1. Page sections** |
| Breadcrumbs still read *Home / Services / Physiotherapy* | Open the Physiotherapy page — the trail came from the hero's *Breadcrumb — trail* rows |
| The homepage sections have their toggle + order set | Pages → Home → the section tabs |

## Going back to the shipped design

Empty the field and the theme uses the shipped copy again. For a whole page, delete its blocks in
**1. Page sections** — the page then renders the design version exactly as it did after install.
Images never changed, so nothing is lost there.

---

## Troubleshooting

| Symptom | Cause |
| --- | --- |
| The menu item is missing | Advanced Custom Fields **Pro** must be active — flexible content is a Pro field |
| Everything says *skipped* | The fields already have content; tick **Replace content that is already filled in** |
| A page was created but shows a different design | The page slug must stay `physiotherapy`, `contact`, `location-chermside` …, because the design copy is keyed by slug |
| Photos are missing after filling | They were never copied — upload them in the block/media fields, or leave the field empty to keep the design photo |
| The homepage looks unchanged after filling | Editing the front page is per block tab; check *Show this section* is still on |

Related: [`theme-settings-guide.md`](theme-settings-guide.md) for what each Site Settings field means,
[`inner-pages-guide.md`](inner-pages-guide.md) for editing the blocks.
