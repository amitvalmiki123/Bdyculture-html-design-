<?php
/**
 * Home — What to expect (numbered steps on a dark photographic band).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d     = bdy_section_defaults( 'home', 'expect' );
$bdy_tag   = bdy_string( 'home_expect_tag', $bdy_d['home_expect_tag'] );
$bdy_title = bdy_html( 'home_expect_title', $bdy_d['home_expect_title'] );
$bdy_intro = bdy_html( 'home_expect_intro', $bdy_d['home_expect_intro'] );
$bdy_steps = bdy_rows( 'home_expect_steps', $bdy_d['home_expect_steps'] );
?>
<section class="section section--dark expect has-arcs"<?php echo $bdy_title ? ' aria-labelledby="exp-title"' : ''; ?>>
	<div class="container">
		<?php if ( $bdy_tag || $bdy_title || $bdy_intro ) : ?>
			<header class="section__head reveal">
				<?php if ( $bdy_tag ) : ?>
					<p class="tag tag--light"><?php echo esc_html( $bdy_tag ); ?></p>
				<?php endif; ?>
				<?php if ( $bdy_title ) : ?>
					<h2 id="exp-title"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h2>
				<?php endif; ?>
				<?php if ( $bdy_intro ) : ?>
					<p class="section__intro"><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<?php if ( $bdy_steps ) : ?>
			<ol class="steps">
				<?php foreach ( $bdy_steps as $bdy_i => $bdy_row ) : ?>
					<li class="reveal">
						<span class="steps__n" aria-hidden="true"><?php echo (int) ( $bdy_i + 1 ); ?></span>
						<?php if ( ! empty( $bdy_row['expect_step_title'] ) ) : ?>
							<h3><?php echo bdy_row_text( $bdy_row, 'expect_step_title' ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $bdy_row['expect_step_text'] ) ) : ?>
							<p><?php echo bdy_row_text( $bdy_row, 'expect_step_text' ); ?></p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>

		<?php if ( bdy_string( 'home_expect_btn_1_text', $bdy_d['home_expect_btn_1_text'] ) || bdy_string( 'home_expect_btn_2_text', $bdy_d['home_expect_btn_2_text'] ) ) : ?>
			<div class="inline-ctas reveal">
				<?php
				echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					bdy_string( 'home_expect_btn_1_text', $bdy_d['home_expect_btn_1_text'] ),
					bdy_string( 'home_expect_btn_1_url', $bdy_d['home_expect_btn_1_url'] ),
					'signal',
					array(
						'size'    => 'lg',
						'icon'    => bdy_string( 'home_expect_btn_1_icon', $bdy_d['home_expect_btn_1_icon'] ),
						'new_tab' => true,
					)
				);
				echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
					bdy_string( 'home_expect_btn_2_text', $bdy_d['home_expect_btn_2_text'] ),
					bdy_string( 'home_expect_btn_2_url', $bdy_d['home_expect_btn_2_url'] ),
					'outline-light',
					array(
						'size' => 'lg',
						'attr' => 'data-focus-form',
					)
				);
				?>
			</div>
		<?php endif; ?>
	</div>
</section>
