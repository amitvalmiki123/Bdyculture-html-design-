# Homepage — field-by-field setup guide

A complete, copy-ready walkthrough for filling the **Home** page by hand in the WordPress admin.
Every field of every tab is listed in the order it appears on screen, with the exact content to type.

> The theme already renders the approved design from `defaults.php`, so **nothing has to be filled** for the site to look right.
> Use this guide when you want the content to live in the database (so the client can edit it) or when you are recreating the site from scratch.

---

## 1. Before you start

| Step | Where | Why |
| --- | --- | --- |
| 1 | Plugins → **Advanced Custom Fields PRO** | Repeaters and the section tabs need the PRO version. The free plugin shows only plain fields. |
| 2 | Appearance → Themes | `bdyculture-parent` first, then `bdyculture` (child), then Activate. |
| 3 | Pages → Add New → title **Home** → Publish | The front page is assembled from sections, so the page body stays empty. |
| 4 | Settings → Reading → *A static page* → Homepage: **Home** | ACF shows the Home field group only once the page is the front page. |
| 5 | BDYCULTURE → **Theme Settings** | Fill the clinic details first — the phone, email, address and booking URL are reused everywhere through tokens. |
| 6 | Pages → *Home* → **Edit** | The 11 tabs described below appear under the page title. |

### How saving works

* **A field you never touch keeps the design copy.** The theme falls back to `defaults.php`.
* **A field you save — even empty — takes over.** So once you start a tab, fill it completely instead of leaving blanks.
* **Repeat rows render top to bottom.** The first row is the first tab / card / FAQ on the page.
* **Save with the page (Update), not per tab.** One update saves every tab.
* **`Show this section` + `Order`** at the top of each tab control whether the band appears and where. The numbers ship as 10, 20, 30 … 120; changing one number moves the band.

### Tokens you can type instead of real details

Any text field accepts these placeholders. They are replaced on the page, so changing the phone number once in *Theme Settings* updates every field that uses a token.

| Token | Becomes |
| --- | --- |
| `{phone}` | the clinic phone number, as text (07 3073 1616) |
| `{phone_link}` | the clinic number wrapped in a tel: link |
| `{email}` | the clinic email, as text |
| `{email_link}` | the clinic email wrapped in a mailto: link |
| `{referrals_email}` | the referrals email, as text |
| `{referrals_email_link}` | the referrals email wrapped in a mailto: link |
| `{address}` | the two address lines separated by a comma |
| `{address_html}` | the two address lines separated by <br> |
| `{credit_link}` | the web-design credit, linked |
| `{privacy}` | the Privacy Policy label, as text |
| `{privacy_link}` | the Privacy Policy label, linked |

### Images

Every image field is an ACF *Image* field (return format: Image Array). The design files ship inside the theme — upload them once under **Media → Add New**, then pick them in the field:

| File (`themes/bdyculture/assets/images/`) | Used by |
| --- | --- |
| `hero-gym-bright.webp` | Hero background |
| `gym-chermside-1920.jpg` | Consulting-room band, Service panels |
| `shopfront-signage-chermside.jpg` | Visit us |
| `clinic-door-signage.png` | Door-signage card, Inset card |

---

## 2. The eleven tabs at a glance

| Tab | Section | What it renders | Show | Order |
| --- | --- | --- | --- | --- |
| 1 | Hero | Opening screen: background photo, H1, lead paragraph, three buttons and the trust checklist. | On | 10 |
| 2 | Marquee | The dark ticker under the hero: four service labels separated by a dot, looped. | On | 20 |
| 3 | Services | Sticky tab list on the left, four service panels on the right. The richest section — one repeater row per service. | On | 30 |
| 4 | More than a consulting room | Split band: heading + four numbered steps on the left, clinic photo with badge and expandable copy on the right. | On | 40 |
| 5 | Photo ribbon | Six-photo strip with alternating heights and swept corners. | On | 50 |
| 6 | Visit us | Clinic signage: window photo, overlapping door-signage card, address copy, two buttons. | On | 55 |
| 7 | What to expect | Dark band with three numbered cards. | On | 60 |
| 8 | Funding | Intro panel on the left, six funding cards on the right. | On | 70 |
| 9 | Home visits & refer | Two equal cards: home visits and referrer pathways. | On | 80 |
| 10 | FAQ | Eight question/answer rows in an accordion, one open at a time. | On | 90 |
| 11 | Contact | Show/order only — copy lives in Theme Settings. | On | 100 |
| 12 | Map | Show/order only — copy lives in Theme Settings. | On | 110 |

Fill in tab order (1 → 11): each tab is one band of the page, top to bottom. Tab 11 is switches only — its copy is edited in Theme Settings.

About **45–60 minutes** for the whole page if you copy the values below, plus 10 minutes to upload the four images once.

---

## 3. Field-by-field fill sheets


### Tab 1 — Hero

Opening screen: background photo, H1, lead paragraph, three buttons and the trust checklist.

Section key: `hero` — fields are prefixed `home_hero_`.

- **Show this section** — `home_hero_show` · on/off · **On**
- **Order** — `home_hero_order` · number · `10`  
  > Lower numbers render first.
