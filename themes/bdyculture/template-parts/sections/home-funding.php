<?php
/**
 * Home — Funding & referrals.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d        = bdy_section_defaults( 'home', 'funding' );
$bdy_tag      = bdy_string( 'home_funding_tag', $bdy_d['home_funding_tag'] );
$bdy_title    = bdy_html( 'home_funding_title', $bdy_d['home_funding_title'] );
$bdy_intro    = bdy_html( 'home_funding_intro', $bdy_d['home_funding_intro'] );
$bdy_text     = bdy_html( 'home_funding_text', $bdy_d['home_funding_text'] );
$bdy_pathways = bdy_rows( 'home_funding_pathways', $bdy_d['home_funding_pathways'] );
?>
<section class="section funding"<?php echo $bdy_title ? ' aria-labelledby="fund-title"' : ''; ?>>
	<div class="container funding__grid">
		<header class="section__head reveal">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag"><?php echo $bdy_tag; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post (allows &amp;). ?></p>
			<?php endif; ?>
			<?php if ( $bdy_title ) : ?>
				<h2 id="fund-title"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_intro ) : ?>
				<p class="section__intro"><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>
			<?php if ( $bdy_text ) : ?>
				<p class="reveal"><?php echo $bdy_text; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>
		</header>

		<?php if ( $bdy_pathways ) : ?>
			<ul class="pathways">
				<?php foreach ( $bdy_pathways as $bdy_row ) : ?>
					<li class="reveal">
						<?php if ( ! empty( $bdy_row['pathway_title'] ) ) : ?>
							<b><?php echo esc_html( $bdy_row['pathway_title'] ); ?></b>
						<?php endif; ?>
						<?php if ( ! empty( $bdy_row['pathway_text'] ) ) : ?>
							<span><?php echo esc_html( $bdy_row['pathway_text'] ); ?></span>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</section>
