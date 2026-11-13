<?php
/**
 * Fill the fields with the design content.
 *
 * A fresh install already looks like the design, because every field falls
 * back to `defaults.php` / `defaults-pages.php`. That is great for launch and
 * awkward for editing: the client opens a page and the fields look empty.
 *
 * This screen writes those defaults **into the fields** — Theme Settings, the
 * front page and every inner page — so the content is visible and editable.
 *
 * Only fields the theme can safely pre-fill are written: text, textarea,
 * selects, toggles, numbers and their repeaters. Images, galleries and post
 * pickers are left empty on purpose, so they keep using the shipped design
 * photos until the client uploads their own.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Inner pages that have a shipped design, slug => WordPress page title.
 *
 * @return array
 */
function bdy_seed_pages() {
	return array(
		'services'                 => 'Services',
		'physiotherapy'            => 'Physiotherapy',
		'exercise-physiology'      => 'Exercise Physiology',
		'occupational-therapy'     => 'Occupational Therapy',
		'clinical-pilates'         => 'Clinical Pilates',
		'referrers'                => 'Referrers',
		'contact'                  => 'Contact',
		'location-chermside'       => 'Location — Chermside',
		'practice-from-bdyculture' => 'Practice from BDYCULTURE',
		'privacy-policy'           => 'Privacy Policy',
	);
}

/**
 * ACF types that are safe to pre-fill.
 *
 * Images, files, galleries, post pickers, groups and links are excluded: the
 * design files are theme assets, not media-library attachments, so writing
 * their filenames into an image field would only produce a broken preview.
 *
 * @return array
 */
function bdy_seed_types() {
	return array( 'text', 'textarea', 'email', 'url', 'number', 'password', 'select', 'checkbox', 'radio', 'true_false', 'range', 'button_group', 'wysiwyg', 'repeater', 'clone' );
}

/**
 * Clean one value against its ACF field definition.
 *
 * @param mixed $value Value from the defaults.
 * @param array $def   ACF field definition.
 * @return mixed Null when the field must be skipped.
 */
function bdy_seed_value( $value, $def ) {
	$type = isset( $def['type'] ) ? (string) $def['type'] : '';

	if ( ! in_array( $type, bdy_seed_types(), true ) ) {
		return null;
	}

	if ( 'repeater' === $type || 'clone' === $type ) {
		if ( ! is_array( $value ) ) {
			return null;
		}

		$subs = isset( $def['sub_fields'] ) && is_array( $def['sub_fields'] ) ? $def['sub_fields'] : array();
		$rows = array();

		// A row whose first sub-field is a photo or a post picker is only
		// meaningful with that value — a crop setting on its own would print
		// an empty frame, so the whole row is dropped.
		$lead      = isset( $subs[0] ) ? $subs[0] : array();
		$lead_name = isset( $lead['name'] ) ? (string) $lead['name'] : '';
		$lead_type = isset( $lead['type'] ) ? (string) $lead['type'] : '';
		$lead_media = in_array( $lead_type, array( 'image', 'file', 'gallery', 'post_object', 'relationship' ), true );

		foreach ( $value as $row ) {
			if ( ! is_array( $row ) ) {
				continue;
			}

			$clean = bdy_seed_row( $row, $subs );

			if ( $clean && ( ! $lead_media || array_key_exists( $lead_name, $clean ) ) ) {
				$rows[] = $clean;
			}
		}

		// A repeater made only of images or post pickers has nothing to
		// store — skipping it keeps the design photos in place.
		return $rows ? $rows : null;
	}

	if ( is_array( $value ) ) {
		// A flat field holding an array is a shape mismatch — skip it.
		return null;
	}

	return $value;
}

/**
 * Clean one repeater row against its sub-field definitions.
 *
 * @param array $row   Row from the defaults.
 * @param array $subs  ACF sub-field definitions.
 * @return array
 */
function bdy_seed_row( $row, $subs ) {
	$out = array();

	foreach ( $subs as $sub ) {
		$name = isset( $sub['name'] ) ? (string) $sub['name'] : '';

		if ( '' === $name || ! array_key_exists( $name, $row ) ) {
			continue;
		}

		$clean = bdy_seed_value( $row[ $name ], $sub );

		if ( null !== $clean ) {
			$out[ $name ] = $clean;
		}
	}

	return $out;
}

