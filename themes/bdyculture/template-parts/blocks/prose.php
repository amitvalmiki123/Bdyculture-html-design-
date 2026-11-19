<?php
/**
 * Block — rich-text section (privacy policy, notices).
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_body = bdy_b( $args, 'body' );
$bdy_tag  = bdy_b( $args, 'tag' );
$bdy_title = bdy_b( $args, 'title' );
$bdy_legal = 'legal' === bdy_b( $args, 'variant' );

if ( '' === trim( (string) $bdy_body ) && ! $bdy_title ) {
	return;
}
?>
<section class="section<?php echo bdy_b_flag( $args, 'paper' ) ? ' section--paper' : ''; ?>">
	<div class="container">
		<?php if ( $bdy_title ) : ?>
			<header class="section__head reveal">
				<?php bdy_b_tag( $bdy_tag ); ?>
				<h2><?php echo esc_html( $bdy_title ); ?></h2>
			</header>
		<?php endif; ?>
		<div class="<?php echo $bdy_legal ? 'legal' : 'prose'; ?>"><?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></div>
	</div>
</section>
