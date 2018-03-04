<?php

/**
 * Container of all theme category fields
 */
class Publisher_Theme_Category_Fields {

	/**
	 * List of all category options
	 *
	 * @var array
	 */
	public static $fields = array();


	/**
	 * Flag to init fields only once
	 *
	 * @var bool
	 */
	public static $fields_initialized = FALSE;


	/**
	 * General term color field CSS
	 *
	 * @var array
	 */
	public static $term_color_css = array(
		'color'            =>
			array(
				'selector' =>
					array(
						0  => '.widget.widget_categories li.cat-item.cat-item-%%id%% > a:hover',
						1  => '.main-menu.menu > li.menu-term-%%id%%:hover > a',
						2  => 'ul.menu.footer-menu li.menu-term-%%id%% > a:hover',
						3  => '.listing-item.main-term-%%id%%:hover .title a',
						4  => 'body.category-%%id%% .archive-title .page-heading',
						5  => '.listing-item-classic.main-term-%%id%% .post-meta a:hover',
						6  => '.listing-item-blog.main-term-%%id%% .post-meta a:hover',
						7  => '.listing-item-grid.main-term-%%id%% .post-meta a:hover',
						8  => '.listing-item-text-1.main-term-%%id%% .post-meta a:hover',
						9  => '.listing-item-text-2.main-term-%%id%% .post-meta a:hover',
						10 => '.bs-popular-categories .bs-popular-term-item.term-item-%%id%%:hover a',
						11 => '.listing-mg-5-item.main-term-%%id%%:hover .title',
						14 => '.listing-mg-5-item.main-term-%%id%%:hover .title a:hover',
						12 => '.listing-item-tall-1.main-term-%%id%%:hover > .title',
						13 => '.listing-item-tall-2.main-term-%%id%%:hover > .title',
						// 14 reserved
					),
				'prop'     =>
					array(
						'color' => '%%value%% !important',
					),
			),
		'bg_color'         =>
			array(
				'selector' =>
					array(
						0 => '.main-menu.menu > li.menu-term-%%id%%:hover > a:before',
						1 => '.main-menu.menu > li.menu-term-%%id%%.current-menu-item > a:before',
						2 => '.main-menu.menu > li.menu-term-%%id%%.current-menu-parent > a:before',

						3 => '.widget.widget_nav_menu ul.menu li.menu-term-%%id%% > a:hover',
						4 => '.widget.widget_categories li.cat-item.cat-item-%%id%% > a:hover > .post-count',

						5 => '.listing-item-text-1.main-term-%%id%%:hover .term-badges.floated .term-badge.term-%%id%% a',
						6 => '.listing-item-tb-2.main-term-%%id%%:hover .term-badges.floated .term-badge a',
						7 => '.listing-item.main-term-%%id%%:hover a.read-more',

						8  => '.term-badges .term-badge.term-%%id%% a',
						25 => '.archive-title .term-badges span.term-badge.term-%%id%% a:hover',

						9  => 'body.category-%%id%% .archive-title .pre-title span',
						10 => 'body.category-%%id%% .archive-title .pre-title:after',

						11 => '.section-heading.main-term-%%id%% .h-text.main-term-%%id%%',
						12 => '.section-heading.main-term-%%id%%:after',
						13 => '.section-heading .h-text.main-term-%%id%%:hover',

						14 => '.bs-pagination.main-term-%%id%% .btn-bs-pagination:hover',
						15 => '.bs-pagination-wrapper.main-term-%%id%% .bs-loading > div',
						24 => '.bs-pagination.main-term-%%id%% .btn-bs-pagination.bs-pagination-in-loading',

						22 => '.bs-slider-controls.main-term-%%id%% .btn-bs-pagination:hover',
						23 => '.bs-slider-controls.main-term-%%id%% .bs-slider-dots .bs-slider-active > .bts-bs-dots-btn',

						16 => '.main-menu.menu > li.menu-term-%%id%% > a > .better-custom-badge',

						17 => '.bs-popular-categories .bs-popular-term-item.term-item-%%id%%:hover .term-count',

						18 => '.bs-slider-2-item.main-term-%%id%% .term-badges.floated .term-badge a',
						19 => '.bs-slider-3-item.main-term-%%id%% .term-badges.floated .term-badge a',
						20 => '.bs-slider-2-item.main-term-%%id%% .content-container a.read-more:hover',
						21 => '.bs-slider-3-item.main-term-%%id%% .content-container a.read-more:hover',
						// 22 is reserved
						// 23 is reserved
						// 24 is reserved
						// 25 is reserved
					),
				'prop'     =>
					array(
						'background-color' => '%%value%% !important; color: #fff;',
					),
			),
		'border_top_color' =>
			array(
				'selector' =>
					array(
						0 => '.main-menu.menu > li.menu-term-%%id%% > a > .better-custom-badge:after',
					),
				'prop'     =>
					array(
						'border-top-color' => '%%value%% !important',
					),
			),
		'border_color'     =>
			array(
				'selector' =>
					array(
						0 => '.listing-item-text-2.main-term-%%id%% .item-inner',

						1 => '.bs-pagination.main-term-%%id%% .btn-bs-pagination:hover',
						6 => '.bs-pagination.main-term-%%id%% .btn-bs-pagination.bs-pagination-in-loading',

						5 => '.bs-slider-controls.main-term-%%id%% .btn-bs-pagination:hover',

						3 => '.bs-slider-2-item.main-term-%%id%% .content-container a.read-more',
						4 => '.bs-slider-3-item.main-term-%%id%% .content-container a.read-more',

						// 5 is reserved
						// 6 is reserved
					),
				'prop'     =>
					array(
						'border-color' => '%%value%% !important',
					),
			),
		'selection'        =>
			array(
				'selector' =>
					array(
						0 => 'body.category-%%id%% ::selection',
					),
				'prop'     =>
					array(
						'background' => '%%value%% !important',
					),
			),
		'selection_moz'    =>
			array(
				'selector' =>
					array(
						0 => 'body.category-%%id%% ::-moz-selection',
					),
				'prop'     =>
					array(
						'background' => '%%value%% !important',
					),
			),
		'reviews_bg_color' =>
			array(
				'selector' =>
					array(
						0 => '.listing-item.main-term-%%id%% .rating-bar span'
					),
				'prop'     => 'background-color',
			),
		'reviews_color'    =>
			array(
				'selector' =>
					array(
						0 => '.listing-item.main-term-%%id%% .rating-stars span:before'
					),
				'prop'     => 'color',
			),

	);

