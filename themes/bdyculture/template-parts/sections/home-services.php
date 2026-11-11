<?php
/**
 * Home — Services stage (tabs + panels).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d      = bdy_section_defaults( 'home', 'services' );
$bdy_tag    = bdy_string( 'home_services_tag', $bdy_d['home_services_tag'] );
$bdy_title  = bdy_html( 'home_services_title', $bdy_d['home_services_title'] );
$bdy_intro  = bdy_html( 'home_services_intro', $bdy_d['home_services_intro'] );
$bdy_panels = bdy_rows( 'home_services_panels', $bdy_d['home_services_panels'] );

if ( ! $bdy_panels ) {
	return;
}
?>
<section class="section services" id="services"<?php echo $bdy_title ? ' aria-labelledby="svc-title"' : ''; ?>>
	<div class="container">
		<?php if ( $bdy_tag || $bdy_title || $bdy_intro ) : ?>
			<header class="section__head reveal">
				<?php if ( $bdy_tag ) : ?>
					<p class="tag"><?php echo esc_html( $bdy_tag ); ?></p>
				<?php endif; ?>
				<?php if ( $bdy_title ) : ?>
					<h2 id="svc-title"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h2>
				<?php endif; ?>
				<?php if ( $bdy_intro ) : ?>
					<p class="section__intro"><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<div class="stage reveal" data-tabs>
			<div class="stage__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Services', 'bdyculture' ); ?>">
				<?php foreach ( $bdy_panels as $bdy_i => $bdy_row ) : ?>
					<?php $bdy_n = $bdy_i + 1; ?>
					<button
						role="tab"
						id="tab-<?php echo (int) $bdy_n; ?>"
						aria-controls="panel-<?php echo (int) $bdy_n; ?>"
						aria-selected="<?php echo 0 === $bdy_i ? 'true' : 'false'; ?>"
						<?php echo 0 === $bdy_i ? '' : 'tabindex="-1"'; ?>
					>
						<i class="tab__ico" aria-hidden="true"><?php echo bdy_icon( isset( $bdy_row['panel_icon'] ) ? $bdy_row['panel_icon'] : '', array( 'size' => 24, 'stroke' => '1.7' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- whitelisted SVG. ?></i>
						<?php echo esc_html( isset( $bdy_row['panel_tab_label'] ) ? $bdy_row['panel_tab_label'] : '' ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<div class="stage__panels">
				<?php foreach ( $bdy_panels as $bdy_i => $bdy_row ) : ?>
					<?php
					$bdy_n     = $bdy_i + 1;
					$bdy_ticks = isset( $bdy_row['panel_ticks'] ) && is_array( $bdy_row['panel_ticks'] ) ? $bdy_row['panel_ticks'] : array();
					$bdy_crop  = '--x:' . ( isset( $bdy_row['panel_img_x'] ) && $bdy_row['panel_img_x'] ? $bdy_row['panel_img_x'] : '50%' )
						. ';--y:' . ( isset( $bdy_row['panel_img_y'] ) && $bdy_row['panel_img_y'] ? $bdy_row['panel_img_y'] : '50%' )
						. ';--s:' . ( isset( $bdy_row['panel_img_scale'] ) && $bdy_row['panel_img_scale'] ? $bdy_row['panel_img_scale'] : '1' );
					?>
					<article class="panel" role="tabpanel" id="panel-<?php echo (int) $bdy_n; ?>" aria-labelledby="tab-<?php echo (int) $bdy_n; ?>"<?php echo 0 === $bdy_i ? '' : ' hidden'; ?>>
						<div class="panel__media" aria-hidden="true">
							<?php
							echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
								isset( $bdy_row['panel_image'] ) ? $bdy_row['panel_image'] : '',
								array(
									'class'      => 'img-crop',
									'fallback'   => 'hero-gym-bright.webp',
									'decorative' => true,
									'attr'       => array( 'style' => $bdy_crop ),
								)
							);
							?>
							<?php if ( ! empty( $bdy_row['panel_chip'] ) ) : ?>
								<span class="panel__chip"><?php echo bdy_row_text( $bdy_row, 'panel_chip' ); ?></span>
							<?php endif; ?>
						</div>

						<div class="panel__body">
							<?php if ( ! empty( $bdy_row['panel_title'] ) ) : ?>
								<h3><?php echo bdy_row_text( $bdy_row, 'panel_title' ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $bdy_row['panel_lead'] ) ) : ?>
								<p class="panel__lead"><?php echo bdy_row_text( $bdy_row, 'panel_lead' ); ?></p>
							<?php endif; ?>

							<?php if ( ! empty( $bdy_row['panel_body'] ) ) : ?>
								<p><?php echo bdy_row_text( $bdy_row, 'panel_body' ); ?></p>
							<?php endif; ?>

							<?php if ( $bdy_ticks ) : ?>
								<ul class="ticks">
									<?php foreach ( $bdy_ticks as $bdy_tick ) : ?>
										<?php if ( ! empty( $bdy_tick['panel_tick_text'] ) ) : ?>
											<li><?php echo esc_html( $bdy_tick['panel_tick_text'] ); ?></li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>

							<div class="panel__btns">
								<?php
								echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
									isset( $bdy_row['panel_btn_1_text'] ) ? $bdy_row['panel_btn_1_text'] : '',
									isset( $bdy_row['panel_btn_1_url'] ) ? $bdy_row['panel_btn_1_url'] : '',
									'signal',
									array( 'icon' => isset( $bdy_row['panel_btn_1_icon'] ) ? $bdy_row['panel_btn_1_icon'] : '' )
								);
								echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
									isset( $bdy_row['panel_btn_2_text'] ) ? $bdy_row['panel_btn_2_text'] : '',
									isset( $bdy_row['panel_btn_2_url'] ) ? $bdy_row['panel_btn_2_url'] : '',
									'outline-light',
									array( 'new_tab' => ! empty( $bdy_row['panel_btn_2_new_tab'] ) )
								);
								?>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
