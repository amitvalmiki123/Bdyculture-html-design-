<?php
/**
 * Shared band — Contact ("Get in touch").
 *
 * Printed at the end of the homepage, every inner page, the blog index and
 * single posts. The copy lives in Theme Settings (Contact band tab); pages only
 * store their own show/order. Rendered by bdy_render_shared_bands().
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_g        = bdy_defaults( 'global' );
$bdy_tag      = bdy_string( 'contact_tag', $bdy_g['contact_tag'], 'option' );
$bdy_title    = bdy_html( 'contact_title', $bdy_g['contact_title'], 'option' );
$bdy_intro    = bdy_html( 'contact_intro', $bdy_g['contact_intro'], 'option' );
$bdy_list     = bdy_rows( 'contact_list', $bdy_g['contact_list'], 'option' );
$bdy_phone    = bdy_phone_display();
// The form itself is built in Contact Form 7 (or another form plugin) — only
// the heading, the note and the shortcode are stored here. Everything below
// them is the design's own markup, used as a fallback until a shortcode exists.
$bdy_sc       = bdy_string( 'contact_form_shortcode', $bdy_g['contact_form_shortcode'], 'option' );
$bdy_f_title  = bdy_string( 'contact_form_title', $bdy_g['contact_form_title'], 'option' );
$bdy_f_intro  = bdy_tokens( wp_kses_post( $bdy_g['contact_form_intro'] ) );
$bdy_types    = $bdy_g['contact_form_types'];
$bdy_interest = $bdy_g['contact_form_interests'];
$bdy_ok_title = $bdy_g['contact_form_success_title'];
$bdy_ok_text  = bdy_tokens( wp_kses_post( $bdy_g['contact_form_success_text'] ) );
$bdy_note     = bdy_html( 'contact_form_note', $bdy_g['contact_form_note'], 'option' );

$bdy_labels = array(
	'name'     => $bdy_g['contact_form_label_name'],
	'phone'    => $bdy_g['contact_form_label_phone'],
	'email'    => $bdy_g['contact_form_label_email'],
	'type'     => $bdy_g['contact_form_label_type'],
	'interest' => $bdy_g['contact_form_label_interest'],
	'message'  => $bdy_g['contact_form_label_message'],
);
?>
<section class="section section--dark contact has-arcs" id="contact"<?php echo $bdy_title ? ' aria-labelledby="contact-title"' : ''; ?>>
	<div class="container contact__grid">
		<div class="contact__info reveal">
			<?php if ( $bdy_tag ) : ?>
				<p class="tag tag--light"><?php echo esc_html( $bdy_tag ); ?></p>
			<?php endif; ?>

			<?php if ( $bdy_title ) : ?>
				<h2 id="contact-title"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h2>
			<?php endif; ?>

			<?php if ( $bdy_intro ) : ?>
				<p class="section__intro"><?php echo $bdy_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php if ( $bdy_phone ) : ?>
				<a class="contact__phone" href="<?php echo esc_url( 'tel:' . bdy_phone_number() ); ?>"><?php echo esc_html( $bdy_phone ); ?></a>
			<?php endif; ?>

			<?php if ( $bdy_list ) : ?>
				<dl class="contact__list">
					<?php foreach ( $bdy_list as $bdy_row ) : ?>
						<?php
						$bdy_label = isset( $bdy_row['contact_list_label'] ) ? $bdy_row['contact_list_label'] : '';
						$bdy_value = isset( $bdy_row['contact_list_value'] ) ? $bdy_row['contact_list_value'] : '';

						if ( '' === trim( (string) $bdy_label ) && '' === trim( (string) $bdy_value ) ) {
							continue;
						}
						?>
						<div>
							<?php if ( $bdy_label ) : ?>
								<dt><?php echo esc_html( $bdy_label ); ?></dt>
							<?php endif; ?>
							<?php if ( $bdy_value ) : ?>
								<dd<?php echo ! empty( $bdy_row['contact_list_placeholder'] ) ? ' class="contact__placeholder"' : ''; ?>><?php echo bdy_tokens( wp_kses_post( $bdy_value ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post + tokens. ?></dd>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</dl>
			<?php endif; ?>

			<?php
			echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
				bdy_string( 'contact_btn_text', $bdy_g['contact_btn_text'], 'option' ),
				bdy_string( 'contact_btn_url', $bdy_g['contact_btn_url'], 'option' ),
				'signal',
				array(
					'size'    => 'lg',
					'icon'    => bdy_string( 'contact_btn_icon', $bdy_g['contact_btn_icon'], 'option' ),
					'new_tab' => true,
				)
			);
			?>
		</div>

		<?php if ( $bdy_sc ) : ?>
			<div class="card-form card-form--light reveal">
				<?php if ( $bdy_f_title ) : ?>
					<div class="card-form__head">
						<h3><?php echo esc_html( $bdy_f_title ); ?></h3>
					</div>
				<?php endif; ?>
				<?php bdy_form( $bdy_sc, '__return_false' ); ?>
				<?php if ( $bdy_note ) : ?>
					<p class="form-note"><?php echo $bdy_note; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<form class="card-form card-form--light reveal" data-form novalidate>
				<?php if ( $bdy_f_title || $bdy_f_intro ) : ?>
					<div class="card-form__head">
						<?php if ( $bdy_f_title ) : ?>
							<h3><?php echo esc_html( $bdy_f_title ); ?></h3>
						<?php endif; ?>
						<?php if ( $bdy_f_intro ) : ?>
							<p><?php echo $bdy_f_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="field-row">
					<?php if ( $bdy_labels['name'] ) : ?>
						<div class="field"><label for="cf-name"><?php echo esc_html( $bdy_labels['name'] ); ?></label><input id="cf-name" name="name" type="text" autocomplete="name" required></div>
					<?php endif; ?>
					<?php if ( $bdy_labels['phone'] ) : ?>
						<div class="field"><label for="cf-phone"><?php echo esc_html( $bdy_labels['phone'] ); ?></label><input id="cf-phone" name="phone" type="tel" autocomplete="tel" required></div>
					<?php endif; ?>
				</div>

				<div class="field-row">
					<?php if ( $bdy_labels['email'] ) : ?>
						<div class="field"><label for="cf-email"><?php echo esc_html( $bdy_labels['email'] ); ?></label><input id="cf-email" name="email" type="email" autocomplete="email" required></div>
					<?php endif; ?>
					<?php if ( $bdy_labels['type'] && $bdy_types ) : ?>
						<div class="field">
							<label for="cf-service"><?php echo esc_html( $bdy_labels['type'] ); ?></label>
							<select id="cf-service" name="service">
								<?php foreach ( $bdy_types as $bdy_row ) : ?>
									<?php if ( ! empty( $bdy_row['contact_type_option_text'] ) ) : ?>
										<option><?php echo bdy_row_text( $bdy_row, 'contact_type_option_text' ); ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( $bdy_labels['interest'] && $bdy_interest ) : ?>
					<div class="field">
						<label for="cf-interest"><?php echo esc_html( $bdy_labels['interest'] ); ?></label>
						<select id="cf-interest" name="interest">
							<?php foreach ( $bdy_interest as $bdy_row ) : ?>
								<?php if ( ! empty( $bdy_row['contact_interest_option_text'] ) ) : ?>
									<option><?php echo bdy_row_text( $bdy_row, 'contact_interest_option_text' ); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				<?php endif; ?>

				<?php if ( $bdy_labels['message'] ) : ?>
					<div class="field field--grow"><label for="cf-msg"><?php echo esc_html( $bdy_labels['message'] ); ?></label><textarea id="cf-msg" name="message" rows="4"></textarea></div>
				<?php endif; ?>

				<?php if ( $bdy_g['contact_form_button'] ) : ?>
					<button class="btn btn--ink btn--block btn--lg" type="submit"><?php echo esc_html( $bdy_g['contact_form_button'] ); ?></button>
				<?php endif; ?>

				<?php if ( $bdy_note ) : ?>
					<p class="form-note"><?php echo $bdy_note; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post + tokens. ?></p>
				<?php endif; ?>

				<?php if ( $bdy_ok_title || $bdy_ok_text ) : ?>
					<div class="form-ok" role="status" hidden>
						<span class="form-ok__dot" aria-hidden="true"></span>
						<?php if ( $bdy_ok_title ) : ?>
							<h3><?php echo esc_html( $bdy_ok_title ); ?></h3>
						<?php endif; ?>
						<?php if ( $bdy_ok_text ) : ?>
							<p><?php echo $bdy_ok_text; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</form>
		<?php endif; ?>
	</div>
</section>
