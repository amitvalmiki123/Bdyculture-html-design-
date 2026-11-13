<?php
/**
 * Home — Photo ribbon (decorative marquee of photos).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d      = bdy_section_defaults( 'home', 'ribbon' );
$bdy_images = bdy_rows( 'home_ribbon_images', $bdy_d['home_ribbon_images'] );

if ( ! $bdy_images ) {
	return;
}
?>
<section class="ribbon" aria-hidden="true">
	<div class="ribbon__track">
		<?php
		// The marquee needs two identical halves: the CSS animation moves the
		// track by -50%. Rendering both halves here keeps the images in the
		// document (no JS clone, no reload, no missing photos).
		for ( $bdy_pass = 0; $bdy_pass < 2; $bdy_pass++ ) :
			foreach ( $bdy_images as $bdy_row ) :
				?>
			<?php
			$bdy_crop = bdy_crop_style(
				isset( $bdy_row['ribbon_x'] ) ? $bdy_row['ribbon_x'] : '',
				isset( $bdy_row['ribbon_y'] ) ? $bdy_row['ribbon_y'] : '',
				isset( $bdy_row['ribbon_scale'] ) ? $bdy_row['ribbon_scale'] : ''
			);
			$bdy_class = empty( $bdy_row['ribbon_swept'] ) ? '' : ' class="media-frame--swept"';
			?>
			<figure<?php echo $bdy_class; // phpcs:ignore WordPress.Security.EscapeOutput -- static class string. ?>>
				<?php
				echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					isset( $bdy_row['ribbon_image'] ) ? $bdy_row['ribbon_image'] : '',
					array(
						'class'      => 'img-crop',
						'fallback'   => 'hero-gym-bright.webp',
						'decorative' => true,
						'attr'       => array( 'style' => $bdy_crop ),
					)
				);
				?>
			</figure>
			<?php
			endforeach;
		endfor;
		?>
	</div>
</section>
