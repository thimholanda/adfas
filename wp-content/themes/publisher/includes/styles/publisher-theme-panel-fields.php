<?php

/**
 * Container of all theme option panel fields
 */
class Publisher_Theme_Panel_Fields {

	/**
	 * List of all options
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
	 * Contains global CSS config for theme color field
	 *
	 * @var array
	 */
	public static $theme_color_css =
		array(
			'bg_color'          =>
				array(
					'selector' =>
						array(
							0  => '.main-bg-color',
							1  => '.btn',
							2  => 'button',
							3  => 'html input[type="button"]',
							4  => 'input[type="reset"]',
							5  => 'input[type="submit"]',
							6  => 'input[type="button"]',
							7  => '.btn:focus',
							8  => '.btn:hover',
							9  => 'button:focus',
							10 => 'button:hover',
							11 => 'html input[type="button"]:focus',
							12 => 'html input[type="button"]:hover',
							13 => 'input[type="reset"]:focus',
							14 => 'input[type="reset"]:hover',
							15 => 'input[type="submit"]:focus',
							16 => 'input[type="submit"]:hover',
							17 => 'input[type="button"]:focus',
							18 => 'input[type="button"]:hover',
							19 => '.main-menu.menu .sub-menu li.current-menu-item:hover > a:hover',
							20 => '.main-menu.menu .better-custom-badge',
							21 => '.widget.widget_nav_menu .menu .better-custom-badge',
							70 => '.responsive-header .menu-container .resp-menu .better-custom-badge',
							22 => '.bs-popular-categories .bs-popular-term-item:hover .term-count',
							23 => '.widget.widget_tag_cloud .tagcloud a:hover',
							24 => 'span.dropcap.dropcap-square',
							25 => 'span.dropcap.dropcap-circle',
							26 => '.bs-tab-shortcode .nav-tabs>li>a:focus',
							27 => '.bs-tab-shortcode .nav-tabs>li>a:hover',
							28 => '.bs-tab-shortcode .nav-tabs>li.active>a',
							29 => '.better-control-nav li a.better-active',
							30 => '.better-control-nav li:hover a',
							31 => '.main-menu.menu > li:hover > a:before',
							32 => '.main-menu.menu > li.current-menu-parent > a:before',
							33 => '.main-menu.menu > li.current-menu-item > a:before',
							34 => '.main-slider .better-control-nav li a.better-active',
							35 => '.main-slider .better-control-nav li:hover a',
							36 => '.site-footer.color-scheme-dark .footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
							37 => '.site-footer.color-scheme-dark .footer-widgets .widget.widget_nav_menu ul.menu li a:hover',
							38 => '.entry-terms.via a:hover',
							39 => '.entry-terms.source a:hover',
							40 => '.entry-terms.post-tags a:hover',
							42 => '.comment-respond #cancel-comment-reply-link',
							43 => '.better-newsticker .heading',
							44 => '.listing-item-text-1:hover .term-badges.floated .term-badge a',
							45 => '.term-badges.floated a',
							66 => '.archive-title .term-badges span.term-badge a:hover',
							46 => '.post-tp-1-header .term-badges a:hover',
							47 => '.archive-title .term-badges a:hover',
							48 => '.listing-item-tb-2:hover .term-badges.floated .term-badge a',
							49 => '.btn-bs-pagination:hover, .btn-bs-pagination.hover, .btn-bs-pagination.bs-pagination-in-loading',
							62 => '.bs-slider-dots .bs-slider-active > .bts-bs-dots-btn',
							50 => '.listing-item-classic:hover a.read-more',
							51 => '.bs-loading > div',
							52 => '.pagination.bs-links-pagination a:hover',
							53 => '.footer-widgets .bs-popular-categories .bs-popular-term-item:hover .term-count',
							54 => '.footer-widgets .widget .better-control-nav li a:hover',
							55 => '.footer-widgets .widget .better-control-nav li a.better-active',
							56 => '.bs-slider-2-item .content-container a.read-more:hover',
							57 => '.bs-slider-3-item .content-container a.read-more:hover',
							58 => '.main-menu.menu .sub-menu li.current-menu-item:hover > a',
							59 => '.main-menu.menu .sub-menu > li:hover > a',
							60 => '.bs-slider-2-item .term-badges.floated .term-badge a',
							61 => '.bs-slider-3-item .term-badges.floated .term-badge a',
							// 62 is reserved
							63 => '.listing-item-blog:hover a.read-more',
							// BetterPlaylist
							64 => '.bsp-style-1 .bsp-playlist-info',
							65 => '.bsp-style-2 .bsp-current-item .bsp-video-icon-wrapper',
							// 66 is reserved
							67 => '.back-top',
							68 => '.site-header .shop-cart-container .cart-handler .cart-count',
							69 => '.site-header .shop-cart-container .cart-box:after',
							// 70 is reserved
							71 => '.single-attachment-content .return-to:hover .fa',
						),
					'prop'     =>
						array(
							'background-color' => '%%value%% !important',
						),
				),
			'color'             =>
				array(
					'selector' =>
						array(
							0  => '.main-color',
							1  => '.screen-reader-text:hover',
							2  => '.screen-reader-text:active',
							3  => '.screen-reader-text:focus',
							4  => '.widget.widget_nav_menu ul.menu li > a:hover',
							5  => '.widget.widget_nav_menu .menu .better-custom-badge',
							6  => '.widget.widget_recent_comments a:hover',
							7  => '.bs-popular-categories .bs-popular-term-item',
							8  => '.main-menu.menu .sub-menu li.current-menu-item > a',
							9  => '.bs-about .about-link a',
							10 => '.comment-list .comment-footer .comment-reply-link:hover',
							11 => '.comment-list li.bypostauthor > article > .comment-meta .comment-author a',
							12 => '.comment-list li.bypostauthor > article > .comment-meta .comment-author',
							13 => '.comment-list .comment-footer .comment-edit-link:hover',
							14 => '.comment-respond #cancel-comment-reply-link',
							15 => 'span.dropcap.dropcap-square-outline',
							16 => 'span.dropcap.dropcap-circle-outline',
							54 => 'ul.bs-shortcode-list li:before',
							55 => '.bs-accordion-shortcode .panel.open .panel-heading a',
							56 => '.bs-accordion-shortcode .panel .panel-heading a:hover',
							17 => 'a:hover',
							18 => '.post-meta a:hover',
							19 => '.site-header .top-menu.menu > li:hover > a',
							20 => '.site-header .top-menu.menu .sub-menu > li:hover > a',
							21 => '.mega-menu.mega-type-link-list .mega-links > li > a:hover',
							22 => '.mega-menu.mega-type-link-list .mega-links > li:hover > a',
							23 => '.listing-item .post-footer .post-share:hover .share-handler',
							24 => '.listing-item-classic .title a:hover',
							25 => '.single-post-content > .post-author .pre-head a:hover',
							26 => '.entry-content a',
							27 => '.site-header .search-container.open .search-handler',
							28 => '.site-header .search-container:hover .search-handler',
							57 => '.site-header .shop-cart-container.open .cart-handler',
							58 => '.site-header .shop-cart-container:hover .cart-handler',
							29 => '.site-footer .copy-2 a:hover',
							30 => '.site-footer .copy-1 a:hover',
							31 => 'ul.menu.footer-menu li > a:hover',
							32 => '.responsive-header .menu-container .resp-menu li:hover > a',
							33 => '.listing-item-thumbnail:hover .title a',
							34 => '.listing-item-grid:hover .title a',
							35 => '.listing-item-blog:hover .title a',
							36 => '.listing-item-classic:hover .title a',
							37 => '.better-newsticker ul.news-list li a:hover',
							38 => '.better-newsticker .control-nav span:hover',
							39 => '.listing-item-text-1:hover .title a',
							40 => '.post-meta a:hover',
							41 => '.pagination.bs-numbered-pagination > span',
							42 => '.pagination.bs-numbered-pagination .wp-pagenavi a:hover',
							43 => '.pagination.bs-numbered-pagination .page-numbers:hover',
							44 => '.pagination.bs-numbered-pagination .wp-pagenavi .current',
							45 => '.pagination.bs-numbered-pagination .current',
							// 46 removed => '.entry-content blockquote:before',
							47 => '.listing-item-text-2:hover .title a',
							48 => '.section-heading a:hover',
							49 => '.bs-popular-categories .bs-popular-term-item:hover',
							// 50 removed
							51 => '.main-menu.menu > li:hover > a',
							52 => '.listing-mg-5-item:hover .title',
							53 => '.listing-item-tall:hover > .title',
							// 54 is reserved
							// 55 is reserved
							// 56 is reserved
							// 57 is reserved
							// 58 is reserved
						),
					'prop'     =>
						array(
							'color' => '%%value%%',
						),
				),
			'color_impo'        =>
				array(
					'selector' =>
						array(
							1 => '.footer-widgets .widget a:hover',
							2 => '.bs-listing-modern-grid-listing-5 .listing-mg-5-item:hover .title a:hover',
							3 => '.bs-listing-modern-grid-listing-5 .listing-mg-5-item:hover .title a',
						),
					'prop'     =>
						array(
							'color' => '%%value%% !important',
						),
				),
			'border_color'      =>
				array(
					'selector' =>
						array(
							0  => 'textarea:focus',
							1  => 'input[type="url"]:focus',
							2  => 'input[type="search"]:focus',
							3  => 'input[type="password"]:focus',
							4  => 'input[type="email"]:focus',
							5  => 'input[type="number"]:focus',
							6  => 'input[type="week"]:focus',
							7  => 'input[type="month"]:focus',
							8  => 'input[type="time"]:focus',
							9  => 'input[type="datetime-local"]:focus',
							10 => 'input[type="date"]:focus',
							11 => 'input[type="color"]:focus',
							12 => 'input[type="text"]:focus',
							13 => '.widget.widget_nav_menu .menu .better-custom-badge:after',
							14 => '.widget.widget_bs-theme-subscribe-newsletter .bs-subscribe-newsletter form .feedburner-email:focus',
							15 => '.better-gallery .fotorama__thumb-border',
							16 => 'span.dropcap.dropcap-square-outline',
							17 => 'span.dropcap.dropcap-circle-outline',
							18 => '.bs-tab-shortcode .nav.nav-tabs',
							33 => '.bs-tab-shortcode .tab-content .tab-pane',
							34 => '.bs-accordion-shortcode .panel.open .panel-heading+.panel-collapse>.panel-body',
							35 => '.bs-accordion-shortcode .panel.open',
							20 => '.comment-respond textarea:focus',
							21 => '.better-newsticker .control-nav span:hover',
							22 => '.archive-title .term-badges a:hover',
							23 => '.listing-item-text-2 .item-inner',
							24 => '.btn-bs-pagination:hover, .btn-bs-pagination.hover, .btn-bs-pagination.bs-pagination-in-loading',
							25 => '.bs-slider-2-item .content-container a.read-more',
							26 => '.bs-slider-3-item .content-container a.read-more',
							27 => '.pagination.bs-links-pagination a:hover',

							// BetterPlaylist
							28 => '.bsp-style-1 li.bsp-current-item .bsp-video-thumbnail',
							29 => '.bsp-style-2 .bsp-current-item .bsp-video-thumbnail',

							30 => '.bs-subscribe-newsletter .feedburner-email:focus',
							31 => 'body.active-top-line .main-wrap',

							32 => '.entry-content blockquote.bs-pullquote-left',
							// 33 is reserved
							// 34 is reserved
							// 35 is reserved
						),
					'prop'     =>
						array(
							'border-color' => '%%value%%',
						),
				),
			'border_top_color'  =>
				array(
					'selector' =>
						array(
							0 => '.main-menu.menu .better-custom-badge:after',
						),
					'prop'     =>
						array(
							'border-top-color' => '%%value%%',
						),
				),
			'border_left_color' =>
				array(
					'selector' =>
						array(
							0 => '.bsp-style-1 li.bsp-current-item .bsp-video-index::after',
						),
					'prop'     =>
						array(
							'border-left-color' => '%%value%%',
						),
				),
			'selection'         =>
				array(
					'selector' =>
						array(
							0 => '::selection',
						),
					'prop'     =>
						array(
							'background' => '%%value%%',
						),
				),
			'selection_moz'     =>
				array(
					'selector' =>
						array(
							0 => '::-moz-selection',
						),
					'prop'     =>
						array(
							'background' => '%%value%%',
						),
				),

			/**
			 *
			 * bbPress Colors
			 *
			 */
			'bbpress_color'     =>
				array(
					'selector' =>
						array(
							0 => '#bbpress-forums li.bbp-forum-info.single-forum-info .bbp-forum-title:before',
							1 => '#bbpress-forums .bbp-forums-list li:before',
							2 => '#bbpress-forums p.bbp-topic-meta .freshness_link a',
							3 => '#bbpress-forums .bbp-forums-list li a',
						),
					'prop'     => 'color',
				),

			/**
			 *
			 * bbPress Background Colors
			 *
			 */
			'bbpress_bg_color'  =>
				array(
					'selector' =>
						array(
							0 => '#bbpress-forums #bbp-search-form #bbp_search_submit',
							1 => '#bbpress-forums li.bbp-header:before',
							2 => '#bbpress-forums button.user-submit, .bbp-submit-wrapper button',
							3 => '#bbpress-forums li.bbp-header:before',
						),
					'prop'     => 'background-color',
				),

			/**
			 *
			 * Better Google Search Color
			 *
			 */
			'bgcs_color'        =>
				array(
					'selector' =>
						array(
							0 => '.better-gcs-result .gsc-result .gs-title:hover *',
							1 => '.better-gcs-result .gsc-result .gs-title:hover',
							2 => '.better-gcs-result .gsc-results .gsc-cursor-box .gsc-cursor-current-page',
							3 => '.better-gcs-result .gsc-results .gsc-cursor-box .gsc-cursor-page:hover',
						),
					'prop'     => 'color',
				),

			/**
			 *
			 * Reviews Background Colors
			 *
			 */
			'reviews_bg_color'  =>
				array(
					'selector' =>
						array(
							0 => '.betterstudio-review .verdict .overall',
							1 => '.rating-bar span',
						),
					'prop'     => 'background-color',
				),

			/**
			 *
			 * Reviews Colors
			 *
			 */
			'reviews_color'     =>
				array(
					'selector' =>
						array(
							0 => '.rating-stars span:before',
						),
					'prop'     => 'color',
				),

			/**
			 *
			 * WooCommerce Colors
			 *
			 */
			'wc_color'          =>
				array(
					'selector' =>
						array(
							0 => '.woocommerce  .woocommerce-Reviews .star-rating',
							2 => '.woocommerce div.product p.price',
							3 => '.woocommerce div.product span.price',
							4 => '.woocommerce div.product .woocommerce-product-rating',
							5 => '.woocommerce ul.products li.product .price',
							6 => '.woocommerce-MyAccount-navigation ul li.is-active a',
							7 => '.woocommerce-MyAccount-navigation ul li a:hover',
						),
					'prop'     => 'color',
				),

			/**
			 *
			 * WooCommerce Background Colors
			 *
			 */
			'wc_bg_color'       =>
				array(
					'selector' =>
						array(
							0  => '.woocommerce #respond input#submit.alt:hover',
							2  => '.woocommerce a.button.alt:hover',
							3  => '.woocommerce button.button.alt:hover',
							4  => '.woocommerce input.button.alt:hover',
							5  => '.woocommerce span.onsale',
							6  => '.woocommerce #respond input#submit:hover',
							7  => '.woocommerce a.button.added',
							8  => '.woocommerce a.button.loading',
							9  => '.woocommerce a.button:hover',
							10 => '.woocommerce button.button:hover',
							11 => '.woocommerce input.button:hover',
							12 => '.woocommerce .widget_price_filter .ui-slider .ui-slider-handle',
							13 => '.woocommerce .widget_price_filter .ui-slider .ui-slider-range',
						),
					'prop'     => 'background-color',
				),


		);

