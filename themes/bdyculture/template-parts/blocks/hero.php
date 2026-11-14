<?php
/**
 * Block — inner page hero (breadcrumbs, H1, lead, buttons, checks + enquiry card).
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_title    = bdy_b( $args, 'title' );
$bdy_lead     = bdy_b( $args, 'lead' );
$bdy_crumbs   = bdy_b_items( $args, 'crumbs' );
$bdy_current  = bdy_b( $args, 'crumb_current' );
$bdy_buttons  = bdy_b_items( $args, 'buttons' );
$bdy_checks   = bdy_b_items( $args, 'checks' );
$bdy_form     = isset( $args['form'] ) ? (bool) $args['form'] : true;
$bdy_no_form  = ! $bdy_form;

/* Breadcrumbs are only authored when they differ from the obvious trail. */
if ( ! $bdy_current ) {
	$bdy_current = get_the_title();
}

if ( ! $bdy_crumbs ) {
	$bdy_crumbs = array(
		array(
			'label' => __( 'Home', 'bdyculture' ),
			'url'   => '/',
		),
	);
}
?>
<section class="hero hero--inner<?php echo $bdy_no_form ? ' hero--noform' : ''; ?>" aria-labelledby="hero-title">
	<div class="container hero__grid">
		<div class="hero__copy">
			<?php if ( $bdy_crumbs || $bdy_current ) : ?>
				<nav class="crumbs" aria-label="<?php esc_attr_e( 'Breadcrumb', 'bdyculture' ); ?>">
					<?php
					$bdy_first = true;
					foreach ( $bdy_crumbs as $bdy_crumb ) :
						if ( ! $bdy_first ) :
							?>
							<span aria-hidden="true">/</span>
							<?php
						endif;
						$bdy_first = false;
						?>
						<a href="<?php echo esc_url( bdy_link( bdy_b_row( $bdy_crumb, 'url' ) ) ); ?>"><?php echo esc_html( bdy_b_row( $bdy_crumb, 'label' ) ); ?></a>
					<?php endforeach; ?>
					<?php if ( $bdy_current ) : ?>
						<?php if ( $bdy_crumbs ) : ?>
							<span aria-hidden="true">/</span>
						<?php endif; ?>
						<span aria-current="page"><?php echo esc_html( $bdy_current ); ?></span>
					<?php endif; ?>
				</nav>
			<?php endif; ?>

			<h1 id="hero-title"><?php echo esc_html( $bdy_title ); ?></h1>

			<?php if ( $bdy_lead ) : ?>
				<p class="lead"><?php echo esc_html( $bdy_lead ); ?></p>
			<?php endif; ?>

			<?php if ( $bdy_buttons ) : ?>
				<div class="hero__btns">
					<?php bdy_b_buttons( $bdy_buttons ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $bdy_checks ) : ?>
				<ul class="hero__checks">
					<?php foreach ( $bdy_checks as $bdy_check ) : ?>
						<li><?php echo esc_html( is_array( $bdy_check ) ? bdy_b_row( $bdy_check, 'text' ) : $bdy_check ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<?php if ( ! $bdy_no_form ) : ?>
			<?php get_template_part( 'template-parts/global/enquiry-card', null, $args ); ?>
		<?php endif; ?>
	</div>
</section>
