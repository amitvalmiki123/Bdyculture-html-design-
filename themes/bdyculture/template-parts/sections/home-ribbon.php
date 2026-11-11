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
		<?php foreach ( $bdy_images as $bdy_row ) : ?>
			<?php
			$bdy_crop = '--x:' . ( ! empty( $bdy_row['ribbon_x'] ) ? $bdy_row['ribbon_x'] : '50%' )
				. ';--y:' . ( ! empty( $bdy_row['ribbon_y'] ) ? $bdy_row['ribbon_y'] : '50%' )
				. ';--s:' . ( ! empty( $bdy_row['ribbon_scale'] ) ? $bdy_row['ribbon_scale'] : '1' );
			$bdy_class = empty( $bdy_row['ribbon_swept'] ) ? '' : ' media-frame--swept';
			?>
			<figure class="<?php echo esc_attr( trim( $bdy_class ) ); ?>">
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
		<?php endforeach; ?>
	</div>
</section>