- **Hero background photo** — `home_hero_image` · image · *leave empty* (the theme then shows `hero-gym-bright.webp`)
- **Hero heading (H1)** — `home_hero_title` · text (multi-line)
  Fill (paste exactly):

  ```text
  Allied Health <span class="amp">&amp;</span> Rehabilitation in <span class="hero__highlight">Chermside</span>
  ```
- **Hero lead paragraph** — `home_hero_lead` · text (multi-line) · `A multidisciplinary clinic combining expert allied health care with a dedicated rehabilitation and exercise environment.`
- **Hero buttons** — `home_hero_buttons` · repeater · **3 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Text (`hero_btn_text`): `Book Online`
  - Link (`hero_btn_url`): `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
  - Style (`hero_btn_style`): **`signal`**
  - Icon (`hero_btn_icon`): **`arrow`**
  - Icon side (`hero_btn_icon_pos`): **`—`**
  - New tab (`hero_btn_new_tab`): **Yes**

  **Row 2**
  - Text (`hero_btn_text`): `Call {phone}`
  - Link (`hero_btn_url`): `tel`
  - Style (`hero_btn_style`): **`call`**
  - Icon (`hero_btn_icon`): **`phone`**
  - Icon side (`hero_btn_icon_pos`): **`—`**
  - New tab (`hero_btn_new_tab`): **No**

  **Row 3**
  - Text (`hero_btn_text`): `Refer a Patient`
  - Link (`hero_btn_url`): `/referrers/`
  - Style (`hero_btn_style`): **`ghost`**
  - Icon (`hero_btn_icon`): **`—`**
  - Icon side (`hero_btn_icon_pos`): **`—`**
  - New tab (`hero_btn_new_tab`): **No**

- **Hero checklist** — `home_hero_checks` · repeater · **3 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Text (`hero_check_text`): `Online booking via Nookal`

  **Row 2**
  - Text (`hero_check_text`): `Physio · Exercise Physiology · OT · Pilates`

  **Row 3**
  - Text (`hero_check_text`): `Home visits by arrangement`


### Tab 2 — Marquee

The dark ticker under the hero: four service labels separated by a dot, looped.

Section key: `marquee` — fields are prefixed `home_marquee_`.

- **Show this section** — `home_marquee_show` · on/off · **On**
- **Order** — `home_marquee_order` · number · `20`  
  > Lower numbers render first.
- **Marquee items** — `home_marquee_items` · repeater · **4 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Text (`marquee_item_text`): `Physiotherapy`

  **Row 2**
  - Text (`marquee_item_text`): `Exercise Physiology`

  **Row 3**
  - Text (`marquee_item_text`): `Occupational Therapy`

  **Row 4**
  - Text (`marquee_item_text`): `Clinical Pilates`


### Tab 3 — Services

Sticky tab list on the left, four service panels on the right. The richest section — one repeater row per service.

Section key: `services` — fields are prefixed `home_services_`.

- **Show this section** — `home_services_show` · on/off · **On**
- **Order** — `home_services_order` · number · `30`  
  > Lower numbers render first.
- **Eyebrow tag** — `home_services_tag` · text · `Our core services`
- **Heading (H2)** — `home_services_title` · text (multi-line)
  Fill (paste exactly):

  ```text
  Four disciplines.<br>One joined-up clinic.
  ```
- **Intro** — `home_services_intro` · text (multi-line)
  Fill (paste exactly):

  ```text
  Integrated allied health care built around rehabilitation, movement and long-term function. Choose a discipline to see how it can help, then book online or enquire — whichever suits you.
  ```
- **Service tabs & panels** — `home_services_panels` · repeater · **4 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Tab label (`panel_tab_label`): `Physiotherapy`
  - Tab icon (`panel_icon`): **`physiotherapy`**
  - Image chip label (`panel_chip`): `Physiotherapy`
  - Panel photo (`panel_image`): upload `assets/images/gym-chermside-1920.jpg`
  - Photo focus — X (`panel_img_x`): `28%`
  - Photo focus — Y (`panel_img_y`): `62%`
  - Photo zoom (`panel_img_scale`): `1.5`
  - Panel heading (H3) (`panel_title`): `Physiotherapy`
  - Panel lead (`panel_lead`): `Assessment, treatment and progressive rehabilitation for pain, injury, post-operative recovery and movement limitations.`
  - Panel body (`panel_body`):

    ```text
    Physiotherapy at BDYCULTURE starts with understanding how you move and what is getting in the way. Your physiotherapist assesses the problem, explains what they find in plain language and builds a plan that moves from symptom management towards strength and confidence — with the clinic’s rehabilitation space on hand when exercise becomes part of the plan.
    ```
  - Primary button — text (`panel_btn_1_text`): `Explore Physiotherapy`
  - Primary button — link (`panel_btn_1_url`): `/physiotherapy/`
  - Primary icon (`panel_btn_1_icon`): **`arrow`**
  - Secondary button — text (`panel_btn_2_text`): `Book Online`
  - Secondary button — link (`panel_btn_2_url`): `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
  - Secondary opens in new tab (`panel_btn_2_new_tab`): **Yes**
  - Tick list (`panel_ticks`): **4 rows**
    1. Text (`panel_tick_text`): `Pain and injury assessment`
    2. Text (`panel_tick_text`): `Post-operative recovery`
    3. Text (`panel_tick_text`): `Movement limitations`
    4. Text (`panel_tick_text`): `Progressive rehabilitation programs`

  **Row 2**
  - Tab label (`panel_tab_label`): `Exercise Physiology`
  - Tab icon (`panel_icon`): **`exercise-physiology`**
  - Image chip label (`panel_chip`): `Exercise Physiology`
  - Panel photo (`panel_image`): upload `assets/images/hero-gym-bright.webp`
  - Photo focus — X (`panel_img_x`): `52%`
  - Photo focus — Y (`panel_img_y`): `45%`
  - Photo zoom (`panel_img_scale`): `1.5`
  - Panel heading (H3) (`panel_title`): `Exercise Physiology`
  - Panel lead (`panel_lead`): `Clinical exercise prescription for chronic conditions, injury rehabilitation, strength, mobility and long-term health.`
  - Panel body (`panel_body`):

    ```text
    Exercise physiology uses carefully prescribed, supervised exercise as the treatment. Sessions are planned around your health history and goals, then progressed as you build capacity — making full use of the equipped exercise environment that sits alongside our consulting rooms.
    ```
  - Primary button — text (`panel_btn_1_text`): `Explore Exercise Physiology`
  - Primary button — link (`panel_btn_1_url`): `/exercise-physiology/`
  - Primary icon (`panel_btn_1_icon`): **`arrow`**
  - Secondary button — text (`panel_btn_2_text`): `Book Online`
  - Secondary button — link (`panel_btn_2_url`): `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
  - Secondary opens in new tab (`panel_btn_2_new_tab`): **Yes**
  - Tick list (`panel_ticks`): **4 rows**
    1. Text (`panel_tick_text`): `Chronic condition management`
    2. Text (`panel_tick_text`): `Injury rehabilitation`
    3. Text (`panel_tick_text`): `Strength and mobility`
    4. Text (`panel_tick_text`): `Long-term health and capacity`

  **Row 3**
  - Tab label (`panel_tab_label`): `Occupational Therapy`
  - Tab icon (`panel_icon`): **`occupational-therapy`**
  - Image chip label (`panel_chip`): `Occupational Therapy`
  - Panel photo (`panel_image`): upload `assets/images/hero-gym-bright.webp`
  - Photo focus — X (`panel_img_x`): `8%`
  - Photo focus — Y (`panel_img_y`): `55%`
  - Photo zoom (`panel_img_scale`): `1.9`
  - Panel heading (H3) (`panel_title`): `Occupational Therapy`
  - Panel lead (`panel_lead`): `Practical assessment and therapy to support independence, daily function, participation and everyday activities.`
  - Panel body (`panel_body`):

    ```text
    Occupational therapy looks at the activities that matter in your day and what makes them harder than they should be. Your therapist works with you on practical strategies and supports that help you stay as independent and involved as you want to be.
    ```
  - Primary button — text (`panel_btn_1_text`): `Explore Occupational Therapy`
  - Primary button — link (`panel_btn_1_url`): `/occupational-therapy/`
  - Primary icon (`panel_btn_1_icon`): **`arrow`**
  - Secondary button — text (`panel_btn_2_text`): `Book Online`
  - Secondary button — link (`panel_btn_2_url`): `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
  - Secondary opens in new tab (`panel_btn_2_new_tab`): **Yes**
  - Tick list (`panel_ticks`): **4 rows**
    1. Text (`panel_tick_text`): `Independence and daily function`
    2. Text (`panel_tick_text`): `Participation in everyday activities`
    3. Text (`panel_tick_text`): `Practical assessment`
    4. Text (`panel_tick_text`): `Strategies and supports`

  **Row 4**
  - Tab label (`panel_tab_label`): `Clinical Pilates`
  - Tab icon (`panel_icon`): **`clinical-pilates`**
  - Image chip label (`panel_chip`): `Clinical Pilates`
  - Panel photo (`panel_image`): upload `assets/images/hero-gym-bright.webp`
  - Photo focus — X (`panel_img_x`): `96%`
  - Photo focus — Y (`panel_img_y`): `78%`
  - Photo zoom (`panel_img_scale`): `2.2`
  - Panel heading (H3) (`panel_title`): `Clinical Pilates`
  - Panel lead (`panel_lead`): `Pilates-based exercise to support rehabilitation, strength, movement and physical capacity, delivered by an Accredited Exercise Physiologist or Physiotherapist.`
  - Panel body (`panel_body`):

    ```text
    Clinical Pilates is delivered by an Accredited Exercise Physiologist or Physiotherapist, so each session is guided by clinical assessment rather than a generic class format. It sits naturally alongside the rest of the clinic’s rehabilitation pathway.
    ```
  - Primary button — text (`panel_btn_1_text`): `Explore Clinical Pilates`
  - Primary button — link (`panel_btn_1_url`): `/clinical-pilates/`
  - Primary icon (`panel_btn_1_icon`): **`arrow`**
  - Secondary button — text (`panel_btn_2_text`): `Book Online`
  - Secondary button — link (`panel_btn_2_url`): `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
  - Secondary opens in new tab (`panel_btn_2_new_tab`): **Yes**
  - Tick list (`panel_ticks`): **4 rows**
    1. Text (`panel_tick_text`): `Rehabilitation-focused movement`
    2. Text (`panel_tick_text`): `Strength and control`
    3. Text (`panel_tick_text`): `Physical capacity`
    4. Text (`panel_tick_text`): `Led by an AEP or Physiotherapist`


### Tab 4 — More than a consulting room

Split band: heading + four numbered steps on the left, clinic photo with badge and expandable copy on the right.

Section key: `continuum` — fields are prefixed `home_continuum_`.

- **Show this section** — `home_continuum_show` · on/off · **On**
- **Order** — `home_continuum_order` · number · `40`  
  > Lower numbers render first.
- **Eyebrow tag** — `home_continuum_tag` · text · `More than a consulting room`
- **Heading (H2)** — `home_continuum_title` · text (multi-line) · `From first assessment to long-term capacity — in one place.`
- **Intro** — `home_continuum_intro` · text (multi-line)
  Fill (paste exactly):

  ```text
  Our Chermside clinic combines clinical allied health care with a dedicated rehabilitation and exercise environment, allowing care to progress from assessment and symptom management through to strength, conditioning and long-term physical capacity.
  ```
- **Main photo** — `home_continuum_photo` · image
  Upload `themes/bdyculture/assets/images/gym-chermside-1920.jpg` (used in: consulting-room band), then type the same description into the next field.
- **Main photo alt text** — `home_continuum_photo_alt` · text · `BDYCULTURE rehabilitation gym in Chermside, Brisbane, with strength equipment, cable machines, free weights and open functional exercise space`  
  > Used only when the Media Library has no alt text.
- **Photo caption** — `home_continuum_caption` · text · `Our rehab &amp; exercise space · Level 1, Chermside`
- **Main photo focus — X** — `home_continuum_photo_x` · text · `38%`  
  > 38 or 38%.
- **Main photo focus — Y** — `home_continuum_photo_y` · text · `50%`  
  > 50 or 50%.
- **Main photo zoom** — `home_continuum_photo_scale` · text · `1`  
  > 1 = no zoom, up to 4.
- **Inset photo** — `home_continuum_inset` · image
  Upload `themes/bdyculture/assets/images/hero-gym-bright.webp` (used in: inset card), then type the same description into the next field.
- **Inset focus — X** — `home_continuum_inset_x` · text · `70%`
- **Inset focus — Y** — `home_continuum_inset_y` · text · `60%`
- **Inset zoom** — `home_continuum_inset_scale` · text · `1.9`
- **Badge number** — `home_continuum_badge_number` · text · `7`
- **Badge text** — `home_continuum_badge_text` · text (multi-line)
  Fill (paste exactly):

  ```text
  consulting rooms<br>+ rehab &amp; exercise space
  ```
- **Approach steps** — `home_continuum_steps` · repeater · **4 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Icon (`continuum_step_icon`): **`search`**
  - Title (`continuum_step_title`): `Assess`
  - Text (`continuum_step_text`): `Your practitioner listens, examines and explains what is going on and what your options are.`

  **Row 2**
  - Icon (`continuum_step_icon`): **`heart`**
  - Title (`continuum_step_title`): `Settle`
  - Text (`continuum_step_text`): `Treatment and guidance focus on managing symptoms so you can start moving with more confidence.`

  **Row 3**
  - Icon (`continuum_step_icon`): **`exercise-physiology`**
  - Title (`continuum_step_title`): `Strengthen`
  - Text (`continuum_step_text`): `Supervised exercise builds strength, mobility and control in the clinic’s dedicated rehab space.`

  **Row 4**
  - Icon (`continuum_step_icon`): **`trend`**
  - Title (`continuum_step_title`): `Sustain`
  - Text (`continuum_step_text`): `You leave with the capacity and the know-how to keep going well beyond the clinic.`

- **"Read more" label** — `home_continuum_more_closed` · text · `Read more about our approach`
- **"Show less" label** — `home_continuum_more_open` · text · `Show less`
- **Expandable paragraphs** — `home_continuum_paragraphs` · repeater · **3 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Paragraph (`continuum_para_text`):

    ```text
    Many people only ever see a health professional in a consulting room, then are sent elsewhere to find somewhere to exercise. Having seven consulting rooms and a fully equipped rehabilitation and exercise space under the same roof means your care does not need to be handed off at the moment it becomes most active.
    ```

  **Row 2**
  - Paragraph (`continuum_para_text`):

    ```text
    Because physiotherapists, exercise physiologists and occupational therapists work from the same clinic, the people involved in your care can stay across what the others are doing. That makes it easier to keep goals consistent, to adjust a program when something changes and to avoid repeating the same assessment in three different places.
    ```

  **Row 3**
  - Paragraph (`continuum_para_text`):

    ```text
    Every plan is individual. Your practitioner will talk through the options and what each involves, and you stay in charge of the decisions. Results and recovery times differ from person to person.
    ```

- **Button 1 — text** — `home_continuum_btn_1_text` · text · `Book an Appointment`
- **Button 1 — link** — `home_continuum_btn_1_url` · text · `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
- **Button 2 — text** — `home_continuum_btn_2_text` · text · `Call {phone}`
- **Button 2 — link** — `home_continuum_btn_2_url` · text · `tel`

