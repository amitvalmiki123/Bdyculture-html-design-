<?php
/**
 * Site footer + sticky mobile bar (Rules 13, 14).
 *
 * Global content managed once in Site Settings.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_global    = bdy_defaults( 'global' );
$bdy_cols      = bdy_footer_columns( $bdy_global['footer_columns'] );
$bdy_logo      = bdy_option( 'footer_logo' );
$bdy_tagline   = bdy_html( 'footer_tagline', $bdy_global['footer_tagline'], 'option' );
$bdy_book      = bdy_booking_url();
$bdy_cta_text  = bdy_string( 'footer_cta_text', bdy_string( 'header_book_text', $bdy_global['header_book_text'], 'option' ), 'option' );
$bdy_cta_url   = bdy_string( 'footer_cta_url', '', 'option' );
$bdy_privacy_t = bdy_string( 'footer_privacy_text', $bdy_global['footer_privacy_text'], 'option' );
$bdy_privacy_u = bdy_string( 'footer_privacy_url', $bdy_global['footer_privacy_url'], 'option' );
$bdy_phone     = bdy_phone_display();
$bdy_mbar_call = bdy_string( 'mobile_bar_call_text', $bdy_global['mobile_bar_call_text'], 'option' );
$bdy_mbar_book = bdy_string( 'mobile_bar_book_text', $bdy_global['mobile_bar_book_text'], 'option' );
$bdy_cta_href  = $bdy_cta_url ? $bdy_cta_url : $bdy_book;
?>
</main>

<footer class="site-footer">
	<div class="container footer__grid">
		<div class="footer__brand">
			<?php
			echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				$bdy_logo,
				array(
					'fallback' => 'logo-white.png',
					'alt'      => get_bloginfo( 'name' ),
				)
			);
			?>
			<?php if ( $bdy_tagline ) : ?>
				<p><?php echo bdy_tokens( wp_kses_post( $bdy_tagline ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses + tokens. ?></p>
			<?php endif; ?>
			<?php if ( $bdy_cta_href && $bdy_cta_text ) : ?>
				<a class="btn btn--signal" href="<?php echo esc_url( $bdy_cta_href ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $bdy_cta_text ); ?></a>
			<?php endif; ?>
		</div>

		<?php foreach ( $bdy_cols as $bdy_col ) : ?>
			<?php
			$bdy_col_title = isset( $bdy_col['col_title'] ) ? $bdy_col['col_title'] : '';
			$bdy_col_text  = isset( $bdy_col['col_text'] ) ? bdy_tokens( wp_kses_post( $bdy_col['col_text'] ) ) : '';
			$bdy_links     = isset( $bdy_col['col_links'] ) && is_array( $bdy_col['col_links'] ) ? $bdy_col['col_links'] : array();
			$bdy_has_text  = '' !== trim( wp_strip_all_tags( $bdy_col_text ) );
			$bdy_tag       = $bdy_has_text ? 'div' : 'nav';
			?>
			<<?php echo esc_attr( $bdy_tag ); ?> class="footer__col"<?php echo $bdy_has_text ? '' : ' aria-label="' . esc_attr( wp_strip_all_tags( $bdy_col_title ) ) . '"'; ?>>
				<?php if ( $bdy_col_title ) : ?>
					<h2><?php echo esc_html( $bdy_col_title ); ?></h2>
				<?php endif; ?>

				<?php if ( $bdy_has_text ) : ?>
					<address><?php echo $bdy_col_text; // phpcs:ignore WordPress.Security.EscapeOutput -- kses + tokens. ?></address>
				<?php endif; ?>

				<?php foreach ( $bdy_links as $bdy_link ) : ?>
					<?php
					$bdy_label = isset( $bdy_link['link_label'] ) ? bdy_tokens( esc_html( $bdy_link['link_label'] ), false ) : '';
					$bdy_value = isset( $bdy_link['link_url'] ) ? bdy_tokens( (string) $bdy_link['link_url'], false ) : '';
					$bdy_type  = isset( $bdy_link['link_type'] ) ? $bdy_link['link_type'] : 'link';

					if ( '' === trim( (string) $bdy_label ) ) {
						continue;
					}

					if ( 'tel' === $bdy_type ) {
						$bdy_href = 'tel:' . preg_replace( '/[^0-9+]/', '', $bdy_value );
					} elseif ( 'email' === $bdy_type ) {
						$bdy_href = 'mailto:' . $bdy_value;
					} else {
						$bdy_href = bdy_link( $bdy_value );
					}
					?>
					<a href="<?php echo esc_url( $bdy_href ); ?>"><?php echo $bdy_label; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above, tokens expanded after escaping. ?></a>
				<?php endforeach; ?>
			</<?php echo esc_attr( $bdy_tag ); ?>>
		<?php endforeach; ?>
	</div>

	<div class="container footer__bar">
		<p><?php echo esc_html( bdy_string( 'footer_copyright', $bdy_global['footer_copyright'], 'option' ) ); ?></p>
		<?php if ( $bdy_privacy_t && $bdy_privacy_u ) : ?>
			<p><a href="<?php echo esc_url( bdy_link( $bdy_privacy_u ) ); ?>"><?php echo esc_html( $bdy_privacy_t ); ?></a></p>
		<?php endif; ?>
		<p class="footer__credit"><?php echo bdy_tokens( esc_html( bdy_string( 'footer_credit', $bdy_global['footer_credit'], 'option' ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped, then {credit_link} expanded. ?></p>
		<p class="footer__note"><?php echo esc_html( bdy_string( 'footer_note', $bdy_global['footer_note'], 'option' ) ); ?></p>
	</div>
</footer>

<?php if ( $bdy_phone || $bdy_book ) : ?>
	<div class="mobile-bar" role="group" aria-label="<?php esc_attr_e( 'Quick actions', 'bdyculture' ); ?>">
		<?php if ( $bdy_phone ) : ?>
			<a class="mobile-bar__call" href="<?php echo esc_url( 'tel:' . bdy_phone_number() ); ?>">
				<?php echo bdy_phone_svg(); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?>
				<?php echo esc_html( $bdy_mbar_call ); ?>
			</a>
		<?php endif; ?>
		<?php if ( $bdy_book ) : ?>
			<a class="mobile-bar__book" href="<?php echo esc_url( $bdy_book ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $bdy_mbar_book ); ?></a>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
