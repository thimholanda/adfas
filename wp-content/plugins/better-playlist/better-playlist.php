<?php
/*
Plugin Name: Better Playlist
Plugin URI: https://themeforest.net/user/better-studio/portfolio?ref=Better-Studio
Description: The best way to show video playlist in WordPress
Version: 1.1.0
Author: BetterStudio
Author URI: http://betterstudio.com
Text Domain: better-studio
*/

// Fire up BetterPlaylist
new Better_Playlist();

class Better_Playlist {

	/**
	 * Contains BPL version number that used for assets for preventing cache mechanism
	 *
	 * @var string
	 */
	private static $version = '1.1.0';


	/**
	 * Contains BPL option panel id
	 *
	 * @var string
	 */
	public static $panel_id = 'better_playlist_options';


	function __construct() {

		// Clear BF transients on plugin activation
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );

		// Register included BF to loader
		add_filter( 'better-framework/loader', array( $this, 'better_framework_loader' ) );

		// Enable needed sections
		add_filter( 'better-framework/sections', array( $this, 'better_framework_sections' ) );

		// Custom functions
		include 'includes/functions.php';

		// todo add option panel for following actions
		// resetting cache
		// typography options
		// highlight color option
		// include 'includes/panel-options.php';

		// Active and new shortcodes
		add_filter( 'better-framework/shortcodes', array( $this, 'setup_shortcodes' ) );

		// Initialize Better Playlist
		// add_action( 'better-framework/after_setup', array( $this, 'init' ) );

		// Includes BF loader if not included before
		require_once 'includes/libs/better-framework/init.php';

		// Ads plugin textdomain
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// Enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

		// Enqueue admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
	}


	/**
	 *  Enqueue admin scripts
	 */
	function admin_enqueue() {
		wp_enqueue_style( 'better-playlist', self::dir_url( 'css/admin-style.css' ), array(), self::$version );
	}


	/**
	 *
	 */
	function enqueue_assets() {
		wp_enqueue_style( 'better-playlist', self::dir_url( 'css/better-playlist.css' ), array(), self::$version );

		bf_enqueue_script( 'element-query' );
		wp_enqueue_script( 'better-playlist', self::dir_url( 'js/better-playlist.js' ), array( 'jquery' ), self::$version );
	}


	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	function load_textdomain() {
		// Register text domain
		load_plugin_textdomain( 'better-studio', FALSE, 'better-playlist/languages' );
	}


	/**
	 * Returns BPL current Version
	 *
	 * @return string
	 */
	static function get_version() {
		return self::$version;
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
	 * Used for accessing plugin directory path
	 *
	 * @param string $address
	 *
	 * @return string
	 */
	public static function dir_path( $address = '' ) {
		return plugin_dir_path( __FILE__ ) . $address;
	}


	/**
	 * Clears BF transients for avoiding of happening any problem
	 */
	function plugin_activation() {
		delete_transient( '__better_framework__widgets_css' );
		delete_transient( '__better_framework__panel_css' );
		delete_transient( '__better_framework__menu_css' );
		delete_transient( '__better_framework__terms_css' );
		delete_transient( '__better_framework__final_fe_css' );
		delete_transient( '__better_framework__final_fe_css_version' );
		delete_transient( '__better_framework__backend_css' );
	}


	/**
	 * Adds included BetterFramework to loader
	 *
	 * @param $frameworks
	 *
	 * @return array
	 */
	function better_framework_loader( $frameworks ) {

		$frameworks[] = array(
			'version' => '2.6.2',
			'path'    => self::dir_path( 'includes/libs/better-framework/' ),
			'uri'     => self::dir_url( 'includes/libs/better-framework/' ),
		);

		return $frameworks;

	}


	/**
	 * Activate BF needed sections
	 *
	 * @param $sections
	 *
	 * @return mixed
	 */
	function better_framework_sections( $sections ) {

		$sections['vc-extender'] = TRUE;

		return $sections;

	}


	/**
	 *  Init the plugin
	 */
	function init() {
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
	 * Setups Shortcodes
	 *
	 * @param $shortcodes
	 *
	 * @return array
	 */
	function setup_shortcodes( $shortcodes ) {

		// Services
		require_once self::dir_path() . 'includes/services/bs-playlist-service.php';
		require_once self::dir_path() . 'includes/services/bs-youtube-service.php';
		require_once self::dir_path() . 'includes/services/bs-vimeo-service.php';

		// Base Playlist
		require_once self::dir_path() . 'includes/bs-playlist.php';

		// Base widget
		require_once self::dir_path() . 'includes/widgets/bs-playlist-widget.php';

		// Base shortcode
		require_once self::dir_path() . 'includes/shortcodes/bs-playlist-shortcode.php';
		require_once self::dir_path() . 'includes/shortcodes/bs-youtube-playlist-shortcodes.php';
		require_once self::dir_path() . 'includes/shortcodes/bs-vimeo-album-shortcodes.php';


		//
		// Youtube playlist
		//
		$shortcodes['bs-youtube-playlist-1'] = array(
			'shortcode_class' => 'BS_YouTube_Playlist_1_Shortcode',
			'widget_class'    => 'BS_YouTube_PlayList_1_Widget',
		);
		$shortcodes['bs-youtube-playlist-2'] = array(
			'shortcode_class' => 'BS_YouTube_Playlist_2_Shortcode',
			'widget_class'    => 'BS_YouTube_PlayList_2_Widget',
		);


		//
		// Vimeo Album
		//
		$shortcodes['bs-vimeo-album-1'] = array(
			'shortcode_class' => 'BS_Vimeo_Album_1_Shortcode',
			'widget_class'    => 'BS_Vimeo_Album_1_Widget',
		);
		$shortcodes['bs-vimeo-album-2'] = array(
			'shortcode_class' => 'BS_Vimeo_Album_2_Shortcode',
			'widget_class'    => 'BS_Vimeo_Album_2_Widget',
		);

		return $shortcodes;
	}


	/**
	 * Temp function to get strings
	 *
	 * todo add translation panel for this plugin
	 *
	 * @param $string_id
	 *
	 * @return string
	 */
	public static function _get( $string_id ){

		switch ( $string_id ){

			case 'widget_playlist':
				return 'Playlist';
				break;

			case 'bsp_by':
				return 'By';
				break;

		}

	}

} // Better_Playlist