/**
 * Turn shipped page blocks into flexible-content rows.
 *
 * Rows whose layout does not exist in ACF are dropped, and keys the layout does
 * not define (the old `crumbs` array, for example) are dropped with them.
 *
 * @param array $sections Blocks from `bdy_page_defaults()`.
 * @param array $layouts  ACF layouts for `page_sections`.
 * @return array
 */
function bdy_seed_block_rows( $sections, $layouts ) {
	$rows = array();

	foreach ( (array) $sections as $block ) {
		if ( ! is_array( $block ) || empty( $block['type'] ) ) {
			continue;
		}

		$type   = (string) $block['type'];
		$layout = null;

		foreach ( (array) $layouts as $candidate ) {
			if ( isset( $candidate['name'] ) && $type === (string) $candidate['name'] ) {
				$layout = $candidate;
				break;
			}
		}

		if ( ! $layout ) {
			continue;
		}

		$subs = isset( $layout['sub_fields'] ) && is_array( $layout['sub_fields'] ) ? $layout['sub_fields'] : array();
		$rows[] = array_merge( array( 'acf_fc_layout' => $type ), bdy_seed_row( $block, $subs ) );
	}

	return $rows;
}

/**
 * Layouts registered for `page_sections`.
 *
 * @return array
 */
function bdy_seed_layouts() {
	if ( ! function_exists( 'acf_get_field' ) ) {
		return array();
	}

	$field = acf_get_field( 'field_page_sections' );

	if ( ! is_array( $field ) || empty( $field['layouts'] ) || ! is_array( $field['layouts'] ) ) {
		return array();
	}

	return array_values( $field['layouts'] );
}

/**
 * Everything that would be written, without writing it.
 *
 * Used by the screen and by the docs so the numbers are never hand-written.
 *
 * @return array
 */
function bdy_seed_plan() {
	$plan = array(
		'options' => array(),
		'pages'   => array(),
		'home'    => array(),
	);

	foreach ( bdy_defaults( 'global' ) as $key => $value ) {
		$def = function_exists( 'acf_get_field' ) ? acf_get_field( 'field_' . $key ) : null;

		if ( ! is_array( $def ) ) {
			continue;
		}

		$clean = bdy_seed_value( $value, $def );

		if ( null !== $clean ) {
			$plan['options'][ $key ] = $clean;
		}
	}

	$layouts = bdy_seed_layouts();
	$design  = bdy_page_defaults();

	foreach ( bdy_seed_pages() as $slug => $title ) {
		if ( empty( $design[ $slug ]['sections'] ) ) {
			continue;
		}

		$plan['pages'][ $slug ] = array(
			'title'  => $title,
			'blocks' => bdy_seed_block_rows( $design[ $slug ]['sections'], $layouts ),
		);
	}

	foreach ( bdy_defaults( 'home' ) as $section => $data ) {
		if ( ! is_array( $data ) ) {
			continue;
		}

		foreach ( $data as $key => $value ) {
			if ( 'show' === $key || 'order' === $key ) {
				$plan['home'][ 'home_' . $section . '_' . $key ] = $value;
				continue;
			}

			$def = function_exists( 'acf_get_field' ) ? acf_get_field( 'field_' . $key ) : null;

			if ( ! is_array( $def ) ) {
				continue;
			}

			$clean = bdy_seed_value( $value, $def );

			if ( null !== $clean ) {
				$plan['home'][ $key ] = $clean;
			}
		}
	}

	return $plan;
}

/**
 * Write the design content into the fields.
 *
 * @param bool $overwrite Replace content that already exists.
 * @return array Report: options count, per-page status, home status.
 */
