<?php

/**
 * Publisher Setup
 */
class Publisher_Setup {

	function __construct() {

		// Register included BF to loader ( After Plugins )
		add_filter( 'better-framework/loader', array( $this, 'register_better_framework' ), 100 );

		add_filter( 'better-framework/oculus/loader', array( $this, 'register_oculus' ), 90 );

		add_filter( 'better-framework/product-updater/loader', array( $this, 'register_updater' ), 90 );

		// Enable needed sections
		add_filter( 'better-framework/sections', array( $this, 'setup_bf_features' ), 100 );

		// Configs "BS Theme Shortcodes" library
		add_filter( 'publisher-theme-core/editor-shortcodes/config', array( $this, 'theme_shortcodes_library' ) );

		// Config Version Compatibility library
		include PUBLISHER_THEME_PATH . 'includes/version-compatibilities.php';
		add_filter( 'publisher-theme-core/version-compatibility/config', array(
			$this,
			'config_version_compatibility'
		) );

		/*
		 * i18n
		 */
		load_theme_textdomain( 'publisher', get_template_directory() . '/languages' );

		// Meta box options
		include PUBLISHER_THEME_PATH . 'includes/options/metabox.php';

		// User Meta box options
		include PUBLISHER_THEME_PATH . 'includes/options/user.php';

		// Tag options
		include PUBLISHER_THEME_PATH . 'includes/options/tag.php';

		// Menus options
		include PUBLISHER_THEME_PATH . 'includes/options/menu.php';

		// Widgets options
		include PUBLISHER_THEME_PATH . 'includes/options/widget.php';

		// Init translation texts
		include PUBLISHER_THEME_PATH . 'includes/options/translation.php';

		// Init Ads
		include PUBLISHER_THEME_PATH . 'includes/ads/ads.php';

		// Active and new shortcodes
		add_filter( 'better-framework/shortcodes', array( $this, 'setup_shortcodes' ), 100 );

		// Initialize no duplicate posts option
		add_action( 'publisher-theme-core/duplicate-posts/config', array( $this, 'setup_no_duplicate_posts' ) );

		// Include VC Homepage Templates
		if ( function_exists( 'vc_set_as_theme' ) ) {
			include PUBLISHER_THEME_PATH . 'includes/vc/templates.php';
		}

		// Config shortcodes placeholder
		add_filter( 'publisher-theme-core/shortcodes-placeholder/config', array( $this, 'shortcodes_placeholder' ) );

		// Inits WooCommerce functionality
		if ( function_exists( 'is_woocommerce' ) ) {
			include PUBLISHER_THEME_PATH . 'includes/woocommerce/publisher-wc.php';
		}

	} // __construct


	/**
	 * Get a WP_Theme object for a theme
	 *
	 * @return WP_Theme
	 */
	public function get_wp_theme_object() {
		if ( function_exists( 'BF' ) ) {
			return Better_Framework()->theme();
		}

		$theme = wp_get_theme();
		if ( '' != $theme->get( 'Template' ) ) {
			$theme = wp_get_theme( $theme->get( 'Template' ) );
		}

		return $theme;
	}


	/**
	 * Get active theme version number
	 *
	 * @param array $config
	 *
	 * @return array
	 */
	public function config_version_compatibility( $config ) {

		$config['products']['publisher'] = array(
			'active-version' => $this->get_wp_theme_object()->get( 'Version' )
		);

		$config['compatibility-actions']['publisher'] = array(
			'1.1' => 'publisher_version_1_1_copatibility'
		);

		return $config;
	}


	/**
	 * Registers included version of BF to BF loader
	 *
	 * @param $frameworks
	 *
	 * @return array
	 */
	function register_better_framework( $frameworks ) {

		$frameworks[] = array(
			'version' => '2.6.4',
			'path'    => PUBLISHER_THEME_PATH . 'includes/libs/better-framework/',
			'uri'     => PUBLISHER_THEME_URI . 'includes/libs/better-framework/',
		);

		return $frameworks;
	}


	/**
	 * Register oculus library
	 *
	 * @param array $libs
	 *
	 * @return array
	 */
	function register_oculus( $libs ) {

		$libs[] = array(
			'version' => '1.0.1',
			'path'    => PUBLISHER_THEME_PATH . 'includes/libs/better-framework/oculus/',
			'uri'     => PUBLISHER_THEME_URI . 'includes/libs/better-framework/oculus/',
		);

		return $libs;
	}


