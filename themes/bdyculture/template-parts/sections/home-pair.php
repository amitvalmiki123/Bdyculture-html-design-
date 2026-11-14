<?php
/**
 * Home — Paired cards (home visits + referrals).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d = bdy_section_defaults( 'home', 'pair' );
?>
<section class="section pair" aria-label="<?php esc_attr_e( 'Home visits and referrals', 'bdyculture' ); ?>">
	<div class="container pair__grid">
		<article class="pair__card pair__card--<?php echo esc_attr( bdy_choice( 'pair_1_style', $bdy_d['pair_1_style'], array( 'ink', 'signal' ) ) ); ?> reveal">
			<?php if ( bdy_string( 'pair_1_tag', $bdy_d['pair_1_tag'] ) ) : ?>
				<p class="tag<?php echo 'ink' === bdy_choice( 'pair_1_style', $bdy_d['pair_1_style'], array( 'ink', 'signal' ) ) ? ' tag--light' : ''; ?>"><?php echo bdy_html( 'pair_1_tag', $bdy_d['pair_1_tag'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php if ( bdy_string( 'pair_1_title', $bdy_d['pair_1_title'] ) ) : ?>
				<h2><?php echo esc_html( bdy_string( 'pair_1_title', $bdy_d['pair_1_title'] ) ); ?></h2>
			<?php endif; ?>

			<?php if ( bdy_string( 'pair_1_text', $bdy_d['pair_1_text'] ) ) : ?>
				<p><?php echo bdy_html( 'pair_1_text', $bdy_d['pair_1_text'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php
			echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				bdy_string( 'pair_1_btn_1_text', $bdy_d['pair_1_btn_1_text'] ),
				bdy_string( 'pair_1_btn_1_url', $bdy_d['pair_1_btn_1_url'] ),
				bdy_choice( 'pair_1_btn_1_style', $bdy_d['pair_1_btn_1_style'], array( 'signal', 'ink', 'ghost', 'light', 'outline-light', 'call' ) )
			);
			echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				bdy_string( 'pair_1_btn_2_text', $bdy_d['pair_1_btn_2_text'] ),
				bdy_string( 'pair_1_btn_2_url', $bdy_d['pair_1_btn_2_url'] ),
				bdy_choice( 'pair_1_btn_2_style', $bdy_d['pair_1_btn_2_style'], array( 'signal', 'ink', 'ghost', 'light', 'outline-light', 'call' ) ),
				array( 'attr' => 'data-focus-form' )
			);
			?>
		</article>

		<article class="pair__card pair__card--<?php echo esc_attr( bdy_choice( 'pair_2_style', $bdy_d['pair_2_style'], array( 'ink', 'signal' ) ) ); ?> reveal">
			<?php if ( bdy_string( 'pair_2_tag', $bdy_d['pair_2_tag'] ) ) : ?>
				<p class="tag<?php echo 'ink' === bdy_choice( 'pair_2_style', $bdy_d['pair_2_style'], array( 'ink', 'signal' ) ) ? ' tag--light' : ''; ?>"><?php echo bdy_html( 'pair_2_tag', $bdy_d['pair_2_tag'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php if ( bdy_string( 'pair_2_title', $bdy_d['pair_2_title'] ) ) : ?>
				<h2><?php echo esc_html( bdy_string( 'pair_2_title', $bdy_d['pair_2_title'] ) ); ?></h2>
			<?php endif; ?>

			<?php if ( bdy_string( 'pair_2_text', $bdy_d['pair_2_text'] ) ) : ?>
				<p><?php echo bdy_html( 'pair_2_text', $bdy_d['pair_2_text'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php
			echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				bdy_string( 'pair_2_btn_1_text', $bdy_d['pair_2_btn_1_text'] ),
				bdy_string( 'pair_2_btn_1_url', $bdy_d['pair_2_btn_1_url'] ),
				bdy_choice( 'pair_2_btn_1_style', $bdy_d['pair_2_btn_1_style'], array( 'signal', 'ink', 'ghost', 'light', 'outline-light', 'call' ) ),
				array( 'icon' => bdy_string( 'pair_2_btn_1_icon', $bdy_d['pair_2_btn_1_icon'] ) )
			);
			echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				bdy_string( 'pair_2_btn_2_text', $bdy_d['pair_2_btn_2_text'] ),
				bdy_string( 'pair_2_btn_2_url', $bdy_d['pair_2_btn_2_url'] ),
				bdy_choice( 'pair_2_btn_2_style', '', array( 'signal', 'ink', 'ghost', 'light', 'outline-light', 'call' ) )
			);
			?>
		</article>
	</div>
</section>
