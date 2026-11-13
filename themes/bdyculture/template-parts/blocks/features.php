<?php
/**
 * Block — feature cards (`.feature-grid`, optional `--four` layout).
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_tag     = bdy_b( $args, 'tag' );
$bdy_title   = bdy_b( $args, 'title' );
$bdy_intro   = bdy_b( $args, 'intro' );
$bdy_body    = bdy_b( $args, 'body' );
$bdy_items   = bdy_b_items( $args );
$bdy_paper   = bdy_b_flag( $args, 'paper' );
$bdy_four    = 'four' === bdy_b( $args, 'variant' );

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

		<div class="feature-grid<?php echo $bdy_four ? ' feature-grid--four' : ''; ?>">
			<?php foreach ( $bdy_items as $bdy_item ) : ?>
				<?php $bdy_ico = bdy_b_row( $bdy_item, 'icon' ); ?>
				<article class="feature reveal">
					<?php if ( $bdy_ico ) : ?>
						<i class="feature__ico" aria-hidden="true"><?php echo bdy_icon( $bdy_ico, array( 'size' => 26, 'stroke' => '1.7' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- whitelisted SVG. ?></i>
					<?php endif; ?>
					<h3><?php echo esc_html( bdy_b_row( $bdy_item, 'title' ) ); ?></h3>
					<p><?php echo esc_html( bdy_b_row( $bdy_item, 'text' ) ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
