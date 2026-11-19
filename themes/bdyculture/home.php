<?php
/**
 * Blog listing (the page set as "Posts page").
 *
 * Renders the design's blog layout through the same block engine as every
 * other inner page: featured article, article grid with topic chips, an about
 * block and the FAQ, then the shared contact band and map.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

bdy_render_page_blocks( 'blog' );

get_template_part( 'template-parts/sections/contact' );
get_template_part( 'template-parts/sections/map' );

get_footer();
