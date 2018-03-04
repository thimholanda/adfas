<?php


/**
 * Class Publisher_Theme_Listing_Shortcode
 */
class Publisher_Theme_Listing_Shortcode extends BF_Shortcode {

	/**
	 * Type of pagination bs_listing or callback
	 *
	 * @var string
	 */
	public $type = 'bs_listing';

	/**
	 * pagination view name. class name for bs_listing type or valid callback for other types
	 *
	 * @var string
	 */
	public $view;


	function __construct( $id, $options ) {

		$options['defaults'] = wp_parse_args( array(
			'pagination-show-label'    => TRUE,
			'pagination-slides-count'  => 3,
			'slider-autoplay'          => TRUE,
			'slider-animation-speed'   => 750,
			'slider-speed'             => 3000,
			'slider-control-dots'      => 'off',
			'slider-control-next-prev' => 'style-1',
			'bs-show-desktop'          => TRUE,
			'bs-show-tablet'           => TRUE,
			'bs-show-phone'            => TRUE,
			'tabs_content_type'        => 'deferred',
		), $options['defaults'] );

		parent::__construct( $id, $options );

		$this->view = get_class( $this );
	}


	/**
	 * set view and type. children classes use this method
	 *
	 * @param $view Type of pagination bs_listing or callback
	 * @param $type string pagination view. class name if $type = bs_listing otherwise name of valid callback
	 *
	 * @return bool
	 */
	public function set_view_type( $view, $type ) {
		if ( $type === 'bs_listing' ) {
			$class  = &$view;
			$method = 'display_content';
			if ( ! is_callable( "$class::$method" ) ) {
				return FALSE;
			}

			$this->type = 'bs_listing';
			$this->view = $class;
		} else {
			$callback = &$view;
			if ( ! is_callable( $callback ) ) {
				return FALSE;
			}

			$this->type = 'callback';
			$this->view = $callback;
		}

		return TRUE;
	}


	protected function slider_settings_atts( &$atts ) {

		foreach (
			array_intersect_key( $atts, array(
				'slider-control-dots'      => '',
				'slider-animation-speed'   => '',
				'slider-control-next-prev' => '',
				'slider-autoplay'          => '',
			) ) as $key => $value
		) {

			echo ' data-', esc_attr( $key ), '=', '"', esc_attr( $value ), '"';
		}

		if ( ! empty( $atts['slider-speed'] ) ) {
			echo ' data-autoplaySpeed="', esc_attr( $atts['slider-speed'] ), '"';
		}
	}


	/**
	 * Used to detect slider have controller
	 *
	 * @param array  $atts
	 * @param string $type
	 *
	 * @return bool
	 */
	function have_slider_controller( &$atts, $type = 'all' ) {

		$_have = FALSE;

		// no slider == no slider controller!
		if ( empty( $atts['have_slider'] ) ) {
			return FALSE;
		}

		switch ( $type ) {

			case 'all':
				$_have = isset( $atts['slider-control-next-prev'] ) && $atts['slider-control-next-prev'] !== 'off';
				if ( ! $_have ) {
					$_have = isset( $atts['slider-control-dots'] ) && $atts['slider-control-dots'] !== 'off';
				}
				break;

			case 'next_prev':
				$_have = isset( $atts['slider-control-next-prev'] ) && $atts['slider-control-next-prev'] !== 'off';
				break;

			case 'dots':
				$_have = isset( $atts['slider-control-dots'] ) && $atts['slider-control-dots'] !== 'off';
				break;

		}

		return $_have;

	}


	protected function append_defer_data_attr( $tabs ) {
		$length = count( $tabs );

		for ( $idx = 1; $idx < $length; $idx ++ ) {
			$tab = &$tabs[ $idx ];

			$tab['data']['deferred-init']  = mt_rand();
			$tab['data']['deferred-event'] = 'shown.bs.tab';
		}

		return $tabs;
	}


