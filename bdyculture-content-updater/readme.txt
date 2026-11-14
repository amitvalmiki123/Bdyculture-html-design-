=== BDYCULTURE Content Updater ===
Contributors: bdyculture
Tags: acf, content, import, seed, design
Requires at least: 6.0
Tested up to: 6.5
Requires Plugins: advanced-custom-fields-pro
Stable tag: 1.0.0

Fills all empty ACF fields and Site Settings from the shipped HTML design.
Use once, then deactivate and delete.

== Description ==

This one-shot plugin fills every empty ACF field on all pages and all Site
Settings options from the BDYCULTURE HTML design. It reads the design data
from the BDYCULTURE theme's bdy_defaults() and bdy_page_defaults() functions.

After running, deactivate and delete this plugin — it makes no permanent
changes to the theme.

== What gets filled ==

* Site Settings — clinic details, enquiry card, header, footer, navigation, mobile bar
* Home page — all section show/order toggles and field values
* 10 inner pages — all top-level fields and page_sections flexible content blocks
* Shared bands — contact/map show/order on every page

== What is NOT touched ==

* Image, gallery, file and post-picker fields — design photos ship with the theme
* CF7 form fields — forms live in Contact Form 7, not the theme
* SEO fields — SEO is handled by your SEO plugin

== Installation ==

1. Upload the plugin to /wp-content/plugins/
2. Activate it
3. Go to BDYCULTURE → Content Updater (or Tools → Content Updater)
4. Click "Fill all empty fields from design"
5. Deactivate and delete the plugin

== Changelog ==

= 1.0.0 =
* Initial release
