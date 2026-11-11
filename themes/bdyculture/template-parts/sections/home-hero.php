<?php
/**
 * Home — Hero (H1 + lead + buttons + checklist + enquiry card).
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdy_d        = bdy_section_defaults( 'home', 'hero' );
$bdy_title    = bdy_html( 'home_hero_title', $bdy_d['home_hero_title'] );
$bdy_lead     = bdy_html( 'home_hero_lead', $bdy_d['home_hero_lead'] );
$bdy_buttons  = bdy_rows( 'home_hero_buttons', $bdy_d['home_hero_buttons'] );
$bdy_checks   = bdy_rows( 'home_hero_checks', $bdy_d['home_hero_checks'] );
$bdy_raw      = bdy_get( 'home_hero_image', '', bdy_context() );
$bdy_image    = $bdy_raw ? bdy_image_url( $bdy_raw ) : '';
$bdy_style    = $bdy_image ? ' style="' . esc_attr( '--hero-image:url(' . $bdy_image . ')' ) . '"' : '';

$bdy_sc       = bdy_string( 'home_hero_form_shortcode', $bdy_d['home_hero_form_shortcode'] );
$bdy_tag      = bdy_string( 'home_hero_form_tag', $bdy_d['home_hero_form_tag'] );
$bdy_f_title  = bdy_string( 'home_hero_form_title', $bdy_d['home_hero_form_title'] );
$bdy_f_intro  = bdy_html( 'home_hero_form_intro', $bdy_d['home_hero_form_intro'] );
$bdy_options  = bdy_rows( 'home_hero_form_options', $bdy_d['home_hero_form_options'] );
$bdy_btn      = bdy_string( 'home_hero_form_button', $bdy_d['home_hero_form_button'] );
$bdy_alt_txt  = bdy_string( 'home_hero_form_alt_text', $bdy_d['home_hero_form_alt_text'] );
$bdy_alt_link = bdy_string( 'home_hero_form_alt_link_text', $bdy_d['home_hero_form_alt_link_text'] );
$bdy_book     = bdy_booking_url();
$bdy_ok_title = bdy_string( 'home_hero_form_success_title', $bdy_d['home_hero_form_success_title'] );
$bdy_ok_text  = bdy_html( 'home_hero_form_success_text', $bdy_d['home_hero_form_success_text'] );
?>
<section class="hero"<?php echo $bdy_title ? ' aria-labelledby="hero-title"' : ''; ?><?php echo $bdy_style; // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above. ?>>
	<div class="container hero__grid">
		<div class="hero__copy">
			<?php if ( $bdy_title ) : ?>
				<h1 id="hero-title" class="reveal"><?php echo $bdy_title; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></h1>
			<?php endif; ?>

			<?php if ( $bdy_lead ) : ?>
				<p class="lead reveal"><?php echo $bdy_lead; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
			<?php endif; ?>

			<?php if ( $bdy_buttons ) : ?>
				<div class="hero__btns reveal">
					<?php foreach ( $bdy_buttons as $bdy_row ) : ?>
						<?php
						echo bdy_button( // phpcs:ignore WordPress.Security.EscapeOutput -- escaped inside helper.
							isset( $bdy_row['hero_btn_text'] ) ? $bdy_row['hero_btn_text'] : '',
							isset( $bdy_row['hero_btn_url'] ) ? $bdy_row['hero_btn_url'] : '',
							isset( $bdy_row['hero_btn_style'] ) ? $bdy_row['hero_btn_style'] : 'signal',
							array(
								'size'    => 'lg',
								'icon'    => isset( $bdy_row['hero_btn_icon'] ) ? $bdy_row['hero_btn_icon'] : '',
								'new_tab' => ! empty( $bdy_row['hero_btn_new_tab'] ),
								'class'   => ( isset( $bdy_row['hero_btn_style'] ) && 'ghost' === $bdy_row['hero_btn_style'] ) ? 'hero__refer' : '',
							)
						);
						?>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $bdy_checks ) : ?>
				<ul class="hero__checks reveal">
					<?php foreach ( $bdy_checks as $bdy_row ) : ?>
						<?php if ( ! empty( $bdy_row['hero_check_text'] ) ) : ?>
							<li><?php echo bdy_row_text( $bdy_row, 'hero_check_text' ); ?></li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<aside class="hero__form reveal" id="enquire"<?php echo $bdy_f_title ? ' aria-labelledby="hf-title"' : ''; ?>>
			<?php if ( $bdy_sc ) : ?>
				<div class="card-form">
					<?php if ( $bdy_tag || $bdy_f_title || $bdy_f_intro ) : ?>
						<div class="card-form__head">
							<?php if ( $bdy_tag ) : ?>
								<p class="tag tag--light"><?php echo esc_html( $bdy_tag ); ?></p>
							<?php endif; ?>
							<?php if ( $bdy_f_title ) : ?>
								<h2 id="hf-title"><?php echo esc_html( $bdy_f_title ); ?></h2>
							<?php endif; ?>
							<?php if ( $bdy_f_intro ) : ?>
								<p><?php echo $bdy_f_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<?php bdy_form( $bdy_sc, '__return_false' ); ?>
				</div>
			<?php else : ?>
				<form class="card-form" data-form novalidate>
					<?php if ( $bdy_tag || $bdy_f_title || $bdy_f_intro ) : ?>
						<div class="card-form__head">
							<?php if ( $bdy_tag ) : ?>
								<p class="tag tag--light"><?php echo esc_html( $bdy_tag ); ?></p>
							<?php endif; ?>
							<?php if ( $bdy_f_title ) : ?>
								<h2 id="hf-title"><?php echo esc_html( $bdy_f_title ); ?></h2>
							<?php endif; ?>
							<?php if ( $bdy_f_intro ) : ?>
								<p><?php echo $bdy_f_intro; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_kses_post. ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php
					$bdy_labels = array(
						'name'    => bdy_string( 'home_hero_form_label_name', $bdy_d['home_hero_form_label_name'] ),
						'phone'   => bdy_string( 'home_hero_form_label_phone', $bdy_d['home_hero_form_label_phone'] ),
						'email'   => bdy_string( 'home_hero_form_label_email', $bdy_d['home_hero_form_label_email'] ),
						'service' => bdy_string( 'home_hero_form_label_service', $bdy_d['home_hero_form_label_service'] ),
					);
					?>

					<?php if ( $bdy_labels['name'] ) : ?>
						<div class="field"><label for="hf-name"><?php echo esc_html( $bdy_labels['name'] ); ?></label><input id="hf-name" name="name" type="text" autocomplete="name" required></div>
					<?php endif; ?>

					<div class="field-row">
						<?php if ( $bdy_labels['phone'] ) : ?>
							<div class="field"><label for="hf-phone"><?php echo esc_html( $bdy_labels['phone'] ); ?></label><input id="hf-phone" name="phone" type="tel" autocomplete="tel" required></div>
						<?php endif; ?>
						<?php if ( $bdy_labels['email'] ) : ?>
							<div class="field"><label for="hf-email"><?php echo esc_html( $bdy_labels['email'] ); ?></label><input id="hf-email" name="email" type="email" autocomplete="email" required></div>
						<?php endif; ?>
					</div>

					<?php if ( $bdy_labels['service'] && $bdy_options ) : ?>
						<div class="field">
							<label for="hf-service"><?php echo esc_html( $bdy_labels['service'] ); ?></label>
							<select id="hf-service" name="service">
								<?php foreach ( $bdy_options as $bdy_row ) : ?>
									<?php if ( ! empty( $bdy_row['hero_form_option_text'] ) ) : ?>
										<option><?php echo bdy_row_text( $bdy_row, 'hero_form_option_text' ); ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
					<?php endif; ?>

					<?php if ( $bdy_btn ) : ?>
						<button class="btn btn--signal btn--block btn--lg" type="submit"><?php echo esc_html( $bdy_btn ); ?></button>
					<?php endif; ?>

					<?php if ( ( $bdy_alt_txt || $bdy_alt_link ) && $bdy_book ) : ?>
						<p class="card-form__alt">
							<?php echo esc_html( $bdy_alt_txt ); ?>
							<a href="<?php echo esc_url( $bdy_book ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $bdy_alt_link ); ?></a>
						</p>
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
		</aside>
	</div>
</section>
