<?php
/**
 * Block — suburb list (location page).
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
$bdy_note  = bdy_b( $args, 'note' );
$bdy_items = bdy_b_items( $args );
?>
<section class="section<?php echo bdy_b_flag( $args, 'paper' ) ? ' section--paper' : ''; ?>">
	<div class="container">
		<header class="section__head reveal">
			<?php bdy_b_tag( $bdy_tag ); ?>
			<?php if ( $bdy_title ) : ?>
				<h2><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_intro ) : ?>
				<p class="section__intro"><?php echo esc_html( $bdy_intro ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $bdy_body ) : ?>
			<div class="prose prose--wide"><?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></div>
		<?php endif; ?>

		<?php if ( $bdy_items ) : ?>
			<ul class="suburbs reveal">
				<?php foreach ( $bdy_items as $bdy_item ) : ?>
					<li><?php echo esc_html( is_array( $bdy_item ) ? bdy_b_row( $bdy_item, 'text' ) : $bdy_item ); ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<?php if ( $bdy_note ) : ?>
			<p class="ph-note"><?php echo esc_html( $bdy_note ); ?></p>
		<?php endif; ?>
	</div>
</section>