	/**
	 * Initialize base options
	 *
	 * ***** Table of contents *****
	 *
	 * => Template Options
	 *      -> Posts
	 *      -> Page
	 *      -> Categories Archive
	 *      -> Tags Archive
	 *      -> Authors Archive
	 *      -> Search Results Archive
	 *      -> 404 Page
	 *      -> bbPress
	 *
	 * => Header Options
	 *      -> Responsive Header
	 *      -> Topbar
	 *      -> Main Menu
	 *      -> Header Padding
	 *
	 * =>Share Box
	 *
	 * => Footer Options
	 *
	 * => Color Options
	 *      -> Header Colors
	 *      -> Topbar Colors
	 *      -> Header Colors
	 *      -> Slider Colors
	 *      -> Footer Colors
	 *      -> Widgets
	 *
	 * => Typography Options
	 *      -> General Typography
	 *      -> Post & Page Typography
	 *      -> Header Typography
	 *      -> Top Bar
	 *      -> Blog Listing
	 *      -> Grid Listing
	 *      -> Tall Listing
	 *      -> Sliders
	 *      -> Widgets
	 *      -> Section Headings
	 *
	 * => Advanced Options
	 *
	 * => Custom Javascript / CSS
	 *
	 * => Analytics & JS
	 *
	 * => Auto Updates
	 *
	 * => Import & Export
	 *
	 */
	public static function init_base_fields() {

		// init fields only once
		if ( self::$fields_initialized ) {
			return;
		}

		/**
		 * => Template Options
		 */
		self::$fields[] = array(
			'name' => __( 'Templates', 'publisher' ),
			'id'   => 'general_settings',
			'type' => 'tab',
			'icon' => 'bsai-global'
		);

		self::$fields['layout_style'] = array(
			'name'          => __( 'Page Boxed Style', 'publisher' ),
			'id'            => 'layout_style',
			'style'         => Publisher_Theme_Styles_Manager::get_styles(),
			'std'           => 'full-width',
			'save_default'  => FALSE,
			'type'          => 'select',
			'section_class' => 'style-floated-left bordered',
			'desc'          => __( 'Select whether you want a boxed or a full width layout. Default option image shows what default style selected in theme options.', 'publisher' ),
			'options'       => array(
				'full-width' => __( 'Full Width', 'publisher' ),
				'boxed'      => __( 'Boxed', 'publisher' ),
			)
		);

		self::$fields[]                   = array(
			'name'  => __( 'General', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['general_layout']   = array(
			'name'             => __( 'Site Layout', 'publisher' ),
			'id'               => 'general_layout',
			'std'              => '2-col-right',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select the layout you want, whether a single column or a 2 column one. It affects every page and the whole layout. This option can be overridden on all sections.', 'publisher' ),
			'deferred-options' => 'publisher_layout_option_list',
		);
		self::$fields['general_listing']  = array(
			'name'             => __( 'Site Listing', 'publisher' ),
			'id'               => 'general_listing',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'blog-1',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select general listing of site.', 'publisher' ),
			'deferred-options' => 'publisher_listing_option_list',
		);
		self::$fields['pagination_type']  = array(
			'name'             => __( 'Pagination', 'publisher' ),
			'id'               => 'pagination_type',
			'std'              => 'links',
			'type'             => 'select',
			'desc'             => __( 'Select pagination type of site.', 'publisher' ),
			'deferred-options' => 'publisher_pagination_option_list',
		);
		self::$fields['back_to_top']      = array(
			'name'    => __( 'Show Back To Top Button', 'publisher' ),
			'id'      => 'back_to_top',
			'std'     => 'show',
			'type'    => 'select',
			'desc'    => __( 'Select show or hide back to top button.', 'publisher' ),
			'options' => array(
				'show' => __( 'Yes, Show.', 'publisher' ),
				'hide' => __( 'No.', 'publisher' ),
			)
		);
		self::$fields['light_box_images'] = array(
			'name'    => __( 'Light Box For Images', 'publisher' ),
			'id'      => 'light_box_images',
			'std'     => 'enable',
			'type'    => 'select',
			'desc'    => __( 'Activate opening images full size in light box.', 'publisher' ),
			'options' => array(
				'enable'  => __( 'Enable', 'publisher' ),
				'disable' => __( 'Disable', 'publisher' ),
			)
		);
		self::$fields['sticky_sidebar']   = array(
			'name'    => __( 'Sticky Sidebar', 'publisher' ),
			'id'      => 'sticky_sidebar',
			'std'     => 'disable',
			'type'    => 'select',
			'desc'    => __( 'You can make sidebars sticky with enabling this option.', 'publisher' ),
			'options' => array(
				'enable'  => __( 'Enable', 'publisher' ),
				'disable' => __( 'Disable', 'publisher' ),
			)
		);


		/**
		 * -> Homepage
		 **/
		self::$fields[] = array(
			'name'  => __( 'Homepage', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields[] = array(
			'name'      => __( 'Important Note', 'publisher' ),
			'id'        => 'homepage-info',
			'type'      => 'info',
			'std'       => '<p>' . __( "Followig options didn't work if you selected custom page for front page ", 'publisher' ) . '</p>',
			'state'     => 'open',
			'info-type' => 'danger',
		);

		self::$fields['home_layout']           = array(
			'name'             => __( 'Homepage Layout', 'publisher' ),
			'id'               => 'home_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override homepage layout.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['home_listing']          = array(
			'name'             => __( 'Homepage Posts Listing', 'publisher' ),
			'id'               => 'home_listing',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override homepage listing.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['home_cat_include']      = array(
			'name'     => __( 'Categories', 'publisher' ),
			'id'       => 'home_cat_include',
			'std'      => '',
			'desc'     => __( 'Show posts associated with certain categories in homepage.', 'publisher' ),
			'type'     => 'select',
			'multiple' => TRUE,
			'options'  => array(
				'' => __( '-- All Posts --', 'publisher' ),
				array(
					'label'   => __( 'Categories', 'publisher' ),
					'options' => array(
						'category_walker' => 'category_walker'
					),
				),
			),
		);
		self::$fields['home_cat_exclude']      = array(
			'name'     => __( 'Exclude Categories', 'publisher' ),
			'id'       => 'home_cat_exclude',
			'std'      => '',
			'desc'     => __( 'Exclude showing posts of specific categories in home page.', 'publisher' ),
			'type'     => 'select',
			'multiple' => TRUE,
			'options'  => array(
				'' => __( '-- All Posts [ No Exclude ] --', 'publisher' ),
				array(
					'label'   => __( 'Categories', 'publisher' ),
					'options' => array(
						'category_walker' => 'category_walker'
					),
				),
			),
		);
		self::$fields['home_tag_include']      = array(
			'name'        => __( 'Tags', 'publisher' ),
			'id'          => 'home_tag_include',
			'std'         => '',
			'desc'        => __( 'Show posts associated with certain tags in homepage.', 'publisher' ),
			'type'        => 'ajax_select',
			"callback"    => 'BF_Ajax_Select_Callbacks::tags_callback',
			"get_name"    => 'BF_Ajax_Select_Callbacks::tag_name',
			'placeholder' => __( "Search and find tag...", 'publisher' ),
		);
		self::$fields['home_custom_post_type'] = array(
			'name'       => __( 'Custom Post Type', 'publisher' ),
			'id'         => 'home_custom_post_type',
			'std'        => '',
			'desc'       => __( 'You can show custom post types in home page by adding them into this field. please don\'t forgot to add "post" to it if you changed this and need to default post type shown also.', 'publisher' ),
			'type'       => 'text',
			'input-desc' => 'Separate by ","',
		);
		self::$fields['home_posts_count']      = array(
			'name' => __( 'Number Of Post To Show', 'publisher' ),
			'id'   => 'home_posts_count',
			'desc' => sprintf( __( 'Enter number of posts to show in homepage per page. <br>Default: %s', 'publisher' ), get_option( 'posts_per_page' ) ),
			'type' => 'text',
			'std'  => '',
		);
		self::$fields['home_pagination_type']  = array(
			'name'             => __( 'Homepage pagination', 'publisher' ),
			'id'               => 'home_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of homepage.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE
				),
			),
		);


		/**
		 * -> Posts
		 **/
		self::$fields[]                                = array(
			'name'  => __( 'Posts', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['post_layout']                   = array(
			'name'             => __( 'Posts Page Layout', 'publisher' ),
			'id'               => 'post_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override posts page layout.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['post_template']                 = array(
			'name'             => __( 'Single post template', 'publisher' ),
			'id'               => 'post_template',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'style-10',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Select default template for single posts.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_get_single_template_option',
			),
		);
		self::$fields['post_author_box']               = array(
			'name'    => __( 'Show Author Box', 'publisher' ),
			'id'      => 'post_author_box',
			'desc'    => __( 'Enabling this will be adds post author box to bottom of post content.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'show',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			)
		);
		self::$fields['post_related']                  = array(
			'name'    => __( 'Related Posts', 'publisher' ),
			'id'      => 'post_related',
			'desc'    => __( 'Enabling this will be adds related posts in in bottom of post content.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'show',
			'options' => array(
				'show'                  => __( 'Show - Simple', 'publisher' ),
				'infinity-related-post' => __( 'Show - Infinity Ajax Load', 'publisher' ),
				'hide'                  => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['post_related_type']             = array(
			'name'    => __( 'Related Posts Algorithm', 'publisher' ),
			'id'      => 'post_related_type',
			'desc'    => __( 'Chose the algorithm of related posts.', 'publisher' ),
			'type'    => 'select',
			'options' => array(
				'cat'            => __( 'by Category', 'publisher' ),
				'tag'            => __( 'by Tag', 'publisher' ),
				'author'         => __( 'by Author', 'publisher' ),
				'cat-tag'        => __( 'by Category & Tag', 'publisher' ),
				'cat-tag-author' => __( 'by Category ,Tag & Author', 'publisher' ),
			),
			'std'     => 'cat',
		);
		self::$fields['post_related_count']            = array(
			'name' => __( 'Related Posts Count', 'publisher' ),
			'id'   => 'post_related_count',
			'desc' => __( 'Enter related posts count.', 'publisher' ),
			'type' => 'text',
			'std'  => 3,
		);
		self::$fields['post_comments']                 = array(
			'name'    => __( 'Show Comments', 'publisher' ),
			'id'      => 'post_comments',
			'desc'    => __( 'Select to show or hide comments in bottom of post content.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'show-simple',
			'options' => array(
				'show-simple'    => __( 'Show, Normal Comments', 'publisher' ),
				'show-ajaxified' => __( 'Ajax - Show Comments Button', 'publisher' ),
				'hide'           => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['post_comments_form_position']   = array(
			'name'    => __( 'Comment Form Position', 'publisher' ),
			'id'      => 'post_comments_form_position',
			'std'     => 'bottom',
			'type'    => 'select',
			'desc'    => __( 'Chose comment form inputs position.', 'publisher' ),
			'options' => array(
				'top'    => __( 'Top of comments list.', 'publisher' ),
				'bottom' => __( 'Bottom of comments list', 'publisher' ),
				'both'   => __( 'Top & Bottom', 'publisher' ),
			),
		);
		self::$fields['post_comments_form_remove_url'] = array(
			'name'    => __( 'Remove URL Field from Comment Form', 'publisher' ),
			'id'      => 'post_comments_form_remove_url',
			'desc'    => __( 'With enabling this URL will removed from comments form.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'no',
			'options' => array(
				'yes' => __( 'Yes, Remove it.', 'publisher' ),
				'no'  => __( 'No', 'publisher' ),
			),
		);


		/**
		 * -> Page
		 **/
		self::$fields[]                = array(
			'name'  => __( 'Page', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['page_layout']   = array(
			'name'             => __( 'Static Pages Layout', 'publisher' ),
			'id'               => 'page_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override static pages layout.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['page_comments'] = array(
			'name'    => __( 'Show Page Comments', 'publisher' ),
			'id'      => 'page_comments',
			'desc'    => __( 'Select to show or hide comments in bottom of page content.', 'publisher' ),
			'type'    => 'select',
			'std'     => 'show',
			'options' => array(
				'show-simple'    => __( 'Show, Normal Comments', 'publisher' ),
				'show-ajaxified' => __( 'Ajax - Show Comments Button', 'publisher' ),
				'hide'           => __( 'Hide', 'publisher' ),
			),
		);


		/**
		 * -> Categories Archive
		 **/
		self::$fields[]                         = array(
			'name'  => __( 'Categories Archive', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['cat_layout']             = array(
			'name'             => __( 'Categories Archive Page Layout', 'publisher' ),
			'id'               => 'cat_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override categories archive pages layout. <br>This option can be overridden on each category.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['cat_listing']            = array(
			'name'             => __( 'Categories Archive Posts Listing', 'publisher' ),
			'id'               => 'cat_listing',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override page listing for all categories. <br>This option can be overridden on each category.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['cat_posts_count']        = array(
			'name' => __( 'Number Of Post To Show', 'publisher' ),
			'id'   => 'cat_posts_count',
			'desc' => sprintf( __( 'Enter number of posts to show in category archive pages. <br>Default: %s', 'publisher' ), get_option( 'posts_per_page' ) ),
			'type' => 'text',
			'std'  => '',
		);
		self::$fields['cat_pagination_type']    = array(
			'name'             => __( 'Category pagination', 'publisher' ),
			'id'               => 'cat_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of all categories.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['cat_slider']             = array(
			'name'             => __( 'Categories Slider Type', 'publisher' ),
			'id'               => 'cat_slider',
			'desc'             => __( 'Select categories top posts blocks or custom "Slider Revolution".', 'publisher' ),
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'custom-blocks',
			'type'             => 'select',
			'deferred-options' => array(
				'callback' => 'publisher_slider_types_option_list',
			),
		);
		self::$fields['cat_top_posts']          = array(
			'name'               => __( 'Categories Top Posts style', 'publisher' ),
			'id'                 => 'cat_top_posts',
			'desc'               => __( 'Select top posts style of all categories.', 'publisher' ),
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => 'style-3',
			'type'               => 'image_radio',
			'section_class'      => 'style-floated-left bordered',
			'deferred-options'   => array(
				'callback' => 'publisher_topposts_option_list',
			),
			'filter-field'       => 'cat_slider',
			'filter-field-value' => 'custom-blocks',
		);
		self::$fields['cat_top_posts_gradient'] = array(
			'name'               => __( 'Top Posts Overlay Gradient', 'publisher' ),
			'id'                 => 'cat_top_posts_gradient',
			'desc'               => __( 'Select top posts overlay style.', 'publisher' ),
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => 'simple-gr',
			'type'               => 'select',
			'section_class'      => 'style-floated-left bordered',
			'options'            => array(
				'colored'      => __( 'Colored Gradient', 'publisher' ),
				'colored-anim' => __( 'Animated Gradient', 'publisher' ),
				'simple-gr'    => __( 'Simple Gradient', 'publisher' ),
				'simple'       => __( 'Simple', 'publisher' ),
			),
			'filter-field'       => 'cat_slider',
			'filter-field-value' => 'custom-blocks',
		);
		self::$fields['cat_rev_slider_item']    = array(
			'name'               => __( 'Categories Top Slider Revolution', 'publisher' ),
			'id'                 => 'cat_rev_slider_item',
			'desc'               => __( 'Select a "Slider Revolution" slider for top of categories.', 'publisher' ),
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '',
			'type'               => 'select',
			'section_class'      => 'style-floated-left bordered',
			'deferred-options'   => array(
				'callback' => 'bf_deferred_option_get_rev_sliders',
				'args'     => array(
					array(
						'default' => TRUE
					)
				)
			),
			'filter-field'       => 'cat_slider',
			'filter-field-value' => 'rev_slider',
		);


		/**
		 * -> Tags Archive
		 **/
		self::$fields[]                      = array(
			'name'  => __( 'Tags Archive', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['tag_layout']          = array(
			'name'             => __( 'Tags Archive Page Layout', 'publisher' ),
			'id'               => 'tag_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override tags archive pages layout. <br>This option can be overridden on each tag.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['tag_listing']         = array(
			'name'             => __( 'Tags Archive Posts Listing', 'publisher' ),
			'id'               => 'tag_listing',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override page listing for all tags. <br>This option can be overridden on each tag.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['tag_posts_count']     = array(
			'name' => __( 'Number Of Post To Show', 'publisher' ),
			'id'   => 'tag_posts_count',
			'desc' => sprintf( __( 'Enter number of posts to show in category archive pages. <br>Default: %s', 'publisher' ), get_option( 'posts_per_page' ) ),
			'type' => 'text',
			'std'  => '',
		);
		self::$fields['tag_pagination_type'] = array(
			'name'             => __( 'Tag pagination', 'publisher' ),
			'id'               => 'tag_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of all tags.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE
				),
			),
		);

		/**
		 * -> Authors Archive
		 **/
		self::$fields[]                         = array(
			'name'  => __( 'Authors Archive', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['author_layout']          = array(
			'name'             => __( 'Authors Profile Page Layout', 'publisher' ),
			'id'               => 'author_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override authors profile pages layout. <br>This option can be overridden on each author.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['author_listing']         = array(
			'name'             => __( 'Authors Profile Posts Listing', 'publisher' ),
			'id'               => 'author_listing',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override page listing for all authors. <br>This option can be overridden on each author.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['author_posts_count']     = array(
			'name' => __( 'Number Of Posts To Show', 'publisher' ),
			'id'   => 'author_posts_count',
			'desc' => sprintf( __( 'Leave this empty for default. <br>Default: %s', 'publisher' ), get_option( 'posts_per_page' ) ),
			'type' => 'text',
			'std'  => '',
		);
		self::$fields['author_pagination_type'] = array(
			'name'             => __( 'Author pagination', 'publisher' ),
			'id'               => 'author_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of all authors profile.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE
				),
			),
		);

		/**
		 * -> Search Results Archive
		 **/
		self::$fields[]                         = array(
			'name'  => __( 'Search Results Archive', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['search_layout']          = array(
			'name'             => __( 'Search Page Layout', 'publisher' ),
			'id'               => 'search_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override search result pages layout.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['search_listing']         = array(
			'name'             => __( 'Search Result Posts Listing', 'publisher' ),
			'id'               => 'search_listing',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Override search result posts listing.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_listing_option_list',
				'args'     => array(
					TRUE
				),
			),
		);
		self::$fields['search_menu']            = array(
			'name'             => __( 'Search Page Navigation Menu', 'publisher' ),
			'id'               => 'search_menu',
			'desc'             => __( 'Select which menu displays on search results page.', 'publisher' ),
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
		self::$fields['search_result_content']  = array(
			'name'    => __( 'Result Content Type', 'publisher' ),
			'id'      => 'search_result_content',
			'std'     => 'post',
			'type'    => 'select',
			'desc'    => __( 'Select the type of content to display in search results.', 'publisher' ),
			'options' => array(
				'post' => __( 'Only Posts', 'publisher' ),
				'page' => __( 'Only Pages', 'publisher' ),
				'both' => __( 'Posts and Pages', 'publisher' ),
			)
		);
		self::$fields['search_posts_count']     = array(
			'name' => __( 'Number Of Post To Show', 'publisher' ),
			'id'   => 'search_posts_count',
			'desc' => sprintf( __( 'Leave this empty for default. <br>Default: %s', 'publisher' ), get_option( 'posts_per_page' ) ),
			'type' => 'text',
			'std'  => '',
		);
		self::$fields['search_pagination_type'] = array(
			'name'             => __( 'Search page pagination', 'publisher' ),
			'id'               => 'search_pagination_type',
			'std'              => 'default',
			'type'             => 'select',
			'desc'             => __( 'Select pagination of search page.', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_pagination_option_list',
				'args'     => array(
					TRUE
				),
			),
		);


		/**
		 * -> Attachment
		 **/
		self::$fields[]                    = array(
			'name'  => __( 'Attachment Pages', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['attachment_layout'] = array(
			'name'             => __( 'Attachment Page Layout', 'publisher' ),
			'id'               => 'attachment_layout',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'desc'             => __( 'Change the layout of attachment pages', 'publisher' ),
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);


		/**
		 * -> 404 Page
		 **/
		self::$fields[]                   = array(
			'name'  => __( '404 Page', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['archive_404_menu'] = array(
			'name'             => __( '404 Page Navigation Menu', 'publisher' ),
			'id'               => 'archive_404_menu',
			'desc'             => __( 'Select which menu displays on 404 page.', 'publisher' ),
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
		 * -> WooCommerce
		 **/
		self::$fields[]              = array(
			'name'  => __( 'WooCommerce - Shop', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['shop_layout'] = array(
			'name'             => __( 'Shop Layout', 'publisher' ),
			'id'               => 'shop_layout',
			'desc'             => __( 'Override shop pages layout with this option', 'publisher' ),
			'type'             => 'image_radio',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'section_class'    => 'style-floated-left bordered',
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);


		/**
		 * -> bbPress
		 **/
		self::$fields[]                 = array(
			'name'  => __( 'bbPress - Forums', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['bbpress_layout'] = array(
			'name'             => __( 'bbPress Forums Layout', 'publisher' ),
			'id'               => 'bbpress_layout',
			'desc'             => __( 'Override bbPress forum pages layout with this option', 'publisher' ),
			'type'             => 'image_radio',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'default',
			'section_class'    => 'style-floated-left bordered',
			'deferred-options' => array(
				'callback' => 'publisher_layout_option_list',
				'args'     => array(
					TRUE
				),
			),
		);


		/**
		 * => Header Options
		 */
		self::$fields[] = array(
			'name' => __( 'Header', 'publisher' ),
			'id'   => 'header_settings',
			'type' => 'tab',
			'icon' => 'bsai-header'
		);

		self::$fields[]                       = array(
			'name'  => __( 'Header', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['header_layout']        = array(
			'name'    => __( 'Header Boxed', 'publisher' ),
			'id'      => 'header_layout',
			'desc'    => __( 'Select header layout.', 'publisher' ),
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'boxed',
			'type'    => 'select',
			'options' => array(
				'boxed'      => __( 'Boxed header', 'publisher' ),
				'full-width' => __( 'Full width header', 'publisher' ),
			),
		);
		self::$fields['header_style']         = array(
			'name'             => __( 'Header Style', 'publisher' ),
			'id'               => 'header_style',
			'desc'             => __( 'Select header style.', 'publisher' ),
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => 'style-2',
			'type'             => 'image_radio',
			'section_class'    => 'style-floated-left bordered',
			'deferred-options' => array(
				'callback' => 'publisher_header_style_option_list',
			),
		);
		self::$fields['menu_sticky']          = array(
			'name'    => __( 'Main Menu Sticky', 'publisher' ),
			'id'      => 'menu_sticky',
			'desc'    => __( 'Enable or disable sticky effect for main menu.', 'publisher' ),
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'smart',
			'type'    => 'select',
			'options' => array(
				'smart'     => __( 'Smart Sticky', 'publisher' ),
				'sticky'    => __( 'Simple Sticky', 'publisher' ),
				'no-sticky' => __( 'No Sticky', 'publisher' ),
			),
		);
		self::$fields['menu_show_search_box'] = array(
			'name'    => __( 'Show Search Box In Menu', 'publisher' ),
			'id'      => 'menu_show_search_box',
			'desc'    => __( 'Chose to show or hide search form in menu.', 'publisher' ),
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'show',
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['menu_show_shop_cart']  = array(
			'name'    => __( 'Show Shopping Cart Icon in Menu', 'publisher' ),
			'id'      => 'menu_show_shop_cart',
			'desc'    => __( 'Chose to show or hide shopping cart icon in menu.', 'publisher' ),
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'show',
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);


		/**
		 * -> Logo
		 */
		self::$fields[]                    = array(
			'name'  => __( 'Logo', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['logo_text']         = array(
			'name' => __( 'Text Logo', 'publisher' ),
			'id'   => 'logo_text',
			'std'  => 'Publisher',
			'desc' => wp_kses( __( 'Enter your site name here for logo text.<br> <code>Tip:</code> Enter site tagline here to add this to logo alt attribute.', 'publisher' ), bf_trans_allowed_html() ),
			'type' => 'text',
		);
		self::$fields['logo_image']        = array(
			'name'         => __( 'Site Logo', 'publisher' ),
			'id'           => 'logo_image',
			'desc'         => __( 'By default, a text-based logo is created using your site title. But you can also upload an image-based logo here.', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Upload Logo', 'publisher' ),
			'media_button' => __( 'Select Image', 'publisher' ),
			'upload_label' => __( 'Upload Logo', 'publisher' ),
			'remove_label' => __( 'Remove', 'publisher' ),
		);
		self::$fields['logo_image_retina'] = array(
			'name'         => __( 'Site Retina Logo (2x)', 'publisher' ),
			'id'           => 'logo_image_retina',
			'desc'         => __( 'If you want to upload a Retina Image, It\'s Image Size should be exactly double in compare with your normal Logo. It requires WP Retina 2x plugin.', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Upload Retina Logo', 'publisher' ),
			'media_button' => __( 'Select @2x Image', 'publisher' ),
			'upload_label' => __( 'Upload @2x Logo', 'publisher' ),
			'remove_label' => __( 'Remove', 'publisher' ),
		);


		/**
		 * -> Responsive Header
		 */
		self::$fields[]                         = array(
			'name'  => __( 'Responsive Header', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['resp_logo_image']        = array(
			'name'         => __( 'Responsive Header Logo', 'publisher' ),
			'id'           => 'resp_logo_image',
			'desc'         => __( 'By default, a text-based logo is created using your site title. But you can also upload an image-based logo here.', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Upload Logo', 'publisher' ),
			'media_button' => __( 'Select Image', 'publisher' ),
			'upload_label' => __( 'Upload Logo', 'publisher' ),
			'remove_label' => __( 'Remove', 'publisher' ),
		);
		self::$fields['resp_logo_image_retina'] = array(
			'name'         => __( 'Responsive Header Retina Logo(2x)', 'publisher' ),
			'id'           => 'resp_logo_image_retina',
			'desc'         => __( 'If you want to upload a Retina Image, It\'s Image Size should be exactly double in compare with your normal Logo. It requires WP Retina 2x plugin.', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Upload Retina Logo', 'publisher' ),
			'media_button' => __( 'Select @2x Image', 'publisher' ),
			'upload_label' => __( 'Upload @2x Logo', 'publisher' ),
			'remove_label' => __( 'Remove', 'publisher' ),
		);


		/**
		 * -> Topbar
		 */
		self::$fields[]                           = array(
			'name'  => __( 'Top Bar', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['topbar_style']             = array(
			'name'          => __( 'Show Top Bar', 'publisher' ),
			'id'            => 'topbar_style',
			'desc'          => __( 'Select top bar style.', 'publisher' ),
			'style'         => Publisher_Theme_Styles_Manager::get_styles(),
			'std'           => 'style-1',
			'type'          => 'select',
			'section_class' => 'style-floated-left bordered',
			'options'       => array(
				'hidden'  => __( 'Hide Top Bar', 'publisher' ),
				'style-1' => __( 'Style 1', 'publisher' ),
				'style-2' => __( 'Style 2', 'publisher' ),
			),
		);
		self::$fields['topbar_show_date']         = array(
			'name'    => __( 'Show Date In Topbar', 'publisher' ),
			'id'      => 'topbar_show_date',
			'desc'    => __( 'Chose to show or hide date in top bar.', 'publisher' ),
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'show',
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['topbar_show_social_icons'] = array(
			'name'    => __( 'Show Social Icons In Topbar', 'publisher' ),
			'id'      => 'topbar_show_social_icons',
			'desc'    => __( 'Chose to show or hide social icons in header.', 'publisher' ),
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'show',
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['topbar_show_social_icons'] = array(
			'name'    => __( 'Show Social Icons In Topbar', 'publisher' ),
			'id'      => 'topbar_show_social_icons',
			'desc'    => __( 'Chose to show or hide social icons in header.', 'publisher' ),
			'std'     => 'show',
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);
		if ( class_exists( 'Better_Social_Counter' ) && class_exists( 'Better_Social_Counter_Data_Manager' ) ) {
			self::$fields['topbar_socials'] = array(
				'name'             => __( 'Sort and Active Sites', 'publisher' ),
				'id'               => 'topbar_socials',
				'desc'             => sprintf( __( 'Select & sort sites you will to show them in topbar. <br><br>
For activating site you should enter your information in <a href="%s" target="_blank">Better Social Counter</a> Panel.
', 'publisher' ), get_admin_url( NULL, 'admin.php?page=better-studio/better-social-counter' ) ),
				'type'             => 'sorter_checkbox',
				'deferred-options' => array(
					'callback' => 'publisher_social_counter_options_list_callback',
				),
				'section_class'    => 'better-social-counter-sorter',
				'std'              => array(
					'instagram' => 1,
					'dribbble'  => 1,
					'pinterest' => 1,
					'envato'    => 1,
					'github'    => 1,
					'vimeo'     => 1,
				)
			);
		} else {
			self::$fields['social-icons-help'] = array(
				'name'          => __( 'Social Icons Instructions', 'publisher' ),
				'id'            => 'social-icons-help',
				'type'          => 'info',
				'std'           => __( '<p>For adding social icons in top bar you should first install and active <strong>Better Social Counter</strong> plugin.</p>', 'publisher' ),
				'state'         => 'open',
				'info-type'     => 'help',
				'section_class' => 'widefat',
			);
		}


		/**
		 * -> Header Padding
		 */
		self::$fields[]                        = array(
			'name'  => __( 'Header Padding', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['header_top_padding']    = array(
			'name'             => __( 'Header Top Padding', 'publisher' ),
			'id'               => 'header_top_padding',
			'suffix'           => __( 'Pixel', 'publisher' ),
			'desc'             => __( 'In pixels without px, ex: 20.', 'publisher' ),
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '',
			'css-echo-default' => FALSE,
			'ltr'              => TRUE,
			'css'              => array(
				array(
					'selector' => array(
						'.header.header-style-1 .header-inner',
						'.header.header-style-2 .header-inner',
					),
					'prop'     => array( 'padding-top' => '%%value%%px' ),
				)
			),
		);
		self::$fields['header_bottom_padding'] = array(
			'name'             => __( 'Header Bottom Padding', 'publisher' ),
			'id'               => 'header_bottom_padding',
			'suffix'           => __( 'Pixel', 'publisher' ),
			'desc'             => __( 'In pixels without ex: 20.', 'publisher' ),
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '',
			'css-echo-default' => FALSE,
			'ltr'              => TRUE,
			'css'              => array(
				array(
					'selector' => array(
						'.header.header-style-1 .header-inner',
						'.header.header-style-2 .header-inner',
					),
					'prop'     => array( 'padding-bottom' => '%%value%%px' ),
				)
			),
		);


		/**
		 * =>Share Box
		 */
		self::$fields[]                      = array(
			'name' => __( 'Share Box', 'publisher' ),
			'type' => 'tab',
			'icon' => 'bsai-share-alt',
			'id'   => 'share-box-options',
		);
		self::$fields['social_share_single'] = array(
			'name'    => __( 'Show Share Box In Single', 'publisher' ),
			'desc'    => __( 'Enabling this will adds share links in posts single page. You can change design and social sites will following options.', 'publisher' ),
			'id'      => 'social_share_single',
			'type'    => 'select',
			'std'     => 'show',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['social_share_page']   = array(
			'name'    => __( 'Show Share Box In Pages', 'publisher' ),
			'desc'    => __( 'Enabling this will adds share links in pages. You can change design and social sites will following options.', 'publisher' ),
			'id'      => 'social_share_page',
			'type'    => 'select',
			'std'     => 'hide',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			),
		);
		self::$fields['social_share_sites']  = array(
			'name'          => __( 'Drag and Drop To Sort The Items', 'publisher' ),
			'id'            => 'social_share_sites',
			'desc'          => __( 'Select active social share links and sort them.', 'publisher' ),
			'type'          => 'sorter_checkbox',
			'std'           => array(
				'facebook'    => TRUE,
				'twitter'     => TRUE,
				'google_plus' => TRUE,
				'email'       => TRUE,
				'pinterest'   => TRUE,
				'linkedin'    => TRUE,
				'tumblr'      => TRUE,
				'telegram'    => FALSE,
			),
			'options'       => array(
				'facebook'    => array(
					'label'     => '<i class="fa fa-facebook"></i> ' . __( 'Facebook', 'publisher' ),
					'css-class' => 'active-item'
				),
				'twitter'     => array(
					'label'     => '<i class="fa fa-twitter"></i> ' . __( 'Twitter', 'publisher' ),
					'css-class' => 'active-item'
				),
				'google_plus' => array(
					'label'     => '<i class="fa fa-google-plus"></i> ' . __( 'Google+', 'publisher' ),
					'css-class' => 'active-item'
				),
				'pinterest'   => array(
					'label'     => '<i class="fa fa-pinterest"></i> ' . __( 'Pinterest', 'publisher' ),
					'css-class' => 'active-item'
				),
				'linkedin'    => array(
					'label'     => '<i class="fa fa-linkedin"></i> ' . __( 'Linkedin', 'publisher' ),
					'css-class' => 'active-item'
				),
				'tumblr'      => array(
					'label'     => '<i class="fa fa-tumblr"></i> ' . __( 'Tumblr', 'publisher' ),
					'css-class' => 'active-item'
				),
				'email'       => array(
					'label'     => '<i class="fa fa-envelope "></i> ' . __( 'Email', 'publisher' ),
					'css-class' => 'active-item'
				),
				'telegram'    => array(
					'label'     => '<i class="fa fa-send"></i> ' . __( 'Telegram', 'publisher' ),
					'css-class' => 'active-item'
				),
			),
			'section_class' => 'publisher-theme-social-share-sorter',
		);


		/**
		 * => Footer Options
		 */
		self::$fields[] = array(
			'name' => __( 'Footer', 'publisher' ),
			'id'   => 'footer_settings',
			'type' => 'tab',
			'icon' => 'bsai-footer'
		);

		self::$fields['footer_copy1']       = array(
			'name' => __( 'Footer Left Copyright Text', 'publisher' ),
			'desc' => __( 'Enter the copy right text of footer.<br>
You can use following pattern to make replace them with real data:<br><br>
<strong>%%year%%</strong>: Will replcae with current year, ex: 2015<br>
<strong>%%date%%</strong>: Will replcae with current year, ex: 2015<br>
<strong>%%sitename%%</strong>: Will replace with site title.<br>
<strong>%%title%%</strong>: Will replace with site title.<br>
<strong>%%siteurl%%</strong>: Will replace with site homepage url.', 'publisher' ),
			'id'   => 'footer_copy1',
			'std'  => __( '&#169; %%year%% - %%sitename%%. All Rights Reserved.', 'publisher' ),
			'type' => 'textarea',
		);
		self::$fields['footer_copy2']       = array(
			'name' => __( 'Footer Right Copyright Text', 'publisher' ),
			'desc' => __( 'Enter the copy right text of footer.<br>
You can use following pattern to make replace them with real data:<br><br>
<strong>%%year%%</strong>: Will replcae with current year, ex: 2015<br>
<strong>%%date%%</strong>: Will replcae with current year, ex: 2015<br>
<strong>%%sitename%%</strong>: Will replace with site title.<br>
<strong>%%title%%</strong>: Will replace with site title.<br>
<strong>%%siteurl%%</strong>: Will replace with site homepage url.', 'publisher' ),
			'id'   => 'footer_copy2',
			'std'  => sprintf( __( 'Website Design: <a href="%s">BetterStudio</a>', 'publisher' ), 'http://betterstudio.com' ),
			'type' => 'textarea',
		);
		self::$fields['footer_widgets']     = array(
			'name'    => __( 'Show Footer Widgets', 'publisher' ),
			'desc'    => __( 'Choose to show or hide widgets in footer.', 'publisher' ),
			'id'      => 'footer_widgets',
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => '4-column',
			'type'    => 'select',
			'options' => array(
				'4-column' => __( '4 column widgets', 'publisher' ),
				'3-column' => __( '3 column widgets', 'publisher' ),
				'hide'     => __( '-- Hide --', 'publisher' ),
			)
		);
		self::$fields[]                     = array(
			'name'  => __( 'Footer Instagram', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['footer_social_feed'] = array(
			'name'    => __( 'Footer Instagram Style', 'publisher' ),
			'desc'    => __( 'Choose to show or hide instagram in footer.', 'publisher' ),
			'id'      => 'footer_social_feed',
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'hide',
			'type'    => 'select',
			'options' => array(
				'hide'    => __( '-- Hide --', 'publisher' ),
				'style-1' => __( 'Style 1', 'publisher' ),
				'style-2' => __( 'Style 2', 'publisher' ),
				'style-3' => __( 'Style 3', 'publisher' ),
			)
		);
		self::$fields['footer_instagram']   = array(
			'name' => __( 'Instagram Feeds Username', 'publisher' ),
			'desc' => __( 'Enter your instagram user name if you will to show instagram feed in footer.', 'publisher' ),
			'id'   => 'footer_instagram',
			'std'  => 'passionpassport',
			'ltr'  => TRUE,
			'type' => 'text',
		);


		self::$fields[]                = array(
			'name'  => __( 'Footer Social Icons', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['footer_social'] = array(
			'name'    => __( 'Show Footer Social Icons', 'publisher' ),
			'desc'    => __( 'Chose to show or hide social icons in footer..', 'publisher' ),
			'id'      => 'footer_social',
			'style'   => Publisher_Theme_Styles_Manager::get_styles(),
			'std'     => 'show',
			'type'    => 'select',
			'options' => array(
				'show' => __( 'Show', 'publisher' ),
				'hide' => __( 'Hide', 'publisher' ),
			)
		);

		if ( class_exists( 'Better_Social_Counter' ) && class_exists( 'Better_Social_Counter_Data_Manager' ) ) {
			self::$fields['footer_social_sites'] = array(
				'name'             => __( 'Sort and Active Sites', 'publisher' ),
				'id'               => 'footer_social_sites',
				'desc'             =>
					wp_kses( sprintf( __( 'Select sites you will to show them in footer and sort them. <br><br>
For activating sites you should enter your information in <a href="%s" target="_blank">Better Social Counter</a> Panel.
', 'publisher' ), get_admin_url( NULL, 'admin.php?page=better-studio/better-social-counter' ) ), bf_trans_allowed_html() ),
				'type'             => 'sorter_checkbox',
				'deferred-options' => array(
					'callback' => 'publisher_social_counter_options_list_callback',
				),
				'section_class'    => 'better-social-counter-sorter',
				'std'              => array(
					'instagram' => 1,
					'dribbble'  => 1,
					'pinterest' => 1,
					'envato'    => 1,
					'github'    => 1,
					'vimeo'     => 1,
				),

			);
		} else {
			self::$fields['footer-social-icons-help'] = array(
				'name'          => __( 'Social Icons Instructions', 'publisher' ),
				'id'            => 'footer-social-icons-help',
				'type'          => 'info',
				'std'           => __( '<p>For adding social icons in top bar you should first install and active <strong>Better Social Counter</strong> plugin.</p>', 'publisher' ),
				'state'         => 'open',
				'info-type'     => 'help',
				'section_class' => 'widefat',
			);
		}


		/**
		 * => Color Options
		 */
		self::$fields[] = array(
			'name' => __( 'Color & Style', 'publisher' ),
			'id'   => 'color_settings',
			'type' => 'tab',
			'icon' => 'bsai-paint'
		);
		// todo delete this
		self::$fields['style']                = array(
			'name'             => __( 'Pre-defined Styles', 'publisher' ),
			'id'               => 'style',
			'std'              => publisher_get_style() == 'default' ? 'clean' : publisher_get_style(),
			'type'             => 'image_select',
			'section_class'    => 'style-floated-left bordered',
			'deferred-options' => array(
				'callback' => 'publisher_styles_config',
			),
			'desc'             => __( 'Select a predefined style or create your own customized one below. <br><br> <strong>WARNING :</strong> With changing style some color and other options will be changes.', 'publisher' ),
		);
		self::$fields['reset_color_settings'] = array(
			'name'        => __( 'Reset Color Settings', 'publisher' ),
			'id'          => 'reset_color_settings',
			'type'        => 'ajax_action',
			'button-name' => '<i class="fa fa-refresh"></i> ' . __( 'Reset Color Settings', 'publisher' ),
			'callback'    => 'Publisher::reset_color_options',
			'confirm'     => __( 'Are you sure for resetting all color settings?', 'publisher' ),
			'desc'        => __( 'This allows you to reset all color settings to default.', 'publisher' )
		);
		self::$fields[]                       = array(
			'name'  => __( 'General Colors', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['theme_color']          = array(
			'name'        => __( 'Theme Highlight Color', 'publisher' ),
			'id'          => 'theme_color',
			'type'        => 'color',
			'std'         => '#0080ce',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'It is the contrast color for the theme. It will be used for all links, menu, category overlays, main page and many contrasting elements.', 'publisher' ),
			'css'         => self::$theme_color_css,
		);
		self::$fields['site_bg_color']        = array(
			'name'        => __( 'Site Background Color', 'publisher' ),
			'id'          => 'site_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'Setting a body background image below will override it.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'body',
						'body.boxed',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					),
				)
			)
		);
		self::$fields['site_bg_image']        = array(
			'name'         => __( 'Body Background Image', 'publisher' ),
			'id'           => 'site_bg_image',
			'type'         => 'background_image',
			'style'        => Publisher_Theme_Styles_Manager::get_styles(),
			'std'          => '',
			'reset-color'  => TRUE, // to reset in panel
			'upload_label' => __( 'Upload Image', 'publisher' ),
			'desc'         => __( 'Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'publisher' ),
			'css'          => array(
				array(
					'selector' => array(
						'body'
					),
					'prop'     => array( 'background-image' ),
					'type'     => 'background-image',
				)
			)
		);


		/**
		 * -> Topbar Colors
		 */
		self::$fields[]                     = array(
			'name'  => __( 'Topbar', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['topbar_date_bg']     = array(
			'name'        => __( 'Topbar Date Background Color', 'publisher' ),
			'id'          => 'topbar_date_bg',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#0080ce',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.topbar .topbar-date'
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['topbar_date_color']  = array(
			'name'        => __( 'Topbar Date Text Color', 'publisher' ),
			'id'          => 'topbar_date_color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'type'        => 'color',
			'std'         => '#ffffff',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.topbar .topbar-date'
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['topbar_text_color']  = array(
			'name'        => __( 'Topbar Text Color', 'publisher' ),
			'id'          => 'topbar_text_color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'type'        => 'color',
			'std'         => '#707070',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-header .top-menu.menu > li > a',
						'.topbar .better-newsticker ul.news-list li a',
						'.topbar .better-newsticker .control-nav span',
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['topbar_text_hcolor'] = array(
			'name'        => __( 'Topbar Text Hover Color', 'publisher' ),
			'id'          => 'topbar_text_hcolor',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'type'        => 'color',
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-header .top-menu.menu > li:hover > a',
						'.site-header .top-menu.menu .sub-menu > li:hover > a',
						'.topbar .better-newsticker ul.news-list li a',
					),
					'prop'     => array(
						'color' => '%%value%% !important'
					)
				)
			)
		);

		self::$fields['topbar_bg_color']     = array(
			'name'        => __( 'Topbar Background Color', 'publisher' ),
			'id'          => 'topbar_bg_color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'type'        => 'color',
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-header.full-width .topbar',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
				array(
					'selector' => array(
						'.site-header.boxed .topbar .topbar-inner',
					),
					'prop'     => array(
						'background-color' => '%%value%%; padding-left:15px; padding-right:15px'
					)
				),

			)
		);
		self::$fields['topbar_border_color'] = array(
			'name'        => __( 'Topbar Bottom Line Color', 'publisher' ),
			'id'          => 'topbar_border_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#efefef',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-header.full-width .topbar',
						'.site-header.boxed .topbar .topbar-inner',
					),
					'prop'     => array(
						'border-color' => '%%value%%'
					)
				)
			)
		);

		self::$fields['topbar_icon_text_color']  = array(
			'name'        => __( 'Topbar Social Icon Text Color', 'publisher' ),
			'id'          => 'topbar_icon_text_color',
			'type'        => 'color',
			'std'         => '#444444',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.topbar .better-social-counter.style-button .social-item .item-icon'
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['topbar_icon_text_hcolor'] = array(
			'name'        => __( 'Topbar Social Icon Text Hover Color', 'publisher' ),
			'id'          => 'topbar_icon_text_hcolor',
			'type'        => 'color',
			'std'         => '#545454',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.topbar .better-social-counter.style-button .social-item:hover .item-icon'
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['topbar_icon_bg']          = array(
			'name'        => __( 'Topbar Social Icon Background', 'publisher' ),
			'id'          => 'topbar_icon_bg',
			'type'        => 'color',
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.topbar .better-social-counter.style-button .social-item .item-icon'
					),
					'prop'     => array(
						'background' => '%%value%%'
					)
				)
			)
		);
		self::$fields['topbar_icon_bg_hover']    = array(
			'name'        => __( 'Topbar Social Icon Mouse Hover Background', 'publisher' ),
			'id'          => 'topbar_icon_bg_hover',
			'type'        => 'color',
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.topbar .better-social-counter.style-button .social-item:hover .item-icon'
					),
					'prop'     => array(
						'background' => '%%value%%'
					)
				)
			)
		);


		/**
		 * -> Header Colors
		 */
		self::$fields[]                                = array(
			'name'  => __( 'Header', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['header_top_border']             = array(
			'name'      => __( 'Show header top line?', 'publisher' ),
			'id'        => 'header_top_border',
			'type'      => 'switch',
			'style'     => Publisher_Theme_Styles_Manager::get_styles(),
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'You can hide header border top line with this option', 'publisher' ),
			'std'       => 1,
		);
		self::$fields['header_top_border_color']       = array(
			'name'        => __( 'Header Top Line Color', 'publisher' ),
			'id'          => 'header_top_border_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change header top line color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'body.active-top-line .main-wrap'
					),
					'prop'     => array(
						'border-color' => '%%value%% !important'
					)
				)
			)
		);
		self::$fields['header_menu_btop_color']        = array(
			'name'        => __( 'Main Menu Top Line Color', 'publisher' ),
			'id'          => 'header_menu_btop_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#dedede',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change header top & bottom line color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.site-header.boxed .main-menu-wrapper .main-menu-container',
						'.site-header.full-width .main-menu-wrapper',
					),
					'prop'     => array(
						'border-top-color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['header_menu_st1_bbottom_color'] = array(
			'name'               => __( 'Main Menu Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st1_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-1',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-1.boxed .main-menu-wrapper .main-menu-container',
						'.site-header.header-style-1.full-width .main-menu-wrapper',
						'.site-header.header-style-1 .better-pinning-block.pinned.main-menu-wrapper .main-menu-container',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%% !important'
					)
				)
			)
		);
		self::$fields['header_menu_st2_bbottom_color'] = array(
			'name'               => __( 'Main Menu Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st2_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-2',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-2.boxed .main-menu-wrapper .main-menu-container',
						'.site-header.header-style-2.full-width .main-menu-wrapper',
						'.site-header.header-style-2 .better-pinning-block.pinned.main-menu-wrapper .main-menu-container',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%% !important'
					)
				)
			)
		);

		self::$fields['header_menu_st3_bbottom_color'] = array(
			'name'               => __( 'Header Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st3_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-3',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header 4 bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-3.boxed .main-menu-container',
						'.site-header.full-width.header-style-3 .main-menu-wrapper',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%% !important'
					)
				)
			)
		);
		self::$fields['header_menu_st4_bbottom_color'] = array(
			'name'               => __( 'Header Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st4_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-4',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header 4 bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-4.boxed .main-menu-container',
						' .site-header.full-width.header-style-4 .main-menu-wrapper',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%% !important'
					)
				)
			)
		);
		self::$fields['header_menu_st5_bbottom_color'] = array(
			'name'               => __( 'Header 5 Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st5_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-5',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header 5 bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-5.boxed .header-inner',
						'.site-header.header-style-5.full-width',
						'.site-header.header-style-5.full-width > .bs-pinning-wrapper > .content-wrap.pinned',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['header_menu_st6_bbottom_color'] = array(
			'name'               => __( '6 Header Menu Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st6_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-6',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header 6 bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-6.boxed .header-inner',
						'.site-header.header-style-6.full-width',
						'.site-header.header-style-6.full-width > .bs-pinning-wrapper > .content-wrap.pinned',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['header_menu_st7_bbottom_color'] = array(
			'name'               => __( 'Header Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st7_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-7',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header 7 bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-7.boxed .main-menu-container',
						' .site-header.full-width.header-style-7 .main-menu-wrapper',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%% !important'
					)
				)
			)
		);
		self::$fields['header_menu_st8_bbottom_color'] = array(
			'name'               => __( 'Header Bottom Line Color', 'publisher' ),
			'id'                 => 'header_menu_st8_bbottom_color',
			'type'               => 'color',
			'style'              => Publisher_Theme_Styles_Manager::get_styles(),
			'std'                => '#dedede',
			'filter-field'       => 'header_style',
			'filter-field-value' => 'style-8',
			'reset-color'        => TRUE, // to reset in panel
			'desc'               => __( 'You can change header 8 bottom line color with this option.', 'publisher' ),
			'css'                => array(
				array(
					'selector' => array(
						'.site-header.header-style-8.boxed .header-inner',
						'.site-header.header-style-8.full-width',
						'.site-header.header-style-8.full-width > .bs-pinning-wrapper > .content-wrap.pinned',
					),
					'prop'     => array(
						'border-bottom-color' => '%%value%%'
					)
				)
			)
		);

		self::$fields['header_menu_text_color'] = array(
			'name'        => __( 'Main Menu Text Color', 'publisher' ),
			'id'          => 'header_menu_text_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#444444',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change main menu text color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.site-header .shop-cart-container .cart-handler',
						'.site-header .search-container .search-handler',
						'.site-header .main-menu > li > a',
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['header_menu_bg_color']   = array(
			'name'        => __( 'Main Menu Background Color', 'publisher' ),
			'id'          => 'header_menu_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change main menu background color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.site-header.boxed .main-menu-wrapper .main-menu-container',
						'.site-header.full-width .main-menu-wrapper',
						'.site-header.full-width.header-style-6',
						'.site-header.full-width.header-style-5',
						'.bs-pinning-block.pinned.main-menu-wrapper .main-menu-container',
						'.site-header.header-style-5 > .content-wrap > .bs-pinning-wrapper > .bs-pinning-block',
						'.site-header.header-style-6 > .content-wrap > .bs-pinning-wrapper > .bs-pinning-block',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
				array(
					'selector' => array(
						'.site-header.header-style-6.boxed .header-inner',
						'.site-header.header-style-5.boxed .header-inner',
					),
					'prop'     => array(
						'background-color' => '%%value%%; padding-left: 20px; padding-right: 20px'
					)
				),
			)
		);
		self::$fields['resp_scheme']            = array(
			'name'          => __( 'Responsive Header Color Scheme', 'publisher' ),
			'id'            => 'resp_scheme',
			'desc'          => __( 'Select responsive header color scheme.', 'publisher' ),
			'style'         => Publisher_Theme_Styles_Manager::get_styles(),
			'std'           => 'dark',
			'reset-color'   => TRUE, // to reset in panel
			'type'          => 'image_select',
			'section_class' => 'style-floated-left bordered',
			'options'       => array(
				'dark'  => array(
					'img'   => bf_get_theme_uri( 'images/options/resp-header-dark.png' ),
					'label' => __( 'Dark Style', 'publisher' ),
				),
				'light' => array(
					'img'   => bf_get_theme_uri( 'images/options/resp-header-light.png' ),
					'label' => __( 'Light Style', 'publisher' ),
				),
			),
		);
		self::$fields['header_bg_color']        = array(
			'name'        => __( 'Header Background Color', 'publisher' ),
			'id'          => 'header_bg_color',
			'type'        => 'color',
			'reset-color' => TRUE, // to reset in panel
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'desc'        => __( 'You can change header background color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.site-header.header-style-1',
						'.site-header.header-style-2',
						'.site-header.header-style-3',
						'.site-header.header-style-4',
						'.site-header.header-style-5.full-width',
						'.site-header.header-style-5.boxed > .content-wrap > .container',
						'.site-header.header-style-5.boxed > .bs-pinning-wrapper > .bs-pinning-block',
						'.site-header.header-style-6',
						'.site-header.header-style-6 > .content-wrap > .bs-pinning-wrapper > .bs-pinning-block',
						'.site-header.header-style-7',
						'.site-header.header-style-8',
						'.site-header.header-style-8 > .content-wrap > .bs-pinning-wrapper > .bs-pinning-block',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				)
			)
		);
		self::$fields['header_bg_image']        = array(
			'name'         => __( 'Header Background Image', 'publisher' ),
			'id'           => 'header_bg_image',
			'type'         => 'background_image',
			'style'        => Publisher_Theme_Styles_Manager::get_styles(),
			'std'          => '',
			'reset-color'  => TRUE, // to reset in panel
			'upload_label' => __( 'Upload Image', 'publisher' ),
			'desc'         => __( 'Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'publisher' ),
			'css'          => array(
				array(
					'selector' => array(
						'.site-header.header-style-1',
						'.site-header.header-style-2',
						'.site-header.header-style-3',
						'.site-header.header-style-4',
						'.site-header.header-style-5 .content-wrap',
						'.site-header.header-style-7',
					),
					'prop'     => array( 'background-image' ),
					'type'     => 'background-image'
				)
			)
		);

		/**
		 * -> Slider Colors
		 */
		self::$fields[]                        = array(
			'name'  => __( 'Category Top Posts', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['cat_topposts_bg_color'] = array(
			'name'        => __( 'Category Top Posts Style 1 Background Color', 'publisher' ),
			'id'          => 'cat_topposts_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change slider background color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.slider-style-15-container .listing-mg-5-item-big .content-container',
						'.slider-style-15-container',
						'.slider-style-13-container',
						'.slider-style-11-container',
						'.slider-style-9-container',
						'.slider-style-7-container',
						'.slider-style-4-container.slider-container-1col',
						'.slider-style-3-container',
						'.slider-style-5-container',
						'.slider-style-2-container.slider-container-1col',
						'.slider-style-1-container',
					),
					'prop'     => array(
						'background-color' => '%%value%% !important; margin-bottom: 0'
					)
				)
			)
		);


		/**
		 * -> Footer Colors
		 */
		self::$fields[]                          = array(
			'name'  => __( 'Footer', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['footer_link_color']       = array(
			'name'        => __( 'Footer Copyright Links Color', 'publisher' ),
			'id'          => 'footer_link_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'you can change footer links color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'ul.menu.footer-menu li > a',
						'.site-footer .copy-2 a',
						'.site-footer .copy-2',
						'.site-footer .copy-1 a',
						'.site-footer .copy-1',
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['footer_link_hover_color'] = array(
			'name'        => __( 'Footer Copyright Links Hover Color', 'publisher' ),
			'id'          => 'footer_link_hover_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'you can change footer links hover color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'ul.menu.footer-menu li > a:hover',
						'.site-footer .copy-2 a:hover',
						'.site-footer .copy-1 a:hover',
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['footer_widgets_text']     = array(
			'name'        => __( 'Footer Widgets Text Color', 'publisher' ),
			'desc'        => __( 'Chose the color of texts in footer widgets! use this with following widgets background color to make texts compatible.', 'publisher' ),
			'id'          => 'footer_widgets_text',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => 'light-text',
			'type'        => 'select',
			'reset-color' => TRUE, // to reset in panel
			'options'     => array(
				'light-text' => __( 'Light Texts', 'publisher' ),
				'dark-text'  => __( 'Dark Texts', 'publisher' ),
			)
		);
		self::$fields['footer_widgets_bg_color'] = array(
			'name'        => __( 'Footer Widgets Background Color', 'publisher' ),
			'id'          => 'footer_widgets_bg_color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '',
			'type'        => 'color',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-footer .footer-widgets',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['footer_copy_bg_color']    = array(
			'name'        => __( 'Copyright Footer Background Color', 'publisher' ),
			'id'          => 'footer_copy_bg_color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#353535',
			'type'        => 'color',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-footer .copy-footer',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['footer_social_bg_color']  = array(
			'name'        => __( 'Footer Social Icons Background Color', 'publisher' ),
			'id'          => 'footer_social_bg_color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#292929',
			'type'        => 'color',
			'reset-color' => TRUE, // to reset in panel
			'css'         => array(
				array(
					'selector' => array(
						'.site-footer .footer-social-icons',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['footer_bg_color']         = array(
			'name'        => __( 'Footer Background Color', 'publisher' ),
			'id'          => 'footer_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#434343',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'you can change footer background color with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.site-footer',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['footer_bg_image']         = array(
			'name'         => __( 'Footer Background Image', 'publisher' ),
			'id'           => 'footer_bg_image',
			'type'         => 'background_image',
			'style'        => Publisher_Theme_Styles_Manager::get_styles(),
			'std'          => '',
			'reset-color'  => TRUE, // to reset in panel
			'upload_label' => __( 'Upload Image', 'publisher' ),
			'desc'         => __( 'Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'publisher' ),
			'css'          => array(
				array(
					'selector' => array(
						'.site-footer'
					),
					'prop'     => array( 'background-image' ),
					'type'     => 'background-image'
				)
			)
		);


		/**
		 * -> Widgets
		 */
		self::$fields[]                        = array(
			'name'  => __( 'Widgets', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['widget_title_color']    = array(
			'name'        => __( 'Widget Title Text Color', 'publisher' ),
			'id'          => 'widget_title_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#ffffff',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change color of widgets title with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.widget .widget-heading > .h-text',
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['widget_title_bg_color'] = array(
			'name'        => __( 'Widget Title Background Color', 'publisher' ),
			'id'          => 'widget_title_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#444444',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change background color of widgets title with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.widget .widget-heading:after',
						'.widget .widget-heading > .h-text',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['widget_bg_color']       = array(
			'name'        => __( 'Widget Background Color', 'publisher' ),
			'id'          => 'widget_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#ffffff',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change background color of widgets with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.sidebar-column .widget',
					),
					'prop'     => array(
						'background' => '%%value%%; padding: 20px'
					)
				),
			)
		);


		/**
		 * -> Section Headings
		 */
		self::$fields[]                         = array(
			'name'  => __( 'Section Headings', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['section_title_color']    = array(
			'name'        => __( 'Section Title Text Color', 'publisher' ),
			'id'          => 'section_title_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#ffffff',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change text color of sections title with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.section-heading .h-text',
					),
					'prop'     => array(
						'color' => '%%value%%'
					)
				),
			)
		);
		self::$fields['section_title_bg_color'] = array(
			'name'        => __( 'Section Title Background Color', 'publisher' ),
			'id'          => 'section_title_bg_color',
			'type'        => 'color',
			'style'       => Publisher_Theme_Styles_Manager::get_styles(),
			'std'         => '#444444',
			'reset-color' => TRUE, // to reset in panel
			'desc'        => __( 'You can change background color of sections title with this option.', 'publisher' ),
			'css'         => array(
				array(
					'selector' => array(
						'.section-heading.multi-tab .main-link.active .h-text',
						'.section-heading.multi-tab .active > .h-text',
						'.section-heading.multi-tab:after',
						'.section-heading:after',
						'.section-heading .h-text',
						'.section-heading .other-link:hover .h-text',
						'.section-heading.multi-tab .main-link:hover .h-text',
					),
					'prop'     => array(
						'background-color' => '%%value%%'
					)
				),
				array(
					'selector' => array(
						'.bs-pretty-tabs-container:hover .bs-pretty-tabs-more.other-link .h-text',
						'.section-heading .bs-pretty-tabs-more.other-link:hover .h-text.h-text',
					),
					'prop'     => array(
						'color' => '%%value%% !important'
					)
				),
			)
		);


		/**
		 * => Typography Options
		 */
		self::$fields[]                      = array(
			'name' => __( 'Typography', 'publisher' ),
			'id'   => 'typo_settings',
			'type' => 'tab',
			'icon' => 'bsai-typography'
		);
		self::$fields['reset_typo_settings'] = array(
			'name'        => __( 'Reset Typography settings', 'publisher' ),
			'id'          => 'reset_typo_settings',
			'type'        => 'ajax_action',
			'button-name' => '<i class="fa fa-refresh"></i> ' . __( 'Reset Typography', 'publisher' ),
			'callback'    => 'Publisher::reset_typography_options',
			'confirm'     => __( 'Are you sure for resetting typography?', 'publisher' ),
			'desc'        => __( 'This allows you to reset all typography fields to default.', 'publisher' )
		);

		/**
		 * -> General Typography
		 *
		 * todo recheck the automatic css selectors to delete extra selectors
		 */
		self::$fields[]                   = array(
			'name'  => __( 'General Typography', 'publisher' ),
			'type'  => 'group',
			'state' => 'open',
		);
		self::$fields['typo_body']        = array(
			'name'             => __( 'Base Font (Body)', 'publisher' ),
			'id'               => 'typo_body',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Lato',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'inherit',
				'size'           => '13',
				'letter-spacing' => '',
				'color'          => '#7b7b7b',
			),
			'desc'             => __( 'Base typography for body that will affect all elements that haven\'t specified typography style. ', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'paragraph',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => 'body',
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_heading']     = array(
			'name'             => __( 'Base Heading Typography', 'publisher' ),
			'id'               => 'typo_heading',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'transform'      => 'inherit',
				'letter-spacing' => '',
			),
			'desc'             => __( 'Base heading typography that will be set to all headings (h1,h2 etc) and all titles of sections and pages that must be bolder than other texts.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.heading-typo',
						'h1,h2,h3,h4,h5,h6',
						'.header .site-branding .logo',
						'.search-form input[type="submit"]',
						'.widget.widget_categories ul li',
						'.widget.widget_archive ul li',
						'.widget.widget_nav_menu ul.menu',
						'.widget.widget_pages ul li',
						'.widget.widget_recent_entries li a',
						'.widget .tagcloud a',
						'.widget.widget_calendar table caption',
						'.widget.widget_rss li .rsswidget',
						'.listing-widget .listing-item .title',
						'button,html input[type="button"],input[type="reset"],input[type="submit"],input[type="button"]',
						'.pagination',
						'.site-footer .footer-social-icons .better-social-counter.style-name .social-item',
						'.section-heading .h-text',
						'.entry-terms a',
						'.single-container .post-share a',
						'.comment-list .comment-meta .comment-author',
						'.comments-wrap .comments-nav',
						'.main-slider .content-container .read-more',
						'a.read-more',
						'.single-page-content > .post-share li',
						'.single-container > .post-share li',

						'.better-newsticker .heading',
						'.better-newsticker ul.news-list li a',
					),
					'type'     => 'font',
				),
				array(
					'selector' => array(
						'.better-gcs-result .gsc-result .gs-title',
					),
					'type'     => 'font',
					'filter'   =>
						array(
							array(
								'type'      => 'class',
								'condition' => 'Better_GCS',
							)
						),
				),

			),
		);
		self::$fields['typo_meta']        = array(
			'name'             => __( 'Posts Meta', 'publisher' ),
			'id'               => 'typo_meta',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Lato',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'transform'      => 'none',
				'size'           => '12',
				'letter-spacing' => '',
				'color'          => '#adb5bd',
			),
			'desc'             => __( 'Typography of posts info in post meta.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-meta',
						'.post-meta a',
					),
					'type'     => 'font',
				),
			),
		);
		self::$fields['typo_meta_author'] = array(
			'name'             => __( 'Posts Meta (Author Name)', 'publisher' ),
			'id'               => 'typo_meta_author',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Lato',
				'variant'        => '700',
				'subset'         => 'latin',
				'transform'      => 'uppercase',
				'size'           => '12',
				'letter-spacing' => '',
				'color'          => '#434343',
			),
			'desc'             => __( 'Typography of posts info in post meta.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-meta .post-author',
					),
					'type'     => 'font',
				),
			),
		);

		self::$fields['typo_badges'] = array(
			'name'             => __( 'Posts Badges', 'publisher' ),
			'id'               => 'typo_badges',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'transform'      => 'uppercase',
				'size'           => '12',
				'letter-spacing' => '',
			),
			'desc'             => __( 'Typography of category and post format badges.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.term-badges .format-badge',
						'.term-badges .term-badge',
						'.main-menu .term-badges a',
					),
					'type'     => 'font',
				),
			),
		);


		/**
		 * -> Post & Page Typography
		 */
		self::$fields[]                         = array(
			'name'  => __( 'Post & Page', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_post_heading']      = array(
			'name'             => __( 'Post Title', 'publisher' ),
			'id'               => 'typo_post_heading',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'transform'      => 'capitalize',
				'letter-spacing' => '',
			),
			'desc'             => __( 'Typography of post title in single pages.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.single-post-title',
					),
					'type'     => 'font',
				),
			),
		);
		self::$fields['typo_post_tp1_heading']  = array(
			'name'             => __( 'Post Template 1 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp1_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '24px',
			'desc'             => __( 'Font size for title of post template 1.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-template-1 .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp2_heading']  = array(
			'name'             => __( 'Post Template 2 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp2_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '26px',
			'desc'             => __( 'Font size for title of post template 1.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-2-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp3_heading']  = array(
			'name'             => __( 'Post Template 3 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp3_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '26px',
			'desc'             => __( 'Font size for title of post template 1.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-3-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp4_heading']  = array(
			'name'             => __( 'Post Template 4 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp4_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '26px',
			'desc'             => __( 'Font size for title of post template 1.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-4-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp5_heading']  = array(
			'name'             => __( 'Post Template 5 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp5_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '26px',
			'desc'             => __( 'Font size for title of post template 5.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-5-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp6_heading']  = array(
			'name'             => __( 'Post Template 6 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp6_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '24px',
			'desc'             => __( 'Font size for title of post template 5.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-template-6 .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp7_heading']  = array(
			'name'             => __( 'Post Template 7 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp7_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '24px',
			'desc'             => __( 'Font size for title of post template 7.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-7-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp8_heading']  = array(
			'name'             => __( 'Post Template 8 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp8_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '24px',
			'desc'             => __( 'Font size for title of post template 8.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-template-8 .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp9_heading']  = array(
			'name'             => __( 'Post Template 9 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp9_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '24px',
			'desc'             => __( 'Font size for title of post template 9.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-template-9 .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp10_heading'] = array(
			'name'             => __( 'Post Template 10 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp10_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '24px',
			'desc'             => __( 'Font size for title of post template 10.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-template-10 .single-post-title',
						'.ajax-post-content .single-post-title.single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp11_heading'] = array(
			'name'             => __( 'Post Template 11 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp11_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '23px',
			'desc'             => __( 'Font size for title of post template 11.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-11-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp12_heading'] = array(
			'name'             => __( 'Post Template 12 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp12_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '22px',
			'desc'             => __( 'Font size for title of post template 12.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-tp-12-header .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);
		self::$fields['typo_post_tp13_heading'] = array(
			'name'             => __( 'Post Template 13 Title Font Size', 'publisher' ),
			'id'               => 'typo_post_tp13_heading',
			'type'             => 'text',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => '22px',
			'desc'             => __( 'Font size for title of post template 13.', 'publisher' ),
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.post-template-13 .single-post-title'
					),
					'prop'     => array(
						'font-size' => '%%value%%'
					)
				),
			),
		);

		self::$fields['typo_entry_content'] = array(
			'name'             => __( 'Posts & Pages Content', 'publisher' ),
			'id'               => 'typo_entry_content',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Lato',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'initial',
				'size'           => '15',
				'letter-spacing' => '',
				'color'          => '#585858',
			),
			'desc'             => __( 'Base typography for content of posts and static pages.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'paragraph',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => '.entry-content',
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_post_summary']  = array(
			'name'             => __( 'Post Summary', 'publisher' ),
			'id'               => 'typo_post_summary',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Lato',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'initial',
				'size'           => '13',
				'line_height'    => '19',
				'letter-spacing' => '',
				'color'          => '#888888',
			),
			'desc'             => __( 'Base typography for posts summary in all listings.', 'publisher' ),
			'preview'          => TRUE,
			'preview_tab'      => 'paragraph',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => '.post-summary',
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Header Typography
		 */
		self::$fields[]                      = array(
			'name'  => __( 'Header', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typ_header_menu']     = array(
			'name'             => __( 'Menu Typography', 'publisher' ),
			'id'               => 'typ_header_menu',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'uppercase',
				'size'           => '15',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.main-menu a',
						'.main-menu li',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typ_header_sub_menu'] = array(
			'name'             => __( 'Sub Menu Typography', 'publisher' ),
			'id'               => 'typ_header_sub_menu',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'none',
				'size'           => '14',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.main-menu.menu .sub-menu > li > a',
						'.main-menu.menu .sub-menu > li',
						'.responsive-header .menu-container .resp-menu li > a',
						'.responsive-header .menu-container .resp-menu li',
						'.mega-menu.mega-type-link-list .mega-links li > a',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Top Bar
		 */
		self::$fields[]                       = array(
			'name'  => __( 'Top Bar', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_topbar_menu']     = array(
			'name'             => __( 'Topbar Menu Typography', 'publisher' ),
			'id'               => 'typo_topbar_menu',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '13',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.top-menu.menu > li > a',
						'.top-menu.menu > li > a:hover',
						'.top-menu.menu > li',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_topbar_sub_menu'] = array(
			'name'             => __( 'Topbar Sub Menu Typography', 'publisher' ),
			'id'               => 'typo_topbar_sub_menu',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'none',
				'size'           => '13',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.top-menu.menu .sub-menu > li > a',
						'.top-menu.menu .sub-menu > li',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_topbar_date']     = array(
			'name'             => __( 'Topbar Date Typography', 'publisher' ),
			'id'               => 'typo_topbar_date',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'transform'      => 'uppercase',
				'size'           => '12',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.topbar .topbar-date',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Archive Title
		 */
		self::$fields[]                         = array(
			'name'  => __( 'Archive Pages Title', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_archive_title_pre'] = array(
			'name'             => __( 'Archive Pre Title', 'publisher' ),
			'id'               => 'typo_archive_title_pre',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Lato',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '14',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.archive-title .pre-title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_archive_title']     = array(
			'name'             => __( 'Archive Title', 'publisher' ),
			'id'               => 'typo_archive_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '28',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.archive-title .page-heading',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Classic Listing
		 */
		self::$fields[]                               = array(
			'name'  => __( 'Classic Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_classic_1_title'] = array(
			'name'             => __( 'Classic Listing 1 Heading', 'publisher' ),
			'id'               => 'typo_listing_classic_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '20',
				'line_height'    => '25',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-classic-1 .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_classic_2_title'] = array(
			'name'             => __( 'Classic Listing 2 Heading', 'publisher' ),
			'id'               => 'typo_listing_classic_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '20',
				'line_height'    => '27',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-classic-2 .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_classic_3_title'] = array(
			'name'             => __( 'Classic Listing 3 Heading', 'publisher' ),
			'id'               => 'typo_listing_classic_3_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '20',
				'line_height'    => '25',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-classic-3 .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Modern Grid Typography
		 */
		self::$fields[]                        = array(
			'name'  => __( 'Modern Grid Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_mg_1_title']       = array(
			'name'             => __( 'Modern Grid Listing 1 Title', 'publisher' ),
			'id'               => 'typo_mg_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '22',
				'letter-spacing' => '',
				'color'          => '#ffffff',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-1-item .content-container',
						'.listing-mg-1-item .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_mg_2_title']       = array(
			'name'             => __( 'Modern Grid Listing 2 Title', 'publisher' ),
			'id'               => 'typo_mg_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '22',
				'letter-spacing' => '',
				'color'          => '#ffffff',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-2-item .content-container',
						'.listing-mg-2-item .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_mg_3_title']       = array(
			'name'             => __( 'Modern Grid Listing 3 Title', 'publisher' ),
			'id'               => 'typo_mg_3_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '18',
				'letter-spacing' => '',
				'color'          => '#ffffff',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-3-item .content-container',
						'.listing-mg-3-item .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_mg_4_title']       = array(
			'name'             => __( 'Modern Grid Listing 4 Title', 'publisher' ),
			'id'               => 'typo_mg_4_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '17',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-4-item .content-container',
						'.listing-mg-4-item .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_mg_5_title_big']   = array(
			'name'             => __( 'Modern Grid Listing 5 - Big item Title', 'publisher' ),
			'id'               => 'typo_mg_5_title_big',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'center',
				'transform'      => 'capitalize',
				'size'           => '20',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-5-item-big .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_mg_5_title_small'] = array(
			'name'             => __( 'Modern Grid Listing 5 - Small item Title', 'publisher' ),
			'id'               => 'typo_mg_5_title_small',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'center',
				'transform'      => 'capitalize',
				'size'           => '14',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-5-item-small .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_mg_6_title']       = array(
			'name'             => __( 'Modern Grid Listing 6 Title', 'publisher' ),
			'id'               => 'typo_mg_6_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '22',
				'letter-spacing' => '',
				'color'          => '#ffffff',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-mg-6-item .content-container',
						'.listing-mg-6-item .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Grid Listing
		 */
		self::$fields[]                            = array(
			'name'  => __( 'Grid Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_grid_1_title'] = array(
			'name'             => __( 'Grid Listing 1 Heading', 'publisher' ),
			'id'               => 'typo_listing_grid_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '18',
				'line_height'    => '24',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-grid-1 .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_grid_2_title'] = array(
			'name'             => __( 'Grid Listing 2 Heading', 'publisher' ),
			'id'               => 'typo_listing_grid_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '18',
				'line_height'    => '24',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-grid-2 .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Tall Listing
		 */
		self::$fields[]                            = array(
			'name'  => __( 'Tall Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_tall_1_title'] = array(
			'name'             => __( 'Tall Listing 1 Heading', 'publisher' ),
			'id'               => 'typo_listing_tall_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '16',
				'line_height'    => '22',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-tall-1 .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_tall_2_title'] = array(
			'name'             => __( 'Tall Listing 2 Heading', 'publisher' ),
			'id'               => 'typo_listing_tall_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'center',
				'transform'      => 'capitalize',
				'size'           => '16',
				'line_height'    => '22',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-tall-2 .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Sliders
		 */
		self::$fields[]                              = array(
			'name'  => __( 'Sliders', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_slider_1_title'] = array(
			'name'             => __( 'Slider 1 Heading', 'publisher' ),
			'id'               => 'typo_listing_slider_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '22',
				'line_height'    => '30',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-slider-1-item .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_slider_2_title'] = array(
			'name'             => __( 'Slider 2 Heading', 'publisher' ),
			'id'               => 'typo_listing_slider_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '20',
				'line_height'    => '30',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-slider-2-item .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_slider_3_title'] = array(
			'name'             => __( 'Slider 3 Heading', 'publisher' ),
			'id'               => 'typo_listing_slider_3_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '20',
				'line_height'    => '30',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-slider-3-item .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Boxes
		 */
		self::$fields[]                           = array(
			'name'  => __( 'Boxes', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_box_1_title'] = array(
			'name'             => __( 'Box 1 Heading', 'publisher' ),
			'id'               => 'typo_listing_box_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'uppercase',
				'size'           => '20',
				'line_height'    => '28',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-box-1 .box-title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_box_2_title'] = array(
			'name'             => __( 'Box 2 Heading', 'publisher' ),
			'id'               => 'typo_listing_box_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'uppercase',
				'size'           => '14',
				'line_height'    => '16',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-box-2 .box-title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_box_3_title'] = array(
			'name'             => __( 'Box 3 Heading', 'publisher' ),
			'id'               => 'typo_listing_box_3_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '18',
				'line_height'    => '28',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-box-3 .box-title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_box_4_title'] = array(
			'name'             => __( 'Box 4 Heading', 'publisher' ),
			'id'               => 'typo_listing_box_4_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '18',
				'line_height'    => '28',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.bs-box-4 .box-title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Blog Listing
		 */
		self::$fields[]                            = array(
			'name'  => __( 'Blog Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_blog_1_title'] = array(
			'name'             => __( 'Blog Listing 1, 2 & 3 Heading', 'publisher' ),
			'id'               => 'typo_listing_blog_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'none',
				'size'           => '18',
				'line_height'    => '23',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-blog-1 > .title',
						'.listing-item-blog-2 > .title',
						'.listing-item-blog-3 > .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_blog_5_title'] = array(
			'name'             => __( 'Blog Listing 5 Heading', 'publisher' ),
			'id'               => 'typo_listing_blog_5_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'capitalize',
				'size'           => '18',
				'line_height'    => '24',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-blog-5 > .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Thumbnail Listing
		 */
		self::$fields[]                                 = array(
			'name'  => __( 'Thumbnail Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_listing_thumbnail_1_title'] = array(
			'name'             => __( 'Thumbnail Listing 1 & 3 Titles', 'publisher' ),
			'id'               => 'typo_listing_thumbnail_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'none',
				'size'           => '14',
				'line_height'    => '18',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-tb-3 .title',
						'.listing-item-tb-1 .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_listing_thumbnail_2_title'] = array(
			'name'             => __( 'Thumbnail Listing 2 Titles', 'publisher' ),
			'id'               => 'typo_listing_thumbnail_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'none',
				'size'           => '14',
				'line_height'    => '18',
				'letter-spacing' => '',
				'color'          => '#383838',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-tb-2 .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Text Listing Typography
		 */
		self::$fields[]                            = array(
			'name'  => __( 'Text Listing', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_text_listing_1_title'] = array(
			'name'             => __( 'Text Listing 1 Title', 'publisher' ),
			'id'               => 'typo_text_listing_1_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'center',
				'transform'      => 'capitalize',
				'size'           => '15',
				'line_height'    => '21',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-text-1 .title',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_text_listing_2_title'] = array(
			'name'             => __( 'Text Listing 2 Title', 'publisher' ),
			'id'               => 'typo_text_listing_2_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'align'          => 'inherit',
				'transform'      => 'inherit',
				'size'           => '15',
				'line_height'    => '21',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.listing-item-text-2 .title',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Widgets
		 */
		self::$fields[]                    = array(
			'name'  => __( 'Widgets', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_widget_title'] = array(
			'name'             => __( 'Widget Title', 'publisher' ),
			'id'               => 'typo_widget_title',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'transform'      => 'uppercase',
				'size'           => '14',
				'line_height'    => '20',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.widget .widget-heading',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * -> Listings Title
		 */
		self::$fields[]                       = array(
			'name'  => __( 'Listings Heading', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_section_heading'] = array(
			'name'             => __( 'Listing Heading', 'publisher' ),
			'id'               => 'typo_section_heading',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'transform'      => 'uppercase',
				'size'           => '14',
				'line_height'    => '20',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.section-heading .h-text',
					),
					'type'     => 'font',
				)
			),
		);

		/**
		 * -> Footer
		 */
		self::$fields[]                   = array(
			'name'  => __( 'Footer', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['typo_footer_menu'] = array(
			'name'             => __( 'Footer Navigation', 'publisher' ),
			'id'               => 'typo_footer_menu',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => '500',
				'subset'         => 'latin',
				'transform'      => 'capitalize',
				'size'           => '14',
				'line_height'    => '28',
				'letter-spacing' => '',
				'color'          => '#ffffff',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.site-footer .copy-footer .menu',
					),
					'type'     => 'font',
				)
			),
		);
		self::$fields['typo_footer_copy'] = array(
			'name'             => __( 'Footer Copyright', 'publisher' ),
			'id'               => 'typo_footer_copy',
			'type'             => 'typography',
			'style'            => Publisher_Theme_Styles_Manager::get_styles(),
			'std'              => array(
				'family'         => 'Roboto',
				'variant'        => 'regular',
				'subset'         => 'latin',
				'size'           => '12',
				'line_height'    => '18',
				'letter-spacing' => '',
			),
			'preview'          => TRUE,
			'preview_tab'      => 'title',
			'css-echo-default' => TRUE,
			'reset-typo'       => TRUE, // to reset in panel
			'css'              => array(
				array(
					'selector' => array(
						'.site-footer .copy-footer .container',
					),
					'type'     => 'font',
				)
			),
		);


		/**
		 * => Default Thumbnail
		 */
		self::$fields[]                             = array(
			'name' => __( 'Default Thumbnail', 'publisher' ),
			'id'   => 'thumbnail_settings',
			'type' => 'tab',
			'icon' => 'bsai-image'
		);
		self::$fields['bsbt_thumbnail_placeholder'] = array(
			'name'      => __( 'Enable Default Thumbnails Placeholder', 'publisher' ),
			'id'        => 'bsbt_thumbnail_placeholder',
			'type'      => 'switch',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'You can set default thumbnail for post that haven\' featured image with enabling this option and uploading default image in following field', 'publisher' ),
			'std'       => 0,
		);
		self::$fields['bsbt_default_thumbnail']     = array(
			'name'         => __( 'Default Thumbnail Image', 'publisher' ),
			'id'           => 'bsbt_default_thumbnail',
			'data-type'    => 'id',
			'desc'         => __( 'By default, the post thumbnail will be shown but when the post haven\'nt thumbnail then this will be replaced', 'publisher' ),
			'std'          => '',
			'type'         => 'media_image',
			'media_title'  => __( 'Select or Image', 'publisher' ),
			'media_button' => __( 'Select Image', 'publisher' ),
			'upload_label' => __( 'Upload Image', 'publisher' ),
			'remove_label' => __( 'Remove', 'publisher' ),
		);


		/**
		 * => Advanced Options
		 */
		self::$fields[]                        = array(
			'name' => __( 'Advanced', 'publisher' ),
			'id'   => 'advanced_settings',
			'type' => 'tab',
			'icon' => 'bsai-gear'
		);
		self::$fields[]                        = array(
			'name'  => __( 'Custom Width', 'publisher' ),
			'id'    => 'custom_width_heading',
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['site_box_width']        = array(
			'name'       => __( 'Site Wrapper Max Width', 'publisher' ),
			'desc'       => __( 'Controls max width of site. In px or %, ex: 100% or 1400px.', 'publisher' ),
			'input-desc' => __( 'This value should have px or %.', 'publisher' ),
			'id'         => 'site_box_width',
			'style'      => Publisher_Theme_Styles_Manager::get_styles(),
			'std'        => '1180px',
			'type'       => 'text',
			'ltr'        => TRUE,
			'css'        => array(
				array(
					'selector' => array(
						'.container',
						'.content-wrap',
						'body.boxed .main-wrap',
					),
					'prop'     => array(
						'max-width' => '%%value%% !important'
					)
				),
			),
		);
		self::$fields['site_single_col_width'] = array(
			'name'       => __( 'Single Column Layout Max Width', 'publisher' ),
			'desc'       => __( 'Controls max width of single column layout. In px or %, ex: 100% or 1400px.', 'publisher' ),
			'input-desc' => __( 'This value should have px or %.', 'publisher' ),
			'id'         => 'site_single_col_width',
			'style'      => Publisher_Theme_Styles_Manager::get_styles(),
			'std'        => '',
			'type'       => 'text',
			'ltr'        => TRUE,
			'css'        => array(
				array(
					'selector' => array(
						'.container.layout-1-col > .main-section > .content-column',
					),
					'prop'     => array(
						'max-width' => '%%value%%; margin-left:auto; margin-right:auto'
					)
				),
			),
		);


		// Favicon fallback for old WP versions
		if ( ! function_exists( 'has_site_icon' ) ) {

			self::$fields[]                  = array(
				'name'  => __( 'Favicons', 'publisher' ),
				'id'    => 'favicon_heading',
				'type'  => 'group',
				'state' => 'close',
			);
			self::$fields['favicon_16_16']   = array(
				'name'         => __( 'Favicon (16x16)', 'publisher' ),
				'id'           => 'favicon_16_16',
				'type'         => 'media_image',
				'std'          => '',
				'desc'         => __( 'Default Favicon. 16px x 16px', 'publisher' ),
				'media_title'  => __( 'Select or Upload Favicon', 'publisher' ),
				'media_button' => __( 'Select Favicon', 'publisher' ),
				'upload_label' => __( 'Upload Favicon', 'publisher' ),
				'remove_label' => __( 'Remove Favicon', 'publisher' ),
			);
			self::$fields['favicon_57_57']   = array(
				'name'         => __( 'Apple iPhone Icon (57x57)', 'publisher' ),
				'id'           => 'favicon_57_57',
				'type'         => 'media_image',
				'desc'         => __( 'Icon for Classic iPhone', 'publisher' ),
				'std'          => '',
				'media_title'  => __( 'Select or Upload Favicon', 'publisher' ),
				'media_button' => __( 'Select Favicon', 'publisher' ),
				'upload_label' => __( 'Upload Favicon', 'publisher' ),
				'remove_label' => __( 'Remove Favicon', 'publisher' ),
			);
			self::$fields['favicon_114_114'] = array(
				'name'         => __( 'Apple iPhone Retina Icon (114x114)', 'publisher' ),
				'id'           => 'favicon_114_114',
				'type'         => 'media_image',
				'desc'         => __( 'Icon for Retina iPhone', 'publisher' ),
				'std'          => '',
				'media_title'  => __( 'Select or Upload Favicon', 'publisher' ),
				'media_button' => __( 'Select Favicon', 'publisher' ),
				'upload_label' => __( 'Upload Favicon', 'publisher' ),
				'remove_label' => __( 'Remove Favicon', 'publisher' ),
			);
			self::$fields['favicon_72_72']   = array(
				'name'         => __( 'Apple iPad Icon (72x72)', 'publisher' ),
				'id'           => 'favicon_72_72',
				'type'         => 'media_image',
				'desc'         => __( 'Icon for Classic iPad', 'publisher' ),
				'std'          => '',
				'media_title'  => __( 'Select or Upload Favicon', 'publisher' ),
				'media_button' => __( 'Select Favicon', 'publisher' ),
				'upload_label' => __( 'Upload Favicon', 'publisher' ),
				'remove_label' => __( 'Remove Favicon', 'publisher' ),
			);
			self::$fields['favicon_144_144'] = array(
				'name'         => __( 'Apple iPad Retina Icon (144x144)', 'publisher' ),
				'id'           => 'favicon_144_144',
				'type'         => 'media_image',
				'desc'         => __( 'Icon for Retina iPad', 'publisher' ),
				'std'          => '',
				'media_title'  => __( 'Select or Upload Favicon', 'publisher' ),
				'media_button' => __( 'Select Favicon', 'publisher' ),
				'upload_label' => __( 'Upload Favicon', 'publisher' ),
				'remove_label' => __( 'Remove Favicon', 'publisher' ),
			);
		} // if has_site_icon

		self::$fields[]                                       = array(
			'name'  => __( 'No Duplicate Posts', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['bs_remove_duplicate_posts_full']       = array(
			'name'      => __( 'Enable For Whole Site', 'publisher' ),
			'id'        => 'bs_remove_duplicate_posts_full',
			'type'      => 'switch',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enabling this feature will remove duplicate posts in whole site.', 'publisher' ),
			'std'       => 0,
		);
		self::$fields['bs_remove_duplicate_posts']            = array(
			'name'      => __( 'Enable In Homepage', 'publisher' ),
			'id'        => 'bs_remove_duplicate_posts',
			'type'      => 'switch',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enabling this feature will remove duplicate posts in home page.', 'publisher' ),
			'std'       => 0,
		);
		self::$fields['bs_remove_duplicate_posts_categories'] = array(
			'name'      => __( 'Enable In Category Archive Page', 'publisher' ),
			'id'        => 'bs_remove_duplicate_posts_categories',
			'type'      => 'switch',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enabling this feature will remove duplicate posts in category archive pages.', 'publisher' ),
			'std'       => 0,
		);
		self::$fields['bs_remove_duplicate_posts_tags']       = array(
			'name'      => __( 'Enable In Tag Archive Page', 'publisher' ),
			'id'        => 'bs_remove_duplicate_posts_tags',
			'type'      => 'switch',
			'on-label'  => __( 'Yes', 'publisher' ),
			'off-label' => __( 'No', 'publisher' ),
			'desc'      => __( 'Enabling this feature will remove duplicate posts in tag archive pages.', 'publisher' ),
			'std'       => 0,
		);

		self::$fields[]                                = array(
			'name'  => __( 'Customize Post and Page Options', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['advanced_post_options_types']   = array(
			'name'       => __( 'Add Post Options To Other Post Types', 'publisher' ),
			'id'         => 'advanced_post_options_types',
			'desc'       => __( 'Enter custom post types IDs here to adding post meta box to them.', 'publisher' ),
			'input-desc' => __( 'Separate post types with ","', 'publisher' ),
			'type'       => 'text',
			'std'        => '',
			'ltr'        => TRUE
		);
		self::$fields[]                                = array(
			'name'  => __( 'Customize Category and Tag Options', 'publisher' ),
			'type'  => 'group',
			'state' => 'close',
		);
		self::$fields['advanced_category_options_tax'] = array(
			'name'       => __( 'Add Category Options to Other Taxonomies', 'publisher' ),
			'id'         => 'advanced_category_options_tax',
			'desc'       => __( 'Enter custom taxonomy IDs here to adding category meta box to them.', 'publisher' ),
			'input-desc' => __( 'Separate taxonomies with ","', 'publisher' ),
			'type'       => 'text',
			'std'        => '',
			'ltr'        => TRUE
		);
		self::$fields['advanced_tag_options_tax']      = array(
			'name'       => __( 'Add Tag Options to Other Taxonomies', 'publisher' ),
			'id'         => 'advanced_tag_options_tax',
			'desc'       => __( 'Enter custom taxonomy IDs here to adding tag meta box to them.', 'publisher' ),
			'input-desc' => __( 'Separate taxonomies with ","', 'publisher' ),
			'type'       => 'text',
			'std'        => '',
			'ltr'        => TRUE
		);


		/**
		 * => Custom Javascript / CSS
		 */
		bf_inject_panel_custom_css_fields( self::$fields, array(
			'advanced-class' => TRUE
		) );


		/**
		 * => Analytics & JS
		 */
		bf_inject_panel_custom_codes_fields( self::$fields, array(
			'tab-title'         => __( 'Analytics/Custom Code', 'publisher' ),
			'footer-code-title' => __( 'Google Analytics and JavaScript Codes', 'publisher' ),
		) );


		/**
		 * => Import & Export
		 */
		bf_inject_panel_import_export_fields( self::$fields, array(
			'panel-id'         => publisher_get_theme_panel_id(),
			'export-file-name' => 'publisher-options-backup',
		) );


	} // init_base_options

} // Publisher_Theme_Panel_Fields