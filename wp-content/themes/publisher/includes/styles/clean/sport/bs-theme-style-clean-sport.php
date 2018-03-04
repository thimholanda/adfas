<?php

/**
 * Publisher
 *      -> Clean Style
 *          -> Sport Demo
 */
class Publisher_Theme_Style_Clean_Sport extends Publisher_Theme_Style_Clean {


	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->demo_id = 'sport';
		parent::__construct();
	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {

		parent::register_assets();

		wp_enqueue_style(
			'publisher-theme-clean-sport',
			Publisher_Theme_Styles_Manager::get_uri( 'clean/sport/style.css' ),
			array( 'publisher' ),
			Better_Framework()->theme()->get( 'Version' )
		);

	}


	/**
	 * Modify each style or demo category fields
	 */
	function customize_category_fields() {

		$term_css = Publisher_Theme_Category_Fields::$term_color_css;

		// fix for thumbnail listing 2 -> term badge
		$term_css['bg_color']['selector'][] = '.listing-item-tb-2 .term-badges.floated .term-badge.term-%%id%% a';

		// bs slider button color
		$term_css['bg_color']['selector'][20] = '.bs-slider-2-item.main-term-%%id%% .content-container a.read-more';
		$term_css['bg_color']['selector'][21] = '.bs-slider-3-item.main-term-%%id%% .content-container a.read-more';

		Publisher_Theme_Category_Fields::$fields['term_color'][ $this->get_css_id() ] = $term_css;

		parent::customize_category_fields();

	}


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
	 *      -> General Typography
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
		 * => Template Options
		 */
		Publisher_Theme_Panel_Fields::$fields['general_listing'][ $std_id ] = 'grid-1';


		/**
		 * -> Posts
		 **/
		Publisher_Theme_Panel_Fields::$fields['post_template'][ $std_id ] = 'style-10';


		/**
		 * -> Categories Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['cat_top_posts'][ $std_id ] = 'style-3';


		/**
		 * => Header Options
		 */
		Publisher_Theme_Panel_Fields::$fields['header_style'][ $std_id ] = 'style-6';


		/**
		 * -> Topbar
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_style'][ $std_id ]             = 'style-1';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_date'][ $std_id ]         = 'show';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_social_icons'][ $std_id ] = 'show';


		/**
		 * => Footer Options
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_social'][ $std_id ]      = 'show';
		Publisher_Theme_Panel_Fields::$fields['footer_instagram'][ $std_id ]   = 'cbssports';
		Publisher_Theme_Panel_Fields::$fields['footer_social_feed'][ $std_id ] = 'hide';


		/**
		 * =>Color & Style
		 */
		$theme_color                                                       = Publisher_Theme_Panel_Fields::$theme_color_css;
		$theme_color['bg_color']['selector'][]                             = '.entry-terms.source .terms-label, .entry-terms.via .terms-label, .entry-terms.post-tags .terms-label';
		$theme_color['border_color']['selector'][]                         = '.entry-terms.source .terms-label, .entry-terms.via .terms-label, .entry-terms.post-tags .terms-label';
		$theme_color['bg_color']['selector'][56]                           = '.bs-slider-2-item .content-container a.read-more';
		$theme_color['bg_color']['selector'][57]                           = '.bs-slider-3-item .content-container a.read-more';
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $css_id ]   = $theme_color;
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $std_id ]   = '#008625';
		Publisher_Theme_Panel_Fields::$fields['site_bg_color'][ $std_id ] = '';


		/**
		 * -> Topbar Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_date_bg'][ $std_id ]          = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_date_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_hcolor'][ $std_id ]      = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_bg_color'][ $std_id ]         = '#008625';
		Publisher_Theme_Panel_Fields::$fields['topbar_border_color'][ $std_id ]     = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_color'][ $std_id ]  = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_hcolor'][ $std_id ] = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg'][ $std_id ]          = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg_hover'][ $std_id ]    = '';
		// topbar custom color for sticky header border top color
		Publisher_Theme_Panel_Fields::$fields['topbar_bg_color'][ $css_id ] = array(
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
			array(
				'selector' => array(
					'.header-style-5 .bs-pinning-block.pinned .header-inner',
					'.header-style-6 .bs-pinning-block.pinned .header-inner',
					'.header-style-8 .bs-pinning-block.pinned .header-inner',
				),
				'prop'     => array(
					'border-top' => '2px solid %%value%%'
				)
			),
		);


		/**
		 * -> Header Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['header_top_border'][ $std_id ]      = 0;
		Publisher_Theme_Panel_Fields::$fields['header_menu_text_color'][ $std_id ] = '#434343';
		Publisher_Theme_Panel_Fields::$fields['resp_scheme'][ $std_id ]            = 'light';


		/**
		 * -> Footer Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_link_hover_color'][ $std_id ] = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['footer_copy_bg_color'][ $std_id ]    = '#006b1e';
		Publisher_Theme_Panel_Fields::$fields['footer_social_bg_color'][ $std_id ]  = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['footer_bg_color'][ $std_id ]         = '#006b1e';


		/**
		 * -> Widgets
		 */
		Publisher_Theme_Panel_Fields::$fields['widget_title_color'][ $std_id ]    = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $std_id ] = '#008625';
		Publisher_Theme_Panel_Fields::$fields['widget_bg_color'][ $std_id ]       = '#ffffff';

		/**
		 * -> Section Heading
		 */
		Publisher_Theme_Panel_Fields::$fields['section_title_color'][ $std_id ]    = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $std_id ] = '#008625';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $css_id ] = array(
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
		);


	} // customize_panel_fields


	/**
	 * Modify typo
	 */
	function customize_panel_typo() {

		$std_id = $this->get_std_id();

		parent::customize_panel_typo();

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
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
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
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
			'color'          => '#434343',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_badges'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_heading'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'transform'      => 'capitalize',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp1_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp2_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp3_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp4_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp5_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp6_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp7_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp8_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp9_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp10_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp11_heading'][ $std_id ] = '23px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp12_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp13_heading'][ $std_id ] = '22px';

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
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_sub_menu'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_menu'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_sub_menu'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_date'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title_pre'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '400',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '26',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '19',
			'line_height'    => '25',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '19',
			'line_height'    => '27',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_3_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '19',
			'line_height'    => '25',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_3_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_4_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_big'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '19',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_small'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '15',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_6_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '22',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_3_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '22',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '14',
			'line_height'    => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_3_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '18',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_4_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '18',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_5_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '24',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '14',
			'line_height'    => '18',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '14',
			'line_height'    => '18',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_1_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'center',
			'transform'      => 'capitalize',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_2_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '700',
			'subset'         => 'unknown',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '14',
			'line_height'    => '20',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_widget_title'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'transform'      => 'uppercase',
			'size'           => '14',
			'line_height'    => '22',
			'letter-spacing' => '0.3px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_section_heading'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'transform'      => 'uppercase',
			'size'           => '14',
			'line_height'    => '22',
			'letter-spacing' => '0.3px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_menu'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '500',
			'subset'         => 'unknown',
			'transform'      => 'uppercase',
			'size'           => '14',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_copy'][ $std_id ] = array(
			'family'         => 'Helvetica',
			'variant'        => '400',
			'subset'         => 'unknown',
			'size'           => '12',
			'line_height'    => '18',
			'letter-spacing' => '',
		);

	} // customize_panel_typo

} // Publisher_Theme_Style_Clean_Sport