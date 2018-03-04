<?php

/**
 * Publisher
 *      -> Clean Style
 *          -> Fashion Demo
 */
class Publisher_Theme_Style_Clean_Fashion extends Publisher_Theme_Style_Clean {


	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->demo_id = 'fashion';
		parent::__construct();
	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {

		if ( $this->style_id == Publisher_Theme_Styles_Manager::$current_style ) {
			include_once Publisher_Theme_Styles_Manager::get_path( 'clean/fashion/functions.php' );
		}

	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {

		parent::register_assets();

		wp_enqueue_style(
			'publisher-theme-clean-fashion',
			Publisher_Theme_Styles_Manager::get_uri( 'clean/fashion/style.css' ),
			array( 'publisher' ),
			Better_Framework()->theme()->get( 'Version' )
		);

	}


	/**
	 * Modify each style or demo category fields
	 */
	function customize_category_fields() {

		$term_css = Publisher_Theme_Category_Fields::$term_color_css;

		// fix section heading bg color
		unset( $term_css['bg_color']['selector'][11] );
		unset( $term_css['bg_color']['selector'][13] );
		$term_css['color']['selector'][] = '.section-heading.main-term-%%id%% .h-text.main-term-%%id%%';
		$term_css['color']['selector'][] = '.section-heading .h-text.main-term-%%id%%:hover';
		$term_css['color']['selector'][] = '.section-heading.multi-tab .main-link.main-term-%%id%%:hover .h-text';

		Publisher_Theme_Category_Fields::$fields['term_color'][ $this->get_css_id() ] = $term_css;

		parent::customize_category_fields();

	} // customize_category_fields


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 *
	 * Table of sections:
	 *
	 * => Template Options
	 *      -> Posts
	 *      -> Categories Archive
	 *
	 * => Header Options
	 *      -> Topbar
	 *
	 * => Footer Options
	 *
	 * =>Color & Style
	 *      -> Topbar Colors
	 *      -> Header Colors
	 *      -> Footer Colors
	 *      -> Widgets
	 *
	 * =>Typography
	 *      -> Modern Grid Typography
	 *
	 * => Advanced Options
	 *
	 */
	function customize_panel_fields() {

		parent::customize_category_fields();

		$std_id = $this->get_std_id();
		$css_id = $this->get_css_id();

		/**
		 * =>Color & Style
		 */
		$theme_color_css                                                 = Publisher_Theme_Panel_Fields::$theme_color_css;
		$theme_color_css['c_border_top_color']                           = array(
			'selector' => array(
				'.header-style-1.full-width .bs-pinning-block.pinned.main-menu-wrapper',
				'.header-style-1.boxed .bs-pinning-block.pinned .main-menu-container',
				'.header-style-2.full-width .bs-pinning-block.pinned.main-menu-wrapper',
				'.header-style-2.boxed .bs-pinning-block.pinned .main-menu-container',
				'.header-style-3.full-width .bs-pinning-block.pinned.main-menu-wrapper',
				'.header-style-3.boxed .bs-pinning-block.pinned .main-menu-container',
				'.header-style-4.full-width .bs-pinning-block.pinned.main-menu-wrapper',
				'.header-style-4.boxed .bs-pinning-block.pinned .main-menu-container',
				'.header-style-5.full-width .bspw-header-style-5 .bs-pinning-block.pinned',
				'.header-style-5.boxed .bspw-header-style-5 .bs-pinning-block.pinned .header-inner',
				'.header-style-6.full-width .bspw-header-style-6 .bs-pinning-block.pinned',
				'.header-style-6.boxed .bspw-header-style-6 .bs-pinning-block.pinned .header-inner',
				'.header-style-7.full-width .bs-pinning-block.pinned.main-menu-wrapper',
				'.header-style-7.boxed .bs-pinning-block.pinned .main-menu-container',
				'.header-style-8.full-width .bspw-header-style-8 .bs-pinning-block.pinned',
				'.header-style-8.boxed .bspw-header-style-8 .bs-pinning-block.pinned .header-inner',
			),
			'prop'     => array(
				'border-top' => '3px solid %%value%%'
			)
		);
		$theme_color_css['color']['selector'][]                          = '.section-heading.multi-tab .main-link:hover .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.section-heading .other-link:hover .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.section-heading.multi-tab .active .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.bs-pretty-tabs-container:hover .bs-pretty-tabs-more.other-link .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.section-heading .bs-pretty-tabs-more.other-link:hover .h-text.h-text';
		$theme_color_css['bg_color']['selector'][]                       = '.section-heading.multi-tab:after';
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $css_id ] = $theme_color_css;
		unset( $theme_color_css );
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $std_id ]   = '#f00a71';
		Publisher_Theme_Panel_Fields::$fields['site_bg_color'][ $std_id ] = '';


