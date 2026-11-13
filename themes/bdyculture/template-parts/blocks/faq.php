<?php
/**
 * Block — FAQ accordion.
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
$bdy_btn     = bdy_b( $args, 'btn_text' );
$bdy_btn_url = bdy_b( $args, 'btn_url' );
$bdy_items   = bdy_b_items( $args );

if ( ! $bdy_items ) {
	return;
}
?>
<section class="section faq" id="faq" aria-labelledby="faq-title">
	<div class="container faq__grid">
		<header class="faq__head reveal">
			<?php bdy_b_tag( $bdy_tag ); ?>
			<?php if ( $bdy_title ) : ?>
				<h2 id="faq-title"><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_intro ) : ?>
				<p><?php echo bdy_b_body( $bdy_intro ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></p>
			<?php endif; ?>
			<?php if ( $bdy_btn ) : ?>
				<a class="btn btn--ink" href="<?php echo esc_url( bdy_link( $bdy_btn_url ) ); ?>" data-focus-form><?php echo esc_html( $bdy_btn ); ?></a>
			<?php endif; ?>
			<?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?>
		</header>

		<div class="faq__list" data-accordion>
			<?php foreach ( $bdy_items as $bdy_i => $bdy_item ) : ?>
				<details<?php echo ( ! empty( $bdy_item['open'] ) || ( 0 === $bdy_i && ! isset( $bdy_item['open'] ) ) ) ? ' open' : ''; ?>>
					<summary><?php echo esc_html( bdy_b_row( $bdy_item, 'q' ) ); ?></summary>
					<div><?php echo bdy_b_body( bdy_b_row( $bdy_item, 'a' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