### Tab 5 — Photo ribbon

Six-photo strip with alternating heights and swept corners.

Section key: `ribbon` — fields are prefixed `home_ribbon_`.

- **Show this section** — `home_ribbon_show` · on/off · **On**
- **Order** — `home_ribbon_order` · number · `50`  
  > Lower numbers render first.
- **Ribbon photos** — `home_ribbon_images` · repeater · **6 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Photo (`ribbon_image`): upload `assets/images/gym-chermside-1920.jpg`
  - Focus — X (`ribbon_x`): `22%`
  - Focus — Y (`ribbon_y`): `70%`
  - Zoom (`ribbon_scale`): `1.6`
  - Swept corner (`ribbon_swept`): **Yes**

  **Row 2**
  - Photo (`ribbon_image`): upload `assets/images/hero-gym-bright.webp`
  - Focus — X (`ribbon_x`): `96%`
  - Focus — Y (`ribbon_y`): `75%`
  - Zoom (`ribbon_scale`): `2.3`
  - Swept corner (`ribbon_swept`): **No**

  **Row 3**
  - Photo (`ribbon_image`): upload `assets/images/hero-gym-bright.webp`
  - Focus — X (`ribbon_x`): `52%`
  - Focus — Y (`ribbon_y`): `40%`
  - Zoom (`ribbon_scale`): `1.5`
  - Swept corner (`ribbon_swept`): **Yes**

  **Row 4**
  - Photo (`ribbon_image`): upload `assets/images/gym-chermside-1920.jpg`
  - Focus — X (`ribbon_x`): `60%`
  - Focus — Y (`ribbon_y`): `65%`
  - Zoom (`ribbon_scale`): `1.3`
  - Swept corner (`ribbon_swept`): **No**

  **Row 5**
  - Photo (`ribbon_image`): upload `assets/images/hero-gym-bright.webp`
  - Focus — X (`ribbon_x`): `8%`
  - Focus — Y (`ribbon_y`): `55%`
  - Zoom (`ribbon_scale`): `2`
  - Swept corner (`ribbon_swept`): **Yes**

  **Row 6**
  - Photo (`ribbon_image`): upload `assets/images/hero-gym-bright.webp`
  - Focus — X (`ribbon_x`): `34%`
  - Focus — Y (`ribbon_y`): `35%`
  - Zoom (`ribbon_scale`): `2`
  - Swept corner (`ribbon_swept`): **No**


