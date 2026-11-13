<?php
/**
 * Block — compact service links (`.svc-grid--compact`).
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_tag   = bdy_b( $args, 'tag' );
$bdy_title = bdy_b( $args, 'title' );
$bdy_intro = bdy_b( $args, 'intro' );
$bdy_body  = bdy_b( $args, 'body' );
$bdy_items = bdy_b_items( $args );
$bdy_paper = bdy_b_flag( $args, 'paper' );

if ( ! $bdy_items ) {
	return;
}
?>
<section class="section<?php echo $bdy_paper ? ' section--paper' : ''; ?>">
	<div class="container">
		<?php if ( $bdy_tag || $bdy_title || $bdy_intro || $bdy_body ) : ?>
			<header class="section__head reveal">
				<?php bdy_b_tag( $bdy_tag ); ?>
				<?php if ( $bdy_title ) : ?>
					<h2><?php echo esc_html( $bdy_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $bdy_intro ) : ?>
					<p class="section__intro"><?php echo esc_html( $bdy_intro ); ?></p>
				<?php endif; ?>
				<?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?>
			</header>
		<?php endif; ?>

		<div class="svc-grid svc-grid--compact">
			<?php foreach ( $bdy_items as $bdy_item ) : ?>
				<a class="svc-mini reveal" href="<?php echo esc_url( bdy_link( bdy_b_row( $bdy_item, 'url' ) ) ); ?>">
					<b><?php echo esc_html( bdy_b_row( $bdy_item, 'title' ) ); ?></b>
					<span><?php echo esc_html( bdy_b_row( $bdy_item, 'text' ) ); ?></span>
					<i aria-hidden="true">→</i>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>
