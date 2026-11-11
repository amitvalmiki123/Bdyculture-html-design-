<?php
/**
 * Mobile drawer — global navigation (managed in Site Settings).
 *
 * Secondary drop-down links (marked "Secondary link") appear in the desktop
 * drop-down only, exactly like the original design.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_global  = bdy_defaults( 'global' );
$bdy_nav     = bdy_rows( 'header_nav', $bdy_global['header_nav'], 'option' );
$bdy_book    = bdy_booking_url();
$bdy_book_l  = bdy_string( 'header_book_text', $bdy_global['header_book_text'], 'option' );
$bdy_enq_l   = bdy_string( 'header_drawer_enquire_text', $bdy_global['header_drawer_enquire_text'], 'option' );
$bdy_phone   = bdy_phone_display();
?>
<div class="drawer" id="drawer" aria-hidden="true">
	<nav class="drawer__nav" aria-label="<?php esc_attr_e( 'Mobile', 'bdyculture' ); ?>">
		<?php foreach ( $bdy_nav as $bdy_item ) : ?>
			<?php
			$bdy_label = isset( $bdy_item['nav_label'] ) ? $bdy_item['nav_label'] : '';
			if ( '' === trim( (string) $bdy_label ) ) {
				continue;
			}
			$bdy_children = isset( $bdy_item['nav_children'] ) && is_array( $bdy_item['nav_children'] ) ? $bdy_item['nav_children'] : array();
			$bdy_href     = bdy_link( isset( $bdy_item['nav_link'] ) ? $bdy_item['nav_link'] : '' );
			?>
			<a href="<?php echo esc_url( $bdy_href ); ?>"><?php echo esc_html( $bdy_label ); ?></a>

			<?php
			$bdy_secondary = array();
			foreach ( $bdy_children as $bdy_child ) {
				if ( empty( $bdy_child['child_alt'] ) && ! empty( $bdy_child['child_label'] ) ) {
					$bdy_secondary[] = $bdy_child;
				}
			}
			?>
			<?php if ( $bdy_secondary ) : ?>
				<div class="drawer__sub">
					<?php foreach ( $bdy_secondary as $bdy_child ) : ?>
						<a href="<?php echo esc_url( bdy_link( isset( $bdy_child['child_link'] ) ? $bdy_child['child_link'] : '' ) ); ?>"><?php echo esc_html( $bdy_child['child_label'] ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</nav>

	<div class="drawer__cta">
		<?php if ( $bdy_book && $bdy_book_l ) : ?>
			<a class="btn btn--signal btn--block" href="<?php echo esc_url( $bdy_book ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $bdy_book_l ); ?></a>
		<?php endif; ?>

		<?php if ( $bdy_phone ) : ?>
			<a class="btn btn--light btn--block" href="<?php echo esc_url( 'tel:' . bdy_phone_number() ); ?>"><?php echo esc_html( sprintf( __( 'Call %s', 'bdyculture' ), $bdy_phone ) ); ?></a>
		<?php endif; ?>

		<?php if ( $bdy_enq_l ) : ?>
			<a class="btn btn--outline-light btn--block" href="<?php echo esc_url( is_front_page() ? '#enquire' : home_url( '/#enquire' ) ); ?>" data-focus-form><?php echo esc_html( $bdy_enq_l ); ?></a>
		<?php endif; ?>
	</div>
</div>
