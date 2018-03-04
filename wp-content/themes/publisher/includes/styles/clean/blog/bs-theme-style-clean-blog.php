<?php

/**
 * Publisher
 *      -> Clean Style
 *          -> Blog Demo
 */
class Publisher_Theme_Style_Clean_Blog extends Publisher_Theme_Style_Clean {

	/**
	 * Style initializer
	 */
	public function __construct() {
		$this->demo_id = 'blog';
		parent::__construct();
	}


	/**
	 * Enqueue current style css file
	 */
	function register_assets() {

		parent::register_assets();

		wp_enqueue_style(
			'publisher-theme-clean-blog',
			Publisher_Theme_Styles_Manager::get_uri( 'clean/blog/style.css' ),
			array( 'publisher' ),
			Better_Framework()->theme()->get( 'Version' )
		);

	}


	/**
	 * Adds custom functions of style
	 */
	function include_functions() {

		if ( $this->style_id == Publisher_Theme_Styles_Manager::$current_style ) {
			include_once Publisher_Theme_Styles_Manager::get_path( 'clean/blog/functions.php' );
		}

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
	 * => Advanced Options
	 *
	 */
	function customize_panel_fields() {

		parent::customize_category_fields();

		$std_id    = $this->get_std_id();
		$css_id    = $this->get_css_id();
		$exc_style = $this->get_styles_exc_current();

		/**
		 * => Template Options
		 */
		Publisher_Theme_Panel_Fields::$fields['general_listing'][ $std_id ] = 'mix-4-1';


		/**
		 * -> Posts
		 **/
		Publisher_Theme_Panel_Fields::$fields['post_template'][ $std_id ] = 'style-10';


		/**
		 * -> Categories Archive
		 **/
		Publisher_Theme_Panel_Fields::$fields['cat_top_posts'][ $std_id ] = 'style-12';


		/**
		 * => Header Options
		 */
		Publisher_Theme_Panel_Fields::$fields['header_style'][ $std_id ] = 'style-7';


		/**
		 * -> Topbar
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_style'][ $std_id ]             = 'style-1';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_date'][ $std_id ]         = 'hide';
		Publisher_Theme_Panel_Fields::$fields['topbar_show_social_icons'][ $std_id ] = 'show';


		/**
		 * => Footer Options
		 */
		Publisher_Theme_Panel_Fields::$fields['footer_social'][ $std_id ]      = 'hide';
		Publisher_Theme_Panel_Fields::$fields['footer_instagram'][ $std_id ]   = 'cerealmag';
		Publisher_Theme_Panel_Fields::$fields['footer_social_feed'][ $std_id ] = 'style-3';


		/**
		 * =>Color & Style
		 */
		$theme_color                                                     = Publisher_Theme_Panel_Fields::$theme_color_css;
		$theme_color['bg_color']['selector'][]                           = '.entry-terms.source .terms-label, .entry-terms.via .terms-label, .entry-terms.post-tags .terms-label';
		$theme_color['border_color']['selector'][]                       = '.entry-terms.source .terms-label, .entry-terms.via .terms-label, .entry-terms.post-tags .terms-label';
		$theme_color['bg_color']['selector'][]                           = '.entry-terms.entry-terms .terms-label';
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $css_id ] = $theme_color;
		Publisher_Theme_Panel_Fields::$fields['theme_color'][ $std_id ] = '#05a975';


		/**
		 * -> Topbar Colors
		 */
		Publisher_Theme_Panel_Fields::$fields['topbar_date_bg'][ $std_id ]          = '#05a975';
		Publisher_Theme_Panel_Fields::$fields['topbar_date_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_text_hcolor'][ $std_id ]      = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_bg_color'][ $std_id ]         = '#05a975';
		Publisher_Theme_Panel_Fields::$fields['topbar_bg_color'][ $css_id ]         = array(
			array(
				'selector' => array(
					'.site-header .topbar',
				),
				'prop'     => array(
					'background-color' => '%%value%%'
				)
			),
		);
		Publisher_Theme_Panel_Fields::$fields['topbar_border_color'][ $std_id ]     = '';
		Publisher_Theme_Panel_Fields::$fields['topbar_border_color']['style']       = $exc_style; // exclude this field
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_color'][ $std_id ]  = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_text_hcolor'][ $std_id ] = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg'][ $std_id ]          = '#05a975';
		Publisher_Theme_Panel_Fields::$fields['topbar_icon_bg_hover'][ $std_id ]    = '#039c69';


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
		Publisher_Theme_Panel_Fields::$fields['footer_copy_bg_color'][ $std_id ]    = '#05a975';
		Publisher_Theme_Panel_Fields::$fields['footer_social_bg_color'][ $std_id ]  = '#059c6a';
		Publisher_Theme_Panel_Fields::$fields['footer_bg_color'][ $std_id ]         = '#05a975';


