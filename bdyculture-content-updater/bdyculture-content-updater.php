<?php
/**
 * Plugin Name: BDYCULTURE Content Updater
 * Plugin URI: https://www.bdyculture.com.au/
 * Description: Fills all empty ACF fields and Site Settings from the HTML design content. Use once, then deactivate and delete.
 * Version: 1.1.0
 * Author: BDYCULTURE
 * Text Domain: bdyculture-content-updater
 * Requires Plugins: advanced-custom-fields-pro
 * Requires at least: 6.0
 * Tested up to: 6.5
 */

/*
 * BDYCULTURE Content Updater
 *
 * A one-shot plugin that fills every empty ACF field on all pages and all
 * Site Settings options from the shipped HTML design. After running,
 * deactivate and delete this plugin — it makes no permanent changes to the
 * theme.
 *
 * Requires the BDYCULTURE theme to be active (it reads design data from the
 * theme's bdy_defaults() and bdy_page_defaults() functions).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BDYCU_VERSION', '1.1.0' );
define( 'BDYCU_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BDYCU_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

require_once BDYCU_PLUGIN_DIR . 'includes/class-content-updater.php';
require_once BDYCU_PLUGIN_DIR . 'includes/class-admin-page.php';

/**
 * Only load in the admin area.
 */
add_action( 'plugins_loaded', 'bdycu_init' );

function bdycu_init() {
	if ( ! is_admin() ) {
		return;
	}

	new BDYCU_Admin_Page();
}

/**
 * Admin menu entry.
 *
 * Keeps the utility under Tools so it remains available regardless of theme menu registration.
 */
add_action( 'admin_menu', 'bdycu_admin_menu' );

function bdycu_admin_menu() {
	// Always place under Tools so it works regardless of theme activation state.
	add_submenu_page(
		'tools.php',
		__( 'BDYCULTURE Content Updater', 'bdyculture-content-updater' ),
		__( 'Content Updater', 'bdyculture-content-updater' ),
		'manage_options',
		'bdyculture-content-updater',
		'bdycu_admin_page_render'
	);
}

/**
 * Admin page callback.
 */
function bdycu_admin_page_render() {
	$page = new BDYCU_Admin_Page();
	$page->render();
}

/**
 * Handle the run-update form submission.
 */
add_action( 'admin_post_bdycu_run_update', 'bdycu_handle_run_update' );
add_action( 'admin_post_nopriv_bdycu_run_update', 'bdycu_handle_run_update' );

function bdycu_handle_run_update() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( __( 'Unauthorized', 'bdyculture-content-updater' ) );
	}

	check_admin_referer( 'bdycu_run_update' );

	$overwrite = ! empty( $_POST['bdycu_overwrite'] );

	$updater = new BDYCU_Content_Updater();
	$report  = $updater->run( $overwrite );

	$url = add_query_arg( array(
		'page'       => 'bdyculture-content-updater',
		'bdycu_done' => '1',
		'bdycu_ok'   => $report['ok'] ? '1' : '0',
		'bdycu_msg'  => urlencode( $report['message'] ),
	), admin_url( 'admin.php' ) );

	wp_redirect( $url );
	exit;
}

/**
 * Deactivation notice.
 */
register_deactivation_hook( __FILE__, 'bdycu_deactivate' );

function bdycu_deactivate() {
	add_option( 'bdycu_deactivation_notice', true );
}

add_action( 'admin_notices', 'bdycu_admin_notices' );

function bdycu_admin_notices() {
	if ( get_option( 'bdycu_deactivation_notice' ) ) {
		delete_option( 'bdycu_deactivation_notice' );
		echo '<div class="notice notice-info is-dismissible"><p>' .
			esc_html__( 'BDYCULTURE Content Updater deactivated. You can now delete this plugin — it is no longer needed.', 'bdyculture-content-updater' ) .
			'</p></div>';
	}

	if ( ! empty( $_GET['bdycu_done'] ) ) {
		$ok    = ! empty( $_GET['bdycu_ok'] );
		$msg   = isset( $_GET['bdycu_msg'] ) ? urldecode( $_GET['bdycu_msg'] ) : '';
		$type  = $ok ? 'notice-success' : 'notice-error';
		echo '<div class="notice ' . esc_attr( $type ) . ' is-dismissible"><p>' .
			esc_html( $msg ) .
			'</p></div>';
	}
}
