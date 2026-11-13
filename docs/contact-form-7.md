# Contact form — built in Contact Form 7

The "Get in touch" band keeps **only three editable things** in the theme: the form **heading**, the
**line under the form**, and the **shortcode** that pulls in the form. Everything inside the form —
labels, inputs, dropdown options, the submit button, validation and the success message — comes from
**Contact Form 7**, so the plugin is the single place to change the form.

**Where:** BDYCULTURE → **Theme Settings → Contact band**.

| Field | What it does |
| --- | --- |
| Form shortcode | Paste `[contact-form-7 id="123" title="Contact form"]` here. |
| Form heading (H3) | Heading above the form — "Send us a message". |
| Line under the form | The privacy line under the submit button. `{privacy_link}` prints the linked Privacy Policy. |

---

## 1. Install and create the form

1. **Plugins → Add New** → install and activate **Contact Form 7**.
2. **Contact → Add New** → title it *Contact band*.
3. Open the **Form** tab and replace everything with the code in
   [`cf7-contact-form.txt`](cf7-contact-form.txt) (copy the whole file).
4. **Mail** tab — set where the enquiry goes:

| Field | Suggested value |
| --- | --- |
| To | `hello@bdyculture.com.au` |
| From | `BDYCULTURE website <wordpress@yourdomain.com>` |
| Subject | `Website enquiry — [your-name]` |
| Additional headers | `Reply-To: [your-email]` |
| Message body | `Name: [your-name]` / `Phone: [your-phone]` / `Email: [your-email]` / `Enquiry type: [enquiry-type]` / `Interest: [interest]` / blank line / `[your-message]` |

> The *From* address must be on your own domain — Gmail/Hotmail senders get filtered as spam.

5. **Messages** tab — replace the default success text with the design's wording:

```
Thanks — message received. We'll be in touch shortly. To speak to someone now, call 07 3073 1616.
```

6. **Save** → the shortcode is shown at the top, e.g. `[contact-form-7 id="87" title="Contact band"]`.

## 2. Connect it to the theme

1. **BDYCULTURE → Theme Settings → Contact band**.
2. Paste the shortcode into **Form shortcode**.
3. Fill **Form heading (H3)** and **Line under the form** (they ship pre-filled).
4. **Update**, then open the homepage and submit a test enquiry.

The homepage, every inner page, the blog index and single posts all show that one form.

## 3. What the pasted code already matches

The form code is written with the theme's own classes, so it lines up with the design without extra
styling:

| Piece | Class used | Result |
| --- | --- | --- |
| Two-column rows | `.field-row` | Name + Phone, then Email + Enquiry type side by side |
| Each field | `.field` | label on top, control below, 6 px gap |
| Long message field | `.field.field--grow` | textarea stretches to fill the card |
| Submit | `[submit class:btn class:btn--ink class:btn--block class:btn--lg "Send message"]` | the design's full-width dark button |
| Intro line | `.card-form__head` | the "We'll reply during business hours…" line under the heading |

Automatic `<p>`/`<br>` insertion is switched off for CF7 by the theme
(`wpcf7_autop_or_not`), so the template is output exactly as you type it.

## 4. Changing the form later

| To… | Edit |
| --- | --- |
| Add, remove or reorder a field | CF7 → Forms → the form → **Form** tab |
| Change the dropdown options | the `[select …]` line, options are quoted, e.g. `"Book an appointment"` |
| Change the button text | the last word of the `[submit …]` line |
| Make a field required | `*` after the field type: `[text* your-name]` → required, `[text your-name]` → optional |
| Change where enquiries go | CF7 → **Mail** tab |
| Change the success message | CF7 → **Messages** tab |
| Change the heading or the privacy line | BDYCULTURE → Theme Settings → **Contact band** |

## 5. Spam

CF7 alone lets spam through. Add one of:

* **Cloudflare Turnstile** (free, no puzzle) — CF7 5.8+ has it built in: *Contact → Integration*.
* **Akismet** — install, connect, then *Contact → Integration → Akismet*.
* **Honeypot for Contact Form 7** plugin (no external service).

## 6. If it does not look right

| Symptom | Cause | Fix |
| --- | --- | --- |
| Form shows unstyled / stacked | The form code was pasted into the page instead of CF7 | Shortcode goes in Theme Settings; the form code goes in CF7's **Form** tab |
| Two forms on the page | A shortcode plus an old form block | Remove the leftover block; only the theme prints the card |
| Fields side by side broken | `.field-row` wrapper missing | Re-copy the template from `cf7-contact-form.txt` |
| Button not dark | `class:btn class:btn--ink` missing from `[submit …]` | Re-copy the template |
| Nothing arrives by email | Mail *To/From* not set, or host blocks mail | Set the Mail tab; install an SMTP plugin (WP Mail SMTP) |
| Static form shows instead of yours | The shortcode field is empty | Paste the shortcode in Theme Settings → Contact band |

## 7. Without the plugin

Leave the shortcode empty and the design's own form is printed — it looks identical but only shows
the success panel client-side; it does not send anything. That is the safety net so the page never
looks broken, not a replacement for CF7.
