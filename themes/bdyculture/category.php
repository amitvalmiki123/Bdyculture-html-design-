<?php
/**
 * Category archive — published blog articles with working topic navigation.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_posts_page = (int) get_option( 'page_for_posts' );
$bdy_blog_url   = $bdy_posts_page ? get_permalink( $bdy_posts_page ) : '';

if ( ! $bdy_blog_url ) {
	$bdy_blog_page = get_page_by_path( 'blog', OBJECT, 'page' );
	$bdy_blog_url  = $bdy_blog_page ? get_permalink( $bdy_blog_page ) : home_url( '/blog/' );
}

$bdy_topics = get_terms(
	array(
		'taxonomy'   => 'category',
		'hide_empty' => true,
	)
);

get_header();
?>
<section class="hero hero--inner hero--noform" aria-labelledby="hero-title">
	<div class="container hero__grid">
		<div class="hero__copy">
			<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'bdyculture' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'bdyculture' ); ?></a>
				<span aria-hidden="true">/</span>
				<a href="<?php echo esc_url( $bdy_blog_url ); ?>"><?php esc_html_e( 'Blog', 'bdyculture' ); ?></a>
				<span aria-hidden="true">/</span>
				<span aria-current="page"><?php single_cat_title(); ?></span>
			</nav>
			<h1 id="hero-title"><?php single_cat_title(); ?></h1>
			<?php if ( category_description() ) : ?>
				<div class="lead"><?php echo wp_kses_post( category_description() ); ?></div>
			<?php endif; ?>
		</div>
	</div>
</section>

<section class="section section--paper">
	<div class="container">
		<div class="chips chips--topics" role="group" aria-label="<?php esc_attr_e( 'Blog topics', 'bdyculture' ); ?>">
			<a class="chip" href="<?php echo esc_url( $bdy_blog_url ); ?>"><?php esc_html_e( 'All', 'bdyculture' ); ?></a>
			<?php if ( is_array( $bdy_topics ) ) : ?>
				<?php foreach ( $bdy_topics as $bdy_topic ) : ?>
					<a class="chip<?php echo is_category( $bdy_topic->term_id ) ? ' is-on' : ''; ?>" href="<?php echo esc_url( get_category_link( $bdy_topic ) ); ?>"><?php echo esc_html( $bdy_topic->name ); ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					$bdy_meta = bdy_post_meta_line( get_the_ID() );
					?>
					<article <?php post_class( 'post-card reveal' ); ?>>
						<a class="post-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
							<?php
							echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
								has_post_thumbnail() ? get_post_thumbnail_id( get_the_ID() ) : '',
								array(
									'class'      => 'img-crop',
									'fallback'   => 'hero-gym-bright.webp',
									'decorative' => true,
								)
							);
							?>
						</a>
						<div class="post-card__body">
							<?php if ( $bdy_meta ) : ?>
								<p class="post-meta">
									<?php foreach ( array_values( $bdy_meta ) as $bdy_i => $bdy_part ) : ?>
										<?php echo 0 === $bdy_i ? '<span class="chip-static">' . esc_html( $bdy_part ) . '</span>' : '<span>' . esc_html( $bdy_part ) . '</span>'; ?>
									<?php endforeach; ?>
								</p>
							<?php endif; ?>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
							<a class="post-card__more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'bdyculture' ); ?> <span aria-hidden="true">&rarr;</span></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p class="ph-note"><?php esc_html_e( 'No articles in this topic yet.', 'bdyculture' ); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php
get_footer();