### Tab 6 — Visit us

Clinic signage: window photo, overlapping door-signage card, address copy, two buttons.

Section key: `visit` — fields are prefixed `home_visit_`.

- **Show this section** — `home_visit_show` · on/off · **On**
- **Order** — `home_visit_order` · number · `55`  
  > Lower numbers render first.
- **Tag** — `home_visit_tag` · text · `Visit us`
- **Heading (H2)** — `home_visit_title` · text · `Find us on Gympie Road, Chermside.`
- **Paragraph 1** — `home_visit_text_1` · text (multi-line)
  Fill (paste exactly):

  ```text
  BDYCULTURE is located at Suite 5, Level 1, 671 Gympie Road, Chermside QLD 4032, with lift access available. Look for our window signage listing Physiotherapy, Exercise Physiology, Occupational Therapy and Clinical Pilates.
  ```
- **Paragraph 2** — `home_visit_text_2` · text (multi-line)
  Fill (paste exactly):

  ```text
  Enter 671 Gympie Road, Chermside QLD 4032 into your GPS or maps app. Visitor parking is available at the rear of the building, with additional 3-hour parking within the adjacent precinct.
  ```
- **Photo — window signage** — `home_visit_main_image` · image · *leave empty*
- **Photo focus — X** — `home_visit_main_x` · text · `50%`  
  > 50 or 50%.
