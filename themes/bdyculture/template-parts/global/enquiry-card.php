<?php
/**
 * Global — the enquiry card that sits beside inner-page heroes.
 *
 * The card is a Contact Form 7 form: Site Settings → Enquiry card stores the
 * tag, the heading, the lines under the form and the shortcode. The design's
 * own markup stays as a fallback until a shortcode is entered. A hero section
 * can still carry its own card: give the hero some "Card — fields" rows and
 * that card is used for the page.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_g   = bdy_defaults( 'global' );
$bdy_own = isset( $args ) && is_array( $args ) ? $args : array();
$bdy_own = ! empty( $bdy_own['form_fields'] ) ? $bdy_own : array();

/**
 * Read one string from the hero overrides, falling back to Site Settings.
 *
 * @param string $key Override key.
 * @param string $def Site Settings default.
 * @return string
 */
$bdy_card = static function ( $key, $def ) use ( $bdy_own ) {
	if ( $bdy_own && ! empty( $bdy_own[ $key ] ) ) {
		return (string) $bdy_own[ $key ];
	}

	return (string) $def;
};

$bdy_tag      = $bdy_card( 'form_tag', bdy_string( 'enquiry_tag', $bdy_g['enquiry_tag'], 'option' ) );
$bdy_title    = $bdy_card( 'form_title', bdy_string( 'enquiry_title', $bdy_g['enquiry_title'], 'option' ) );
$bdy_intro    = $bdy_card( 'form_intro', $bdy_g['enquiry_intro'] );
$bdy_note     = $bdy_card( 'form_note', bdy_html( 'enquiry_note', $bdy_g['enquiry_note'], 'option' ) );
$bdy_sc       = $bdy_card( 'form_shortcode', bdy_string( 'enquiry_shortcode', $bdy_g['enquiry_shortcode'], 'option' ) );

// The design's own form (used until a shortcode is set, and for a hero that
// carries its own licence card). These are static defaults, not ACF fields.
$bdy_button   = $bdy_card( 'form_button', $bdy_g['enquiry_button'] );
$bdy_ok_title = $bdy_card( 'form_success_title', $bdy_g['enquiry_success_title'] );
$bdy_ok_text  = $bdy_card( 'form_success_text', $bdy_g['enquiry_success_text'] );

$bdy_book = bdy_booking_url();
$bdy_alt  = '';

if ( ! $bdy_own ) {
	$bdy_alt_text = bdy_string( 'enquiry_alt_text', $bdy_g['enquiry_alt_text'], 'option' );
	$bdy_alt_link = bdy_string( 'enquiry_alt_link_text', $bdy_g['enquiry_alt_link_text'], 'option' );

	if ( $bdy_alt_text && $bdy_alt_link && $bdy_book ) {
		$bdy_alt = '<p class="card-form__alt">' . esc_html( $bdy_alt_text ) . ' <a href="' . esc_url( $bdy_book ) . '" target="_blank" rel="noopener">' . esc_html( $bdy_alt_link ) . ' &rarr;</a></p>';
	}
}