function bdy_seed_run( $overwrite = false ) {
	$report = array(
		'ok'      => false,
		'message' => '',
		'options' => array(
			'filled'  => 0,
			'skipped' => 0,
		),
		'pages'   => array(),
		'home'    => array(
			'status' => 'skipped',
			'fields' => 0,
		),
	);

	if ( ! function_exists( 'update_field' ) || ! function_exists( 'acf_get_field' ) ) {
		$report['message'] = __( 'Advanced Custom Fields Pro must be active before the design content can be stored in the fields.', 'bdyculture' );

		return $report;
	}

	$plan = bdy_seed_plan();

	// 1. Site Settings.
	foreach ( $plan['options'] as $key => $value ) {
		if ( ! $overwrite && bdy_is_set( $key, 'option' ) ) {
			$report['options']['skipped']++;
			continue;
		}

		update_field( $key, $value, 'option' );
		$report['options']['filled']++;
	}

	// 2. The front page.
	$home_id = (int) get_option( 'page_on_front' );

	if ( ! $home_id ) {
		$home_id = (int) wp_insert_post(
			array(
				'post_title'   => __( 'Home', 'bdyculture' ),
				'post_name'    => 'home',
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_content' => '',
			)
		);

		if ( $home_id ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $home_id );
		}
	}

	if ( $home_id ) {
		$has_home = '' !== (string) get_post_meta( $home_id, 'home_hero_title', true );

		if ( $has_home && ! $overwrite ) {
			$report['home']['status'] = 'skipped';
		} else {
			foreach ( $plan['home'] as $key => $value ) {
				update_field( $key, $value, $home_id );
				$report['home']['fields']++;
			}

			$report['home']['status'] = $has_home ? 'overwritten' : 'filled';
		}
	} else {
		$report['home']['status'] = 'error';
	}

	// 3. Inner pages.
	foreach ( $plan['pages'] as $slug => $data ) {
		$status = 'filled';
		$page   = get_page_by_path( $slug );

		if ( ! $page ) {
			$id = (int) wp_insert_post(
				array(
					'post_title'   => $data['title'],
					'post_name'    => $slug,
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_content' => '',
				)
			);

			if ( ! $id ) {
				$report['pages'][ $slug ] = array(
					'title'  => $data['title'],
					'status' => 'error',
					'blocks' => 0,
				);
				continue;
			}

			$page   = get_post( $id );
			$status = 'created';
		}

		$page_id = (int) $page->ID;
		$has     = '' !== (string) get_post_meta( $page_id, 'page_sections', true );

		if ( $has && ! $overwrite ) {
			$report['pages'][ $slug ] = array(
				'title'  => $data['title'],
				'status' => 'skipped',
				'blocks' => 0,
			);
			continue;
		}

		update_field( 'page_sections', $data['blocks'], $page_id );
		update_field( 'page_contact_show', 1, $page_id );
		update_field( 'page_contact_order', 900, $page_id );
		update_field( 'page_map_show', 1, $page_id );
		update_field( 'page_map_order', 910, $page_id );

		$report['pages'][ $slug ] = array(
			'title'  => $data['title'],
			'status' => $has ? 'overwritten' : $status,
			'blocks' => count( $data['blocks'] ),
		);
	}

	// 4. Blog index — a page has to be assigned as the posts page.
	$blog = get_page_by_path( 'blog' );

	if ( ! $blog && ! (int) get_option( 'page_for_posts' ) ) {
		$blog_id = (int) wp_insert_post(
			array(
				'post_title'   => __( 'Blog', 'bdyculture' ),
				'post_name'    => 'blog',
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_content' => '',
			)
		);

		if ( $blog_id ) {
			update_option( 'page_for_posts', $blog_id );
		}
	}

	$report['ok'] = true;

	return $report;
}

/**
 * Admin screen: BDYCULTURE → Fill with design content.
 *
 * @return void
 */
function bdy_seed_menu() {
	$parent = function_exists( 'acf_add_options_page' ) ? 'bdyculture-settings' : 'tools.php';

	add_submenu_page(
		$parent,
		__( 'Fill with design content', 'bdyculture' ),
		__( 'Fill with design content', 'bdyculture' ),
		'manage_options',
		'bdyculture-seed',
		'bdy_seed_screen'
	);
}
add_action( 'admin_menu', 'bdy_seed_menu', 20 );

/**
 * Print the screen.
 *
 * @return void
 */
