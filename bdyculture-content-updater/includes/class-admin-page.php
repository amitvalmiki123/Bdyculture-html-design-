<?php
/**
 * BDYCULTURE Content Updater — admin page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BDYCU_Admin_Page {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	public function enqueue_assets( $hook ) {
		if ( 'toplevel_page_bdyculture-content-updater' !== $hook &&
			'admin.php?page=bdyculture-content-updater' !== $hook ) {
			return;
		}
		wp_enqueue_style( 'wp-admin' );
	}

	public function render() {
		?>
		<div class="wrap">
			<h1><?php echo esc_html__( 'BDYCULTURE Content Updater', 'bdyculture-content-updater' ); ?></h1>

			<p><?php echo esc_html__( 'This one-shot tool fills every empty ACF field on all pages and all Site Settings options from the shipped HTML design. After running, deactivate and delete this plugin — it makes no permanent changes to the theme.', 'bdyculture-content-updater' ); ?></p>

			<?php
			if ( ! function_exists( 'acf_get_field' ) ) {
				echo '<div class="notice notice-error"><p>' .
					esc_html__( 'Advanced Custom Fields Pro is not active. Please activate ACF Pro first.', 'bdyculture-content-updater' ) .
					'</p></div>';
				return;
			}

			if ( ! function_exists( 'bdy_defaults' ) || ! function_exists( 'bdy_page_defaults' ) ) {
				echo '<div class="notice notice-error"><p>' .
					esc_html__( 'The BDYCULTURE theme must be active to run the content updater.', 'bdyculture-content-updater' ) .
					'</p></div>';
				return;
			}
			?>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<?php wp_nonce_field( 'bdycu_run_update' ); ?>
				<input type="hidden" name="action" value="bdycu_run_update"/>

				<label>
					<input type="checkbox" name="bdycu_overwrite" value="1"/>
					<?php echo esc_html__( 'Overwrite existing content (replace fields that already have values)', 'bdyculture-content-updater' ); ?>
				</label>

				<p class="description"><?php echo esc_html__( 'Leave unchecked to only fill empty fields. Fields that already have content will be left as-is.', 'bdyculture-content-updater' ); ?></p>

				<?php submit_button( __( 'Fill all empty fields from design', 'bdyculture-content-updater' ), 'primary large', 'bdycu_submit' ); ?>
			</form>

			<?php
			// Show hints about what will be filled.
			echo '<h2>' . esc_html__( 'What gets filled', 'bdyculture-content-updater' ) . '</h2>';
			echo '<ul>';
			echo '<li>' . esc_html__( 'Site Settings — clinic details, enquiry card, header, footer, navigation, mobile bar.', 'bdyculture-content-updater' ) . '</li>';
			echo '<li>' . esc_html__( 'Home page — all section show/order toggles and field values.', 'bdyculture-content-updater' ) . '</li>';
			echo '<li>' . esc_html__( '10 inner pages — all top-level fields and page_sections flexible content blocks.', 'bdyculture-content-updater' ) . '</li>';
			echo '<li>' . esc_html__( 'Shared bands — contact/map show/order on every page.', 'bdyculture-content-updater' ) . '</li>';
			echo '</ul>';

			echo '<h2>' . esc_html__( 'What is NOT touched', 'bdyculture-content-updater' ) . '</h2>';
			echo '<ul>';
			echo '<li>' . esc_html__( 'Image, gallery, file and post-picker fields — design photos ship with the theme; these stay empty so the theme’s fallback photos are used.', 'bdyculture-content-updater' ) . '</li>';
			echo '<li>' . esc_html__( 'CF7 form fields (form_tag, form_shortcode, etc.) — forms live in Contact Form 7, not the theme.', 'bdyculture-content-updater' ) . '</li>';
			echo '<li>' . esc_html__( 'SEO fields (page_meta_description) — SEO is handled by your SEO plugin.', 'bdyculture-content-updater' ) . '</li>';
			echo '</ul>';

			echo '<p>' . esc_html__( 'After the update runs, deactivate and delete this plugin from Plugins → Installed Plugins.', 'bdyculture-content-updater' ) . '</p>';
			?>
		</div>
		<?php
	}
}