	/**
	 * Register updater library
	 *
	 * @param array $libs
	 *
	 * @return array
	 */
	function register_updater( $libs ) {

		$libs[] = array(
			'version' => '1.0.1',
			'path'    => PUBLISHER_THEME_PATH . 'includes/libs/better-product-updater/',
			'uri'     => PUBLISHER_THEME_URI . 'includes/libs/better-product-updater/'
		);

		return $libs;
	}


	/**
	 * Setups features of BetterFramework
	 *
	 * @param $features
	 *
	 * @return array
	 */
	function setup_bf_features( $features ) {

		/**
		 * 1. => BetterFramework Features
		 */
		$features['admin_panel']       = TRUE;
		$features['meta_box']          = TRUE;
		$features['taxonomy_meta_box'] = TRUE;
		$features['load_in_frontend']  = FALSE;
		$features['better-menu']       = TRUE;
		$features['custom-css-pages']  = TRUE;
		$features['user-meta-box']     = TRUE;
		$features['custom-css-users']  = TRUE;
		$features['vc-extender']       = TRUE;
		$features['product-pages']     = TRUE;
		$features['product-updater']   = TRUE;

		return $features;
	}


	/**
	 * Setups Shortcodes
	 *
	 * 6. => Setup Shortcodes
	 *
	 * @param $shortcodes
	 *
	 * @return array
	 */
	function setup_shortcodes( $shortcodes ) {

		require bf_get_theme_dir( 'includes/shortcodes/bs-highlight-colors.php' );
		$shortcodes['bs-highlight-bg']    = array(
			'shortcode_class' => 'Publisher_Highlight_BG_Shortcode',
		);
		$shortcodes['bs-highlight-color'] = array(
			'shortcode_class' => 'Publisher_Highlight_Color_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-mix-listings.php' );
		$shortcodes['bs-mix-listing-1-1'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_1_1_Shortcode',
		);
		$shortcodes['bs-mix-listing-1-2'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_1_2_Shortcode',
		);
		$shortcodes['bs-mix-listing-1-3'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_1_3_Shortcode',
		);
		$shortcodes['bs-mix-listing-1-4'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_1_4_Shortcode',
		);
		$shortcodes['bs-mix-listing-2-1'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_2_1_Shortcode',
		);
		$shortcodes['bs-mix-listing-2-2'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_2_2_Shortcode',
		);
		$shortcodes['bs-mix-listing-3-1'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_3_1_Shortcode',
		);
		$shortcodes['bs-mix-listing-3-2'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_3_2_Shortcode',
		);
		$shortcodes['bs-mix-listing-3-3'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_3_3_Shortcode',
		);
		$shortcodes['bs-mix-listing-3-4'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_3_4_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-1'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_1_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-2'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_2_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-3'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_3_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-4'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_4_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-5'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_5_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-6'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_6_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-7'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_7_Shortcode',
		);
		$shortcodes['bs-mix-listing-4-8'] = array(
			'shortcode_class' => 'Publisher_Mix_Listing_4_8_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-blog-listings.php' );
		$shortcodes['bs-blog-listing-1'] = array(
			'shortcode_class' => 'Publisher_Blog_Listing_1_Shortcode',
		);
		$shortcodes['bs-blog-listing-2'] = array(
			'shortcode_class' => 'Publisher_Blog_Listing_2_Shortcode',
		);
		$shortcodes['bs-blog-listing-3'] = array(
			'shortcode_class' => 'Publisher_Blog_Listing_3_Shortcode',
		);
		$shortcodes['bs-blog-listing-4'] = array(
			'shortcode_class' => 'Publisher_Blog_Listing_4_Shortcode',
		);
		$shortcodes['bs-blog-listing-5'] = array(
			'shortcode_class' => 'Publisher_Blog_Listing_5_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-classic-listings.php' );
		$shortcodes['bs-classic-listing-1'] = array(
			'shortcode_class' => 'Publisher_Classic_Listing_1_Shortcode',
		);
		$shortcodes['bs-classic-listing-2'] = array(
			'shortcode_class' => 'Publisher_Classic_Listing_2_Shortcode',
		);
		$shortcodes['bs-classic-listing-3'] = array(
			'shortcode_class' => 'Publisher_Classic_Listing_3_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-grid-listings.php' );
		$shortcodes['bs-grid-listing-1'] = array(
			'shortcode_class' => 'Publisher_Grid_Listing_1_Shortcode',
		);
		$shortcodes['bs-grid-listing-2'] = array(
			'shortcode_class' => 'Publisher_Grid_Listing_2_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-thumbnail-listings.php' );
		$shortcodes['bs-thumbnail-listing-1'] = array(
			'shortcode_class' => 'Publisher_Thumbnail_Listing_1_Shortcode',
		);
		$shortcodes['bs-thumbnail-listing-2'] = array(
			'shortcode_class' => 'Publisher_Thumbnail_Listing_2_Shortcode',
		);
		$shortcodes['bs-thumbnail-listing-3'] = array(
			'shortcode_class' => 'Publisher_Thumbnail_Listing_3_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-text-listings.php' );
		$shortcodes['bs-text-listing-1'] = array(
			'shortcode_class' => 'Publisher_Text_Listing_1_Shortcode',
		);
		$shortcodes['bs-text-listing-2'] = array(
			'shortcode_class' => 'Publisher_Text_Listing_2_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-tall-listings.php' );
		$shortcodes['bs-tall-listing-1'] = array(
			'shortcode_class' => 'Publisher_Tall_Listing_1_Shortcode',
		);
		$shortcodes['bs-tall-listing-2'] = array(
			'shortcode_class' => 'Publisher_Tall_Listing_2_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-modern-grid-listings.php' );
		$shortcodes['bs-modern-grid-listing-1'] = array(
			'shortcode_class' => 'Publisher_Modern_Grid_Listing_1_Shortcode',
		);
		$shortcodes['bs-modern-grid-listing-2'] = array(
			'shortcode_class' => 'Publisher_Modern_Grid_Listing_2_Shortcode',
		);
		$shortcodes['bs-modern-grid-listing-3'] = array(
			'shortcode_class' => 'Publisher_Modern_Grid_Listing_3_Shortcode',
		);
		$shortcodes['bs-modern-grid-listing-4'] = array(
			'shortcode_class' => 'Publisher_Modern_Grid_Listing_4_Shortcode',
		);
		$shortcodes['bs-modern-grid-listing-5'] = array(
			'shortcode_class' => 'Publisher_Modern_Grid_Listing_5_Shortcode',
		);
		$shortcodes['bs-modern-grid-listing-6'] = array(
			'shortcode_class' => 'Publisher_Modern_Grid_Listing_6_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-sliders.php' );
		$shortcodes['bs-slider-1'] = array(
			'shortcode_class' => 'Publisher_Slider_1_Shortcode',
		);
		$shortcodes['bs-slider-2'] = array(
			'shortcode_class' => 'Publisher_Slider_2_Shortcode',
		);
		$shortcodes['bs-slider-3'] = array(
			'shortcode_class' => 'Publisher_Slider_3_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/listing-shortcodes/bs-boxes.php' );
		$shortcodes['bs-box-1'] = array(
			'shortcode_class' => 'Publisher_Box_1_Shortcode',
		);
		$shortcodes['bs-box-2'] = array(
			'shortcode_class' => 'Publisher_Box_2_Shortcode',
		);
		$shortcodes['bs-box-3'] = array(
			'shortcode_class' => 'Publisher_Box_3_Shortcode',
		);
		$shortcodes['bs-box-4'] = array(
			'shortcode_class' => 'Publisher_Box_4_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-social-share.php' );
		$shortcodes['bs-social-share'] = array(
			'shortcode_class' => 'Publisher_Social_Share_Shortcode',
			'widget_class'    => 'Publisher_Social_Share_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-recent-posts.php' );
		$shortcodes['bs-recent-posts'] = array(
			'shortcode_class' => 'Publisher_Recent_Posts_Shortcode',
			'widget_class'    => 'Publisher_Recent_Posts_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-about.php' );
		$shortcodes['bs-about'] = array(
			'shortcode_class' => 'Publisher_About_Shortcode',
			'widget_class'    => 'Publisher_About_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-popular-categories.php' );
		$shortcodes['bs-popular-categories'] = array(
			'shortcode_class' => 'Publisher_Popular_Categories_Shortcode',
			'widget_class'    => 'Publisher_Popular_Categories_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-subscribe-newsletter.php' );
		$shortcodes['bs-subscribe-newsletter'] = array(
			'shortcode_class' => 'Publisher_Subscribe_Newsletter_Shortcode',
			'widget_class'    => 'Publisher_Subscribe_Newsletter_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-flickr.php' );
		$shortcodes['bs-flickr'] = array(
			'shortcode_class' => 'Publisher_Flickr_Shortcode',
			'widget_class'    => 'Publisher_Flickr_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-likebox.php' );
		$shortcodes['bs-likebox'] = array(
			'shortcode_class' => 'Publisher_Likebox_Shortcode',
			'widget_class'    => 'Publisher_Likebox_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-dribbble.php' );
		$shortcodes['bs-dribbble'] = array(
			'shortcode_class' => 'Publisher_Dribbble_Shortcode',
			'widget_class'    => 'Publisher_Dribbble_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-google-plus.php' );
		$shortcodes['bs-google-plus'] = array(
			'shortcode_class' => 'Publisher_Google_Plus_Shortcode',
			'widget_class'    => 'Publisher_Google_Plus_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-embed.php' );
		$shortcodes['bs-embed'] = array(
			'shortcode_class' => 'Publisher_Embed_Shortcode',
			'widget_class'    => 'Publisher_Embed_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-instagram.php' );
		$shortcodes['bs-instagram'] = array(
			'shortcode_class' => 'Publisher_Instagram_Shortcode',
			'widget_class'    => 'Publisher_Instagram_Widget',
		);


		require bf_get_theme_dir( 'includes/shortcodes/better-newsticker.php' );
		$shortcodes['better-newsticker'] = array(
			'shortcode_class' => 'Better_Newsticker_Shortcode',
		);


		require bf_get_theme_dir( 'includes/shortcodes/bs-text.php' );
		$shortcodes['bs-text'] = array(
			'shortcode_class' => 'Publisher_Text_Shortcode',
		);

		require bf_get_theme_dir( 'includes/shortcodes/bs-heading.php' );
		$shortcodes['bs-heading'] = array(
			'shortcode_class' => 'Publisher_Heading_Shortcode',
		);

		return $shortcodes;

	}


