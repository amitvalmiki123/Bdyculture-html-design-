<?php
/**
 * Home — Interactive map (Leaflet, lazy-loaded by main.js).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d       = bdy_section_defaults( 'home', 'map' );
$bdy_tag     = bdy_string( 'home_map_tag', $bdy_d['home_map_tag'] );
$bdy_title   = bdy_string( 'home_map_title', $bdy_d['home_map_title'] );
$bdy_chips   = bdy_rows( 'home_map_chips', $bdy_d['home_map_chips'] );
$bdy_card    = bdy_html( 'home_map_card_text', $bdy_d['home_map_card_text'] );
$bdy_lat     = bdy_string( 'home_map_lat', $bdy_d['home_map_lat'] );
$bdy_lng     = bdy_string( 'home_map_lng', $bdy_d['home_map_lng'] );
$bdy_zoom    = bdy_string( 'home_map_zoom', $bdy_d['home_map_zoom'] );
$bdy_btn_1   = bdy_string( 'home_map_btn_1_text', $bdy_d['home_map_btn_1_text'] );
$bdy_btn_2   = bdy_string( 'home_map_btn_2_text', $bdy_d['home_map_btn_2_text'] );
?>
<section class="mapsec" id="map"<?php echo $bdy_title ? ' aria-labelledby="map-title"' : ''; ?>>
	<div class="container">
		<header class="mapsec__head reveal">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag"><?php echo esc_html( $bdy_tag ); ?></p>
			<?php endif; ?>
			<?php if ( $bdy_title ) : ?>
				<h2 id="map-title"><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
		</header>

		<div class="mapbox reveal">
			<div class="mapbox__map" id="clinic-map" role="region" aria-label="<?php esc_attr_e( 'Interactive map of BDYCULTURE, Chermside', 'bdyculture' ); ?>" data-lat="<?php echo esc_attr( $bdy_lat ); ?>" data-lng="<?php echo esc_attr( $bdy_lng ); ?>" data-zoom="<?php echo esc_attr( $bdy_zoom ); ?>">
				<button class="mapbox__load" type="button" data-load-map><?php echo esc_html( bdy_string( 'home_map_load_label', $bdy_d['home_map_load_label'] ) ); ?></button>
			</div>

			<div class="mapbox__card">
				<span class="mapbox__pin" aria-hidden="true"></span>
				<?php if ( bdy_string( 'home_map_card_title', $bdy_d['home_map_card_title'] ) ) : ?>
					<h3><?php echo esc_html( bdy_string( 'home_map_card_title', $bdy_d['home_map_card_title'] ) ); ?></h3>
				<?php endif; ?>
				<?php if ( $bdy_card ) : ?>
					<p><?php echo $bdy_card; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
				<?php endif; ?>

				<?php if ( $bdy_chips ) : ?>
					<div class="chips" role="group" aria-label="<?php esc_attr_e( 'Explore the area around the clinic', 'bdyculture' ); ?>">
						<?php if ( bdy_string( 'home_map_chips_label', $bdy_d['home_map_chips_label'] ) ) : ?>
							<span class="chips__label"><?php echo esc_html( bdy_string( 'home_map_chips_label', $bdy_d['home_map_chips_label'] ) ); ?></span>
						<?php endif; ?>
						<?php foreach ( $bdy_chips as $bdy_i => $bdy_row ) : ?>
							<?php
							if ( empty( $bdy_row['chip_label'] ) ) {
								continue;
							}
							$bdy_fly = ( isset( $bdy_row['chip_lat'] ) ? $bdy_row['chip_lat'] : $bdy_lat ) . ',' . ( isset( $bdy_row['chip_lng'] ) ? $bdy_row['chip_lng'] : $bdy_lng ) . ',' . ( ! empty( $bdy_row['chip_zoom'] ) ? $bdy_row['chip_zoom'] : $bdy_zoom );
							?>
							<button type="button" class="chip<?php echo 0 === $bdy_i ? ' is-on' : ''; ?>" data-fly="<?php echo esc_attr( $bdy_fly ); ?>"><?php echo bdy_row_text( $bdy_row, 'chip_label' ); ?></button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<div class="mapbox__btns">
					<?php
					if ( $bdy_btn_1 ) {
						echo bdy_button( $bdy_btn_1, bdy_string( 'home_map_btn_1_url', $bdy_d['home_map_btn_1_url'] ), 'ink', array( 'new_tab' => true ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					}
					if ( $bdy_btn_2 ) {
						echo bdy_button( $bdy_btn_2, bdy_string( 'home_map_btn_2_url', $bdy_d['home_map_btn_2_url'] ), 'ghost' ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
