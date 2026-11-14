<?php
/**
 * Home — Hero (H1 + lead + buttons + checklist + enquiry card).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d        = bdy_section_defaults( 'home', 'hero' );
$bdy_title    = bdy_html( 'home_hero_title', $bdy_d['home_hero_title'] );
$bdy_lead     = bdy_html( 'home_hero_lead', $bdy_d['home_hero_lead'] );
$bdy_buttons  = bdy_rows( 'home_hero_buttons', $bdy_d['home_hero_buttons'] );
$bdy_checks   = bdy_rows( 'home_hero_checks', $bdy_d['home_hero_checks'] );
$bdy_raw      = bdy_get( 'home_hero_image', '', bdy_context() );
$bdy_image    = $bdy_raw ? bdy_image_url( $bdy_raw ) : '';
$bdy_style    = $bdy_image ? ' style="' . esc_attr( '--hero-image:url(' . $bdy_image . ')' ) . '"' : '';

?>
<section class="hero hero--solo"<?php echo $bdy_title ? ' aria-labelledby="hero-title"' : ''; ?><?php echo $bdy_style; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above. ?>>
	<div class="container hero__grid">
		<div class="hero__copy">
			<?php if ( $bdy_title ) : ?>
				<h1 id="hero-title" class="reveal"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h1>
			<?php endif; ?>

			<?php if ( $bdy_lead ) : ?>
				<p class="lead reveal"><?php echo $bdy_lead; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php if ( $bdy_buttons ) : ?>
				<div class="hero__btns reveal">
					<?php foreach ( $bdy_buttons as $bdy_row ) : ?>
						<?php
						echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
							isset( $bdy_row['hero_btn_text'] ) ? $bdy_row['hero_btn_text'] : '',
							isset( $bdy_row['hero_btn_url'] ) ? $bdy_row['hero_btn_url'] : '',
							isset( $bdy_row['hero_btn_style'] ) ? $bdy_row['hero_btn_style'] : 'signal',
							array(
								'size'    => 'lg',
								'icon'    => isset( $bdy_row['hero_btn_icon'] ) ? $bdy_row['hero_btn_icon'] : '',
								'icon_pos' => isset( $bdy_row['hero_btn_icon_pos'] ) ? $bdy_row['hero_btn_icon_pos'] : 'auto',
								'new_tab' => ! empty( $bdy_row['hero_btn_new_tab'] ),
								'class'   => ( isset( $bdy_row['hero_btn_style'] ) && 'ghost' === $bdy_row['hero_btn_style'] ) ? 'hero__refer' : '',
							)
						);
						?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $bdy_checks ) : ?>
				<ul class="hero__checks reveal">
					<?php foreach ( $bdy_checks as $bdy_row ) : ?>
						<?php if ( ! empty( $bdy_row['hero_check_text'] ) ) : ?>
							<li><?php echo bdy_row_text( $bdy_row, 'hero_check_text' ); ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>