- **Photo focus — Y** — `home_visit_main_y` · text · `50%`  
  > 40 or 40%.
- **Photo zoom** — `home_visit_main_scale` · text · `1`  
  > 1 = no zoom, up to 4.
- **Alt text — window signage** — `home_visit_main_alt` · text · `BDYCULTURE window signage at the Chermside clinic listing Physiotherapy, Exercise Physiology, Occupational Therapy and Clinical Pilates`
- **Photo — door signage** — `home_visit_door_image` · image · *leave empty*
- **Alt text — door signage** — `home_visit_door_alt` · text · `BDYCULTURE clinic door signage, Suite 5, Level 1, Chermside`
- **Button 1 — label** — `home_visit_cta_1_text` · text · `Get directions`
- **Button 1 — link** — `home_visit_cta_1_url` · text · `https://www.google.com/maps/search/?api=1&query=671+Gympie+Road+Suite+5+Level+1+Chermside+QLD+4032`
- **Button 1 — style** — `home_visit_cta_1_style` · select · **`ink`**  (options: signal, ink, ghost, light, outline-light, call)
- **Button 2 — label** — `home_visit_cta_2_text` · text · `Book Online`
- **Button 2 — link** — `home_visit_cta_2_url` · text · `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
- **Button 2 — style** — `home_visit_cta_2_style` · select · **`ghost`**  (options: signal, ink, ghost, light, outline-light, call)

### Tab 7 — What to expect

Dark band with three numbered cards.

Section key: `expect` — fields are prefixed `home_expect_`.

- **Show this section** — `home_expect_show` · on/off · **On**
- **Order** — `home_expect_order` · number · `60`  
  > Lower numbers render first.
- **Eyebrow tag** — `home_expect_tag` · text · `What to expect`
- **Heading (H2)** — `home_expect_title` · text (multi-line) · `Three steps from “I need help” to a plan.`
- **Intro** — `home_expect_intro` · text (multi-line) · `Getting started should be the easy part. Whether you book yourself or a GP, specialist or case manager refers you, the path looks the same.`
- **Steps** — `home_expect_steps` · repeater · **3 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Title (`expect_step_title`): `Book or refer`
  - Text (`expect_step_text`):

    ```text
    Book online through Nookal in a couple of minutes, call the clinic on {phone}, or send an enquiry. Referrers can email the team directly. If you are not sure which service you need, tell us what is going on and we will help you choose.
    ```

  **Row 2**
  - Title (`expect_step_title`): `Your first appointment`
  - Text (`expect_step_text`):

    ```text
    Your practitioner takes time to understand your history, goals and concerns, assesses how you move, and explains the findings and options clearly. Wear comfortable clothing and bring any referral letters, reports or imaging you already have.
    ```

  **Row 3**
  - Title (`expect_step_title`): `Your plan, in motion`
  - Text (`expect_step_text`):

    ```text
    Together you agree on a plan. Depending on your needs that might include treatment, supervised exercise in the rehab space, Clinical Pilates, practical strategies for daily life, or a mix — reviewed and adjusted as you progress.
    ```

- **Button 1 — text** — `home_expect_btn_1_text` · text · `Book Online`
- **Button 1 — link** — `home_expect_btn_1_url` · text · `https://book.nookal.com/bookings/book/EA59F8c8-2593-a0ee-Fbca-FEaEb0d0beE6/select`
- **Button 1 icon** — `home_expect_btn_1_icon` · select · **`arrow`**  (options: physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search, heart, trend, clipboard, calendar, location, check, star, mail, arrow)
- **Button 2 — text** — `home_expect_btn_2_text` · text · `Send an enquiry`
- **Button 2 — link** — `home_expect_btn_2_url` · text · `#contact`

