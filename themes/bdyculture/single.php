<?php
/**
 * Single post — blog article in the design's `.article-layout`.
 *
 * Everything a reader sees here is either the post itself (title, excerpt,
 * content, category, date) or one of the article-template strings from
 * Site Settings → Blog article, so the copy is editable without code.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$bdy_g        = bdy_defaults( 'global' );
	$bdy_book     = bdy_booking_url();
	$bdy_blog_url = get_option( 'page_for_posts' ) ? get_permalink( get_option( 'page_for_posts' ) ) : home_url( '/blog/' );
	$bdy_checks   = bdy_rows( 'article_checks', $bdy_g['article_checks'], 'option' );
	$bdy_checks   = $bdy_checks ? $bdy_checks : $bdy_g['article_checks'];

	$bdy_side_book   = bdy_string( 'article_side_book_title', $bdy_g['article_side_book_title'], 'option' );
	$bdy_side_text   = bdy_string( 'article_side_book_text', $bdy_g['article_side_book_text'], 'option' );
	$bdy_side_svc    = bdy_string( 'article_side_services_title', $bdy_g['article_side_services_title'], 'option' );
	$bdy_toc_title   = bdy_string( 'article_toc_title', $bdy_g['article_toc_title'], 'option' );
	$bdy_rel_tag     = bdy_string( 'article_related_tag', $bdy_g['article_related_tag'], 'option' );
	$bdy_rel_title   = bdy_string( 'article_related_title', $bdy_g['article_related_title'], 'option' );
	$bdy_cta_title   = bdy_string( 'article_cta_title', $bdy_g['article_cta_title'], 'option' );
	$bdy_cta_text    = bdy_string( 'article_cta_text', $bdy_g['article_cta_text'], 'option' );
	$bdy_byline      = bdy_string( 'article_byline', $bdy_g['article_byline'], 'option' );
	$bdy_disclaimer  = bdy_string( 'article_disclaimer', $bdy_g['article_disclaimer'], 'option' );
	$bdy_placeholder = bdy_string( 'article_byline_note', $bdy_g['article_byline_note'], 'option' );

	ob_start();
	the_content();
	$bdy_article = bdy_article_content( ob_get_clean() );

	$bdy_toc   = $bdy_article['toc'];
	$bdy_body  = $bdy_article['content'];
	$bdy_cats  = get_the_category();
	$bdy_more  = __( 'Read more', 'bdyculture' );
	$bdy_reltd = bdy_related_posts( get_the_ID(), 3 );
	?>
	<section class="hero hero--inner" aria-labelledby="hero-title">
		<div class="container hero__grid">
			<div class="hero__copy">
				<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'bdyculture' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'bdyculture' ); ?></a>
					<span aria-hidden="true">/</span>
					<a href="<?php echo esc_url( $bdy_blog_url ); ?>"><?php esc_html_e( 'Blog', 'bdyculture' ); ?></a>
					<span aria-hidden="true">/</span>
					<span aria-current="page"><?php the_title(); ?></span>
				</nav>
				<h1 id="hero-title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<div class="hero__btns">
					<?php
					echo bdy_button( __( 'Book Online', 'bdyculture' ), $bdy_book, 'signal', array( 'size' => 'lg', 'new_tab' => true, 'icon' => 'arrow' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper.
					echo bdy_button( sprintf( __( 'Call %s', 'bdyculture' ), bdy_phone_display() ), 'tel', 'call', array( 'size' => 'lg' ) ); // @codingStandardsIgnoreLine
					echo bdy_button( __( 'Refer a Patient', 'bdyculture' ), '/referrers/', 'ghost', array( 'size' => 'lg', 'class' => 'hero__refer' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper.
					?>
				</div>
				<?php if ( $bdy_checks ) : ?>
					<ul class="hero__checks">
						<?php foreach ( $bdy_checks as $bdy_check ) : ?>
							<?php $bdy_check_text = is_array( $bdy_check ) ? bdy_b_row( $bdy_check, 'text' ) : $bdy_check; ?>
							<?php if ( '' !== trim( (string) $bdy_check_text ) ) : ?>
								<li><?php echo esc_html( $bdy_check_text ); ?></li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php get_template_part( 'template-parts/global/enquiry-card' ); ?>
		</div>
	</section>

	<section class="section">
		<div class="container article-layout">
			<article class="article">
				<p class="post-meta">
					<?php if ( $bdy_cats ) : ?>
						<span class="chip-static"><?php echo esc_html( $bdy_cats[0]->name ); ?></span>
					<?php endif; ?>
					<span><?php echo esc_html( sprintf( /* translators: %s: date. */ __( 'Published: %s', 'bdyculture' ), get_the_date() ) ); ?></span>
					<span><?php echo esc_html( bdy_reading_time( get_post_field( 'post_content', get_the_ID() ) ) ); ?></span>
				</p>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="article__hero media-frame--swept">
						<?php
						echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
							get_post_thumbnail_id( get_the_ID() ),
							array(
								'class'           => 'img-crop',
								'full_resolution' => true,
								'alt'             => get_the_title(),
							)
						);
						?>
					</figure>
				<?php endif; ?>

				<?php if ( has_excerpt() ) : ?>
					<p class="article__lede"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>

				<?php echo $bdy_body; // phpcs:ignore WordPress.Security.EscapeOutput -- post content, already filtered. ?>

				<div class="article__cta">
					<h3><?php echo esc_html( $bdy_cta_title ); ?></h3>
					<p><?php echo esc_html( $bdy_cta_text ); ?></p>
					<div class="inline-ctas">
						<?php
						echo bdy_button( __( 'Book Online', 'bdyculture' ), $bdy_book, 'signal', array( 'new_tab' => true, 'icon' => 'arrow' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper.
						echo bdy_button( sprintf( __( 'Call %s', 'bdyculture' ), bdy_phone_display() ), 'tel', 'outline-light' ); // @codingStandardsIgnoreLine
						?>
					</div>
				</div>

				<footer class="article__foot">
					<p>
						<b><?php esc_html_e( 'Written by:', 'bdyculture' ); ?></b> <?php echo esc_html( $bdy_byline ); ?>
						<?php if ( $bdy_placeholder ) : ?>
							<span class="ph">(<?php echo esc_html( $bdy_placeholder ); ?>)</span>
						<?php endif; ?>
					</p>
					<?php if ( $bdy_disclaimer ) : ?>
						<p class="article__disclaimer"><?php echo esc_html( $bdy_disclaimer ); ?></p>
					<?php endif; ?>
				</footer>
			</article>

			<aside class="article-side" aria-label="<?php esc_attr_e( 'Article sidebar', 'bdyculture' ); ?>">
				<?php if ( $bdy_toc ) : ?>
					<div class="side-card">
						<h2><?php echo esc_html( $bdy_toc_title ); ?></h2>
						<ul class="toc">
							<?php foreach ( $bdy_toc as $bdy_item ) : ?>
								<li><a href="#<?php echo esc_attr( $bdy_item['id'] ); ?>"><?php echo esc_html( $bdy_item['text'] ); ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>

				<div class="side-card side-card--ink">
					<h2><?php echo esc_html( $bdy_side_book ); ?></h2>
					<?php if ( $bdy_side_text ) : ?>
						<p><?php echo esc_html( $bdy_side_text ); ?></p>
					<?php endif; ?>
					<?php
					echo bdy_button( __( 'Book Online', 'bdyculture' ), $bdy_book, 'signal', array( 'block' => true, 'new_tab' => true, 'icon' => 'arrow' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in helper.
					echo bdy_button( sprintf( __( 'Call %s', 'bdyculture' ), bdy_phone_display() ), 'tel', 'outline-light', array( 'block' => true ) ); // @codingStandardsIgnoreLine
					?>
				</div>

				<?php
				$bdy_services = array(
					__( 'Physiotherapy', 'bdyculture' )        => '/physiotherapy/',
					__( 'Exercise Physiology', 'bdyculture' )  => '/exercise-physiology/',
					__( 'Occupational Therapy', 'bdyculture' ) => '/occupational-therapy/',
					__( 'Clinical Pilates', 'bdyculture' )     => '/clinical-pilates/',
				);
				?>
				<div class="side-card">
					<h2><?php echo esc_html( $bdy_side_svc ); ?></h2>
					<ul class="note-links">
						<?php foreach ( $bdy_services as $bdy_label => $bdy_path ) : ?>
							<li><a href="<?php echo esc_url( home_url( $bdy_path ) ); ?>"><?php echo esc_html( $bdy_label ); ?> <i aria-hidden="true">&rarr;</i></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</aside>
		</div>
	</section>

	<?php if ( $bdy_reltd ) : ?>
		<section class="section section--paper">
			<div class="container">
				<header class="section__head reveal">
					<?php bdy_b_tag( $bdy_rel_tag ); ?>
					<?php if ( $bdy_rel_title ) : ?>
						<h2><?php echo esc_html( $bdy_rel_title ); ?></h2>
					<?php endif; ?>
				</header>
				<div class="post-grid post-grid--three">
					<?php foreach ( $bdy_reltd as $bdy_card ) : ?>
						<?php
						$bdy_meta = isset( $bdy_card['meta'] ) && is_array( $bdy_card['meta'] ) ? $bdy_card['meta'] : array();
						$bdy_url  = bdy_link( $bdy_card['url'] );
						?>
						<article class="post-card reveal">
							<a class="post-card__media" href="<?php echo esc_url( $bdy_url ); ?>" aria-hidden="true" tabindex="-1">
								<?php
								echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
									$bdy_card['image'],
									array(
										'class'      => 'img-crop',
										'fallback'   => 'gym-chermside-1920.jpg',
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
								<h3><a href="<?php echo esc_url( $bdy_url ); ?>"><?php echo esc_html( $bdy_card['title'] ); ?></a></h3>
								<a class="post-card__more" href="<?php echo esc_url( $bdy_url ); ?>"><?php echo esc_html( $bdy_more ); ?> <span aria-hidden="true">&rarr;</span></a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>
	<?php endif; ?>

	<?php
	get_template_part( 'template-parts/sections/contact' );
	get_template_part( 'template-parts/sections/map' );
endwhile;

get_footer();
