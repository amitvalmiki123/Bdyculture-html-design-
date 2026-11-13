# The two form codes — copy, paste, done

Both website forms are **Contact Form 7** forms. The theme only holds their shortcodes, so all the
fields, labels, the button and the success message are edited here in the plugin.

| Form | Where it shows | Paste into |
| --- | --- | --- |
| **1. Get in touch** | The dark band at the end of the homepage, every inner page, the blog and single posts | Contact → *Get in touch* → **Form** tab |
| **2. Hero enquiry card** | The card beside the H1 on every inner page | Contact → *Hero enquiry card* → **Form** tab |

After pasting, copy each form's shortcode and put it in
**Theme Settings → Contact band → Form shortcode** and
**Theme Settings → Enquiry card → Form shortcode**.

---

## 1. Get in touch band

**Contact → Add New**, title it *Get in touch*, open the **Form** tab, select everything and replace
it with this:

```
<div class="card-form__head">
  <p>We’ll reply during business hours. For urgent medical help, call 000.</p>
</div>

<div class="field-row">
  <div class="field">
    <label for="cf-name">Full name</label>
    [text* your-name id:cf-name autocomplete:name]
  </div>
  <div class="field">
    <label for="cf-phone">Phone</label>
    [tel* your-phone id:cf-phone autocomplete:tel]
  </div>
</div>

<div class="field-row">
  <div class="field">
    <label for="cf-email">Email</label>
    [email* your-email id:cf-email autocomplete:email]
  </div>
  <div class="field">
    <label for="cf-service">Enquiry type</label>
    [select enquiry-type id:cf-service "Book an appointment" "Home visit enquiry" "Referring a patient" "General question"]
  </div>
</div>

<div class="field">
  <label for="cf-interest">I’m interested in</label>
  [select interest id:cf-interest "Physiotherapy" "Exercise Physiology" "Occupational Therapy" "Clinical Pilates" "I’m not sure yet"]
</div>

<div class="field field--grow">
  <label for="cf-msg">Message</label>
  [textarea your-message id:cf-msg rows:4]
</div>

[submit class:btn class:btn--ink class:btn--block class:btn--lg "Send message"]
```

**Mail** tab:

| Field | Value |
| --- | --- |
| To | `hello@bdyculture.com.au` |
| From | `BDYCULTURE website <wordpress@yourdomain.com>` |
| Subject | `Website enquiry — [your-name]` |
| Additional headers | `Reply-To: [your-email]` |
| Message body | see below |

```
Name: [your-name]
Phone: [your-phone]
Email: [your-email]
Enquiry type: [enquiry-type]
Interest: [interest]

[your-message]
```

**Messages** tab — success message (this is what the visitor sees in the band):

```
Thanks — your message is with the clinic. We reply during business hours.
```

> The *From* address must be on your own domain. A Gmail/Hotmail sender gets filtered as spam.

---

## 2. Hero enquiry card

**Contact → Add New**, title it *Hero enquiry card*, **Form** tab, replace everything with this:

```
<div class="card-form__head">
  <p>Our Chermside team will get back to you. For urgent medical help, call 000.</p>
</div>

<div class="field">
  <label for="hf-name">Full name</label>
  [text* your-name id:hf-name autocomplete:name]
</div>

<div class="field-row">
  <div class="field">
    <label for="hf-phone">Phone</label>
    [tel* your-phone id:hf-phone autocomplete:tel]
  </div>
  <div class="field">
    <label for="hf-email">Email</label>
    [email* your-email id:hf-email autocomplete:email]
  </div>
</div>

<div class="field">
  <label for="hf-service">I’m interested in</label>
  [select interest id:hf-service "Physiotherapy" "Exercise Physiology" "Occupational Therapy" "Clinical Pilates" "Home visit enquiry" "I’m not sure yet"]
</div>

[submit class:btn class:btn--signal class:btn--block class:btn--lg "Send enquiry"]
```

The card is dark, so the button is `btn--signal` (gold). Do not swap it for `btn--ink` — black on
black disappears.

**Mail** tab:

| Field | Value |
| --- | --- |
| To | `hello@bdyculture.com.au` |
| From | `BDYCULTURE website <wordpress@yourdomain.com>` |
| Subject | `Hero enquiry — [your-name]` |
| Additional headers | `Reply-To: [your-email]` |
| Message body | see below |

```
Name: [your-name]
Phone: [your-phone]
Email: [your-email]
Interested in: [interest]
```

**Messages** tab:

```
Thanks — your enquiry is with us. We’ll be in touch shortly.
```

---

## Copying the shortcodes

Each form's shortcode is shown at the top of its edit screen, e.g.
`[contact-form-7 id="87" title="Get in touch"]`. Click the shortcode box to select it, then:

| Form | Where it goes |
| --- | --- |
| Get in touch | **Theme Settings → Contact band → Form shortcode** |
| Hero enquiry card | **Theme Settings → Enquiry card → Form shortcode** |

Press **Update** in Theme Settings. Reload a page in a private window — the fields you pasted should
appear in the design's layout, with the gold/black button at the bottom.

> Until a shortcode is pasted the theme shows its own copy of the form. It looks right but stores and
> emails nothing — that is why this step matters.

---

## Quick check

1. Both forms say **Published** and have a shortcode.
2. Theme Settings shows a shortcode in both fields.
3. Fill each form on the live site once and confirm the email arrives at
   `hello@bdyculture.com.au`.
4. If the layout looks plain, the paste lost the `<div class="field">` lines — re-copy the whole
   block, including the tags.

More detail — spam settings, autocomplete, troubleshooting — in
[`contact-form-7.md`](contact-form-7.md).
