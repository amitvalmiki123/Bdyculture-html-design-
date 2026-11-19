<?php
/**
 * Inner page — design blocks + the two shared bands.
 *
 * Thank You has a dedicated confirmation layout; all other pages continue to
 * use their ACF/default design blocks and shared bands.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	if ( is_page( 'thank-you' ) ) {
		get_template_part( 'template-parts/pages/thank-you' );
	} else {
		$bdy_blocks = bdy_page_blocks();

		if ( $bdy_blocks ) {
			bdy_render_page_blocks();
		} else {
			?>
			<section class="hero hero--inner hero--noform" aria-labelledby="hero-title"<?php echo bdy_featured_hero_style_attr(); // phpcs:ignore WordPress.Security.EscapeOutput -- helper returns an escaped style attribute. ?>>
				<div class="container hero__grid">
					<div class="hero__copy">
						<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'bdyculture' ); ?>">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'bdyculture' ); ?></a>
							<span aria-hidden="true">/</span>
							<span aria-current="page"><?php the_title(); ?></span>
						</nav>
						<h1 id="hero-title"><?php the_title(); ?></h1>
					</div>
				</div>
			</section>

			<section class="section">
				<div class="container">
					<div class="entry-content">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<nav class="entry-content__pages">',
								'after'  => '</nav>',
							)
						);
						?>
					</div>
				</div>
			</section>
			<?php
		}

		// Shared bands: content lives in Theme Settings, show/order per page.
		bdy_render_shared_bands( 'page' );
	}
endwhile;

get_footer();
