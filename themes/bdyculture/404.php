<?php
/**
 * 404 template.
 *
 * The supplied design package has no 404 screen, so this reuses the existing
 * inner-page design language (page-hero scale + one body band) and the same
 * button styles. No new visual language is introduced.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<section class="page-hero page-404" aria-labelledby="page-title">
	<div class="container page-hero__inner">
		<p class="tag"><?php esc_html_e( 'Error 404', 'bdyculture' ); ?></p>
		<h1 id="page-title"><?php esc_html_e( 'That page has moved out of range.', 'bdyculture' ); ?></h1>
		<p class="lead"><?php esc_html_e( 'The page you were looking for is not here. You can head back to the homepage, book online, or call the clinic and we will point you in the right direction.', 'bdyculture' ); ?></p>
	</div>
</section>

<section class="section section--page">
	<div class="container">
		<div class="page-404__actions">
			<?php
			echo bdy_button( __( 'Back to home', 'bdyculture' ), home_url( '/' ), 'ink' ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
			echo bdy_button( __( 'Book Online', 'bdyculture' ), bdy_booking_url(), 'signal', array( 'icon' => 'arrow', 'new_tab' => true ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
			echo bdy_button( sprintf( __( 'Call %s', 'bdyculture' ), bdy_phone_display() ), 'tel:' . bdy_phone_number(), 'ghost', array( 'icon' => 'phone' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
			?>
		</div>
	</div>
</section>
<?php
get_footer();
