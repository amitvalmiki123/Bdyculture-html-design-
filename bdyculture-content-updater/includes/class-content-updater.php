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

	/** @var array|null Cached Media Library lookup by filename and stem. */
	private $attachment_index = null;

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
					$def = acf_get_field( 'field_' . $key );
					if ( ! $overwrite && $this->is_option_set( $key ) ) {
						$current = get_field( $key, 'option', false );
						$merged  = $this->merge_image_values( $current, $value, $def );
						if ( $merged !== $current ) {
							update_field( $key, $merged, 'option' );
							$report['options']['filled']++;
						} else {
							$report['options']['skipped']++;
						}
						continue;
					}
					$clean = $this->clean_value( $value, $key, is_array( $def ) ? $def : null );
					if ( $clean !== null ) {
						update_field( $key, $clean, 'option' );
						$report['options']['filled']++;
					}
				}
			}
			$this->fill_named_image_defaults(
				'option',
				array(
					'clinic_logo'       => 'logo-black.png',
					'clinic_logo_light' => 'logo-white.png',
					'footer_logo'       => 'logo-white.png',
				),
				$report['options']
			);

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
						$current = get_field( $key, $home_id, false );
						$merged  = $this->merge_image_values( $current, $value, $def );
						if ( $merged !== $current ) {
							update_field( $key, $merged, $home_id );
							$homeReport['filled']++;
						} else {
							$homeReport['skipped']++;
						}
						continue;
					}

					update_field( $key, $clean, $home_id );
					$homeReport['filled']++;
				}
			}
			$this->fill_named_image_defaults(
				$home_id,
				array( 'home_hero_image' => 'hero-gym-bright.webp' ),
				$homeReport
			);

			$report['home'] = $homeReport;
		}

		// 3. Inner pages.
		$design = bdy_page_defaults();
		$seedPages = $this->bdy_seed_pages();

		foreach ( $seedPages as $slug => $title ) {
			if ( empty( $design[ $slug ]['sections'] ) ) {
				continue;
			}

			// Find by canonical slug. The current XAMPP export uses /chermside/
			// for the designed Location — Chermside page, so treat it as an alias.
			$page = get_page_by_path( $slug, OBJECT, 'page' );
			if ( ! $page && 'location-chermside' === $slug ) {
				$page = get_page_by_path( 'chermside', OBJECT, 'page' );
			}
			if ( ! $page ) {
				$pageId = (int) wp_insert_post( array(
					'post_title'   => $title,
					'post_name'    => $slug,
					'post_type'    => 'page',
					'post_status'  => 'publish',
					'post_content' => '',
				) );
			} else {
				// Keep the existing page title/slug and every client-edited value.
				$pageId = (int) $page->ID;
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
					$current = get_field( $key, $pageId, false );
					$merged  = $this->merge_image_values( $current, $value, $def );
					if ( $merged !== $current ) {
						update_field( $key, $merged, $pageId );
						$pageReport['filled']++;
					} else {
						$pageReport['skipped']++;
					}
					continue;
				}

				update_field( $key, $clean, $pageId );
				$pageReport['filled']++;
			}

			// Fill the flexible-content page_sections.
			$layouts = $this->bdy_seed_layouts();
			$blockRows = $this->bdy_seed_block_rows( $design[ $slug ]['sections'], $layouts );

			if ( ! $overwrite && $this->is_field_set( 'page_sections', $pageId ) ) {
				$currentBlocks = get_field( 'page_sections', $pageId, false );
				$sectionField  = acf_get_field( 'field_page_sections' );
				$mergedBlocks  = $this->merge_image_values( $currentBlocks, $blockRows, $sectionField );
				if ( $mergedBlocks !== $currentBlocks ) {
					update_field( 'page_sections', $mergedBlocks, $pageId );
					$pageReport['blocks'] = count( (array) $currentBlocks );
				} else {
					$pageReport['blocks'] = -1; // content retained; no missing design image matched
				}
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
	 * Fill well-known logo/hero fields from matching media items when blank.
	 * Existing valid attachment selections are never replaced.
	 *
	 * @param int|string $post_id ACF post ID or "option".
	 * @param array      $images  Field name => design filename.
	 * @param array      $report  Mutable field counter.
	 * @return void
	 */
	private function fill_named_image_defaults( $post_id, $images, &$report ) {
		foreach ( $images as $field_name => $filename ) {
			$field = acf_get_field( 'field_' . $field_name );
			if ( ! is_array( $field ) || 'image' !== ( isset( $field['type'] ) ? $field['type'] : '' ) ) {
				continue;
			}
			$current = get_field( $field_name, $post_id, false );
			if ( is_numeric( $current ) && $this->is_attachment( (int) $current ) ) {
				continue;
			}
			$current_id = $this->resolve_image_reference( $current );
			$id = $current_id ? $current_id : $this->resolve_image_reference( $filename );
			if ( ! $id ) {
				continue;
			}
			if ( (int) $current !== (int) $id ) {
				update_field( $field_name, $id, $post_id );
				if ( isset( $report['filled'] ) ) {
					$report['filled']++;
				}
			}
		}
	}

	/**
	 * Convert design defaults into values ACF can store. Image filenames are
	 * resolved to attachment IDs from the current site's Media Library.
	 */
	private function clean_value( $value, $key, $def = null ) {
		if ( ! is_array( $def ) && function_exists( 'acf_get_field' ) ) {
			$def = acf_get_field( 'field_' . $key );
		}
		$def  = is_array( $def ) ? $def : array();
		$type = isset( $def['type'] ) ? (string) $def['type'] : '';

		if ( 'image' === $type ) {
			$id = $this->resolve_image_reference( $value );
			return $id ? $id : null;
		}

		if ( 'gallery' === $type ) {
			$ids = array();
			foreach ( (array) $value as $image ) {
				$id = $this->resolve_image_reference( $image );
				if ( $id ) {
					$ids[] = $id;
				}
			}
			return $ids ? $ids : null;
		}

		if ( is_array( $value ) ) {
			$subs = isset( $def['sub_fields'] ) && is_array( $def['sub_fields'] ) ? $def['sub_fields'] : array();
			if ( 'repeater' === $type || 'clone' === $type ) {
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

			if ( 'group' === $type ) {
				$clean = array();
				foreach ( $subs as $sub ) {
					$sname = isset( $sub['name'] ) ? (string) $sub['name'] : '';
					if ( '' === $sname || ! array_key_exists( $sname, $value ) ) {
						continue;
					}
					$c = $this->clean_value( $value[ $sname ], $sname, $sub );
					if ( null !== $c ) {
						$clean[ $sname ] = $c;
					}
				}
				return $clean ? $clean : null;
			}

			return null;
		}

		if ( '' === $value || null === $value ) {
			return null;
		}
		return $value;
	}

	/**
	 * Fill/repair only image values inside existing fields; all text and valid
	 * client-selected attachment IDs are kept unchanged.
	 */
	private function merge_image_values( $current, $defaults, $field ) {
		if ( ! is_array( $field ) ) {
			return $current;
		}
		$type = isset( $field['type'] ) ? (string) $field['type'] : '';

		if ( 'image' === $type ) {
			if ( is_numeric( $current ) && $this->is_attachment( (int) $current ) ) {
				return (int) $current;
			}
			$current_id = $this->resolve_image_reference( $current );
			if ( $current_id && is_string( $current ) && $current !== (string) $current_id ) {
				return $current_id;
			}
			$default_id = $this->resolve_image_reference( $defaults );
			return $default_id ? $default_id : $current;
		}

		if ( 'gallery' === $type ) {
			if ( ! empty( $current ) ) {
				return $current;
			}
			$clean = $this->clean_value( $defaults, isset( $field['name'] ) ? $field['name'] : '', $field );
			return null !== $clean ? $clean : $current;
		}

		$subs = isset( $field['sub_fields'] ) && is_array( $field['sub_fields'] ) ? $field['sub_fields'] : array();
		if ( 'group' === $type ) {
			if ( ! is_array( $current ) ) {
				$current = array();
			}
			$defaults = is_array( $defaults ) ? $defaults : array();
			$merged = $current;
			foreach ( $subs as $sub ) {
				$name = isset( $sub['name'] ) ? (string) $sub['name'] : '';
				if ( '' === $name ) {
					continue;
				}
				$before = array_key_exists( $name, $merged ) ? $merged[ $name ] : null;
				$after  = $this->merge_image_values( $before, isset( $defaults[ $name ] ) ? $defaults[ $name ] : null, $sub );
				if ( $after !== $before ) {
					$merged[ $name ] = $after;
				}
			}
			return $merged;
		}

		if ( 'repeater' === $type || 'clone' === $type ) {
			if ( ! is_array( $current ) || ! is_array( $defaults ) ) {
				return $current;
			}
			$merged = $current;
			foreach ( $merged as $index => $row ) {
				if ( ! is_array( $row ) || ! isset( $defaults[ $index ] ) || ! is_array( $defaults[ $index ] ) ) {
					continue;
				}
				foreach ( $subs as $sub ) {
					$name = isset( $sub['name'] ) ? (string) $sub['name'] : '';
					if ( '' === $name || ! array_key_exists( $name, $defaults[ $index ] ) ) {
						continue;
					}
					$before = array_key_exists( $name, $row ) ? $row[ $name ] : null;
					$after  = $this->merge_image_values( $before, $defaults[ $index ][ $name ], $sub );
					if ( $after !== $before ) {
						$merged[ $index ][ $name ] = $after;
					}
				}
			}
			return $merged;
		}

		if ( 'flexible_content' === $type && is_array( $current ) && is_array( $defaults ) ) {
			$layouts = isset( $field['layouts'] ) && is_array( $field['layouts'] ) ? $field['layouts'] : array();
			$merged  = $current;
			foreach ( $merged as $index => $row ) {
				if ( ! is_array( $row ) || empty( $row['acf_fc_layout'] ) ) {
					continue;
				}
				$defaultRow = isset( $defaults[ $index ] ) && isset( $defaults[ $index ]['acf_fc_layout'] ) && $defaults[ $index ]['acf_fc_layout'] === $row['acf_fc_layout'] ? $defaults[ $index ] : null;
				if ( ! is_array( $defaultRow ) ) {
					continue;
				}
				foreach ( $layouts as $layout ) {
					if ( ! isset( $layout['name'] ) || $layout['name'] !== $row['acf_fc_layout'] ) {
						continue;
					}
					foreach ( (array) $layout['sub_fields'] as $sub ) {
						$name = isset( $sub['name'] ) ? (string) $sub['name'] : '';
						if ( '' === $name || ! array_key_exists( $name, $defaultRow ) ) {
							continue;
						}
						$before = array_key_exists( $name, $row ) ? $row[ $name ] : null;
						$after  = $this->merge_image_values( $before, $defaultRow[ $name ], $sub );
						if ( $after !== $before ) {
							$merged[ $index ][ $name ] = $after;
						}
					}
					break;
				}
			}
			return $merged;
		}

		return $current;
	}

	/** Resolve a design filename or URL to a Media Library attachment ID. */
	private function resolve_image_reference( $value ) {
		if ( is_array( $value ) ) {
			if ( ! empty( $value['ID'] ) ) {
				$value = $value['ID'];
			} elseif ( ! empty( $value['id'] ) ) {
				$value = $value['id'];
			} elseif ( ! empty( $value['url'] ) ) {
				$value = $value['url'];
			} else {
				return 0;
			}
		}
		if ( is_numeric( $value ) ) {
			return $this->is_attachment( (int) $value ) ? (int) $value : 0;
		}
		if ( ! is_string( $value ) || '' === trim( $value ) ) {
			return 0;
		}
		$url_id = attachment_url_to_postid( $value );
		if ( $url_id ) {
			return (int) $url_id;
		}
		$path = parse_url( $value, PHP_URL_PATH );
		$base = strtolower( rawurldecode( basename( $path ? $path : $value ) ) );
		$stem = strtolower( pathinfo( $base, PATHINFO_FILENAME ) );
		$index = $this->get_attachment_index();
		if ( isset( $index['files'][ $base ] ) ) {
			return (int) $index['files'][ $base ];
		}
		if ( isset( $index['stems'][ $stem ] ) && 1 === count( $index['stems'][ $stem ] ) ) {
			return (int) $index['stems'][ $stem ][0];
		}
		return 0;
	}

	/** Build a cached lookup of original Media Library filenames. */
	private function get_attachment_index() {
		if ( is_array( $this->attachment_index ) ) {
			return $this->attachment_index;
		}
		$index = array( 'files' => array(), 'stems' => array() );
		$ids   = get_posts( array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'orderby'        => 'ID',
			'order'          => 'ASC',
		) );
		foreach ( $ids as $id ) {
			$file = get_attached_file( $id );
			if ( ! $file ) {
				continue;
			}
			$base = strtolower( basename( $file ) );
			$stem = strtolower( pathinfo( $base, PATHINFO_FILENAME ) );
			if ( ! isset( $index['files'][ $base ] ) ) {
				$index['files'][ $base ] = (int) $id;
			}
			if ( ! isset( $index['stems'][ $stem ] ) ) {
				$index['stems'][ $stem ] = array();
			}
			$index['stems'][ $stem ][] = (int) $id;
		}
		$this->attachment_index = $index;
		return $index;
	}

	/** Check that an ID belongs to a Media Library attachment. */
	private function is_attachment( $id ) {
		return $id > 0 && 'attachment' === get_post_type( $id );
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
