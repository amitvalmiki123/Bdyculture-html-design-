<?php
/**
 * BDYCULTURE Content Updater — core logic.
 *
 * Fills empty ACF fields and Site Settings from the design data provided by
 * the BDYCULTURE theme (bdy_defaults() / bdy_page_defaults()).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class BDYCU_Content_Updater {

	/**
	 * Run the content update.
	 *
	 * @param bool $overwrite Replace content that already exists.
	 * @return array Report array.
	 */
	public function run( $overwrite = false ) {
		$report = array(
			'ok'      => false,
			'message' => '',
			'options' => array(
				'filled'  => 0,
				'skipped' => 0,
				'total'   => 0,
			),
			'home'    => array(
				'status' => 'skipped',
				'fields' => 0,
				'filled' => 0,
				'skipped'=> 0,
			),
			'pages'   => array(),
		);

		// ACF must be active.
		if ( ! function_exists( 'update_field' ) || ! function_exists( 'acf_get_field' ) ) {
			$report['message'] = __( 'Advanced Custom Fields Pro must be active before content can be stored in the fields.', 'bdyculture-content-updater' );
			return $report;
		}

		// The BDYCULTURE theme must be active to provide design data.
		if ( ! function_exists( 'bdy_defaults' ) || ! function_exists( 'bdy_page_defaults' ) ) {
			$report['message'] = __( 'The BDYCULTURE theme must be active to run the content updater.', 'bdyculture-content-updater' );
			return $report;
		}

		// 1. Site Settings (global options).
		$globals = bdy_defaults( 'global' );
		if ( is_array( $globals ) ) {
			foreach ( $globals as $key => $value ) {
				$report['options']['total']++;
				if ( ! $overwrite && $this->is_option_set( $key ) ) {
					$report['options']['skipped']++;
					continue;
				}
				$clean = $this->clean_value( $value, $key );
				if ( $clean !== null ) {
					update_field( $key, $clean, 'option' );
					$report['options']['filled']++;
				}
			}
		}

		// 2. Home page.
		$home_id = (int) get_option( 'page_on_front' );
		if ( ! $home_id ) {
			$home_id = (int) wp_insert_post( array(
				'post_title'   => __( 'Home', 'bdyculture-content-updater' ),
				'post_name'    => 'home',
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_content' => '',
			) );
			update_option( 'page_on_front', $home_id );
			update_option( 'show_on_front', 'page' );
		}

		$homeDefaults = bdy_defaults( 'home' );
		if ( is_array( $homeDefaults ) ) {
			$homeReport = array(
				'status' => 'done',
				'fields' => 0,
				'filled' => 0,
				'skipped'=> 0,
			);

			foreach ( $homeDefaults as $section => $data ) {
				if ( ! is_array( $data ) ) {
					continue;
				}

				foreach ( $data as $key => $value ) {
					$homeReport['fields']++;

					// show/order keys are handled separately.
					if ( 'show' === $key || 'order' === $key ) {
						$fieldKey = 'home_' . $section . '_' . $key;
						if ( ! $overwrite && $this->is_field_set( $fieldKey, $home_id ) ) {
							$homeReport['skipped']++;
							continue;
						}
						update_field( $fieldKey, $value, $home_id );
						$homeReport['filled']++;
						continue;
					}

					// Regular field — look up ACF definition for validation.
					$def = acf_get_field( 'field_' . $key );
					if ( ! is_array( $def ) ) {
						continue;
					}

					$clean = $this->clean_value( $value, $key, $def );
					if ( $clean === null ) {
						continue;
					}

					if ( ! $overwrite && $this->is_field_set( $key, $home_id ) ) {
						$homeReport['skipped']++;
						continue;
					}

					update_field( $key, $clean, $home_id );
					$homeReport['filled']++;
				}
			}

			$report['home'] = $homeReport;
		}

		// 3. Inner pages.
		$design = bdy_page_defaults();
		$seedPages = $this->bdy_seed_pages();

		foreach ( $seedPages as $slug => $title ) {
			if ( empty( $design[ $slug ]['sections'] ) ) {
				continue;
			}

			// Find or create the page.
			$page = get_page_by_path( $slug );
			if ( ! $page ) {
				$pageId = (int) wp_insert_post( array(
					'post_title'   => $title,
					'post_name'    => $slug,
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_content' => '',
				) );
			} else {
				$pageId = (int) $page->ID;
				// Update title if needed.
				if ( $page->post_title !== $title ) {
					wp_update_post( array( 'ID' => $pageId, 'post_title' => $title ) );
				}
			}

			$pageReport = array(
				'title'  => $title,
				'slug'   => $slug,
				'fields' => 0,
				'filled' => 0,
				'skipped'=> 0,
				'blocks' => 0,
			);

			// Fill top-level page fields (hero tag, meta description, etc.)
			$pageDefaults = isset( $design[ $slug ] ) ? $design[ $slug ] : array();
			foreach ( $pageDefaults as $key => $value ) {
				if ( 'sections' === $key || ! is_scalar( $value ) && ! is_array( $value ) ) {
					continue;
				}
				$pageReport['fields']++;

				$def = acf_get_field( 'field_' . $key );
				if ( ! is_array( $def ) ) {
					continue;
				}

				$clean = $this->clean_value( $value, $key, $def );
				if ( $clean === null ) {
					continue;
				}

				if ( ! $overwrite && $this->is_field_set( $key, $pageId ) ) {
					$pageReport['skipped']++;
					continue;
				}

				update_field( $key, $clean, $pageId );
				$pageReport['filled']++;
			}

			// Fill the flexible-content page_sections.
			$layouts = $this->bdy_seed_layouts();
			$blockRows = $this->bdy_seed_block_rows( $design[ $slug ]['sections'], $layouts );

			if ( ! $overwrite && $this->is_field_set( 'page_sections', $pageId ) ) {
				$pageReport['blocks'] = -1; // skipped entirely
			} else {
				update_field( 'page_sections', $blockRows, $pageId );
				$pageReport['blocks'] = count( $blockRows );
			}

			// Shared band switches.
			foreach ( array( 'contact', 'map' ) as $band ) {
				$showKey  = 'page_' . $band . '_show';
				$orderKey = 'page_' . $band . '_order';

				if ( ! $overwrite && $this->is_field_set( $showKey, $pageId ) ) {
					$pageReport['skipped']++;
				} else {
					update_field( $showKey, 1, $pageId );
				}
				if ( ! $overwrite && $this->is_field_set( $orderKey, $pageId ) ) {
					$pageReport['skipped']++;
				} else {
					$order = 'contact' === $band ? 1 : 900;
					update_field( $orderKey, $order, $pageId );
				}
			}

			$report['pages'][ $slug ] = $pageReport;
		}

		$report['ok'] = true;
		$report['message'] = sprintf(
			__('Content update complete. %d options filled, home page done, %d pages processed.', 'bdyculture-content-updater'),
			$report['options']['filled'],
			count( $report['pages'] )
		);

		return $report;
	}

	/**
	 * Check if an option already has a non-empty value.
	 */
	private function is_option_set( $key ) {
		$val = get_option( $key );
		return ! empty( $val );
	}

	/**
	 * Check if an ACF field on a post already has a non-empty value.
	 */
	private function is_field_set( $key, $postId ) {
		$val = get_field( $key, $postId );
		return ! empty( $val );
	}

	/**
	 * Clean a value against its ACF field definition (same logic as theme seed).
	 */
	private function clean_value( $value, $key, $def = null ) {
		if ( is_array( $value ) ) {
			// Repeater or clone.
			$type = isset( $def['type'] ) ? (string) $def['type'] : '';
			if ( 'repeater' === $type || 'clone' === $type ) {
				$subs = isset( $def['sub_fields'] ) && is_array( $def['sub_fields'] ) ? $def['sub_fields'] : array();
				$rows = array();
				foreach ( $value as $row ) {
					if ( ! is_array( $row ) ) {
						continue;
					}
					$clean = array();
					foreach ( $subs as $sub ) {
						$sname = isset( $sub['name'] ) ? (string) $sub['name'] : '';
						if ( '' === $sname || ! array_key_exists( $sname, $row ) ) {
							continue;
						}
						$c = $this->clean_value( $row[ $sname ], $sname, $sub );
						if ( null !== $c ) {
							$clean[ $sname ] = $c;
						}
					}
					if ( $clean ) {
						$rows[] = $clean;
					}
				}
				return $rows ? $rows : null;
			}
			return null;
		}

		if ( $value === '' || $value === null ) {
			return null;
		}

		return $value;
	}

	/**
	 * Inner pages that have a shipped design (mirrors theme's bdy_seed_pages()).
	 */
	private function bdy_seed_pages() {
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
	 * Get ACF layouts for page_sections flexible content.
	 */
	private function bdy_seed_layouts() {
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
	 * Turn design page blocks into flexible-content rows.
	 */
	private function bdy_seed_block_rows( $sections, $layouts ) {
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
			$row  = array( 'acf_fc_layout' => $type );

			foreach ( $subs as $sub ) {
				$sname = isset( $sub['name'] ) ? (string) $sub['name'] : '';
				if ( '' === $sname || ! array_key_exists( $sname, $block ) ) {
					continue;
				}
				$clean = $this->clean_value( $block[ $sname ], $sname, $sub );
				if ( null !== $clean ) {
					$row[ $sname ] = $clean;
				}
			}

			$rows[] = $row;
		}

		return $rows;
	}
}
