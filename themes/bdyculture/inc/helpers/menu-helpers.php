<?php
/**
 * Navigation helpers — WordPress menus drive the header and the footer.
 *
 * The design's header dropdown shows an icon per service and the footer has
 * two link columns, so the menus are read with wp_get_nav_menu_items() and
 * rendered with the design's own markup instead of wp_nav_menu()'s default
 * list. Everything the client edits lives in Appearance → Menus.
 *
 * @package BDYCULTURE
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Menu locations registered by the theme.
 *
 * @return array
 */
function bdy_menu_locations() {
	return array(
		'primary'         => __( 'Header — primary navigation', 'bdyculture' ),
		'footer_services' => __( 'Footer — services column', 'bdyculture' ),
		'footer_quick'    => __( 'Footer — quick links column', 'bdyculture' ),
		'footer_legal'    => __( 'Footer — legal bar', 'bdyculture' ),
	);
}

/**
 * Work out which icon belongs to a menu item.
 *
 * Priority: an explicit `icon-*` class on the menu item, then the last path
 * segment of the URL (physiotherapy, clinical-pilates …).
 *
 * @param string $url     Menu item URL.
 * @param array  $classes Menu item classes.
 * @return string
 */
function bdy_menu_icon( $url = '', $classes = array() ) {
	$icons = array_keys( bdy_icon_paths() );

	foreach ( (array) $classes as $class ) {
		if ( 0 === strpos( $class, 'icon-' ) ) {
			$name = str_replace( 'icon-', '', $class );
			if ( in_array( $name, $icons, true ) ) {
				return $name;
			}
		}
	}

	$path = wp_parse_url( (string) $url, PHP_URL_PATH );
	$slug = $path ? basename( untrailingslashit( $path ) ) : '';

	return in_array( $slug, $icons, true ) ? $slug : '';
}

/**
 * Should this menu item open in a new tab?
 *
 * @param object $item Menu item.
 * @return bool
 */
function bdy_menu_is_external( $item ) {
	return isset( $item->target ) && '_blank' === $item->target;
}

/**
 * Is this menu item the page being viewed?
 *
 * WordPress marks the item with `current-menu-item`; the URL comparison is a
 * fallback for menus built by hand.
 *
 * @param object $item Menu item.
 * @return bool
 */
function bdy_menu_is_current( $item ) {
	$classes = isset( $item->classes ) ? (array) $item->classes : array();

	if ( in_array( 'current-menu-item', $classes, true ) || in_array( 'current_page_item', $classes, true ) ) {
		return true;
	}

	return bdy_is_current( isset( $item->url ) ? $item->url : '' );
}

/**
 * Raw menu items for a location, keyed by parent id.
 *
 * @param string $location Location slug.
 * @return array
 */
function bdy_menu_raw( $location ) {
	$locations = get_nav_menu_locations();

	if ( empty( $locations[ $location ] ) ) {
		return array();
	}

	$items = wp_get_nav_menu_items(
		(int) $locations[ $location ],
		array( 'update_post_term_cache' => false )
	);

	return is_array( $items ) ? $items : array();
}

/**
 * Menu as the header/drawer tree shape the templates already use.
 *
 * Returns rows shaped like the previous ACF repeater so the markup stays the
 * same: nav_label, nav_link, nav_children[ child_label, child_link,
 * child_icon, child_alt ].
 *
 * @param string $location     Location slug.
 * @param array  $fallback_rows Rows used when no menu is assigned yet.
 * @return array
 */
function bdy_menu_tree( $location, $fallback_rows = array() ) {
	$items = bdy_menu_raw( $location );

	if ( ! $items ) {
		return $fallback_rows;
	}

	$by_parent = array();

	foreach ( $items as $item ) {
		$by_parent[ (int) $item->menu_item_parent ][] = $item;
	}

	$rows = array();

	foreach ( isset( $by_parent[0] ) ? $by_parent[0] : array() as $item ) {
		$children = array();

		foreach ( isset( $by_parent[ (int) $item->ID ] ) ? $by_parent[ (int) $item->ID ] : array() as $child ) {
			$children[] = array(
				'child_label'   => $child->title,
				'child_link'    => $child->url,
				'child_icon'    => bdy_menu_icon( $child->url, $child->classes ),
				'child_alt'     => in_array( 'nav__menu-alt', (array) $child->classes, true ),
				'child_new_tab' => bdy_menu_is_external( $child ),
				'child_current' => bdy_menu_is_current( $child ),
			);
		}

		$rows[] = array(
			'nav_label'    => $item->title,
			'nav_link'     => $item->url,
			'nav_new_tab'  => bdy_menu_is_external( $item ),
			'nav_current'  => bdy_menu_is_current( $item ),
			'nav_children' => $children,
		);
	}

	return $rows;
}

/**
 * Menu as footer link rows (link_label / link_url / link_type).
 *
 * @param string $location Location slug.
 * @return array
 */
function bdy_menu_links( $location ) {
	$items = bdy_menu_raw( $location );

	if ( ! $items ) {
		return array();
	}

	$rows = array();

	foreach ( $items as $item ) {
		$url  = (string) $item->url;
		$type = 'link';

		if ( 0 === strpos( $url, 'tel:' ) ) {
			$type = 'tel';
			$url  = str_replace( 'tel:', '', $url );
		} elseif ( 0 === strpos( $url, 'mailto:' ) ) {
			$type = 'email';
			$url  = str_replace( 'mailto:', '', $url );
		}

		$rows[] = array(
			'link_label'    => $item->title,
			'link_url'      => $url,
			'link_type'     => $type,
			'link_new_tab'  => bdy_menu_is_external( $item ),
		);
	}

	return $rows;
}

/**
 * Footer columns: two menus + the clinic address/contact column.
 *
 * Column titles come from the menu name, so editing a menu name renames the
 * column. If a menu is not assigned yet the shipped default column is used.
 *
 * @param array $fallback_columns Columns from defaults.php.
 * @return array
 */
function bdy_footer_columns( $fallback_columns = array() ) {
	$columns = array();
	$index   = 0;

	foreach ( array( 'footer_services', 'footer_quick' ) as $location ) {
		$links = bdy_menu_links( $location );

		if ( $links ) {
			$columns[] = array(
				'col_title' => bdy_menu_name( $location ),
				'col_text'  => '',
				'col_links' => $links,
			);
			$index++;
			continue;
		}

		if ( isset( $fallback_columns[ $index ] ) ) {
			$columns[] = $fallback_columns[ $index ];
		}
		$index++;
	}

	// The third column is the clinic's own address block (Clinic details).
	if ( isset( $fallback_columns[2] ) ) {
		$columns[] = $fallback_columns[2];
	}

	return $columns;
}

/**
 * Name of the menu assigned to a location.
 *
 * @param string $location Location slug.
 * @return string
 */
function bdy_menu_name( $location ) {
	$locations = get_nav_menu_locations();

	if ( empty( $locations[ $location ] ) ) {
		return '';
	}

	$menu = wp_get_nav_menu_object( (int) $locations[ $location ] );

	return ( $menu && isset( $menu->name ) ) ? $menu->name : '';
}
