<?php
/*
Plugin Name: Better Ads Manager
Plugin URI: http://betterstudio.com
Description: Manage your ads in better way!
Version: 1.4.0
Author: BetterStudio
Author URI: http://betterstudio.com
License: GPL2
*/


/**
 * Better_Ads_Manager class wrapper for make changes safe in future
 *
 * @return Better_Ads_Manager
 */
function Better_Ads_Manager() {
	return Better_Ads_Manager::self();
}


// Initialize Better Ads Manager
Better_Ads_Manager();


/**
 * Class Better_Ads_Manager
 */
class Better_Ads_Manager {


	/**
	 * Contains plugin version number that used for assets for preventing cache mechanism
	 *
	 * @var string
	 */
	private static $version = '1.4.0';


	/**
	 * Contains plugin option panel ID
	 *
	 * @var string
	 */
	public static $panel_id = 'better_ads_manager';


	/**
	 * Inner array of instances
	 *
	 * @var array
	 */
	protected static $instances = array();


	/**
	 * Plugin initialize
	 */
	function __construct() {

		// Register included BF
		add_filter( 'better-framework/loader', array( $this, 'better_framework_loader' ) );

		// Includes general functions
		include $this->dir_path( 'functions.php' );

		// Add option panel
		include $this->dir_path( 'includes/panel-options.php' );

		// Add metabox
		include $this->dir_path( 'includes/metabox-options.php' );

		// Activate and add new shortcodes
		add_filter( 'better-framework/shortcodes', array( $this, 'setup_shortcodes' ), 100 );

		// Initialize after bf init
		add_action( 'better-framework/after_setup', array( $this, 'bf_init' ) );

		// Do some stuff after WP init
		add_action( 'init', array( $this, 'init' ) );

		// Includes BF loader if not included before
		require_once $this->dir_path( '/includes/libs/better-framework/init.php' );

		// Ads plugin textdomain
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// Ajax callback for rebuilding image from front end
		add_action( 'wp_ajax_nopriv_better_ads_manager_blocked_fallback', array( $this, 'callback_blocked_ads' ) );
		add_action( 'wp_ajax_better_ads_manager_blocked_fallback', array( $this, 'callback_blocked_ads' ) );

	}


	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	function load_textdomain() {

		// Register text domain
		load_plugin_textdomain( 'better-studio', FALSE, 'better-ads-manager/languages' );

	}


	/**
	 * Used for accessing plugin directory URL
	 *
	 * @param string $address
	 *
	 * @return string
	 */
	public static function dir_url( $address = '' ) {

		return plugin_dir_url( __FILE__ ) . $address;

	}


	/**
	 * Used for accessing plugin directory Path
	 *
	 * @param string $address
	 *
	 * @return string
	 */
	public static function dir_path( $address = '' ) {

		return plugin_dir_path( __FILE__ ) . $address;

	}


	/**
	 * Returns plugin current Version
	 *
	 * @return string
	 */
	public static function get_version() {

		return self::$version;

	}


	/**
	 * Build the required object instance
	 *
	 * @param   string $object
	 * @param   bool   $fresh
	 * @param   bool   $just_include
	 *
	 * @return  Better_Ads_Manager|null
	 */
	public static function factory( $object = 'self', $fresh = FALSE, $just_include = FALSE ) {

		if ( isset( self::$instances[ $object ] ) && ! $fresh ) {
			return self::$instances[ $object ];
		}

		switch ( $object ) {

			/**
			 * Main Better_Ads_Manager Class
			 */
			case 'self':
				$class = 'Better_Ads_Manager';
				break;

			default:
				return NULL;
		}


		// Just prepare/includes files
		if ( $just_include ) {
			return;
		}

		// don't cache fresh objects
		if ( $fresh ) {
			return new $class;
		}

		self::$instances[ $object ] = new $class;

		return self::$instances[ $object ];
	}


