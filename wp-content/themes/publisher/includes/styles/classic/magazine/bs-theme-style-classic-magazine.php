<?php

/**
 * Publisher
 *      -> Classic Style
 *          -> Magazine Demo
 */
class Publisher_Theme_Style_Classic_Magazine extends Publisher_Theme_Style_Classic {


	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->demo_id = 'magazine';
		parent::__construct();
	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {

		if ( $this->style_id == Publisher_Theme_Styles_Manager::$current_style ) {
			include_once Publisher_Theme_Styles_Manager::get_path( 'classic/magazine/functions.php' );
		}

	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {

		parent::register_assets();

		wp_enqueue_style(
			'publisher-theme-classic-magazine',
			Publisher_Theme_Styles_Manager::get_uri( 'classic/magazine/style.css' ),
			array( 'publisher' ),
			Better_Framework()->theme()->get( 'Version' )
		);

	}


	/**
	 * Modify each style or demo category fields
	 */
	function customize_category_fields() {

		$term_css = Publisher_Theme_Category_Fields::$term_color_css;

		unset( $term_css['color']['selector'][1] ); // menu hover color

		unset( $term_css['bg_color']['selector'][11] ); // section heading
		unset( $term_css['bg_color']['selector'][12] ); // section heading
		unset( $term_css['bg_color']['selector'][13] ); // section heading

		$term_css['color']['selector'][] = '.section-heading.main-term-%%id%% .h-text.main-term-%%id%%'; // section heading
		$term_css['color']['selector'][] = '.section-heading .h-text.main-term-%%id%%:hover'; // section heading

		// archive heading
		$term_css['color']['selector'][] = $term_css['bg_color']['selector'][9];
		unset( $term_css['bg_color']['selector'][9] );

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
		$theme_color                             = Publisher_Theme_Panel_Fields::$theme_color_css;
		$theme_color['color']['selector'][]      = '.section-heading .active > .h-text'; // section heading
		$theme_color['color']['selector'][]      = '.section-heading.multi-tab .main-link.active .h-text'; // section heading
		$theme_color['color_impo']['selector'][] = '.section-heading .other-link:hover .h-text.h-text'; // section heading
		$theme_color['color_impo']['selector'][] = '.bs-pretty-tabs-container:hover .bs-pretty-tabs-more.other-link .h-text';
		$theme_color['color_impo']['selector'][] = '.section-heading .bs-pretty-tabs-more.other-link:hover .h-text.h-text';
		unset( $theme_color['color']['selector'][51] ); // menu hover color
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $css_id ] = $theme_color;
		unset( $theme_color );
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $std_id ]   = '#e33d3d';
		Publisher_Theme_Panel_Fields::$fields['site_bg_color'][ $std_id ] = '';


		/**
		 * -> Topbar Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_border_color'][ $std_id ] = '#ffffff';


		/**
		 * -> Header Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['header_top_border'][ $std_id ]             = 0;
		Publisher_Theme_Panel_Fields::$fields['header_menu_btop_color'][ $std_id ]        = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st1_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st2_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st3_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st4_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st5_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st6_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st7_bbottom_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['header_menu_text_color'][ $std_id ]        = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['header_menu_bg_color'][ $std_id ]          = '#292929';
		Publisher_Theme_Panel_Fields::$fields['resp_scheme'][ $std_id ]                   = 'light';


		/**
		 * -> Footer Colors
		 */


		/**
		 * -> Widgets
		 */
		Publisher_Theme_Panel_Fields::$fields['widget_title_color'][ $std_id ]    = '#292929';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $css_id ] = array(
			array(
				'selector' => array(
					'.widget .widget-heading > .h-text',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
		);
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


		/**
		 * -> Section Headings
		 */
		Publisher_Theme_Panel_Fields::$fields['section_title_color'][ $std_id ]    = '#292929';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $std_id ] = '#292929';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $css_id ] = array(
			array(
				'selector' => array(
					'.section-heading.multi-tab:after',
					'.section-heading:after',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
			array(
				'selector' => array(
					'.bs-pretty-tabs-container .bs-pretty-tabs-elements',
				),
				'prop'     => array(
					'border-color' => '%%value%%'
				)
			),

		);


		/**
		 * => Template Options
		 */
		Publisher_Theme_Panel_Fields::$fields['general_listing'][ $std_id ] = 'blog-1';


		/**
		 * -> Posts
		 **/
		Publisher_Theme_Panel_Fields::$fields['post_template'][ $std_id ] = 'style-11';


		/**
		 * => Header Options
		 */
		Publisher_Theme_Panel_Fields::$fields['header_layout'][ $std_id ] = 'boxed';
		Publisher_Theme_Panel_Fields::$fields['header_style'][ $std_id ]  = 'style-1';


		/**
		 * -> Topbar
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_show_date'][ $std_id ] = 'hide';


		/**
		 * => Footer Options
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_social'][ $std_id ]      = 'show';
		Publisher_Theme_Panel_Fields::$fields['footer_social_feed'][ $std_id ] = 'hide';


	} // customize_panel_fields


	/**
	 * Modify typo
	 */
	function customize_panel_typo() {

		// do parent customizations
		parent::customize_panel_typo();

		$std_id = $this->get_std_id();


		Publisher_Theme_Panel_Fields::$fields['typo_body'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'inherit',
			'size'           => '13',
			'letter-spacing' => '',
			'color'          => '#7b7b7b',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_heading'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
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
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
			'color'          => '#434343',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_badges'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => 'italic',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '0.5px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_heading'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp1_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp2_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp3_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp4_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp5_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp6_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp7_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp8_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp9_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp10_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp11_heading'][ $std_id ] = '23px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp12_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp13_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_entry_content'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'initial',
			'size'           => '15',
			'letter-spacing' => '',
			'color'          => '#585858',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_summary'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'initial',
			'size'           => '13',
			'line_height'    => '19',
			'letter-spacing' => '',
			'color'          => '#888888',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_menu'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '14',
			'letter-spacing' => '0.5px',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_sub_menu'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => 'regular',
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
			'size'           => '13',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_sub_menu'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '13',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_date'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title_pre'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '25',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '27',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_3_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '27',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '24',
			'letter-spacing' => '0.3px',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '24',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_3_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_4_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_big'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '22',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_small'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_6_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '17',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '28',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '24',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_3_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '24',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '22',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '14',
			'line_height'    => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_3_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_4_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_5_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '15',
			'line_height'    => '17',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '15',
			'line_height'    => '17',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_1_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'capitalize',
			'size'           => '15',
			'line_height'    => '22',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_2_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '15',
			'line_height'    => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_widget_title'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '20',
			'line_height'    => '26',
			'letter-spacing' => '0.4px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_section_heading'][ $std_id ] = array(
			'family'         => 'Roboto Condensed',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '20',
			'line_height'    => '26',
			'letter-spacing' => '0.4px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'size'           => '14',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_copy'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'size'           => '11',
			'line_height'    => '18',
			'letter-spacing' => '',
		);

	} // customize_panel_typo

} // Publisher_Theme_Style_Classic_Magazine