	/**
	 * Handle displaying of shortcode
	 *
	 * @param array  $atts
	 * @param string $content
	 *
	 * @return string
	 */
	function display( array $atts, $content = '' ) {

		publisher_theme_pagin_manager()->set_tabs_atts( $atts );

		publisher_set_prop( 'shortcode-' . $this->id, $atts );

		if ( empty( $atts['css-class'] ) ) {
			$atts['css-class'] = '';
		}

		if ( empty( $atts['slider-control-next-prev'] ) ) {
			$atts['slider-control-next-prev'] = 'style-1';
		}

		$tabs              = publisher_block_create_tabs( $atts );
		$multi_tab         = count( $tabs ) > 1;
		$_is_tabs_deferred = ! empty( $atts['deferred_load_block'] );

		// return nothing if tabs are empty
		if ( empty( $tabs ) ) {
			return '';
		}

		ob_start();

		if ( $_is_tabs_deferred ) {
			$tabs = $this->append_defer_data_attr( $tabs );
		}

		if ( empty( $atts['hide_main_wrapper'] ) ) {
			?>
			<div class="<?php echo ! empty( $atts['have_pagination'] ) ? 'pagination-animate ' : '';
			echo esc_attr( $atts['css-class'] ); ?> bs-listing
			bs-listing-<?php echo esc_attr( isset( $atts['style'] ) ? esc_attr( $atts['style'] ) : 'none' ); ?> bs-listing-<?php echo $multi_tab ? 'multi' : 'single'; ?>-tab">
			<?php
		}

		if ( empty( $atts['hide_heading'] ) ) {
			publisher_block_the_heading( $atts, $tabs, $multi_tab );
		}

	if ( $multi_tab ){ ?>
		<div class="tab-content"><?php
	}

		$have_slider            = ! empty( $atts['have_slider'] );
		$have_slider_controller = $this->have_slider_controller( $atts );

		foreach ( (array) $tabs as $idx => $tab ) {

			// copy main atts to change and customize it for tab
			$_tab_atts = $atts;

			// Fix tabs terms
			switch ( $tab['type'] ) {

				// change atts category to tab category to fix query
				case 'category':
					$_tab_atts['category'] = $tab['term_id'];

					// tags only will be included inside first tab
					if ( $tab['active'] ) {
						$_tab_atts['tag'] = '';
					}
					break;

			}

			//deferred tab options
			$_tab_is_deferred = $_is_tabs_deferred && ! $tab['active'];

			if ( $multi_tab ) {
				?><div class="tab-pane bs-tab-anim<?php
				echo $tab['active'] ? ' active' : '';
				echo $_tab_is_deferred ? ' bs-deferred-container' : '';
				?>" id="<?php echo esc_attr( $tab['id'] );
				?>"><?php
			}

			$iteration = empty( $_tab_atts['pagination_query_count'] ) ? 1 : intval( $_tab_atts['pagination_query_count'] );
			$iteration = max( 1, $iteration );

			if ( $_tab_is_deferred ) {

				publisher_set_prop( 'listing-prim-cat', isset( $_tab_atts['category'] ) ? $_tab_atts['category'] : 'none' );
				publisher_theme_pagin_manager()->wrapper_start( $atts, $iteration );
				publisher_theme_pagin_manager()->display_deferred_html( $_tab_atts, $this->view, $this->type, isset( $tab['data']['deferred-init'] ) ? $tab['data']['deferred-init'] : 0 );
				publisher_theme_pagin_manager()->wrapper_end();
				publisher_clear_props();
				echo '</div>';

				continue;
			}

			if ( $have_slider ) {

				echo '<div class="bs-slider-items-container"';
				$this->slider_settings_atts( $_tab_atts );
				echo '>';

			}

			$args          = publisher_pagin_create_query_args( $_tab_atts );
			$wp_query_args = apply_filters( 'publisher-theme-core/pagination/bs-theme-listing/args', $args, $_tab_atts, $tabs );

			if ( $tab['type'] == 'category' ) {
				publisher_set_prop( 'listing-prim-cat', $tab['term_id'] );
			}

			if ( ! empty( $_tab_atts['have_pagination'] ) ) {

				/**
				 * modify posts_per_page value
				 */
				$slide_posts = 0;
				if ( ! empty( $wp_query_args['posts_per_page'] ) ) {

					$slide_posts = $wp_query_args['posts_per_page'];
					$wp_query_args['posts_per_page'] *= $iteration;
				} else if ( ! empty( $wp_query_args['showposts'] ) ) {

					$slide_posts = $wp_query_args['showposts'];
					$wp_query_args['showposts'] *= $iteration;
				}

				if ( $slide_posts ) {
					publisher_set_prop( 'posts-count', $slide_posts );
				}

				$wp_query = $this->set_post_query( $wp_query_args, $multi_tab && ! $tab['active'] ? $_tab_atts : $atts );

				// cache it for preventing each slide to shit this!
				global $publisher_theme_core_props_cache;
				$_listing_prop = $publisher_theme_core_props_cache;

				for ( $i = 0; $i < $iteration; $i ++ ) {

					if ( ! publisher_have_posts() ) {
						break;
					}

					publisher_theme_pagin_manager()->wrapper_start( $_tab_atts, $iteration, ( $i ? '' : 'bs-slider-first-item' ) );
					$this->display_content( $_tab_atts, $tab );
					publisher_theme_pagin_manager()->wrapper_end();

					// return back props for next slide to fix props changing problems
					$GLOBALS['publisher_theme_core_props_cache'] = $_listing_prop;
				}

				// Display pagination
				publisher_theme_pagin_manager()->display_pagination( $_tab_atts, $wp_query, $this->view, $this->type );

			} else {

				publisher_theme_pagin_manager()->set_post_query( $wp_query_args, $multi_tab && ! $tab['active'] ? $_tab_atts : $atts );

				$this->display_content( $_tab_atts, $tab );
			}

			if ( $have_slider ) {

				// slider controller when it's enabled
				if ( $have_slider_controller ) {
					echo '<div class="bs-slider-controls main-term-', sanitize_html_class( publisher_get_prop( 'listing-prim-cat', 'none' ) ), '">';
					if ( $this->have_slider_controller( $_tab_atts, 'next_prev' ) ) {
						echo '<div class="bs-control-nav ', ' bs-control-nav-', sanitize_html_class( $_tab_atts['slider-control-next-prev'] ), '"></div>';
					}
					echo '</div>'; // bs-slider-controls
				}

				echo '</div>';
			}

			if ( $multi_tab ) {
				?></div><?php
			}
		}

	if ( $multi_tab ){
		?></div><?php
	}

		if ( empty( $atts['hide_main_wrapper'] ) ) {
			?>
			</div>
			<?php
		}

		publisher_clear_props();

		return ob_get_clean();

	} // display


