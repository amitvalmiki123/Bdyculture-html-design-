<?php
/**
 * Home — Services marquee (decorative).
 *
 * The track is printed three times so the CSS keyframe (-33.3333%) loops
 * seamlessly, exactly as in the original design.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d     = bdy_section_defaults( 'home', 'marquee' );
$bdy_items = bdy_rows( 'home_marquee_items', $bdy_d['home_marquee_items'] );

if ( ! $bdy_items ) {
	return;
}
?>
<div class="marquee" aria-hidden="true">
	<div class="marquee__track">
		<?php for ( $bdy_pass = 0; $bdy_pass < 3; $bdy_pass++ ) : ?>
			<?php foreach ( $bdy_items as $bdy_row ) : ?>
				<?php if ( empty( $bdy_row['marquee_item_text'] ) ) : ?>
					<?php continue; ?>
				<?php endif; ?>
				<span><?php echo esc_html( $bdy_row['marquee_item_text'] ); ?></span><i></i>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</div>
