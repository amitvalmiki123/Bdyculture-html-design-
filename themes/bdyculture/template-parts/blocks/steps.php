<?php
/**
 * Block — numbered steps (dark band by default, or the light variant).
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
$bdy_buttons = bdy_b_items( $args, 'buttons' );
$bdy_dark    = bdy_b_flag( $args, 'dark' );
$bdy_light   = bdy_b_flag( $args, 'light' );
$bdy_paper   = bdy_b_flag( $args, 'paper' );

if ( ! $bdy_items ) {
	return;
}

$bdy_classes = 'section';
if ( $bdy_dark ) {
	$bdy_classes .= ' section--dark expect has-arcs';
} elseif ( $bdy_paper ) {
	$bdy_classes .= ' section--paper';
}
?>
<section class="<?php echo esc_attr( $bdy_classes ); ?>">
	<div class="container">
		<header class="section__head reveal">
			<?php bdy_b_tag( $bdy_tag, $bdy_dark ); ?>
			<?php if ( $bdy_title ) : ?>
				<h2><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_intro ) : ?>
				<p class="section__intro"><?php echo esc_html( $bdy_intro ); ?></p>
			<?php endif; ?>
			<?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?>
		</header>

		<ol class="steps<?php echo $bdy_light ? ' steps--light' : ''; ?>">
			<?php foreach ( $bdy_items as $bdy_i => $bdy_item ) : ?>
				<li class="reveal">
					<span class="steps__n" aria-hidden="true"><?php echo (int) ( $bdy_i + 1 ); ?></span>
					<h3><?php echo esc_html( bdy_b_row( $bdy_item, 'title' ) ); ?></h3>
					<p><?php echo bdy_b_body( bdy_b_row( $bdy_item, 'text' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></p>
				</li>
			<?php endforeach; ?>
		</ol>

		<?php if ( $bdy_buttons ) : ?>
			<div class="inline-ctas reveal">
				<?php bdy_b_buttons( $bdy_buttons ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