	/**
	 * Initialize base catgeory fields
	 *
	 * ***** Table of contents *****
	 *
	 * => Style
	 *      -> Top Posts
	 *      -> Background
	 *
	 * => Title
	 *
	 * => Header Options
	 *      -> Logo
	 *
	 * => Custom Javascript / CSS
	 */
	public static function init_base_fields() {

		// init fields only once
		if ( self::$fields_initialized ) {
			return;
		}


		/**
		 * => Style
		 */
		self::$fields[]                       = array(
			'name' => __( 'Style', 'publisher' ),
			'id'   => 'tab_style',
			'type' => 'tab',
			'icon' => 'bsai-paint',
		);
		self::$fields['term_color']           = array(
			'name'     => __( 'Category Highlight Color', 'publisher' ),
			'id'       => 'term_color',
			'type'     => 'color',
			'std'      => '',
			'save-std' => FALSE,
			'style'    => array( 'default' ),
			'desc'     => __( 'This color will be used in several areas such as navigation and listing blocks to emphasize category.', 'publisher' ),
			'css'      => self::$term_color_css,
		);
		self::$fields['page_layout']          = array(
			'name'             => __( 'Page Layout', 'publisher' ),
			'id'               => 'page_layout',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override default layout for this category layout.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		self::$fields['layout_style']         = array(
			'name'    => __( 'Page Boxed Style', 'publisher' ),
			'id'      => 'layout_style',
			'std'     => 'default',
			'type'    => 'select',
			'desc'    => __( 'Override default layout for this category layout.', 'publisher' ),
			'options' => array(
				'default'    => __( 'Default', 'publisher' ),
				'full-width' => __( 'Full Width', 'publisher' ),
				'boxed'      => __( 'Boxed', 'publisher' ),
			)
		);
		self::$fields['page_listing']         = array(
			'name'             => __( 'Posts Listing', 'publisher' ),
			'id'               => 'page_listing',
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override default posts listing fot this category.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		self::$fields['term_posts_count']     = array(
			'name' => __( 'Number of Post to Show', 'publisher' ),
			'id'   => 'term_posts_count',
			'desc' => wp_kses( sprintf( __( 'Leave this empty for default. <br>Default: %s', 'publisher' ), publisher_get_option( 'archive_cat_posts_count' ) != '' ? publisher_get_option( 'archive_cat_posts_count' ) : get_option( 'posts_per_page' ) ), bf_trans_allowed_html() ),
			'type' => 'text',
			'std'  => '',
		);
		self::$fields['term_pagination_type'] = array(
			'name'             => __( 'Category pagination', 'publisher' ),
			'id'               => 'term_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of this category.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);


		/**
		 * -> Background
		 */
		self::$fields[]           = array(
			'name'  => __( 'Background Style', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['bg_color'] = array(
			'name'     => __( 'Body Background Color', 'publisher' ),
			'id'       => 'bg_color',
			'type'     => 'color',
			'std'      => publisher_get_option( 'bg_color' ),
			'save-std' => FALSE,
			'desc'     => __( 'Setting a body background image below will override it.', 'publisher' ),
			'css'      => array(
				array(
					'selector' => array(
						'body.category-%%id%%',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['bg_image'] = array(
			'name'         => __( 'Body Background Image', 'publisher' ),
			'id'           => 'bg_image',
			'type'         => 'background_image',
			'std'          => '',
			'upload_label' => __( 'Upload Image', 'publisher' ),
			'desc'         => __( 'Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'publisher' ),
			'css'          => array(
				array(
					'selector' => array(
						'body.category-%%id%%'
					),
					'prop'     => array( 'background-image' ),
					'type'     => 'background-image',
				)
			)
		);


		/**
		 * => Title
		 */
		self::$fields[]                        = array(
			'name' => __( 'Title', 'publisher' ),
			'id'   => 'tab_title',
			'type' => 'tab',
			'icon' => 'bsai-title',
		);
		self::$fields['term_custom_pre_title'] = array(
			'name' => __( 'Custom Pre Title', 'publisher' ),
			'id'   => 'term_custom_pre_title',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Customize category pre title with this option for making category page more specific.', 'publisher' ),
		);
		self::$fields['term_custom_title']     = array(
			'name' => __( 'Custom Category Title', 'publisher' ),
			'id'   => 'term_custom_title',
			'type' => 'text',
			'std'  => '',
			'desc' => __( 'Customize category title in archive page without renaming name of category.', 'publisher' ),
		);
		self::$fields['hide_term_title']       = array(
			'name'      => __( 'Hide Category Title', 'publisher' ),
			'id'        => 'hide_term_title',
			'type'      => 'switch',
			'std'       => '0',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enable this for hiding category title.', 'publisher' ),
		);
		self::$fields['hide_term_description'] = array(
			'name'      => __( 'Hide Category Description', 'publisher' ),
			'id'        => 'hide_term_description',
			'type'      => 'switch',
			'std'       => '0',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enable this for hiding category description.', 'publisher' ),
		);


		/**
		 * => Header Options
		 */
		self::$fields['header_options'] = array(
			'name' => __( 'Header', 'publisher' ),
			'id'   => 'header_options',
			'type' => 'tab',
			'icon' => 'bsai-header',
		);
		self::$fields[]                 = array(
			'name'  => __( 'Header', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['header_style']   = array(
			'name'             => __( 'Header Style', 'publisher' ),
			'id'               => 'header_style',
			'desc'             => __( 'Override header style for this category.', 'publisher' ),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'deferred-options' => array(
				'callback' => 'publisher_header_style_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		self::$fields['header_layout']  = array(
			'name'    => __( 'Header Boxed', 'publisher' ),
			'id'      => 'header_layout',
			'desc'    => __( 'Select header layout.', 'publisher' ),
			'std'     => 'default',
			'type'    => 'select',
			'options' => array(
				'default'    => __( 'Default', 'publisher' ),
				'boxed'      => __( 'Boxed header', 'publisher' ),
				'full-width' => __( 'Full width header', 'publisher' ),
			),
		);
		self::$fields['main_nav_menu']  = array(
			'name'             => __( 'Main Navigation Menu', 'publisher' ),
			'id'               => 'main_nav_menu',
			'desc'             => __( 'Replace & change main menu for this category.', 'publisher' ),
			'type'             => 'select',
			'std'              => 'default',
			'deferred-options' => array(
				'callback' => 'bf_get_menus_option',
				'args'     => array(
					TRUE,
					__( '-- Default Main Navigation --', 'publisher' ),
				),
			),
		);

		/**
		 * -> Logo
		 */
		self::$fields[]                        = array(
			'name'  => __( 'Category Custom Logo', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['logo_image']            = array(
			'name'         => __( 'Logo Image', 'publisher' ),
			'id'           => 'logo_image',
			'desc'         => __( 'You can override default site logo with this option to create fully customized archive pages for each category.', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Upload Logo', 'publisher' ),
			'media_button' => __( 'Select Image', 'publisher' ),
			'upload_label' => __( 'Upload Logo', 'publisher' ),
			'remove_label' => __( 'Remove Logo', 'publisher' ),
			'save-std'     => FALSE,
		);
		self::$fields['logo_image_retina']     = array(
			'name'         => __( 'Logo Image Retina (2x)', 'publisher' ),
			'id'           => 'logo_image_retina',
			'desc'         => __( 'If you want to upload a Retina Image, It\'s Image Size should be exactly double in compare with your normal Logo. It requires WP Retina 2x plugin.', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Upload Retina Logo', 'publisher' ),
			'media_button' => __( 'Select Retina Image', 'publisher' ),
			'upload_label' => __( 'Upload Retina Logo', 'publisher' ),
			'remove_label' => __( 'Remove Retina Logo', 'publisher' ),
			'save-std'     => FALSE,
		);
		self::$fields[]                        = array(
			'name'  => __( 'Header Padding', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['header_top_padding']    = array(
			'name'             => __( 'Header Top Padding', 'publisher' ),
			'id'               => 'header_top_padding',
			'suffix'           => __( 'Pixel', 'publisher' ),
			'desc'             => __( 'In pixels without px, ex: 20. <br>Leave empty for default value.', 'publisher' ),
			'type'             => 'text',
			'std'              => '',
			'css-echo-default' => FALSE,
			'css'              => array(
				array(
					'selector' => array(
						'body.category-%%id%% .site-header .header-inner',
						'body.category-%%id%% .site-header .header-inner',
					),
					'prop'     => array( 'padding-top' => '%%value%%px' ),
				)
			),
		);
		self::$fields['header_bottom_padding'] = array(
			'name'             => __( 'Header Bottom Padding', 'publisher' ),
			'id'               => 'header_bottom_padding',
			'suffix'           => __( 'Pixel', 'publisher' ),
			'desc'             => __( 'In pixels without px, ex: 20. <br>Leave empty for default value. Values lower than 60px will break the style.', 'publisher' ),
			'type'             => 'text',
			'std'              => '',
			'css-echo-default' => FALSE,
			'css'              => array(
				array(
					'selector' => array(
						'body.category-%%id%% .site-header .header-inner',
						'body.category-%%id%% .site-header .header-inner',
					),
					'prop'     => array( 'padding-bottom' => '%%value%%px' ),
				)
			),
		);


		/**
		 * -> Top Posts
		 */
		self::$fields[]                         = array(
			'name' => __( 'Slider', 'publisher' ),
			'id'   => 'tab_slider',
			'type' => 'tab',
			'icon' => 'bsai-slider',
		);
		self::$fields['slider_type']            = array(
			'name'             => __( 'Categories Slider Type', 'publisher' ),
			'id'               => 'slider_type',
			'desc'             => __( 'Select category top posts blocks or custom "Slider Revolution".', 'publisher' ),
			'std'              => 'default',
			'type'             => 'select',
			'deferred-options' => array(
				'callback' => 'publisher_slider_types_option_list',
				'args'     => array(
					TRUE
				)
			),
		);
		self::$fields[]                         = array(
			'name'  => __( 'Top Posts Settings', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['better_slider_style']    = array(
			'name'             => __( 'Category Top Posts', 'publisher' ),
			'id'               => 'better_slider_style',
			'desc'             => __( 'Select slider style.', 'publisher' ),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'deferred-options' => array(
				'callback' => 'publisher_topposts_option_list',
				'args'     => array(
					TRUE,
				),
			),
		);
		self::$fields['better_slider_gradient'] = array(
			'name'          => __( 'Overlay Gradient', 'publisher' ),
			'id'            => 'better_slider_gradient',
			'desc'          => __( 'Select slider items overlay style.', 'publisher' ),
			'std'           => 'default',
			'type'          => 'select',
			'section_class' => 'style-floated-left bordered',
			'options'       => array(
				'default'      => __( '-- Default --', 'publisher' ),
				'colored'      => __( 'Colored Gradient', 'publisher' ),
				'colored-anim' => __( 'Animated Gradient', 'publisher' ),
				'simple-gr'    => __( 'Simple Gradient', 'publisher' ),
				'simple'       => __( 'Simple', 'publisher' ),
			),
		);
		self::$fields[]                         = array(
			'name'  => __( 'Slider Revolution Settings', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		// todo add style for rev slider ex: wide, boxed, in main columns...
		self::$fields['rev_slider_item'] = array(
			'name'             => __( 'Categories Top Slider Revolution', 'publisher' ),
			'id'               => 'rev_slider_item',
			'desc'             => __( 'Select a "Slider Revolution" slider for top of categories.', 'publisher' ),
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '',
			'type'             => 'select',
			'deferred-options' => array(
				'callback' => 'bf_deferred_option_get_rev_sliders',
				'args'     => array(
					array(
						'default' => TRUE
					)
				)
			),
		);


		/**
		 *
		 * Custom CSS code
		 *
		 */
		bf_inject_panel_custom_css_fields( self::$fields );


	} // init_base_fields

} // Publisher_Theme_Panel_Fields