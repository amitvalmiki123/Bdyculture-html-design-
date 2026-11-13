<?php
/**
 * Site header (Rule 14).
 *
 * Every value comes from Site Settings (ACF Options page) so the global
 * header/navigation is managed in ONE place.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_global   = bdy_defaults( 'global' );
$bdy_nav      = bdy_menu_tree( 'primary', $bdy_global['header_nav'] );
$bdy_book     = bdy_booking_url();
$bdy_book_txt = bdy_string( 'header_book_text', $bdy_global['header_book_text'], 'option' );
$bdy_enq_txt  = bdy_string( 'header_enquire_text', $bdy_global['header_enquire_text'], 'option' );
$bdy_enq_href = is_front_page() ? '#enquire' : home_url( '/#enquire' );
$bdy_phone    = bdy_phone_display();
$bdy_logo     = bdy_option( 'clinic_logo' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php if ( ! has_site_icon() ) : ?>
<link rel="icon" type="image/png" href="<?php echo esc_url( THEME_URI . '/assets/images/logo-mark-black.png' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to main content', 'bdyculture' ); ?></a>

<header class="site-header" id="top">
	<div class="container header__row">
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ' – home' ); ?>">
			<?php
			echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				$bdy_logo,
				array(
					'fallback' => 'logo-black.png',
					'alt'      => get_bloginfo( 'name' ),
					'eager'    => true,
					'sizes'    => '(min-width: 1100px) 200px, 150px',
				)
			);
			?>
		</a>

		<nav class="nav" aria-label="<?php esc_attr_e( 'Primary', 'bdyculture' ); ?>">
			<?php foreach ( $bdy_nav as $bdy_item ) : ?>
				<?php
				$bdy_label = isset( $bdy_item['nav_label'] ) ? $bdy_item['nav_label'] : '';
				if ( '' === trim( (string) $bdy_label ) ) {
					continue;
				}
				$bdy_children = isset( $bdy_item['nav_children'] ) && is_array( $bdy_item['nav_children'] ) ? $bdy_item['nav_children'] : array();
				$bdy_href     = isset( $bdy_item['nav_link'] ) ? bdy_link( $bdy_item['nav_link'] ) : '';
				$bdy_current  = ! empty( $bdy_item['nav_current'] ) || bdy_is_current( isset( $bdy_item['nav_link'] ) ? $bdy_item['nav_link'] : '' );
				$bdy_blank    = ! empty( $bdy_item['nav_new_tab'] ) ? ' target="_blank" rel="noopener"' : '';
				?>
				<?php if ( $bdy_children ) : ?>
					<div class="nav__dd">
						<a href="<?php echo esc_url( $bdy_href ); ?>" class="nav__dd-trigger" aria-haspopup="true"<?php echo $bdy_blank; // phpcs:ignore WordPress.Security.EscapeOutput -- static attribute string. ?>>
							<?php echo esc_html( $bdy_label ); ?>
							<svg width="10" height="10" viewBox="0 0 10 10" aria-hidden="true"><path d="M1 3l4 4 4-4" fill="none" stroke="currentColor" stroke-width="1.6"/></svg>
						</a>
						<div class="nav__menu">
							<?php foreach ( $bdy_children as $bdy_child ) : ?>
								<?php
								$bdy_child_label = isset( $bdy_child['child_label'] ) ? $bdy_child['child_label'] : '';
								if ( '' === trim( (string) $bdy_child_label ) ) {
									continue;
								}
								$bdy_child_alt  = ! empty( $bdy_child['child_alt'] );
								$bdy_child_ico  = isset( $bdy_child['child_icon'] ) ? $bdy_child['child_icon'] : '';
								$bdy_child_link = bdy_link( isset( $bdy_child['child_link'] ) ? $bdy_child['child_link'] : '' );
								$bdy_child_cur  = ! empty( $bdy_child['child_current'] );
								$bdy_child_blank = ! empty( $bdy_child['child_new_tab'] ) ? ' target="_blank" rel="noopener"' : '';
								?>
								<a href="<?php echo esc_url( $bdy_child_link ); ?>"<?php echo $bdy_child_alt ? ' class="nav__menu-alt"' : ''; ?><?php echo $bdy_child_cur ? ' aria-current="page"' : ''; ?><?php echo $bdy_child_blank; // phpcs:ignore WordPress.Security.EscapeOutput -- static attribute strings. ?>>
									<?php echo bdy_icon( $bdy_child_ico, array( 'class' => 'nav__ico', 'size' => 22, 'stroke' => '1.8' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- whitelisted SVG. ?>
									<?php echo esc_html( $bdy_child_label ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php else : ?>
					<a href="<?php echo esc_url( $bdy_href ); ?>"<?php echo $bdy_current ? ' aria-current="page"' : ''; ?><?php echo $bdy_blank; // phpcs:ignore WordPress.Security.EscapeOutput -- static attribute string. ?>><?php echo esc_html( $bdy_label ); ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</nav>

		<div class="header__cta">
			<?php if ( $bdy_phone ) : ?>
				<a class="header__phone" href="<?php echo esc_url( 'tel:' . bdy_phone_number() ); ?>">
					<?php echo bdy_phone_svg(); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?>
					<span><?php echo esc_html( $bdy_phone ); ?></span>
				</a>
			<?php endif; ?>

			<?php if ( $bdy_enq_txt ) : ?>
				<a class="btn btn--ghost header__enquire" href="<?php echo esc_url( $bdy_enq_href ); ?>" data-focus-form><?php echo esc_html( $bdy_enq_txt ); ?></a>
			<?php endif; ?>

			<?php if ( $bdy_book && $bdy_book_txt ) : ?>
				<a class="btn btn--ink" href="<?php echo esc_url( $bdy_book ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $bdy_book_txt ); ?></a>
			<?php endif; ?>
		</div>

		<?php if ( $bdy_phone ) : ?>
			<a class="header__call" href="<?php echo esc_url( 'tel:' . bdy_phone_number() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Call %s', 'bdyculture' ), $bdy_phone ) ); ?>">
				<?php echo bdy_phone_svg( 22 ); // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG. ?>
			</a>
		<?php endif; ?>

		<button class="nav-toggle" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'bdyculture' ); ?>" aria-expanded="false" aria-controls="drawer"><span></span><span></span></button>
	</div>
</header>

<?php get_template_part( 'template-parts/global/drawer' ); ?>

<main id="main">
