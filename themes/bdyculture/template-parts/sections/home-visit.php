<?php
/**
 * Home — Visit us (v2 design): clinic signage photos + directions.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d     = bdy_section_defaults( 'home', 'visit' );
$bdy_tag   = bdy_string( 'home_visit_tag', $bdy_d['home_visit_tag'] );
$bdy_title = bdy_string( 'home_visit_title', $bdy_d['home_visit_title'] );
$bdy_text1 = bdy_html( 'home_visit_text_1', $bdy_d['home_visit_text_1'] );
$bdy_text2 = bdy_html( 'home_visit_text_2', $bdy_d['home_visit_text_2'] );

$bdy_main = bdy_image(
	bdy_get( 'home_visit_main_image', '', bdy_context() ),
	array(
		'fallback' => 'shopfront-signage-chermside.jpg',
		'alt'      => bdy_string( 'home_visit_main_alt', $bdy_d['home_visit_main_alt'] ),
		'class'    => 'img-crop',
		'sizes'    => '(min-width: 1100px) 46vw, 100vw',
		'attr'     => array(
			'style' => bdy_crop_style(
				bdy_string( 'home_visit_main_x', $bdy_d['home_visit_main_x'] ),
				bdy_string( 'home_visit_main_y', $bdy_d['home_visit_main_y'] ),
				bdy_string( 'home_visit_main_scale', $bdy_d['home_visit_main_scale'] )
			),
		),
	)
);

$bdy_door = bdy_image(
	bdy_get( 'home_visit_door_image', '', bdy_context() ),
	array(
		'fallback' => 'clinic-door-signage.png',
		'alt'      => bdy_string( 'home_visit_door_alt', $bdy_d['home_visit_door_alt'] ),
		'sizes'    => '220px',
	)
);

if ( ! $bdy_title && ! $bdy_main ) {
	return;
}
?>
<section class="section section--paper visit" id="visit" aria-labelledby="visit-title">
	<div class="container visit__grid">
		<?php if ( $bdy_main || $bdy_door ) : ?>
			<div class="visit__photos reveal">
				<?php if ( $bdy_main ) : ?>
					<figure class="visit__main media-frame--swept"><?php echo $bdy_main; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper. ?></figure>
				<?php endif; ?>
				<?php if ( $bdy_door ) : ?>
					<figure class="visit__door"><?php echo $bdy_door; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper. ?></figure>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="visit__copy">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag reveal"><?php echo esc_html( $bdy_tag ); ?></p>
			<?php endif; ?>

			<?php if ( $bdy_title ) : ?>
				<h2 id="visit-title" class="reveal"><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>

			<?php if ( $bdy_text1 ) : ?>
				<p class="reveal"><?php echo $bdy_text1; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post + tokens. ?></p>
			<?php endif; ?>

			<?php if ( $bdy_text2 ) : ?>
				<p class="reveal"><?php echo $bdy_text2; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post + tokens. ?></p>
			<?php endif; ?>

			<div class="inline-ctas reveal">
				<?php
				echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					bdy_string( 'home_visit_cta_1_text', $bdy_d['home_visit_cta_1_text'] ),
					bdy_string( 'home_visit_cta_1_url', $bdy_d['home_visit_cta_1_url'] ),
					bdy_choice( 'home_visit_cta_1_style', $bdy_d['home_visit_cta_1_style'], array( 'signal', 'ink', 'ghost', 'light', 'outline-light' ) ),
					array( 'size' => 'lg', 'new_tab' => true )
				);

				echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					bdy_string( 'home_visit_cta_2_text', $bdy_d['home_visit_cta_2_text'] ),
					bdy_string( 'home_visit_cta_2_url', $bdy_d['home_visit_cta_2_url'] ),
					bdy_choice( 'home_visit_cta_2_style', $bdy_d['home_visit_cta_2_style'], array( 'signal', 'ink', 'ghost', 'light', 'outline-light' ) ),
					array( 'size' => 'lg', 'new_tab' => true )
				);
				?>
			</div>
		</div>
	</div>
</section>
