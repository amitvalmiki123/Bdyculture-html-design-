<?php
/**
 * Thank-you page — confirmation and useful next steps after a CF7 submission.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_phone        = bdy_phone_display();
$bdy_phone_number = bdy_phone_number();
$bdy_page_content = get_the_content();
$bdy_has_content  = '' !== trim( wp_strip_all_tags( $bdy_page_content ) );
?>
<section class="hero hero--inner hero--noform" aria-labelledby="hero-title">
	<div class="container hero__grid">
		<div class="hero__copy">
			<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'bdyculture' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'bdyculture' ); ?></a>
				<span aria-hidden="true">/</span>
				<span aria-current="page"><?php esc_html_e( 'Thank You', 'bdyculture' ); ?></span>
			</nav>
			<h1 id="hero-title"><?php esc_html_e( 'Thank You', 'bdyculture' ); ?></h1>
		</div>
	</div>
</section>

<section class="thank-you-section" aria-label="<?php esc_attr_e( 'Submission confirmation', 'bdyculture' ); ?>">
	<div class="container">
		<div class="thank-you-card">
			<div class="thank-you-card__mark" aria-hidden="true">
				<?php echo bdy_icon( 'check', array( 'size' => 32, 'stroke' => '2.2' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- curated inline SVG. ?>
			</div>

			<div class="thank-you-card__content">
				<p class="tag"><?php esc_html_e( 'Message received', 'bdyculture' ); ?></p>
				<?php if ( $bdy_has_content ) : ?>
					<div class="thank-you-card__editor">
						<?php the_content(); ?>
					</div>
				<?php else : ?>
					<h2><?php esc_html_e( 'Thanks for reaching out.', 'bdyculture' ); ?></h2>
					<p class="thank-you-card__intro">
						<?php esc_html_e( 'Your message is with our Chermside team. We’ll be in touch during business hours.', 'bdyculture' ); ?>
					</p>
				<?php endif; ?>

				<?php if ( $bdy_phone && $bdy_phone_number ) : ?>
					<p class="thank-you-card__call">
						<?php esc_html_e( 'Need help sooner? Call us on', 'bdyculture' ); ?>
						<a href="<?php echo esc_url( 'tel:' . $bdy_phone_number ); ?>"><?php echo esc_html( $bdy_phone ); ?></a>
					</p>
				<?php endif; ?>

				<div class="thank-you-card__actions">
					<a class="btn btn--ink" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to Home', 'bdyculture' ); ?></a>
					<?php if ( $bdy_phone && $bdy_phone_number ) : ?>
						<a class="btn btn--signal" href="<?php echo esc_url( 'tel:' . $bdy_phone_number ); ?>">
							<?php echo esc_html( sprintf( __( 'Call %s', 'bdyculture' ), $bdy_phone ) ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
