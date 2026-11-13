<?php
/**
 * Block — funding pathways.
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
<section class="section<?php echo $bdy_paper ? ' section--paper' : ''; ?> funding">
	<div class="container funding__grid">
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

		<ul class="pathways">
			<?php foreach ( $bdy_items as $bdy_item ) : ?>
				<li class="reveal">
					<b><?php echo esc_html( bdy_b_row( $bdy_item, 'title' ) ); ?></b>
					<span><?php echo esc_html( bdy_b_row( $bdy_item, 'text' ) ); ?></span>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</section>