### Tab 8 — Funding

Intro panel on the left, six funding cards on the right.

Section key: `funding` — fields are prefixed `home_funding_`.

- **Show this section** — `home_funding_show` · on/off · **On**
- **Order** — `home_funding_order` · number · `70`  
  > Lower numbers render first.
- **Eyebrow tag** — `home_funding_tag` · text · `Funding &amp; referrals`
- **Heading (H2)** — `home_funding_title` · text (multi-line) · `Funding pathways that fit how you’re covered.`
- **Intro** — `home_funding_intro` · text (multi-line)
  Fill (paste exactly):

  ```text
  Our services can be accessed through a range of funding pathways. Eligibility and availability differ by service and by person — for example, Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service — so check with our team before you book.
  ```
- **Second paragraph** — `home_funding_text` · text (multi-line)
  Fill (paste exactly):

  ```text
  Each service page sets out the pathways for that discipline, along with what a referral involves and what to bring. If you are working with a case manager, insurer or support coordinator, we are happy to talk through their requirements with you.
  ```
- **Funding pathways** — `home_funding_pathways` · repeater · **6 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Title (`pathway_title`): `Private`
  - Note (`pathway_text`): `Book directly, no third party required`

  **Row 2**
  - Title (`pathway_title`): `WorkCover Queensland`
  - Note (`pathway_text`): `Work-related injury claims`

  **Row 3**
  - Title (`pathway_title`): `Medicare Chronic Condition Management`
  - Note (`pathway_text`): `Eligible chronic conditions via your GP`

  **Row 4**
  - Title (`pathway_title`): `Queensland CTP`
  - Note (`pathway_text`): `Compulsory third party motor vehicle claims`

  **Row 5**
  - Title (`pathway_title`): `NDIS`
  - Note (`pathway_text`): `Participants with funded supports`

  **Row 6**
  - Title (`pathway_title`): `DVA`
  - Note (`pathway_text`): `Veteran Cards — Gold and White`


### Tab 9 — Home visits & refer

Two equal cards: home visits and referrer pathways.

Section key: `pair` — fields are prefixed `home_pair_`.

- **Show this section** — `home_pair_show` · on/off · **On**
- **Order** — `home_pair_order` · number · `80`  
  > Lower numbers render first.
