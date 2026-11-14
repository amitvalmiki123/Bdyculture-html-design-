<?php
/**
 * Post helpers — the meta line and reading time shown on blog cards.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Estimated reading time for a piece of content.
 *
 * @param string $content Post content (HTML allowed).
 * @return string e.g. "5 min read".
 */
function bdy_reading_time( $content ) {
	$words = str_word_count( wp_strip_all_tags( (string) $content ) );
	$mins  = max( 1, (int) ceil( $words / 200 ) );

	/* translators: %d: number of minutes. */
	return sprintf( _n( '%d min read', '%d min read', $mins, 'bdyculture' ), $mins );
}

/**
 * Category, date and reading time for a post.
 *
 * @param int $post_id Post ID.
 * @return array
 */
function bdy_post_meta_line( $post_id = 0 ) {
	$post_id  = $post_id ? $post_id : get_the_ID();
	$category = '';

	if ( $post_id && function_exists( 'get_the_category' ) ) {
		$cats = get_the_category( $post_id );
		if ( $cats ) {
			$category = $cats[0]->name;
		}
	}

	$meta = array();

	if ( $category ) {
		$meta[] = $category;
	}

	if ( $post_id ) {
		$meta[] = get_the_date( '', $post_id );
		$meta[] = bdy_reading_time( get_post_field( 'post_content', $post_id ) );
	}

	return $meta;
}

/**
 * Article body with heading anchors, plus the matching "In this article" list.
 *
 * The design's article template links its sidebar to the H2s in the body, so
 * every H2 gets an id (the author's own id is kept when present) and the same
 * list drives `ul.toc`.
 *
 * @param string $content Rendered post content.
 * @return array array( 'content' => string, 'toc' => array of array( 'id', 'text' ) )
 */
function bdy_article_content( $content ) {
	$toc = array();

	$content = preg_replace_callback(
		'/<h([23])([^>]*)>(.*?)<\/h\1>/is',
		static function ( $matches ) use ( &$toc ) {
			$level = $matches[1];
			$attrs = $matches[2];
			$inner = $matches[3];
			$text  = trim( wp_strip_all_tags( $inner ) );

			if ( preg_match( '/id="([^"]+)"/', $attrs, $found ) ) {
				$id = $found[1];
			} else {
				$id    = 's' . ( count( $toc ) + 1 );
				$attrs = rtrim( $attrs ) . ' id="' . esc_attr( $id ) . '"';
			}

			if ( '2' === $level && $text ) {
				$toc[] = array(
					'id'   => $id,
					'text' => $text,
				);
			}

			return '<h' . $level . $attrs . '>' . $inner . '</h' . $level . '>';
		},
		(string) $content
	);

	return array(
		'content' => $content,
		'toc'     => $toc,
	);
}

/**
 * Related articles: the latest published posts other than the current one.
 *
 * @param int $post_id Current post.
 * @param int $limit   How many cards.
 * @return array List of array( title, excerpt, url, image, meta, more ).
 */
function bdy_related_posts( $post_id = 0, $limit = 3 ) {
	$query = new WP_Query(
		array(
			'post__not_in'        => $post_id ? array( (int) $post_id ) : array(),
			'posts_per_page'      => (int) $limit,
			'ignore_sticky_posts' => true,
		)
	);

	$cards = array();

	while ( $query->have_posts() ) {
		$query->the_post();
		$cards[] = array(
			'title'   => get_the_title(),
			'excerpt' => wp_strip_all_tags( get_the_excerpt() ),
			'url'     => get_permalink(),
			'image'   => has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) : '',
			'meta'    => bdy_post_meta_line( get_the_ID() ),
			'more'    => __( 'Read more', 'bdyculture' ),
		);
	}

	wp_reset_postdata();

	return $cards;
}
