<?php

/**
 * Front Site Walker
 */
class BF_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Contain mega menu IDs
	 *
	 * @var array
	 */
	public $mega_menus = array();


	/**
	 * Capture children elements
	 *
	 * @var int
	 */
	public $capture_childs = 0;

	/**
	 * Store children items in mega menu as html
	 *
	 * @var string
	 */
	public $captured_childs;

	/**
	 * Contains list of field ID's that should be behave as mega menu
	 *
	 * @var array
	 */
	public static $mega_menu_field_ids = array(
		'mega_menu' => array(
			'default' => 'disabled',
			'depth'   => 0,
		),
	);


	/**
	 * Sub menu animations
	 */
	public $animations = array(
		'fade',
		'slide-fade',
		'bounce',
		'tada',
		'shake',
		'swing',
		'wobble',
		'buzz',
		'slide-top-in',
		'slide-bottom-in',
		'slide-left-in',
		'slide-right-in',
		'filip-in-x',
		'filip-in-y',
	);

	/**
	 * Show parent items description
	 */
	public $show_desc_parent = FALSE;


	function __construct() {
		$this->show_desc_parent = apply_filters( 'better-framework/menu/show-parent-desc', $this->show_desc_parent );
	}


	/**
	 * Prepare properties to start capturing
	 */
	public function turn_capturing_mode_on() {
		$this->capture_childs  = 1;
		$this->captured_childs = '';
	}

	/**
	 * Reset capture temp variables
	 */
	public function turn_capturing_mode_off() {
		$this->capture_childs = 0;
	}

	/**
	 * Increase capture pointer number
	 */
	public function start_capture_childs() {
		$this->capture_childs ++;
	}

	/**
	 * decrease capture pointer number
	 */
	public function stop_capture_childs() {
		$this->capture_childs --;
	}

	/**
	 * Whether to check is capturing mode turn on
	 *
	 * @return int
	 */
	public function is_capturing_mode_enable() {
		return $this->capture_childs;
	}

	/**
	 * Whether to check is capturing started
	 *
	 * @return bool true on success
	 */
	public function is_capture_childs_started() {
		return $this->capture_childs > 1;
	}

	/**
	 * Starts the list before the elements are added.
	 *
	 * @see Walker_Nav_Menu::start_lvl()
	 * @see Walker::start_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {


		/**
		 * Capture mega menu children items
		 *
		 * Ex:
		 *  item: mega-menu
		 *         - Child 1
		 *         - Child 2
		 *
		 * will capture child 1, child 2 otherwise print <ul>
		 */
		if ( $this->mega_menus && ! $this->is_capture_childs_started() ) {
			$this->turn_capturing_mode_on();
		}
		$item_output = '';
		parent::start_lvl( $item_output, $depth, $args );

		if ( $this->mega_menus && $this->is_capturing_mode_enable() ) {
			$this->start_capture_childs();

			if ( $this->capture_childs > 2 ) { // ignore first <ul ..> tag
				$this->captured_childs .= $item_output;
			}
		} else {
			$output .= $item_output;
		}
	}


	/**
	 * Ends the list of after the elements are added.
	 *
	 * @see Walker_Nav_Menu::end_lvl()
	 * @see Walker::end_lvl()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$turned_off = FALSE;
		if ( $this->is_capturing_mode_enable() ) {
			$this->stop_capture_childs();
			$turned_off = ! $this->is_capture_childs_started();
		}

		if ( $turned_off ) {
			if ( $this->mega_menus ) {
				$current_item = array_pop( $this->mega_menus );

				$mega_menu = apply_filters( 'better-framework/menu/mega/end_lvl', array(
						'depth'        => $depth,
						'this'         => &$this,
						'sub-menu'     => $this->captured_childs,
						'current-item' => &$current_item,
						'output'       => '',
					)
				);
				$this->append_comment( $output, $depth, __( 'Mega Menu Start', 'publisher' ) );
				$output .= $mega_menu['output'];
				$this->append_comment( $output, $depth, __( 'Mega Menu End', 'publisher' ) );
			}
		}
		$item_output = '';
		parent::end_lvl( $item_output, $depth, $args );

		if ( $this->is_capturing_mode_enable() ) {
			$this->captured_childs .= $item_output;
		} else {
			$output .= $item_output;
		}
	}


	/**
	 * Detect the item have mega menu
	 *
	 * @param object $item
	 *
	 * @return bool true on success
	 */
	protected function is_item_mega_menu( $item ) {
		foreach ( self::$mega_menu_field_ids as $mega_id => $mega_value ) {
			if ( ! empty( $item->{$mega_id} ) && $item->{$mega_id} != $mega_value['default'] ) {
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @see Walker::start_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$_class = array();

		//
		// Responsive Options
		//
		if ( isset( $item->resp_desktop ) && $item->resp_desktop == 'hide' ) {
			$_class[] = 'hidden-lg'; // Hide On Desktop
		}

		if ( isset( $item->resp_tablet ) && $item->resp_tablet == 'hide' ) {
			$_class[] = 'hidden-md'; // Hide On Desktop
		}

		if ( isset( $item->resp_mobile ) && $item->resp_mobile == 'hide' ) {
			$_class[] = 'hidden-sm'; // Hide On Mobile
			$_class[] = 'hidden-xs';
		}

		// add specific class for identical usages for categories
		if ( $item->object == 'category' ) {
			$_class[] = 'menu-term-' . $item->object_id;
		}

		// Delete item title when hiding title set
		if ( ! isset( $item->hide_menu_title ) || $item->hide_menu_title == 1 ) {
			$_class[]    = 'menu-title-hide';
			$item->title = '<span class="hidden">' . $item->title /* escaped before */ . '</span>';
		}


		//
		// Menu Animations
		//
		if ( ! isset( $item->drop_menu_anim ) || $item->drop_menu_anim != '' ) {
			if ( $item->drop_menu_anim == 'random' ) {
				$_class[] = 'better-anim-' . $this->animations[ array_rand( $this->animations ) ];
			} else {
				$_class[] = 'better-anim-' . $item->drop_menu_anim;
			}
		} else {
			$_class[] = 'better-anim-fade';
		}


		//
		// Generate Icons HTML
		//
		if ( isset( $item->menu_icon ) ) {

			if ( is_array( $item->menu_icon ) && ! empty( $item->menu_icon['icon'] ) ) {
				if ( ! isset( $_temp_args ) ) {
					$_temp_args = (object) $args;
					$_temp_args = clone $_temp_args;
				}
				$_temp_args->link_before = $this->generate_icon_HTML( $item->menu_icon, $item->menu_icon_pos ) . $_temp_args->link_before;
				$_class[]                = 'menu-have-icon';
				$_class[]                = 'menu-icon-type-' . $item->menu_icon['type'];
			} elseif ( is_string( $item->menu_icon ) && $item->menu_icon != 'none' ) {
				if ( ! isset( $_temp_args ) ) {
					$_temp_args = (object) $args;
					$_temp_args = clone $_temp_args;
				}
				$_temp_args->link_before = $this->generate_icon_HTML( $item->menu_icon, $item->menu_icon_pos ) . $_temp_args->link_before;
				$_class[]                = 'menu-have-icon';
			}

		}


		//
		// Generate Badges html
		//
		if ( ! empty( $item->badge_label ) ) {

			if ( ! isset( $_temp_args ) ) {
				$_temp_args = (object) $args;
				$_temp_args = clone $_temp_args;
			}

			if ( ! empty( $item->badge_position ) ) {
				$badge_position = $item->badge_position;
				$_class[]       = 'menu-badge-' . $item->badge_position;
			} else {
				$badge_position = 'right';
				$_class[]       = 'menu-badge-right';
			}

			if ( $badge_position == 'right' ) {
				$_temp_args->link_after = $this->generate_badge_HTML( $item->badge_label ) . $_temp_args->link_after;
			} else {
				$_temp_args->link_before = $this->generate_badge_HTML( $item->badge_label ) . $_temp_args->link_before;
			}

			$_class[] = 'menu-have-badge';
		}


		//
		// Add description to parent items
		//
		if ( $depth == 0 && $this->show_desc_parent && isset( $item->description ) && ! empty( $item->description ) ) {

			if ( ! isset( $_temp_args ) ) {
				$_temp_args = (object) $args;
				$_temp_args = clone $_temp_args;
			}

			$_temp_args->link_after .= '<span class="description">' . $item->description /* escaped before */ . '</span>';
			$_class[] = 'menu-have-description';
		}

		// Prepare params for mega menu
		if ( $this->is_item_mega_menu( $item ) ) {
			// Mega menu classes
			$mega_item_obj            = clone( $item );
			$mega_item_obj->item_id   = $item->ID;
			$mega_item_obj->mega_menu = $item->mega_menu;

			$this->mega_menus[ $item->ID ] = $mega_item_obj;

			$_class[] = 'menu-item-has-children menu-item-has-mega menu-item-mega-' . $item->mega_menu;
		}

		// Merge menu classes
		$item->classes = array_merge( (array) $item->classes, $_class );
		unset( $_class );

		// continue with new args that changed
		$item_output = '';
		if ( isset( $_temp_args ) ) {
			parent::start_el( $item_output, $item, $depth, $_temp_args, $id );
		} else {
			parent::start_el( $item_output, $item, $depth, $args, $id );
		}

		if ( $this->is_capture_childs_started() ) {
			$this->captured_childs .= $item_output;
		} else {
			$output .= $item_output;
		}
	}

	/**
	 * Ends the element output, if needed.
	 *
	 * @see Walker_Nav_Menu::end_el()
	 * @see Walker::end_el()
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Page data object. Not used.
	 * @param int    $depth  Depth of page. Not Used.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		// Mega menu items without child
		if ( $this->mega_menus && ! $this->is_capture_childs_started() ) {
			$current_item = array_pop( $this->mega_menus );
			$mega_menu    = apply_filters( 'better-framework/menu/mega/end_lvl', array(
					'depth'        => $depth,
					'this'         => &$this,
					'sub-menu'     => $this->captured_childs,
					'current-item' => &$current_item,
					'output'       => '',
				)
			);

			$this->append_comment( $output, $depth, __( 'Mega Menu Start', 'publisher' ) );
			$output .= $mega_menu['output'];
			$this->append_comment( $output, $depth, __( 'Mega Menu End', 'publisher' ) );

			parent::end_el( $output, $item, $depth, $args );
		} else {

			$item_output = '';
			parent::end_el( $item_output, $item, $depth, $args );


			if ( $this->is_capturing_mode_enable() ) {
				$this->captured_childs .= $item_output;
				if ( ! $this->is_capture_childs_started() ) {
					$output .= $item_output;
				}
			} else {
				$output .= $item_output;
			}
		}
	}


	/**
	 * Append HTML comment inside menu items. it's formatted and easy to read!
	 *
	 * @param string $output
	 * @param int    $depth
	 * @param string $comment
	 */
	protected function append_comment( &$output, $depth, $comment = '' ) {
		$output .= "\n";
		$output .= str_repeat( "\t", $depth );
		if ( $comment ) {
			$output .= sprintf( '<!-- %s -->', $comment );
		}
		$output .= "\n";
	}


	/**
	 * Used for generating custom badge html
	 *
	 * @param $badge_label
	 *
	 * @return string
	 */
	public function generate_badge_HTML( $badge_label ) {
		return '<span class="better-custom-badge">' . $badge_label /* escaped before */ . '</span>';
	}


	/**
	 * Used for generating custom icon html
	 *
	 * @param $menu_icon
	 * @param $menu_icon_pos
	 *
	 * @return string
	 */
	public function generate_icon_HTML( $menu_icon, $menu_icon_pos ) {
		return bf_get_icon_tag( $menu_icon );
	}

} // BF_Menu_Walker