	/**
	 * Callback: Activate BetterStudio Duplicate Posts
	 *
	 * @param $active_pages
	 *
	 * @return array
	 */
	function setup_no_duplicate_posts( $active_pages ) {

		if ( publisher_get_option( 'bs_remove_duplicate_posts_full' ) ) {
			$active_pages[] = 'full';
		} else {

			if ( publisher_get_option( 'bs_remove_duplicate_posts' ) ) {
				$active_pages[] = 'home';
			}

			if ( publisher_get_option( 'bs_remove_duplicate_posts_categories' ) ) {
				$active_pages[] = 'categories';
			}

			if ( publisher_get_option( 'bs_remove_duplicate_posts_tags' ) ) {
				$active_pages[] = 'tags';
			}

		}

		return $active_pages;

	}


	/**
	 * Configs the theme shortcodes library
	 *
	 * @param $config
	 *
	 * @return array
	 */
	public function theme_shortcodes_library( $config ) {

		// dynamic styles
		$config['editor-dynamic-style'][] = PUBLISHER_THEME_PATH . 'includes/dynamics/global_content_css.php';
		$config['editor-dynamic-style'][] = PUBLISHER_THEME_PATH . 'includes/dynamics/editor_css.php';

		// Publisher icon
		$config['icon']       = '034';
		$config['icon-color'] = publisher_get_option( 'theme_color' );

		// name
		$config['name'] = 'Publisher';

		// Columns sizes
		$config['size-max-width']     = 1130;
		$config['size-content-width'] = 743.333;

		return $config;

	}