	/**
	 * Used for accessing alive instance of plugin
	 *
	 * @since 1.0
	 *
	 * @return Better_Ads_Manager
	 */
	public static function self() {

		return self::factory();

	}


	/**
	 * Used for retrieving options simply and safely for next versions
	 *
	 * @param $option_key
	 *
	 * @return mixed|null
	 */
	public static function get_option( $option_key ) {

		return bf_get_option( $option_key, self::$panel_id );

	}


	/**
	 * Callback: Adds included BetterFramework to BF loader
	 *
	 * Filter: better-framework/loader
	 *
	 * @param $frameworks
	 *
	 * @return array
	 */
	function better_framework_loader( $frameworks ) {

		$frameworks[] = array(
			'version' => '2.6.3',
			'path'    => $this->dir_path( 'includes/libs/better-framework/' ),
			'uri'     => $this->dir_url( 'includes/libs/better-framework/' ),
		);

		return $frameworks;

	}


	/**
	 *  Init the plugin
	 */
	function bf_init() {

		// Enqueue assets
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Enqueue admin assets
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );

		// filter post content for
		add_filter( 'the_content', array( $this, 'the_content' ), 1 );

	}


	/**
	 * Callback: Used for registering scripts and styles
	 *
	 * Action: enqueue_scripts
	 */
	function enqueue_scripts() {

		wp_register_style( 'better-bam', Better_Ads_Manager()->dir_url( 'css/bam.css' ), array(), Better_Ads_Manager()->get_version() );

		wp_register_script( 'better-advertising', Better_Ads_Manager()->dir_url( 'js/advertising.js' ), array(), Better_Ads_Manager()->get_version(), TRUE );

		wp_register_script( 'better-bam', Better_Ads_Manager()->dir_url( 'js/bam.js' ), array(), Better_Ads_Manager()->get_version(), TRUE );

		wp_localize_script(
			'better-bam',
			'better_bam_loc',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);

	}


	/**
	 * Callback: Used for adding JS and CSS files to page
	 *
	 * Action: admin_enqueue_scripts
	 */
	function admin_enqueue_scripts() {

		if ( Better_Framework::self()->get_current_page_type() == 'metabox' || Better_Framework::self()->get_current_page_type() == 'panel' ) {
			wp_enqueue_style( 'better-ads-manager', $this->dir_url( 'css/better-ads-manager-admin.css' ), array(), Better_Ads_Manager()->get_version() );
		}

	}


	/**
	 * Get Campaigns
	 *
	 * @param array $extra Extra Options.
	 *
	 * @since 1.0
	 * @return array
	 */
	public static function get_campaigns( $extra = array() ) {

		/*
			Extra Usage:

			array(
				'posts_per_page'  => 5,
				'offset'          => 0,
				'category'        => '',
				'orderby'         => 'post_date',
				'order'           => 'DESC',
				'include'         => '',
				'exclude'         => '',
				'meta_key'        => '',
				'meta_value'      => '',
				'post_type'       => 'post',
				'post_mime_type'  => '',
				'post_parent'     => '',
				'post_status'     => 'publish',
				'suppress_filters' => true
			)
		*/


		$extra = wp_parse_args( $extra, array(
			'post_type'      => array( 'better-campaign' ),
			'posts_per_page' => - 1,
		) );

		$output = array();

		$query = get_posts( $extra );

		foreach ( $query as $post ) {
			$output[ $post->ID ] = $post->post_title;
		}

		return $output;

	}


	/**
	 * Get Banners
	 *
	 * @param array $extra Extra Options.
	 *
	 * @since 1.0
	 * @return array
	 */
	public static function get_banners( $extra = array() ) {

		/*
			Extra Usage:

			array(
				'posts_per_page'  => 5,
				'offset'          => 0,
				'category'        => '',
				'orderby'         => 'post_date',
				'order'           => 'DESC',
				'include'         => '',
				'exclude'         => '',
				'meta_key'        => '',
				'meta_value'      => '',
				'post_type'       => 'post',
				'post_mime_type'  => '',
				'post_parent'     => '',
				'post_status'     => 'publish',
				'suppress_filters' => true
			)
		*/


		$extra = wp_parse_args( $extra, array(
			'post_type'      => array( 'better-banner' ),
			'posts_per_page' => - 1,
		) );

		$output = array();

		$query = get_posts( $extra );

		foreach ( $query as $post ) {
			$output[ $post->ID ] = $post->post_title;
		}

		return $output;

	}


	/**
	 * Callback: Used to register post types
	 *
	 * Action: init
	 */
	function init() {

		//
		// Campaigns post type
		//
		$labels = array(
			'name'               => _x( 'Campaigns', 'post type general name', 'better-studio' ),
			'singular_name'      => _x( 'Campaign', 'post type singular name', 'better-studio' ),
			'menu_name'          => _x( 'Campaigns', 'admin menu', 'better-studio' ),
			'name_admin_bar'     => _x( 'Campaigns', 'add new on admin bar', 'better-studio' ),
			'add_new'            => _x( 'Add New Campaign', 'campaign', 'better-studio' ),
			'add_new_item'       => __( 'Add New Campaign', 'better-studio' ),
			'new_item'           => __( 'New Campaign', 'better-studio' ),
			'edit_item'          => __( 'Edit Campaign', 'better-studio' ),
			'view_item'          => __( 'View Campaign', 'better-studio' ),
			'all_items'          => __( 'Campaigns', 'better-studio' ),
			'search_items'       => __( 'Search Campaigns', 'better-studio' ),
			'not_found'          => __( 'No campaigns found.', 'better-studio' ),
			'not_found_in_trash' => __( 'No campaigns found in Trash.', 'better-studio' )
		);
		$args   = array(
			'public'       => FALSE,
			'labels'       => $labels,
			'show_in_menu' => 'better-studio/better-ads-manager',
			'show_ui'      => TRUE,
			'supports'     => array( 'title' )

		);
		register_post_type( 'better-campaign', $args );

		//
		// Banners post type
		//
		$labels = array(
			'name'               => _x( 'Banners', 'post type general name', 'better-studio' ),
			'singular_name'      => _x( 'Banner', 'post type singular name', 'better-studio' ),
			'menu_name'          => _x( 'Banners', 'admin menu', 'better-studio' ),
			'name_admin_bar'     => _x( 'Banners', 'add new on admin bar', 'better-studio' ),
			'add_new'            => _x( 'Add New Banner', 'campaign', 'better-studio' ),
			'add_new_item'       => __( 'Add New Banner', 'better-studio' ),
			'new_item'           => __( 'New Banner', 'better-studio' ),
			'edit_item'          => __( 'Edit Banner', 'better-studio' ),
			'view_item'          => __( 'View Banner', 'better-studio' ),
			'all_items'          => __( 'Banners', 'better-studio' ),
			'search_items'       => __( 'Search Banner', 'better-studio' ),
			'not_found'          => __( 'No banners found.', 'better-studio' ),
			'not_found_in_trash' => __( 'No banners found in Trash.', 'better-studio' )
		);
		$args   = array(
			'public'              => FALSE,
			'labels'              => $labels,
			'show_in_menu'        => 'better-studio/better-ads-manager',
			'show_ui'             => TRUE,
			'supports'            => array( 'title' ),
			'exclude_from_search' => TRUE,
			'publicly_queryable'  => FALSE,
			'show_in_nav_menus'   => FALSE,
			'show_in_admin_bar'   => FALSE,
		);
		register_post_type( 'better-banner', $args );

	}


	/**
	 * Setups Shortcodes for BetterMag
	 *
	 * 6. => Setup Shortcodes
	 *
	 * @param $shortcodes
	 *
	 * @return mixed
	 */
	function setup_shortcodes( $shortcodes ) {

		require_once $this->dir_path( 'includes/shortcodes/class-better-ads-shortcode.php' );
		require_once $this->dir_path( 'includes/widgets/class-better-ads-widget.php' );

		$shortcodes['better-ads'] = array(
			'shortcode_class' => 'Better_Ads_Shortcode',
			'widget_class'    => 'Better_Ads_Widget',
		);

		return $shortcodes;
	}


	/**
	 * Used for showing add
	 *
	 * @param $ad_data
	 *
	 * @return string
	 */
	function show_ads( $ad_data ) {

		$output = '';

		// ads css class, it comes from VC design option
		if ( ( $css_class = bf_shortcode_custom_css_class( $ad_data ) ) != '' ) {
			if ( ! empty( $ad_data['container-class'] ) ) {
				$ad_data['container-class'] .= ' ' . $css_class;
			} else {
				$ad_data['container-class'] = $css_class;
			}
		}

		if ( ! isset( $ad_data['type'] ) ) {

			if ( is_user_logged_in() ) {
				return $this->show_ads_container( $ad_data, '<div class="betterads-empty-note">' . __( 'Please select type of ad.', 'better-studio' ) . '</div>' );
			} else {
				return $this->show_ads_container( $ad_data, '' );
			}

		}

		// args of ads banners
		$args = array(
			'show-caption' => isset( $ad_data['show-caption'] ) ? $ad_data['show-caption'] : TRUE
		);

		switch ( $ad_data['type'] ) {


			case 'campaign':

				if ( ! isset( $ad_data['campaign'] ) || $ad_data['campaign'] == 'none' ) {
					if ( is_user_logged_in() ) {
						return $this->show_ads_container( $ad_data, '<div class="betterads-empty-note">' . __( 'Please select a campaign.', 'better-studio' ) . '</div>' );
					} else {
						return $this->show_ads_container( $ad_data, '' );
					}
				}

				if ( empty( $ad_data['count'] ) || intval( $ad_data['count'] ) <= 0 ) {
					$ad_data['count'] = - 1;
				}

				$c_query = new WP_Query( array(
					'post_type'      => 'better-banner',
					'meta_key'       => 'campaign',
					'meta_value'     => $ad_data['campaign'],
					'order'          => $ad_data['order'],
					'orderby'        => $ad_data['orderby'],
					'posts_per_page' => $ad_data['count'],
				) );

				if ( $c_query->have_posts() ) {

					if ( isset( $ad_data['count'] ) && intval( $ad_data['count'] ) > 0 ) {

						// count of adds
						$count = $ad_data['count'];
						if ( $count > count( $c_query->posts ) ) {
							$count = count( $c_query->posts );
						}

						$counter = 1;
						foreach ( $c_query->posts as $post ) {

							if ( $counter > $count ) {
								break;
							}

							$output .= $this->show_ad_banner( $post->ID, $args );

							$counter ++;
						}

					} else {
						foreach ( $c_query->posts as $post ) {
							$output .= $this->show_ad_banner( $post->ID, $args );
						}
					}

					return $this->show_ads_container( $ad_data, $output );

				} else {

					if ( is_user_logged_in() ) {
						return $this->show_ads_container( $ad_data, '<div class="betterads-empty-note">' . __( 'Selected campaign have not any active ad.', 'better-studio' ) . '</div>' );
					} else {
						return $this->show_ads_container( $ad_data, '' );
					}

				}

				break; // /campaign

			case 'banner':

				$ad_data['columns'] = 1;

				if ( ! isset( $ad_data['banner'] ) || $ad_data['banner'] == 'none' ) {
					if ( is_user_logged_in() ) {
						return $this->show_ads_container( $ad_data, '<div class="betterads-empty-note">' . __( 'Please select a banner.', 'better-studio' ) . '</div>' );
					} else {
						return $this->show_ads_container( $ad_data, '' );
					}
				}

				return $this->show_ads_container( $ad_data, $this->show_ad_banner( $ad_data['banner'], $args ) );

				break; // /banner

		}

	}


	/**
	 * Handy function used to generate ads container
	 *
	 * @param $ad_data
	 * @param $html
	 *
	 * @return string
	 */
	private function show_ads_container( $ad_data, $html ) {

		if ( ! isset( $ad_data['container-class'] ) ) {
			$ad_data['container-class'] = '';
		}

		$ad_data['container-class'] .= ' betterads-align-' . $ad_data['align'];
		$ad_data['container-class'] .= ' betterad-column-' . $ad_data['columns'];

		if ( isset( $ad_data['float'] ) && $ad_data['float'] != 'none' ) {
			$ad_data['container-class'] .= ' betterads-float-' . $ad_data['float'];
		}

		$output = '<div class="betteradscontainer betterads-clearfix ' . $ad_data['container-class'] . '">' . $html . '</div>';

		return $output;
	}


	/**
	 * Handy function used for showing ad banner from post id
	 *
	 * @param $banner_id
	 *
	 * @return string
	 */
	private function show_ad_banner( $banner_id, $args = array() ) {

		$args = wp_parse_args( $args, array(
			'show-caption' => TRUE
		) );

		$banner_data = $this->get_banner_data( $banner_id );

		$output = '';


		switch ( $banner_data['type'] ) {

			case 'image':

				if ( ! empty( $banner_data['caption'] ) ) {
					$title = $banner_data['caption'];
				} else {
					$title = $banner_data['title'];
				}

				$_ad = '<a itemprop="url" class="betterad-link" href="' . $banner_data['url'] . '" target="' . $banner_data['target'] . '" ';

				$_ad .= $banner_data['no_follow'] ? ' rel="nofollow" >' : '>';

				$_ad .= '<img class="betterad-image" src="' . $banner_data['img'] . '" alt="' . $title . '" />';

				$_ad .= '</a>';


				if ( ! empty( $banner_data['caption'] ) && $args['show-caption'] ) {
					$_ad .= '<span class="betterad-caption">' . $banner_data['caption'] . '</span>';
				}

				$output .= $this->show_ad_banner_container( $banner_data, $_ad );
				break;

			// code is Google Adsense code
			case 'code':

				$ad_data = better_ads_extract_google_ad_code_data( $banner_data['code'] );


				if( ! empty( $ad_data['ad-client'] ) && ! empty( $ad_data['ad-slot'] ) ){

					if ( ! empty( $banner_data['custom_id'] ) ) {
						$ad_id = $banner_data['custom_id'];
					} else {
						$ad_id = 'betterad-' . $banner_data['id'];
					}

					$ad_code = '<script type="text/javascript">';

					$ad_code .= 'betterads_screen_el = document.getElementById(\'' . $ad_id . '\');
if (betterads_screen_el.getBoundingClientRect().width) {
	betterads_screen_width = betterads_screen_el.getBoundingClientRect().width;
} else {
	betterads_screen_width = betterads_screen_el.offsetWidth;
}
if ( betterads_screen_width >= 728 )
	betterad_size = ["728", "90"];
else if ( betterads_screen_width >= 468 )
	betterad_size = ["468", "60"];
else if ( betterads_screen_width >= 336 )
	betterad_size = ["336", "280"];
else if ( betterads_screen_width >= 300 )
	betterad_size = ["300", "250"];
else if ( betterads_screen_width >= 250 )
	betterad_size = ["250", "250"];
else if ( betterads_screen_width >= 200 )
	betterad_size = ["200", "200"];
else if ( betterads_screen_width >= 180 )
	betterad_size = ["180", "150"];
else
	betterad_size = ["125", "125"];';

					$ad_code .= '
document.write ( \'<ins class="adsbygoogle" style="display:inline-block;width:\' + betterad_size[0] + \'px;height:\' + betterad_size[1] + \'px" data-ad-client="' . $ad_data['ad-client'] . '" data-ad-slot="' . $ad_data['ad-slot'] . '"></ins>\' );
(adsbygoogle = window.adsbygoogle || []).push({});</script><script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
';
					$output .= $this->show_ad_banner_container( $banner_data, $ad_code );

				}else{
					$output .= $this->show_ad_banner_container( $banner_data, $banner_data['code'] );
				}
				break;

			case 'custom_code':

				$output .= $this->show_ad_banner_container( $banner_data, $banner_data['code'] );
				break;


		}

		return $output;

	}


	/**
	 * Handy function used to create single ad container
	 *
	 * @param $banner_data
	 * @param $html
	 *
	 * @return string
	 */
	private function show_ad_banner_container( $banner_data, $html ) {

		$banner_data['custom_class'] = 'betterad-container betterad-type-' . $banner_data['type'] . ' ' . $banner_data['custom_class'];

		if ( ! empty( $banner_data['custom_css'] ) ) {
			Better_Framework()->assets_manager()->add_css( $banner_data['custom_css'], TRUE );
		}

		if ( ! empty( $banner_data['custom_id'] ) ) {
			$banner_data['final-id'] = $banner_data['custom_id'];
		} else {
			$banner_data['final-id'] = 'betterad-' . $banner_data['id'];
		}

		if ( ! $banner_data['show_desktop'] ) {
			$banner_data['custom_class'] .= ' betterads-hide-on-desktop';
		}

		if ( ! $banner_data['show_tablet_portrait'] ) {
			$banner_data['custom_class'] .= ' betterads-hide-on-tablet-portrait';
		}

		if ( ! $banner_data['show_phone'] ) {
			$banner_data['custom_class'] .= ' betterads-hide-on-phone';
		}

		return '<div id="' . $banner_data['final-id'] . '" class="' . $banner_data['custom_class'] . '" itemscope="" itemtype="https://schema.org/WPAdBlock" data-adid="' . $banner_data['id'] . '" data-type="' . $banner_data['type'] . '">' . $html . '</div>';

	}


	/**
	 * Handy function used for safely getting banner data
	 *
	 * @param $id
	 *
	 * @return array
	 */
	function get_banner_data( $id ) {

		$data = array(
			'id'                   => $id,
			'title'                => get_the_title( $id ),
			'campaign'             => 'none',
			'type'                 => 'code',
			'code'                 => '',
			'img'                  => '',
			'caption'              => '',
			'url'                  => '',
			'target'               => '',
			'no_follow'            => '',
			'show_desktop'         => TRUE,
			'show_tablet_portrait' => TRUE,
			'show_phone'           => TRUE,
			'custom_class'         => '',
			'custom_id'            => '',
			'custom_css'           => '',
		);

		if ( get_post_meta( $id, 'campaign', TRUE ) != FALSE ) {
			$data['campaign'] = get_post_meta( $id, 'campaign', TRUE );
		}

		if ( get_post_meta( $id, 'code', TRUE ) != FALSE ) {
			$data['code'] = get_post_meta( $id, 'code', TRUE );
		}

		if ( get_post_meta( $id, 'type', TRUE ) != FALSE ) {
			$data['type'] = get_post_meta( $id, 'type', TRUE );
		}

		if ( get_post_meta( $id, 'img', TRUE ) != FALSE ) {
			$data['img'] = get_post_meta( $id, 'img', TRUE );
		}

		if ( get_post_meta( $id, 'caption', TRUE ) != FALSE ) {
			$data['caption'] = get_post_meta( $id, 'caption', TRUE );
		}

		if ( get_post_meta( $id, 'url', TRUE ) != FALSE ) {
			$data['url'] = get_post_meta( $id, 'url', TRUE );
		}

		if ( get_post_meta( $id, 'target', TRUE ) != FALSE ) {
			$data['target'] = get_post_meta( $id, 'target', TRUE );
		}

		if ( count( get_post_meta( $id, 'no_follow' ) ) > 0 ) {
			$data['no_follow'] = get_post_meta( $id, 'no_follow', TRUE );
		}

		if ( count( get_post_meta( $id, 'show_desktop' ) ) > 0 ) {
			$data['show_desktop'] = get_post_meta( $id, 'show_desktop', TRUE );
		}

		if ( count( get_post_meta( $id, 'show_tablet_portrait' ) ) > 0 ) {
			$data['show_tablet_portrait'] = get_post_meta( $id, 'show_tablet_portrait', TRUE );
		}

		if ( count( get_post_meta( $id, 'show_phone' ) ) > 0 ) {
			$data['show_phone'] = get_post_meta( $id, 'show_phone', TRUE );
		}

		if ( get_post_meta( $id, 'custom_class', TRUE ) != FALSE ) {
			$data['custom_class'] = get_post_meta( $id, 'custom_class', TRUE );
		}

		if ( get_post_meta( $id, 'custom_id', TRUE ) != FALSE ) {
			$data['custom_id'] = get_post_meta( $id, 'custom_id', TRUE );
		}

		if ( get_post_meta( $id, 'custom_css', TRUE ) != FALSE ) {
			$data['custom_css'] = get_post_meta( $id, 'custom_css', TRUE );
		}

		return $data;

	}


	/**
	 * Handy function used for safely getting banner data
	 *
	 * @param $id
	 *
	 * @return array
	 */
	function get_banner_fallback_data( $id ) {

		$data = array(
			'id'        => $id,
			'title'     => get_the_title( $id ),
			'type'      => 'image',
			'code'      => '',
			'img'       => '',
			'caption'   => '',
			'url'       => '',
			'target'    => '',
			'no_follow' => '',
		);

		if ( get_post_meta( $id, 'fallback_type', TRUE ) != FALSE ) {
			$data['type'] = get_post_meta( $id, 'fallback_type', TRUE );
		}

		if ( get_post_meta( $id, 'fallback_code', TRUE ) != FALSE ) {
			$data['code'] = get_post_meta( $id, 'fallback_code', TRUE );
		}

		if ( get_post_meta( $id, 'fallback_img', TRUE ) != FALSE ) {
			$data['img'] = get_post_meta( $id, 'fallback_img', TRUE );
		}

		if ( get_post_meta( $id, 'fallback_caption', TRUE ) != FALSE ) {
			$data['caption'] = get_post_meta( $id, 'fallback_caption', TRUE );
		}

		if ( get_post_meta( $id, 'fallback_url', TRUE ) != FALSE ) {
			$data['url'] = get_post_meta( $id, 'fallback_url', TRUE );
		}

		if ( get_post_meta( $id, 'fallback_target', TRUE ) != FALSE ) {
			$data['target'] = get_post_meta( $id, 'fallback_target', TRUE );
		}

		if ( count( get_post_meta( $id, 'fallback_no_follow' ) ) > 0 ) {
			$data['no_follow'] = get_post_meta( $id, 'fallback_no_follow', TRUE );
		}

		return $data;

	}


	/**
	 * Callback: Used for adding ads to post content in frond end
	 *
	 * Filter: the_content
	 *
	 * @param $content
	 *
	 * @return string
	 */
	function the_content( $content ) {


		if ( is_singular( 'post' ) ) {

			//
			//
			// Multiple inline Ads
			//
			//
			$content_parts = explode( "\n", $content );

			foreach ( $this->get_option( 'ad_post_inline' ) as $inline_ad ) {

				if ( $inline_ad['type'] == 'none' || ( $inline_ad['type'] == 'banner' && $inline_ad['banner'] == 'none' ) || ( $inline_ad['type'] == 'campaign' && $inline_ad['campaign'] == 'none' ) ) {
					continue;
				}

				if ( intval( $inline_ad['paragraph'] ) - 1 <= 0 ) {
					$inline_ad['paragraph'] = 0;
				} else {
					$inline_ad['paragraph'] = intval( $inline_ad['paragraph'] ) - 1;
				}

				foreach ( $content_parts as $content_part_index => $content_part ) {

					if ( $inline_ad['paragraph'] == $content_part_index / 2 ) {

						$inline_ad['container-class'] = ' betterads-post-inline';
						$inline_ad['align']           = 'center';
						$inline_ad['float']           = $inline_ad['position'];

						$content_parts[ $content_part_index ] .= $this->show_ads( $inline_ad );

						break;
					}

				}

			}

			$content = implode( "\n", $content_parts );


			//
			//
			// Top Ads
			//
			//
			$top_ads = array(
				'type'            => $this->get_option( 'ad_post_top_type' ),
				'campaign'        => $this->get_option( 'ad_post_top_campaign' ),
				'banner'          => $this->get_option( 'ad_post_top_banner' ),
				'count'           => $this->get_option( 'ad_post_top_count' ),
				'columns'         => $this->get_option( 'ad_post_top_columns' ),
				'orderby'         => $this->get_option( 'ad_post_top_orderby' ),
				'order'           => $this->get_option( 'ad_post_top_order' ),
				'align'           => $this->get_option( 'ad_post_top_align' ),
				'container-class' => 'better-ads-post-top',
			);

			if ( ( $top_ads['type'] == 'banner' && $top_ads['banner'] != 'none' ) || ( $top_ads['type'] == 'campaign' && $top_ads['campaign'] != 'none' ) ) {
				$content = $this->show_ads( $top_ads ) . $content;
			}


			//
			//
			// Bottom Ads
			//
			//
			$bottom_ads = array(
				'type'            => $this->get_option( 'ad_post_bottom_type' ),
				'campaign'        => $this->get_option( 'ad_post_bottom_campaign' ),
				'banner'          => $this->get_option( 'ad_post_bottom_banner' ),
				'count'           => $this->get_option( 'ad_post_bottom_count' ),
				'columns'         => $this->get_option( 'ad_post_bottom_columns' ),
				'orderby'         => $this->get_option( 'ad_post_bottom_orderby' ),
				'order'           => $this->get_option( 'ad_post_bottom_order' ),
				'align'           => $this->get_option( 'ad_post_bottom_align' ),
				'container-class' => 'betterads-post-bottom',
			);

			if ( ( $bottom_ads['type'] == 'banner' && $bottom_ads['banner'] != 'none' ) || ( $bottom_ads['type'] == 'campaign' && $bottom_ads['campaign'] != 'none' ) ) {
				$content = $content . $this->show_ads( $bottom_ads );
			}

		}

		return $content;
	}


	/**
	 * Callback: Ajax callback for retrieving blocked ads fallback!
	 */
	function callback_blocked_ads() {


		if ( ! empty( $_POST["ads"] ) ) {
			$ads_list = $_POST["ads"];
		} else {
			$ads_list = array();
		}


		// Create ads fallback code
		foreach ( (array) $ads_list as $ad_id => $ad ) {

			// prepare data
			$banner_data = $this->get_banner_fallback_data( $ad_id );

			$output = '';

			switch ( $banner_data['type'] ) {

				case 'image':

					// custom title
					if ( ! empty( $banner_data['caption'] ) ) {
						$title = $banner_data['caption'];
					} else {
						$title = $banner_data['title'];
					}

					$output .= '<a itemprop="url" class="betterad-link" href="' . $banner_data['url'] . '" target="' . $banner_data['target'] . '" ';

					$output .= $banner_data['no_follow'] ? ' rel="nofollow" >' : '>';

					$output .= '<img class="betterad-image" src="' . $banner_data['img'] . '" alt="' . $title . '" />';

					if ( ! empty( $banner_data['caption'] ) ) {
						$output .= '<span class="betterad-caption">' . $banner_data['caption'] . '</span>';
					}

					$output .= '</a>';

					break;

				case 'code':

					$output .= $banner_data['code'];
					break;

			}

			$ads_list[ $ad_id ]['code'] = $output;

		}

		$result = array(
			'ads' => $ads_list
		);

		die( json_encode( $result ) );

	}
}
