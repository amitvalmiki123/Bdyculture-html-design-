<?php
/**
 * Home — Contact (clinic details + message form).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d        = bdy_section_defaults( 'home', 'contact' );
$bdy_tag      = bdy_string( 'home_contact_tag', $bdy_d['home_contact_tag'] );
$bdy_title    = bdy_html( 'home_contact_title', $bdy_d['home_contact_title'] );
$bdy_intro    = bdy_html( 'home_contact_intro', $bdy_d['home_contact_intro'] );
$bdy_list     = bdy_rows( 'home_contact_list', $bdy_d['home_contact_list'] );
$bdy_phone    = bdy_phone_display();
$bdy_sc       = bdy_string( 'home_contact_form_shortcode', $bdy_d['home_contact_form_shortcode'] );
$bdy_f_title  = bdy_string( 'home_contact_form_title', $bdy_d['home_contact_form_title'] );
$bdy_f_intro  = bdy_html( 'home_contact_form_intro', $bdy_d['home_contact_form_intro'] );
$bdy_types    = bdy_rows( 'home_contact_form_types', $bdy_d['home_contact_form_types'] );
$bdy_interest = bdy_rows( 'home_contact_form_interests', $bdy_d['home_contact_form_interests'] );
$bdy_ok_title = bdy_string( 'home_contact_form_success_title', $bdy_d['home_contact_form_success_title'] );
$bdy_ok_text  = bdy_html( 'home_contact_form_success_text', $bdy_d['home_contact_form_success_text'] );

$bdy_labels = array(
	'name'     => bdy_string( 'home_contact_form_label_name', $bdy_d['home_contact_form_label_name'] ),
	'phone'    => bdy_string( 'home_contact_form_label_phone', $bdy_d['home_contact_form_label_phone'] ),
	'email'    => bdy_string( 'home_contact_form_label_email', $bdy_d['home_contact_form_label_email'] ),
	'type'     => bdy_string( 'home_contact_form_label_type', $bdy_d['home_contact_form_label_type'] ),
	'interest' => bdy_string( 'home_contact_form_label_interest', $bdy_d['home_contact_form_label_interest'] ),
	'message'  => bdy_string( 'home_contact_form_label_message', $bdy_d['home_contact_form_label_message'] ),
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
				bdy_string( 'home_contact_btn_text', $bdy_d['home_contact_btn_text'] ),
				bdy_string( 'home_contact_btn_url', $bdy_d['home_contact_btn_url'] ),
				'signal',
				array(
					'size'    => 'lg',
					'icon'    => bdy_string( 'home_contact_btn_icon', $bdy_d['home_contact_btn_icon'] ),
					'new_tab' => true,
				)
			);
			?>
		</div>

		<?php if ( $bdy_sc ) : ?>
			<div class="card-form card-form--light reveal">
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
				<?php bdy_form( $bdy_sc, '__return_false' ); ?>
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
										<option><?php echo esc_html( $bdy_row['contact_type_option_text'] ); ?></option>
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
									<option><?php echo esc_html( $bdy_row['contact_interest_option_text'] ); ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
				<?php endif; ?>

				<?php if ( $bdy_labels['message'] ) : ?>
					<div class="field field--grow"><label for="cf-msg"><?php echo esc_html( $bdy_labels['message'] ); ?></label><textarea id="cf-msg" name="message" rows="4"></textarea></div>
				<?php endif; ?>

				<?php if ( bdy_string( 'home_contact_form_button', $bdy_d['home_contact_form_button'] ) ) : ?>
					<button class="btn btn--ink btn--block btn--lg" type="submit"><?php echo esc_html( bdy_string( 'home_contact_form_button', $bdy_d['home_contact_form_button'] ) ); ?></button>
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
