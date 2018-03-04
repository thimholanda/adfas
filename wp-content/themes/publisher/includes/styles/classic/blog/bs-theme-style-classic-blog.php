<?php

/**
 * Classic style -> Blog demo
 */
class Publisher_Theme_Style_Classic_Blog extends Publisher_Theme_Style_Classic {


	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->demo_id = 'blog';
		parent::__construct();
	}

	/**
	 * Adds custom functions of style
	 */
	function include_functions() {

		if ( $this->style_id == Publisher_Theme_Styles_Manager::$current_style ) {
			include_once Publisher_Theme_Styles_Manager::get_path( 'classic/blog/functions.php' );
		}

	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {
		wp_enqueue_style(
			'publisher-theme-classic-blog',
			Publisher_Theme_Styles_Manager::get_uri( 'classic/blog/style.css' ),
			array( 'publisher' ),
			Better_Framework()->theme()->get( 'Version' )
		);
	}

	/**
	 * Modify each style or demo category fields
	 */
	function customize_category_fields() {

		$term_css = Publisher_Theme_Category_Fields::$term_color_css;

		unset( $term_css['color']['selector'][4] ); // section heading:after

		// category on tabbed section heading
		$term_css['color']['selector'][] = $term_css['bg_color']['selector'][11];
		unset( $term_css['bg_color']['selector'][11] );

		$term_css['color']['selector'][] = $term_css['bg_color']['selector'][12];
		unset( $term_css['bg_color']['selector'][12] );

		$term_css['color']['selector'][] = $term_css['bg_color']['selector'][13];
		unset( $term_css['bg_color']['selector'][13] );


		// archive title bg color
		$term_css['bg_color']['selector'][] = 'body.category-%%id%% .archive-title.with-actions .page-heading';

		// archive title bottom arrow color
		$term_css['border_top_color']['selector'][] = 'body.category-%%id%% .archive-title.with-actions .page-heading:after';

		Publisher_Theme_Category_Fields::$fields['term_color'][ $this->get_css_id() ] = $term_css;

		parent::customize_category_fields();

	} // customize_category_fields


	/**
	 * Modify each style or demo options with overriding this function on child classes
	 */
	function customize_panel_fields() {

		$std_id = $this->get_std_id();
		$css_id = $this->get_css_id();

		/**
		 * => Template Options
		 */
		Publisher_Theme_Panel_Fields::$fields['layout_style'][ $std_id ]    = 'full-width';
		Publisher_Theme_Panel_Fields::$fields['general_listing'][ $std_id ] = 'grid-1';


		/**
		 * -> Homepage
		 **/
		Publisher_Theme_Panel_Fields::$fields['home_layout'][ $std_id ]  = 'default';
		Publisher_Theme_Panel_Fields::$fields['home_listing'][ $std_id ] = 'default';


		/**
		 * -> Posts
		 **/
		Publisher_Theme_Panel_Fields::$fields['post_layout'][ $std_id ]   = 'default';
		Publisher_Theme_Panel_Fields::$fields['post_template'][ $std_id ] = 'style-13';


		/**
		 * -> Page
		 **/
		Publisher_Theme_Panel_Fields::$fields['page_layout'][ $std_id ] = 'default';


		/**
		 * -> Categories Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['cat_layout'][ $std_id ]             = 'default';
		Publisher_Theme_Panel_Fields::$fields['cat_listing'][ $std_id ]            = 'default';
		Publisher_Theme_Panel_Fields::$fields['cat_top_posts'][ $std_id ]          = 'style-5';
		Publisher_Theme_Panel_Fields::$fields['cat_top_posts_gradient'][ $std_id ] = 'simple-gr';


		/**
		 * -> Tags Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['tag_layout'][ $std_id ]  = 'default';
		Publisher_Theme_Panel_Fields::$fields['tag_listing'][ $std_id ] = 'default';


		/**
		 * -> Authors Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['author_layout'][ $std_id ]  = 'default';
		Publisher_Theme_Panel_Fields::$fields['author_listing'][ $std_id ] = 'default';


		/**
		 * -> Search Results Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['search_layout'][ $std_id ]  = 'default';
		Publisher_Theme_Panel_Fields::$fields['search_listing'][ $std_id ] = 'default';

		/**
		 * -> bbPress
		 **/
		Publisher_Theme_Panel_Fields::$fields['bbpress_layout'][ $std_id ] = 'default';


		/**
		 * => Header Options
		 */
		Publisher_Theme_Panel_Fields::$fields['header_layout'][ $std_id ]        = 'full-width';
		Publisher_Theme_Panel_Fields::$fields['header_style'][ $std_id ]         = 'style-4';
		Publisher_Theme_Panel_Fields::$fields['menu_sticky'][ $std_id ]          = 'smart';
		Publisher_Theme_Panel_Fields::$fields['menu_show_search_box'][ $std_id ] = 'show';


		/**
		 * -> Topbar
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_style'][ $std_id ]             = 'hidden';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_date'][ $std_id ]         = 'hide';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_social_icons'][ $std_id ] = 'show';
		Publisher_Theme_Panel_Fields::$fields['header_top_padding'][ $std_id ]       = '';
		Publisher_Theme_Panel_Fields::$fields['header_bottom_padding'][ $std_id ]    = '';


		/**
		 * => Footer Options
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_social'][ $std_id ]      = 'hide';
		Publisher_Theme_Panel_Fields::$fields['footer_social_feed'][ $std_id ] = 'style-3';
		Publisher_Theme_Panel_Fields::$fields['footer_widgets'][ $std_id ]     = '3-column';


		/**
		 * =>Color & Style
		 */
		$theme_color_css                                                 = Publisher_Theme_Panel_Fields::$theme_color_css;
		$theme_color_css['color']['selector'][]                          = '.section-heading.multi-tab .main-link.active .h-text';
		$theme_color_css['color']['selector'][]                          = '.section-heading.multi-tab .main-link:hover .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.section-heading .other-link:hover .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.bs-pretty-tabs-container:hover .bs-pretty-tabs-more.other-link .h-text';
		$theme_color_css['color_impo']['selector'][]                     = '.section-heading .bs-pretty-tabs-more.other-link:hover .h-text.h-text';
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $css_id ] = $theme_color_css;
		unset( $theme_color_css ); // clean memory
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $std_id ]   = '#4ea371';
		Publisher_Theme_Panel_Fields::$fields['site_bg_color'][ $std_id ] = '';
		Publisher_Theme_Panel_Fields::$fields['site_bg_image'][ $std_id ] = '';


		/**
		 * -> Topbar Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_date_bg'][ $std_id ]          = '#434343';
		Publisher_Theme_Panel_Fields::$fields['topbar_date_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_color'][ $std_id ]       = '#707070';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_hcolor'][ $std_id ]      = '#707070';
		Publisher_Theme_Panel_Fields::$fields['topbar_bg_color'][ $std_id ]         = '#f5f5f5';
		Publisher_Theme_Panel_Fields::$fields['topbar_border_color'][ $std_id ]     = '#f5f5f5';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_color'][ $std_id ]  = '#424242';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_hcolor'][ $std_id ] = '#3b3b3b';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg'][ $std_id ]          = '#f5f5f5';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg_hover'][ $std_id ]    = '';


		/**
		 * -> Header Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['header_top_border'][ $std_id ]             = 0;
		Publisher_Theme_Panel_Fields::$fields['header_top_border_color'][ $std_id ]       = '';
		Publisher_Theme_Panel_Fields::$fields['header_menu_btop_color'][ $std_id ]        = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st1_bbottom_color'][ $std_id ] = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st2_bbottom_color'][ $std_id ] = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st3_bbottom_color'][ $std_id ] = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st4_bbottom_color'][ $std_id ] = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_menu_st7_bbottom_color'][ $std_id ] = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_menu_text_color'][ $std_id ]        = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['header_menu_bg_color'][ $std_id ]          = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['header_bg_color'][ $std_id ]               = '';
		Publisher_Theme_Panel_Fields::$fields['header_bg_image'][ $std_id ]               = '';
		Publisher_Theme_Panel_Fields::$fields['resp_scheme'][ $std_id ]                   = 'dark';


		/**
		 * -> Slider Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['cat_topposts_bg_color'][ $std_id ] = '';


		/**
		 * -> Footer Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_link_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['footer_link_hover_color'][ $std_id ] = '';
		Publisher_Theme_Panel_Fields::$fields['footer_widgets_text'][ $std_id ]     = 'light-text';
		Publisher_Theme_Panel_Fields::$fields['footer_widgets_bg_color'][ $std_id ] = '';
		Publisher_Theme_Panel_Fields::$fields['footer_copy_bg_color'][ $std_id ]    = '#2e2e2e';
		Publisher_Theme_Panel_Fields::$fields['footer_social_bg_color'][ $std_id ]  = '#292929';
		Publisher_Theme_Panel_Fields::$fields['footer_bg_color'][ $std_id ]         = '';
		Publisher_Theme_Panel_Fields::$fields['footer_bg_image'][ $std_id ]         = '';


		/**
		 * -> Widgets
		 */
		Publisher_Theme_Panel_Fields::$fields['widget_title_color'][ $std_id ]    = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['widget_bg_color'][ $std_id ]       = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $css_id ] = array(
			array(
				'selector' => array(
					'.widget .widget-heading',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
			array(
				'selector' => array(
					'.widget .widget-heading:after',
				),
				'prop'     => array(
					'border-top-color' => '%%value%% !important'
				)
			),
		);


		/**
		 * -> Section Headings
		 */
		Publisher_Theme_Panel_Fields::$fields['section_title_color'][ $std_id ]    = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $std_id ] = '#2d2d2d';
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $css_id ] = array(
			array(
				'selector' => array(
					'.section-heading',
					'.bs-pretty-tabs-container .bs-pretty-tabs-elements',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
			array(
				'selector' => array(
					'.section-heading:after',
				),
				'prop'     => array(
					'border-top-color' => '%%value%% !important'
				)
			),
		);


		/**
		 * => Advanced Options
		 */
		Publisher_Theme_Panel_Fields::$fields['site_box_width'][ $std_id ]        = '1040px';
		Publisher_Theme_Panel_Fields::$fields['site_single_col_width'][ $std_id ] = '';

	} // customize_panel_fields


	/**
	 * Modifies panel typo options
	 *
	 * @return mixed
	 */
	function customize_panel_typo() {

		$std_id = $this->get_std_id();


		Publisher_Theme_Panel_Fields::$fields['typo_body'][ $std_id ] = array(
			'family'         => 'Lora',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'inherit',
			'size'           => '13',
			'letter-spacing' => '',
			'color'          => '#7b7b7b',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_heading'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_meta'][ $std_id ]        = array(
			'family'         => 'Lora',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'none',
			'size'           => '11',
			'letter-spacing' => '',
			'color'          => '#adb5bd',
		);
		Publisher_Theme_Panel_Fields::$fields['typo_meta_author'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
			'color'          => '#434343',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_badges'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '11',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_heading'][ $std_id ] = array(
			'family'      => 'Montserrat',
			'variant'     => 'regular',
			'subset'      => 'latin',
			'transform'   => 'uppercase',
			'size'        => '22',
			'line_height' => '26',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp1_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp2_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp3_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp4_heading'][ $std_id ] = '26px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp5_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp6_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp7_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp8_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp9_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp10_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp11_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp12_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp13_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_entry_content'][ $std_id ] = array(
			'family'         => 'Lora',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'initial',
			'size'           => '14',
			'letter-spacing' => '',
			'color'          => '#585858',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_summary'][ $std_id ] = array(
			'family'         => 'Lora',
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
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_sub_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '13',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '10',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_sub_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_date'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'uppercase',
			'size'           => '14',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'line_height'    => '24',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'line_height'    => '24',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_3_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'uppercase',
			'size'           => '18',
			'line_height'    => '25',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_3_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_4_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '15',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_big'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'uppercase',
			'size'           => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_small'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'uppercase',
			'size'           => '14',
			'letter-spacing' => '-0.4px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_6_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '17',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '15',
			'line_height'    => '22',
			'letter-spacing' => '-0.4px',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'uppercase',
			'size'           => '15',
			'line_height'    => '22',
			'letter-spacing' => '-0.4px',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '20',
			'line_height'    => '30',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'line_height'    => '26',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_3_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'line_height'    => '26',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '14',
			'line_height'    => '20',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_3_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_4_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '16',
			'line_height'    => '20',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_5_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '18',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '13',
			'line_height'    => '16',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '13',
			'line_height'    => '16',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_1_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'uppercase',
			'size'           => '15',
			'line_height'    => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_2_title'][ $std_id ] = array(
			'family'         => 'Montserrat',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'uppercase',
			'size'           => '13',
			'line_height'    => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_widget_title'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'line_height'    => '16',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_section_heading'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'line_height'    => '16',
			'letter-spacing' => '1px',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_menu'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '12',
			'line_height'    => '12',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_footer_copy'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'size'           => '10',
			'line_height'    => '10',
			'letter-spacing' => '',
		);

	} // customize_panel_typo

} // Publisher_Theme_Style_Classic_Blog
