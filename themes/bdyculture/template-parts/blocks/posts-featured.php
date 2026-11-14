<?php
/**
 * Block — featured article (latest post, or the shipped sample).
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
$bdy_post  = bdy_b_items( $args, 'post' );
$bdy_url   = isset( $bdy_post['url'] ) ? bdy_link( $bdy_post['url'] ) : '';
$bdy_img   = isset( $bdy_post['image'] ) ? $bdy_post['image'] : '';
$bdy_crop  = isset( $bdy_post['crop'] ) ? $bdy_post['crop'] : '';
$bdy_meta  = isset( $bdy_post['meta'] ) && is_array( $bdy_post['meta'] ) ? $bdy_post['meta'] : array();
$bdy_head  = isset( $bdy_post['title'] ) ? $bdy_post['title'] : '';
$bdy_sum   = isset( $bdy_post['excerpt'] ) ? $bdy_post['excerpt'] : '';
$bdy_btn   = bdy_b( $args, 'btn_text', __( 'Read the article', 'bdyculture' ) );

$bdy_query = new WP_Query(
	array(
		'posts_per_page'      => 1,
		'ignore_sticky_posts' => true,
	)
);

if ( $bdy_query->have_posts() ) {
	$bdy_query->the_post();
	$bdy_head  = get_the_title();
	$bdy_url   = get_permalink();
	$bdy_sum   = wp_strip_all_tags( get_the_excerpt() );
	$bdy_meta  = bdy_post_meta_line( get_the_ID() );
	$bdy_img   = has_post_thumbnail() ? get_post_thumbnail_id( get_the_ID() ) : $bdy_img;
	$bdy_crop  = has_post_thumbnail() ? '' : $bdy_crop;
	wp_reset_postdata();
}

if ( ! $bdy_head ) {
	return;
}
?>
<section class="section">
	<div class="container">
		<?php if ( $bdy_tag || $bdy_title || $bdy_intro ) : ?>
			<header class="section__head reveal">
				<?php bdy_b_tag( $bdy_tag ); ?>
				<?php if ( $bdy_title ) : ?>
					<h2><?php echo esc_html( $bdy_title ); ?></h2>
				<?php endif; ?>
				<?php if ( $bdy_intro ) : ?>
					<p class="section__intro"><?php echo esc_html( $bdy_intro ); ?></p>
				<?php endif; ?>
			</header>
		<?php endif; ?>

		<article class="post-featured reveal">
			<a class="post-featured__media media-frame--swept" href="<?php echo esc_url( $bdy_url ); ?>" aria-hidden="true" tabindex="-1">
				<?php
				echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
					$bdy_img,
					array(
						'class'      => 'img-crop',
						'sizes'      => '(min-width: 900px) 55vw, 100vw',
						'fallback'   => 'gym-chermside-1920.jpg',
						'decorative' => true,
						'attr'       => array( 'style' => bdy_crop_style_from( $bdy_crop ) ),
					)
				);
				?>
			</a>
			<div class="post-featured__body">
				<?php if ( $bdy_meta ) : ?>
					<p class="post-meta">
						<?php foreach ( array_values( $bdy_meta ) as $bdy_i => $bdy_part ) : ?>
							<?php echo 0 === $bdy_i ? '<span class="chip-static">' . esc_html( $bdy_part ) . '</span>' : '<span>' . esc_html( $bdy_part ) . '</span>'; ?>
						<?php endforeach; ?>
					</p>
				<?php endif; ?>
				<h3><a href="<?php echo esc_url( $bdy_url ); ?>"><?php echo esc_html( $bdy_head ); ?></a></h3>
				<?php if ( $bdy_sum ) : ?>
					<p><?php echo esc_html( $bdy_sum ); ?></p>
				<?php endif; ?>
				<a class="btn btn--ink" href="<?php echo esc_url( $bdy_url ); ?>"><?php echo esc_html( $bdy_btn ); ?> <span aria-hidden="true">&rarr;</span></a>
			</div>
		</article>
	</div>
</section>