/* The custom card's note and success line may carry links, so they go through kses. */
$bdy_note    = wp_kses_post( bdy_tokens( $bdy_note ) );
$bdy_ok_text = wp_kses_post( bdy_tokens( $bdy_ok_text ) );
?>
<aside class="hero__form" id="enquire" aria-labelledby="hf-title">
	<?php $bdy_plugin = ( ! $bdy_own && '' !== trim( (string) $bdy_sc ) && false !== strpos( (string) $bdy_sc, '[' ) ); ?>
	<?php if ( $bdy_plugin ) : ?>
	<div class="card-form card-form--plugin">
	<?php else : ?>
	<form class="card-form" data-form novalidate>
	<?php endif; ?>
		<div class="card-form__head">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag tag--light"><?php echo esc_html( $bdy_tag ); ?></p>
			<?php endif; ?>
			<?php if ( $bdy_title ) : ?>
				<h2 id="hf-title"><?php echo esc_html( $bdy_title ); ?></h2>
			<?php endif; ?>
			<?php if ( $bdy_intro && ! $bdy_plugin ) : ?>
				<p><?php echo esc_html( $bdy_intro ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $bdy_plugin ) : ?>

			<?php bdy_form( $bdy_sc, '__return_false' ); ?>

		<?php elseif ( $bdy_own ) : ?>

			<?php
			$bdy_fields = bdy_b_items( $bdy_own, 'form_fields' );
			$bdy_row    = array();

			/**
			 * Print one field, wrapping it in its own div.
			 *
			 * @param array $field Field row.
			 */
			$bdy_print_field = static function ( $field ) {
				$label = bdy_b_row( $field, 'label' );
				$name  = bdy_b_row( $field, 'name' );
				$type  = bdy_b_row( $field, 'type' );
				$auto  = bdy_b_row( $field, 'autocomplete' );
				$req   = ! empty( $field['required'] );
				$id    = 'hf-' . ( $name ? $name : 'field' );

				if ( ! $name ) {
					return;
				}

				if ( ! in_array( $type, array( 'text', 'email', 'tel', 'number', 'date', 'url' ), true ) ) {
					$type = 'text';
				}
				?>
				<div class="field">
					<label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label>
					<input id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" type="<?php echo esc_attr( $type ); ?>"<?php echo $auto ? ' autocomplete="' . esc_attr( $auto ) . '"' : ''; ?><?php echo $req ? ' required' : ''; ?>>
				</div>
				<?php
			};

			foreach ( $bdy_fields as $bdy_field ) {
				if ( ! empty( $bdy_field['half'] ) ) {
					$bdy_row[] = $bdy_field;

					if ( 2 === count( $bdy_row ) ) {
						echo '<div class="field-row">';
						foreach ( $bdy_row as $bdy_cell ) {
							$bdy_print_field( $bdy_cell );
						}
						echo '</div>';
						$bdy_row = array();
					}

					continue;
				}

				if ( $bdy_row ) {
					foreach ( $bdy_row as $bdy_cell ) {
						$bdy_print_field( $bdy_cell );
					}
					$bdy_row = array();
				}

				$bdy_print_field( $bdy_field );
			}

			if ( $bdy_row ) {
				foreach ( $bdy_row as $bdy_cell ) {
					$bdy_print_field( $bdy_cell );
				}
			}
			?>

		<?php else : ?>

			<div class="field">
				<label for="hf-name"><?php echo esc_html( $bdy_g['enquiry_label_name'] ); ?></label>
				<input id="hf-name" name="name" type="text" autocomplete="name" required>
			</div>

			<div class="field-row">
				<div class="field">
					<label for="hf-phone"><?php echo esc_html( $bdy_g['enquiry_label_phone'] ); ?></label>
					<input id="hf-phone" name="phone" type="tel" autocomplete="tel" required>
				</div>
				<div class="field">
					<label for="hf-email"><?php echo esc_html( $bdy_g['enquiry_label_email'] ); ?></label>
					<input id="hf-email" name="email" type="email" autocomplete="email" required>
				</div>
			</div>

			<?php $bdy_options = $bdy_g['enquiry_options']; ?>
			<div class="field">
				<label for="hf-service"><?php echo esc_html( $bdy_g['enquiry_label_service'] ); ?></label>
				<select id="hf-service" name="service">
					<?php foreach ( $bdy_options as $bdy_option ) : ?>
						<?php
						$bdy_opt_text = is_array( $bdy_option ) ? bdy_b_row( $bdy_option, 'text' ) : $bdy_option;

						if ( '' === trim( (string) $bdy_opt_text ) ) {
							continue;
						}

						$bdy_opt_sel = is_array( $bdy_option ) && ! empty( $bdy_option['selected'] );
						?>
						<option<?php echo $bdy_opt_sel ? ' selected' : ''; ?>><?php echo esc_html( $bdy_opt_text ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

		<?php endif; ?>

		<?php if ( ! $bdy_plugin ) : ?>
			<button class="btn btn--signal btn--block btn--lg" type="submit"><?php echo esc_html( $bdy_button ); ?></button>
		<?php endif; ?>

		<?php if ( $bdy_note ) : ?>
			<p class="form-note"><?php echo $bdy_note; // phpcs:ignore WordPress.Security.EscapeOutput -- kses + tokens. ?></p>
		<?php endif; ?>

		<?php echo $bdy_alt; // phpcs:ignore WordPress.Security.EscapeOutput -- built above from escaped parts. ?>

		<?php if ( ! $bdy_plugin ) : ?>
			<div class="form-ok" role="status" hidden>
				<span class="form-ok__dot" aria-hidden="true"></span>
				<h3><?php echo esc_html( $bdy_ok_title ); ?></h3>
				<p><?php echo $bdy_ok_text; // phpcs:ignore WordPress.Security.EscapeOutput -- kses + tokens. ?></p>
			</div>
		<?php endif; ?>
	<?php if ( $bdy_plugin ) : ?>
	</div>
	<?php else : ?>
	</form>
	<?php endif; ?>
</aside>