	/**
	 * Callback: configs shortcodes placeholder for theme
	 * Filter: better-template/shortcodes-placeholder/config
	 *
	 * @param $config
	 *
	 * @return array
	 */
	public function shortcodes_placeholder( $config ) {

		$plugins_url = admin_url( 'admin.php?page=bs-product-pages-install-plugin' );

		$notice = __( 'Please install "<b>%s</b>" Plugin from <a href="%s">Plugin Installer</a> to show this shortcode.', 'publisher' );

		$special_sidebars = array();


		$config['better-social-counter'] = array(
			'id'               => 'better-social-counter',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Social Counter', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);
		$config['better-social-banner']  = array(
			'id'               => 'better-social-banner',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Social Counter', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);


		$config['BetterWeather']        = array(
			'id'               => 'BetterWeather',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Weather', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);
		$config['BetterWeather-inline'] = array(
			'id'               => 'BetterWeather-inline',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Weather', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);


		$config['better-ads'] = array(
			'id'               => 'better-ads',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Ads Manager', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);


		$config['better-post-views'] = array(
			'id'               => 'better-post-views',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Post Views', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);


		$config['bs-youtube-playlist-1'] = array(
			'id'               => 'bs-youtube-playlist-1',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Playlist', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);
		$config['bs-youtube-playlist-2'] = array(
			'id'               => 'bs-youtube-playlist-2',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Playlist', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);
		$config['bs-vimeo-playlist-1']   = array(
			'id'               => 'bs-vimeo-album-1',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Playlist', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);
		$config['bs-vimeo-playlist-2']   = array(
			'id'               => 'bs-vimeo-album-2',
			'notice_long'      => wp_kses( sprintf( $notice, __( 'Better Playlist', 'publisher' ), $plugins_url ), bf_trans_allowed_html() ),
			'special_sidebars' => $special_sidebars,
		);

		return $config;
	}

} // Publisher_Setup