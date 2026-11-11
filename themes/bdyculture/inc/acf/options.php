<?php
/**
 * ACF Options page — the ONE place global sections are managed.
 *
 * Header, navigation, drawer, footer, mobile action bar and every clinic
 * detail live here (Site Settings), so they are maintained once and appear
 * on every page. Requires ACF Pro.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Site Settings options page.
 *
 * @return void
 */
function bdy_register_options_page() {
	if ( ! function_exists( 'acf_add_options_page' ) ) {
		return;
	}

	acf_add_options_page(
		array(
			'page_title' => __( 'Site Settings', 'bdyculture' ),
			'menu_title' => __( 'Site Settings', 'bdyculture' ),
			'menu_slug'  => 'bdyculture-settings',
			'capability' => 'edit_posts',
			'position'   => '59.9',
			'icon_url'   => 'dashicons-admin-site-alt3',
			'redirect'   => false,
			'update_button' => __( 'Save site settings', 'bdyculture' ),
		)
	);
}
add_action( 'acf/init', 'bdy_register_options_page' );