- **Card 1 — tag** — `pair_1_tag` · text · `More than a consulting room`
- **Card 1 — style** — `pair_1_style` · select · **`ink`**  (options: ink, signal)
- **Card 1 — heading (H2)** — `pair_1_title` · text · `Home Visits Available by Arrangement`
- **Card 1 — text** — `pair_1_text` · text (multi-line)
  Fill (paste exactly):

  ```text
  Physiotherapy and exercise physiology home visits may be available across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability. Contact our team to enquire.
  ```
- **Card 1 — button 1 text** — `pair_1_btn_1_text` · text · `Call {phone}`
- **Card 1 — button 1 link** — `pair_1_btn_1_url` · text · `tel`
- **Card 1 — button 1 style** — `pair_1_btn_1_style` · select · **`signal`**  (options: signal, ink, ghost, light, outline-light, call)
- **Card 1 — button 2 text** — `pair_1_btn_2_text` · text · `Ask about home visits`
- **Card 1 — button 2 link** — `pair_1_btn_2_url` · text · `#contact`
- **Card 1 — button 2 style** — `pair_1_btn_2_style` · select · **`outline-light`**  (options: signal, ink, ghost, light, outline-light, call)
- **Card 2 — tag** — `pair_2_tag` · text · `For GPs, specialists &amp; case managers`
- **Card 2 — style** — `pair_2_style` · select · **`signal`**  (options: ink, signal)
- **Card 2 — heading (H2)** — `pair_2_title` · text · `Ready to get started? Refer a patient.`
- **Card 2 — text** — `pair_2_text` · text (multi-line)
  Fill (paste exactly):

  ```text
  Whether you’re booking care or referring a patient, we’ll make the next step simple. Email {referrals_email_link} with the subject “Patient Referral – BDYCULTURE”, or visit the Referrers page for the full steps.
  ```
- **Card 2 — button 1 text** — `pair_2_btn_1_text` · text · `Refer a Patient`
- **Card 2 — button 1 link** — `pair_2_btn_1_url` · text · `/referrers/`
- **Card 2 — button 1 style** — `pair_2_btn_1_style` · select · **`ink`**  (options: signal, ink, ghost, light, outline-light, call)
- **Card 2 — button 1 icon** — `pair_2_btn_1_icon` · select · **`arrow`**  (options: physiotherapy, exercise-physiology, occupational-therapy, clinical-pilates, search, heart, trend, clipboard, calendar, location, check, star, mail, arrow)
- **Card 2 — button 2 text** — `pair_2_btn_2_text` · text · *leave empty*
- **Card 2 — button 2 link** — `pair_2_btn_2_url` · text · *leave empty*

### Tab 10 — FAQ

Eight question/answer rows in an accordion, one open at a time.

Section key: `faq` — fields are prefixed `home_faq_`.

- **Show this section** — `home_faq_show` · on/off · **On**
- **Order** — `home_faq_order` · number · `90`  
  > Lower numbers render first.
- **Eyebrow tag** — `home_faq_tag` · text · `FAQs`
- **Heading (H2)** — `home_faq_title` · text (multi-line) · `Questions we’re often asked.`
- **Intro** — `home_faq_intro` · text (multi-line) · `Can’t see yours? Call {phone_link} or send us a message — we’re happy to help.`  
  > Use {phone_link} for the clinic phone link.
- **Button text** — `home_faq_btn_text` · text · `Ask a question`
- **Button link** — `home_faq_btn_url` · text · `#contact`
- **Questions** — `home_faq_items` · repeater · **8 rows**
  Add the rows in this order (top to bottom = left to right on the page):

  **Row 1**
  - Question (`faq_question`): `Do I need a referral to book an appointment?`
  - Answer (`faq_answer`):

    ```text
    It depends on the service and how your care is funded. Private appointments can be booked online through Nookal. Funded pathways such as Medicare Chronic Condition Management, WorkCover Queensland, Queensland CTP, NDIS and DVA can have their own paperwork or referral requirements, so call {phone} and our team will confirm what applies to you.
    ```

  **Row 2**
  - Question (`faq_question`): `Which service is right for me?`
  - Answer (`faq_answer`):

    ```text
    Physiotherapy suits pain, injury, post-operative recovery and movement limitations. Exercise physiology focuses on clinical exercise for chronic conditions, injury rehabilitation, strength and mobility. Occupational therapy supports independence and everyday function. Clinical Pilates is a Pilates-based approach to rehabilitation and movement. If you are unsure, contact our team and we will point you to the right starting point.
    ```

  **Row 3**
  - Question (`faq_question`): `Which funding pathways are available?`
  - Answer (`faq_answer`):

    ```text
    Our service pages list Private, WorkCover Queensland, Medicare Chronic Condition Management, Queensland CTP, NDIS and DVA Veteran Cards (Gold and White). Availability differs by service. For example, Clinical Pilates is not a standalone funding category and may form part of an eligible Physiotherapy or Exercise Physiology service. Contact us to confirm eligibility before you book.
    ```

  **Row 4**
  - Question (`faq_question`): `Where is the clinic?`
  - Answer (`faq_answer`): `We are at {address}, Brisbane. Use the map on this page for directions.`

  **Row 5**
  - Question (`faq_question`): `Do you offer home visits?`
  - Answer (`faq_answer`):

    ```text
    Physiotherapy and exercise physiology home visits may be available by arrangement across Chermside and surrounding suburbs, subject to location, clinical needs and practitioner availability. Contact our team to enquire.
    ```

  **Row 6**
  - Question (`faq_question`): `Who delivers Clinical Pilates?`
  - Answer (`faq_answer`): `Clinical Pilates at BDYCULTURE is delivered by an Accredited Exercise Physiologist or a Physiotherapist, as part of a rehabilitation and movement approach.`

  **Row 7**
  - Question (`faq_question`): `What happens at a first appointment?`
  - Answer (`faq_answer`):

    ```text
    Your practitioner will talk through your history, goals and concerns, assess how you move and explain the options for your care before anything starts. You will be involved in decisions about your plan. Wear comfortable clothing and bring any referrals, reports or imaging you have.
    ```

  **Row 8**
  - Question (`faq_question`): `How do I refer a patient?`
  - Answer (`faq_answer`):

    ```text
    Email {referrals_email} with the subject line “Patient Referral – BDYCULTURE”, or call {phone}. Visit our Referrers page for the full steps, including secure messaging advice.
    ```