	/**
	 * Handy function to set query args. Childs can override this
	 *
	 * @param $wp_query_args
	 *
	 * @return \WP_Query
	 */
	function set_post_query( $wp_query_args, $atts = array() ) {
		return publisher_theme_pagin_manager()->set_post_query( $wp_query_args );
	}


	/**
	 * Display the inner content of listing
	 *
	 * @param string $atts         Attribute of shortcode or ajax action
	 * @param string $tab          Tab
	 * @param string $pagin_button Ajax action button
	 */
	function display_content( &$atts, $tab = '', $pagin_button = '' ) {
		trigger_error( sprintf( __( 'You should override display content in child of Publisher_Theme_Listing_Shortcode class.', 'publisher' ) ) );
	}


	/**
	 * Registers Visual Composer Add-on
	 */
	function register_vc_add_on() {
		vc_map(
			array(
				"name"           => $this->name,
				"base"           => $this->id,
				"icon"           => $this->icon,
				"description"    => $this->description,
				"weight"         => 10,
				"wrapper_height" => 'full',
				"category"       => __( 'Content', 'publisher' ),
				"params"         => $this->vc_map_listing_all()
			)
		);
	}


	/**
	 *
	 * @return array
	 */
	public static function pagination_styles() {
		return Publisher_Theme_Listing_Pagin_Manager::pagination_styles();
	}


	protected function pagination_styles_group() {
		return array(
			'ajax'   => 'Ajax',
			'slider' => 'Slider'
		);
	}

	//
	// VC Maps Functions
	//


	/**
	 * Maps all listing VC params
	 *
	 * @return array
	 */
	public function vc_map_listing_all() {

		return array_merge(
			$this->vc_map_listing_headings(),
			$this->vc_map_listing_filters(),
			$this->vc_map_listing_tabs(),
			$this->vc_map_listing_pagination(),
			$this->vc_map_design_options()
		);
	}