		/**
		 * -> Widgets
		 */
		Publisher_Theme_Panel_Fields::$fields['widget_title_color'][ $std_id ]    = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['widget_title_bg_color'][ $std_id ] = '#05a975';
		Publisher_Theme_Panel_Fields::$fields['widget_bg_color'][ $std_id ]       = '#ffffff';
		Publisher_Theme_Panel_Fields::$fields['widget_bg_color'][ $css_id ]       = array(
			array(
				'selector' => array(
					'.sidebar-column .widget',
				),
				'prop'     => array(
					'background' => '%%value%%;'
				)
			),
		);

		/**
		 * -> Section Headings
		 */
		Publisher_Theme_Panel_Fields::$fields['section_title_bg_color'][ $std_id ] = '#05a975';


		/**
		 * => Advanced Options
		 */
		Publisher_Theme_Panel_Fields::$fields['site_box_width'][ $std_id ] = '1040px';


	} // customize_panel_fields


	/**
	 * Modifies panel typo options
	 *
	 * @return mixed
	 */
	function customize_panel_typo() {

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
			'family'         => 'Noto Sans',
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
			'transform'      => 'uppercase',
			'size'           => '12',
			'letter-spacing' => '',
			'color'          => '#434343',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_badges'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_heading'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp1_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp2_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp3_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp4_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp5_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp6_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp7_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp8_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp9_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp10_heading'][ $std_id ] = '20px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp11_heading'][ $std_id ] = '22px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp12_heading'][ $std_id ] = '24px';

		Publisher_Theme_Panel_Fields::$fields['typo_post_tp13_heading'][ $std_id ] = '24px';

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
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typ_header_sub_menu'][ $std_id ] = array(
			'family'         => 'Noto Sans',
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
			'transform'      => 'capitalize',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_sub_menu'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '12',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_topbar_date'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => '700',
			'subset'         => 'latin',
			'transform'      => 'uppercase',
			'size'           => '11',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title_pre'][ $std_id ] = array(
			'family'         => 'Lato',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_archive_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '26',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '25',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '27',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_classic_3_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '25',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_3_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_4_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_big'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_5_title_small'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '14',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_mg_6_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '20',
			'letter-spacing' => '',
			'color'          => '#ffffff',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_grid_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '15',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_tall_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'none',
			'size'           => '15',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '22',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '19',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_slider_3_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => '700',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '19',
			'line_height'    => '28',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '22',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'italic',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '13',
			'line_height'    => '16',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_3_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_box_4_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '17',
			'line_height'    => '28',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '16',
			'line_height'    => '19',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_blog_5_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '18',
			'line_height'    => '22',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '13',
			'line_height'    => '17',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_listing_thumbnail_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'none',
			'size'           => '13',
			'line_height'    => '16',
			'letter-spacing' => '',
			'color'          => '#383838',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_1_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'center',
			'transform'      => 'capitalize',
			'size'           => '14',
			'line_height'    => '22',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_text_listing_2_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'align'          => 'inherit',
			'transform'      => 'capitalize',
			'size'           => '13',
			'line_height'    => '18',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_widget_title'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'size'           => '13',
			'line_height'    => '20',
			'letter-spacing' => '',
		);

		Publisher_Theme_Panel_Fields::$fields['typo_section_heading'][ $std_id ] = array(
			'family'         => 'Noto Sans',
			'variant'        => 'regular',
			'subset'         => 'latin',
			'transform'      => 'capitalize',
			'size'           => '13',
			'line_height'    => '20',
			'letter-spacing' => '',
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

} // Publisher_Theme_Style_Default_Blog
