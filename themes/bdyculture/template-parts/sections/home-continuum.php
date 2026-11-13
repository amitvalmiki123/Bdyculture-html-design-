<?php
/**
 * Home — "More than a consulting room" (photo + copy + steps + expandable).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d        = bdy_section_defaults( 'home', 'continuum' );
$bdy_tag      = bdy_string( 'home_continuum_tag', $bdy_d['home_continuum_tag'] );
$bdy_title    = bdy_html( 'home_continuum_title', $bdy_d['home_continuum_title'] );
$bdy_intro    = bdy_html( 'home_continuum_intro', $bdy_d['home_continuum_intro'] );
$bdy_caption  = bdy_html( 'home_continuum_caption', $bdy_d['home_continuum_caption'] );
$bdy_steps    = bdy_rows( 'home_continuum_steps', $bdy_d['home_continuum_steps'] );
$bdy_paras    = bdy_rows( 'home_continuum_paragraphs', $bdy_d['home_continuum_paragraphs'] );
$bdy_badge_n  = bdy_string( 'home_continuum_badge_number', $bdy_d['home_continuum_badge_number'] );
$bdy_badge_t  = bdy_html( 'home_continuum_badge_text', $bdy_d['home_continuum_badge_text'] );
$bdy_alt      = bdy_string( 'home_continuum_photo_alt', $bdy_d['home_continuum_photo_alt'] );
$bdy_inset    = bdy_crop_style(
	bdy_string( 'home_continuum_inset_x', $bdy_d['home_continuum_inset_x'] ),
	bdy_string( 'home_continuum_inset_y', $bdy_d['home_continuum_inset_y'] ),
	bdy_string( 'home_continuum_inset_scale', $bdy_d['home_continuum_inset_scale'] )
);
?>
<section class="section continuum" id="clinic"<?php echo $bdy_title ? ' aria-labelledby="cont-title"' : ''; ?>>
	<div class="container continuum__grid">
		<figure class="continuum__photo reveal-clip">
			<?php
			echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				bdy_get( 'home_continuum_photo', '', bdy_context() ),
				array(
					'fallback' => $bdy_d['home_continuum_photo'],
					'alt'      => $bdy_alt,
					'sizes'    => '(min-width: 1100px) 46vw, 100vw',
					'srcset'   => 'gym-chermside-960.jpg 960w, gym-chermside-1920.jpg 1920w',
					'attr'     => array(
						'style' => bdy_focus_style(
							bdy_string( 'home_continuum_photo_x', $bdy_d['home_continuum_photo_x'] ),
							bdy_string( 'home_continuum_photo_y', $bdy_d['home_continuum_photo_y'] ),
							bdy_string( 'home_continuum_photo_scale', $bdy_d['home_continuum_photo_scale'] )
						),
					),
				)
			);
			?>
			<?php if ( $bdy_caption ) : ?>
				<figcaption><span class="dot" aria-hidden="true"></span> <?php echo $bdy_caption; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></figcaption>
			<?php endif; ?>
			<span class="continuum__inset media-frame--swept" aria-hidden="true">
				<?php
				echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					bdy_get( 'home_continuum_inset', '', bdy_context() ),
					array(
						'class'      => 'img-crop',
						'fallback'   => $bdy_d['home_continuum_inset'],
						'sizes'      => '300px',
						'decorative' => true,
						'attr'       => array( 'style' => $bdy_inset ),
					)
				);
				?>
			</span>
			<?php if ( $bdy_badge_n || $bdy_badge_t ) : ?>
				<span class="continuum__badge" aria-hidden="true">
					<?php if ( $bdy_badge_n ) : ?>
						<b><?php echo esc_html( $bdy_badge_n ); ?></b>
					<?php endif; ?>
					<?php echo $bdy_badge_t; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?>
				</span>
			<?php endif; ?>
		</figure>

		<div class="continuum__copy">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag reveal"><?php echo esc_html( $bdy_tag ); ?></p>
			<?php endif; ?>

			<?php if ( $bdy_title ) : ?>
				<h2 id="cont-title" class="reveal"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h2>
			<?php endif; ?>

			<?php if ( $bdy_intro ) : ?>
				<p class="reveal"><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php if ( $bdy_steps ) : ?>
				<ol class="range-steps reveal">
					<?php foreach ( $bdy_steps as $bdy_row ) : ?>
						<li>
							<i class="rs-ico" aria-hidden="true"><?php echo bdy_icon( isset( $bdy_row['continuum_step_icon'] ) ? $bdy_row['continuum_step_icon'] : '', array( 'size' => 24, 'stroke' => '1.7' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- whitelisted SVG. ?></i>
							<b><?php echo esc_html( isset( $bdy_row['continuum_step_title'] ) ? $bdy_row['continuum_step_title'] : '' ); ?></b>
							<span><?php echo esc_html( isset( $bdy_row['continuum_step_text'] ) ? $bdy_row['continuum_step_text'] : '' ); ?></span>
						</li>
					<?php endforeach; ?>
				</ol>
			<?php endif; ?>

			<?php if ( $bdy_paras ) : ?>
				<details class="more reveal">
					<summary>
						<span class="more__closed"><?php echo esc_html( bdy_string( 'home_continuum_more_closed', $bdy_d['home_continuum_more_closed'] ) ); ?></span>
						<span class="more__open"><?php echo esc_html( bdy_string( 'home_continuum_more_open', $bdy_d['home_continuum_more_open'] ) ); ?></span>
					</summary>
					<div class="more__body">
						<?php foreach ( $bdy_paras as $bdy_row ) : ?>
							<?php if ( ! empty( $bdy_row['continuum_para_text'] ) ) : ?>
								<p><?php echo bdy_row_text( $bdy_row, 'continuum_para_text' ); ?></p>
							<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</details>
			<?php endif; ?>

			<div class="inline-ctas reveal">
				<?php
				echo bdy_button( bdy_string( 'home_continuum_btn_1_text', $bdy_d['home_continuum_btn_1_text'] ), bdy_string( 'home_continuum_btn_1_url', $bdy_d['home_continuum_btn_1_url'] ), 'ink', array( 'new_tab' => true ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				echo bdy_button( bdy_string( 'home_continuum_btn_2_text', $bdy_d['home_continuum_btn_2_text'] ), bdy_string( 'home_continuum_btn_2_url', $bdy_d['home_continuum_btn_2_url'] ), 'ghost' ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				?>
			</div>
		</div>
	</div>
</section>
