<?php
/**
 * Mobile drawer — global navigation (managed in Site Settings).
 * Secondary navigation links can be expanded/collapsed with an accessible toggle.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_global  = bdy_defaults( 'global' );
$bdy_nav     = bdy_menu_tree( 'primary', $bdy_global['header_nav'] );
$bdy_book    = bdy_booking_url();
$bdy_book_l  = bdy_string( 'header_book_text', $bdy_global['header_book_text'], 'option' );
$bdy_enq_l   = bdy_string( 'header_drawer_enquire_text', $bdy_global['header_drawer_enquire_text'], 'option' );
$bdy_phone   = bdy_phone_display();
?>
<div class="drawer" id="drawer" aria-hidden="true">
	<nav class="drawer__nav" aria-label="<?php esc_attr_e( 'Mobile', 'bdyculture' ); ?>">
		<?php foreach ( $bdy_nav as $bdy_index => $bdy_item ) : ?>
			<?php
			$bdy_label = isset( $bdy_item['nav_label'] ) ? $bdy_item['nav_label'] : '';
			if ( '' === trim( (string) $bdy_label ) ) {
				continue;
			}
			$bdy_children = isset( $bdy_item['nav_children'] ) && is_array( $bdy_item['nav_children'] ) ? $bdy_item['nav_children'] : array();
			$bdy_href     = bdy_link( isset( $bdy_item['nav_link'] ) ? $bdy_item['nav_link'] : '' );
			$bdy_current  = ! empty( $bdy_item['nav_current'] );
			$bdy_blank    = ! empty( $bdy_item['nav_new_tab'] ) ? ' target="_blank" rel="noopener"' : '';
			$bdy_secondary = array();
			foreach ( $bdy_children as $bdy_child ) {
				if ( ! empty( $bdy_child['child_label'] ) ) {
					$bdy_secondary[] = $bdy_child;
				}
			}
			?>
			<?php if ( $bdy_secondary ) : ?>
				<?php $bdy_sub_id = 'drawer-sub-' . absint( $bdy_index ); ?>
				<div class="drawer__group">
					<div class="drawer__row">
						<a class="drawer__link" href="<?php echo esc_url( $bdy_href ); ?>"<?php echo $bdy_current ? ' aria-current="page"' : ''; ?><?php echo $bdy_blank; // phpcs:ignore WordPress.Security.EscapeOutput -- static attribute string. ?>><?php echo esc_html( $bdy_label ); ?></a>
						<button class="drawer__sub-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $bdy_sub_id ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Show %s submenu', 'bdyculture' ), $bdy_label ) ); ?>" data-show-label="<?php echo esc_attr( sprintf( __( 'Show %s submenu', 'bdyculture' ), $bdy_label ) ); ?>" data-hide-label="<?php echo esc_attr( sprintf( __( 'Hide %s submenu', 'bdyculture' ), $bdy_label ) ); ?>">
							<svg width="18" height="18" viewBox="0 0 18 18" aria-hidden="true"><path d="m4 6 5 5 5-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
						</button>
					</div>
					<div class="drawer__sub" id="<?php echo esc_attr( $bdy_sub_id ); ?>" hidden>
						<?php foreach ( $bdy_secondary as $bdy_child ) : ?>
							<?php
							$bdy_child_blank = ! empty( $bdy_child['child_new_tab'] ) ? ' target="_blank" rel="noopener"' : '';
							$bdy_child_cur   = ! empty( $bdy_child['child_current'] );
							?>
							<a href="<?php echo esc_url( bdy_link( isset( $bdy_child['child_link'] ) ? $bdy_child['child_link'] : '' ) ); ?>"<?php echo $bdy_child_cur ? ' aria-current="page"' : ''; ?><?php echo $bdy_child_blank; // phpcs:ignore WordPress.Security.EscapeOutput -- static attribute string. ?>><?php echo esc_html( $bdy_child['child_label'] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			<?php else : ?>
				<a class="drawer__link" href="<?php echo esc_url( $bdy_href ); ?>"<?php echo $bdy_current ? ' aria-current="page"' : ''; ?><?php echo $bdy_blank; // phpcs:ignore WordPress.Security.EscapeOutput -- static attribute string. ?>><?php echo esc_html( $bdy_label ); ?></a>
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
