<?php
/**
 * Block — article grid with topic chips.
 *
 * Published posts drive the grid; until posts exist the block renders its own
 * sample cards, so the page matches the design on a fresh install.
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
$bdy_note  = bdy_b( $args, 'note' );
$bdy_chips = bdy_b_items( $args, 'chips' );
$bdy_items = bdy_b_items( $args );
$bdy_more  = bdy_b( $args, 'more', __( 'Read more', 'bdyculture' ) );
$bdy_paper = bdy_b_flag( $args, 'paper' );

$bdy_query = new WP_Query(
	array(
		'posts_per_page'      => 6,
		'offset'              => 1,
		'ignore_sticky_posts' => true,
	)
);

$bdy_cards = array();

if ( $bdy_query->have_posts() ) {
	while ( $bdy_query->have_posts() ) {
		$bdy_query->the_post();
		$bdy_cards[] = array(
			'title'   => get_the_title(),
			'excerpt' => wp_strip_all_tags( get_the_excerpt() ),
			'url'     => get_permalink(),
			'image'   => has_post_thumbnail() ? get_post_thumbnail_id( get_the_ID() ) : '',
			'meta'    => bdy_post_meta_line( get_the_ID() ),
			'more'    => $bdy_more,
		);
	}
	wp_reset_postdata();
}

if ( ! $bdy_cards ) {
	$bdy_cards = $bdy_items;
}

if ( ! $bdy_cards ) {
	return;
}

$bdy_topics = get_terms(
	array(
		'taxonomy'   => 'category',
		'hide_empty' => true,
	)
);
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

		<?php if ( is_array( $bdy_topics ) && $bdy_topics ) : ?>
			<div class="chips chips--topics" role="group" aria-label="<?php esc_attr_e( 'Blog topics', 'bdyculture' ); ?>">
				<a class="chip is-on" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php esc_html_e( 'All', 'bdyculture' ); ?></a>
				<?php foreach ( $bdy_topics as $bdy_topic ) : ?>
					<a class="chip" href="<?php echo esc_url( get_category_link( $bdy_topic ) ); ?>"><?php echo esc_html( $bdy_topic->name ); ?></a>
				<?php endforeach; ?>
			</div>
		<?php elseif ( $bdy_chips ) : ?>
			<div class="chips chips--topics" role="group" aria-label="<?php esc_attr_e( 'Blog topics', 'bdyculture' ); ?>">
				<?php foreach ( $bdy_chips as $bdy_i => $bdy_chip ) : ?>
					<button type="button" class="chip<?php echo 0 === $bdy_i ? ' is-on' : ''; ?>"><?php echo esc_html( $bdy_chip ); ?></button>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<div class="post-grid">
			<?php foreach ( $bdy_cards as $bdy_card ) : ?>
				<?php
				$bdy_meta = isset( $bdy_card['meta'] ) && is_array( $bdy_card['meta'] ) ? $bdy_card['meta'] : array();
				$bdy_link = bdy_link( isset( $bdy_card['url'] ) ? $bdy_card['url'] : '' );
				$bdy_card_more = isset( $bdy_card['more'] ) && $bdy_card['more'] ? $bdy_card['more'] : $bdy_more;
				?>
				<article class="post-card reveal">
					<a class="post-card__media" href="<?php echo esc_url( $bdy_link ); ?>" aria-hidden="true" tabindex="-1">
						<?php
						echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
							isset( $bdy_card['image'] ) ? $bdy_card['image'] : '',
							array(
								'class'      => 'img-crop',
								'fallback'   => 'hero-gym-bright.webp',
								'decorative' => true,
								'attr'       => array( 'style' => bdy_crop_style_from( isset( $bdy_card['crop'] ) ? $bdy_card['crop'] : '' ) ),
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
						<h3><a href="<?php echo esc_url( $bdy_link ); ?>"><?php echo esc_html( isset( $bdy_card['title'] ) ? $bdy_card['title'] : '' ); ?></a></h3>
						<?php if ( ! empty( $bdy_card['excerpt'] ) ) : ?>
							<p><?php echo esc_html( $bdy_card['excerpt'] ); ?></p>
						<?php endif; ?>
						<a class="post-card__more" href="<?php echo esc_url( $bdy_link ); ?>"><?php echo esc_html( $bdy_card_more ); ?> <span aria-hidden="true">&rarr;</span></a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>

		<?php if ( $bdy_note ) : ?>
			<p class="ph-note"><?php echo esc_html( $bdy_note ); ?></p>
		<?php endif; ?>
	</div>
</section>
