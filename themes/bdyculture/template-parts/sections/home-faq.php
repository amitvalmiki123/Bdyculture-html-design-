<?php
/**
 * Home — FAQ accordion (native <details>, one open at a time via main.js).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d     = bdy_section_defaults( 'home', 'faq' );
$bdy_tag   = bdy_string( 'home_faq_tag', $bdy_d['home_faq_tag'] );
$bdy_title = bdy_html( 'home_faq_title', $bdy_d['home_faq_title'] );
$bdy_intro = bdy_html( 'home_faq_intro', $bdy_d['home_faq_intro'] );
$bdy_btn_t = bdy_string( 'home_faq_btn_text', $bdy_d['home_faq_btn_text'] );
$bdy_btn_u = bdy_string( 'home_faq_btn_url', $bdy_d['home_faq_btn_url'] );
$bdy_items = bdy_rows( 'home_faq_items', $bdy_d['home_faq_items'] );

if ( ! $bdy_items ) {
	return;
}
?>
<section class="section faq" id="faq"<?php echo $bdy_title ? ' aria-labelledby="faq-title"' : ''; ?>>
	<div class="container faq__grid">
		<header class="faq__head reveal">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag"><?php echo esc_html( $bdy_tag ); ?></p>
			<?php endif; ?>
			<?php if ( $bdy_title ) : ?>
				<h2 id="faq-title"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_intro ) : ?>
				<p><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>
			<?php if ( $bdy_btn_t ) : ?>
				<a class="btn btn--ink" href="<?php echo esc_url( bdy_link( $bdy_btn_u ) ); ?>" data-focus-form><?php echo esc_html( $bdy_btn_t ); ?></a>
			<?php endif; ?>
		</header>

		<div class="faq__list" data-accordion>
			<?php foreach ( $bdy_items as $bdy_i => $bdy_row ) : ?>
				<?php
				if ( empty( $bdy_row['faq_question'] ) ) {
					continue;
				}
				$bdy_answer = isset( $bdy_row['faq_answer'] ) ? wp_kses_post( $bdy_row['faq_answer'] ) : '';
				?>
				<details class="reveal"<?php echo 0 === $bdy_i ? ' open' : ''; ?>>
					<summary><?php echo esc_html( $bdy_row['faq_question'] ); ?></summary>
					<?php if ( $bdy_answer ) : ?>
						<div><p><?php echo $bdy_answer; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p></div>
					<?php endif; ?>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