	/**
	 * Handy function used to add posts filters fields array to VC_Map
	 *
	 * @return array
	 */
	function vc_map_listing_filters() {
		return array(
			array(
				"type"        => 'bf_select',
				"admin_label" => TRUE,
				"heading"     => __( 'Categories', 'publisher' ),
				"param_name"  => 'category',
				"value"       => $this->defaults['category'],
				"options"     => array(
					'' => __( 'All Posts', 'publisher' ),
					array(
						'label'   => __( 'Categories', 'publisher' ),
						'options' => array(
							'category_walker' => 'category_walker'
						),
					),
				),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'bf_ajax_select',
				"admin_label" => TRUE,
				"heading"     => __( 'Tags', 'publisher' ),
				"param_name"  => 'tag',
				"value"       => $this->defaults['tag'],
				"callback"    => 'BF_Ajax_Select_Callbacks::tags_callback',
				"get_name"    => 'BF_Ajax_Select_Callbacks::tag_name',
				'placeholder' => __( "Search tag...", 'publisher' ),
				'description' => __( "Search and select tags. You can use combination of Category and Tags!", 'publisher' ),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'textfield',
				"admin_label" => TRUE,
				"heading"     => __( 'Post ID filter', 'publisher' ),
				"param_name"  => 'post_ids',
				"value"       => $this->defaults['post_ids'],
				'description' => __( "Filter multiple posts by ID. Enter here the post IDs separated by commas (ex: 10,27,233). To exclude posts from this block add them with '-' (ex: -7, -16)", 'publisher' ),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'textfield',
				"admin_label" => TRUE,
				"heading"     => __( 'Number of Posts', 'publisher' ),
				"param_name"  => 'count',
				"value"       => $this->defaults['count'],
				"description" => __( 'If the field is empty the limit post number will be the number from WordPress Settings -> Reading.', 'publisher' ),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				'type'        => 'bf_select',
				'heading'     => __( 'Time Filter', 'publisher' ),
				'param_name'  => 'time_filter',
				"admin_label" => TRUE,
				"value"       => $this->defaults['time_filter'],
				"options"     => array(
					''          => __( 'No Filter', 'publisher' ),
					'today'     => __( 'Today Posts', 'publisher' ),
					'yesterday' => __( 'Today + Yesterday Posts', 'publisher' ),
					'week'      => __( 'This Week Posts', 'publisher' ),
					'month'     => __( 'This Month Posts', 'publisher' ),
					'year'      => __( 'This Year Posts', 'publisher' ),
				),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'textfield',
				"admin_label" => TRUE,
				"heading"     => __( 'Custom Post Type', 'publisher' ),
				"param_name"  => 'post_type',
				"value"       => $this->defaults['post_type'],
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'textfield',
				"admin_label" => TRUE,
				"heading"     => __( 'Offset posts', 'publisher' ),
				"description" => __( 'Start the count with an offset. If you have a block that shows 4 posts before this one, you can make this one start from the 5\'th post (by using offset 4)', 'publisher' ),
				"param_name"  => 'offset',
				"value"       => $this->defaults['offset'],
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'bf_select',
				"heading"     => __( 'Order', 'publisher' ),
				"param_name"  => 'order',
				"admin_label" => FALSE,
				"value"       => $this->defaults['order'],
				"options"     => array(
					'DESC' => __( 'Latest First - Descending', 'publisher' ),
					'ASC'  => __( 'Oldest First - Ascending', 'publisher' ),
				),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
			array(
				"type"        => 'bf_select',
				"heading"     => __( 'Order By', 'publisher' ),
				"param_name"  => 'order_by',
				"admin_label" => FALSE,
				"value"       => $this->defaults['order_by'],
				"options"     => publisher_get_order_field_option(),
				'group'       => __( 'Posts Filter', 'publisher' ),
			),
		);
	} // vc_map_listing_filters


	/**
	 * Handy function used to add posts filters fields array to VC_Map
	 *
	 * @return array
	 */
	function vc_map_listing_tabs() {
		return array(
			array(
				'type'        => 'bf_select',
				'heading'     => __( 'Tabs', 'publisher' ),
				'param_name'  => 'tabs',
				"admin_label" => FALSE,
				"value"       => $this->defaults['tabs'],
				"options"     => array(
					''               => __( 'No Tab', 'publisher' ),
					'cat_filter'     => __( 'Categories as Tab', 'publisher' ),
					'sub_cat_filter' => __( 'Sub Categories as Tab', 'publisher' ),
				),
				'group'       => __( 'Multi Tabs', 'publisher' ),
			),
			array(
				"type"        => 'bf_select',
				"admin_label" => FALSE,
				"heading"     => __( 'Selected Categories as Tab', 'publisher' ),
				"param_name"  => 'tabs_cat_filter',
				"value"       => $this->defaults['tabs_cat_filter'],
				"options"     => array(
					'category_walker' => 'category_walker'
				),
				'group'       => __( 'Multi Tabs', 'publisher' ),
				'multiple'    => TRUE,
				'description' => __( 'Select multiple categories with holding "Control" button. this will create multi tab header.', 'publisher' ),
				'show_on'     => array( array( 'tabs=cat_filter' ) ),
			),
			array(
				"type"        => 'bf_select',
				"admin_label" => FALSE,
				"heading"     => __( 'Tabs content type', 'publisher' ),
				"param_name"  => 'tabs_content_type',
				"value"       => $this->defaults['tabs_content_type'],
				"options"     => array(
					'deferred'  => __( 'Deferred Content', 'publisher' ),
					'preloaded' => __( 'Preloaded Content', 'publisher' ),
				),
				'group'       => __( 'Multi Tabs', 'publisher' ),
				'description' => __( '<strong>Recommended</strong>: Deferred. <br> Use deferred content type to make site loading faster, There is no need to load content\'s in tabs that maybe users didn\'t see them.', 'publisher' ),
				'show_on'     => array( array( 'tabs=cat_filter' ), array( 'tabs=sub_cat_filter' ) ),
			),
		);
	} // vc_map_listing_tabs


	/**
	 * Handy function used to add posts filters fields array to VC_Map
	 *
	 * @return array
	 */
	function vc_map_listing_headings() {
		return array(
			array(
				"type"        => 'textfield',
				"admin_label" => TRUE,
				"heading"     => __( 'Custom Heading (Optional)', 'publisher' ),
				"param_name"  => 'title',
				"value"       => $this->defaults['title'],
				'group'       => __( 'Heading', 'publisher' ),
			),
			array(
				"type"        => 'bf_icon_select',
				"heading"     => __( 'Custom Heading Icon (Optional)', 'publisher' ),
				"param_name"  => 'icon',
				"admin_label" => FALSE,
				"value"       => $this->defaults['icon'],
				"description" => __( 'Select custom icon for listing.', 'publisher' ),
				'group'       => __( 'Heading', 'publisher' ),
			),
			array(
				"type"          => 'bf_switchery',
				"heading"       => __( 'Hide listing Heading?', 'publisher' ),
				"param_name"    => 'hide_title',
				"admin_label"   => FALSE,
				"value"         => $this->defaults['hide_title'],
				'section_class' => 'style-floated-left bordered',
				"description"   => __( 'You can hide listing heading with turning on this field.', 'publisher' ),
				'group'         => __( 'Heading', 'publisher' ),
			),
		);
	} // vc_map_listing_tabs


	function vc_map_listing_pagination() {

		$groups = $this->pagination_styles_group();

		$options = array( 'none' => __( 'no Pagination', 'publisher' ) );
		foreach ( self::pagination_styles() as $key => $data ) {
			$group = &$data['group'];

			if ( ! isset( $options[ $group ] ) ) {
				$options[ $group ] = array(
					'label'   => isset( $groups[ $group ] ) ? $groups[ $group ] : $group,
					'options' => array()
				);
			}

			$options[ $group ]['options'][ $key ] = $data['name'];
		}

		return array(
			array(
				"type"        => 'bf_select',
				"heading"     => __( 'Pagination Type', 'publisher' ),
				"param_name"  => 'paginate',
				"admin_label" => FALSE,
				"options"     => $options,
				'group'       => __( 'Pagination', 'publisher' ),
				'always_show' => TRUE
			),

			array(
				"type"        => 'bf_switchery',
				"heading"     => __( 'Show pagination number label', 'publisher' ),
				"param_name"  => 'pagination-show-label',
				"admin_label" => FALSE,
				'value'       => $this->defaults['pagination-show-label'],
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array( array( 'paginate=next_prev' ) )
			),

			array(
				"type"        => 'textfield',
				"heading"     => __( 'Number of slides', 'publisher' ),
				"param_name"  => 'pagination-slides-count',
				"admin_label" => FALSE,
				'value'       => $this->defaults['pagination-slides-count'],
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array( 'paginate=slider' )
			),

			array(
				"type"        => 'textfield',
				"heading"     => __( 'Animation Speed', 'publisher' ),
				"param_name"  => 'slider-animation-speed',
				"admin_label" => FALSE,
				'value'       => $this->defaults['slider-animation-speed'],
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array( 'paginate=slider' )
			),
			array(
				"type"        => 'bf_switchery',
				"heading"     => __( 'AutoPlay', 'publisher' ),
				"param_name"  => 'slider-autoplay',
				"admin_label" => FALSE,
				'value'       => $this->defaults['slider-autoplay'],
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array( 'paginate=slider' )
			),
			array(
				"type"        => 'textfield',
				"heading"     => __( 'Slide duration', 'publisher' ),
				"param_name"  => 'slider-speed',
				"admin_label" => FALSE,
				'value'       => $this->defaults['slider-speed'],
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array(
					array( 'paginate=slider', 'slider-autoplay=1' ),
				)
			),
			array(
				"type"        => 'bf_select',
				"heading"     => __( 'Display Dot Navigation', 'publisher' ),
				"param_name"  => 'slider-control-dots',
				"admin_label" => FALSE,
				'value'       => $this->defaults['slider-control-dots'],
				"options"     => array(
					'off'     => __( 'Don\'t Show', 'publisher' ),
					'style-1' => __( 'Style 1', 'publisher' ),
					'style-2' => __( 'Style 2', 'publisher' ),
					'style-3' => __( 'Style 3', 'publisher' ),
					'style-4' => __( 'Style 4', 'publisher' ),
				),
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array( 'paginate=slider' )
			),
			array(
				"type"        => 'bf_select',
				"heading"     => __( 'Display Control Navigation', 'publisher' ),
				"param_name"  => 'slider-control-next-prev',
				"admin_label" => FALSE,
				'value'       => $this->defaults['slider-control-next-prev'],
				"options"     => array(
					'off'     => __( 'Don\'t Show', 'publisher' ),
					'style-1' => __( 'Style 1', 'publisher' ),
					'style-2' => __( 'Style 2', 'publisher' ),
					'style-3' => __( 'Style 3', 'publisher' ),
					'style-4' => __( 'Style 4', 'publisher' ),
				),
				'group'       => __( 'Pagination', 'publisher' ),
				'show_on'     => array( 'paginate=slider' )
			),
		);
	} // vc_map_listing_pagination

	function vc_map_design_options() {
		return array(
			array(
				"type"          => 'bf_switchery',
				"heading"       => __( 'Show on Desktop', 'publisher' ),
				"param_name"    => 'bs-show-desktop',
				"admin_label"   => FALSE,
				"value"         => $this->defaults['bs-show-desktop'],
				'section_class' => 'style-floated-left bordered bf-css-edit-switch',
				'group'         => __( 'Design options', 'publisher' ),
			),
			array(
				"type"          => 'bf_switchery',
				"heading"       => __( 'Show on Tablet Portrait', 'publisher' ),
				"param_name"    => 'bs-show-tablet',
				"admin_label"   => FALSE,
				"value"         => $this->defaults['bs-show-tablet'],
				'section_class' => 'style-floated-left bordered bf-css-edit-switch',
				'group'         => __( 'Design options', 'publisher' ),
			),
			array(
				"type"          => 'bf_switchery',
				"heading"       => __( 'Show on Phone', 'publisher' ),
				"param_name"    => 'bs-show-phone',
				"admin_label"   => FALSE,
				"value"         => $this->defaults['bs-show-phone'],
				'section_class' => 'style-floated-left bordered bf-css-edit-switch',
				'group'         => __( 'Design options', 'publisher' ),
			),

			array(
				'type'       => 'css_editor',
				'heading'    => __( 'CSS box', 'publisher' ),
				'param_name' => 'css',
				'group'      => __( 'Design options', 'publisher' ),
			)
		);
	}
}
