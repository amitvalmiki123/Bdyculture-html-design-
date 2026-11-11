<?php
/**
 * Inner page — hero (one H1 per page, Rule 13).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d     = bdy_section_defaults( 'page', 'hero' );
$bdy_tag   = bdy_string( 'page_hero_tag', $bdy_d['page_hero_tag'] );
$bdy_intro = bdy_html( 'page_hero_intro', $bdy_d['page_hero_intro'] );
$bdy_pos   = bdy_string( 'page_hero_image_position', $bdy_d['page_hero_image_position'] );
$bdy_image = bdy_image( bdy_get( 'page_hero_image', '', bdy_context() ), array( 'fallback' => '', 'eager' => true, 'sizes' => '100vw' ) );
?>
<section class="page-hero" aria-labelledby="page-title">
	<div class="container page-hero__inner">
		<?php if ( $bdy_tag ) : ?>
			<p class="tag"><?php echo esc_html( $bdy_tag ); ?></p>
		<?php endif; ?>
		<h1 id="page-title"><?php echo esc_html( get_the_title() ); ?></h1>
		<?php if ( $bdy_intro ) : ?>
			<p class="lead"><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
		<?php endif; ?>
	</div>

	<?php if ( $bdy_image ) : ?>
		<div class="container page-hero__media">
			<figure class="media-frame--swept" style="--page-hero-position:<?php echo esc_attr( $bdy_pos ); ?>">
				<?php echo $bdy_image; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper. ?>
			</figure>
		</div>
	<?php endif; ?>
</section>
