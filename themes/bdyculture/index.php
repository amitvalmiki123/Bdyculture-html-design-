<?php
/**
 * Fallback template (archives, search, blog index).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<section class="section section--page">
	<div class="container">
		<header class="section__head">
			<h1 class="entry-content__title">
				<?php
				if ( is_search() ) {
					printf( esc_html__( 'Search results for “%s”', 'bdyculture' ), esc_html( get_search_query() ) );
				} elseif ( is_archive() ) {
					echo esc_html( wp_strip_all_tags( get_the_archive_title() ) );
				} else {
					echo esc_html( get_bloginfo( 'name' ) );
				}
				?>
			</h1>
		</header>

		<div class="entry-content">
			<?php if ( have_posts() ) : ?>
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article <?php post_class( 'entry-content__item' ); ?>>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_excerpt(); ?>
					</article>
					<?php
				endwhile;

				the_posts_pagination();
			else :
				?>
				<p><?php esc_html_e( 'Nothing found.', 'bdyculture' ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
get_footer();
