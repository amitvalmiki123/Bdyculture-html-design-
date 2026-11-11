<?php
/**
 * Inner page template.
 *
 * The supplied HTML package only included the homepage, so inner pages reuse
 * the existing design language instead of inventing new sections:
 * hero (tag + H1 + intro), then the page content from the editor.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		bdy_render_sections( 'page' );
		?>
		<section class="section section--page">
			<div class="container">
				<div class="entry-content">
					<?php
					if ( ! bdy_show( 'page', 'hero' ) ) {
						echo '<h1 class="entry-content__title">' . esc_html( get_the_title() ) . '</h1>';
					}

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
	endwhile;
endif;

get_footer();