function bdy_seed_screen() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to do this.', 'bdyculture' ) );
	}

	$overwrite = isset( $_POST['bdy_seed_overwrite'] );
	$report    = null;

	if ( isset( $_POST['bdy_seed_action'] ) && check_admin_referer( 'bdy_seed_run', 'bdy_seed_nonce' ) ) {
		$report = bdy_seed_run( $overwrite );
	}

	$plan  = bdy_seed_plan();
	$total = 0;

	foreach ( $plan['pages'] as $data ) {
		$total += count( $data['blocks'] );
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Fill with design content', 'bdyculture' ); ?></h1>

		<?php if ( is_array( $report ) ) : ?>
			<?php if ( ! $report['ok'] ) : ?>
				<div class="notice notice-error"><p><?php echo esc_html( $report['message'] ); ?></p></div>
			<?php else : ?>
				<div class="notice notice-success">
					<p>
						<?php
						printf(
							/* translators: 1: Site Settings field count, 2: page count, 3: block count, 4: front-page field count. */
							esc_html__( 'Done. %1$d Site Settings fields, %2$d pages (%3$d blocks) and %4$d front-page fields now hold the design content.', 'bdyculture' ),
							(int) $report['options']['filled'],
							count( $report['pages'] ),
							(int) $total,
							(int) $report['home']['fields']
						);
						?>
					</p>
					<?php if ( $report['options']['skipped'] ) : ?>
						<p>
							<?php
							printf(
								/* translators: %d: skipped field count. */
								esc_html__( '%d Site Settings fields were left alone because they already had a value. Tick the box below to replace them.', 'bdyculture' ),
								(int) $report['options']['skipped']
							);
							?>
						</p>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<table class="widefat striped" style="max-width:760px">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Page', 'bdyculture' ); ?></th>
						<th><?php esc_html_e( 'Result', 'bdyculture' ); ?></th>
						<th><?php esc_html_e( 'Blocks', 'bdyculture' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $report['pages'] as $slug => $data ) : ?>
						<tr>
							<td><?php echo esc_html( $data['title'] ); ?> <code>/<?php echo esc_html( $slug ); ?>/</code></td>
							<td><?php echo esc_html( $data['status'] ); ?></td>
							<td><?php echo (int) $data['blocks']; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<p><?php esc_html_e( 'Front page:', 'bdyculture' ); ?> <strong><?php echo esc_html( $report['home']['status'] ); ?></strong></p>
		<?php endif; ?>

		<p style="max-width:760px">
			<?php esc_html_e( 'A fresh install shows the design without anything in these fields — the theme falls back to the shipped copy. This button copies that copy into the fields so it can be edited: Site Settings, the front page and every inner page.', 'bdyculture' ); ?>
		</p>

		<p style="max-width:760px">
			<?php esc_html_e( 'Images are not copied: they stay on the design fallback until you upload your own, because the design photos ship with the theme rather than in the media library. Menus are not copied either — assign them in Appearance → Menus.', 'bdyculture' ); ?>
		</p>

		<p>
			<strong><?php esc_html_e( 'This will fill:', 'bdyculture' ); ?></strong>
			<?php
			printf(
				/* translators: 1: settings field count, 2: page count, 3: block count, 4: home field count. */
				esc_html__( '%1$d Site Settings fields · %2$d pages · %3$d blocks · %4$d front-page fields', 'bdyculture' ),
				count( $plan['options'] ),
				count( $plan['pages'] ),
				(int) $total,
				count( $plan['home'] )
			);
			?>
		</p>

		<form method="post">
			<?php wp_nonce_field( 'bdy_seed_run', 'bdy_seed_nonce' ); ?>
			<p>
				<label>
					<input type="checkbox" name="bdy_seed_overwrite" value="1" <?php checked( $overwrite ); ?>>
					<?php esc_html_e( 'Replace content that is already filled in', 'bdyculture' ); ?>
				</label>
			</p>
			<p>
				<button type="submit" name="bdy_seed_action" value="1" class="button button-primary">
					<?php esc_html_e( 'Fill the fields with the design content', 'bdyculture' ); ?>
				</button>
			</p>
		</form>
	</div>
	<?php
}
