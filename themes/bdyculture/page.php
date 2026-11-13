<?php
/**
 * Inner page — design blocks + the two shared bands.
 *
 * The block list comes from the ACF flexible-content field `page_sections`;
 * without it, `defaults-pages.php` supplies the approved design for each known
 * page. A brand-new page with neither gets a plain hero (page title) and the
 * editor content below.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$bdy_blocks = bdy_page_blocks();

	if ( $bdy_blocks ) {
		bdy_render_page_blocks();
	} else {
		?>
		<section class="hero hero--inner hero--noform" aria-labelledby="hero-title">
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
endwhile;

get_footer();