### Tab 11 — Contact band & map (shared)

**Nothing to type here.** The copy for both bands is written once in **BDYCULTURE → Theme Settings → Contact band** and **Map band**, so it is identical on the homepage and every inner page.

This tab only holds two pairs of switches: *Show this section* and *Order* for the band as a whole (fields `home_contact_show` / `home_contact_order` and `home_map_show` / `home_map_order`).

Read it as one list, top to bottom:

- **Show this section** — `home_contact_show` · on/off · **On**
- **Order** — `home_contact_order` · number · `100`  
  > Lower numbers render first.
- **Show this section** — `home_map_show` · on/off · **On**
- **Order** — `home_map_order` · number · `110`  
  > Lower numbers render first.

---

## 4. Not on this page (fill these elsewhere)

These parts of the homepage do **not** live in the Home page tabs — filling them once updates every page:

| What you see | Where it is edited |
| --- | --- |
| Logo, header row, *Enquire* / *Book Online* buttons | BDYCULTURE → Theme Settings → **Header & navigation** |
| Header menu + Services dropdown, footer link columns, legal bar | **Appearance → Menus** (four locations) |
| Phone, emails, address, booking URL, hours, tagline | Theme Settings → **Clinic details** |
| Footer logo, tagline, buttons, credit line, disclaimer | Theme Settings → **Footer** |
| Mobile action bar (Call / Book Online) | Theme Settings → **Mobile action bar** |
| Enquiry card beside inner-page heroes | Theme Settings → **Enquiry card** |
| Contact band + map band copy (the last two bands) | Theme Settings → **Contact band** / **Map band** — one copy for every page |
| Inner page sections | Pages → *(page)* → **1. Page sections** (see `inner-pages-guide.md`) |
| Colours, fonts, sizes, spacing, container width | Appearance → Customize → **Theme Design** |

---

## 5. After saving — 8-point check

1. **Order** — the front page shows hero → marquee → services → consulting room → ribbon → visit us → what to expect → funding → home visits & refer → FAQ → contact band → map band. Any band missing means its `Show this section` is off; either band copy is edited in Theme Settings, not here.
2. **Tokens** — search the page for a literal `{`. There should be none: every `{phone}`, `{email}`, `{address}` should have been replaced.
3. **Services tabs** — clicking a tab on the left swaps the panel on the right; the first tab is open on load.
4. **Consulting room** — *Read more* expands the extra paragraphs; the badge number sits on the photo.
5. **Ribbon** — the photo strip loops without a visible jump or empty half.
6. **FAQ** — one answer open at a time; the arrow rotates.
7. **Contact band** — submitting the form shows the green success state (the fallback form is client-side; paste a Contact Form 7 shortcode in `Form shortcode` to make it live).
8. **Map** — *Load interactive map* reveals the map, the chips fly to each suburb, and Street ⇄ Satellite keeps the place.

### Common mistakes

* **Typing HTML where it is not allowed.** *Text (multi-line)* fields pass `<br>`, `<span>`, `<a>`, `<strong>` and `<em>` through; single-line *text* fields strip tags, so markup there shows up as visible characters.
* **Saving a tab half-filled.** Saved beats default, so an empty saved field renders empty. Finish the tab or do not save it.
* **Reordering rows in the wrong repeater.** Each list controls only its own band; the section order comes from `Order`, not from row order.
* **Uploading images to a text field.** Use the *Add Image* button on image fields so WordPress creates the responsive sizes.
* **Editing the theme files to change copy.** Everything in this guide is editable in the admin; the PHP files only carry the fallback.

---

*Field names in backticks are the technical keys; the bold label is what you see on screen. Guide generated from `defaults.php` — the values here are exactly what the theme renders today.*