		/**
		 * -> Topbar Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_date_bg'][ $std_id ]          = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_date_color'][ $std_id ]       = '#434343';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_color'][ $std_id ]       = '#707070';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_hcolor'][ $std_id ]      = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_bg_color'][ $std_id ]         = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_border_color'][ $std_id ]     = '#e6e6e6';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_color'][ $std_id ]  = '#444444';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_hcolor'][ $std_id ] = '#f00a71';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg'][ $std_id ]          = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg_hover'][ $std_id ]    = '';


		/**
		 * -> Header Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['header_menu_text_color'][ $std_id ]        = '#444444';
		Publisher_Theme_Panel_Fields::$fields['resp_scheme'][ $std_id ]                   = 'light';
		Publisher_Theme_Panel_Fields::$fields['header_bg_color'][ $std_id ]               = '#f5f5f5';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st5_bbottom_color'][ $std_id ] = '#e6e6e6';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st6_bbottom_color'][ $std_id ] = '#e6e6e6';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st8_bbottom_color'][ $std_id ] = '#e6e6e6';
		Publisher_Theme_Panel_Fields::$fields['header_menu_btop_color'][ $std_id ]        = '#dedede';
		Publisher_Theme_Panel_Fields::$fields['header_top_border'][ $std_id ]             = 1;
		Publisher_Theme_Panel_Fields::$fields['header_top_border_color'][ $std_id ]       = '';
		Publisher_Theme_Panel_Fields::$fields['header_top_border_color'][ $css_id ]       = array(
			array(
				'selector' => array(
					'body.active-top-line .main-wrap'
				),
				'prop'     => array(
					'border-color' => '%%value%%'
				)
			),
			array(
				'selector' => array(
					'.header-style-1.full-width .bs-pinning-block.pinned.main-menu-wrapper',
					'.header-style-1.boxed .bs-pinning-block.pinned .main-menu-container',
					'.header-style-2.full-width .bs-pinning-block.pinned.main-menu-wrapper',
					'.header-style-2.boxed .bs-pinning-block.pinned .main-menu-container',
					'.header-style-3.full-width .bs-pinning-block.pinned.main-menu-wrapper',
					'.header-style-3.boxed .bs-pinning-block.pinned .main-menu-container',
					'.header-style-4.full-width .bs-pinning-block.pinned.main-menu-wrapper',
					'.header-style-4.boxed .bs-pinning-block.pinned .main-menu-container',
					'.header-style-5.full-width .bspw-header-style-5 .bs-pinning-block.pinned',
					'.header-style-5.boxed .bspw-header-style-5 .bs-pinning-block.pinned .header-inner',
					'.header-style-6.full-width .bspw-header-style-6 .bs-pinning-block.pinned',
					'.header-style-6.boxed .bspw-header-style-6 .bs-pinning-block.pinned .header-inner',
					'.header-style-7.full-width .bs-pinning-block.pinned.main-menu-wrapper',
					'.header-style-7.boxed .bs-pinning-block.pinned .main-menu-container',
					'.header-style-8.full-width .bspw-header-style-8 .bs-pinning-block.pinned',
					'.header-style-8.boxed .bspw-header-style-8 .bs-pinning-block.pinned .header-inner',
				),
				'prop'     => array(
					'border-top' => '3px solid %%value%%'
				)
			),
		);


		/**
		 * -> Footer Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_link_color'][ $std_id ]       = '#333333';
		Publisher_Theme_Panel_Fields::$fields['footer_link_hover_color'][ $std_id ] = '';
		Publisher_Theme_Panel_Fields::$fields['footer_copy_bg_color'][ $std_id ]    = '#f5f5f5';
		Publisher_Theme_Panel_Fields::$fields['footer_social_bg_color'][ $std_id ]  = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['footer_bg_color'][ $std_id ]         = '#ffffff';


		/**
		 * -> Widgets
		 */
		Publisher_Theme_Panel_Fields::$fields['widget_title_color'][ $std_id ]    = '#f00a71';
		Publisher_Theme_Panel_Fields::$fields['widget_bg_color'][ $std_id ]       = '';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $std_id ] = '#f00a71';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $css_id ] = array(
			array(
				'selector' => array(
					'.widget .widget-heading:after',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
		);


		Publisher_Theme_Panel_Fields::$fields['section_title_color'][ $std_id ]    = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $std_id ] = '#303030';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $css_id ] = array(
			array(
				'selector' => array(
					'.section-heading:after',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
			array(
				'selector' => array(
					'.section-heading .h-text',
				),
				'prop'     => array(
					'color' => '%%value%%'
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
		);


		/**
		 * => Template Options
		 */
		Publisher_Theme_Panel_Fields::$fields['general_listing'][ $std_id ] = 'grid-1';


		/**
		 * -> Posts
		 **/
		Publisher_Theme_Panel_Fields::$fields['post_template'][ $std_id ] = 'style-1';


		/**
		 * -> Categories Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['cat_top_posts'][ $std_id ] = 'style-3';


		/**
		 * => Header Options
		 */
		Publisher_Theme_Panel_Fields::$fields['header_layout'][ $std_id ] = 'full-width';
		Publisher_Theme_Panel_Fields::$fields['header_style'][ $std_id ]  = 'style-8';


		/**
		 * -> Topbar
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_style'][ $std_id ]             = 'style-1';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_date'][ $std_id ]         = 'hide';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_social_icons'][ $std_id ] = 'show';


		/**
		 * => Footer Options
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_social'][ $std_id ]      = 'show';
		Publisher_Theme_Panel_Fields::$fields['footer_instagram'][ $std_id ]   = 'desigual';
		Publisher_Theme_Panel_Fields::$fields['footer_social_feed'][ $std_id ] = 'style-1';


	} // customize_panel_fields


	/**
	 * Modify each style or typo
	 *
	 * It's full customization
	 */
	function customize_panel_typo() {

		$std_id = $this->get_std_id();

		Publisher_Theme_Panel_Fields::$fields['typo_body'][ $std_id ] = array(
			'family'         => 'Georgia',
			'variant'        => '400',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'inherit',
			'size'           => '14',
			'letter-spacing' => '',
			'color'          => '#7b7b7b',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_heading'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'inherit',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_meta'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'none',
			'size'           => '12',
			'letter-spacing' => '',
			'color'          => '#adb5bd',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_meta_author'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'size'           => '12',
			'letter-spacing' => '',
			'color'          => '#434343',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_badges'][ $std_id ] = array(
			'family'         => 'Raleway',
			'variant'        => '600',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_heading'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp1_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp2_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp3_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp4_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp5_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp6_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp7_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp8_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp9_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp10_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp11_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp12_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp13_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_entry_content'][ $std_id ] = array(
			'family'         => 'Georgia',
			'variant'        => '400',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'initial',
			'size'           => '15',
			'letter-spacing' => '',
			'color'          => '#585858',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_summary'][ $std_id ] = array(
			'family'         => 'Georgia',
			'variant'        => '400',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'initial',
			'size'           => '14',
			'line_height'    => '20',
			'letter-spacing' => '',
			'color'          => '#888888',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_menu'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_sub_menu'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_sub_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_date'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => 'italic',
			'subset'         => 'latin',
			'transform'      => 'none',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title_pre'][ $std_id ] = array(
			'family'         => 'Raleway',
			'variant'        => '600',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '30',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '24',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '24',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_3_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '26',
			'line_height'    => '30',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '26',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '26',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_3_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_4_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_big'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '26',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_small'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_6_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '26',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '26',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '22',
			'line_height'    => '30',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '24',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '24',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '28',
			'line_height'    => '32',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '26',
			'line_height'    => '35',
			'letter-spacing' => '0.4px',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_3_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '26',
			'line_height'    => '35',
			'letter-spacing' => '0.4px',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700italic',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '26',
			'line_height'    => '30',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => 'italic',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '18',
			'line_height'    => '26',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_3_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700italic',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '26',
			'line_height'    => '30',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_4_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700italic',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '26',
			'line_height'    => '30',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_5_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '23',
			'line_height'    => '30',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '15',
			'line_height'    => '20',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_1_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'capitalize',
			'size'           => '17',
			'line_height'    => '26',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_2_title'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '900',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '16',
			'line_height'    => '24',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_widget_title'][ $std_id ] = array(
			'family'         => 'Raleway',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '34',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_section_heading'][ $std_id ] = array(
			'family'         => 'Raleway',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'size'           => '16',
			'line_height'    => '34',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_menu'][ $std_id ] = array(
			'family'         => 'Playfair Display',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'none',
			'size'           => '14',
			'line_height'    => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_copy'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'size'           => '12',
			'line_height'    => '18',
			'letter-spacing' => '',
		);

	} // customize_panel_fields

} // Publisher_Theme_Style_Clean_Fashion
