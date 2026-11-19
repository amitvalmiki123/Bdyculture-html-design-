<?php
/**
 * Front page — renders every enabled section in order (Rules 4, 10).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

bdy_render_sections( 'home' );

get_footer();
