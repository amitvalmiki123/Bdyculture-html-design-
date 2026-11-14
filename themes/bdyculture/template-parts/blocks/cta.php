<?php
/**
 * Block — call-to-action band.
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_title   = bdy_b( $args, 'title' );
$bdy_text    = bdy_b( $args, 'text' );
$bdy_buttons = bdy_b_items( $args, 'buttons' );
?>
<section class="cta-band" aria-labelledby="cta-title">
	<div class="container cta-band__row">
		<div>
			<?php if ( $bdy_title ) : ?>
				<h2 id="cta-title"><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_text ) : ?>
				<p><?php echo esc_html( $bdy_text ); ?></p>
			<?php endif; ?>
		</div>
		<?php if ( $bdy_buttons ) : ?>
			<div class="cta-band__btns">
				<?php bdy_b_buttons( $bdy_buttons ); ?>
			</div>
		<?php endif; ?>
	</div>
</section>
