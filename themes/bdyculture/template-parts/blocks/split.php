<?php
/**
 * Block — split section (prose + photo, prose + note card, either way round).
 *
 * @package BDYCULTURE
 *
 * @var array $args Block data.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_tag     = bdy_b( $args, 'tag' );
$bdy_title   = bdy_b( $args, 'title' );
$bdy_body    = bdy_b( $args, 'body' );
$bdy_note    = bdy_b( $args, 'note' );
$bdy_buttons = bdy_b_items( $args, 'buttons' );
$bdy_media   = bdy_b_items( $args, 'media' );
$bdy_panel   = bdy_b_items( $args, 'panel' );
$bdy_reverse = bdy_b_flag( $args, 'reverse' );
$bdy_paper   = bdy_b_flag( $args, 'paper' );
$bdy_has_media = ! empty( $bdy_media['image'] );
$bdy_has_panel = ! empty( $bdy_panel['title'] ) || ! empty( $bdy_panel['body'] ) || ! empty( $bdy_panel['rows'] ) || ! empty( $bdy_panel['links'] );
?>
<section class="section<?php echo $bdy_paper ? ' section--paper' : ''; ?>">
	<div class="container split<?php echo $bdy_reverse ? ' split--rev' : ''; ?>">
		<?php
		if ( $bdy_has_media && $bdy_reverse ) :
			?>
			<figure class="split__media media-frame--swept reveal">
				<?php
				echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
					$bdy_media['image'],
					array(
						'class'    => 'img-crop',
						'fallback' => $bdy_media['image'],
						'alt'      => isset( $bdy_media['alt'] ) ? $bdy_media['alt'] : '',
						'attr'     => array( 'style' => isset( $bdy_media['crop'] ) ? $bdy_media['crop'] : '' ),
					)
				);
				?>
			</figure>
			<?php
		endif;
		?>

		<div class="prose">
			<?php bdy_b_tag( $bdy_tag ); ?>
			<?php if ( $bdy_title ) : ?>
				<h2 class="reveal"><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
			<?php echo bdy_b_body( $bdy_body ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?>
			<?php if ( $bdy_buttons ) : ?>
				<div class="inline-ctas reveal">
					<?php bdy_b_buttons( $bdy_buttons, '' ); ?>
				</div>
			<?php endif; ?>
			<?php if ( $bdy_note ) : ?>
				<div class="note-links"><?php echo bdy_b_body( $bdy_note ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></div>
			<?php endif; ?>
		</div>

		<?php if ( $bdy_has_media && ! $bdy_reverse ) : ?>
			<figure class="split__media media-frame--swept reveal">
				<?php
				echo bdy_image( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside the helper.
					$bdy_media['image'],
					array(
						'class'    => 'img-crop',
						'fallback' => $bdy_media['image'],
						'alt'      => isset( $bdy_media['alt'] ) ? $bdy_media['alt'] : '',
						'attr'     => array( 'style' => isset( $bdy_media['crop'] ) ? $bdy_media['crop'] : '' ),
					)
				);
				?>
			</figure>
		<?php endif; ?>

		<?php if ( ! $bdy_has_media && $bdy_has_panel ) : ?>
			<aside class="note-card reveal" aria-label="<?php echo esc_attr( isset( $bdy_panel['title'] ) ? $bdy_panel['title'] : '' ); ?>">
				<?php if ( ! empty( $bdy_panel['title'] ) ) : ?>
					<h3><?php echo esc_html( $bdy_panel['title'] ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $bdy_panel['body'] ) ) : ?>
					<?php echo bdy_b_body( $bdy_panel['body'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?>
				<?php endif; ?>

				<?php if ( ! empty( $bdy_panel['rows'] ) ) : ?>
					<dl>
						<?php foreach ( $bdy_panel['rows'] as $bdy_row ) : ?>
							<div>
								<dt><?php echo esc_html( bdy_b_row( $bdy_row, 'label' ) ); ?></dt>
								<dd><?php echo bdy_b_body( bdy_b_row( $bdy_row, 'value' ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- kses. ?></dd>
							</div>
						<?php endforeach; ?>
					</dl>
				<?php endif; ?>

				<?php if ( ! empty( $bdy_panel['links'] ) ) : ?>
					<ul class="note-links">
						<?php foreach ( $bdy_panel['links'] as $bdy_row ) : ?>
							<li><a href="<?php echo esc_url( bdy_link( bdy_b_row( $bdy_row, 'url' ) ) ); ?>"><?php echo esc_html( bdy_b_row( $bdy_row, 'text' ) ); ?> <i aria-hidden="true">→</i></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if ( ! empty( $bdy_panel['buttons'] ) ) : ?>
					<?php bdy_b_buttons( $bdy_panel['buttons'], '' ); ?>
				<?php endif; ?>
			</aside>
		<?php endif; ?>
	</div>
</section>
