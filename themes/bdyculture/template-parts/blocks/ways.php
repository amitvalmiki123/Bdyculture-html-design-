<?php
/**
 * Block — contact "ways to reach us" cards.
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_items = bdy_b_items( $args );

if ( ! $bdy_items ) {
	return;
}
?>
<section class="section contact-ways">
	<div class="container ways">
		<?php foreach ( $bdy_items as $bdy_item ) : ?>
			<?php $bdy_ico = bdy_b_row( $bdy_item, 'icon' ); ?>
			<a class="way reveal" href="<?php echo esc_url( bdy_link( bdy_b_row( $bdy_item, 'url' ) ) ); ?>"<?php echo ! empty( $bdy_item['new_tab'] ) ? ' target="_blank" rel="noopener"' : ''; ?>>
				<?php if ( $bdy_ico ) : ?>
					<i class="way__ico" aria-hidden="true"><?php echo bdy_icon( $bdy_ico, array( 'size' => 26, 'stroke' => '1.7' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- whitelisted SVG. ?></i>
				<?php endif; ?>
				<b><?php echo esc_html( bdy_b_row( $bdy_item, 'title' ) ); ?></b><span><?php echo esc_html( bdy_b_row( $bdy_item, 'text' ) ); ?></span>
			</a>
		<?php endforeach; ?>
	</div>
</section>
