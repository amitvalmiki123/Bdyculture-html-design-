<?php
/**
 * Block — grid of published articles with links to real category archives.
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_tag   = bdy_b( $args, 'tag' );
$bdy_title = bdy_b( $args, 'title' );
$bdy_intro = bdy_b( $args, 'intro' );
$bdy_body  = bdy_b( $args, 'body' );
$bdy_more  = bdy_b( $args, 'more', __( 'Read more', 'bdyculture' ) );
$bdy_paper = bdy_b_flag( $args, 'paper' );

$bdy_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => -1,
		'ignore_sticky_posts' => true,
	)
);

$bdy_topics = get_terms(
	array(
		'taxonomy'   => 'category',
		'hide_empty' => true,
	)
);
$bdy_all_url = get_permalink( get_queried_object_id() );
if ( ! $bdy_all_url ) {
	$bdy_all_url = home_url( '/blog/' );
}
?>
<section class="section<?php echo $bdy_paper ? ' section--paper' : ''; ?>">
	<div class="container">
		<?php if ( $bdy_tag || $bdy_title || $bdy_intro || $bdy_body ) : ?>
			<header class="section__head reveal">
				<?php bdy_b_tag( $bdy_tag ); ?>
				<?php if ( $bdy_title ) : ?>
					<h2><?php echo esc_html( $bdy_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $bdy_intro ) : ?>
					<p class="section__intro"><?php echo esc_html( $bdy_intro ); ?></p>
				<?php endif; ?>
				<?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?>
			</header>
		<?php endif; ?>

		<div class="chips chips--topics" role="group" aria-label="<?php esc_attr_e( 'Blog topics', 'bdyculture' ); ?>">
			<a class="chip is-on" href="<?php echo esc_url( $bdy_all_url ); ?>"><?php esc_html_e( 'All', 'bdyculture' ); ?></a>
			<?php if ( is_array( $bdy_topics ) ) : ?>
				<?php foreach ( $bdy_topics as $bdy_topic ) : ?>
					<a class="chip" href="<?php echo esc_url( get_category_link( $bdy_topic ) ); ?>"><?php echo esc_html( $bdy_topic->name ); ?></a>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>

		<?php if ( $bdy_query->have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( $bdy_query->have_posts() ) :
					$bdy_query->the_post();
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
							<?php if ( has_excerpt() || get_the_content() ) : ?>
								<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt() ) ); ?></p>
							<?php endif; ?>
							<a class="post-card__more" href="<?php the_permalink(); ?>"><?php echo esc_html( $bdy_more ); ?> <span aria-hidden="true">&rarr;</span></a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php wp_reset_postdata(); ?>
		<?php else : ?>
			<p class="ph-note"><?php esc_html_e( 'No articles have been published yet.', 'bdyculture' ); ?></p>
		<?php endif; ?>
	</div>
</section>
